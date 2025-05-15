<?php
require_once "connect.php";
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
                $e = $_POST['e' . $i] ?? "";
                $pn = $_POST['pN' . $i] ?? "";
                $bd = $_POST['bD' . $i] ?? "";
                $s = $_POST['s' . $i] ?? "";
                $cs = $_POST['cS' . $i ?? ""];
                $ea = $_POST['eA' . $i ?? ""];
                $o = $_POST['o' . $i ?? ""];
                $isd = intval($_POST['iD' . $i]) ?? "";

                $sql = $pdo->prepare("SELECT * FROM tbl_accounts WHERE Email = :e");
                $sql->bindParam(":e", $e, PDO::PARAM_STR);
                $sql->execute();

                if ($sql->rowCount() === 0) {

                    $sql = $pdo->prepare("SELECT * FROM tbl_family_member WHERE Email = :e");
                    $sql->bindParam(":e", $e, PDO::PARAM_STR);
                    $sql->execute();

                    if ($sql->rowCount() === 0) {

                        $sql = $pdo->prepare("SELECT * FROM tbl_family_member WHERE Phone_Number = :pn");
                        $sql->bindParam(":pn", $pn, PDO::PARAM_STR);
                        $sql->execute();

                        if ($sql->rowCount() === 0) {

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
                                $u = $pdo->lastInsertId();

                                $sql = $pdo->prepare("INSERT INTO tbl_family_composition (Account_ID, Family_ID, User_ID)
                                VALUES (:a, :f, :u)");
                                $sql->bindParam(":a", $a, PDO::PARAM_INT);
                                $sql->bindParam(":f", $f, PDO::PARAM_INT);
                                $sql->bindParam(":u", $u, PDO::PARAM_INT);

                                if ($sql->execute()) {
                                    $lastCount = $i;
                                } else {
                                    $pdo->rollBack();

                                    $_SESSION['Alert'] = "Error Inserting Family Composition.";
                                    $_SESSION['Path'] = "../../familyMember.php";

                                    header('Location: ../../index.php');
                                    exit;
                                }
                            } else {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "Error Inserting User Info.";
                                $_SESSION['Path'] = "../../familyMember.php";

                                header('Location: ../../index.php');
                                exit;
                            }
                        } else {
                            $pdo->rollBack();

                            $_SESSION['Alert'] = "Phone Number Already Exists!";
                            $_SESSION['Path'] = "../../familyMember.php";

                            header('Location: ../../index.php');
                            exit;
                        }
                    } else {
                        $pdo->rollBack();

                        $_SESSION['Alert'] = "Email Already Exists!";
                        $_SESSION['Path'] = "../../familyMember.php";

                        header('Location: ../../index.php');
                        exit;
                    }
                } else {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "Email Already Exists!";
                    $_SESSION['Path'] = "../../familyMember.php";

                    header('Location: ../../index.php');
                    exit;
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
                $_SESSION['Path'] = "../../familyMember.php";

                header('Location: ../../index.php');
                exit;
            }
        } else {
            $pdo->rollBack();

            $_SESSION['Alert'] = "Count is not set.";
            $_SESSION['Path'] = "../../familyMember.php";

            header('Location: ../../index.php');
            exit;
        }
    } catch (PDOException $e) {
        $pdo->rollBack();

        $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
        $_SESSION['Path'] = "../../familyMember.php";

        header('Location: ../../index.php');
        exit;
    }
} else {
    header('Location: ../../index.php');
    exit;
}
?>