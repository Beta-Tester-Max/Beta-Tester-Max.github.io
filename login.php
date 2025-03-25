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
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="loginUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" placeholder="Enter your username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="loginPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Enter your password" name="password"
                        maxlength="15" required>
                </div>
                <div class="mb-3 ">
                    <button type="submit" name="loginForm" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <?php if (isset($_POST['loginForm'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $sql = "SELECT password FROM register_tbl where username = '$username'";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    $fetchedPassword = $row["password"];
                    if ($password === $fetchedPassword) { ?>
                        <script>window.location.href = 'index.php'</script> <?php
                    } else { ?>
                        <p class="text-danger justify-content-center align-items-center d-flex">Incorrect Password</p><?php }
                } else { ?>
                    <p class="text-danger justify-content-center align-items-center d-flex">Incorrect Username</p><?php }
            } ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>