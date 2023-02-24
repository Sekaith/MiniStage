<?php

require_once('../../Class/autoload.php');
require_once('../../Class/Connexion.class.php');

if (isset($_POST['etablissement'])) {

    $json = array();
    /*$rqt = "SELECT f.id, f.nom, tf.nom as typeformation, idtype FROM t_formation as f inner join t_ministage as m on m.idformation=f.id
    inner join t_typeformation as tf on f.idtype=tf.id
    WHERE idOffrant= ".$_POST['etablissement']."
    order by idtype";*/

    $rqt = "select f.idformation as id, f.nom_formation as nom, tyf.nom_typeformation as typeformation, tyf.idtypeform as idtype 
from t_formation f
inner join t_ministage as m on m.idformation=f.idformation
inner join t_typeformation as tyf on tyf.idtypeform=f.idtypeform
where m.idOffrant=" . $_POST['etablissement'] . "
order by m.idOffrant;";

    $Formation = $mysqli->query($rqt);


    while ($data = mysqli_fetch_array($Formation)) {
        $nom = $data['nom'];
        $type = $data['typeformation'];
        $json[$data['id']] = ($type . ' - ' . $nom);
    }
    // envoi du résultat au success
    echo json_encode($json);
}
?>