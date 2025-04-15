<!doctype html>
<?php include "connect.php";
session_start();
if (empty($_SESSION['userid'])) { ?>
    <script>window.location.href = "logout.php";</script><?php
} else {
    $userid = $_SESSION['userid'];
}
if (empty($_SESSION['appid'])) {
    ?>
    <script>window.location.href = "profile.php#pending"</script><?php
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
    <title>Edit <?php echo $assistancetype ?> Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="overflow-x-hidden" style="min-width: 50em;">
    <div class="container-fluid">
        <div class="row">'
            <div class="col-12">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <div class="border border-black rounded shadow p-5">
                        <?php if (isset($_SESSION['goback'])) {
                            $gb = $_SESSION['goback'] ?>
                            <a class="mb-3 d-flex justify-content-center align-items-center" href="<?php echo $gb ?>">Go
                                Back.</a>
                        <?php } ?>
                        <div class="mb-3 d-flex flex-column justify-content-center align-items-center">
                            <h3><b><?php echo $assistancetype ?> Application Form</b></h3>
                            <form class="d-flex flex-column justify-content-center align-items-center" method="POST">
                                <label class="mb-1" for="changeAssist">Change Assistance Type:</label>
                                <div class="d-flex">
                                    <select id="changeAssist" class="form-select me-2" name="asstype">
                                        <?php $assistancetypearray = array(
                                            'Transportation Assistance',
                                            'Medical Assistance',
                                            'Burial Assistance',
                                            'Educational Assistance',
                                            'Food Assistance',
                                            'Cash Relief Assistance',
                                            'Psychosocial Support'
                                        );
                                        foreach ($assistancetypearray as $at) {
                                            ;
                                            $rows = [];
                                            $sql = "SELECT Document_Type
                                            FROM requirements_tbl 
                                            where User_ID = '$userid' AND Status = 'Validated'";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_array($result)) {
                                                $rows[] = $row['Document_Type'];
                                            }
                                            if ($at === "Transportation Assistance") {
                                                if (in_array("Barangay Indigency", $rows)) {
                                                    if (in_array("Medical Certificate Referral", $rows)) {
                                                        if (in_array("Death Certificate", $rows) || in_array("Medical Report", $rows)) {
                                                            if (in_array("Police Report", $rows)) {
                                                                if (in_array("Representative Valid ID", $rows)) {
                                                                    if (in_array("Valid ID", $rows)) {
                                                                        if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
                                                                            ?>
                                                                            <option class="<?php echo $at ?>"><?php echo $at ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            if ($at === "Medical Assistance") {
                                                if (in_array("Barangay Indigency", $rows)) {
                                                    if (in_array("Medical Certificate", $rows) || in_array("Clinical Abstract", $rows)) {
                                                        if (in_array("Hospital Billing Statement", $rows)) {
                                                            if (in_array("Pharmacy Quotation", $rows)) {
                                                                if (in_array("Laboratory Request", $rows) || in_array("Diagnostic Request", $rows)) {
                                                                    if (in_array("Official Receipts", $rows)) {
                                                                        if (in_array("Outstanding Payer Certificate", $rows)) {
                                                                            if (in_array("Representative Valid ID", $rows)) {
                                                                                if (in_array("Authorization Letter", $rows)) {
                                                                                    if (in_array("Valid ID", $rows)) {
                                                                                        if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
                                                                                            ?>
                                                                                            <option class="<?php echo $at ?>"><?php echo $at ?></option>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            if ($at === "Burial Assistance") {
                                                if (in_array("Barangay Indigency", $rows)) {
                                                    if (in_array("Death Certificate", $rows)) {
                                                        if (in_array("Funeral Contract", $rows)) {
                                                            if (in_array("Official Receipts", $rows)) {
                                                                if (in_array("Representative Valid ID", $rows)) {
                                                                    if (in_array("Valid ID", $rows)) {
                                                                        if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
                                                                            if (in_array("Authorization Letter", $rows)) {
                                                                                if (in_array("Marriage Contract", $rows)) {
                                                                                    if (in_array("Outstanding Payer Certificate", $rows)) {
                                                                                        ?>
                                                                                        <option class="<?php echo $at ?>"><?php echo $at ?></option>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            if ($at === "Educational Assistance") {
                                                if (in_array("Barangay Indigency", $rows)) {
                                                    if (in_array("Enrollment Assessment Form", $rows) || in_array("Certificate of Enrollment", $rows)) {
                                                        if (in_array("School ID", $rows)) {
                                                            if (in_array("Grade", $rows)) {
                                                                if (in_array("Police Report", $rows) || in_array("Social Worker's Assessment", $rows)) {
                                                                    ?>
                                                                    <option class="<?php echo $at ?>"><?php echo $at ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            if ($at === "Food Assistance") {
                                                if (in_array("Barangay Indigency", $rows)) {
                                                    if (in_array("Valid ID", $rows)) {
                                                        if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
                                                            ?>
                                                            <option class="<?php echo $at ?>"><?php echo $at ?></option>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            }
                                            if ($at === "Cash Relief Assistance") {
                                                if (in_array("Barangay Indigency", $rows)) {
                                                    if (in_array("Valid ID", $rows)) {
                                                        if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
                                                            if (in_array("Incident Report", $rows)) {
                                                                ?>
                                                                <option class="<?php echo $at ?>"><?php echo $at ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            if ($at === "Psychosocial Support") {
                                                if (in_array("Barangay Indigency", $rows)) {
                                                    if (in_array("Valid ID", $rows)) {
                                                        if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
                                                            if (in_array("Referral Letter", $rows)) {
                                                                ?>
                                                                <option class="<?php echo $at ?>"><?php echo $at ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        } ?>
                                    </select>
                                    <button type="submit" class="btn btn-primary"
                                        name="changeAssistType">Choose</button>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['changeAssistType'])) {
                                $_SESSION['assistancetype'] = $_POST['asstype']; ?>
                                <script>window.location.href = "applicationeditor.php"</script>
                            <?php }
                            ?>
                        </div>
                        <form method="POST">
                            <?php $appid = $_SESSION['appid'];
                            $sql = "SELECT Address_ID FROM application_tbl where Application_ID = '$appid'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $addid = $row['Address_ID'];
                            $sql = "SELECT t1.Fname, t1.Mname, t1.Lname, t1.Birth_Date, t1.Civil_Status, t1.Contact_Number, t2.Email, t4.Reason,
                                    t4.Req1, t4.Req2, t4.Req3, t4.Req4, t4.Req5, t4.Req6, t4.Req7, t4.Req8, t4.Req9, t4.Req10, t4.Req11,
                                    t4.Edited_Count, t4.Date_Edited, t4.Assistance_Type,
                                    t3.Street_Address, t3.Barangay, t3.CityorMunicipality, t3.Province
                                    FROM userinfo_tbl AS t1,
                                    register_tbl AS t2,
                                    address_tbl AS t3,
                                    application_tbl AS t4
                                    where t1.User_ID = '$userid' AND t2.User_ID = '$userid'
                                    AND t3.Address_ID ='$addid' AND t4.Application_ID = '$appid'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            if (isset($row['Assistance_Type']) && $row['Assistance_Type'] === $assistancetype) {
                                $req1 = (isset($row['Req1'])) ? $row['Req1'] : "";
                                $req2 = (isset($row['Req2'])) ? $row['Req2'] : "";
                                $req3 = (isset($row['Req3'])) ? $row['Req3'] : "";
                                $req4 = (isset($row['Req4'])) ? $row['Req4'] : "";
                                $req5 = (isset($row['Req5'])) ? $row['Req5'] : "";
                                $req6 = (isset($row['Req6'])) ? $row['Req6'] : "";
                                $req7 = (isset($row['Req7'])) ? $row['Req7'] : "";
                                $req8 = (isset($row['Req8'])) ? $row['Req8'] : "";
                                $req9 = (isset($row['Req9'])) ? $row['Req9'] : "";
                                $req10 = (isset($row['Req10'])) ? $row['Req10'] : "";
                                $req11 = (isset($row['Req11'])) ? $row['Req11'] : "";
                            } else {
                                $req1 = "";
                                $req2 = "";
                                $req3 = "";
                                $req4 = "";
                                $req5 = "";
                                $req6 = "";
                                $req7 = "";
                                $req8 = "";
                                $req9 = "";
                                $req10 = "";
                                $req11 = "";
                            }
                            $ecount = (isset($row['Edited_Count'])) ? $row['Edited_Count'] : "";
                            $edate = (isset($row['Date_Edited'])) ? $row['Date_Edited'] : "";
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
                                                    value="<?php echo $row['Birth_Date'] ?>"
                                                    aria-label="Disabled input example" readonly required>
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
                                                    value="<?php echo $row['Email'] ?>"
                                                    aria-label="Disabled input example" readonly required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mt-3">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="State your reason here"
                                                    id="floatingTextarea" style="height: 10em" name="reason"
                                                    required><?php echo $row['Reason'] ?></textarea>
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
                                                    <?php if (empty($req1)) { ?>
                                                        <option value="">Select a Document Type</option>
                                                    <?php } else {
                                                        $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req1'";
                                                        $result = mysqli_query($conn, $sql);
                                                        $row = mysqli_fetch_assoc($result);
                                                        ?>
                                                        <option value="<?php echo $req1 ?>">
                                                            <?php echo $row['Document_Type'] ?>
                                                        </option>
                                                    <?php }
                                                    $documenttype = "Barangay Indigency";
                                                    $sql = "SELECT File_ID
                                                    FROM requirements_tbl 
                                                    where User_ID = '$userid' 
                                                    AND Document_Type = '$documenttype' AND Status = 'Validated'
                                                    AND NOT File_ID = '$req1'";
                                                    $result = mysqli_query($conn, $sql);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        ?>
                                                        <option value="<?php echo $row['File_ID']; ?>">
                                                            <?php echo $documenttype ?>
                                                        </option><?php
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                                <label class="mb-1 text-danger" for="file02"><b>Required</b></label>
                                                <select class="form-select" id="file02" name="file02" required>
                                                    <?php if (empty($req2)) { ?>
                                                        <option value="">Select a Document Type</option>
                                                    <?php } else {
                                                        $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req2'";
                                                        $result = mysqli_query($conn, $sql);
                                                        $row = mysqli_fetch_assoc($result);
                                                        ?>
                                                        <option value="<?php echo $req2 ?>">
                                                            <?php echo $row['Document_Type'] ?>
                                                        </option>
                                                    <?php }
                                                    if ($assistancetype === "Medical Assistance" || $assistancetype === "Educational Assistance") {
                                                        $documenttype1 = ($assistancetype === "Medical Assistance") ? "Medical Certificate" : "Enrollment Assessment Form";
                                                        $documenttype2 = ($assistancetype === "Medical Assistance") ? "Clinical Abstact" : "Certificate of Enrollment";
                                                        $sql = "SELECT Document_Type, File_ID
                                                                FROM requirements_tbl 
                                                                where User_ID = '$userid' 
                                                                AND Status = 'Validated'
                                                                AND (Document_Type = '$documenttype1' OR Document_Type = '$documenttype2')
                                                                AND NOT File_ID = '$req2'";
                                                        $result = mysqli_query($conn, $sql);
                                                    } else {
                                                        switch ($documenttype) {
                                                            case "Transportation Assistance":
                                                                $documenttype = "Medical Certificate Referral";
                                                                break;
                                                            case "Burial Assistance":
                                                                $documenttype = "Death Certificate";
                                                                break;
                                                            default:
                                                                $documenttype = "Valid ID";
                                                        }
                                                        $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' 
                                                            AND Document_Type = '$documenttype' AND Status = 'Validated'
                                                            AND NOT File_ID = '$req2'";
                                                        $result = mysqli_query($conn, $sql);
                                                    }
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        ?>
                                                        <option value="<?php echo $row['File_ID'] ?>">
                                                            <?php echo $row['Document_Type'] ?>
                                                        </option><?php
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                                <label class="mb-1 text-danger" for="file03"><b>Required</b></label>
                                                <select class="form-select" id="file03" name="file03" required>
                                                    <?php if (empty($req3)) { ?>
                                                        <option value="">Select a Document Type</option>
                                                    <?php } else {
                                                        $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req3'";
                                                        $result = mysqli_query($conn, $sql);
                                                        $row = mysqli_fetch_assoc($result);
                                                        ?>
                                                        <option value="<?php echo $req3 ?>">
                                                            <?php echo $row['Document_Type'] ?>
                                                        </option>
                                                    <?php }
                                                    if ($assistancetype === "Medical Assistance" || $assistancetype === "Burial Assistance" || $assistancetype === "Educational Assistance") {
                                                        switch ($assistancetype) {
                                                            case "Medical Assistance":
                                                                $documenttype = "Hospital Billing Statement";
                                                                break;
                                                            case "Burial Assistance":
                                                                $documenttype = "Funeral Contract";
                                                                break;
                                                            case "Educational Assistance":
                                                                $documenttype = "School ID";
                                                                break;
                                                        }
                                                        $sql = "SELECT Document_Type, File_ID
                                                                FROM requirements_tbl 
                                                                where User_ID = '$userid' AND Status = 'Validated'
                                                                AND Document_Type = '$documenttype'
                                                                AND NOT File_ID = '$req3'";
                                                        $result = mysqli_query($conn, $sql);
                                                    } else {
                                                        if ($assistancetype === "Transportation Assistance") {
                                                            $documenttype1 = "Death Certificate";
                                                            $documenttype2 = "Medical Report";
                                                        } else {
                                                            $documenttype1 = "Birth Certificate";
                                                            $documenttype2 = "Marriage Certificate";
                                                        }
                                                        $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND (Document_Type = '$documenttype1' OR Document_Type = '$documenttype2')
                                                            AND NOT File_ID = '$req3'";
                                                        $result = mysqli_query($conn, $sql);
                                                    }
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        ?>
                                                        <option value="<?php echo $row['File_ID'] ?>">
                                                            <?php echo $row['Document_Type'] ?>
                                                        </option><?php
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                                <?php if ($assistancetype === "Food Assistance") { ?>
                                                    <label class="mb-1 text-secondary"
                                                        for="file04"><i>(Optional)</i></label>
                                                    <select class="form-select" id="file04" name="file04">
                                                    <?php } else { ?>
                                                        <label class="mb-1 text-danger" for="file04"><b>Required</b></label>
                                                        <select class="form-select" id="file04" name="file04" required>
                                                        <?php } ?>
                                                        <?php if (empty($req4)) { ?>
                                                            <option value="">Select a Document Type</option>
                                                        <?php } else {
                                                            $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req4'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_assoc($result);
                                                            ?>
                                                            <option value="<?php echo $req4 ?>">
                                                                <?php echo $row['Document_Type'] ?>
                                                            </option>
                                                        <?php }
                                                        switch ($assistancetype) {
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
                                                        $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' 
                                                            AND Document_Type = '$documenttype' AND Status = 'Validated'
                                                            AND NOT File_ID = '$req4'";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <option value="<?php echo $row['File_ID'] ?>">
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
                                                        <label class="mb-1 text-secondary"
                                                            for="file05"><i>(Optional)</i></label>
                                                        <select class="form-select" id="file05" name="file05">
                                                        <?php } ?>
                                                        <?php if (empty($req5)) { ?>
                                                            <option value="">Select a Document Type</option>
                                                        <?php } else {
                                                            $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req5'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_assoc($result);
                                                            ?>
                                                            <option value="<?php echo $req5 ?>">
                                                                <?php echo $row['Document_Type'] ?>
                                                            </option>
                                                        <?php }
                                                        if ($assistancetype === "Transportation Assistance" || $assistancetype === "Burial Assistance" || $assistancetype === "Educational Assistance") {
                                                            $documenttype = ($assistancetype === "Educational Assistance") ? "Medical Certificate" : "Representative Valid ID";
                                                            $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' 
                                                            AND Document_Type = '$documenttype' AND Status = 'Validated'
                                                            AND NOT File_ID = '$req5'";
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
                                                            $sql = "SELECT Document_Type, File_ID
                                                    FROM requirements_tbl 
                                                    where User_ID = '$userid' AND Status = 'Validated' 
                                                    AND (Document_Type = '$documenttype1' OR Document_Type = '$documenttype2')
                                                    AND NOT File_ID = '$req5'";
                                                            $result = mysqli_query($conn, $sql);
                                                        }
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <option value="<?php echo $row['File_ID'] ?>">
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
                                                        <label class="mb-1 text-secondary"
                                                            for="file06"><i>(Optional)</i></label>
                                                        <select class="form-select" id="file06" name="file06">
                                                        <?php } else { ?>
                                                            <label class="mb-1 text-danger" for="file06"><b>Required</b></label>
                                                            <select class="form-select" id="file06" name="file06" required>
                                                            <?php } ?>
                                                            <?php if (empty($req6)) { ?>
                                                                <option value="">Select a Document Type</option>
                                                            <?php } else {
                                                                $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req6'";
                                                                $result = mysqli_query($conn, $sql);
                                                                $row = mysqli_fetch_assoc($result);
                                                                ?>
                                                                <option value="<?php echo $req6 ?>">
                                                                    <?php echo $row['Document_Type'] ?>
                                                                </option>
                                                            <?php }
                                                            if ($assistancetype === "Educational Assistance" || $assistancetype === "Psychosocial Support") {
                                                                $documenttype1 = "Police Report";
                                                                $documenttype2 = htmlspecialchars(($assistancetype === "Educational Assistance") ? "Social Worker's Assessment" : "Legal Report");
                                                                $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND (Document_Type = '$documenttype1' OR Document_Type = '$documenttype2')
                                                            AND NOT File_ID = '$req6'";
                                                                $result = mysqli_query($conn, $sql);
                                                            } else {
                                                                $documenttype = ($assistancetype === "Medical Assistance") ? "Official Receipts" : "Valid ID";
                                                                $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND Document_Type = '$documenttype'
                                                            AND NOT File_ID = '$req6'";
                                                                $result = mysqli_query($conn, $sql);
                                                            }
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                ?>
                                                                <option value="<?php echo $row['File_ID'] ?>">
                                                                    <?php echo $row['Document_Type'] ?>
                                                                </option><?php
                                                            } ?>
                                                        </select>
                                                </div>
                                            <?php } ?>
                                            <?php if ($assistancetype === "Transportation Assistance" || $assistancetype === "Medical Assistance" || $assistancetype === "Burial Assistance" || $assistancetype === "Psychosocial Support") { ?>
                                                <div class="mt-3">
                                                    <?php if ($assistancetype === "Psychosocial Support") { ?>
                                                        <label class="mb-1 text-secondary"
                                                            for="file07"><i>(Optional)</i></label>
                                                        <select class="form-select" id="file07" name="file07">
                                                        <?php } else { ?>
                                                            <label class="mb-1 text-danger" for="file07"><b>Required</b></label>
                                                            <select class="form-select" id="file07" name="file07" required>
                                                            <?php } ?>
                                                            <?php if (empty($req7)) { ?>
                                                                <option value="">Select a Document Type</option>
                                                            <?php } else {
                                                                $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req7'";
                                                                $result = mysqli_query($conn, $sql);
                                                                $row = mysqli_fetch_assoc($result);
                                                                ?>
                                                                <option value="<?php echo $req7 ?>">
                                                                    <?php echo $row['Document_Type'] ?>
                                                                </option>
                                                            <?php }
                                                            if ($assistancetype === "Medical Assistance") {
                                                                $documenttype = "Outstanding Payer Certificate";
                                                                $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND Document_Type = '$documenttype'
                                                            AND NOT File_ID = '$req7'";
                                                                $result = mysqli_query($conn, $sql);
                                                            } else {
                                                                if ($assistancetype === "Psychosocial Support") {
                                                                    $documenttype1 = "Disaster Certificate";
                                                                    $documenttype2 = "Emergency Certificate";
                                                                } else {
                                                                    $documenttype1 = "Birth Certificate";
                                                                    $documenttype2 = "Marriage Certificate";
                                                                }
                                                                $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND (Document_Type = '$documenttype1' OR Document_Type = '$documenttype2')
                                                            AND NOT File_ID = '$req7'";
                                                                $result = mysqli_query($conn, $sql);
                                                            }
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                ?>
                                                                <option value="<?php echo $row['File_ID'] ?>">
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
                                                        <?php if (empty($req8)) { ?>
                                                            <option value="">Select a Document Type</option>
                                                        <?php } else {
                                                            $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req8'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_assoc($result);
                                                            ?>
                                                            <option value="<?php echo $req8 ?>">
                                                                <?php echo $row['Document_Type'] ?>
                                                            </option>
                                                        <?php }
                                                        $documenttype = ($assistancetype === "Medical Assistance") ? "Representative Valid ID" : "Marriage Contract";
                                                        $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND Document_Type = '$documenttype'
                                                            AND NOT File_ID = '$req8'";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <option value="<?php echo $row['File_ID'] ?>">
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
                                                        <?php if (empty($req9)) { ?>
                                                            <option value="">Select a Document Type</option>
                                                        <?php } else {
                                                            $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req9'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_assoc($result);
                                                            ?>
                                                            <option value="<?php echo $req9 ?>">
                                                                <?php echo $row['Document_Type'] ?>
                                                            </option>
                                                        <?php }
                                                        $documenttype = "Authorization Letter";
                                                        $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND Document_Type = '$documenttype'
                                                            AND NOT File_ID = '$req9'";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <option value="<?php echo $row['File_ID'] ?>">
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
                                                        <?php if (empty($req10)) { ?>
                                                            <option value="">Select a Document Type</option>
                                                        <?php } else {
                                                            $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req10'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_assoc($result);
                                                            ?>
                                                            <option value="<?php echo $req10 ?>">
                                                                <?php echo $row['Document_Type'] ?>
                                                            </option>
                                                        <?php }
                                                        $documenttype = ($assistancetype === "Medical Assistance") ? "Valid ID" : "Outstanding Payer Certificate";
                                                        $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND Document_Type = '$documenttype'
                                                            AND NOT File_ID = '$req10'";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <option value="<?php echo $row['File_ID'] ?>">
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
                                                        <?php if (empty($req11)) { ?>
                                                            <option value="">Select a Document Type</option>
                                                        <?php } else {
                                                            $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req11'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_assoc($result);
                                                            ?>
                                                            <option value="<?php echo $req11 ?>">
                                                                <?php echo $row['Document_Type'] ?>
                                                            </option>
                                                        <?php }
                                                        $documenttype1 = "Birth Certificate";
                                                        $documenttype2 = "Marriage Certificate";
                                                        $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND (Document_Type = '$documenttype1' OR Document_Type = '$documenttype2')
                                                            AND NOT File_ID = '$req11'";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <option value="<?php echo $row['File_ID'] ?>">
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
                            $civsta = $_POST['civilstatus'];
                            $phoneno = $_POST['phoneno'];
                            $email = $_POST['email'];
                            $reason = htmlspecialchars($_POST['reason']);
                            $req1 = $_POST['file01'];
                            $req2 = $_POST['file02'];
                            $req3 = $_POST['file03'];
                            $req4 = $_POST['file04'];
                            $req5 = $_POST['file05'];
                            $req6 = $_POST['file06'];
                            $req7 = $_POST['file07'];
                            $req8 = $_POST['file08'];
                            $req9 = $_POST['file09'];
                            $req10 = $_POST['file10'];
                            $req11 = $_POST['file11'];
                            $ec = ++$ecount;
                            $date = (empty($edate)) ? date('Y-m-d') : $edate . ", " . date('Y-m-d');
                            $sql = "UPDATE application_tbl
                                        SET User_ID = '$userid', 
                                            Full_Name = '$fullname',
                                            Birth_Date = '$bday',
                                            Address_ID = '$addid',
                                            Assistance_Type = '$assistancetype',
                                            Civil_Status = '$civsta',
                                            Contact_Number = '$phoneno',
                                            Email = '$email',
                                            Reason = '$reason',
                                            Req1 = '$req1',
                                            Req2 = '$req2',
                                            Req3 = '$req3',
                                            Req4 = '$req4',
                                            Req5 = '$req5',
                                            Req6 = '$req6',
                                            Req7 = '$req7',
                                            Req8 = '$req8',
                                            Req9 = '$req9',
                                            Req10 = '$req10',
                                            Req11 = '$req11',
                                            Edited_Count = '$ec',
                                            Date_Edited = '$date'
                                        where Application_ID = $appid";
                            if ($result = mysqli_query($conn, $sql)) { ?>
                                <script>alert("Your Application has been Updated.")</script>
                                <?php unset($_SESSION['appid']) ?>
                                <script>window.location.href = "profile.php"</script><?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>