<?php
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_SESSION['hasFormII']) || !empty($_SESSION['hasFormII'])) {
    unset($_SESSION['hasFormII']);
    header('Location: ../../Form_II/');
    exit;
} else {
    header('Location: logout.php');
    exit;
}
?>