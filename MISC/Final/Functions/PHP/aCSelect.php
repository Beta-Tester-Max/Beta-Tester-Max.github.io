<?php
if (isset($_SESSION['accessControl']) && !empty($_SESSION['accessControl'])) {
    if (isset($_SESSION['acid' . $token]) && !empty($_SESSION['acid' . $token])) {
        ?>
        <option value="<?php echo $acid ?>" selected><?php echo $acname ?></option>
        <?php
    } else {
        ?>
        <option value="" selected>Select Role</option>
        <?php
    }
    foreach ($_SESSION['accessControl'] as $a) {
        $id = $a['Access_ID'] ?? "";
        $al = $a['Access_Level'] ?? "";
        if (isset($_SESSION['acid' . $token]) && !empty($_SESSION['acid' . $token])) {

        } else {
            ?>
            <option value="<?php echo $id ?>"><?php echo $al ?></option>
            <?php
        }
    }
}
?>