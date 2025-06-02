<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['setProfile'])) {
    $a = $_SESSION['Account_ID'] ?? "";
    $fn = $_POST['fN'] ?? "";
    $hn = intval(trim($_POST['hN'])) ?? "";
    $sn = $_POST['s'] ?? "";
    $b = $_POST['b'] ?? "";
    $c = $_POST['c'] ?? "";
    $p = $_POST['p'] ?? "";
    $r = $_POST['r'] ?? "";
    $zc = intval(trim($_POST['zC'])) ?? "";

    if (empty($a)) {
        $_SESSION['Alert'] = "Missing Account ID!";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (empty($fn)) {
        $_SESSION['Alert'] = "Missing Family Name!";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (strlen($fn) > 50) {
        $_SESSION['Alert'] = "Family Name must not exceed 50 characters.";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (strlen(trim($fn)) < 3) {
        $_SESSION['Alert'] = "Family Name must not be shorter than 3 characters! Space not included.";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (empty($hn)) {
        $_SESSION['Alert'] = "Missing House Number!";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (strlen(strval($hn)) > 4) {
        $_SESSION['Alert'] = "House Number must not exceed 4 digits.";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (strlen(strval($hn)) < 1) {
        $_SESSION['Alert'] = "House Number must not be less than 1 digit! Space not included.";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (!preg_match('/^\d+$/', strval($hn))) {
        $_SESSION['Alert'] = "Missing House Number!";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (empty($sn)) {
        $_SESSION['Alert'] = "Missing Street Name!";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (strlen($sn) > 50) {
        $_SESSION['Alert'] = "Street Name must not exceed 50 characters.";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (strlen(trim($sn)) < 3) {
        $_SESSION['Alert'] = "Street Name must not be shorter than 3 characters! Space not included.";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (empty($b)) {
        $_SESSION['Alert'] = "Missing Barangay!";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (strlen($b) > 50) {
        $_SESSION['Alert'] = "Barangay must not exceed 50 characters.";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (strlen(trim($b)) < 3) {
        $_SESSION['Alert'] = "Barangay must not be shorter than 3 characters! Space not included.";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (empty($c)) {
        $_SESSION['Alert'] = "Missing City or Municipality!";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (strlen($c) > 50) {
        $_SESSION['Alert'] = "City or Municipality must not exceed 50 characters.";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (strlen(trim($c)) < 3) {
        $_SESSION['Alert'] = "City or Municipality must not be shorter than 3 characters! Space not included.";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (empty($p)) {
        $_SESSION['Alert'] = "Missing Province!";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (strlen($p) > 50) {
        $_SESSION['Alert'] = "Province must not exceed 50 characters.";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (strlen(trim($p)) < 3) {
        $_SESSION['Alert'] = "Province must not be shorter than 3 characters! Space not included.";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (empty($r)) {
        $_SESSION['Alert'] = "Missing Region!";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (strlen($r) > 50) {
        $_SESSION['Alert'] = "Region must not exceed 50 characters.";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (strlen(trim($r)) < 1) {
        $_SESSION['Alert'] = "Region must be atleast 1 character! Space not included.";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (empty($zc)) {
        $_SESSION['Alert'] = "Missing House Number!";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (strlen(strval($zc)) > 4) {
        $_SESSION['Alert'] = "House Number must not exceed 4 digits.";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (strlen(strval($zc)) < 1) {
        $_SESSION['Alert'] = "House Number must not be less than 1 digit! Space not included.";
        header('Location: ../../setProfile.php');
        exit;
    } elseif (!preg_match('/^\d+$/', strval($zc))) {
        $_SESSION['Alert'] = "Missing House Number!";
        header('Location: ../../setProfile.php');
        exit;
    } else {

        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("INSERT INTO tbl_address (Account_ID, House_Number, Street_Name, Barangay, City_or_Municipality, Province, Region, Zip_Code)
            VALUES (:a, :hn, :sn, :b, :com, :p, :r, :zc)");
            $sql->bindParam(":a", $a, PDO::PARAM_INT);
            $sql->bindParam(":hn", $hn, PDO::PARAM_INT);
            $sql->bindParam(":sn", $sn, PDO::PARAM_STR);
            $sql->bindParam(":b", $b, PDO::PARAM_STR);
            $sql->bindParam(":com", $c, PDO::PARAM_STR);
            $sql->bindParam(":p", $p, PDO::PARAM_STR);
            $sql->bindParam(":r", $r, PDO::PARAM_STR);
            $sql->bindParam(":zc", $zc, PDO::PARAM_INT);

            if ($sql->execute()) {

                $sql = $pdo->prepare("INSERT INTO tbl_family (Account_ID, Family_Name)
                VALUES (:a, :fn)");
                $sql->bindParam(":a", $a, PDO::PARAM_INT);
                $sql->bindParam(":fn", $fn, PDO::PARAM_STR);

                if ($sql->execute()) {

                    if (isset($_POST['count']) && !empty($_POST['count'])) {
                        $fid = $pdo->lastInsertId();
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
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (strlen($fn) > 50) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$fn: exceeds 50 characters.";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (strlen(trim($fn)) < 2) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$fn: shorter than 2 characters! Space not included.";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (!empty($mn) && strlen($mn) > 50) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$mn: exceeds 50 characters.";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (!empty($mn) && strlen(trim($mn)) < 2) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$mn: shorter than 2 characters! Space not included.";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (empty($ln)) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "Missing Last Name!";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (strlen($ln) > 50) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$ln: exceeds 50 characters.";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (strlen(trim($ln)) < 2) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$ln: shorter than 2 characters! Space not included.";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (!empty($e) && strlen($e) > 50) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$e: exceeds 50 characters.";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (!empty($e) && strlen($e) < 3) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$e: shorter than 3 characters! Space not included.";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (!empty($e) && !filter_var($e, FILTER_VALIDATE_EMAIL)) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$e: Invalid Email";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (!empty($pn) && strlen($pn) > 13) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$pn: exceeds 13 characters. Proper Format: 0XXX=XXX=XXXX";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (!empty($pn) && strlen($pn) < 13) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$pn: shorter than 13 characters! Space not included. Proper Format: 0XXX=XXX=XXXX";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (!empty($pn) && !preg_match('/^0[89][1-9]{2}-[1-9]{3}-[1-9]{4}$/', $pn)) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$pn: Wrong Phone Number Format! Proper Format: 0XXX=XXX=XXXX";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (empty($bd)) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "Missing Birth Day!";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $bd)) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "Wrong Date Format! Proper Format: MM/DD/YYYY";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (empty($s)) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "Missing Sex!";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (strlen($s) !== 1) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$s: must be 1 character only.";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif ($s !== 'm' && $s !== 'f') {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$s: Invalid Value.";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (empty($cs)) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "Missing Civil Status!";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (strlen($cs) > 50) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$cs: exceeds 50 characters.";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (strlen(trim($cs)) < 3) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$cs: shorter than 3 characters! Space not included.";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (!empty($ea) && strlen($ea) > 50) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$ea: exceeds 50 characters.";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (!empty($ea) && strlen($ea) < 3) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$ea: shorter than 3 characters! Space not included.";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (!empty($o) && strlen($o) > 50) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$o: exceeds 50 characters.";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (!empty($o) && strlen($o) < 3) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$o: shorter than 3 characters! Space not included.";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (!empty($isd) && strlen(strval($isd)) !== 1) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$s: must be 1 character only.";
                                header('Location: ../../setProfile.php');
                                exit;
                            } elseif (!empty($isd) && $isd !== 1 && $s !== 0) {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "$s: Invalid Value.";
                                header('Location: ../../setProfile.php');
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
                                    $sql->bindParam(":fid", $fid, PDO::PARAM_INT);
                                    $sql->bindParam(":uid", $uid, PDO::PARAM_INT);

                                    if ($sql->execute()) {
                                        $lastCount = $i;
                                    } else {
                                        $pdo->rollBack();

                                        $_SESSION['Alert'] = "Error Inserting Family Composition.";
                                        header('Location: ../../setProfile.php');
                                        exit;
                                    }
                                } else {
                                    $pdo->rollBack();

                                    $_SESSION['Alert'] = "Error Inserting User Info.";
                                    header('Location: ../../setProfile.php');
                                    exit;
                                }
                            }
                        }
                        if ($lastCount === $count) {
                            $ac = "has set their Family Name and Address. and added $count family member/s.";

                            $sql = $pdo->prepare("INSERT INTO tbl_user_logs (Account_ID, Action)
                            VALUES (:a, :ac)");
                            $sql->bindParam(":a", $a, PDO::PARAM_INT);
                            $sql->bindParam(":ac", $ac, PDO::PARAM_STR);

                            if ($sql->execute()) {
                                $pdo->commit();

                                $_SESSION['Alert'] = "Account Information has been Set Successfully!";
                                header('Location: ../../profile.php');
                                exit;
                            } else {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "Error Logging Activity.";
                                header('Location: ../../setProfile.php');
                                exit;
                            }
                        } else {
                            $pdo->rollBack();

                            $_SESSION['Alert'] = "Error Tracking End Loop.";
                            header('Location: ../../setProfile.php');
                            exit;
                        }
                    } else {
                        $ac = "has set their Family Name and Address.";

                        $sql = $pdo->prepare("INSERT INTO tbl_user_logs (Account_ID, Action)
                            VALUES (:a, :ac)");
                        $sql->bindParam(":a", $a, PDO::PARAM_INT);
                        $sql->bindParam(":ac", $ac, PDO::PARAM_STR);

                        if ($sql->execute()) {
                            $pdo->commit();

                            $_SESSION['Alert'] = "Account Information has been Set Successfully!";
                            header('Location: ../../profile.php');
                            exit;
                        } else {
                            $pdo->rollBack();

                            $_SESSION['Alert'] = "Error Logging Activity.";
                            header('Location: ../../setProfile.php');
                            exit;
                        }
                    }
                } else {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "Error Inserting Family Name.";
                    header('Location: ../../setProfile.php');
                    exit;
                }
            } else {
                $pdo->rollBack();

                $_SESSION['Alert'] = "Error Inserting Address.";
                header('Location: ../../setProfile.php');
                exit;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();

            $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
            header('Location: ../../setProfile.php');
            exit;
        }
    }
} else {
    header('Location: ../../index.php');
    exit;
}
?>