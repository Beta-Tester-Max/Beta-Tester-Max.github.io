<?php session_start();
if ($_SESSION['authority'] === "Admin") {
    $file = realpath("file/" . $_SESSION['file']);
    $filename = "file.pdf";
    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename='" . $filename . "'");
    header("Content-Transfer-Encoding: binary");
    header("Accept-Ranges: bytes");
    @readfile($file);
} else { ?>
    <script>window.location.href = "logout.php"</script>
<?php }