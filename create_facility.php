<?php

    $facility_name = $_POST["facility_name"];
	$address = $_POST["address"];
	$city = $_POST["city"];
	$state = $_POST["state"];
	$zip = $_POST["zip"];
	$poc = $_POST["poc"];

	$facility = "'".$facility_name.','.$address.','.$city.','.$state.','.$zip.','.$poc."'";
    echo $facility;
	$execStr = 'python /var/www/html/reunite/scripts/create_facility.py '.$facility;
	echo $execStr;
	$result = exec($execStr);
	echo $result;
	//header("Location: index.php");
?>