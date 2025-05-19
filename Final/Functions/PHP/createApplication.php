<?php
require_once "connect.php";

if (isset($_POST['createApplication'])) {
    $c = $_POST['count'] + 1;
    for ($i = 1; $i < $c; ++$i) {
        if (empty($f) && !empty($_POST['appFile' . $i])) {
            $f = $_POST['appFile' . $i] ?? "";
        } elseif (isset($f) && !empty($f) && !empty($_POST['appFile' . $i])) {
            $f .= ", " . $_POST['appFile' . $i] ?? "";
        }
    }
    echo $f;
} elseif (isset($_POST['uploadDocuments'])) {
    $c = $_POST['count'] + 1;

    for ($i = 1; $i < $c; ++$i) {
        $d = $_POST['document' . $i] ?? "";

        if (empty($f) && !empty($d)) {
            $f = $d ?? "";
        } elseif (isset($f) && !empty($f) && !empty($d)) {
            $f .= ", " . $d ?? "";
        }

        $sql = $pdo->prepare("SELECT * FROM tbl_account_requirements WHERE Document_ID = :d");
        $sql->bindParam(":d", $d, PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            echo "it went here";
        } else {
        }
    }
    echo $f;
}
?>