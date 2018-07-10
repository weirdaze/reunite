<?php
	include 'header.php';
	/*$uid_b = $_POST["uid"];*/
?>
<style>
	body {
		background-color: #eee;
	}
</style>
<?php
	if(isset($_GET['cleared'])){
?>
	<div class="alert alert-success alert-dismissible fade show m-3" role="alert">
		User successfully cleared!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php
	}
?>
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
		<input class="form-control mb-2 placeholder" type="date" name="dob">
	</div>
	<input class="btn btn-primary mx-3" type="submit" value="Find me">
</form>
<script>
	$("input[name='dob']").change(function(){
		$(this).removeClass("placeholder");
	});

	setTimeout(function(){
		$(".alert").slideUp(300);
	},2500);
</script>
<?php include 'footer.php'?>