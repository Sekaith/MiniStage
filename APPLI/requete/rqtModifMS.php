<?php

/* Affiche données ministage */
function get_MS(){
    global $mysqli;
	
    $rqt = 'SELECT m.id, tf.nom as typeformation, f.nom as formation, f.id as idformation, civilite, nomProf, date as dateUS, DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, 
	hdebut, hfin, nbplace, nbplacereste, lieu
	from t_ministage as m inner join t_formation as f on m.idformation=f.id
	inner join t_typeformation as tf on f.idtype=tf.id
	where m.id= '.$_GET['id'].'';
    $tab= mysqli_query($mysqli,$rqt) or exit(mysqli_error());
	$MS = $tab -> fetch_assoc();
	
	return $MS;
}


function updateMS(){
    global $mysqli;
	
    $rqt = 'UPDATE t_ministage SET civilite="'.$_POST['civilite'].'", nomProf="'.$_POST['nomprof'].'", 
	date= STR_TO_DATE("'.$_POST['date'].'", "%d-%m-%Y"), hdebut="'.$_POST['heure1'].'", hfin="'.$_POST['heure2'].'", 
	nbplace='.$_POST['place'].', nbplacereste='.$_POST['placereste'].', lieu="'.$_POST['lieu'].'"
	where id= '.$_POST['id'].'';
    mysqli_query($mysqli,$rqt) or exit(mysqli_error());
}

?>