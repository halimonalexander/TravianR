<?php

use Travian\Installation\Database;
use Travian\Installation\Process;

ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);

require('../vendor/autoload.php');
include("../GameEngine/Database/db_MYSQLi.php");

$isConfigLoaded = false;
if (file_exists("include/constant.php")) {
    include("include/constant.php");
    $isConfigLoaded = true;
} elseif (file_exists("../GameEngine/config.php")) {
    include("../GameEngine/config.php");
    $isConfigLoaded = true;
}

if ($isConfigLoaded) {
    $database = new Database();
    $grandModel = new MYSQLi_DB($database->getConnection());
}

if (isset($_POST['subconst'])) {
    (new Process())->createServerConfigFile();
} elseif (isset($_POST['substruc'])) {
    (new Process())->createDatabaseStructure($database);
} elseif (isset($_POST['subwdata'])) {
    (new Process())->generateMap($database);
} elseif (isset($_POST['mhunter'])) {
    (new Process())->createMultihunter($database, $grandModel);
} elseif (isset($_POST['popoasis'])) {
    (new Process())->populateOasises($grandModel);
} else {
    header("Location: index.php");
}
