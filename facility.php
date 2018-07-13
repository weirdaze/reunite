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

<form class="formBox pb-3" method="post" action="create_facility.php" name="createfacility" onsubmit="return validateForm()">
	<div class="bg-info text-light p-2 mb-3 lead">Create Facility</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-building"></i></div>
		<input class="form-control mb-2" type="text" name="facility_name" placeholder="Name of the facility" required>
		<p id="facility_name1"></p>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-address-card"></i></div>
		<input class="form-control mb-2" type="text" name="address" placeholder="Address">
		<p id="address1"></p>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-address-card"></i></div>
		<input class="form-control mb-2" type="text" name="city" placeholder="City" required>
		<p id="city1"></p>
	</div>
	<div class="form-group mx-3">
		<!-- <label class="">State:</label> -->
		<select class="custom-select form-control mb-2" name="state" required>
			<?php
				include 'state_select.php';
			?>
		</select>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-address-card"></i></div>
		<input class="form-control mb-2" type="text" name="zip" placeholder="Zip" maxlength="5">
		<p id="zip1"></p>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="poc" placeholder="Point of contact full name">
		<h6><p color="red" id="poc1"></p></h6>
	</div>
	<input class="btn btn-primary ml-3 mr-2" type="submit" value="Create">
	<a href="admintools.php" class="btn btn-secondary">Cancel</a>
</form>
<script>
	function validateForm() {
    	var facility_name = document.forms["createfacility"]["facility_name"].value;
    	var address = document.forms["createfacility"]["address"].value;
    	var city = document.forms["createfacility"]["city"].value;
    	var zip = document.forms["createfacility"]["zip"].value;
    	var poc = document.forms["createfacility"]["poc"].value;

    	if (facility_name.includes("'")) {
        	document.getElementById("facility_name1").innerHTML = "input cannot contain apostrophes";
        	return false;
    	}
    	if (address.includes("'")) {
        	document.getElementById("address1").innerHTML = "input cannot contain apostrophes";
        	return false;
    	}
    	if (city.includes("'")) {
        	document.getElementById("city1").innerHTML = "input cannot contain apostrophes";
        	return false;
    	}
    	if (isNaN(zip) || zip < 1 || zip > 99999) {
        	document.getElementById("zip1").innerHTML = "invalid zip code";
        	return false;
    	}
    	if (poc.includes("'")) {
        	document.getElementById("poc1").innerHTML = "input cannot contain apostrophes";
        	return false;
    	}
	}
</script>
<?php include 'footer.php'?>








