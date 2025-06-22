<?php $cd = "Case_Study";
include "./../Functions/PHP/dataFetcher.php";
include "./../Functions/PHP/alert.php";
include "./../Functions/PHP/formIReq.php";
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
    <link rel="stylesheet" href="../Assets/Style/formI.css" />
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
                    I. Benefeciary</h1>
                <form method="post" action="./../Functions/PHP/formI.php" id="form">
                    <div class="form">
                        <div class="row">
                            <div class="col vhr">
                                <div class="form__group field">
                                    <input type="input" class="form__field--input" minlength="2" maxlength="50"
                                        placeholder="First Name" name="fname" id="firstName" required>
                                    <label for="firstName" class="form__label--input">First Name <span
                                            class="required">*</span></label>
                                </div>
                                <div class="form__group field">
                                    <input type="input" class="form__field--input" maxlength="50"
                                        placeholder="Middle Name" name="mname" id="middleName" />
                                    <label for="middleName" class="form__label--input">Middle Name</label>
                                </div>
                                <div class="form__group field">
                                    <input type="input" class="form__field--input" minlength="2" maxlength="50"
                                        placeholder="Last Name" name="lname" id="lastName" required>
                                    <label for="lastName" class="form__label--input">Last Name <span
                                            class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col vhr">
                                <div class="form__group">
                                    <input type="text" class="form__field--date" id="dob" name="bday"
                                        placeholder="MM/DD/YYYY" required>
                                    <label for="dob" class="form__label--date">Date of Birth <span
                                            class="required">*</span></label>
                                </div>
                                <div class="form__group">
                                    <input type="text" id="sxInput" class="form__field--select" placeholder=" "
                                        readonly />
                                    <select id="sxSelect" class="form__real-select" name="sx">
                                        <?php include "./../Functions/PHP/sxSelect.php" ?>
                                    </select>
                                    <label for="sxInput" class="form__label--select">Sex <span
                                            class="required">*</span></label>
                                </div>
                                <div class="form__group">
                                    <input type="text" id="csInput" class="form__field--select" placeholder=" "
                                        readonly />
                                    <select id="csSelect" class="form__real-select" name="civStat">
                                        <?php include "./../Functions/PHP/cSSelect.php" ?>
                                    </select>
                                    <label for="csInput" class="form__label--select">Civil Status <span
                                            class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col vhr">
                                <div class="form__group">
                                    <input type="text" id="eaInput" class="form__field--select" placeholder=" "
                                        readonly />
                                    <select id="eaSelect" class="form__real-select" name="educAtt">
                                        <?php include "./../Functions/PHP/eASelect.php" ?>
                                    </select>
                                    <label for="eaInput" class="form__label--select">Educational Attainnment</label>
                                </div>
                                <div class="form__group field">
                                    <input type="input" class="form__field--input" minlength="2" maxlength="50"
                                        placeholder="Occupation" name="occupation" id="occupation" />
                                    <label for="occupation" class="form__label--input">Occupation</label>
                                </div>
                                <div class="form__group">
                                    <input type="text" id="bInput" class="form__field--select" placeholder=" "
                                        readonly />
                                    <select id="bSelect" class="form__real-select" name="barangay">
                                        <?php include "./../Functions/PHP/bSelect.php" ?>
                                    </select>
                                    <label for="bInput" class="form__label--select">Barangay <span
                                            class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form__group field">
                                    <input type="input" class="form__field--input" pattern="0[89]\d{2}-\d{3}-\d{4}"
                                        title="Format: 0999-999-9999" minlength="13" maxlength="13" placeholder=""
                                        name="contactno" id="contactno" required>
                                    <label for="contactno" class="form__label--input">Contact No. <span
                                            class="required">*</span></label>
                                </div>
                                <div class="center" style="margin-top: 3.5em;">
                                    <input type="hidden" name="formI">
                                    <button type="sibmit" class="btn">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script type="module" src="../Functions/JS/form.js"></script>
        <script src="https://kit.fontawesome.com/7961b8f896.js" crossorigin="anonymous"></script>
</body>

</html>