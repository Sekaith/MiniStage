<?php

require_once('../../Class/autoload.php');
include_once('../../Class/Connexion.class.php');

if (isset($_POST['id'])) {

    global $mysqli;
    //$rqt = "DELETE FROM t_utilisateur WHERE id = ".$_POST['id']."";
    $rqt = "DELETE FROM t_compte WHERE idcompte = " . $_POST['id'] . "";
    $Confirm = $mysqli->query($rqt);

}
?>