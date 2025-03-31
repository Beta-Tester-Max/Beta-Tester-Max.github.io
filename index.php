<?php include "connect.php";
session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AICS System demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="overflow-x-hidden" style="min-width: 50em;">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">AICS/LOGO</a>
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
                            <li><a class="dropdown-item" href="#">Medical Assistance</a></li>
                            <li><a class="dropdown-item" href="#">Transportation Assistance</a></li>
                            <li><a class="dropdown-item" href="#">Educational Assistance</a></li>
                            <li><a class="dropdown-item" href="#">Food Assistance</a></li>
                            <li><a class="dropdown-item" href="#">other options</a></li>
                            <li><a class="dropdown-item" href="#">other options</a></li>
                            <li><a class="dropdown-item" href="#">other options</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Create Application</a></li>
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
        <div class="position-absolute top-50 start-50 translate-middle">
            <?php if (isset($_SESSION['userid'])) {
                ?>
                <h1>Hello! <?php $userid = $_SESSION['userid'];
                $sql = "SELECT Fname, Mname, Lname FROM register_tbl where User_ID = '$userid'";
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>