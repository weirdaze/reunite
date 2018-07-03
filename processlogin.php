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
?>