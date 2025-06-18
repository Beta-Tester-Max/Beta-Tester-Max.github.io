<?php
if (isset($_SESSION['family'])) {
    foreach ($_SESSION['family'] as $f) {
        $u = $f['User_ID'];
        if (!empty($r['Middle_Name'])) {
            $n = $f['First_Name'] . "&nbsp;" . $f['Middle_Name'] . "&nbsp;" . $f['Last_Name'];
        } else {
            $n = $f['First_Name'] . "&nbsp;" . $f['Last_Name'];
        }

        ?>
        <option value="<?php echo $u ?>"><?php echo $n ?></option>
        <?php
    }
    var_dump($f);
}
?>