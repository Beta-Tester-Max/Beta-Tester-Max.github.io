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
    <title>Applications Approval</title>
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

        <div class="row justify-content-md-center my-5">
            <div class="col-md-auto">

                <h1><b>Application History</b></h1>

            </div>
        </div>

        <div class="row justify-content-md-center my-5">
            <div class="col-md-auto">

                <p class="fs-5">Approved Applications</p>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Assistance Type</th>
                            <th>Submitted By</th>
                            <th>Data Submitted</th>
                            <th>Reviewed By</th>
                            <th>Data Reviewed</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Food Assistance</td>
                            <td>Gerald Anderson</td>
                            <td>5/12/2025</td>
                            <td>Mariane Flores</td>
                            <td>5/14/2025</td>
                            <td><button>View Details</button></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="row justify-content-md-center my-5">
            <div class="col-md-auto">

                <p class="fs-5">Rejected Applications</p>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Assistance Type</th>
                            <th>Submitted By</th>
                            <th>Data Submitted</th>
                            <th>Reviewed By</th>
                            <th>Data Reviewed</th>
                            <th>Reason</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Transportation Assistance</td>
                            <td>George michelle</td>
                            <td>5/08/2025</td>
                            <td>Kyla Reyes</td>
                            <td>5/11/2025</td>
                            <td>Not Good Enough</td>
                            <td><button>View Details</button></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    <script src="https://kit.fontawesome.com/7961b8f896.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
</body>

</html>