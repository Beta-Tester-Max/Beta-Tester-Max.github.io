<?php
require_once "connect.php";

if (isset($_SESSION['access']) && !empty($_SESSION['access'])) {
    if (isset($_SESSION['Admin_ID']) && !empty($_SESSION['Admin_ID'])) {
        $a = $_SESSION['Admin_ID'] ?? "";

        try {

            $sql = $pdo->prepare("SELECT * FROM tbl_admin_token WHERE Token_ID = :t");
            $sql->bindParam(":t", $a, PDO::PARAM_INT);
            $sql->execute();

            if ($sql->rowCount() === 1) {
                $sql = $pdo->prepare("SELECT Admin_Name, Access_ID FROM tbl_admin_info WHERE Token_ID = :t");
                $sql->bindParam(":t", $a, PDO::PARAM_INT);
                $sql->execute();
                $result = $sql->fetch(PDO::FETCH_ASSOC);
                $data = sanitize($result);
                $adminName = $data['Admin_Name'] ?? "";
                $a = $data['Access_ID'] ?? "";

                $sql = $pdo->prepare("SELECT Access_Level FROM tbl_access_control WHERE Access_ID = :a");
                $sql->bindParam(":a", $a, PDO::PARAM_INT);
                $sql->execute();
                $result = $sql->fetch(PDO::FETCH_ASSOC);
                $data = sanitize($result);
                $accessLevel = $data['Access_Level'] ?? "";

                $sql = $pdo->query("SELECT * FROM tbl_access_control");
                $result = $sql->fetchAll();
                $data = sanitize($result);
                $_SESSION['accessControl'] = $data;

                $sql = $pdo->query("SELECT Token_ID, `Key` FROM tbl_admin_token");
                $result = $sql->fetchAll();
                $data = sanitize($result);
                $_SESSION['allTokens'] = $data;
                foreach ($data as $d) {
                    $token = $d['Token_ID'] ?? "";

                    $sql = $pdo->prepare("SELECT Access_ID, Admin_ID, Admin_Name FROM tbl_admin_info WHERE Token_ID = :t");
                    $sql->bindParam(":t", $token, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data = sanitize($result);
                    $_SESSION['adminName' . $token] = $data['Admin_Name'] ?? "";
                    $_SESSION['adminID' . $token] = $data['Admin_ID'] ?? "";
                    $_SESSION['acid' . $token] = $data['Access_ID'] ?? "";
                    $acid = $data['Access_ID'] ?? "";

                    $sql = $pdo->prepare("SELECT Access_Level FROM tbl_access_control WHERE Access_ID = :a");
                    $sql->bindParam(":a", $acid, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data = sanitize($result);
                    $_SESSION['accessName' . $acid] = $data['Access_Level'] ?? "";
                }

                $sql = $pdo->query("SELECT * FROM tbl_applications WHERE Status = 'Pending' AND is_deleted = 0");
                $result = $sql->fetchAll();
                $data = sanitize($result);
                $_SESSION['pA'] = $data;
                foreach ($data as $d) {
                    $aid = $d['Application_ID'] ?? "";
                    $rep = $d['Representative'] ?? "";
                    $as = $d['Assistance_ID'] ?? "";
                    $a = $d['Account_ID'] ?? "";
                    $sv = $d['Severity'] ?? "";
                    $files = explode(", ", $d['Files']) ?? "";

                    $sql = $pdo->prepare("SELECT Family_Name FROM tbl_family WHERE Account_ID = :a");
                    $sql->bindParam(":a", $a, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data = sanitize($result);
                    $_SESSION['pA_fN' . $a] = $data['Family_Name'];

                    $sql = $pdo->prepare("SELECT First_Name, Middle_Name, Last_Name FROM tbl_family_member WHERE User_ID = :u");
                    $sql->bindParam(":u", $rep, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data = sanitize($result);
                    $_SESSION['pA_name' . $aid] = $data;

                    $sql = $pdo->prepare("SELECT Assistance_Name FROM tbl_assistance WHERE Assistance_ID = :a");
                    $sql->bindParam(":a", $as, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data = sanitize($result);
                    $_SESSION['pA_as' . $aid] = $data['Assistance_Name'];

                    $sql = $pdo->prepare("SELECT Criteria FROM tbl_rates WHERE Rate_ID = :r");
                    $sql->bindParam(":r", $sv, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data = sanitize($result);
                    $_SESSION['pA_sv' . $sv] = $data['Criteria'];

                    $sql = $pdo->prepare("SELECT * FROM tbl_Address WHERE Account_ID = :a");
                    $sql->bindParam(":a", $a, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data = sanitize($result);
                    $_SESSION['pA_add' . $aid] = $data;

                    for ($i = 0; $i < count($files); ++$i) {
                        $sql = $pdo->prepare("SELECT Requirement_ID, File_Name FROM tbl_files WHERE File_ID = :f");
                        $sql->bindParam(":f", $files[$i], PDO::PARAM_INT);
                        $sql->execute();
                        $result = $sql->fetch(PDO::FETCH_ASSOC);
                        $data = sanitize($result);
                        $_SESSION['file' . $i . $aid] = $data['File_Name'] ?? "";

                        $sql = $pdo->prepare("SELECT Description FROM tbl_requirements WHERE Requirement_ID = :r");
                        $sql->bindParam(":r", $data['Requirement_ID'], PDO::PARAM_INT);
                        $sql->execute();
                        $result = $sql->fetch(PDO::FETCH_ASSOC);
                        $data = sanitize($result);
                        $_SESSION['desc' . $i . $aid] = $data['Description'] ?? "";
                    }

                    $sql = $pdo->prepare("SELECT User_ID FROM tbl_family_composition WHERE Account_ID = :a");
                    $sql->bindParam(":a", $a, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetchAll();
                    $data = sanitize($result);
                    $_SESSION['pA_fC' . $a] = $data;

                    foreach ($data as $d) {
                        $u = $d['User_ID'] ?? "";

                        $sql = $pdo->prepare("SELECT * FROM tbl_family_member WHERE User_ID = :u");
                        $sql->bindParam(":u", $u, PDO::PARAM_INT);
                        $sql->execute();
                        $result = $sql->fetch(PDO::FETCH_ASSOC);
                        $data = sanitize($result);
                        $_SESSION['pA_fM' . $u] = $data;
                    }
                }

                $sql = $pdo->query("SELECT * FROM tbl_applications WHERE (Status = 'Approved' OR Status = 'Rejected') AND is_deleted = 0");
                $result = $sql->fetchAll();
                $data = sanitize($result);
                $_SESSION['hA'] = $data;
                foreach ($data as $d) {
                    $aid = $d['Application_ID'] ?? "";
                    $rep = $d['Representative'] ?? "";
                    $as = $d['Assistance_ID'] ?? "";
                    $a = $d['Account_ID'] ?? "";
                    $sv = $d['Severity'] ?? "";
                    $files = explode(", ", $d['Files']) ?? "";

                    $sql = $pdo->prepare("SELECT Family_Name FROM tbl_family WHERE Account_ID = :a");
                    $sql->bindParam(":a", $a, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data = sanitize($result);
                    $_SESSION['hA_fN' . $a] = $data['Family_Name'];

                    $sql = $pdo->prepare("SELECT First_Name, Middle_Name, Last_Name FROM tbl_family_member WHERE User_ID = :u");
                    $sql->bindParam(":u", $rep, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data = sanitize($result);
                    $_SESSION['hA_name' . $aid] = $data;

                    $sql = $pdo->prepare("SELECT Assistance_Name FROM tbl_assistance WHERE Assistance_ID = :a");
                    $sql->bindParam(":a", $as, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data = sanitize($result);
                    $_SESSION['hA_as' . $aid] = $data['Assistance_Name'];

                    $sql = $pdo->prepare("SELECT Criteria FROM tbl_rates WHERE Rate_ID = :r");
                    $sql->bindParam(":r", $sv, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data = sanitize($result);
                    $_SESSION['hA_sv' . $sv] = $data['Criteria'];

                    $sql = $pdo->prepare("SELECT * FROM tbl_Address WHERE Account_ID = :a");
                    $sql->bindParam(":a", $a, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data = sanitize($result);
                    $_SESSION['hA_add' . $aid] = $data;

                    for ($i = 0; $i < count($files); ++$i) {
                        $sql = $pdo->prepare("SELECT Requirement_ID, File_Name FROM tbl_files WHERE File_ID = :f");
                        $sql->bindParam(":f", $files[$i], PDO::PARAM_INT);
                        $sql->execute();
                        $result = $sql->fetch(PDO::FETCH_ASSOC);
                        $data = sanitize($result);
                        $_SESSION['file' . $i . $aid] = $data['File_Name'] ?? "";

                        $sql = $pdo->prepare("SELECT Description FROM tbl_requirements WHERE Requirement_ID = :r");
                        $sql->bindParam(":r", $data['Requirement_ID'], PDO::PARAM_INT);
                        $sql->execute();
                        $result = $sql->fetch(PDO::FETCH_ASSOC);
                        $data = sanitize($result);
                        $_SESSION['desc' . $i . $aid] = $data['Description'] ?? "";
                    }

                    $sql = $pdo->prepare("SELECT User_ID FROM tbl_family_composition WHERE Account_ID = :a");
                    $sql->bindParam(":a", $a, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetchAll();
                    $data = sanitize($result);
                    $_SESSION['hA_fC' . $a] = $data;

                    foreach ($data as $d) {
                        $u = $d['User_ID'] ?? "";

                        $sql = $pdo->prepare("SELECT * FROM tbl_family_member WHERE User_ID = :u");
                        $sql->bindParam(":u", $u, PDO::PARAM_INT);
                        $sql->execute();
                        $result = $sql->fetch(PDO::FETCH_ASSOC);
                        $data = sanitize($result);
                        $_SESSION['hA_fM' . $u] = $data;
                    }

                    $sql = $pdo->query("SELECT * FROM tbl_applications");
                    $_SESSION['tApp'] = $sql->rowCount() ?? 0;
                    $sql = $pdo->query("SELECT * FROM tbl_applications WHERE Status = 'Pending'");
                    $_SESSION['tPApp'] = $sql->rowCount() ?? 0;
                    $sql = $pdo->query("SELECT * FROM tbl_applications WHERE Status = 'Approved'");
                    $_SESSION['tAApp'] = $sql->rowCount() ?? 0;
                    $sql = $pdo->query("SELECT * FROM tbl_applications WHERE Status = 'Rejected'");
                    $_SESSION['tRApp'] = $sql->rowCount() ?? 0;
                }

                $sql = $pdo->query("SELECT * FROM tbl_budget");
                $result = $sql->fetchAll();
                $data = sanitize($result);
                $_SESSION['budgetTable'] = $data ?? "";
                foreach ($data as $d) {
                    $as = $d['Assistance_ID'] ?? "";

                    $sql = $pdo->prepare("SELECT Assistance_Name FROM tbl_assistance WHERE Assistance_ID = :a");
                    $sql->bindParam(":a", $as, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data =sanitize($result);
                    $_SESSION['AsName'.$as] = $data['Assistance_Name'] ?? "";
                }

                $sql = $pdo->query("SELECT * FROM tbl_assistance");
                $result = $sql->fetchAll();
                $data = sanitize($result);
                $_SESSION['allAssistance'] = $data ?? "";

                $sql = $pdo->query("SELECT * FROM tbl_documents");
                $result = $sql->fetchAll();
                $data = sanitize($result);
                $_SESSION['allDocuments'] = $data ?? "";

                $sql = $pdo->query("SELECT * FROM tbl_requirements");
                $result = $sql->fetchAll();
                $data = sanitize($result);
                $_SESSION['allRequirements'] = $data ?? "";
                
                $sql = $pdo->query("SELECT * FROM tbl_availability");
                $result = $sql->fetchAll();
                $data = sanitize($result);
                $_SESSION['allAvailability'] = $data ?? "";
                
                $sql = $pdo->query("SELECT * FROM tbl_rates");
                $result = $sql->fetchAll();
                $data = sanitize($result);
                $_SESSION['allRates'] = $data ?? "";
                
                $sql = $pdo->query("SELECT * FROM tbl_accounts");
                $result = $sql->fetchAll();
                $data = sanitize($result);
                $_SESSION['allAccounts'] = $data ?? "";

            } else {
                header('Location: ../Functions/PHP/logout.php');
                exit;
            }
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    } else {
        header('Location: ../Functions/PHP/logout.php');
        exit;
    }
} else {
    header('Location: ../Functions/PHP/logout.php');
    exit;
}
?>