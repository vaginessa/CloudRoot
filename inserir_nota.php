<?php
	if(!isset($_COOKIE['user_coockie'])) {
		header('location: index.php');
	}
	include("db.php");
	$dummy_nota = mysqli_real_escape_string($conn, htmlspecialchars($_GET["nova_nota_nome"]));
	$query = mysqli_query($conn, "INSERT INTO `cloud`.`comentarios` (`nif`, `comentario`) VALUES ('". $_COOKIE['nif'] ."', '". $dummy_nota ."');");
	echo "<meta http-equiv='refresh' content='0;URL=vendas.php' />";
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