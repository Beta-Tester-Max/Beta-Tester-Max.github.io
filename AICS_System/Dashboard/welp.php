<?php $cd = basename(__DIR__);?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AICS SYSTEM - Dashboard</title>
  <link rel="icon" type="image/x-icon" href="" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="../Assets/Style/dashboard.css" />
  <script>
        (function() {
            const THEME_KEY = "userTheme";
            const html = document.documentElement;

            const savedTheme = localStorage.getItem(THEME_KEY) || "light";

            if (savedTheme === "dark") {
                html.classList.add("darkness");
            } else {
                html.classList.remove("darkness");
            }
        })();
    </script>
</head>

<body>
  <?php include "./../Assets/Global/nav.php"?>
  <div class="container">
    <div class="top-nav">
      <div class="right">
        <button type="button" id="toggleMode"><i class="fa-solid fa-sun-bright"></i></button>
        <img src="../Assets/Image/profile_placeholder.png" />
        <h4>Username</h4>
      </div>
    </div>
    <div class="main">
      <div class="chart-container" id="statistics">
        <canvas class="chart" id="chart"></canvas>
      </div>
    </div>

    <script type="module" src="../Functions/JS/dashboard.js"></script>
    <script src="https://kit.fontawesome.com/7961b8f896.js" crossorigin="anonymous"></script>
</body>

</html>