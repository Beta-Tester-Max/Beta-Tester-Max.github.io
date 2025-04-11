<!doctype html>
<?php include "connect.php";
session_start();
if (empty($_SESSION['userid'])) { ?>
    <script>window.location.href = "logout.php";</script><?php
} else {
    $userid = $_SESSION['userid'];
}
if (empty($_SESSION['assistancetype'])) {
    ?>
    <script>window.location.href = "index.php"</script>
    <?php
} else {
    $assistancetype = $_SESSION['assistancetype'];
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $assistancetype ?> Application Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="overflow-x-hidden" style="min-width: 50em;">
    <div class="container-fluid">
        <div class="row my-5">'
            <div class="col-1"></div>
            <div
                class="col-10 d-flex flex-column justify-content-center align-items-center border border-black rounded shadow p-5">
                <?php if (isset($_SESSION['goback'])) {
                    $gb = $_SESSION['goback'] ?>
                    <a class="mb-3 d-flex justify-content-center align-items-center" href="<?php echo $gb ?>">Go Back.</a>
                <?php } ?>
                <div class="mb-3 d-flex flex-column justify-content-center align-items-center">
                    <h3><?php echo $assistancetype ?> <b>Application Form</b></h3>
                </div>
                <form method="POST">
                    <?php $sql = "SELECT t1.Fname, t1.Mname, t1.Lname, t1.Birth_Date, t1.Civil_Status, t1.Contact_Number,
                                    t2.Email,
                                    t3.Address_ID, t3.Street_Address, t3.Barangay, t3.CityorMunicipality, t3.Province
                                    FROM userinfo_tbl AS t1, 
                                    register_tbl AS t2,
                                    address_tbl AS t3
                                    where t1.User_ID = '$userid' AND t2.User_ID = '$userid' AND t3.User_ID = '$userid'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $address = $row["Address_ID"];
                    ?>
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mt-3">
                                        <label class="mb-1" for="fullname">Full Name</label><br>
                                        <input class="form-control" type="text" id="fullname" name="fullname"
                                            value="<?php echo (empty($row['Mname'])) ? $row['Fname'] . "&nbsp;" . $row['Lname'] : $row['Fname'] . "&nbsp;" . $row['Mname'] . "&nbsp;" . $row['Lname'] ?>"
                                            aria-label="Disabled input example" readonly required>
                                    </div>
                                    <div class="mt-3">
                                        <label class="mb-1" for="bday">Date of Birth</label><br>
                                        <input class=" form-control" type="date" id="bday" name="bday"
                                            value="<?php echo $row['Birth_Date'] ?>" aria-label="Disabled input example"
                                            readonly required>
                                    </div>
                                    <div class="mt-3">
                                        <label class="mb-1" for="address">Address</label><br>
                                        <input class="form-control" type="text" id="address" name="address"
                                            value="<?php echo $row['Street_Address'] . "&nbsp;" . $row['Barangay'] . "&nbsp;" . $row['CityorMunicipality'] . ",&nbsp;" . $row['Province'] ?>"
                                            aria-label="Disabled input example" readonly>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mt-3">
                                        <label class="mb-1" for="civSta">Civil Status</label><br>
                                        <input class="form-control" type="text" id="civSta" name="civilstatus"
                                            value="<?php echo $row['Civil_Status'] ?>"
                                            aria-label="Disabled input example" readonly required>
                                    </div>
                                    <div class="mt-3">
                                        <label class="mb-1" for="phoneno">Contact Number</label><br>
                                        <input class="form-control" type="tel" id="phoneno" name="phoneno"
                                            pattern="0[8-9][0-9]{2}-[0-9]{3}-[0-9]{4}"
                                            value="<?php echo $row['Contact_Number'] ?>"
                                            aria-label="Disabled input example" readonly required>
                                    </div>
                                    <div class="mt-3">
                                        <label class="mb-1" for="email">Email</label><br>
                                        <input class="form-control" type="text" id="email" name="email"
                                            value="<?php echo $row['Email'] ?>" aria-label="Disabled input example"
                                            readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mt-3">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="State your reason here"
                                            id="floatingTextarea" style="height: 10em" name="reason"
                                            required></textarea>
                                        <label for="floatingTextarea">Reason</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <label class="mt-3 mb-1 d-flex justify-content-center align-items-center"><b>Choose
                                        file to Submit:</b></label>
                                <div class="col-6">
                                    <div class="mt-3">
                                        <label class="mb-1 text-danger" for="file01"><b>Required</b></label>
                                        <select class="form-select" id="file01" name="file01" required>
                                            <option value="">Select a Document Type</option>
                                            <?php $documenttype = "Barangay Indigency";
                                            $sql = "SELECT File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' 
                                                            AND Document_Type = '$documenttype' AND Status = 'Validated'";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                <option value="<?php echo $row['File_Name']; ?>">
                                                    <?php echo $documenttype ?>
                                                </option><?php
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label class="mb-1 text-danger" for="file02"><b>Required</b></label>
                                        <select class="form-select" id="file02" name="file02" required>
                                            <option value="">Select a Document Type</option>
                                            <?php $documenttype = "Valid ID";
                                            $sql = "SELECT Document_Type, File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' 
                                                            AND Document_Type = '$documenttype' AND Status = 'Validated'";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                <option value="<?php echo $row['File_Name'] ?>">
                                                    <?php echo $row['Document_Type'] ?>
                                                </option><?php
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label class="mb-1 text-danger" for="file03"><b>Required</b></label>
                                        <select class="form-select" id="file03" name="file03" required>
                                            <option value="">Select a Document Type</option>
                                            <?php if ($assistancetype === "Medical Assistance" || $assistancetype === "Burial Assistance" || $assistancetype === "Educational Assistance") {
                                                switch ($assistancetype) {
                                                    case "Medical Assistance":
                                                        $documenttype = "Hospital Billin Statement";
                                                        break;
                                                    case "Burial Assistance":
                                                        $documenttype = "Funeral Contract";
                                                        break;
                                                    case "Educational Assistance":
                                                        $documenttype = "School ID";
                                                        break;
                                                }
                                                $sql = "SELECT Document_Type, File_Name
                                                                FROM requirements_tbl 
                                                                where User_ID = '$userid' AND Status = 'Validated'
                                                                AND Document_Type = '$documenttype'";
                                                $result = mysqli_query($conn, $sql);
                                            } else {
                                                if ($assistancetype === "Transportation Assistance") {
                                                    $documenttype1 = "Death Certificate";
                                                    $documenttype2 = "Medical Report";
                                                } else {
                                                    $documenttype1 = "Birth Certificate";
                                                    $documenttype2 = "Marriage Certificate";
                                                }
                                                $sql = "SELECT Document_Type, File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND (Document_Type = '$documenttype1' OR Document_Type = '$documenttype2')";
                                                $result = mysqli_query($conn, $sql);
                                            }
                                            while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                <option value="<?php echo $row['File_Name'] ?>">
                                                    <?php echo $row['Document_Type'] ?>
                                                </option><?php
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <?php if ($assistancetype === "Food Assistance") { ?>
                                            <label class="mb-1 text-secondary" for="file04"><i>(Optional)</i></label>
                                            <select class="form-select" id="file04" name="file04">
                                            <?php } else { ?>
                                                <label class="mb-1 text-danger" for="file04"><b>Required</b></label>
                                                <select class="form-select" id="file04" name="file04" required>
                                                <?php } ?>
                                                <option value="">Select a Document Type</option>
                                                <?php switch ($assistancetype) {
                                                    case "Transportation Assistance":
                                                        $documenttype = "Police Report";
                                                        break;
                                                    case "Medical Assistance":
                                                        $documenttype = "Pharmacy Quotation";
                                                        break;
                                                    case "Burial Assistance":
                                                        $documenttype = "Official Receipts";
                                                        break;
                                                    case "Educational Assistance":
                                                        $documenttype = "Grades";
                                                        break;
                                                    case "Food Assistance":
                                                        $documenttype = "Disaster Certificate";
                                                        break;
                                                    case "Cash Relief Assistance":
                                                        $documenttype = "Incident Report";
                                                        break;
                                                    case "Psychosocial Support":
                                                        $documenttype = "Referral Letter";
                                                        ;
                                                        break;
                                                }
                                                $sql = "SELECT Document_Type, File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' 
                                                            AND Document_Type = '$documenttype' AND Status = 'Validated'";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <option value="<?php echo $row['File_Name'] ?>">
                                                        <?php echo $row['Document_Type'] ?>
                                                    </option><?php
                                                } ?>
                                            </select>
                                    </div>
                                    <div class="mt-3">
                                        <?php if ($assistancetype === "Transportation Assistance" || $assistancetype === "Medical Assistance" || $assistancetype === "Burial Assistance") { ?>
                                            <label class="mb-1 text-danger" for="file05"><b>Required</b></label>
                                            <select class="form-select" id="file05" name="file05" required>
                                            <?php } else { ?>
                                                <label class="mb-1 text-secondary" for="file05"><i>(Optional)</i></label>
                                                <select class="form-select" id="file05" name="file05">
                                                <?php } ?>
                                                <option value="">Select a Document Type</option>
                                                <?php if ($assistancetype === "Transportation Assistance" || $assistancetype === "Burial Assistance" || $assistancetype === "Educational Assistance") {
                                                    $documenttype = ($assistancetype === "Educational Assistance") ? "Medical Certificate" : "Representative Valid ID";
                                                    $sql = "SELECT Document_Type, File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' 
                                                            AND Document_Type = '$documenttype' AND Status = 'Validated'";
                                                    $result = mysqli_query($conn, $sql);
                                                } else {
                                                    if ($assistancetype === "Medical Assistance") {
                                                        $documenttype1 = "Laboratory Request";
                                                        $documenttype2 = "Diagnostic Request";
                                                    } elseif ($assistancetype === "Psychosocial Support") {
                                                        $documenttype1 = "Medical Report";
                                                        $documenttype2 = "Psychological Report";
                                                    } else {
                                                        $documenttype1 = "Medical Certificate";
                                                        $documenttype2 = "Medical Referral";
                                                    }
                                                    $sql = "SELECT Document_Type, File_Name
                                                    FROM requirements_tbl 
                                                    where User_ID = '$userid' AND Status = 'Validated' 
                                                    AND (Document_Type = '$documenttype1' OR Document_Type = '$documenttype2')";
                                                    $result = mysqli_query($conn, $sql);
                                                }
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <option value="<?php echo $row['File_Name'] ?>">
                                                        <?php echo $row['Document_Type'] ?>
                                                    </option><?php
                                                } ?>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <?php if ($assistancetype === "Food Assistance" || $assistancetype === "Cash Relief Assistance") {
                                    } else { ?>
                                        <div class="mt-3">
                                            <?php if ($assistancetype === "Psychosocial Support") { ?>
                                                <label class="mb-1 text-secondary" for="file06"><i>(Optional)</i></label>
                                                <select class="form-select" id="file06" name="file06">
                                                <?php } else { ?>
                                                    <label class="mb-1 text-danger" for="file06"><b>Required</b></label>
                                                    <select class="form-select" id="file06" name="file06" required>
                                                    <?php } ?>
                                                    <option value="">Select a Document Type</option>
                                                    <?php if ($assistancetype === "Educational Assistance" || $assistancetype === "Psychosocial Support") {
                                                        $documenttype1 = "Police Report";
                                                        $documenttype2 = htmlspecialchars(($assistancetype === "Educational Assistance") ? "Social Worker's Assessment" : "Legal Report");
                                                        $sql = "SELECT Document_Type, File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND (Document_Type = '$documenttype1' OR Document_Type = '$documenttype2')";
                                                        $result = mysqli_query($conn, $sql);
                                                    } else {
                                                        $documenttype = ($assistancetype === "Medical Assistance") ? "Official Receipts" : "Valid ID";
                                                        $sql = "SELECT Document_Type, File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND Document_Type = '$documenttype'";
                                                        $result = mysqli_query($conn, $sql);
                                                    }
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        ?>
                                                        <option value="<?php echo $row['File_Name'] ?>">
                                                            <?php echo $row['Document_Type'] ?>
                                                        </option><?php
                                                    } ?>
                                                </select>
                                        </div>
                                    <?php } ?>
                                    <?php if ($assistancetype === "Transportation Assistance" || $assistancetype === "Medical Assistance" || $assistancetype === "Burial Assistance" || $assistancetype === "Psychosocial Support") { ?>
                                        <div class="mt-3">
                                            <?php if ($assistancetype === "Psychosocial Support") { ?>
                                                <label class="mb-1 text-secondary" for="file07"><i>(Optional)</i></label>
                                                <select class="form-select" id="file07" name="file07">
                                                <?php } else { ?>
                                                    <label class="mb-1 text-danger" for="file07"><b>Required</b></label>
                                                    <select class="form-select" id="file07" name="file07" required>
                                                    <?php } ?>
                                                    <option value="">Select a Document Type</option>
                                                    <?php if ($assistancetype === "Medical Assistance") {
                                                        $documenttype = "Outstanding Payer Certificate";
                                                        $sql = "SELECT Document_Type, File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND Document_Type = '$documenttype'";
                                                        $result = mysqli_query($conn, $sql);
                                                    } else {
                                                        if ($assistancetype === "Psychosocial Support") {
                                                            $documenttype1 = "Disaster Certificate";
                                                            $documenttype2 = "Emergency Certificate";
                                                        } else {
                                                            $documenttype1 = "Birth Certificate";
                                                            $documenttype2 = "Marriage Certificate";
                                                        }
                                                        $sql = "SELECT Document_Type, File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND (Document_Type = '$documenttype1' OR Document_Type = '$documenttype2')";
                                                        $result = mysqli_query($conn, $sql);
                                                    }
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        ?>
                                                        <option value="<?php echo $row['File_Name'] ?>">
                                                            <?php echo $row['Document_Type'] ?>
                                                        </option><?php
                                                    } ?>
                                                </select>
                                        </div>
                                    <?php } ?>
                                    <?php if ($assistancetype === "Medical Assistance" || $assistancetype === "Burial Assistance") { ?>
                                        <div class="mt-3">
                                            <label class="mb-1 text-danger" for="file08"><b>Required</b></label>
                                            <select class="form-select" id="file08" name="file08" required>
                                                <option value="">Select a Document Type</option>
                                                <?php $documenttype = ($assistancetype === "Medical Assistance") ? "Representative Valid ID" : "Marriage Contract";
                                                $sql = "SELECT Document_Type, File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND Document_Type = '$documenttype'";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <option value="<?php echo $row['File_Name'] ?>">
                                                        <?php echo $row['Document_Type'] ?>
                                                    </option><?php
                                                } ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <?php if ($assistancetype === "Medical Assistance" || $assistancetype === "Burial Assistance") { ?>
                                        <div class="mt-3">
                                            <label class="mb-1 text-danger" for="file09"><b>Required</b></label>
                                            <select class="form-select" id="file09" name="file09" required>
                                                <option value="">Select a Document Type</option>
                                                <?php $documenttype = "Authorization Letter";
                                                $sql = "SELECT Document_Type, File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND Document_Type = '$documenttype'";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <option value="<?php echo $row['File_Name'] ?>">
                                                        <?php echo $row['Document_Type'] ?>
                                                    </option><?php
                                                } ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <?php if ($assistancetype === "Medical Assistance" || $assistancetype === "Burial Assistance") { ?>
                                        <div class="mt-3">
                                            <label class="mb-1 text-danger" for="file10"><b>Required</b></label>
                                            <select class="form-select" id="file10" name="file10" required>
                                                <option value="">Select a Document Type</option>
                                                <?php $documenttype = ($assistancetype === "Medical Assistance") ? "Valid ID" : "Outstanding Payer Certificate";
                                                $sql = "SELECT Document_Type, File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND Document_Type = '$documenttype'";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <option value="<?php echo $row['File_Name'] ?>">
                                                        <?php echo $row['Document_Type'] ?>
                                                    </option><?php
                                                } ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    <?php if ($assistancetype === "Medical Assistance") { ?>
                                        <div class="mt-3">
                                            <label class="mb-1 text-danger" for="file11"><b>Required</b></label>
                                            <select class="form-select" id="file11" name="file11" required>
                                                <option value="">Select a Document Type</option>
                                                <?php $documenttype1 = "Birth Certificate";
                                                $documenttype2 = "Marriage Certificate";
                                                $sql = "SELECT Document_Type, File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND (Document_Type = '$documenttype1' OR Document_Type = '$documenttype2')";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <option value="<?php echo $row['File_Name'] ?>">
                                                        <?php echo $row['Document_Type'] ?>
                                                    </option><?php
                                                } ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-2"></div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-center align-items-center">
                            <button type="submit" name="applicationForm" class="btn btn-outline-primary">Submit
                                Application</button>
                        </div>
                    </div>
                </form>
                <?php if (isset($_POST['applicationForm'])) {
                    $fullname = $_POST['fullname'];
                    $bday = $_POST['bday'];
                    $assistancetype = $_SESSION['assistancetype'];
                    $civsta = $_POST['civilstatus'];
                    $phoneno = $_POST['phoneno'];
                    $email = $_POST['email'];
                    $reason = htmlspecialchars($_POST['reason']);
                    $req1 = htmlspecialchars($_POST['file01']);
                    $req2 = htmlspecialchars($_POST['file02']);
                    $req3 = htmlspecialchars($_POST['file03']);
                    $req4 = htmlspecialchars($_POST['file04']);
                    $req5 = htmlspecialchars($_POST['file05']);
                    $req6 = htmlspecialchars($_POST['file06']);
                    $req7 = htmlspecialchars($_POST['file07']);
                    $date = date('Y-m-d');
                    $sql = "INSERT INTO application_tbl (User_ID, Full_Name, Birth_Date, Address_ID, Assistance_Type, Civil_Status, Contact_Number, Email, Reason, Req1, Req2, req3, req4, req5, req6, req7, Date_Submitted)
                                    VALUES('$userid', '$fullname', '$bday', '$address', '$assistancetype', '$civsta', '$phoneno', '$email', '$reason', '$req1', '$req2', '$req3', '$req4', '$req5', '$req6', '$req7', '$date')";
                    if ($result = mysqli_query($conn, $sql)) {
                        ?>
                        <script>alert("Your Application has been Submitted.")
                            window.location.href = "profile.php"</script><?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>