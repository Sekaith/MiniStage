<?php

	require_once('../../Class/autoload.php');
	require_once('../../Class/Connexion.class.php');
	
	if(isset($_POST['id'])) {
        global $mysqli;
//Mise à jour d'une réservation pour enlever l'absence d'un élève
	$rqt = "UPDATE t_reservation SET absence = 0 WHERE idreserv = ".$_POST['id']."";
	$abs = $mysqli->query($rqt);
	}
?>