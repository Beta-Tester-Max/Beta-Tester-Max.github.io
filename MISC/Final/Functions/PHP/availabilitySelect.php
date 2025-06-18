<?php
if (isset($_SESSION['Availability']) && !empty($_SESSION['Availability'])) {
    foreach ($_SESSION['Availability'] as $a) {
        $aid = $a['Availability_ID'];
        $an = $a['Availability_Name'];
        ?>
        <option value="<?php echo $aid?>"><?php echo $an?></option>
        <?php
    }
}
?>