<?php
require_once "../Functions/PHP/connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

try {

$sql = $pdo->query("SELECT * FROM tbl_sx");
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['allSx'] = $result;

$sql = $pdo->query("SELECT * FROM tbl_cvs");
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['allCS'] = $result;

$sql = $pdo->query("SELECT * FROM tbl_ea");
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['allEA'] = $result;

$sql = $pdo->query("SELECT * FROM tbl_b");
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['allB'] = $result;

$sql = $pdo->query("SELECT * FROM tbl_r");
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['allR'] = $result;

$sql = $pdo->query("SELECT id, cSName FROM tbl_cs");
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['allCaseStudy'] = $result;
} catch (PDOException $e) {
    $alert = "Connection Error: ". $e->getMessage();
    ?>
    <script>
        alert(<?php echo json_encode($alert)?>);
    </script>
    <?php
}
?>