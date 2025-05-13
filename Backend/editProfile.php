<?php
session_start();
include "Functions/PHP/userDataFetcher.php";
include "Functions/PHP/forUser.php";
include "Functions/PHP/hasFamilyName.php"
    ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>

    <div class="container-fluid">

        <div class="row justify-content-md-center mt-5">
            <div class="col-md-auto">

                <a href="profile.php">Go Back</a>

                <h3 class="text-center mb-3">Edit Profile</h3>

                <form method="POST" action="Functions/PHP/setProfile.php">

                    <div class="row justify-content-md-center">
                        <div class="col-md-auto">

                            <label for="familyName"><b>Family Name: <span class="text-danger">*</span></b></label><br>
                            <input type="text" id="familyName" name="familyName" required>

                            <br><br>

                            <label for="houseNumber"><b>House Number: <span class="text-danger">*</span></b></label><br>
                            <input type="text" id="houseNumber" name="houseNumber" required>

                            <br><br>

                            <label for="streetName"><b>Street Name: <span class="text-danger">*</span></b></label><br>
                            <input type="text" id="streetName" name="streetName" required>

                            <br><br>

                            <label for="barangay"><b>Barangay: <span class="text-danger">*</span></b></label><br>
                            <input type="text" id="barangay" name="barangay" required>

                        </div>

                        <div class="col-md-auto">

                            <label for="cityormuni"><b>City or Municipality: <span class="text-danger">*</span></b></label><br>
                            <input type="text" id="cityormuni" name="cityormuni" required>

                            <br><br>

                            <label for="province"><b>Province: <span class="text-danger">*</span></b></label><br>
                            <input type="text" id="province" name="province" required>

                            <br><br>

                            <label for="region"><b>Region: <span class="text-danger">*</span></b></label><br>
                            <input type="text" id="region" name="region" required>

                            <br><br>

                            <label for="zipCode"><b>Zip Code: <span class="text-danger">*</span></b></label><br>
                            <input type="text" id="zipCode" name="zipCode" required>

                        </div>
                    </div>

                    <hr>

                    <div class="row justify-content-md-center">
                        <div class="col-md-auto">

                            <div class="d-flex flex-column justify-content-center align-items-center">

                                <p><b>Household Family Composition</b></p>

                                <label for="hFMN"><b>Number of Family Members in the Household (max.20):</b></label>
                                <input type="text" id="hFMN">

                                <div id="allMembers"></div>

                                <input type="hidden" id="count" name="count" required>

                                <br>

                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <input type="hidden" name="setProfile" required>
                                    <button type="submit">Set Profile</button>
                                </div>

                            </div>

                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>

    <script src="Functions/JS/eProfileScript.js"></script>
    <script src="https://kit.fontawesome.com/7961b8f896.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
</body>

</html>