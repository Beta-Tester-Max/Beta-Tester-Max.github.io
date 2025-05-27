<?php
require_once "connect.php";

if (isset($_SESSION['access']) && !empty($_SESSION['access']) && $_SESSION['access'] === 1) {
    if (isset($_SESSION['Admin_ID']) && !empty($_SESSION['Admin_ID'])) {
        $a = $_SESSION['Admin_ID'] ?? "";

        try {

            $sql = $pdo->prepare("SELECT * FROM tbl_admin_token WHERE Token_ID = :t");
            $sql->bindParam(":t", $a, PDO::PARAM_INT);
            $sql->execute();

            if ($sql->rowCount() === 1) {


                $sql = $pdo->query("SELECT * FROM tbl_applications WHERE Status = 'Pending' AND is_deleted = 0");
                $result = $sql->fetchAll();
                $data = sanitize($result);
                $_SESSION['pA'] = $data;
                foreach ($data as $d) {
                    $aid = $d['Application_ID'] ?? "";
                    $rep = $d['Representative'] ?? "";
                    $as = $d['Assistance_ID'] ?? "";
                    $a = $d['Account_ID'] ?? "";
                    $files = explode(", ", $d['Files']) ?? "";

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

                    $sql = $pdo->prepare("SELECT * FROM tbl_Address WHERE Account_ID = :a");
                    $sql->bindParam(":a", $a, PDO::PARAM_INT);
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $data = sanitize($result);
                    $_SESSION['pA_add' . $aid] = $data;

                    for ($i = 0; $i < count($files); ++$i) {
                        $sql = $pdo->prepare("SELECT File_Name FROM tbl_files WHERE File_ID = :f");
                        $sql->bindParam(":f", $files[$i], PDO::PARAM_INT);
                        $sql->execute();
                        $result = $sql->fetch(PDO::FETCH_ASSOC);
                        $data = sanitize($result);
                        $_SESSION['file'.$i.$aid] = $data['File_Name'] ?? "";
                    }
                }
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