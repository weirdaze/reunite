<?php include 'header.php'; ?>
	<?php 
		if(!isset($_SESSION['uid'])){
			// header("Location: who_are_you.php");
		}
	?>
<div class="container py-3">
	<?php 
		if(isset($_SESSION['uid'])){
			$person_type = "adult";
	?>
		<div id="selectPersonType">
			<?php include 'includes/userSelect.php'; ?>
		</div>

		<div class="showUserSelect text-center mb-2 text-secondary">
			<i class="fa fa-arrow-alt-circle-up fa-2x"></i>
		</div>
	<?php
		}
		else {
			$person_type = "child";
			echo "<h2 class='text-center mb-3'>¿Quién eres tú?</h2>";
		}
	?>

	
	<div class="row">
		<div class="col">
			<div class="form-group">
				<input id="searchInput" name="search" class="form-control" placeholder="Search..." data-gender="*" data-person_type="<?php echo $person_type; ?>">
				<a id="searchIcon"><i class="fa fa-search"></i></a>
			</div>	
		</div>
	</div>
	<div id="results" class="d-flex align-items-center justify-content-center flex-wrap">
		
	</div>
</div>
<?php include 'footer.php'; ?>