<?php

/* Charge important */
function get_important(){
 global $mysqli;
	
    $rqt = 'Select important, important2 from t_utilisateur where id='.$_SESSION['IdUtilisateur'].'';
	$data= mysqli_query($mysqli,$rqt) or exit(mysqli_error());
	$important = $data -> fetch_assoc();
	
	return $important;

}


/* modif important */
function modif_important(){
 global $mysqli;
	
    $rqt = 'update t_utilisateur SET important="'.$_POST['important'].'", important2="'.$_POST['important2'].'" where id='.$_SESSION['IdUtilisateur'].'';
	mysqli_query($mysqli,$rqt) or exit(mysqli_error());

}


/* Affiche données de la convention */
function get_Conv(){
    global $mysqli;
	
    $rqt = 'Select uO.nometab as etabOrigine, uO.adresse as adresseOrigine, uO.ville as villeOrigine, uO.cp as cpOrigine, tyO.nom as
			typeOrigine,
			u.nometab, u.adresse, u.ville, u.cp, u.logo, u.cachet, u.mail, u.tel, u.important, u.important2, t.nom as type,
			r.prenom, r.nom, civilite, nomprof, lieu,
			DATE_FORMAT(date, "%d-%m-%Y") AS date, hdebut, hfin, f.nom as formation, tf.nom as typeformation
			From t_reservation as r inner join t_utilisateur as uO on r.idreservant=uO.id
			inner join t_ministage as m on r.idmini=m.id
			inner join t_utilisateur as u on m.idOffrant=u.id
			inner join t_formation as f on f.id=m.idformation
			inner join t_typeformation as tf on f.idtype=tf.id
			inner join t_typeetab as tyO on uO.idtype=tyO.id
			inner join t_typeetab as t on t.id=u.idtype
			where r.id= '.$_GET['id'].'';
			
    $Convention= mysqli_query($mysqli,$rqt) or exit(mysqli_error());
	$Conv = $Convention -> fetch_assoc();
	
	return $Conv;
}


/* Affiche données de la convention test */
function get_ConvTest(){
    global $mysqli;
	
    $rqt = 'Select u.nometab, u.adresse, u.ville, u.cp, u.logo, u.cachet, u.mail, u.tel, u.important, u.important2, t.nom as type
			From t_utilisateur as u inner join t_typeetab as t on t.id=u.idtype
			where u.id= '.$_SESSION['IdUtilisateur'].'';
			
    $Convention= mysqli_query($mysqli,$rqt) or exit(mysqli_error());
	$Conv = $Convention -> fetch_assoc();
	
	return $Conv;
}