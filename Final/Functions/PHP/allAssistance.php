<?php
if (isset($_SESSION['allAssistance']) && !empty($_SESSION['allAssistance'])) {
    foreach ($_SESSION['allAssistance'] as $a) {
        $id = $a['Assistance_ID'] ?? "";
        $an = $a['Assistance_Name'] ?? "";
        ?>
        <tr class="tbl-row">
            <td><?php echo $id ?></td>
            <td><?php echo $an ?></td>
        </tr>
        <?php
    }
}
?>