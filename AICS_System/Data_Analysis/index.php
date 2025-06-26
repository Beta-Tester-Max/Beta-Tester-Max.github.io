<form method="post">
    <label for="">Age Range</label>
    <input type="text" name="age1" required>
    to
    <input type="text" name="age2" required>
    <input type="hidden" name="getDateRange">
    <button type="submit">Get Date Range</button>
</form>
<?php
if (isset($_POST['getDateRange'])) {
    $age1 = intval($_POST['age1'] ?? "");
    $age2 = intval($_POST['age2'] ?? "");

    Date('Year', time() - ($age1 * 365 * 24 * 60 * 60));
    $date1 = date('Y-m-d', strtotime("-$age1 years"));
    $date2 = date('Y-m-d', strtotime("-$age2 years"));

    echo "<p>From: $date1 To: $date2</p>";
}
?>