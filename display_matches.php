<?php
	include 'header.php';
	include('config.php');
?>
	<div class="col-1">
		<a href="admintools.php" class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Back</a>
	</div>
	<table class="table">
		<tr>
			<th>Preview</th>
			<th>Match ID</th>
			<th>Claimer</th>
			<th>Claimed</th>
			<th>Status</th>
		</tr>
<?php
		
	$sql = "SELECT Match_ID, UID_A, UID_B, DateMatched, Status from matches where Status<>'closed' ORDER BY DateMatched";

	$result = mysqli_query($db,$sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$uid_a = $row['UID_A'];
			$uid_b = $row['UID_B'];
			$date_matched = $row['DateMatched'];
			
			$sql2 = "SELECT FirstName, LastName from person where UID='$uid_a'";
			$result2 = mysqli_query($db,$sql2);
			$row2 = $result2->fetch_assoc();
			$uid_a_fn = $row2['FirstName'];
			$uid_a_ln = $row2['LastName'];

			$sql3 = "SELECT FirstName, LastName from person where UID='$uid_b'";
			$result3 = mysqli_query($db,$sql3);
			$row3 = $result3->fetch_assoc();
			$uid_b_fn = $row3['FirstName'];
			$uid_b_ln = $row3['LastName'];

?>
			<tr>
				<td><a class="previewMatch text-primary ml-3" data-matchID="<?php echo $row['Match_ID']; ?>" data-uid_a="<?php echo $row['UID_A']; ?>" data-uid_b="<?php echo $row['UID_B']; ?>"><i class="fa fa-eye"></i></a></td>
				<td><?php echo $row['Match_ID']; ?></td>
				<td><?php echo $uid_a_ln.", ".$uid_a_fn." (".$row['UID_A'].")"; ?></td>
			    <td><?php echo $uid_b_ln.", ".$uid_b_fn." (".$row['UID_B'].")"; ?></td>
				<td><?php echo $row['Status']; ?></td>
				<td><?php echo $row['DateMatched']; ?></td>
			</tr>
<?php
		}
	}
?>
	</table>
<?php include 'footer.php'?>