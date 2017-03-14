<?php
	include("cloud_lib.php");
	include("db.php");
	$processo_id = htmlspecialchars($_GET["processo_id"]);
	$nif = mysqli_fetch_array(mysqli_query($conn, "select `nif` FROM vendas WHERE id = ". $processo_id .""));
	setcookie("nif", $nif[0], time() + (60 * 60), "/");
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
		<div id='body_content' style='margin-top: 50px;'>
			<div id='wrapper' style='margin-top: 0px;'>
				<?php
					$processo_id = htmlspecialchars($_GET["processo_id"]);
					$select = mysqli_query($conn, "SELECT * FROM vendas WHERE id = '". $processo_id ."';");
					while($row=mysqli_fetch_array($select))
					{
						echo "
							<div class='text_font' style='border: 2px #0d0d0d; color: #000; height: 50px; width: 100%; position: relative; float: left; background-color: #f2f2f2; line-height: 50px;'>
								<a style='padding-left: 10px; font-size: 17px;'>Nome: </a><a style='padding-left: 10px; font-size: 20px;'>". $row['nome'] ."</a>
							</div>
							<div class='text_font' style='color: #000; height: 50px; width: 40%; position: relative; float: left; margin-top: 20px; margin-left: 5%; background-color: #f2f2f2; line-height: 50px;'>
								<a style='padding-left: 10px; font-size: 17px;'>Numero: </a>
							</div>
							<div class='text_font' style='color: #000; height: 50px; width: 40%; position: relative; float: left; margin-top: 20px; margin-left: 5%; background-color: #f2f2f2; line-height: 50px;'>
								<a style='padding-left: 10px; font-size: 17px;'>Nif: </a><a style='padding-left: 10px; font-size: 20px;'>". $row['nif'] ."</a>
							</div>
							<div class='text_font' style='color: #000; height: 50px; width: 100%; position: relative; float: left; background-color: #f2f2f2; margin-top: 20px; line-height: 50px;'>
								<a style='padding-left: 10px; font-size: 17px;'>Morada: </a>
							</div>
							<div class='text_font' style='color: #000; height: 50px; width: 40%; position: relative; float: left; margin-top: 20px; margin-left: 5%; background-color: #f2f2f2; line-height: 50px;'>
								<a style='padding-left: 10px; font-size: 17px;'>Serviço: </a><a style='padding-left: 10px; font-size: 20px;'>". $row['servico'] ."</a>
							</div>
							<div class='text_font' style='color: #000; height: 50px; width: 40%; position: relative; float: left; margin-top: 20px; margin-left: 5%; background-color: #f2f2f2; line-height: 50px;'>
								<a style='padding-left: 10px; font-size: 17px;'>Data: </a><a style='padding-left: 10px; font-size: 20px;'>". $row['data'] ."</a>
							</div>
							";
						if($row['servico'] == 'TVNETVOZ' || $row['servico'] == 'NETVoZ Fibra'){
							echo "
								<div class='text_font' style='color: #000; height: 50px; width: 40%; position: relative; float: left; margin-top: 20px; margin-left: 5%; background-color: #f2f2f2; line-height: 50px;'>
									<a style='padding-left: 10px; font-size: 17px;'>Instalação: </a><a style='padding-left: 10px; font-size: 20px;'>". $row['data_instalacao'] ."</a>
								</div>
							";
						}							
						echo "
							<div class='text_font' style='color: #000; min-height: 150px; width: 100%; position: relative; float: left; background-color: #f2f2f2; margin-top: 20px; line-height: 30px;'>
								<a style='padding-left: 10px; font-size: 17px;'>Comentário: </a><a style='padding-left: 10px; font-size: 20px;'>". $row['comentario'] ."</a>
							</div>
						";
					}
					$nif = mysqli_fetch_array(mysqli_query($conn, "select `nif` FROM vendas WHERE id = ". $processo_id .""));
					$count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM comentarios WHERE nif = '". $nif[0] ."';"));
					if($count[0] > 0){
						echo "
							<div class='text_font' style='margin-top: 40px; height: 50px; width: 100%; position: relative; float: left; border: none; border-bottom: 2px solid #000; line-height: 50px;'>
								<a style='font-size: 20px; padding-left: 30px;'>Notas: </a>
							</div>
						";
					}
					$select2 = mysqli_query($conn, "SELECT * FROM comentarios WHERE nif = '". $nif[0] ."';");
					while($row2=mysqli_fetch_array($select2))
					{
						echo "
							<div class='text_font' style='color: #000; min-height: 150px; width: 90%; position: relative; float: left; margin-left: 5%; background-color: #f2f2f2; margin-top: 20px;'>
								<a style='padding-left: 20px; float: right; padding-right: 15px; line-height: 30px;'>". $row2['data'] ."</a></br><a style='padding-left: 10px; font-size: 20px; line-height: 30px;'>". $row2['comentario'] ."</a>
							</div>
						";
					}
				?>
				<div class='text_font' style='margin-top: 40px; height: 50px; width: 100%; position: relative; float: left; border: none; border-bottom: 2px solid #000; line-height: 50px;'>
					<a style='font-size: 20px; padding-left: 30px;'>Nova nota: </a>
				</div>
				<form action='inserir_nota.php'>
					<div id='novo_form'>
						<textarea id='novo_textarea' name='nova_nota_nome' autocomplete="off" style='letter-spacing: 1px;' required></textarea>
					<button id="novo_nota_button" style='letter-spacing: 1px;'>ADICIONAR NOTA</button>
					</div>
				</form>
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