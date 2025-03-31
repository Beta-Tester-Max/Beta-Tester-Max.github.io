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
</head>

<body>
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
                    $sql = "SELECT * FROM requirements_tbl where User_ID = '$userid'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result) ?>
                    <thead>
                        <tr>
                            <th scope="col">Document Type</th>
                            <th scope="col">Importance</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Updated Original Certificate of Indigency from Barangay with proof of low income.</td>
                            <td class="text-center">Required</td>
                            <td class="text-center"><?php echo (empty($row['Brgy_Indigency'])) ? "❌" : "✅"; ?></td>
                            <td><?php if (empty($row['Brgy_Indigency'])) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Upload" type="submit"
                                            name="fileUpload01">
                                    </form><?php if (isset($_POST['fileUpload01'])) {
                                        $file = $_FILES['file']['name'];
                                        $userid = $_SESSION['userid'];
                                        $location = "image/" . $file;
                                        $sql = "INSERT INTO requirements_tbl (User_ID, Brgy_Indigency)
                                                VALUES ('$userid', '$file')";
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
                                        print_r($file);
                                        $file = $_FILES['file']['name'];
                                        $userid = $_SESSION['userid'];
                                        $location = "image/" . $file;
                                        $sql = "UPDATE requirements_tbl
                                            SET Brgy_Indigency = '$file'
                                            where User_ID = '$userid'";
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
                            <td>Valid ID.</td>
                            <td class="text-center">Required</td>
                            <td class="text-center"><?php echo (empty($row['Valid_ID'])) ? "❌" : "✅"; ?></td>
                            <td><?php if (empty($row['Valid_ID'])) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Upload" type="submit"
                                            name="fileUpload02">
                                    </form><?php if (isset($_POST['fileUpload02'])) {
                                        $file = $_FILES['file']['name'];
                                        $userid = $_SESSION['userid'];
                                        $location = "image/" . $file;
                                        $sql = "INSERT INTO requirements_tbl (User_ID, Valid_ID)
                                                VALUES ('$userid', '$file')";
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
                                        $file = $_FILES['file']['name'];
                                        $userid = $_SESSION['userid'];
                                        $location = "image/" . $file;
                                        $sql = "UPDATE requirements_tbl
                                            SET Valid_ID = '$file'
                                            where User_ID = '$userid'";
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
                            <td>Marriage Certificate or Birth Certificate.</td>
                            <td class="text-center">Required</td>
                            <td class="text-center">
                                <?php echo (empty($row['Birth/Marriage_Cert'])) ? "❌" : "✅"; ?>
                            </td>
                            <td><?php if (empty($row['Birth/Marriage_Cert'])) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Upload" type="submit"
                                            name="fileUpload03">
                                    </form><?php if (isset($_POST['fileUpload03'])) {
                                        $file = $_FILES['file']['name'];
                                        $userid = $_SESSION['userid'];
                                        $location = "image/" . $file;
                                        $sql = "INSERT INTO requirements_tbl (User_ID, Birth/Marriage_Cert)
                                                VALUES ('$userid', '$file')";
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
                                        $file = $_FILES['file']['name'];
                                        $userid = $_SESSION['userid'];
                                        $location = "image/" . $file;
                                        $sql = "UPDATE requirements_tbl
                                            SET Birth/Marriage_Cert = '$file'
                                            where User_ID = '$userid'";
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
                            <td>Referral Letter from Social Worker, Barangay Officer, or Mental Health Professional.
                            <td class="text-center">Required</td>
                            <td class="text-center"><?php echo (empty($row['Ref_Letter'])) ? "❌" : "✅"; ?></td>
                            <td><?php if (empty($row['Ref_Letter'])) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Upload" type="submit"
                                            name="fileUpload04">
                                    </form><?php if (isset($_POST['fileUpload04'])) {
                                        $file = $_FILES['file']['name'];
                                        $userid = $_SESSION['userid'];
                                        $location = "image/" . $file;
                                        $sql = "INSERT INTO requirements_tbl (User_ID, Ref_Letter)
                                                VALUES ('$userid', '$file')";
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
                                        $file = $_FILES['file']['name'];
                                        $userid = $_SESSION['userid'];
                                        $location = "image/" . $file;
                                        $sql = "UPDATE requirements_tbl
                                            SET Ref_Letter = '$file'
                                            where User_ID = '$userid'";
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
                            <td>Medical or Psychological Report.</td>
                            <td class="text-center">Optional</td>
                            <td class="text-center">
                                <?php echo (empty($row['Med/Psycho_Rep'])) ? "❌" : "✅"; ?>
                            </td>
                            <td><?php if (empty($row['Med/Psycho_Rep'])) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Upload" type="submit"
                                            name="fileUpload05">
                                    </form><?php if (isset($_POST['fileUpload05'])) {
                                        $file = $_FILES['file']['name'];
                                        $userid = $_SESSION['userid'];
                                        $location = "image/" . $file;
                                        $sql = "INSERT INTO requirements_tbl (User_ID, Med/Psycho_Rep)
                                                VALUES ('$userid', '$file')";
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
                                        $file = $_FILES['file']['name'];
                                        $userid = $_SESSION['userid'];
                                        $location = "image/" . $file;
                                        $sql = "UPDATE requirements_tbl
                                            SET Med/Psycho_Rep = '$file'
                                            where User_ID = '$userid'";
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
                            <td>Police or Legal Report.</td>
                            <td class="text-center">Optional</td>
                            <td class="text-center">
                                <?php echo (empty($row['Police/Legal_Rep'])) ? "❌" : "✅"; ?>
                            </td>
                            <td><?php if (empty($row['Police/Legal_Rep'])) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Upload" type="submit"
                                            name="fileUpload06">
                                    </form><?php if (isset($_POST['fileUpload06'])) {
                                        $file = $_FILES['file']['name'];
                                        $userid = $_SESSION['userid'];
                                        $location = "image/" . $file;
                                        $sql = "INSERT INTO requirements_tbl (User_ID, Police/Legal_Rep)
                                                VALUES ('$userid', '$file')";
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
                                        $file = $_FILES['file']['name'];
                                        $userid = $_SESSION['userid'];
                                        $location = "image/" . $file;
                                        $sql = "UPDATE requirements_tbl
                                            SET Police/Legal_Rep = '$file'
                                            where User_ID = '$userid'";
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
                            <td>Disaster or Emergency Certification.</td>
                            <td class="text-center">Optional</td>
                            <td class="text-center">
                                <?php echo (empty($row['Disaster/Emergency_Cert'])) ? "❌" : "✅"; ?>
                            </td>
                            <td><?php if (empty($row['Ref_Letter'])) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" id="myFile" name="file" accept="application/pdf" required>
                                        <input class="btn btn-primary shadow" value="Upload" type="submit"
                                            name="fileUpload07">
                                    </form><?php if (isset($_POST['fileUpload07'])) {
                                        $file = $_FILES['file']['name'];
                                        $userid = $_SESSION['userid'];
                                        $location = "image/" . $file;
                                        $sql = "INSERT INTO requirements_tbl (User_ID, Police/Legal_Rep)
                                                VALUES ('$userid', '$file')";
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
                                        $file = $_FILES['file']['name'];
                                        $userid = $_SESSION['userid'];
                                        $location = "image/" . $file;
                                        $sql = "UPDATE requirements_tbl
                                            SET Police/Legal_Rep = '$file'
                                            where User_ID = '$userid'";
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