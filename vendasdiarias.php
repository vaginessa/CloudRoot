<?php
	include("cloud_lib.php");
?>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>.Cloud - Registo de Vendas</title>
		<link rel="shortcut icon" type="image/png" href="media/images/icon.ico" />
		<link rel="stylesheet" type="text/css" href="css/main.css"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
		<div id='home_top_navigation_bar'>
			<a href='home.php'><img style='margin-top: 10px; margin-left: 60px; float: left;' width='130px;' height='40px;' src='./media/images/Loginlogo.png'/></a>
		</div>
		<div id='body_content' style='margin-top: 0px;' class='letter_spacing'>
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
			<div id='wrapper' style='margin-top: 50px;'>
				<?php
					include("db.php");
					$count_vendas = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM vendas WHERE `user` = '". $_COOKIE['user_coockie'] ."' AND `data` LIKE '". date("Y-m-d") ."' ORDER BY 1 DESC;"));
					if($count_vendas[0] == '0'){
						echo "<a class='text_font_center' style='font-size: 150%; margin-top: 150px;'>Não tens venda registado no dia de hoje até ao momento.</a>";
					} else {
						echo "
							<div>
								<div id='text_template' style='margin-top: 10px; width: 50px; height: 45px; float: left; line-height: 45px;'></div>
								<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>NOME DO CLIENTE</div>
								<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>CAMPANHA</div>
								<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 100px; height: 45px; float: left; line-height: 45px;'>SERVIÇO</div>
								<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 100px; height: 45px; float: left; line-height: 45px;'>NIF</div>
								<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 100px; height: 45px; float: left; line-height: 45px;'>CALL ID</div>
								<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 300px; height: 45px; float: left; line-height: 45px;'>COMENTARIO</div>
							</div>
						";
					}
				?>
			<?php
				include("db.php");
				$select=mysqli_query($conn, "SELECT * FROM vendas WHERE `user` = '". $_COOKIE['user_coockie'] ."' AND `data` LIKE '". date("Y-m-d") ."' ORDER BY 1 DESC;");
					while($row=mysqli_fetch_array($select))
					{
						if($row['registado'] == 'N'){
							echo "
								<div style='width: 100%; float: left; margin-top: 10px; border-bottom: 1px solid; border-color: #D8D8D8;'>
									<select onChange='window.location.href=this.value' id='vendas_diarias_status' style='margin-top: 10px; width: 50px; height: 45px; float: left; line-height: 45px;'>
										<option value='' disabled selected></option>
										<option value='functions.php?id=3&venda_id=". $row['id'] ."'>REGISTADO</option>
									</select>
									<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px; overflow: hidden;'>". $row["nome"] ."</div>
									<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>". $row["campanha"] ."</div>
									<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 100px; height: 45px; float: left; line-height: 45px; overflow: hidden;'>". $row["servico"] ."</div>
									<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 100px; height: 45px; float: left; line-height: 45px;'>". $row["nif"] ."</div>
									<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 100px; height: 45px; float: left; line-height: 45px;'>". $row["call_id"] ."</div>
									<div id='text_template' class='opacity_on' style='margin-top: 10px; margin-left: 5px; width: 300px; height: 45px; float: left; overflow: scroll; overflow-x: hidden;'>". $row["comentario"] ."</div>
								</div>
							";
						} else {
							echo "
								<div style='width: 100%; float: left; margin-top: 10px; border-bottom: 1px solid; border-color: #D8D8D8; background-color: #99FFCC;'>
									<select id='vendas_diarias_status' style='opacity: 0; margin-top: 10px; width: 50px; height: 45px; float: left; line-height: 45px; background-color: #99FFCC; border-color: #99FFCC;'>
										
									</select>
									<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px; overflow: hidden;'>". $row["nome"] ."</div>
									<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>". $row["campanha"] ."</div>
									<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 100px; height: 45px; float: left; line-height: 45px; overflow: hidden;'>". $row["servico"] ."</div>
									<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 100px; height: 45px; float: left; line-height: 45px;'>". $row["nif"] ."</div>
									<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 100px; height: 45px; float: left; line-height: 45px;'>". $row["call_id"] ."</div>
									<div id='text_template' class='opacity_on' style='margin-top: 10px; margin-left: 5px; width: 300px; height: 45px; float: left; overflow: scroll; overflow-x: hidden;'>". $row["comentario"] ."</div>
								</div>
							";
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
				<a><font>© <?php echo date("Y"); ?> .Cloud</br></font></a>
				<a><font>Copyright 2010-<?php echo date("Y"); ?>. Holystone CMS All Rights Reserved.</br></font></a>
			</div>
		</div>
	</footer>
</html>