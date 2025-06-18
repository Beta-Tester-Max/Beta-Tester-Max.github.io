<?php
if (isset($_SESSION['Assistance'])) {
    $toggle = false;
    foreach ($_SESSION['Assistance'] as $a) {
        $aid = $a['Assistance_ID'] ?? "";
        $an = $a['Assistance_Name'] ?? "";
        $mR = $_SESSION['missingRequirements' . $aid] ?? "";
        if (!empty($mR)) {
            for ($i = 0; $i < count($mR); $i++) {
                $r = $mR[$i];
                $mD = $_SESSION['accountDocumentN' . $r] ?? "";
            }
        } else {
            $toggle = true;
        }
    }
    if (!$toggle) {
        header('Location: profile.php');
        exit;
    }
}
?>