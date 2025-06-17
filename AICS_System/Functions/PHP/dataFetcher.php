<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

$sql = $pdo->query("SELECT * FROM tbl_sx");
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['allSx'] = $result;

$sql = $pdo->query("SELECT * FROM tbl_cvs");
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['allCS'] = $result;

$sql = $pdo->query("SELECT * FROM tbl_ea");
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['allEA'] = $result;

$sql = $pdo->query("SELECT * FROM tbl_b");
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['allB'] = $result;
?>