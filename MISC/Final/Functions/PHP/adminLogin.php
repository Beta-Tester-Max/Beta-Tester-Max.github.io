<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['adminLogin'])) {
    $k = trim($_POST['key']) ?? "";
    $t = trim($_POST['token']) ?? "";

    if (empty($k)) {
        $_SESSION['faL'] = "Missing Key!";
        header('Location: ../../Admin/');
        exit;
    } elseif (strlen($k) !== 10) {
        $_SESSION['faL'] = "Invalid Key Length";
        header('Location: ../../Admin/');
        exit;
    } elseif (empty($t)) {
        $_SESSION['faL'] = "Missing Token!";
        header('Location: ../../Admin/');
        exit;
    } elseif (strlen($t) !== 20) {
        $_SESSION['faL'] = "Invalid Token Length";
        header('Location: ../../Admin/');
        exit;
    } else {

        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("SELECT Token, Token_ID FROM tbl_admin_token WHERE `Key` = :k");
            $sql->bindParam(":k", $k, PDO::PARAM_STR);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $result = $sql->fetch(PDO::FETCH_ASSOC);
                $data = sanitize($result);
                $token = $data['Token'] ?? "";
                $tid = $data['Token_ID'] ?? "";

                if (password_verify($t, $token)) {
                    $sql = $pdo->prepare("SELECT * FROM tbl_admin_info WHERE Token_ID = :t");
                    $sql->bindParam(":t", $tid, PDO::PARAM_INT);
                    $sql->execute();
                    $ac = "has logged in.";

                    if ($sql->rowCount() > 0) {

                        $sql = $pdo->prepare("INSERT INTO tbl_admin_logs (Token_ID, Action)
                            VALUES (:t, :ac)");
                        $sql->bindParam(":t", $tid, PDO::PARAM_INT);
                        $sql->bindParam(":ac", $ac, PDO::PARAM_STR);

                        if ($sql->execute()) {
                            $pdo->commit();
                            unset($_SESSION['Authority']);
                            $_SESSION['Admin_ID'] = $tid;
                            $_SESSION['access'] = 1;
                            header('Location: ../../Admin/dashboard.php');
                            exit;
                        } else {
                            $pdo->rollBack();
                            $_SESSION['faL'] = "Error Logging Activity.";
                            header('Location: ../../Admin/');
                            exit;
                        }
                    } else {

                        $sql = $pdo->prepare("INSERT INTO tbl_admin_logs (Token_ID, Action)
                            VALUES (:t, :ac)");
                        $sql->bindParam(":t", $tid, PDO::PARAM_INT);
                        $sql->bindParam(":ac", $ac, PDO::PARAM_STR);

                        if ($sql->execute()) {
                            $pdo->commit();
                            unset($_SESSION['Authority']);
                            $_SESSION['Token_ID'] = $tid;
                            header('Location: ../../Admin/setName.php');
                            exit;
                        } else {
                            $pdo->rollBack();
                            $_SESSION['faL'] = "Error Logging Activity.";
                            header('Location: ../../Admin/');
                            exit;
                        }
                    }
                } else {
                    $pdo->rollBack();
                    $_SESSION['faL'] = "Incorrect Token!";
                    header('Location: ../../Admin/');
                    exit;
                }
            } else {
                $pdo->rollBack();
                $_SESSION['faL'] = "Incorrect Key!";
                header('Location: ../../Admin/');
                exit;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            $_SESSION['faL'] = "Connection Error: " . $e->getMessage();
            header('Location: ../../Admin/');
            exit;
        }
    }
} else {
    header('Location: logout.php');
    exit;
}
?>