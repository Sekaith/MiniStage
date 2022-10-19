<?php
function get_ListeForm(){
    global $mysqli;
	
	if ($_SESSION["IdProfil"] == 1) /* Pour administrateur */{
    $rqt = 'SELECT m.id, tf.nomcourt as typeformation, f.nom as formation, civilite, nomProf, date as dateUS, 
	DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, 
	hdebut, hfin, nbplace, nbplacereste
	from t_ministage as m inner join t_formation as f on m.idformation=f.id
	inner join t_typeformation as tf on f.idtype=tf.id
	where date>ADDDATE(NOW(), INTERVAL -7 DAY)
	ORDER BY date';
	}else{
	if ($_SESSION["IdProfil"] == 3) /* Pour Prof */{
	$rqt = 'SELECT m.id, tf.nomcourt as typeformation, f.nom as formation, civilite, nomProf, date as dateUS, 
	DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, 
	hdebut, hfin, nbplace, nbplacereste
	from t_ministage as m inner join t_formation as f on m.idformation=f.id
	inner join t_typeformation as tf on f.idtype=tf.id
	where idOffrant = '.$_SESSION['Idrattacher'].' AND date>=DATE(NOW())
	ORDER BY date';
	}else{
	$rqt = 'SELECT m.id, tf.nomcourt as typeformation, f.nom as formation, civilite, nomProf, date as dateUS, 
	DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, 
	hdebut, hfin, nbplace, nbplacereste
	from t_ministage as m inner join t_formation as f on m.idformation=f.id
	inner join t_typeformation as tf on f.idtype=tf.id
	where idOffrant = '.$_SESSION['IdUtilisateur'].' AND date>=DATE(NOW())
	ORDER BY date';}}
	
	$ListeForm= $mysqli->query($rqt) or exit(mysqli_error());
	return $ListeForm;
}

function get_ListeFormAnt(){
    global $mysqli;
	
	if ($_SESSION["IdProfil"] == 1) /* Pour administrateur */{
    $rqt = 'SELECT m.id, tf.nomcourt as typeformation, f.nom as formation, civilite, nomProf, date as dateUS, 
	DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, 
	hdebut, hfin, nbplace, nbplacereste
	from t_ministage as m inner join t_formation as f on m.idformation=f.id
	inner join t_typeformation as tf on f.idtype=tf.id
	where date<=ADDDATE(NOW(), INTERVAL -7 DAY)
	ORDER BY date';
	}else{
	if ($_SESSION["IdProfil"] == 3) /* Pour Prof */{
		$rqt = 'SELECT m.id, tf.nomcourt as typeformation, f.nom as formation, civilite, nomProf, date as dateUS, 
	DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, 
	hdebut, hfin, nbplace, nbplacereste
	from t_ministage as m inner join t_formation as f on m.idformation=f.id
	inner join t_typeformation as tf on f.idtype=tf.id
	where idOffrant = '.$_SESSION['Idrattacher'].' AND date<DATE(NOW())
	ORDER BY date';
	}else{
	$rqt = 'SELECT m.id, tf.nomcourt as typeformation, f.nom as formation, civilite, nomProf, date as dateUS, 
	DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, 
	hdebut, hfin, nbplace, nbplacereste
	from t_ministage as m inner join t_formation as f on m.idformation=f.id
	inner join t_typeformation as tf on f.idtype=tf.id
	where idOffrant = '.$_SESSION['IdUtilisateur'].' AND date<DATE(NOW())
	ORDER BY date';}}
	
	$ListeForm= $mysqli->query($rqt) or exit(mysqli_error());
	return $ListeForm;
}
?>