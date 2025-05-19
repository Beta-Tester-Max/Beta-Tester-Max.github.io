<?php
require_once "connect.php";
session_start();
if (isset($_POST['appCred'])) {
    $sD = array();
    $sD['a'] = $_POST['assistance'];
    $sD['h'] = $_POST['helpee'];
    $sD['rp'] = $_POST['rep'];
    $sD['r'] = $_POST['reason'];

    $sql = $pdo->prepare("SELECT Assistance_Name FROM tbl_assistance WHERE Assistance_ID = :a");
    $sql->bindParam(":a", $sD['a'], PDO::PARAM_INT);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    $data = sanitize($result);
    $sD['an'] = $data['Assistance_Name'];

    $_SESSION['sD'] = $sD;

    header('Location: ../../appDoc.php');
    exit;
}
?>