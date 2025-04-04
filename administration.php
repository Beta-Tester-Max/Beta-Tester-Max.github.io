<?php include "connect.php";
session_start();
if ($_SESSION['authority'] === "Admin") {
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Only</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous">
    </head>

    <body class="overflow-x-hidden" style="min-width: 50em;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2"></div>
                <div
                    class="col-8 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5 my-5">
                    <h1 class="mb-4" id="pending">Pending Applications</h1>
                    <table class="table table-striped border shadow rounded">
                        <tr>
                            <th class="text-center text-primary" scope="col">ID</th>
                            <th class="text-center" scope="col">Assistance Type</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Files</th>
                            <th class="text-center" scope="col">Status</th>
                            <th class="text-center" scope="col">Date Submitted</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $sql = "SELECT Application_ID, Assistance_Type, Reason, Req1, Req2, Req3,
                                            Req4, Req5, Req6, Req7, Status, Date_Submitted
                                            FROM application_tbl
                                            where is_deleted = 0 
                                            AND Status = 'Pending'";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <th class="text-center text-primary"><?php echo $row['Application_ID'] ?></th>
                                    <th class="text-center"><?php echo $row['Assistance_Type'] ?></th>
                                    <th><?php echo $row['Reason'] ?></th>
                                    <th><?php if (empty($row['Req1']) == false) { ?>1. <?php echo $row['Req1'] ?><br>
                                            <form method="POST">
                                                <input type="hidden" value="<?php echo $row['Req1'] ?>" name="file">
                                                <button type="submit" class="btn btn-primary" name="file01">Open File</button>
                                            </form><br><?php } ?>
                                        <?php if (empty($row['Req2']) == false) { ?>2. <?php echo $row['Req2'] ?><br>
                                            <form method="POST">
                                                <input type="hidden" value="<?php echo $row['Req2'] ?>" name="file">
                                                <button type="submit" class="btn btn-primary" name="file01">Open File</button>
                                            </form><br><?php } ?>
                                        <?php if (empty($row['Req3']) == false) { ?>3. <?php echo $row['Req3'] ?><br>
                                            <form method="POST">
                                                <input type="hidden" value="<?php echo $row['Req3'] ?>" name="file">
                                                <button type="submit" class="btn btn-primary" name="file01">Open File</button>
                                            </form><br><?php } ?>
                                        <?php if (empty($row['Req4']) == false) { ?>4. <?php echo $row['Req4'] ?><br>
                                            <form method="POST">
                                                <input type="hidden" value="<?php echo $row['Req4'] ?>" name="file">
                                                <button type="submit" class="btn btn-primary" name="file01">Open File</button>
                                            </form><br><?php } ?>
                                        <?php if (empty($row['Req5']) == false) { ?>5. <?php echo $row['Req5'] ?><br>
                                            <form method="POST">
                                                <input type="hidden" value="<?php echo $row['Req5'] ?>" name="file">
                                                <button type="submit" class="btn btn-primary" name="file01">Open File</button>
                                            </form><br><?php } ?>
                                        <?php if (empty($row['Req6']) == false) { ?>6. <?php echo $row['Req6'] ?><br>
                                            <form method="POST">
                                                <input type="hidden" value="<?php echo $row['Req6'] ?>" name="file">
                                                <button type="submit" class="btn btn-primary" name="file01">Open File</button>
                                            </form><br><?php } ?>
                                        <?php if (empty($row['Req7']) == false) { ?>7. <?php echo $row['Req7'] ?><br>
                                            <form method="POST">
                                                <input type="hidden" value="<?php echo $row['Req7'] ?>" name="file">
                                                <button type="submit" class="btn btn-primary" name="file01">Open File</button>
                                            </form><br><?php } ?>
                                    </th>
                                    <th class="text-center"><?php echo $row['Status'] ?></th>
                                    <th class="text-center"><?php echo $row['Date_Submitted'] ?></th>
                                    <th>
                                        <form method="POST">
                                            <input type="hidden" name="appid" value="<?php echo $row['Application_ID'] ?>">
                                            <button type="submit" name="approveForm"
                                                class="btn btn-success me-1">Approve</button>
                                        </form>
                                        <form method="POST">
                                            <input type="hidden" name="appid" value="<?php echo $row['Application_ID'] ?>">
                                            <button type="submit" name="rejectForm" class="btn btn-danger mt-1">Reject</button>
                                        </form>
                                    </th>
                                </tr>
                                <?php if (isset($_POST['file01'])) {
                                    $_SESSION['file'] = $_POST['file'] ?>
                                    <script>window.location.href = "pdfdisplayer.php"</script>
                                <?php }
                                if (isset($_POST['approveForm'])) {
                                    $appid = $_POST['appid'];
                                    $date = date('Y-m-d');
                                    $sql = "UPDATE application_tbl
                                            SET Date_ApporRej = '$date',
                                            Status = 'Approved'
                                            where Application_ID = '$appid'";
                                    if (mysqli_query($conn, $sql)) {
                                        ?>
                                        <script>window.location.href = "administration.php"</script><?php
                                    }
                                }
                                if (isset($_POST['rejectForm'])) {
                                    $appid = $_POST['appid'];
                                    $date = date('Y-m-d');
                                    $sql = "UPDATE application_tbl
                                            SET Date_ApporRej = '$date',
                                            Status = 'Rejected'
                                            where Application_ID = '$appid'";
                                    if (mysqli_query($conn, $sql)) {
                                        ?>
                                        <script>window.location.href = "administration.php"</script><?php
                                    }
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="row">
                <div class="col-2"></div>
                <div
                    class="col-8 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5 my-5">
                    <h1 class="mb-4" id="history">Applications History</h1>
                    <table class="table table-striped border shadow rounded">
                        <tr>
                            <th class="text-center text-primary" scope="col">ID</th>
                            <th class="text-center" scope="col">Assistance Type</th>
                            <th class="text-center" scope="col">Status</th>
                            <th class="text-center" scope="col">Date Submitted</th>
                            <th class="text-center" scope="col">Date Reviewed</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $sql = "SELECT Application_ID, Assistance_Type, Status, Date_Submitted, Date_ApporRej
                                        FROM application_tbl
                                        where NOT Status = 'Pending' 
                                        AND is_deleted = '0'";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <th class="text-center text-primary"><?php echo $row['Application_ID'] ?></th>
                                    <th class="text-center"><?php echo $row['Assistance_Type'] ?></th>
                                    <?php if ($row['Status'] == "Approved") { ?>
                                        <th class="text-center text-success"><?php echo $row['Status'] ?></th>
                                    <?php } else { ?>
                                        <th class="text-center text-danger"><?php echo $row['Status'] ?></th>
                                    <?php } ?>
                                    <th class="text-center"><?php echo $row['Date_Submitted'] ?></th>
                                    <th class="text-center"><?php echo $row['Date_ApporRej'] ?></th>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
        <footer>
            <div class="bg-success p-5 d-flex justify-content-center align-items-center">
                <a class="btn btn-outline-info btn-lg" href="logout.php">Exit Administration</a>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YUe2LzesAfftltw+PEaao2tjU/QATaW/rOitAq67e0CT0Zi2VVRL0oC4+gAaeBKu"
            crossorigin="anonymous"></script>
    </body>

    </html> <?php } else { ?>
    <script>window.location.href = "logout.php"</script>
<?php }