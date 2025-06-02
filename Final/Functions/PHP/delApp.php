<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['delApp'])) {
    $a = intval($_SESSION['Account_ID']) ?? "";
    $aid = intval($_POST['appID']) ?? "";

    if (empty($a)) {
        $_SESSION['Alert'] = "Missing Account ID";
        header('Location: ../../application.php');
        exit;
    } else {
        if (empty($aid)) {
            $_SESSION['Alert'] = "Missing Application ID";
            header('Location: ../../application.php');
            exit;
        } elseif (strlen(strval($aid)) > 11) {
            $_SESSION['Alert'] = "Application ID can only have upto 11 characters.";
            header('Location: ../../application.php');
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
                        $ac = "has deleted an Application. ID: $aid.";

                        $sql = $pdo->prepare("INSERT INTO tbl_user_logs (Account_ID, Action)
                            VALUES (:a, :ac)");
                        $sql->bindParam(":a", $a, PDO::PARAM_INT);
                        $sql->bindParam(":ac", $ac, PDO::PARAM_STR);

                        if ($sql->execute()) {
                            $pdo->commit();
                            $_SESSION['Alert'] = "Application Deleted Successfully.";
                            header('Location: ../../application.php');
                            exit;
                        } else {
                            $pdo->rollBack();
                            $_SESSION['Alert'] = "Error Logging Activity.";
                            header('Location: ../../application.php');
                            exit;
                        }
                    } else {
                        $pdo->rollBack();
                        $_SESSION['Alert'] = "Error Deleting Application.";
                        header('Location: ../../application.php');
                        exit;
                    }
                } catch (PDOException $e) {
                    $pdo->rollBack();
                    $_SESSION['Alert'] = "Connection Error:" . $e->getMessage();
                    header('Location: ../../application.php');
                    exit;
                }
            } else {
                $_SESSION['Alert'] = "Application does not Exists!";
                header('Location: ../../application.php');
                exit;
            }
        }
    }
} else {
    header('Location: ../../index.php');
    exit;
}
?>