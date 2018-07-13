<?php
	session_start();
	$facility_name = $_GET['facility_name'];
	include 'config.php';

	$sql = "SELECT FacilityName, Address, POC, Status, city, state, zip, POC from facilities where FacilityName='".$facility_name."'";
	$result = mysqli_query($db,$sql);
	$row = $result->fetch_assoc();
	$match_id = $row['Match_ID'];
	$agent = $row['Agent'];
	$status = $row['Status'];
?>