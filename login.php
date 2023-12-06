<?php

session_start();

// Check if the form was submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if both email and password are set
  if (isset($_POST['email']) && isset($_POST['password'])) {
    // Create a connection
    $mysqli = new mysqli("localhost", "root", "", "UserAccount");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Get the email and password from the form
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];

    // Prepare a SQL query to find the user with the entered email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();  

    // Check if the user exists and if the password is correct
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            // Assign values to session variables
            // $_SESSION['userID'] = $row['userID'];
            // $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];


            // Set a cookie for auto-login
            setcookie('auto_login', $row['email'], time() + 300);

            // Redirect to the dashboard
            header("Location: index.php");
        } else {
            echo '<script>window.alert("Incorrect username or password!");</script>';
            // header("Location: index.php?page=login");
        }
    } else {
        echo '<script>window.alert("Incorrect username or password!");</script>';
        // header("Location: index.php?page=login");
    }

    // Close the connection
    $mysqli->close();
  } else {
      // Redirect or display an error message if email or password is not set
      echo '<script>window.alert("Email and password are required!");</script>';
      // header("Location: index.php?page=login");
  }
} else {
  // Redirect or display an error message if the form was not submitted with POST method
  echo '<script>window.alert("Invalid form submission!");</script>';
  // header("Location: index.php?page=login");
}

if(isset($_POST["login"])) {
  $email = $_POST["$email"];
  $password = $_POST["$password"];
  require_once "database.php";
  $sql = "SELECT * FROM users where email='$email'";
  $result = mysqli_query($conn, $sql);
  $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
  if($user) {
    if(password_verify($password, $user["password"])) {
      header("Location: index.php");
      die();
    }
    else {
      echo "<div class = 'alert alert-danger'>Password does not match</div>"; 
    }
  } else {
    echo "<div class = 'alert alert-danger'>Email does not exist</div>"; 
  }
}

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $email = $_POST["email"];
//     $password = $_POST["password"];

//     // SQL to retrieve hashed password from the database
//     $sql = "SELECT password FROM users WHERE email = '$email'";
//     $result = $conn->query($sql);

//     if ($result->num_rows > 0) {
//         $row = $result->fetch_assoc();
//         $hashed_password = $row["password"];

//         // Verify the entered password
//         if (password_verify($password, $hashed_password)) {
//             echo "Login successful!";
//         } else {
//             echo "Invalid password!";
//         }
//     } else {
//         echo "User not found!";
//     }
// }
// $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">

        <h1>Login</h1>
        <div class="input-box">
            <input type="text" name="email" placeholder="Email" required />
            <box-icon type="solid" name="user"></box-icon>
        </div>

        <div class="input-box">
            <input type="password" name="password" placeholder="Password" required />
            <box-icon name="lock-alt" type="solid"></box-icon>
        </div>

        <button class="btn" type="submit">Login</button>
        <div class="register-link">
            <p>Don't have an account? <a href="#">Register here</a></p>
        </div>
        </form>
    </div>
    <section></section>
    <!-- css -->
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: #2F4F4F no-repeat;
        background-size: cover;
    }

    .wrapper {
        width: 600px;
        height: 400px;
        background: rgb(27, 17, 27);
        color: #fff;
        border-radius: 10px;
        padding: 30px 40px;
    }

    .wrapper h1 {
        font-size: 36px;
        text-align: center;
    }

    .wrapper .input-box {
        width: 100%;
        height: 50px;
        margin: 30px 0;
    }

    .input-box input {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 40px;
        font-size: 16px;
        color: #fff;
        padding: 20px 45px 20px 20px;
    }

    .input-box input::placeholder {
        color: #fff;
    }

    .input-box i {
        position: absolute;
        right: 20px;
        top: 50px;
        transform: translateY(-50%);
        font-size: 20px;
    }

    .wrapper .btn {
        width: 100%;
        height: 45px;
        background: #fff;
        border: none;
        outline: none;
        border-radius: 40px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        font-size: 16px;
        color: #333;
        font-weight: 600;
    }

    .wrapper .register-link {
        font-size: 14.5px;
        text-align: center;
        margin-top: 20px;
        margin: 20px 0 15px;
    }

    .register-link p a {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
    }

    .register-link p a:hover {
        text-decoration: underline;
    }
    </style>
</body>

</html>