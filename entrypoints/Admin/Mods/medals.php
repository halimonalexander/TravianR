<?php

include_once("../../Account.php");

mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);

if (!isset($_SESSION)) session_start();
if ($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");

$medalid = $_POST['medalid'];
$uid = $_POST['uid'];

mysql_query("DELETE FROM medal WHERE id = " . $medalid . "");

$name = mysql_query("SELECT name FROM users WHERE id= " . $uid . "");
$name = mysql_result($name, 0);

mysql_query("Insert into admin_log values (0,$admid,'Deleted medal id [#" . $medalid . "] from the user <a href=\'admin.php?p=player&uid=$uid\'>$name</a> '," . time() . ")");


$deleteweek = $_POST['medalweek'];
mysql_query("DELETE FROM medal WHERE week = " . $deleteweek . "");

header("Location: ../../../Admin/admin.php?p=player&uid=" . $uid . "");
?>
