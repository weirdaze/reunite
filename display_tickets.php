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
			<th>Ticket No.</th>
			<th>Match ID</th>
			<th>Agent</th>
			<th>Status</th>
		</tr>
<?php
		
	$sql = "SELECT TicketNumber, Match_ID, Agent, Status from tickets where Status<>'closed'";

	$result = mysqli_query($db,$sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$sql2 = "SELECT UID_A, UID_B from matches where Match_ID='$row['Match_ID']'";
			$result2 = mysqli_query($db,$sql2);
			$row2 = $result2->fetch_assoc()
			$uid_a = $row2['UID_A'];
			$uid_b = $row2['UID_B'];
?>
			<tr>
				<td>eye</td>
				<td><?php echo $row['TicketNumber']; ?></td>
				<td><a class="previewMatch text-primary ml-3" data-matchID="<?php echo $row['Match_ID']; ?>" data-uid_a="<?php echo $row['UID_A']; ?>" data-uid_b="<?php echo $row['UID_B']; ?>"><?php echo $row['Match_ID']; ?></a></td>
				<td><?php echo $row['Agent']; ?></td>
				<td><?php echo $row['Status']; ?></td>
			</tr>
<?php
		}
	}
?>
	</table>
<?php include 'footer.php'?>