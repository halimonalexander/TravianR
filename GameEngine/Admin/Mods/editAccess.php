<?php

if (!isset($_SESSION)) session_start();
if ($_SESSION['access'] < 9) die("Access Denied: You are not Admin!");
include_once("../../config.php");

mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);

$session = $_POST['admid'];
$id = $_POST['uid'];

$sql = mysql_query("SELECT * FROM " . TB_PREFIX . "users WHERE id = " . $session . "");
$access = mysql_fetch_array($sql);
$sessionaccess = $access['access'];

if ($sessionaccess != 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

$access = $_POST['access'];

mysql_query("UPDATE " . TB_PREFIX . "users SET 
	access = " . $access . " 
	WHERE id = " . $id . "") or die(mysql_error());

header("Location: ../../../Admin/admin.php?p=player&uid=" . $id . "");
