<?php
if (isset($_SESSION['allSx']) && !empty($_SESSION['allSx'])) { ?>
    <select id="sxSelect" class="form__real-select" name="sx">
        <option value="" disabled selected hidden>Select</option>
        <?php foreach ($_SESSION['allSx'] as $a) {
            $code = $a['sC'] ?? "";
            $name = $a['sN'] ?? "";?>
            <option value="<?php echo $code?>"><?php echo $name?></option>
        <?php } ?>
    </select>
<?php }
?>