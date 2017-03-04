<?php
	$dummy_ano = htmlspecialchars($_GET["dummy_ano"]);
	$dummy_mes = htmlspecialchars($_GET["dummy_mes"]);
	echo "<meta http-equiv='refresh' content='0;URL=vendas.php?data=". $dummy_ano ."-". $dummy_mes ."' />";
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