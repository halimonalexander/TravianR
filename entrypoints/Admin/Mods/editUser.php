<?php

include_once("../../Account.php");
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);
if (!isset($_SESSION)) session_start();
if ($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");

$id = $_POST['id'];
$user = $database->getUserArray($id, 1);
mysql_query("UPDATE users SET email = '" . $_POST['email'] . "', tribe = " . $_POST['tribe'] . ", location = '" . $_POST['location'] . "', desc1 = '" . $_POST['desc1'] . "', `desc2` = '" . $_POST['desc2'] . "' WHERE id = " . $_POST['id'] . "");
mysql_query("Insert into admin_log values (0," . $_SESSION['id'] . ",'Changed <a href=\'admin.php?p=village&did=$id\'>" . $user['username'] . "</a>\'s profile'," . time() . ")");


header("Location: ../../../Admin/admin.php?p=player&uid=" . $id . "");
