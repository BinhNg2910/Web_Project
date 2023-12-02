<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CV TEMPLATE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <!-- <script src="Lab_2/scripts.js"></script> -->
</head>

<body>
<?php session_start(); ?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">CV TEMPLATE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
 
        <?php if (isset($_SESSION['email'])) : ?>
          <li class="nav-item">
              <a id="homelink" class="nav-link active" href="index.php?page=home">Home</a>
          </li>
          <li class="nav-item">
              <a id="productlink" class="nav-link" href="index.php?page=products">Products</a>
          </li>
          <li class="nav-item">
              <a id="logoutlink" class="nav-link" href="logout.php">Logout</a>
          </li>
          <li class="nav-item">
              <a id="logoutlink" class="nav-link" href="logout.php">Hi, user</a>
          </li>
        <?php else : ?>
          <!-- <li class="nav-item">
              <a id="homelink" class="nav-link active" href="index.php?page=home">Home</a>
          </li>
          <li class="nav-item">
              <a id="productlink" class="nav-link" href="index.php?page=products">Products</a>
          </li>
          <li class="nav-item">
              <a id="logoutlink" class="nav-link" href="logout.php">Logout</a>
          </li>
          <li class="nav-item">
              <a id="logoutlink" class="nav-link" href="logout.php">Hi, user</a>
          </li> -->
          <li class="nav-item">
            <a id="loginlink" class="nav-link" href="index.php?page=login">Login</a>
          </li>
          <li class="nav-item">
            <a id="registerlink" class="nav-link" href="index.php?page=register">Register</a>
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
