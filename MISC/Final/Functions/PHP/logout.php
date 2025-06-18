<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();


if (isset($_SESSION['Account_ID']) && !empty($_SESSION['Account_ID'])) {
    try {
        $pdo->beginTransaction();

        $a = $_SESSION['Account_ID'] ?? "";
        $ac = "has logged out.";

        $sql = $pdo->prepare("INSERT INTO tbl_user_logs (Account_ID, Action) 
        VALUES (:a, :ac)");
        $sql->bindParam(":a", $a, PDO::PARAM_INT);
        $sql->bindParam(":ac", $ac, PDO::PARAM_STR);

        if ($sql->execute()) {
            $pdo->commit();
            session_unset();
            session_destroy();
            header('Location: ../../');
            exit;
        } else {
            $_SESSION['Alert'] = "Error Logging Activity";
            header('Location: ../../');
            exit;
        }
    } catch (PDOException $e) {
                $_SESSION['Alert'] = "Connection Error: ".$e->getMessage();
                header('Location: ../../');
                exit;
    }
} elseif (isset($_SESSION['access']) && !empty($_SESSION['access'])) {
    if (isset($_SESSION['Admin_ID']) && !empty($_SESSION['Admin_ID'])) {
        try {
            $pdo->beginTransaction();

            $a = $_SESSION['Admin_ID'] ?? "";
            $ac = "has logged out.";

            $sql = $pdo->prepare("INSERT INTO tbl_admin_logs (Token_ID, Action) 
            VALUES (:t, :ac)");
            $sql->bindParam(":t", $a, PDO::PARAM_INT);
            $sql->bindParam(":ac", $ac, PDO::PARAM_STR);

            if ($sql->execute()) {
                $pdo->commit();
                session_unset();
                session_destroy();
                header('Location: ../../');
                exit;
            } else {
                $_SESSION['Alert'] = "Error Logging Activity";
                header('Location: ../../Admin');
                exit;
            }
        } catch (PDOException $e) {
                $_SESSION['Alert'] = "Connection Error: ".$e->getMessage();
                header('Location: ../../Admin');
                exit;
        }
    } else {
        session_unset();
        session_destroy();
        header('Location: ../../');
    }
} else {
    session_unset();
    session_destroy();
    header('Location: ../../');
}
?>