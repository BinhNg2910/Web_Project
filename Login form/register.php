<?php

if (isset($_POST["submit"])) {
  // Get form data
  $email = $_POST['user_email'];
  $password = $_POST['user_password'];
  $name = $_POST['user_name'];
  $hash_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

  $errors = array();

  require_once "db_setup.php";

  // $user_sql = "SELECT * FROM users WHERE email = '$email'";
  // $result = mysqli_query($conn, $user_sql);
  // $rowCount = mysqli_num_rows($result);
  // if($rowCount > 0) {
  //   array_push($errors, "Email already exists");
  // }
  // if($email === "binhnvhcm@gmail.com") {
  //   array_push($errors, "Email already exists");
  // }

  
  // $user_sql="INSERT INTO users (username, user_email, user_password) VALUES ('$name', '$email', '$paasword')";
  $user_sql="INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);
  $prepareStmt = mysqli_stmt_prepare($stmt, $user_sql);
  if($prepareStmt) {
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hash_password);
    mysqli_stmt_execute($stmt);
    echo "<div class = 'alert alert-success'>You are registered successfully.</div>";
    header("location: index.php?page=login");
  } else {
    die("Somthing went wrong !!!");
  }
}
// $mysqli->close();
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

            <form action="register.php" method="post" onsubmit="return validateForm()">
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
<script>
  function validateForm() {
      var email = document.getElementById('user_email').value;
      var user_name = document.getElementById('user_name').value;
      var password = document.getElementById('user_password').value;
      var confirmPassword = document.getElementById('user_confirm_password').value;

      // Perform basic validation
      if (email.trim() === '' || user_name.trim() === '' || password.trim() === '' || confirmPassword.trim() === '') {
        alert('Please enter all fields.');
        return false;
      }

      // Check if passwords match
      if (password !== confirmPassword) {
        alert('Passwords do not match. Please enter the same password in both fields.');
        return false;
      }

      //check if password is not complex
      if(!isPasswordComplex(password)) {
        alert('Password must be at least 8 characters and include at least one lowercase letter, one uppercase letter, and one digit.');
        return false;        
      }
      return true; // Allow form submission
  }
  function isPasswordComplex(password) {
      var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
      return regex.test(password);
  }
</script>

</body>
</html>
