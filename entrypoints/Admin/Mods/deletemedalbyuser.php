<?php

include_once("../../Account.php");
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);
if (!isset($_SESSION)) session_start();
if ($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");


$userid = $_POST['userid'];
mysql_query("DELETE FROM medal WHERE userid = " . $userid . "");

header("Location: ../../../Admin/admin.php?p=player&uid=" . $userid . "");
