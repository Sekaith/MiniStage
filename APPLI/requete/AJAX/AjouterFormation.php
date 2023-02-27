<?php

require_once('../../Class/autoload.php');
require_once('../../Class/Connexion.class.php');


if (isset($_POST['id'])) {
    if (isset($_POST['compte'])) {

        global $mysqli;

        $rqt = "INSERT INTO t_formation_compte (idformation, idcompte) VALUES (".$_POST["id"].", ".$_POST['compte'].");";

        $Confirm = $mysqli->query($rqt);
    }
}



?>

