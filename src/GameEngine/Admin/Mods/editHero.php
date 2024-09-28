<?php

if (!isset($_SESSION)) session_start();
if ($_SESSION['access'] < 9) die("Access Denied: You are not Admin!");
$status = "&ce=1";
if (isset($_POST['id'])) {
    $_POST['hname'] = trim(stripslashes($_POST['hname']));
    if ($_POST['hname'] == "") {
        header("Location: ../../../Admin/admin.php?p=editHero&uid=" . $_POST['id'] . "&e=1");
        exit;
    }

    include_once("../../Data/hero_full.php");

    $id = $_POST['id'];

    $q = "UPDATE hero SET unit=" . $_POST['hunit'] . ", name='" . $_POST['hname'] . "', level=" . $_POST['hlvl'] . ", points=" . $_POST['exp'] . ", experience=" . $hero_levels[$_POST['hlvl']] . ", health=" . $_POST['hhealth'] . ",
		attack=" . $_POST['hatk'] . ", defence=" . $_POST['hdef'] . ", attackbonus=" . $_POST['hob'] . ", defencebonus=" . $_POST['hdb'] . ", regeneration=" . $_POST['hrege'] . " WHERE uid = " . $id;
    $return = $database->query($q);
    if ($return) {
        $database->query("Insert into admin_log values (0," . $_SESSION['id'] . ",'Changed hero info'," . time() . ")");
        $status = "&cs=1";
    }
}
header("Location: ../../../Admin/admin.php?p=player&uid=" . $id . $status);
?>
