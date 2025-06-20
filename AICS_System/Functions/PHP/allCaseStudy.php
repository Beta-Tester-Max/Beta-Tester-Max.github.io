<?php
if (isset($_SESSION['allCaseStudy']) || !empty($_SESSION['allCaseStudy'])) {
    foreach ($_SESSION['allCaseStudy'] as $a) {
        $id = $a['id'] ?? "";
        $name = $a['cSName'] ?? "";

        ?>
        <form method="post" action="./../Functions/PHP/continueCS.php">
            <div class="row" style="width: 100%; margin-left: 1px;">
                <div class="col">
                    <h4 style="margin: 0;"><?php echo htmlspecialchars($name) ?></h4>
                </div>
                <div class="col" style="display: flex; align-items: center; justify-content: end;">
                    <input type="hidden" value="<?php echo htmlspecialchars($id) ?>" name="id">
                    <input type="hidden" name="continue">
                    <button type="submit">Continue Case Study</button>
                </div>
            </div>
        </form>
        <?php
    }
}
?>