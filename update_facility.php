<?php

    $facility_name = $_POST["facility_name"];
	$address = $_POST["address"];
	$city = $_POST["city"];
	$state = $_POST["state"];
	$zip = $_POST["zip"];
	$poc = $_POST["poc"];
	$facility_number = $_POST["facility_number"];

	$facility = "'".$facility_name.','.$address.','.$city.','.$state.','.$zip.','.$poc.','.$facility_number."'";
	$execStr = 'python /var/www/html/reunite/scripts/update_facility.py '.$facility;
	$result = exec($execStr);
	//echo $execStr;
	//echo $result;
	//echo "created facility: ".$facility_name;
	header("Location: display_facilities.php");
?>