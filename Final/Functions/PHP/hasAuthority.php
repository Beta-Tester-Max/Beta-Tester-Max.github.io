<?php
if (isset($_SESSION['Authority']) && !empty($_SESSION['Authority'])) {

} else {
    header('Location: ../Functions/PHP/logout.php');
    exit;
}
?>