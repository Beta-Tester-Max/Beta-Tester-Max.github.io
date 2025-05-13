<?php
session_start();
include "../Functions/PHP/adminDataFetcher.php";
include "../Functions/PHP/forAdmin.php"
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Assistance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">

        <div class="row justify-content-md-center my-5">
            <div class="col-md-auto">

                <form method="POST" action="../Functions/PHP/addAssistance.php">

                    <label for="assistance">Assistance</label>
                    <input type="text" name="assistance" id="assistance" required>

                    <input type="hidden" name="addAssistance" required>
                    <button type="submit">Add</button><br>

                </form>
                
                <a href="adminDashboard.php">Go Back</a>

            </div>
        </div>

    </div>

    <script src="https://kit.fontawesome.com/7961b8f896.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
</body>

</html>