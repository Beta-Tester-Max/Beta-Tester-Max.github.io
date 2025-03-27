<?php include "connect.php";
session_start();
if (empty($_SESSION['username'])) { ?>
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
    </head>

    <body class="overflow-x-hidden" style="min-width: 50em;">
        <div class="container-fluid">
            <div class="row m-5">
                <div class="col-4">
                    <div class="position-relative border border-primary rounded shadow" style="height:40em;">
                        <strong class="ms-2"><?php if (isset($_SESSION['recipientName'])) {
                            $recipient = $_SESSION['recipientName'];
                            $sql = "SELECT Fname, Lname FROM register_tbl where Username = '$recipient'";
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
                        <div class="position-absolute top-100 start-50 translate-middle" style="width: 100%;">
                            <form class="mb-5 ms-2 me-2 d-flex justify-content-center align-items-center" method="POST">
                                <input class="form-control me-2" name="message" type="text" placeholder="Write a Message"
                                    aria-label="Send" required>
                                <button class="btn btn-outline-primary" name="sendMessage" type="submit">Send</button>
                            </form>
                            <?php
                            if (isset($_POST['sendMessage'])) {
                                if (isset($_SESSION['recipientName'])) {
                                    $recipient = $_SESSION['recipientName'];
                                    $sql = "SELECT User_ID FROM register_tbl where Username = '$recipient'";
                                    $result = mysqli_query($conn, $sql);
                                    if ($row = mysqli_fetch_assoc($result)) {
                                        $recieverid = $row['User_ID'];
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
                                    }
                                } else { ?>
                                    <script>alert('Please select a recipient.')</script><?php }
                            } ?>
                        </div>
                        <div class="ms-2 me-2 mt-3">
                            <?php
                            if (isset($_SESSION['recipientName'])) {
                                $recipient = $_SESSION['recipientName'];
                                $userid = $_SESSION['userid'];
                                $sql = "SELECT User_ID FROM register_tbl where Username = '$recipient'";
                                $result = mysqli_query($conn, $sql);
                                if ($row = mysqli_fetch_array($result)) {
                                    $recieverid = $row["User_ID"];
                                    $sql = "SELECT Sender_ID, Message, Timestamp FROM messages_tbl
                                    where (Sender_ID = '$recieverid' OR Sender_ID = '$userid')
                                    AND (Reciever_ID = '$recieverid' OR Reciever_ID = '$userid')";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                        if ($userid == $row['Sender_ID']) {
                                            ?>
                                            <div class="text-end">
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
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <strong>Select Users to talk to:</strong>
                    <div>
                        <form method="POST">
                            <select name="recipient">
                                <?php $sql = "SELECT Fname, Lname, Username FROM register_tbl";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    if ($_SESSION['username'] !== $row['Username']) {
                                        ?>
                                        <option value=<?php echo $row['Username'] ?>><?php echo $row['Fname'] . "&nbsp;" . $row['Lname']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <button type="submit" name="recipientForm">Choose</button>
                        </form>
                        <?php if (isset($_POST['recipientForm'])) {
                            $_SESSION['recipientName'] = $_POST['recipient'];
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