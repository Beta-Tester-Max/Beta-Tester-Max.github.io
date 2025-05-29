<?php
ini_set('session.cookie_httponly', 1);
session_start();
$path = $_SESSION['Path'];
unset($_SESSION['Alert'], $_SESSION['Path']);
header('Location: '.$path);
exit;
?>