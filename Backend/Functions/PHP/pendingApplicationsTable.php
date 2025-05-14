<?php
if (isset($_SESSION['pendingA'])) {
    $aT = array();
    foreach ($_SESSION['pendingA'] as $d) {
        $aF = array();
        $a = $d['Account_ID'] ?? "";
        $n = $_SESSION['pendingF' . $a]
            ?>
        <div class="d-none" id="aT<?php echo $a ?>">
            <div class="d-flex justify-content-center align-items-center mb-3">
                <p class="me-2 mt-3"><b><?php echo $n ?>'s Unvalidated Requirements</b></p>
                <button type="button" id="showAccountInformtation">View Information</button>
            </div>

            <table class="table table-striped-columns table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Assistance Type</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Files</th>
                        <th scope="col">Date Submitted</th>
                        <th class="text-center" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($_SESSION['pendingApp' . $a] as $p) {
                        $appid = $p['Application_ID'];
                        $as = $p['Assistance_ID'] ?? "";
                        $r = $p['Reason'] ?? "";
                        $an = $_SESSION['pAs' . $as] ?? "";
                        $ds = $p['Date_Submitted'] ?? "";
                        ?>
                        <td><?php echo $an ?></td>
                        <td><?php echo $r ?></td>
                        <td class="align-middle">
                            <?php
                            $aF = explode(", ", $p['Files']) ?? "";
                            for ($i = 0; $i < count($aF); ++$i) {
                                $f = $aF[$i] ?? "";
                                $d = $_SESSION['pD' . $f] ?? "";
                                $desc = $_SESSION['pDesc' . $d] ?? "";
                                $fn = $_SESSION['pFile' . $f] ?? "";
                                ?>
                                <div class="row mb-2">
                                    <div class="col">
                                        <p><?php echo $desc ?></p>
                                    </div>
                                    <div class="col">
                                        <form method="POST" target="_blank" action="../Functions/PHP/fileOpener.php">
                                            <input type="hidden" value="<?php echo $fn ?>" name="file" required>
                                            <input type="hidden" name="fileOpen" required>
                                            <button type="submit">Open File</button>
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                        <td><?php echo $ds ?></td>
                        <td>
                            <form class="m-1" method="POST" action="../Functions/PHP/validate.php">
                                <input type="hidden" value="<?php echo $r['Document_ID'] ?? "" ?>" name="document" required>
                                <input type="hidden" value="<?php echo $id ?>" name="id" required>
                                <input type="hidden" name="validate" required>
                                <button type="submit" class="me-1">Validate</button>
                            </form>
                            <form class="m-1" method="POST" action="../Functions/PHP/toReject.php">
                                <input type="hidden" value="applicationsApproval.php" name="from" required>
                                <input type="hidden" value="application" name="table" required>
                                <input type="hidden" value="<?php echo $as ?>" name="assistance" required>
                                <input type="hidden" value="<?php echo $appid ?>" name="id" required>
                                <input type="hidden" name="reject" required>
                                <button type="submit">Reject</button>
                            </form>
                        </td>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php
        $aT[] = 'aT' . $a;
    }
    $_SESSION['aT'] = $aT;
}
?>