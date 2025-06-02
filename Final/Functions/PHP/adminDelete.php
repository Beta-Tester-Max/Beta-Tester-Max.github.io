<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['deleteAvailability'])) {
    $id = intval(trim($_POST['id'])) ?? "";

    if () {

    }
}
?>