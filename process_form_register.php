<?php

require_once('utility.php');
require_once('dbhelper.php');
$fullname = $email = $msg = '';

if(!empty($_POST)) {
	$fullname = getPost('fullname');
	$email = getPost('email');
	$pwd = getPost('password');

	//validate
	if(empty($fullname) || empty($email) || empty($pwd) || strlen($pwd) < 6) {
	} else {
		$userExist = executeResult("select * from _User where email = '$email'", true);
		if($userExist != null) {
			$msg = 'Email already exist, please try another one';
		} else {
			$created = date('Y-m-d H:i:s');
			$updated = date('Y-m-d H:i:s');
			$pwd = getSecurityMD5($pwd);

			if($email=="root@root.com")
			{
			// $role = "Admin";
			$sqlUser = "insert into _User (username,email,pass,role_id,deleted,created_at,updated_at) values ('$fullname', '$email', '$pwd',1,0,'$created','$updated')";
			// $sqlRole = "insert into _Role(role_name) values('$role')";

			}
			else if($email!="anhtriet172@gmail.com")
			{
				// $role = "User";
				$sqlUser = "insert into _User (username,email,pass,role_id,deleted,created_at,updated_at) values ('$fullname', '$email', '$pwd',2,0,'$created','$updated')";
				// $sqlRole = "insert into _Role(role_name) values('$role')";

			}
			execute($sqlUser);
			header('Location: login.php');
			die();
		}
	}
}
