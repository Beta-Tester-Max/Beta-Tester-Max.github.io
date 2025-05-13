<?php
if (isset($_SESSION['unvalidatedA'])) {
    $rT = array();
    foreach ($_SESSION['unvalidatedA'] as $a) {
        $id = $a['Account_ID'] ?? "";
        $n = $_SESSION['unvalidatedF' . $id] ?? "";
        ?>
        <div class="d-none" id="rT<?php echo $id ?>">
            <div class="d-flex justify-content-center align-items-center mb-3">
                <p class="me-2 mt-3"><b><?php echo $n ?>'s Unvalidated Requirements</b></p>
                <button type="button" id="showAccountInformtation">View Information</button>
            </div>

            <table class="table table-striped-columns table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Document Description</th>
                        <th scope="col">Document</th>
                        <th class="text-center" scope="col">Date Submitted</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($_SESSION['unvalidatedR' . $id])) {
                        foreach ($_SESSION['unvalidatedR' . $id] as $r) {
                            $d = $_SESSION['desc' . $r['Document_ID'] ?? ""] ?? "";
                            $f = $_SESSION['file' . $r['File_ID'] ?? ""] ?? "";
                            $t = $r['Date_Submitted'] ?? "";
                            ?>
                            <tr>
                                <td class="align-middle"><?php echo $d ?></td>
                                <td>
                                    <form method="POST" action="../Functions/PHP/fileOpener.php">
                                        <input type="hidden" value="<?php echo $f ?>" name="file" required>
                                        <input type="hidden" name="fileOpen" required>
                                        <button type="submit">Open File</button>
                                    </form>
                                </td>
                                <td class="align-middle text-center"><?php echo $t ?></td>
                                <td class="d-flex">
                                    <form method="POST" action="../Functions/PHP/validate.php">
                                        <input type="hidden" value="<?php echo $r['Document_ID'] ?? "" ?>" name="document" required>
                                        <input type="hidden" value="<?php echo $id ?>" name="id" required>
                                        <input type="hidden" name="validate" required>
                                        <button type="submit" class="me-1">Validate</button>
                                    </form>
                                    <form method="POST" action="../Functions/PHP/toReject.php">
                                        <input type="hidden" value="requirementsValidate.php" name="from" required>
                                        <input type="hidden" value="requirement" name="table" required>
                                        <input type="hidden" value="<?php echo $r['Document_ID'] ?? "" ?>" name="document" required>
                                        <input type="hidden" value="<?php echo $id ?>" name="id" required>
                                        <input type="hidden" name="reject" required>
                                        <button type="submit">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        <?php }
                    } else {
                        ?>
                        <tr>Theres no requirements need validating.</tr>
                        <?php
                    } ?>
                </tbody>
            </table>
        </div>
        <?php
        $rT[] = 'rT' . $id;
    }
    $_SESSION['rT'] = $rT;
}
?>