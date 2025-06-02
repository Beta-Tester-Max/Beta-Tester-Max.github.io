<?php
if (isset($_SESSION['allAvailability']) && !empty($_SESSION['allAvailability'])) {
    foreach ($_SESSION['allAvailability'] as $a) {
        $id = $a['Availability_ID'] ?? "";
        $an = $a['Availability_Name'] ?? "";
        ?>
        <tr>
            <td><?php echo $id ?></td>
            <td><?php echo $an ?></td>
            <td>
                <form method="POST" action="../Functions/PHP/adminDelete.php">
                    <input type="hidden" value="<?php echo $id ?>" name="id">
                    <input type="hidden" name="deleteAvailability">
                    <button type="submit" class="action-btn">Delete</button>
                </form>
            </td>
        </tr>
        <?php
    }
}
?>