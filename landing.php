<?php include "connect.php";
session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AICS Landing Page</title>
    <link rel="icon" type="image/x-icon" href="./img/aics-logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="landing.css">
    <link rel="stylesheet" href="nav.css">
</head>

<body class="overflow-x-hidden" style="min-width: 20em;">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img class="logo" src="./img/aics-logo.ico" alt="AICS">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Assistance
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="application.php">Psychosocial Support</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <?php if (empty($_SESSION['userid'])) {
                                ?>
                                <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop01">
                                        Create Application
                                    </button>
                                </li>
                            <?php } else {
                                $userid = $_SESSION['userid'];
                                $rows = [];
                                $sql = "SELECT Document_Type 
                                        FROM requirements_tbl 
                                        where User_ID = '$userid'";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    $rows[] = $row['Document_Type'];
                                }
                                if (in_array("Barangay Indigency", $rows)) {
                                    if (in_array("Valid ID", $rows)) {
                                        if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
                                            if (in_array("Referral Letter", $rows)) {
                                                ?>
                                                <li><a class="dropdown-item" href="application.php">Create Application</a></li><?php
                                            } else {
                                                $modaltext = "Referral Letter";
                                                ?>
                                                <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop02">
                                                        Create Application
                                                    </button>
                                                </li><?php
                                            }
                                        } else {
                                            $modaltext = "Birth Certificate or Marriage Certificate";
                                            ?>
                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop02">
                                                    Create Application
                                                </button>
                                            </li><?php
                                        }
                                    } else {
                                        $modaltext = "Valid ID";
                                        ?>
                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop02">
                                                Create Application
                                            </button>
                                        </li><?php
                                    }
                                } else {
                                    $modaltext = "Barangay Indigency";
                                    ?>
                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop02">
                                            Create Application
                                        </button>
                                    </li><?php
                                }
                            } ?>
                        </ul>
                    </li>
                </ul>
                <div class="search-container">
                <form class="d-flex m-auto" role="search">
                    <input class="form-control me-2 searchbar" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light searchbtn" type="submit">Search</button>
                </form>
                </div>
                <?php if (empty($_SESSION['userid'])) { ?>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <p class="nav-link btn-secondary pe-none">or</p>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Sign up</a>
                        </li>
                    </ul>
                <?php } else { ?>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-5">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <?php $userid = $_SESSION['userid'];
                                $sql = "SELECT Username FROM register_tbl where User_ID = '$userid'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                echo $row['Username'] ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="messaging.php">Messages</a></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </nav>
    
    <div class="aics">AICS</div>
    <div
      class="brief-desc"
    >
      The Municipality of Alaminos, Laguna, through its Municipal Social Welfare
      and Development Office (MSWDO)
      <br />
      , is committed to providing immediate and compassionate support to
      individuals and families facing urgent crises. Guided by Section 16 of the
      Local Government Code of 1991 (RA 7160), the AICS Program ensures that
      marginalized, vulnerable, and low-income residents receive timely assistance
      to alleviate distress, meet basic needs, and pave the way toward long-term
      stability.
    </div>
    <br/>
    <div class="spaceX"></div>
    <br/>
    <br/>
    <div class="banner">
    <div class="slider" style="--quantity: 7">
        <div class="item" style="--position: 1" onclick="showDescription(1)">
            <img src="./img/transportation.png" alt="">
        </div>
        <div class="item" style="--position: 2" onclick="showDescription(2)">
            <img src="./img/food.png" alt="">
        </div>
        <div class="item" style="--position: 3" onclick="showDescription(3)">
            <img src="./img/medical.png" alt="">
        </div>
        <div class="item" style="--position: 4" onclick="showDescription(4)">
            <img src="./img/cash.png" alt="">
        </div>
        <div class="item" style="--position: 5" onclick="showDescription(5)">
            <img src="./img/burial.png" alt="">
        </div>
        <div class="item" style="--position: 6" onclick="showDescription(6)">
            <img src="./img/educational.png" alt="">
        </div>
        <div class="item" style="--position: 7" onclick="showDescription(7)">
            <img src="./img/psychosocial.png" alt="">
        </div>
    </div>
    <div class="description-box">
        <p id="description-text">Click on an image to see the description.</p>
    </div>
</div>
<script>
    function showDescription(position) {
        const descriptions = {
            1: "Transportation Assistance offers financial aid to individuals who need travel funds for medical treatments, job relocation, or emergency situations. This program ensures that applicants can reach their destinations, such as hospitals or places of employment, without financial hardship.",
            2: "Food Assistance provides essential food supplies or financial aid to individuals and families facing hunger due to crisis situations such as calamities, job loss, or financial instability. This program aims to ensure food security and prevent malnutrition, especially among vulnerable groups.",
            3: "Medical Assistance provides financial aid to individuals who need support for hospitalization, medical procedures, laboratory tests, or the purchase of essential medicines. This program helps applicants cover medical expenses, ensuring they receive the necessary healthcare services, particularly for emergency and life-threatening conditions.",
            4: "Cash Relief Assistance offers immediate financial aid to individuals and families affected by unexpected crises such as natural disasters, accidents, or economic hardships. The provided cash support helps them address urgent needs, including rent, food, and other daily expenses.",
            5: "Burial Assistance helps families cope with funeral and burial expenses after the loss of a loved one. This program provides financial support for coffin purchase, funeral services, and burial costs, reducing the financial burden on grieving families during difficult times.",
            6: "Educational Assistance is designed to support students from financially struggling families by providing financial aid for tuition fees, school supplies, and other academic-related expenses. This assistance aims to ensure that students, particularly those in crisis situations, can continue their education without financial barriers.",
            7: "Psychosocial Support is designed to assist individuals dealing with emotional, mental, or social distress caused by traumatic experiences, such as disasters, abuse, or loss. This program offers counseling, therapy, and guidance services to help applicants recover and rebuild their emotional well-being."
        };

        const descriptionBox = document.querySelector(".description-box");
        const descriptionText = document.getElementById("description-text");

        descriptionText.textContent = descriptions[position];
        descriptionBox.classList.add("active");
    }
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>