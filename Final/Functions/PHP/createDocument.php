<?php
require_once "connect.php";
session_start();

if (isset($_POST['createDocument'])) {
    $d = $_POST['desc'] ?? "";

    if (empty($d)) {
        $_SESSION['Alert'] = "Missing Document Description!";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen(trim($d)) < 10) {
        $_SESSION['Alert'] = "Document Description cannot be less than 10 characters";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen($d) > 50) {
        $_SESSION['Alert'] = "Document Description cannot exceed 1000 characters";
        header('Location: ../../Admin/setting.php');
        exit;
    } else {

        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("SELECT * FROM tbl_documents WHERE Description = :d");
            $sql->bindParam(":d", $d, PDO::PARAM_STR);
            $sql->execute();

            if ($sql->rowCount() === 0) {
                $sql = $pdo->prepare("INSERT INTO tbl_documents (Description)
                VALUES (:d)");
                $sql->bindParam(":d", $d, PDO::PARAM_STR);

                if ($sql->execute()) {
                    $pdo->commit();

                    $_SESSION['Alert'] = "Document Added Successfully.";
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

                $_SESSION['Alert'] = "Document Already Exists!";
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