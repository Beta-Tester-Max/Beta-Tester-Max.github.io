<?php
if (!empty($_SESSION['Account'])) {
    $data = $_SESSION['Account'] ?? "";
    $u = $data['Username'] ?? "";
    
    echo "Hi, ".$u;
} ?>