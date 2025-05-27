<?php
require_once "connect.php";
session_start();
if (isset($_POST['appCred'])) {
    $sD = array();
    $a = $_SESSION['Account_ID'] ?? "";
    $aid = $_POST['assistance'];
    $sD['a'] = $_POST['assistance'];
    $sD['h'] = $_POST['helpee'];
    $sD['rp'] = $_POST['rep'];
    $sD['r'] = $_POST['reason'];

    try {
        $pdo->beginTransaction();

        $sql = $pdo->prepare("SELECT Assistance_Name FROM tbl_assistance WHERE Assistance_ID = :a");
        $sql->bindParam(":a", $sD['a'], PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $data = sanitize($result);
        $sD['an'] = $data['Assistance_Name'];

        $sql = $pdo->prepare("SELECT * FROM tbl_applications WHERE Account_ID = :a AND Assistance_ID = :as AND is_deleted = 0");
        $sql->bindParam(":a", $a, PDO::PARAM_INT);
        $sql->bindParam(":as", $aid, PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() === 0) {

            $_SESSION['sD'] = $sD;

            header('Location: ../../appDoc.php');
            exit;
        } else {
            $pdo->rollBack();

            $_SESSION['Alert'] = "You already have a pending application on this type of assistance.";
            $_SESSION['Path'] = "../../createApp.php";

            header('Location: ../../index.php');
            exit;
        }
    } catch (PDOException $e) {
        $pdo->rollBack();

        $_SESSION['Alert'] = "You already have a pending application of this type of assistance.";
        $_SESSION['Path'] = "../../createApp.php";

        header('Location: ../../index.php');
        exit;
    }
}
?>