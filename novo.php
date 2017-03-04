<?php
	include("cloud_lib.php")
?>
<html>
	<head>
		<title>.Cloud - Novo Contacto</title>
		<link rel="shortcut icon" type="image/png" href="media/images/icon.ico" />
		<link rel="stylesheet" type="text/css" href="css/main.css"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<script type="text/javascript">
			var datefield=document.createElement("input")
			datefield.setAttribute("type", "date")
			if (datefield.type!="date"){ //if browser doesn't support input type="date", load files for jQuery UI Date Picker
				document.write('<link href="docs/JQuery/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
				document.write('<script src="docs/JQuery/jquery.min.js"><\/script>\n')
				document.write('<script src="docs/JQuery/jquery-ui.min.js"><\/script>\n') 
			}
		</script>
		<script>
			if (datefield.type!="date"){ //if browser doesn't support input type="date", initialize date picker widget:
				jQuery(function($){ //on document.ready
					$('#novo_input_date').datepicker();
				})
			}
			if (datefield.type!="date"){ //if browser doesn't support input type="date", initialize date picker widget:
				jQuery(function($){ //on document.ready
					$('#novo_input_date2').datepicker();
				})
			}
			function showDiv(elem){
   			if(elem.value != 'TVNETVOZ:10' && elem.value != 'NETVoZ Fibra:10') {
   				document.getElementById('novo_input_date').style.display = "none";
   			} else {
   				document.getElementById('novo_input_date').style.display = "";
   			}
			}
		</script>
	</head>
	<body>
		<div id='home_top_navigation_bar'>
			<a href='home.php'><img style='margin-top: 10px; margin-left: 60px; float: left;' width='130px;' height='40px;' src='./media/images/Loginlogo.png'/></a>
		</div>
		<div id='body_content'>
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
			<div id='wrapper' style='margin-top: 50px; position: relative; display:table;'>
				<a class='text_font' style='font-size: 150%; margin-top: 100px; width: 100%;'>NOVO REGISTO DE VENDA</a>
				<form action='inserir.php'>
					<div id='novo_form'>
						<div id='novo_left_box'>
							<input id='novo_input_nome' style='text-align: center; letter-spacing: 1px;' type='text' placeholder='Nome do Cliente' name='novo_nome' autocomplete="off" required>
							<input id='novo_input_nome' style='text-align: center; letter-spacing: 1px;' type='text' placeholder='Numero de Contribuinte' name='novo_nif' maxlength='9' autocomplete="off" required>
							<select id='novo_input_nome' name='novo_servico' style='letter-spacing: 1px;' onchange="showDiv(this)">
								<option value="" disabled selected>Serviços</option>
								<?php
									include("db.php");
									$select=mysqli_query($conn, "SELECT * FROM campanhas_servicos WHERE `id` > '0' AND `type` = 'servico' AND `status` = 'Y';");
									while($row=mysqli_fetch_array($select))
									{
										echo "<option value='". $row['value'] ."'>". $row['name'] ."</option>";
									}
								?>
							</select>
							<select id='novo_input_nome' name='novo_campanha' style='letter-spacing: 1px;'>
								<option value='' disabled selected>Campanha</option>
								<?php
									include("db.php");
									$select=mysqli_query($conn, "SELECT * FROM campanhas_servicos WHERE `id` > '0' AND `type` = 'campanha' AND `status` = 'Y';");
									while($row=mysqli_fetch_array($select))
									{
										echo "<option value='". $row['value'] ."'>". $row['name'] ."</option>";
									}
								?>
							</select>
							<input id='novo_input_nome' style='text-align: center; letter-spacing: 1px;' type='text' placeholder='Call ID' name='novo_call_id' maxlength='10' autocomplete="off" required>
						</div>
						<div id='novo_right_box'>
							<textarea id='novo_textarea' name='novo_comentario' autocomplete="off" style='letter-spacing: 1px;' required></textarea>
							<input id='novo_input_date' style='display: none; text-align: center;' type='date' placeholder='Data de Instalação / Registo' name='novo_data' autocomplete="off">
						</div>
						<button id="novo_form_button" style='letter-spacing: 1px;'>ADICIONAR VENDA</button>
					</div>
				</form>
			</div>
			<div id='wrapper' style='margin-top: 150px; position: relative; display:table;'>
				<a class='text_font' style='font-size: 150%; margin-top: 100px; width: 100%;'>NOVO REGISTO DE CALLBACK</a>
				<form action='inserir_callback.php'>
					<div id='novo_form'>
						<div id='novo_left_box'>
							<input id='novo_input_nome' style='text-align: center; letter-spacing: 1px;' type='text' placeholder='Nome do Cliente' name='novo_nome' autocomplete="off" required>
							<input id='novo_input_nome' style='text-align: center; letter-spacing: 1px;' type='text' placeholder='Numero de Contacto' name='novo_numero' maxlength='9' autocomplete="off" required>
							<input id='novo_input_date2' style='text-align: center; width: 60%; letter-spacing: 1px;' type='date' placeholder='Data de Callback' name='novo_data' autocomplete="off" required>
							<select id='novo_input_nome' style='width: 24%; letter-spacing: 1px;' name="time">
								<option value="09:00 AM">9:00 AM</option>
								<option value="09:15 AM">9:15 AM</option>
								<option value="09:30 AM">9:30 AM</option>
								<option value="09:45 AM">9:45 AM</option>
								<option value="10:00 AM">10:00 AM</option>
								<option value="10:15 AM">10:15 AM</option>
								<option value="10:30 AM">10:30 AM</option>
								<option value="10:45 AM">10:45 AM</option>
								<option value="11:00 AM">11:00 AM</option>
								<option value="11:15 AM">11:15 AM</option>
								<option value="11:30 AM">11:30 AM</option>
								<option value="11:45 AM">11:45 AM</option>
								<option value="12:00 PM">12:00 PM</option>
								<option value="12:15 PM">12:15 PM</option>
								<option value="12:30 PM">12:30 PM</option>
								<option value="12:45 PM">12:45 PM</option>
								<option value="01:00 PM">1:00 PM</option>
								<option value="01:15 PM">1:15 PM</option>
								<option value="01:30 PM">1:30 PM</option>
								<option value="01:45 PM">1:45 PM</option>
								<option value="02:00 PM">2:00 PM</option>
								<option value="02:15 PM">2:15 PM</option>
								<option value="02:30 PM">2:30 PM</option>
								<option value="02:45 PM">2:45 PM</option>
								<option value="03:00 PM">3:00 PM</option>
								<option value="03:15 PM">3:15 PM</option>
								<option value="03:30 PM">3:30 PM</option>
								<option value="03:45 PM">3:45 PM</option>
								<option value="04:00 PM">4:00 PM</option>
								<option value="04:15 PM">4:15 PM</option>
								<option value="04:30 PM">4:30 PM</option>
								<option value="04:45 PM">4:45 PM</option>
								<option value="05:00 PM">5:00 PM</option>
								<option value="05:15 PM">5:15 PM</option>
								<option value="05:30 PM">5:30 PM</option>
								<option value="05:45 PM">5:45 PM</option>
								<option value="06:00 PM">6:00 PM</option>
								<option value="06:15 PM">6:15 PM</option>
								<option value="06:30 PM">6:30 PM</option>
								<option value="06:45 PM">6:45 PM</option>
								<option value="07:00 PM">7:00 PM</option>
								<option value="07:15 PM">7:15 PM</option>
								<option value="07:30 PM">7:30 PM</option>
								<option value="07:45 PM">7:45 PM</option>
								<option value="08:00 PM">8:00 PM</option>
								<option value="08:15 PM">8:15 PM</option>
								<option value="08:30 PM">8:30 PM</option>
								<option value="08:45 PM">8:45 PM</option>
								<option value="09:00 PM">9:00 PM</option>
								<option value="09:15 PM">9:15 PM</option>
								<option value="09:30 PM">9:30 PM</option>
								<option value="09:45 PM">9:45 PM</option>
								<option value="10:00 PM">10:00 PM</option>
							</select>
						</div>
						<div id='novo_right_box'>
							<textarea id='novo_textarea_callback' name='novo_comentario' autocomplete="off" style='letter-spacing: 1px;' required></textarea>
							<button id="novo_form_button" style='width: 90%; margin-left: 5%; margin-top: 25px; height: 40px; letter-spacing: 1px;'>ADICIONAR CALLBACK</button>
						</div>
					</div>
				</form>
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