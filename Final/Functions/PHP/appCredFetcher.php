<?php
if (isset($_SESSION['sD']) && !empty($_SESSION['sD'])) {
    $d = $_SESSION['sD'];
    
    $a = $d['a'] ?? "";
    $h = $d['h'] ?? "";
    $rp = $d['rp'] ?? "";
    $r = $d['r'] ?? "";
    $an = $d['an'] ?? "";
} else {
    header('Location: Functions/PHP/logout.php');
    exit;
}
?>