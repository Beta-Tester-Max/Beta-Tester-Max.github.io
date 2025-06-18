<?php
session_start();
include "Functions/PHP/userDataFetcher.php";
include "Functions/PHP/forUser.php"
    ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Setup Requirements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">

        <div class="row justify-content-md-center mt-5">
            <div class="col-md-auto">

                <a href="index.php">Go Back</a><br>

            </div>
        </div>

        <div class="row justify-content-md-center my-5">
            <div class="col-md-auto">

                <h4 class="text-center">Setup Requirements</h4><br><br>

                <form method="POST" action="">

                    <div class="row justify-content-md-center">
                        <div class="col-md-auto">

                            <div class="d-flex flex-column mb-3">
                                <label class="mb-1" for="asAp"><b>Select Assistance: <span
                                            class="text-danger">*</span></b></label>
                                <select id="asAp" name="assistance" required>
                                    <?php include "Functions/PHP/assistanceSelect.php" ?>
                                </select>
                            </div>

                            <div class="d-flex flex-column mb-3">
                                <label class="mb-1" for="beAp"><b>Select Beneficiary: <span
                                            class="text-danger">*</span></b></label>
                                <select id="beAp" name="helpee" required>
                                    <?php include "Functions/PHP/assistanceSelect.php" ?>
                                </select>
                            </div>

                            <div class="d-flex flex-column mb-3">
                                <label class="mb-1" for="reAp"><b>Select Representative: </b><span
                                        class="text-secondary"><i>Optional</i></span></label>
                                <select id="reAp" name="rep">
                                    <?php include "Functions/PHP/assistanceSelect.php" ?>
                                </select>
                            </div>

                            <div class="d-flex flex-column mb-3">
                                <label class="mb-1" for="reason"><b>Reason: <span
                                            class="text-danger">*</span></b></label>
                                <textarea id="reason" name="reason" rows="4" cols="50" required></textarea>
                            </div>

                            <button type="submit">Next --> Requirements</button>

                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>

    <script src="https://kit.fontawesome.com/7961b8f896.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
</body>

</html>