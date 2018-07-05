<?php
	include 'header_login.php';
	$uid_b = $_POST["uid"];

?>

<style>
	body {
		background-color: #eee;
	}
</style>
<form class="loginBox signin pb-3" method="post" action="its_me.php">
	<input type="hidden" name="uid_b" value=<?php echo '"'.$uid_b.'"' ?> />
	<div class="bg-info text-light p-2 mb-3 lead">Who Are you?</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="first_name" placeholder="First Name">
	</div>
    <div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="middle_name" placeholder="Middle Name">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="last_name" placeholder="Last Name">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="maternal_last_name" placeholder="Second Last Name">
	</div>
    <div class="form-group mx-3">
		<input class="form-control mb-2" type="date" name="dob" placeholder="Date of Birth">
	</div>
	<div class="form-group mx-3">
		<select class="form-control mb-2" name="sex" required>
			<option value="M">M</option>
			<option value="F">F</option>
		</select>
	</div>
	<input class="btn btn-primary mx-3" type="submit" value="Create">
	<hr class="mx-3" />

</form>
<?php include 'footer_login.php'?>