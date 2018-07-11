<?php
	include 'header.php';
	include('config.php');
?>
	<div class="col-1">
		<a href="admintools.php" class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Back</a>
	</div>
	<div>
		<a href=display_tickets.php>all tickets</a> | <a href=display_tickets.php?assigned=me>my tickets</a>
	</div>
	<table class="table">
		<tr>
			<th>Edit</th>
			<th>Ticket No.</th>
			<th>Match ID</th>
			<th>Agent</th>
			<th>Status</th>
		</tr>
<?php
	
	$assigned_to = $_GET['assigned'];
	$userid = $_SESSION['userid'];

	if($assigned_to == 'me'){
		$sql = "SELECT TicketNumber, Match_ID, Agent, Status, DateCreated FROM tickets WHERE Status<>'closed' AND Agent='$userid' ORDER BY DateCreated DESC";
	}
	else{
		$sql = "SELECT TicketNumber, Match_ID, Agent, Status, DateCreated FROM tickets WHERE Status<>'closed' ORDER BY DateCreated DESC";
	}
	

	$result = mysqli_query($db,$sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$match_id = $row['Match_ID'];
			$sql2 = "SELECT UID_A, UID_B from matches where Match_ID='".$match_id."'";
			$result2 = mysqli_query($db,$sql2);
			$row2 = $result2->fetch_assoc();
			$uid_a = $row2['UID_A'];
			$uid_b = $row2['UID_B'];
?>
			<tr>
				<td>eye</td>
				<td><?php echo $row['TicketNumber']; ?></td>
				<td><a class="previewMatch text-primary ml-3" data-matchID="<?php echo $row['Match_ID']; ?>" data-uid_a="<?php echo $row2['UID_A']; ?>" data-uid_b="<?php echo $row2['UID_B']; ?>"><?php echo $row['Match_ID']; ?></a></td>
				<td><?php echo $row['Agent']; ?></td>
				<td><?php echo $row['Status']; ?></td>
			</tr>
<?php
		}
	}
?>
	</table>
<?php include 'footer.php'?>