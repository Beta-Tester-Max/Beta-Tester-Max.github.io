<?php
if (isset($_SESSION['Alert'])) {
    echo "<script>alert('" . $_SESSION['Alert'] . "')</script>";
    unset($_SESSION['Alert']);
}
?>