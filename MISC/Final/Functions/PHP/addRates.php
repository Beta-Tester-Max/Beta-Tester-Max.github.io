<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['addRate'])) {
    $a = $_POST['assistance'] ?? "";
    $cr = $_POST['criteria'] ?? "";
    $c = intval($_POST['cost']) ?? "";
    $av = $_POST['availability'] ?? "";

    $sql = $pdo->prepare("INSERT INTO tbl_rates (Assistance_ID, Criteria, Cost, Availability)
    VALUES (:a, :cr, :c, :av)");
    $sql->bindParam(":a", $a, PDO::PARAM_INT);
    $sql->bindParam(":cr", $cr, PDO::PARAM_STR);
    $sql->bindParam(":c", $c, PDO::PARAM_INT);
    $sql->bindParam(":av", $av, PDO::PARAM_INT);
    $sql->execute();

    header('Location: ../../Admin/rates.php');
    exit;
} else {
    header('Location: logout.php');
    exit;
}
?>