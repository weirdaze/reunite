<?php
	$uid_a = $_GET["uid_a"];
	$uid_b = $_GET["uid_b"];

	echo '<br />';
	echo '<br /><table class="sortable" style="width:100%"><tr><th>Match ID</th><th>Claimer</th><th>Claimed</th><th>Status</th></tr>';
	$sql = "SELECT Match_ID, UID_A, UID_B, Status from matches where Status<>'closed'";

	$result = mysqli_query($db,$sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) { ?>
				<div class="child d-flex align-items-center flex-column justify-content-center" data-uid="<?php echo $row['UID']; ?>" data-gender="<?php echo $row['Sex']; ?>" data-fullname="<?php echo $row['FirstName'] . ' ' . $row['LastName']; ?>">
					<div class="personImg" style="background-image: url('media/photo/<?php echo $row['photo']; ?>');"></div>
					<div class="caption"><?php echo $row['LastName'] . ", " . $row['FirstName']; ?></div>
				</div>'
				}
			}
	while($row = $result->fetch_assoc()) {
    	echo "<tr>
    	<td>".'<a href="'.esc_url(add_query_arg( array('acct' => $accountNum, 'clientName' => $clientName, 'deviceSerial' => $mydevice->DeviceSerial, 'clientUserId' => $clientID), 'https://pep.centerpointcc.net/portal/device-information-manager' )).'">'.$mydevice->DeviceHostName.'</a>'."</td>
    	<td>".'<a href="'.esc_url(add_query_arg( array('acct' => $accountNum, 'clientName' => $clientName, 'siteFqdn' => $mydevice->DeviceSiteName, 'clientUserId' => $clientID), 'https://pep.centerpointcc.net/portal/site-information-manager' )).'">'.$mydevice->DeviceSiteName.'</a>'."</td> 
    	<td>".'<a href="'.esc_url(add_query_arg( array('acct' => $accountNum, 'clientName' => $clientName, 'deviceSerial' => $mydevice->DeviceSerial, 'clientUserId' => $clientID), 'https://pep.centerpointcc.net/portal/device-information-manager' )).'">'.$mydevice->DeviceSerial.'</a>'."</td>
    	<td>".'<a href="'.esc_url(add_query_arg( array('acct' => $accountNum, 'clientName' => $clientName, 'deviceSerial' => $mydevice->DeviceSerial, 'clientUserId' => $clientID), 'https://pep.centerpointcc.net/portal/device-information-manager' )).'">'.$ticketCount.'</a>'."</td>
  		</tr>";
  		//echo $ticketCount;
		}
		echo '</table>';
?>