<?php $cd = basename(__DIR__);
include "./../Functions/PHP/dataFetcher.php";
include "./../Functions/PHP/alert.php";
include "./../Functions/PHP/ongoingCS.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AICS SYSTEM - Case Study</title>
  <link rel="icon" type="image/x-icon" href="" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="../Assets/Style/caseStudy.css" />
  <script>
    (function () {
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
        <button type="button" id="toggleMode">Dark Mode</button>
        <img src="../Assets/Image/profile_placeholder.png" />
        <h4>Username</h4>
      </div>
    </div>
    <div class="main">

      <div class="content">
        <div style="padding: 0 10px;">
          <form method="POST" action="./../Functions/PHP/createCS.php">
            <div class="form__group field">
              <input type="input" class="form__field--input" minlength="2" maxlength="50" placeholder="Case Study Name"
                name="csName" id="csName" required>
              <label for="csName" class="form__label--input">Case Study Name</label>
            </div>
            <input type="hidden" name="createCS">
            <button type="submit">Create Case Study</button>
          </form>
        </div>
        <hr>
        <div style="overflow-y: auto; overflow-x: hidden";>
          <?php include "./../Functions/PHP/allCaseStudy.php" ?>
        </div>
      </div>
    </div>

    <script type="module" src="../Functions/JS/caseStudy.js"></script>
    <script src="https://kit.fontawesome.com/7961b8f896.js" crossorigin="anonymous"></script>
</body>

</html>