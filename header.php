<?php 
	if(!isset($admin)){
		$admin = false;
	}
	session_start();
	if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false){
		header("Location: login.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- js -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script type="text/javascript" src="css/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/functions.js"></script>
		<script type="text/javascript" src="js/main.js"></script>

		
		<!--- css --->
		<link rel="stylesheet" href="css/fontawesome/css/all.css">
		<link rel="stylesheet" href="css/bootstrap-4.0.0/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/main.css">

	    <title>ReUnite</title>
	</head>
	 
	<body>
		<header class="bg-dark p-2">
		    <h1><a class="text-light" href="index.php">Reunite</a></h1>
		    <div id="userMenu" class="dropdown ml-auto">
		    	<button class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    		<i class="fa fa-user mr-2"></i><?php echo $_SESSION['userid']; ?>
		    	</button>
			    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenu">
			    	<?php 
			    		if(!$admin){
			    	?>
				    	<a href="facility.php" class="dropdown-item text-light d-flex align-items-center">
				    		<span class="menuIcon"><i class="fa fa-cog"></i></span>
				    		<span class="menuText">Admin Tools</span>
				    	</a>
			    	<?php
			    		}
			    		else {
			    	?>
				    	<a href="index.php" class="dropdown-item text-light d-flex align-items-center">
				    		<span class="menuIcon"><i class="fa fa-home"></i></span>
				    		<span class="menuText">Home</span>
				    	</a>
			    	<?php
			    		}
			    	?>
				    <a href="login.php?logout=1" class="dropdown-item text-light d-flex align-items-center">
				    	<span class="menuIcon"><i class="fa fa-sign-out-alt mr-2"></i></span>
				    	<span class="menuText">Logout</span>
				    </a>
				</div>
			</div>
		</header>
			