<?php
if (isset($_SESSION['budgetTable']) && !empty($_SESSION['budgetTable'])) {
    foreach ($_SESSION['budgetTable'] as $a) {
        $as = $a['Assistance_ID'] ?? "";
        $am = $a['Amount'] ?? "";
        $an = $_SESSION['AsName'.$as] ?? "";

        ?>
        <tr>
            <td><?php echo $an ?></td>
            <td>₱ <?php echo number_format($am, 2) ?></td>
        </tr>
        <?php
    }
}
?>