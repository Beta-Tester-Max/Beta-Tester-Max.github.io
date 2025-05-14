<?php
if (isset($_SESSION['Assistance'])) {
    $aTT = array();
    $aT = array();
    foreach ($_SESSION['Assistance'] as $a) {
        $an = $a['Assistance_Name'] ?? "";
        $aid = $a['Assistance_ID'] ?? "";
        ?>
        <p class="text-center d-none" id="aTableTitle<?php echo $aid; ?>"><b><?php echo $an; ?></b></p>


        <table class="table table-bordered table-striped-column d-none" id="aTable<?php echo $aid; ?>">
            <thead>
                <tr>
                    <th scope="col">Document Description</th>
                    <th class="text-center" scope="col">Importance</th>
                    <th class="text-center" scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION['Requirements' . $aid]) && !empty($_SESSION['Requirements' . $aid])) {
                    foreach ($_SESSION['Requirements' . $aid] as $r) {
                        $d = $r['Document_ID'] ?? "";
                        $desc = $r['Description'] ?? "";
                        $i = $r['Importance'] ?? "";

                        ?>
                        <tr>
                            <td class="align-middle"><?php echo $desc; ?></td>
                            <td class="text-center align-middle"><?php echo $i; ?></td>
                            <?php
                            if (isset($_SESSION['accountRequirements' . $d]) && !empty($_SESSION['accountRequirements' . $d])) {
                                foreach ($_SESSION['accountRequirements' . $d] as $ar) {
                                    $arf = $ar['File_ID'] ?? "";
                                    $ars = $ar['Status'] ?? "";
                                    $ard = $ar['Document_ID'] ?? "";
                                    $arid = $ar['Account_Requirement_ID'] ?? "";
                                    $arr = $ar['ReasonFR'] ?? "";
                                    ?>
                                    <td class="text-center align-middle"><?php echo $ars; ?></td>
                                    <td class="text-center align-middle">
                                        <?php
                                        if ($ars === 'Validated') {
                                            ?>
                                            <p class="text-secondary"><i>No Action Needed</i></p>
                                            <?php
                                        } else {
                                            ?>
                                            <form method="POST" enctype="multipart/form-data" action="Functions/PHP/editRequirement.php">
                                                <input type="file" id="formFile" name="file" accept="application/pdf" required>
                                                <input type="hidden" name="arid" value="<?php echo $arid ?>" required>
                                                <input type="hidden" name="fid" value="<?php echo $arf ?>" required>
                                                <input type="hidden" name="document" value="<?php echo $ard ?>" required>
                                                <input type="hidden" name="editRequirement" required>
                                                <button type="submit">Edit</button>
                                            </form>
                                            <?php
                                            if ($ars === 'Rejected') {
                                                ?>
                                                <hr>
                                                <p><b>Reason: </b><?php echo $arr ?></p>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </td>
                                <?php }
                            } else { ?>
                                <td class="text-center align-middle">Missing</td>
                                <td>
                                    <form method="POST" enctype="multipart/form-data" action="Functions/PHP/uploadRequirement.php">
                                        <input type="file" id="formFile" name="file" accept="application/pdf" required>
                                        <input type="hidden" name="document" value="<?php echo $d ?>" required>
                                        <input type="hidden" name="uploadRequirement" required>
                                        <button type="submit">Upload</button>
                                    </form>
                                </td>
                            <?php } ?>
                        </tr>

                    <?php }
                } else {
                    echo "<p>No requirements found for this assistance.</p>";
                } ?>
            </tbody>
        </table>
        <?php
        $aTT[] = "aTableTitle" . $aid;
        $aT[] = "aTable" . $aid;
    }
    $_SESSION['assistanceTitles'] = $aTT;
    $_SESSION['assistanceTables'] = $aT;
}
?>