<?php
require_once "connect.php";
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
    } else {
        $sql = $pdo->prepare("SELECT Token FROM tbl_admin_token WHERE `Key` = :k");
        $sql->bindParam(":k", $k, PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $data = sanitize($result);
            $token = $data['Token'] ?? "";

            if (password_verify($t, $token)) {
                $_SESSION['access'] = 1;
                header('Location: ../../Admin/dashboard.php');
                exit;
            } else {
                $_SESSION['faL'] = "Incorrect Token!";
                header('Location: ../../Admin/');
                exit;
            }
        } else {
            $_SESSION['faL'] = "Incorrect Key!";
            header('Location: ../../Admin/');
            exit;
        }
    }
} else {
    header('Location: logout.php');
    exit;
}
?>