<?php

require_once('../../Class/autoload.php');
require_once('../../Class/Connexion.class.php');

if (isset($_POST['confirmation'])) {
//Mise à jour d'une resrvation pour annuler une réservation
    global $mysqli;
    $json = array();
    $rqt = "UPDATE t_reservation SET confirmation = 0 WHERE idreserv = " . $_POST['confirmation'] . "";
    $Confirm = $mysqli->query($rqt);

}

?>