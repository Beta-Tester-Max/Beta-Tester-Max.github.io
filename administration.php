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
                <div class="col-3"></div>
                <div
                    class="col-6 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5 my-5">
                    <h1 class="mb-4" id="history">Pending Requirements</h1>
                    <table class="table table-striped border shadow rounded">
                        <tr>
                            <th class="text-center text-primary" scope="col">ID</th>
                            <th class="text-center" scope="col">Document_Type</th>
                            <th class="" scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $sql = $pdo->prepare("SELECT Requirements_ID, Document_Type, File_ID
                                        FROM requirements_tbl
                                        where Status = 'Unvalidated'");
                            $sql->execute();
                            $row = $sql->fetch(PDO::FETCH_ASSOC);
                            $reqCount = 0;

                            while ($reqCount < $sql->rowCount()) {
                                ++$reqCount;
                                $documenttype = htmlspecialchars($row["Document_Type"], ENT_QUOTES, 'UTF-8');
                                $doc = str_replace(" ", "", $documenttype);
                                ?>
                                <tr>
                                    <th class="text-center text-primary"><?php echo $row['Requirements_ID'] ?></th>
                                    <th class="text-center"><?php echo $documenttype ?></th>
                                    <th class="d-flex">
                                        <form method="POST">
                                            <button class="btn btn-primary" style="width: 8em;" type="submit" name="fileopen"
                                                value="<?php echo $row['File_ID'] ?>">Open File</button>
                                        </form>
                                        <form method="POST">
                                            <button class="btn btn-success mx-2" type="submit" name="validatereq"
                                                value="<?php echo $row['Requirements_ID'] ?>">Validate</button>
                                        </form>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#reqModal<?php echo $row['Requirements_ID']; ?>">
                                            Reject
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="reqModal<?php echo $row['Requirements_ID']; ?>" data-bs-backdrop="static" data-bs-keyboard="false"
                                            tabindex="-1" aria-labelledby="reqModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="reqModalLabel">Reason For Rejecttion
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            <div class="mt-3">
                                                                <div class="form-floating">
                                                                    <textarea class="form-control"
                                                                        placeholder="State your reason here"
                                                                        id="floatingTextarea" style="height: 10em" name="reason"
                                                                        required></textarea>
                                                                    <label for="floatingTextarea">Reason</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger"
                                                                value="<?php echo $row['Requirements_ID'] ?>"
                                                                name="rejectreq">Reject</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <?php
                                    if (isset($_POST['fileopen'])) {
                                        $fileid = $_POST['fileopen'];
                                        $sql = $pdo->prepare("SELECT File_Name FROM file_tbl where File_ID = :fileid");
                                        $sql->bindParam(":fileid", $fileid, PDO::PARAM_INT);
                                        $sql->execute();
                                        $row = $sql->fetch(PDO::FETCH_ASSOC);

                                        if ($row) {
                                            $filename = htmlspecialchars($row["File_Name"], ENT_QUOTES, 'UTF-8');
                                            $_SESSION['file'] = $filename; ?>
                                            <script>window.location.href = "pdfdisplayer.php"</script><?php }
                                    }
                                    if (isset($_POST['validatereq']) || isset($_POST['rejectreq'])) {
                                        $reqid = (isset($_POST['validatereq'])) ? $_POST['validatereq'] : $_POST['rejectreq'];
                                        $status = (isset($_POST['validatereq'])) ? "Validated" : "Rejected";
                                        if (isset($_POST['validatereq'])) {
                                            $sql = $pdo->prepare("UPDATE requirements_tbl
                                                SET Status = :status
                                                where Requirements_ID = :reqid");
                                            $sql->bindParam(":status", $status, PDO::PARAM_STR);
                                            $sql->bindParam(":reqid", $reqid, PDO::PARAM_INT);
                                            $sql->execute();
                                            ?>
                                            <script>window.location.href = "administration.php"</script>
                                        <?php } elseif (isset($_POST['rejectreq'])) {
                                            $reason = $_POST['reason'];
                                            $sql = $pdo->prepare("UPDATE requirements_tbl
                                                                        SET Status = :status,
                                                                        ReasonFR = :reason
                                                                        where Requirements_ID = :reqid");
                                            $sql->bindParam(":status", $status, PDO::PARAM_STR);
                                            $sql->bindParam(":reason", $reason, PDO::PARAM_STR);
                                            $sql->bindParam(":reqid", $reqid, PDO::PARAM_INT);
                                            $sql->execute();
                                            ?>
                                            <script>window.location.href = "administration.php"</script>
                                        <?php }
                                    }
                                    ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-3"></div>
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