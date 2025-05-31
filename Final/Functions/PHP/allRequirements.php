<?php
if (isset($_SESSION['allRequirements']) && !empty($_SESSION['allRequirements'])) {
    foreach ($_SESSION['allRequirements'] as $a) {
        $id = $a['Requirement_ID'] ?? "";
        $aid = $a['Assistance_ID'] ?? "";
        $did = $a['Document_ID'] ?? "";
        $desc = $a['Description'] ?? "";
        $im = $a['Importance'] ?? "";
        ?>
        <tr class="tbl-row">
            <td><?php echo $id ?></td>
            <td><?php echo $aid ?></td>
            <td><?php echo $did ?></td>
            <td><?php echo $desc ?></td>
            <td><?php echo $im ?></td>
        </tr>
        <?php
    }
}
?>