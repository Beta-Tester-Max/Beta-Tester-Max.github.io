<?php
if (isset($_SESSION['allAvailability'])) {
    foreach ($_SESSION['allAvailability'] as $a) {
        $an = $a['Availability_Name'] ?? "";
        $aid = $a['Availability_ID'] ?? "";
        ?>
    <option value="<?php echo $aid?>"><?php echo $an?></option>
    <?php }
}
?>