<?php
session_start();
$path = $_SESSION['Path'];
unset($_SESSION['Alert'], $_SESSION['Path']);
header('Location: '.$path);
exit;
?>