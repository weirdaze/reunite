
<?php
	session_start();

	/*if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
		header("Location: index.php");
	}*/

	if(isset($_POST['username']) && isset($_POST['password'])) {
		if($_POST['username'] == "Admin" && $_POST['password'] == "Admin123"){
			$_SESSION['logged_in'] = true;
			header("Location: index.php");
		}
	}

	include 'header_login.php';
?>

<style>
	body {
		background-color: #eee;
	}
</style>

<form id="loginBox" class="p-3" method="post" action="login.php">
	<div class="form-group">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="username" placeholder="username">
	</div>
	<div class="form-group">
		<div class="input-icon"><i class="fa fa-lock"></i></div>
		<input class="form-control mb-2" type="password" name="password" placeholder="password">
	</div>
	<input class="btn btn-primary" type="submit" value="Login">
</form>

<?php include 'footer_login.php'?>