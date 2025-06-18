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
/**
 * @param mixed $data
 * @return mixed Returns an array, stdClass, or string depending on the input.
 */
function sanitize($data): mixed
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

function cleanStr($str) {
    $trimmed = trim($str);
    return str_replace(' ', '', $trimmed);
}

function cleanInt($int) {
    return preg_replace('/\D/', '', $int);
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

?>