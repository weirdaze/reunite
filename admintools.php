<?php
	$admin = true;
	include 'header.php';

	if(isset($_GET['clear_temp'])){
		$userid = $_SESSION['userid'];
		foreach(glob("media/photo/temp/*_$userid*") as $filename){
			unlink($filename);
		}
	}
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
				<a class="list-group-item d-flex align-items-center" href="display_tickets.php">
					<span class="menuIcon"><i class="fa fa-file-alt"></i></span>
					<span class="menuText">Manage Tickets</span>
				</a>
				<a class="list-group-item d-flex align-items-center" href="display_matches.php">
					<span class="menuIcon"><i class="fa fa-exchange-alt"></i></span>
					<span class="menuText">View Matches</span>
				</a>
				<?php
					if(isset($_SESSION['uid'])){
				?>
				<a class="list-group-item d-flex align-items-center" href="clear_user.php">
					<span class="menuIcon"><i class="fa fa-user-times"></i></span>
					<span class="menuText">Clear Current User</span>
				</a>
				<?php
					}
				?>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'?>