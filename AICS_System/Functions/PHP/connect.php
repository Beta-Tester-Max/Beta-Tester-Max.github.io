<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_aics";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=" . urlencode($dbname), $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $_SESSION['alert'] = "Connection Error: " . $e->getMessage() . "";

    header('Location: ../../index.php');
    exit;
}

function cleanStr($str) {
    if (!empty($str)) {
    $trimmed = trim($str);
    return str_replace(' ', '', $trimmed);
    } else {
        return null;
    }
}

function cleanInt($int) {
    return intval(preg_replace('/\D/', '', $int));
}

define('ENCRYPTION_KEY_FILE', 'secret.key');

function get_key()
{
    if (!file_exists(ENCRYPTION_KEY_FILE)) {
        $key = openssl_random_pseudo_bytes(32);
        file_put_contents(ENCRYPTION_KEY_FILE, $key);
    } else {
        $key = file_get_contents(ENCRYPTION_KEY_FILE);
    }
    return $key;
}

function encrypt($data)
{
    $key = get_key();
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);

    $output = base64_encode($iv . $encrypted);
    return $output;
}

function decrypt($data)
{
    $key = get_key();
    $decoded = base64_decode($data);

    $iv_length = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($decoded, 0, $iv_length);
    $ciphertext = substr($decoded, $iv_length);

    $decrypted = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, 0, $iv);
    return $decrypted;
}

function validateDate($date) { 
	list($year, $month, $day) = explode('-', $date); 
	return checkdate($month, $day, $year); 
} 

?>