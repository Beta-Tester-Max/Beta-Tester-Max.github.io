<?php
require_once "connect.php";
session_start();

if (isset($_POST['setProfile'])) {
    $a = $_SESSION['Account_ID'];
    $fn = $_POST['fN'];
    $hn = $_POST['hN'];
    $sn = $_POST['s'];
    $b = $_POST['b'];
    $com = $_POST['c'];
    $p = $_POST['p'];
    $r = $_POST['r'];
    $zc = $_POST['zC'];

    try {
        $pdo->beginTransaction();

        $sql = $pdo->prepare("INSERT INTO tbl_address (Account_ID, House_Number, Street_Name, Barangay, City_or_Municipality, Province, Region, Zip_Code)
        VALUES (:a, :hn, :sn, :b, :com, :p, :r, :zc)");
        $sql->bindParam(":a", $a, PDO::PARAM_INT);
        $sql->bindParam(":hn", $hn, PDO::PARAM_INT);
        $sql->bindParam(":sn", $sn, PDO::PARAM_STR);
        $sql->bindParam(":b", $b, PDO::PARAM_STR);
        $sql->bindParam(":com", $com, PDO::PARAM_STR);
        $sql->bindParam(":p", $p, PDO::PARAM_STR);
        $sql->bindParam(":r", $r, PDO::PARAM_STR);
        $sql->bindParam(":zc", $zc, PDO::PARAM_INT);

        if ($sql->execute()) {
            $sql = $pdo->prepare("INSERT INTO tbl_family (Account_ID, Family_Name)
            VALUES (:a, :fn)");
            $sql->bindParam(":a", $a, PDO::PARAM_INT);
            $sql->bindParam(":fn", $fn, PDO::PARAM_STR);

            if ($sql->execute()) {
                $fid = $pdo->lastInsertId();

                if (isset($_POST['count']) && !empty($_POST['count'])) {
                    $count = isset($_POST['count']) ? (int) $_POST['count'] : 0;

                    for ($i = 1; $i <= $count; ++$i) {
                        $fn = $_POST['fN' . $i] ?? "";
                        $mn = $_POST['mN' . $i] ?? "";
                        $ln = $_POST['lN' . $i] ?? "";
                        $e = $_POST['e' . $i] ?? "";
                        $pn = $_POST['pN' . $i] ?? "";
                        $bd = $_POST['bD' . $i] ?? "";
                        $s = $_POST['s' . $i] ?? "";
                        $cs = $_POST['cS' . $i ?? ""];
                        $ea = $_POST['eA' . $i ?? ""];
                        $o = $_POST['o' . $i ?? ""];
                        $isd = intval($_POST['iD' . $i]) ?? "";

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
                    if ($lastCount === $count) {
                        $pdo->commit();

                        $_SESSION['Alert'] = "Account Information has been Set Successfully!";
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
            } else {
                $pdo->rollBack();

                $_SESSION['Alert'] = "Error Inserting Family Name.";
                $_SESSION['Path'] = "../../setProfile.php";

                header('Location: ../../index.php');
                exit;
            }
        } else {
            $pdo->rollBack();

            $_SESSION['Alert'] = "Error Inserting Address.";
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