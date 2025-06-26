<?php
if (isset($_SESSION['allCompleteCaseStudy']) || !empty($_SESSION['allCompleteCaseStudy'])) {
    foreach ($_SESSION['allCompleteCaseStudy'] as $a) {
        $id = $a['id'] ?? "";
        $name = $a['cSName'] ?? "";

        ?>
        <form method="post" target="_blank" action="./../PDF_Maker/">
            <div class="row mb-2">
                <div class="col-10 d-flex align-items-center">
                    <p class="fs-5 m-0"><?php echo htmlspecialchars($name) ?></p>
                </div>
                <div class="col-2 d-flex justify-content-end align-items-center">
                    <input type="hidden" value="<?php echo htmlspecialchars($id) ?>" name="id">
                    <input type="hidden" name="viewPDF">
                    <button type="submit" class="btn btn-outline-dark">Continue</button>
                </div>
            </div>
        </form>
        <?php
    }
}
?>