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
        <div class="col d-flex justify-content-center align-items-center mt-5">
            <div class="row-12 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5">
                <img class="border rounded shadow p-2 mb-5" src="profile.png">
                <?php
                if (isset($_SESSION['userid'])) {
                    $userid = $_SESSION['userid'];
                    $sql = "SELECT Fname, Mname, Lname, Username, Email FROM register_tbl where User_ID = '$userid'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result); ?>
                    <h3><b>First Name: </b><?php echo $row['Fname'] ?></h3>
                    <h3><b>Middle Name: </b><?php echo $row['Mname'] ?></h3>
                    <h3><b>Last Name: </b><?php echo $row['Lname'] ?></h3>
                    <h3><b>Username: </b><?php echo $row['Username'] ?></h3>
                    <h3><b>Email: </b><?php echo $row['Email'] ?></h3>
                    <a class="btn btn-primary btn-lg mt-3 mb-2" href="profileeditor.php">Edit Profile</a>
                    <p>Go to <a href="index.php">Home</a>.</p>
                <?php } ?>
            </div>
        </div>
        <div class="col d-flex justify-content-center align-items-center mt-5 mb-5">
            <div class="row-12 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5">
                <h1 class="mb-4">Requirements</h1>
                <table class="table table-striped border shadow rounded">
                    <?php $userid = $_SESSION['userid'];
                    $sql = "SELECT Document_Type, File_Name FROM requirements_tbl where User_ID = '$userid'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result) ?>
                    <thead>
                        <tr>
                            <th scope="col">Document Type</th>
                            <th scope="col">Uploaded File</th>
                            <th scope="col">Importance</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Barangay Indigency</td>
                            <td><?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Barangay_Indigency") ? $row['File_Name'] : "No Uploaded File" ?>
                            </td>
                            <td class="text-center">Required</td>
                            <td class="text-center">
                                <?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Barangay_Indigency") ? "✅" : "❌"; ?>
                            </td>
                            <td><?php if (empty($row['Document_Type'])) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Upload" type="submit"
                                            name="fileUpload01">
                                    </form><?php if (isset($_POST['fileUpload01'])) {
                                        $documenttype = "Barangay_Indigency";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name)
                                                VALUES ('$userid', '$documenttype', '$file')";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Uploaded Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } else { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Edit" type="submit"
                                            name="fileUpdate01">
                                    </form><?php if (isset($_POST['fileUpdate01'])) {
                                        $documenttype = "Barangay_Indigency";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "UPDATE requirements_tbl
                                            SET File_Name = '$file'
                                            where Document_Type = '$documenttype' AND User_ID = '$userid'";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Updated Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Valid ID</td>
                            <td><?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Valid_ID") ? $row['File_Name'] : "No Uploaded File" ?>
                            </td>
                            <td class="text-center">Required</td>
                            <td class="text-center">
                                <?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Valid_ID") ? "✅" : "❌"; ?>
                            </td>
                            <td><?php if (empty($row['Document_Type'])) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Upload" type="submit"
                                            name="fileUpload02">
                                    </form><?php if (isset($_POST['fileUpload02'])) {
                                        $documenttype = "Valid_ID";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name)
                                                VALUES ('$userid', '$documenttype', '$file')";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Uploaded Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } else { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Edit" type="submit"
                                            name="fileUpdate02">
                                    </form><?php if (isset($_POST['fileUpdate02'])) {
                                        $documenttype = "Valid_ID";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "UPDATE requirements_tbl
                                            SET File_Name = '$file'
                                            where Document_Type = '$documenttype' AND User_ID = '$userid'";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Updated Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Marriage Certificate</td>
                            <td><?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Marriage_Certificate") ? $row['File_Name'] : "No Uploaded File" ?>
                            </td>
                            <td class="text-center">Required</td>
                            <td class="text-center">
                                <?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Marriage_Certificate") ? "✅" : "❌"; ?>
                            </td>
                            <td><?php if (empty($row['Document_Type'])) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Upload" type="submit"
                                            name="fileUpload03">
                                    </form><?php if (isset($_POST['fileUpload03'])) {
                                        $documenttype = "Marriage_Certificate";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name)
                                                VALUES ('$userid', '$documenttype', '$file')";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Uploaded Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } else { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Edit" type="submit"
                                            name="fileUpdate03">
                                    </form><?php if (isset($_POST['fileUpdate03'])) {
                                        $documenttype = "Marriage_Certificate";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "UPDATE requirements_tbl
                                            SET File_Name = '$file'
                                            where Document_Type = '$documenttype' AND User_ID = '$userid'";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Updated Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Birth Certificate</td>
                            <td><?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Birth_Certificate") ? $row['File_Name'] : "No Uploaded File" ?>
                            </td>
                            <td class="text-center">Required</td>
                            <td class="text-center">
                                <?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Birth_Certificate") ? "✅" : "❌"; ?>
                            </td>
                            <td><?php if (empty($row['Document_Type'])) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Upload" type="submit"
                                            name="fileUpload04">
                                    </form><?php if (isset($_POST['fileUpload04'])) {
                                        $documenttype = "Birth_Certificate";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name)
                                                VALUES ('$userid', '$documenttype', '$file')";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Uploaded Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } else { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Edit" type="submit"
                                            name="fileUpdate04">
                                    </form><?php if (isset($_POST['fileUpdate04'])) {
                                        $documenttype = "Birth_Certificate";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "UPDATE requirements_tbl
                                            SET File_Name = '$file'
                                            where Document_Type = '$documenttype' AND User_ID = '$userid'";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Updated Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Referral Letter</td>
                            <td><?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Referral_Letter") ? $row['File_Name'] : "No Uploaded File" ?>
                            </td>
                            <td class="text-center">Required</td>
                            <td class="text-center">
                                <?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Referral_Letter") ? "✅" : "❌"; ?>
                            </td>
                            <td><?php if (empty($row['Document_Type'])) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Upload" type="submit"
                                            name="fileUpload05">
                                    </form><?php if (isset($_POST['fileUpload05'])) {
                                        $documenttype = "Referral_Letter";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name)
                                                VALUES ('$userid', '$documenttype', '$file')";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Uploaded Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } else { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Edit" type="submit"
                                            name="fileUpdate05">
                                    </form><?php if (isset($_POST['fileUpdate05'])) {
                                        $documenttype = "Referral_Letter";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "UPDATE requirements_tbl
                                            SET File_Name = '$file'
                                            where Document_Type = '$documenttype' AND User_ID = '$userid'";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Updated Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Medical Report</td>
                            <td><?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Medical_Report") ? $row['File_Name'] : "No Uploaded File" ?>
                            </td>
                            <td class="text-center">Optional</td>
                            <td class="text-center">
                                <?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Medical_Report") ? "✅" : "❌"; ?>
                            </td>
                            <td><?php if (empty($row['Document_Type'])) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Upload" type="submit"
                                            name="fileUpload06">
                                    </form><?php if (isset($_POST['fileUpload06'])) {
                                        $documenttype = "Medical_Report";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name)
                                                VALUES ('$userid', '$documenttype', '$file')";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Uploaded Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } else { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Edit" type="submit"
                                            name="fileUpdate06">
                                    </form><?php if (isset($_POST['fileUpdate06'])) {
                                        $documenttype = "Medical_Report";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "UPDATE requirements_tbl
                                            SET File_Name = '$file'
                                            where Document_Type = '$documenttype' AND User_ID = '$userid'";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Updated Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } ?>
                        </tr>
                        <tr>
                            </td>
                            <td>Psychological Report</td>
                            <td><?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Psychological_Report") ? $row['File_Name'] : "No Uploaded File" ?>
                            </td>
                            <td class="text-center">Optional</td>
                            <td class="text-center">
                                <?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Psychological_Report") ? "✅" : "❌"; ?>
                            </td>
                            <td><?php if (empty($row['Document_Type'])) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Upload" type="submit"
                                            name="fileUpload07">
                                    </form><?php if (isset($_POST['fileUpload07'])) {
                                        $documenttype = "Psychological_Report";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name)
                                                VALUES ('$userid', '$documenttype', '$file')";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Uploaded Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } else { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Edit" type="submit"
                                            name="fileUpdate07">
                                    </form><?php if (isset($_POST['fileUpdate07'])) {
                                        $documenttype = "Psychological_Report";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "UPDATE requirements_tbl
                                            SET File_Name = '$file'
                                            where Document_Type = '$documenttype' AND User_ID = '$userid'";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Updated Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Police Report</td>
                            <td><?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Police_Report") ? $row['File_Name'] : "No Uploaded File" ?>
                            </td>
                            <td class="text-center">Optional</td>
                            <td class="text-center">
                                <?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Police_Report") ? "✅" : "❌"; ?>
                            </td>
                            <td><?php if (empty($row['Document_Type'])) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Upload" type="submit"
                                            name="fileUpload08">
                                    </form><?php if (isset($_POST['fileUpload08'])) {
                                        $documenttype = "Police_Report";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name)
                                                VALUES ('$userid', '$documenttype', '$file')";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Uploaded Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } else { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Edit" type="submit"
                                            name="fileUpdate08">
                                    </form><?php if (isset($_POST['fileUpdate08'])) {
                                        $file = $_FILES['file']['name'];
                                        $documenttype = "Police_Report";
                                        $userid = $_SESSION['userid'];
                                        $location = "file/" . $file;
                                        $sql = "UPDATE requirements_tbl
                                            SET File_Name = '$file'
                                            where Document_Type = '$documenttype' AND User_ID = '$userid'";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Updated Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Legal Report</td>
                            <td><?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Legal_Report") ? $row['File_Name'] : "No Uploaded File" ?>
                            </td>
                            <td class="text-center">Optional</td>
                            <td class="text-center">
                                <?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Legal_Report") ? "✅" : "❌"; ?>
                            </td>
                            <td><?php if (empty($row['Document_Type'])) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Upload" type="submit"
                                            name="fileUpload09">
                                    </form><?php if (isset($_POST['fileUpload09'])) {
                                        $documenttype = "Legal_Report";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name)
                                                VALUES ('$userid', '$documenttype', '$file')";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Uploaded Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } else { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Edit" type="submit"
                                            name="fileUpdate09">
                                    </form><?php if (isset($_POST['fileUpdate09'])) {
                                        $documenttype = "Legal_Report";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "UPDATE requirements_tbl
                                            SET File_Name = '$file'
                                            where Document_Type = '$documenttype' AND User_ID = '$userid'";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Updated Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Disaster Certification</td>
                            <td><?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Disaster_Certification") ? $row['File_Name'] : "No Uploaded File" ?>
                            </td>
                            <td class="text-center">Optional</td>
                            <td class="text-center">
                                <?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Disaster_Certification") ? "✅" : "❌"; ?>
                            </td>
                            <td><?php if (empty($row['Document_Type'])) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Upload" type="submit"
                                            name="fileUpload10">
                                    </form><?php if (isset($_POST['fileUpload10'])) {
                                        $documenttype = "Disaster_Certification";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name)
                                                VALUES ('$userid', '$documenttype', '$file')";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Uploaded Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } else { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Edit" type="submit"
                                            name="fileUpdate10">
                                    </form><?php if (isset($_POST['fileUpdate10'])) {
                                        $documenttype = "Disaster_Certification";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "UPDATE requirements_tbl
                                            SET File_Name = '$file'
                                            where Document_Type = '$documenttype' AND User_ID = '$userid'";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Updated Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Emergency Certification</td>
                            <td><?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Emergency_Certification") ? $row['File_Name'] : "No Uploaded File" ?>
                            </td>
                            <td class="text-center">Optional</td>
                            <td class="text-center">
                                <?php echo (isset($row['Document_Type']) && $row['Document_Type'] == "Emergency_Certification") ? "✅" : "❌"; ?>
                            </td>
                            <td><?php if (empty($row['Document_Type'])) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Upload" type="submit"
                                            name="fileUpload11">
                                    </form><?php if (isset($_POST['fileUpload11'])) {
                                        $documenttype = "Emergency_Certification";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "INSERT INTO requirements_tbl (User_ID, Document_Type, File_Name)
                                                VALUES ('$userid', '$documenttype', '$file')";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Uploaded Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } else { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Edit" type="submit"
                                            name="fileUpdate11">
                                    </form><?php if (isset($_POST['fileUpdate11'])) {
                                        $documenttype = "Emergency_Certification";
                                        $userid = $_SESSION['userid'];
                                        $file = $_FILES['file']['name'];
                                        $location = "file/" . $file;
                                        $sql = "UPDATE requirements_tbl
                                            SET File_Name = '$file'
                                            where Document_Type = '$documenttype' AND User_ID = '$userid'";
                                        mysqli_query($conn, $sql);
                                        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                                            ?>
                                            <script>alert("Files Updated Successfully.")
                                                window.location.href = "profile.php"
                                            </script><?php
                                        } else { ?>
                                            <script>alert("Something went wrong.")</script>
                                        <?php }
                                    }
                            } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>