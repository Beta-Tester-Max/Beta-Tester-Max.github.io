<?php
require_once "connect.php";
session_start();

if (isset($_POST['addAssistance'])) {
    $a = $_POST['assistance'];

    try {
        $pdo->beginTransaction();

        $sql = $pdo->prepare("SELECT * FROM tbl_assistance WHERE Assistance_Name = :a");
        $sql->bindParam(":a", $a, PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() === 0) {
            $sql = $pdo->prepare("INSERT INTO tbl_assistance (Assistance_Name)
            VALUES (:a)");
            $sql->bindParam(":a", $a, PDO::PARAM_STR);

            if ($sql->execute()) {
                $pdo->commit();

                $_SESSION['Alert'] = "Assistance Added Successfully.";
                $_SESSION['Path'] = "../../Admin/addAssistanceForm.php";

                header('Location: ../../Admin/adminDashboard.php');
                exit;
            } else {
                $pdo->rollBack();

                $_SESSION['Alert'] = "Error Inserting Data.";
                $_SESSION['Path'] = "../../Admin/addAssistanceForm.php";

                header('Location: ../../Admin/adminDashboard.php');
                exit;
            }
        } else {
            $pdo->rollBack();

            $_SESSION['Alert'] = "Assistance Already Exists!";
            $_SESSION['Path'] = "../../Admin/addAssistanceForm.php";

            header('Location: ../../Admin/adminDashboard.php');
            exit;
        }
    } catch (PDOException $e) {
        $pdo->rollBack();

        $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
        $_SESSION['Path'] = "../../Admin/addAssistanceForm.php";

        header('Location: ../../Admin/adminDashboard.php');
        exit;
    }
} else {
    header('Location: ../../index.php');
    exit;
}
?>