<?php
if (isset($_SESSION['Authority']) && !empty($_SESSION['Authority'])) {
    header('Location: Admin/adminDashboard.php');
    exit;
}
?>