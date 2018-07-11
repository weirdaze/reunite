<?php
	include 'header.php';
	include 'config.php';
?>
<div class="container">
	<div class="alert alert-success lead">Claim Successfully Submitted!</div>
	
	<?php 
		$_GET['uid_a'] = $_SESSION['uid'];
		$_GET['uid_b'] = $_GET['uid'];
		include 'match_info.php'; 
	?>
	
	<div class="d-flex align-items-center justify-content-end my-3">
		<a href="clear_user.php" class="btn btn-secondary mr-2">Clear User</a>
		<a href="index.php" class="btn btn-primary">Claim Another Person</a>
	</div>
</div>
<?php include 'footer.php'?>