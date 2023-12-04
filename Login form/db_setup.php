<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "UserAccount";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert into Users Table (email, password, username)
$email = $_POST['user_email'];
$password = $_POST['user_password'];
$username = $_POST['user_name'];
$hash_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
$sql = "INSERT INTO Users (Email, Password, UserName) VALUES ('$email', '$hash_password', '$username')";
$conn->query($sql);

if ($conn->query($sql) === TRUE) {
    // Redirect to the login page
    // header('location: index.php?page=login');
    // echo '<script>window.alert("Successfull registration !!");</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
header('location: index.php?page=register');
exit;
?>
