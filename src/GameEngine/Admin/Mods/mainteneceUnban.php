<?php

if (!isset($_SESSION)) session_start();
if ($_SESSION['access'] < 9) die("Access Denied: You are not Admin!");
include_once("../../config.php");

mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);

$session = $_POST['admid'];

$sql = mysql_query("SELECT * FROM users WHERE id = " . $session . "");
$access = mysql_fetch_array($sql);
$sessionaccess = $access['access'];

if ($sessionaccess != 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

$users = mysql_num_rows(mysql_query("SELECT * FROM users"));

$reason = $_POST['unbanreason'];
$admin = $session;
$active = '0';
$access = '2';
$actualend = time();

$sql = "SELECT id FROM users ORDER BY ID DESC LIMIT 1";
$loops = mysql_result(mysql_query($sql), 0);

for ($i = 0; $i < $loops + 1; $i++) {
    $query = "SELECT * FROM users WHERE id = " . $i . " AND access = " . $access . "";
    $result = mysql_query($query);
    while ($row = mysql_fetch_assoc($result)) {
        mysql_query("UPDATE banlist SET active = '" . $active . "', end = '" . $actualend . "' WHERE reason = '" . $reason . "'");
    }
}

header("Location: ../../../Admin/admin.php?p=ban");
?>
