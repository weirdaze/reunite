<?php
	$admin = 1;
	include 'header.php';
	// this form is going to be for creating a user
?>

<style>
	body {
		background-color: #eee;
	}
</style>
<form class="loginBox signin pb-3" method="post" action="update_ticket_status.php">
	<div class="bg-info text-light p-2 mb-3 lead">Who Are you?</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="ticket_number" placeholder="Ticket Number">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="update" placeholder="Update">
	</div>
	<input class="btn btn-primary mx-3" type="submit" value="Change">
	<hr class="mx-3" />

</form>
<?php include 'footer_login.php'?>