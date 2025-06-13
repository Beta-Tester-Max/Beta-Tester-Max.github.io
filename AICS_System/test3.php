<?php
// Include the DOMPDF library (adjust the path if necessary)
require '../vendor/autoload.php'; // Ensure the path is correct if you're using Composer

use Dompdf\Dompdf;
use Dompdf\Options;

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the HTML content sent from JavaScript
    $htmlContent = $_POST['htmlContent'];

    // Initialize DOMPDF
    $dompdf = new Dompdf();

    // Set options for DOMPDF (optional, e.g., for better font handling)
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);  // Enable HTML5 support
    $options->set('isPhpEnabled', true);          // Enable PHP in the HTML (if needed)
    $dompdf->setOptions($options);

    // Load the HTML content into DOMPDF
    $dompdf->loadHtml($htmlContent);

    // (Optional) Set paper size (A4 by default)
    $dompdf->setPaper('A4', 'portrait');  // You can also use 'landscape' if preferred

    // Render PDF (first pass for the HTML to PDF conversion)
    $dompdf->render();

    // Output the generated PDF to the browser (inline display)
    $dompdf->stream("Social_Case_Study_Report.pdf", array("Attachment" => 0)); // 0 = inline display, 1 = download
}
?>
