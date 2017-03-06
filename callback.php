<?php
	include("cloud_lib.php");
?>
<html>
	<head>
		<title>.Cloud - Callback</title>
		<link rel="shortcut icon" type="image/png" href="media/images/icon.ico" />
		<link rel="stylesheet" type="text/css" href="css/main.css"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">
		<script language="javascript" type="text/javascript">
			function popup() {
				$( "#dialog" ).dialog();
			}
			
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
		<div id='wrapper'>
			<div id='home_news_template'>
				<?php
				include("db.php");
				$data = htmlspecialchars($_GET["data"]);
				$select = mysqli_query($conn, "SELECT * FROM `callbacks` WHERE `user` = '". $_COOKIE['user_coockie'] ."' AND `callback_data` = '". date("Y-m-d") ."' AND `tratado` = 'N';");
				$count_callbacks = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM `callbacks` WHERE `user` = '". $_COOKIE['user_coockie'] ."' AND `callback_data` = '". date("Y-m-d") ."' AND `tratado` = 'N';"));
				$mons = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'); 
				$date = getdate(); 
				$month = $date['mon']; 
				$month_name = $mons[$month];
					if($count_callbacks[0] == '0'){
						echo "<a class='text_font_center' style='font-size: 150%; margin-top: 150px;'>Não tens nenhum callback marcado para hoje até ao momento.</a>";
					}
					while($row=mysqli_fetch_array($select))
					{
						echo "
							<div id='home_news'>
								<div id='news_date'>
									<img width='100%' height='100%' src='./media/images/date3.png'/>
									<div class='news_day text_font_center' style='z-index: 5;'>
										<a>". date('d') ."</a>
									</div>
									<div class='news_month text_font_center' style='z-index: 5;'>
										<a>". $month_name ."</a>
									</div>
								</div>
								<div style='width: 85%; height: 30px; float: right; margin-top: -50px; margin-right: 3%;' class='text_font'>
									<a style='text-align: left; color: #000; font-size: 120%;'>". $row['nome'] ."</a>
								</div>
								<div style='width: 94%; min-height: 100px; float: left; margin-top: 10px; margin-left: 3%; line-height: 1.5em;' class='text_font'>
									<a style='text-align: left; color: #000; font-size: 100%;'>Numero: ". $row['numero'] ."</br>Hora: ". $row['hora'] ."</br>". $row['comentario'] ."</a>
								</div>
							</div>";
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