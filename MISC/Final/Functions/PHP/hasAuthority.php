<?php
if (isset($_SESSION['access']) && !empty($_SESSION['access'])) {
    if (isset($_SESSION['Admin_ID']) && !empty($_SESSION['Admin_ID'])) {
        header('Location: dashboard.php');
        exit;
    } else {
        header('Location: ../Functions/PHP/logout.php');
        exit;
    }
} elseif (isset($_SESSION['Authority']) && !empty($_SESSION['Authority'])) {

} else {
    header('Location: ../Functions/PHP/logout.php');
    exit;
}
?>