<?php
	include 'header_login.php';
	// this form is going to be for creating a facility
?>

<style>
	body {
		background-color: #eee;
	}
</style>
<?php
    include('config.php');
    $sql = "SELECT FacilityNumber, FacilityName, city, state FROM facilities";
	$result = mysqli_query($db,$sql);
	
?>
<form class="loginBox signin pb-3" method="post" action="create_facility.php">
	<div class="bg-info text-light p-2 mb-3 lead">Register</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="first_name" placeholder="First Name" required>
	</div>
    <div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="middle_name" placeholder="Middle Name">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="last_name" placeholder="Last Name" required>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="maternal_last_name" placeholder="Second Last Name">
	</div>
    <div class="form-group mx-3">
		<input class="form-control mb-2" type="date" name="dob" placeholder="Date of Birth" required>
	</div>
	<div class="form-group mx-3">
		<select class="form-control mb-2" name="facilities" required>
			<option value="m">M</option>
			<option value="f">F</option>
		</select>
	</div>
	<div class="form-group mx-3">
		<select class="form-control mb-2" name="facilities">
			<?php
			    while($row = $result->fetch_assoc()) {
	        		echo '<option value="'.$row['FacilityNumber'].'">'.$row['FacilityName'].' ('.$row['city'].', '.$row['state'].')</option>';
				}
			?>
    	</select>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-lock"></i></div>
		<input class="form-control mb-2" type="text" name="city" placeholder="city">
	</div><div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-lock"></i></div>
		<input class="form-control mb-2" type="text" name="state" placeholder="state">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-lock"></i></div>
		<input class="form-control mb-2" type="text" name="zip" placeholder="zip">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-lock"></i></div>
		<input class="form-control mb-2" type="text" name="poc" placeholder="point of contact full name">
	</div>
	<input class="btn btn-primary mx-3" type="submit" value="Create">
	<hr class="mx-3" />
</form>

<?php include 'footer_login.php'?>