<?php
require_once "connect.php";
session_start();

if (isset($_POST['delApp'])) {
    $a = intval($_SESSION['Account_ID']) ?? "";
    $aid = intval($_POST['appID']) ?? "";

    if (empty($a)) {
        $_SESSION['Alert'] = "Missing Account ID";
        $_SESSION['Path'] = "../../application.php";
        header('Location: ../../index.php');
        exit;
    } else {
        if (empty($aid)) {
            $_SESSION['Alert'] = "Missing Application ID";
            $_SESSION['Path'] = "../../application.php";
            header('Location: ../../index.php');
            exit;
        } elseif (strlen(trim(strval($aid))) > 11) {
            $_SESSION['Alert'] = "Application ID can only have upto 11 characters.";
            $_SESSION['Path'] = "../../application.php";
            header('Location: ../../index.php');
            exit;
        } else {
            $sql = $pdo->prepare("SELECT * FROM tbl_applications WHERE Account_ID = :a AND Application_ID = :aid");
            $sql->bindParam(":a", $a, PDO::PARAM_INT);
            $sql->bindParam(":aid", $aid, PDO::PARAM_INT);
            $sql->execute();

            if ($sql->rowCount() > 0) {

                try {
                    $pdo->beginTransaction();

                    $sql = $pdo->prepare("UPDATE tbl_applications 
                    SET is_deleted = 1 
                    WHERE Account_ID = :a AND Application_ID = :aid");
                    $sql->bindParam(":a", $a, PDO::PARAM_INT);
                    $sql->bindParam(":aid", $aid, PDO::PARAM_INT);

                    if ($sql->execute()) {
                        $pdo->commit();
                        $_SESSION['Alert'] = "Application Deleted Successfully.";
                        $_SESSION['Path'] = "../../application.php";
                        header('Location: ../../index.php');
                        exit;
                    } else {
                        $pdo->rollBack();
                        $_SESSION['Alert'] = "Error Deleting Application.";
                        $_SESSION['Path'] = "../../application.php";
                        header('Location: ../../index.php');
                        exit;
                    }
                } catch (PDOException $e) {
                    $pdo->rollBack();
                    $_SESSION['Alert'] = "Connection Error:" . $e->getMessage();
                    $_SESSION['Path'] = "../../application.php";
                    header('Location: ../../index.php');
                    exit;
                }
            } else {
                $_SESSION['Alert'] = "Application does not Exists!";
                $_SESSION['Path'] = "../../application.php";
                header('Location: ../../index.php');
                exit;
            }
        }
    }
} else {
    header('Location: ../../index.php');
    exit;
}
?>