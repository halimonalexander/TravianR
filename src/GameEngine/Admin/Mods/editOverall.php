<?php

if (!isset($_SESSION)) session_start();
if ($_SESSION['access'] < 9) die("Access Denied: You are not Admin!");
include_once("../../config.php");

mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);

$session = $_POST['admid'];
$id = $_POST['id'];

$sql = mysql_query("SELECT * FROM users WHERE id = " . $session . "");
$access = mysql_fetch_array($sql);
$sessionaccess = $access['access'];

if ($sessionaccess != 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

mysql_query("UPDATE users SET
	apall = '" . $_POST['off'] . "',
	dpall = '" . $_POST['def'] . "'
	WHERE id = $id"));

header("Location: ../../../Admin/admin.php?p=player&uid=" . $id . "");
?>
