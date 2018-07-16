<?php
	session_start();
	$ticket_number = $_POST['ticket_number'];
	$userid = $_SESSION['userid'];
	$update = $_POST['update'];
	// echo "this is the user ID:".$userid;
	$execStr = "python /var/www/html/reunite/scripts/update_ticket.py ".$ticket_number." ".$userid." '".$update."'";
	$result = exec($execStr);
	//echo $execStr;
	//header("Location: display_tickets.php");
?>