<?php
	error_reporting(0);
	$function_id = htmlspecialchars($_GET["id"]);
	if($function_id == 1){
		include("db.php");
		$dummy_user = $_POST['cloud_username'];
		$dummy_password = md5(strtoupper($_POST['cloud_password']));
		
		$check = mysqli_fetch_array(mysqli_query($conn, "select if(exists (SELECT * FROM users WHERE user ='". $dummy_user ."'),'Assigned', 'Available')"));
		if($check[0] == 'Assigned'){
			$select = mysqli_query($conn, "SELECT * FROM users WHERE user = '". $dummy_user ."';");
			while($row=mysqli_fetch_array($select))
			{
				if($row['password'] == $dummy_password){
					setcookie("user_coockie", $dummy_user, time() + (60 * 60 * 4), "/");
					mysqli_query($conn, "UPDATE users SET last_update = now() WHERE username = '". $dummy_user ."';");
					echo "<meta http-equiv='refresh' content='0;URL=home.php' />";
				} else {
					echo "<meta http-equiv='refresh' content='0;URL=index.php' />";
				}
			}
		} else {
			echo "<meta http-equiv='refresh' content='0;URL=index.php' />";
		}
	}
	if($function_id == '2'){
		include("db.php");
		setcookie("user_coockie", '', time() - 3600, "/");
		$select=mysqli_query($conn, "INSERT INTO `log` (`log_text`) VALUES ('USER LOGOUT ". $_COOKIE['user_coockie'] ." AT ". date("Y/m/d h:i:s") .".');");
		echo "<meta http-equiv='refresh' content='0;URL=index.php' />";
	}
	if($function_id == '3'){
		include("db.php");
		$venda_id = htmlspecialchars($_GET["venda_id"]);
		$value = mysqli_query($conn, "UPDATE `cloud`.`vendas` SET `registado`='Y' WHERE  `id`=". $venda_id ." AND `user` = '". $_COOKIE['user_coockie'] ."';");
		$select=mysqli_query($conn, "INSERT INTO `log` (`log_text`) VALUES ('VENDA MARCADA COMO REGISTADA POR USER: ". $_COOKIE['user_coockie'] ." ID: ". $venda_id ." | ". date("Y/m/d h:i:s") ."');");
		echo "<meta http-equiv='refresh' content='0;URL=vendasdiarias.php' />";
	}
	if($function_id == '4'){
		include("db.php");
		$venda_id = htmlspecialchars($_GET["venda_id"]);
		$index = htmlspecialchars($_GET["index"]);
		$data = htmlspecialchars($_GET["data"]);
		$pages = htmlspecialchars($_GET["pages"]);
		$value = mysqli_query($conn, "UPDATE `cloud`.`vendas` SET `status`='ACTIVO' WHERE  `id`=". $venda_id ." AND `user` = '". $_COOKIE['user_coockie'] ."';");
		$select=mysqli_query($conn, "INSERT INTO `log` (`log_text`) VALUES ('VENDA MARCADA COMO ACTIVA POR USER: ". $_COOKIE['user_coockie'] ." ID: ". $venda_id ." | ". date("Y/m/d h:i:s") ."');");
		echo "<meta http-equiv='refresh' content='0;URL=vendas.php?data=". $data ."&index=". $index ."&pages=". $pages ."' />";
	}
	if($function_id == '5'){
		include("db.php");
		$venda_id = htmlspecialchars($_GET["venda_id"]);
		$index = htmlspecialchars($_GET["index"]);
		$data = htmlspecialchars($_GET["data"]);
		$pages = htmlspecialchars($_GET["pages"]);
		$value = mysqli_query($conn, "UPDATE `cloud`.`vendas` SET `status`='CANCELADO' WHERE  `id`=". $venda_id ." AND `user` = '". $_COOKIE['user_coockie'] ."';");
		$select=mysqli_query($conn, "INSERT INTO `log` (`log_text`) VALUES ('VENDA MARCADA COMO CANCELADA POR USER: ". $_COOKIE['user_coockie'] ." ID: ". $venda_id ." | ". date("Y/m/d h:i:s") ."');");
		echo "<meta http-equiv='refresh' content='0;URL=vendas.php?data=". $data ."&index=". $index ."&pages=". $pages ."' />";
	}
	if($function_id == '6'){
		include("db.php");
		$query = mysqli_fetch_array(mysqli_query($conn, "SELECT `auto_break` FROM `settings` WHERE `id` = '1';"));
		if($query[0] == 'Y'){
			$vendas_off = mysqli_query($conn, "UPDATE `settings` SET `auto_break`='N' WHERE  `id`=1;");
			$select=mysqli_query($conn, "INSERT INTO `log` (`log_text`) VALUES ('AUTOBREAK CANCELADO USER: ". $_COOKIE['user_coockie'] ." | ". date("Y/m/d h:i:s") ."');");
			echo "<meta http-equiv='refresh' content='0;URL=break_bot.php' />";
		} else {
			$vendas_on = mysqli_query($conn, "UPDATE `settings` SET `auto_break`='Y' WHERE  `id`=1;");
			$select=mysqli_query($conn, "INSERT INTO `log` (`log_text`) VALUES ('AUTOBREAK ACTIVO USER: ". $_COOKIE['user_coockie'] ." | ". date("Y/m/d h:i:s") ."');");
			echo "<meta http-equiv='refresh' content='0;URL=break_bot.php' />";
		}
	}
	if($function_id == '7'){
		include("db.php");
		$count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM breaks WHERE `status` = 'N' AND `user` = '". $_COOKIE['user_coockie'] ."';"));
		if($count[0] >= 1){
			echo '<script language="javascript">'; 
				echo 'alert("ERRO: Pedido de break não fechado. Caso seja um erro por favor informe a supervisão.");';
			echo '</script>';
			$select=mysqli_query($conn, "INSERT INTO `log` (`log_text`) VALUES ('ERROR#02: USER: ". $_COOKIE['user_coockie'] ." pedido de break em duplicado | ". date("Y/m/d h:i:s") ."');");
			echo "<meta http-equiv='refresh' content='0;URL=break_panel.php' />";
		} else {
			$tempo = htmlspecialchars($_GET["tempo"]);
			$data = date("H:i:s");
			$query = mysqli_query($conn, "INSERT INTO `breaks` (`data`, `user`, `tempo_pedido`) VALUES ('". $data ."', '". $_COOKIE['user_coockie'] ."', '". $tempo ."');");
			$select=mysqli_query($conn, "INSERT INTO `log` (`log_text`) VALUES ('BREAK PEDIDO USER: ". $_COOKIE['user_coockie'] ." | ". date("Y/m/d h:i:s") ."');");
			echo "<meta http-equiv='refresh' content='0;URL=break_panel.php' />";
		}
	}
	if($function_id == '8'){
		include("db.php");
		$time = date("Y/m/d h:i:s");
		$query = mysqli_query($conn, "UPDATE `breaks` SET `aceite` = 'Y', `inicio` = '". $time ."' WHERE `user` = '". $_COOKIE['user_coockie'] ."' AND `status` = 'N';");
		$select=mysqli_query($conn, "INSERT INTO `log` (`log_text`) VALUES ('BREAK ACEITE USER: ". $_COOKIE['user_coockie'] ." | ". date("Y/m/d h:i:s") ."');");
		echo "<meta http-equiv='refresh' content='0;URL=break_panel.php' />";
	}
	if($function_id == '9'){
		include("db.php");
		$query = mysqli_query($conn, "UPDATE `breaks` SET `status` = 'Y' WHERE `user` = '". $_COOKIE['user_coockie'] ."' AND `status` = 'N';");
		$select=mysqli_query($conn, "INSERT INTO `log` (`log_text`) VALUES ('BREAK CANCELADO USER: ". $_COOKIE['user_coockie'] ." | ". date("Y/m/d h:i:s") ."');");
		echo "<meta http-equiv='refresh' content='0;URL=break_panel.php' />";
	}
	if($function_id == '10'){
		include("db.php");
		$dummy_password_one = $_POST['recover_pass_one'];
		$dummy_password_two = $_POST['recover_pass_two'];
		if($dummy_password_one == $dummy_password_two){
			$query = mysqli_query($conn, "UPDATE `users` SET `password` = '". $dummy_password_one ."' WHERE `user` = '". $_COOKIE['user_coockie_recover'] ."';");
			echo "<meta http-equiv='refresh' content='0;URL=index.php' />";
		} else {
			echo "<meta http-equiv='refresh' content='0;URL=password_recover.php' />";
		}
	}
	
	if($function_id == '12'){
        include("db.php");
        $venda_id = htmlspecialchars($_GET["venda_id"]);
        $index = htmlspecialchars($_GET["index"]);
        $data = htmlspecialchars($_GET["data"]);
        $pages = htmlspecialchars($_GET["pages"]);
        $value = mysqli_query($conn, "UPDATE `cloud`.`vendas` SET `status` = 'AC_MES_SEGUINTE', data = '". date("Y-m-d") ."' WHERE  `id`=". $venda_id ." AND `user` = '". $_COOKIE['user_coockie'] ."';");
        $select = mysqli_query($conn, "INSERT INTO `log` (`log_text`) VALUES ('VENDA MARCADA COMO CANCELADA POR USER: ". $_COOKIE['user_coockie'] ." ID: ". $venda_id ." | ". date("Y/m/d h:i:s") ."');");
        echo "<meta http-equiv='refresh' content='0;URL=vendas.php?data=". $data ."&index=". $index ."&pages=". $pages ."' />";
    }
?>

<html>
	<head>
		<title>Loading . . .</title>
		<link rel="shortcut icon" type="image/png" href="media/images/icon.ico" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	</head>
	<body style='background-color: #fff;'>
			<img style='margin: auto; position: absolute; top: 0; left: 0; bottom: 0; right: 0;' width='100px;' height='100px;' src='./media/images/loading_processmaker.gif'/>
	</body>
</html>