<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['continue'])) {
    $id = cleanInt(intval($_POST['id'] ?? ""));

    if (empty($id)) {
        $_SESSION['alert'] = "Missing ID!";
        header('Location: ../../Case_Study/');
        exit;
    } elseif (strlen(strval($id)) > 11) {
        $_SESSION['alert'] = "Invaid ID Length.";
        header('Location: ../../Case_Study/');
        exit;
    } else {
        $_SESSION['csID'] = $id;
        header('Location: ../../Form/');
        exit;
    }
} else {
    header('Location: include/logout.php');
    exit;
}
?>