<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();
if (isset($_POST['createCaseStudy'])) {
    $aD = array();
    $a = $_POST['id'];

    $sql = $pdo->prepare("SELECT Account_ID, Beneficiary FROM tbl_applications WHERE Application_ID = :a");
    $sql->bindParam(":a", $a, PDO::PARAM_INT);
    $sql->execute();
    $result = $sql->fetch();
    $data = sanitize($result);
    $b = $data['Beneficiary'] ?? "";
    $acc = $data['Account_ID'] ?? "";

    $sql = $pdo->prepare("SELECT * FROM tbl_family_member WHERE User_ID = :u");
    $sql->bindParam(":u", $b, PDO::PARAM_INT);
    $sql->execute();
    $result = $sql->fetch();
    $data = sanitize($result);
    $aD['helpee'] = $data ?? "";

    $sql = $pdo->prepare("SELECT User_ID FROM tbl_family_composition WHERE Account_ID = :a AND NOT User_ID = :u");
    $sql->bindParam(":a", $acc, PDO::PARAM_INT);
    $sql->bindParam(":u", $b, PDO::PARAM_INT);
    $sql->execute();
    $result = $sql->fetchAll();
    $data = sanitize($result);

    foreach ($data as $d) {
        $u = $d['User_ID'] ?? "";

        $sql = $pdo->prepare("SELECT * FROM tbl_family_member WHERE User_ID = :u");
        $sql->bindParam(":u", $u, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch();
        $data = sanitize($result);
        $aD['familyMembers'] = $data ?? "";
    }

    var_dump($aD);
}
?>