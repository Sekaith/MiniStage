<?php

require_once('../../Class/autoload.php');
require_once('../../Class/Connexion.class.php');


if (isset($_POST['id'])) {
if (isset($_POST['compte'])) {

global $mysqli;

$rqt = "DELETE FROM t_professeur WHERE idProf = " . $_POST['id'] . " and idetab =" . $_POST['compte'];

$Confirm = $mysqli->query($rqt);
}
}

?>