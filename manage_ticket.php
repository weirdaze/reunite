<?php
	include 'header.php';
?>
<style>
	body {
		background-color: #eee;
	}
</style>

<?php
	$ticket_number = $_GET['ticket_number'];
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

	<div>
		Ticket <?php echo $ticket_number."(".$match_id.")"; ?>
		Status: <?php echo $status; ?><a href='index.php'>(change-dd)</a>
		Assigned: 
		<?php 
			echo $agent." logged in user: ".$_SESSION['userid'];
			if($agent != $_SESSION['userid']){
				echo "<a href='index.php'>Assign to me</a>";
			}
		?>

	</div>
<hr>
<h2>Match Info</h2>
	<div>
		<div>
			<div>
				<?php echo $uid_a_ln.", ".$uid_a_fn." (".$uid_a.")"; ?>
			</div>
			<div>
				<img src="media/photo/<?php echo $uid_a_photo; ?>" height="250" />
			</div>
		</div>
		<div>
			<div>
				<?php echo $uid_b_ln.", ".$uid_b_fn." (".$uid_b.")"; ?>
			</div>
			<div>
				<img src="media/photo/<?php echo $uid_b_photo; ?>" height="250" />
			</div>
		</div>
		<div>
			Matched on <?php echo $date_matched; ?>
		</div>
	</div>

<hr>
<h2>Ticket History</h2>

<h3> Add update to ticket </h3>
<form class="formBox pb-3" method="post" action="update_ticket.php">
	<div class="bg-info text-light p-2 mb-3 lead">Create Ticket</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-id-card"></i></div>
		<textarea name="update" id="updates" rows="10" cols="30"></textarea>
	</div>
	<input class="btn btn-primary ml-3 mr-2" type="submit" value="Update Ticket">
</form>
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