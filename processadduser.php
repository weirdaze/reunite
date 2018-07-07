<?php
	if(isset($_POST['submit'])){
		session_start();
		$admin_username = $_SESSION['userid'];
		$first_name = $_POST['first_name'];
		$middle_name = $_POST['middle_name'];
		$last_name = $_POST['last_name'];
		$maternal_last_name = $_POST['maternal_last_name'];
		$dob = $_POST['dob'];
		$sex = $_POST['sex'];
		$current_facility = $_POST['current_facility'];
		$country = $_POST['country'];
		$photo = $_POST['photo'];
		$video = $_POST['video'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		$poc = $_POST['poc'];
		$relatives = "";

		foreach($_POST as $key => $value){
			if(preg_match('/^rel[0-9]*$/',$key)){
				if($relatives == ""){
					$relatives = $value;
				}
				else {
					$relatives = $relatives . "," . $value;
				}
			}
		}

		$exec_str = "python /var/www/html/reunite/scripts/add_user.py '$first_name','$middle_name','$last_name','$dob','$maternal_last_name','$sex','entry_point','$country','last_facility','$current_facility','$relatives','date_detained','status','claiming','type','$video','$photo','facility_uid','$admin_username'";
		echo $exec_str;
		/*$result = exec($exec_str);*/
		/*echo $result;*/
	}
	else {
		echo "nothing submitted";
	}
	
?>