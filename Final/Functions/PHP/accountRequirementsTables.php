<?php
if (isset($_SESSION['sD']) && !empty($_SESSION['sD'])) {
    $a = $d['a'] ?? "";
    $an = $d['an'] ?? "";
    ?>
    <p class="text-center fs-4"><b><?php echo $an ?></b></p>
    <table class="table table-dark table-striped-columns border border-dark">
        <thead>
            <tr class="table-active">
                <th scope="col">Document Description</th>
                <th class="text-center" scope="col">Importance</th>
                <th class="text-center" scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="table-light">
            <?php
            if (isset($_SESSION['Requirements' . $a]) && !empty($_SESSION['Requirements' . $a])) {
                $c = count($_SESSION['Requirements' . $a]) + 1;
                $tc = count($_SESSION['Requirements' . $a]);
                for ($n = 1; $n < $c; ++$n) {
                    $nc = $n - 1;
                    $r = $_SESSION['Requirements' . $a][$nc];
                    $d = $r['Document_ID'] ?? "";
                    $desc = $r['Description'] ?? "";
                    $i = $r['Importance'] ?? "";

                    ?>
                    <tr>
                        <td class="align-middle"><?php echo $desc ?></td>
                        <td class="text-center align-middle"><?php
                        if ($i === 'Required') {
                            ?>
                                <b class="text-danger">Required</b>
                                <?php
                        } else {
                            ?>
                                <i class="text-secondary">Optional</i>
                                <?php
                        }
                        ?>
                        </td>
                        <?php
                        if (isset($_SESSION['accountRequirements' . $d]) && !empty($_SESSION['accountRequirements' . $d])) {
                            foreach ($_SESSION['accountRequirements' . $d] as $ar) {
                                $arf = $ar['File_ID'] ?? "";
                                $ars = $ar['Status'] ?? "";
                                $ard = $ar['Document_ID'] ?? "";
                                $arid = $ar['Account_Requirement_ID'] ?? "";
                                $arr = $ar['ReasonFR'] ?? "";
                                ?>
                                <td class="text-center align-middle"><?php
                                if ($ars === 'Unvalidated') {
                                    ?>
                                        <img class="importance" src="assets/img/unvalidated.png" alt="unvalidated">
                                        <?php
                                } elseif ($ars === 'Validated') {
                                    ?>
                                        <img class="importance" src="assets/img/validated.png" alt="validated">
                                        <?php
                                } else {
                                    ?>
                                        <img class="importance" src="assets/img/missing.png" alt="missing">
                                        <?php
                                } ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    if ($ars === 'Validated') {
                                        ?>
                                        <i class="text-secondary">No Action Needed</i>
                                        <input type="hidden" name="appFile<?php echo $n ?>" value="<?php echo $arf ?>">
                                        <?php
                                    } else {
                                        ?>
                                        <div class="fileCon">
                                            <button type="button" class="btn btn-outline-dark file fakeFile mb-2">Choose File</button>
                                            <input class="form-control realFile d-none" type="file" name="file<?php echo $n ?>"
                                                accept="application/pdf">
                                            <p class="textFile m-0">No File Chosen</p>
                                        </div>
                                        <input type="hidden" name="arid<?php echo $n ?>" value="<?php echo $arid ?>">
                                        <input type="hidden" name="fid<?php echo $n ?>" value="<?php echo $arf ?>">
                                        <input type="hidden" name="document<?php echo $n ?>" value="<?php echo $ard ?>">
                                        </form>
                                        <?php
                                        if ($ars === 'Rejected') {
                                            ?>
                                            <hr>
                                            <b>Reason: </b><?php echo $arr ?>
                                            <?php
                                        }
                                    }
                                    ?>
                                </td>
                            <?php }
                        } else {
                            ?>
                            <td class="text-center align-middle"><img class="importance" src="assets/img/missing.png" alt="missing">
                            </td>
                            <td class="text-center align-middle">
                                <div class="fileCon">
                                    <button type="button" class="btn btn-outline-dark file fakeFile mb-2">Choose File</button>
                                    <input class="form-control realFile d-none" type="file" name="file<?php echo $n ?>"
                                        accept="application/pdf">
                                    <p class="textFile m-0">No File Chosen</p>
                                </div>
                                <input type="hidden" name="document<?php echo $n ?>" value="<?php echo $d ?>">
                            </td>
                        <?php } ?>
                    </tr>

                <?php }
            } else {
                echo "<p>No requirements found for this assistance.</p>";
            } ?>
        </tbody>
    </table>
    <input type="hidden" name="count" value="<?php echo $tc ?>">
    <?php
}
?>