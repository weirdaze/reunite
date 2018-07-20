
	<?php
		$search_term = "";
		$gender = "";
		$page = 0;
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}
		$limit = 12;
		$start = $page*$limit;

		/*echo $start . ", " . $limit;*/

		if(isset($_GET['gender'])){
			$gender = $_GET['gender'];
		}
		
		if(isset($_GET['search_term'])){
			$search_term = TRIM($_GET['search_term']);
		}

		include('../config.php');
		session_start();
		
		$sql = "SELECT * FROM person where ";

		if($gender != ""){
			$sql = $sql . "sex = '$gender' and ";
		} 

		$sql =  $sql . "(UPPER(FirstName) like UPPER('%$search_term%') or UPPER(LastName) like UPPER('%$search_term%')) and type='Adult' order by LastName LIMIT $start,$limit";

		$result = mysqli_query($db,$sql);
		 
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
	?>
			<div class="person d-flex align-items-center flex-column justify-content-center" data-uid="<?php echo $row['UID']; ?>" data-gender="<?php echo $row['Sex']; ?>" data-fullname="<?php echo $row['FirstName'] . ' ' . $row['LastName']; ?>">
				<div class="personImg" style="background-image: url('media/photo/<?php echo $row['photo']; ?>');"></div>
				<div class="caption"><?php echo $row['LastName'] . ", " . $row['FirstName']; ?></div>
			</div>	
	<?php
			}
	?>
		<button id="loadMore" class="btn btn-primary" data-page="<?php echo $page + 1; ?>">Load More Results</button>
	<?php
		}
		else {
	?>
			<div class="w-100 alert alert-info alert-dismissible fade show m-3" role="alert">
				No more results
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
	<?php
		}
	?>