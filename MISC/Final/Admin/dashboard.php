<?php
ini_set('session.cookie_httponly', 1);
session_start();
include "../Functions/PHP/displayAlert.php";
include "../Functions/PHP/adminDataFetcher.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AICS - Application Tracking System</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/AICS150.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/administration.css" />
    <style>
        .tdn {
            text-decoration: none;
            color: #ffffff;
        }

        .application-action:hover {
            opacity: .5;
        }

        .btn-close {
            transition: .5s ease;
        }

        .btn-close:hover {
            transition: .5s ease;
            scale: 1.2;
        }

        p {
            margin: 0;
        }

        .bg-admin {
            background-color: #0a1929;
        }

        .application-list {
            padding: 0;
        }

        .d1:hover {
            opacity: .5;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            border-radius: 8px;
            background-color: transparent;
            box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
        }

        ::-webkit-scrollbar-thumb {
            border-radius: 8px;
            background-color: rgba(106, 105, 105, .2);
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: rgb(106, 105, 105);
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <i><img src="../assets/img/AICS150.png" alt="AICS LOGO" /></i>
                <span>AICS</span>
            </div>
            <ul class="menu">
                <a class="tdn" href="">
                    <li class="menu-item active">
                        <i><img src="../assets/img/Dashboard.png" alt="" /></i>
                        <span>Dashboard</span>
                    </li>
                </a>
                <a class="tdn" href="applications.php">
                    <li class="menu-item">
                        <i><img src="../assets/img/Application.png" alt="" /></i>
                        <span>Applications</span>
                    </li>
                </a>
                <a class="tdn" href="report.php">
                    <li class="menu-item">
                        <i><img src="../assets/img/Report.png" alt="" /></i>
                        <span>Reports</span>
                    </li>
                </a>
                <a class="tdn" href="setting.php">
                    <li class="menu-item">
                        <i><img src="../assets/img/Settings.png" alt="" /></i>
                        <span>Settings</span>
                    </li>
                </a>
                <a class="tdn" href="notification.php">
                    <li class="menu-item">
                        <i><img src="../assets/img/Notification.png" alt="" /></i>
                        <span>Notifications</span>
                    </li>
                </a>
                <a style="text-decoration: none; color: #ffffff;" href="../Functions/PHP/logout.php">
                    <li class="ps-4 menu-item fs-4">
                        <i class="fa-solid fa-house"></i>
                        <span>Logout</span>
                    </li>
                </a>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main">
            <div class="header">
                <div class="category-dropdown">
                </div>
                <div class="header-right">
                    <div class="admin-info">
                        <i class="fas fa-user"></i>
                        <?php include "../Functions/php/adminNandA.php" ?>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="stats-container">
                <div class="stat-card total">
                    <div class="stat-value"><?php echo $_SESSION['tApp'] ?? 0 ?></div>
                    <div class="stat-label">Total Applications</div>
                </div>
                <div class="stat-card approved">
                    <div class="stat-value"><?php echo $_SESSION['tAApp'] ?? 0 ?></div>
                    <div class="stat-label">Approved</div>
                </div>
                <div class="stat-card pending">
                    <div class="stat-value"><?php echo $_SESSION['tPApp'] ?? 0 ?></div>
                    <div class="stat-label">Pending</div>
                </div>
                <div class="stat-card rejected">
                    <div class="stat-value"><?php echo $_SESSION['tRApp'] ?? 0 ?></div>
                    <div class="stat-label">Rejected</div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>

</html>