<?php
if (isset($_SESSION['allCaseStudy']) || !empty($_SESSION['allCaseStudy'])) {
    foreach ($_SESSION['allCaseStudy'] as $a) {
        $id = $a['id'] ?? "";
        $name = $a['cSName'] ?? "";

        ?>
        <form method="post" action="./../Functions/PHP/continueCS.php">
            <div class="row mb-2">
                <div class="col-10 d-flex align-items-center">
                    <p class="fs-5 m-0"><?php echo htmlspecialchars($name) ?></p>
                </div>
                <div class="col-2 d-flex justify-content-end align-items-center">
                    <input type="hidden" value="<?php echo htmlspecialchars($id) ?>" name="id">
                    <input type="hidden" name="continue">
                    <button type="submit" class="btn btn-outline-dark">Continue</button>
                </div>
            </div>
        </form>
        <?php
    }
}
?>