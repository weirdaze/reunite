<?php
	$page = 0;
	if(isset($_GET['page'])){
		$page = intval($_GET['page']) - 1;
		include('../config.php');
	}
	$limit = 10;
	$start = $page*$limit;
	$sql = "SELECT Match_ID, UID_A, UID_B, DateMatched, Status from matches where Status<>'closed' ORDER BY DateMatched DESC LIMIT $start,$limit";

	$result = mysqli_query($db,$sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$uid_a = $row['UID_A'];
			$uid_b = $row['UID_B'];
			$date_matched = date("m/d/Y",strtotime($row['DateMatched']));
			
			$sql2 = "SELECT FirstName, LastName from person where UID='$uid_a'";
			$result2 = mysqli_query($db,$sql2);
			$row2 = $result2->fetch_assoc();
			$uid_a_fn = $row2['FirstName'];
			$uid_a_ln = $row2['LastName'];

			$sql3 = "SELECT FirstName, LastName from person where UID='$uid_b'";
			$result3 = mysqli_query($db,$sql3);
			$row3 = $result3->fetch_assoc();
			$uid_b_fn = $row3['FirstName'];
			$uid_b_ln = $row3['LastName'];

?>
			<tr>
				<td>
					<a class="previewMatch text-primary ml-3" data-match_id="<?php echo $row['Match_ID']; ?>" data-uid_a="<?php echo $row['UID_A']; ?>" data-uid_b="<?php echo $row['UID_B']; ?>"><i class="fa fa-eye"></i></a>
				</td>
				<td><?php echo $row['Match_ID']; ?></td>
				<td><?php echo "<a class='uid text-primary' data-toggle='tooltip' data-title='".$row['UID_A']."'><i class='far fa-id-badge'></i></a> ".$uid_a_ln.", ".$uid_a_fn; ?></td>
			    <td><?php echo "<a class='uid text-primary' data-toggle='tooltip' data-title='".$row['UID_B']."'><i class='far fa-id-badge'></i></a> ".$uid_b_ln.", ".$uid_b_fn; ?></td>
				<td><?php echo $row['Status']; ?></td>
				<td><?php echo $date_matched; ?></td>
			</tr>
<?php
		}
?>
	<script>
		$(".uid").tooltip();
	</script>
<?php
	}
?>