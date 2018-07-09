<?php
	session_start();
	if(isset($_GET['uid'])){
		if($_GET['claim_type'] == "child"){
			$_SESSION['uid'] = $_GET['uid'];
		}
		else {
			$uid_a = $_GET['uid'];
			$uid_b = $_SESSION['uid'];

			$uids = "'" . $uid_a . ',' . $uid_b . "'";
			$execStr = 'python /var/www/html/reunite/scripts/submit_claim.py ' . $uids;
			echo $execStr;
			$result = exec($execStr);
			/*echo $result;*/
			/*echo "Entered Claim: " . $result;*/
		}	
	}
?>