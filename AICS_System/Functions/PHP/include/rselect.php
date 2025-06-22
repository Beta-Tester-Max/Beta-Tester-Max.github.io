<?php
if (isset($_SESSION['allR']) && !empty($_SESSION['allR'])) { ?>
        <option value="" disabled selected hidden>Select</option>
        <?php foreach ($_SESSION['allR'] as $a) {
            $code = $a['rC'] ?? "";
            $name = $a['rN'] ?? "";?>
            <option value="<?php echo $code?>"><?php echo $name?></option>
        <?php } ?>
<?php }
?>