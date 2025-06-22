<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['formII'])) {
    $id = cleanInt(intval($_SESSION['csID'] ?? ""));

    if (empty($id)) {
        $_SESSION['alert'] = "Missing ID!";
        header('Location: ../../Form_II/');
        exit;
    } elseif (strlen(strval($id)) > 11) {
        $_SESSION['alert'] = "Invaid ID Length.";
        header('Location: ../../Form_II/');
        exit;
    } else {

        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("SELECT r FROM tbl_cs WHERE id = :1");
            $sql->bindParam(":1", $id, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $rid = $result['r'] ?? "";

            if (empty($rid)) {
                $_SESSION['alert'] = "Missing Recipient ID!";
                header('Location: ../../Form_II/');
                exit;
            } elseif (strlen(strval($rid)) > 5) {
                $_SESSION['alert'] = "Invaid Recipient ID Length.";
                header('Location: ../../Form_II/');
                exit;
            } else {

                if (isset($_POST['count']) && !empty($_POST['count'])) {
                    $count = cleanInt($_POST['count'] ?? "");

                    for ($i = 1; $i <= $count; ++$i) {
                        $fn = strval($_POST['fname' . $i] ?? "");
                        $mn = strval($_POST['mname' . $i] ?? "");
                        $ln = strval($_POST['lname' . $i] ?? "");
                        $rel = strval($_POST['relation' . $i] ?? "");
                        $db = $_POST['bday' . $i] ?? "";
                        $sx = cleanStr(strval($_POST['sx' . $i] ?? ""));
                        $cs = cleanStr(strval($_POST['civStat' . $i] ?? ""));
                        $ea = cleanStr(strval($_POST['educAtt' . $i] ?? ""));
                        $o = strval($_POST['occupation' . $i] ?? "");

                        if (empty($fn)) {
                            $_SESSION['alert'] = "Missing First Name! Family Member No.$i";
                            header('Location: ../../Form_I/');
                            exit;
                        } elseif (strlen(cleanStr($fn)) < 2 || strlen(cleanStr($fn)) > 50) {
                            $_SESSION['alert'] = "First Name must have 2-50 characters. Family Member No.$i";
                            header('Location: ../../Form_I/');
                            exit;
                        } elseif (strlen(cleanStr($mn)) > 50) {
                            $_SESSION['alert'] = "Middle Name must not exceed 50 characters. Family Member No.$i";
                            header('Location: ../../Form_I/');
                            exit;
                        } elseif (empty($ln)) {
                            $_SESSION['alert'] = "Missing Last Name! Family Member No.$i";
                            header('Location: ../../Form_I/');
                            exit;
                        } elseif (strlen(cleanStr($ln)) < 2 || strlen(cleanStr($ln)) > 50) {
                            $_SESSION['alert'] = "Last Name must have 2-50 characters. Family Member No.$i";
                            header('Location: ../../Form_I/');
                            exit;
                        } elseif (empty($rel)) {
                            $_SESSION['alert'] = "Missing Relation! Family Member No.$i";
                            header('Location: ../../Form_I/');
                            exit;
                        } elseif (strlen($rel) > 5) {
                            $_SESSION['alert'] = "Relation must not exceed 5 characters. Family Member No.$i";
                            header('Location: ../../Form_I/');
                            exit;
                        } elseif (empty($db)) {
                            $_SESSION['alert'] = "Missing Birth Date! Family Member No.$i";
                            header('Location: ../../Form_I/');
                            exit;
                        } elseif (!validateDate($db)) {
                            $_SESSION['alert'] = "Invalid Date Format! Family Member No.$i";
                            header('Location: ../../Form_I/');
                            exit;
                        } elseif (empty($sx)) {
                            $_SESSION['alert'] = "Missing Sex! Family Member No.$i";
                            header('Location: ../../Form_I/');
                            exit;
                        } elseif (strlen($sx) > 5) {
                            $_SESSION['alert'] = "Sex must not exceed 5 characters. Family Member No.$i";
                            header('Location: ../../Form_I/');
                            exit;
                        } elseif (empty($cs)) {
                            $_SESSION['alert'] = "Missing Civil Status! Family Member No.$i";
                            header('Location: ../../Form_I/');
                            exit;
                        } elseif (strlen($cs) > 5) {
                            $_SESSION['alert'] = "Civil Status must not exceed 5 chatacters. Family Member No.$i";
                            header('Location: ../../Form_I/');
                            exit;
                        } elseif (!empty($ea) && strlen($ea) > 5) {
                            $_SESSION['alert'] = "Educational Attainment must not exceed 5 chatacters. Family Member No.$i";
                            header('Location: ../../Form_I/');
                            exit;
                        } elseif (!empty($o) && strlen($o) > 50) {
                            $_SESSION['alert'] = "Occupation must not exceed 50 characters. Family Member No.$i";
                            header('Location: ../../Form_I/');
                            exit;
                        } else {
                            $sql = $pdo->prepare("INSERT INTO tbl_c (fN, mN, lN, dB, s, cS, eA, o)
                            VALUES (:1, :2, :3, :4, :5, :6, :7, :8)");
                            $sql->bindParam(":1", $fn, PDO::PARAM_STR);
                            $sql->bindParam(":2", $mn, PDO::PARAM_STR);
                            $sql->bindParam(":3", $ln, PDO::PARAM_STR);
                            $sql->bindParam(":4", $db, PDO::PARAM_STR);
                            $sql->bindParam(":5", $sx, PDO::PARAM_STR);
                            $sql->bindParam(":6", $cs, PDO::PARAM_STR);
                            $sql->bindParam(":7", $ea, PDO::PARAM_STR);
                            $sql->bindParam(":8", $o, PDO::PARAM_STR);

                            if ($sql->execute()) {
                                $fmid = $pdo->lastInsertId();

                                $sql = $pdo->prepare("INSERT INTO tbl_rel (findiv, sindiv, relation)
                                VALUES (:1, :2, :3)");
                                $sql->bindParam(":1", $rid, PDO::PARAM_INT);
                                $sql->bindParam(":2", $fmid, PDO::PARAM_INT);
                                $sql->bindParam(":3", $rel, PDO::PARAM_STR);

                                if ($sql->execute()) {

                                    $sql = $pdo->prepare("UPDATE tbl_cs
                                    SET form_II = 1
                                    WHERE id = :1");
                                    $sql->bindParam(":1", $id, PDO::PARAM_INT);

                                    if ($sql->execute()) {
                                        $lastCount = $i;
                                    } else {
                                        $pdo->rollBack();
                                        $_SESSION['alert'] = "Error Inserting Case Study Info";
                                        header('Location: ../../Form_I/');
                                        exit;
                                    }
                                } else {
                                    $pdo->rollBack();
                                    $_SESSION['alert'] = "Error Inserting Relationships";
                                    header('Location: ../../Form_I/');
                                    exit;
                                }
                            } else {
                                $pdo->rollBack();
                                $_SESSION['alert'] = "Error Inserting User Info";
                                header('Location: ../../Form_I/');
                                exit;
                            }
                        }
                    } // ---------------------------------------------------------------------------------------->>>>
                    if ($lastCount === $count) {
                        $pdo->commit();
                        $_SESSION['alert'] = "Form II Worked";
                        header('Location: ../../Form_II/');
                        exit;
                    }
                } else {
                    $pdo->rollBack();
                    $_SESSION['alert'] = "Missing Count!";
                    header('Location: ../../Form_II/');
                    exit;
                }
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            $_SESSION['alert'] = "Connection Error: " . $e->getMessage();
            header('Location: ../../Form_II/');
            exit;
        }
    }
} else {
    header('Location: include/logout.php');
    exit;
}
?>