<<<<<<< HEAD:Web_runner/delete.php
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
=======
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
    $mail = $_POST["mail"];
    // Delete résumé information
    $sqlDeleteResume = "DELETE FROM UserResume WHERE ResumeName='$cvName' AND UserMail='$mail'";
    $conn->query($sqlDeleteResume);

    $sqlDeleteGeneral = "DELETE FROM General WHERE ResumeName='$cvName' AND Mail='$mail'";
    $conn->query($sqlDeleteGeneral);

    // Delete phone numbers
    $sqlDeletePhone = "DELETE FROM Phone WHERE ResumeName='$cvName' AND Mail='$mail'";
    $conn->query($sqlDeletePhone);

    // Delete certificate/degree
    $sqlDeleteCerDeg = "DELETE FROM CerDeg WHERE ResumeName='$cvName' AND Mail='$mail'";
    $conn->query($sqlDeleteCerDeg);
}

$conn->close();

// Redirect back to the edit.php page
header("Location: edit.php?cvName=" . urlencode($cvName));
exit();
?>
>>>>>>> 9138ff94591fe4693c3665158a301e64b444895d:AssignmentWeb - Copy/delete.php
