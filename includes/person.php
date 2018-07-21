<?php

	include('../config.php');
	session_start();
	
	$uid = $_GET['uid'];

	$sql = "SELECT * FROM person where uid = '" . $uid . "'";

	$result = mysqli_query($db,$sql);


	if ($result->num_rows > 0) {

	    // output data of each row

	    while($row = $result->fetch_assoc()) {
	        // echo $row['FirstName'] . " " . $row['LastName'];
	        $sex = $row['Sex'];
	        $date_detained = $row['DateDetained'];
	        $current_facility = $row['CurrentFacility'];
	        $entry_point = $row['EntryPoint'];
	        $country = $row['Country'];
	        ?>

			<div class="row">
				<!-- <div class="prevArrow col-1"><i class="fa fa-chevron-left fa-3x"></i></div> -->
				<div class="col-sm">
					<div class="d-flex align-items-center justify-content-center mb-3">
						<img src="media/photo/<?php echo $row['photo']; ?>" height="250" />
					</div>
					<div class="d-flex align-items-center justify-content-center flex-wrap mb-3">
						<i class="fa fa-male fa-3x mr-3"></i>
						<i class="fa fa-male fa-3x mr-3"></i>
						<i class="fa fa-male fa-3x"></i>
					</div>
					<video width="100%" controls>
					    <source src="media/video/<?php echo $row['video'] ?>" type="video/mp4">
					</video>
				</div>
				<div id="personDetails" class="col-sm" data-uid="<?php echo $uid; ?>" data-gender="<?php echo $_GET['gender']; ?>">
					<table class="table">
						<tr>
							<th>Sex:</th>
							<td><?php 
								if ($sex == 'm'){
									echo "Male";
								}else{
									echo "Female";
								}
								//echo $sex; 
							?></td>
						</tr>
						<tr>
							<th>Date Detained:</th>
							<td><?php echo $date_detained; ?></td>
						</tr>
						<tr>
							<th>Entry Point:</th>
							<td><?php echo $entry_point; ?></td>
						</tr>
						<tr>
							<th>Current Facility:</th>
							<td><?php 
									$sql2 = "SELECT FacilityName FROM facilities where FacilityNumber = '" . $current_facility . "'";

									$result2 = mysqli_query($db,$sql2);
									$row2 = $result2->fetch_assoc();
									//echo $sql2;
									echo $row2['FacilityName']; 
								?></td>
						</tr>
						<tr>
							<th>Country of Origin:</th>
							<td><?php echo $country; ?></td>
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
						<tr>
							<td colspan="2">
								<strong>Claims:</strong>
								<ul class="list-group mt-2">
									<?php 
										$a = explode(',',$row['Claiming']);
										foreach($a as $v){
											$sql3 = "SELECT FirstName, LastName, Country FROM person where UID = '" . $v . "'";

											$result3 = mysqli_query($db,$sql3);
											$row3 = $result3->fetch_assoc();
											$record = $row3['FirstName'].' '.$row3['LastName'].'('.$row3['Country'].')';
											echo "<li class='list-group-item'>".$record."</li>";
										}
									?>
								</ul>
							</td>
						</tr>
					</table>
				</div>
				<!-- <div class="nextArrow col-1"><i class="fa fa-chevron-right fa-3x"></i></div> -->
			</div>

	        <?php
	    }

	} else {
	    echo "0 results";
	}

?>

<script>
	$(document).ready(function(){
		$("#uid").tooltip();
	});
</script>