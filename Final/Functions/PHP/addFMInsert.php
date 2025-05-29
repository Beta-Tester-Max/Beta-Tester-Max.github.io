<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['addFamilyMember'])) {
    $a = $_SESSION['Account_ID'];
    $f = $_SESSION['Family_ID'];

    try {
        $pdo->beginTransaction();

        if (isset($_POST['count']) && !empty($_POST['count'])) {
            $count = isset($_POST['count']) ? (int) $_POST['count'] : 0;

            for ($i = 1; $i <= $count; ++$i) {
                $fn = $_POST['fN' . $i] ?? "";
                $mn = $_POST['mN' . $i] ?? "";
                $ln = $_POST['lN' . $i] ?? "";
                $e = filter_var(trim($_POST['e' . $i]), FILTER_SANITIZE_EMAIL) ?? "";
                $pn = $_POST['pN' . $i] ?? "";
                $bd = $_POST['bD' . $i] ?? "";
                $s = $_POST['s' . $i] ?? "";
                $cs = $_POST['cS' . $i ?? ""];
                $ea = $_POST['eA' . $i ?? ""];
                $o = $_POST['o' . $i ?? ""];
                $isd = intval(trim($_POST['iD' . $i])) ?? "";

                if (empty($fn)) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "Missing First Name!";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (strlen($fn) > 50) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$fn: exceeds 50 characters.";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (strlen(trim($fn)) < 2) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$fn: shorter than 2 characters! Space not included.";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (!empty($mn) && strlen($mn) > 50) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$mn: exceeds 50 characters.";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (!empty($mn) && strlen(trim($mn)) < 2) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$mn: shorter than 2 characters! Space not included.";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (empty($ln)) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "Missing Last Name!";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (strlen($ln) > 50) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$ln: exceeds 50 characters.";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (strlen(trim($ln)) < 2) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$ln: shorter than 2 characters! Space not included.";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (!empty($e) && strlen($e) > 50) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$e: exceeds 50 characters.";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (!empty($e) && strlen($e) < 3) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$e: shorter than 3 characters! Space not included.";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (!empty($e) && !filter_var($e, FILTER_VALIDATE_EMAIL)) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$e: Invalid Email";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (!empty($pn) && strlen($pn) > 13) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$pn: exceeds 13 characters. Proper Format: 0XXX=XXX=XXXX";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (!empty($pn) && strlen($pn) < 13) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$pn: shorter than 13 characters! Space not included. Proper Format: 0XXX=XXX=XXXX";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (!empty($pn) && !preg_match('/^0[89][1-9]{2}-[1-9]{3}-[1-9]{4}$/', $pn)) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$pn: Wrong Phone Number Format! Proper Format: 0XXX=XXX=XXXX";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (empty($bd)) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "Missing Birth Day!";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $bd)) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "Wrong Date Format! Proper Format: MM/DD/YYYY";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (empty($s)) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "Missing Sex!";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (strlen($s) !== 1) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$s: must be 1 character only.";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif ($s !== 'm' && $s !== 'f') {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$s: Invalid Value.";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (empty($cs)) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "Missing Civil Status!";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (strlen($cs) > 50) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$cs: exceeds 50 characters.";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (strlen(trim($cs)) < 3) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$cs: shorter than 3 characters! Space not included.";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (!empty($ea) && strlen($ea) > 50) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$ea: exceeds 50 characters.";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (!empty($ea) && strlen($ea) < 3) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$ea: shorter than 3 characters! Space not included.";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (!empty($o) && strlen($o) > 50) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$o: exceeds 50 characters.";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (!empty($o) && strlen($o) < 3) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$o: shorter than 3 characters! Space not included.";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (!empty($isd) && strlen(strval($isd)) !== 1) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$s: must be 1 character only.";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } elseif (!empty($isd) && $isd !== 1 && $s !== 0) {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "$s: Invalid Value.";
                    $_SESSION['Path'] = "../../setProfile.php";

                    header('Location: ../../index.php');
                    exit;
                } else {

                    $sql = $pdo->prepare("INSERT INTO tbl_family_member (First_Name, Middle_Name, Last_Name, Email, Phone_Number, Birth_Day, Sex, Civil_Status, Educational_Attainment, Occupation, is_deceased)
                                VALUES (:fn, :mn, :ln, :e, :pn, :bd, :s, :cs, :ea, :o, :isd)");
                    $sql->bindParam(":fn", $fn, PDO::PARAM_STR);
                    $sql->bindParam(":mn", $mn, PDO::PARAM_STR);
                    $sql->bindParam(":ln", $ln, PDO::PARAM_STR);
                    $sql->bindParam(":e", $e, PDO::PARAM_STR);
                    $sql->bindParam(":pn", $pn, PDO::PARAM_STR);
                    $sql->bindParam(":bd", $bd, PDO::PARAM_STR);
                    $sql->bindParam(":s", $s, PDO::PARAM_STR);
                    $sql->bindParam(":cs", $cs, PDO::PARAM_STR);
                    $sql->bindParam(":ea", $ea, PDO::PARAM_STR);
                    $sql->bindParam(":o", $o, PDO::PARAM_STR);
                    $sql->bindParam(":isd", $isd, PDO::PARAM_INT);
                    if ($sql->execute()) {
                        $uid = $pdo->lastInsertId();

                        $sql = $pdo->prepare("INSERT INTO tbl_family_composition (Account_ID, Family_ID, User_ID)
                                    VALUES (:a, :fid, :uid)");
                        $sql->bindParam(":a", $a, PDO::PARAM_INT);
                        $sql->bindParam(":fid", $f, PDO::PARAM_INT);
                        $sql->bindParam(":uid", $uid, PDO::PARAM_INT);

                        if ($sql->execute()) {
                            $lastCount = $i;
                        } else {
                            $pdo->rollBack();

                            $_SESSION['Alert'] = "Error Inserting Family Composition.";
                            $_SESSION['Path'] = "../../setProfile.php";

                            header('Location: ../../index.php');
                            exit;
                        }
                    } else {
                        $pdo->rollBack();

                        $_SESSION['Alert'] = "Error Inserting User Info.";
                        $_SESSION['Path'] = "../../setProfile.php";

                        header('Location: ../../index.php');
                        exit;
                    }
                }
            }
            if ($lastCount === $count) {
                $pdo->commit();

                $_SESSION['Alert'] = "Family Member/s has been added Successfully!";
                $_SESSION['Path'] = "../../profile.php";

                header('Location: ../../index.php');
                exit;
            } else {
                $pdo->rollBack();

                $_SESSION['Alert'] = "Error Tracking End Loop.";
                $_SESSION['Path'] = "../../setProfile.php";

                header('Location: ../../index.php');
                exit;
            }
        } else {
            $pdo->rollBack();

            $_SESSION['Alert'] = "Count is not set.";
            $_SESSION['Path'] = "../../setProfile.php";

            header('Location: ../../index.php');
            exit;
        }
    } catch (PDOException $e) {
        $pdo->rollBack();

        $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
        $_SESSION['Path'] = "../../setProfile.php";

        header('Location: ../../index.php');
        exit;
    }
} else {
    header('Location: ../../index.php');
    exit;
}
?>