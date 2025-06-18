<?php
if (isset($_SESSION['accessControl']) && !empty($_SESSION['accessControl'])) {
    foreach ($_SESSION['accessControl'] as $a) {
        $id = $a['Access_ID'] ?? "";
        $n = $a['Access_Level'] ?? "";
        $access = explode(", ", $a['Access']) ?? "";
        $acc = array();
        $ch = array();
        foreach ($access as $b) {
            if ($b === '1') {
                $m = "<p class='text-success m-0'>Has Access</p>";
                $c = "checked";
            } else {
                $m = "<p class='text-danger m-0'>No Access</p>";
                $c = "";
            }
            $acc[] = $m;
            $ch[] = $c;
        }
        ?>
        <tr>
            <td><?php echo $n ?></td>
            <td>
                <div class="row">
                    <div class="col"><b>Managing User Access:</b></div>
                    <div class="col"><?php echo $acc[1] ?></div>
                </div>
            </td>
            <td>
                <button type="button" class="action-btn" data-bs-toggle="modal" data-bs-target="#mA<?php echo $id?>">
                    Modify Access
                </button>
            </td>

            <!-- Modal -->
            <div class="modal fade" id="mA<?php echo $id?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="cALabel<?php echo $id?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content text-light" style="background-color: #000133;">
                        <div class="modal-header p-0">
                            <div class="row" style="width: 100%;">
                                <div class="col py-3 ms-3">
                                    <h1 class="modal-title fs-5" id="cALabel<?php echo $id?>">Modify Access "<?php echo $n?>"</h1>
                                </div>
                                <div class="col py-3 mt-1 pe-2">
                                    <div class="col d-flex justify-content-end p-0">
                                        <button type="button" class="bg-light rounded-circle btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="../Functions/PHP/createAccess.php">
                            <div class="modal-body">
                                <h4 class="text-center mt-3">Modify Restrictions</h4>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="mUA" name="mUA" <?php echo $ch[1]?>>
                                    <label class="form-check-label" for="mUA">Managing User Access</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" value="<?php echo $id?>" name="id">
                                <input type="hidden" value="<?php echo $n?>" name="name">
                                <input type="hidden" name="modifyAccess">
                                <button type="submit" class="btn-modal">Modify</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </tr>
        <?php
    }
}
?>