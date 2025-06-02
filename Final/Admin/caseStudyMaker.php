<?php
ini_set('session.cookie_httponly', 1);
session_start();
include "../Functions/PHP/displayAlert.php";
include "../Functions/PHP/adminDataFetcher.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Social Case Study Report</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/AICS150.png" />
<style>
    body {
        font-family: 'Times New Roman', Times, serif;
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
        background-color: #000133;
    }
    .document {
        background-color: white;
        padding: 30px;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 3px solid #1b1b1b;
    }
    .logo1, .logo2 {
        height: 80px;
    }
    .title-container {
        text-align: center;
    }
    .header h2 {
        margin: 0;
        color: #002663;
    }
    .title {
        text-align: center;
        font-weight: bold;
        margin: 20px 0;
        color: #002663;
        font-size: 18px;
    }
    .date {
        text-align: right;
        margin-bottom: 20px;
        font-weight: bold;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 15px 0;
    }
    th, td {
        padding: 6px 8px;
        text-align: left;
        border: 1px solid #1b1b1b;
        font-size: 14px;
    }
    .section {
        margin: 25px 0;
    }
    .section-title {
        font-weight: bold;
        margin: 20px 0 10px 0;
        font-size: 16px;
    }
    .footer {
        text-align: center;
        margin-top: 30px;
        padding-top: 15px;
        border-top: 2px solid #1b1b1b;
        font-weight: bold;
    }
    .editable {
        color: #cc0000;
        font-weight: bold;
        border-bottom: 1px dashed #999;
        padding: 2px 4px;
        cursor: pointer;
        min-width: 100px;
        display: inline-block;
    }
    .edited {
        color: #000000 !important;
    }
    .save-print {
        margin-top: 40px;
        text-align: center;
    }
    button {
        padding: 10px 25px;
        margin: 0 10px;
        font-size: 16px;
        cursor: pointer;
        background-color: #002663;
        color: white;
        border: none;
        border-radius: 4px;
    }
    button:hover {
        background-color: #003380;
    }
    .red-text {
        color: #cc0000;
        font-weight: bold;
    }
</style>
</head>
<body>

<div class="document">
    <div class="header">
        <img src="../assets/img/Alam150.png" alt="Alaminos Seal" class="logo1">
        <div class="title-container">
            <h3>Republic of the Philippines</h3>
            <h3>MUNICIPAL SOCIAL WELFARE AND DEVELOPMENT OFFICE</h3>
            <h4>Alaminos, Laguna</h4>
        </div>
        <img src="../assets/img/dswd-logo.png" alt="DSWD" class="logo2">
    </div>

    <div class="date"><span class="editable" contenteditable="true">April 15, 2025</span></div>

    <div class="title">
        SOCIAL CASE STUDY REPORT
    </div>

    <div class="section">
        <h3 class="section-title">I. IDENTIFYING DATA:</h3>
        <table>
            <tr>
                <th>Name</th>
                <td>:</td>
                <td><span class="editable" contenteditable="true">Vilma V. Dua</span></td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td>:</td>
                <td><span class="editable" contenteditable="true">November 5, 1979</span></td>
            </tr>
            <tr>
                <th>Age</th>
                <td>:</td>
                <td><span class="editable" contenteditable="true">45 years old</span></td>
            </tr>
            <tr>
                <th>Sex</th>
                <td>:</td>
                <td><span class="editable" contenteditable="true">Female</span></td>
            </tr>
            <tr>
                <th>Civil Status</th>
                <td>:</td>
                <td><span class="editable" contenteditable="true">Separated</span></td>
            </tr>
            <tr>
                <th>Educational Attainment</th>
                <td>:</td>
                <td><span class="editable" contenteditable="true">College Undergrad.</span></td>
            </tr>
            <tr>
                <th>Occupation</th>
                <td>:</td>
                <td><span class="editable" contenteditable="true">None</span></td>
            </tr>
            <tr>
                <th>Address</th>
                <td>:</td>
                <td><span class="editable" contenteditable="true">Brgy. I Poblacion Alaminos, Laguna</span></td>
            </tr>
            <tr>
                <th>Contact Number</th>
                <td>:</td>
                <td><span class="editable" contenteditable="true">0930-460-6242</span></td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h3 class="section-title">FAMILY COMPOSITION:</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Relationship to Client</th>
                <th>Age</th>
                <th>Sex</th>
                <th>Civil Status</th>
                <th>Educational Attainment</th>
                <th>Occupation</th>
            </tr>
            <tr>
                <td><span class="editable" contenteditable="true">Ramoncito Abdul</span></td>
                <td><span class="editable" contenteditable="true">Live-in partner</span></td>
                <td><span class="editable" contenteditable="true">45</span></td>
                <td><span class="editable" contenteditable="true">M</span></td>
                <td><span class="editable" contenteditable="true">Single</span></td>
                <td><span class="editable" contenteditable="true">Vocational Graduate</span></td>
                <td><span class="editable" contenteditable="true">None</span></td>
            </tr>
            <tr>
                <td><span class="editable" contenteditable="true">Jovan Vasquez</span></td>
                <td><span class="editable" contenteditable="true">Son</span></td>
                <td><span class="editable" contenteditable="true">17</span></td>
                <td><span class="editable" contenteditable="true">M</span></td>
                <td><span class="editable" contenteditable="true">Single</span></td>
                <td><span class="editable" contenteditable="true">Grade 11</span></td>
                <td><span class="editable" contenteditable="true">Student</span></td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h3 class="section-title">PROBLEM PRESENTED:</h3>
        <p>
            Client came to this office seeking for a Social Case Study Report for their request of 
            financial/medical assistance from <span class="red-text editable" contenteditable="true">DOH-MAIP</span>.
        </p>
    </div>

    <div class="section">
        <h3 class="section-title">IV. CLIENT’S HISTORICAL BACKGROUND:</h3>
        <p>
            Client and her family rent a house that is made up of light and concrete materials. 
            Client/patient was seen and examined at <span class="editable" contenteditable="true">San Pablo City General Hospital</span> 
            under the service of <span class="editable" contenteditable="true">Dr. Navata</span> and was diagnosed of 
            <span class="editable" contenteditable="true">T/C Gastric Pathology</span> and was recommended for 
            <span class="editable" contenteditable="true">Whole Abdomen Ultrasound</span>. Client’s family are really 
            great financial difficulty to augment their medical and laboratory expenses thus she 
            asked of financial support from your good office.
        </p>
    </div>

    <div class="section">
        <h3 class="section-title">V. RECOMMENDATION:</h3>
        <p>
            In view of the foregoing facts stated above, the undersigned worker recommends the 
            client for provision of financial/medical assistance from <span class="red-text editable" contenteditable="true">DOH-MAIP</span>. We 
            continuously thank your good office for the unending support you extend to our needy 
            constituents.
        </p>
    </div>

    <div class="footer">
        <p>
            Prepared by:<br>
            <span class="editable" contenteditable="true">JEACEL F. BIÑAS, RSW</span><br>
            MSWD OFFICER<br>
            License No. <span class="editable" contenteditable="true">0021579</span><br>
            Valid Until <span class="editable" contenteditable="true">October 21, 2027</span>
        </p>
        <p>
            Noted by:<br>
            <span class="editable" contenteditable="true">HON. GLENN P. FLORES</span><br>
            Municipal Mayor
        </p>
    </div>

    <div class="save-print">
        <button onclick="saveData()">Save</button>
        <button onclick="printDocument()">Print</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editableElements = document.querySelectorAll('.editable');
        const originalValues = {};

        editableElements.forEach(element => {
            element.addEventListener('input', function() {
                if (this.textContent.trim() !== originalValues[element]) {
                    this.classList.add('edited');
                } else {
                    this.classList.remove('edited');
                }
            });

            element.addEventListener('click', function() {
                this.focus();
            });

            originalValues[element] = element.textContent.trim();
        });
    });

    function saveData() {
        const editableElements = document.querySelectorAll('.editable');
        const data = {};
        
        editableElements.forEach(element => {
            data[element.textContent.trim()] = element.textContent;
        });
        
        localStorage.setItem('caseStudyReport', JSON.stringify(data));
        alert('Data saved successfully!');
    }

    function loadData() {
        const savedData = localStorage.getItem('caseStudyReport');
        if (savedData) {
            const data = JSON.parse(savedData);
            document.querySelectorAll('.editable').forEach(element => {
                const key = element.textContent.trim();
                if (data[key]) {
                    element.textContent = data[key];
                    element.classList.add('edited');
                }
            });
        }
    }

    function printDocument() {
        window.print();
    }

    window.onload = loadData;
</script>

</body>
</html>