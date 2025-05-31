<form method="POST">
    <select name="importance" required>
        <option value="" selected>Select Importance</option>
        <option value="Required">Required</option>
        <option value="Optional">Optional</option>
    </select>

    <button type="submit">submit</button>
</form>

<?php
if (isset($_POST['importance'])) {
    $t = $_POST['importance'] ?? "";
    if ($t !== 'Required' && $t !== 'Optional') {
        echo "it didn't work: $t";
    } else {
        echo "it worked: $t";
    }
}
?>