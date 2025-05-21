<?php
if (isset($aid) && !empty($aid)) {
    if (isset($_SESSION['ratesCount' . $aid])) {
        if ($_SESSION['ratesCount' . $aid] > 1) {
            ?>
            <div class="mb-3">
                <label class="mb-1" for="seAp">Select Severity:</label><br />
                <select class="form-select" name="severity" id="seAp" required>
                    <option value="" selected>Select Severity Type</option>
                    <?php
                    foreach ($_SESSION['Rates' . $aid] as $r) {
                        $rid = $r['Rate_ID'] ?? "";
                        $c = $r['Criteria'] ?? "";
                        ?>
                        <option value="<?php echo $rid ?>"><?php echo $c ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <?php
        } elseif ($_SESSION['ratesCount' . $aid] === 1) {
            $r = $_SESSION['Rates' . $aid][0] ?? "";
            $rid = $r['Rate_ID'] ?? "";
            ?>
            <input type="hidden" value="<?php echo $rid?>" name="severity">
            <?php
        }
    }
}
?>