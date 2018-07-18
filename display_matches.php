<?php
	include 'header.php';
	include 'config.php';

	$sql = "SELECT * from matches where Status<>'closed'";

	$result = mysqli_query($db,$sql);

	$pages = $result->num_rows;
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
	<div class="d-flex align-items-center mb-3">
		<a href="admintools.php" class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Back</a>
		<nav id="matchesPagination" class="ml-auto" data-total="<?php echo $pages; ?>">
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

						if($pages >= 10){
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
				<th>Preview</th>
				<th>Match ID</th>
				<th>Claimer</th>
				<th>Claimed</th>
				<th>Status</th>
				<th>Date Created</th>
			</tr>
		</thead>
		<tbody id="matches">
			<?php include 'includes/matches.php' ?>
		</tbody>
	</table>
</div>
<?php include 'footer.php'?>