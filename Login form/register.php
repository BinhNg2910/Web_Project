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

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="index_style.css">
</head>
<body>
  
  <!-- Section: Design Block -->
  <section class="text-center text-lg-start">
    <style>
      .rounded-t-5 {
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
      }

      @media (min-width: 992px) {
        .rounded-tr-lg-0 {
          border-top-right-radius: 0;
        }

        .rounded-bl-lg-5 {
          border-bottom-left-radius: 0.5rem;
        }
      }
    </style>
    <div class="card mb-3">
      <div class="row g-0 d-flex align-items-center">
        <div class="col-lg-4 d-none d-lg-flex">
            <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" alt="Trendy Pants and Shoes"
            class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
        </div>
        <div class="col-lg-8">
          <div class="card-body py-5 px-md-5">

            <form action="db_setup.php" method="POST" onsubmit="return validateForm()">
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" name="user_email" id="user_email" class="form-control" />
                    <label class="form-label" for="user_email">Email address</label>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="name" name="user_name" id="user_name" class="form-control" />
                    <label class="form-label" for="user_name">User name</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" name="user_password" id="user_password" class="form-control" />
                    <label class="form-label" for="user_password">Password</label>
                </div>

                <!-- Password confirmation input -->
                <div class="form-outline mb-4">
                    <input type="password" name="user_confirm_password" id="user_confirm_password" class="form-control" />
                    <label class="form-label" for="user_confirm_password">Password confirmation</label>
                </div>

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Log in</button>
                <!-- <input type="submit" value="Sign in" name="submmit"> -->

            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Section: Design Block -->

<script src="./register.js"></script>
</body>
</html>
