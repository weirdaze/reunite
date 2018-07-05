<?php include 'header.php'; ?>
	<?php 
		if(!isset($_SESSION['uid'])){
			/*echo "not set";*/
			header("Location: who_are_you.php");
		}
	?>
<div class="container py-3">
	<div id="selectPersonType">
		<?php include 'includes/userSelect.php'; ?>
	</div>
	<div class="showUserSelect text-center mb-2 text-secondary">
		<i class="fa fa-arrow-alt-circle-up fa-2x"></i>
	</div>
	<div class="row">
		<div class="col">
			<div class="form-group">
				<input id="searchInput" name="search" class="form-control" placeholder="Search..." data-gender="">
				<a id="searchIcon"><i class="fa fa-search"></i></a>
			</div>
		</div>
	</div>
	<div id="results">
		
	</div>
</div>
<?php include 'footer.php'; ?>