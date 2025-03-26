<?php include 'connect.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="position-absolute top-50 start-50 translate-middle">
            <form method="POST">
                <div class="mb-3">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="text" maxlength="20" class="form-control" placeholder="Enter your First Name" name="fname" required>
                </div>
                <div class="mb-3">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="text" maxlength="20" class="form-control" placeholder="Enter your Last Name" name="lname" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" maxlength="25" class="form-control" placeholder="Enter your Username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" maxlength="25" class="form-control" placeholder="Enter your Email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Enter your Password" name="password"
                        maxlength="15" required>
                </div>
                <div class="mb-3 justify-content-center align-items-center d-flex">
                    <button type="submit" name="registerForm" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <?php if (isset($_POST['registerForm'])) {
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                $sql = "SELECT * FROM register_tbl where username = '$username'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) == 0) {
                    $sql = "INSERT INTO register_tbl (Fname, Lname, Username, Email, Password)
                            VALUES ('$fname', '$lname', '$username', '$email', '$password')";

                    if (mysqli_query($conn, $sql)) {
                        ?>
                        <script>window.location.href = "login.php"</script> <?php
                    }
                } else { ?>
                    <p class="text-danger justify-content-center align-items-center d-flex">Username Already Exists.</p><?php
                }
            } $conn->close()?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>