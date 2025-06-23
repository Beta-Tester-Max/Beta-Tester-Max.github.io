<?php
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_SESSION['hasFormIII']) || !empty($_SESSION['hasFormIII'])) {
    unset($_SESSION['hasFormIII']);
    header('Location: ../../Form_III/');
    exit;
} else {
    header('Location: logout.php');
    exit;
}
?>