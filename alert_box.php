<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/main.css"/>
		<style>
			.alert_error {
				width: 60%;
				height: 50px;
				background-color: #b30000;
				position: absolute;
				margin-left: 20%;
				margin-top: 5%;
				color: #fff;
				line-height: 50px;
				padding-left: 15px;
				font-size: 20px;
			}
			
			.alert_info {
				width: 100%;
				height: 50px;
				background-color: #2196F3;
				position: absolute;
				margin-left: 0%;
				margin-top: 0%;
				color: #fff;
				line-height: 50px;
				font-size: 20px;
			}

			.alert.success {background-color: #4CAF50;}
			.alert.info {background-color: #2196F3;}
			.alert.warning {background-color: #ff9800;}

			.closebtn {
				margin-right: 7px;
				margin-top: 4px;
				color: white;
				font-weight: bold;
				float: right;
				font-size: 22px;
				line-height: 20px;
				cursor: pointer;
				transition: 500ms;
			}

			.closebtn:hover {
				color: black;
			}
		</style>
	</head>
	<body>
		  <?php
			$function_id = htmlspecialchars($_GET["id"]);
			if($function_id == '1'){
				echo "
				<div class='alert_info'>
				    <span class='closebtn text_font'>&times;</span>
					<strong class='text_font' style='padding-left: 25px;'>Aviso: </strong><a class='text_font'>Este site utiliza cookies para melhor aproveitamento por parte dos nossos utilizadores.</a>
				</div>
				";
			}
			if($function_id == '2'){
				echo "
				<div class='alert_error'>
				    <span class='closebtn text_font'>&times;</span>
					<strong class='text_font' style='padding-left: 25px;'>Erro: </strong><a class='text_font'>utilizador ou password errados, tente novamente.</a>
				</div>
				";
			}
		  ?>
		<script>
			var close = document.getElementsByClassName("closebtn");
			var i;

			for (i = 0; i < close.length; i++) {
				close[i].onclick = function(){
					var div = this.parentElement;
					div.style.opacity = "0";
					setTimeout(function(){ div.style.display = "none"; }, 600);
				}
			}
		</script>
	</body>
</html>