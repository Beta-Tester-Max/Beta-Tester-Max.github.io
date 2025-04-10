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
        <link rel="icon" href="./img/aics-logo.ico" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous">
    </head>

    <body class="overflow-x-hidden" style="min-width: 50em;">
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-2"></div>
                <div
                    class="col-8 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5 my-5">
                    <h1 class="mb-4" id="history">Pending Requirements</h1>
                    <table class="table table-striped border shadow rounded">
                        <tr>
                            <th class="text-center text-primary" scope="col">ID</th>
                            <th class="text-center" scope="col">Document_Type</th>
                            <th class="" scope="col">File Name</th>
                            <th class="" scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $sql = "SELECT Requirements_ID, Document_Type, File_Name
                                        FROM requirements_tbl
                                        where Status = 'Unvalidated'";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <th class="text-center text-primary"><?php echo $row['Requirements_ID'] ?></th>
                                    <th class="text-center"><?php echo $row['Document_Type'] ?></th>
                                    <th class=""><?php echo $row['File_Name'] ?></th>
                                    <th class="">
                                        <form method="POST">
                                            <button class="btn btn-primary" style="width: 8em;" type="submit" name="fileopen"
                                                value="<?php echo $row['File_Name'] ?>">Open File</button>
                                        </form>
                                        <form method="POST">
                                            <button class="btn btn-success my-1" type="submit" name="validatereq"
                                                value="<?php echo $row['Requirements_ID'] ?>">Validate</button>
                                        </form>
                                        <button type="button" class="btn btn-danger mt-1" data-bs-toggle="modal"
                                            data-bs-target="#requirementsRejectionModal">
                                            Reject
                                        </button>
                                        <div class="modal fade" id="requirementsRejectionModal" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="requirementsRejectionModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="requirementsRejectionModalLabel">Reason For
                                                            Rejection</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            <div class="mt-3">
                                                                <div class="form-floating">
                                                                    <textarea class="form-control" id="floatingTextarea"
                                                                        style="height: 10em" name="reason"></textarea>
                                                                    <label for="floatingTextarea">Reason</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-danger" type="submit" name="rejectreq"
                                                                value="<?php echo $row['Requirements_ID'] ?>">Reject</button>
                                                    </form>
                                                </div>
                                            </div>
                                    </th>
                                    </th>
                                    <?php
                                    if (isset($_POST['fileopen'])) {
                                        $_SESSION['file'] = $_POST['fileopen'] ?>
                                        <script>window.location.href = "pdfdisplayer.php"</script><?php
                                    }
                                    if (isset($_POST['validatereq']) || isset($_POST['rejectreq'])) {
                                        $reqid = (isset($_POST['validatereq'])) ? $_POST['validatereq'] : $_POST['rejectreq'];
                                        $status = (isset($_POST['validatereq'])) ? "Validated" : "Rejected";
                                        if (isset($_POST['validatereq'])) {
                                        $sql = "UPDATE requirements_tbl
                                                SET Status = '$status'
                                                where Requirements_ID = '$reqid'";
                                        mysqli_query($conn, $sql); ?>
                                        <script>window.location.href = "administration.php"</script> 
                                    <?php } elseif (isset($_POST['rejectreq'])) {
                                        $reason = $_POST['reason'];
                                        $sql = "UPDATE requirements_tbl
                                        SET Status = '$status',
                                        ReasonFR = '$reason'
                                        where Requirements_ID = '$reqid'";
                                mysqli_query($conn, $sql); ?>
                                <script>window.location.href = "administration.php"</script> 
                                    <?php } }
                                    ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="row">
                <div class="col-1"></div>
                <div
                    class="col-10 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5 my-5">
                    <h1 class="mb-4" id="pending">Pending Applications</h1>
                    <table class="table table-striped border shadow rounded">
                        <tr>
                            <th class="text-center text-primary" scope="col">ID</th>
                            <th class="text-center" scope="col">Assistance Type</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Files</th>
                            <th class="text-center" scope="col">Status</th>
                            <th class="text-center" scope="col">Date Submitted</th>
                            <th class="text-center" scope="col">Number of Edits Made</th>
                            <th scope="col">All Date of Edits</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $sql = "SELECT Application_ID, Assistance_Type, Reason, Req1, Req2, Req3,
                                            Req4, Req5, Req6, Req7, Status, Date_Submitted, Edited_Count, Date_Edited
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
                                    <th class="text-center"><?php echo $row['Edited_Count'] ?></th>
                                    <th><?php echo $row['Date_Edited'] ?></th>
                                    <th>
                                        <form method="POST">
                                            <input type="hidden" name="appid" value="<?php echo $row['Application_ID'] ?>">
                                            <button type="submit" name="approveForm"
                                                class="btn btn-success me-1">Approve</button>
                                        </form>
                                        <button type="button" class="btn btn-danger mt-1" data-bs-toggle="modal"
                                            data-bs-target="#applicationRejectionModal">
                                            Reject
                                        </button>
                                        <div class="modal fade" id="applicationRejectionModal" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="applicationRejectionModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="applicationRejectionModalLabel">Reason For
                                                            Rejection</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            <div class="mt-3">
                                                                <div class="form-floating">
                                                                    <textarea class="form-control" id="floatingTextarea"
                                                                        style="height: 10em" name="reason"></textarea>
                                                                    <label for="floatingTextarea">Reason</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="appid"
                                                                value="<?php echo $row['Application_ID'] ?>">
                                                            <button type="submit" name="rejectForm"
                                                                class="btn btn-danger mt-1">Reject
                                                                </butto>
                                                    </form>
                                                </div>
                                            </div>
                                    </th>
                                </tr>
                    </div>
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
                        $reason = $_POST['reason'];
                        $sql = "UPDATE application_tbl
                                            SET Date_ApporRej = '$date',
                                            Status = 'Rejected',
                                            ReasonFR = '$reason'
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
            <div class="col-8 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5 my-5">
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
            <div class="col-1"></div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 d-flex justify-content-center align-items-center border rounded shadow p-2 my-5">
                <div
                    class="container-fluid text-light d-flex flex-column justify-content-center align-items-center border bg-primary rounded shadow p-2 m-2">
                    <?php $sql = "SELECT Application_ID FROM application_tbl where is_deleted = '0'";
                    $result = mysqli_query($conn, $sql);
                    ?>
                    <strong>Total Application</strong>
                    <h2><?php echo mysqli_num_rows($result); ?></h2>
                </div>
                <div
                    class="container-fluid text-light d-flex flex-column justify-content-center align-items-center border bg-success rounded shadow p-2 m-2">
                    <?php $sql = "SELECT Application_ID FROM application_tbl where is_deleted = '0' AND Status = 'Approved'";
                    $result = mysqli_query($conn, $sql);
                    ?>
                    <strong>Total Approved</strong>
                    <h2><?php echo mysqli_num_rows($result); ?></h2>
                </div>
                <div
                    class="container-fluid text-light d-flex flex-column justify-content-center align-items-center border bg-danger rounded shadow p-2 m-2">
                    <?php $sql = "SELECT Application_ID FROM application_tbl where is_deleted = '0' And Status = 'Rejected'";
                    $result = mysqli_query($conn, $sql);
                    ?>
                    <strong>Total Rejected</strong>
                    <h2><?php echo mysqli_num_rows($result); ?></h2>
                </div>
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