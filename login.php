<?php include 'connect.php'; 
session_start();
if (empty($_SESSION['userid'])) {?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="overflow-x-hidden" style="min-width: 50em;">
    <div class="container-fluid">
        <div class="d-flex flex-column justify-content-center align-items-center mt-5">
            <form method="POST">
                <div class="mb-3">
                    <label for="account" class="form-label">Username or Email</label>
                    <input type="text" class="form-control" placeholder="Enter Username/Email" name="account"
                        maxlength="25" required>
                </div>
                <div class="mb-3">
                    <label for="Password" class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Enter Password" name="password"
                        maxlength="15" required>
                </div>
                <div class="mb-3 justify-content-center align-items-center d-flex">
                    <button type="submit" name="loginForm" class="btn btn-primary">Submit</button>
                </div>
                <p>Go to <a href="register.php">Sign up</a> or <a href="index.php">homepage</a></p>
            </form>
            <?php if (isset($_POST['loginForm'])) {
                $account = $_POST['account'];
                $password = $_POST['password'];

                $sql = "SELECT User_ID, Password FROM register_tbl where Username = '$account' OR Email = '$account'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $fetchedPassword = $row['Password'];
                    if ($password === $fetchedPassword) {
                        $userid = $row['User_ID'];
                        $sql = "SELECT Access_Level FROM register_tbl where User_ID = '$userid'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        if ($row['Access_Level'] === "Admin") {
                            $_SESSION['authority'] = $row['Access_Level']?>
                        <script>window.location.href = 'administration.php'</script> <?php
                        } else {?>
                        <script>window.location.href = 'index.php'</script> <?php
                        $_SESSION['userid'] = $userid;
                    }} else { ?>
                        <p class="text-danger justify-content-center align-items-center d-flex">Incorrect Password.</p><?php }
                } else { ?>
                    <p class="text-danger justify-content-center align-items-center d-flex">Incorrect Username.</p><?php }
            }
            $conn->close() ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
<?php } else {?> <script>window.location.href = 'index.php'</script><?php }