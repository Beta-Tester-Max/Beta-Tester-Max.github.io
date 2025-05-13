<?php
session_start();

if (isset($_POST['fileOpen'])) {
    $_SESSION['file'] = $_POST['file'];

    header('Location: ../../pdfdisplayer.php');
    exit;
} else {
    header('Location: logout.php');
    exit;
}
?>