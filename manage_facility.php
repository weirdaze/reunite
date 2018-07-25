<?php
	session_start();
	$facility_name = $_GET['facility_name'];
	include 'config.php';

	$sql = "SELECT FacilityNumber, FacilityName, Address, POC, Status, city, state, zip, POC from facilities where FacilityName='".$facility_name."'";
	$result = mysqli_query($db,$sql);
	$row = $result->fetch_assoc();

	$facility_name = $row['FacilityName'];
	$address = $row['Address'];
	$status = $row['Status'];
	$poc = $row['POC'];
	$city = $row['city'];
	$state = $row['state'];
	$zip = $row['zip'];
	if($zip == '0'){
		$zip = '';
	}
	$facility_number = $row['FacilityNumber'];
?>
<h2>Update Facility</h2>
<form id="update_facility" method="post" action="update_facility.php" name="updatefacility">
	<div class="form-group">
		<input type="hidden" name="facility_number" value="<?php echo $facility_number; ?>">
	</div>
	<div class="form-group icon-group">
		<div class="input-icon"><i class="fa fa-building"></i></div>
		<input class="form-control mb-2" type="text" name="facility_name" value="<?php echo $facility_name; ?>" pattern="[A-Za-z0-9 &#.-]+"  required>
		<small><p class="bg-warning" id="facility_name1"></p></small>
	</div>
	<div class="form-group icon-group">
		<div class="input-icon"><i class="fa fa-address-card"></i></div>
		<input class="form-control mb-2" type="text" name="address" placeholder="Address" value="<?php echo $address; ?>" pattern="[0-9]+[ -][0-9A-Za-z .#-]+">
		<small><p class="bg-warning" id="address1"></p></small>
	</div>
	<div class="form-group icon-group">
		<div class="input-icon"><i class="fa fa-address-card"></i></div>
		<input class="form-control mb-2" type="text" name="city" placeholder="City" value="<?php echo $city; ?>" pattern="[A-Za-z0-9 &#.-]+" required>
		<small><p class="bg-warning" id="city1"></p></small>
	</div>
	<div class="form-group">
		<!-- <label class="">State:</label> -->
		<select class="custom-select form-control mb-2" name="state" required>
			<?php
				include 'state_select.php';
			?>
			<option value="<?php echo $state; ?>" selected="selected"><?php echo $state; ?></option>
		</select>
	</div>
	<div class="form-group icon-group">
		<div class="input-icon"><i class="fa fa-address-card"></i></div>
		<input class="form-control mb-2" type="text" name="zip" placeholder="Zip" maxlength="5" value="<?php echo $zip; ?>" pattern="^[0-9]{5}(?:-[0-9]{4})?$">
		<small><p class="bg-warning" id="zip1"></p></small>
	</div>
	<div class="form-group icon-group">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="poc" placeholder="Notes" value="<?php echo $poc; ?>" pattern="[0-9A-Za-z :,!@%*/?&)(.#-]+">
		<small><p class="bg-warning" id="poc1"></p></small>
	</div>
	<div class="alert alert-warning small px-2 d-inline-block" role="alert">
		<i class="fa fa-exclamation-triangle text-danger"></i>
		Apostrophes are not allowed within text inputs
	</div>
	<!-- <input id="update_facility" type="submit" class="collapse" value="submit"> -->
</form>
<script>
	function validateForm() {
    	var facility_name = document.forms["updatefacility"]["facility_name"].value;
    	var address = document.forms["updatefacility"]["address"].value;
    	var city = document.forms["updatefacility"]["city"].value;
    	var zip = document.forms["updatefacility"]["zip"].value;
    	var poc = document.forms["updatefacility"]["poc"].value;

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
</script>
