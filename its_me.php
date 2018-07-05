<?php
	$uid_b = $_POST["uid_b"];
	$first_name = $_POST["first_name"];
	$middle_name = $_POST["middle_name"];
	$last_name = $_POST["last_name"];
	$maternal_last_name = $_POST["maternal_last_name"];
	$sex = $_POST["sex"];
	$dob = $_POST["dob"];

	include('config.php');

	$sql = "SELECT * FROM person where 
	        UPPER(FirstName) like UPPER('%$first_name%') or UPPER(LastName) like UPPER('%$last_name%') or
	        UPPER(MiddleName) like UPPER('%$middle_name%') or UPPER(MaternalLastName) like UPPER('%$maternal_last_name%') or
	        UPPER(DOB) like UPPER('%$dob%') or UPPER(Sex) like UPPER('%$sex%')
	        order by LastName";
	echo $sql;

	$result = mysqli_query($db,$sql);

	if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
	?>
			<div class="person d-flex align-items-center flex-column justify-content-center" data-uid="<?php echo $row['UID']; ?>" data-gender="<?php echo $row['Sex']; ?>" data-fullname="<?php echo $row['FirstName'] . ' ' . $row['LastName']; ?>">
				<img src="media/photo/<?php echo $row['photo']; ?>" />
				<div class="caption"><?php echo $row['LastName'] . ", " . $row['FirstName']; ?></div>
			</div>	
	<?php
			}
		}
	?>
?>