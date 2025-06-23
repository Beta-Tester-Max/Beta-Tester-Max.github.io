<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['formIII'])) {
    $id = cleanInt(intval($_SESSION['csID'] ?? ""));
    $as = cleanStr(strval($_POST['assistance'] ?? ""));

    if (empty($id)) {
        $_SESSION['alert'] = "Missing ID!";
        header('Location: ../../Form_III/');
        exit;
    } elseif (strlen(strval($id)) > 11) {
        $_SESSION['alert'] = "Invaid ID Length.";
        header('Location: ../../Form_III/');
        exit;
    } elseif (empty($as)) {
        $_SESSION['alert'] = "Missing Assistance Type!";
        header('Location: ../../Form_III/');
        exit;
    } elseif (strlen($as) > 5) {
        $_SESSION['alert'] = "Assistance Type must not exceed 5 chatacters.";
        header('Location: ../../Form_III/');
        exit;
    } else {

        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("UPDATE tbl_cs
            SET form_III = 1,
            asType = :1
            WHERE id = :2");
            $sql->bindParam(":1", $as, PDO::PARAM_STR);
            $sql->bindParam(":2", $id, PDO::PARAM_INT);

            if ($sql->execute()) {
                $pdo->commit();
                header('Location: ../../Form_IV/');
                exit;
            } else {
                $pdo->rollBack();
                $_SESSION['alert'] = "Error in Inserting Data";
                header('Location: ../../Form_III/');
                exit;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            $_SESSION['alert'] = "Connection Error: " . $e->getMessage();
            header('Location: ../../Form_III/');
            exit;
        }
    }
} else {
    header('Location: include/logout.php');
    exit;
}
?>