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

        $_SESSION['Family_ID'] = $data['Family_ID'];

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
            $_SESSION['family'] = $data;
        }

        // $sql = $pdo->query("SELECT * FROM tbl_documents");
        // $result = $sql->fetchAll();
        // $data = sanitize($result);

        // $_SESSION['Documents'] = $data;

        // foreach ($_SESSION['Documents'] as $d) {
        //     $did = $d['Document_ID'];

        //     $sql = $pdo->prepare("SELECT * FROM tbl_account_requirements WHERE Document_ID = :d AND Account_ID = :a");
        //     $sql->bindParam(":d", $did, PDO::PARAM_INT);
        //     $sql->bindParam(":a", $a, PDO::PARAM_INT);
        //     $sql->execute();
        //     $data = sanitize($sql->fetchAll());
        //     $_SESSION['accountRequirements' . $did] = $data;
        // }

        // $sql = $pdo->query("SELECT * FROM tbl_assistance");
        // $assistance = $sql->fetchAll();
        // $_SESSION['Assistance'] = sanitize($assistance);

        // foreach ($_SESSION['Assistance'] as $as) {
        //     $aid = $as['Assistance_ID'];

        //     $sql = $pdo->prepare("SELECT * FROM tbl_requirements WHERE Assistance_ID = :a");
        //     $sql->bindParam(":a", $aid, PDO::PARAM_INT);
        //     $sql->execute();
        //     $_SESSION['Requirements' . $aid] = sanitize($sql->fetchAll());
        // }

        // $eA = array();

        // foreach ($_SESSION['Assistance'] as $as) {
        //     $aid = $as['Assistance_ID'];
        //     $an = $as['Assistance_Name'];
        //     $mR = array();

        //     $sql = $pdo->prepare("SELECT Document_ID FROM tbl_requirements WHERE Assistance_ID = :a AND Importance = 'Required'");
        //     $sql->bindParam(":a", $aid, PDO::PARAM_INT);
        //     $sql->execute();
        //     $result = $sql->fetchAll();
        //     $data = sanitize($result);
        //     $_SESSION['requiredDocuments' . $aid] = $data;

        //     foreach ($_SESSION['requiredDocuments' . $aid] as $rd) {
        //         $d = $rd['Document_ID'];

        //         $sql = $pdo->prepare("SELECT Document_ID FROM tbl_account_requirements WHERE Account_ID = :a AND Document_ID = :d AND Status = 'Validated'");
        //         $sql->bindParam(":a", $a, PDO::PARAM_INT);
        //         $sql->bindParam(":d", $d, PDO::PARAM_INT);
        //         $sql->execute();
        //         $result = $sql->fetch(PDO::FETCH_ASSOC);
        //         $data = sanitize($result);
        //         if (!empty($data)) {
        //             $_SESSION['accountDocument' . $d] = $data['Document_ID'];
        //         } else {
        //             $mR[] = $d;
        //         }
        //     }

        //     $_SESSION['missingRequirements' . $aid] = $mR;

        //     if (!empty($mR)) {
        //         for ($i = 0; $i < count($mR); $i++) {
        //             $r = $mR[$i];

        //             $sql = $pdo->prepare("SELECT Description FROM tbl_documents WHERE Document_ID = :r");
        //             $sql->bindParam(":r", $r, PDO::PARAM_INT);
        //             $sql->execute();
        //             $result = $sql->fetch(PDO::FETCH_ASSOC);
        //             $data = sanitize($result);
        //             $_SESSION['accountDocumentN' . $r] = $data['Description'];
        //         }
        //     } else {
        //         $eA[] = [$aid => $an];
        //     }
        // }

        // if (!empty($eA)) {
        //     $_SESSION['eApplication'] = $eA;
        // }

    } catch (PDOException $e) {
        echo "Connection Error: " . $e->getMessage();
    }
}
?>