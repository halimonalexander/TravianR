<?php

include_once("../../Account.php");
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);
if (!isset($_SESSION)) session_start();
if ($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");

$id = $_POST['id'];
$admid = $_POST['admid'];
mysql_query("UPDATE users SET cp = cp + " . $_POST['cp'] . " WHERE id = " . $id . "");

$name = $database->getUserField($id, "username", 0);
mysql_query("Insert into admin_log values (0,$admid,'Added " . $_POST['cp'] . " Cultural Points to user <a href=\'admin.php?p=player&uid=$id\'>$name</a> '," . time() . ")");

header("Location: ../../../Admin/admin.php?p=player&uid=" . $id . "&cp=ok");
?>
