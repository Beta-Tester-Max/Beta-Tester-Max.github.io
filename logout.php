<?php include "connect.php"; 
session_start();
if (empty($_SESSION)) { $conn->close();?>
    <script>window.location.href = 'index.php'</script><?php } else {
    $conn->close();
    session_destroy(); ?>
    <script>window.location.href = 'index.php'</script> <?php }