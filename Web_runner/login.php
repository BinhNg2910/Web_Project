<!DOCTYPE html>
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
    <div class="container">
      <h2 class="text-center mb-4">Login</h2> <!-- Title added here -->
      <div class="card mb-3">
        <div class="row g-0 d-flex align-items-center">
          <div class="col-lg-8 mx-auto"> <!-- Center the form -->
            <div class="card-body py-5 px-md-5">
              <form action="login_db.php" method="POST" onsubmit="return validateForm()">
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
                <button type="submit" class="btn btn-primary btn-block mb-4">Log in</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Section: Design Block -->

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
</body>
</html>
