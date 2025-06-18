<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['setAdminName'])) {
    $t = intval($_SESSION['Token_ID']) ?? "";
    $n = $_POST['name'] ?? "";

    if (empty($t)) {
        $_SESSION['fsAN'] = "Missing Token ID!";
        header('Location: ../../Admin/setName.php');
        exit;
    } elseif (strlen(strval($t)) > 11) {
        $_SESSION['fsAN'] = "Token ID cannot exceed 10 digits";
        header('Location: ../../Admin/setName.php');
        exit;
    } elseif (empty($n)) {
        $_SESSION['fsAN'] = "Missing Name!";
        header('Location: ../../Admin/setName.php');
        exit;
    } elseif (strlen($n) > 50) {
        $_SESSION['fsAN'] = "Name cannot exceed 50 Characters";
        header('Location: ../../Admin/setName.php');
        exit;
    } else {

        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("SELECT * FROM tbl_admin_info WHERE Admin_Name = :n");
            $sql->bindParam(":n", $n, PDO::PARAM_STR);
            $sql->execute();

            if ($sql->rowCount() === 0) {

            $sql = $pdo->prepare("INSERT INTO tbl_admin_info (Token_ID, Admin_Name)
            VALUES (:t, :n)");
            $sql->bindParam(":t", $t, PDO::PARAM_INT);
            $sql->bindParam(":n", $n, PDO::PARAM_STR);

            if ($sql->execute()) {
                $pdo->commit();
                $_SESSION['Admin_ID'] = $t;
                $_SESSION['access'] = 1;
                unset($_SESSION['Token_ID']);
                header('Location: ../../Admin/dashboard.php');
                exit;
            } else {
                $pdo->rollBack();
                $_SESSION['fsAN'] = "Error Inserting Data.";
                header('Location: ../../Admin/setName.php');
                exit;
            }
        } else {
                $pdo->rollBack();
                $_SESSION['fsAN'] = "Name Already Exists.";
                header('Location: ../../Admin/setName.php');
                exit;
        }
        } catch (PDOException $e) {
            $pdo->rollBack();
            $_SESSION['fsAN'] = "Connection Error: " . $e->getMessage();
            header('Location: ../../Admin/setName.php');
            exit;
        }
    }
} else {
    header('Location: logout.php');
    exit;
}
?>