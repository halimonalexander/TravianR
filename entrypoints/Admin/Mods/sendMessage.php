<?php

include_once("../../GameEngine/Account.php");
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);
if (!isset($_SESSION)) session_start();
if ($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");

$uid = $_POST['uid'];
$topic = $_POST['topic'];
$message = $_POST['message'];
$time = time();

$query = "INSERT INTO mdata (target, owner, topic, message, viewed, time) VALUES ('$uid', 1, '$topic', '$message', 0, '$time')";

mysql_query($query);

header("Location: ../../../Admin/admin.php?p=Newmessage&uid=" . $uid . "&msg=ok");
