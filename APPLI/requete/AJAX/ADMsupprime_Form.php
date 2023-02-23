<?php

require_once('../../Class/autoload.php');
require_once('../../Class/Connexion.class.php');

if (isset($_POST['id'])) {
    global $mysqli;

    $rqt = "DELETE FROM t_formation WHERE idformation = " . $_POST['id'] . "";
    $Confirm = $mysqli->query($rqt);

}
?>