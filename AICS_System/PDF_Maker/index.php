<?php
require './../../vendor/autoload.php';
require_once "../Functions/PHP/connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

use Dompdf\Dompdf;
use Dompdf\Options;

if (isset($_POST['viewPDF'])) {
  $id = cleanInt(intval($_POST['id'] ?? ""));
  if (empty($id)) {
    $_SESSION['alert'] = "Missing ID!";
    header('Location: ../Case_Study/');
    exit;
  } elseif (strlen(strval($id)) > 11) {
    $_SESSION['alert'] = "Invaid ID Length.";
    header('Location: ../Case_Study/');
    exit;
  } else {

    try {
      $sql = $pdo->prepare("SELECT * FROM tbl_cs WHERE id = :1");
      $sql->bindParam(":1", $id, PDO::PARAM_INT);
      $sql->execute();

      if ($sql->rowCount() > 0) {
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $rid = cleanInt($result['r'] ?? "");
        $bcode = cleanStr(strval($result['b'] ?? ""));
        $ascode = cleanStr(strval($result['asType'] ?? ""));
        $f4 = strval($result['form_VI_text'] ?? "");
        $f5 = strval($result['form_V_text'] ?? "");

        $sql = $pdo->prepare("SELECT t1.*, t2.cn FROM tbl_c as t1, tbl_cn as t2 WHERE t1.id = :1 AND t2.c = :1");
        $sql->bindParam(":1", $rid, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $fn = strval($result['fN'] ?? "");
        $mn = strval($result['mN'] ?? "");
        $ln = strval($result['lN'] ?? "");
        $fullname = (empty($mn)) ? $fn . "&nbsp;" . $ln : $fn . "&nbsp;" . $mn . "&nbsp;" . $ln;
        $fetchedDB = strval($result['dB'] ?? "");
        $birthDate = new DateTime($fetchedDB);
        $currentDate = new DateTime();
        $age = $currentDate->diff($birthDate);
        function formatDate($dateString = null)
        {
          if ($dateString === null) {
            $dateString = (new DateTime())->format('Y-m-d');
          }

          $date = new DateTime($dateString);

          $year = $date->format('Y');
          $month = $date->format('m');
          $day = $date->format('d');

          $monthNum = ltrim($month, '0');
          switch ($monthNum) {
            case 1:
              $monthName = "January";
              break;
            case 2:
              $monthName = "February";
              break;
            case 3:
              $monthName = "March";
              break;
            case 4:
              $monthName = "April";
              break;
            case 5:
              $monthName = "May";
              break;
            case 6:
              $monthName = "June";
              break;
            case 7:
              $monthName = "July";
              break;
            case 8:
              $monthName = "August";
              break;
            case 9:
              $monthName = "September";
              break;
            case 10:
              $monthName = "October";
              break;
            case 11:
              $monthName = "November";
              break;
            case 12:
              $monthName = "December";
              break;
            default:
              $monthName = "Invalid Month";
              break;
          }

          return "$monthName $day, $year";
        }

        $fetchedSX = strval($result['s'] ?? "");
        $fetchedCS = strval($result['cS'] ?? "");
        $fetchedEA = strval($result['eA'] ?? "");
        $occupation = empty(strval($result['o'])) ? "N/A" : $result['o'];
        $cn = strval($result['cn'] ?? "");

        $sql = $pdo->prepare("SELECT sN FROM tbl_sx Where sC = :1");
        $sql->bindParam(":1", $fetchedSX, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $sx = strval($result['sN'] ?? "");

        $sql = $pdo->prepare("SELECT cSN FROM tbl_cvs Where cSC = :1");
        $sql->bindParam(":1", $fetchedCS, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $cs = strval($result['cSN'] ?? "");

        $sql = $pdo->prepare("SELECT eAN FROM tbl_ea Where eAC = :1");
        $sql->bindParam(":1", $fetchedEA, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $ea = strval($result['eAN'] ?? "");

        $sql = $pdo->prepare("SELECT bN FROM tbl_b Where bC = :1");
        $sql->bindParam(":1", $bcode, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $b = strval($result['bN'] ?? "");

        $sql = $pdo->prepare("SELECT sindiv, relation FROM tbl_rel WHERE findiv = :1");
        $sql->bindParam(":1", $rid, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $fmVar = "";

        foreach ($result as $a) {
          $sid = cleanInt($a['sindiv'] ?? "");
          $rcode = cleanStr($a['relation'] ?? "");

          $sql = $pdo->prepare("SELECT rN FROM tbl_r WHERE rC = :1");
          $sql->bindParam(":1", $rcode, PDO::PARAM_STR);
          $sql->execute();
          $result = $sql->fetch(PDO::FETCH_ASSOC);
          $r = strval($result['rN'] ?? "");

          $sql = $pdo->prepare("SELECT * FROM tbl_c WHERE id = :1");
          $sql->bindParam(":1", $sid, PDO::PARAM_INT);
          $sql->execute();
          $result = $sql->fetch(PDO::FETCH_ASSOC);
          $sfn = strval($result['fN'] ?? "");
          $smn = strval($result['mN'] ?? "");
          $sln = strval($result['lN'] ?? "");
          $sfullname = (empty($smn)) ? $sfn . "&nbsp;" . $sln : $sfn . "&nbsp;" . $smn . "&nbsp;" . $sln;
          $sfetchedDB = strval($result['dB'] ?? "");
          $sbirthDate = new DateTime($sfetchedDB);
          $sAge = $currentDate->diff($sbirthDate);
          $sfetchedSX = strval($result['s'] ?? "");
          $sfetchedCS = strval($result['cS'] ?? "");
          $sfetchedEA = strval($result['eA'] ?? "");
          $soccupation = empty(strval($result['o'])) ? "N/A" : $result['o'];

          $sql = $pdo->prepare("SELECT sN FROM tbl_sx Where sC = :1");
          $sql->bindParam(":1", $sfetchedSX, PDO::PARAM_STR);
          $sql->execute();
          $result = $sql->fetch(PDO::FETCH_ASSOC);
          $sSx = strval($result['sN'] ?? "");

          $sql = $pdo->prepare("SELECT cSN FROM tbl_cvs Where cSC = :1");
          $sql->bindParam(":1", $sfetchedCS, PDO::PARAM_STR);
          $sql->execute();
          $result = $sql->fetch(PDO::FETCH_ASSOC);
          $sCS = strval($result['cSN'] ?? "");

          $sql = $pdo->prepare("SELECT eAN FROM tbl_ea Where eAC = :1");
          $sql->bindParam(":1", $sfetchedEA, PDO::PARAM_STR);
          $sql->execute();
          $result = $sql->fetch(PDO::FETCH_ASSOC);
          $sEA = strval($result['eAN'] ?? "");

          $fmVar .= '
        <tr>
            <td style="border: 1px solid #000; font-weight: normal;">' . $sfullname . '</td>
            <td style="border: 1px solid #000; font-weight: normal; text-align: center;">' . $r . '</td>
            <td style="border: 1px solid #000; font-weight: normal; text-align: center;">' . $sAge->y . '</td>
            <td style="border: 1px solid #000; font-weight: normal; text-align: center;">' . $sSx . '</td>
            <td style="border: 1px solid #000; font-weight: normal; text-align: center;">' . $sCS . '</td>
            <td style="border: 1px solid #000; font-weight: normal; text-align: center;">' . $sEA . '</td>
            <td style="border: 1px solid #000; font-weight: normal; text-align: center;">' . $soccupation . '</td>
        </tr>
          ';
        }

        $sql = $pdo->prepare("SELECT aN FROM tbl_a Where aC = :1");
        $sql->bindParam(":1", $ascode, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $as = strval($result['aN'] ?? "");

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);
        $dswdLogoPath = realpath('../Assets/Image/dswd-logo.png');
        $alaminosLogoPath = realpath('../Assets/Image/Alam150.png');
        $asAlaminosLogoPath = realpath('../Assets/Image/ayosAlaminos.png');
        $dswdLogoData = base64_encode(file_get_contents($dswdLogoPath));
        $alaminosLogoData = base64_encode(file_get_contents($alaminosLogoPath));
        $asAlaminosData = base64_encode(file_get_contents($asAlaminosLogoPath));
        $dswdLogoBase64 = 'data:image/png;base64,' . $dswdLogoData;
        $alaminosBase64 = 'data:image/png;base64,' . $alaminosLogoData;
        $asAlaminosBase64 = 'data:image/png;base64,' . $asAlaminosData;
        // <img src="' . $alaminosBase64 . '" alt="DSWD Logo" />
        // <img src="' . $dswdLogoBase64 . '" alt="DSWD Logo" />
        // <img src="' . $asAlaminosBase64 . '" alt="DSWD Logo" />

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
    <p class="right-date m-0-date">' . formatDate() . '</p>
    <p style="margin: 0; margin-top: 20px;margin-left: 280px;"><b>SOCIAL CASE STUDY REPORT</b></p>
    <p style="margin: 0; margin-left: 100px; margin-bottom: 5px;"><b>I. <span style="margin-left: 35px;">IDENTIFYING DATA:</span></b></p>
    <table style="width:100%; border: none; font-size: 11px; margin-left: 141px; margin-bottom: 20px;">
    <tr>
    <td style="width: 150px;"><b>Name</b></td>
    <td style="width: 40px;"><b>:</b></td>
    <td>' . $fullname . '</td>
    </tr>
    <tr>
    <td style="width: 150px;"><b>Date of Birth</b></td>
    <td style="width: 40px;"><b>:</b></td>
    <td>' . formatDate($fetchedDB) . '</td>
    </tr>
    <tr>
    <td style="width: 150px;"><b>Age</b></td>
    <td style="width: 40px;"><b>:</b></td>
    <td>' . $age->y . ' years old</td>
    </tr>
    <tr>
    <td style="width: 150px;"><b>Sex</b></td>
    <td style="width: 40px;"><b>:</b></td>
    <td>' . $sx . '</td>
    </tr>
    <tr>
    <td style="width: 150px;"><b>Civil Status</b></td>
    <td style="width: 40px;"><b>:</b></td>
    <td>' . $cs . '</td>
    </tr>
    <tr>
    <td style="width: 150px;"><b>Educational Attainment</b></td>
    <td style="width: 40px;"><b>:</b></td>
    <td>' . $ea . '</td>
    </tr>
    <tr>
    <td style="width: 150px;"><b>Occupation</b></td>
    <td style="width: 40px;"><b>:</b></td>
    <td>' . $occupation . '</td>
    </tr>
    <tr>
    <td style="width: 150px;"><b>Address</b></td>
    <td style="width: 40px;"><b>:</b></td>
    <td>' . $b . ' Alaminos, Laguna</td>
    </tr>
    <tr>
    <td style="width: 150px;"><b>Contact Number</b></td>
    <td style="width: 40px;"><b>:</b></td>
    <td>' . $cn . '</td>
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
    <tbody>
     ' . $fmVar . '
        </tbody>
    </table>
    <p style="margin: 0; margin-left: 80px; margin-top: 5px;"><b>III. <span style="margin-left: 32px;">PROBLEM PRESENTED:</span></b></p>
    <p style="margin: 0; margin-left: 127px; margin-bottom: 10px; text-align: justify; margin-right: 100px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Client came to this office seeking for a Social Case Study Report for their request of ' . $as . '.</p>
    <p style="margin: 0; margin-left: 80px; margin-top: 5px;"><b>IV. <span style="margin-left: 32px;">CLIENT’S HISTORICAL BACKGROUND:</span></b></p>
    <p style="margin: 0; margin-left: 127px; margin-bottom: 10px; text-align: justify; margin-right: 100px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Client and her family rent a house that is made up of ' . $f4 . '. Client’s family are really great financial difficulty to augment their medical and laboratory expenses thus she asked of financial support from your good office.</p>
    <p style="margin: 0; margin-left: 80px; margin-top: 5px;"><b>V. <span style="margin-left: 32px;">RECOMMENDATION:</span></b></p>
    <p style="margin: 0; margin-left: 127px; margin-bottom: 15px; text-align: justify; margin-right: 100px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;In view of the foregoing facts stated above, the undersigned worker recommends the client for provision of financial/medical assistance from ' . $f5 . '. We continuously thank your good office for the unending support you extend to our needy constituents.</p>
    <p style="margin: 0; margin-left: 450px; margin-bottom: 10px;">Prepared by:</p><br>
    <p style="margin: 0; margin-left: 450px; margin-bottom: 5px;"><b>JEACEL B. Oblina, RSW, MMPA</b></p>
    <p style="margin: 0; margin-left: 450px; margin-bottom: 5px;">MSWD OFFICER</p>
    <p style="margin: 0; margin-left: 450px; margin-bottom: 5px;">License No. 0021579</p>
    <p style="margin: 0; margin-left: 120px; margin-bottom: 30px;">Noted by:</p>
    <p style="margin: 0; margin-left: 120px; margin-bottom: 5px;"><b>HON. GLENN P. FLORES</b></p>
    <p style="margin: 0; margin-left: 120px;">Municipal Mayor</p>
    <img src="' . $asAlaminosBase64 . '" alt="DSWD Logo" style="margin: 0; margin-left: 120px; width: 4em; height: 2em;" />
  </body>
  </body>
</html>
';

        $dompdf->loadHtml($html);
        $dompdf->setPaper('Legal', 'portrait');
        $dompdf->render();
        $dompdf->stream('Case_Study.pdf', array('Attachment' => 0));
      } else {
        $_SESSION['alert'] = "Case Study Doesn't Exists!";
        header('Location: ../Case_Study/');
        exit;
      }
    } catch (PDOException $e) {
      $_SESSION['alert'] = "Connection Error: " . $e->getMessage();
      header('Location: ../Case_Study/');
      exit;
    }
  }
} else {
  header('Location: ../Functions/PHP/include/logout.php');
  exit;
}
?>