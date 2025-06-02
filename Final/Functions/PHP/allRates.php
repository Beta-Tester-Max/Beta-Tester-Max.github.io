<?php
if (isset($_SESSION['allRates']) && !empty($_SESSION['allRates'])) {
    foreach ($_SESSION['allRates'] as $a) {
        $id = $a['Rate_ID'] ?? "";
        $asid = $a['Assistance_ID'] ?? "";
        $avid = $a['Availability'] ?? "";
        $cr = $a['Criteria'] ?? "";
        $co = $a['Cost'] ?? "";
        ?>
        <tr>
            <td><?php echo $id ?></td>
            <td><?php echo $asid ?></td>
            <td><?php echo $avid ?></td>
            <td><?php echo $cr ?></td>
            <td><?php echo $co ?></td>
        </tr>
        <?php
    }
}
?>