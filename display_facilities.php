<?php
	include 'header.php';
	include('config.php');
?>
	<div class="col-1">
		<a href="facility.php" class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Back</a>
	</div>
	<table class="table">
		<tr>
			<th>Preview</th>
			<th>Facility Name</th>
			<th>City</th>
			<th>State</th>
			<th>Date Updated</th>
		</tr>
<?php
		
	$sql = "SELECT FacilityName, city, state, zip, last_updated from facilities ORDER BY FacilityName ASC";

	$result = mysqli_query($db,$sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {

?>
			<tr>
				<td><a class="previewMatch text-primary ml-3" data-match_id="<?php echo $row['Match_ID']; ?>" data-uid_a="<?php echo $row['UID_A']; ?>" data-uid_b="<?php echo $row['UID_B']; ?>"><i class="fa fa-eye"></i></a></td>
				<td><?php echo $row['FacilityName']; ?></td>
				<td><?php echo $row['city']; ?></td>
			    <td><?php echo $row['state']; ?></td>
				<td><?php echo $row['last_updated']; ?></td>
			</tr>
<?php
		}
	}
?>
	</table>
	<?php echo "Number of Facilities: ".$result->num_rows; ?>
<?php include 'footer.php'?>