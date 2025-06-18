<?php
require_once "connect.php";
session_start();

if (isset($_POST['addDocuments'])) {
    $d = $_POST['description'];

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
                $_SESSION['Path'] = "../../Admin/addDocumentsForm.php";

                header('Location: ../../Admin/adminDashboard.php');
                exit;
            } else {
                $pdo->rollBack();

                $_SESSION['Alert'] = "Error Inserting Data.";
                $_SESSION['Path'] = "../../Admin/addDocumentsForm.php";

                header('Location: ../../Admin/adminDashboard.php');
                exit;
            }
        } else {
            $pdo->rollBack();

            $_SESSION['Alert'] = "Document Already Exists!";
            $_SESSION['Path'] = "../../Admin/addDocumentsForm.php";

            header('Location: ../../Admin/adminDashboard.php');
            exit;
        }
    } catch (PDOException $e) {
        $pdo->rollBack();

        $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
        $_SESSION['Path'] = "../../Admin/addDocumentsForm.php";

        header('Location: ../../Admin/adminDashboard.php');
        exit;
    }
} else {
    header('Location: ../../index.php');
    exit;
}
?>