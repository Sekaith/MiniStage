<?php

	require_once('../../Class/autoload.php');
	require_once('../../Class/Connexion.class.php');	
	
	if(isset($_POST['id'])) {
        global $mysqli;
//Suppression d'un ministage d'un utilisateur
	$rqt = "DELETE FROM t_ministage WHERE idministage = ".$_POST['id']."";
	$Confirm = $mysqli->query($rqt);
	
	}
	?>