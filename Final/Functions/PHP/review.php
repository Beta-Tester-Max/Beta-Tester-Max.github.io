<?php
require_once "connect.php";

if (isset($_POST['approve'])) {
    $aid = intval($_POST['appid']) ?? "";

    if (empty($aid)) {
        echo "Application ID cannot be empty";
    } elseif (strlen(trim(strval($aid))) > 11) {
        echo "Application ID cannot be more than 11 digits";
    } else {
        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("UPDATE tbl_applications
            SET Status = 'Approved'
            WHERE Application_ID = :a");
            $sql->bindParam(":a", $aid, PDO::PARAM_INT);
            if ($sql->execute()) {
                $pdo->commit();

                header('Location: ../../Admin/applications.php');
                exit;
            } else {
                $pdo->rollBack();
                echo "Error Updating Application!";
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo $e->getMessage();
        }
    }
} elseif (isset($_POST['reject'])) {
    $aid = intval($_POST['appid']) ?? "";
    $r = $_POST['reason'] ?? "";

    if (empty($aid)) {
        echo "Application ID cannot be empty";
    } elseif (strlen(trim(strval($aid))) > 11) {
        echo "Application ID cannot be more than 11 digits";
    } elseif (empty($r)) {
        echo "Missing Reason!";
    } elseif (strlen(trim($r)) < 10) {
        echo "Reason cannot be more less than 10 characters! Not including space.";
    } elseif (strlen($r) > 1000) {
        echo "Reason cannot be more than 1000 characters! Including space.";
    } else {
        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("UPDATE tbl_applications
            SET Status = 'Rejected',
            ReasonFR = :r
            WHERE Application_ID = :a");
            $sql->bindParam(":a", $aid, PDO::PARAM_INT);
            $sql->bindParam(":r", $r, PDO::PARAM_STR);
            if ($sql->execute()) {
                $pdo->commit();

                header('Location: ../../Admin/applications.php');
                exit;
            } else {
                $pdo->rollBack();
                echo "Error Updating Application!";
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo $e->getMessage();
        }
    }
} else {
    header('Location: logout.php');
    exit;
}
?>