<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cvName = $_POST["cvName"];

    // Delete résumé information
    $sqlDeleteResume = "DELETE FROM UserResume WHERE ResumeName='$cvName'";
    $conn->query($sqlDeleteResume);

    $sqlDeleteGeneral = "DELETE FROM General WHERE ResumeName='$cvName'";
    $conn->query($sqlDeleteGeneral);

    // Delete phone numbers
    $sqlDeletePhone = "DELETE FROM Phone WHERE ResumeName='$cvName'";
    $conn->query($sqlDeletePhone);

    // Delete certificate/degree
    $sqlDeleteCerDeg = "DELETE FROM CerDeg WHERE ResumeName='$cvName'";
    $conn->query($sqlDeleteCerDeg);
}

$conn->close();

// Redirect back to the edit.php page
header("Location: edit.php?cvName=" . urlencode($cvName));
exit();
?>
