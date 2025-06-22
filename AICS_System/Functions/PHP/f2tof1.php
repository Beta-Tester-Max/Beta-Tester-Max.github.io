<?php
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_SESSION['hasFormI']) || !empty($_SESSION['hasFormI'])) {
    unset($_SESSION['hasFormI']);
    header('Location: ../../Form_I/');
    exit;
} else {
    header('Location: logout.php');
    exit;
}
?>