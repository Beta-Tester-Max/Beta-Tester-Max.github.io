<?php
session_start();
$_SESSION['d'] = 'time';
$_SESSION['d'] = 'Set';
var_dump($_SESSION['d']);
unset($_SESSION['d']);
?>