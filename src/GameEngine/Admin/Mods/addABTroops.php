<?php

if (!isset($_SESSION)) session_start();
if ($_SESSION['access'] < 9) die("Access Denied: You are not Admin!");

$id = $_POST['id'];
$village = $database->getVillage($id);
$user = $database->getUserArray($village['owner'], 1);
$atech = "";
$btech = "";
for ($i = 1; $i < 9; $i++) {
    $atech .= "a" . $i . "=" . $_POST['a' . $i] . ", ";
    $btech .= "b" . $i . "=" . $_POST['b' . $i] . (($i > 7) ? "" : ", ");
}

$q = "UPDATE abdata SET " . $atech . $btech . " WHERE vref = $id";
$database->query($q);
$database->query("Insert into admin_log values (0," . $_SESSION['id'] . ",'Changed troop anmount in village <a href=\'admin.php?p=village&did=$id\'>$id</a> '," . time() . ")");

header("Location: ../../../Admin/admin.php?p=village&did=" . $id . "&ab");

?>
