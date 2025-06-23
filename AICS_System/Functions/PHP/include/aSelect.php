<?php
if (isset($_SESSION['allAssistance']) && !empty($_SESSION['allAssistance'])) { ?>
        <option value="" disabled selected hidden>Select</option>
        <?php foreach ($_SESSION['allAssistance'] as $a) {
            $code = $a['aC'] ?? "";
            $name = $a['aN'] ?? "";?>
            <option value="<?php echo $code?>"><?php echo $name?></option>
        <?php } ?>
<?php }
?>