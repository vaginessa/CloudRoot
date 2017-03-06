<html>
	<head>
		<script src="docs/jquery-latest.js"></script>
		<script>
			$(document).ready(function(){
				setInterval(function() {
					$("#break_matrix").load("break_matrix.php #break_matrix");
				}, 1000);
				$.ajaxSetup({ cache: false });
			});
		</script>
	</head>
	<body>
		<div id='break_matrix'>
			<?php
				error_reporting(0);
				include("db.php");
				$query = mysqli_fetch_array(mysqli_query($conn, "SELECT `auto_break` FROM `settings` WHERE `id` = '1';"));
				if($query[0] == 'Y'){
					$a = mysqli_fetch_array(mysqli_query($conn, "SELECT `max_breaks` FROM `settings` WHERE `id` = '1';"));
					$b = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM `breaks` WHERE `status` = 'N';"));
					$c = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM `breaks` WHERE `autorizado` IS NULL;"));
					$d = $b[0] - $c[0];
					if($d < $a[0]){
						$select=mysqli_query($conn, "SELECT * FROM `breaks` WHERE `autorizado` IS NULL ORDER BY 1 ASC LIMIT 1;");
						while($row=mysqli_fetch_array($select))
						{
							$time = date("Y/m/d h:i:s");
							$query = mysqli_query($conn, "UPDATE `breaks` SET `autorizado`='". $time ."' WHERE  `id`=". $row['id'] .";");
							$select=mysqli_query($conn, "INSERT INTO `log` (`log_text`) VALUES ('AUTOBREAK ACEITE ID:". $row['id'] ." | ". $time ." por BOT.');");
						}
					}
				}
			?>
			<?php
				error_reporting(0);
				include("db.php");
				$select = mysqli_query($conn, "SELECT * FROM breaks WHERE `autorizado` IS NOT NULL AND status = 'N' AND `aceite` = 'N';");
				while($row=mysqli_fetch_array($select))
				{
					$selectedTime = $row['autorizado'];
					$endTime = strtotime($selectedTime) + 900;
					$corrent_time = strtotime(date("Y/m/d h:i:s"));
					if($corrent_time > $endTime){
						$query = mysqli_query($conn, "UPDATE `breaks` SET `status`='Y' WHERE  `id`=". $row['id'] .";");
						$select=mysqli_query($conn, "INSERT INTO `log` (`log_text`) VALUES ('AUTOBREAK CANCELADO POR NAO TER SER ACEITE ID: ". $row['id'] ."  | ". date("Y/m/d h:i:s") ."');");
					}
				}
			?>
			<?php
				error_reporting(0);
				include("db.php");
				$select = mysqli_query($conn, "SELECT * FROM breaks WHERE `aceite` = 'Y' AND `status` = 'N';");
				while($row=mysqli_fetch_array($select))
				{
					$a = strtotime($row['inicio']);
					$b = strtotime(date("Y/m/d h:i:s"));
					$usedtime = $b - $a;
					$matrix = date("i:s", $usedtime);
					$query = mysqli_query($conn, "UPDATE `breaks` SET `tempo_utilizado` = '". $matrix ."' WHERE `id` = ". $row['id'] .";");
				}
			?>
			<?php
				error_reporting(0);
				include("db.php");
				$accept = mysqli_fetch_array(mysqli_query($conn, "SELECT `aceite` FROM breaks WHERE `user` = '". $_COOKIE['user_coockie'] ."' AND `status` = 'N';"));
				$query = mysqli_fetch_array(mysqli_query($conn, "SELECT `tempo_utilizado` FROM breaks WHERE `user` = '". $_COOKIE['user_coockie'] ."' AND `status` = 'N';"));
				$breakid = mysqli_fetch_array(mysqli_query($conn, "SELECT `id` FROM breaks WHERE `user` = '". $_COOKIE['user_coockie'] ."' AND `status` = 'N';"));
				if($accept[0] == 'Y'){
					echo "
						<div id='background_break'>
							<div style='margin: auto; position: absolute; top: 0; left: 0; bottom: 0; right: 0; width: 500px; height: 300px;'>
								<img style='margin: 0 auto; position: relative; display: table-cell;' width='100px;' height='100px;' src='./media/images/loading_processmaker.gif'/>
								<a class='text_font_center' style='font-size: 150%; margin-top: 50px;'>TEMPO UTILIZADO: ". $query[0] ."</a>
								<div class='corner' style='background-color: #1E90FF; max-width: 240px; margin:0 auto; height: 50px; margin-top: 30px;'>
									<a href='functions.php?id=9&breakid=". $breakid[0] ."' class='text_font_center' style='text-decoration: none; max-width: 240px; margin:0 auto; color: #fff; font-size: 150%; line-height: 50px;'>CANCELAR</a>
								</div>
							</div>
						</div>
					";
				}
			?>
		</div>
	</body>
</html>
