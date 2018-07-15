<?php
	$ticket_number = $_GET['ticket_number'];
	$userid = $_SESSION['userid'];
	$update = $_GET['update']
	// echo "this is the user ID:".$userid;
	$execStr = "python /var/www/html/reunite/scripts/update_ticket.py ".$ticket_number." ".$userid." ".$update;
	$result = exec($execStr);

	//header("Location: display_tickets.php");
?>