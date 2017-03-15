<html>
	<head>
		<title>.Cloud</title>
		<link rel="shortcut icon" type="image/png" href="media/images/icon.ico" />
		<link rel="stylesheet" type="text/css" href="css/main.css"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
		<?php
			if(isset($_COOKIE['user_coockie'])){
				setcookie("user_coockie", "", time() - 28800, "/");
			}
			if(isset($_COOKIE['alert'])){
				$_GET['id'] = $_COOKIE['alert'];
				include('alert_box.php');
			} else {
				$_GET['id'] = 1;
				include('alert_box.php');
			}
		?>
		<div id='index_background' style='background-image: url("media/images/background.jpg"); background-position: center; background-size: cover;'>
			<div id='login_box'></div>
			<div id='login_box_2'>
				<div id='login_logo' style='background-image: url("media/images/icon.ico"); background-position: center; background-size: cover;'></div>
				<form action='functions.php?id=1' method='post'>
					<input id='input_login_username' placeholder='Username' style='color: #000;' name='cloud_username'>
					</input>
					<input id='input_login_password' placeholder='Password' type='password' style='color: #000;' name='cloud_password'>
					</input>
					<button id='login_button'>Login</button>
				</form>
			</div>
		</div>
	</body>
</html>