<?php

//heef npc uitzondering omdat die met speciaal $_post werken
if (isset($_POST)) {
    if (!isset($_POST['ft'])) {
        $_POST = @array_map('mysql_real_escape_string', $_POST);
        $_POST = array_map('htmlspecialchars', $_POST);
    }
}
$rsargs = $_GET['rsargs'];
$_GET = array_map('mysql_real_escape_string', $_GET);
$_GET = array_map('htmlspecialchars', $_GET);
$_GET['rsargs'] = $rsargs;
$_COOKIE = array_map('mysql_real_escape_string', $_COOKIE);
$_COOKIE = array_map('htmlspecialchars', $_COOKIE);
