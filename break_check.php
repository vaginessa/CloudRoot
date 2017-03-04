<html>
	<head>
		<script src="docs/jquery-latest.js"></script>
		<script>
			$(document).ready(function(){
				setInterval(function() {
					$("#break_check").load("break_check.php #break_check");
				}, 1000);
				$.ajaxSetup({ cache: false });
			});
		</script>
	</head>
	<body>
		<div id='break_check'>
			<?php
				include("db.php");
				$check = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM breaks WHERE `status` = 'N' AND `user` = '". $_COOKIE['user_coockie'] ."' AND `aceite` = 'N' AND `autorizado` <> '';"));
				if($check[0] >= 1){
					$breakid = mysqli_fetch_array(mysqli_query($conn, "SELECT `id` FROM breaks WHERE `user` = '". $_COOKIE['user_coockie'] ."' AND `status` = 'N';"));
					echo "
						<div id='break_alert_aceitar'>
							<a href='functions.php?id=8&breakid=". $breakid[0] ."'><img class='stroke' style='margin-top: 5px; float: left; margin-left: 15px;' width='30px' height='30px' src='./media/images/logos/accept.png'/></a>
						</div>
						<div id='break_alert_cancelar'>
							<a href='functions.php?id=9&breakid=". $breakid[0] ."'><img class='stroke' style='margin-top: 5px; float: left; margin-left: 15px;' width='30px' height='30px' src='./media/images/logos/decline.png'/></a>
						</div>
					";
				}
			?>
		</div>
	</body>
</html>