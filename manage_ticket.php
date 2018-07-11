<?php
	$ticket_number = $_GET['ticket_number'];
	//echo $ticket_number;
	include 'config.php';

	$sql = "SELECT TicketNumber, Match_ID, Agent, Status, from tickets where TicketNumber='".$ticket_number."'";

	$result = mysqli_query($db,$sql);
	$row = $result->fetch_assoc();
	$match_id = $row['Match_ID'];
	$agent = $row['Agent'];
	$status = $row['Status'];

	echo "matchid,agent,status: ".$match_id.", ".$agent.", ".$status;
/*
	$sql2 = "SELECT UID_A, UID_B, DateMatched from matches where MatchID='".$match_id."'";

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
			echo $agent; 
			if($agent != $_SESSION['userid']){
				echo "<a href='index.php'>Assign to me</a>";
			}
		?>

	</div>
<hr>

	<div>
		<div>
			<div>
				<?php echo $uid_a_ln.", ".$uid_a_ln." (".$uid_a.")"; ?>
			</div>
			<div>
				<img src='<?php echo $uid_a_photo; ?>'/>
			</div>
		</div>
		<div>
			<div>
				<?php echo $uid_b_ln.", ".$uid_b_ln." (".$uid_b.")"; ?>
			</div>
			<div>
				<img src='<?php echo $uid_b_photol; ?>'/>
			</div>
		</div>
		<div>
			Matched on <?php echo $date_matched; ?>
		</div>
	</div>

<hr>
<?php
		
	$sql5 = "SELECT Updates, DateUpdated, userid from ticket_history where TicketNumber='".$ticket_number."'";

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
	}*/
?>