<?php if (isset($_SESSION['Family_ID']) && !empty($_SESSION['Family_ID'])) {
    header('Location: profile.php');
}