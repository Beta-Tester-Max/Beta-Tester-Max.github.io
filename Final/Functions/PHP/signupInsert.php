<?php
require_once "connect.php";
session_start();

$inserted = false;

if (isset($_POST['signup'])) {
    if (isset($_POST['consent']) && $_POST['consent'] === '1') {
        $u = $_POST['username'] ?? "";
        $e = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) ?? "";
        $password = $_POST['pass'] ?? "";
        
        if (empty($u)) {
            $_SESSION['Alert'] = "Missing Username!";
            $_SESSION['Path'] = "../../signup.php";

            header('Location: ../../index.php');
            exit;
        } elseif (strlen($u) > 50) {
            $_SESSION['Alert'] = "Username must not exceed 50 characters.";
            $_SESSION['Path'] = "../../signup.php";

            header('Location: ../../index.php');
            exit;
        } elseif (empty($e)) {
            $_SESSION['Alert'] = "Missing Email!";
            $_SESSION['Path'] = "../../signup.php";

            header('Location: ../../index.php');
            exit;
        } elseif (strlen($e) > 50) {
            $_SESSION['Alert'] = "Email must not exceed 50 characters.";
            $_SESSION['Path'] = "../../signup.php";

            header('Location: ../../index.php');
            exit;
        } elseif (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['Alert'] = "Invalid Email!";
            $_SESSION['Path'] = "../../signup.php";

            header('Location: ../../index.php');
            exit;
        } elseif (empty($password)) {
            $_SESSION['Alert'] = "Missing Password!";
            $_SESSION['Path'] = "../../signup.php";

            header('Location: ../../index.php');
            exit;
        } elseif (strlen($password) < 8 || strlen($password) > 15) {
            $_SESSION['Alert'] = "Password must be between 8 and 15 characters.";
            $_SESSION['Path'] = "../../signup.php";

            header('Location: ../../index.php');
            exit;
        } elseif (!preg_match('/[a-z]/', $password)) {
            $_SESSION['Alert'] = "Password must contain at least one lowercase letter.";
            $_SESSION['Path'] = "../../signup.php";

            header('Location: ../../index.php');
            exit;
        } elseif (!preg_match('/[A-Z]/', $password)) {
            $_SESSION['Alert'] = "Password must contain at least one uppercase letter.";
            $_SESSION['Path'] = "../../signup.php";

            header('Location: ../../index.php');
            exit;
        } elseif (!preg_match('/[0-9]/', $password)) {
            $_SESSION['Alert'] = "Password must contain at least one number.";
            $_SESSION['Path'] = "../../signup.php";

            header('Location: ../../index.php');
            exit;
        } elseif (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            $_SESSION['Alert'] = "Password must contain at least one special character.";
            $_SESSION['Path'] = "../../signup.php";

            header('Location: ../../index.php');
            exit;
        } elseif (preg_match('/\s/', $password)) {
            $_SESSION['Alert'] = "Password cannot contain spaces.";
            $_SESSION['Path'] = "../../signup.php";

            header('Location: ../../index.php');
            exit;
        } else {
            $p = password_hash($password, PASSWORD_DEFAULT);

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
                        $_SESSION['Path'] = "../../signup.php";

                        header('Location: ../../index.php');
                        exit;
                    }
                } else {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "Username Already Exists!";
                    $_SESSION['Path'] = "../../signup.php";

                    header('Location: ../../index.php');
                    exit;
                }
            } catch (PDOException $e) {
                $pdo->rollBack();

                $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
                $_SESSION['Path'] = "../../signup.php";

                header('Location: ../../index.php');
                exit;
            }
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
            $_SESSION['Path'] = "../../login.php";

            header('Location: ../../index.php');
            exit;
        }
    } else {
        $_SESSION['Alert'] = "Consent is required";
        $_SESSION['Path'] = "../../signup.php";

        header('Location: ../../index.php');
        exit;
    }
} else {
    header('Location: ../../index.php');
    exit;
}
?>