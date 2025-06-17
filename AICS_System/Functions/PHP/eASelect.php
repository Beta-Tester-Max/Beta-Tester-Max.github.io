<?php
if (isset($_SESSION['allEA']) && !empty($_SESSION['allEA'])) { ?>
    <select id="eaSelect" class="form__real-select" name="educAtt">
        <option value="" disabled selected hidden>Select</option>
        <?php foreach ($_SESSION['allEA'] as $a) {
            $code = $a['eAC'] ?? "";
            $name = $a['eAN'] ?? "";?>
            <option value="<?php echo $code?>"><?php echo $name?></option>
        <?php } ?>
    </select>
<?php }
?>