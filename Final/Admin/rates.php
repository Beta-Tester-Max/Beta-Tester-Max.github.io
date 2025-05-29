<?php
ini_set('session.cookie_httponly', 1);
session_start();
$_SESSION['Authority'] = "Admin";
include "../Functions/PHP/adminDataFetcher.php";
// include "../Functions/PHP/forAdmin.php"
?>
<div style="display: flex; justify-content: center; align-items: center; padding: 5em;">
    <div style="max-width: 30em;">
        <form style="display: flex; flex-direction: column;" method="POST" action="../Functions/PHP/addRates.php">
            <p style="font-size: 2em; text-align: center;"><b>Add Rates</b></p>

            <select name="assistance" required>
                <option value="" selected>Select Assistance</option>
                <?php include "../Functions/PHP/assistanceSelect.php" ?>
            </select>

            <br>

            <label for="criteria">Criteria</label>
            <textarea id="criteria" name="criteria" rows="10" cols="40" required></textarea>

            <br>

            <label for="cost">Cost</label>
            <input type="number" id="cost" name="cost" required>

            <br>

            <select name="availability" required>
                <option value="" selected>Select Availability</option>
                <?php include "../Functions/PHP/availabilitySelect.php" ?>
            </select>

            <br>

            <input type="hidden" name="addRate">
            <button type="submit">Create Rate</button>
        </form>
    </div>
</div>