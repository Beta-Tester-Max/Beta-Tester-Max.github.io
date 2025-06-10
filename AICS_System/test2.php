<?php
require_once '../vendor/autoload.php';  // Include PHPWord

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Create a new PHPWord object
    $phpWord = new \PhpOffice\PhpWord\PhpWord();

    // Add a section to the document
    $section = $phpWord->addSection();

    $table = $section->addTable();

    // Add the first row to the table
    $table->addRow();

    // Add the first image in the first cell
    $imagePath = './Assets/Image/Alam150.png';
    $table->addCell(890)->addImage($imagePath, array('width' => 55, 'height' => 56, 'align' => 'center', 'spaceAfter' => 0));

    $cell = $table->addCell(6890); // Add a cell with width 5000

    // Add text inside the cell
    $cell->addText("Republic of the Philippines", ['name' => 'Calibri (Body)', 'size' => 10], ['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 200]);
    $cell->addText("MUNICIPAL SOCIAL WELFARE AND DEVELOPMENT OFFICE", ['name' => 'Calibri (Body)', 'size' => 10], ['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $cell->addText("Alaminos, Laguna", ['name' => 'Calibri (Body)', 'size' => 10], ['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    // Add the second image in the second cell
    $imagePath = './Assets/Image/dswd-logo.png';
    $table->addCell(1000)->addImage($imagePath, array('width' => 55, 'height' => 56, 'align' => 'center', 'spaceAfter' => 0));

    $section->addText(
        '____________________________________________________________________________',
        ['underline' => 'single', 'size' => 10.99, 'bold' => true],
        ['align' => 'center', 'valign' => 'center', 'spaceAfter' => 200, 'spaceBefore' => 0] // Customize the "line"
    );
    // Use the edited fields to generate the document
    $section->addText("SOCIAL CASE STUDY REPORT", ['name' => 'Calibri (Body)', 'size' => 11, 'bold' => true], ['align' => 'center']);

    $section->addText("                I.            IDENTIFYING DATA:", ['name' => 'Calibri (Body)', 'size' => 11, 'bold' => true], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    $table = $section->addTable();

    $table->addRow();
    $table->addCell(2000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText("Name", ['lineSpacing' => 0],['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText(":", ['lineSpacing' => 0],['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText($_POST['field2'], ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    $table->addRow();
    $table->addCell(2000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText("Date of Birth", ['lineSpacing' => 0],['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText(":", ['lineSpacing' => 0],['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText($_POST['field3'], ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    $table->addRow();
    $table->addCell(2000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText("Age", ['lineSpacing' => 0],['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText(":", ['lineSpacing' => 0],['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText($_POST['field4'], ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    $table->addRow();
    $table->addCell(2000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText("Sex", ['lineSpacing' => 0],['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText(":", ['lineSpacing' => 0],['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText($_POST['field5'], ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    $table->addRow();
    $table->addCell(2000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText("Civil Status", ['lineSpacing' => 0],['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText(":", ['lineSpacing' => 0],['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText($_POST['field6'], ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    $table->addRow();
    $table->addCell(2000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(3000)->addText("Educational Attainment", ['lineSpacing' => 0],['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText(":", ['lineSpacing' => 0],['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText($_POST['field7'], ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    $table->addRow();
    $table->addCell(2000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText("Occupation", ['lineSpacing' => 0],['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText(":", ['lineSpacing' => 0],['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText($_POST['field8'], ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    $table->addRow();
    $table->addCell(2000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText("Address", ['lineSpacing' => 0],['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText(":", ['lineSpacing' => 0],['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(5000)->addText($_POST['field9'], ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    $table->addRow();
    $table->addCell(2000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText("Contact Number", ['lineSpacing' => 0],['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText(":", ['lineSpacing' => 0],['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText($_POST['field10'], ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 200, 'spaceBefore' => 0]);

    $section->addText("               II.            FAMILY COMPOSITION:", ['name' => 'Calibri (Body)', 'size' => 11, 'bold' => true], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    // Add more sections as necessary...

    // Save the document to a .docx file
    $file = 'Social_Case_Study_Report.docx';

    // Send file to the browser for download
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: attachment; filename="' . $file . '"');
    $phpWord->save('php://output', 'Word2007');

    // After file download, redirect to another page
    exit;  // Don't execute further after download
}
?>