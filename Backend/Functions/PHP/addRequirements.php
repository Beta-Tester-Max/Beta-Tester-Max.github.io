<?php
require_once "connect.php";
session_start();

if (isset($_POST['addRequirements'])) {
    $a = $_POST['assistance'];
    $d = $_POST['document'];
    $dd = $_POST['description'];
    $i = $_POST['importance'];

    try {
        $pdo->beginTransaction();

        $sql = $pdo->prepare("SELECT * FROM tbl_requirements WHERE Assistance_ID = :a AND Document_ID = :d AND Description = :dd");
        $sql->bindParam(":a", $a, PDO::PARAM_INT);
        $sql->bindParam(":d", $d, PDO::PARAM_INT);
        $sql->bindParam(":dd", $dd, PDO::PARAM_STR);
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
                $_SESSION['Path'] = "../../Admin/addRequirementsForm.php";

                header('Location: ../../Admin/adminDashboard.php');
                exit;
            } else {
                $pdo->rollBack();

                $_SESSION['Alert'] = "Error Inserting Data.";
                $_SESSION['Path'] = "../../Admin/addRequirementsForm.php";

                header('Location: ../../Admin/adminDashboard.php');
                exit;
            }
        } else {
            $pdo->rollBack();

            $_SESSION['Alert'] = "Requirement Already Exists!";
            $_SESSION['Path'] = "../../Admin/addRequirementsForm.php";

            header('Location: ../../Admin/adminDashboard.php');
            exit;
        }
    } catch (PDOException $e) {
        $pdo->rollBack();

        $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
        $_SESSION['Path'] = "../../Admin/addRequirementsForm.php";

        header('Location: ../../Admin/adminDashboard.php');
        exit;
    }
} else {
    header('Location: ../../Admin/adminDashboard.php');
    exit;
}
?>