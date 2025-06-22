<?php $cd = "Case_Study";
include "./../Functions/PHP/dataFetcher.php";
include "./../Functions/PHP/alert.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AICS SYSTEM - Case Study</title>
    <link rel="icon" type="image/x-icon" href="" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../Assets/Style/formII.css" />
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
    <?php include "./../Assets/Global/nav.php" ?>
    <div class="container">
        <div class="top-nav">
            <div class="right">
                <button type="button" id="toggleMode">Dark Mode</button>
                <img src="../Assets/Image/profile_placeholder.png" />
                <h4>Username</h4>
            </div>
        </div>
        <div class="main">
            <div class="content" id="content">
                <h1><a class="close" href="./../Functions/PHP/exitCS.php"><i class="fa-solid fa-arrow-left"></i></a>
                    II. FAMILY COMPOSITION</h1>
                <form method="post" action="./../Functions/PHP/formII.php">
                    <div class="form">
                        <div class="row">
                            <div class="col">
                                <div class="form__group field">
                                    <input type="input" class="form__field--input" placeholder="Family Members"
                                        id="familyMember">
                                    <label for="familyMember" class="form__label--input">Number of Family
                                        Members</label>
                                </div>
                            </div>
                            <div class="col"></div>
                            <div class="col"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="all-members" id="allMembers" style=""></div>
                    <div class="form">
                        <div class="row">
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col">
                                <div class="btn-container">
                                    <button type="button" class="btn" style="font-size: 20px; margin-right: 10px;"
                                        id="addMember">ADD</button>
                                    <button type="button" class="btn" style="font-size: 20px;"
                                        id="removeMember">REMOVE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form">
                        <div class="row">
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col">
                                <div class="btn-container">
                                    <input type="hidden" id="count" name="count">
                                    <button type="submit" class="btn">NEXT</button>
                                </div>
                            </div>
                            <div class="col"></div>
                            <div class="col"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script type="module" src="../Functions/JS/form.js"></script>
        <script type="module" src="../Functions/JS/formFM.js"></script>
        <script src="https://kit.fontawesome.com/7961b8f896.js" crossorigin="anonymous"></script>
</body>

</html>