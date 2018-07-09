<?php
	include 'header.php';
	include('config.php');
?>
	<table class="table">
		<tr>
			<th>Preview</th>
			<th>Match ID</th>
			<th>Claimer</th>
			<th>Claimed</th>
			<th>Status</th>
		</tr>
<?php
		
	$sql = "SELECT Match_ID, UID_A, UID_B, Status from matches where Status<>'closed'";

	$result = mysqli_query($db,$sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$uid_a = $row['UID_A'];
			$uid_b = $row['UID_B'];
?>
			<tr>
				<td><a class="previewMatch text-primary ml-3" data-matchID="<?php echo $row['Match_ID']; ?>" data-uid_a="<?php echo $row['UID_A']; ?>" data-uid_b="<?php echo $row['UID_B']; ?>"><i class="fa fa-eye"></i></a></td>
				<td><?php echo $row['Match_ID']; ?></td>
				<td><?php echo $row['UID_A']; ?></td>
				<td><?php echo $row['UID_B']; ?></td>
				<td><?php echo $row['Status']; ?></td>
			</tr>
<?php
		}
	}
?>
	</table>
<?php include 'footer.php'?>