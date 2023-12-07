<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "UserAccount";

// Create connection
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
$conn->query($sql);
$conn->close();

$conn=new mysqli($servername,$username,$password,$dbname);

// Create UserAccount Table
$sql = "CREATE TABLE IF NOT EXISTS Users(
    Email VARCHAR(255),
    Password VARCHAR(255),
    UserName VARCHAR(255)
)";
$conn->query($sql);
$conn->close();
?>
