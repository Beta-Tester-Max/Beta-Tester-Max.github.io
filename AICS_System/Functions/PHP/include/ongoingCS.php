<?php
if (isset($_SESSION['csID']) || !empty($_SESSION['csID'])) {
    $csid = cleanInt(intval($_SESSION['csID'] ?? ""));
    if (empty($csid)) {
        header('Location: logout.php');
        exit;
    } elseif (strlen(strval($csid)) > 11) {
        header('Location: logout.php');
        exit;
    } elseif (!preg_match("/^\d+$/", $csid)) {
        header('Location: logout.php');
        exit;
    } else {
        if (cleanInt(intval($_SESSION['hasFormIV'] ?? "")) === 1) {
            header('Location: ../Form_V/');
            exit;
        } elseif (cleanInt(intval($_SESSION['hasFormIII'] ?? "")) === 1) {
            header('Location: ../Form_IV/');
            exit;
        } elseif (cleanInt(intval($_SESSION['hasFormII'] ?? "")) === 1) {
            header('Location: ../Form_III/');
            exit;
        } elseif (cleanInt(intval($_SESSION['hasFormI'] ?? "")) === 1) {
            header('Location: ../Form_II/');
            exit;
        } else {
            header('Location: ../Form_I/');
            exit;
        }
    }
}
?>