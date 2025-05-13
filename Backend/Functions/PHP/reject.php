<?php
require_once "connect.php";
session_start();

if (isset($_POST['rejection'])) {
    $a = $_POST['id'];
    $t = $_POST['table'];
    $r = $_POST['reason'];
    $doc = $_POST['document'];
    $d = date("Y/m/d");
    $path = $_POST['from'];

    try {
        $pdo->beginTransaction();

        if ($t === 'requirement') {
            $sql = $pdo->prepare("UPDATE tbl_account_requirements
            SET Status = 'Rejected',
            Reason = :r,
            Date_Reviewed = :d
            WHERE Account_ID = :a AND Document_ID = :doc");
            $sql->bindParam(":r", $r, PDO::PARAM_STR);
            $sql->bindParam(":d", $d, PDO::PARAM_STR);
            $sql->bindParam(":a", $a, PDO::PARAM_INT);
            $sql->bindParam(":doc", $doc, PDO::PARAM_INT);
        } elseif ($t === 'application') {

        }

        if ($sql->execute()) {
            $pdo->commit();

            if ($t === 'requirement') {
                $_SESSION['Alert'] = "Requirement Rejected Successfully!";
            } elseif ($t === 'application') {
                $_SESSION['Alert'] = "Application Rejected Successfully!";
            }
            unset($_SESSION['rejectCred']);
            $_SESSION['Path'] = "../../Admin/$path";

            header('Location: ../../Admin/adminDashboard.php');
            exit;
        } else {
            $pdo->rollBack();

            $_SESSION['Alert'] = "Error Updating Data.";
            $_SESSION['Path'] = "../../Admin/$path";

            header('Location: ../../Admin/adminDashboard.php');
            exit;
        }
    } catch (PDOException $e) {
        $pdo->rollBack();

        $_SESSION['Alert'] = "Conenction Error: " . $e->getMessage();
        $_SESSION['Path'] = "../../Admin/$path";

            header('Location: ../../Admin/adminDashboard.php');
        exit;
    }
} else {
    header('Location: logout.php');
    exit;
}
?>