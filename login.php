<?php
	include 'header_login.php';
	$showForm = 1;
	include('config.php');
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
			$error = $_GET["error"];
			switch($error){
				case 1:
					$message = "Invalid username or password";
					$showForm = 1;
					break;
				case 2:
					$message = "Passwords do not match";
					$showForm = 2;
					break;
				case 3:
					$message = "Username already in the database";
					$showForm = 2;
					break;
			}
			
		}
?>
	<div class="loginalert alert <?php echo $alertClass; ?> alert-dismissible fade show m-3" role="alert">
		<?php echo $message; ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php
	}
?>

<form class="loginBox signin pb-3 <?php if($showForm == 2){ echo "hidden"; } ?>" method="post" action="processlogin.php">
	<div class="bg-info text-light px-3 py-2 mb-3 lead">Sign In</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="username" placeholder="Username">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-lock"></i></div>
		<input class="form-control mb-2" type="password" name="password" placeholder="Password">
	</div>
	<div class="form-group mx-3">
		<select class="custom-select form-control mb-2" name="current_facility" required>
			<option></option>
			<?php
				$sql = "SELECT FacilityNumber, FacilityName, city, state FROM facilities ORDER BY FacilityName ASC";
				$result = mysqli_query($db,$sql);
			    while($row = $result->fetch_assoc()) {
	        		echo '<option value="'.$row['FacilityNumber'].'">'.$row['FacilityName'].' ('.$row['city'].', '.$row['state'].')</option>';
				}
			?>
    	</select>
	</div>
	<input class="btn btn-primary mx-3" type="submit" value="Sign In">
	<hr class="mx-3" />
	<span class="small mx-3">Don't have an account? <a class="switchLogin text-primary">Sign Up Here</a></span>
</form>
<form class="loginBox signup pb-3 <?php if($showForm == 1){ echo "hidden"; } ?>" method="post" action="processlogin.php">
	<div class="bg-info text-light px-3 py-2 mb-3 lead">Sign Up</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-id-card"></i></div>
		<input class="form-control mb-2" type="text" name="firstname" placeholder="First Name">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-id-card"></i></div>
		<input class="form-control mb-2" type="text" name="middlename" placeholder="Middle Name">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-id-card"></i></div>
		<input class="form-control mb-2" type="text" name="lastname" placeholder="Last Name">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-id-card"></i></div>
		<input class="form-control mb-2" type="text" name="employeeid" placeholder="Employee ID">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="createusername" placeholder="Create Username">
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
		$(".signin, .signup").toggleClass("hidden");
		$(".alert").slideUp(300);
	});

	$(".custom-select").select2({
		placeholder: "Choose Facility"
	});
</script>

<?php include 'footer_login.php'?>