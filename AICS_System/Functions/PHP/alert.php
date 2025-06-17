<?php
if (isset($_SESSION['alert']) && !empty($_SESSION['alert'])) {
    $alert = $_SESSION['alert'] ?? "";
    unset($_SESSION['alert']);
    ?>
    <script>
        alert(<?php echo json_encode($alert)?>);
    </script>
    <?php
}
?>