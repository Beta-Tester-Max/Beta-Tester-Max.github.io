<?php include "connect.php";
session_start();
if (empty($_SESSION['userid'])) { ?>
    <script>window.location.href = "logout.php";</script><?php } ?>
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
                    $userid = $_SESSION['userid'];
                    $sql = "SELECT t2.Fname, t2.Mname, t2.Lname, t1.Username, t1.Profile_Pic, t1.Email FROM register_tbl As t1, userinfo_tbl AS t2 where t1.User_ID = '$userid' AND t2.User_ID = '$userid'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result); ?>
                    <img class="border rounded shadow p-2 mb-5" style="width: 10em; height: 10em;"
                        src="<?php echo (empty($row['Profile_Pic'])) ? "placeholderprofilepic.png" : "file/" . $row['Profile_Pic'] ?>">
                    <h3><b>First Name: </b><?php echo $row['Fname'] ?></h3>
                    <h3><b>Middle Name: </b><?php echo $row['Mname'] ?></h3>
                    <h3><b>Last Name: </b><?php echo $row['Lname'] ?></h3>
                    <h3><b>Username: </b><?php echo $row['Username'] ?></h3>
                    <h3><b>Email: </b><?php echo $row['Email'] ?></h3>
                    <a class="btn btn-primary btn-lg mt-3 mb-2" href="profileeditor.php">Edit Profile</a>
                    <p>Go to <a href="index.php">Home</a>.</p>
                <?php } ?>
            </div>
            <div class="col-2"></div>
            <div class="col-4 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5">
                <?php if (isset($_SESSION['userid'])) {
                    $userid = $_SESSION['userid'];
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
                <table class="table table-striped border shadow rounded">
                    <tr>
                        <th scope="col">Document Type</th>
                        <th scope="col">Uploaded File</th>
                        <th scope="col">Importance</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $doctype = array(
                            "Barangay Indigency"=>"Required",
                            "Valid ID"=>"Required",
                            "Marriage Certificate"=>"Required",
                            "Birth Certificate"=>"Required",
                            "Referral Letter"=>"Required",
                            "Medical Report"=>"Optional",
                            "Psychological Report"=>"Optional",
                            "Polica Report"=>"Optional",
                            "Legal Report"=>"Optional",
                            "Disaster Certificate"=>"Optional",
                            "Emergency Certificate"=>"Optional"
                        );
                        foreach ($doctype as $dt => $im) {
                            $userid = $_SESSION['userid'];
                            $sql = "SELECT Document_Type, File_Name FROM requirements_tbl where User_ID = '$userid' AND Document_Type = '$dt'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result) ?>
                            <tr>
                                <td><?php echo $dt ?></td>
                                <td><?php echo (isset($row['Document_Type']) && $row['Document_Type'] == $dt) ? $row['File_Name'] : "No Uploaded File" ?>
                                </td>
                                <td class="text-center"><?php if ($im == "Required") {?> <p class="text-danger"><b>Required</b></p><?php } else {?><p class="text-secondary"><i>(Optional)</i></p><?php }?></td>
                                <td class="text-center">
                                    <?php echo (isset($row['Document_Type']) && $row['Document_Type'] == $dt) ? "✅" : "❌"; ?>
                                </td>
                                <td><?php if (isset($row['Document_Type']) && $row['Document_Type'] == $dt) { ?>
                                        <form method="POST" enctype="multipart/form-data">
                                            <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                            <input class="btn btn-primary shadow" value="Edit" type="submit"
                                                name="<?php echo str_replace(" ", "", $dt) ?>">
                                        </form><?php if (isset($_POST[str_replace(" ", "", $dt)])) {
                                            $documenttype = $dt;
                                            $userid = $_SESSION['userid'];
                                            $file = htmlspecialchars($_FILES['file']['name']);
                                            $location = "file/" . $file;
                                            $sql = "SELECT File_Name FROM requirements_tbl where File_Name = '$file'";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) == 0) {
                                                $sql = "UPDATE requirements_tbl
                                                        SET File_Name = '$file'
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
                                        }
                                } else { ?>
                                        <form method="POST" enctype="multipart/form-data">
                                            <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                            <input class="btn btn-primary shadow" value="Upload" type="submit"
                                                name="<?php echo str_replace(" ", "", $dt) ?>">
                                        </form><?php if (isset($_POST[str_replace(" ", "", $dt)])) {
                                            $importance = $im;
                                            $documenttype = $dt;
                                            $userid = $_SESSION['userid'];
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
                                } ?>
                                </td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>