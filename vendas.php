<?php
	include("cloud_lib.php");
	if(!isset($_GET['data'])){
		header("Location: vendas.php?data=". date("Y-m"));
	}
	if(!isset($_GET['index']) & isset($_GET['data'])){
		$data = htmlspecialchars($_GET["data"]);
		$count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM vendas WHERE `data` LIKE '". $data ."-%' AND `user` = '". $_COOKIE['user_coockie'] ."';"));
		$count_id = $count[0] / 10;
		$count_format = number_format($count_id, 0, ',', ' ');
		header("Location: vendas.php?data=". $data ."&index=0&pages=". $count_format);
	}
?>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>.Cloud - Registo de Vendas</title>
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
		<div id='body_content' style='margin-top: 0px;'>
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
			<div id='wrapper' style='height 50px; margin-top: 50px;'>
				<div style='width: 100%; height: 25px;'>
					<form action='search.php'>
						<select name='dummy_mes' style='letter-spacing: 1px; margin-right: 5px; float: left; width: 100px; border-radius: 6px; border: 1px solid #F8F8F8; font-family: myFirstFont; font-weight: 200;  font-size: 95%;	text-align: center;'>
							<option value='01'>Janeiro</option>
							<option value='02'>Fevereiro</option>
							<option value='03'>Março</option>
							<option value='04'>Abril</option>
							<option value='05'>Maio</option>
							<option value='06'>Junho</option>
							<option value='07'>Julho</option>
							<option value='08'>Agosto</option>
							<option value='09'>Setembro</option>
							<option value='10'>Outubro</option>
							<option value='11'>Novembro</option>
							<option value='12'>Dezembro</option>
						</select>
						<select name='dummy_ano' style='letter-spacing: 1px; margin-right: 5px; float: left; width: 60px; border-radius: 6px; border: 1px solid #F8F8F8; font-family: myFirstFont; font-weight: 200;  font-size: 95%;	text-align: center;'>
							<option value='<?php echo date("Y"); ?>'><?php echo date("Y"); ?></option>
							<option value='<?php echo date("Y") - 1; ?>'><?php echo date("Y") - 1; ?></option>
							<option value='<?php echo date("Y") - 2; ?>'><?php echo date("Y") - 2; ?></option>
						</select>
						<button style='background-color: #fff; margin-right: 5px; float: left; width: 60px; border-radius: 6px; border: 1px solid #000; font-family: myFirstFont; font-weight: 200;  font-size: 95%;	text-align: center;'>Filtrar</button>
					</div>
				</form>
			</div>
			<div id='wrapper' style='margin-top: 25px;'>
				<div>
					<div id='text_template' style='margin-top: 10px; width: 50px; height: 45px; float: left; line-height: 45px;'></div>
					<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>NOME DO CLIENTE</div>
					<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 150px; height: 45px; float: left; line-height: 45px;'>CAMPANHA</div>
					<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 100px; height: 45px; float: left; line-height: 45px;'>SERVIÇO</div>
					<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 100px; height: 45px; float: left; line-height: 45px;'>NIF</div>
					<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 100px; height: 45px; float: left; line-height: 45px;'>CALL ID</div>
					<div id='text_template' style='margin-top: 10px; margin-left: 5px; width: 300px; height: 45px; float: left; line-height: 45px;'>COMENTARIO</div>
				</div>
			<?php
				include("db.php");
				$data = htmlspecialchars($_GET["data"]);
				$index = htmlspecialchars($_GET["index"]);
				$pages = htmlspecialchars($_GET["pages"]);
				$select=mysqli_query($conn, "SELECT * FROM vendas WHERE `user` = '". $_COOKIE['user_coockie'] ."' AND `data` LIKE '". $data ."-%' ORDER BY 1 DESC LIMIT ". $index ."0, 10;");
					while($row=mysqli_fetch_array($select))
					{
						if($row['status'] == 'PENDENTE'){
							echo "
								<div style='width: 100%; float: left; margin-top: 10px; border-bottom: 1px solid; border-color: #D8D8D8; background-color: #FFFF99;'>
									<select onChange='window.location.href=this.value' id='vendas_diarias_status' style='margin-top: 10px; width: 50px; height: 45px; float: left; line-height: 45px; background-color: #FFFF99; border-color: #FFFF99;'>
										<option value='' disabled selected></option>
										<option value='functions.php?id=4&venda_id=". $row['id'] ."&index=". $index ."&data=". $data ."&pages=". $pages ."'>CONCLUIDO</option>
										<option value='functions.php?id=5&venda_id=". $row['id'] ."&index=". $index ."&data=". $data ."&pages=". $pages ."'>CANCELADO</option>
										<option value='functions.php?id=12&venda_id=". $row['id'] ."&index=". $index ."&data=". $data ."&pages=". $pages ."'>MÊS SEGUINTE</option>
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
						if($row['status'] == 'ACTIVO'){
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
						if($row['status'] == 'CANCELADO'){
							echo "
								<div style='width: 100%; float: left; margin-top: 10px; border-bottom: 1px solid; border-color: #D8D8D8; background-color: #FF6666;'>
									<select id='vendas_diarias_status' style='opacity: 0; margin-top: 10px; width: 50px; height: 45px; float: left; line-height: 45px; background-color: #FF6666; border-color: #FF6666;'>
										
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
						if($row['status'] == 'AC_MES_SEGUINTE'){
							echo "
								<div style='width: 100%; float: left; margin-top: 10px; border-bottom: 1px solid; border-color: #D8D8D8; background-color: #aafaff;'>
									<select id='vendas_diarias_status' style='opacity: 0; margin-top: 10px; width: 50px; height: 45px; float: left; line-height: 45px; background-color: #FF6666; border-color: #FF6666;'>
										
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
			<?php
				$page = $_GET['index'];
				$last_page = $page - 1;
				$data = $_GET['data'];
				$pages = $_GET['pages'];
				if($page >= '1'){
					echo "
						<div style='width: 150px; height: 50px; line-height: 50px; float: left; text-align: left; margin-left: 50px;' class='text_font letter_spacing'>
							<a href='vendas.php?data=". $data ."&index=". $last_page ."&pages=". $pages ."' style='color: 00CCFF; text-decoration: none;'>&#10096; Página ". ($last_page + 1) ."</a>
						</div>
					";
				}
			?>
			<?php
				$page = $_GET['index'];
				$next_page = $page + 1;
				$data = $_GET['data'];
				$pages = $_GET['pages'];
				if($page < $pages){
					echo "
						<div style='width: 150px; height: 50px; line-height: 50px; float: right; text-align: right; margin-right: 50px;' class='text_font letter_spacing'>
							<a href='vendas.php?data=". $data ."&index=". $next_page ."&pages=". $pages ."' style='color: 00CCFF; text-decoration: none;'>Página ". ($next_page + 1) ." &#10097;</a>
						</div>
					";
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