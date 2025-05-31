<?php
if (isset($_SESSION['allAssistance'])) {
    foreach ($_SESSION['allAssistance'] as $a) {
        $an = $a['Assistance_Name'] ?? "";
        $aid = $a['Assistance_ID'] ?? "";
        ?>
    <option value="<?php echo $aid?>"><?php echo $an?></option>
    <?php }
}
?>