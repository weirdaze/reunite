<?php
    session_start();
    unset($_SESSION['uid']);
	header("Location: who_are_you.php?cleared=1");
?>