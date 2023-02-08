<?php

// On définit les 4 variables nécessaires à la connexion MySQL :
	$hostname = "localhost";
	$user     = "root";
	$password = "";
	$nom_base_donnees = "ministage";

	$mysqli = new mysqli($hostname, $user, $password,$nom_base_donnees) or die(mysql_error());
	$mysqli->set_charset("utf8");
?>
