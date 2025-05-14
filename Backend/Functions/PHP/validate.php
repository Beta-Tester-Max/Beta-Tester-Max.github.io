<?php
require_once "connect.php";
session_start();

if (isset($_POST['validate'])) {
    $a = $_POST['id'];
    $d = date("Y/m/d");

    try {
        $pdo->beginTransaction();

        $sql = $pdo->prepare("UPDATE tbl_account_requirements
            SET Status = 'Validated',
            Date_Reviewed = :d
            WHERE Account_Requirement_ID = :a");;
        $sql->bindParam(":a", $a, PDO::PARAM_INT);
        $sql->bindParam(":doc", $doc, PDO::PARAM_INT);

        if ($sql->execute()) {
            $pdo->commit();

            $_SESSION['Alert'] = "Requirement Validated Successfully!";
            $_SESSION['Path'] = "../../Admin/requirementsValidate.php";

            header('Location: ../../Admin/adminDashboard.php');
            exit;
        } else {
            $pdo->rollBack();

            $_SESSION['Alert'] = "Error Updating Data.";
            $_SESSION['Path'] = "../../Admin/requirementsValidate.php";

            header('Location: ../../Admin/adminDashboard.php');
            exit;
        }
    } catch (PDOException $e) {
        $pdo->rollBack();

        $_SESSION['Alert'] = "Conenction Error: " . $e->getMessage();
        $_SESSION['Path'] = "../../Admin/requirementsValidate.php";

        header('Location: ../../Admin/adminDashboard.php');
        exit;
    }
} else {
    header('Location: logout.php');
    exit;
}
?>