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

<form class="formBox pb-3" method="post" action="create_facility.php" name="createfacility">
	<div class="bg-info text-light p-2 mb-3 lead">
		<div>
			Create Facility <small><a class="text-warning" href="display_facilities.php"> (View Facilities)</a></small>
		</div>
	</div>

	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-building"></i></div>
		<input class="form-control mb-2" type="text" name="facility_name" placeholder="Name of the facility" pattern="[A-Za-z0-9 &#.-]+" required>
		<small><p class="bg-warning" id="facility_name1"></p></small>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-address-card"></i></div>
		<input class="form-control mb-2" type="text" name="address" placeholder="Address" pattern="[0-9]+[ -][0-9A-Za-z .#-]+">
		<small><p class="bg-warning" id="address1"></p></small>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-address-card"></i></div>
		<input class="form-control mb-2" type="text" name="city" placeholder="City" pattern="[A-Za-z0-9 &#.-]+" required>
		<small><p class="bg-warning" id="city1"></p></small>
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
		<input class="form-control mb-2" type="text" name="zip" placeholder="Zip" maxlength="5" pattern="^[0-9]{5}(?:-[0-9]{4})?$">
		<small><p class="bg-warning" id="zip1"></p></small>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="poc" placeholder="Notes" pattern="[0-9A-Za-z :,!@%*/?&)(.#-]+">
		<small><p class="bg-warning" id="poc1"></p></small>
	</div>
	<div class="alert alert-warning small px-2 mx-3" role="alert">
		<i class="fa fa-exclamation-triangle text-danger"></i>
		Apostrophes are not allowed within text inputs
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

    	if (facility_name.includes("'") || facility_name.includes(",")) {
        	document.getElementById("facility_name1").innerHTML = "input cannot contain apostrophes or commas";
        	return false;
    	} 
    	if (address.includes("'") || address.includes(",")) {
        	document.getElementById("address1").innerHTML = "input cannot contain apostrophes or commas";
        	return false;
    	} 
    	if (city.includes("'") || city.includes(",")) {
        	document.getElementById("city1").innerHTML = "input cannot contain apostrophes or commas";
        	return false;
    	} 
    	if (zip.includes("'") || zip.includes(",")){
        	document.getElementById("zip1").innerHTML = "invalid zip code or commas";
        	return false;
    	} 
    	if (poc.includes("'") || poc.includes(",")) {
        	document.getElementById("poc1").innerHTML = "input cannot contain apostrophes or commas";
        	return false;
    	} 
	}
	$(".custom-select").select2({
		placeholder: "Choose State"
	});
</script>
<?php include 'footer.php'?>








