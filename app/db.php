<?php
	$conn=mysqli_connect("127.0.0.1","root","", "cloud");
	if (mysqli_connect_errno($conn))
	{
		return false;
	}
	mysqli_query ($conn, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'"); 
?>
