<?php

	require_once('../../Class/autoload.php');
	require_once('../../Class/Connexion.class.php');
	
	if(isset($_POST['id'])) {

	$rqt = "DELETE FROM t_reservation WHERE idreserv = ".$_POST['id']."";
	$Confirm = $mysqli->query($rqt);
	
	}
?>