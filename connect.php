<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aics_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=" . urlencode($dbname), $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<script>alert('Connection failed: " . addslashes($e->getMessage()) . "');</script>";
    $pdo = null;
}

if (!function_exists('sanitize')) {
    function sanitize($data)
    {
        if (is_array($data)) {
            return array_map('sanitize', $data);
        } elseif (is_object($data)) {
            $sanitizedObject = new stdClass();
            foreach ($data as $key => $value) {
                $sanitizedObject->$key = sanitize($value);
            }
            return $sanitizedObject;
        } else {
            return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        }
    }
} else {
    echo "<script>alert('sanitize() function already exists.');</script>";
}

?>