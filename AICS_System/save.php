<?php
require_once './../vendor/autoload.php';  // Make sure to adjust the path to your autoload file
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;

// Ensure the incoming HTML content is UTF-8 encoded
if (isset($_POST['htmlContent'])) {
    // Decode the incoming HTML content
    $htmlContent = urldecode($_POST['htmlContent']);  // Decoding the encoded HTML content

    // Sanitize and fix malformed HTML using DOMDocument
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML(mb_convert_encoding($htmlContent, 'HTML-ENTITIES', 'UTF-8'));

    // If there are errors in the DOM, handle them (you can also log them)
    if ($errors = libxml_get_errors()) {
        foreach ($errors as $error) {
            echo "Error: " . $error->message;
        }
        libxml_clear_errors();
        exit;
    }

    // Fix any broken tags if needed (e.g., <br>, <p>, etc.)
    $fixedHtml = $dom->saveHTML();

    // Create a new PhpWord instance
    $phpWord = new PhpWord();
    $section = $phpWord->addSection();

    try {
        // Use the Html class to add HTML content to the Word document
        $htmlParser = new Html();
        $htmlParser->addHtml($section, $fixedHtml);
    } catch (Exception $e) {
        // Error handling
        echo "Error converting HTML to Word: " . $e->getMessage();
        exit;
    }

    // Save the document as a .docx file
    $tempFile = tempnam(sys_get_temp_dir(), 'phpword_');
    $docxFile = $tempFile . '.docx';
    $phpWord->save($docxFile, 'Word2007');

    // Set headers for file download
    header('Content-Description: File Transfer');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: attachment; filename="Social_Case_Study_Report.docx"');
    header('Content-Length: ' . filesize($docxFile));

    // Output the file to the browser
    readfile($docxFile);

    // Clean up temporary file
    unlink($docxFile);
    exit;
}
?>
