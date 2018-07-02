<div class="d-flex align-items-center justify-content-center flex-wrap">
	<?php
		$person_type_id = $_GET['person_type_id'];

		$servername = "tun1.centerpointcc.net";
		$username = "root";
		$password = "R3unite123";
		$dbname = "reunite";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT * FROM person";
		$result = $conn->query($sql);
		 
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
	?>
			<div class="person d-flex align-items-center flex-column justify-content-center" data-uid="<?php echo $row['UID']; ?>" data-person_type_id="<?php echo $person_type_id; ?>">
				<i class="fa fa-male fa-7x"></i>
				<div class="caption"><?php echo $row['FirstName'] . " " . $row['LastName']; ?></div>
			</div>	
	<?php
			}
		}
		$conn->close();
	?>
</div>