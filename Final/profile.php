<?php
ini_set('session.cookie_httponly', 1);
session_start();
include "Functions/PHP/userDataFetcher.php";
include "Functions/PHP/forUser.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Portal</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/AICS150.png" />
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/3498/3498138.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/profile.css">
    <link rel="stylesheet" href="./assets/style.css">
    <script>
        window.addEventListener('load', function () {
            setTimeout(function () {
                document.querySelector('.loader').style.display = 'none';
            }, 1000);
        });
    </script>
</head>

<body class="loaded">
    <div class="loader">
        <div class="loader-container">
            <div class="dot left-dot"></div>
            <div class="rectangles">
                <div class="rectangle"></div>
                <div class="rectangle"></div>
                <div class="rectangle"></div>
            </div>
            <div class="dot right-dot"></div>
        </div>
    </div>

    <div class="container">
        <div class="header">
            <div class="greeting">
                <i><img src="./assets/img/User Male.png" alt=""></i>
                <span><?php include "Functions/PHP/showUsername.php"?></span>
            </div>
            <a href="index.php" class="info-icon" style="text-decoration: none; color: #ffffff; font-size: 1.5em;">
                <i class="fa-solid fa-xmark"></i>
            </a>
        </div>

        <div class="buttons-container">

            <?php include "Functions/PHP/hasFamilyProfile.php" ?>

            <a href="quali.html" class="action-button">
                <i><img src="./assets/img/Open Book.png" alt=""></i>
                <p>Read the<br>Qualification</p>
            </a>

            <a href="messaging.html" class="action-button">
                <i><img src="./assets/img/Messaging.png" alt=""></i>
                <p>Connect<br>to MSWD</p>
            </a>
        </div>
    </div>
</body>

</html>