<?php
if (isset($_SESSION['allCS']) && !empty($_SESSION['allCS'])) { ?>
    <select id="csSelect" class="form__real-select" name="civStat">
        <option value="" disabled selected hidden>Select</option>
        <?php foreach ($_SESSION['allCS'] as $a) {
            $code = $a['cSC'] ?? "";
            $name = $a['cSN'] ?? "";?>
            <option value="<?php echo $code?>"><?php echo $name?></option>
        <?php } ?>
    </select>
<?php }
?>