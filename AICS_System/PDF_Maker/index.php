<?php
require './../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Initialize DOMPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$dompdf = new Dompdf($options);

// Get the absolute path of the image
$dswdLogoPath = realpath('../Assets/Image/dswd-logo.png');
$alaminosLogoPath = realpath('../Assets/Image/Alam150.png');
$asAlaminosLogoPath = realpath('../Assets/Image/ayosAlaminos.png');
$dswdLogoData = base64_encode(file_get_contents($dswdLogoPath));
$alaminosLogoData = base64_encode(file_get_contents($alaminosLogoPath));
$asAlaminosData = base64_encode(file_get_contents($asAlaminosLogoPath ));
$dswdLogoBase64 = 'data:image/png;base64,' . $dswdLogoData;
$alaminosBase64 = 'data:image/png;base64,' . $alaminosLogoData;
$asAlaminosBase64 = 'data:image/png;base64,' . $asAlaminosData;
// <img src="' . $alaminosBase64 . '" alt="DSWD Logo" />
// <img src="' . $dswdLogoBase64 . '" alt="DSWD Logo" />
// <img src="' . $asAlaminosBase64 . '" alt="DSWD Logo" />

// Create HTML content for your PDF with the Base64 image
$html = '
    <html>
  <head>
    <style>
      body {
        font-family: "calibri(body)", sans-serif;
      }
      h1 {
        color: #4caf50;
      }
      p {
        font-size: 11px;
      }
      img {
        width: 4em;
        height: 4em;
      }
      .text-center {
        text-align: center;
      }
      .mx {
        margin-left: 20px;
        margin-right: 20px;
      }
      .hr {
        border-bottom: 2px solid #000000;
        margin-left: 70px;
        margin-right: 70px;
      } 
      .center-container {
        text-align: center;
        display: block;
      }
      .inline-block {
        display: inline-block;
        vertical-align: middle;
      }
      .m-0-date {
        margin: 0;
        margin-top: 5px;
        margin-right: 125px;
      }
    .m-0-date-v2 {
        margin: 0;
        margin-top: 5px;
        margin-right: 190px;
      }
      .right-date {
        float: right;
      }
      .fs-10 {
        font-size: 10px;
      }
        th {
         style="width:100%; border: 1px solid #000000;"
}
    </style>
  </head>
  <body>
    <div class="center-container">
      <div class="inline-block">
        <img src="' . $alaminosBase64 . '" alt="DSWD Logo" />
      </div>
      <div class="inline-block mx">
        <p class="text-center">
          Republic of the Philippines<br />
          <span class="fs-10">MUNICIPAL SOCIAL WELFARE AND DEVELOPMENT OFFICE</span><br />
          <span class="fs-10">Alaminos, Laguna</span>
        </p>
      </div>
      <div class="inline-block">
        <img src="' . $dswdLogoBase64 . '" alt="DSWD Logo" />
      </div>
    </div>
    <div class="hr"></div>
    <p class="right-date m-0-date">April 15, 2025</p>
    <p style="margin: 0; margin-top: 20px;margin-left: 280px;"><b>SOCIAL CASE STUDY REPORT</b></p>
    <p style="margin: 0; margin-left: 100px; margin-bottom: 5px;"><b>I. <span style="margin-left: 35px;">IDENTIFYING DATA:</span></b></p>
    <table style="width:100%; border: none; font-size: 11px; margin-left: 141px; margin-bottom: 20px;">
    <tr>
    <td style="width: 150px;"><b>Name</b></td>
    <td style="width: 40px;"><b>:</b></td>
    <td>Vilma V. Dua</td>
    </tr>
    <tr>
    <td style="width: 150px;"><b>Date of Birth</b></td>
    <td style="width: 40px;"><b>:</b></td>
    <td>November 5, 1979</td>
    </tr>
    <tr>
    <td style="width: 150px;"><b>Age</b></td>
    <td style="width: 40px;"><b>:</b></td>
    <td>November 5, 1979</td>
    </tr>
    <tr>
    <td style="width: 150px;"><b>Sex</b></td>
    <td style="width: 40px;"><b>:</b></td>
    <td>November 5, 1979</td>
    </tr>
    <tr>
    <td style="width: 150px;"><b>Civil Status</b></td>
    <td style="width: 40px;"><b>:</b></td>
    <td>November 5, 1979</td>
    </tr>
    <tr>
    <td style="width: 150px;"><b>Educational Attainment</b></td>
    <td style="width: 40px;"><b>:</b></td>
    <td>November 5, 1979</td>
    </tr>
    <tr>
    <td style="width: 150px;"><b>Occupation</b></td>
    <td style="width: 40px;"><b>:</b></td>
    <td>November 5, 1979</td>
    </tr>
    <tr>
    <td style="width: 150px;"><b>Address</b></td>
    <td style="width: 40px;"><b>:</b></td>
    <td>November 5, 1979</td>
    </tr>
    <tr>
    <td style="width: 150px;"><b>Contact Number</b></td>
    <td style="width: 40px;"><b>:</b></td>
    <td>November 5, 1979</td>
    </tr>
    </table>
    <p style="margin: 0; margin-left: 100px; margin-bottom: 5px;"><b>II. <span style="margin-left: 32px;">FAMILY COMPOSITION:</span></b></p>
    <table style="width:100%; border: 1px solid #000000; border-collapse: collapse; font-size: 11px; font-weight: 100;">
    <thead>
    <tr>
    <th style="border: 1px solid #000000; text-align: left;">Name</th>
    <th style="border: 1px solid #000000;">Relationship to Client</th>
    <th style="border: 1px solid #000000;">Age</th>
    <th style="border: 1px solid #000000;">Sex</th>
    <th style="border: 1px solid #000000;">Civil Status</th>
    <th style="border: 1px solid #000000;">Educational Attainment</th>
    <th style="border: 1px solid #000000;">Occupation</th>
    </tr>
    </thead>
     <tr>
            <td style="border: 1px solid #000; font-weight: normal;">John Doe</td>
            <td style="border: 1px solid #000; font-weight: normal; text-align: center;">Spouse</td>
            <td style="border: 1px solid #000; font-weight: normal; text-align: center;">35</td>
            <td style="border: 1px solid #000; font-weight: normal; text-align: center;">Male</td>
            <td style="border: 1px solid #000; font-weight: normal; text-align: center;">Married</td>
            <td style="border: 1px solid #000; font-weight: normal; text-align: center;">Bachelor\'s</td>
            <td style="border: 1px solid #000; font-weight: normal; text-align: center;">Engineer</td>
        </tr>
    </table>
    <p style="margin: 0; margin-left: 80px; margin-top: 5px;"><b>III. <span style="margin-left: 32px;">PROBLEM PRESENTED:</span></b></p>
    <p style="margin: 0; margin-left: 127px; margin-bottom: 10px; text-align: justify; margin-right: 100px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Client came to this office seeking for a Social Case Study Report for their request of financial/medical assistance from DOH-MAIP.</p>
    <p style="margin: 0; margin-left: 80px; margin-top: 5px;"><b>IV. <span style="margin-left: 32px;">CLIENT’S HISTORICAL BACKGROUND:</span></b></p>
    <p style="margin: 0; margin-left: 127px; margin-bottom: 10px; text-align: justify; margin-right: 100px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Client and her family rent a house that is made up of light and concrete materials. Client/patient was seen and examined at San Pablo City General Hospital San Pablo City, Laguna under the service of Dr. Navata and was diagnosed of T/C Gastric Pathology and was recommended for Whole Abdomen Ultrasound. Client’s family are really great financial difficulty to augment their medical and laboratory expenses thus she asked of financial support from your good office.</p>
    <p style="margin: 0; margin-left: 80px; margin-top: 5px;"><b>V. <span style="margin-left: 32px;">RECOMMENDATION:</span></b></p>
    <p style="margin: 0; margin-left: 127px; margin-bottom: 15px; text-align: justify; margin-right: 100px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;In view of the foregoing facts stated above, the undersigned worker recommends the client for provision of financial/medical assistance from DOH-MAIP. We continuously thank your good office for the unending support you extend to our needy constituents.</p>
    <p style="margin: 0; margin-left: 450px; margin-bottom: 10px;">Prepared by:</p><br>
    <p style="margin: 0; margin-left: 450px; margin-bottom: 5px;"><b>JEACEL F. BIÑAS, RSW</b></p>
    <p style="margin: 0; margin-left: 450px; margin-bottom: 5px;">MSWD OFFICER</p>
    <p style="margin: 0; margin-left: 450px; margin-bottom: 5px;">License No. 0021579</p>
    <p style="margin: 0; margin-left: 450px; margin-bottom: 30px;">Valid Until October 21, 2027</p>
    <p style="margin: 0; margin-left: 120px; margin-bottom: 30px;">Noted by:</p>
    <p style="margin: 0; margin-left: 120px; margin-bottom: 5px;"><b>HON. GLENN P. FLORES</b></p>
    <p style="margin: 0; margin-left: 120px;">Municipal Mayor</p>
    <img src="' . $asAlaminosBase64 . '" alt="DSWD Logo" style="margin: 0; margin-left: 120px; width: 4em; height: 2em;" />
  </body>
  </body>
</html>
';


// Load HTML content into DOMPDF
$dompdf->loadHtml($html);

// (Optional) Set Paper Size (default is A4)
$dompdf->setPaper('Legal', 'portrait');

// Render PDF from HTML (first pass)
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream('generated_pdf.pdf', array('Attachment' => 0));
?>