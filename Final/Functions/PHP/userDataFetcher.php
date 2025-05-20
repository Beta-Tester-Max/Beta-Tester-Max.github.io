<?php
require_once "connect.php";

if (isset($_SESSION['Account_ID']) && !empty($_SESSION['Account_ID'])) {
    $a = $_SESSION['Account_ID'] ?? "";
    try {

        $sql = $pdo->prepare("SELECT Username, Email, Access_Level FROM tbl_accounts WHERE Account_ID = :a");
        $sql->bindParam(":a", $a, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $data = sanitize($result);

        $_SESSION['Account'] = $data;

        $sql = $pdo->prepare("SELECT Family_ID FROM tbl_family WHERE Account_ID = :a");
        $sql->bindParam(":a", $a, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $data = sanitize($result);

        $_SESSION['Family_ID'] = $data['Family_ID'] ?? "";

        $sql = $pdo->prepare("SELECT * FROM tbl_family_composition WHERE Account_ID = :a");
        $sql->bindParam(":a", $a, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetchAll();
        $data = sanitize($result);

        $_SESSION['familyComp'] = $data;
        $_SESSION['hasFamily'] = ($sql->rowCount() > 0) ? 1 : 0;

        foreach ($data as $fc) {
            $u = $fc['User_ID'];

            $sql = $pdo->prepare("SELECT * FROM tbl_family_member WHERE User_ID = :u");
            $sql->bindParam(":u", $u, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetchAll();
            $data = sanitize($result);
            $_SESSION['family'.$u] = $data;
        }

        $sql = $pdo->query("SELECT * FROM tbl_documents");
        $result = $sql->fetchAll();
        $data = sanitize($result);

        $_SESSION['Documents'] = $data;

        $sql = $pdo->query("SELECT * FROM tbl_assistance");
        $assistance = $sql->fetchAll();
        $_SESSION['Assistance'] = sanitize($assistance);

        foreach ($_SESSION['Assistance'] as $as) {
            $aid = $as['Assistance_ID'];

            $sql = $pdo->prepare("SELECT * FROM tbl_requirements WHERE Assistance_ID = :a");
            $sql->bindParam(":a", $aid, PDO::PARAM_INT);
            $sql->execute();
            $_SESSION['Requirements' . $aid] = sanitize($sql->fetchAll());
        }

    } catch (PDOException $e) {
        echo "Connection Error: " . $e->getMessage();
    }
}
?>