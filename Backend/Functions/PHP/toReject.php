<?php
require_once "connect.php";
session_start();

$data = array();

 if (isset($_POST['reject'])) {
    $data['f'] = $_POST['from'];
    $data['t'] = $_POST['table'];
    $data['d'] = $_POST['document'];
    $data['id'] = $_POST['id'];

    $_SESSION['rejectCred'] = $data;
    header('Location: ../../Admin/rejectForm.php');
    exit; 
 }

?>