<?php
ini_set('session.cookie_httponly', 1);
session_start();
include "../Functions/PHP/displayAlert.php";
include "../Functions/PHP/hasAuthority.php"
  ?>
<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>AICS - Set Admin Name</title>
<link rel="icon" type="image/x-icon" href="../assets/img/AICS150.png" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="../assets/administration.css" />
<link rel="stylesheet" href="../assets/mod.css" />
<style>
  .login {
    background-color: transparent;
    border: 1px solid #ffffff;
    border-radius: 10px;
    padding: 50px;
    transition: 1s ease;
  }

  .login:hover {
    box-shadow: 0 0 5px 5px rgba(255, 255, 255, 0.5);
    transition: 1s ease;
  }

  input {
    background-color: transparent;
    border: 1px solid #ffffff;
    border-radius: 10px;
    padding: 10px;
    font-size: 20px;
    transition: .3s ease;
    color: #ffffff;
  }

  h1 {
    font-size: 50px;
    margin-bottom: 30px;
    transition: .5s ease;
    cursor: default;
  }

  h1:hover {
    text-shadow: 0 5px rgba(255, 255, 255, 0.33);
    transform: translateY(-4px);
    transition: .5s ease;
  }

  input:hover {
    box-shadow: 0 5px rgba(255, 255, 255, 0.33);
    transform: translateY(-4px);
    transition: .3s ease;
  }

  input:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.8);
    transform: translateY(0px);
    transition: .3s ease;
  }

  button {
    background-color: transparent;
    border: 1px solid #ffffff;
    border-radius: 10px;
    padding: 10px;
    font-size: 20px;
    color: #ffffff;
    transition: .3s ease;
    cursor: pointer;
  }

  button:hover {
    box-shadow: 0 5px rgba(255, 255, 255, 0.33);
    transform: translateY(-4px);
    transition: .3s ease;
  }

  button:active {
    box-shadow: 0 2px rgba(255, 255, 255, 0.33);
    transform: translateY(0px);
    transition: .3s ease;
  }

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
          <li class="ps-4 menu-item fs-4">
            <i class="fa-solid fa-house"></i>
            <span>Homepage</span>
          </li>
        </a>
      </ul>
    </div>

    <div class="main">

      <div class="row">
        <div class="col">

          <div class="login">

            <form method="POST" action="../Functions/PHP/adminLogin.php">

              <div style="text-align: center; display: flex; flex-direction: column;">

                <h1>LOGIN</h1>

                <input style="margin-bottom: 20px;" type="text" minlength="10" maxlength="10" placeholder="Insert Key" name="key" required>

                <input style="margin-bottom: 30px;" type="password" minlength="20" maxlength="20" placeholder="Insert Token" name="token" required>

                <input type="hidden" name="adminLogin">

                <button style="margin-bottom: 10px;" type="submit">Login</button>

              </div>

            </form>

            <?php
            if (isset($_SESSION['faL'])) {
              echo "<p style='text-align: center; color:rgb(240, 4, 4);'>" . $_SESSION['faL'] . "</p>";
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