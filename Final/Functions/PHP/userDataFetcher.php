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
            $_SESSION['family' . $u] = $data;
        }

        $sql = $pdo->query("SELECT * FROM tbl_documents");
        $result = $sql->fetchAll();
        $data = sanitize($result);

        $_SESSION['Documents'] = $data;

        $sql = $pdo->query("SELECT * FROM tbl_assistance");
        $result = $sql->fetchAll();
        $_SESSION['Assistance'] = sanitize($result);

        foreach ($_SESSION['Assistance'] as $as) {
            $aid = $as['Assistance_ID'];

            $sql = $pdo->prepare("SELECT * FROM tbl_requirements WHERE Assistance_ID = :a");
            $sql->bindParam(":a", $aid, PDO::PARAM_INT);
            $sql->execute();
            $_SESSION['Requirements' . $aid] = sanitize($sql->fetchAll());

            $sql = $pdo->prepare("SELECT * FROM tbl_rates WHERE Assistance_ID = :a");
            $sql->bindParam(":a", $aid, PDO::PARAM_INT);
            $sql->execute();
            $_SESSION['Rates' . $aid] = sanitize($sql->fetchAll());
            $_SESSION['ratesCount' . $aid] = $sql->rowCount();
        }

        $sql = $pdo->query("SELECT * FROM tbl_applications WHERE Status = 'Pending'");
        $result = $sql->fetchAll();
        $data = sanitize($result);
        $_SESSION['pendingApplications'] = $data;

        foreach ($data as $d) {
            $apid = $d['Application_ID'] ?? "";
            $aid = $d['Assistance_ID'] ?? "";
            $s = $d['Severity'] ?? "";

            $sql = $pdo->prepare("SELECT Assistance_Name FROM tbl_assistance WHERE Assistance_ID = :a");
            $sql->bindParam(":a", $aid, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $data = sanitize($result);
            $_SESSION['pAan'.$apid] = $data['Assistance_Name'] ?? "";

            $sql = $pdo->prepare("SELECT Criteria FROM tbl_rates WHERE Rate_ID = :s");
            $sql->bindParam(":s", $s, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $data = sanitize($result);
            $_SESSION['pAs'.$apid] = $data['Criteria'] ?? "";
        }

        $sql = $pdo->query("SELECT * FROM tbl_applications WHERE Status = 'Approved'");
        $result = $sql->fetchAll();
        $data = sanitize($result);
        $_SESSION['approvedApplications'] = $data;

        foreach ($data as $d) {
            $apid = $d['Application_ID'] ?? "";
            $aid = $d['Assistance_ID'] ?? "";

            $sql = $pdo->prepare("SELECT Assistance_Name FROM tbl_assistance WHERE Assistance_ID = :a");
            $sql->bindParam(":a", $aid, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $data = sanitize($result);
            $_SESSION['aAan'.$apid] = $data['Assistance_Name'] ?? "";
        }

        $sql = $pdo->query("SELECT * FROM tbl_applications WHERE Status = 'Rejected'");
        $result = $sql->fetchAll();
        $data = sanitize($result);
        $_SESSION['rejectedApplications'] = $data;

        foreach ($data as $d) {
            $apid = $d['Application_ID'] ?? "";
            $aid = $d['Assistance_ID'] ?? "";

            $sql = $pdo->prepare("SELECT Assistance_Name FROM tbl_assistance WHERE Assistance_ID = :a");
            $sql->bindParam(":a", $aid, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $data = sanitize($result);
            $_SESSION['rAan'.$apid] = $data['Assistance_Name'] ?? "";
        }

    } catch (PDOException $e) {
        echo "Connection Error: " . $e->getMessage();
    }
}
?>