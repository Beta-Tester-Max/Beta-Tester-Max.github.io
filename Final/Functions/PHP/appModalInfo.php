<?php
if (isset($_SESSION['pA']) && !empty($_SESSION['pA'])) {
    foreach ($_SESSION['pA'] as $p) {
        $aid = $p['Application_ID'] ?? "";
        $a = $p['Account_ID'] ?? "";
        $family = $_SESSION['pA_fN' . $a] ?? "";
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
        ?>
        <div class="modal fade" id="accountInfo_<?php echo $aid ?>" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="accountlabel_<?php echo $aid ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-admin text-light">
                    <div class="modal-header p-0">
                        <div class="row ps-3 py-3 pe-2" style="width: 100%;">
                            <div class="col-10">
                                <h3 class="modal-title fs-5" id="accountlabel_<?php echo $aid ?>"><b><?php echo $family ?>
                                        Family</b></h3>
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
                            <h3 class="section-title">Family Members</h3>
                            <ul class="application-list">
                                <?php
                                foreach ($_SESSION['pA_fC' . $a] as $fc) {
                                    $u = $fc['User_ID'] ?? "";
                                    $uI = $_SESSION['pA_fM' . $u] ?? "";
                                    $fn = $uI['First_Name'] ?? "";
                                    $mn = $uI['Middle_Name'] ?? "";
                                    $ln = $uI['Last_Name'] ?? "";
                                    if (!empty($mn)) {
                                        $fullname = $fn . '&nbsp;' . $mn . '&nbsp;' . $ln;
                                    } else {
                                        $fullname = $fn . '&nbsp;' . $ln;
                                    }
                                    $email = $uI['Email'] ?? "";
                                    $pn = $uI['Phone_Number'] ?? "";
                                    $bd = $uI['Birth_Day'] ?? "";
                                    $sx = $uI['Sex'] ?? "";
                                    $cs = $uI['Civil_Status'] ?? "";
                                    $ea = $uI['Educational_Attainment'] ?? "";
                                    $oc = $uI['Occupation'] ?? "";
                                    $isD = intval($uI['is_deceased']) ?? "";
                                    ?>
                                    <li class="application-item">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <b>Name:</b>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <?php echo (!empty($fullname)) ? $fullname : "Missing Name"?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <b>Email:</b>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <?php echo (!empty($email)) ? $email : "N/A"?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <b>Phone Number:</b>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <?php echo (!empty($pn)) ? $pn : "N/A"?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <b>Birthday:</b>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <?php echo (!empty($bd)) ? $bd : "Missing Birthday"?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <b>Sex:</b>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <?php
                                                    if ($sx === 'm') {
                                                        echo "Male";
                                                    } elseif ($sx === 'f') {
                                                        echo "Female";
                                                    } else {
                                                        echo "Missing Sex";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <b>Civil Status:</b>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <?php echo (!empty($cs)) ? $cs : "Missing Civil Status"?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <b>Educational Attainment:</b>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <?php echo (!empty($ea)) ? $ea : "N/A"?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <b>Occupation:</b>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <?php echo (!empty($oc)) ? $oc : "N/A"?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <b>Life Status:</b>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="application-name">
                                                    <?php
                                                    if ($isD === 1) {
                                                        echo "Alive";
                                                    } elseif ($isD === 0) {
                                                        echo "Deceased";
                                                    } else {
                                                        echo "Missing Life Status";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer p-0">
                        <div class="row p-2">
                            <button type="button" class="application-action" style="background-color:rgb(7, 234, 255);"
                                data-bs-target="#application_<?php echo $aid ?>" data-bs-toggle="modal">Go Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>