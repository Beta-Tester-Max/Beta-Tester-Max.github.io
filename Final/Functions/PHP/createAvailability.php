<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['createAvailability'])) {
    $a = $_POST['availability'] ?? "";

    if (empty($a)) {
        $_SESSION['Alert'] = "Missing Availability Name!";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen(trim($a)) < 3) {
        $_SESSION['Alert'] = "Availability Name cannot be less than 3 characters";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen($a) > 50) {
        $_SESSION['Alert'] = "Availability Name cannot exceed 50 characters";
        header('Location: ../../Admin/setting.php');
        exit;
    } else {

        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("SELECT * FROM tbl_availability WHERE Availability_Name = :a");
            $sql->bindParam(":a", $a, PDO::PARAM_STR);
            $sql->execute();

            if ($sql->rowCount() === 0) {
                $sql = $pdo->prepare("INSERT INTO tbl_availability (Availability_Name)
                VALUES (:a)");
                $sql->bindParam(":a", $a, PDO::PARAM_STR);

                if ($sql->execute()) {
                    $pdo->commit();

                    $_SESSION['Alert'] = "Availability Added Successfully.";
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

                $_SESSION['Alert'] = "Availability Already Exists!";
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