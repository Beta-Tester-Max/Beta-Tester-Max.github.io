<?php
require_once "connect.php";

if (isset($_SESSION['Authority']) && !empty($_SESSION['Authority'])) {
    try {
        $sql = $pdo->query("SELECT * FROM tbl_availability");
        $result = $sql->fetchAll();
        $_SESSION['Availability'] = sanitize($result);

        $sql = $pdo->query("SELECT * FROM tbl_assistance");
        $result = $sql->fetchAll();
        $_SESSION['Assistance'] = sanitize($result);

        $sql = $pdo->query("SELECT * FROM tbl_documents");
        $result = $sql->fetchAll();
        $data = sanitize($result);
        $_SESSION['Documents'] = $data;

        $sql = $pdo->query("SELECT DISTINCT Account_ID FROM tbl_applications WHERE Status = 'Pending'");
        $result = $sql->fetchAll();
        $data = sanitize($result);
        $_SESSION['pendingA'] = $data;
        foreach ($data as $d) {
            $aF = array();
            $a = $d['Account_ID'];
            $sql = $pdo->prepare("SELECT Family_Name FROM tbl_family WHERE Account_ID = :a");
            $sql->bindParam(":a", $a, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $data = sanitize($result);
            $_SESSION['pendingF' . $a] = $data['Family_Name'];
            $sql = $pdo->prepare("SELECT * FROM tbl_applications WHERE Account_ID = :a AND Status = 'Pending'");
            $sql->bindParam(":a", $a, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetchAll();
            $data = sanitize($result);
            $_SESSION['pendingApp' . $a] = $data;
            foreach ($data as $p) {
                $as = $p['Assistance_ID'] ?? "";
                $sql = $pdo->prepare("SELECT Assistance_Name FROM tbl_assistance WHERE Assistance_ID = :a");
                $sql->bindParam(":a", $as, PDO::PARAM_INT);
                $sql->execute();
                $result = $sql->fetch(PDO::FETCH_ASSOC);
                $data = sanitize($result);;
                $_SESSION['pAs'.$as] = $data['Assistance_Name'];
                $aF = explode(", ", $p['Files']) ?? "";
                for ($i = 0; $i < count($aF); ++$i) {
                    $f = $aF[$i];
                    $sql = $pdo->prepare("SELECT File_Name, Requirement_ID FROM tbl_files WHERE File_ID = :f");
                    $sql->bindParam(":f", $f, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data = sanitize($result);
                    $_SESSION['pFile' . $f] = $data['File_Name'];
                    $_SESSION['pR' . $f] = $data['Requirement_ID'];
                    $r = $data['Requirement_ID'];
                    $sql = $pdo->prepare("SELECT t1.Description, t2.Assistance_Name FROM tbl_requirements as t1, tbl_assistance as t2 WHERE t1.Assistance_ID = :a AND t1.Requirement_ID = :r AND t2.Assistance_ID = :a");
                    $sql->bindParam(":a", $as, PDO::PARAM_INT);
                    $sql->bindParam(":r", $r, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data = sanitize($result);
                    $_SESSION['pDesc' . $r] = $data['Description'];
                }
            }
        }
    } catch (PDOException $e) {
        echo "Connection Error: " . $e->getMessage();
    }
}
?>