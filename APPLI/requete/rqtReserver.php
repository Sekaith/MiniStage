<?php

/* Liste les établissement proposant des ministages */                 /*cas de la recherche par Etab*/
function get_etab(){
	global $mysqli;
	
	$rqt = 'SELECT distinct u.id, t.nom, nometab, ville from t_ministage as m inner join t_utilisateur as u on m.idOffrant=u.id 
	inner join t_typeetab as t on u.idtype=t.id order by nometab asc';
	$Etab= $mysqli->query($rqt) or exit(mysqli_error());
	
	return $Etab;
}
	

/* Liste des ministages par formations et par type de formation*/         /*cas de la recherche par formation*/
function get_formation($idtype){
	global $mysqli;
	
	$rqt = 'SELECT distinct f.id, f.nom, tf.nom as typeformation FROM t_formation as f inner join t_ministage as m on m.idformation=f.id 
	inner join t_typeformation as tf on f.idtype=tf.id
	where idtype='.$idtype.' order by nom asc';
	$Formation= $mysqli->query($rqt) or exit(mysqli_error());
	
	if(mysqli_num_rows($Formation)>0);
	{return $Formation;}
}


//ajout d'une reservation
function insertMinistage(){
	global $mysqli;
	
	$rqt='INSERT INTO t_reservation (idministage,nom_eleve,prenom_eleve,idReservant,confirmation,rappel,absence)
	values ('.$_POST['mini'].', "'.$_POST['nom'].'", "'.$_POST['prenom'].'", '.$_SESSION['IdUtilisateur'].', 0,0,0)';
    mysqli_query($mysqli,$rqt) or exit(mysqli_error());
	
	$rqt='Select tf.nom_typeformation as typeformation, f.nom_formation as form, t.nom_typeetab  as nom, e.nometab from t_formation as f inner join t_ministage as m on m.idformation=f.idformation  
	inner join t_compte as u on idOffrant=u.idcompte inner join t_etablissement e on e.idetab=u.idetab inner join t_typeetab as t on e.idtypeetab=t.idtypeetab inner join t_typeformation as tf on f.idtypeform=tf.idtypeform 
	where m.idministage='.$_POST['mini'].'';
	$data= mysqli_query($mysqli,$rqt) or exit(mysqli_error());
	$Reserv = $data -> fetch_assoc();
	
	return $Reserv;
}


//ajout d'une reservation Chef
function insertMinistageR(){
	global $mysqli;
	
	if ($_POST['autre'] == "1")
	{
		$rqt='INSERT INTO t_reservation (idministage,nom_eleve,prenom_eleve,idReservant,confirmation,rappel,absence)
		values ('.$_POST['miniR'].', "'.$_POST['nomR'].'", "'.$_POST['prenomR'].'", 999, 0,0,0)';
    	mysqli_query($mysqli,$rqt) or exit(mysqli_error());
	
	}
	else
	{
		$rqt='INSERT INTO t_reservation (idministage,nom_eleve,prenom_eleve,idReservant,confirmation,rappel,absence)
		values ('.$_POST['miniR'].', "'.$_POST['nomR'].'", "'.$_POST['prenomR'].'", '.$_POST['etablissementR'].', 0,0,0)';
    	mysqli_query($mysqli,$rqt) or exit(mysqli_error());
		
	}
	
	$rqt='Select tf.nom_typeformation as typeformation, f.nom_formation as form, t.nom_typeetab  as nom, e.nometab from t_formation as f inner join t_ministage as m on m.idformation=f.idformation  
	inner join t_compte as u on idOffrant=u.idcompte inner join t_etablissement e on e.idetab=u.idetab inner join t_typeetab as t on e.idtypeetab=t.idtypeetab inner join t_typeformation as tf on f.idtypeform=tf.idtypeform 
	where m.idministage='.$_POST['miniR'].'';
	$data= mysqli_query($mysqli,$rqt) or exit(mysqli_error());
	$Reserv = $data -> fetch_assoc();
	
	return $Reserv;
}


/* Liste des formations de son propre établissement (profil chef)*/
function get_formationR($idtype){
	global $mysqli;
	
	$rqt = 'SELECT distinct f.id, f.nom, tf.nom as typeformation FROM t_formation as f inner join t_ministage as m on m.idformation=f.id 
	inner join t_typeformation as tf on f.idtype=tf.id
	where idtype='.$idtype.' AND idOffrant= '.$_SESSION['IdUtilisateur'].' order by nom asc';
	$Formation= $mysqli->query($rqt) or exit(mysqli_error());
	
	if(mysqli_num_rows($Formation)>0);
	{return $Formation;}
}


/* Liste les établissement Reservant pour les chefs */
function get_etabR(){
	global $mysqli;
	
	$rqt = 'SELECT u.id, t.nom, nometab, ville from t_utilisateur as u 
	inner join t_typeetab as t on u.idtype=t.id 
	where idprofil=4 order by nometab asc';
	$Etab= $mysqli->query($rqt) or exit(mysqli_error());
	
	return $Etab;
}


?>