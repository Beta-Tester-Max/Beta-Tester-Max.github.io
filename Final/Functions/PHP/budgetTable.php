<?php
if (isset($_SESSION['budgetTable']) && !empty($_SESSION['budgetTable'])) {
    foreach ($_SESSION['budgetTable'] as $a) {
        $n = $a['Budget_Name'] ?? "";
        $am = $a['Amount'] ?? "";

        ?>
        <tr class="tbl-row">
            <td><?php echo $n?></td>
            <td>₱ <?php echo number_format($am, 2)?></td>
        </tr>
        <?php
    }
}
?>