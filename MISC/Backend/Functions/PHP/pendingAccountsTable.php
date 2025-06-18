<?php
if (isset($_SESSION['pendingA'])) {
    $aTA = array();
    foreach ($_SESSION['pendingA'] as $a) {
        $id = $a['Account_ID'] ?? "";
        $fn = $_SESSION['pendingF'.$id] ?? "";
        ?>
            <tr>
                <td class="align-middle text-center"><?php echo $fn?></td>
                <td><button type="button" id="aTA<?php echo $id?>">View</button></td>
            </tr>
        <?php
        $aTA[] = "aTA".$id;
    }
    $_SESSION['aTA'] = $aTA;
}
?>