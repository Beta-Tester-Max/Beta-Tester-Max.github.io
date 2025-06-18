<?php
require_once "connect.php";
session_start();

$inserted = false;

if (isset($_POST['register'])) {
    $u = $_POST['username'];
    $e = $_POST['email'];
    $p = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $pdo->beginTransaction();

        $sql = $pdo->prepare("SELECT Username FROM tbl_accounts WHERE Username = :u");
        $sql->bindParam(":u", $u, PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() === 0) {
            $sql = $pdo->prepare("SELECT Email FROM tbl_accounts WHERE Email = :e");
            $sql->bindParam(":e", $e, PDO::PARAM_STR);
            $sql->execute();

            if ($sql->rowCount() === 0) {
                $sql = $pdo->prepare("INSERT INTO tbl_accounts (Username, Email, Password)
                VALUES (:u, :e, :p)");
                $sql->bindParam(":u", $u, PDO::PARAM_STR);
                $sql->bindParam(":e", $e, PDO::PARAM_STR);
                $sql->bindParam(":p", $p, PDO::PARAM_STR);

                if ($sql->execute()) {
                    $pdo->commit();
                    $inserted = true;
                }
            } else {
                $pdo->rollBack();

                $_SESSION['Alert'] = "Email Already Exists!";
                $_SESSION['Path'] = "../../registrationForm.php";

                header('Location: ../../index.php');
                exit;
            }
        } else {
            $pdo->rollBack();

            $_SESSION['Alert'] = "Username Already Exists!";
            $_SESSION['Path'] = "../../registrationForm.php";

            header('Location: ../../index.php');
            exit;
        }
    } catch (PDOException $e) {
        $pdo->rollBack();

        $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
        $_SESSION['Path'] = "../../registrationForm.php";

        header('Location: ../../index.php');
        exit;
    }
} else {
    header('Location: ../../index.php');
    exit;
}

if ($inserted) {
    $sql = $pdo->prepare("SELECT Account_ID FROM tbl_accounts WHERE Username = :u AND Email = :e");
    $sql->bindParam(":u", $u, PDO::PARAM_STR);
    $sql->bindParam(":e", $e, PDO::PARAM_STR);

    if ($sql->execute()) {
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $data = sanitize($result);

        $_SESSION['Account_ID'] = $data['Account_ID'];
        $_SESSION['Alert'] = "Account Registered Successfully!";
        $_SESSION['Path'] = "../../index.php";

        header('Location: ../../index.php');
        exit;
    } else {
        $_SESSION['Alert'] = "Account Registered Successfully! Login Failed.";
        $_SESSION['Path'] = "../../loginForm.php";

        header('Location: ../../index.php');
        exit;
    }
}
?>