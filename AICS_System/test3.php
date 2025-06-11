<?php

require_once './../vendor/autoload.php'; // Adjust this path if your vendor folder is elsewhere

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\Shared\Converter; // For unit conversion

// 1. Create a new PhpWord object
$phpWord = new PhpWord();

// 2. Add a section to the document
$section = $phpWord->addSection();

// 3. Define a paragraph style with left and firstLine indentation
$paragraphStyleName = 'MyCustomIndentedParagraph';
$phpWord->addParagraphStyle($paragraphStyleName, [
  'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, // Justify text for better visual
  'indentation' => [
    'left' => Converter::cmToTwip(2),   // Base left indentation of 2 cm for the whole paragraph
    'firstLine' => Converter::cmToTwip(5),   // Additional 1 cm indentation for the first line only
  ],
  'spaceAfter' => Converter::pointToTwip(12), // Corrected: Use pointToTwip() for 12 points of space
]);

// 4. Add a paragraph using the defined style
$section->addText(
  ' This is a paragraph specifically designed to test left and first-line indentation. ' .
  'You should observe that the entire paragraph is indented 2cm from the left page margin, ' .
  'and the very first line of this paragraph will be indented an additional 1cm ' .
  'beyond that. This configuration is often used for standard paragraph formatting ' .
  'in academic papers or formal documents.',
  null, // No specific text style
  $paragraphStyleName // Apply the custom paragraph style
);

// Add another paragraph for comparison, only with left indent
$section->addTextBreak(1); // Add a line break for visual separation

$phpWord->addParagraphStyle('OnlyLeftIndent', [
  'indentation' => [
    'left' => Converter::cmToTwip(2), // Only 2 cm left indentation
  ],
  'spaceAfter' => Converter::pointToTwip(12), // Corrected: Use pointToTwip()
]);

$section->addText(
  'This is a comparison paragraph that only has a 2cm left indentation. ' .
  'Its first line will start at the same position as the rest of its lines, ' .
  'unlike the paragraph above.',
  null,
  'OnlyLeftIndent'
);

// 5. Save the document
$filename = 'first_line_indentation_test.docx';
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="' . $filename . '"');
$phpWord->save('php://output', 'Word2007');
exit;

?>