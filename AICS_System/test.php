<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Case Study Report</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #000133;
        }

        .document {
            background-color: white;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #1b1b1b;
        }

        .logo1 {
            height: 80px;
        }

        .logo2 {
            height: 100px;
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

        th,
        td {
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
            <img src="./Assets/Image/Alam150.png" alt="Alaminos Seal" class="logo1 img" />
            <div class="title-container">
                <h3>Republic of the Philippines</h3>
                <h3>MUNICIPAL SOCIAL WELFARE AND DEVELOPMENT OFFICE</h3>
                <h4>Alaminos, Laguna</h4>
            </div>
            <img src="./Assets/Image/dswd-logo.png" alt="DSWD" class="logo2 img" />
        </div>

        <!-- Editable Date -->
        <div class="date">
            <span class="editable" contenteditable="true">April 15, 2025</span>
        </div>

        <div class="title">SOCIAL CASE STUDY REPORT</div>

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

        <!-- Other sections remain the same -->
        <div class="section">
            <h3 class="section-title">PROBLEM PRESENTED:</h3>
            <p>
                Client came to this office seeking for a Social Case Study Report for their request of financial/medical
                assistance from
                <span class="red-text editable" contenteditable="true">DOH-MAIP</span>.
            </p>
        </div>

        <div class="section">
            <h3 class="section-title">ASSESSMENT:</h3>
            <p class="editable" contenteditable="true">Client has an income of P5,000 monthly...</p>
        </div>

        <!-- Add more editable sections as needed -->

        <div class="footer">
            <p>Prepared by: <span class="editable" contenteditable="true">Jane Doe</span></p>
            <p>Noted by: <span class="editable" contenteditable="true">Mark Doe</span></p>
        </div>

        <div class="save-print">
            <button type="button" onclick="saveReport()">Save and Download Report</button>
        </div>
    </div>

    <script>    
        function saveReport() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'test2.php';

            const editableFields = document.querySelectorAll('.editable');

            editableFields.forEach((field, index) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `field${index + 1}`;
                input.value = field.innerText.trim();
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>

</html>