<?php

use Travian\Security;

if (!file_exists('GameEngine/config.php')) {
    header("Location: install/");
    exit;
}
if (!file_exists('scr/Security.php')) {
    die('Security: Please activate security class!');
}

require("GameEngine/config.php");

require 'src/Security.php';
Security::instance();

require("GameEngine/Database/GrandRepository.php");
$database = new MYSQLi_DB();

require("GameEngine/Lang/" . LANG . ".php");

