<?php

/* Liste les formations */
function get_formation($idtype){
	global $mysqli;
	
	$rqt = 'SELECT f.id, f.nom, tf.nom as typeformation FROM t_formation as f
	inner join t_typeformation as tf on f.idtype=tf.id
	where idtype='.$idtype.' order by nom asc';
	$Formation= $mysqli->query($rqt) or exit(mysqli_error($mysqli));
	
	return $Formation;
}

/* Liste des ministages par formations et par type de formation*/         /*cas de la recherche par formation*/
function get_formation_export($idtype, $qui){
	global $mysqli;

	$rqt = 'SELECT distinct f.id, f.nom, tf.nom as typeformation FROM t_formation as f, t_ministage as m, t_typeformation as tf, t_utilisateur as ut
	where ut.id=m.idOffrant and f.idtype=tf.id and m.idformation=f.id and m.idformation=f.id
	and f.idtype='.$idtype.' and ut.identifiant="'.$qui.'" order by nom asc';

	$Formation= $mysqli->query($rqt) or exit(mysqli_error($mysqli));
	
	if(mysqli_num_rows($Formation)>0)
	{return $Formation;}
}

function get_donnees_export($formation, $date) {
	global $mysqli;

	$rqt = 'SELECT r.nom, r.prenom, ty.nom as typeEtab, ut.nometab as nomEtab, m.date as dateMS, m.hdebut as debut, m.hfin as fin 
	from t_typeetab as ty, t_utilisateur as ut, t_ministage as m, t_reservation as r
	where ';
	if ($formation!=-1) {
		$rqt .= 'm.idformation = "'.$formation.'" and ';
	}
	if ($date!="1970-01-01") {
		$rqt.= 'm.date = "'.$date.'" and ';
	}
	$rqt .= 'm.id=r.idmini and ut.id=r.idReservant and ty.id=ut.idtype order by nom asc';

	$Formation= $mysqli->query($rqt) or exit(mysqli_error($mysqli));
	
	if(mysqli_num_rows($Formation)>0)
	{return $Formation;}
	else return false;
}


//ajout ministage
function insertMinistage(){
	global $mysqli;
	
	$rqt='INSERT INTO t_ministage (idOffrant,idformation,civilite,nomProf,date,hdebut,hfin,nbplace,nbplacereste)
	values ('.$_SESSION['IdUtilisateur'].', '.$_POST['formation'].', "'.$_POST['civilite'].'", "'.$_POST['nomprof'].'", STR_TO_DATE("'.$_POST['date'].'", "%Y-%m-%d"), 
	"'.$_POST['heure1'].'", "'.$_POST['heure2'].'",'.$_POST['place'].', '.$_POST['place'].')';
    mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));
return button1;
}

//si besoin d'ajout de formation --> coordonnées de l'administrateur
function getCoordAdmin(){
	global $mysqli;
		
	$rqt = 'select prenom, nom, mail, tel from t_utilisateur where idprofil=1
	limit 0,1';
	$data= $mysqli->query($rqt) or exit(mysqli_error());
	$coord = $data -> fetch_assoc();
	
	return $coord;
}


?>