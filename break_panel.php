<?php
	include("cloud_lib.php");
?>
<html>
	<head>
		<title>.Cloud - Break's</title>
		<link rel="shortcut icon" type="image/png" href="media/images/icon.ico" />
		<link rel="stylesheet" type="text/css" href="css/main.css"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="docs/jquery-latest.js"></script>
		<script>
			function myFunction() {
				document.getElementById("myDropdown").classList.toggle("show");
			}

			window.onclick = function(event) {
			if (!$(event.target).hasClass('dropbtn')) {

				var dropdowns = document.getElementsByClassName("dropdown-content");
				var i;
				for (i = 0; i < dropdowns.length; i++) {
				var openDropdown = dropdowns[i];
				if (openDropdown.classList.contains('show')) {
					openDropdown.classList.remove('show');
					}
				}
			}
		}
		function imgWindow() {
			window.open("image") 
		}
		
		$(document).ready(function(){
				setInterval(function() {
					$("#wrapper").load("break_panel.php #wrapper");
				}, 1000);
				$.ajaxSetup({ cache: false });
			});
		</script>
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
		<div id='body_content' style='margin-top: 100px;'>
			<div id='wrapper2' style='height: 60px;'>
				<a class='text_font' style='float: left; width: 120px; margin-top: 2px;'>PEDIR BREAK: </a>
				<select onChange='window.location.href=this.value' name='dummy_mes' style='letter-spacing: 1px; margin-right: 5px; float: left; width: 120px; border-radius: 6px; border: 1px solid #303030; font-family: myFirstFont; font-weight: 200;  font-size: 110%;	text-align: center;'>
					<option value=''></option>
					<?php
						echo "
								<option value='functions.php?id=7&tempo=10'>10 Minutos</option>
								<option value='functions.php?id=7&tempo=15'>15 Minutos</option>
								<option value='functions.php?id=7&tempo=20'>20 Minutos</option>
							";
					?>
				</select>
			</div>
			<div id='wrapper'>
				<div style='width: 100%; height: 40px; border-bottom: 1px solid #E0E0E0; font-size: 110%;'>
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
								<div style='width: 100%; height: 40px;'>
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
									<div style='width: 100%; height: 40px; color: #33CCFF;'>
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
									<div style='width: 100%; height: 40px; color: #FF0000;'>
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