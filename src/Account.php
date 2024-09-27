<?php

namespace Travian;

use MYSQLi_DB;

class Account
{
    function __construct()
    {
        global $session;
        if (isset($_POST['ft'])) {
            switch ($_POST['ft']) {
                case "a2":
                    $this->Activate();
                    break;
                case "a3":
                    $this->Unreg();
                    break;
                case "a4":
                    $this->Login();
                    break;
            }
        }
        if (isset($_GET['code'])) {
            $_POST['id'] = $_GET['code'];
            $this->Activate();
        } else {
            if ($session->logged_in && in_array("logout.php", explode("/", $_SERVER['PHP_SELF']))) {
                $this->Logout();
            }
        }
    }

    public function Signup(
        MyGenerator $generator,
        Form        $form,
        MYSQLi_DB   $database,
        Mailer      $mailer,
        Message     $message,
    ): void
    {
        $this->validateRegistrationForm($form, $database);

        if ($form->returnErrors() > 0) {
            $form->addError("invt", $_POST['invited']);
            $_SESSION['errorarray'] = $form->getErrors();
            $_SESSION['valuearray'] = $_POST;

            return;
        }

        if (AUTH_EMAIL) {
            $act = $generator->generateRandStr(10);
            $act2 = $generator->generateRandStr(5);
            $uid = $database->activate($_POST['name'], md5($_POST['pw']), $_POST['email'], $_POST['vid'], $_POST['kid'], $act, $act2);
            if ($uid) {
                $mailer->sendActivate($_POST['email'], $_POST['name'], $_POST['pw'], $act);
                header("Location: activate.php?id=$uid&q=$act2");
                exit;
            }
        } else {
            $database->startTransaction();
            $uid = $database->register($_POST['name'], md5($_POST['pw']), $_POST['email'], $_POST['vid'], "");
            if (!$uid) {
                $database->getConnection()->rollback();
                die('Unable to create user');
            }

            $database->updateUserField($uid, "act", "", 1);
            if (!empty($_POST['invited'])) {
                $database->updateUserField($uid, "invited", $_POST['invited'], 1);
            }
            $this->generateBase($database, (int)$_POST['kid'], $uid, $_POST['name']);
            $message->sendWelcome($database, $uid, $_POST['name']);

            $database->commit();

            setcookie("COOKUSR", $_POST['name'], time() + COOKIE_EXPIRE, COOKIE_PATH);
            setcookie("COOKEMAIL", $_POST['email'], time() + COOKIE_EXPIRE, COOKIE_PATH);

            header("Location: login.php");
            exit;
        }
    }

    private function validateRegistrationForm(Form $form, MYSQLi_DB $database): void
    {
        if (!isset($_POST['name']) || trim($_POST['name']) == "") {
            $form->addError("name", USRNM_EMPTY);
        } else {
            if (strlen($_POST['name']) < USRNM_MIN_LENGTH) {
                $form->addError("name", USRNM_SHORT);
            } else if (!USRNM_SPECIAL && preg_match('/[^0-9A-Za-z]/', $_POST['name'])) {
                $form->addError("name", USRNM_CHAR);
            } else if (USRNM_SPECIAL && preg_match("/[:,\\. \\n\\r\\t\\s\\<\\>]+/", $_POST['name'])) {
                $form->addError("name", USRNM_CHAR);
            } else if ($database->checkExist($_POST['name'], 0)) {
                $form->addError("name", USRNM_TAKEN);
            } else if ($database->checkExist_activate($_POST['name'], 0)) {
                $form->addError("name", USRNM_TAKEN);
            }
        }

        if (!isset($_POST['pw']) || trim($_POST['pw']) == "") {
            $form->addError("pw", PW_EMPTY);
        } else {
            if (strlen($_POST['pw']) < PW_MIN_LENGTH) {
                $form->addError("pw", PW_SHORT);
            } else if ($_POST['pw'] == $_POST['name']) {
                $form->addError("pw", PW_INSECURE);

            }
        }

        if (!isset($_POST['email'])) {
            $form->addError("email", EMAIL_EMPTY);
        } else {
            if (!$this->validEmail($_POST['email'])) {
                $form->addError("email", EMAIL_INVALID);
            } else if ($database->checkExist($_POST['email'], 1)) {
                $form->addError("email", EMAIL_TAKEN);
            } else if ($database->checkExist_activate($_POST['email'], 1)) {
                $form->addError("email", EMAIL_TAKEN);
            }
        }

        if (!isset($_POST['vid'])) {
            $form->addError("tribe", TRIBE_EMPTY);
        }

        if (!isset($_POST['agb'])) {
            $form->addError("agree", AGREE_ERROR);
        }
    }

    private function Activate()
    {
        if (START_DATE < date('m/d/Y') or START_DATE == date('m/d/Y') && START_TIME <= date('H:i')) {
            global $database;
            $q = "SELECT * FROM " . TB_PREFIX . "activate where act = '" . $_POST['id'] . "'";
            $result = mysqli_query($q, $database->connection);
            $dbarray = mysqli_fetch_array($result);
            if ($dbarray['act'] == $_POST['id']) {
                $uid = $database->register($dbarray['username'], $dbarray['password'], $dbarray['email'], $dbarray['tribe'], "");
                if ($uid) {
                    $database->unreg($dbarray['username']);
                    $this->generateBase($dbarray['kid'], $uid, $dbarray['username']);
                    $message->sendWelcome($uid, $username);
                    header("Location: activate.php?e=2");
                }
            } else {
                header("Location: activate.php?e=3");
            }
        } else {
            header("Location: activate.php");
        }

    }

    private function Unreg()
    {
        global $database;
        $q = "SELECT * FROM " . TB_PREFIX . "activate where id = '" . $_POST['id'] . "'";
        $result = mysqli_query($q, $database->connection);
        $dbarray = mysqli_fetch_array($result);
        if (md5($_POST['pw']) == $dbarray['password']) {
            $database->unreg($dbarray['username']);
            header("Location: registration.php");
        } else {
            header("Location: activate.php?e=3");
        }
    }

    private function Login()
    {
        global $database, $session, $form;
        $_POST['user'] = mysqli_real_escape_string($_POST['user']);
        if (!isset($_POST['user']) || $_POST['user'] == "") {
            $form->addError("user", LOGIN_USR_EMPTY);
        } else if (!$database->checkExist($_POST['user'], 0)) {
            $form->addError("user", USR_NT_FOUND);
        }
        if (!isset($_POST['pw']) || $_POST['pw'] == "") {
            $form->addError("pw", LOGIN_PASS_EMPTY);
        } else if (!$database->login($_POST['user'], $_POST['pw']) && !$database->sitterLogin($_POST['user'], $_POST['pw'])) {
            $form->addError("pw", LOGIN_PW_ERROR);
        }
        if ($database->getUserField($_POST['user'], "act", 1) != "") {
            $form->addError("activate", $_POST['user']);
        }
        // Vacation mode by Shadow
        if ($database->getUserField($_POST['user'], "vac_mode", 1) == 1 && $database->getUserField($_POST['user'], "vac_time", 1) > time()) {
            $form->addError("vacation", "Vacation mode is still enabled");
        }
        // Vacation mode by Shadow
        if ($form->returnErrors() > 0) {
            $_SESSION['errorarray'] = $form->getErrors();
            $_SESSION['valuearray'] = $_POST;

            header("Location: login.php");
        } else {
            $userid = $database->getUserArray($_POST['user'], 0);
            // Vacation mode by Shadow
            $database->removevacationmode($userid['id']);
            // Vacation mode by Shadow
            if ($database->login($_POST['user'], $_POST['pw'])) {
                $database->UpdateOnline("login", $_POST['user'], time(), $userid['id']);
            } else if ($database->sitterLogin($_POST['user'], $_POST['pw'])) {
                $database->UpdateOnline("sitter", $_POST['user'], time(), $userid['id']);
            }
            setcookie("COOKUSR", $_POST['user'], time() + COOKIE_EXPIRE, COOKIE_PATH);
            $session->login($_POST['user']);
        }
    }

    private function Logout()
    {
        global $session, $database;
        unset($_SESSION['wid']);
        $database->activeModify(addslashes($session->username), 1);
        $database->UpdateOnline("logout");
        $session->Logout();
    }

    private function validEmail($email)
    {
        $regexp = "/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
        if (!preg_match($regexp, $email)) {
            return false;
        }
        return true;
    }

    private function generateBase(MYSQLi_DB $database, int $kid, $uid, $username)
    {
        if ($kid === 0) {
            $kid = random_int(1, 4);
        }

        $wid = $database->generateBase($kid, 0);
        $database->setFieldTaken($wid);
        $database->addVillage($wid, $uid, $username, 1);
        $database->addResourceFields($wid, $database->getVillageType($wid));
        $database->initUnits($wid);
        $database->initTech($wid);
        $database->initABTech($wid);
        $database->updateUserField($uid, "access", USER, 1);
    }
}
