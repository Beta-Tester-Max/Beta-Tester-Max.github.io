<?php $cd = basename(__DIR__);
include "./../Functions/PHP/include/dataFetcher.php";
include "./../Functions/PHP/include/alert.php";
include "./../Functions/PHP/include/ongoingCS.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AICS SYSTEM - Case Study</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="./../Assets/Style/Global/style.css">
</head>

<body>
    <?php include "./../Assets/Global/nav.php"; ?>

    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col"></div>
            <div class="col rounded border shadow-sm p-2">
                <form class="d-flex align-items-center justify-content-center" method="POST" action="./../Functions/PHP/createCS.php">
                    <input type="text" class="form-control me-2" minlength="2" maxlength="50" placeholder="Case Study Name"
                        name="csName" id="csName" required>
                    <input type="hidden" name="createCS">
                    <button type="submit" class="btn btn-outline-dark">Create</button>
                </form>
                <hr>
                <div class="overflow-x-hidden overflow-y-auto" style="max-height: 30em;">
                    <?php include "./../Functions/PHP/include/allCaseStudy.php" ?>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/7961b8f896.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
</body>

</html>