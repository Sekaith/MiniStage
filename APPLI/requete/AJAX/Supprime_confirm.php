<?php

	require_once('../../Class/autoload.php');
	require_once('../../Class/Connexion.class.php');
	
	if(isset($_POST['confirmation'])) {

	$json = array();
	$rqt = "UPDATE t_reservation SET confirmation = 0 WHERE idreserv = ".$_POST['confirmation']."";
	$Confirm = $mysqli->query($rqt);
	
	}

?>