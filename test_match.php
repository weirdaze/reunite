<?php
	include 'header_login.php';
?>

<style>
	body {
		background-color: #eee;
	}
</style>
<form class="loginBox signin pb-3" method="post" action="who_are_you.php">
	<div class="bg-info text-light p-2 mb-3 lead">Who Are you?</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="uid" placeholder="UID">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="uid" placeholder="UID">
	</div>
	<input class="btn btn-primary mx-3" type="submit" value="Create">
	<hr class="mx-3" />

</form>
<?php include 'footer_login.php'?>