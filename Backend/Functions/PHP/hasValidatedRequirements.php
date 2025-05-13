<?php
if (isset($_SESSION['Assistance'])) {
    ?>
    <div class="row justify-content-md-center my-5">
        <div class="col-md-auto">
            <h4 class="text-center">Applications</h4><br>
            <hr>
            <?php
            $toggle = false;
            foreach ($_SESSION['Assistance'] as $a) {
                $aid = $a['Assistance_ID'] ?? "";
                $an = $a['Assistance_Name'] ?? "";
                $mR = $_SESSION['missingRequirements' . $aid] ?? "";
                if (!empty($mR)) {
                    ?>
                    <div class="row justify-content-md-center">
                        <div class="col-md-auto">
                            <p class="text-center">(<span class="text-danger">Not Eligible</span>) <b><?php echo $an ?>:</b></p>
                            <p class="text-center text-secondary"><i>Missing:<br>
                                    <?php
                                    for ($i = 0; $i < count($mR); $i++) {
                                        $r = $mR[$i];
                                        $mD = $_SESSION['accountDocumentN' . $r] ?? "";
                                        echo $mD . "<br>";
                                    }
                                    ?>
                                </i></p>
                        </div>
                    </div>
                    <hr>
                    <?php
                } else {
                    $toggle = true;
                }
            }
            if ($toggle) {
                ?>
                <div class="row justify-content-md-center my-5">
                    <div class="col-md-auto">

                        <a href="createApplicationForm.php">Create Application</a>

                    </div>
                </div>
                <?php
            }
}
?>