<?php
ini_set('session.cookie_httponly', 1);
session_start();
include "../Functions/PHP/displayAlert.php";
include "../Functions/PHP/adminDataFetcher.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AICS - Report</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/AICS150.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/administration.css">
    <link rel="stylesheet" href="../assets/rep.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <i><img src="../assets/img/AICS150.png" alt="AICS LOGO" /></i>
                <span>AICS</span>
            </div>
            <ul class="menu">
                <a class="tdn" href="dashboard.php">
                    <li class="menu-item">
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
                <a class="tdn" href="">
                    <li class="menu-item active">
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
                        <span>Admin MSWD</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Main Content -->
    <form method="POST" action="../Functions/PHP/generateReport.php">
        <div class="rep-content">
            <div class="report-card">
                <div class="report-header">
                    <div class="report-icon">📋</div>
                    <div class="report-title">Report Generation</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Type of Assistance:</label>
                    <select class="form-select" name="assistance" required>
                        <option value="" selected>Select Assistance</option>
                        <?php include "../Functions/PHP/allAssistanceSelect.php" ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Date Range</label>
                    <div class="date-range">
                        <input type="date" class="start_date" name="startDate" required>
                        <span>⏵</span>
                        <input type="date" class="end_date" name="endDate" required>
                    </div>
                </div>

                <!-- <div class="form-checkbox">
                <input type="checkbox" id="detailed-info">
                <label for="detailed-info">Include detailed information</label>
            </div> -->

                <input type="hidden" name="generateReport">
                <button type="submit" class="generate-btn">Generate Report</button>
            </div>
        </div>
    </form>

</body>

</html>