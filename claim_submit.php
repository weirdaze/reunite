<?php
    session_start();
    $uid_a = $_POST["uid_a"];
	$uid_b = $_POST["uid_b"];
	$user_id = $_SESSION["userid"];

	$uids = "'".$uid_a.','.$uid_b."'";
	$execStr = 'python /var/www/html/reunite/scripts/submit_claim.py '.$uids.' '.$user_id;
	echo $execStr;
	$result = exec($execStr);
	echo $result;
	echo "Entered Claim: ".$result;
	/*header("Location: facility.php");*/
?>