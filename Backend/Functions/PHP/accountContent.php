<?php
if (!empty($_SESSION['Account'])) {
$data = $_SESSION['Account'] ?? "";
?>
<p><b>Username: </b><?php echo $data['Username']?></p>
<p><b>Email: </b><?php echo $data['Email']?></p>
<p><b>User_Level: </b><?php echo $data['Access_Level']?></p>
<a href="profile.php">Profile</a><br>
<a href="Functions/PHP/logout.php">Logout</a>
<?php } else {?>
    <a href="registrationForm.php">Register</a><br>
    <a href="loginForm.php">Login</a><br>
<?php }?>