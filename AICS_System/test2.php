<?php
require_once '../vendor/autoload.php';  // Include PHPWord

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Create a new PHPWord object
    $phpWord = new \PhpOffice\PhpWord\PhpWord();

    $section = $phpWord->addSection([
        'marginTop' => 360,
        'marginBottom' => 360,
        'marginLeft' => 360,
        'marginRight' => 360,
        'paperSize' => 'Legal',
    ]);

    $table = $section->addTable();

    // Add the first row to the table
    $table->addRow();

    $table->addCell(1150);

    // Add the first image in the first cell
    $imagePath = './Assets/Image/Alam150.png';
    $table->addCell(890)->addImage($imagePath, array('width' => 55, 'height' => 56, 'align' => 'center', 'spaceAfter' => 0));

    $cell = $table->addCell(6890); // Add a cell with width 5000

    // Add text inside the cell
    $cell->addText("Republic of the Philippines", ['name' => 'Calibri (Body)', 'size' => 11], ['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 200]);
    $cell->addText("MUNICIPAL SOCIAL WELFARE AND DEVELOPMENT OFFICE", ['name' => 'Calibri (Body)', 'size' => 10], ['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $cell->addText("Alaminos, Laguna", ['name' => 'Calibri (Body)', 'size' => 10], ['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    // Add the second image in the second cell
    $imagePath = './Assets/Image/dswd-logo.png';
    $table->addCell(1000)->addImage($imagePath, array('width' => 55, 'height' => 56, 'align' => 'center', 'spaceAfter' => 0));

    $table->addCell(1000);

    $section->addText(
        '____________________________________________________________________________',
        ['underline' => 'single', 'size' => 12, 'bold' => true],
        ['align' => 'center', 'valign' => 'center', 'spaceAfter' => 200, 'spaceBefore' => 0] // Customize the "line"
    );
    // Use the edited fields to generate the document
    $section->addText("SOCIAL CASE STUDY REPORT", ['name' => 'Calibri (Body)', 'size' => 11, 'bold' => true], ['align' => 'center']);

    $section->addText("                                  I.            IDENTIFYING DATA:", ['name' => 'Calibri (Body)', 'size' => 11, 'bold' => true], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    $table = $section->addTable();

    $table->addRow();
    $table->addCell(3000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText("Name", ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText(":", ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText($_POST['field2'], ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(2000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    $table->addRow();
    $table->addCell(3000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText("Date of Birth", ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText(":", ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText($_POST['field3'], ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    $table->addRow();
    $table->addCell(3000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText("Age", ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText(":", ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText($_POST['field4'], ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    $table->addRow();
    $table->addCell(3000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText("Sex", ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText(":", ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText($_POST['field5'], ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    $table->addRow();
    $table->addCell(3000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText("Civil Status", ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText(":", ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText($_POST['field6'], ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    $table->addRow();
    $table->addCell(3000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(3000)->addText("Educational Attainment", ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText(":", ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText($_POST['field7'], ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    $table->addRow();
    $table->addCell(3000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText("Occupation", ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText(":", ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText($_POST['field8'], ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    $table->addRow();
    $table->addCell(3000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText("Address", ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText(":", ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(5000)->addText($_POST['field9'], ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    $table->addRow();
    $table->addCell(3000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText("Contact Number", ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText(":", ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['align' => 'center', 'valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell(1000)->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $table->addCell()->addText($_POST['field10'], ['name' => 'Calibri (Body)', 'size' => 11, 'lineSpacing' => 0], ['valign' => 'center', 'spaceAfter' => 200, 'spaceBefore' => 0]);

    $section->addText("                                II.            FAMILY COMPOSITION:", ['name' => 'Calibri (Body)', 'size' => 11, 'bold' => true], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);

    // Create a table with border style
    $table = $section->addTable(['borderSize' => 3, 'borderColor' => '000000', 'left' => -360]);

    // Add a row to the table
    $row = $table->addRow();

    // Define the number of columns
    $numColumns = 4; // Number of cells (columns)

    // Calculate the width for each cell (e.g., divide available width by the number of columns)
    $width = 15000 / $numColumns; // 10000 is the total available width (adjust as needed)
    $paddingTop = 50;
    $paddingLeft = ['left' => 50];

    // Add cells to the row, setting the width for each cell
    $row->addCell($width)->addText('Name', ['name' => 'Calibri (Body)', 'size' => 11, 'bold' => true], ['spaceBefore' => $paddingTop, 'indentation' => $paddingLeft, 'spaceAfter' => 0]);
    $row->addCell($width)->addText('Relationship to Client', ['name' => 'Calibri (Body)', 'size' => 11, 'bold' => true], ['spaceBefore' => $paddingTop, 'indentation' => $paddingLeft, 'spaceAfter' => 0]);
    $row->addCell(1000)->addText('Age', ['name' => 'Calibri (Body)', 'size' => 11, 'bold' => true], ['align' => 'center', 'spaceBefore' => $paddingTop, 'spaceAfter' => 0]);
    $row->addCell(1000)->addText('Sex', ['name' => 'Calibri (Body)', 'size' => 11, 'bold' => true], ['align' => 'center', 'spaceBefore' => $paddingTop, 'spaceAfter' => 0]);
    $row->addCell(1500)->addText('Civil Status', ['name' => 'Calibri (Body)', 'size' => 11, 'bold' => true], ['align' => 'center', 'spaceBefore' => $paddingTop, 'spaceAfter' => 0]);
    $row->addCell($width)->addText('Educational Attainment', ['name' => 'Calibri (Body)', 'size' => 11, 'bold' => true], ['spaceBefore' => $paddingTop, 'indentation' => $paddingLeft, 'spaceAfter' => 0]);
    $row->addCell($width)->addText('Occupation', ['name' => 'Calibri (Body)', 'size' => 11, 'bold' => true], ['spaceBefore' => $paddingTop, 'indentation' => $paddingLeft, 'spaceAfter' => 0]);


    $section->addText("                            III.          PROBLEM PRESENTED:", ['name' => 'Calibri (Body)', 'size' => 11, 'bold' => true], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $section->addText("          Client came to this office seeking for a Social Case Study Report for their request of " . "financial/medical assistance from DOH-MAIP" . ".", ['name' => 'Calibri (Body)', 'size' => 11], ['valign' => 'center', 'spaceAfter' => 200, 'spaceBefore' => 0, 'indentation' => ['left' => 2350, 'right' => 1200]]);

    $section->addText("                            IV.          CLIENT’S HISTORICAL BACKGROUND:", ['name' => 'Calibri (Body)', 'size' => 11, 'bold' => true], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $section->addText("          Client and her family rent a house that is made up of " . "light and concrete materials. Client/patient was seen and examined at San Pablo City General Hospital San Pablo City, Laguna under the service of Dr. Navata and was diagnosed of T/C Gastric Pathology and was recommended for Whole Abdomen Ultrasound" . ". Client’s family are really great financial difficulty to augment their medical and laboratory expenses thus she asked of financial support from your good office.", ['name' => 'Calibri (Body)', 'size' => 11], ['alignment' => 'both', 'valign' => 'center', 'spaceAfter' => 200, 'spaceBefore' => 0, 'indentation' => ['left' => 2350, 'right' => 1200]]);

    $section->addText("                            V.           RECOMMENDATION:", ['name' => 'Calibri (Body)', 'size' => 11, 'bold' => true], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $section->addText("          In view of the foregoing facts stated above, the undersigned worker recommends the client for provision of financial/medical assistance from " . "DOH-MAIP" . ". We continuously thank your good office for the unending support you extend to our needy constituents.", ['name' => 'Calibri (Body)', 'size' => 11], ['valign' => 'center', 'spaceAfter' => 200, 'spaceBefore' => 0, 'indentation' => ['left' => 2350, 'right' => 1200]]);

    $section->addText("Prepared by:", ['name' => 'Calibri (Body)', 'size' => 11], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0, 'indentation' => ['left' => 7500]]);
    $section->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $section->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $section->addText("JEACEL F. BIÑAS, RSW", ['name' => 'Calibri (Body)', 'size' => 11, 'bold' => true], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0, 'indentation' => ['left' => 7500]]);
    $section->addText("MSWD OFFICER", ['name' => 'Calibri (Body)', 'size' => 11], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0, 'indentation' => ['left' => 7500]]);
    $section->addText("License No. 0021579", ['name' => 'Calibri (Body)', 'size' => 11], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0, 'indentation' => ['left' => 7500]]);
    $section->addText("Valid Until October 21, 2027", ['name' => 'Calibri (Body)', 'size' => 11], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0, 'indentation' => ['left' => 7500]]);
    $section->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $section->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $section->addText("Noted by:", ['name' => 'Calibri (Body)', 'size' => 11], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0, 'indentation' => ['left' => 1500]]);
    $section->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $section->addText("", [], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0]);
    $section->addText("HON. GLENN P. FLORES", ['name' => 'Calibri (Body)', 'size' => 11, 'bold' => true], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0, 'indentation' => ['left' => 1500]]);
    $section->addText("Municipal Mayor", ['name' => 'Calibri (Body)', 'size' => 11], ['valign' => 'center', 'spaceAfter' => 0, 'spaceBefore' => 0, 'indentation' => ['left' => 1500]]);
    
    $table = $section->addTable();

    $table->addRow();

    $table->addCell(1450);
    
    $imagePath = './Assets/Image/ayosAlaminos.png';
    $table->addCell()->addImage($imagePath, ['width' => 50, 'height' => 20, 'spaceAfter' => 0]);

    $file = 'Social_Case_Study_Report.docx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: attachment; filename="' . $file . '"');
    $phpWord->save('php://output', 'Word2007');

    exit;
}
?>