<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['deleteAvailability'])) {
    $a = intval(cleanInt($_SESSION['Admin_ID'])) ?? "";
    $id = intval(cleanInt($_POST['id'])) ?? "";

    if (empty(($a))) {
        $_SESSION['Alert'] = "Missing Admin ID!";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen(strval($a)) > 11) {
        $_SESSION['Alert'] = "Admin ID must not exceed 11 digits.";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (empty(($id))) {
        $_SESSION['Alert'] = "Missing Availability ID!";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen(strval($id)) > 11) {
        $_SESSION['Alert'] = "Availability ID must not exceed 11 digits.";
        header('Location: ../../Admin/setting.php');
        exit;
    } else {

        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("SELECT * FROM tbl_admin_token WHERE Token_ID = :t");
            $sql->bindParam(":t", $a, PDO::PARAM_INT);
            $sql->execute();

            if ($sql->rowCount() > 0) {

                $sql = $pdo->prepare("SELECT * FROM tbl_availability WHERE Availability_ID = :a");
                $sql->bindParam(":a", $id, PDO::PARAM_INT);
                $sql->execute();

                if ($sql->rowCount() > 0) {

                    $sql = $pdo->prepare("UPDATE tbl_availability
                    SET is_deleted = 1
                    WHERE Availability_ID = :a");
                    $sql->bindParam(":a", $id, PDO::PARAM_INT);

                    if ($sql->execute()) {
                        $ac = "deleted an availability. ID: $id.";

                        $sql = $pdo->prepare("INSERT INTO tbl_admin_logs (Token_ID, Action)
                            VALUES (:t, :ac)");
                        $sql->bindParam(":t", $a, PDO::PARAM_INT);
                        $sql->bindParam(":ac", $ac, PDO::PARAM_STR);

                        if ($sql->execute()) {
                            $pdo->commit();
                            
                            $_SESSION['Alert'] = "Availability Deleted Successfully!";
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
                        $_SESSION['Alert'] = "Error Updating Database.";
                        header('Location: ../../Admin/setting.php');
                        exit;
                    }
                } else {
                    $pdo->rollBack();
                    $_SESSION['Alert'] = "Availability does not exists!";
                    header('Location: ../../Admin/setting.php');
                    exit;
                }
            } else {
                $pdo->rollBack();
                $_SESSION['Alert'] = "Admin does not exists!";
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
}
?>