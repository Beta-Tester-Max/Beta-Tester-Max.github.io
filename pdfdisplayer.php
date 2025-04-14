<?php session_start();
if (isset($_SESSION['file'])) {
    $file = realpath("file/" . $_SESSION["file"]);
    $filename = "File.pdf";
    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename='" . $filename . "'");
    header("Content-Transfer-Encoding: binary");
    header("Accept-Ranges: bytes");
    @readfile($file);
} else { ?>
    <script>window.location.href = "logout.php"</script>
<?php }