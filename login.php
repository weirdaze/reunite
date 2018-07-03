<?php
	include 'header_login.php';
?>

<style>
	body {
		background-color: #eee;
	}
</style>

<?php
	if(isset($_GET["logout"]) || isset($_GET["error"])){
		if(isset($_GET["logout"])){
			$alertClass = "alert-success";
			$message = "You have been successfully logged out";
		}
		else {
			$alertClass = "alert-danger";
			switch($_GET["error"]){
				case "1":
					$message = "Invalid username or password";
					break;
			}
			
		}
?>
	<div class="alert <?php echo $alertClass; ?> alert-dismissible fade show m-3" role="alert">
		<?php echo $message; ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php
	}
?>

<form class="loginBox signin pb-3" method="post" action="processlogin.php">
	<div class="bg-info text-light p-2 mb-3 lead">Sign In</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="username" placeholder="Username">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-lock"></i></div>
		<input class="form-control mb-2" type="password" name="password" placeholder="Password">
	</div>
	<input class="btn btn-primary mx-3" type="submit" value="Sign In">
	<hr class="mx-3" />
	<span class="small mx-3">Don't have an account? <a class="switchLogin text-primary">Sign Up Here</a></span>
</form>
<form class="loginBox signup pb-3" method="post" action="processlogin.php">
	<div class="bg-info text-light p-2 mb-3 lead">Sign Up</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="firstname" placeholder="First Name">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="password" name="middlename" placeholder="Middle Name">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="password" name="lastname" placeholder="Last Name">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-lock"></i></div>
		<input class="form-control mb-2" type="password" name="createpassword" placeholder="Password">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-lock"></i></div>
		<input class="form-control mb-2" type="password" name="confirmpassword" placeholder="Confirm Password">
	</div>
	<input class="btn btn-primary mx-3" type="submit" value="Sign Up">
	<hr class="mx-3" />
	<span class="small mx-3">Already have an account? <a class="switchLogin text-primary">Sign In Here</a></span>
</form>

<script>
	setTimeout(function(){
		$(".alert-success").slideUp(300);
	},2500);
	
	$(".switchLogin").click(function(){
		$(".signin, .signup").toggle();
		$(".alert").slideUp(300);
	});
</script>

<?php include 'footer_login.php'?>