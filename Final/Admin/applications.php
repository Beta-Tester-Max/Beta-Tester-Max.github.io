<?php
session_start();
include "../Functions/PHP/adminDataFetcher.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AICS - Application Tracking System</title>
  <link rel="icon" type="image/x-icon" href="../assets/img/AICS150.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/administration.css" />
  <link rel="stylesheet" href="../assets/mod.css" />
  <style>
    .tdn {
      text-decoration: none;
      color: #ffffff;
    }

    .application-action:hover {
      background-color:rgb(153, 150, 3);
    }

    .close:hover {
      color: rgb(229, 13, 13);
    }
  </style>
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
        <a class="tdn" href="app.html">
          <li class="menu-item active">
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
        <a class="tdn" href="setting.html">
          <li class="menu-item">
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
          <li class="menu-item">
            <i class="fa-solid fa-house"></i>
            <span>Homepage</span>
          </li>
        </a>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="main">
      <div class="header">
        <div class="category-dropdown">
          <select id="category-select">
            <option value="all">All Categories</option>
            <option value="transportation">Transportation</option>
            <option value="food">Food</option>
            <option value="medical">Medical</option>
            <option value="burial">Burial</option>
            <option value="cash-relief">Cash Relief</option>
            <option value="educational">Educational</option>
            <option value="psychosocial">Psychosocial Support</option>
          </select>
        </div>
        <div class="header-right">
          <div class="admin-info">
            <i class="fas fa-user"></i>
            <span>Admin MSWD</span>
          </div>
        </div>
      </div>

      <!-- Statistics Cards -->
      <div class="stats-container">
        <div class="stat-card total">
          <div class="stat-value">200</div>
          <div class="stat-label">Total Applications</div>
        </div>
        <div class="stat-card approved">
          <div class="stat-value">90</div>
          <div class="stat-label">Approved</div>
        </div>
        <div class="stat-card pending">
          <div class="stat-value">100</div>
          <div class="stat-label">Pending</div>
        </div>
        <div class="stat-card rejected">
          <div class="stat-value">10</div>
          <div class="stat-label">Rejected</div>
        </div>
      </div>

      <!-- Applications Sections -->
      <div class="applications-container">
        <!-- Pending Applications -->
        <div class="applications-column">
          <h3 class="section-title">Pending Applications</h3>
          <ul class="application-list">
            <?php include "../Functions/PHP/pendingAppAccounts.php" ?>
          </ul>
        </div>

        <!-- Application History -->
        <div class="applications-column">
          <h3 class="section-title">Application History</h3>
          <ul class="application-list">
            <li class="application-item">
              <div class="application-name">
                Miguel Santos<br />San Agustin<br>
                <p style="color:rgb(228, 23, 23);">Rejected</p>
              </div>
              <button class="application-action">View</button>
            </li>
            <li class="application-item">
              <div class="application-name">
                Ryan Gosling<br />San Roque<br>
                <p style="color:rgb(17, 197, 56);">Approved</p>
              </div>
              <button class="application-action">View</button>
            </li>
          </ul>
        </div>

        <!-- Interview Schedule -->
        <div class="applications-column">
          <h3 class="section-title">Subject for Interview</h3>
          <ul class="application-list">
            <li class="application-item">
              <div class="application-name">
                Miguel Santos<br />San Agustin
              </div>
              <button class="application-action">Schedule</button>
            </li>
            <li class="application-item">
              <div class="application-name">Rafael Dizon<br />San Andres</div>
              <button class="application-action">Schedule</button>
            </li>
            <li class="application-item">
              <div class="application-name">
                Tomás Rivera<br />San Gregorio
              </div>
              <button class="application-action">Schedule</button>
            </li>
            <li class="application-item">
              <div class="application-name">Lorna Garcia<br />San Benito</div>
              <button class="application-action">Schedule</button>
            </li>
            <li class="application-item">
              <div class="application-name">Elena Cruz<br />San Isidro</div>
              <button class="application-action">Schedule</button>
            </li>
            <li class="application-item">
              <div class="application-name">Alberto Ramos<br />San Juan</div>
              <button class="application-action">Schedule</button>
            </li>
            <li class="application-item">
              <div class="application-name">Teresa Nuevo<br />San Miguel</div>
              <button class="application-action">Schedule</button>
            </li>
            <li class="application-item">
              <div class="application-name">Daniel Flores<br />San Roque</div>
              <button class="application-action">Schedule</button>
            </li>
            <li class="application-item">
              <div class="application-name">Luz Hernandez<br />San Simon</div>
              <button class="application-action">Schedule</button>
            </li>
            <li class="application-item">
              <div class="application-name">Ernesto Salazar<br />Palma I</div>
              <button class="application-action">Schedule</button>
            </li>
            <li class="application-item">
              <div class="application-name">
                Miguel Santos<br />San Agustin
              </div>
              <button class="application-action">Schedule</button>
            </li>
            <li class="application-item">
              <div class="application-name">Rafael Dizon<br />San Andres</div>
              <button class="application-action">Schedule</button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal" id="applicationModal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <div class="modal-header" style="margin-top: 20px;">
        <div class="applicant-info">
          <div class="applicant-avatar">
            <i class="fas fa-user"></i>
          </div>
          <div class="applicant-details">
            <h3>Missing Name</h3>
            <p>Missing Address</p>
          </div>
        </div>
        <div class="application-category" style="text-align: center;">Missing Assistance</div>
      </div>
      <div class="modal-body">
        <p>Reason: I am deeply in debt because my sibling got sick. I have no relatives who can help, all my
          possessions are gone, my parents have passed away, and I am also currently undergoing intense medical
          treatment.</p>
        <hr style="margin-bottom: 10px;">
        <form action="">
          <div style="display: flex;">
            <div class="application-name" style="width: 100%;">
              Ryan Gosling
            </div>
            <button class="application-action" style="width: 10em;">Open File</button>
          </div>
        </form>
      </div>
        <hr style="margin-bottom: 10px;">
      <div class="modal-actions">
        <form style="width: 100%;" action="">
          <input type="hidden" class="app-input-approve">
          <button class="reject-btn" style="width: 100%;">REJECT</button>
        </form>
        <form style="width: 100%;" action="">
          <input type="hidden" class="app-input-reject">
          <button class="approve-btn" style="width: 100%;">APPROVE</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.querySelectorAll(".menu-item").forEach((item) => {
      item.addEventListener("click", function () {
        document
          .querySelectorAll(".menu-item")
          .forEach((i) => i.classList.remove("active"));
        this.classList.add("active");
      });
    });

    document.querySelectorAll(".application-action").forEach((button) => {
      button.addEventListener("click", function () {
        const action = this.textContent;
        const name = this.parentElement
          .querySelector(".application-name")
          .textContent.split("\n")[0];
        console.log(`${action} action for ${name}`);
      });
    });

    // Modal functionality
    const modal = document.getElementById('applicationModal');
    const closeBtn = document.querySelector('.close');
    const viewButtons = document.querySelectorAll('.view-btn');

    // Open modal for view actions
    document.querySelectorAll('.application-action').forEach(button => {
      button.addEventListener('click', function () {
        const name = this.parentElement.querySelector('.app-name').textContent;
        const address = this.parentElement.querySelector('.app-address').textContent;
        const assistance = this.parentElement.querySelector('.app-assistance').textContent;
        const reason = this.parentElement.querySelector('.app-reason').textContent;
        const application = this.parentElement.querySelector('.app-application').textContent;

        // Update modal content based on the selected application
        document.querySelector('.applicant-details h3').textContent = name;
        document.querySelector('.applicant-details p').textContent = address;
        document.querySelector('.application-category').textContent = assistance;
        document.querySelector('.modal-body p').textContent = reason;
        document.querySelector('.modal-actions .app-input-approve').value = application;
        document.querySelector('.modal-actions .app-input-reject').value = application;

        // Show modal
        modal.style.display = 'block';
      });
    });

    // Close modal
    closeBtn.addEventListener('click', function () {
      modal.style.display = 'none';
    });

    // Close modal when clicking outside
    window.addEventListener('click', function (event) {
      if (event.target == modal) {
        modal.style.display = 'none';
      }
    });

    // Action buttons in modal
    document.querySelector('.reject-btn').addEventListener('click', function () {
      console.log('Application rejected');
      modal.style.display = 'none';
    });

    document.querySelector('.approve-btn').addEventListener('click', function () {
      console.log('Application approved');
      modal.style.display = 'none';
    });

    document.querySelector('.view-btn').addEventListener('click', function () {
      console.log('View application details');
      modal.style.display = 'none';
    });
  </script>
</body>

</html>