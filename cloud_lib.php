<?php
	if(!isset($_COOKIE['user_coockie'])) {
		echo "<meta http-equiv='refresh' content='0;URL=index.php' />";
	}
	include("callback_check.php");
	include("break_check.php");
	include("break_matrix.php");
?>