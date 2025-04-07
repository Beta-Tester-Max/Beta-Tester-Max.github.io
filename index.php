<?php include "connect.php";
session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AICS System demo</title>
    <link rel="icon" type="image/x-icon" href="Logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .logo {
            height: 3em;
            width: 3.5em;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            100% {
                transform: rotateZ(360deg);
            }
        }
    </style>
</head>

<body class="overflow-x-hidden" style="min-width: 20em;">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img class="logo" src="logo.ico" alt="AICS">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
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
                <form class="d-flex m-auto" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
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

    <div class="container-fluid">
        <div class="modal fade" id="staticBackdrop01" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">You are not <b>Signed In</b>.</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>You must be <b>Signed In</b> to be able to create an application.</p>
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-items-center">
                        <a type="button" class="btn btn-primary" href="login.php">Go to login</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="staticBackdrop02" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">You are missing some <b>Requirements</b>.
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>You Are Missing <b><?php echo $modaltext ?></b>.</p>
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-items-center">
                        <a type="button" class="btn btn-primary" href="profile.php#requirements">Upload Missing
                            Requirements</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center" style="height: 30em;">
                <?php if (isset($_SESSION['userid'])) {
                    ?>
                    <h1>Hello! <?php $userid = $_SESSION['userid'];
                    $sql = "SELECT Fname, Mname, Lname FROM userinfo_tbl where User_ID = '$userid'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    if (empty($row['Mname'])) {
                        echo $row['Fname'] . "&nbsp;" . $row['Lname'];
                    } else {
                        echo $row['Fname'] . "&nbsp;" . $row['Mname'] . "&nbsp;" . $row['Lname'];
                    }
                    ?>.</h1>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>