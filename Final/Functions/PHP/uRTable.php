<?php
if (isset($_SESSION['allTokens']) && !empty($_SESSION['allTokens'])) {
    foreach ($_SESSION['allTokens'] as $a) {
        $token = $a['Token_ID'] ?? "";
        $k = $a['Key'] ?? "";
        $acid = $_SESSION['acid' . $token] ?? "";
        $name = $_SESSION['adminName' . $token] ?? "";
        $admin = $_SESSION['adminID' . $token] ?? "";
        $acname = $_SESSION['accessName' . $acid] ?? "";

        ?>
        <tr class="tbl-row">
            <td><?php echo $k ?></td>
            <td><?php echo (!empty($name)) ? $name : '<i class="text-secondary">Not Set</i>' ?></td>
            <td><?php echo (!empty($acname)) ? $acname : '<i class="text-secondary">Not Set</i>' ?></td>
            <td><?php
            if (!empty($acid)) {
                ?>
                    <button type="button" class="action-btn" data-bs-toggle="modal" data-bs-target="#uR<?php echo $token ?>">Modify Role</button>
                    <?php
            } elseif (empty($name)) {
                ?>
                    <i class="text-secondary">Set Name To Add Role</i>
                    <?php
            } else { ?>
                    <button type="button" class="action-btn" data-bs-toggle="modal" data-bs-target="#uR<?php echo $token ?>">Add
                        Role</button>
                <?php } ?>
            </td>
        </tr>

        <!-- Modal -->
        <div class="modal fade" id="uR<?php echo $token ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="aRLabel<?php echo $token ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content text-light" style="background-color: #000133;">
                    <div class="modal-header p-0">
                        <div class="row" style="width: 100%;">
                            <div class="col py-3 ms-3">
                                <h1 class="modal-title fs-5" id="aRLabel<?php echo $token ?>">
                                    <?php
                                    if (!empty($acid)) {
                                        echo "Modify $name's Role";
                                    } else {
                                        echo "Add $name's Role";
                                    }
                                    ?>
                                </h1>
                            </div>
                            <div class="col py-3 mt-1 pe-2">
                                <div class="col d-flex justify-content-end p-0">
                                    <button type="button" class="bg-light rounded-circle btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="../Functions/PHP/addRole.php">
                        <div class="modal-body">
                            <select class="form-select" name="access" required>
                                <?php include "../Functions/PHP/aCSelect.php" ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" value="<?php echo $admin ?>" name="id">
                            <input type="hidden" name="addRole">
                            <?php if (!empty($acid)) { ?>
                                <button type="submit" class="btn-modal">Modify Role</button>
                            <?php } else { ?>
                                <button type="submit" class="btn-modal">add Role</button>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
}
?>