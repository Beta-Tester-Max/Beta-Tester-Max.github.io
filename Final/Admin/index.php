<?php
session_start();
include "../Functions/PHP/hasAuthority.php"
?>
<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>AICS - Admin Login</title>
<link rel="icon" type="image/x-icon" href="../assets/img/AICS150.png" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="../assets/administration.css" />
<link rel="stylesheet" href="../assets/mod.css" />
<style>
  .row {
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
  }

  .col {
    flex: 1 1 auto;
  }

  @media (min-width: 768px) {
    .row {
      justify-content: center;
    }

    .col {
      flex: 0 1 auto;
    }
  }
</style>
</head>

<body>
  <div class="container">

    <div class="sidebar">
      <div class="logo">
        <i><img src="../assets/img/AICS150.png" alt="AICS LOGO" /></i>
        <span>AICS</span>
      </div>
      <ul class="menu">
        <a style="text-decoration: none; color: #ffffff;" href="administration.html">
          <li class="menu-item active">
            <i class="fas fa-user"></i>
            <span>Admin Login</span>
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

    <div class="main">

      <div class="row">
        <div class="col">

          <div style="background-color: #ffffff; border-radius: 10px; padding: 50px;">

            <form method="POST" action="../Functions/PHP/adminLogin.php">

              <div style="color: #000000; text-align: center; display: flex; flex-direction: column;">

                <h3 style="margin-bottom: 10px;">Login</h3>

                <input style="margin-bottom: 10px;" type="text" placeholder="Insert Key" name="key" required>

                <input style="margin-bottom: 10px;" type="password" placeholder="Insert Token" name="token" required>

                <input type="hidden" name="adminLogin">

                <button style="margin-bottom: 10px;" type="submit">Login</button>

              </div>

            </form>

            <?php
            if (isset($_SESSION['faL'])) {
                echo "<p style='text-align: center; color:rgb(240, 4, 4);'>".$_SESSION['faL']."</p>";
                unset($_SESSION['faL']);
            }
            ?>

          </div>

        </div>
      </div>

    </div>

  </div>

</body>

</html>