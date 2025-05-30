<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['approve'])) {
    $aid = intval($_POST['appid']) ?? "";
    $as = intval($_POST['asid']) ?? "";
    $sv = intval($_POST['severity']) ?? "";

    if (empty($aid)) {
        $_SESSION['Alert'] = "Application ID cannot be empty";
        header('Location: ../../Admin/applications.php');
        exit;
    } elseif (strlen(strval($aid)) > 11) {
        $_SESSION['Alert'] = "Application ID cannot be more than 11 digits";
        header('Location: ../../Admin/applications.php');
        exit;
    } elseif (empty($as)) {
        $_SESSION['Alert'] = "Assistance ID cannot be empty";
        header('Location: ../../Admin/applications.php');
        exit;
    } elseif (strlen(strval($as)) > 11) {
        $_SESSION['Alert'] = "Assistance ID cannot be more than 11 digits";
        header('Location: ../../Admin/applications.php');
        exit;
    } elseif (empty($sv)) {
        $_SESSION['Alert'] = "Rate ID cannot be empty";
        header('Location: ../../Admin/applications.php');
        exit;
    } elseif (strlen(strval($sv)) > 11) {
        $_SESSION['Alert'] = "Rate ID cannot be more than 11 digits";
        header('Location: ../../Admin/applications.php');
        exit;
    } else {
        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("UPDATE tbl_applications
            SET Status = 'Approved'
            WHERE Application_ID = :a");
            $sql->bindParam(":a", $aid, PDO::PARAM_INT);
            if ($sql->execute()) {
                $sql = $pdo->prepare("SELECT * FROM tbl_budget WHERE Assistance_ID = :a");
                $sql->bindParam(":a", $as, PDO::PARAM_INT);
                $sql->execute();

                if ($sql->rowCount() > 0) {
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data = sanitize($result);
                    $a = intval($data['Amount']) ?? "";

                    $sql = $pdo->prepare("SELECT * FROM tbl_rates WHERE Rate_ID = :r");
                    $sql->bindParam(":r", $sv, PDO::PARAM_INT);
                    $sql->execute();
                    if ($sql->rowCount() > 0) {
                        $result = $sql->fetch(PDO::FETCH_ASSOC);
                        $data = sanitize($result);
                        $c = intval($data['Cost']) ?? "";

                        $newam = $a + $c;

                        $sql = $pdo->prepare("UPDATE tbl_budget
                        SET Amount = :a
                        WHERE Assistance_ID = :as");
                        $sql->bindParam(":a", $c, PDO::PARAM_INT);
                        $sql->bindParam(":as", $as, PDO::PARAM_INT);

                        if ($sql->execute()) {
                            $pdo->commit();
                            $_SESSION['Alert'] = "Application Approved Successfully!";
                            header('Location: ../../Admin/applications.php');
                            exit;
                        } else {
                            $pdo->rollBack();
                            $_SESSION['Alert'] = "Error Updating Budget";
                            header('Location: ../../Admin/applications.php');
                            exit;
                        }
                    } else {
                        $pdo->rollBack();
                        $_SESSION['Alert'] = "Rate does not Exists!";
                        header('Location: ../../Admin/applications.php');
                        exit;
                    }
                } else {
                    $sql = $pdo->prepare("SELECT * FROM tbl_rates WHERE Rate_ID = :r");
                    $sql->bindParam(":r", $sv, PDO::PARAM_INT);
                    $sql->execute();

                    if ($sql->rowCount() > 0) {
                        $result = $sql->fetch(PDO::FETCH_ASSOC);
                        $data = sanitize($result);
                        $c = intval($data['Cost']) ?? "";

                        $sql = $pdo->prepare("INSERT INTO tbl_budget (Assistance_ID, Amount)
                        VALUES (:as, :a)");
                        $sql->bindParam(":as", $as, PDO::PARAM_INT);
                        $sql->bindParam(":a", $c, PDO::PARAM_INT);

                        if ($sql->execute()) {
                            $pdo->commit();
                            $_SESSION['Alert'] = "Application Approved Successfully!";
                            header('Location: ../../Admin/applications.php');
                            exit;
                        } else {
                            $pdo->rollBack();
                            $_SESSION['Alert'] = "Error Inserting Budget";
                            header('Location: ../../Admin/applications.php');
                            exit;
                        }
                    } else {
                        $pdo->rollBack();
                        $_SESSION['Alert'] = "Rate does not Exists!";
                        header('Location: ../../Admin/applications.php');
                        exit;
                    }
                }
            } else {
                $pdo->rollBack();
                $_SESSION['Alert'] = "Error Updating Application!";
                header('Location: ../../Admin/applications.php');
                exit;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
            header('Location: ../../Admin/applications.php');
            exit;
        }
    }
} elseif (isset($_POST['reject'])) {
    $aid = intval($_POST['appid']) ?? "";
    $r = $_POST['reason'] ?? "";

    if (empty($aid)) {
        $_SESSION['Alert'] = "Application ID cannot be empty";
        header('Location: ../../Admin/applications.php');
        exit;
    } elseif (strlen(trim(strval($aid))) > 11) {
        $_SESSION['Alert'] = "Application ID cannot be more than 11 digits";
        header('Location: ../../Admin/applications.php');
        exit;
    } elseif (empty($r)) {
        $_SESSION['Alert'] = "Missing Reason!";
        header('Location: ../../Admin/applications.php');
        exit;
    } elseif (strlen(trim($r)) < 10) {
        $_SESSION['Alert'] = "Reason cannot be more less than 10 characters! Not including space.";
        header('Location: ../../Admin/applications.php');
        exit;
    } elseif (strlen($r) > 1000) {
        $_SESSION['Alert'] = "Reason cannot be more than 1000 characters! Including space.";
        header('Location: ../../Admin/applications.php');
        exit;
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

                $_SESSION['Alert'] = "Application Rejected Successfully!";
                header('Location: ../../Admin/applications.php');
                exit;
            } else {
                $pdo->rollBack();
                $_SESSION['Alert'] = "Error Updating Application!";
                header('Location: ../../Admin/applications.php');
                exit;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
            header('Location: ../../Admin/applications.php');
            exit;
        }
    }
} else {
    header('Location: logout.php');
    exit;
}
?>