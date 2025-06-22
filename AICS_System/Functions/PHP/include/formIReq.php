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
    } elseif (isset($_SESSION['hasFormI']) || !empty($_SESSION['hasFormI'])) {
        if ($_SESSION['hasFormI'] === 1) {
            header('Location: ../Form_II/');
            exit;
        }
    }
} else {
    header('Location: ../Case_Study/');
    exit;
}
?>