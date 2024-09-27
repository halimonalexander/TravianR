<?php

include_once("../../Account.php");

mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);

if (!isset($_SESSION)) session_start();
if ($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");

$did = $_POST['did'];
$name = $_POST['villagename'];
$sql = "UPDATE " . TB_PREFIX . "vdata SET name = '$name' WHERE wref = $did";

mysql_query($sql);

header("Location: ../../../Admin/admin.php?p=village&did=" . $did . "&name=" . $name . "");
