<?php
	session_start();
	if(isset($_GET['uid'])){
		$_SESSION['uid'] = $_GET['uid'];
	}

	/*echo $_SESSION['uid'];
	header("Location: index.php");*/
?>