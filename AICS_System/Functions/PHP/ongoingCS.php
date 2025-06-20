<?php
if (isset($_SESSION['csID']) || !empty($_SESSION['csID'])) {
    header('Location: ./Form_I/');
    exit;
}
?>