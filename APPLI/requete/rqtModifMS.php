<?php

/* Affiche données ministage */
function get_MS(){
    global $mysqli;
	
//    $rqt = 'SELECT m.id, tf.nom as typeformation, f.nom as formation, f.id as idformation, civilite, nomProf, date as dateUS, DATE_FORMAT(date, "%d-%m-%Y") AS dateFR,
//	hdebut, hfin, nbplace, nbplacereste, lieu
//	from t_ministage as m inner join t_formation as f on m.idformation=f.id
//	inner join t_typeformation as tf on f.idtype=tf.id
//	where m.id= '.$_GET['id'].'';

    $rqt = 'SELECT m.idministage as id, tf.nom_typeformation  as typeformation, f.nom_formation as formation, f.idformation as idformation, p.civilite, p.idProf as idprof,p.nom_prof as nomProf, date as dateUS, DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, 
	hdebut, hfin, nbplace, lieu
	from t_ministage as m inner join t_formation as f on m.idformation=f.idformation
	inner join t_typeformation as tf on f.idtypeform=tf.idtypeform
    inner join t_professeur as p on p.idProf = m.idProf
	where m.idministage= '.$_GET['id'].'';
    $tab= mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));
	$MS = $tab -> fetch_assoc();
	
	return $MS;
}


function updateMS(){
    global $mysqli;
	
    $rqt = 'UPDATE t_ministage SET civilite="'.$_POST['civilite'].'", nomProf="'.$_POST['nomprof'].'", 
	date= STR_TO_DATE("'.$_POST['date'].'", "%Y-%m-%d"), hdebut="'.$_POST['heure1'].'", hfin="'.$_POST['heure2'].'", 
	nbplace='.$_POST['place'].', lieu="'.$_POST['lieu'].'"
	where id= '.$_POST['id'].'';
    mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));
}

?>