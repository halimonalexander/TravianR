<?php

namespace Travian;

use MYSQLi_DB;

class Account
{

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
}
