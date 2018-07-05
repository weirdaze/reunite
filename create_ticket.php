<?php
	include 'header.php';
?>

<style>
	body {
		background-color: #eee;
	}
</style>

<form class="formBox pb-3" method="post" action="create_ticket.php">
	<div class="bg-info text-light p-2 mb-3 lead">Create Ticket</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-id-card"></i></div>
		<input class="form-control mb-2" type="text" name="firstname" placeholder="Ticket Name">
	</div>
	<input class="btn btn-primary ml-3 mr-2" type="submit" value="Create Ticket">
	<a href="admintools.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include 'footer.php'?>