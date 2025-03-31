<?php include "connect.php";
session_start();
if (empty($_SESSION['userid'])) { ?>
    <script>window.location.href = "logout.php"</script>
<?php } else {
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Messaging System</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            ::-webkit-scrollbar {
                width: .2em;
            }

            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            ::-webkit-scrollbar-thumb {
                background: rgb(133, 133, 133);
            }

            ::-webkit-scrollbar-thumb:hover {
                background: rgb(71, 70, 70);
            }
        </style>
    </head>

    <body class="overflow-x-hidden" style="min-width: 50em;">
        <div class="container-fluid">
            <div class="row m-5">
                <div class="col-4">
                    <div class="border border-primary rounded shadow" style="height:40em;">
                        <strong class="ms-2"><?php if (isset($_SESSION['recieverid'])) {
                            $recieverid = $_SESSION['recieverid'];
                            $sql = "SELECT Fname, Lname FROM register_tbl where User_ID = '$recieverid'";
                            $result = mysqli_query($conn, $sql);
                            if ($row = mysqli_fetch_assoc($result)) {
                                echo $row['Fname'] . "&nbsp;" . $row['Lname'];
                            } else {
                                ?>
                                    <script>window.location.href = "logout.php"</script><?php
                            }
                        }
                        ; ?>
                        </strong>
                        <div class="d-flex flex-column" style="width: 100%;">

                            <?php
                            if (isset($_SESSION['recieverid'])) {
                                $recieverid = $_SESSION['recieverid'];
                                $userid = $_SESSION['userid'];
                                $sql = "SELECT User_ID FROM register_tbl where User_ID = '$recieverid'";
                                $result = mysqli_query($conn, $sql);
                                if ($row = mysqli_fetch_array($result)) {
                                    $recieverid = $row["User_ID"];
                                    $sql = "SELECT Sender_ID, Message, Timestamp FROM messages_tbl
                                    where (Sender_ID = '$recieverid' OR Sender_ID = '$userid')
                                    AND (Reciever_ID = '$recieverid' OR Reciever_ID = '$userid')";
                                    $result = mysqli_query($conn, $sql);
                                    ?>
                                    <div class="overflow-y-scroll ms-2 me-2 mt-" style="height: 34em;"><?php
                                    while ($row = mysqli_fetch_array($result)) {
                                        if ($userid == $row['Sender_ID']) {
                                            ?>
                                                <div class="text-end me-2">
                                                    <p class=><?php echo $row['Message'] ?></p>
                                                    <p><b><?php echo $row['Timestamp'] ?></b></p><br>
                                                </div><?php
                                        } else {
                                            ?>
                                                <div>
                                                    <p class=><?php echo $row['Message'] ?></p>
                                                    <p><b><?php echo $row['Timestamp'] ?></b></p><br>
                                                </div><?php
                                        }
                                    }
                                }
                            } else { ?> <div class="d-flex justify-content-center align-items-center m-auto" style="height: 34em;">
                                <h3>Please Select a Recipient</h3><?php }
                            ?>
                            </div>
                            <form class="mt-3 ms-2 me-2 d-flex justify-content-center align-items-center" method="POST">
                                <input class="form-control me-2" name="message" type="text" placeholder="Write a Message"
                                    aria-label="Send" required>
                                <button class="btn btn-outline-primary" name="sendMessage" type="submit">Send</button>
                            </form>
                            <?php
                            if (isset($_POST['sendMessage'])) {
                                if (isset($_SESSION['recieverid'])) {
                                    $recieverid = $_SESSION['recieverid'];
                                    $message = $_POST['message'];
                                    $senderid = $_SESSION['userid'];
                                    $sql = "INSERT INTO messages_tbl (Sender_ID, Reciever_ID, Message)
                                            VALUES ('$senderid', '$recieverid', '$message')";

                                    if (mysqli_query($conn, $sql)) {
                                        ?>
                                        <script>window.location.href = "messaging.php"</script>
                                        <?php
                                    } else { ?>
                                        <script>alert('Something went wrong.')
                                            window.location.href = 'messaging.php'</script><?php }
                                } else { ?>
                                    <script>alert('Please select a recipient.')</script><?php }
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div>
                        <form method="POST">
                            <select class="btn btn-outline-primary" name="recieverid">
                                <?php $sql = "SELECT Fname, Lname, User_ID FROM register_tbl";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    if ($_SESSION['userid'] !== $row['User_ID']) {
                                        ?>
                                        <option value=<?php echo $row['User_ID'] ?>><?php echo $row['Fname'] . "&nbsp;" . $row['Lname']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <button class="btn btn-primary" type="submit" name="recieverForm">Choose</button>
                        </form>
                        <?php if (isset($_POST['recieverForm'])) {
                            $_SESSION['recieverid'] = $_POST['recieverid'];
                            ?>
                            <script>window.location.href = "messaging.php"</script><?php } ?>
                    </div>
                    <p>Go back to <a href="index.php">Homepage</a>.</p>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </body>

    </html><?php
}