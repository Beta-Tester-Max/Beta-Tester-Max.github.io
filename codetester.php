<div class="col-6">
                                    <div class="row">
                                        <label class="mt-3 mb-1 d-flex justify-content-center align-items-center"><b>Choose
                                                file to Submit:</b></label>
                                        <div class="col-6">
                                            <div class="mt-3">
                                                <label class="mb-1 text-danger" for="file01"><b>Required</b></label>
                                                <select class="form-select" id="file01" name="file01" required>
                                                    <?php if (empty($req1)) { ?>
                                                        <option value="">Select a Document Type</option>
                                                    <?php } else {
                                                        $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req1'";
                                                        $result = mysqli_query($conn, $sql);
                                                        $row = mysqli_fetch_assoc($result);
                                                        ?>
                                                        <option value="<?php echo $req1 ?>">
                                                            <?php echo $row['Document_Type'] ?>
                                                        </option>
                                                    <?php }
                                                    $documenttype = "Barangay Indigency";
                                                    $sql = "SELECT File_ID
                                                    FROM requirements_tbl 
                                                    where User_ID = '$userid' 
                                                    AND Document_Type = '$documenttype' AND Status = 'Validated'
                                                    AND NOT File_ID = '$req1'";
                                                    $result = mysqli_query($conn, $sql);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        ?>
                                                        <option value="<?php echo $row['File_ID']; ?>">
                                                            <?php echo $documenttype ?>
                                                        </option><?php
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                                <label class="mb-1 text-danger" for="file02"><b>Required</b></label>
                                                <select class="form-select" id="file02" name="file02" required>
                                                    <?php if (empty($req2)) { ?>
                                                        <option value="">Select a Document Type</option>
                                                    <?php } else {
                                                        $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req2'";
                                                        $result = mysqli_query($conn, $sql);
                                                        $row = mysqli_fetch_assoc($result);
                                                        ?>
                                                        <option value="<?php echo $req2 ?>">
                                                            <?php echo $row['Document_Type'] ?>
                                                        </option>
                                                    <?php }
                                                    if ($assistancetype === "Medical Assistance" || $assistancetype === "Educational Assistance") {
                                                        $documenttype1 = ($assistancetype === "Medical Assistance") ? "Medical Certificate" : "Enrollment Assessment Form";
                                                        $documenttype2 = ($assistancetype === "Medical Assistance") ? "Clinical Abstact" : "Certificate of Enrollment";
                                                        $sql = "SELECT Document_Type, File_ID
                                                                FROM requirements_tbl 
                                                                where User_ID = '$userid' 
                                                                AND Status = 'Validated'
                                                                AND (Document_Type = '$documenttype1' OR Document_Type = '$documenttype2')
                                                                AND NOT File_ID = '$req2'";
                                                        $result = mysqli_query($conn, $sql);
                                                    } else {
                                                        switch ($documenttype) {
                                                            case "Transportation Assistance":
                                                                $documenttype = "Medical Certificate Referral";
                                                                break;
                                                            case "Burial Assistance":
                                                                $documenttype = "Death Certificate";
                                                                break;
                                                            default:
                                                                $documenttype = "Valid ID";
                                                        }
                                                        $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' 
                                                            AND Document_Type = '$documenttype' AND Status = 'Validated'
                                                            AND NOT File_ID = '$req2'";
                                                        $result = mysqli_query($conn, $sql);
                                                    }
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        ?>
                                                        <option value="<?php echo $row['File_ID'] ?>">
                                                            <?php echo $row['Document_Type'] ?>
                                                        </option><?php
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                                <label class="mb-1 text-danger" for="file03"><b>Required</b></label>
                                                <select class="form-select" id="file03" name="file03" required>
                                                    <?php if (empty($req3)) { ?>
                                                        <option value="">Select a Document Type</option>
                                                    <?php } else {
                                                        $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req3'";
                                                        $result = mysqli_query($conn, $sql);
                                                        $row = mysqli_fetch_assoc($result);
                                                        ?>
                                                        <option value="<?php echo $req3 ?>">
                                                            <?php echo $row['Document_Type'] ?>
                                                        </option>
                                                    <?php }
                                                    if ($assistancetype === "Medical Assistance" || $assistancetype === "Burial Assistance" || $assistancetype === "Educational Assistance") {
                                                        switch ($assistancetype) {
                                                            case "Medical Assistance":
                                                                $documenttype = "Hospital Billing Statement";
                                                                break;
                                                            case "Burial Assistance":
                                                                $documenttype = "Funeral Contract";
                                                                break;
                                                            case "Educational Assistance":
                                                                $documenttype = "School ID";
                                                                break;
                                                        }
                                                        $sql = "SELECT Document_Type, File_ID
                                                                FROM requirements_tbl 
                                                                where User_ID = '$userid' AND Status = 'Validated'
                                                                AND Document_Type = '$documenttype'
                                                                AND NOT File_ID = '$req3'";
                                                        $result = mysqli_query($conn, $sql);
                                                    } else {
                                                        if ($assistancetype === "Transportation Assistance") {
                                                            $documenttype1 = "Death Certificate";
                                                            $documenttype2 = "Medical Report";
                                                        } else {
                                                            $documenttype1 = "Birth Certificate";
                                                            $documenttype2 = "Marriage Certificate";
                                                        }
                                                        $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND (Document_Type = '$documenttype1' OR Document_Type = '$documenttype2')
                                                            AND NOT File_ID = '$req3'";
                                                        $result = mysqli_query($conn, $sql);
                                                    }
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        ?>
                                                        <option value="<?php echo $row['File_ID'] ?>">
                                                            <?php echo $row['Document_Type'] ?>
                                                        </option><?php
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                                <?php if ($assistancetype === "Food Assistance") { ?>
                                                    <label class="mb-1 text-secondary"
                                                        for="file04"><i>(Optional)</i></label>
                                                    <select class="form-select" id="file04" name="file04">
                                                    <?php } else { ?>
                                                        <label class="mb-1 text-danger" for="file04"><b>Required</b></label>
                                                        <select class="form-select" id="file04" name="file04" required>
                                                        <?php } ?>
                                                        <?php if (empty($req4)) { ?>
                                                            <option value="">Select a Document Type</option>
                                                        <?php } else {
                                                            $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req4'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_assoc($result);
                                                            ?>
                                                            <option value="<?php echo $req4 ?>">
                                                                <?php echo $row['Document_Type'] ?>
                                                            </option>
                                                        <?php }
                                                        switch ($assistancetype) {
                                                            case "Transportation Assistance":
                                                                $documenttype = "Police Report";
                                                                break;
                                                            case "Medical Assistance":
                                                                $documenttype = "Pharmacy Quotation";
                                                                break;
                                                            case "Burial Assistance":
                                                                $documenttype = "Official Receipts";
                                                                break;
                                                            case "Educational Assistance":
                                                                $documenttype = "Grades";
                                                                break;
                                                            case "Food Assistance":
                                                                $documenttype = "Disaster Certificate";
                                                                break;
                                                            case "Cash Relief Assistance":
                                                                $documenttype = "Incident Report";
                                                                break;
                                                            case "Psychosocial Support":
                                                                $documenttype = "Referral Letter";
                                                                ;
                                                                break;
                                                        }
                                                        $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' 
                                                            AND Document_Type = '$documenttype' AND Status = 'Validated'
                                                            AND NOT File_ID = '$req4'";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <option value="<?php echo $row['File_ID'] ?>">
                                                                <?php echo $row['Document_Type'] ?>
                                                            </option><?php
                                                        } ?>
                                                    </select>
                                            </div>
                                            <div class="mt-3">
                                                <?php if ($assistancetype === "Transportation Assistance" || $assistancetype === "Medical Assistance" || $assistancetype === "Burial Assistance") { ?>
                                                    <label class="mb-1 text-danger" for="file05"><b>Required</b></label>
                                                    <select class="form-select" id="file05" name="file05" required>
                                                    <?php } else { ?>
                                                        <label class="mb-1 text-secondary"
                                                            for="file05"><i>(Optional)</i></label>
                                                        <select class="form-select" id="file05" name="file05">
                                                        <?php } ?>
                                                        <?php if (empty($req5)) { ?>
                                                            <option value="">Select a Document Type</option>
                                                        <?php } else {
                                                            $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req5'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_assoc($result);
                                                            ?>
                                                            <option value="<?php echo $req5 ?>">
                                                                <?php echo $row['Document_Type'] ?>
                                                            </option>
                                                        <?php }
                                                        if ($assistancetype === "Transportation Assistance" || $assistancetype === "Burial Assistance" || $assistancetype === "Educational Assistance") {
                                                            $documenttype = ($assistancetype === "Educational Assistance") ? "Medical Certificate" : "Representative Valid ID";
                                                            $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' 
                                                            AND Document_Type = '$documenttype' AND Status = 'Validated'
                                                            AND NOT File_ID = '$req5'";
                                                            $result = mysqli_query($conn, $sql);
                                                        } else {
                                                            if ($assistancetype === "Medical Assistance") {
                                                                $documenttype1 = "Laboratory Request";
                                                                $documenttype2 = "Diagnostic Request";
                                                            } elseif ($assistancetype === "Psychosocial Support") {
                                                                $documenttype1 = "Medical Report";
                                                                $documenttype2 = "Psychological Report";
                                                            } else {
                                                                $documenttype1 = "Medical Certificate";
                                                                $documenttype2 = "Medical Referral";
                                                            }
                                                            $sql = "SELECT Document_Type, File_ID
                                                    FROM requirements_tbl 
                                                    where User_ID = '$userid' AND Status = 'Validated' 
                                                    AND (Document_Type = '$documenttype1' OR Document_Type = '$documenttype2')
                                                    AND NOT File_ID = '$req5'";
                                                            $result = mysqli_query($conn, $sql);
                                                        }
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <option value="<?php echo $row['File_ID'] ?>">
                                                                <?php echo $row['Document_Type'] ?>
                                                            </option><?php
                                                        } ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <?php if ($assistancetype === "Food Assistance" || $assistancetype === "Cash Relief Assistance") {
                                            } else { ?>
                                                <div class="mt-3">
                                                    <?php if ($assistancetype === "Psychosocial Support") { ?>
                                                        <label class="mb-1 text-secondary"
                                                            for="file06"><i>(Optional)</i></label>
                                                        <select class="form-select" id="file06" name="file06">
                                                        <?php } else { ?>
                                                            <label class="mb-1 text-danger" for="file06"><b>Required</b></label>
                                                            <select class="form-select" id="file06" name="file06" required>
                                                            <?php } ?>
                                                            <?php if (empty($req6)) { ?>
                                                                <option value="">Select a Document Type</option>
                                                            <?php } else {
                                                                $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req6'";
                                                                $result = mysqli_query($conn, $sql);
                                                                $row = mysqli_fetch_assoc($result);
                                                                ?>
                                                                <option value="<?php echo $req6 ?>">
                                                                    <?php echo $row['Document_Type'] ?>
                                                                </option>
                                                            <?php }
                                                            if ($assistancetype === "Educational Assistance" || $assistancetype === "Psychosocial Support") {
                                                                $documenttype1 = "Police Report";
                                                                $documenttype2 = htmlspecialchars(($assistancetype === "Educational Assistance") ? "Social Worker's Assessment" : "Legal Report");
                                                                $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND (Document_Type = '$documenttype1' OR Document_Type = '$documenttype2')
                                                            AND NOT File_ID = '$req6'";
                                                                $result = mysqli_query($conn, $sql);
                                                            } else {
                                                                $documenttype = ($assistancetype === "Medical Assistance") ? "Official Receipts" : "Valid ID";
                                                                $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND Document_Type = '$documenttype'
                                                            AND NOT File_ID = '$req6'";
                                                                $result = mysqli_query($conn, $sql);
                                                            }
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                ?>
                                                                <option value="<?php echo $row['File_ID'] ?>">
                                                                    <?php echo $row['Document_Type'] ?>
                                                                </option><?php
                                                            } ?>
                                                        </select>
                                                </div>
                                            <?php } ?>
                                            <?php if ($assistancetype === "Transportation Assistance" || $assistancetype === "Medical Assistance" || $assistancetype === "Burial Assistance" || $assistancetype === "Psychosocial Support") { ?>
                                                <div class="mt-3">
                                                    <?php if ($assistancetype === "Psychosocial Support") { ?>
                                                        <label class="mb-1 text-secondary"
                                                            for="file07"><i>(Optional)</i></label>
                                                        <select class="form-select" id="file07" name="file07">
                                                        <?php } else { ?>
                                                            <label class="mb-1 text-danger" for="file07"><b>Required</b></label>
                                                            <select class="form-select" id="file07" name="file07" required>
                                                            <?php } ?>
                                                            <?php if (empty($req7)) { ?>
                                                                <option value="">Select a Document Type</option>
                                                            <?php } else {
                                                                $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req7'";
                                                                $result = mysqli_query($conn, $sql);
                                                                $row = mysqli_fetch_assoc($result);
                                                                ?>
                                                                <option value="<?php echo $req7 ?>">
                                                                    <?php echo $row['Document_Type'] ?>
                                                                </option>
                                                            <?php }
                                                            if ($assistancetype === "Medical Assistance") {
                                                                $documenttype = "Outstanding Payer Certificate";
                                                                $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND Document_Type = '$documenttype'
                                                            AND NOT File_ID = '$req7'";
                                                                $result = mysqli_query($conn, $sql);
                                                            } else {
                                                                if ($assistancetype === "Psychosocial Support") {
                                                                    $documenttype1 = "Disaster Certificate";
                                                                    $documenttype2 = "Emergency Certificate";
                                                                } else {
                                                                    $documenttype1 = "Birth Certificate";
                                                                    $documenttype2 = "Marriage Certificate";
                                                                }
                                                                $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND (Document_Type = '$documenttype1' OR Document_Type = '$documenttype2')
                                                            AND NOT File_ID = '$req7'";
                                                                $result = mysqli_query($conn, $sql);
                                                            }
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                ?>
                                                                <option value="<?php echo $row['File_ID'] ?>">
                                                                    <?php echo $row['Document_Type'] ?>
                                                                </option><?php
                                                            } ?>
                                                        </select>
                                                </div>
                                            <?php } ?>
                                            <?php if ($assistancetype === "Medical Assistance" || $assistancetype === "Burial Assistance") { ?>
                                                <div class="mt-3">
                                                    <label class="mb-1 text-danger" for="file08"><b>Required</b></label>
                                                    <select class="form-select" id="file08" name="file08" required>
                                                        <?php if (empty($req8)) { ?>
                                                            <option value="">Select a Document Type</option>
                                                        <?php } else {
                                                            $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req8'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_assoc($result);
                                                            ?>
                                                            <option value="<?php echo $req8 ?>">
                                                                <?php echo $row['Document_Type'] ?>
                                                            </option>
                                                        <?php }
                                                        $documenttype = ($assistancetype === "Medical Assistance") ? "Representative Valid ID" : "Marriage Contract";
                                                        $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND Document_Type = '$documenttype'
                                                            AND NOT File_ID = '$req8'";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <option value="<?php echo $row['File_ID'] ?>">
                                                                <?php echo $row['Document_Type'] ?>
                                                            </option><?php
                                                        } ?>
                                                    </select>
                                                </div>
                                            <?php } ?>
                                            <?php if ($assistancetype === "Medical Assistance" || $assistancetype === "Burial Assistance") { ?>
                                                <div class="mt-3">
                                                    <label class="mb-1 text-danger" for="file09"><b>Required</b></label>
                                                    <select class="form-select" id="file09" name="file09" required>
                                                        <?php if (empty($req9)) { ?>
                                                            <option value="">Select a Document Type</option>
                                                        <?php } else {
                                                            $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req9'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_assoc($result);
                                                            ?>
                                                            <option value="<?php echo $req9 ?>">
                                                                <?php echo $row['Document_Type'] ?>
                                                            </option>
                                                        <?php }
                                                        $documenttype = "Authorization Letter";
                                                        $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND Document_Type = '$documenttype'
                                                            AND NOT File_ID = '$req9'";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <option value="<?php echo $row['File_ID'] ?>">
                                                                <?php echo $row['Document_Type'] ?>
                                                            </option><?php
                                                        } ?>
                                                    </select>
                                                </div>
                                            <?php } ?>
                                            <?php if ($assistancetype === "Medical Assistance" || $assistancetype === "Burial Assistance") { ?>
                                                <div class="mt-3">
                                                    <label class="mb-1 text-danger" for="file10"><b>Required</b></label>
                                                    <select class="form-select" id="file10" name="file10" required>
                                                        <?php if (empty($req10)) { ?>
                                                            <option value="">Select a Document Type</option>
                                                        <?php } else {
                                                            $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req10'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_assoc($result);
                                                            ?>
                                                            <option value="<?php echo $req10 ?>">
                                                                <?php echo $row['Document_Type'] ?>
                                                            </option>
                                                        <?php }
                                                        $documenttype = ($assistancetype === "Medical Assistance") ? "Valid ID" : "Outstanding Payer Certificate";
                                                        $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND Document_Type = '$documenttype'
                                                            AND NOT File_ID = '$req10'";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <option value="<?php echo $row['File_ID'] ?>">
                                                                <?php echo $row['Document_Type'] ?>
                                                            </option><?php
                                                        } ?>
                                                    </select>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-8">
                                            <?php if ($assistancetype === "Medical Assistance") { ?>
                                                <div class="mt-3">
                                                    <label class="mb-1 text-danger" for="file11"><b>Required</b></label>
                                                    <select class="form-select" id="file11" name="file11" required>
                                                        <?php if (empty($req11)) { ?>
                                                            <option value="">Select a Document Type</option>
                                                        <?php } else {
                                                            $sql = "SELECT Document_Type FROM requirements_tbl where File_ID = '$req11'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $row = mysqli_fetch_assoc($result);
                                                            ?>
                                                            <option value="<?php echo $req11 ?>">
                                                                <?php echo $row['Document_Type'] ?>
                                                            </option>
                                                        <?php }
                                                        $documenttype1 = "Birth Certificate";
                                                        $documenttype2 = "Marriage Certificate";
                                                        $sql = "SELECT Document_Type, File_ID
                                                            FROM requirements_tbl 
                                                            where User_ID = '$userid' AND Status = 'Validated'
                                                            AND (Document_Type = '$documenttype1' OR Document_Type = '$documenttype2')
                                                            AND NOT File_ID = '$req11'";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <option value="<?php echo $row['File_ID'] ?>">
                                                                <?php echo $row['Document_Type'] ?>
                                                            </option><?php
                                                        } ?>
                                                    </select>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-2"></div>
                                    </div>
                                </div>