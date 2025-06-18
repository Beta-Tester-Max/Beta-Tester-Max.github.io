<?php
if (isset($_SESSION['eApplication'])) {
    for ($i = 0; $i < count($_SESSION['eApplication']); ++$i) {
        foreach ($_SESSION['eApplication'][$i] as $a => $an) {
            ?>
            <option value="<?php echo $a ?>"><?php echo $an ?></option>
            <?php
        }
    }
}
?>