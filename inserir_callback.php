<?php
	if(!isset($_COOKIE['user_coockie'])) {
		header('location: index.php');
	}
	include("db.php");
	$dummy_nome = mysqli_real_escape_string($conn, htmlspecialchars($_GET["novo_nome"]));
	$dummy_numero = mysqli_real_escape_string($conn, htmlspecialchars($_GET["novo_numero"]));
	$dummy_comentario = mysqli_real_escape_string($conn, htmlspecialchars($_GET["novo_comentario"]));
	$dummy_data_dummy = mysqli_real_escape_string($conn, htmlspecialchars($_GET["novo_data"]));
	$dummy_data = date('Y-m-d', strtotime($dummy_data_dummy));
	$dummy_hora = mysqli_real_escape_string($conn, htmlspecialchars($_GET["time"]));
	$query=mysqli_query($conn, "INSERT INTO `cloud`.`callbacks` (`user`, `nome`, `numero`, `comentario`, `hora`, `callback_data`) VALUES ('". $_COOKIE['user_coockie'] ."', '". $dummy_nome ."', '". $dummy_numero ."', '". $dummy_comentario ."', '". $dummy_hora ."', '". $dummy_data ."');");
	$select=mysqli_query($conn, "INSERT INTO `log` (`log_text`) VALUES ('INSERIDO CALLBACK USER: ". $_COOKIE['user_coockie'] ." | ". date("Y/m/d h:i:s") ." | PARA O NUMERO ". $dummy_numero ."');");
	echo "<meta http-equiv='refresh' content='0;URL=novo.php' />";
?>

<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Loading . . .</title>
		<link rel="shortcut icon" type="image/png" href="media/images/icon.ico" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body style='background-color: #fff;'>
		<div style='background-color: #fff; max-width: 980px; margin:0 auto; margin-top: 325px;'>
			<img style='margin-left: 440px;' width='100px;' height='100px;' src='./media/images/loading_processmaker.gif'/>
		</div>
	</body>
</html>