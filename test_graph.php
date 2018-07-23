<?php
	$admin = 1;
	include 'header.php';
	session_start();
	// this form is going to be for creating a user
?>

<style>
	body {
		background-color: #eee;
	}
</style>

<iframe src="http://localhost:5601/app/kibana#/dashboard/f63b2200-8e92-11e8-8aef-db8a9a9661f9?embed=true&_g=(refreshInterval%3A(display%3AOff%2Cpause%3A!f%2Cvalue%3A0)%2Ctime%3A(from%3Anow%2FM%2Cmode%3Aquick%2Cto%3Anow%2FM))" height="600" width="800"></iframe>

<?php include 'footer_login.php'?>