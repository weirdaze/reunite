<?php
	$admin = true;
	include 'header.php';
?>
<div class="container">
	<div class="row">
		<div class="col">
			<h2 class="mt-3">Admin Tools</h2>
			<div class="list-group mt-3">
				<a class="list-group-item d-flex align-items-center" href="add_user.php">
					<span class="menuIcon"><i class="fa fa-user-plus"></i></span>
					<span class="menuText">Add User</span>
				</a>
				<a class="list-group-item d-flex align-items-center" href="facility.php">
					<span class="menuIcon"><i class="fa fa-building"></i></span>
					<span class="menuText">Create Facility</span>
				</a>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'?>