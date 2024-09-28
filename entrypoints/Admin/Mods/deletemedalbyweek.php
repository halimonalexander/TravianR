<?php

include_once("../../Account.php");
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);
if (!isset($_SESSION)) session_start();
if ($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");

$deleteweek = $_POST['medalweek'];
mysql_query("DELETE FROM medal WHERE week = " . $deleteweek . "");

header("Location: ../../../Admin/admin.php?p=delmedal");
