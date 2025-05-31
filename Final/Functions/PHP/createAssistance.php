<?php
require_once "connect.php";
session_start();

if (isset($_POST['createAssistance'])) {
    $a = $_POST['assistance'] ?? "";

    if (empty($a)) {
        $_SESSION['Alert'] = "Missing Assistance Name!";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen(trim($a)) < 3) {
        $_SESSION['Alert'] = "Assistance Name cannot be less than 3 characters";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen($a) > 50) {
        $_SESSION['Alert'] = "Assistance Name cannot exceed 50 characters";
        header('Location: ../../Admin/setting.php');
        exit;
    } else {

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
                    header('Location: ../../Admin/setting.php');
                    exit;
                } else {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "Error Inserting Data.";
                    header('Location: ../../Admin/setting.php');
                    exit;
                }
            } else {
                $pdo->rollBack();

                $_SESSION['Alert'] = "Assistance Already Exists!";
                header('Location: ../../Admin/setting.php');
                exit;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();

            $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
            header('Location: ../../Admin/setting.php');
            exit;
        }
    }
} else {
    header('Location: logout.php');
    exit;
}
?>