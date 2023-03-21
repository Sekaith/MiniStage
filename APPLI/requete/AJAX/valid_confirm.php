<?php

	require_once('../../Class/autoload.php');
	require_once('../../Class/Connexion.class.php');
//Modification d'une réservation pour confirmer la réservation
	if(isset($_POST['confirmation'])) {
        global $mysqli;
	$json = array();
	$rqt = "UPDATE t_reservation SET confirmation = 1 WHERE idreserv = ".$_POST['confirmation']."";
	$Confirm = $mysqli->query($rqt);
	
	}
	?>