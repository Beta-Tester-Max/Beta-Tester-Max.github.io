<?php
require_once "connect.php";
session_start();

if (isset($_POST['rejection'])) {
    $id = $_POST['id'];
    $t = $_POST['table'];
    $r = $_POST['reason'];
    $d = date("Y/m/d");
    $path = $_POST['from'];

    try {
        $pdo->beginTransaction();

        if ($t === 'requirement') {
            $table = 'tbl_account_requirements';
            $tid = "Account_Requirement_ID";
        } elseif ($t === 'application') {
            $table = 'tbl_applications';
            $tid = "Application_ID";
        }
        
            $sql = $pdo->prepare("UPDATE $table
            SET Status = 'Rejected',
            ReasonFR = :r,
            Date_Reviewed = :d
            WHERE $tid = :a");
            $sql->bindParam(":r", $r, PDO::PARAM_STR);
            $sql->bindParam(":d", $d, PDO::PARAM_STR);
            $sql->bindParam(":a", $id, PDO::PARAM_INT);

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