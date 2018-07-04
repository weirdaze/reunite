<?php
    $facility_name = 'test facility';
	$address = 'test address';
	$city = 'test city';
	$state = 'test state';
	$zip = 'test zip';
	$poc = 'test poc';

	$facility = "'".$facility_name.','.$address.','.$city.','.$state.','.$zip.','.$poc."'";
    echo $facility;
	$execStr = 'python /var/www/html/reunite/scripts/create_facility.py '.$facility;
	$result = exec($execStr);
	echo $result;
	//header("Location: index.php");
?>