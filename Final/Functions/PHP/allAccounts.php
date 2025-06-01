<?php
if (isset($_SESSION['allAccounts']) && !empty($_SESSION['allAccounts'])) {
    foreach ($_SESSION['allAccounts'] as $a) {
        $id = $a['Account_ID'] ?? "";
        $u = $a['Username'] ?? "";
        $e = $a['Email'] ?? "";
        $p = $a['Password'] ?? "";
        $t = $a['TimeStamp'] ?? "";
        ?>
        <tr class="tbl-row">
            <td><?php echo $id ?></td>
            <td><?php echo $u ?></td>
            <td><?php echo $e ?></td>
            <td><?php echo $p ?></td>
            <td><?php echo $t ?></td>
        </tr>
        <?php
    }
}
?>