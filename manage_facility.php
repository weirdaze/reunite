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
<?php
	session_start();
	$facility_name = $_GET['facility_name'];
	include 'config.php';

	$sql = "SELECT FacilityName, Address, POC, Status, city, state, zip, POC from facilities where FacilityName='".$facility_name."'";
	$result = mysqli_query($db,$sql);
	$row = $result->fetch_assoc();

	$facility_name = $row['FacilityName'];
	$address = $row['Address'];
	$status = $row['Status'];
	$poc = $row['POC'];
	$city = $row['city'];
	$state = $row['state'];
	$zip = $row['zip'];
?>
<form class="formBox pb-3" method="post" action="create_facility.php" name="updatefacility" onsubmit="return validateForm()">
	<div class="bg-info text-light p-2 mb-3 lead">
		<div>
			Update Facility <small><a class="text-warning" href="display_facilities.php"> (View Facilities)</a></small>
		</div>
	</div>

	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-building"></i></div>
		<input class="form-control mb-2" type="text" name="facility_name" value="<?php echo $facility_name; ?>" required>
		<small><p class="bg-warning" id="facility_name1"></p></small>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-address-card"></i></div>
		<input class="form-control mb-2" type="text" name="address" placeholder="Address" value="<?php echo $address; ?>">
		<small><p class="bg-warning" id="address1"></p></small>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-address-card"></i></div>
		<input class="form-control mb-2" type="text" name="city" placeholder="City" value="<?php echo $city; ?>"required>
		<small><p class="bg-warning" id="city1"></p></small>
	</div>
	<div class="form-group mx-3">
		<!-- <label class="">State:</label> -->
		<select class="custom-select form-control mb-2" name="state" value="<?php echo $state; ?>"required>
			<?php
				include 'state_select.php';
			?>
		</select>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-address-card"></i></div>
		<input class="form-control mb-2" type="text" name="zip" placeholder="Zip" maxlength="5" value="<?php echo $zip; ?>">
		<small><p class="bg-warning" id="zip1"></p></small>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="poc" placeholder="Point of contact full name" value="<?php echo $poc; ?>">
		<small><p class="bg-warning" id="poc1"></p></small>
	</div>
	<input class="btn btn-primary ml-3 mr-2" type="submit" value="Update">
	<a href="admintools.php" class="btn btn-secondary">Cancel</a>
</form>
<script>
	function validateForm() {
    	var facility_name = document.forms["updatefacility"]["facility_name"].value;
    	var address = document.forms["updatefacility"]["address"].value;
    	var city = document.forms["updatefacility"]["city"].value;
    	var zip = document.forms["updatefacility"]["zip"].value;
    	var poc = document.forms["updatefacility"]["poc"].value;

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
    	if (zip != ""){
    		if (isNaN(zip) || zip < 1 || zip > 99999) {
        		document.getElementById("zip1").innerHTML = "invalid zip code";
        		return false;
    		}
    	} 
    	if (poc.includes("'")) {
        	document.getElementById("poc1").innerHTML = "input cannot contain apostrophes";
        	return false;
    	} 
	}
</script>
<?php include 'footer.php'?>
