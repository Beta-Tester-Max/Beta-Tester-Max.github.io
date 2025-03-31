<?php include "connect.php";
session_start();
if (empty($_SESSION['userid'])) { ?>
    <script>window.location.href = "logout.php";</script><?php } ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="overflow-x-hidden" style="min-width: 50em;">
    <div class="container-fluid">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <a class="mt-5" href="index.php">Go Back.</a>
            <form method="POST" enctype="multipart/form-data">
                <?php if (isset($_SESSION['userid'])) {
                    $userid = $_SESSION['userid'];
                    $sql = "SELECT Fname, Mname, Lname, Username, Profile_Pic, Email, Password FROM register_tbl where User_ID = '$userid'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="d-flex flex-column justify-content-center align-items-center mt-3 mb-3">
                        <img class="border rounded shadow p-2 mb-3" style="width: 10em; height: 10em;"
                            src="<?php echo (empty($row['Profile_Pic'])) ? "placeholderprofilepic.png" : "file/".$row['Profile_Pic'] ?>">
                        <input class="btn btn-outline-primary d-flex justify-content-center align-items-center" type="file" id="myFile" name="file"
                            value="<?php echo (empty($row['Profile_Pic'])) ? "placeholderprofilepic.png" : "file/".$row['Profile_Pic'] ?>" accept="image/png, image/jpeg, image/jpg, image/PNG, image/JPG">
                    </div>
                    <div class="mb-3">
                        <label for="fname" class="form-label">First Name</label>
                        <input type="text" maxlength="20" class="form-control" value="<?php echo $row['Fname'] ?>"
                            name="fname" required>
                    </div>
                    <div class="mb-3">
                        <label for="mname" class="form-label">Middle Name</label>
                        <input type="text" maxlength="20" class="form-control" name="mname"
                            value="<?php echo $row['Mname'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="text" maxlength="20" class="form-control" value="<?php echo $row['Lname'] ?>"
                            name="lname" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" maxlength="25" class="form-control" value="<?php echo $row['Username'] ?>"
                            name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" maxlength="25" class="form-control" value="<?php echo $row['Email'] ?>"
                            name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" value="<?php echo $row['Password'] ?>" name="password"
                            maxlength="15" required>
                    </div>
                <?php } ?>
                <div class="mb-3 justify-content-center align-items-center d-flex">
                    <button type="submit" name="editProfile" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <?php if (isset($_POST['editProfile'])) {
                $userid = $_SESSION['userid'];
                $fname = ucwords(strtolower($_POST['fname']));
                $mname = ucwords(strtolower($_POST['mname'])) ?: "";
                $lname = ucwords(strtolower($_POST['lname']));
                $username = $_POST['username'];
                $file = $_FILES['file']['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                $sql = "UPDATE register_tbl
                        SET Fname = '$fname',
                            Mname = '$mname',
                            Lname = '$lname',
                            Username = '$username',
                            Profile_Pic = '$file',
                            Email = '$email',
                            Password = '$password'
                        where User_ID = '$userid'";
                if (mysqli_query($conn, $sql)) {
                    $location = "file/".$file;
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {?>
                    <script>window.location.href = "profile.php";</script><?php } else {?>
                        <script>window.location.href = "profile.php";</script><?php }
                }
            } ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>