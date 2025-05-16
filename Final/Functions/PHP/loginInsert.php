<?php
require_once "connect.php";
session_start();

if (isset($_POST['login'])) {
    $a = $_POST['account'] ?? "";
    $p = $_POST['pass'] ?? "";

    if (empty($a)) {
        $_SESSION['Alert'] = "Email or Username Missing!";
        $_SESSION['Path'] = "../../login.php";

        header('Location: ../../index.php');
        exit;
    } elseif (strlen($a) > 50) {
        $_SESSION['Alert'] = "Account must not exceed 50 charaters.";
        $_SESSION['Path'] = "../../login.php";

        header('Location: ../../index.php');
        exit;
    } elseif (strlen(trim($a)) < 3) {
        $_SESSION['Alert'] = "Account must not be shorter than 3 characters! Space not included.";
        $_SESSION['Path'] = "../../login.php";

        header('Location: ../../index.php');
        exit;
    } elseif (empty($p)) {
        $_SESSION['Alert'] = "Password Missing!";
        $_SESSION['Path'] = "../../login.php";

        header('Location: ../../index.php');
        exit;
    } elseif (strlen($p) > 8 || strlen($p) > 15) {
        $_SESSION['Alert'] = "Account must not be less than 8 charaters and must not exceed 15 charaters.";
        $_SESSION['Path'] = "../../login.php";

        header('Location: ../../index.php');
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
                    // if ($data['Access_Level'] === 'Admin') {
                    //     $_SESSION['Authority'] = $data['Access_Level'];

                    //     header('Location: ../../Admin/adminDashboard.php');
                    //     exit;
                    // } else {
                    $_SESSION['Account_ID'] = $data['Account_ID'];

                    header('Location: ../../index.php');
                    exit;
                    // }
                } else {
                    $_SESSION['Alert'] = "Incorrect Password!";
                    $_SESSION['Path'] = "../../login.php";

                    header('Location: ../../index.php');
                    exit;
                }
            } else {
                $_SESSION['Alert'] = "Incorrect Email or Username!";
                $_SESSION['Path'] = "../../login.php";

                header('Location: ../../index.php');
                exit;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();

            $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
            $_SESSION['Path'] = "../../login.php";

            header('Location: ../../index.php');
            exit;
        }
    }
} else {
    header('Location: ../../index.php');
    exit;
}

?>