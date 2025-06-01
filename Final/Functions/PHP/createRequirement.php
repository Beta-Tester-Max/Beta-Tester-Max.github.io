<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['createRequirement'])) {
    $a = intval($_POST['assistance']) ?? "";
    $d = intval($_POST['document']) ?? "";
    $dd = $_POST['desc'] ?? "";
    $i = $_POST['importance'] ?? "";

    if (empty($a)) {
        $_SESSION['Alert'] = "Missing Assistance ID!";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen(strval($a)) > 11) {
        $_SESSION['Alert'] = "Assistance ID must not exceed 11 digits.";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (empty($d)) {
        $_SESSION['Alert'] = "Missing Document ID!";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen(strval($d)) > 11) {
        $_SESSION['Alert'] = "Assistance ID must not exceed 11 digits.";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (empty($dd)) {
        $_SESSION['Alert'] = "Missing Requirement Description!";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen(trim($dd)) < 10) {
        $_SESSION['Alert'] = "Requirement Description cannot be less than 10 characters";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen($dd) > 1000) {
        $_SESSION['Alert'] = "Requirement Description cannot exceed 1000 characters";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif ($i !== 'Required' && $i !== 'Optional') {
        $_SESSION['Alert'] = "Importance can only be Required or Optional";
        header('Location: ../../Admin/setting.php');
        exit;
    } else {

        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("SELECT * FROM tbl_assistance WHERE Assistance_ID = :a");
            $sql->bindParam(":a", $a, PDO::PARAM_INT);
            $sql->execute();

            if ($sql->rowCount() > 0) {

                $sql = $pdo->prepare("SELECT * FROM tbl_documents WHERE Document_ID = :d");
                $sql->bindParam(":d", $d, PDO::PARAM_INT);
                $sql->execute();

                if ($sql->rowCount() > 0) {

                    $sql = $pdo->prepare("SELECT * FROM tbl_requirements WHERE Assistance_ID = :a AND Document_ID = :d");
                    $sql->bindParam(":a", $a, PDO::PARAM_INT);
                    $sql->bindParam(":d", $d, PDO::PARAM_INT);
                    $sql->execute();

                    if ($sql->rowCount() === 0) {
                        $sql = $pdo->prepare("INSERT INTO tbl_requirements (Assistance_ID, Document_ID, Description, Importance)
                        VALUES (:a, :d, :dd, :i)");
                        $sql->bindParam(":a", $a, PDO::PARAM_INT);
                        $sql->bindParam(":d", $d, PDO::PARAM_INT);
                        $sql->bindParam(":dd", $dd, PDO::PARAM_STR);
                        $sql->bindParam(":i", $i, PDO::PARAM_STR);

                        if ($sql->execute()) {
                            $pdo->commit();

                            $_SESSION['Alert'] = "Requirements Added Successfully.";
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

                        $_SESSION['Alert'] = "Requirement Already Exists!";
                        header('Location: ../../Admin/setting.php');
                        exit;
                    }
                } else {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "Document ID Doesn't Exists!";
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