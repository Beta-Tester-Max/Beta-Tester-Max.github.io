<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['caseStudy'])) {
    $fn = strval($_POST['fname'] ?? "");
    $mn = strval($_POST['mname'] ?? "");
    $ln = strval($_POST['lname' ?? ""]);
    $db = $_POST['bday' ?? ""];
    $sx = cleanStr(strval($_POST['sx' ?? ""]));
    $cs = cleanStr(strval($_POST['civStat' ?? ""]));
    $ea = cleanStr(strval($_POST['educAtt' ?? ""]));
    $o = strval($_POST['occupation' ?? ""]);
    $b = cleanStr(strval($_POST['barangay' ?? ""]));
    $cn = cleanStr(strval($_POST['contactno' ?? ""]));
    $isPWD = isset($_POST['isPWD']) ? 1 : 0;
    $familyCount = intval($_POST['familyMemberCount' ?? 0]);
    $familyMembers = [];
    for ($i = 1; $i <= $familyCount; ++$i) {
        $familyMembers[] = [
            'fname' => strval($_POST['fname' . $i] ?? ""),
            'mname' => strval($_POST['mname' . $i] ?? ""),
            'lname' => strval($_POST['lname' . $i] ?? ""),
            'relation' => strval($_POST['relation' . $i] ?? ""),
            'bday' => $_POST['bday' . $i] ?? "",
            'sx' => cleanStr(strval($_POST['sx' . $i] ?? "")),
            'civStat' => cleanStr(strval($_POST['civStat' . $i] ?? "")),
            'educAtt' => cleanStr(strval($_POST['educAtt' . $i] ?? "")),
            'occupation' => strval($_POST['occupation' . $i] ?? "")
        ];
    }
    $problem = strval($_POST['problem_presented_ui' ?? ""]);
    $history = strval($_POST['f4text' ?? ""]);
    $recommend = strval($_POST['f5text' ?? ""]);
    $asType = cleanStr(strval($_POST['asType' ?? ""]));
    $cost = strval($_POST['cost' ?? "0.00"]);
    if (empty($fn) || strlen(cleanStr($fn)) < 2 || strlen($fn) > 50) {
        $_SESSION['alert'] = "First Name must have 2-50 characters.";
        header('Location: ../../Form/'); exit;
    }
    if (strlen(cleanStr($mn)) > 50) {
        $_SESSION['alert'] = "Middle Name must not exceed 50 characters.";
        header('Location: ../../Form/'); exit;
    }
    if (empty($ln) || strlen(cleanStr($ln)) < 2 || strlen($ln) > 50) {
        $_SESSION['alert'] = "Last Name must have 2-50 characters.";
        header('Location: ../../Form/'); exit;
    }
    if (empty($db) || !validateDate($db)) {
        $_SESSION['alert'] = "Invalid or missing Birth Date!";
        header('Location: ../../Form/'); exit;
    }
    if (empty($sx) || strlen($sx) > 5) {
        $_SESSION['alert'] = "Invalid Sex.";
        header('Location: ../../Form/'); exit;
    }
    if (empty($cs) || strlen($cs) > 5) {
        $_SESSION['alert'] = "Invalid Civil Status.";
        header('Location: ../../Form/'); exit;
    }
    if (strlen($ea) > 50) {
        $_SESSION['alert'] = "Educational Attainment too long.";
        header('Location: ../../Form/'); exit;
    }
    if (strlen($o) > 100) {
        $_SESSION['alert'] = "Occupation too long.";
        header('Location: ../../Form/'); exit;
    }
    if (empty($b) || strlen($b) > 50) {
        $_SESSION['alert'] = "Invalid Barangay.";
        header('Location: ../../Form/'); exit;
    }
    if (empty($cn) || strlen($cn) != 13) {
        $_SESSION['alert'] = "Contact Number must be in 0999-999-9999 format.";
        header('Location: ../../Form/'); exit;
    }
    foreach ($familyMembers as $i => $fm) {
        if (empty($fm['fname']) || strlen(cleanStr($fm['fname'])) < 2 || strlen($fm['fname']) > 50) {
            $_SESSION['alert'] = "Family Member #".($i+1).": First Name must have 2-50 characters.";
            header('Location: ../../Form/'); exit;
        }
        if (strlen(cleanStr($fm['mname'])) > 50) {
            $_SESSION['alert'] = "Family Member #".($i+1).": Middle Name too long.";
            header('Location: ../../Form/'); exit;
        }
        if (empty($fm['lname']) || strlen(cleanStr($fm['lname'])) < 2 || strlen($fm['lname']) > 50) {
            $_SESSION['alert'] = "Family Member #".($i+1).": Last Name must have 2-50 characters.";
            header('Location: ../../Form/'); exit;
        }
        if (empty($fm['bday']) || !validateDate($fm['bday'])) {
            $_SESSION['alert'] = "Family Member #".($i+1).": Invalid or missing Birth Date.";
            header('Location: ../../Form/'); exit;
        }
        if (empty($fm['sx']) || strlen($fm['sx']) > 5) {
            $_SESSION['alert'] = "Family Member #".($i+1).": Invalid Sex.";
            header('Location: ../../Form/'); exit;
        }
        if (empty($fm['civStat']) || strlen($fm['civStat']) > 5) {
            $_SESSION['alert'] = "Family Member #".($i+1).": Invalid Civil Status.";
            header('Location: ../../Form/'); exit;
        }
        if (strlen($fm['educAtt']) > 50) {
            $_SESSION['alert'] = "Family Member #".($i+1).": Educational Attainment too long.";
            header('Location: ../../Form/'); exit;
        }
        if (strlen($fm['occupation']) > 100) {
            $_SESSION['alert'] = "Family Member #".($i+1).": Occupation too long.";
            header('Location: ../../Form/'); exit;
        }
    }
    if (empty($problem) || strlen(cleanStr($problem)) < 10 || strlen($problem) > 1000) {
        $_SESSION['alert'] = "Problem Presented must have 10-1000 characters.";
        header('Location: ../../Form/'); exit;
    }
    if (empty($history) || strlen(cleanStr($history)) < 10 || strlen($history) > 10000) {
        $_SESSION['alert'] = "Historical Background must have 10-10,000 characters.";
        header('Location: ../../Form/'); exit;
    }
    if (empty($recommend) || strlen(cleanStr($recommend)) < 10 || strlen($recommend) > 10000) {
        $_SESSION['alert'] = "Recommendation must have 10-10,000 characters.";
        header('Location: ../../Form/'); exit;
    }
    if (empty($asType) || strlen($asType) > 5) {
        $_SESSION['alert'] = "Invalid Assistance Type.";
        header('Location: ../../Form/'); exit;
    }
    if (!preg_match('/^\d{1,11}\.\d{2}$/', $cost)) {
        $_SESSION['alert'] = "Invalid Cost format.";
        header('Location: ../../Form/'); exit;
    }
    try {
        $pdo->beginTransaction();
        $csID = isset($_SESSION['csID']) ? intval($_SESSION['csID']) : 0;
        if (!$csID) {
            $_SESSION['alert'] = "No Case Study ID found. Please start from the Case Study page.";
            header('Location: ../../Case_Study/');
            exit;
        }
        $cSName = $ln . ', ' . $fn . ($mn ? ' ' . $mn : '');
        $sql = $pdo->prepare("UPDATE tbl_cs SET
            cSName = :cSName,
            b = :b,
            asType = :asType,
            cost = :cost,
            Status = 'Complete',
            form_I = 1,
            form_II = 1,
            form_III = :problem,
            form_IV = :history,
            form_V = :recommend,
            is_pwd = :isPWD
        WHERE id = :csID");
        $sql->execute([
            ':cSName' => $cSName,
            ':b' => $b,
            ':asType' => $asType,
            ':cost' => $cost,
            ':problem' => $problem,
            ':history' => $history,
            ':recommend' => $recommend,
            ':isPWD' => $isPWD,
            ':csID' => $csID
        ]);
        foreach ($familyMembers as $fm) {
            $sql2 = $pdo->prepare("INSERT INTO tbl_cs_family (cs_id, fname, mname, lname, relation, bday, sx, civStat, educAtt, occupation) VALUES (:csID, :fn, :mn, :ln, :rel, :bday, :sx, :cs, :ea, :o)");
            $sql2->execute([
                ':csID' => $csID,
                ':fn' => $fm['fname'],
                ':mn' => $fm['mname'],
                ':ln' => $fm['lname'],
                ':rel' => $fm['relation'],
                ':bday' => $fm['bday'],
                ':sx' => $fm['sx'],
                ':cs' => $fm['civStat'],
                ':ea' => $fm['educAtt'],
                ':o' => $fm['occupation']
            ]);
        }
        try {
            $sqlC2 = $pdo->prepare("INSERT INTO tbl_c (fN, mN, lN, dB, s, cS, eA, o, is_pwd) VALUES (:fn, :mn, :ln, :db, :sx, :cs, :ea, :o, :isPWD)");
            $sqlC2->execute([
                ':fn' => $fn,
                ':mn' => $mn,
                ':ln' => $ln,
                ':db' => $db,
                ':sx' => $sx,
                ':cs' => $cs,
                ':ea' => $ea,
                ':o' => $o,
                ':isPWD' => $isPWD
            ]);
        } catch (PDOException $e) {
            $sqlC2 = $pdo->prepare("UPDATE tbl_c SET mN = :mn, s = :sx, cS = :cs, eA = :ea, o = :o, is_pwd = :isPWD WHERE fN = :fn AND lN = :ln AND dB = :db");
            $sqlC2->execute([
                ':mn' => $mn,
                ':sx' => $sx,
                ':cs' => $cs,
                ':ea' => $ea,
                ':o' => $o,
                ':isPWD' => $isPWD,
                ':fn' => $fn,
                ':ln' => $ln,
                ':db' => $db
            ]);
        }
        $pdo->commit();
        unset($_SESSION['hasFormIV'], $_SESSION['hasFormIII'], $_SESSION['hasFormII'], $_SESSION['hasFormI'], $_SESSION['csID']);
        $_SESSION['alert'] = "Case Study Completed!";
        header('Location: ../../Case_Study/');
        exit;
    } catch (PDOException $e) {
        $pdo->rollBack();
        $_SESSION['alert'] = "Database Error: " . $e->getMessage();
        header('Location: ../../Form/');
        exit;
    }
} else {
    header('Location: include/logout.php');
    exit;
}
?>