<?php
ini_set('session.cookie_httponly', 1); 
session_start(); ?>
<form method="POST" action="../Functions/PHP/createToken.php">
    <input type="hidden" name="createToken">
    <button type="submit">Generate Token</button>
</form>

<?php
if (isset($_SESSION['key']) && isset($_SESSION['token'])) {
    $k = $_SESSION['key'];
    $t = $_SESSION['token'];
    unset($_SESSION['key'], $_SESSION['token']);
    ?>
    <p><b>Key: </b><?php echo $k ?? "" ?><br><b>Token: </b><?php echo $t ?? "" ?></p>
    <?php
}
?>