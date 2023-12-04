<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['user_level']);
setcookie('email', '', time() - 3600);
header('Location: index.php');
?>
