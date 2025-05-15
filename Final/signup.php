<?php 
session_start();
include "Functions/PHP/userLoggedIn.php";
include "Functions/PHP/adminLoggedIn.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign Up</title>
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

        label {
            font-size: 16px;
        }

        #passwordRequirements {
            margin-top: 10px;
        }

        #passwordRequirements li {
            font-size: 14px;
            margin: 5px 0;
            color: #bbb;
            display: flex;
            align-items: center;
        }

        .valid {
            color: green;
        }

        .invalid {
            color: red;
        }

        .valid::before {
            content: '✔';
            margin-right: 10px;
            color: green;
        }

        .invalid::before {
            content: '✘';
            margin-right: 10px;
            color: red;
        }

        #password:invalid {
            border-color: black;
        }

        #password:valid {
            border-color: green;
        }

        #submitBtn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        #submitBtn:enabled {
            background-color: #28a745;
            cursor: pointer;
        }
    </style>
</head>

<body class="overflow-hidden">
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
            <form method="POST" action="Functions/PHP/signupInsert.php" class="logbox" id="sF">
                <div class="mb-3">
                    <h1 class="textHead">Sign Up</h1>
                    <img src="./assets/img/AICS150.png" alt="AICS LOGO" id="logoLog" />

                </div>
                <div class="input-container" style="background-color: #ffffff">
                    <input type="text" class="form-input" id="username" placeholder="" required
                        style="background-color: #ffffff" max="50" name="username">
                    <label for="account" style="color: #0c0b0b">Username</label>
                </div>
                <div class="input-container" style="background-color: #ffffff">
                    <input type="email" class="form-input" id="email" placeholder="" required
                        style="background-color: #ffffff" max="50" name="email">
                    <label for="account" style="color: #0c0b0b">Email Address</label>
                </div>
                <div class="input-container" style="background-color: #ffffff">
                    <input type="password" class="form-input" id="password" placeholder="" required
                        style="background-color: #ffffff" max="15" name="pass">
                    <label for="Password" style="color: #0c0b0b">Password</label>
                </div>

                <div id="passwordRequirements" class="d-none">
                    <ul>
                        <li id="lengthRequirement">8-15 characters</li>
                        <li id="lowercaseRequirement">At least one lowercase letter</li>
                        <li id="uppercaseRequirement">At least one uppercase letter</li>
                        <li id="numberRequirement">At least one number</li>
                        <li id="specialCharRequirement">At least one special character</li>
                        <li id="noSpaceRequirement">No spaces allowed</li>
                    </ul>
                </div>

                <div class="remember-me">
                    <input type="checkbox" id="remember" />
                    <label for="remember">Remember me</label>
                </div>
                <div class="agree">
                    <input type="checkbox" id="agree" value="1" name="consent" required> <label for="agree">
                        I agree to <a href="privacy.html">Privacy Policy</a> and
                        <a href="consent.html">Consent</a></label></input>
                </div>
                <div class="my-2 justify-content-center align-items-center d-flex">
                    <input type="hidden" name="signup">
                    <button type="submit" disabled id="submitBtn" class="btn btn-success">
                        Create
                    </button>
                </div>
                <p class="text-center">Already have an account?</p>
                <p class="text-center">
                    <a href="login.php">Log In</a> or Go to
                    <a href="index.php">Homepage</a>
                </p>
            </form>
        </div>
    </div>
    <script src="Functions/JS/signupScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>