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

                <form method="POST" action="Functions/PHP/register.php">

                    <label for="usernameRegister">Username</label>
                    <input type="text" maxlength="50" id="usernameRegister" name="username" required>

                    <label for="emailRegister">Email</label>
                    <input type="email" maxlength="50" id="emailRegister" name="email" required>

                    <label for="passwordRegister">Password</label>
                    <input type="password" maxlength="50" id="passwordRegister" name="password" required>

                    <input type="hidden" name="register" required>
                    <button type="submit">Sign Up</button><br>

                </form>

                <a href="loginForm.php">Login</a>
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