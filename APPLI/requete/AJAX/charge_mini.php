<?php

	require_once('../../Class/autoload.php');
	require_once('../../Class/Connexion.class.php');
	global $mysqli;
	if((isset($_POST['formation'])) && (isset($_POST['etablissement']))) {
	
//	$rqt = " Select id, date, DATE_FORMAT(date, '%d-%m-%Y') AS dateFR,hdebut,hfin,nbplace,nbplacereste from t_ministage where idOffrant= ".$_POST['etablissement']."
//	AND idformation=".$_POST['formation']."";


    $rqt ="select m.idministage as id, m.date, DATE_FORMAT(m.date, '%d-%m-%Y') AS dateFR, m.hdebut, m.hfin, m.nbplace, case when t1.nbreserv is null then m.nbplace else (m.nbplace - t1.nbreserv) end as nbplacereste from t_ministage as m 
    left join (
        select m1.idministage, count(distinct r1.idreserv) as nbreserv from t_reservation as r1
        inner join t_ministage as m1 on m1.idministage=r1.idministage
        where m1.idOffrant=".$_POST['etablissement']." and m1.idformation=".$_POST['formation']."
        GROUP by r1.idministage) t1 on t1.idministage = m.idministage
        where idOffrant=".$_POST['etablissement']." and idformation=".$_POST['formation']."";
	$Creneau = $mysqli->query($rqt);
	}
	else{
	if((isset($_POST['formation2'])) && (isset($_POST['etablissement2'])))
	{
		
	$rqt = "select m.idministage as id, m.date, DATE_FORMAT(m.date, '%d-%m-%Y') AS dateFR, m.hdebut, m.hfin, m.nbplace, case when t1.nbreserv is null then m.nbplace else (m.nbplace - t1.nbreserv) end as nbplacereste from t_ministage as m 
    left join (
        select m1.idministage, count(distinct r1.idreserv) as nbreserv from t_reservation as r1
        inner join t_ministage as m1 on m1.idministage=r1.idministage
        where m1.idOffrant=".$_POST['etablissement2']." and m1.idformation=".$_POST['formation2']."
        GROUP by r1.idministage) t1 on t1.idministage = m.idministage
        where idOffrant=".$_POST['etablissement2']." and idformation=".$_POST['formation2']."";
	$Creneau = $mysqli->query($rqt);
	}
	else{
	if((isset($_POST['formationR'])) && (isset($_POST['etabR'])))
	{
	$rqt = "select m.idministage as id, m.date, DATE_FORMAT(m.date, '%d-%m-%Y') AS dateFR, m.hdebut, m.hfin, m.nbplace, case when t1.nbreserv is null then m.nbplace else (m.nbplace - t1.nbreserv) end as nbplacereste from t_ministage as m 
    left join (
        select m1.idministage, count(distinct r1.idreserv) as nbreserv from t_reservation as r1
        inner join t_ministage as m1 on m1.idministage=r1.idministage
        where m1.idOffrant=".$_POST['etablissementR']." and m1.idformation=".$_POST['formationR']."
        GROUP by r1.idministage) t1 on t1.idministage = m.idministage
        where idOffrant=".$_POST['etablissementR']." and idformation=".$_POST['formationR']."";
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