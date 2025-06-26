<?php $cd = "Case_Study";
include "./../Functions/PHP/include/dataFetcher.php";
include "./../Functions/PHP/include/alert.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AICS SYSTEM - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="./../Assets/Style/Global/style.css">
</head>
<style>
    .word-container {
        font-family: "Tahoma", sans-serif;
        width: 8.5in;
        height: 14in;
        margin: 40px auto;
        background: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.10);
        padding: 1in 0.8in;
        box-sizing: border-box;
        overflow: hidden;
        position: relative;
    }

    p {
        font-size: 11px;
    }

    img {
        width: 4em;
        height: 4em;
    }

    .fs-10 {
        font-size: 10px;
    }

    .hr {
        border-bottom: 2px solid #000000;
        margin-left: 70px;
        margin-right: 70px;
    }

    table {
        width: auto;
        max-width: 100%;
        margin-left: auto;
        margin-right: auto;
    }

    .table-borderless td,
    .table-borderless th {
        border: none;
    }

    .table-sm td,
    .table-sm th {
        padding: 0.3rem;
    }

    .table-borderless.table-sm.align-middle tr {
        line-height: 1.1;
    }

    .table-borderless.table-sm.align-middle td {
        padding-top: 0.1rem;
        padding-bottom: 0.1rem;
    }

    .glass-bg {
        background: rgba(255, 255, 255, 0.55);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border-radius: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.25);
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<body>
    <?php include "./../Assets/Global/nav.php"; ?>
    <div class="glass-bg mx-auto my-4 py-3 px-3 px-md-5 px-lg-5" style="max-width: 1200px;">
        <form method="POST" action="./../Functions/PHP/form.php">
            <!-- Form I -->
            <div class="border rounded shadow-sm p-3 bg-white mb-4 mx-auto mt-4" style="max-width: 900px;">
                <h5 class="mb-3">I. Identifying Data</h5>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control shadow-sm" placeholder="" minlength="2" maxlength="50"
                                id="fname" name="fname" required>
                            <label for="fname">First Name <span class="text-danger">*</span></label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control shadow-sm" placeholder="" maxlength="50" id="mname"
                                name="mname">
                            <label for="mname">Middle Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control shadow-sm" placeholder="" minlength="2" maxlength="50"
                                id="lname" name="lname" required>
                            <label for="lname">Last Name <span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control shadow-sm" placeholder="" id="dob" name="bday" required>
                            <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select shadow-sm" id="sx" name="sx" required>
                                <?php include './../Functions/PHP/include/sxSelect.php' ?>
                            </select>
                            <label for="sx">Sex <span class="text-danger">*</span></label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select shadow-sm" id="civStat" name="civStat" required>
                                <?php include './../Functions/PHP/include/cSSelect.php' ?>
                            </select>
                            <label for="civStat">Civil Status <span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <select class="form-select shadow-sm" id="educAtt" name="educAtt">
                                <?php include './../Functions/PHP/include/eASelect.php' ?>
                            </select>
                            <label for="educAtt">Educational Attainment</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control shadow-sm" placeholder="" maxlength="100" id="occupation"
                                name="occupation">
                            <label for="occupation">Occupation</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form II -->
            <div class="border rounded shadow-sm p-3 bg-white mb-4 mx-auto" style="max-width: 900px;">
                <h5 class="mb-3">II. Family Composition</h5>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control shadow-sm" placeholder="" id="familyMember">
                    <label for="familyMember">Number of Family Members</label>
                    <input type="hidden" id="familyMemberCount" name="familyMemberCount" value="0">
                </div>
                <select id="templateRelation" class="d-none form-select shadow-sm">
                    <?php include './../Functions/PHP/include/rSelect.php'; ?>
                </select>
                <select id="templateSex" class="d-none form-select shadow-sm">
                    <?php include './../Functions/PHP/include/sxSelect.php'; ?>
                </select>
                <select id="templateCivStat" class="d-none form-select shadow-sm">
                    <?php include './../Functions/PHP/include/cSSelect.php'; ?>
                </select>
                <select id="templateEducAtt" class="d-none form-select shadow-sm">
                    <?php include './../Functions/PHP/include/eASelect.php'; ?>
                </select>
                <div class="all-members overflow-x-hidden overflow-y-auto" id="allMembers" style="height: 32.5em;"></div>
                <div class="row">
                    <div class="col d-flex justify-content-end align-items-start mt-2">
                        <button type="button" class="btn btn-outline-dark btn-sm shadow-sm mx-1" id="addMember"><b>Add
                                Member</b></button>
                        <button type="button" class="btn btn-outline-dark btn-sm shadow-sm mx-1" style="display: none;"
                            id="removeMember"><b>Remove Member</b></button>
                    </div>
                </div>
            </div>
            <!-- Form III -->
            <div class="border rounded shadow-sm p-3 bg-white mb-4 mx-auto" style="max-width: 900px;">
                <h5 class="mb-3">III. Problem Presented</h5>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Describe the problem here" id="problem_presented_ui"
                        style="height: 100px" minlength="10" maxlength="1000" name="problem_presented_ui"
                        required></textarea>
                    <label for="problem_presented_ui">Describe the problem here</label>
                </div>
            </div>
            <!-- Form IV -->
            <div class="border rounded shadow-sm p-3 bg-white mb-4 mx-auto" style="max-width: 900px;">
                <h5 class="mb-3">IV. Client's Historical Background</h5>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Leave a comment here" id="f4text" style="height: 100px"
                        minlength="10" maxlength="10000" name="f4text" required></textarea>
                    <label for="f4text">Write Historical Background Here</label>
                </div>
            </div>
            <!-- Form V -->
            <div class="border rounded shadow-sm p-3 bg-white mb-4 mx-auto" style="max-width: 900px;">
                <h5 class="mb-3">V. Recommendation</h5>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Leave a comment here" id="f5text" style="height: 100px"
                        minlength="10" maxlength="1000" name="f5text" required></textarea>
                    <label for="f5text">Source Of Provision Here</label>
                </div>
            </div>
            <input type="hidden" name="caseStudy">
        </form>
        <div class="word-container position-relative">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <img src="./../Assets/Image/Alam150.png" alt="DSWD Logo" class="img-fluid"
                    style="width: 4em; height: 4em; margin-left: 100px;" />
                <div class="flex-grow-1 mx-3">
                    <p class="text-center mb-0">
                        Republic of the Philippines<br />
                        <span class="fs-10">MUNICIPAL SOCIAL WELFARE AND DEVELOPMENT OFFICE</span><br />
                        <span class="fs-10">Alaminos, Laguna</span>
                    </p>
                </div>
                <img src="./../Assets/Image/dswd-logo.png" alt="DSWD Logo" class="img-fluid"
                    style="width: 4em; height: 4em; margin-right: 100px;" />
            </div>
            <div class="hr"></div>
            <div class="d-flex justify-content-end mb-0"
                style="margin-top: 5px; margin-bottom: 12px; margin-right: 100px;">
                <input type="text" class="form-control form-control-sm" name="cdate" placeholder="Auto Current Date"
                    style="width: 120px; font-size:11px; background: #fff; border: 1px solid #ccc; box-shadow: none;"
                    disabled>
            </div>
            <p class="fw-bold text-center">SOCIAL CASE STUDY REPORT</p>
            <p class="fw-bold ms-4 mb-1">I. <span class="ms-3">IDENTIFYING DATA:</span></p>
            <table class="table table-borderless table-sm align-middle"
                style="width:auto; max-width:100%; font-size: 11px; margin-bottom: 20px; margin-left:141px;">
                <tbody>
                    <tr>
                        <td style="width: 150px; white-space:nowrap;"><b>Name</b></td>
                        <td style="width: 40px; white-space:nowrap;"><b>:</b></td>
                        <td style="min-width:120px;"><span id="word_name"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 150px; white-space:nowrap;"><b>Date of Birth</b></td>
                        <td style="width: 40px; white-space:nowrap;"><b>:</b></td>
                        <td style="min-width:120px;"><span id="word_dob"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 150px; white-space:nowrap;"><b>Age</b></td>
                        <td style="width: 40px; white-space:nowrap;"><b>:</b></td>
                        <td style="min-width:120px;"><span id="word_age"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 150px; white-space:nowrap;"><b>Sex</b></td>
                        <td style="width: 40px; white-space:nowrap;"><b>:</b></td>
                        <td style="min-width:120px;"><span id="word_sex"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 150px; white-space:nowrap;"><b>Civil Status</b></td>
                        <td style="width: 40px; white-space:nowrap;"><b>:</b></td>
                        <td style="min-width:120px;"><span id="word_civil_status"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 150px; white-space:nowrap;"><b>Educational Attainment</b></td>
                        <td style="width: 40px; white-space:nowrap;"><b>:</b></td>
                        <td style="min-width:120px;"><span id="word_educational_attainment"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 150px; white-space:nowrap;"><b>Occupation</b></td>
                        <td style="width: 40px; white-space:nowrap;"><b>:</b></td>
                        <td style="min-width:120px;"><span id="word_occupation"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 150px; white-space:nowrap;"><b>Address</b></td>
                        <td style="width: 40px; white-space:nowrap;"><b>:</b></td>
                        <td style="min-width:120px;"><span id="word_address"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 150px; white-space:nowrap;"><b>Contact Number</b></td>
                        <td style="width: 40px; white-space:nowrap;"><b>:</b></td>
                        <td style="min-width:120px;"><span id="word_contact_number"></span></td>
                    </tr>
                </tbody>
            </table>
            <p class="fw-bold ms-4 mb-1">II. <span class="ms-3">FAMILY COMPOSITION:</span></p>
            <input type="hidden" id="count" name="count" value="0">
            <table class="table table-bordered table-sm align-middle w-100" id="familyTableWord"
                style="font-size: 11px; font-weight: 100;">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Relationship to Client</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th>Civil Status</th>
                        <th>Educational Attainment</th>
                        <th>Occupation</th>
                    </tr>
                </thead>
                <tbody id="familyTableWordBody">
                </tbody>
            </table>
            <p class="fw-bold m-0 ms-3 mt-2">III. <span class="ms-3">&nbsp;&nbsp;PROBLEM PRESENTED:</span></p>
            <p class="text-justify me-5 mb-2" style="font-size: 11px; margin-left: 60px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="word_problem_presented"></span>
            </p>
            <p class="fw-bold m-0 ms-3 mt-2">IV. <span class="ms-3">&nbsp;&nbsp;CLIENT’S HISTORICAL BACKGROUND:</span>
            </p>
            <p class="text-justify me-5 mb-2" style="font-size: 11px; margin-left: 60px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="word_historical_background"></span>
            </p>
            <p class="fw-bold m-0 ms-3 mt-2">V. <span class="ms-3">&nbsp;&nbsp;&nbsp;&nbsp;RECOMMENDATION:</span></p>
            <p class="text-justify me-5 mb-2" style="font-size: 11px; margin-left: 60px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="word_recommendation"></span>
            </p>
            <p class="fw-bold text-end me-5 mb-1">Prepared by:</p>
            <p class="fw-bold text-end me-5 mb-1">JEACEL B. OBLINA, RSW, MMPA</p>
            <p class="text-end me-5 mb-1">MSWD OFFICER</p>
            <p class="text-end me-5 mb-1">License No. 0021579</p>
            <p class="fw-bold ms-5 mb-1">Noted by:</p>
            <p class="fw-bold ms-5 mb-1">HON. GLENN P. FLORES</p>
            <p class="ms-5 mb-0">Municipal Mayor</p>
            <img src="./../Assets/Image/ayosAlaminos.png" alt="DSWD Logo"
                style="margin-left: 45px; width: 4em; height: 2em;" />
        </div>
    </div>
    <footer class="bg-secondary text-center shadow py-2">
        <div class="d-flex justify-content-center my-4">
            <button type="button" id="submitFormBtn" class="btn btn-outline-light btn-lg shadow-sm">Submit</button>
        </div>
    </footer>
    <script src="https://kit.fontawesome.com/7961b8f896.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
    <script type="module" src="../Functions/JS/formFM.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var cdateInput = document.querySelector('input[name="cdate"]');
            if (cdateInput) {
                var now = new Date();
                var options = { year: 'numeric', month: 'long', day: 'numeric' };
                cdateInput.value = now.toLocaleDateString('en-US', options);
            }
            console.log('DOM fully loaded');
            const allMembers = document.getElementById('allMembers');
            if (allMembers) {
                console.log('#allMembers found');
            } else {
                console.error('#allMembers NOT found');
            }
            var submitBtn = document.getElementById('submitFormBtn');
            if (submitBtn) {
                submitBtn.addEventListener('click', function (e) {
                    var form = document.querySelector('form[method="POST"]');
                    if (!form) return;
                    var allRequired = form.querySelectorAll('[required]');
                    allRequired.forEach(function (field) {
                        if (typeof field.checkValidity === 'function') {
                            field.classList.remove('is-invalid');
                        }
                    });
                    var firstInvalid = null;
                    allRequired.forEach(function (field) {
                        if (typeof field.checkValidity === 'function' && !field.checkValidity()) {
                            field.classList.add('is-invalid');
                            if (!firstInvalid) firstInvalid = field;
                        }
                    });
                    if (firstInvalid) {
                        firstInvalid.focus();
                        e.preventDefault();
                        return false;
                    }
                    form.requestSubmit();
                });
                document.querySelector('form[method="POST"]').addEventListener('input', function (e) {
                    if (e.target.required && typeof e.target.checkValidity === 'function') {
                        if (e.target.checkValidity()) {
                            e.target.classList.remove('is-invalid');
                        }
                    }
                }, true);
                document.querySelector('form[method="POST"]').addEventListener('change', function (e) {
                    if (e.target.required && typeof e.target.checkValidity === 'function') {
                        if (e.target.checkValidity()) {
                            e.target.classList.remove('is-invalid');
                        }
                    }
                }, true);
            }
        });
    </script>
</body>

</html>