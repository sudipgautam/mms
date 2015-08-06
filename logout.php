<?php
	session_start();
	if ( (isset($_SESSION['mms_logged_uid'])) && (isset($_SESSION['mms_logged_name']))) {
		unset ($_SESSION['mms_logged_uid']);
		unset ($_SESSION['mms_logged_name']);
		session_unset();
		session_destroy();
	}
	header('location:index.php');
?>
