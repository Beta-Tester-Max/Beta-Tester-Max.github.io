<?php
require_once "connect.php";
session_start();

if (isset($_POST['submitApp'])) {
    $a = $_SESSION['Account_ID'];
    $as = $_POST['assistance'];
    $h = $_POST['helpee'];
    $rp = $_POST['rep'];
    $r = $_POST['reason'];
    $aF = array();
    
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
                $aF[] = $data['File_ID'] ?? "";
            }
        }
    }
     
    $f = $aF[0] ?? "";
    $f1 = $aF[1] ?? "";
    $f2 = $aF[2] ?? "";
    $f3 = $aF[3] ?? "";
    $f4 = $aF[4] ?? "";
    $f5 = $aF[5] ?? "";
    $f6 = $aF[6] ?? "";
    $f7 = $aF[7] ?? "";
    $f8 = $aF[8] ?? "";
    $f9 = $aF[9] ?? "";
    $f10 = $aF[10] ?? "";



    try {
        $pdo->beginTransaction();

        $sql = $pdo->prepare("INSERT INTO tbl_applications (Account_ID, Assistance_ID, Beneficiary, Representative, Reason, File_1, File_2, File_3, File_4, File_5, File_6, File_7, File_8, File_9, File_10, File_11)
        VALUES (:a, :as, :h, :rp, :r, :f, :f1, :f2, :f3, :f4, :f5, :f6, :f7, :f8, :f9, :f10)");
        $sql->bindParam(":a", $a, PDO::PARAM_INT);
        $sql->bindParam(":as", $as, PDO::PARAM_INT);
        $sql->bindParam(":h", $h, PDO::PARAM_INT);
        $sql->bindParam(":rp", $rp, PDO::PARAM_INT);
        $sql->bindParam(":r", $r, PDO::PARAM_INT);
        $sql->bindParam(":f", $f, PDO::PARAM_INT);
        $sql->bindParam(":f1", $f1, PDO::PARAM_INT);
        $sql->bindParam(":f2", $f2, PDO::PARAM_INT);
        $sql->bindParam(":f3", $f3, PDO::PARAM_INT);
        $sql->bindParam(":f4", $f4, PDO::PARAM_INT);
        $sql->bindParam(":f5", $f5, PDO::PARAM_INT);
        $sql->bindParam(":f6", $f6, PDO::PARAM_INT);
        $sql->bindParam(":f7", $f7, PDO::PARAM_INT);
        $sql->bindParam(":f8", $f8, PDO::PARAM_INT);
        $sql->bindParam(":f9", $f9, PDO::PARAM_INT);
        $sql->bindParam(":f10", $f10, PDO::PARAM_INT);

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