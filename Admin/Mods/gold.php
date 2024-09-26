<?php

include_once("../../Account.php");
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);
if (!isset($_SESSION)) session_start();
if ($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");

$id = $_POST['id'];
$gold = $_POST['gold'];

$q = "UPDATE " . TB_PREFIX . "users SET gold = gold + " . $_POST['gold'] . " WHERE id != '0'";
mysql_query($q);
mysql_query("Insert into " . TB_PREFIX . "admin_log values (0,$id,'Added <b>$gold</b> gold to all users'," . time() . ")");

header("Location: ../../../Admin/admin.php?p=gold&g");
