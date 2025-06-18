<?php
if (isset($_SESSION['Assistance'])) {
    $aB = array();
    foreach ($_SESSION['Assistance'] as $a) {
        $an = $a['Assistance_Name'] ?? "";
        $aid = $a['Assistance_ID'] ?? ""
            ?>
        <button type="button" id="aButton<?php echo $aid ?>"><?php echo $an ?></button>
        <?php
        $aB[] = 'aButton' . $aid;
    }
    $_SESSION['assistanceButtons'] = $aB;
}
?>