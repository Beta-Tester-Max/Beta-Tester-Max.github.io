<?php
require_once "connect.php";

if (isset($_SESSION['Authority']) && !empty($_SESSION['Authority'])) {
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
        $sql = $pdo->prepare("SELECT Document_ID, File_ID, Date_Submitted FROM tbl_account_requirements WHERE Account_ID = :a AND Status = 'Unvalidated'");
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
            $_SESSION['desc' . $d] = $data['Description'];
            $sql = $pdo->prepare("SELECT File_Name FROM tbl_files WHERE File_ID = :f");
            $sql->bindParam(":f", $f, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $data = sanitize($result);
            $_SESSION['file' . $f] = $data['File_Name'];
        }
    }
}
?>