<?php
	/*$uid_b = $_POST["uid_b"];*/
	$first_name = $_POST["first_name"];
	$middle_name = $_POST["middle_name"];
	$last_name = $_POST["last_name"];
	$maternal_last_name = $_POST["maternal_last_name"];
	$dob = $_POST["dob"];
	$first_name_q = '';
	$middle_name_q = '';
	$last_name_q = '';
	$maternal_last_name_q = '';
	$dob_q = '';

	include('config.php');

	$sql = "SELECT * FROM person ";
	$where = " where";
	$or = ' OR ';
	$orderBy = "order by LastName";
	$count = 0;

	if ($first_name != ''){
		$first_name_q = " UPPER(FirstName) like UPPER('%$first_name%') ";
		$count = $count + 1;
	}
	if ($middle_name != ''){
		$middle_name_q = " UPPER(MiddleName) like UPPER('%$middle_name%') ";
		$count = $count + 1;
	}
	if ($last_name != ''){
		$last_name_q = " UPPER(LastName) like UPPER('%$last_name%') ";
		$count = $count + 1;
	}
	if ($maternal_last_name != ''){
		$maternal_last_name_q = " UPPER(MaternalLastName) like UPPER('%$maternal_last_name%') ";
		$count = $count + 1;
	}
	if ($dob != ''){
		$dob_q = " UPPER(DOB) like UPPER('%$dob%') ";
		$count = $count + 1;
	}

	/*echo $count;*/

	if ($count >= 1){
		$sql = $sql.$where;
	}
	if ($first_name_q != ''){
		$sql = $sql.$first_name_q;
		if ($count > 1){
			$count = $count - 1;
			$sql = $sql.$or;
		}

	}
	if ($middle_name_q != ''){
		$sql = $sql.$middle_name_q;
		if ($count > 1){
			$count = $count - 1;
			$sql = $sql.$or;
		}
	}
	if ($last_name_q != ''){
		$sql = $sql.$last_name_q;
		if ($count > 1){
			$count = $count - 1;
			$sql = $sql.$or;
		}
	}
	if ($maternal_last_name_q != ''){
		$sql = $sql.$maternal_last_name_q;
		if ($count > 1){
			$count = $count - 1;
			$sql = $sql.$or;
		}
	}
	if ($dob_q != ''){
		$sql = $sql.$dob_q;
		if ($count > 1){
			$count = $count - 1;
			$sql = $sql.$or;
		}
	}

	include("header.php");
?>
<div class="container">

	<h2 class="text-center my-3"><a id="goBack" href="who_are_you.php" data-toggle="tooltip" data-title="Return to Form"><i class="fa fa-arrow-circle-left"></i></a> Encuéntrate en las imágenes</h2>
	<div id="results" class="d-flex align-items-center justify-content-center flex-wrap">
	<?php
		$sql = $sql.$orderBy;

		/*echo $sql;*/

		$result = mysqli_query($db,$sql);

		if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
	?>
				<div class="child d-flex align-items-center flex-column justify-content-center" data-uid="<?php echo $row['UID']; ?>" data-gender="<?php echo $row['Sex']; ?>" data-fullname="<?php echo $row['FirstName'] . ' ' . $row['LastName']; ?>">
					<div class="personImg" style="background-image: url('media/photo/<?php echo $row['photo']; ?>');"></div>
					<div class="caption"><?php echo $row['LastName'] . ", " . $row['FirstName']; ?></div>
				</div>	
		<?php
				}
			}
		?>
	</div>
</div>
<script>
	$("#goBack").tooltip();
</script>
<?php include("footer.php"); ?>