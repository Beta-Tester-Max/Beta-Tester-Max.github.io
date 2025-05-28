<?php
if (isset($_SESSION['pA']) && !empty($_SESSION['pA'])) {
    foreach ($_SESSION['pA'] as $p) {
        $aid = $p['Application_ID'] ?? "";
        $a = $p['Account_ID'] ?? "";
        $n = $_SESSION['pA_name' . $aid] ?? "";
        $assistance = $_SESSION['pA_as' . $aid] ?? "";
        $fn = $n['First_Name'] ?? "";
        $mn = $n['Middle_Name'] ?? "";
        $ln = $n['Last_Name'] ?? "";
        if (!empty($mn)) {
            $fullname = $fn . '&nbsp;' . $mn . '&nbsp;' . $ln;
        } else {
            $fullname = $fn . '&nbsp;' . $ln;
        }
        $ad = $_SESSION['pA_add' . $aid] ?? "";
        $address = $ad['House_Number'] . "&nbsp;" . $ad['Street_Name'] . "&nbsp;" . $ad['Barangay'] . "&nbsp;" . $ad['City_or_Municipality'] . ", " . $ad['Province'];
        $reason = $p['Reason'] ?? "";
        $files = explode(", ", $p['Files']) ?? "";
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
                        <h4><b>Reason</b></h4>
                        <p><?php echo $reason ?></p>
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
                    <div class="modal-footer p-0">
                        <div class="row pt-2 mb-2" style="width: 100%;">
                            <div class="col ps-2 pe-1">
                                <form method="POST" action="../Functions/PHP/review.php">
                                    <input type="hidden" value="<?php echo $aid ?>" name="appid">
                                    <input type="hidden" name="approve">
                                    <button type="submit" class="application-action"
                                        style="width: 100%; background-color:rgb(12, 228, 37);"><b>Approve</b></button>
                                </form>
                            </div>
                            <div class="col pe-2 ps-1">
                                <button class="application-action" style="width: 100%; background-color:rgb(238, 91, 91);"
                                    data-bs-target="#reject_<?php echo $aid ?>" data-bs-toggle="modal">Reject</button>
                            </div>
                        </div>
                        <div class="row pb-2 px-2" style="width: 100%;">
                            <button class="application-action" style="width: 100%;" data-bs-target="#accountInfo_<?php echo $aid ?>"
                                data-bs-toggle="modal">View Information</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>