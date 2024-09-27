<?php

if (isset($_POST)) {
    if (!isset($_POST['ft'])) {
        $_POST = @array_map(fn ($value) => $database->getConnection()->real_escape_string($value), $_POST);
        $_POST = array_map('htmlspecialchars', $_POST);
    }
}

$rsargs = $_GET['rsargs'] ?? null;

$_GET = array_map(fn ($value) => $database->getConnection()->real_escape_string($value), $_GET);
$_GET = array_map('htmlspecialchars', $_GET);

$_GET['rsargs'] = $rsargs;

$_COOKIE = array_map(fn ($value) => $database->getConnection()->real_escape_string($value), $_COOKIE);
$_COOKIE = array_map('htmlspecialchars', $_COOKIE);
