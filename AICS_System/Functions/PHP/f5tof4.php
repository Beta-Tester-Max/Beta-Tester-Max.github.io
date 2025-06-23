<?php
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_SESSION['hasFormIV']) || !empty($_SESSION['hasFormIV'])) {
    unset($_SESSION['hasFormIV']);
    header('Location: ../../Form_IV/');
    exit;
} else {
    header('Location: logout.php');
    exit;
}
?>