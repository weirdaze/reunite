<?php
	include 'header.php';
	include 'config.php';

	$assigned_to = "";
	if(isset($_GET['assigned_to'])){
		$assigned_to = $_GET['assigned_to'];
	}
	
	$userid = $_SESSION['userid'];

	if($assigned_to == ""){
		$sql = "SELECT * from tickets where Status<>'closed'";
	}
	else {
		$sql = "SELECT * from tickets where Status<>'closed' where Agent='$userid'";
	}

	$result = mysqli_query($db,$sql);

	if($result) { 
		$pages = $result->num_rows;
	}
	else {
		$pages = 1;
	}
	$limit = 10;
	$pages = ceil($pages/$limit);
	// echo $pages;
	$active = "";
	$disableNext = "";
	if($pages == 1){
		$disableNext = "disabled";
	}

?>
<div class="container">
	<div class="d-flex align-items-center my-3">
		<a class="btn btn-secondary ml-2" href="admintools.php"><i class="fa fa-chevron-left"></i> Back</a>
		<a class="btn btn-info mr-2 ml-auto" href="display_tickets.php"><i class="fa fa-tags"></i> All Tickets</a>
		<a class="btn btn-info mr-2" href="display_tickets.php?assigned_to=me"><i class="fa fa-tag"></i> My Tickets</a>
	</div>
	<div class="d-flex justify-content-end mb-2">
		<nav id="ticketsPagination" class="ml-auto" data-total="<?php echo $pages; ?>" data-assigned_to="<?php echo $assigned_to; ?>">
			<ul class="pagination pagination-sm mb-0">
				<li id="prevPage" class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
				<?php
					for($i=1; $i<=$pages; $i++){
						if($i == 1){
							$active = "active";
						}
						else {
							$active = "";
						}

						if($pages >= 1000){
							if($i <= 3 || $i > ($pages-3)) {
				?>
								<li class="page-item <?php echo $active; ?>" data-page="<?php echo $i; ?>"><a class="page-link" href="#"><?php echo $i; ?></a></li>
				<?php				
							}
							else if($i == 4) {
				?>
								<li class="page-item disabled"><a class="page-link"><i class='fa fa-ellipsis-h'></i></a></li>
				<?php	
							}
						}
						else {
				?>
							<li class="page-item <?php echo $active; ?>" data-page="<?php echo $i; ?>"><a class="page-link" href="#"><?php echo $i; ?></a></li>
				<?php
						}
					}
				?>
				<li id="nextPage" class="page-item <?php echo $disableNext; ?>"><a class="page-link" href="#">&raquo;</a></li>
			</ul>
		</nav>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>Edit</th>
				<th>Ticket No.</th>
				<th>Match ID</th>
				<th>Agent</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody id="tickets">
			<?php include 'includes/tickets.php'; ?>
		</tbody>
	</table>
</div>
<?php include 'footer.php'?>