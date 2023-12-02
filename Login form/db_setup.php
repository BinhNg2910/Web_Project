<?php
$hostname = "localhost";
$username = "root";
$password = "";
$databasename = "UserAccount";
$conn = mysqli_connect($hostname, $username, $password, $databasename);
if(!$conn) {
    die("Something wrong");
}
?>