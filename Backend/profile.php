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
    <title>Profile</title>
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

                <?php include "Functions/PHP/hasFamily.php" ?>

            </div>
        </div>

    </div>

    <script>
        let aB = <?php echo json_encode($_SESSION['assistanceButtons'] ?? "") ?>;
        let aTT = <?php echo json_encode($_SESSION['assistanceTitles'] ?? "") ?>;
        let aT = <?php echo json_encode($_SESSION['assistanceTables'] ?? "") ?>;
    </script>
    <script src="Functions/JS/profileScript.js"></script>
    <script src="https://kit.fontawesome.com/7961b8f896.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
</body>

</html>