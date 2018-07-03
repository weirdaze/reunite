<?php
	include('config.php');
	session_start();

	$user = $_POST['username'];
    $password = $_POST['password'];

	/*$sql = "SELECT company, project FROM login WHERE username = '$user' and password = '$password';";
	$result = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

	$count = mysqli_num_rows($result);
	// If result matched $myusername and $mypassword, table row must be 1 row

	if($count == 1) {
		echo "Login Successful!!";
	}
	else {
		$error = "Your Login Name or Password is invalid";
	}*/

	if($user == "Admin" && $password == "Admin123"){
		$_SESSION['logged_in'] = true;
		$_SESSION['user_type'] = "admin";
		header("Location: index.php");
	}
	else {
		header("Location: login.php?error=1");
	}
?>