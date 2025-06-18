<?php
if (!empty($_SESSION['Login'])) {
    $l = $_SESSION['Login'] ?? "";
    unset($_SESSION['Login']);
    ?>
    <p class="text-danger"><b><?php echo $l?></b></p>
<?php }?>