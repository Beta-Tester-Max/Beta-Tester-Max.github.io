<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['login'])) {
    $a = $_POST['account'] ?? "";
    $p = $_POST['pass'] ?? "";

    if (empty($a)) {
        $_SESSION['Alert'] = "Email or Username Missing!";
        header('Location: ../../login.php');
        exit;
    } elseif (strlen($a) > 50) {
        $_SESSION['Alert'] = "Account must not exceed 50 charaters.";
        header('Location: ../../login.php');
        exit;
    } elseif (strlen(trim($a)) < 3) {
        $_SESSION['Alert'] = "Account must not be shorter than 3 characters! Space not included.";
        header('Location: ../../login.php');
        exit;
    } elseif (empty($p)) {
        $_SESSION['Alert'] = "Password Missing!";
        header('Location: ../../login.php');
        exit;
    } elseif (strlen($p) < 8 || strlen($p) > 15) {
        $_SESSION['Alert'] = "Password must not be less than 8 charaters and must not exceed 15 charaters.";
        header('Location: ../../login.php');
        exit;
    } else {
        try {
            $sql = $pdo->prepare("SELECT Account_ID, Password, Access_Level FROM tbl_accounts WHERE Username = :a OR Email = :a");
            $sql->bindParam(":a", $a, PDO::PARAM_STR);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $result = $sql->fetch(PDO::FETCH_ASSOC);
                $data = sanitize($result);

                if (password_verify($p, $data['Password'])) {
                    if ($data['Access_Level'] === 'Admin') {
                        $_SESSION['Authority'] = $data['Access_Level'];

                        header('Location: ../../Admin/');
                        exit;
                    } else {
                        $_SESSION['Account_ID'] = $data['Account_ID'];

                        header('Location: ../../profile.php');
                        exit;
                    }
                } else {
                    $_SESSION['Alert'] = "Incorrect Password!";
                    header('Location: ../../login.php');
                    exit;
                }
            } else {
                $_SESSION['Alert'] = "Incorrect Email!";
                header('Location: ../../login.php');
                exit;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();

            $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
            header('Location: ../../login.php');
            exit;
        }
    }
} else {
    header('Location: ../../index.php');
    exit;
}

?>