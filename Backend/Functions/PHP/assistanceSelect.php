<?php
if (isset($_SESSION['Assistance'])) {
    foreach ($_SESSION['Assistance'] as $a) {
        $an = $a['Assistance_Name'] ?? "";
        $aid = $a['Assistance_ID'] ?? "";
        ?>
    <option value="<?php echo $aid?>"><?php echo $an?></option>
    <?php }
}
?>