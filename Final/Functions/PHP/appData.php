<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();
if (isset($_POST['createCaseStudy'])) {
    $aD = array();
    header('Location: ../../Admin/caseStudyMaker.php');
    exit;

    // try {
    //     $pdo->beginTransaction();

    //     $sql = $pdo->prepare("SELECT Assistance_Name FROM tbl_assistance WHERE Assistance_ID = :a");
    //     $sql->bindParam(":a", $sD['a'], PDO::PARAM_INT);
    //     $sql->execute();
    //     $result = $sql->fetch(PDO::FETCH_ASSOC);
    //     $data = sanitize($result);
    //     $sD['an'] = $data['Assistance_Name'];

    //     $sql = $pdo->prepare("SELECT * FROM tbl_applications WHERE Account_ID = :a AND Assistance_ID = :as AND is_deleted = 0 AND Status = 'Pending'");
    //     $sql->bindParam(":a", $a, PDO::PARAM_INT);
    //     $sql->bindParam(":as", $aid, PDO::PARAM_INT);
    //     $sql->execute();

    //     if ($sql->rowCount() === 0) {

    //         $_SESSION['sD'] = $sD;

    //         header('Location: ../../appDoc.php');
    //         exit;
    //     } else {
    //         $pdo->rollBack();

    //         $_SESSION['Alert'] = "You already have a pending application on this type of assistance.";
    //         header('Location: ../../createApp.php');
    //         exit;
    //     }
    // } catch (PDOException $e) {
    //     $pdo->rollBack();

    //     $_SESSION['Alert'] = "You already have a pending application of this type of assistance.";
    //     header('Location: ../../createApp.php');
    //     exit;
    // }
}
?>