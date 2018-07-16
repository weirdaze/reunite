<?php
	session_start();
	$ticket_number = $_POST['ticket_number'];
	$userid = $_SESSION['userid'];
	$status = $_POST['status'];
	// echo "this is the user ID:".$userid;
	$execStr = "python /var/www/html/reunite/scripts/change_status.py ".$ticket_number." ".$userid." ".$status;
	$result = exec($execStr);
	// echo $execStr;
	// header("Location: display_tickets.php");
?>