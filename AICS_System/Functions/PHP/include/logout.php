<?php
ini_set('session.cookie_httponly', 1);
session_start();
session_unset();
session_destroy();
header('Location: ../../../');
exit;
?>