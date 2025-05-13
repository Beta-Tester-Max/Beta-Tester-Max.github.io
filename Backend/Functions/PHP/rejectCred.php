<?php
$data = array();
    if ($_SESSION['rejectCred']) {
        $data = $_SESSION['rejectCred'] ?? "";

        $f = $data['f'] ?? "";
        $t = $data['t'] ?? "";
        $d = $data['d'] ?? "";
        $id = $data['id'] ?? "";

        ?>
        <a href="<?php echo $f?>">Go Back</a>
        <?php
    } else {
        header('Location: ../Functions/PHP/logout.php');
        exit;
    }
?>