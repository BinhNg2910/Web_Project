<?php 
$servername = "localhost";
$username = "username";
$password = "password";
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
        $mail = $_SESSION['user_mail'];
        $query = "SELECT * FROM userresume WHERE UserMail='$mail' AND ResumeName='$inpText'";
        $result = $conn->query($query);
        $row = mysqli_num_rows($result) > 0;
        $responseData = ["message" => $row];
        $jsonResponse = json_encode($responseData);
    } else {
        $responseData = ["message" => "nothing"];
        $jsonResponse = json_encode($responseData);
    }
}
$conn->close();
?>