<?php
    $facility_name = 'test facility';
	$address = 'test address';
	$city = 'test city';
	$state = 'nj';
	$zip = '08106';
	$poc = 'test poc';

	$facility = "'".$facility_name.','.$address.','.$city.','.$state.','.$zip.','.$poc."'";
    echo $facility;
	$execStr = 'python /var/www/html/reunite/scripts/create_facility.py '.$facility;
	echo $execStr;
	$result = exec($execStr);
	echo $result;
	echo '\n';
	//header("Location: index.php");
?>