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

$query = "INSERT INTO mdata (target, owner, topic, message, viewed, time) VALUES ('$uid', 1, '$topic', '$message', 0, '$time')";

mysql_query($query);

header("Location: ../../../Admin/admin.php?p=Newmessage&uid=" . $uid . "&msg=ok");
?>
