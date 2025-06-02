<form method="POST">
    <input type="text" name="importance">

    <button type="submit">submit</button>
</form>

<?php
if (isset($_POST['importance'])) {
    $t = trim($_POST['importance']) ?? "";
    echo $t;
}
?>