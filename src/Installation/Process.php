<?php

declare(strict_types=1);

namespace Travian\Installation;

class Process
{
    public function createServerConfigFile(): void
    {
        $root = $_SERVER['DOCUMENT_ROOT'];
        $filename = "/install/include/constant.php";

        $data = $this->prepareConfigData();

        $myFile = $root . $filename;
        $fh = fopen($myFile, 'wb') or die("Can't create file: " . $filename);
        fwrite($fh, $data);

        if (file_exists($root . $filename)) {
            header("Location: index.php?s=2");
        } else {
            header("Location: index.php?s=1&c=1");
        }

        fclose($fh);
    }

    private function prepareConfigData(): string
    {
        $text = file_get_contents(__DIR__ . "/data/constant_format.tpl");
        if ($text === false) {
            die('unable to get example file');
        }

        $text = preg_replace("'%SERVERNAME%'", $_POST['servername'], $text);
        $text = preg_replace("'%SSTARTDATE%'", $_POST['start_date'], $text);
        $text = preg_replace("'%SSTARTTIME%'", $_POST['start_time'], $text);
        $tz = explode(",", $_POST['tzone']);
        $text = preg_replace("'%STIMEZONE%'", $tz[1], $text);
        $text = preg_replace("'%LANG%'", $_POST['lang'], $text);
        $text = preg_replace("'%SPEED%'", $_POST['speed'], $text);
        $text = preg_replace("'%INCSPEED%'", $_POST['incspeed'], $text);
        $text = preg_replace("'%EVASIONSPEED%'", $_POST['evasionspeed'], $text);
        $text = preg_replace("'%TRADERCAP%'", $_POST['tradercap'], $text);
        $text = preg_replace("'%CRANNYCAP%'", $_POST['crannycap'], $text);
        $text = preg_replace("'%TRAPPERCAP%'", $_POST['trappercap'], $text);
        $text = preg_replace("'%STORAGE_MULTIPLIER%'", $_POST['storage_multiplier'], $text);
        $text = preg_replace("'%UTRACK%'", $_POST['trackusers'] ?? '', $text);
        $text = preg_replace("'%UTOUT%'", $_POST['timeout'] ?? '', $text);
        $text = preg_replace("'%AUTOD%'", $_POST['autodel'] ?? '', $text);
        $text = preg_replace("'%AUTODT%'", $_POST['autodeltime'] ?? '', $text);
        $text = preg_replace("'%MAX%'", $_POST['wmax'], $text);
        $text = preg_replace("'%GP%'", $_POST['gpack'] ?? '', $text);
        $text = preg_replace("'%SSERVER%'", $_POST['sserver'], $text);
        $text = preg_replace("'%SUSER%'", $_POST['suser'], $text);
        $text = preg_replace("'%SPASS%'", $_POST['spass'], $text);
        $text = preg_replace("'%SDB%'", $_POST['sdb'], $text);
        $text = preg_replace("'%PREFIX%'", $_POST['prefix'], $text);
        $text = preg_replace("'%CONNECTT%'", $_POST['connectt'], $text);
        $text = preg_replace("'%AEMAIL%'", $_POST['aemail'], $text);
        $text = preg_replace("'%ANAME%'", $_POST['aname'], $text);
        $text = preg_replace("'%SUBDOM%'", $_POST['subdom'] ?? '', $text);
        $text = preg_replace("'%LOGBUILD%'", $_POST['log_build'], $text);
        $text = preg_replace("'%LOGTECH%'", $_POST['log_tech'], $text);
        $text = preg_replace("'%LOGLOGIN%'", $_POST['log_login'], $text);
        $text = preg_replace("'%LOGGOLDFIN%'", $_POST['log_gold_fin'], $text);
        $text = preg_replace("'%LOGADMIN%'", $_POST['log_admin'], $text);
        $text = preg_replace("'%LOGWAR%'", $_POST['log_war'], $text);
        $text = preg_replace("'%LOGMARKET%'", $_POST['log_market'], $text);
        $text = preg_replace("'%LOGILLEGAL%'", $_POST['log_illegal'], $text);
        $text = preg_replace("'%MINUSERLENGTH%'", $_POST['userlength'] ?? '', $text);
        $text = preg_replace("'%MINPASSLENGTH%'", $_POST['passlength'] ?? '', $text);
        $text = preg_replace("'%SPECIALCHARS%'", $_POST['specialchars'] ?? '', $text);
        $text = preg_replace("'%ACTIVATE%'", $_POST['activate'], $text);
        $text = preg_replace("'%ARANK%'", $_POST['admin_rank'], $text);
        $text = preg_replace("'%QUEST%'", $_POST['quest'], $text);
        $text = preg_replace("'%QTYPE%'", $_POST['qtype'], $text);
        $text = preg_replace("'%BEGINNER%'", $_POST['beginner'], $text);
        $text = preg_replace("'%STARTTIME%'", (string)time(), $text);
        $text = preg_replace("'%DOMAIN%'", $_POST['domain'], $text);
        $text = preg_replace("'%HOMEPAGE%'", $_POST['homepage'], $text);
        $text = preg_replace("'%SERVER%'", $_POST['server'], $text);
        $text = preg_replace("'%LIMIT_MAILBOX%'", $_POST['limit_mailbox'], $text);
        $text = preg_replace("'%MAX_MAILS%'", $_POST['max_mails'], $text);
        $text = preg_replace("'%DEMOLISH%'", $_POST['demolish'], $text);
        $text = preg_replace("'%BOX1%'", $_POST['box1'], $text);
        $text = preg_replace("'%BOX2%'", $_POST['box2'], $text);
        $text = preg_replace("'%BOX3%'", $_POST['box3'], $text);
        $text = preg_replace("'%VILLAGE_EXPAND%'", $_POST['village_expand'], $text);
        $text = preg_replace("'%ERRORREPORT%'", $_POST['error'], $text);
        $text = preg_replace("'%ERROR%'", $_POST['error'], $text);
        $text = preg_replace("'%GP_LOCATE%'", $_POST['gp_locate'] ?? '', $text);
        $text = preg_replace("'%PLUS_TIME%'", $_POST['plus_time'], $text);
        $text = preg_replace("'%PLUS_PRODUCTION%'", $_POST['plus_production'], $text);
        $text = preg_replace("'%MEDALINTERVAL%'", $_POST['medalinterval'], $text);
        $text = preg_replace("'%GREAT_WKS%'", $_POST['great_wks'], $text);
        $text = preg_replace("'%TS_THRESHOLD%'", $_POST['ts_threshold'], $text);
        $text = preg_replace("'%WW%'", $_POST['ww'], $text);
        $text = preg_replace("'%SHOW_NATARS%'", $_POST['show_natars'], $text);
        $text = preg_replace("'%NATARS_UNITS%'", $_POST['natars_units'], $text);
        $text = preg_replace("'%NATURE_REGTIME%'", $_POST['nature_regtime'], $text);
        $text = preg_replace("'%REG_OPEN%'", $_POST['reg_open'], $text);
        $text = preg_replace("'%PEACE%'", $_POST['peace'], $text);

        return $text;
    }

    public function createDatabaseStructure(Database $database): void
    {
        $sqls = file_get_contents(__DIR__ . "/data/db_structure.sql");

        $result = $database->multi_query($sqls);

        if ($result) {
            header("Location: index.php?s=3");
        } else {
            header("Location: index.php?s=2&c=1");
        }
    }

    public function generateMap(Database $database): void
    {
        set_time_limit(0);

        header("Location: index.php?s=4");
    }

    public function createMultihunter(Database $database, \MYSQLi_DB $grandModel): void
    {
        if (!isset($_POST['mhpw'])) {
            die('Password is not set');
        }

        if (file_exists("include/constant.php") && !file_exists("../GameEngine/config.php")) {
            rename("include/constant.php", "../GameEngine/config.php");
        }

        $password = $_POST['mhpw'];
        $database->query("UPDATE users SET password = '" . md5($password) . "' WHERE username = 'Multihunter'");
        $uid = 5;

        $wid = $grandModel->getVilWref(0, 0);
        $status = $grandModel->getVillageState($wid);
        if ($status === false) {
            $grandModel->setFieldTaken($wid);
            $grandModel->addVillage($wid, $uid, 'Multihunter', '0');
            $grandModel->addResourceFields($wid, $grandModel->getVillageType($wid));
            $grandModel->initUnits($wid);
            $grandModel->initTech($wid);
            $grandModel->initABTech($wid);
        }

        header("Location: index.php?s=5");
    }

    public function populateOasises(\MYSQLi_DB $grandModel): void
    {
        header("Location: ../index.php?s=6");
    }
}
