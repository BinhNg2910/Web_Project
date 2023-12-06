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

    // Update résumé information
    $fullName = $_POST["fullName"];
    $birthday = $_POST["birthday"];
    $addr = $_POST["addr"];
    $mail = $_POST["mail"];
    $website = $_POST["website"];
    $skills = $_POST["skills"];
    $personalSkills = $_POST["PersonalSkills"];
    $experience = $_POST["Experience"];

    $sqlUpdateGeneral = "UPDATE General SET
        FullName='$fullName',
        Birthday='$birthday',
        Addr='$addr',
        Website='$website',
        Skills='$skills',
        PersonalSkills='$personalSkills',
        Experience='$experience'
        WHERE ResumeName='$cvName' AND Mail='$mail'";
    $conn->query($sqlUpdateGeneral);


    // Update phone numbers
    if (isset($_POST["phone"])) {
        foreach ($_POST["phone"] as $phoneId => $phone) {
            $sqlUpdatePhone = "UPDATE Phone SET 
            Phone='$phone'
            WHERE resumeName='$phoneId' AND Mail='$mail'";
            $conn->query($sqlUpdatePhone);
        }
    }

    // Update certificate/degree
    if (isset($_POST["cerDeg"])) {
        foreach ($_POST["cerDeg"] as $cerDegId => $cerDeg) {
            $sqlUpdateCerDeg = "UPDATE CerDeg SET 
            CerDeg='$cerDeg' 
            WHERE resumeName='$cerDegId' AND Mail='$mail'";
            $conn->query($sqlUpdateCerDeg);
        }
    }
}

$conn->close();

// Redirect back to the edit.php page
header("Location: edit.php?cvName=" . urlencode($cvName));
exit();
?>
