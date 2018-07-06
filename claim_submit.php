<?php
    $uid_a = $_POST["uid_a"];
	$uid_b = $_POST["uid_b"];

	$uids = "'".$uid_a.','.$uid_b."'";
	$execStr = 'python /var/www/html/reunite/scripts/submit_claim.py '.$uids;
	echo $execStr;
	$result = exec($execStr);
	echo $result;
	echo "Entered Claim: ".$result;
	/*header("Location: facility.php");*/
?>