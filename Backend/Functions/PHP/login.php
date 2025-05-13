<?php
require_once "connect.php";
session_start();

if (isset($_POST['login'])) {
    $a = $_POST['account'];
    $p = $_POST['password'];

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

                    header('Location: ../../Admin/adminDashboard.php');
                    exit;
                } else {
                    $_SESSION['Account_ID'] = $data['Account_ID'];

                    header('Location: ../../index.php');
                    exit;
                }
            } else {
                $_SESSION['Login'] = "Incorrect Password";

                header('Location: ../../loginForm.php');
                exit;
            }
        } else {
            $_SESSION['Login'] = "Incorrect Username";

            header('Location: ../../loginForm.php');
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();

        header('Location: ../../index.php');
        exit;
    }
} else {
    header('Location: ../../index.php');
    exit;
}

?>