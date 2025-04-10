<?php include 'connect.php';
session_start();
if (empty($_SESSION)) { ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="icon" type="image/x-icon" href="./img/aics-logo.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="nav.css">
        <link rel="stylesheet" href="login.css">
    </head>

    <body class="overflow-x-hidden" style="min-width: 50em;">
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
                                $_SESSION['authority'] = $row['Access_Level'] ?>
                                <script>
                                    window.location.href = 'administration.php'
                                </script> <?php
                                        } else { ?>
                                <script>
                                    window.location.href = 'index.php'
                                </script> <?php
                                            $_SESSION['userid'] = $userid;
                                        }
                                    } else { ?>
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
<?php } else { ?> <script>
        window.location.href = 'index.php'
    </script><?php }
