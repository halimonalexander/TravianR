<?php

if ($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");


$id = $_GET['did'];

if (isset($id))
{
$village = $database->getVillage($id);
$user = $database->getUserArray($village['owner'], 1);
$coor = $database->getCoor($village['wref']);
$varray = $database->getProfileVillages($village['owner']);
$type = $database->getVillageType($village['wref']);
$fdata = $database->getResourceLevel($village['wref']);
$units = $database->getUnit($village['wref']);
?>
<table id="member">
    <thead>
    <tr>
        <th colspan="2">Edit Village Name</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?php echo $village['name']; ?></td>
        </td>
    </tbody>
</table>