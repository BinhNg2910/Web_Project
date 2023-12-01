<?php
	session_start();

	require_once('process_form_register.php');
	$user = getUserToken();
	if($user!=null)
	{
		header('Location: ../');
		die();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta charset="utf-8">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	<link
      rel="stylesheet"
      href="https://code.jquery.com/qunit/qunit-1.22.0.css"
    />
    <script src="https://code.jquery.com/qunit/qunit-1.22.0.js"></script>


</head>
<body style="background-image: url(../../assets/photos/ecommerce.jpeg); background-size: cover; background-repeat: no-repeat;">

<div class="container">
		<div class="panel panel-primary" style="width: 480px; margin: 0px auto; margin-top: 50px; background-color: white; padding: 10px; border-radius: 5px; box-shadow: 2px 2px #9ac9f5;">
			<div class="panel-heading">
				<h2 class="text-center">Register</h2>
				<h5 style="color: red;" class="text-center"><?=$msg?></h5>
			</div>
			<div class="panel-body">
				<form method="post" onsubmit="return validateForm();">
					<div class="form-group">
					  <label for="usr">Fullname:</label>
					  <input required="true" type="text" class="form-control" id="usr" name="fullname" value="<?=$fullname?>">
					</div>
					<div class="form-group">
					  <label for="email">Email:</label>
					  <input required="true" type="email" class="form-control" id="email" name="email" value="<?=$email?>">
					</div>
					<div class="form-group">
					  <label for="pwd">Password:</label>
					  <input required="true" type="password" class="form-control" id="pwd" name="password" minlength="6">
					</div>
					<div class="form-group">
					  <label for="confirmation_pwd">Re-type password:</label>
					  <input required="true" type="password" class="form-control" id="confirmation_pwd" minlength="6">
					</div>
					<p>
						<a href="login.php">Already have account? click here</a>
					</p>
					<button class="btn btn-success">Register</button>
				</form>
			</div>
		</div>
	</div>


<script type="text/javascript">
	function validateForm() {
		$pwd = $('#pwd').val();
		$confirmPwd = $('#confirmation_pwd').val();
		if($pwd != $confirmPwd) {
			alert("Password not match, please check again")
			return false
		}
		return true
	}


</script>
</body>
</html>