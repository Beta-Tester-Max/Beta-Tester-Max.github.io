<?php
if (isset($_SESSION['Token_ID']) && !empty($_SESSION['Token_ID'])) {

} else {
    header('Location: index.php');
    exit;
}
?>