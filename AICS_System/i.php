<?php
include "./Functions/PHP/dataFetcher.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="./Functions/PHP/formI.php" style="display: flex; flex-direction: column;">
        <label for="firstName">First Name</label>
        <input type="text" id="firstName" name="firstName" required>
        <label for="middleName">Middle Name</label>
        <input type="text" id="middleName" name="middleName">
        <label for="lastName">Last Name</label>
        <input type="text" id="lastName" name="lastName" required>
        <label for="bday">Birth Day</label>
        <input type="date" id="bday" name="bday" required>
        <?php include "./Functions/PHP/sxSelect.php";
        include "./Functions/PHP/cSSelect.php";
        include "./Functions/PHP/eASelect.php" ?>
        <label for="occupation">Occupation</label>
        <input type="text" id="occupation" name="occupation" required>
        <label for="barangay">Barangay</label>
        <input type="text" id="barangay" name="barangay" required>
        <label for="Conno">Contact Number</label>
        <input type="text" id="Conno" name="Conno" required>
        <input type="hidden" name="formI">
        <button type="submit">Submit</button>
    </form>
</body>

</html>