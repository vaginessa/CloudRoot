<?php
	error_reporting(0);
	if(!isset($_COOKIE['user_coockie'])) {
		header('location: index.php');
	}
	include("db.php");
	$dummy_nome = mysqli_real_escape_string($conn, htmlspecialchars($_GET["novo_nome"]));
	$dummy_nif = mysqli_real_escape_string($conn, htmlspecialchars($_GET["novo_nif"]));
	$dummy_num = mysqli_real_escape_string($conn, htmlspecialchars($_GET["novo_num"]));
	$dummy_morada = mysqli_real_escape_string($conn, htmlspecialchars($_GET["novo_morada"]));
	$dummy_campanha = mysqli_real_escape_string($conn, htmlspecialchars($_GET["novo_campanha"]));
	$dummy_call_id = mysqli_real_escape_string($conn, htmlspecialchars($_GET["novo_call_id"]));
	$dummy_comentario = mysqli_real_escape_string($conn, htmlspecialchars($_GET["novo_comentario"]));
	$dummy_data_instalacao_dummy = mysqli_real_escape_string($conn, htmlspecialchars($_GET["novo_data"]));
	$dummy_data_instalacao = date('Y-m-d', strtotime($dummy_data_instalacao_dummy));
	$dummy_data = date("Y-m-d");
	$dummy_servico = mysqli_real_escape_string($conn, htmlspecialchars($_GET["novo_servico"]));
	$arr = explode(":", $dummy_servico);
	$equipa = mysqli_fetch_array(mysqli_query($conn, "SELECT `equipa` FROM `users` WHERE `user` = '". $_COOKIE['user_coockie'] ."';"));
	$query=mysqli_query($conn, "INSERT INTO `cloud`.`vendas` (`user`, `equipa`, `nome`, `num`, `morada`, `campanha`, `servico`, `data`, `data_instalacao`, `nif`, `call_id`, `pontos`, `comentario`) VALUES ('". $_COOKIE['user_coockie'] ."', '". $equipa[0] ."' , '". $dummy_nome ."', '". $dummy_num ."', '". $dummy_morada ."', '". $dummy_campanha ."', '". $arr[0] ."', '". $dummy_data ."', '". $dummy_data_instalacao ."', '". $dummy_nif ."', '". $dummy_call_id ."', '". $arr[1] ."', '". $dummy_comentario ."');");
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