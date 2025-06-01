<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['createRate'])) {
    $cr = $_POST['criteria'] ?? "";
    $co = intval(trim($_POST['cost'])) ?? "";
    $as = intval(trim($_POST['assistance'])) ?? "";
    $av = intval(trim($_POST['availability'])) ?? "";

    if (empty($cr)) {
        $_SESSION['Alert'] = "Missing Criteria!";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen(trim($cr)) < 10) {
        $_SESSION['Alert'] = "Criteria cannot be less than 10 characters";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen($cr) > 1000) {
        $_SESSION['Alert'] = "Criteria cannot exceed 1000 characters";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (empty($co)) {
        $_SESSION['Alert'] = "Missing Cost!";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen(strval($co)) > 11) {
        $_SESSION['Alert'] = "Cost must not exceed 11 digits.";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (empty($as)) {
        $_SESSION['Alert'] = "Missing Assistance ID!";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen(strval($as)) > 11) {
        $_SESSION['Alert'] = "Assistance ID must not exceed 11 digits.";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (empty($av)) {
        $_SESSION['Alert'] = "Missing Availability ID!";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen(strval($av)) > 11) {
        $_SESSION['Alert'] = "Availability ID must not exceed 11 digits.";
        header('Location: ../../Admin/setting.php');
        exit;
    } else {

        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("SELECT * FROM tbl_assistance WHERE Assistance_ID = :a");
            $sql->bindParam(":a", $as, PDO::PARAM_INT);
            $sql->execute();

            if ($sql->rowCount() > 0) {

                $sql = $pdo->prepare("SELECT * FROM tbl_availability WHERE Availability_ID = :a");
                $sql->bindParam(":a", $av, PDO::PARAM_INT);
                $sql->execute();

                if ($sql->rowCount() > 0) {
                    $sql = $pdo->prepare("INSERT INTO tbl_rates (Assistance_ID, `Availability`, Criteria, Cost)
                        VALUES (:as, :av, :cr, :co)");
                    $sql->bindParam(":as", $as, PDO::PARAM_INT);
                    $sql->bindParam(":av", $av, PDO::PARAM_INT);
                    $sql->bindParam(":cr", $cr, PDO::PARAM_STR);
                    $sql->bindParam(":co", $co, PDO::PARAM_STR);

                    if ($sql->execute()) {
                        $pdo->commit();

                        $_SESSION['Alert'] = "Rate Added Successfully.";
                        header('Location: ../../Admin/setting.php');
                        exit;
                    } else {
                        $pdo->rollBack();

                        $_SESSION['Alert'] = "Error Inserting Data.";
                        header('Location: ../../Admin/setting.php');
                        exit;
                    }
                } else {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "Availability ID Doesn't Exists!";
                    header('Location: ../../Admin/setting.php');
                    exit;
                }
            } else {
                $pdo->rollBack();

                $_SESSION['Alert'] = "Assistance ID Doesn't Exists!";
                header('Location: ../../Admin/setting.php');
                exit;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();

            $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
            header('Location: ../../Admin/setting.php');
            exit;
        }
    }
} else {
    header('Location: logout.php');
    exit;
}
?>