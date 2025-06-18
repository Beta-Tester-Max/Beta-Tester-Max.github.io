<?php
if (isset($_SESSION['Alert'])) {
    $msg = $_SESSION['Alert'] ?? "";
    echo "<script>alert(" . json_encode($msg) . ");</script>";
    unset($_SESSION['Alert']);
}
?>
