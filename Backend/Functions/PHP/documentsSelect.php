<?php
if (isset($_SESSION['Documents'])) {
    foreach ($_SESSION['Documents'] as $d) {
        $dd = $d['Description'] ?? "";
        $did = $d['Document_ID'] ?? "";
        ?>
    <option value="<?php echo $did?>"><?php echo $dd?></option>
    <?php }
}
?>