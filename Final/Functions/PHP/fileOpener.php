<?php
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['fileOpen'])) {
    $_SESSION['file'] = $_POST['file'];

    header('Location: ../../Admin/pdfdisplayer.php');
    exit;
} else {
    header('Location: logout.php');
    exit;
}
?>