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
		
	$sql = "SELECT TicketNumber, Match_ID, Agent, Status, Updates from tickets where Status<>'closed'";

	$result = mysqli_query($db,$sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$uid_a = $row['UID_A'];
			$uid_b = $row['UID_B'];
?>
			<tr>
				<td><a class="previewMatch text-primary ml-3" data-ticketnumber="<?php echo $row['TicketNumber']; ?>" data-matchID="<?php echo $row['Match_ID']; ?>" data-agent="<?php echo $row['Agent']; ?>"><i class="fa fa-eye"></i></a></td>
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