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

$sql="SELECT 1 FROM userresume LIMIT 1";
$res=$conn->query($sql);
if($res!==false){
    if(isset($_POST['datane'])){
        $inpText = $_POST['datane'];
        $mail = $_SESSION['email'];
        $query = "SELECT * FROM userresume WHERE BINARY UserMail='$mail' AND BINARY ResumeName='$inpText'";
        $result = $conn->query($query);
        $row = mysqli_num_rows($result) > 0;
        $responseData = ["message" => $row];
        $jsonResponse = json_encode($responseData);
        echo $jsonResponse;
    } else {
        $responseData = ["message" => "nothing"];
        $jsonResponse = json_encode($responseData);
        echo $jsonResponse;
    }
}
$conn->close();
?>