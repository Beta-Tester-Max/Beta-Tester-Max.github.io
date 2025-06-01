<?php
if (isset($_SESSION['allAvailability']) && !empty($_SESSION['allAvailability'])) {
    foreach ($_SESSION['allAvailability'] as $a) {
        $id = $a['Availability_ID'] ?? "";
        $an = $a['Availability_Name'] ?? "";
        ?>
        <tr class="tbl-row">
            <td><?php echo $id ?></td>
            <td><?php echo $an ?></td>
        </tr>
        <?php
    }
}
?>