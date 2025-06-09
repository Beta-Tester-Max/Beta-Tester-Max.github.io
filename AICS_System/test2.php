<?php
require './../vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;

$docPath = 'example.docx';

function extractFontInfoFromTextRun($element) {
    if (method_exists($element, 'getFontStyle')) {
        $fontStyle = $element->getFontStyle();
        if ($fontStyle) {
            $fontName = $fontStyle->getName();
            $fontSize = $fontStyle->getSize();
            if ($fontName || $fontSize) {
                return [
                    'name' => $fontName ?: null,
                    'size' => $fontSize ?: null,
                ];
            }
        }
    }
    return null;
}

try {
    $phpWord = IOFactory::load($docPath);

    $fontName = null;
    $fontSize = null;

    foreach ($phpWord->getSections() as $section) {
        $elements = $section->getElements();
        foreach ($elements as $element) {
            if (get_class($element) === 'PhpOffice\PhpWord\Element\TextRun') {
                foreach ($element as $childElement) {
                    $fontInfo = extractFontInfoFromTextRun($childElement);
                    if ($fontInfo) {
                        $fontName = $fontInfo['name'];
                        $fontSize = $fontInfo['size'];
                        break 3;
                    }
                }
            } elseif (get_class($element) === 'PhpOffice\PhpWord\Element\Text') {
                $fontInfo = extractFontInfoFromTextRun($element);
                if ($fontInfo) {
                    $fontName = $fontInfo['name'];
                    $fontSize = $fontInfo['size'];
                    break 2;
                }
            }
        }
    }

    echo "<h2>Extracted Font Information</h2>";
    echo "<p><strong>Font Name:</strong> " . ($fontName ?? 'Not found') . "</p>";
    echo "<p><strong>Font Size:</strong> " . ($fontSize ? $fontSize . 'pt' : 'Not found') . "</p>";

} catch (Exception $e) {
    echo 'Error: ' . htmlspecialchars($e->getMessage());
}
