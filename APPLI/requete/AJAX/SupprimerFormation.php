<?php

require_once('../../Class/autoload.php');
require_once('../../Class/Connexion.class.php');


if (isset($_POST['id'])) {
    if (isset($_POST['compte'])) {
//Suppression liaison entre une formation et un compte
        global $mysqli;

        $rqt = "DELETE FROM t_formation_compte WHERE idformation = " . $_POST['id'] . " and idcompte =" . $_POST['compte'];

        $Confirm = $mysqli->query($rqt);
    }
}

?>

