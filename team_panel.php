<?php
	include("cloud_lib.php");
	$sql_user_get_permissions = mysqli_fetch_array(mysqli_query($conn, "SELECT `permissions` FROM `users` WHERE `user` = '". $_COOKIE['user_coockie'] ."';"));
	if($sql_user_get_permissions[0] == 1){
		echo "<meta http-equiv='refresh' content='0;URL=home.php' />";
	}
?>
<html>
	<head>
		<title>.Cloud - Team Panel</title>
		<link rel="shortcut icon" type="image/png" href="media/images/icon.ico" />
		<link rel="stylesheet" type="text/css" href="css/main.css"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<script type="text/javascript">
			function imgWindow() {
				window.open("image") 
			}
		</script>
	</head>
	<body style='background-color: #F8F8F8;'>
		<div id='home_top_navigation_bar'>
			<a href='home.php'><img style='margin-top: 10px; margin-left: 60px; float: left;' width='130px;' height='40px;' src='./media/images/Loginlogo.png'/></a>
		</div>
		<div id='side_menu'>
			<?php
				include("db.php");
				$select=mysqli_query($conn, "SELECT * FROM menu WHERE `id` > 0 AND `status` = 'Y';");
				while($row=mysqli_fetch_array($select))
				{
					if($row['new_page'] == 'Y'){ $new_page = "target='_blank'"; } else { $new_page = ''; }
					if($row['format'] == 'TOP'){
						echo "
							<div id='website_menu_top'>
						";
					}
					if($row['format'] == 'MIDDLE'){
						echo "
							<div id='website_menu_middle'>
						";
					}
					if($row['format'] == 'BOTTOM'){
						echo "
							<div id='website_menu_bottom'>
						";
					}
					echo "
							<a href='". $row['link'] ."' ". $new_page ."><img class='stroke' style='margin-top: 10px; float: left; margin-left: 10px;' width='30px' height='30px' src='./media/images/logos/". $row['icon'] .".png'/></a>
							<a style='color: #fff; font-size: 110%; margin-left: 20px; top: 15px; position: relative;' class='text_font'>". $row['title'] ."</a>
						</div>
					";
				}
			?>
		</div>
		<div id='side_menu_2'>
			<?php
				include("db.php");
				$select = mysqli_query($conn, "SELECT * FROM menu_gestao WHERE `id` > 0 AND `status` = 'Y';");
				while($row=mysqli_fetch_array($select))
				{
					$sql_user_get_permissions = mysqli_fetch_array(mysqli_query($conn, "SELECT `permissions` FROM `users` WHERE `user` = '". $_COOKIE['user_coockie'] ."';"));
					if($sql_user_get_permissions[0] >= $row['permission']){
						if($row['new_page'] == 'Y'){ $new_page = "target='_blank'"; } else { $new_page = ''; }
						echo "
							<div id='website_menu_solo'>
								<a href='". $row['link'] ."' ". $new_page ."><img class='stroke' style='margin-top: 10px; float: left; margin-left: 10px;' width='30px' height='30px' src='./media/images/logos/". $row['icon'] .".png'/></a>
								<a style='color: #fff; font-size: 110%; margin-left: 20px; top: 15px; position: relative;' class='text_font'>". $row['title'] ."</a>
							</div>
						";
					}
				}
			?>
		</div>
		<div id='body_content' style='margin-top: 200px;'>
			<div id='wrapper' style='margin-top: 0px;'>
				<div id='home_perfil_box'>
					<?php
						include("db.php");
						$equipa = mysqli_fetch_array(mysqli_query($conn, "SELECT `equipa` FROM `users` WHERE `user` = '". $_COOKIE['user_coockie'] ."';"));
						
						$myTime = strtotime(date("m") ."/1/". date("Y"));  // Use whatever date format you want (MM/DD/YYY)
						$daysInMonth = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y")); // 31 (MM, YYYY)
						$workDays = 0;

						while($daysInMonth > 0)
						{
							$day = date("D", $myTime); // Sun - Sat
							if($day != "Sun" && $day != "Sat")
								$workDays++;

							$daysInMonth--;
							$myTime += 86400; // 86,400 seconds = 24 hrs.
						}

						$select=mysqli_query($conn, "SELECT * FROM users WHERE `id` > '0' AND `equipa` = '". $equipa[0] ."';");
						while($row=mysqli_fetch_array($select))
						{
							if($row['d_ferias'] >= 1){
								$objectivo = $row['CH'] * 3.07 * ($workDays - $row['d_ferias']);
								$query_user = mysqli_query($conn, "UPDATE `users` SET `objectivo_bruto` = '". $objectivo ."' WHERE `id` = '". $row['id'] ."'");
							} else {
								$objectivo = $row['CH'] * 3.07 * $workDays;
								$query_user = mysqli_query($conn, "UPDATE `users` SET `objectivo_bruto` = '". $objectivo ."' WHERE `id` = '". $row['id'] ."'");
							}
							if($row['on_off'] == 'OFF'){
								$query_user = mysqli_query($conn, "UPDATE `users` SET `objectivo_bruto` = '0' WHERE `id` = '". $row['id'] ."'");
							}
						}
						
						$sum_objectivo = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(objectivo_bruto) FROM users WHERE `equipa` = '". $equipa[0] ."';"));
						$sum_objectivo_actual = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(pontos) FROM vendas WHERE status != 'AC_MES_SEGUINTE' AND `data` LIKE '". date("Y") ."-". date("m") ."-%' AND `equipa` = '". $equipa[0] ."';"));
						if($sum_objectivo_actual[0] == ''){
							$sum_objectivo_actual[0] = 0;
						}
						
						echo "
							<a style='margin-top: 20px;' class='text_font'>EQUIPA: ". $equipa[0] ."</a></br></br>
							<a style='margin-top: 20px;' class='text_font'>OBJECTIVO BRUTO: ". $sum_objectivo[0] ."</a></br></br>
							<a style='margin-top: 20px;' class='text_font'>OBJECTIVO ACTUAL: ". $sum_objectivo_actual[0] ."</a></br></br>
						";
					?>
				</div>
				<div id='home_perfil_box'>
					<?php
						include("db.php");
						$equipa = mysqli_fetch_array(mysqli_query($conn, "SELECT `equipa` FROM `users` WHERE `user` = '". $_COOKIE['user_coockie'] ."';"));
						$sum_objectivo = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(objectivo_bruto) FROM users WHERE `equipa` = '". $equipa[0] ."';"));
						$value = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(pontos) FROM vendas WHERE status != 'AC_MES_SEGUINTE' AND `data` LIKE '". date("Y") ."-". date("m") ."-%' AND `equipa` = '". $equipa[0] ."';"));
						$percent = (($value[0] / $sum_objectivo[0]) * 100);
						$objectivo_em_falta = $sum_objectivo[0] - $value[0];
						echo "<a style='margin-top: 20px; margin-left: 40px;' class='text_font'>OBJECTIVO EM FALTA: ". $objectivo_em_falta ."</a>";
						if($percent > 100){
							echo "
							<a style='margin-top: 20px; float: right;' class='text_font'>Progresso ( ". number_format( $percent, 0 ) ."% )</a>
							<div id='home_progress_bar_gray'>
								<div id='home_progress_bar_green' style='width: 100%;'></div>
							</div>
							";
						} else {
							echo "
							<a style='margin-top: 20px; float: right;' class='text_font'>Progresso ( ". number_format( $percent, 0 ) ."% )</a>
							<div id='home_progress_bar_gray'>
								<div id='home_progress_bar_green' style='width: ". number_format( $percent, 0 ) ."%;'></div>
							</div>
							";
						}
					?>
				</div>
				<?php
					include("db.php");
					
					$equipa = mysqli_fetch_array(mysqli_query($conn, "SELECT `equipa` FROM `users` WHERE `user` = '". $_COOKIE['user_coockie'] ."';"));
					$select=mysqli_query($conn, "SELECT * FROM users WHERE `id` > '0' AND `equipa` = '". $equipa[0] ."' AND `on_off` = 'ON';");
					while($row=mysqli_fetch_array($select))
					{
						echo "<div id='home_perfil_box_2'>";
							$objectivo = mysqli_fetch_array(mysqli_query($conn, "SELECT `objectivo_bruto` FROM `users` WHERE `user` = '". $row['user'] ."';"));
							$value = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(pontos) FROM vendas WHERE status != 'AC_MES_SEGUINTE' AND `data` LIKE '". date("Y") ."-". date("m") ."-%' AND `user` = '". $row['user'] ."';"));
							$percent = (($value[0] / $objectivo[0]) * 100);
							if($value == ''){
								$value = 0;
							}
							echo "<a style='margin-top: 20px; margin-left: 20px; font-size: 95%; overflow: hidden;' class='text_font'>". $row['user'] ." | PONTOS: ". $value[0] ."</a>";
							if($percent > 100){
								echo "
								<a style='margin-top: 20px; float: right; font-size: 90%;' class='text_font'> Progresso Mensal ( ". number_format( $percent, 0 ) ."% )</a>
								<div id='home_progress_bar_gray_2'>
									<div id='home_progress_bar_green_2' style='width: 100%;'></div>
								</div>
								";
							} else {
								echo "
								<a style='margin-top: 20px; float: right; font-size: 90%;' class='text_font'>Progresso Mensal ( ". number_format( $percent, 0 ) ."% )</a>
								<div id='home_progress_bar_gray_2'>
									<div id='home_progress_bar_green_2' style='width: ". number_format( $percent, 0 ) ."%;'></div>
								</div>
								";
							}
							$count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM vendas WHERE `data` = '". date("Y") ."-". date("m") ."-". date("d") ."' AND STATUS != 'AC_MES_SEGUINTE' AND `user` = '". $row['user'] ."';"));
							$pontosdodia = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(pontos) FROM vendas WHERE `data` = '". date("Y") ."-". date("m") ."-". date("d") ."' AND STATUS != 'AC_MES_SEGUINTE' AND `user` = '". $row['user'] ."';"));
							if($pontosdodia[0] == ''){
								$pontosdodia[0] = 0;
							}
							echo "<a style='margin-top: 20px; float: right; font-size: 90%;' class='text_font'>Numero de vendas hoje: ". $count[0] ."</a>";
							echo "<a style='margin-top: 20px; float: left; font-size: 90%;' class='text_font'>Numero de pontos hoje: ". $pontosdodia[0] ."</a>";
						echo "</div>";
					}
				?>
			</div>
		</div>
	</body>
	<footer style='padding-top: 50px;'>
		<div style='clear: both; position: relative; height: 70px; background-color: #303030;'>
			<div id="footer_text" style='color: #fff;'>
			</br>
				<a><font>© <?php echo "2016-". date("Y"); ?> .Cloud</br></font></a>
				<a><font>Copyright 2010-<?php echo date("Y"); ?>. Holystone CMS All Rights Reserved.</br></font></a>
			</div>
		</div>
	</footer>
</html>