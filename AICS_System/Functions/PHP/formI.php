<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['formI'])){
    $fn = $_POST['firstName'] ?? "";

    if (empty($fn)) {
        $_SESSION['alert'] = "Missing First Name!";
        header('Location: ../../Case_Study/Form_I/');
        exit;
    } else {
        header('Location: ../../Case_Study/Form_I/');
        exit;
    }
}
?>