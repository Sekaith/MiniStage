<?php

	require_once('../../Class/autoload.php');
	require_once('../../Class/Connexion.class.php');
	
	if(isset($_POST['id'])) {

	$rqt = "UPDATE t_reservation SET absence = 0 WHERE idreserv = ".$_POST['id']."";
	$abs = $mysqli->query($rqt);
	}
?>