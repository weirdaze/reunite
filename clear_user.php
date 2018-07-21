<?php
    session_start();
    unset($_SESSION['uid']);
	header("Location: admintools.php?cleared=1");
?>