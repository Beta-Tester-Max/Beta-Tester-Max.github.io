<?php include "connect.php";
session_start();
if ($_SESSION['authority'] === "Admin") { ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Only</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous">
        <style>
            @media (max-width: 1200px) {
                .modal-xl {
                    min-width: 1140px !important;
                }
            }

            @media (max-width: 991px) {
                .modal-xl {
                    min-width: 1140px !important;
                }

                .modal-lg {
                    min-width: 800px !important;
                }
            }

            @media (max-width: 767px) {
                .modal-xl {
                    min-width: 1140px !important;
                }

                .modal-lg {
                    min-width: 800px !important;
                }
            }
        </style>
    </head>

    <body class="overflow-hidden" style="min-width: 50em;">
        <div class="container-fluid" id="main" style="height: 85vh;">
            <div class="row justify-content-md-center">
                <div class="col border rounded shadow p-3 my-4 mx-2 overflow-y-scroll overflow-x-hidden"
                    style="min-height: 35em; min-width: 15em;">
                    <p class="mb-4 text-center"><b>Pending Requirements</b></p>
                    <table class="table table-striped table-primary border shadow rounded">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">Name</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = $pdo->query("SELECT DISTINCT User_ID FROM requirements_tbl where Status = 'Unvalidated'");
                            $result = $sql->fetchall();
                            $data = sanitize($result);

                            foreach ($data as $users) {
                                $user = $users["User_ID"];
                                $sql = $pdo->prepare("SELECT Fname, Mname, Lname FROM userinfo_tbl where User_ID = :userid");
                                $sql->bindParam(":userid", $user, PDO::PARAM_INT);
                                $sql->execute();
                                $result = $sql->fetch(PDO::FETCH_ASSOC);
                                $data = sanitize($result);
                                $Fname = (isset($data['Fname'])) ? $data['Fname'] : '';
                                $Mname = (isset($data['Mname'])) ? $data['Mname'] : '';
                                $Lname = (isset($data['Lname'])) ? $data['Lname'] : '';

                                if (empty($Mname)) {
                                    $fullName = $Fname . "&nbsp;" . $Lname;
                                } else {
                                    $fullName = $Fname . "&nbsp;" . $Mname . "&nbsp;" . $Lname;
                                } ?>
                                <tr>
                                    <td class="text-center align-middle"><?php echo $fullName ?></td>
                                    <td class="text-center"><button type="button" class="btn btn-warning rounded-pill"
                                            data-bs-toggle="modal" data-bs-target="#modalReq<?php echo $user ?>">
                                            View
                                        </button>
                                    </td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                    <?php
                    $sql = $pdo->query("SELECT DISTINCT User_ID FROM requirements_tbl where Status = 'Unvalidated'");
                    $result = $sql->fetchall();
                    $data = sanitize($result);

                    foreach ($data as $users) {
                        $user = $users["User_ID"];
                        $sql = $pdo->prepare("SELECT Fname, Mname, Lname FROM userinfo_tbl where User_ID = :userid");
                        $sql->bindParam(":userid", $user, PDO::PARAM_INT);
                        $sql->execute();
                        $result = $sql->fetch(PDO::FETCH_ASSOC);
                        $data = sanitize($result);
                        $Fname = (isset($data['Fname'])) ? $data['Fname'] : '';
                        $Mname = (isset($data['Mname'])) ? $data['Mname'] : '';
                        $Lname = (isset($data['Lname'])) ? $data['Lname'] : '';

                        if (empty($Mname)) {
                            $fullName = $Fname . "&nbsp;" . $Lname;
                        } else {
                            $fullName = $Fname . "&nbsp;" . $Mname . "&nbsp;" . $Lname;
                        }
                        ?>
                        <div class="modal fade" id="modalReq<?php echo $user ?>" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel<?php echo $user ?>"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalLabel<?php echo $user ?>">
                                            <?php echo $fullName ?>'s
                                            Requirements
                                        </h1>
                                        <input type="hidden" value="<?php echo $fullName?>" id="reqUser">
                                        <button class="btn btn-outline-info rounded-pill ms-2" onclick="seeUserDetails()" data-bs-dismiss="modal">View User Information</button>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-striped table-success border shadow rounded">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Document_Type</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                <?php
                                                $sql = $pdo->prepare("SELECT Requirements_ID, Document_Type, File_ID FROM requirements_tbl where User_ID = :userid AND Status = 'Unvalidated'");
                                                $sql->bindParam(":userid", $user, PDO::PARAM_INT);
                                                $sql->execute();
                                                $result = $sql->fetchAll();
                                                $data = sanitize($result);

                                                foreach ($data as $row) {
                                                    $doctype = $row['Document_Type'];
                                                    $fileid = $row['File_ID'];
                                                    $reqid = $row['Requirements_ID']; ?>
                                                    <tr>
                                                        <td class="align-top"><?php echo $doctype ?></td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <form method="POST">
                                                                    <input type="hidden" name="file" value="<?php echo $fileid ?>">
                                                                    <button type="submit" name="fileOpenReq"
                                                                        class="btn btn-primary me-2">Open
                                                                        File</button>
                                                                </form>
                                                                <form method="POST">
                                                                    <input type="hidden" name="reqid" value="<?php echo $reqid ?>">
                                                                    <button type="submit" name="validateDoc"
                                                                        class="btn btn-success me-2">Validate</button>
                                                                </form>
                                                                <form method="POST">
                                                                    <div style="display: flex; align-items: flex-start;">
                                                                        <input type="hidden" name="reqid"
                                                                            value="<?php echo $reqid ?>">
                                                                        <button type="submit" name="rejectDoc"
                                                                            class="btn btn-danger me-2">Reject</button>
                                                                        <div class="form-floating">
                                                                            <textarea class="form-control"
                                                                                placeholder="State your reason here"
                                                                                id="floatingTextarea"
                                                                                style="height: 5em; width: 15em;" name="reason"
                                                                                required></textarea>
                                                                            <label for="floatingTextarea">Reason</label>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php }
                                                if (isset($_POST['fileOpenReq'])) {
                                                    $fileid = $_POST['file'];

                                                    $sql = $pdo->prepare("SELECT File_Name FROM file_tbl where File_ID = :fileid");
                                                    $sql->bindParam(":fileid", $fileid, PDO::PARAM_INT);
                                                    $sql->execute();
                                                    $result = $sql->fetchAll();
                                                    $data = sanitize($result);

                                                    $_SESSION['file'] = $data[0]['File_Name'];
                                                    ?>
                                                    <script>window.location.href = "pdfdisplayer.php"</script>
                                                    <?php
                                                }
                                                if (isset($_POST['validateDoc'])) {
                                                    $reqid = $_POST['reqid'];

                                                    $sql = $pdo->prepare("UPDATE requirements_tbl 
                                                                            SET Status = 'Validated'
                                                                            where Requirements_ID = :reqid");
                                                    $sql->bindParam(":reqid", $reqid, PDO::PARAM_INT);
                                                    $sql->execute();

                                                    ?>
                                                    <script>
                                                        alert('Document Validated.')
                                                        window.location.href = "administration.php"
                                                    </script>
                                                    <?php
                                                }
                                                if (isset($_POST['rejectDoc'])) {
                                                    $reqid = $_POST['reqid'];
                                                    $reason = $_POST['reason'];

                                                    $sql = $pdo->prepare("UPDATE requirements_tbl 
                                                        SET Status = 'Rejected',
                                                        ReasonFR = :reason
                                                        where Requirements_ID = :reqid");
                                                    $sql->bindParam(":reqid", $reqid, PDO::PARAM_INT);
                                                    $sql->bindParam(":reason", $reason, PDO::PARAM_STR);
                                                    $sql->execute();

                                                    ?>
                                                    <script>
                                                        alert('Document Rejected')
                                                        window.location.href = "administration.php"
                                                    </script>
                                                    <?php
                                                }
                                                ?>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col border rounded shadow p-3 my-4 mx-2 overflow-y-scroll overflow-x-hidden"
                    style="min-height: 35em; min-width: 15em;">
                    <p class="mb-4 text-center"><b>Pending Applications</b></p>
                    <table class="table table-striped table-primary border shadow rounded">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">Name</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = $pdo->query("SELECT DISTINCT User_ID FROM application_tbl where Status = 'Pending'");
                            $result = $sql->fetchall();
                            $data = sanitize($result);

                            foreach ($data as $users) {
                                $user = $users["User_ID"];
                                $sql = $pdo->prepare("SELECT Fname, Mname, Lname FROM userinfo_tbl where User_ID = :userid");
                                $sql->bindParam(":userid", $user, PDO::PARAM_INT);
                                $sql->execute();
                                $result = $sql->fetchAll();
                                $data = sanitize($result);
                                $Fname = (isset($data[0]['Fname'])) ? $data[0]['Fname'] : '';
                                $Mname = (isset($data[0]['Mname'])) ? $data[0]['Mname'] : '';
                                $Lname = (isset($data[0]['Lname'])) ? $data[0]['Lname'] : '';

                                if (empty($Mname)) {
                                    $fullName = $Fname . "&nbsp;" . $Lname;
                                } else {
                                    $fullName = $Fname . "&nbsp;" . $Mname . "&nbsp;" . $Lname;
                                } ?>
                                <tr>
                                    <td class="text-center align-middle"><?php echo $fullName ?></td>
                                    <td class="text-center"><button type="button" class="btn btn-warning rounded-pill"
                                            data-bs-toggle="modal" data-bs-target="#modalApp<?php echo $user ?>">
                                            View
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php
                    $sql = $pdo->query("SELECT DISTINCT User_ID FROM application_tbl where Status = 'Pending'");
                    $result = $sql->fetchall();
                    $data = sanitize($result);

                    foreach ($data as $users) {
                        $user = $users["User_ID"];
                        $sql = $pdo->prepare("SELECT Fname, Mname, Lname FROM userinfo_tbl where User_ID = :userid");
                        $sql->bindParam(":userid", $user, PDO::PARAM_INT);
                        $sql->execute();
                        $result = $sql->fetchAll();
                        $data = sanitize($result);
                        $Fname = (isset($data[0]['Fname'])) ? $data[0]['Fname'] : '';
                        $Mname = (isset($data[0]['Mname'])) ? $data[0]['Mname'] : '';
                        $Lname = (isset($data[0]['Lname'])) ? $data[0]['Lname'] : '';

                        if (empty($Mname)) {
                            $fullName = $Fname . "&nbsp;" . $Lname;
                        } else {
                            $fullName = $Fname . "&nbsp;" . $Mname . "&nbsp;" . $Lname;
                        }
                        ?>
                        <div class="modal fade" id="modalApp<?php echo $user ?>" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel<?php echo $user ?>"
                            aria-hidden="true" style="min-width: 100%;">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalLabel<?php echo $user ?>">
                                            <?php echo $fullName ?>'s
                                            Applications
                                        </h1>
                                        <input type="hidden" value="<?php echo $fullName?>" id="appUser">
                                        <button class="btn btn-outline-info rounded-pill ms-2" onclick="seeUserDetails()" data-bs-dismiss="modal">View User Information</button>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-striped table-success border shadow rounded">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Assistance Type</th>
                                                    <th scope="col">Reason</th>
                                                    <th scope="col">Requirements</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                <?php
                                                $sql = $pdo->prepare("SELECT Assistance_Type, Reason, 
                                                                        Req1, Req2, Req3, Req4, Req5, Req6,
                                                                        Req7, Req8, Req9, Req10, Req11 
                                                                        FROM application_tbl where User_ID = :userid AND Status = 'Pending'");
                                                $sql->bindParam(":userid", $user, PDO::PARAM_INT);
                                                $sql->execute();
                                                $result = $sql->fetchAll();
                                                $data = sanitize($result);

                                                foreach ($data as $row) {
                                                    $astype = $row['Assistance_Type'];
                                                    $reason = $row['Reason'];
                                                    $req1 = (isset($row['Req1'])) ? $row['Req1'] : "";
                                                    $req2 = (isset($row['Req2'])) ? $row['Req2'] : "";
                                                    $req3 = (isset($row['Req3'])) ? $row['Req3'] : "";
                                                    $req4 = (isset($row['Req4'])) ? $row['Req4'] : "";
                                                    $req5 = (isset($row['Req5'])) ? $row['Req5'] : "";
                                                    $req6 = (isset($row['Req6'])) ? $row['Req6'] : "";
                                                    $req7 = (isset($row['Req7'])) ? $row['Req7'] : "";
                                                    $req8 = (isset($row['Req8'])) ? $row['Req8'] : "";
                                                    $req9 = (isset($row['Req9'])) ? $row['Req9'] : "";
                                                    $req10 = (isset($row['Req10'])) ? $row['Req10'] : "";
                                                    $req11 = (isset($row['Req11'])) ? $row['Req11'] : ""; ?>
                                                    <tr>
                                                        <td class="align-top"><?php echo $astype ?></td>
                                                        <td class="align-top"><?php echo $reason ?></td>
                                                        <td>
                                                            <?php
                                                            $sql = $pdo->prepare("SELECT Document_Type, File_ID
                                                                                    FROM requirements_tbl
                                                        WHERE File_ID IN (:req1, :req2, :req3, :req4, :req5, :req6, :req7, :req8, :req9, :req10, :req11)");
                                                            $sql->bindParam(":req1", $req1, PDO::PARAM_INT);
                                                            $sql->bindParam(":req2", $req2, PDO::PARAM_INT);
                                                            $sql->bindParam(":req3", $req3, PDO::PARAM_INT);
                                                            $sql->bindParam(":req4", $req4, PDO::PARAM_INT);
                                                            $sql->bindParam(":req4", $req4, PDO::PARAM_INT);
                                                            $sql->bindParam(":req5", $req5, PDO::PARAM_INT);
                                                            $sql->bindParam(":req6", $req6, PDO::PARAM_INT);
                                                            $sql->bindParam(":req7", $req7, PDO::PARAM_INT);
                                                            $sql->bindParam(":req8", $req8, PDO::PARAM_INT);
                                                            $sql->bindParam(":req9", $req9, PDO::PARAM_INT);
                                                            $sql->bindParam(":req10", $req10, PDO::PARAM_INT);
                                                            $sql->bindParam(":req11", $req11, PDO::PARAM_INT);
                                                            $sql->execute();
                                                            $result = $sql->fetchAll();
                                                            $data = sanitize($result);

                                                            foreach ($data as $row) {
                                                                $doctype = $row['Document_Type'];
                                                                $fileid = $row['File_ID'];

                                                                ?>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <p class="mt-1"><b><?php echo $doctype ?></b></p>
                                                                    </div>
                                                                    <div class="col" style="max-width: 8em;">
                                                                        <form method="POST">
                                                                            <input type="hidden" value="<?php echo $fileid ?>"
                                                                                name="file">
                                                                            <button type="submit" name="fileOpenApp"
                                                                                class="btn btn-primary">Open File</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                            if (isset($_POST['fileOpenApp'])) {
                                                                $fileid = $_POST['file'];

                                                                $sql = $pdo->prepare("SELECT File_Name FROM file_tbl where File_ID = :fileid");
                                                                $sql->bindParam(":fileid", $fileid, PDO::PARAM_INT);
                                                                $sql->execute();
                                                                $result = $sql->fetchAll();
                                                                $data = sanitize($result);

                                                                $_SESSION['file'] = $data[0]['File_Name'];
                                                                ?>
                                                                <script>window.location.href = "pdfdisplayer.php"</script>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="align-top">
                                                            <?php
                                                            $sql = $pdo->prepare("SELECT Application_ID
                                                        FROM application_tbl
                                                        where Assistance_Type = :astype AND User_ID = :userid");
                                                            $sql->bindParam(":astype", $astype, PDO::PARAM_STR);
                                                            $sql->bindParam(":userid", $user, PDO::PARAM_INT);
                                                            $sql->execute();
                                                            $result = $sql->fetch(PDO::FETCH_ASSOC);
                                                            $data = sanitize($result);
                                                            $appid = $data['Application_ID'];
                                                            ?>
                                                            <div class="row">
                                                                <div class="col d-flex justify-content-center align-items-start"
                                                                    style="width: 2em;">
                                                                    <form method="POST">
                                                                        <input type="hidden" name="appid"
                                                                            value="<?php echo $appid ?>">
                                                                        <button type="submit" name="approveApp"
                                                                            class="btn btn-success">Approve</button>
                                                                    </form>
                                                                </div>
                                                                <div class="col ps-1">
                                                                    <form method="POST">
                                                                        <div style="display: flex; align-items: flex-start;">
                                                                            <input type="hidden" name="appid"
                                                                                value="<?php echo $appid ?>">
                                                                            <button type="submit" name="rejectApp"
                                                                                class="btn btn-danger me-1">Reject</button>
                                                                            <div class="form-floating">
                                                                                <textarea class="form-control"
                                                                                    placeholder="State your reason here"
                                                                                    id="floatingTextarea"
                                                                                    style="height: 5em; width: 15em;" name="reason"
                                                                                    required></textarea>
                                                                                <label for="floatingTextarea">Reason</label>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                    <?php
                                                                    if (isset($_POST['approveApp'])) {
                                                                        $appid = $_POST['appid'];
                                                                        $date = date('Y-m-d');

                                                                        $sql = $pdo->prepare("UPDATE application_tbl
                                                                                                SET Status = 'Approved',
                                                                                                Date_ApporRej = :date
                                                                                                where Application_ID = :appid");
                                                                        $sql->bindParam(":appid", $appid, PDO::PARAM_INT);
                                                                        $sql->bindParam(":date", $date, PDO::PARAM_STR);
                                                                        $sql->execute();

                                                                        ?>
                                                                        <script>
                                                                            alert('Application Approved.')
                                                                            window.location.href = "administration.php"
                                                                        </script>
                                                                        <?php
                                                                    }
                                                                    if (isset($_POST['rejectApp'])) {
                                                                        $appid = $_POST['appid'];
                                                                        $reason = $_POST['reason'];
                                                                        $date = date('Y-m-d');

                                                                        $sql = $pdo->prepare("UPDATE application_tbl
                                                                            SET Status = 'Rejected',
                                                                            ReasonFR = :reason,
                                                                            Date_ApporRej = :date
                                                                            where Application_ID = :appid");
                                                                        $sql->bindParam(":appid", $appid, PDO::PARAM_INT);
                                                                        $sql->bindParam(":reason", $reason, PDO::PARAM_STR);
                                                                        $sql->bindParam(":date", $date, PDO::PARAM_STR);
                                                                        $sql->execute();

                                                                        ?>
                                                                        <script>
                                                                            alert('Application Rejected')
                                                                            window.location.href = "administration.php"
                                                                        </script>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col border rounded shadow p-3 my-4 mx-2 overflow-y-scroll overflow-x-hidden"
                    style="min-height: 35em; min-width: 15em;">
                    <p class="mb-4 text-center"><b>Application History</b></p>
                    <table class="table table-striped table-primary border shadow rounded">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th class="text-center" scope="col">Assistance Type</th>
                                <th class="text-center" scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $sql = $pdo->query("SELECT User_ID, Assistance_Type, Status
                                FROM application_tbl
                                where NOT Status = 'Pending'");
                            $result = $sql->fetchAll();
                            $data = sanitize($result);

                            foreach ($data as $row) {
                                $userid = $row['User_ID'];
                                $astype = $row['Assistance_Type'];
                                $status = $row['Status'];

                                ?>
                                <tr>
                                    <td class="align-middle">
                                        <?php
                                        $sql = $pdo->prepare("SELECT Fname, Mname, Lname FROM userinfo_tbl where User_ID = :userid");
                                        $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                                        $sql->execute();
                                        $result = $sql->fetch(PDO::FETCH_ASSOC);
                                        $data = sanitize($result);
                                        $Fname = (isset($data['Fname'])) ? $data['Fname'] : '';
                                        $Mname = (isset($data['Mname'])) ? $data['Mname'] : '';
                                        $Lname = (isset($data['Lname'])) ? $data['Lname'] : '';

                                        if (empty($Mname)) {
                                            $fullName = $Fname . "&nbsp;" . $Lname;
                                        } else {
                                            $fullName = $Fname . "&nbsp;" . $Mname . "&nbsp;" . $Lname;
                                        }

                                        echo $fullName;
                                        ?>
                                    </td>
                                    <td class="text-center align-middle"><?php echo $astype ?></td>
                                    <?php
                                    switch ($status) {
                                        case "Approved":
                                            ?>
                                            <td class="text-center align-middle text-success"><b>Approved</b></td><?php ;
                                            break;
                                        case "Rejected";
                                            ?>
                                            <td class="text-center align-middle text-danger"><b>Rejected</b></td><?php ;
                                            break;
                                    } ?>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container-fluid d-none" id="card" style="height: 78vh;">
            <div class="row justify-content-md-center mt-5">
                <div class="col-md-auto">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title" id="userFullName"></h5>
                            <p class="card-text">User Description.</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">User Details 1</li>
                            <li class="list-group-item">User Details 2</li>
                            <li class="list-group-item">User Details 3</li>
                        </ul>
                        <div class="card-body">
                            <button type="button" class="btn btn-outline-dark" onclick="unseeDetails()">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function seeUserDetails() {
                document.getElementById('main').classList.add('d-none')
                document.getElementById('card').classList.remove('d-none')

                const rU = document.getElementById('reqUser')
                const aU = document.getElementById('appUser')

                if (rU.value !== "") {
                    const value = rU.value
                    document.getElementById('userFullName').innerText = value
                }
                if (aU.value !== "") {
                    const value = sU.value
                    document.getElementById('userFullName').innerText = value
                }
            }
            function unseeDetails() {
                window.location.href = "administration.php"
            }
        </script>
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