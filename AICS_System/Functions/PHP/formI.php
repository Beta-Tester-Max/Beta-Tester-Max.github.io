<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['formI'])) {
    $fn = strval($_POST['fname'] ?? "");
    $mn = strval($_POST['mname'] ?? "");
    $ln = strval($_POST['lname'] ?? "");
    $db = $_POST['bday'] ?? "";
    $sx = cleanStr(strval($_POST['sx'] ?? ""));
    $cs = cleanStr(strval($_POST['civStat'] ?? ""));
    $ea = cleanStr(strval($_POST['educAtt'] ?? ""));
    $o = strval($_POST['occupation'] ?? "");
    $b = cleanStr(strval($_POST['barangay'] ?? ""));
    $cn = cleanStr(strval($_POST['contactno'] ?? ""));
    $id = cleanInt(intval($_SESSION['csID'] ?? ""));

    if (empty($fn)) {
        $_SESSION['alert'] = "Missing First Name!";
        header('Location: ../../Form_I/');
        exit;
    } elseif (strlen(cleanStr($fn)) < 2 || strlen($fn) > 50) {
        $_SESSION['alert'] = "First Name must have 2-50 characters.";
        header('Location: ../../Form_I/');
        exit;
    } elseif (strlen(cleanStr($mn)) > 50) {
        $_SESSION['alert'] = "Middle Name must not exceed 50 characters.";
        header('Location: ../../Form_I/');
        exit;
    } elseif (empty($ln)) {
        $_SESSION['alert'] = "Missing Last Name!";
        header('Location: ../../Form_I/');
        exit;
    } elseif (strlen(cleanStr($ln)) < 2 || strlen($ln) > 50) {
        $_SESSION['alert'] = "Last Name must have 2-50 characters.";
        header('Location: ../../Form_I/');
        exit;
    } elseif (empty($db)) {
        $_SESSION['alert'] = "Missing Birth Date!";
        header('Location: ../../Form_I/');
        exit;
    } elseif (!validateDate($db)) {
        $_SESSION['alert'] = "Invalid Date Format!";
        header('Location: ../../Form_I/');
        exit;
    } elseif (empty($sx)) {
        $_SESSION['alert'] = "Missing Sex!";
        header('Location: ../../Form_I/');
        exit;
    } elseif (strlen($sx) > 5) {
        $_SESSION['alert'] = "Sex must not exceed 5 characters.";
        header('Location: ../../Form_I/');
        exit;
    } elseif (empty($cs)) {
        $_SESSION['alert'] = "Missing Civil Status!";
        header('Location: ../../Form_I/');
        exit;
    } elseif (strlen($cs) > 5) {
        $_SESSION['alert'] = "Civil Status must not exceed 5 chatacters.";
        header('Location: ../../Form_I/');
        exit;
    } elseif (!empty($ea) && strlen($ea) > 5) {
        $_SESSION['alert'] = "Educational Attainment must not exceed 5 chatacters.";
        header('Location: ../../Form_I/');
        exit;
    } elseif (!empty($o) && strlen($o) > 50) {
        $_SESSION['alert'] = "Occupation must not exceed 50 characters.";
        header('Location: ../../Form_I/');
        exit;
    } elseif (empty($b)) {
        $_SESSION['alert'] = "Missing Barangay!";
        header('Location: ../../Form_I/');
        exit;
    } elseif (strlen($b) > 5) {
        $_SESSION['alert'] = "Barangay must not exceed 5 characters.";
        header('Location: ../../Form_I/');
        exit;
    } elseif (!preg_match('/^0[89]\d{2}-\d{3}-\d{4}$/', $cn)) {
        $_SESSION['alert'] = "Invalid Format. Ex: 0999-999-9999";
        header('Location: ../../Form_I/');
        exit;
    } elseif (empty($id)) {
        $_SESSION['alert'] = "Missing ID!";
        header('Location: ../../Form_I/');
        exit;
    } elseif (strlen(strval($id)) > 11) {
        $_SESSION['alert'] = "Invaid ID Length.";
        header('Location: ../../Form_I/');
        exit;
    } else {

        try {
            $pdo->beginTransaction();

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
                $r = $pdo->lastInsertId();

                $sql = $pdo->prepare("INSERT INTO tbl_cn (c, cn)
                VALUES (:1, :2)");
                $sql->bindParam(":1", $r, PDO::PARAM_INT);
                $sql->bindParam(":2", $cn, PDO::PARAM_STR);

                if ($sql->execute()) {
                    $sql = $pdo->prepare("UPDATE tbl_cs
                    SET form_I = 1,
                    r = :1,
                    b = :2
                    WHERE id = :3");
                    $sql->bindParam(":1", $r, PDO::PARAM_INT);
                    $sql->bindParam(":2", $b, PDO::PARAM_STR);
                    $sql->bindParam(":3", $id, PDO::PARAM_INT);

                    if ($sql->execute()) {
                        $pdo->commit();
                        header('Location: ../../Form_II/');
                        exit;
                    } else {
                        $pdo->rollBack();
                        $_SESSION['alert'] = "Error Inserting Case Study Info";
                        header('Location: ../../Form_I/');
                        exit;
                    }
                } else {
                    $pdo->rollBack();
                    $_SESSION['alert'] = "Error Inserting Contact Number";
                    header('Location: ../../Form_I/');
                    exit;
                }
            } else {
                $pdo->rollBack();
                $_SESSION['alert'] = "Error Inserting User Info";
                header('Location: ../../Form_I/');
                exit;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            $_SESSION['alert'] = "Connection Error: " . $e->getMessage();
            header('Location: ../../Form_I/');
            exit;
        }
    }
} else {
    header('Location: include/logout.php');
    exit;
}
?>