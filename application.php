<!doctype html>
<?php include "connect.php";
session_start();
if (empty($_SESSION['userid'])) { ?>
    <script>window.location.href = "logout.php";</script><?php } ?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Application Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row">'
            <div class="col-12">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <div class="border border-black rounded shadow p-5">
                        <a class="mb-3 d-flex justify-content-center align-items-center" href="index.php">Go Back.</a>
                        <form method="POST">
                            <?php $userid = $_SESSION['userid'];
                                ?>
                            <div class="mb-3">
                                <h3><b>Application Form</b></h3>
                            </div>
                            <div class="mt-3">
                                <label class="mb-1" for="name">Full Name</label><br>
                                <input type="text" id="name" name="name" maxlength="62" required>
                            </div>
                            <div class="mt-3">
                                <label class="mb-1" for="bday">Date of Birth</label><br>
                                <input class="p-2" type="date" id="bday" name="bday" required>
                            </div>
                            <div class="mt-3">
                                <label class="mb-1" for="address">Address</label><br>
                                <input type="text" id="address" name="address" maxlength="62" required>
                            </div>
                            <div class="mt-3">
                                <label class="mb-2" for="assistanceType">Type of Assitance</label><br>
                                <select class="p-2" name="assistanceType" id="assistanceType">
                                    <option value="Tra_As">Transportation Assistance</option>
                                    <option value="Med_As">Medical Assistance</option>
                                    <option value="Bur_As">Burial Assistance</option>
                                    <option value="Edu_As">Educational Assistance</option>
                                    <option value="Foo_As">Food Assistance</option>
                                    <option value="Cas_As">Cash Relief Assistance</option>
                                    <option value="Psy_Su">Psychosocial Support</option>
                                </select>
                            </div>
                            <div class="mt-4 d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn btn-outline-primary">Submit Application</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>