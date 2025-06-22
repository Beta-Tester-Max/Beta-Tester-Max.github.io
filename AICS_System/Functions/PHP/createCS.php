<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['createCS'])) {
    $cs = strval($_POST['csName'] ?? "");

    if (empty($cs)) {
        $_SESSION['alert'] = "Missing Name!";
        header('Location: ../../Case_Study/');
        exit;
    } elseif (strlen(cleanStr($cs)) < 2 || strlen($cs) > 50) {
        $_SESSION['alert'] = "Name must have 2-50 characters.";
        header('Location: ../../Case_Study/');
        exit;
    } else {

        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("INSERT INTO tbl_cs (cSName)
            VALUES (:cs)");
            $sql->bindParam(":cs", $cs, PDO::PARAM_STR);

            if ($sql->execute()) {
                $_SESSION['csID'] = $pdo->lastInsertId();
                $pdo->commit();
                header('Location: ../../Form_I/');
                exit;
            } else {
                $pdo->rollBack();
                $_SESSION['alert'] = "Error Inseting Data.";
                header('Location: ../../Case_Study/');
                exit;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            $_SESSION['alert'] = "Connection Error: " . $e->getMessage();
            header('Location: ../../Case_Study/');
            exit;
        }
    }
} else {
    header('Location: logout.php');
    exit;
}
?>