<?php
if (isset($_SESSION['allDocuments']) && !empty($_SESSION['allDocuments'])) {
    foreach ($_SESSION['allDocuments'] as $a) {
        $id = $a['Document_ID'] ?? "";
        $desc = $a['Description'] ?? "";
        ?>
        <tr>
            <td><?php echo $id ?></td>
            <td><?php echo $desc ?></td>
        </tr>
        <?php
    }
}
?>