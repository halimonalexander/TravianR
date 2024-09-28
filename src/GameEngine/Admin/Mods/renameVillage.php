<?php

if (!isset($_SESSION)) session_start();
if ($_SESSION['access'] < 9) die("Access Denied: You are not Admin!");
include_once("../../config.php");

mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);

$did = $_POST['did'];
$name = $_POST['villagename'];
$session = $_POST['admid'];

$sql = mysql_query("SELECT * FROM users WHERE id = " . $session . "");
$access = mysql_fetch_array($sql);
$sessionaccess = $access['access'];

if ($sessionaccess != 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

$sql = "UPDATE vdata SET name = '$name' WHERE wref = $did";
mysql_query($sql);

header("Location: ../../../Admin/admin.php?p=village&did=" . $did . "&name=" . $name . "");
?>
