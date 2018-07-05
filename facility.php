<?php
	$admin = true;
	include 'header.php';
	// this form is going to be for creating a facility
?>

<style>
	body {
		background-color: #eee;
	}
</style>

<form class="formBox pb-3" method="post" action="create_facility.php">
	<div class="bg-info text-light p-2 mb-3 lead">Create Facility</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-building"></i></div>
		<input class="form-control mb-2" type="text" name="facility_name" placeholder="Name of the facility">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-address-card"></i></div>
		<input class="form-control mb-2" type="text" name="address" placeholder="Address">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-address-card"></i></div>
		<input class="form-control mb-2" type="text" name="city" placeholder="City">
	</div><div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-address-card"></i></div>
		<input class="form-control mb-2" type="text" name="state" placeholder="State">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-address-card"></i></div>
		<input class="form-control mb-2" type="text" name="zip" placeholder="Zip">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="poc" placeholder="Point of contact full name">
	</div>
	<input class="btn btn-primary ml-3 mr-2" type="submit" value="Create">
	<a href="admintools.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include 'footer.php'?>