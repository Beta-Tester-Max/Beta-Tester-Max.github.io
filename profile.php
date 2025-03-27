<?php include "connect.php";
session_start();
if (empty($_SESSION['userid'])) { ?>
    <script>window.location.href = "logout.php";</script><?php } ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid ">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="border rounded shadow p-5">
                <img class="border rounded shadow p-2 mb-5" src="profile.png">
                <?php 
                if (isset($_SESSION['userid'])) {
                    $userid = $_SESSION['userid'];
                $sql = "SELECT Fname, Mname, Lname, Username, Email FROM register_tbl where = '$userid'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);?>
                <h3><b>First Name: </b><?php echo $row['Fname']?></h3>
                <h3><b>Middle Name: </b><?php echo $row['Fname']?></h3>
                <h3><b>Last Name: </b><?php echo $row['Fname']?></h3>
                <h3><b>Username: </b><?php echo $row['Fname']?></h3>
                <h3><b>Email: </b></h3>
                <?php }?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>