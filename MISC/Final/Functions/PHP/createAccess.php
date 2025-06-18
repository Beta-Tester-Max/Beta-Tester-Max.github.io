<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['createAccess'])) {
    $n = $_POST['name'] ?? "";
    $access = '0';
    $access .= (isset($_POST['mUA']) && $_POST['mUA'] === 'on') ? ', 1' : ', 0';

    if (empty($n)) {
        $_SESSION['Alert'] = "Missing Name!";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen(trim($n)) < 3) {
        $_SESSION['Alert'] = "Name cannot be less than 3 Characters.";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen($n) > 50) {
        $_SESSION['Alert'] = "Name cannot exceed 50 Characters.";
        header('Location: ../../Admin/setting.php');
        exit;
    } else {

        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("SELECT * FROM tbl_access_control WHERE Access_Level = :aL");
            $sql->bindParam(":aL", $n, PDO::PARAM_STR);
            $sql->execute();

            if ($sql->rowCount() === 0) {
                $sql = $pdo->prepare("INSERT INTO tbl_access_control (Access_Level, Access)
                VALUES (:aL, :a)");
                $sql->bindParam(":aL", $n, PDO::PARAM_STR);
                $sql->bindParam(":a", $access, PDO::PARAM_STR);

                if ($sql->execute()) {
                    $pdo->commit();
                    $_SESSION['Alert'] = "Access Created Successfully.";
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
                    $_SESSION['Alert'] = "Access Name Already Exists.";
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
} elseif (isset($_POST['modifyAccess'])) {
    $n = $_POST['name'] ?? "";
    $access = '0';
    $access .= (isset($_POST['mUA']) && $_POST['mUA'] === 'on') ? ', 1' : ', 0';

    if (empty($n)) {
        $_SESSION['Alert'] = "Missing Name!";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen(trim($n)) < 3) {
        $_SESSION['Alert'] = "Name cannot be less than 3 Characters.";
        header('Location: ../../Admin/setting.php');
        exit;
    } elseif (strlen($n) > 50) {
        $_SESSION['Alert'] = "Name cannot exceed 50 Characters.";
        header('Location: ../../Admin/setting.php');
        exit;
    } else {

        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("SELECT * FROM tbl_access_control WHERE Access_Level = :aL");
            $sql->bindParam(":aL", $n, PDO::PARAM_STR);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $sql = $pdo->prepare("UPDATE tbl_access_control 
                SET Access = :a");
                $sql->bindParam(":a", $access, PDO::PARAM_STR);

                if ($sql->execute()) {
                    $pdo->commit();
                    $_SESSION['Alert'] = "Access Modified Successfully.";
                    header('Location: ../../Admin/setting.php');
                    exit;
                } else {
                    $pdo->rollBack();
                    $_SESSION['Alert'] = "Error Updating Data.";
                    header('Location: ../../Admin/setting.php');
                    exit;
                }
            } else {
                    $pdo->rollBack();
                    $_SESSION['Alert'] = "Access Deosn't Exists.";
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