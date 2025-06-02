<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['createAvailability'])) {
    $tid = intval(cleanInt($_SESSION['Admin_ID'])) ?? "";
    $a = trim($_POST['availability']) ?? "";

    if (empty(($tid))) {
        $_SESSION['Alert'] = "Missing Admin ID!";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen(strval($tid)) > 11) {
        $_SESSION['Alert'] = "Admin ID must not exceed 11 digits.";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (empty($a)) {
        $_SESSION['Alert'] = "Missing Availability Name!";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen(cleanStr($a)) < 3) {
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

            $sql = $pdo->prepare("SELECT * FROM tbl_admin_token WHERE Token_ID = :t");
            $sql->bindParam(":t", $tid, PDO::PARAM_INT);
            $sql->execute();

            if ($sql->rowCount() > 0) {

            $sql = $pdo->prepare("SELECT * FROM tbl_availability WHERE Availability_Name = :a");
            $sql->bindParam(":a", $a, PDO::PARAM_STR);
            $sql->execute();

            if ($sql->rowCount() === 0) {
                $sql = $pdo->prepare("INSERT INTO tbl_availability (Availability_Name)
                VALUES (:a)");
                $sql->bindParam(":a", $a, PDO::PARAM_STR);

                if ($sql->execute()) {
                    $id = $pdo->lastInsertId();
                    $ac = "created new Availability \"$a\". ID: $id.";

                    $sql = $pdo->prepare("INSERT INTO tbl_admin_logs (Token_ID, Action)
                            VALUES (:t, :ac)");
                    $sql->bindParam(":t", $tid, PDO::PARAM_INT);
                    $sql->bindParam(":ac", $ac, PDO::PARAM_STR);

                    if ($sql->execute()) {
                        $pdo->commit();

                        $_SESSION['Alert'] = "Availability Added Successfully.";
                        header('Location: ../../Admin/setting.php');
                        exit;
                    } else {
                        $pdo->rollBack();
                        $_SESSION['Alert'] = "Error Logging Activity.";
                        header('Location: ../../Admin/setting.php');
                        exit;
                    }
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
        } else {
                $pdo->rollBack();

                $_SESSION['Alert'] = "Admin does not Exists!";
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