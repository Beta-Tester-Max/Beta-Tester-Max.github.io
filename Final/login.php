<?php 
ini_set('session.cookie_httponly', 1);
session_start();
include "Functions/PHP/displayAlert.php";
include "Functions/PHP/userLoggedIn.php";
include "Functions/PHP/adminLoggedIn.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/AICS150.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/login.css" />
    <link rel="stylesheet" href="./assets/nav.css" />
    <style>
        #logoLog {
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            margin: auto;
        }
    </style>
</head>

<body class="overflow-x-hidden">
    <nav class="sticky-top navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img class="logo" src="./assets/img/AICS150.png" alt="AICS" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="d-flex flex-column justify-content-center align-items-center mt-2">
            <form method="POST" class="logbox" action="Functions/PHP/loginInsert.php">
                <div class="mb-3">
                    <h1 class="textHead">Login</h1>
                    <img src="./assets/img/AICS150.png" alt="AICS LOGO" id="logoLog" />
                </div>
                <div class="input-container" style="background-color: #ffffff">
                    <input type="text" class="form-input" id="email" placeholder="" required
                        style="background-color: #ffffff" name="account" minlength="3" maxlength="50">
                    <label for="account" style="color: #0c0b0b">Email or Username</label>
                </div>
                <div class="input-container" style="background-color: #ffffff">
                    <input type="password" class="form-input" id="password" placeholder=""
                        required style="background-color: #ffffff" name="pass" minlength="8" maxlength="15">
                    <label for="Password" style="color: #0c0b0b">Password</label>
                </div>

                <div class="remember-me">
                    <input type="checkbox" id="remember" />
                    <label for="remember">Remember me</label>
                </div>
                <div class="my-3 justify-content-center align-items-center d-flex">
                    <input type="hidden" name="login">
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>
                </div>
                <p class="text-center">Don't have an account?</p>
                <p class="text-center">
                    <a href="signup.php">Sign up</a> or Go to
                    <a href="index.php">Homepage</a>
                </p>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>