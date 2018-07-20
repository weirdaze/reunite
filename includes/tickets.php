
<?php
	session_start();
	$page = 0;
	$assigned_to = $_GET['assigned_to'];
	if(isset($_GET['page'])){
		include('../config.php');
		$page = intval($_GET['page']) - 1;
		$assigned_to = $_GET['assigned_to'];
	}
	$limit = 10;
	$start = $page*$limit;

	$userid = $_SESSION['userid'];

	if($assigned_to == 'me'){
		$sql = "SELECT TicketNumber, Match_ID, Agent, Status, DateCreated FROM tickets WHERE Status<>'closed' AND Agent='$userid' ORDER BY DateCreated DESC LIMIT $start,$limit";
	}
	else{
		$sql = "SELECT TicketNumber, Match_ID, Agent, Status, DateCreated FROM tickets WHERE Status<>'closed' ORDER BY DateCreated DESC LIMIT $start,$limit";
	}
	echo ("assigned_to: ".$assigned_to.". how about that.");
	echo ($sql);
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
?>
		<script>
			$(".previewMatch").tooltip();
		</script>
<?php
	}
?>