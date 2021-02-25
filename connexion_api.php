<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "DBA";

	$connexion = new mysqli($servername, $username, $password, $dbname);
	
	if ($connexion->connect_error) {
		die("Server Error");
	}
?>