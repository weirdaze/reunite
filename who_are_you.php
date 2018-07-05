<?php
	include 'header.php';
	/*$uid_b = $_POST["uid"];*/
?>
<style>
	body {
		background-color: #eee;
	}
</style>
<form class="formBox pb-3" method="post" action="its_me.php">
	<div class="bg-info text-light p-2 mb-3 lead">Who Are you?</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-id-card"></i></div>
		<input class="form-control mb-2" type="text" name="first_name" placeholder="First Name">
	</div>
    <div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-id-card"></i></div>
		<input class="form-control mb-2" type="text" name="middle_name" placeholder="Middle Name">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-id-card"></i></div>
		<input class="form-control mb-2" type="text" name="last_name" placeholder="Last Name">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-id-card"></i></div>
		<input class="form-control mb-2" type="text" name="maternal_last_name" placeholder="Second Last Name">
	</div>
	<label class="ml-3">Date of Birth:</label>
    <div class="form-group mx-3">
    	<div class="input-icon"><i class="fa fa-calendar-alt"></i></div>
		<input class="form-control mb-2" type="date" name="dob">
	</div>
	<input class="btn btn-primary mx-3" type="submit" value="Find me">
</form>
<?php include 'footer.php'?>