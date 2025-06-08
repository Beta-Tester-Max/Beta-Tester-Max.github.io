<?php
require './../vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;

$docPath = 'example.docx';

try {
    $phpWord = IOFactory::load($docPath);
    $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');

    ob_start();
    $htmlWriter->save('php://output');
    $htmlContent = ob_get_clean();

    $htmlContent = str_replace("\t", '&nbsp;&nbsp;&nbsp;&nbsp;', $htmlContent);

    $htmlContent = preg_replace('/<meta[^>]+>/', '', $htmlContent);

    $fontName = null;
    $fontSize = null;

    foreach ($phpWord->getSections() as $section) {
        foreach ($section->getElements() as $element) {

            if (method_exists($element, 'getFontStyle') && $element->getFontStyle()) {
                $style = $element->getFontStyle();
                if ($style->getName()) $fontName = $style->getName();
                if ($style->getSize()) $fontSize = $style->getSize() . 'pt';
                if ($fontName && $fontSize) break 2;
            }

            if (method_exists($element, 'getElements')) {
                foreach ($element->getElements() as $child) {
                    if (method_exists($child, 'getFontStyle') && $child->getFontStyle()) {
                        $childStyle = $child->getFontStyle();
                        if ($childStyle->getName()) $fontName = $childStyle->getName();
                        if ($childStyle->getSize()) $fontSize = $childStyle->getSize() . 'pt';
                        if ($fontName && $fontSize) break 3;
                    }
                }
            }
        }
    }

    if (!$fontName || !$fontSize) {
        throw new Exception("Font name or font size could not be extracted from the document.");
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Editable Word Viewer</title>
        <style>
            body {
                background-color: #f4f4f4;
                padding: 30px;
            }
            .doc-container {
                background-color: white;
                width: 816px;
                min-height: 1056px;
                padding: 60px;
                margin: auto;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border: 1px solid #ccc;
                outline: none;
                white-space: pre-wrap;
            }
            .button-container {
                text-align: center;
                margin-top: 20px;
            }
            button {
                padding: 10px 20px;
                font-size: 16px;
                background-color: #007BFF;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            button:hover {
                background-color: #0056b3;
            }
            .font-info {
                width: 816px;
                margin: 10px auto;
                font-family: Arial, sans-serif;
                font-size: 14px;
                background: #fff;
                padding: 10px 20px;
                border: 1px solid #ccc;
                box-shadow: 0 0 5px rgba(0,0,0,0.1);
                text-align: center;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <div class="font-info">
            <strong>Extracted Font:</strong> <?= htmlspecialchars($fontName) ?> |
            <strong>Font Size:</strong> <?= htmlspecialchars($fontSize) ?>
        </div>

        <div class="doc-container" contenteditable="true">
            <?= $htmlContent ?>
        </div>

        <div class="button-container">
            <button onclick="saveContent()">💾 Save as Word</button>
        </div>

        <script>
        function saveContent() {
            const htmlContent = document.querySelector('.doc-container').innerHTML;
            const fontName = <?= json_encode($fontName) ?>;
            const fontSize = <?= json_encode($fontSize) ?>;

            fetch("save.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ 
                    content: htmlContent,
                    fontName: fontName,
                    fontSize: fontSize
                })
            })
            .then(response => response.blob())
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                a.download = "edited.docx";
                a.click();
                window.URL.revokeObjectURL(url);
            })
            .catch(error => alert("Failed to save document: " + error));
        }
        </script>
    </body>
    </html>
    <?php
} catch (Exception $e) {
    echo '<h1>Error loading document</h1>';
    echo '<p style="color:red; font-weight:bold;">' . htmlspecialchars($e->getMessage()) . '</p>';
}
?>
