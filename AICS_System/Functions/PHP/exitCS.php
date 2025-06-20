<?php
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_SESSION['csID']) || !empty($_SESSION['csID'])) {
    unset($_SESSION['csID']);
    header('Location: ../../Case_Study/');
    exit;
} else {
    header('Location: logout.php');
    exit;
}
?>