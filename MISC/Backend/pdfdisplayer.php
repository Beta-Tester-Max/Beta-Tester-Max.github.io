<?php session_start();
if (isset($_SESSION['file'])) {
    $file = realpath("Files/" . $_SESSION["file"]);
    $filename = "File.pdf";
    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename='" . $filename . "'");
    header("Content-Transfer-Encoding: binary");
    header("Accept-Ranges: bytes");
    @readfile($file);
} elseif (empty($_SESSION['file'])) {
    header('Location: Functions/PHP/logout.php');
    exit;
}