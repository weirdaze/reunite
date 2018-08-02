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
				<?php
					if($_SESSION['admin'] == '1'){
				?>
				<a class="list-group-item d-flex align-items-center" href="facility.php">
					<span class="menuIcon"><i class="fa fa-building"></i></span>
					<span class="menuText">Manage Facilities</span>
				</a>
				<?php
					}
				?>
				<a class="list-group-item d-flex align-items-center" href="display_tickets.php">
					<span class="menuIcon"><i class="fa fa-file-alt"></i></span>
					<span class="menuText">Manage Tickets</span>
				</a>
				<a class="list-group-item d-flex align-items-center" href="display_matches.php">
					<span class="menuIcon"><i class="fa fa-exchange-alt"></i></span>
					<span class="menuText">View Matches</span>
				</a>
				<a class="list-group-item d-flex align-items-center" href="test_graph.php">
					<span class="menuIcon"><i class="fa fa-chart-pie"></i></span>
					<span class="menuText">View Data</span>
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
		</div>
	</div>
</div>

<?php include 'footer.php'?>