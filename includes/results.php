<div class="d-flex align-items-center justify-content-center flex-wrap">
	<?php
		$search_term = "";
		$gender = "";
		if(isset($_GET['gender'])){
			$gender = $_GET['gender'];
		}
		
		if(isset($_GET['search_term'])){
			$search_term = TRIM($_GET['search_term']);
		}

		include('../config.php');
		session_start();
		
		$sql = "SELECT * FROM person where ";

		if($gender != ""){
			$sql = $sql . "sex = '$gender' and ";
		} 

		$sql =  $sql . "(UPPER(FirstName) like UPPER('%$search_term%') or UPPER(LastName) like UPPER('%$search_term%')) and type='Adult' order by LastName";

		$result = mysqli_query($db,$sql);
		 
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
	?>
			<div class="person d-flex align-items-center flex-column justify-content-center" data-uid="<?php echo $row['UID']; ?>" data-gender="<?php echo $row['Sex']; ?>" data-fullname="<?php echo $row['FirstName'] . ' ' . $row['LastName']; ?>">
				<div class="personImg" style="background-image: url('media/photo/<?php echo $row['photo']; ?>');"></div>
				<div class="caption"><?php echo $row['LastName'] . ", " . $row['FirstName']; ?></div>
			</div>	
	<?php
			}
		}
	?>
</div>