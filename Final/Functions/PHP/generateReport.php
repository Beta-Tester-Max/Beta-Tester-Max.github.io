<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['generateReport'])) {
$sd = $_POST['startDate'];
$ed = $_POST['endDate'];
$a = $_POST['assistance'];

try {

    $sql = $pdo->prepare("SELECT * FROM tbl_applications WHERE Assistance_ID = :a AND Date_Submitted BETWEEN :sd AND :ed");
    $sql->bindParam(":a", $a, PDO::PARAM_INT);
    $sql->bindParam(":sd", $sd, PDO::PARAM_STR);
    $sql->bindParam(":ed", $ed, PDO::PARAM_STR);
    $sql->execute();

    $results = $sql->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="'.$a.'Report.csv"');

    $output = fopen('php://output', 'w');

    if (!empty($results)) {
        fputcsv($output, array_keys($results[0]));

        foreach ($results as $row) {
            fputcsv($output, $row);
        }
    } else {
        fputcsv($output, ['No records found.']);
    }

    fclose($output);
    exit;
} catch (Exception $e) {
    $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
    header('Location: ../.,/Admin/report.php');
    exit;
}
} else {
    header('Location: logout.php');
    exit;
}

?>