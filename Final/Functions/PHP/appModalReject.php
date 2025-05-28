<?php
if (isset($_SESSION['pA']) && !empty($_SESSION['pA'])) {
    foreach ($_SESSION['pA'] as $p) {
        $aid = $p['Application_ID'] ?? "";
        ?>
        <div class="modal fade" id="reject_<?php echo $aid ?>" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false" aria-labelledby="rejectLabel_<?php echo $aid ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-admin text-light">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="rejectLabel_<?php echo $aid ?>">Reason For Rejection</h1>
                        <button type="button" class="bg-light rounded-circle btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form method="POST" action="../Functions/PHP/review.php">
                        <div class="modal-body">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="State your reason here"
                                    style="height: 200px; width: 100%;" id="reason" minlength="10" maxlength="1000"
                                    name="reason" required></textarea>
                                <label class="text-dark" for="reason">Reason</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="application-action" style="background-color:rgb(7, 234, 255);"
                                data-bs-target="#application_<?php echo $aid ?>" data-bs-toggle="modal">Go Back</button>
                            <input type="hidden" value="<?php echo $aid ?>" name="appid">
                            <input type="hidden" name="reject">
                            <button type="submit" class="application-action"
                                style="background-color:rgb(238, 91, 91);">Reject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
}
?>