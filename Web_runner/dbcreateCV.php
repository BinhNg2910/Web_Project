<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";
//Create connection
$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}

//insert into UserResume Table (usermail, resumename)
$cvname = $_POST['cvname'];
$sessionmail=$_SESSION['email'];
$sql="INSERT INTO userresume (UserMail, ResumeName)
VALUE ('$sessionmail', '$cvname')
";
$conn->query($sql);

//insert into General Table
if (!file_exists('uploads/')) {
    mkdir('uploads/', 0777, true);
}
$file = $_FILES['file'];
$fileName = $_FILES['file']['name'];
$fileTmpName = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileError = $_FILES['file']['error'];
// $fileType = $_FILES['file']['type'];

$fileExt = explode('.',$fileName);
$fileActualExt = strtolower(end($fileExt));

$allowed = array('jpg', 'jpeg', 'png');

if(in_array($fileActualExt, $allowed)){
    if($fileError===0){
        if($fileSize < 500000){ //size < 500 kB
            $fileNameNew = uniqid('',true).".".$fileActualExt;
            $fileDestination = 'uploads/'.$fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
        } else {
            echo "Your file is too big!";
        }
    } else {
        echo "There was an error uploading your file!";
    }
} else {
    echo "You can not files of this type!";
}
$mail = $_POST['mail'];
$fname = $_POST['fname'];
$bday = $_POST['birthday'];
$addr = $_POST['address'];
$website = $_POST['website'];
$skill = $_POST['skill'];
$personalskill = $_POST['personalskill'];
$experience = $_POST['experience'];
$sql="INSERT INTO general (FullName, Birthday, Addr, Mail, SessionMail, Website, Skills, PersonalSkills, Experience, Photo, ResumeName)
VALUE ('$fname', '$bday', '$addr', '$mail', '$sessionmail', '$website', '$skill', '$personalskill', '$experience', '$fileDestination','$cvname')
";
$conn->query($sql);

//insert into phone table
foreach($_POST as $key => $value){
    if(strpos($key, 'phoneNumber-')===0){
        $sql="INSERT INTO phone (Mail, Phone, ResumeName) VALUE ('$sessionmail','$value','$cvname')";
        $conn->query($sql);
    }
}

//insert into CerDeg table
foreach($_POST as $key => $value){
    if(strpos($key, 'CerDeg-')===0){
        // array_push($phoneNumbers, $value);
        $sql="INSERT INTO cerdeg (Mail, CerDeg, ResumeName) VALUE ('$sessionmail','$value','$cvname')";
        $conn->query($sql);
    }
}
$conn->close();
header('location: CreateCV.php');
// exit;
?>