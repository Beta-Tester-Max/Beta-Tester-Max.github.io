<?php
require_once "connect.php";

if (isset($_SESSION['Authority']) && !empty($_SESSION['Authority'])) {
    try {
        $sql = $pdo->query("SELECT * FROM tbl_assistance");
        $assistance = $sql->fetchAll();
        $_SESSION['Assistance'] = sanitize($assistance);

        $sql = $pdo->query("SELECT * FROM tbl_documents");
        $result = $sql->fetchAll();
        $data = sanitize($result);
        $_SESSION['Documents'] = $data;

        $sql = $pdo->query("SELECT DISTINCT Account_ID FROM tbl_account_requirements WHERE Status = 'Unvalidated'");
        $result = $sql->fetchAll();
        $data = sanitize($result);
        $_SESSION['unvalidatedA'] = $data;
        foreach ($data as $d) {
            $a = $d['Account_ID'];
            $sql = $pdo->prepare("SELECT Family_Name FROM tbl_family WHERE Account_ID = :a");
            $sql->bindParam(":a", $a, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $data = sanitize($result);
            $_SESSION['unvalidatedF' . $a] = $data['Family_Name'];
            $sql = $pdo->prepare("SELECT * FROM tbl_account_requirements WHERE Account_ID = :a AND Status = 'Unvalidated'");
            $sql->bindParam(":a", $a, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetchAll();
            $data = sanitize($result);
            $_SESSION['unvalidatedR' . $a] = $data;
            foreach ($data as $r) {
                $d = $r['Document_ID'] ?? "";
                $f = $r['File_ID'] ?? "";
                $sql = $pdo->prepare("SELECT Description FROM tbl_documents WHERE Document_ID = :d");
                $sql->bindParam(":d", $d, PDO::PARAM_INT);
                $sql->execute();
                $result = $sql->fetch(PDO::FETCH_ASSOC);
                $data = sanitize($result);
                $_SESSION['uDesc' . $d] = $data['Description'];
                $sql = $pdo->prepare("SELECT File_Name FROM tbl_files WHERE Account_ID = :a AND File_ID = :f");
                $sql->bindParam(":a", $a, PDO::PARAM_INT);
                $sql->bindParam(":f", $f, PDO::PARAM_INT);
                $sql->execute();
                $result = $sql->fetch(PDO::FETCH_ASSOC);
                $data = sanitize($result);
                $_SESSION['uFile' . $f] = $data['File_Name'];
            }
        }

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
                    $sql = $pdo->prepare("SELECT t1.File_Name, t2.Document_ID FROM tbl_files as t1, tbl_account_requirements as t2 WHERE t1.File_ID = :f AND t2.File_ID = :f");
                    $sql->bindParam(":f", $f, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data = sanitize($result);
                    $_SESSION['pFile' . $f] = $data['File_Name'];
                    $_SESSION['pD' . $f] = $data['Document_ID'];
                    $d = $data['Document_ID'];
                    $sql = $pdo->prepare("SELECT t1.Description, t2.Assistance_Name FROM tbl_requirements as t1, tbl_assistance as t2 WHERE t1.Assistance_ID = :a AND t1.Document_ID = :d AND t2.Assistance_ID = :a");
                    $sql->bindParam(":a", $as, PDO::PARAM_INT);
                    $sql->bindParam(":d", $d, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data = sanitize($result);
                    $_SESSION['pDesc' . $d] = $data['Description'];
                }
            }
        }
    } catch (PDOException $e) {
        echo "Connection Error: " . $e->getMessage();
    }
}
?>