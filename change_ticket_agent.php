<?php
	$ticket_number = $_POST['ticket_number'];
	$userid = $_SESSION['userid'];
	// echo "this is the user ID:".$userid;
	$execStr = "python /var/www/html/reunite/scripts/change_ticket_agent.py ".$ticket_number." ".$userid;
	$result = exec($execStr);
	echo $execStr;

	//header("Location: display_tickets.php");
?>