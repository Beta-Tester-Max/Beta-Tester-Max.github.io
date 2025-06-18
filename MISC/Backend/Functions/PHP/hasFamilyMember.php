<?php
if (isset($_SESSION['hasFamily']) && $_SESSION['hasFamily'] === 1) {
    header('Location: profile.php');
}
?>