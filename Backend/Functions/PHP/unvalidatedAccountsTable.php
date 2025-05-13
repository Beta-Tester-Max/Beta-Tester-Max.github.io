<?php
if (isset($_SESSION['unvalidatedA'])) {
    $aT = array();
    foreach ($_SESSION['unvalidatedA'] as $a) {
        $id = $a['Account_ID'] ?? "";
        $fn = $_SESSION['unvalidatedF'.$id] ?? "";
        ?>
            <tr>
                <td class="align-middle text-center"><?php echo $fn?></td>
                <td><button type="button" id="aT<?php echo $id?>">View</button></td>
            </tr>
        <?php
        $aT[] = "aT".$id;
    }
    $_SESSION['aT'] = $aT;
}
?>