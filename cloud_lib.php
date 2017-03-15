<?php
	if(!isset($_COOKIE['user_coockie'])) {
		header('location: index.php');
	}
	include("callback_check.php");
	include("break_check.php");
	include("break_matrix.php");
	include("last_update.php");
?>