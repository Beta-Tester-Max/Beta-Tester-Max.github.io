<?php include "connect.php"; 
session_start();
if (empty($_SESSION)) { ?>
    <script>window.location.href = 'index.php'</script><?php } else {
    session_destroy(); ?>
    <script>window.location.href = 'index.php'</script> <?php }