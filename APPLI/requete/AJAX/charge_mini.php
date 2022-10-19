<?php

	require_once('../../Class/autoload.php');
	require_once('../../Class/Connexion.class.php');
	
	if((isset($_POST['formation'])) && (isset($_POST['etablissement']))) {
	
	$rqt = " Select id, date, DATE_FORMAT(date, '%d-%m-%Y') AS dateFR,hdebut,hfin,nbplace,nbplacereste from t_ministage where idOffrant= ".$_POST['etablissement']."
	AND idformation=".$_POST['formation']."";
	$Creneau = $mysqli->query($rqt);
	}
	else{
	if((isset($_POST['formation2'])) && (isset($_POST['etablissement2'])))
	{
		
	$rqt = " Select id, date,  DATE_FORMAT(date, '%d-%m-%Y') AS dateFR,hdebut,hfin,nbplace,nbplacereste from t_ministage where idOffrant= ".$_POST['etablissement2']."
	AND idformation=".$_POST['formation2']."";
	$Creneau = $mysqli->query($rqt);
	}
	else{
	if((isset($_POST['formationR'])) && (isset($_POST['etabR'])))
	{
	$rqt = " Select id, date, DATE_FORMAT(date, '%d-%m-%Y') AS dateFR,hdebut,hfin,nbplace,nbplacereste from t_ministage where idOffrant= ".$_POST['etabR']."
	AND idformation=".$_POST['formationR']."";
	$Creneau = $mysqli->query($rqt);
	}
	}
	}
			
	
	$json = array();	
	while($data=mysqli_fetch_array($Creneau))
    {
		if(($data['nbplacereste']<1) or ($data['date'] < date('Y-m-d'))){
			$place="complet";
			$json[$data['id']] = ('<option disabled value="'.$data['id'].'" > '.$data['dateFR'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$data['hdebut'].'-'.$data['hfin'].'&nbsp;&nbsp;&nbsp;&nbsp;places : ' .$place);
		}
		else
		{
			$place = $data["nbplacereste"].'/'.$data["nbplace"];
			$json[$data['id']] = ('<option value="'.$data['id'].'" > '.$data['dateFR'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$data['hdebut'].'-'.$data['hfin'].'&nbsp;&nbsp;&nbsp;&nbsp; places : ' .$place);
		}
	}
    // envoi du résultat au success
    echo json_encode($json);
	?>