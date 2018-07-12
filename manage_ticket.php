<?php
	session_start();
	$ticket_number = $_GET['ticket_id'];
	include 'config.php';

	$sql = "SELECT TicketNumber, Match_ID, Agent, Status from tickets where TicketNumber='".$ticket_number."'";
	$result = mysqli_query($db,$sql);
	$row = $result->fetch_assoc();
	$match_id = $row['Match_ID'];
	$agent = $row['Agent'];
	$status = $row['Status'];


	$sql2 = "SELECT UID_A, UID_B, DateMatched from matches where Match_ID='".$match_id."'";
	$result2 = mysqli_query($db,$sql2);
	$row2 = $result2->fetch_assoc();
	$uid_a = $row2['UID_A'];
	$uid_b = $row2['UID_B'];
	$date_matched = $row2['DateMatched'];


	$sql3 = "SELECT FirstName, LastName, photo from person where UID='".$uid_a."'";

	$result3 = mysqli_query($db,$sql3);
	$row3 = $result3->fetch_assoc();

	$uid_a_fn = $row3['FirstName'];
	$uid_a_ln = $row3['LastName'];
	$uid_a_photo = $row3['photo'];


	$sql4 = "SELECT FirstName, LastName, photo from person where UID='".$uid_b."'";

	$result4 = mysqli_query($db,$sql4);
	$row4 = $result4->fetch_assoc();

	$uid_b_fn = $row4['FirstName'];
	$uid_b_ln = $row4['LastName'];
	$uid_b_photo = $row4['photo'];

?>
	<div class="d-flex align-items-center justify-content-center">
		<div class="card mx-3">
			<div class="card-header lead">
				Status
			</div>
			<div>
			<!-- <div class="card-body"> -->
				<!-- <?php //echo $status; ?> -->
				<form class="formBox pb-3" method="post" action="change_ticket_status.php">
					<select class="custom-select form-control mb-2" name="status" required>
						<option></option>
						<option>in-progress</option>
						<option>matched</option>
						<option>closed</option>
					</select>
					<div class="form-group mx-3">
						<input type="hidden" name="userid" value="<?php echo $_SESSION['userid'];?>">
					</div>
					<div class="form-group mx-3">
						<input type="hidden" name="ticket_number" value="<?php echo $ticket_number;?>">
					</div>
					<a class="btn btn-primary ml-3 mr-2" type="submit" name="submit" value="Change">
				</form>
			</div>
			<!-- <div class="card-footer">
						<a class="btn btn-primary ml-3 mr-2" type="submit" name="submit" value="Change">
			</div> -->
		</div>
		<div class="card mx-3">
			<div class="card-header lead">
				Assigned to
			</div>
			<div class="card-body">
				<?php echo $agent; ?>
			</div>
			<div class="card-footer">
				<a class='btn btn-info' href='index.php'>Assign to me</a>
			</div>
		</div>
	</div>
	<h2>Match Info</h2>
	<div class="row">
		<div class="col">
			<div>
				<?php echo $uid_a_ln.", ".$uid_a_fn." (".$uid_a.")"; ?>
			</div>
			<div>
				<img src="media/photo/<?php echo $uid_a_photo; ?>" height="250" />
			</div>
		</div>
		<div class="col">
			<div>
				<?php echo $uid_b_ln.", ".$uid_b_fn." (".$uid_b.")"; ?>
			</div>
			<div>
				<img src="media/photo/<?php echo $uid_b_photo; ?>" height="250" />
			</div>
		</div>
	</div>
		<div>
			Matched on <?php echo $date_matched; ?>
		</div>

<hr>
<h2>Ticket History</h2>

<h3>Add update to ticket</h3>
<div class="form-group mx-3">
	<div class="input-icon"><i class="fa fa-id-card"></i></div>
	<textarea class="form-control" name="update" id="updates"></textarea>
</div>
<?php
		
	$sql5 = "SELECT Updates, DateUpdated, userid from ticket_history where TicketNumber='".$ticket_number."' ORDER BY DateUpdated DESC";

	$result5 = mysqli_query($db,$sql5);

	if ($result5->num_rows > 0) {
		while($row5 = $result5->fetch_assoc()) {
?>
			<div>
				<div>
					<?php echo $row5['DateUpdated']."(".$row5['userid'].")"; ?>
				</div>
				<div>
					<?php echo $row5['Updates']; ?>
				</div>
			</div>
<?php
		}
	}
?>