<div class="d-flex align-items-center justify-content-center flex-wrap">
	<?php
		$gender = $_GET['gender'];

		include('../config.php');
		session_start();
		
		$sql = "SELECT * FROM person order by LastName";

		$result = mysqli_query($db,$sql);
		 
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
	?>
			<div class="person d-flex align-items-center flex-column justify-content-center" data-uid="<?php echo $row['UID']; ?>" data-gender="<?php echo $gender; ?>" data-fullname="<?php echo $row['FirstName'] . ' ' . $row['LastName']; ?>">
				<img src="media/photo/<?php echo $row['photo']; ?>" />
				<div class="caption"><?php echo $row['LastName'] . ", " . $row['FirstName']; ?></div>
			</div>	
	<?php
			}
		}
	?>
</div>