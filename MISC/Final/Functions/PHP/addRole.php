<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['addRole'])) {
    $id = intval($_POST['id']) ?? "";
    $ac = intval($_POST['access']) ?? "";

    if (empty($id)) {
        $_SESSION['Alert'] = "Missing Admin ID!";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen(strval($id)) > 11) {
        $_SESSION['Alert'] = "Admin ID cannot exceed 11 digits";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (empty($ac)) {
        $_SESSION['Alert'] = "Missing Access ID!";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen(strval($ac)) > 11) {
        $_SESSION['Alert'] = "Access ID cannot exceed 11 digits";
        header('Location: ../../Admin/setting.php');
        exit;
    } else {

        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("UPDATE tbl_admin_info
            SET Access_ID = :a
            WHERE Admin_ID = :ad");
            $sql->bindParam(":a", $ac, PDO::PARAM_STR);
            $sql->bindParam(":ad", $id, PDO::PARAM_INT);

            if ($sql->execute()) {
                $pdo->commit();
                $_SESSION['Alert'] = "Role Set Successfully!";
                header('Location: ../../Admin/setting.php');
                exit;
            } else {
                $pdo->rollBack();
                $_SESSION['Alert'] = "Error Updating Database.";
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