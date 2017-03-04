<html>
	<head>
		<script src="docs/jquery-latest.js"></script>
		<script>
			$(document).ready(function(){
				setInterval(function() {
					$("#callback_check").load("callback_check.php #callback_check");
				}, 1000);
				$.ajaxSetup({ cache: false });
			});
		</script>
	</head>
	<body>
		<div id='callback_check'>
			<?php
				include("db.php");
				$timezone  = +0; //(GMT -5:00) EST (U.S. & Canada) 
				$today = gmdate("H:i:s", time() + 3600*($timezone+date("I"))); 
				$current_hour = date('h', strtotime($today));
				$current_time = date('a', strtotime($today));
				$sql_query_get_callback = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM callbacks WHERE `callback_data` = '". date("Y-m-d") ."' AND `hora` LIKE '". $current_hour .":% ". $current_time ."' AND `user` = '". $_COOKIE['user_coockie'] ."' AND `tratado` = 'N';"));
				if($sql_query_get_callback[0] >= '1'){
					echo "
						<div id='callback_alert'>
							<a href='callback.php'><img class='stroke' style='margin-top: 5px; float: left; margin-left: 15px;' width='30px' height='30px' src='./media/images/logos/calendar.png'/></a>
							<a style='color: #fff; font-size: 110%; margin-left: 10px; top: 12px; position: relative;' class='text_font'>CALLBACK</a>
						</div>
					";
				}
			?>
		</div>
	</body>
</html>