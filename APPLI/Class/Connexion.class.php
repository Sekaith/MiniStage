<?php

// On définit les 4 variables nécessaires à la connexion MySQL :
	$hostname = "localhost";
	$user     = "root";
	$password = "root";
	$nom_base_donnees = "ministages44_3";

	$mysqli = new mysqli($hostname, $user, $password,$nom_base_donnees) or die(mysql_error());
	$mysqli->set_charset("utf8");
?>
