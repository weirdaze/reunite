<?php
	include 'header.php';
?>
<style>
	body {
		background-color: #eee;
	}
</style>
<?php
	include('config.php');
?>
	<br /><table style="width:100%"><tr><th>Match ID</th><th>Claimer</th><th>Claimed</th><th>Status</th></tr>
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
?>
		</table>
<?php include 'footer.php'?>