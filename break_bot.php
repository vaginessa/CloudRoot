<?php
	include("cloud_lib.php");
	$sql_user_get_permissions = mysqli_fetch_array(mysqli_query($conn, "SELECT `permissions` FROM `users` WHERE `user` = '". $_COOKIE['user_coockie'] ."';"));
	if($sql_user_get_permissions[0] == 1){
		echo "<meta http-equiv='refresh' content='0;URL=home.php' />";
	}
?>

<html>
	<head>
		<title>.Cloud - Cloud Bot</title>
		<link rel="shortcut icon" type="image/png" href="media/images/icon.ico" />
		<link rel="stylesheet" type="text/css" href="css/main.css"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="docs/jquery-latest.js"></script>
		<script>
		function imgWindow() {
			window.open("image") 
		}
		$(document).ready(function(){
				setInterval(function() {
					$("#body_breaks").load("break_bot.php #body_breaks");
				}, 1000);
				$.ajaxSetup({ cache: false });
		});
		function on_off() {
			window.location.replace("functions.php?id=6");
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
			<div id='wrapper' style='background-color: #F8F8F8;'>
				<div id='bot_check' style='height: 50px; width: 300px;'>
					<div class="onoffswitch" onclick='on_off()' style='float: left; line-height: 50px;'>
						<?php
							include("db.php");
							$query = mysqli_fetch_array(mysqli_query($conn, "SELECT `auto_break` FROM `settings` WHERE `id` = '1';"));
							if($query[0] == 'N'){
								echo "
									<input type='checkbox' name='onoffswitch' class='onoffswitch-checkbox' id='myonoffswitch'>
								";
							} else {
								echo "
									<input type='checkbox' name='onoffswitch' class='onoffswitch-checkbox' id='myonoffswitch' checked>
								";
							}
						?>
						<label class="onoffswitch-label" for="myonoffswitch">
							<span class="onoffswitch-inner"></span>
							<span class="onoffswitch-switch"></span>
						</label>
					</div>
					<a class='text_font letter_spacing' style='float: left; margin-left: 15px; margin-top: 5px; font-size: 125%;'>Auto-Break</a>
				</div>
				<div id='break_bot_max_box'>
					<form action='functions.php?id=11' method='post'>
						<?php
							include("db.php");
							$query = mysqli_fetch_array(mysqli_query($conn, "SELECT `max_breaks` FROM `settings` WHERE `id` = '1';"));
							echo "<input id='break_insert_box' type='number' style='outline: none;' value='". $query[0] ."' onfocus=\"this.style.color='#000';\" style=\"color: #000;\" onkeypress='if(event.charCode >= 48 && event.charCode <= 57) return true'  min='0' max='10' name='max_breaks'/>";
						?>
						<button id='break_insert_button'>UPDATE</button>
					</form>
				</div>
				<div id='body_breaks'>
					<div style='margin-top: 30px; width: 100%; height: 40px; border-bottom: 1px solid #E0E0E0; background-color: #F8F8F8; font-size: 110%;'>
						<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px; border-bottom: #303030;'>HORA PEDIDO</div>
						<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>USER</div>
						<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>PERIODO BREAK</div>
						<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>AUTORIZADO</div>
						<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>INICIO</div>
						<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 200px; height: 45px; float: left; line-height: 45px;'>TEMPO UTILIZADO</div>
					</div>
					<?php
						include("db.php");
						$select=mysqli_query($conn, "SELECT * FROM breaks WHERE `id` > 0 AND `status` = 'N';");
						while($row=mysqli_fetch_array($select))
						{
							if($row['autorizado'] == ''){
								echo "
									<div style='width: 100%; height: 40px; background-color: #F8F8F8;'>
										<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px; border-bottom: #303030;'>". $row['data'] ."</div>
										<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>". $row['user'] ."</div>
										<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>". $row['tempo_pedido'] ." Min</div>
										<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>". $row['autorizado'] ."</div>
										<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>". $row['inicio'] ."</div>
										<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 200px; height: 45px; float: left; line-height: 45px;'>". $row['tempo_utilizado'] ."</div>
									</div>
								";
							} else {
								if($row['aceite'] == 'N'){
									echo "
										<div style='width: 100%; height: 40px; background-color: #F8F8F8; color: #33CCFF;'>
											<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px; border-bottom: #303030;'>". $row['data'] ."</div>
											<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>". $row['user'] ."</div>
											<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>". $row['tempo_pedido'] ." Min</div>
											<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>". $row['autorizado'] ."</div>
											<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>". $row['inicio'] ."</div>
											<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 200px; height: 45px; float: left; line-height: 45px;'>". $row['tempo_utilizado'] ."</div>
										</div>
									";
								} else {
									echo "
										<div style='width: 100%; height: 40px; background-color: #F8F8F8; color: #FF0000;'>
											<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px; border-bottom: #303030;'>". $row['data'] ."</div>
											<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>". $row['user'] ."</div>
											<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>". $row['tempo_pedido'] ." Min</div>
											<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>". $row['autorizado'] ."</div>
											<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>". $row['inicio'] ."</div>
											<div id='text_template' style='margin-top: 0px; margin-left: 5px; width: 200px; height: 45px; float: left; line-height: 45px;'>". $row['tempo_utilizado'] ."</div>
										</div>
									";
								}
							}
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
				<a><font>© <?php echo "2016-". date("Y"); ?> .Cloud</br></font></a>
				<a><font>Copyright 2010-<?php echo date("Y"); ?>. Holystone CMS All Rights Reserved.</br></font></a>
			</div>
		</div>
	</footer>
</html>