<?php include "connect.php";
session_start();
if (empty($_SESSION['userid'])) { ?>
    <script>window.location.href = "logout.php";</script><?php } else {
    $userid = $_SESSION['userid'];
} ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<body class="overflow-x-hidden" style="min-width: 50em;">
    <div class="container-fluid ">
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col-1"></div>
            <div class="col-4 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5">
                <?php
                if (isset($_SESSION['userid'])) {
                    $sql = "SELECT t2.Fname, t2.Mname, t2.Lname, t1.Username, t1.Profile_Pic, t1.Email FROM register_tbl As t1, userinfo_tbl AS t2 where t1.User_ID = '$userid' AND t2.User_ID = '$userid'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result); ?>
                    <img class="border rounded shadow p-2 mb-5" style="width: 10em; height: 10em;"
                        src="<?php echo (empty($row['Profile_Pic'])) ? "placeholderprofilepic.png" : "file/" . $row['Profile_Pic'] ?>">
                    <h3><b><?php echo $row['Fname'] ?>     <?php echo $row['Mname'] ?>     <?php echo $row['Lname'] ?></b></h3>
                    <h3><i><?php echo $row['Username'] ?></i></h3>
                    <h3><?php echo $row['Email'] ?></h3>
                    <a class="btn btn-primary btn-lg mt-3 mb-2" href="profileeditor.php">Edit Profile</a>
                    <p>Go to <a href="index.php">Home</a>.</p>
                <?php } ?>
            </div>
            <div class="col-2"></div>
            <div class="col-4 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5">
                <?php if (isset($_SESSION['userid'])) {
                    $sql = "SELECT * FROM address_tbl where User_ID = '$userid'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result); ?>
                    <h2><b>Address</b></h2>
                    <div class="d-flex justify-content-center align-items-center text-center">
                        <p><?php echo $row['Street_Address'] . "&nbsp;" . $row['Barangay'] . "&nbsp;" . $row['CityorMunicipality'] . ",&nbsp;" . $row['Province'] ?>
                        </p>
                    </div>
                <?php } ?>
            </div>
            <div class="col-1"></div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div
                class="col-8 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5 m-5">
                <h1 class="mb-4" id="requirements">Requirements</h1>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="grid text-center">
                        <?php $assistancetype = array(
                            'Transportation Assistance' => 'traAss',
                            'Medical Assistance' => 'medAss',
                            'Burial Assistance' => 'burAss',
                            'Educational Assistance' => 'eduAss',
                            'Food Assistance' => 'fooAss',
                            'Cash Relief Assistance' => 'casAss',
                            'Psychosocial Support' => 'psySup',
                        );
                        foreach ($assistancetype as $at => $id) { ?>
                            <button type="submit" class="btn btn-primary m-1" data-bs-toggle="modal"
                                data-bs-target="#<?php echo $id ?>">
                                <?php echo $at ?>
                            </button>
                            <div class="modal fade" id="<?php echo $id ?>" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="lodLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="lodLabel"><?php echo $at ?> Documents List</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped">
                                                <tr>
                                                    <th class="text-start" scope="col">Document Type</th>
                                                    <th class="text-center" scope="col">Status</th>
                                                    <th class="text-start" scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($at === "Psychosocial Support") {
                                                        $doctype = array(
                                                            "Required" => [
                                                                "Barangay Indigency",
                                                                "Valid ID",
                                                                "Marriage Certificate",
                                                                "Birth Certificate",
                                                                "Referral Letter",
                                                            ],
                                                            "Optional" => [
                                                                "Medical Report",
                                                                "Psychological Report",
                                                                "Police Report",
                                                                "Legal Report",
                                                                "Disaster Certificate",
                                                                "Emergency Certificate"
                                                            ]
                                                        );
                                                        for ($i = 0; $i < count($doctype['Required']); $i++) {
                                                            $doclist = $doctype['Required'][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <i class="text-danger"
                                                                        style="font-size: .8em;">Required</i></td>
                                                                <?php
                                                                $sql = "SELECT Status, File_Name, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = '$userid' AND Document_type = '$doclist'";
                                                                $result = mysqli_query($conn, $sql);
                                                                $row = mysqli_fetch_assoc($result); ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($row['Status']) && $row['Status'] === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php
                                                                if (isset($row['File_Name'])) { ?>
                                                                        <div class="d-flex">
                                                                            <form method="POST" enctype="multipart/form-data">
                                                                                <div class="d-flex">
                                                                                    <div class="mb-3">
                                                                                        <input class="form-control" type="file"
                                                                                            id="formFile" name="file"
                                                                                            accept="application/pdf" required>
                                                                                    </div>
                                                                                    <button class="btn btn-primary shadow ms-2"
                                                                                        type="submit" style="height: 2.3em;"
                                                                                        name="<?php echo str_replace(" ", "", $doclist) ?>">Edit</button>
                                                                                </div>
                                                                            </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                                $documenttype = $doclist;
                                                                                $file = htmlspecialchars($_FILES['file']['name']);
                                                                                $location = "file/" . $file;
                                                                                $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                                $result = mysqli_query($conn, $sql);
                                                                                if (mysqli_num_rows($result) == 0) {
                                                                                    $sql = "UPDATE requirements_tbl
                                                                                        SET File_Name = '$file',
                                                                                        Status = 'Unvalidated'
                                                                                        where Document_Type = '$documenttype' 
                                                                                        AND User_ID = '$userid'";
                                                                                    mysqli_query($conn, $sql);
                                                                                    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                        ?>
                                                                                        <script>alert("Files Updated Successfully.")
                                                                                            window.location.href = "profile.php"
                                                                                        </script><?php
                                                                                    } else { ?>
                                                                                        <script>alert("Something went wrong.")</script>
                                                                                    <?php }
                                                                                } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                    <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                            } ?>
                                                                            <form method="POST">
                                                                                <input type="hidden"
                                                                                    value="<?php echo $row['File_Name'] ?>" name="file">
                                                                                <button type="submit" class="btn btn-primary ms-2"
                                                                                    style="height: 2.3em; width: 6em;"
                                                                                    name="fileopener">Open File</button>
                                                                            </form>
                                                                        </div>
                                                                        <?php if (isset($_POST['fileopener'])) {
                                                                            $_SESSION['file'] = $_POST['file'] ?>
                                                                            <script>window.location.href = "pdfdisplayer.php"</script>
                                                                        <?php }
                                                                        if (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                            <div class="form-floating">
                                                                                <textarea class="form-control"
                                                                                    placeholder="State your reason here"
                                                                                    id="floatingTextarea" style="height: 10em" name="reason"
                                                                                    disabled readonly required></textarea>
                                                                                <label
                                                                                    for="floatingTextarea"><?php echo (empty($row['ReasonFR'])) ? "The Admin did not leave a reason" : $row['ReasonFR'] ?></label>
                                                                            </div>
                                                                        <?php }
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="<?php echo str_replace(" ", "", $doclist) ?>">Upload</button>
                                                                            </div>
                                                                        </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                            $importance = "Required";
                                                                            $documenttype = $doclist;
                                                                            $file = htmlspecialchars($_FILES['file']['name']);
                                                                            $location = "file/" . $file;
                                                                            $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                            $result = mysqli_query($conn, $sql);
                                                                            if (mysqli_num_rows($result) == 0) {
                                                                                $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name, Importance)
                                                                                    VALUES ('$userid', '$documenttype', '$file', '$importance')";
                                                                                mysqli_query($conn, $sql);
                                                                                if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                    ?>
                                                                                    <script>alert("Files Uploaded Successfully.")
                                                                                        window.location.href = "profile.php"
                                                                                    </script><?php
                                                                                } else { ?>
                                                                                    <script>alert("Something went wrong.")</script>
                                                                                <?php }
                                                                            } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                        }
                                                                }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                        for ($i = 0; $i < count($doctype['Optional']); $i++) {
                                                            $doclist = $doctype['Optional'][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <i
                                                                        class="text-secondary" style="font-size: .8em;">Optional</i>
                                                                </td>
                                                                <?php
                                                                $sql = "SELECT Status, File_Name, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = '$userid' AND Document_type = '$doclist'";
                                                                $result = mysqli_query($conn, $sql);
                                                                $row = mysqli_fetch_assoc($result); ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($row['Status']) && $row['Status'] === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php
                                                                if (isset($row['File_Name'])) { ?>
                                                                        <div class="d-flex">
                                                                            <form method="POST" enctype="multipart/form-data">
                                                                                <div class="d-flex">
                                                                                    <div class="mb-3">
                                                                                        <input class="form-control" type="file"
                                                                                            id="formFile" name="file"
                                                                                            accept="application/pdf" required>
                                                                                    </div>
                                                                                    <button class="btn btn-primary shadow ms-2"
                                                                                        type="submit" style="height: 2.3em;"
                                                                                        name="<?php echo str_replace(" ", "", $doclist) ?>">Edit</button>
                                                                                </div>
                                                                            </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                                $documenttype = $doclist;
                                                                                $file = htmlspecialchars($_FILES['file']['name']);
                                                                                $location = "file/" . $file;
                                                                                $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                                $result = mysqli_query($conn, $sql);
                                                                                if (mysqli_num_rows($result) == 0) {
                                                                                    $sql = "UPDATE requirements_tbl
                                                                                        SET File_Name = '$file',
                                                                                        Status = 'Unvalidated'
                                                                                        where Document_Type = '$documenttype' 
                                                                                        AND User_ID = '$userid'";
                                                                                    mysqli_query($conn, $sql);
                                                                                    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                        ?>
                                                                                        <script>alert("Files Updated Successfully.")
                                                                                            window.location.href = "profile.php"
                                                                                        </script><?php
                                                                                    } else { ?>
                                                                                        <script>alert("Something went wrong.")</script>
                                                                                    <?php }
                                                                                } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                    <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                            } ?>
                                                                            <form method="POST">
                                                                                <input type="hidden"
                                                                                    value="<?php echo $row['File_Name'] ?>" name="file">
                                                                                <button type="submit" class="btn btn-primary ms-2"
                                                                                    style="height: 2.3em; width: 6em;"
                                                                                    name="fileopener">Open File</button>
                                                                            </form>
                                                                        </div>
                                                                        <?php if (isset($_POST['fileopener'])) {
                                                                            $_SESSION['file'] = $_POST['file'] ?>
                                                                            <script>window.location.href = "pdfdisplayer.php"</script>
                                                                        <?php }
                                                                        if (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                            <div class="form-floating">
                                                                                <textarea class="form-control"
                                                                                    placeholder="State your reason here"
                                                                                    id="floatingTextarea" style="height: 10em" name="reason"
                                                                                    disabled readonly required></textarea>
                                                                                <label
                                                                                    for="floatingTextarea"><?php echo (empty($row['ReasonFR'])) ? "The Admin did not leave a reason" : $row['ReasonFR'] ?></label>
                                                                            </div>
                                                                        <?php }
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="<?php echo str_replace(" ", "", $doclist) ?>">Upload</button>
                                                                            </div>
                                                                        </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                            $importance = "Optional";
                                                                            $documenttype = $doclist;
                                                                            $file = htmlspecialchars($_FILES['file']['name']);
                                                                            $location = "file/" . $file;
                                                                            $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                            $result = mysqli_query($conn, $sql);
                                                                            if (mysqli_num_rows($result) == 0) {
                                                                                $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name, Importance)
                                                                                    VALUES ('$userid', '$documenttype', '$file', '$importance')";
                                                                                mysqli_query($conn, $sql);
                                                                                if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                    ?>
                                                                                    <script>alert("Files Uploaded Successfully.")
                                                                                        window.location.href = "profile.php"
                                                                                    </script><?php
                                                                                } else { ?>
                                                                                    <script>alert("Something went wrong.")</script>
                                                                                <?php }
                                                                            } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                        }
                                                                }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    } elseif ($at === "Transportation Assistance") {
                                                        $doctype = array(
                                                            "Required" => [
                                                                "Barangay Indigency",
                                                                "Medical Certificate Referral",
                                                                "Death Certificate",
                                                                "Medical Report",
                                                                "Police Report",
                                                                "Representative Valid ID",
                                                                "Marriage Certificate",
                                                                "Birth Certificate"
                                                            ]
                                                        );
                                                        for ($i = 0; $i < count($doctype['Required']); $i++) {
                                                            $doclist = $doctype['Required'][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <i class="text-danger"
                                                                        style="font-size: .8em;">Required</i></td>
                                                                <?php
                                                                $sql = "SELECT Status, File_Name, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = '$userid' AND Document_type = '$doclist'";
                                                                $result = mysqli_query($conn, $sql);
                                                                $row = mysqli_fetch_assoc($result); ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($row['Status']) && $row['Status'] === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php
                                                                if (isset($row['File_Name'])) { ?>
                                                                        <div class="d-flex">
                                                                            <form method="POST" enctype="multipart/form-data">
                                                                                <div class="d-flex">
                                                                                    <div class="mb-3">
                                                                                        <input class="form-control" type="file"
                                                                                            id="formFile" name="file"
                                                                                            accept="application/pdf" required>
                                                                                    </div>
                                                                                    <button class="btn btn-primary shadow ms-2"
                                                                                        type="submit" style="height: 2.3em;"
                                                                                        name="<?php echo str_replace(" ", "", $doclist) ?>">Edit</button>
                                                                                </div>
                                                                            </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                                $documenttype = $doclist;
                                                                                $file = htmlspecialchars($_FILES['file']['name']);
                                                                                $location = "file/" . $file;
                                                                                $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                                $result = mysqli_query($conn, $sql);
                                                                                if (mysqli_num_rows($result) == 0) {
                                                                                    $sql = "UPDATE requirements_tbl
                                                                                        SET File_Name = '$file',
                                                                                        Status = 'Unvalidated'
                                                                                        where Document_Type = '$documenttype' 
                                                                                        AND User_ID = '$userid'";
                                                                                    mysqli_query($conn, $sql);
                                                                                    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                        ?>
                                                                                        <script>alert("Files Updated Successfully.")
                                                                                            window.location.href = "profile.php"
                                                                                        </script><?php
                                                                                    } else { ?>
                                                                                        <script>alert("Something went wrong.")</script>
                                                                                    <?php }
                                                                                } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                    <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                            } ?>
                                                                            <form method="POST">
                                                                                <input type="hidden"
                                                                                    value="<?php echo $row['File_Name'] ?>" name="file">
                                                                                <button type="submit" class="btn btn-primary ms-2"
                                                                                    style="height: 2.3em; width: 6em;"
                                                                                    name="fileopener">Open File</button>
                                                                            </form>
                                                                        </div>
                                                                        <?php if (isset($_POST['fileopener'])) {
                                                                            $_SESSION['file'] = $_POST['file'] ?>
                                                                            <script>window.location.href = "pdfdisplayer.php"</script>
                                                                        <?php }
                                                                        if (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                            <div class="form-floating">
                                                                                <textarea class="form-control"
                                                                                    placeholder="State your reason here"
                                                                                    id="floatingTextarea" style="height: 10em" name="reason"
                                                                                    disabled readonly required></textarea>
                                                                                <label
                                                                                    for="floatingTextarea"><?php echo (empty($row['ReasonFR'])) ? "The Admin did not leave a reason" : $row['ReasonFR'] ?></label>
                                                                            </div>
                                                                        <?php }
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="<?php echo str_replace(" ", "", $doclist) ?>">Upload</button>
                                                                            </div>
                                                                        </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                            $importance = "Required";
                                                                            $documenttype = $doclist;
                                                                            $file = htmlspecialchars($_FILES['file']['name']);
                                                                            $location = "file/" . $file;
                                                                            $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                            $result = mysqli_query($conn, $sql);
                                                                            if (mysqli_num_rows($result) == 0) {
                                                                                $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name, Importance)
                                                                                    VALUES ('$userid', '$documenttype', '$file', '$importance')";
                                                                                mysqli_query($conn, $sql);
                                                                                if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                    ?>
                                                                                    <script>alert("Files Uploaded Successfully.")
                                                                                        window.location.href = "profile.php"
                                                                                    </script><?php
                                                                                } else { ?>
                                                                                    <script>alert("Something went wrong.")</script>
                                                                                <?php }
                                                                            } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                        }
                                                                }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    } elseif ($at === "Medical Assistance") {
                                                        $doctype = array(
                                                            "Required" => [
                                                                "Barangay Indigency",
                                                                "Medical Certificate",
                                                                "Clinical Abstract",
                                                                "Hospital Billing Statement",
                                                                "Pharmacy Quotation",
                                                                "Laboratory Request",
                                                                "Diagnostic Request",
                                                                "Official Receipts",
                                                                "Outstanding Payer Certificate",
                                                                "Representative Valid ID",
                                                                "Authorization Letter",
                                                                "Valid ID",
                                                                "Marriage Certificate",
                                                                "Birth Certificate"
                                                            ]
                                                        );
                                                        for ($i = 0; $i < count($doctype['Required']); $i++) {
                                                            $doclist = $doctype['Required'][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <i class="text-danger"
                                                                        style="font-size: .8em;">Required</i></td>
                                                                <?php
                                                                $sql = "SELECT Status, File_Name, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = '$userid' AND Document_type = '$doclist'";
                                                                $result = mysqli_query($conn, $sql);
                                                                $row = mysqli_fetch_assoc($result); ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($row['Status']) && $row['Status'] === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php
                                                                if (isset($row['File_Name'])) { ?>
                                                                        <div class="d-flex">
                                                                            <form method="POST" enctype="multipart/form-data">
                                                                                <div class="d-flex">
                                                                                    <div class="mb-3">
                                                                                        <input class="form-control" type="file"
                                                                                            id="formFile" name="file"
                                                                                            accept="application/pdf" required>
                                                                                    </div>
                                                                                    <button class="btn btn-primary shadow ms-2"
                                                                                        type="submit" style="height: 2.3em;"
                                                                                        name="<?php echo str_replace(" ", "", $doclist) ?>">Edit</button>
                                                                                </div>
                                                                            </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                                $documenttype = $doclist;
                                                                                $file = htmlspecialchars($_FILES['file']['name']);
                                                                                $location = "file/" . $file;
                                                                                $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                                $result = mysqli_query($conn, $sql);
                                                                                if (mysqli_num_rows($result) == 0) {
                                                                                    $sql = "UPDATE requirements_tbl
                                                                                        SET File_Name = '$file',
                                                                                        Status = 'Unvalidated'
                                                                                        where Document_Type = '$documenttype' 
                                                                                        AND User_ID = '$userid'";
                                                                                    mysqli_query($conn, $sql);
                                                                                    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                        ?>
                                                                                        <script>alert("Files Updated Successfully.")
                                                                                            window.location.href = "profile.php"
                                                                                        </script><?php
                                                                                    } else { ?>
                                                                                        <script>alert("Something went wrong.")</script>
                                                                                    <?php }
                                                                                } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                    <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                            } ?>
                                                                            <form method="POST">
                                                                                <input type="hidden"
                                                                                    value="<?php echo $row['File_Name'] ?>" name="file">
                                                                                <button type="submit" class="btn btn-primary ms-2"
                                                                                    style="height: 2.3em; width: 6em;"
                                                                                    name="fileopener">Open File</button>
                                                                            </form>
                                                                        </div>
                                                                        <?php if (isset($_POST['fileopener'])) {
                                                                            $_SESSION['file'] = $_POST['file'] ?>
                                                                            <script>window.location.href = "pdfdisplayer.php"</script>
                                                                        <?php }
                                                                        if (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                            <div class="form-floating">
                                                                                <textarea class="form-control"
                                                                                    placeholder="State your reason here"
                                                                                    id="floatingTextarea" style="height: 10em" name="reason"
                                                                                    disabled readonly required></textarea>
                                                                                <label
                                                                                    for="floatingTextarea"><?php echo (empty($row['ReasonFR'])) ? "The Admin did not leave a reason" : $row['ReasonFR'] ?></label>
                                                                            </div>
                                                                        <?php }
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="<?php echo str_replace(" ", "", $doclist) ?>">Upload</button>
                                                                            </div>
                                                                        </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                            $importance = "Required";
                                                                            $documenttype = $doclist;
                                                                            $file = htmlspecialchars($_FILES['file']['name']);
                                                                            $location = "file/" . $file;
                                                                            $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                            $result = mysqli_query($conn, $sql);
                                                                            if (mysqli_num_rows($result) == 0) {
                                                                                $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name, Importance)
                                                                                    VALUES ('$userid', '$documenttype', '$file', '$importance')";
                                                                                mysqli_query($conn, $sql);
                                                                                if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                    ?>
                                                                                    <script>alert("Files Uploaded Successfully.")
                                                                                        window.location.href = "profile.php"
                                                                                    </script><?php
                                                                                } else { ?>
                                                                                    <script>alert("Something went wrong.")</script>
                                                                                <?php }
                                                                            } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                        }
                                                                }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    } elseif ($at === "Burial Assistance") {
                                                        $doctype = array(
                                                            "Required" => [
                                                                "Barangay Indigency",
                                                                "Death Certificate",
                                                                "Funeral Contract",
                                                                "official Receipts",
                                                                "Representative Valid ID",
                                                                "Valid ID",
                                                                "Marriage Certificate",
                                                                "Birth Certificate",
                                                                "Marriage Contract",
                                                                "Authorization Letter",
                                                                "Outstanding Payer Certificate"
                                                            ]
                                                        );
                                                        for ($i = 0; $i < count($doctype['Required']); $i++) {
                                                            $doclist = $doctype['Required'][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <i class="text-danger"
                                                                        style="font-size: .8em;">Required</i></td>
                                                                <?php
                                                                $sql = "SELECT Status, File_Name, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = '$userid' AND Document_type = '$doclist'";
                                                                $result = mysqli_query($conn, $sql);
                                                                $row = mysqli_fetch_assoc($result); ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($row['Status']) && $row['Status'] === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php
                                                                if (isset($row['File_Name'])) { ?>
                                                                        <div class="d-flex">
                                                                            <form method="POST" enctype="multipart/form-data">
                                                                                <div class="d-flex">
                                                                                    <div class="mb-3">
                                                                                        <input class="form-control" type="file"
                                                                                            id="formFile" name="file"
                                                                                            accept="application/pdf" required>
                                                                                    </div>
                                                                                    <button class="btn btn-primary shadow ms-2"
                                                                                        type="submit" style="height: 2.3em;"
                                                                                        name="<?php echo str_replace(" ", "", $doclist) ?>">Edit</button>
                                                                                </div>
                                                                            </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                                $documenttype = $doclist;
                                                                                $file = htmlspecialchars($_FILES['file']['name']);
                                                                                $location = "file/" . $file;
                                                                                $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                                $result = mysqli_query($conn, $sql);
                                                                                if (mysqli_num_rows($result) == 0) {
                                                                                    $sql = "UPDATE requirements_tbl
                                                                                        SET File_Name = '$file',
                                                                                        Status = 'Unvalidated'
                                                                                        where Document_Type = '$documenttype' 
                                                                                        AND User_ID = '$userid'";
                                                                                    mysqli_query($conn, $sql);
                                                                                    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                        ?>
                                                                                        <script>alert("Files Updated Successfully.")
                                                                                            window.location.href = "profile.php"
                                                                                        </script><?php
                                                                                    } else { ?>
                                                                                        <script>alert("Something went wrong.")</script>
                                                                                    <?php }
                                                                                } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                    <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                            } ?>
                                                                            <form method="POST">
                                                                                <input type="hidden"
                                                                                    value="<?php echo $row['File_Name'] ?>" name="file">
                                                                                <button type="submit" class="btn btn-primary ms-2"
                                                                                    style="height: 2.3em; width: 6em;"
                                                                                    name="fileopener">Open File</button>
                                                                            </form>
                                                                        </div>
                                                                        <?php if (isset($_POST['fileopener'])) {
                                                                            $_SESSION['file'] = $_POST['file'] ?>
                                                                            <script>window.location.href = "pdfdisplayer.php"</script>
                                                                        <?php }
                                                                        if (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                            <div class="form-floating">
                                                                                <textarea class="form-control"
                                                                                    placeholder="State your reason here"
                                                                                    id="floatingTextarea" style="height: 10em" name="reason"
                                                                                    disabled readonly required></textarea>
                                                                                <label
                                                                                    for="floatingTextarea"><?php echo (empty($row['ReasonFR'])) ? "The Admin did not leave a reason" : $row['ReasonFR'] ?></label>
                                                                            </div>
                                                                        <?php }
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="<?php echo str_replace(" ", "", $doclist) ?>">Upload</button>
                                                                            </div>
                                                                        </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                            $importance = "Required";
                                                                            $documenttype = $doclist;
                                                                            $file = htmlspecialchars($_FILES['file']['name']);
                                                                            $location = "file/" . $file;
                                                                            $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                            $result = mysqli_query($conn, $sql);
                                                                            if (mysqli_num_rows($result) == 0) {
                                                                                $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name, Importance)
                                                                                    VALUES ('$userid', '$documenttype', '$file', '$importance')";
                                                                                mysqli_query($conn, $sql);
                                                                                if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                    ?>
                                                                                    <script>alert("Files Uploaded Successfully.")
                                                                                        window.location.href = "profile.php"
                                                                                    </script><?php
                                                                                } else { ?>
                                                                                    <script>alert("Something went wrong.")</script>
                                                                                <?php }
                                                                            } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                        }
                                                                }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    } elseif ($at === "Educational Assistance") {
                                                        $doctype = array(
                                                            "Required" => [
                                                                "Barangay Indigency",
                                                                "Enrollment Assessment From",
                                                                "Certificate of Enrollment",
                                                                "School ID",
                                                                "Grades",
                                                                "Police Report",
                                                                "Social Worker's Assessment"
                                                            ],
                                                            "Optional" => [
                                                                "Medical Certificate"
                                                            ]
                                                        );
                                                        for ($i = 0; $i < count($doctype['Required']); $i++) {
                                                            $doclist = htmlspecialchars($doctype['Required'][$i]);
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php
                                                                if ($doclist === "Enrollment Assessment From") {
                                                                    echo $doclist;
                                                                    ?>
                                                                        <p> (Certified True Copy)</p><?php
                                                                } elseif ($doclist === "Certificate of Enrollment") {
                                                                    echo $doclist;
                                                                    ?>
                                                                        <p> (Certified True Copy)</p><?php
                                                                } elseif ($doclist === "Grades") {
                                                                    echo $doclist;
                                                                    ?>
                                                                        <p> (Certified True Copy signed by Authorized Personnel)</p><?php
                                                                } else {
                                                                    echo $doclist;
                                                                }
                                                                ?> <i class="text-danger"
                                                                        style="font-size: .8em;">Required</i>
                                                                </td>
                                                                <?php
                                                                $sql = "SELECT Status, File_Name, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = '$userid' AND Document_type = '$doclist'";
                                                                $result = mysqli_query($conn, $sql);
                                                                $row = mysqli_fetch_assoc($result); ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($row['Status']) && $row['Status'] === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php
                                                                if (isset($row['File_Name'])) { ?>
                                                                        <div class="d-flex">
                                                                            <form method="POST" enctype="multipart/form-data">
                                                                                <div class="d-flex">
                                                                                    <div class="mb-3">
                                                                                        <input class="form-control" type="file"
                                                                                            id="formFile" name="file"
                                                                                            accept="application/pdf" required>
                                                                                    </div>
                                                                                    <button class="btn btn-primary shadow ms-2"
                                                                                        type="submit" style="height: 2.3em;"
                                                                                        name="<?php echo str_replace(" ", "", $doclist) ?>">Edit</button>
                                                                                </div>
                                                                            </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                                $documenttype = $doclist;
                                                                                $file = htmlspecialchars($_FILES['file']['name']);
                                                                                $location = "file/" . $file;
                                                                                $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                                $result = mysqli_query($conn, $sql);
                                                                                if (mysqli_num_rows($result) == 0) {
                                                                                    $sql = "UPDATE requirements_tbl
                                                                                        SET File_Name = '$file',
                                                                                        Status = 'Unvalidated'
                                                                                        where Document_Type = '$documenttype' 
                                                                                        AND User_ID = '$userid'";
                                                                                    mysqli_query($conn, $sql);
                                                                                    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                        ?>
                                                                                        <script>alert("Files Updated Successfully.")
                                                                                            window.location.href = "profile.php"
                                                                                        </script><?php
                                                                                    } else { ?>
                                                                                        <script>alert("Something went wrong.")</script>
                                                                                    <?php }
                                                                                } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                    <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                            } ?>
                                                                            <form method="POST">
                                                                                <input type="hidden"
                                                                                    value="<?php echo $row['File_Name'] ?>" name="file">
                                                                                <button type="submit" class="btn btn-primary ms-2"
                                                                                    style="height: 2.3em; width: 6em;"
                                                                                    name="fileopener">Open File</button>
                                                                            </form>
                                                                        </div>
                                                                        <?php if (isset($_POST['fileopener'])) {
                                                                            $_SESSION['file'] = $_POST['file'] ?>
                                                                            <script>window.location.href = "pdfdisplayer.php"</script>
                                                                        <?php }
                                                                        if (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                            <div class="form-floating">
                                                                                <textarea class="form-control"
                                                                                    placeholder="State your reason here"
                                                                                    id="floatingTextarea" style="height: 10em" name="reason"
                                                                                    disabled readonly required></textarea>
                                                                                <label
                                                                                    for="floatingTextarea"><?php echo (empty($row['ReasonFR'])) ? "The Admin did not leave a reason" : $row['ReasonFR'] ?></label>
                                                                            </div>
                                                                        <?php }
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="<?php echo str_replace(" ", "", $doclist) ?>">Upload</button>
                                                                            </div>
                                                                        </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                            $importance = "Required";
                                                                            $documenttype = $doclist;
                                                                            $file = htmlspecialchars($_FILES['file']['name']);
                                                                            $location = "file/" . $file;
                                                                            $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                            $result = mysqli_query($conn, $sql);
                                                                            if (mysqli_num_rows($result) == 0) {
                                                                                $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name, Importance)
                                                                                    VALUES ('$userid', '$documenttype', '$file', '$importance')";
                                                                                mysqli_query($conn, $sql);
                                                                                if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                    ?>
                                                                                    <script>alert("Files Uploaded Successfully.")
                                                                                        window.location.href = "profile.php"
                                                                                    </script><?php
                                                                                } else { ?>
                                                                                    <script>alert("Something went wrong.")</script>
                                                                                <?php }
                                                                            } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                        }
                                                                }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                        for ($i = 0; $i < count($doctype['Optional']); $i++) {
                                                            $doclist = $doctype['Optional'][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <i
                                                                        class="text-secondary" style="font-size: .8em;">Optional</i>
                                                                </td>
                                                                <?php
                                                                $sql = "SELECT Status, File_Name, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = '$userid' AND Document_type = '$doclist'";
                                                                $result = mysqli_query($conn, $sql);
                                                                $row = mysqli_fetch_assoc($result); ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($row['Status']) && $row['Status'] === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php
                                                                if (isset($row['File_Name'])) { ?>
                                                                        <div class="d-flex">
                                                                            <form method="POST" enctype="multipart/form-data">
                                                                                <div class="d-flex">
                                                                                    <div class="mb-3">
                                                                                        <input class="form-control" type="file"
                                                                                            id="formFile" name="file"
                                                                                            accept="application/pdf" required>
                                                                                    </div>
                                                                                    <button class="btn btn-primary shadow ms-2"
                                                                                        type="submit" style="height: 2.3em;"
                                                                                        name="<?php echo str_replace(" ", "", $doclist) ?>">Edit</button>
                                                                                </div>
                                                                            </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                                $documenttype = $doclist;
                                                                                $file = htmlspecialchars($_FILES['file']['name']);
                                                                                $location = "file/" . $file;
                                                                                $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                                $result = mysqli_query($conn, $sql);
                                                                                if (mysqli_num_rows($result) == 0) {
                                                                                    $sql = "UPDATE requirements_tbl
                                                                                        SET File_Name = '$file',
                                                                                        Status = 'Unvalidated'
                                                                                        where Document_Type = '$documenttype' 
                                                                                        AND User_ID = '$userid'";
                                                                                    mysqli_query($conn, $sql);
                                                                                    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                        ?>
                                                                                        <script>alert("Files Updated Successfully.")
                                                                                            window.location.href = "profile.php"
                                                                                        </script><?php
                                                                                    } else { ?>
                                                                                        <script>alert("Something went wrong.")</script>
                                                                                    <?php }
                                                                                } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                    <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                            } ?>
                                                                            <form method="POST">
                                                                                <input type="hidden"
                                                                                    value="<?php echo $row['File_Name'] ?>" name="file">
                                                                                <button type="submit" class="btn btn-primary ms-2"
                                                                                    style="height: 2.3em; width: 6em;"
                                                                                    name="fileopener">Open File</button>
                                                                            </form>
                                                                        </div>
                                                                        <?php if (isset($_POST['fileopener'])) {
                                                                            $_SESSION['file'] = $_POST['file'] ?>
                                                                            <script>window.location.href = "pdfdisplayer.php"</script>
                                                                        <?php }
                                                                        if (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                            <div class="form-floating">
                                                                                <textarea class="form-control"
                                                                                    placeholder="State your reason here"
                                                                                    id="floatingTextarea" style="height: 10em" name="reason"
                                                                                    disabled readonly required></textarea>
                                                                                <label
                                                                                    for="floatingTextarea"><?php echo (empty($row['ReasonFR'])) ? "The Admin did not leave a reason" : $row['ReasonFR'] ?></label>
                                                                            </div>
                                                                        <?php }
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="<?php echo str_replace(" ", "", $doclist) ?>">Upload</button>
                                                                            </div>
                                                                        </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                            $importance = "Optional";
                                                                            $documenttype = $doclist;
                                                                            $file = htmlspecialchars($_FILES['file']['name']);
                                                                            $location = "file/" . $file;
                                                                            $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                            $result = mysqli_query($conn, $sql);
                                                                            if (mysqli_num_rows($result) == 0) {
                                                                                $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name, Importance)
                                                                                    VALUES ('$userid', '$documenttype', '$file', '$importance')";
                                                                                mysqli_query($conn, $sql);
                                                                                if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                    ?>
                                                                                    <script>alert("Files Uploaded Successfully.")
                                                                                        window.location.href = "profile.php"
                                                                                    </script><?php
                                                                                } else { ?>
                                                                                    <script>alert("Something went wrong.")</script>
                                                                                <?php }
                                                                            } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                        }
                                                                }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    } elseif ($at === "Food Assistance") {
                                                        $doctype = array(
                                                            "Required" => [
                                                                "Barangay Indigency",
                                                                "Valid ID",
                                                                "Marriage Certificate",
                                                                "Birth Certificate"
                                                            ],
                                                            "Optional" => [
                                                                "Disaster Certificate",
                                                                "Medical Certificate",
                                                                "Medical Referral"
                                                            ]
                                                        );
                                                        for ($i = 0; $i < count($doctype['Required']); $i++) {
                                                            $doclist = $doctype['Required'][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <i class="text-danger"
                                                                        style="font-size: .8em;">Required</i></td>
                                                                <?php
                                                                $sql = "SELECT Status, File_Name, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = '$userid' AND Document_type = '$doclist'";
                                                                $result = mysqli_query($conn, $sql);
                                                                $row = mysqli_fetch_assoc($result); ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($row['Status']) && $row['Status'] === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php
                                                                if (isset($row['File_Name'])) { ?>
                                                                        <div class="d-flex">
                                                                            <form method="POST" enctype="multipart/form-data">
                                                                                <div class="d-flex">
                                                                                    <div class="mb-3">
                                                                                        <input class="form-control" type="file"
                                                                                            id="formFile" name="file"
                                                                                            accept="application/pdf" required>
                                                                                    </div>
                                                                                    <button class="btn btn-primary shadow ms-2"
                                                                                        type="submit" style="height: 2.3em;"
                                                                                        name="<?php echo str_replace(" ", "", $doclist) ?>">Edit</button>
                                                                                </div>
                                                                            </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                                $documenttype = $doclist;
                                                                                $file = htmlspecialchars($_FILES['file']['name']);
                                                                                $location = "file/" . $file;
                                                                                $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                                $result = mysqli_query($conn, $sql);
                                                                                if (mysqli_num_rows($result) == 0) {
                                                                                    $sql = "UPDATE requirements_tbl
                                                                                        SET File_Name = '$file',
                                                                                        Status = 'Unvalidated'
                                                                                        where Document_Type = '$documenttype' 
                                                                                        AND User_ID = '$userid'";
                                                                                    mysqli_query($conn, $sql);
                                                                                    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                        ?>
                                                                                        <script>alert("Files Updated Successfully.")
                                                                                            window.location.href = "profile.php"
                                                                                        </script><?php
                                                                                    } else { ?>
                                                                                        <script>alert("Something went wrong.")</script>
                                                                                    <?php }
                                                                                } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                    <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                            } ?>
                                                                            <form method="POST">
                                                                                <input type="hidden"
                                                                                    value="<?php echo $row['File_Name'] ?>" name="file">
                                                                                <button type="submit" class="btn btn-primary ms-2"
                                                                                    style="height: 2.3em; width: 6em;"
                                                                                    name="fileopener">Open File</button>
                                                                            </form>
                                                                        </div>
                                                                        <?php if (isset($_POST['fileopener'])) {
                                                                            $_SESSION['file'] = $_POST['file'] ?>
                                                                            <script>window.location.href = "pdfdisplayer.php"</script>
                                                                        <?php }
                                                                        if (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                            <div class="form-floating">
                                                                                <textarea class="form-control"
                                                                                    placeholder="State your reason here"
                                                                                    id="floatingTextarea" style="height: 10em" name="reason"
                                                                                    disabled readonly required></textarea>
                                                                                <label
                                                                                    for="floatingTextarea"><?php echo (empty($row['ReasonFR'])) ? "The Admin did not leave a reason" : $row['ReasonFR'] ?></label>
                                                                            </div>
                                                                        <?php }
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="<?php echo str_replace(" ", "", $doclist) ?>">Upload</button>
                                                                            </div>
                                                                        </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                            $importance = "Required";
                                                                            $documenttype = $doclist;
                                                                            $file = htmlspecialchars($_FILES['file']['name']);
                                                                            $location = "file/" . $file;
                                                                            $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                            $result = mysqli_query($conn, $sql);
                                                                            if (mysqli_num_rows($result) == 0) {
                                                                                $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name, Importance)
                                                                                    VALUES ('$userid', '$documenttype', '$file', '$importance')";
                                                                                mysqli_query($conn, $sql);
                                                                                if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                    ?>
                                                                                    <script>alert("Files Uploaded Successfully.")
                                                                                        window.location.href = "profile.php"
                                                                                    </script><?php
                                                                                } else { ?>
                                                                                    <script>alert("Something went wrong.")</script>
                                                                                <?php }
                                                                            } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                        }
                                                                }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                        for ($i = 0; $i < count($doctype['Optional']); $i++) {
                                                            $doclist = $doctype['Optional'][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <i
                                                                        class="text-secondary" style="font-size: .8em;">Optional</i>
                                                                </td>
                                                                <?php
                                                                $sql = "SELECT Status, File_Name, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = '$userid' AND Document_type = '$doclist'";
                                                                $result = mysqli_query($conn, $sql);
                                                                $row = mysqli_fetch_assoc($result); ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($row['Status']) && $row['Status'] === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php
                                                                if (isset($row['File_Name'])) { ?>
                                                                        <div class="d-flex">
                                                                            <form method="POST" enctype="multipart/form-data">
                                                                                <div class="d-flex">
                                                                                    <div class="mb-3">
                                                                                        <input class="form-control" type="file"
                                                                                            id="formFile" name="file"
                                                                                            accept="application/pdf" required>
                                                                                    </div>
                                                                                    <button class="btn btn-primary shadow ms-2"
                                                                                        type="submit" style="height: 2.3em;"
                                                                                        name="<?php echo str_replace(" ", "", $doclist) ?>">Edit</button>
                                                                                </div>
                                                                            </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                                $documenttype = $doclist;
                                                                                $file = htmlspecialchars($_FILES['file']['name']);
                                                                                $location = "file/" . $file;
                                                                                $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                                $result = mysqli_query($conn, $sql);
                                                                                if (mysqli_num_rows($result) == 0) {
                                                                                    $sql = "UPDATE requirements_tbl
                                                                                        SET File_Name = '$file',
                                                                                        Status = 'Unvalidated'
                                                                                        where Document_Type = '$documenttype' 
                                                                                        AND User_ID = '$userid'";
                                                                                    mysqli_query($conn, $sql);
                                                                                    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                        ?>
                                                                                        <script>alert("Files Updated Successfully.")
                                                                                            window.location.href = "profile.php"
                                                                                        </script><?php
                                                                                    } else { ?>
                                                                                        <script>alert("Something went wrong.")</script>
                                                                                    <?php }
                                                                                } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                    <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                            } ?>
                                                                            <form method="POST">
                                                                                <input type="hidden"
                                                                                    value="<?php echo $row['File_Name'] ?>" name="file">
                                                                                <button type="submit" class="btn btn-primary ms-2"
                                                                                    style="height: 2.3em; width: 6em;"
                                                                                    name="fileopener">Open File</button>
                                                                            </form>
                                                                        </div>
                                                                        <?php if (isset($_POST['fileopener'])) {
                                                                            $_SESSION['file'] = $_POST['file'] ?>
                                                                            <script>window.location.href = "pdfdisplayer.php"</script>
                                                                        <?php }
                                                                        if (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                            <div class="form-floating">
                                                                                <textarea class="form-control"
                                                                                    placeholder="State your reason here"
                                                                                    id="floatingTextarea" style="height: 10em" name="reason"
                                                                                    disabled readonly required></textarea>
                                                                                <label
                                                                                    for="floatingTextarea"><?php echo (empty($row['ReasonFR'])) ? "The Admin did not leave a reason" : $row['ReasonFR'] ?></label>
                                                                            </div>
                                                                        <?php }
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="<?php echo str_replace(" ", "", $doclist) ?>">Upload</button>
                                                                            </div>
                                                                        </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                            $importance = "Optional";
                                                                            $documenttype = $doclist;
                                                                            $file = htmlspecialchars($_FILES['file']['name']);
                                                                            $location = "file/" . $file;
                                                                            $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                            $result = mysqli_query($conn, $sql);
                                                                            if (mysqli_num_rows($result) == 0) {
                                                                                $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name, Importance)
                                                                                    VALUES ('$userid', '$documenttype', '$file', '$importance')";
                                                                                mysqli_query($conn, $sql);
                                                                                if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                    ?>
                                                                                    <script>alert("Files Uploaded Successfully.")
                                                                                        window.location.href = "profile.php"
                                                                                    </script><?php
                                                                                } else { ?>
                                                                                    <script>alert("Something went wrong.")</script>
                                                                                <?php }
                                                                            } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                        }
                                                                }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    } elseif ($at === "Cash Relief Assistance") {
                                                        $doctype = array(
                                                            "Required" => [
                                                                "Barangay Indigency",
                                                                "Valid ID",
                                                                "Marriage Certificate",
                                                                "Birth Certificate",
                                                                "Incident Report",
                                                            ],
                                                            "Optional" => [
                                                                "Medical Certificate",
                                                                "Medical Referral"
                                                            ]
                                                        );
                                                        for ($i = 0; $i < count($doctype['Required']); $i++) {
                                                            $doclist = $doctype['Required'][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <i class="text-danger"
                                                                        style="font-size: .8em;">Required</i></td>
                                                                <?php
                                                                $sql = "SELECT Status, File_Name, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = '$userid' AND Document_type = '$doclist'";
                                                                $result = mysqli_query($conn, $sql);
                                                                $row = mysqli_fetch_assoc($result); ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($row['Status']) && $row['Status'] === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php
                                                                if (isset($row['File_Name'])) { ?>
                                                                        <div class="d-flex">
                                                                            <form method="POST" enctype="multipart/form-data">
                                                                                <div class="d-flex">
                                                                                    <div class="mb-3">
                                                                                        <input class="form-control" type="file"
                                                                                            id="formFile" name="file"
                                                                                            accept="application/pdf" required>
                                                                                    </div>
                                                                                    <button class="btn btn-primary shadow ms-2"
                                                                                        type="submit" style="height: 2.3em;"
                                                                                        name="<?php echo str_replace(" ", "", $doclist) ?>">Edit</button>
                                                                                </div>
                                                                            </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                                $documenttype = $doclist;
                                                                                $file = htmlspecialchars($_FILES['file']['name']);
                                                                                $location = "file/" . $file;
                                                                                $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                                $result = mysqli_query($conn, $sql);
                                                                                if (mysqli_num_rows($result) == 0) {
                                                                                    $sql = "UPDATE requirements_tbl
                                                                                        SET File_Name = '$file',
                                                                                        Status = 'Unvalidated'
                                                                                        where Document_Type = '$documenttype' 
                                                                                        AND User_ID = '$userid'";
                                                                                    mysqli_query($conn, $sql);
                                                                                    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                        ?>
                                                                                        <script>alert("Files Updated Successfully.")
                                                                                            window.location.href = "profile.php"
                                                                                        </script><?php
                                                                                    } else { ?>
                                                                                        <script>alert("Something went wrong.")</script>
                                                                                    <?php }
                                                                                } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                    <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                            } ?>
                                                                            <form method="POST">
                                                                                <input type="hidden"
                                                                                    value="<?php echo $row['File_Name'] ?>" name="file">
                                                                                <button type="submit" class="btn btn-primary ms-2"
                                                                                    style="height: 2.3em; width: 6em;"
                                                                                    name="fileopener">Open File</button>
                                                                            </form>
                                                                        </div>
                                                                        <?php if (isset($_POST['fileopener'])) {
                                                                            $_SESSION['file'] = $_POST['file'] ?>
                                                                            <script>window.location.href = "pdfdisplayer.php"</script>
                                                                        <?php }
                                                                        if (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                            <div class="form-floating">
                                                                                <textarea class="form-control"
                                                                                    placeholder="State your reason here"
                                                                                    id="floatingTextarea" style="height: 10em" name="reason"
                                                                                    disabled readonly required></textarea>
                                                                                <label
                                                                                    for="floatingTextarea"><?php echo (empty($row['ReasonFR'])) ? "The Admin did not leave a reason" : $row['ReasonFR'] ?></label>
                                                                            </div>
                                                                        <?php }
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="<?php echo str_replace(" ", "", $doclist) ?>">Upload</button>
                                                                            </div>
                                                                        </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                            $importance = "Required";
                                                                            $documenttype = $doclist;
                                                                            $file = htmlspecialchars($_FILES['file']['name']);
                                                                            $location = "file/" . $file;
                                                                            $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                            $result = mysqli_query($conn, $sql);
                                                                            if (mysqli_num_rows($result) == 0) {
                                                                                $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name, Importance)
                                                                                    VALUES ('$userid', '$documenttype', '$file', '$importance')";
                                                                                mysqli_query($conn, $sql);
                                                                                if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                    ?>
                                                                                    <script>alert("Files Uploaded Successfully.")
                                                                                        window.location.href = "profile.php"
                                                                                    </script><?php
                                                                                } else { ?>
                                                                                    <script>alert("Something went wrong.")</script>
                                                                                <?php }
                                                                            } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                        }
                                                                }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                        for ($i = 0; $i < count($doctype['Optional']); $i++) {
                                                            $doclist = $doctype['Optional'][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <i
                                                                        class="text-secondary" style="font-size: .8em;">Optional</i>
                                                                </td>
                                                                <?php
                                                                $sql = "SELECT Status, File_Name, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = '$userid' AND Document_type = '$doclist'";
                                                                $result = mysqli_query($conn, $sql);
                                                                $row = mysqli_fetch_assoc($result); ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($row['Status']) && $row['Status'] === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php
                                                                if (isset($row['File_Name'])) { ?>
                                                                        <div class="d-flex">
                                                                            <form method="POST" enctype="multipart/form-data">
                                                                                <div class="d-flex">
                                                                                    <div class="mb-3">
                                                                                        <input class="form-control" type="file"
                                                                                            id="formFile" name="file"
                                                                                            accept="application/pdf" required>
                                                                                    </div>
                                                                                    <button class="btn btn-primary shadow ms-2"
                                                                                        type="submit" style="height: 2.3em;"
                                                                                        name="<?php echo str_replace(" ", "", $doclist) ?>">Edit</button>
                                                                                </div>
                                                                            </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                                $documenttype = $doclist;
                                                                                $file = htmlspecialchars($_FILES['file']['name']);
                                                                                $location = "file/" . $file;
                                                                                $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                                $result = mysqli_query($conn, $sql);
                                                                                if (mysqli_num_rows($result) == 0) {
                                                                                    $sql = "UPDATE requirements_tbl
                                                                                        SET File_Name = '$file',
                                                                                        Status = 'Unvalidated'
                                                                                        where Document_Type = '$documenttype' 
                                                                                        AND User_ID = '$userid'";
                                                                                    mysqli_query($conn, $sql);
                                                                                    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                        ?>
                                                                                        <script>alert("Files Updated Successfully.")
                                                                                            window.location.href = "profile.php"
                                                                                        </script><?php
                                                                                    } else { ?>
                                                                                        <script>alert("Something went wrong.")</script>
                                                                                    <?php }
                                                                                } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                    <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                            } ?>
                                                                            <form method="POST">
                                                                                <input type="hidden"
                                                                                    value="<?php echo $row['File_Name'] ?>" name="file">
                                                                                <button type="submit" class="btn btn-primary ms-2"
                                                                                    style="height: 2.3em; width: 6em;"
                                                                                    name="fileopener">Open File</button>
                                                                            </form>
                                                                        </div>
                                                                        <?php if (isset($_POST['fileopener'])) {
                                                                            $_SESSION['file'] = $_POST['file'] ?>
                                                                            <script>window.location.href = "pdfdisplayer.php"</script>
                                                                        <?php }
                                                                        if (isset($row['Status']) && $row['Status'] === "Rejected") { ?>
                                                                            <div class="form-floating">
                                                                                <textarea class="form-control"
                                                                                    placeholder="State your reason here"
                                                                                    id="floatingTextarea" style="height: 10em" name="reason"
                                                                                    disabled readonly required></textarea>
                                                                                <label for="floatingTextarea"><?php echo (empty($row['ReasonFR'])) ? "The Admin did not leave a reason" : $row['ReasonFR']?></label>
                                                                            </div>
                                                                        <?php }
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="<?php echo str_replace(" ", "", $doclist) ?>">Upload</button>
                                                                            </div>
                                                                        </form><?php if (isset($_POST[str_replace(" ", "", $doclist)])) {
                                                                            $importance = "Optional";
                                                                            $documenttype = $doclist;
                                                                            $file = htmlspecialchars($_FILES['file']['name']);
                                                                            $location = "file/" . $file;
                                                                            $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                                                            $result = mysqli_query($conn, $sql);
                                                                            if (mysqli_num_rows($result) == 0) {
                                                                                $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name, Importance)
                                                                                    VALUES ('$userid', '$documenttype', '$file', '$importance')";
                                                                                mysqli_query($conn, $sql);
                                                                                if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                                                                    ?>
                                                                                    <script>alert("Files Uploaded Successfully.")
                                                                                        window.location.href = "profile.php"
                                                                                    </script><?php
                                                                                } else { ?>
                                                                                    <script>alert("Something went wrong.")</script>
                                                                                <?php }
                                                                            } elseif (mysqli_num_rows($result) > 0) { ?>
                                                                                <script>alert("That file is already taken, please change the file name.")</script><?php }
                                                                        }
                                                                }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div
                class="col-8 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5 m-5">
                <h1 class="mb-4" id="pending">Pending Applications</h1>
                <table class="table table-striped border shadow rounded">
                    <tr>
                        <th scope="col">Assistance Type</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Date Submitted</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $sql = "SELECT Application_ID, Assistance_Type, Status, Date_Submitted 
                                FROM application_tbl 
                                where User_ID = '$userid' 
                                AND is_deleted = 0 
                                AND status = 'Pending'";
                        $result = mysqli_query($conn, $sql);
                        if ($row = mysqli_fetch_array($result)) { ?>
                            <tr>
                                <th><?php echo $row['Assistance_Type'] ?></th>
                                <th class="text-center text-warning"><?php echo $row['Status'] ?></th>
                                <th class="text-center"><?php echo $row['Date_Submitted'] ?></th>
                                <th class="d-flex">
                                    <form method="POST">
                                        <input type="hidden" name="appid" value="<?php echo $row['Application_ID'] ?>">
                                        <button type="submit" name="editForm" class="btn btn-primary me-1">Edit</button>
                                    </form>
                                    <?php if (isset($_POST['editForm'])) {
                                        $_SESSION['appid'] = $_POST['appid'];
                                        ?>
                                        <script>window.location.href = "applicationeditor.php"</script><?php
                                    } ?>
                                    <form method="POST">
                                        <button type="submit" name="deleteForm" class="btn btn-danger">Delete</button>
                                    </form>
                                    <?php if (isset($_POST['deleteForm'])) {
                                        $appid = $row['Application_ID'];
                                        $sql = "UPDATE application_tbl
                                                SET is_deleted = 1
                                                where Application_ID = '$appid'";
                                        mysqli_query($conn, $sql);
                                        ?>
                                        <script>window.location.href = "profile.php"</script><?php
                                    } ?>
                                </th>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div
                class="col-8 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5 m-5">
                <h1 class="mb-4" id="history">Applications History</h1>
                <table class="table table-striped border shadow rounded">
                    <tr>
                        <th class="text-center" scope="col">Assistance Type</th>
                        <th class="text-center" scope="col">Status</th>
                        <th scope="col">Reason</th>
                        <th class="text-center" scope="col">Date Reviewed</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $sql = "SELECT Assistance_Type, Status, Date_Submitted, Date_ApporRej, ReasonFR
                                FROM application_tbl
                                where User_ID = '$userid' 
                                AND is_deleted = '0' 
                                AND NOT Status = 'Pending'";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result)) { ?>
                            <tr>
                                <th class="text-center"><?php echo $row['Assistance_Type'] ?></th>
                                <?php if ($row['Status'] == "Approved") { ?>
                                    <th class="text-center text-success"><?php echo $row['Status'] ?></th>
                                <?php } else { ?>
                                    <th class="text-center text-danger"><?php echo $row['Status'] ?></th>
                                <?php } ?>
                                <th><?php echo (empty($row['ReasonFR'])) ? "This Application Has Been Approved" : $row['ReasonFR'] ?>
                                </th>
                                <th class="text-center"><?php echo $row['Date_ApporRej'] ?></th>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>