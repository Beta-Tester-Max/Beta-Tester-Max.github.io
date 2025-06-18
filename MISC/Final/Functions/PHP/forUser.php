<?php
if(!isset($_SESSION['Account_ID']) || empty($_SESSION['Account_ID'])) {
    header('Location: index.php');
}
?>