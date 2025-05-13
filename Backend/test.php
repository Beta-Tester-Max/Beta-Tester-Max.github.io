<form method="POST" style="margin-bottom: 10px;">
    <input type="text1" value="test" name="value1">
    <input type="text2" value="test" name="value2">
    <input type="text3" value="test" name="value3">
    <input type="hidden" name="testForm">
    <button type="submit">submit</button>
</form>

<?php
$row = array();

$row['time'] = 'day';

echo $row['time'];

?>