<?php
if (isset($_SESSION['sD'])) {
    header("Refresh:0");
    unset($_SESSION['sD']);
}
?>