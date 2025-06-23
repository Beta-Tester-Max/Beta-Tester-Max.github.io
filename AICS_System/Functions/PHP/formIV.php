<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['formIV'])) {
    $id = cleanInt(intval($_SESSION['csID'] ?? ""));
    $text = strval($_POST['f4text'] ?? "");

    if (empty($id)) {
        $_SESSION['alert'] = "Missing ID!";
        header('Location: ../../Form_IV/');
        exit;
    } elseif (strlen(strval($id)) > 11) {
        $_SESSION['alert'] = "Invaid ID Length.";
        header('Location: ../../Form_IV/');
        exit;
    } elseif (empty($text)) {
        $_SESSION['alert'] = "Missing HISTORICAL BACKGROUND!";
        header('Location: ../../Form_IV/');
        exit;
    } elseif (strlen(cleanStr($text)) < 10 || strlen($text) > 10000) {
        $_SESSION['alert'] = "HISTORICAL BACKGROUND must have 10-10,000 characters.";
        header('Location: ../../Form_IV/');
        exit;
    } else {

        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("UPDATE tbl_cs
            SET form_IV = 1,
            form_VI_text = :1
            WHERE id = :2");
            $sql->bindParam(":1", $text, PDO::PARAM_STR);
            $sql->bindParam(":2", $id, PDO::PARAM_INT);

            if ($sql->execute()) {
                $pdo->commit();
                header('Location: ../../Form_V/');
                exit;
            } else {
                $pdo->rollBack();
                $_SESSION['alert'] = "Error in Inserting Data";
                header('Location: ../../Form_IV/');
                exit;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            $_SESSION['alert'] = "Connection Error: " . $e->getMessage();
            header('Location: ../../Form_IV/');
            exit;
        }
    }
} else {
    header('Location: include/logout.php');
    exit;
}
?>