<?php
if (isset($_SESSION['allUserLogs']) && !empty($_SESSION['allUserLogs'])) {
    foreach ($_SESSION['allUserLogs'] as $a) {
        $ts = $a['TimeStamp'] ?? "";
        $acc = $a['Account_ID'] ?? "";
        $act = $a['Action'] ?? "";

        ?>
        <tr>
            <td><?php echo $ts?></td>
            <td><?php echo $acc?></td>
            <td><?php echo $act?></td>
        </tr>
        <?php
    }
}
?>