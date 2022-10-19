<?php

	require_once('../../Class/autoload.php');
	require_once('../../Class/Connexion.class.php');
	
	if(isset($_POST['formation'])) {

	$json = array();
	$rqt = "SELECT u.id, t.nom, nometab, ville from t_ministage as m inner join t_utilisateur as u on m.idOffrant=u.id 
	inner join t_typeetab as t on u.idtype=t.id
	where idformation=".$_POST['formation']." order by nometab asc";
	$Formation = $mysqli->query($rqt);
			
			
	while($data=mysqli_fetch_array($Formation))
    {
		$json[$data['id']] = ($data['nom'].' '.$data["nometab"].' - '.$data["ville"]);
	}
    // envoi du résultat au success
    echo json_encode($json);
	}
	?>