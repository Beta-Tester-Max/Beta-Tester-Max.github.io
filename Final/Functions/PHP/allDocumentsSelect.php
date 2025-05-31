<?php
if (isset($_SESSION['allDocuments'])) {
    foreach ($_SESSION['allDocuments'] as $a) {
        $desc = $a['Description'] ?? "";
        $did = $a['Document_ID'] ?? "";
        ?>
    <option value="<?php echo $did?>"><?php echo $desc?></option>
    <?php }
}
?>