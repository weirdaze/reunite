	<?php
		if(isset($_GET['update_notes'])){
			session_start();
			$ticket_number = $_GET['ticket_number'];
			$userid = $_SESSION['userid'];

			include '../config.php';

			$update = $_GET['update'];
			$execStr = "python /var/www/html/reunite/scripts/update_ticket.py ".$ticket_number." ".$userid." '".$update."'";
			$result = exec($execStr);
		}
	?>
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