<!doctype html>
<?php include "connect.php";
session_start();
if (empty($_SESSION['userid'])) { ?>
    <script>window.location.href = "logout.php";</script><?php }
$userid = $_SESSION['userid'];
$rows = [];
$sql = "SELECT Document_Type 
        FROM requirements_tbl 
        where User_ID = '$userid'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    $rows[] = $row['Document_Type'];
}
if (in_array("Barangay Indigency", $rows)) {
    if (in_array("Valid ID", $rows)) {
        if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
            if (in_array("Referral Letter", $rows)) {
            } else {
                ?>
                <script>alert("You Are Missing Referral Letter")
                    window.location.href = "profile.php#requirements"</script><?php
            }
        } else {
            ?>
            <script>alert("You Are Missing either Birth Certificate or Marriage Certificate")
                window.location.href = "profile.php#requirements"</script><?php
        }
    } else {
        ?>
        <script>alert("You Are Missing Valid ID")
            window.location.href = "profile.php#requirements"</script><?php
    }
} else {
    ?>
    <script>alert("You Are Missing Barangay Indigency")
        window.location.href = "profile.php#requirements"</script>
    <?php
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Application Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row">'
            <div class="col-12">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <div class="border border-black rounded shadow p-5">
                        <a class="mb-3 d-flex justify-content-center align-items-center" href="index.php">Go Back.</a>
                        <form method="POST">
                            <div class="mb-3 d-flex justify-content-center align-items-center">
                                <h3><b>Application Form</b></h3>
                            </div>
                            <?php $userid = $_SESSION['userid'];
                            $sql = "SELECT t1.Fname, t1.Mname, t1.Lname, t1.Birth_Date, t1.Civil_Status, t1.Contact_Number,
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
                                <div class="col-3">
                                    <div class="mt-3">
                                        <label class="mb-1" for="fullname">Full Name</label><br>
                                        <input class="form-control" type="text" id="fullname" name="fullname"
                                            value="<?php echo (empty($row['Mname'])) ? $row['Fname'] . "&nbsp;" . $row['Lname'] : $row['Fname'] . "&nbsp;" . $row['Mname'] . "&nbsp;" . $row['Lname'] ?>"
                                            aria-label="Disabled input example" readonly required>
                                    </div>
                                    <div class="mt-3">
                                        <label class="mb-1" for="bday">Date of Birth</label><br>
                                        <input class="p-2 form-control" type="date" id="bday" name="bday"
                                            value="<?php echo $row['Birth_Date'] ?>" aria-label="Disabled input example"
                                            readonly required>
                                    </div>
                                    <div class="mt-3">
                                        <label class="mb-1" for="address">Address</label><br>
                                        <input class="form-control" type="text" id="address" name="address"
                                            value="<?php echo $row['Street_Address'] . "&nbsp;" . $row['Barangay'] . "&nbsp;" . $row['CityorMunicipality'] . ",&nbsp;" . $row['Province'] ?>"
                                            aria-label="Disabled input example" readonly>
                                    </div>
                                    <div class="mt-3">
                                        <label class="mb-2" for="assistanceType">Type of Assitance</label><br>
                                        <select class="py-2 form-select" name="assistancetype" id="assistanceType"
                                            required>
                                            <option value="Psychosocial_Support">Psychosocial Support</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
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
                                    <div class="mt-3">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="State your reason here"
                                                id="floatingTextarea" style="height: 10em" name="reason"
                                                required></textarea>
                                            <label for="floatingTextarea">Reason</label>
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
                                                <select class="form-select" id="file01" name="file02" required>
                                                    <option>Select a Document Type</option>
                                                    <?php $userid = $_SESSION['userid'];
                                                    $documenttype = "Barangay Indigency";
                                                    $sql = "SELECT File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' 
                                                            AND Document_Type = '$documenttype'";
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
                                                <select class="form-select" id="file02" name="file03" required>
                                                    <option>Select a Document Type</option>
                                                    <?php $userid = $_SESSION['userid'];
                                                    $documenttype = "Valid ID";
                                                    $sql = "SELECT Document_Type, File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' 
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
                                            <div class="mt-3">
                                                <label class="mb-1 text-danger" for="file03"><b>Required</b></label>
                                                <select class="form-select" id="file03" name="file04" required>
                                                    <option>Select a Document Type</option>
                                                    <?php $userid = $_SESSION['userid'];
                                                    $documenttype1 = "Birth Certificate";
                                                    $documenttype2 = "Marriage Certificate";
                                                    $sql = "SELECT Document_Type, File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' 
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
                                            <div class="mt-3">
                                                <label class="mb-1 text-danger" for="file04"><b>Required</b></label>
                                                <select class="form-select" id="file04" name="file01" required>
                                                    <option>Select a Document Type</option>
                                                    <?php $userid = $_SESSION['userid'];
                                                    $documenttype = "Referral Letter";
                                                    $sql = "SELECT Document_Type, File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' 
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
                                        </div>
                                        <div class="col-6">
                                            <div class="mt-3">
                                                <label class="mb-1 text-secondary"
                                                    for="file05"><i>(Optional)</i></label>
                                                <select class="form-select" id="file05" name="file05">
                                                    <option>Select a Document Type</option>
                                                    <?php $userid = $_SESSION['userid'];
                                                    $documenttype1 = "Medical Report";
                                                    $documenttype2 = "Psychological Report";
                                                    $sql = "SELECT Document_Type, File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' 
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
                                            <div class="mt-3">
                                                <label class="mb-1 text-secondary"
                                                    for="file06"><i>(Optional)</i></label>
                                                <select class="form-select" id="file06" name="file06">
                                                    <option>Select a Document Type</option>
                                                    <?php $userid = $_SESSION['userid'];
                                                    $documenttype1 = "Police Report";
                                                    $documenttype2 = "Legal Report";
                                                    $sql = "SELECT Document_Type, File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' 
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
                                            <div class="mt-3">
                                                <label class="mb-1 text-secondary"
                                                    for="file07"><i>(Optional)</i></label>
                                                <select class="form-select" id="file07" name="file07">
                                                    <option>Select a Document Type</option>
                                                    <?php $userid = $_SESSION['userid'];
                                                    $documenttype1 = "Disaster Certificate";
                                                    $documenttype2 = "Emergency Certificate";
                                                    $sql = "SELECT Document_Type, File_Name
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' 
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
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 d-flex justify-content-center align-items-center">
                                    <button type="submit" name="applicationForm" class="btn btn-outline-primary">Submit
                                        Application</button>
                                </div>
                            </div>
                        </form>
                        <?php if (isset($_POST['applicationForm'])) {
                            $userid = $_SESSION['userid'];
                            $fullname = $_POST['fullname'];
                            $bday = $_POST['bday'];
                            $assistancetype = $_POST['assistancetype'];
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
                            $sql = "INSERT INTO application_tbl (User_ID, Full_Name, Birth_Date, Address_ID, Assistance_Type, Civil_Status, Contact_Number, Email, Reason, Req1, Req2, req3, req4, req5, req6, req7)
                                    VALUES('$userid', '$fullname', '$bday', '$address', '$assistancetype', '$civsta', '$phoneno', '$email', '$reason', '$req1', '$req2', '$req3', '$req4', '$req5', '$req6', '$req7')";
                            if ($result = mysqli_query($conn, $sql)) {
                                ?>
                                <script>alert("Your Application has been Submitted.")
                                    window.location.href = "profile.php"</script><?php
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