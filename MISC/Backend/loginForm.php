<?php 
session_start();
include "Functions/PHP/userLoggedIn.php";
include "Functions/PHP/adminLoggedIn.php"?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">

        <div class="row justify-content-md-center my-5">
            <div class="col-md-auto">

                <form method="POST" action="Functions/PHP/login.php">

                    <label for="accountLogin">Username or Password</label>
                    <input type="text" maxlength="50" id="accountLogin" name="account" required>

                    <label for="passwordLogin">Password</label>
                    <input type="password" maxlength="50" id="passwordLogin" name="password" required>

                    <input type="hidden" name="login" required>
                    <button type="submit">Login</button><br>

                </form>

                <?php include "Functions/PHP/loginFail.php"?>

                <a href="registrationForm.php">Register</a>
                <a href="index.php">Index</a>

            </div>
        </div>

    </div>

    <script src="https://kit.fontawesome.com/7961b8f896.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
</body>

</html>