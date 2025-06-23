<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['formV'])) {
    $id = cleanInt(intval($_SESSION['csID'] ?? ""));
    $text = strval($_POST['f5text'] ?? "");

    if (empty($id)) {
        $_SESSION['alert'] = "Missing ID!";
        header('Location: ../../Form_V/');
        exit;
    } elseif (strlen(strval($id)) > 11) {
        $_SESSION['alert'] = "Invaid ID Length.";
        header('Location: ../../Form_V/');
        exit;
    } elseif (empty($text)) {
        $_SESSION['alert'] = "Missing Source of Provision!";
        header('Location: ../../Form_V/');
        exit;
    } elseif (strlen(cleanStr($text)) < 10 || strlen($text) > 10000) {
        $_SESSION['alert'] = "Source of Provision must have 10-10,000 characters.";
        header('Location: ../../Form_V/');
        exit;
    } else {

        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("UPDATE tbl_cs
            SET Status = 'Complete',
            form_V = 1,
            form_V_text = :1
            WHERE id = :2");
            $sql->bindParam(":1", $text, PDO::PARAM_STR);
            $sql->bindParam(":2", $id, PDO::PARAM_INT);

            if ($sql->execute()) {
                $pdo->commit();
                unset($_SESSION['hasFormIV'], $_SESSION['hasFormIII'], $_SESSION['hasFormII'], $_SESSION['hasFormI'], $_SESSION['csID']);
                $_SESSION['alert'] = "Case Study Completed!";
                header('Location: ../../Case_Study/');
                exit;
            } else {
                $pdo->rollBack();
                $_SESSION['alert'] = "Error in Inserting Data";
                header('Location: ../../Form_V/');
                exit;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            $_SESSION['alert'] = "Connection Error: " . $e->getMessage();
            header('Location: ../../Form_V/');
            exit;
        }
    }
} else {
    header('Location: include/logout.php');
    exit;
}
?>