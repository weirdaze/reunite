<?php
	include 'header.php';
?>
<style>
	body {
		background-color: #eee;
	}
</style>
<?php
	$uid_a = $_GET["uid_a"];
	$uid_b = $_GET["uid_b"];

	include('config.php');

	$sql = "SELECT UID, FirstName, LastName, Sex, photo from person where UID = '".$uid_a."'";
	echo $sql;
	$result = mysqli_query($db,$sql);
	$row = $result->fetch_assoc();
?>
	
	<div class="child d-flex align-items-center flex-column justify-content-center" data-uid="<?php echo $row['UID']; ?>" data-gender="<?php echo $row['Sex']; ?>" data-fullname="<?php echo $row['FirstName'] . ' ' . $row['LastName']; ?>">
		<div class="personImg" style="background-image: url('media/photo/<?php echo $row['photo']; ?>');"></div>
		<div class="caption"><?php echo $row['LastName'] . ", " . $row['FirstName']; ?></div>
	</div>
	<br>
<?php
	$sql = "SELECT UID, FirstName, LastName, Sex, photo from person where UID = '".$uid_b."'";
	echo $sql;
	$result = mysqli_query($db,$sql);
	$row = $result->fetch_assoc();
?>

	<div class="child d-flex align-items-center flex-column justify-content-center" data-uid="<?php echo $row['UID']; ?>" data-gender="<?php echo $row['Sex']; ?>" data-fullname="<?php echo $row['FirstName'] . ' ' . $row['LastName']; ?>">
		<div class="personImg" style="background-image: url('media/photo/<?php echo $row['photo']; ?>');"></div>
		<div class="caption"><?php echo $row['LastName'] . ", " . $row['FirstName']; ?></div>
	</div>
	<br>
<?php include 'footer.php'?>