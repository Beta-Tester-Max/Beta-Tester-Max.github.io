<?php
require_once "connect.php";
session_start();

if (isset($_POST['createToken'])) {
    $stoken = "TO" . bin2hex(random_bytes(5));
    $stoken .= "KE" . bin2hex(openssl_random_pseudo_bytes(5));
    $stoken .= "N" . bin2hex(random_bytes(5));
    $gtoken = str_shuffle($stoken);
    $hgtoken = password_hash($gtoken, PASSWORD_DEFAULT);
    $shgtoken = str_shuffle($hgtoken);
    $rtoken = mb_substr($shgtoken, 0, 5) . $gtoken;
    $ltoken = mb_substr($rtoken, 0, 20);
    $ftoken = str_shuffle($ltoken);
    $token = str_shuffle($ftoken);
    $t = password_hash($token, PASSWORD_DEFAULT);
    $gkey = "K" . bin2hex(openssl_random_pseudo_bytes(2));
    $gkey .= "E" . bin2hex(random_bytes(3));
    $gkey .= "Y" . bin2hex(openssl_random_pseudo_bytes(2));
    $k = str_shuffle(mb_substr($gkey, 0, 10));

    $sql = $pdo->prepare("SELECT * FROM tbl_admin_token WHERE `Key` = :k");
    $sql->bindParam(":k", $k, PDO::PARAM_STR);
    $sql->execute();

    if ($sql->rowCount() === 0) {

        $sql = $pdo->prepare("SELECT * FROM tbl_admin_token WHERE Token = :t");
        $sql->bindParam(":t", $t, PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() === 0) {

            $sql = $pdo->prepare("INSERT INTO tbl_admin_token (`Key`, Token)
            VALUES (:k, :t)");
            $sql->bindParam(":k", $k, PDO::PARAM_STR);
            $sql->bindParam(":t", $t, PDO::PARAM_STR);
            $sql->execute();

            $_SESSION['token'] = $token;
            $_SESSION['key'] = $k;

            header('Location: ../../Admin/tokenMaker.php');
            exit;
        } else {
            $_SESSION['token'] = "Token Already Exists! Please Re-Generate Token.";
            $_SESSION['key'] = "^^^^^^";

            header('Location: ../../Admin/tokenMaker.php');
            exit;
        }
    } else {
            $_SESSION['token'] = "vvvvvvv";
            $_SESSION['key'] = "Key Already Exists! Please Re-Generate Key.";

            header('Location: ../../Admin/tokenMaker.php');
            exit;
    }
} else {
    header('Location: logout.php');
    exit;
}
?>