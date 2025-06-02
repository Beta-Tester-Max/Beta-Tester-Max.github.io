<?php
if (isset($_SESSION['allAdminLogs']) && !empty($_SESSION['allAdminLogs'])) {
    foreach ($_SESSION['allAdminLogs'] as $a) {
        $ts = $a['TimeStamp'] ?? "";
        $tid = $a['Token_ID'] ?? "";
        $ac = $a['Action'] ?? "";

        ?>
        <tr>
            <td><?php echo $ts?></td>
            <td><?php echo $tid?></td>
            <td><?php echo $ac?></td>
        </tr>
        <?php
    }
}
?>