<html>
	<head>
		<script src="docs/jquery-latest.js"></script>
		<script>
			$(document).ready(function(){
				setInterval(function() {
					$("#last_update").load("last_update.php #last_update");
				}, 60000);
				$.ajaxSetup({ cache: false });
			});
		</script>
	</head>
	<body>
		<div id='last_update'>
			<?php
				include("db.php");
				$data = date("Y/m/d h:i:s");
				$check = mysqli_query($conn, "UPDATE `cloud`.`users` SET `last_update`='". $data ."' WHERE  `user` = '". $_COOKIE['user_coockie'] ."';");
			?>
		</div>
	</body>
</html>