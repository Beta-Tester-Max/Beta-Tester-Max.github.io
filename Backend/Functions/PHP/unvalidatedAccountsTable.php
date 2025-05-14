<?php
if (isset($_SESSION['unvalidatedA'])) {
    $aTR = array();
    foreach ($_SESSION['unvalidatedA'] as $a) {
        $id = $a['Account_ID'] ?? "";
        $fn = $_SESSION['unvalidatedF'.$id] ?? "";
        ?>
            <tr>
                <td class="align-middle text-center"><?php echo $fn?></td>
                <td><button type="button" id="aTR<?php echo $id?>">View</button></td>
            </tr>
        <?php
        $aTR[] = "aTR".$id;
    }
    $_SESSION['aTR'] = $aTR;
}
?>