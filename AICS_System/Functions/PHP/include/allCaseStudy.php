<?php
if (isset($_SESSION['allCaseStudy']) || !empty($_SESSION['allCaseStudy'])) {
    foreach ($_SESSION['allCaseStudy'] as $a) {
        $id = $a['id'] ?? "";
        $name = $a['cSName'] ?? "";

        ?>
        <form method="post" action="./../Functions/PHP/continueCS.php">
            <div class="row">
                <div class="col d-flex align-items-center">
                    <p class="fs-5 m-0"><?php echo htmlspecialchars($name) ?></p>
                </div>
                <div class="col d-flex justify-content-end align-items-center">
                    <input type="hidden" value="<?php echo htmlspecialchars($id) ?>" name="id">
                    <input type="hidden" name="continue">
                    <button type="submit" class="btn btn-outline-dark">Continue</button>
                </div>
            </div>
            <hr>
        </form>
        <?php
    }
}
?>