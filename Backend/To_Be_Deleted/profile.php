<?php include "connect.php";
session_start();
if (empty($_SESSION["userid"])) { ?>
    <script>window.location.href = "logout.php";</script><?php } else {
    $userid = $_SESSION["userid"];
} ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @media (max-width: 991px) {
                .modal-lg {
                    min-width: 800px !important;
                }
            }

            @media (max-width: 767px) {
                .modal-xl {
                    min-width: 1140px !important;
                }
            }
    </style>
</head>
<body class="overflow-x-hidden" style="min-width: 50em;">
    <div class="container-fluid ">
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col-1"></div>
            <div class="col-4 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5">
                <?php
                if (isset($_SESSION["userid"])) {
                    $sql = $pdo->prepare("SELECT t2.Fname, t2.Mname, t2.Lname, t1.Username, t1.Profile_Pic, t1.Email FROM register_tbl As t1, userinfo_tbl AS t2 where t1.User_ID = :userid AND t2.User_ID = :userid");
                    $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                    $sql->execute();
                    $row = $sql->fetch(PDO::FETCH_ASSOC);
                    if ($row) {
                        ?>
                        <img class="border rounded shadow p-2 mb-5" style="width: 10em; height: 10em;"
                            src="<?php echo (empty($row["Profile_Pic"])) ? "placeholderprofilepic.png" : "file/" . $row["Profile_Pic"] ?>">
                        <h3><b><?php echo htmlspecialchars($row["Fname"], ENT_QUOTES, 'UTF-8') ?>
                                <?php echo htmlspecialchars($row["Mname"], ENT_QUOTES, 'UTF-8') ?>
                                <?php echo htmlspecialchars($row["Lname"], ENT_QUOTES, 'UTF-8') ?></b></h3>
                        <h3><i><?php echo htmlspecialchars($row["Username"], ENT_QUOTES, 'UTF-8') ?></i></h3>
                        <h3><?php echo htmlspecialchars($row["Email"], ENT_QUOTES, 'UTF-8') ?></h3>
                        <a class="btn btn-primary btn-lg mt-3 mb-2" href="profileeditor.php">Edit Profile</a>
                        <p>Go to <a href="index.php">Home</a>.</p>
                    <?php }
                } ?>
            </div>
            <div class="col-2"></div>
            <div class="col-4 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5">
                <?php if (isset($_SESSION["userid"])) {
                    $sql = $pdo->prepare("SELECT * FROM address_tbl where User_ID = :userid");
                    $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                    $sql->execute();
                    $row = $sql->fetch(PDO::FETCH_ASSOC);
                    if ($row) {
                        ?>
                        <h2><b>Address</b></h2>
                        <div class="d-flex justify-content-center align-items-center text-center">
                            <p><?php echo htmlspecialchars($row["Street_Address"], ENT_QUOTES, 'UTF-8') . "&nbsp;" . htmlspecialchars($row["Barangay"], ENT_QUOTES, 'UTF-8') . "&nbsp;" . htmlspecialchars($row["CityorMunicipality"], ENT_QUOTES, 'UTF-8') . ",&nbsp;" . htmlspecialchars($row["Province"], ENT_QUOTES, 'UTF-8') ?>
                            </p>
                        </div>
                    <?php }
                } ?>
            </div>
            <div class="col-1"></div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div
                class="col-8 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5 m-5">
                <h1 class="mb-4" id="requirements">Requirements</h1>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="grid text-center">
                        <?php $assistancetype = array(
                            "Transportation Assistance" => 'traAss',
                            "Medical Assistance" => 'medAss',
                            "Burial Assistance" => 'burAss',
                            "Educational Assistance" => 'eduAss',
                            "Food Assistance" => 'fooAss',
                            "Cash Relief Assistance" => 'casAss',
                            "Psychosocial Support" => 'psySup',
                        );
                        foreach ($assistancetype as $at => $id) { ?>
                            <button type="submit" class="btn btn-primary m-1" data-bs-toggle="modal"
                                data-bs-target="#<?php echo $id ?>">
                                <?php echo $at ?>
                            </button>
                            <div class="modal fade" id="<?php echo $id ?>" aria-hidden="true"
                                aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalToggleLabel"><?php echo $at ?>
                                                Requirements</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped">
                                                <tr>
                                                    <th class="text-start" scope="col">Document Type</th>
                                                    <th class="text-center" scope="col">Status</th>
                                                    <th class="text-start" scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (isset($_POST["fileopener"])) {
                                                        $_SESSION["file"] = $_POST["file"] ?>
                                                        <script>window.location.href = "pdfdisplayer.php"</script>
                                                    <?php }
                                                    if ($at === "Psychosocial Support") {
                                                        $doctype = array(
                                                            "Required" => [
                                                                "Barangay Indigency",
                                                                "Valid ID",
                                                                "Marriage Certificate",
                                                                "Birth Certificate",
                                                                "Referral Letter",
                                                            ],
                                                            "Optional" => [
                                                                "Medical Report",
                                                                "Psychological Report",
                                                                "Police Report",
                                                                "Legal Report",
                                                                "Disaster Certificate",
                                                                "Emergency Certificate"
                                                            ]
                                                        );
                                                        for ($i = 0; $i < count($doctype["Required"]); $i++) {
                                                            $doclist = $doctype["Required"][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <b class="text-danger"
                                                                        style="font-size: .8em;">Required</b></td>
                                                                <?php
                                                                $sql = $pdo->prepare("SELECT Status, File_ID, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = :userid AND Document_type = :doctype");
                                                                $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                                                                $sql->bindParam(":doctype", $doclist, PDO::PARAM_STR);
                                                                $sql->execute();
                                                                $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                $status = (isset($row["Status"])) ? htmlspecialchars($row["Status"], ENT_QUOTES, 'UTF-8') : "";
                                                                $reason = (isset($row["ReasonFR"])) ? htmlspecialchars($row["ReasonFR"], ENT_QUOTES, 'UTF-8') : "";
                                                                $fileid = (isset($row["File_ID"])) ? $row["File_ID"] : ""; ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($status) && $status === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php if (empty($fileid) == false) { ?>
                                                                        <div class="d-flex">
                                                                            <form class="d-flex me-2" method="POST"
                                                                                enctype="multipart/form-data">
                                                                                <div>
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <input type="hidden" name="fileid"
                                                                                    value="<?php echo $fileid ?>">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="editRequirements">Edit</button>
                                                                            </form>
                                                                            <?php
                                                                            $sql = $pdo->prepare("SELECT File_Name FROM file_tbl where File_ID = :fileid AND is_deleted = '0'");
                                                                            $sql->bindParam(":fileid", $fileid, PDO::PARAM_INT);
                                                                            $sql->execute();
                                                                            $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                            $file = (isset($row["File_Name"])) ? htmlspecialchars($row["File_Name"], ENT_QUOTES, 'UTF-8') : ""; ?>
                                                                            <div>
                                                                                <form class="me-2" method="POST">
                                                                                    <input type="hidden" value="<?php echo $file ?>"
                                                                                        name="file">
                                                                                    <button class="btn btn-primary shadow" type="submit"
                                                                                        style="height: 2.3em; width: 6em;"
                                                                                        name="fileopener">Open File</button>
                                                                                </form>
                                                                            </div>
                                                                            <?php if (isset($status) && $status === "Rejected") { ?>
                                                                                <div>
                                                                                    <div class="form-floating">
                                                                                        <textarea class="form-control"
                                                                                            placeholder="State your reason here"
                                                                                            id="floatingTextarea" style="height: 10em"
                                                                                            name="reason" disabled readonly
                                                                                            required><?php echo $reason ?></textarea>
                                                                                        <label for="floatingTextarea">Reason</label>
                                                                                    </div>
                                                                                </div><?php }
                                                                            ?>

                                                                        </div>
                                                                        <?php
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <input type="hidden" name="importance" value="Required">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="uploadRequirements">Upload</button>
                                                                            </div>
                                                                        </form>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        for ($i = 0; $i < count($doctype["Optional"]); $i++) {
                                                            $doclist = $doctype["Optional"][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <i
                                                                        class="text-secondary" style="font-size: .8em;">Optional</i>
                                                                </td>
                                                                <?php
                                                                $sql = $pdo->prepare("SELECT Status, File_ID, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = :userid AND Document_type = :doctype");
                                                                $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                                                                $sql->bindParam(":doctype", $doclist, PDO::PARAM_STR);
                                                                $sql->execute();
                                                                $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                $status = (isset($row["Status"])) ? htmlspecialchars($row["Status"], ENT_QUOTES, 'UTF-8') : "";
                                                                $reason = (isset($row["ReasonFR"])) ? htmlspecialchars($row["ReasonFR"], ENT_QUOTES, 'UTF-8') : "";
                                                                $fileid = (isset($row["File_ID"])) ? $row["File_ID"] : ""; ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($status) && $status === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php if (empty($fileid) == false) { ?>
                                                                        <div class="d-flex">
                                                                            <form class="d-flex me-2" method="POST"
                                                                                enctype="multipart/form-data">
                                                                                <div>
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf">
                                                                                </div>
                                                                                <input type="hidden" name="fileid"
                                                                                    value="<?php echo $fileid ?>">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="editRequirements">Edit</button>
                                                                            </form>
                                                                            <?php
                                                                            $sql = $pdo->prepare("SELECT File_Name FROM file_tbl where File_ID = :fileid AND is_deleted = '0'");
                                                                            $sql->bindParam(":fileid", $fileid, PDO::PARAM_INT);
                                                                            $sql->execute();
                                                                            $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                            $file = (isset($row["File_Name"])) ? htmlspecialchars($row["File_Name"], ENT_QUOTES, 'UTF-8') : ""; ?>
                                                                            <div>
                                                                                <form class="me-2" method="POST">
                                                                                    <input type="hidden" value="<?php echo $file ?>"
                                                                                        name="file">
                                                                                    <button class="btn btn-primary shadow" type="submit"
                                                                                        style="height: 2.3em; width: 6em;"
                                                                                        name="fileopener">Open File</button>
                                                                                </form>
                                                                            </div>
                                                                            <?php if (isset($status) && $status === "Rejected") { ?>
                                                                                <div>
                                                                                    <div class="form-floating">
                                                                                        <textarea class="form-control"
                                                                                            placeholder="State your reason here"
                                                                                            id="floatingTextarea" style="height: 10em"
                                                                                            name="reason" disabled
                                                                                            readonly><?php echo $reason ?></textarea>
                                                                                        <label for="floatingTextarea">Reason</label>
                                                                                    </div>
                                                                                </div><?php }
                                                                            ?>

                                                                        </div>
                                                                        <?php
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf">
                                                                                </div>
                                                                                <input type="hidden" name="importance" value="Optional">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="uploadRequirements">Upload</button>
                                                                            </div>
                                                                        </form>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } elseif ($at === "Transportation Assistance") {
                                                        $doctype = array(
                                                            "Required" => [
                                                                "Barangay Indigency",
                                                                "Medical Certificate Referral",
                                                                "Death Certificate",
                                                                "Medical Report",
                                                                "Police Report",
                                                                "Representative Valid ID",
                                                                "Valid ID",
                                                                "Marriage Certificate",
                                                                "Birth Certificate"
                                                            ]
                                                        );
                                                        for ($i = 0; $i < count($doctype["Required"]); $i++) {
                                                            $doclist = $doctype["Required"][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <b class="text-danger"
                                                                        style="font-size: .8em;">Required</b></td>
                                                                <?php
                                                                $sql = $pdo->prepare("SELECT Status, File_ID, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = :userid AND Document_type = :doctype");
                                                                $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                                                                $sql->bindParam(":doctype", $doclist, PDO::PARAM_STR);
                                                                $sql->execute();
                                                                $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                $status = (isset($row["Status"])) ? htmlspecialchars($row["Status"], ENT_QUOTES, 'UTF-8') : "";
                                                                $reason = (isset($row["ReasonFR"])) ? htmlspecialchars($row["ReasonFR"], ENT_QUOTES, 'UTF-8') : "";
                                                                $fileid = (isset($row["File_ID"])) ? $row["File_ID"] : ""; ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($status) && $status === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php if (empty($fileid) == false) { ?>
                                                                        <div class="d-flex">
                                                                            <form class="d-flex me-2" method="POST"
                                                                                enctype="multipart/form-data">
                                                                                <div>
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <input type="hidden" name="fileid"
                                                                                    value="<?php echo $fileid ?>">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="editRequirements">Edit</button>
                                                                            </form>
                                                                            <?php
                                                                            $sql = $pdo->prepare("SELECT File_Name FROM file_tbl where File_ID = :fileid AND is_deleted = '0'");
                                                                            $sql->bindParam(":fileid", $fileid, PDO::PARAM_INT);
                                                                            $sql->execute();
                                                                            $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                            $file = (isset($row["File_Name"])) ? htmlspecialchars($row["File_Name"], ENT_QUOTES, 'UTF-8') : ""; ?>
                                                                            <div>
                                                                                <form class="me-2" method="POST">
                                                                                    <input type="hidden" value="<?php echo $file ?>"
                                                                                        name="file">
                                                                                    <button class="btn btn-primary shadow" type="submit"
                                                                                        style="height: 2.3em; width: 6em;"
                                                                                        name="fileopener">Open File</button>
                                                                                </form>
                                                                            </div>
                                                                            <?php if (isset($status) && $status === "Rejected") { ?>
                                                                                <div>
                                                                                    <div class="form-floating">
                                                                                        <textarea class="form-control"
                                                                                            placeholder="State your reason here"
                                                                                            id="floatingTextarea" style="height: 10em"
                                                                                            name="reason" disabled readonly
                                                                                            required><?php echo $reason ?></textarea>
                                                                                        <label for="floatingTextarea">Reason</label>
                                                                                    </div>
                                                                                </div><?php }
                                                                            ?>

                                                                        </div>
                                                                        <?php
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <input type="hidden" name="importance" value="Required">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="uploadRequirements">Upload</button>
                                                                            </div>
                                                                        </form>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } elseif ($at === "Medical Assistance") {
                                                        $doctype = array(
                                                            "Required" => [
                                                                "Barangay Indigency",
                                                                "Medical Certificate",
                                                                "Clinical Abstract",
                                                                "Hospital Billing Statement",
                                                                "Pharmacy Quotation",
                                                                "Laboratory Request",
                                                                "Diagnostic Request",
                                                                "Official Receipts",
                                                                "Outstanding Payer Certificate",
                                                                "Representative Valid ID",
                                                                "Authorization Letter",
                                                                "Valid ID",
                                                                "Marriage Certificate",
                                                                "Birth Certificate"
                                                            ]
                                                        );
                                                        for ($i = 0; $i < count($doctype["Required"]); $i++) {
                                                            $doclist = $doctype["Required"][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <b class="text-danger"
                                                                        style="font-size: .8em;">Required</b></td>
                                                                <?php
                                                                $sql = $pdo->prepare("SELECT Status, File_ID, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = :userid AND Document_type = :doctype");
                                                                $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                                                                $sql->bindParam(":doctype", $doclist, PDO::PARAM_STR);
                                                                $sql->execute();
                                                                $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                $status = (isset($row["Status"])) ? htmlspecialchars($row["Status"], ENT_QUOTES, 'UTF-8') : "";
                                                                $reason = (isset($row["ReasonFR"])) ? htmlspecialchars($row["ReasonFR"], ENT_QUOTES, 'UTF-8') : "";
                                                                $fileid = (isset($row["File_ID"])) ? $row["File_ID"] : ""; ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($status) && $status === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php if (empty($fileid) == false) { ?>
                                                                        <div class="d-flex">
                                                                            <form class="d-flex me-2" method="POST"
                                                                                enctype="multipart/form-data">
                                                                                <div>
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <input type="hidden" name="fileid"
                                                                                    value="<?php echo $fileid ?>">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="editRequirements">Edit</button>
                                                                            </form>
                                                                            <?php
                                                                            $sql = $pdo->prepare("SELECT File_Name FROM file_tbl where File_ID = :fileid AND is_deleted = '0'");
                                                                            $sql->bindParam(":fileid", $fileid, PDO::PARAM_INT);
                                                                            $sql->execute();
                                                                            $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                            $file = (isset($row["File_Name"])) ? htmlspecialchars($row["File_Name"], ENT_QUOTES, 'UTF-8') : ""; ?>
                                                                            <div>
                                                                                <form class="me-2" method="POST">
                                                                                    <input type="hidden" value="<?php echo $file ?>"
                                                                                        name="file">
                                                                                    <button class="btn btn-primary shadow" type="submit"
                                                                                        style="height: 2.3em; width: 6em;"
                                                                                        name="fileopener">Open File</button>
                                                                                </form>
                                                                            </div>
                                                                            <?php if (isset($status) && $status === "Rejected") { ?>
                                                                                <div>
                                                                                    <div class="form-floating">
                                                                                        <textarea class="form-control"
                                                                                            placeholder="State your reason here"
                                                                                            id="floatingTextarea" style="height: 10em"
                                                                                            name="reason" disabled readonly
                                                                                            required><?php echo $reason ?></textarea>
                                                                                        <label for="floatingTextarea">Reason</label>
                                                                                    </div>
                                                                                </div><?php }
                                                                            ?>

                                                                        </div>
                                                                        <?php
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <input type="hidden" name="importance" value="Required">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="uploadRequirements">Upload</button>
                                                                            </div>
                                                                        </form>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } elseif ($at === "Burial Assistance") {
                                                        $doctype = array(
                                                            "Required" => [
                                                                "Barangay Indigency",
                                                                "Death Certificate",
                                                                "Funeral Contract",
                                                                "official Receipts",
                                                                "Representative Valid ID",
                                                                "Valid ID",
                                                                "Marriage Certificate",
                                                                "Birth Certificate",
                                                                "Marriage Contract",
                                                                "Authorization Letter",
                                                                "Outstanding Payer Certificate"
                                                            ]
                                                        );
                                                        for ($i = 0; $i < count($doctype["Required"]); $i++) {
                                                            $doclist = $doctype["Required"][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <b class="text-danger"
                                                                        style="font-size: .8em;">Required</b></td>
                                                                <?php
                                                                $sql = $pdo->prepare("SELECT Status, File_ID, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = :userid AND Document_type = :doctype");
                                                                $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                                                                $sql->bindParam(":doctype", $doclist, PDO::PARAM_STR);
                                                                $sql->execute();
                                                                $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                $status = (isset($row["Status"])) ? htmlspecialchars($row["Status"], ENT_QUOTES, 'UTF-8') : "";
                                                                $reason = (isset($row["ReasonFR"])) ? htmlspecialchars($row["ReasonFR"], ENT_QUOTES, 'UTF-8') : "";
                                                                $fileid = (isset($row["File_ID"])) ? $row["File_ID"] : ""; ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($status) && $status === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php if (empty($fileid) == false) { ?>
                                                                        <div class="d-flex">
                                                                            <form class="d-flex me-2" method="POST"
                                                                                enctype="multipart/form-data">
                                                                                <div>
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <input type="hidden" name="fileid"
                                                                                    value="<?php echo $fileid ?>">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="editRequirements">Edit</button>
                                                                            </form>
                                                                            <?php
                                                                            $sql = $pdo->prepare("SELECT File_Name FROM file_tbl where File_ID = :fileid AND is_deleted = '0'");
                                                                            $sql->bindParam(":fileid", $fileid, PDO::PARAM_INT);
                                                                            $sql->execute();
                                                                            $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                            $file = (isset($row["File_Name"])) ? htmlspecialchars($row["File_Name"], ENT_QUOTES, 'UTF-8') : ""; ?>
                                                                            <div>
                                                                                <form class="me-2" method="POST">
                                                                                    <input type="hidden" value="<?php echo $file ?>"
                                                                                        name="file">
                                                                                    <button class="btn btn-primary shadow" type="submit"
                                                                                        style="height: 2.3em; width: 6em;"
                                                                                        name="fileopener">Open File</button>
                                                                                </form>
                                                                            </div>
                                                                            <?php if (isset($status) && $status === "Rejected") { ?>
                                                                                <div>
                                                                                    <div class="form-floating">
                                                                                        <textarea class="form-control"
                                                                                            placeholder="State your reason here"
                                                                                            id="floatingTextarea" style="height: 10em"
                                                                                            name="reason" disabled readonly
                                                                                            required><?php echo $reason ?></textarea>
                                                                                        <label for="floatingTextarea">Reason</label>
                                                                                    </div>
                                                                                </div><?php }
                                                                            ?>

                                                                        </div>
                                                                        <?php
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <input type="hidden" name="importance" value="Required">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="uploadRequirements">Upload</button>
                                                                            </div>
                                                                        </form>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } elseif ($at === "Educational Assistance") {
                                                        $doctype = array(
                                                            "Required" => [
                                                                "Barangay Indigency",
                                                                "Enrollment Assessment From",
                                                                "Certificate of Enrollment",
                                                                "School ID",
                                                                "Grades",
                                                                "Police Report",
                                                                "Social Worker's Assessment"
                                                            ],
                                                            "Optional" => [
                                                                "Medical Certificate"
                                                            ]
                                                        );
                                                        for ($i = 0; $i < count($doctype["Required"]); $i++) {
                                                            $doclist = $doctype["Required"][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <b class="text-danger"
                                                                        style="font-size: .8em;">Required</b></td>
                                                                <?php
                                                                $sql = $pdo->prepare("SELECT Status, File_ID, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = :userid AND Document_type = :doctype");
                                                                $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                                                                $sql->bindParam(":doctype", $doclist, PDO::PARAM_STR);
                                                                $sql->execute();
                                                                $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                $status = (isset($row["Status"])) ? htmlspecialchars($row["Status"], ENT_QUOTES, 'UTF-8') : "";
                                                                $reason = (isset($row["ReasonFR"])) ? htmlspecialchars($row["ReasonFR"], ENT_QUOTES, 'UTF-8') : "";
                                                                $fileid = (isset($row["File_ID"])) ? $row["File_ID"] : ""; ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($status) && $status === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php if (empty($fileid) == false) { ?>
                                                                        <div class="d-flex">
                                                                            <form class="d-flex me-2" method="POST"
                                                                                enctype="multipart/form-data">
                                                                                <div>
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <input type="hidden" name="fileid"
                                                                                    value="<?php echo $fileid ?>">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="editRequirements">Edit</button>
                                                                            </form>
                                                                            <?php
                                                                            $sql = $pdo->prepare("SELECT File_Name FROM file_tbl where File_ID = :fileid AND is_deleted = '0'");
                                                                            $sql->bindParam(":fileid", $fileid, PDO::PARAM_INT);
                                                                            $sql->execute();
                                                                            $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                            $file = (isset($row["File_Name"])) ? htmlspecialchars($row["File_Name"], ENT_QUOTES, 'UTF-8') : ""; ?>
                                                                            <div>
                                                                                <form class="me-2" method="POST">
                                                                                    <input type="hidden" value="<?php echo $file ?>"
                                                                                        name="file">
                                                                                    <button class="btn btn-primary shadow" type="submit"
                                                                                        style="height: 2.3em; width: 6em;"
                                                                                        name="fileopener">Open File</button>
                                                                                </form>
                                                                            </div>
                                                                            <?php if (isset($status) && $status === "Rejected") { ?>
                                                                                <div>
                                                                                    <div class="form-floating">
                                                                                        <textarea class="form-control"
                                                                                            placeholder="State your reason here"
                                                                                            id="floatingTextarea" style="height: 10em"
                                                                                            name="reason" disabled readonly
                                                                                            required><?php echo $reason ?></textarea>
                                                                                        <label for="floatingTextarea">Reason</label>
                                                                                    </div>
                                                                                </div><?php }
                                                                            ?>

                                                                        </div>
                                                                        <?php
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <input type="hidden" name="importance" value="Required">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="uploadRequirements">Upload</button>
                                                                            </div>
                                                                        </form>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        for ($i = 0; $i < count($doctype["Optional"]); $i++) {
                                                            $doclist = $doctype["Optional"][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <i
                                                                        class="text-secondary" style="font-size: .8em;">Optional</i>
                                                                </td>
                                                                <?php
                                                                $sql = $pdo->prepare("SELECT Status, File_ID, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = :userid AND Document_type = :doctype");
                                                                $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                                                                $sql->bindParam(":doctype", $doclist, PDO::PARAM_STR);
                                                                $sql->execute();
                                                                $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                $status = (isset($row["Status"])) ? htmlspecialchars($row["Status"], ENT_QUOTES, 'UTF-8') : "";
                                                                $reason = (isset($row["ReasonFR"])) ? htmlspecialchars($row["ReasonFR"], ENT_QUOTES, 'UTF-8') : "";
                                                                $fileid = (isset($row["File_ID"])) ? $row["File_ID"] : ""; ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($status) && $status === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php if (empty($fileid) == false) { ?>
                                                                        <div class="d-flex">
                                                                            <form class="d-flex me-2" method="POST"
                                                                                enctype="multipart/form-data">
                                                                                <div>
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf">
                                                                                </div>
                                                                                <input type="hidden" name="fileid"
                                                                                    value="<?php echo $fileid ?>">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="editRequirements">Edit</button>
                                                                            </form>
                                                                            <?php
                                                                            $sql = $pdo->prepare("SELECT File_Name FROM file_tbl where File_ID = :fileid AND is_deleted = '0'");
                                                                            $sql->bindParam(":fileid", $fileid, PDO::PARAM_INT);
                                                                            $sql->execute();
                                                                            $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                            $file = (isset($row["File_Name"])) ? htmlspecialchars($row["File_Name"], ENT_QUOTES, 'UTF-8') : ""; ?>
                                                                            <div>
                                                                                <form class="me-2" method="POST">
                                                                                    <input type="hidden" value="<?php echo $file ?>"
                                                                                        name="file">
                                                                                    <button class="btn btn-primary shadow" type="submit"
                                                                                        style="height: 2.3em; width: 6em;"
                                                                                        name="fileopener">Open File</button>
                                                                                </form>
                                                                            </div>
                                                                            <?php if (isset($status) && $status === "Rejected") { ?>
                                                                                <div>
                                                                                    <div class="form-floating">
                                                                                        <textarea class="form-control"
                                                                                            placeholder="State your reason here"
                                                                                            id="floatingTextarea" style="height: 10em"
                                                                                            name="reason" disabled
                                                                                            readonly><?php echo $reason ?></textarea>
                                                                                        <label for="floatingTextarea">Reason</label>
                                                                                    </div>
                                                                                </div><?php }
                                                                            ?>

                                                                        </div>
                                                                        <?php
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf">
                                                                                </div>
                                                                                <input type="hidden" name="importance" value="Optional">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="uploadRequirements">Upload</button>
                                                                            </div>
                                                                        </form>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } elseif ($at === "Food Assistance") {
                                                        $doctype = array(
                                                            "Required" => [
                                                                "Barangay Indigency",
                                                                "Valid ID",
                                                                "Marriage Certificate",
                                                                "Birth Certificate"
                                                            ],
                                                            "Optional" => [
                                                                "Disaster Certificate",
                                                                "Medical Certificate",
                                                                "Medical Referral"
                                                            ]
                                                        );
                                                        for ($i = 0; $i < count($doctype["Required"]); $i++) {
                                                            $doclist = $doctype["Required"][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <b class="text-danger"
                                                                        style="font-size: .8em;">Required</b></td>
                                                                <?php
                                                                $sql = $pdo->prepare("SELECT Status, File_ID, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = :userid AND Document_type = :doctype");
                                                                $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                                                                $sql->bindParam(":doctype", $doclist, PDO::PARAM_STR);
                                                                $sql->execute();
                                                                $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                $status = (isset($row["Status"])) ? htmlspecialchars($row["Status"], ENT_QUOTES, 'UTF-8') : "";
                                                                $reason = (isset($row["ReasonFR"])) ? htmlspecialchars($row["ReasonFR"], ENT_QUOTES, 'UTF-8') : "";
                                                                $fileid = (isset($row["File_ID"])) ? $row["File_ID"] : ""; ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($status) && $status === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php if (empty($fileid) == false) { ?>
                                                                        <div class="d-flex">
                                                                            <form class="d-flex me-2" method="POST"
                                                                                enctype="multipart/form-data">
                                                                                <div>
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <input type="hidden" name="fileid"
                                                                                    value="<?php echo $fileid ?>">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="editRequirements">Edit</button>
                                                                            </form>
                                                                            <?php
                                                                            $sql = $pdo->prepare("SELECT File_Name FROM file_tbl where File_ID = :fileid AND is_deleted = '0'");
                                                                            $sql->bindParam(":fileid", $fileid, PDO::PARAM_INT);
                                                                            $sql->execute();
                                                                            $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                            $file = (isset($row["File_Name"])) ? htmlspecialchars($row["File_Name"], ENT_QUOTES, 'UTF-8') : ""; ?>
                                                                            <div>
                                                                                <form class="me-2" method="POST">
                                                                                    <input type="hidden" value="<?php echo $file ?>"
                                                                                        name="file">
                                                                                    <button class="btn btn-primary shadow" type="submit"
                                                                                        style="height: 2.3em; width: 6em;"
                                                                                        name="fileopener">Open File</button>
                                                                                </form>
                                                                            </div>
                                                                            <?php if (isset($status) && $status === "Rejected") { ?>
                                                                                <div>
                                                                                    <div class="form-floating">
                                                                                        <textarea class="form-control"
                                                                                            placeholder="State your reason here"
                                                                                            id="floatingTextarea" style="height: 10em"
                                                                                            name="reason" disabled readonly
                                                                                            required><?php echo $reason ?></textarea>
                                                                                        <label for="floatingTextarea">Reason</label>
                                                                                    </div>
                                                                                </div><?php }
                                                                            ?>

                                                                        </div>
                                                                        <?php
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <input type="hidden" name="importance" value="Required">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="uploadRequirements">Upload</button>
                                                                            </div>
                                                                        </form>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        for ($i = 0; $i < count($doctype["Optional"]); $i++) {
                                                            $doclist = $doctype["Optional"][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <i
                                                                        class="text-secondary" style="font-size: .8em;">Optional</i>
                                                                </td>
                                                                <?php
                                                                $sql = $pdo->prepare("SELECT Status, File_ID, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = :userid AND Document_type = :doctype");
                                                                $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                                                                $sql->bindParam(":doctype", $doclist, PDO::PARAM_STR);
                                                                $sql->execute();
                                                                $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                $status = (isset($row["Status"])) ? htmlspecialchars($row["Status"], ENT_QUOTES, 'UTF-8') : "";
                                                                $reason = (isset($row["ReasonFR"])) ? htmlspecialchars($row["ReasonFR"], ENT_QUOTES, 'UTF-8') : "";
                                                                $fileid = (isset($row["File_ID"])) ? $row["File_ID"] : ""; ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($status) && $status === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php if (empty($fileid) == false) { ?>
                                                                        <div class="d-flex">
                                                                            <form class="d-flex me-2" method="POST"
                                                                                enctype="multipart/form-data">
                                                                                <div>
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf">
                                                                                </div>
                                                                                <input type="hidden" name="fileid"
                                                                                    value="<?php echo $fileid ?>">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="editRequirements">Edit</button>
                                                                            </form>
                                                                            <?php
                                                                            $sql = $pdo->prepare("SELECT File_Name FROM file_tbl where File_ID = :fileid AND is_deleted = '0'");
                                                                            $sql->bindParam(":fileid", $fileid, PDO::PARAM_INT);
                                                                            $sql->execute();
                                                                            $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                            $file = (isset($row["File_Name"])) ? htmlspecialchars($row["File_Name"], ENT_QUOTES, 'UTF-8') : ""; ?>
                                                                            <div>
                                                                                <form class="me-2" method="POST">
                                                                                    <input type="hidden" value="<?php echo $file ?>"
                                                                                        name="file">
                                                                                    <button class="btn btn-primary shadow" type="submit"
                                                                                        style="height: 2.3em; width: 6em;"
                                                                                        name="fileopener">Open File</button>
                                                                                </form>
                                                                            </div>
                                                                            <?php if (isset($status) && $status === "Rejected") { ?>
                                                                                <div>
                                                                                    <div class="form-floating">
                                                                                        <textarea class="form-control"
                                                                                            placeholder="State your reason here"
                                                                                            id="floatingTextarea" style="height: 10em"
                                                                                            name="reason" disabled
                                                                                            readonly><?php echo $reason ?></textarea>
                                                                                        <label for="floatingTextarea">Reason</label>
                                                                                    </div>
                                                                                </div><?php }
                                                                            ?>

                                                                        </div>
                                                                        <?php
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf">
                                                                                </div>
                                                                                <input type="hidden" name="importance" value="Optional">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="uploadRequirements">Upload</button>
                                                                            </div>
                                                                        </form>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } elseif ($at === "Cash Relief Assistance") {
                                                        $doctype = array(
                                                            "Required" => [
                                                                "Barangay Indigency",
                                                                "Valid ID",
                                                                "Marriage Certificate",
                                                                "Birth Certificate",
                                                                "Incident Report",
                                                            ],
                                                            "Optional" => [
                                                                "Medical Certificate",
                                                                "Medical Referral"
                                                            ]
                                                        );
                                                        for ($i = 0; $i < count($doctype["Required"]); $i++) {
                                                            $doclist = $doctype["Required"][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <b class="text-danger"
                                                                        style="font-size: .8em;">Required</b></td>
                                                                <?php
                                                                $sql = $pdo->prepare("SELECT Status, File_ID, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = :userid AND Document_type = :doctype");
                                                                $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                                                                $sql->bindParam(":doctype", $doclist, PDO::PARAM_STR);
                                                                $sql->execute();
                                                                $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                $status = (isset($row["Status"])) ? htmlspecialchars($row["Status"], ENT_QUOTES, 'UTF-8') : "";
                                                                $reason = (isset($row["ReasonFR"])) ? htmlspecialchars($row["ReasonFR"], ENT_QUOTES, 'UTF-8') : "";
                                                                $fileid = (isset($row["File_ID"])) ? $row["File_ID"] : ""; ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($status) && $status === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php if (empty($fileid) == false) { ?>
                                                                        <div class="d-flex">
                                                                            <form class="d-flex me-2" method="POST"
                                                                                enctype="multipart/form-data">
                                                                                <div>
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <input type="hidden" name="fileid"
                                                                                    value="<?php echo $fileid ?>">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="editRequirements">Edit</button>
                                                                            </form>
                                                                            <?php
                                                                            $sql = $pdo->prepare("SELECT File_Name FROM file_tbl where File_ID = :fileid AND is_deleted = '0'");
                                                                            $sql->bindParam(":fileid", $fileid, PDO::PARAM_INT);
                                                                            $sql->execute();
                                                                            $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                            $file = (isset($row["File_Name"])) ? htmlspecialchars($row["File_Name"], ENT_QUOTES, 'UTF-8') : ""; ?>
                                                                            <div>
                                                                                <form class="me-2" method="POST">
                                                                                    <input type="hidden" value="<?php echo $file ?>"
                                                                                        name="file">
                                                                                    <button class="btn btn-primary shadow" type="submit"
                                                                                        style="height: 2.3em; width: 6em;"
                                                                                        name="fileopener">Open File</button>
                                                                                </form>
                                                                            </div>
                                                                            <?php if (isset($status) && $status === "Rejected") { ?>
                                                                                <div>
                                                                                    <div class="form-floating">
                                                                                        <textarea class="form-control"
                                                                                            placeholder="State your reason here"
                                                                                            id="floatingTextarea" style="height: 10em"
                                                                                            name="reason" disabled readonly
                                                                                            required><?php echo $reason ?></textarea>
                                                                                        <label for="floatingTextarea">Reason</label>
                                                                                    </div>
                                                                                </div><?php }
                                                                            ?>

                                                                        </div>
                                                                        <?php
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf" required>
                                                                                </div>
                                                                                <input type="hidden" name="importance" value="Required">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="uploadRequirements">Upload</button>
                                                                            </div>
                                                                        </form>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        for ($i = 0; $i < count($doctype["Optional"]); $i++) {
                                                            $doclist = $doctype["Optional"][$i];
                                                            ?>
                                                            <tr>
                                                                <td class="text-start"><?php echo $doclist ?> <i
                                                                        class="text-secondary" style="font-size: .8em;">Optional</i>
                                                                </td>
                                                                <?php
                                                                $sql = $pdo->prepare("SELECT Status, File_ID, ReasonFR
                                                                        FROM requirements_tbl
                                                                        where User_ID = :userid AND Document_type = :doctype");
                                                                $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                                                                $sql->bindParam(":doctype", $doclist, PDO::PARAM_STR);
                                                                $sql->execute();
                                                                $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                $status = (isset($row["Status"])) ? htmlspecialchars($row["Status"], ENT_QUOTES, 'UTF-8') : "";
                                                                $reason = (isset($row["ReasonFR"])) ? htmlspecialchars($row["ReasonFR"], ENT_QUOTES, 'UTF-8') : "";
                                                                $fileid = (isset($row["File_ID"])) ? $row["File_ID"] : ""; ?>
                                                                <td class="text-center">
                                                                    <?php if (isset($status) && $status === "Validated") { ?>
                                                                        <img src="img/validated.png" alt="Validated" title="Validated"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Unvalidated") { ?>
                                                                        <img src="img/unvalidated.png" alt="Unvalidated"
                                                                            title="Unvalidated" style="width: 1.5em; height: 1.5em;">
                                                                    <?php } elseif (isset($status) && $status === "Rejected") { ?>
                                                                        <img src="img/reject.png" alt="Rejected" title="Rejected"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } else { ?>
                                                                        <img src="img/missing.png" alt="Missing" title="Missing"
                                                                            style="width: 1.5em; height: 1.5em;">
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php if (empty($fileid) == false) { ?>
                                                                        <div class="d-flex">
                                                                            <form class="d-flex me-2" method="POST"
                                                                                enctype="multipart/form-data">
                                                                                <div>
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf">
                                                                                </div>
                                                                                <input type="hidden" name="fileid"
                                                                                    value="<?php echo $fileid ?>">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="editRequirements">Edit</button>
                                                                            </form>
                                                                            <?php
                                                                            $sql = $pdo->prepare("SELECT File_Name FROM file_tbl where File_ID = :fileid AND is_deleted = '0'");
                                                                            $sql->bindParam(":fileid", $fileid, PDO::PARAM_INT);
                                                                            $sql->execute();
                                                                            $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                                            $file = (isset($row["File_Name"])) ? htmlspecialchars($row["File_Name"], ENT_QUOTES, 'UTF-8') : ""; ?>
                                                                            <div>
                                                                                <form class="me-2" method="POST">
                                                                                    <input type="hidden" value="<?php echo $file ?>"
                                                                                        name="file">
                                                                                    <button class="btn btn-primary shadow" type="submit"
                                                                                        style="height: 2.3em; width: 6em;"
                                                                                        name="fileopener">Open File</button>
                                                                                </form>
                                                                            </div>
                                                                            <?php if (isset($status) && $status === "Rejected") { ?>
                                                                                <div>
                                                                                    <div class="form-floating">
                                                                                        <textarea class="form-control"
                                                                                            placeholder="State your reason here"
                                                                                            id="floatingTextarea" style="height: 10em"
                                                                                            name="reason" disabled
                                                                                            readonly><?php echo $reason ?></textarea>
                                                                                        <label for="floatingTextarea">Reason</label>
                                                                                    </div>
                                                                                </div><?php }
                                                                            ?>

                                                                        </div>
                                                                        <?php
                                                                } else { ?>
                                                                        <form method="POST" enctype="multipart/form-data">
                                                                            <div class="d-flex">
                                                                                <div class="mb-3">
                                                                                    <input class="form-control" type="file"
                                                                                        id="formFile" name="file"
                                                                                        accept="application/pdf">
                                                                                </div>
                                                                                <input type="hidden" name="importance" value="Optional">
                                                                                <input type="hidden" name="docname"
                                                                                    value="<?php echo $doclist ?>">
                                                                                <button class="btn btn-primary shadow ms-2"
                                                                                    type="submit" style="height: 2.3em;"
                                                                                    name="uploadRequirements">Upload</button>
                                                                            </div>
                                                                        </form>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        if (isset($_POST["editRequirements"])) {
                            $fileid = $_POST["fileid"];

                            try {
                                $pdo->beginTransaction();

                                $sql = $pdo->prepare("SELECT Requirements_ID FROM requirements_tbl WHERE File_ID = :fileid");
                                $sql->bindParam(":fileid", $fileid, PDO::PARAM_INT);
                                $sql->execute();
                                $row = $sql->fetch(PDO::FETCH_ASSOC);

                                $reqid = $row['Requirements_ID'];

                                $sql = $pdo->prepare("SELECT File_Name FROM file_tbl WHERE File_ID = :fileid");
                                $sql->bindParam(":fileid", $fileid, PDO::PARAM_INT);
                                $sql->execute();
                                $row = $sql->fetch(PDO::FETCH_ASSOC);

                                if ($row) {
                                    $oldfile = $row["File_Name"];
                                    $oldlocation = "file/" . $oldfile;
                                    $deletedfilename = $fileid . "_deleted_" . $oldfile;
                                    $newlocation = "file/deletedfile/" . $deletedfilename;
                                    rename($oldlocation, $newlocation);

                                    $sql = $pdo->prepare("UPDATE file_tbl
                                                                SET File_Name = :deletedfile,
                                                                    is_deleted = '1'
                                                                WHERE File_ID = :fileid AND User_ID = :userid");
                                    $sql->bindParam(":deletedfile", $deletedfilename, PDO::PARAM_STR);
                                    $sql->bindParam(":fileid", $fileid, PDO::PARAM_INT);
                                    $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                                    $sql->execute();

                                    $doc = str_replace(" ", "_", $_POST["docname"]);
                                    $file = $_FILES["file"]["name"];
                                    $fileSize = $_FILES["file"]["size"];
                                    $tmpName = $_FILES["file"]["tmp_name"];
                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                    $maxFileSize = 5 * 1024 * 1024;

                                    if ($fileSize > $maxFileSize) {
                                        $pdo->rollBack();
                                        ?>
                                        <script>
                                            alert("File is too large. Maximum size allowed is 5MB.");
                                            window.location.href = "profile.php";
                                        </script>
                                        <?php
                                        exit();
                                    }

                                    $fileType = mime_content_type($tmpName);
                                    if ($fileType !== "application/pdf") {
                                        $pdo->rollBack();
                                        ?>
                                        <script>
                                            alert("Invalid file type. Only PDF files are allowed.");
                                            window.location.href = "profile.php";
                                        </script>
                                        <?php
                                        exit();
                                    }

                                    $newFileName = $userid . "_" . $doc . "." . $extension;
                                    $uploadDir = "file/";
                                    $filePath = $uploadDir . $newFileName;

                                    if (move_uploaded_file($tmpName, $filePath)) {
                                        $sql = $pdo->prepare("INSERT INTO file_tbl (User_ID, File_Name) VALUES (:userid, :filename)");
                                        $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                                        $sql->bindParam(":filename", $newFileName, PDO::PARAM_STR);

                                        if ($sql->execute()) {
                                            $newfileid = $pdo->lastInsertId();

                                            $sql = $pdo->prepare("UPDATE requirements_tbl
                                                                        SET File_ID = :fileid,
                                                                        Status = 'Unvalidated',
                                                                        ReasonFR = ''
                                                                        where Requirements_ID = :reqid");
                                            $sql->bindParam(":fileid", $newfileid, PDO::PARAM_INT);
                                            $sql->bindParam(":reqid", $reqid, PDO::PARAM_INT);

                                            if ($sql->execute()) {

                                                $pdo->commit();
                                                ?>
                                                <script>
                                                    alert("File Updated Successfully.");
                                                    window.location.href = "profile.php";
                                                </script>
                                                <?php
                                            } else {
                                                $pdo->rollBack();
                                                ?>
                                                <script>
                                                    alert("Error Updating Requirements.");
                                                    window.location.href = "profile.php";
                                                </script>
                                                <?php
                                            }
                                        } else {
                                            $pdo->rollBack();
                                            ?>
                                            <script>
                                                alert("Error Updating File.");
                                                window.location.href = "profile.php";
                                            </script>
                                            <?php
                                            exit();
                                        }
                                    } else {
                                        $pdo->rollBack();
                                        ?>
                                        <script>
                                            alert("Error moving the uploaded file.");
                                            window.location.href = "profile.php";
                                        </script>
                                        <?php
                                        exit();
                                    }
                                } else {
                                    $pdo->rollBack();
                                    ?>
                                    <script>
                                        alert("Old file not found.");
                                        window.location.href = "profile.php";
                                    </script>
                                    <?php
                                    exit();
                                }

                            } catch (PDOException $e) {
                                $pdo->rollBack();
                                ?>
                                <script>
                                    alert("Error: <?php echo $e->getMessage() ?>");
                                    window.location.href = "profile.php";
                                </script>
                                <?php
                                exit();
                            }
                            $sql = null;
                        }
                        if (isset($_POST["uploadRequirements"])) {
                            $importance = $_POST["importance"];
                            $documenttype = $_POST["docname"];
                            $doc = str_replace(" ", "_", $_POST["docname"]);
                            $file = $_FILES["file"]["name"];
                            $fileSize = $_FILES["file"]["size"];
                            $tmpName = $_FILES["file"]["tmp_name"];
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                            $newFileName = $userid . "_" . $doc . "." . $extension;
                            $uploadDir = "file/";
                            $filePath = $uploadDir . $newFileName;

                            $maxFileSize = 5 * 1024 * 1024;
                            if ($fileSize > $maxFileSize) {
                                ?>
                                <script>
                                    alert("File is too large. Maximum size allowed is 5MB.")
                                    window.location.href = "profile.php"
                                </script>
                                <?php
                            } else {

                                $fileType = mime_content_type($tmpName);
                                if ($fileType !== "application/pdf") {
                                    ?>
                                    <script>
                                        alert("Invalid file type. Only PDF files are allowed.")
                                        window.location.href = "profile.php"
                                    </script>
                                    <?php
                                } else {

                                    try {
                                        $pdo->beginTransaction();
                                        $sql = $pdo->prepare("INSERT INTO file_tbl (User_ID, File_Name) VALUES (:userid, :filename)");
                                        $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                                        $sql->bindParam(":filename", $newFileName, PDO::PARAM_STR);
                                        $sql->execute();

                                        if (move_uploaded_file($tmpName, $filePath)) {
                                            $fileid = $pdo->lastInsertId();

                                            $sql = $pdo->prepare("INSERT INTO requirements_tbl (User_ID, Document_Type, File_ID, Importance)
                                    VALUES (:userid, :doctype, :fileid, :importance)");
                                            $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                                            $sql->bindParam(":doctype", $documenttype, PDO::PARAM_STR);
                                            $sql->bindParam(":fileid", $fileid, PDO::PARAM_INT);
                                            $sql->bindParam(":importance", $importance, PDO::PARAM_STR);

                                            if ($sql->execute()) {
                                                $pdo->commit();
                                                ?>
                                                <script>alert("Files Uploaded Successfully.")
                                                    window.location.href = "profile.php"
                                                </script><?php
                                            } else { ?>
                                                <script>alert("Error in upon sending in Database.")
                                                    window.location.href = "profile.php"
                                                </script>
                                            <?php }
                                        } else { ?>
                                            <script>alert("Error in Moving File.")
                                                window.location.href = "profile.php"
                                            </script>
                                        <?php }
                                    } catch (PDOException $e) {
                                        $pdo->rollBack()
                                            ?>
                                        <script>
                                            alert("Error Uploading File: <?php echo $e->getMessage() ?>")
                                            window.location.href = "profile.php"
                                        </script>
                                        <?php
                                    }
                                }
                            }
                            $sql = null;
                        } ?>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div
                class="col-8 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5 m-5">
                <h1 class="mb-4" id="pending">Pending Applications</h1>
                <table class="table table-striped border shadow rounded">
                    <tr>
                        <th scope="col">Assistance Type</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Date Submitted</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $sql = $pdo->prepare("SELECT Application_ID, Assistance_Type, Status, Date_Submitted 
                                FROM application_tbl 
                                where User_ID = :userid 
                                AND is_deleted = 0 
                                AND status = 'Pending'");
                        $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                        $sql->execute();
                        $data = $sql->fetchAll();
                        foreach ($data as $row) {
                            $appid = htmlspecialchars($row["Application_ID"], ENT_QUOTES, 'UTF-8');
                            $assType = htmlspecialchars($row["Assistance_Type"], ENT_QUOTES, 'UTF-8');
                            $status = htmlspecialchars($row["Status"], ENT_QUOTES, 'UTF-8');
                            $dateSub = htmlspecialchars($row["Date_Submitted"], ENT_QUOTES, 'UTF-8');
                            ?>
                            <tr>
                                <th class="align-middle"><?php echo $assType ?></th>
                                <th class="text-center text-warning align-middle"><?php echo $status ?></th>
                                <th class="text-center align-middle"><?php echo $dateSub ?></th>
                                <th class="d-flex">
                                    <form method="POST">
                                        <button type="submit" name="editForm" class="btn btn-primary me-1">Edit</button>
                                    </form>
                                    <?php if (isset($_POST["editForm"])) {
                                        $_SESSION["appid"] = $appid;
                                        $_SESSION["assistancetype"] = $assType;
                                        $_SESSION["goback"] = "profile.php#pending";
                                        ?>
                                        <script>window.location.href = "applicationeditor.php"</script><?php
                                    } ?>
                                    <form method="POST">
                                        <button type="submit" name="deleteForm" class="btn btn-danger">Delete</button>
                                    </form>
                                    <?php if (isset($_POST["deleteForm"])) {

                                        $sql = $pdo->prepare("UPDATE application_tbl
                                                SET is_deleted = 1
                                                where Application_ID = :appid");
                                        $sql->bindParam(":appid", $appid, PDO::PARAM_INT);
                                        $sql->execute();
                                        $pdo->commit();
                                        ?>
                                        <script>alert("Application has been removed.")
                                            window.location.href = "profile.php"
                                        </script>
                                        <?php
                                    } ?>
                                </th>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div
                class="col-8 d-flex flex-column justify-content-center align-items-center border rounded shadow p-5 m-5">
                <h1 class="mb-4" id="history">Applications History</h1>
                <table class="table table-striped border shadow rounded">
                    <tr>
                        <th class="text-center" scope="col">Assistance Type</th>
                        <th class="text-center" scope="col">Status</th>
                        <th scope="col">Reason</th>
                        <th class="text-center" scope="col">Date Reviewed</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $sql = $pdo->prepare("SELECT Assistance_Type, Status, Date_ApporRej, ReasonFR
                                FROM application_tbl
                                where User_ID = :userid
                                AND is_deleted = '0' 
                                AND NOT Status = 'Pending'");
                        $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                        $sql->execute();
                        $data = $sql->fetchAll();
                        foreach ($data as $row) {
                            $assType = htmlspecialchars($row["Assistance_Type"], ENT_QUOTES, 'UTF-8');
                            $status = htmlspecialchars($row["Status"], ENT_QUOTES, 'UTF-8');
                            $dateAoR = htmlspecialchars($row["Date_ApporRej"], ENT_QUOTES, 'UTF-8');
                            $reason = htmlspecialchars($row["ReasonFR"], ENT_QUOTES, 'UTF-8');
                            ?>
                            <tr>
                                <th class="text-center"><?php echo $assType ?></th>
                                <?php if ($status == "Approved") { ?>
                                    <th class="text-center text-success"><?php echo $status ?></th>
                                <?php } else { ?>
                                    <th class="text-center text-danger"><?php echo $status ?></th>
                                <?php } ?>
                                <th><?php echo (empty($reason)) ? "This Application Has Been Approved" : $reason ?>
                                </th>
                                <th class="text-center"><?php echo $dateAoR ?></th>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>