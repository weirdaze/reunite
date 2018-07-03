<div class="d-flex align-items-center justify-content-center flex-wrap">
	<?php
		$person_type_id = $_GET['person_type_id'];

		include('../config.php');
		session_start();
		
		$sql = "SELECT * FROM person order by LastName";

		$result = mysqli_query($db,$sql);
		 
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
	?>
			<div class="person d-flex align-items-center flex-column justify-content-center" data-uid="<?php echo $row['UID']; ?>" data-person_type_id="<?php echo $person_type_id; ?>">
				<img src="../media/photo/<?php echo $row['photo']; ?>" />
				<div class="caption"><?php echo $row['LastName'] . ", " . $row['FirstName']; ?></div>
			</div>	
	<?php
			}
		}
	?>
</div>