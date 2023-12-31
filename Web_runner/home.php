<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1 class="display-4">Welcome to CV Template</h1>
                <p class="lead">Create your professional CV easily with our template.</p>
                <?php if (!isset($_SESSION['email'])) : ?>
                    <a href="index.php?page=login" class="btn btn-primary btn-lg">Log in</a>
                    <a href="index.php?page=register" class="btn btn-primary btn-lg">Sign in</a>
                <?php else : ?>
                    <a href="CreateCV.php" class="btn btn-primary btn-lg">Get Started</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, for some features) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
</body>
</html>
