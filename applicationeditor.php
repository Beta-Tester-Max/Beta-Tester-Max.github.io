<!doctype html>
<?php include "connect.php";
session_start();
if (empty($_SESSION['userid'])) { ?>
    <script>window.location.href = "logout.php";</script><?php } elseif (isset($_SESSION['appid'])) { ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit Application</title>
        <link rel="icon" href="./img/aics-logo.ico" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

    <body class="overflow-x-hidden" style="min-width: 50em;">
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
                                <?php $appid = $_SESSION['appid'];
                                $sql = "SELECT Address_ID FROM application_tbl where Application_ID = '$appid'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $addid = $row['Address_ID'];
                                $sql = "SELECT t1.Full_Name, t1.Birth_Date, t1.Civil_Status, t1.Contact_Number, t1.Email, t1.Reason,
                                    t1.Req1, t1.Req2, t1.Req3, t1.Req4, t1.Req5, t1.Req6, t1.Req7, t1.Edited_Count, t1.Date_Edited,
                                    t2.Street_Address, t2.Barangay, t2.CityorMunicipality, t2.Province
                                    FROM application_tbl AS t1,
                                    address_tbl AS t2
                                    where t1.Application_ID = '$appid' AND t2.Address_ID = '$addid'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $req1 = ($row['Req1']) ? $row['Req1'] : "";
                                $req2 = ($row['Req2']) ? $row['Req2'] : "";
                                $req3 = ($row['Req3']) ? $row['Req3'] : "";
                                $req4 = ($row['Req4']) ? $row['Req4'] : "";
                                $req5 = ($row['Req5']) ? $row['Req5'] : "";
                                $req6 = ($row['Req6']) ? $row['Req6'] : "";
                                $req7 = ($row['Req7']) ? $row['Req7'] : "";
                                $ecount = ($row['Edited_Count']) ? $row['Edited_Count'] : "";
                                $edate = ($row['Date_Edited']) ? $row['Date_Edited'] : "";
                                ?>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="mt-3">
                                            <label class="mb-1" for="fullname">Full Name</label><br>
                                            <input class="form-control" type="text" id="fullname" name="fullname"
                                                value="<?php echo $row['Full_Name'] ?>" aria-label="Disabled input example"
                                                readonly required>
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
                                                <option value="Psychosocial Support">Psychosocial Support</option>
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
                                                <textarea class="form-control" id="floatingTextarea" style="height: 10em"
                                                    name="reason" required><?php echo $row['Reason'] ?></textarea>
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
                                                    <select class="form-select" id="file01" name="file01" required>
                                                        <?php $userid = $_SESSION['userid'];
                                                        if (empty($req1) == false) {
                                                            $sql = "SELECT Document_Type 
                                                                FROM requirements_tbl 
                                                                where User_ID = '$userid' 
                                                                AND File_Name = '$req1' AND Status = 'Validated'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_array($result);
                                                            if (empty($row['Document_Type']) == false) { ?>
                                                                <option value="<?php echo $req1 ?>">
                                                                    <?php echo $row['Document_Type'] ?>
                                                                </option>
                                                            <?php }
                                                        } else { ?>
                                                            <option value="">Select a Document</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="mt-3">
                                                    <label class="mb-1 text-danger" for="file02"><b>Required</b></label>
                                                    <select class="form-select" id="file02" name="file02" required>
                                                        <?php $userid = $_SESSION['userid'];
                                                        if (empty($req2) == false) {
                                                            $sql = "SELECT Document_Type 
                                                                FROM requirements_tbl 
                                                                where User_ID = '$userid' 
                                                                AND File_Name = '$req2' AND Status = 'Validated'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_array($result);
                                                            if (empty($row['Document_Type']) == false) { ?>
                                                                <option value="<?php echo $req2 ?>">
                                                                    <?php echo $row['Document_Type'] ?>
                                                                </option>
                                                            <?php }
                                                        } else { ?>
                                                            <option value="">Select a Document</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="mt-3">
                                                    <label class="mb-1 text-danger" for="file03"><b>Required</b></label>
                                                    <select class="form-select" id="file03" name="file03" required>
                                                        <?php $userid = $_SESSION['userid'];
                                                        if (empty($req3) == false) {
                                                            $sql = "SELECT Document_Type 
                                                                FROM requirements_tbl 
                                                                where User_ID = '$userid' 
                                                                AND File_Name = '$req3' AND Status = 'Validated'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_array($result);
                                                            if (empty($row['Document_Type']) == false) { ?>
                                                                <option value="<?php echo $req3 ?>">
                                                                    <?php echo $row['Document_Type'] ?>
                                                                </option>
                                                            <?php }
                                                        } else { ?>
                                                            <option value="">Select a Document</option>
                                                        <?php }
                                                        $userid = $_SESSION['userid'];
                                                        $documenttype = ($row['Document_Type'] == "Marriage Certificate") ? $row['Document_Type'] : "Birth Certificate";
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
                                                <div class="mt-3">
                                                    <label class="mb-1 text-danger" for="file04"><b>Required</b></label>
                                                    <select class="form-select" id="file04" name="file04" required>
                                                        <?php if (empty($req4) == false) {
                                                            $sql = "SELECT Document_Type 
                                                                FROM requirements_tbl 
                                                                where User_ID = '$userid' 
                                                                AND File_Name = '$req4' AND Status = 'Validated'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_array($result);
                                                            if (empty($row['Document_Type']) == false) { ?>
                                                                <option value="<?php echo $req4 ?>">
                                                                    <?php echo $row['Document_Type'] ?>
                                                                </option>
                                                            <?php }
                                                        } else { ?>
                                                            <option value="">Select a Document</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mt-3">
                                                    <label class="mb-1 text-secondary"
                                                        for="file05"><i>(Optional)</i></label>
                                                    <select class="form-select" id="file05" name="file05">
                                                        <?php if (empty($req5) == false) {
                                                            $sql = "SELECT Document_Type 
                                                                FROM requirements_tbl 
                                                                where User_ID = '$userid' AND Status = 'Validated'
                                                                AND File_Name = '$req5'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_array($result);
                                                            if (empty($row['Document_Type']) == false) { ?>
                                                                <option value="<?php echo $req5 ?>">
                                                                    <?php echo $row['Document_Type'] ?>
                                                                </option>
                                                            <?php }
                                                        } else { ?>
                                                            <option value="">Select a Document</option>
                                                        <?php }
                                                        $userid = $_SESSION['userid'];
                                                        $documenttype = ($row['Document_Type'] == "Medical Report") ? $row['Document_Type'] : "Psychological Report";
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
                                                    <label class="mb-1 text-secondary"
                                                        for="file06"><i>(Optional)</i></label>
                                                    <select class="form-select" id="file06" name="file06">
                                                        <?php if (empty($req6) == false) {
                                                            $sql = "SELECT Document_Type 
                                                                FROM requirements_tbl 
                                                                where User_ID = '$userid' 
                                                                AND File_Name = '$req6' AND Status = 'Validated'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_array($result);
                                                            if (empty($row['Document_Type']) == false) { ?>
                                                                <option value="<?php echo $req6 ?>">
                                                                    <?php echo $row['Document_Type'] ?>
                                                                </option>
                                                            <?php }
                                                        } else { ?>
                                                            <option value="">Select a Document</option>
                                                        <?php }
                                                        $userid = $_SESSION['userid'];
                                                        $documenttype = ($row['Document_Type'] == "Police Report") ? $row['Document_Type'] : "Legal Report";
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
                                                    <label class="mb-1 text-secondary"
                                                        for="file07"><i>(Optional)</i></label>
                                                    <select class="form-select" id="file07" name="file07">
                                                        <?php if (empty($req7) == false) {
                                                            $sql = "SELECT Document_Type 
                                                                FROM requirements_tbl 
                                                                where User_ID = '$userid' 
                                                                AND File_Name = '$req7' AND Status = 'Validated'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_array($result);
                                                            if (empty($row['Document_Type']) == false) { ?>
                                                                <option value="<?php echo $req7 ?>">
                                                                    <?php echo $row['Document_Type'] ?>
                                                                </option>
                                                            <?php }
                                                        } else { ?>
                                                            <option value="">Select a Document</option>
                                                        <?php }
                                                        $userid = $_SESSION['userid'];
                                                        $documenttype = ($row['Document_Type'] == "Disaster Certificate") ? $row['Document_Type'] : "Marriage Certificate";
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
                                $req1 = htmlspecialchars($_POST['file01']);
                                $req2 = htmlspecialchars($_POST['file02']);
                                $req3 = htmlspecialchars($_POST['file03']);
                                $req4 = htmlspecialchars($_POST['file04']);
                                $req5 = htmlspecialchars($_POST['file05']);
                                $req6 = htmlspecialchars($_POST['file06']);
                                $req7 = htmlspecialchars($_POST['file07']);
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
<?php } else { ?>
    <script>window.location.href = "profile.php#pending"</script>
<?php }