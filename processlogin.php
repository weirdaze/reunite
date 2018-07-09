<?php
	include('config.php');

	if(isset($_POST['username'])){
		$username = $_POST['username'];
   		$password = $_POST['password'];
   		$current_facility = $_POST['current_facility'];

   		$sql = "SELECT UserID, password FROM admin WHERE UserID = '$username'";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

		$count = mysqli_num_rows($result);
		// If result matched $myusername and $mypassword, table row must be 1 row

		if($count == 1) {
			if(password_verify($password,$row['password']) == 1){
				session_start();
				$_SESSION['logged_in'] = true;
				$_SESSION['userid'] = $username;
				$_SESSION['current_facility'] = $current_facility;
				header("Location: index.php");
			}
			else {
				header("Location: login.php?error=1");
			}
		}
		else {
			header("Location: login.php?error=1");
		}
	}
	elseif(isset($_POST['firstname'])){

		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$employeeid = $_POST['employeeid'];
		$userid = $_POST['createusername'];
		$createpassword = $_POST['createpassword'];
		$confirmpassword = $_POST['confirmpassword'];

		if($createpassword !== $confirmpassword){
			header("Location: login.php?error=2");
		}
		else {
			$sql = "SELECT UserID FROM admin WHERE UserID = '$userid'";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

			$count = mysqli_num_rows($result);
			// If result matched $myusername and $mypassword, table row must be 1 row

			if($count == 0) {
				$password = password_hash($createpassword,PASSWORD_BCRYPT);

				/*echo password_verify("12334",$password);*/
				$sql = "INSERT INTO admin (UserID, FirstName, MiddleName, LastName, employee_id, password) VALUES ('".$userid."','".$firstname."','".$middlename."','".$lastname."','".$employeeid."','".$password."')";

				$result = mysqli_query($db,$sql);

				/*echo $result;*/

				mysqli_close($db);

				session_start();
				$_SESSION['logged_in'] = true;
				$_SESSION['userid'] = $userid;
				header("Location: index.php");
			}
			else {
				header("Location: login.php?error=3");
			}
		}
	}
?>