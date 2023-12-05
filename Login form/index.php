<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CV TEMPLATE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>

  <?php
    session_start();
    // Connect to your database (replace these details with your actual database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "UserAccount";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
  ?>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class  ="container-fluid">
      <div><a class="navbar-brand" href="index.php">CV TEMPLATE</a></div>
      <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

      <?php if (isset($_SESSION['email'])) : ?>

        <?php
          // Fetch the username from the database based on the user's email
          $email = $_SESSION['email'];
          $query = "SELECT username FROM users WHERE email = '$email'";
          $result = $conn->query($query);

          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $username = $row['username'];
          } else {
              // Handle the case where the user is not found in the database
              $username = "User";
          }
        ?>

        <li class="nav-item">
          <a id="homelink" class="nav-link active" href="index.php?page=home">Crete new CV</a>
        </li>
        <li class="nav-item">
          <a id="productlink" class="nav-link active" href="index.php?page=products">Delete or Edit CV</a>
        </li>
        <!-- <li class="nav-item">
          <a id="logoutlink" class="nav-link" href="logout.php">Logout</a>
        </li> -->

        <div class="nav-item btn-group">
          <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Hello, <?php echo $username; ?>
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">My CV</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Setting</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a id="logoutlink" class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </div>
        <!-- <li class="nav-item">
          <a id="logoutlink" class="nav-link" href="#">Hello, <?php echo $username; ?></a>
        </li> -->
      <?php else : ?>
        <li class="nav-item">
          <a id="loginlink" class="nav-link active" href="index.php?page=login">Login</a>
        </li>
        <li class="nav-item">
          <a id="registerlink" class="nav-link active" href="index.php?page=register">Register</a>
        </li>
      <?php endif; ?>
        
      </ul>

    </div>
  </nav>



  <div id="searchResults"></div>
  <div class="container mt-4">
    <?php
      $page = $_GET['page'] ?? 'home';
      $filename = $page . '.php';
      if (file_exists($filename)) {
        include $filename;
      } else {
        echo "Page not found";
      }
    ?>
  </div>
</body>

</html>
