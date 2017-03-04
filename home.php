<?php
	include("cloud_lib.php");
?>
<html>
	<head>
		<title>.Cloud - Home</title>
		<link rel="shortcut icon" type="image/png" href="media/images/icon.ico" />
		<link rel="stylesheet" type="text/css" href="css/main.css"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	</head>
	<body>
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
						$nome = mysqli_fetch_array(mysqli_query($conn, "SELECT `user` FROM `users` WHERE `user` = '". $_COOKIE['user_coockie'] ."';"));
						$email = mysqli_fetch_array(mysqli_query($conn, "SELECT `email` FROM `users` WHERE `user` = '". $_COOKIE['user_coockie'] ."';"));
						$sfid = mysqli_fetch_array(mysqli_query($conn, "SELECT `sfid` FROM `users` WHERE `user` = '". $_COOKIE['user_coockie'] ."';"));
						echo "
							<a style='margin-top: 20px;' class='text_font'>USER: ". $nome[0] ."</a></br></br>
							<a style='margin-top: 20px;' class='text_font'>EMAIL: ". $email[0] ."</a></br></br>
							<a style='margin-top: 20px;' class='text_font'>SFID: ". $sfid[0] ."</a></br></br>
						";
					?>
				</div>
				<div id='home_perfil_box'>
					<?php
						include("db.php");
						$objectivo = mysqli_fetch_array(mysqli_query($conn, "SELECT `objectivo_bruto` FROM `users` WHERE `user` = '". $_COOKIE['user_coockie'] ."';"));
						$value = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(pontos) FROM vendas WHERE `data` LIKE '". date("Y") ."-". date("m") ."-%' AND `user` = '". $_COOKIE['user_coockie'] ."';"));
						$percent = (($value[0] / $objectivo[0]) * 100);
						$objectivo_em_falta = $objectivo[0] - $value[0];
						if($objectivo_em_falta > 0){
							echo "<a style='margin-top: 20px; margin-left: 40px;' class='text_font'>OBJECTIVO EM FALTA: ". $objectivo_em_falta ."</a>";
						} else {
							echo "<a style='margin-top: 20px; margin-left: 40px;' class='text_font'>OBJECTIVO ATINGIDO: ". $value[0] ."</a>";
						}
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
				<div id='home_perfil_box'>
					<?php
						include("db.php");
						
						$value = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(pontos) FROM vendas WHERE `data` LIKE '". date("Y") ."-". date("m") ."-%' AND `user` = '". $_COOKIE['user_coockie'] ."';"));
						$count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM vendas WHERE `data` LIKE '". date("Y") ."-". date("m") ."-%' AND `user` = '". $_COOKIE['user_coockie'] ."';"));
						$count_total = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM vendas WHERE `data` > 0 AND `user` = '". $_COOKIE['user_coockie'] ."';"));
						$objectivo = mysqli_fetch_array(mysqli_query($conn, "SELECT `objectivo_bruto` FROM `users` WHERE `user` = '". $_COOKIE['user_coockie'] ."';"));
						if($value[0] == ''){
							$value = 0;
						} else {
							$value = $value[0];
						}
						echo "
							<a style='margin-top: 20px;' class='text_font'>Objectivo Efectivos: ". $objectivo[0] ."</a></br></br>
							<a style='margin-top: 20px;' class='text_font'>Objectivo Atingidos: ". $value ."</a></br></br></br>
							<a style='margin-top: 20px;' class='text_font'>Nº de vendas: ". $count[0] ."</a></br></br>
							<a style='margin-top: 20px;' class='text_font'>Nº total de vendas: ". $count_total[0] ."</a>
						";
					?>
				</div>
				<div id='home_perfil_box'>
					<?php
						include("db.php");
						$objectivo = mysqli_fetch_array(mysqli_query($conn, "SELECT `objectivo_bruto` FROM `users` WHERE `user` = '". $_COOKIE['user_coockie'] ."';"));
						$value = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(pontos) FROM vendas WHERE `data` LIKE '". date("Y") ."-". date("m") ."-%' AND `STATUS` = 'ACTIVO' AND `user` = '". $_COOKIE['user_coockie'] ."';"));
						$percent = (($value[0] / $objectivo[0]) * 100);
						echo "<a style='margin-top: 20px; margin-left: 40px;' class='text_font'>PONTOS ACTIVOS: ". $value[0] ."</a>";
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
			</div>
		</div>
	</body>
	<footer style='padding-top: 50px;'>
		<div style='clear: both; position: relative; height: 70px; background-color: #303030;'>
			<div id="footer_text" style='color: #fff;'>
			</br>
				<a><font>© <?php echo date("Y"); ?> .Cloud</br></font></a>
				<a><font>Copyright 2010-<?php echo date("Y"); ?>. Holystone CMS All Rights Reserved.</br></font></a>
			</div>
		</div>
	</footer>
</html>