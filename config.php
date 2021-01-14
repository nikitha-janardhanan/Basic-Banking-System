<?php
	$servername = 'localhost:3306';
	$user = 'root';
	$pass = 'root';
	$dbname = 'credits_db';

	$conn = mysqli_connect($servername,$user,$pass,$dbname);

	if(!$conn){
		die("Could Not Connect to the database".mysqli_connect_error());
	}

?>
