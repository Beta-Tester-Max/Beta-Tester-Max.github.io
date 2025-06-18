<form method="POST">
    <input type="text" name="importance">

    <button type="submit">submit</button>
</form>

<?php
include "Functions/PHP/connect.php";
if (isset($_POST['importance'])) {
    $t = cleanInt($_POST['importance']) ?? "";
    echo $t;
}
?>