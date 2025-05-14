<?php
require_once "connect.php";
session_start();

if (isset($_POST['submitApp'])) {
    $a = $_SESSION['Account_ID'];
    $as = $_POST['assistance'];
    $h = $_POST['helpee'];
    $rp = $_POST['rep'];
    $r = $_POST['reason'];

    if (isset($as) || !empty($as)) {
        $appA = $as ?? "";
        $aF = array();

        $sql = $pdo->prepare("SELECT Document_ID FROM tbl_requirements WHERE Assistance_ID = :a");
        $sql->bindParam(":a", $appA, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetchAll();
        $data = sanitize($result);
        $_SESSION['appDoc'] = $data;

        foreach ($data as $i) {
            $d = $i['Document_ID'];

            $sql = $pdo->prepare("SELECT File_ID FROM tbl_account_requirements WHERE Account_ID = :a AND Document_ID = :d AND Status = 'Validated'");
            $sql->bindParam(":a", $a, PDO::PARAM_INT);
            $sql->bindParam(":d", $d, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $data = sanitize($result);
            if (!empty($data['File_ID'])) {
                if (empty($aF)) {
                    $aF = $data['File_ID'] ?? "";
                } else {
                    $aF .= ", " . $data['File_ID'] ?? "";
                }
            }
        }
    }

    try {
        $pdo->beginTransaction();

        $sql = $pdo->prepare("INSERT INTO tbl_applications (Account_ID, Assistance_ID, Beneficiary, Representative, Reason, Files)
        VALUES (:a, :as, :h, :rp, :r, :f)");
        $sql->bindParam(":a", $a, PDO::PARAM_INT);
        $sql->bindParam(":as", $as, PDO::PARAM_INT);
        $sql->bindParam(":h", $h, PDO::PARAM_INT);
        $sql->bindParam(":rp", $rp, PDO::PARAM_INT);
        $sql->bindParam(":r", $r, PDO::PARAM_STR);
        $sql->bindParam(":f", $aF, PDO::PARAM_STR);

        if ($sql->execute()) {
            $pdo->commit();

            unset($_SESSION['appAssistance'], $_SESSION['appDoc'], $_SESSION['appFiles']);
            $_SESSION['Alert'] = "Application Submitted Successfully!";
            $_SESSION['Path'] = "../../profile.php";

            header('Location: ../../index.php');
            exit;
        } else {
            $pdo->rollBack();

            $_SESSION['Alert'] = "Error Inserting Data.";
            $_SESSION['Path'] = "../../createApplicationForm.php";

            header('Location: ../../index.php');
            exit;
        }
    } catch (PDOException $e) {
        $pdo->rollBack();

        $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
        $_SESSION['Path'] = "../../createApplicationForm.php";

        header('Location: ../../index.php');
        exit;
    }
} else {
    header('Location: logout.php');
    exit;
}
?>