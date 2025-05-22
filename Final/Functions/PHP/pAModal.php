<?php
if (isset($_SESSION['pendingApplications']) && !empty($_SESSION['pendingApplications'])) { ?>
    <?php foreach ($_SESSION['pendingApplications'] as $p) {
        $apid = $p['Application_ID'] ?? "";
        ?>
        <div class="modal fade" id="delCon<?php echo $apid ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="delConLabel<?php echo $apid ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h1 class="modal-title fs-5" id="delConLabel<?php echo $apid ?>">Are you sure?</h1>
                        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">
                        This application will be permanently deleted and you won't be able to restore it.
                    </div>
                    <form method="POST" action="Functions/PHP/delApp.php">
                        <div class="modal-footer d-flex justify-content-center align-items-center bg-secondary">
                            <input type="hidden" value="<?php echo $apid?>" name="appID">
                            <input type="hidden" name="delApp">
                            <button type="submit" class="btn btn-danger">Yes, Delete it</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
} ?>