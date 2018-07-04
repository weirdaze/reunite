<?php
	include 'header_login.php';
	// this form is going to be for creating a facility
?>

<style>
	body {
		background-color: #eee;
	}
</style>

<form class="loginBox signin pb-3" method="post" action="create_facility.php">
	<div class="bg-info text-light p-2 mb-3 lead">Create Facility</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="facility_name" placeholder="Name of the Facility">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-lock"></i></div>
		<input class="form-control mb-2" type="text" name="address" placeholder="address">
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