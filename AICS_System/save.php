<?php
require './../vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;

header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
header("Content-Disposition: attachment; filename=edited.docx");

$data = json_decode(file_get_contents('php://input'), true);
$html = $data['content'] ?? '';
$fontName = $data['fontName'] ?? 'Calibri';
$fontSize = $data['fontSize'] ?? '12pt';

$wrappedHtml = '<div style="font-family:' . htmlspecialchars($fontName) . '; font-size:' . htmlspecialchars($fontSize) . ';">' . $html . '</div>';

$phpWord = new PhpWord();

$phpWord->setDefaultFontName($fontName);
$phpWord->setDefaultFontSize((int)filter_var($fontSize, FILTER_SANITIZE_NUMBER_INT));

$section = $phpWord->addSection();

Html::addHtml($section, $wrappedHtml, false, false);

$tempFile = tempnam(sys_get_temp_dir(), 'word');
$xmlWriter = IOFactory::createWriter($phpWord, 'Word2007');
$xmlWriter->save($tempFile);

readfile($tempFile);
unlink($tempFile);
