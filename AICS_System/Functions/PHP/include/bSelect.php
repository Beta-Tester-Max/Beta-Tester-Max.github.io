<?php
if (isset($_SESSION['allB']) && !empty($_SESSION['allB'])) { ?>
    <option value="" disabled selected hidden>Select</option>
    <?php foreach ($_SESSION['allB'] as $a) {
        $code = $a['bC'] ?? "";
        $name = $a['bN'] ?? ""; ?>
        <option value="<?php echo $code ?>"><?php echo $name ?></option>
    <?php } ?>
<?php }
?>