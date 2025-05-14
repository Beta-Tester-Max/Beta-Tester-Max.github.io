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
    <title>Requirements Validate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">

        <div class="row justify-content-md-center my-5">
            <div class="col-md-auto">

                <a href="adminDashboard.php">Go Back</a>

            </div>
        </div>

        <hr>

        <div class="row justify-content-md-center my-5">
            <div class="col-md-auto">

                <table class="table table-striped-columns table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Family Name</th>
                            <th class="text-center" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "../Functions/PHP/unvalidatedAccountsTable.php" ?>
                    </tbody>
                </table>

            </div>
        </div>

        <hr>

        <div class="row justify-content-md-center my-5">
            <div class="col-md-auto">

                <?php include "../Functions/PHP/unvalidatedRequirementsTable.php"?>

            </div>
        </div>

    </div>

    <script>
        let aT = <?php echo json_encode($_SESSION['aTR'] ?? "") ?>;
        let dT = <?php echo json_encode($_SESSION['rT'] ?? "") ?>;
    </script>
    <script src="../Functions/JS/voaScript.js"></script>
    <script src="https://kit.fontawesome.com/7961b8f896.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
</body>

</html>