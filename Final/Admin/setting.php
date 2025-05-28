<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AICS - Settings</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/AICS150.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/administration.css">
    <link rel="stylesheet" href="../assets/set.css">
    <style>
    .tdn {
      text-decoration: none;
      color: #ffffff;
    }
    </style>
</head>

<body>
    <div class="d-flex flex-column">
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
                <a class="tdn" href="app.html">
                    <li class="menu-item">
                        <i><img src="../assets/img/Application.png" alt="" /></i>
                        <span>Applications</span>
                    </li>
                </a>
                <a class="tdn" href="report.html">
                    <li class="menu-item">
                        <i><img src="../assets/img/Report.png" alt="" /></i>
                        <span>Reports</span>
                    </li>
                </a>
                <a class="tdn" href="setting.php">
                    <li class="menu-item active">
                        <i><img src="../assets/img/Settings.png" alt="" /></i>
                        <span>Settings</span>
                    </li>
                </a>
                <a class="tdn" href="notification.html">
                    <li class="menu-item">
                        <i><img src="../assets/img/Notification.png" alt="" /></i>
                        <span>Notifications</span>
                    </li>
                </a>
                <a style="text-decoration: none; color: #ffffff;" href="../Functions/PHP/logout.php">
                    <li class="ps-4 menu-item fs-4">
                        <i class="fa-solid fa-house"></i>
                        <span>Homepage</span>
                    </li>
                </a>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main pb-0">
            <div class="header" style="margin: 0;">
                <div class="category-dropdown">
                </div>
                <div class="header-right d-flex align-end">
                    <div class="admin-info">
                        <i class="fas fa-user"></i>
                        <span>Admin MSWD</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Content -->
        <div class="set-content pt-0">
            <!-- Access Control -->
            <h2 class="section-title mt-0">Access Control</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="tbl-row">
                            <td>Maria Penduko</td>
                            <td>Admin</td>
                            <td class="status-inactive">Inactive</td>
                            <td><button class="action-btn">Remove as Admin</button></td>
                        </tr>
                        <tr class="tbl-row">
                            <td>Maria Jaurigue</td>
                            <td>Admin</td>
                            <td class="status-active">Active</td>
                            <td><button class="action-btn">Remove as Admin</button></td>
                        </tr>
                        <tr class="tbl-row">
                            <td>Mario Dela Cruz</td>
                            <td>Admin</td>
                            <td class="status-inactive">Inactive</td>
                            <td><button class="action-btn">Remove as Admin</button></td>
                        </tr>
                        <tr class="tbl-row">
                            <td>Ricardo Dalsay</td>
                            <td>Semi-Admin</td>
                            <td class="status-inactive">Inactive</td>
                            <td><button class="action-btn">Set as Admin</button></td>
                        </tr>
                        <tr class="tbl-row">
                            <td>Lola Besyang</td>
                            <td>Semi-Admin</td>
                            <td class="status-active">Active</td>
                            <td><button class="action-btn">Set as Admin</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Manage User Roles -->
            <h2 class="section-title mt-0">Manage User Roles</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="tbl-row">
                            <td>Maria Penduko</td>
                            <td>Admin</td>
                            <td class="status-inactive">Inactive</td>
                            <td><button class="action-btn">Remove as Admin</button></td>
                        </tr>
                        <tr class="tbl-row">
                            <td>Maria Jaurigue</td>
                            <td>Admin</td>
                            <td class="status-active">Active</td>
                            <td><button class="action-btn">Remove as Admin</button></td>
                        </tr>
                        <tr class="tbl-row">
                            <td>Mario Dela Cruz</td>
                            <td>Admin</td>
                            <td class="status-inactive">Inactive</td>
                            <td><button class="action-btn">Remove as Admin</button></td>
                        </tr>
                        <tr class="tbl-row">
                            <td>Ricardo Dalsay</td>
                            <td>Semi-Admin</td>
                            <td class="status-inactive">Inactive</td>
                            <td><button class="action-btn">Set as Admin</button></td>
                        </tr>
                        <tr class="tbl-row">
                            <td>Lola Besyang</td>
                            <td>Semi-Admin</td>
                            <td class="status-active">Active</td>
                            <td><button class="action-btn">Set as Admin</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Activity Log -->
            <h2 class="section-title">Activity Log</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Admin Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="tbl-row">
                            <td>01/10/2023 09:30am</td>
                            <td>Maria Simukuan</td>
                            <td>Review Application</td>
                        </tr>
                        <tr class="tbl-row">
                            <td>01/10/2023 10:30am</td>
                            <td>Maria Penduko</td>
                            <td>Review Application</td>
                        </tr>
                        <tr class="tbl-row">
                            <td>01/10/2023 10:45am</td>
                            <td>Maria Jaurigue</td>
                            <td>Schedule Application</td>
                        </tr>
                        <tr class="tbl-row">
                            <td>01/10/2023 10:50am</td>
                            <td>Mario Dela Cruz</td>
                            <td>Send Notifications</td>
                        </tr>
                        <tr class="tbl-row">
                            <td>01/10/2023 11:00am</td>
                            <td>Ricardo Dalsay</td>
                            <td>Review Application</td>
                        </tr>
                        <tr class="tbl-row">
                            <td>01/10/0223 11:30am</td>
                            <td>Lola Besyang</td>
                            <td>Modify Settings</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Budget Allocation -->
            <h2 class="section-title">Budget Allocation</h2>
            <div class="table-container">
                <table class="budget-table">
                    <thead>
                        <tr>
                            <th>Assistance</th>
                            <th>Allocated Budget (₱)</th>
                            <th>Utilized Budget</th>
                            <th>Remaining Budget</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Medical</td>
                            <td>5,000,000.00</td>
                            <td>3,750,000.00</td>
                            <td>1,250,000.00 <a href="#" class="add-link">+add</a></td>
                        </tr>
                        <tr>
                            <td>Burial</td>
                            <td>2,000,000.00</td>
                            <td>1,500,000.00</td>
                            <td>500,000.00 <a href="#" class="add-link">+add</a></td>
                        </tr>
                        <tr>
                            <td>Transportation</td>
                            <td>1,000,000.00</td>
                            <td>450,000.00</td>
                            <td>550,000.00 <a href="#" class="add-link">+add</a></td>
                        </tr>
                        <tr>
                            <td>Educational</td>
                            <td>4,000,000.00</td>
                            <td>3,100,000.00</td>
                            <td>900,000.00 <a href="#" class="add-link">+add</a></td>
                        </tr>
                        <tr>
                            <td>Food</td>
                            <td>3,000,000.00</td>
                            <td>2,600,000.00</td>
                            <td>400,000.00 <a href="#" class="add-link">+add</a></td>
                        </tr>
                        <tr>
                            <td>Psychosocial</td>
                            <td>1,500,000.00</td>
                            <td>950,000.00</td>
                            <td>550,000.00 <a href="#" class="add-link">+add</a></td>
                        </tr>
                        <tr>
                            <td>Cash Relief</td>
                            <td>3,500,000.00</td>
                            <td>2,200,000.00</td>
                            <td>1,300,000.00 <a href="#" class="add-link">+add</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Applicant Verification -->
            <h2 class="section-title">Applicant Verification</h2>
            <div class="table-container">
                <table class="budget-table">
                    <thead>
                        <tr>
                            <th>Applicants</th>
                            <th>Verified Account</th>
                            <th>Recent Application</th>
                            <th>Approved Application</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Juan Dela Cruz</td>
                            <td><a href="#" class="add-link">View Profile</a></td>
                            <td>Medical</td>
                            <td>Medical</td>
                        </tr>
                        <tr>
                            <td>Pedro Penduko</td>
                            <td><a href="#" class="add-link">View Profile</a></td>
                            <td>Transportation</td>
                            <td>Psychosocial</td>
                        </tr>
                        <tr>
                            <td>Maria Sinukuan</td>
                            <td><a href="#" class="add-link">View Profile</a></td>
                            <td>Burial</td>
                            <td>Medical</td>
                        </tr>
                        <tr>
                            <td>Rigor Dimaguiba</td>
                            <td><a href="#" class="add-link">View Profile</a></td>
                            <td>Cash Relief</td>
                            <td>Burial</td>
                        </tr>
                        <tr>
                            <td>Ricardo Dalisay</td>
                            <td><a href="#" class="add-link">View Profile</a></td>
                            <td>Food</td>
                            <td>Educational</td>
                        </tr>
                        <tr>
                            <td>Miguelito Guerrero</td>
                            <td><a href="#" class="add-link">View Profile</a></td>
                            <td>Educational</td>
                            <td>Transportation</td>
                        </tr>
                        <tr>
                            <td>Crisostomo Ibarra</td>
                            <td><a href="#" class="add-link">View Profile</a></td>
                            <td>Psychosocial</td>
                            <td>Food</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Add click event listeners to action buttons
                const actionButtons = document.querySelectorAll('.action-btn');
                actionButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const action = this.textContent;
                        const row = this.closest('tr');
                        const name = row.cells[0].textContent;
                        alert(`${action} for ${name}`);
                    });
                });

                // Add click event listeners to view profile links
                const viewProfileLinks = document.querySelectorAll('tbody a.add-link');
                viewProfileLinks.forEach(link => {
                    if (link.textContent === 'View Profile') {
                        link.addEventListener('click', function (e) {
                            e.preventDefault();
                            const applicantName = this.closest('tr').cells[0].textContent;
                            alert(`Viewing profile for ${applicantName}`);
                        });
                    } else if (link.textContent === '+add') {
                        link.addEventListener('click', function (e) {
                            e.preventDefault();
                            const assistanceType = this.closest('tr').cells[0].textContent;
                            alert(`Add budget for ${assistanceType}`);
                        });
                    }
                });
            });
        </script>

        <script>
            // Menu item selection
            document.querySelectorAll('.menu-item').forEach(item => {
                item.addEventListener('click', function () {
                    document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
            crossorigin="anonymous"></script>
</body>

</html>