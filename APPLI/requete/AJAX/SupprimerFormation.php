<?php

require_once('../../Class/autoload.php');
require_once('../../Class/Connexion.class.php');


if(isset($_POST['idformation']) && isset($_POST['idcompte'])) {

    global $mysqli;

    $rqt = "DELETE FROM t_formation_compte WHERE idformation = ".$_POST['idformation']." and idcompte=".$_POST['idcompte'];
    $Confirm = $mysqli->query($rqt);

}
?>