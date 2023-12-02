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

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="index_style.css">
</head>
<body>
  <!-- <form action="login_processing.php" method="post">
    Username: <input type="email" name="email"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Login">
  </form> -->

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

            <form action="login.php" method="post" onsubmit="return validateForm()">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="user_email" id="user_email" class="form-control" />
                <label class="form-label" for="user_email">Email address</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="user_password" id="user_password" class="form-control" />
                <label class="form-label" for="user_password">Password</label>
              </div>

              <!-- 2 column grid layout for inline styling -->
              <div class="row mb-4">
                <div class="col d-flex justify-content-center">
                  <!-- Checkbox -->
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                    <label class="form-check-label" for="form2Example31"> Remember me </label>
                  </div>
                </div>

                <div class="col">
                  <!-- Simple link -->
                  <a href="#!">Forgot password?</a>
                </div>
              </div>

              <!-- Submit button -->
              <!-- <button type="button" class="btn btn-primary btn-block mb-4">Sign in</button> -->
              <input type="submit" value="Log in">
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Section: Design Block -->



</body>
<script>
    function validateForm() {
      var email = document.getElementById('user_email').value;
      var password = document.getElementById('user_password').value;

      // Perform basic validation
      if (email.trim() === '' || password.trim() === '') {
        alert('Please enter both email and password.');
        return false;
      }
      return true; // Allow form submission
    }
  </script>
</html>
