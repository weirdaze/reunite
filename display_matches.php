<?php
	include('config.php');
?>
	<br /><table class="sortable" style="width:100%"><tr><th>Match ID</th><th>Claimer</th><th>Claimed</th><th>Status</th></tr>
<?php
		
	$sql = "SELECT Match_ID, UID_A, UID_B, Status from matches where Status<>'closed'";

	$result = mysqli_query($db,$sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
?>
			<tr>
			<td><a href="match_info.php?<?php echo 'uid_a='.$row['UID_A'].'&'.'uid_b='.$row['UID_B'] ?>"><?php echo $row['Match_ID']; ?></a></td>
			<td><?php echo $row['UID_A']; ?></td>
			<td><?php echo $row['UID_B']; ?></td>
			<td><?php echo $row['Status']; ?></td>
			</tr>
<?php
		}
	}


				
/*

				<div class="child d-flex align-items-center flex-column justify-content-center" data-uid="<?php echo $row['UID']; ?>" data-gender="<?php echo $row['Sex']; ?>" data-fullname="<?php echo $row['FirstName'] . ' ' . $row['LastName']; ?>">
					<div class="personImg" style="background-image: url('media/photo/<?php echo $row['photo']; ?>');"></div>
					<div class="caption"><?php echo $row['LastName'] . ", " . $row['FirstName']; ?></div>
				</div>'
				}
			}
	while($row = $result->fetch_assoc()) {
    	echo "
    	<td>".'<a href="'.esc_url(add_query_arg( array('acct' => $accountNum, 'clientName' => $clientName, 'deviceSerial' => $mydevice->DeviceSerial, 'clientUserId' => $clientID), 'https://pep.centerpointcc.net/portal/device-information-manager' )).'">'.$mydevice->DeviceHostName.'</a>'."</td>
    	<td>".'<a href="'.esc_url(add_query_arg( array('acct' => $accountNum, 'clientName' => $clientName, 'siteFqdn' => $mydevice->DeviceSiteName, 'clientUserId' => $clientID), 'https://pep.centerpointcc.net/portal/site-information-manager' )).'">'.$mydevice->DeviceSiteName.'</a>'."</td> 
    	<td>".'<a href="'.esc_url(add_query_arg( array('acct' => $accountNum, 'clientName' => $clientName, 'deviceSerial' => $mydevice->DeviceSerial, 'clientUserId' => $clientID), 'https://pep.centerpointcc.net/portal/device-information-manager' )).'">'.$mydevice->DeviceSerial.'</a>'."</td>
    	<td>".'<a href="'.esc_url(add_query_arg( array('acct' => $accountNum, 'clientName' => $clientName, 'deviceSerial' => $mydevice->DeviceSerial, 'clientUserId' => $clientID), 'https://pep.centerpointcc.net/portal/device-information-manager' )).'">'.$ticketCount.'</a>'."</td>
  		</tr>";
  		//echo $ticketCount;
		}*/
		echo '</table>';
?>