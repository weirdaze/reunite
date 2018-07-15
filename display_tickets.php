<?php
	include 'header.php';
	include 'config.php';
?>
<div class="container">
	<div class="d-flex align-items-center mb-3">
		<a class="btn btn-secondary ml-2" href="admintools.php"><i class="fa fa-chevron-left"></i> Back</a>
		<a class="btn btn-info mr-2 ml-auto" href="display_tickets.php"><i class="fa fa-tags"></i> All Tickets</a>
		<a class="btn btn-info mr-2" href="display_tickets.php?assigned=me"><i class="fa fa-tag"></i> My Tickets</a>
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
	
	if(isset($_GET['assigned'])){
		$assigned_to = $_GET['assigned'];
	}
	else {
		$assigned_to = "";
	}
	
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
				<td>
					<a class="editTicket text-primary ml-2" data-ticket_id="<?php echo $row['TicketNumber'] ?>"><i class="fa fa-edit"></i></a>
				</td>
				<td><?php echo $row['TicketNumber']; ?></td>
				<td>
					<a class="previewMatch text-primary mr-2" data-toggle="tooltip" data-title="Preview Match" data-match_id="<?php echo $row['Match_ID']; ?>" data-uid_a="<?php echo $row2['UID_A']; ?>" data-uid_b="<?php echo $row2['UID_B']; ?>"><i class="fa fa-eye"></i></a><?php echo $row['Match_ID']; ?>
				</td>
				<td>
					<?php echo $row['Agent']; ?>
				</td>
				<td>
					<?php echo $row['Status']; ?>
				</td>
			</tr>
<?php
		}
	}
?>
		</table>
</div>
<script>
	$(".previewMatch").tooltip();
</script>
<?php include 'footer.php'?>