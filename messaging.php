<?php include "connect.php"; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Messagin System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            min-width: 60em;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row m-5">
            <div class="col-4">
                <div class="position-relative border border-primary rounded shadow" style="height:40em;">
                    <div class="position-absolute top-100 start-50 translate-middle" style="width: 100%;">
                        <form class="mb-5 ms-2 me-2 d-flex justify-content-center align-items-center" method="POST">
                            <input class="form-control me-2" name="message" type="text" placeholder="Write a Message"
                                aria-label="Send" required>
                            <button class="btn btn-outline-primary" name="sendMessage" type="submit">Send</button>
                        </form>
                        <?php $userid = 14;
                        if (isset($_POST['sendMessage'])) {
                            $message = $_POST['message'];

                            $sql = "INSERT INTO messages_tbl (User_ID, Message)
                                        VALUES ('$userid', '$message')";

                            if (mysqli_query($conn, $sql)) {
                                ?>
                                <script>window.location.href = "login.php"</script><?php
                            } else { ?> <script>alert('Something went wrong.')</script><?php }
                        }
                        $conn->close() ?>
                    </div>
                </div>
            </div>
            <div class="col-4">

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>