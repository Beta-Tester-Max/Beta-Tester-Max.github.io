<?php
ini_set('session.cookie_httponly', 1);
session_start();
include "Functions/PHP/displayAlert.php";
include "Functions/PHP/userDataFetcher.php";
include "Functions/PHP/forUser.php"
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Applications</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/AICS150.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/application.css" />
</head>

<body class="overflow-x-hidden">

    <div class="header">
        <div class="logo">
            <a href="index.php" class="text-decoration-none"><i><img src="./assets/img/Home Page.png" alt="Home"></i>
                <span class="text-light">AICS</span></a>
        </div>
        <div class="user-info">
            <div class="user-profile">
                <a href="profile.php" class="text-decoration-none"><i><img src="./assets/img/User Male.png"
                            alt="User"></i><span
                        class="text-light"><?php include "Functions/PHP/showUsername.php" ?></span></a>
            </div>
            <!-- <i><img src="./assets/img/Settings.png" alt=""></i> -->
        </div>
    </div>

    <?php include "Functions/PHP/recSubApp.php" ?>

    <div class="container history">
        <h3>Pending Applications</h3>
        <?php include "Functions/PHP/pendingApplications.php" ?>
        <?php include "Functions/PHP/pAModal.php" ?>

    </div>

    <div class="container history">
        <h2 class="text-center mb-3"><b>Application History</b></h2>
        <h3>Approved Applications</h4>
            <?php include "Functions/PHP/approvedApplications.php" ?>

            <hr>

            <h3>Rejected Applications</h4>
                <?php include "Functions/PHP/rejectedApplications.php" ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>