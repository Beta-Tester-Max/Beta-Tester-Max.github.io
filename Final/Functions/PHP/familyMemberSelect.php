<?php
if (isset($_SESSION['familyComp'])) {
    foreach ($_SESSION['familyComp'] as $fc) {
        $u = $fc['User_ID'];
        if (isset($_SESSION['family' . $u])) {
            foreach ($_SESSION['family' . $u] as $f) {
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
        }
    }
}
?>