<?php
if (isset($_SESSION['hA']) && !empty($_SESSION['hA'])) {
    foreach ($_SESSION['hA'] as $p) {
        $aid = $p['Application_ID'] ?? "";
        $a = $p['Account_ID'] ?? "";
        $n = $_SESSION['hA_name' . $aid] ?? "";
        $assistance = $_SESSION['hA_as' . $aid] ?? "";
        $fn = $n['First_Name'] ?? "";
        $mn = $n['Middle_Name'] ?? "";
        $ln = $n['Last_Name'] ?? "";
        if (!empty($mn)) {
            $fullname = $fn . '&nbsp;' . $mn . '&nbsp;' . $ln;
        } else {
            $fullname = $fn . '&nbsp;' . $ln;
        }
        $ad = $_SESSION['hA_add' . $aid] ?? "";
        $address = $ad['House_Number'] . "&nbsp;" . $ad['Street_Name'] . "&nbsp;" . $ad['Barangay'] . "&nbsp;" . $ad['City_or_Municipality'] . ", " . $ad['Province'];
        $ds = $p['Date_Submitted'] ?? "";
        $reason = $p['Reason'] ?? "";
        $sv = $p['Severity'] ?? "";
        $severity = $_SESSION['hA_sv' . $sv] ?? "";
        $files = explode(", ", $p['Files']) ?? "";
        $st = $p['Status'] ?? "";
        $rb = $_SESSION['hA_rB' . $aid] ?? "";
        $dr = $p['Date_Reviewed'] ?? "";
        ?>
        <div class="modal fade" id="application_<?php echo $aid ?>" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="label_<?php echo $aid ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content bg-admin text-light">
                    <div class="modal-header p-0">
                        <div class="row ps-3 py-3 pe-2" style="width: 100%;">
                            <div class="col-10">
                                <h3 class="modal-title fs-5" id="label_<?php echo $aid ?>"><b><?php echo $fullname ?></b></h3>
                                <p style="font-size: 12px;"><?php echo $address ?></p>
                            </div>
                            <div class="col d-flex justify-content-end p-0 mt-2">
                                <button type="button" class="bg-light rounded-circle btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="applications-column">
                            <h3 class="section-title">Review Details</h3>
                            <ul class="application-list">
                                <li class="application-item">
                                    <div class="application-">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <b>Status:</b>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <?php
                                                    if ($st === 'Approved') {
                                                        ?>
                                                        <p class="text-success"><?php echo $st ?></p>
                                                        <?php
                                                    } elseif ($st === 'Rejected') {
                                                        ?>
                                                        <p class="text-danger"><?php echo $st ?></p>
                                                        <?php
                                                    } else {
                                                        echo "Missing Status";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <b>Reviewed By:</b>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <?php echo $rb ?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <b>Date Reviewed:</b>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <?php echo (!empty($dr)) ? $dr : "Missing Date" ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <hr>
                        <h4><b>Date Submitted</b></h4>
                        <p><?php echo $ds ?></p>
                        <hr>
                        <h4><b>Reason</b></h4>
                        <p><?php echo $reason ?></p>
                        <hr>
                        <h4><b>Severity</b></h4>
                        <p><?php echo $severity ?></p>
                        <hr>
                        <div class="applications-column">
                            <h3 class="section-title">Uploaded Documents</h3>
                            <ul class="application-list">
                                <?php
                                for ($i = 0; $i < count($files); ++$i) {
                                    $file = $_SESSION['file' . $i . $aid];
                                    $desc = $_SESSION['desc' . $i . $aid];
                                    ?>
                                    <li class="application-item">
                                        <div class="application-name me-1">
                                            <?php echo $desc ?>
                                        </div>
                                        <form method="POST" target="_blank" action="../Functions/PHP/fileOpener.php">
                                            <input type="hidden" value="<?php echo $file ?>" name="file">
                                            <input type="hidden" name="fileOpen">
                                            <button type="submit" class="application-action">Open</button>
                                        </form>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <form method="POST" action="../Functions/PHP/appData.php">
                        <div class="modal-footer p-0">
                            <div class="row pt-2 px-2" style="width: 100%;">
                                <button type="button" class="application-action" style="width: 100%;"
                                    data-bs-target="#accountInfo_hA<?php echo $aid ?>" data-bs-toggle="modal">View
                                    Information</button>
                            </div>
                            <input type="hidden" value="<?php echo $aid ?>" name="id">
                            <div class="row pb-2 px-2" style="width: 100%;">
                                <input type="hidden" name="createCaseStudy">
                                <button type="submit" class="btn btn-info csBtn"
                                    style="width: 100%; height: 28px; font-size: 12px;">Create Case
                                    Study</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
}
?>