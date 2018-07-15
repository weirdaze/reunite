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
	$date_matched = date("m/d/Y",strtotime($row2['DateMatched']));


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
	<div id="ticketNo" class="d-flex aling-items-center mb-3" data-ticket_number="<?php echo $ticket_number; ?>">
		<div class="dropdown mr-2">
		 	<button class="btn btn-secondary dropdown-toggle" role="button" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    	Status: <?php echo $status; ?>
		  	</button>

		  	<div class="dropdown-menu" aria-labelledby="changeStatus">
		    	<a class="changeStatus dropdown-item" data-status="In-Progress">In-Progress</a>
		    	<a class="changeStatus dropdown-item" data-status="Matched">Matched</a>
		    	<a class="changeStatus dropdown-item" data-status="Closed">Closed</a>
		  	</div>
		</div>
		<div class="dropdown">
		 	<button class="btn btn-secondary dropdown-toggle" role="button" id="changeAgent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    	Assigned to: <?php echo $agent; ?>
		  	</button>

		  	<div class="dropdown-menu" aria-labelledby="changeAgent">
		    	<a id="assignMe" class="dropdown-item" data-userid="<?php echo $_SESSION['userid']; ?>">Assign to me</a>
		  	</div>
		</div>
	</div>
	<div class="d-flex align-items-center mb-3">
		<h2>Match Info</h2>
		<span class="small ml-auto">Matched on <?php echo $date_matched; ?></span>
	</div>

	<div class="row mb-3">
		<div class="col d-flex flex-column align-items-center justify-content-center">
			<div class="lead">
				<?php echo "<a class='uid text-info' data-toggle='tooltip' data-title='".$uid_a."'><i class='far fa-id-badge'></i></a> ".$uid_a_ln.", ".$uid_a_fn; ?>
			</div>
			<div class="personImg" style="background-image: url('media/photo/<?php echo $uid_a_photo; ?>');"></div>
		</div>
		<div class="col d-flex flex-column align-items-center justify-content-center">
			<div class="lead">
				<?php echo "<a class='uid text-info' data-toggle='tooltip' data-title='".$uid_b."'><i class='far fa-id-badge'></i></a> ".$uid_b_ln.", ".$uid_b_fn; ?>
			</div>
			<div class="personImg" style="background-image: url('media/photo/<?php echo $uid_b_photo; ?>');"></div>
		</div>
	</div>

	<h3>Ticket Notes</h3>
	<div class="form-group mr-3">
		<textarea class="form-control" name="update" id="updates"></textarea>
	</div>

	<h3>Ticket History</h3>
	<ul class="list-group">
<?php
		
	$sql5 = "SELECT Updates, DateUpdated, userid from ticket_history where TicketNumber='".$ticket_number."' ORDER BY DateUpdated DESC";

	$result5 = mysqli_query($db,$sql5);

	if ($result5->num_rows > 0) {
		while($row5 = $result5->fetch_assoc()) {
?>
		<li class="list-group-item d-flex aling-items-center">
			<span><?php echo $row5['Updates']; ?></span>
			<span class="ml-auto"><?php echo $row5['DateUpdated']."(".$row5['userid'].")"; ?></span>
		</li>
<?php
		}
	}
	else {
		echo "<li class='list-group-item'>No Ticket History</li>";
	}
?>
	</ul>
<script>
	$(".uid").tooltip();
</script>