<?php $cd = "Case_Study";
include "./../Functions/PHP/include/dataFetcher.php";
include "./../Functions/PHP/include/alert.php";
include "./../Functions/PHP/include/formIReq.php";
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

<body>
    <?php include "./../Assets/Global/nav.php"; ?>

    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 border rounded shadow-sm pb-2">
                <form method="POST" action="./../Functions/PHP/formI.php">
                    <div class="row">
                        <div class="col">
                            <h4 class="m-0 mt-2 user-select-none">I. BENEFECIARY</h4>
                        </div>
                        <div class="col d-flex justify-content-end align-items-start pt-2">
                            <a href="./../Functions/PHP/exitCS.php" type="button" class="btn-close"
                                aria-label="Close"></a>
                        </div>
                    </div>
                    <hr class="m-0 mb-2">
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control shadow-sm" placeholder="" minlength="2"
                                    maxlength="50" id="fname" name="fname" required>
                                <label for="fname">First Name <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control shadow-sm" placeholder="" maxlength="50"
                                    id="mname" name="mname">
                                <label for="mname">Middle Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control shadow-sm" placeholder="" minlength="2"
                                    maxlength="50" id="lname" name="lname" required>
                                <label for="lname">Last Name <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control shadow-sm" placeholder="" id="dob" name="bday"
                                    required>
                                <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select shadow-sm" id="sx" name="sx" required>
                                    <?php include "./../Functions/PHP/include/sxSelect.php" ?>
                                </select>
                                <label for="sx">Sex <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select shadow-sm" id="civStat" name="civStat" required>
                                    <?php include "./../Functions/PHP/include/cSSelect.php" ?>
                                </select>
                                <label for="civStat">Civil Status <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <select class="form-select shadow-sm" id="educAtt" name="educAtt">
                                    <?php include "./../Functions/PHP/include/eASelect.php" ?>
                                </select>
                                <label for="educAtt">Educational Attainment</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control shadow-sm" placeholder="" minlength="2"
                                    maxlength="50" id="occupation" name="occupation">
                                <label for="occupation">Occupation</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select shadow-sm" id="barangay" name="barangay" required>
                                    <?php include "./../Functions/PHP/include/bSelect.php" ?>
                                </select>
                                <label for="barangay">Barangay <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control shadow-sm" placeholder=""
                                    pattern="0[89]\d{2}-\d{3}-\d{4}" title="Format: 0999-999-9999" minlength="13"
                                    maxlength="13" id="conno" name="contactno" required>
                                <label for="conno">Contact Number <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    <hr class="m-0 mb-2">
                    <div class="row">
                        <div class="col d-flex justify-content-end align-items-start">
                            <input type="hidden" name="formI">
                            <button type="submit" class="btn btn-outline-dark btn-lg shadow-sm">Next</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-2"></div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/7961b8f896.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
</body>

</html>