<?php

	$uid_a = $_GET['uid_a'];
	$uid_b = $_GET['uid_b'];

	include 'config.php';

	$sql = "SELECT UID, FirstName, LastName, Sex, photo, DateDetained, EntryPoint, CurrentFacility, Country, Relatives from person where UID = '".$uid_a."'";

	$result = mysqli_query($db,$sql);
	$row = $result->fetch_assoc();
?>
	<div class="row">
		<div class="col-sm">
			<h3><?php echo $row['FirstName'] . " " . $row['LastName']; ?></h3>
			<div class="d-flex align-items-center justify-content-center mb-3">
				<img src="media/photo/<?php echo $row['photo']; ?>" height="250" />
			</div>
			<table class="table">
				<tr>
					<th>Sex:</th>
					<td><?php echo $row['Sex'] ?></td>
				</tr>
				<tr>
					<th>Date Detained:</th>
					<td><?php echo $row['DateDetained'] ?></td>
				</tr>
				<tr>
					<th>Entry Point:</th>
					<td><?php echo $row['EntryPoint'] ?></td>
				</tr>
				<tr>
					<th>Current Facility:</th>
					<td><?php echo $row['CurrentFacility'] ?></td>
				</tr>
				<tr>
					<th>Country of Origin:</th>
					<td><?php echo $row['Country'] ?></td>
				</tr>
				<tr>
					<td colspan="2">
						<strong>Relatives:</strong>
						<ul class="list-group mt-2">
							<?php 
								$a = explode(',',$row['Relatives']);
								foreach($a as $v){
									echo "<li class='list-group-item'>".$v."</li>";
								}
							?>
						</ul>
					</td>
				</tr>
			</table>
		</div>
<?php
	$sql = "SELECT UID, FirstName, LastName, Sex, photo, DateDetained, EntryPoint, CurrentFacility, Country, Relatives from person where UID = '".$uid_b."'";

	$result = mysqli_query($db,$sql);
	$row = $result->fetch_assoc();
?>
		<div class="col-sm">
			<h3><?php echo $row['FirstName'] . " " . $row['LastName']; ?></h3>
			<div class="d-flex align-items-center justify-content-center mb-3">
				<img src="media/photo/<?php echo $row['photo']; ?>" height="250" />
			</div>
			<table class="table">
				<tr>
					<th>Sex:</th>
					<td><?php echo $row['Sex'] ?></td>
				</tr>
				<tr>
					<th>Date Detained:</th>
					<td><?php echo $row['DateDetained'] ?></td>
				</tr>
				<tr>
					<th>Entry Point:</th>
					<td><?php echo $row['EntryPoint'] ?></td>
				</tr>
				<tr>
					<th>Current Facility:</th>
					<td><?php echo $row['CurrentFacility'] ?></td>
				</tr>
				<tr>
					<th>Country of Origin:</th>
					<td><?php echo $row['Country'] ?></td>
				</tr>
				<tr>
					<td colspan="2">
						<strong>Relatives:</strong>
						<ul class="list-group mt-2">
							<?php 
								$a = explode(',',$row['Relatives']);
								foreach($a as $v){
									echo "<li class='list-group-item'>".$v."</li>";
								}
							?>
						</ul>
					</td>
				</tr>
			</table>
		</div>
	</div>

	<!-- <i class="text-secondary fa fa-exchange-alt fa-3x"></i> -->
