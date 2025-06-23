<?php $cd = "Case_Study";
include "./../Functions/PHP/include/dataFetcher.php";
include "./../Functions/PHP/include/alert.php";
// include "./../Functions/PHP/include/formIIReq.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AICS SYSTEM - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="./../Assets/Style/Global/style.css">
</head>

<body>
    <?php include "./../Assets/Global/nav.php"; ?>

    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col"></div>
            <div class="col border rounded shadow-sm pb-2">
                <form method="post" action="./../Functions/PHP/formII.php">
                    <div class="row">
                        <div class="col">
                            <h4 class="m-0 mt-2 user-select-none">III. PROBLEM PRESENTED:</h4>
                        </div>
                        <div class="col d-flex justify-content-end align-items-start pt-2">
                            <a href="./../Functions/PHP/f2tof1.php" type="button" class="btn-close"
                                aria-label="Close"></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                    style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Comments</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col d-flex justify-content-end align-items-start">
                            <input type="hidden" id="count" name="count">
                            <input type="hidden" name="formII">
                            <button type="submit" class="btn btn-outline-dark btn-lg shadow-sm me-1">Next</button>
                        </div>
                    </div>
                </form>
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