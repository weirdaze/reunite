<?php

$servername = "tun1.centerpointcc.net";
$username = "root";
$password = "R3unite123";
$dbname = "reunite";


// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

$uid = $_GET['uid'];

$sql = "SELECT * FROM person where uid = '" . $uid . "'";

$result = $conn->query($sql);

 

if ($result->num_rows > 0) {

    // output data of each row

    while($row = $result->fetch_assoc()) {
        // echo $row['FirstName'] . " " . $row['LastName'];
        ?>

		<div class="row">
			<div class="prevArrow col-1"><i class="fa fa-chevron-left fa-3x"></i></div>
			<div class="col">
				<div class="d-flex align-items-center justify-content-center mb-3">
					<i class="text-center fa fa-male fa-7x"></i>
				</div>
				<div class="d-flex align-items-center justify-content-center flex-wrap mb-3">
					<i class="fa fa-male fa-3x mr-3"></i>
					<i class="fa fa-male fa-3x mr-3"></i>
					<i class="fa fa-male fa-3x"></i>
				</div>
				<video width="100%" controls>
				    <source src="media/video/SampleVideo_1280x720_5mb.mp4" type="video/mp4">
				</video>
			</div>
			<div id="personDetails" class="col" data-uid="<?php echo $uid; ?>" data-person_type_id="<?php echo $_GET['person_type_id']; ?>">
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
			<div class="nextArrow col-1"><i class="fa fa-chevron-right fa-3x"></i></div>
		</div>

        <?php
    }

} else {

    echo "0 results";

}

$conn->close();

?>

