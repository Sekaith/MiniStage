<?php

/* Liste les types d'Etablissement */
function get_type(){
	global $mysqli;
	
	$rqt = 'SELECT * from t_typeetab';
	$Type= $mysqli->query($rqt) or exit(mysqli_error($mysqli));
	
	return $Type;
}


/* Liste les Academies */
function get_academie(){
	global $mysqli;
	
	$rqt = 'SELECT * FROM t_academie';
	$Academie= $mysqli->query($rqt) or exit(mysqli_error($mysqli));
	
	return $Academie;
}


/* Liste les Fonctions */
function get_fonction(){
	global $mysqli;
	
	$rqt = 'SELECT * FROM t_fonction';
	$Fonction= $mysqli->query($rqt) or exit(mysqli_error($mysqli));
	
	return $Fonction;
}


/* Liste des offrant MS pour les profs */
function get_Offrant(){
	global $mysqli;
	
	$rqt = 'SELECT u.id, nomcourt, nometab, ville FROM  t_utilisateur as u inner join t_typeetab as t on u.idtype = t.id
	WHERE idprofil=2 ORDER BY nometab ASC';
	$Offrant= $mysqli->query($rqt) or exit(mysqli_error($mysqli));
	
	return $Offrant;
}


/* Liste des types de formations */
function get_typeF(){
	global $mysqli;
	
	$rqt = 'SELECT * from t_typeformation';
	$typeF= $mysqli->query($rqt) or exit(mysqli_error($mysqli));
	
	return $typeF;
}


/*insert utilisateur*/
function insert_Util(){
	global $mysqli;
	
	if ($_POST["idprofil"] == 3)
	{
		$rqt='INSERT INTO t_utilisateur (identifiant, mdp, idprofil, nom, prenom, mail, idfonction, tel, rattacher)
		values ("'.$_POST["identifiant"].'","'.$_POST["mdp"].'",3,"'.$_POST["nom"].'","'.$_POST["prenom"].'","'.$_POST["mail"].'",
		'.$_POST["fonction"].', "'.$_POST["tel"].'",'.$_POST["idrattache"].')';
    	mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));
	}
	else 
	{
		if ($_POST["idprofil"] == 4)
		{
		$rqt='INSERT INTO t_utilisateur (identifiant, mdp, idprofil, nom, prenom, mail, idfonction, tel,
		nometab, idtype, idacademie, adresse, ville, cp, mailetab)
		values ("'.$_POST["identifiant"].'","'.$_POST["mdp"].'",'.$_POST["idprofil"].',"'.$_POST["nom"].'",
		"'.$_POST["prenom"].'","'.$_POST["mail"].'",'.$_POST["fonction"].', "'.$_POST["tel"].'",
		"'.$_POST["etab"].'",'.$_POST["type"].','.$_POST["academie"].',"'.$_POST["adresse"].'",
		"'.$_POST["ville"].'",'.$_POST["cp"].',"'.$_POST["mailEtab"].'")';
    	mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));
		}
		else
		{
			$rqt='INSERT INTO t_utilisateur (identifiant, mdp, idprofil, nom, prenom, mail, idfonction, tel,
			nometab, idtype, idacademie, adresse, ville, cp, mailetab,logo,cachet)
			values ("'.$_POST["identifiant"].'","'.$_POST["mdp"].'",'.$_POST["idprofil"].',"'.$_POST["nom"].'",
			"'.$_POST["prenom"].'","'.$_POST["mail"].'",'.$_POST["fonction"].', "'.$_POST["tel"].'",
			"'.$_POST["etab"].'",'.$_POST["type"].','.$_POST["academie"].',"'.$_POST["adresse"].'",
			"'.$_POST["ville"].'",'.$_POST["cp"].',"'.$_POST["mailEtab"].'","'.$_POST["logo"].'","'.$_POST["sign"].'")';
    		mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));
		}
	}
}


/*liste utilisateur*/
function get_utilisateur(){
    global $mysqli;
	
	if ($_SESSION["IdProfil"] == 1) /* Pour administrateur */{
    $rqt = 'SELECT u.*, f.nom as fonction, p.nom as profil
	from t_utilisateur as u inner join t_profil as p on u.idprofil=p.id
	inner join t_fonction as f on u.idfonction=f.id';
	
	$ListeUtil= $mysqli->query($rqt) or exit(mysqli_error($mysqli));
	return $ListeUtil;
	}
}


/*liste utilisateur pour la modification*/
function get_utilModif(){
    global $mysqli;
	
	if ($_SESSION["IdProfil"] == 1) /* Pour administrateur */{
		
		$rqt = 'SELECT *
		from t_utilisateur
		where id='.$_GET['id'].'';
			
	$Liste= $mysqli->query($rqt) or exit(mysqli_error($mysqli));
	$ListeUtil = $Liste -> fetch_assoc();
	return $ListeUtil;
	}
}


/*Modif utilisateur*/
function Modif_Util(){
	global $mysqli;
	
	if ($_POST["idprofil"] == 3)
	{
		$rqt='Update t_utilisateur SET identifiant="'.$_POST["identifiant"].'", mdp="'.$_POST["mdp"].'", idprofil='.$_POST["idprofil"].',
		nom="'.$_POST["nom"].'", prenom="'.$_POST["prenom"].'", mail="'.$_POST["mail"].'", idfonction='.$_POST["fonction"].',
		tel="'.$_POST["tel"].'", rattacher='.$_POST["idrattache"].'
		where id= '.$_POST['id'].'';
    	mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));
	}
	else 
	{	
		if ($_POST["idprofil"] == 4)
		{
		$rqt='Update t_utilisateur SET identifiant="'.$_POST["identifiant"].'", mdp="'.$_POST["mdp"].'", idprofil='.$_POST["idprofil"].',
		nom = "'.$_POST["nom"].'", prenom ="'.$_POST["prenom"].'", mail="'.$_POST["mail"].'", idfonction='.$_POST["fonction"].',
		tel = "'.$_POST["tel"].'", nometab="'.$_POST["etab"].'", idtype='.$_POST["type"].', idacademie='.$_POST["academie"].', 
		adresse="'.$_POST["adresse"].'", ville="'.$_POST["ville"].'", cp='.$_POST["cp"].', mailetab="'.$_POST["mailEtab"].'"
		where id= '.$_POST['id'].'';
    	mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));
		}
		else
		{
		$rqt='Update t_utilisateur SET identifiant="'.$_POST["identifiant"].'", mdp="'.$_POST["mdp"].'", idprofil='.$_POST["idprofil"].',
		nom = "'.$_POST["nom"].'", prenom ="'.$_POST["prenom"].'", mail="'.$_POST["mail"].'", idfonction='.$_POST["fonction"].',
		tel = "'.$_POST["tel"].'", nometab="'.$_POST["etab"].'", idtype='.$_POST["type"].', idacademie='.$_POST["academie"].', 
		adresse="'.$_POST["adresse"].'", ville="'.$_POST["ville"].'", cp='.$_POST["cp"].', mailetab="'.$_POST["mailEtab"].'",
		logo="'.$_POST["logo"].'",cachet="'.$_POST["sign"].'"
		where id= '.$_POST['id'].'';
    	mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));
		}
	}
}






/*insert Formation*/
function insert_Form(){
	global $mysqli;
	
		$rqt='INSERT INTO t_formation (idtype, nom)
		values ('.$_POST["typeF"].', "'.$_POST["sigle"].' - '.$_POST["nom"].'")';
    	mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));
	
}


/*liste Formation*/
function get_formation(){
    global $mysqli;
	
	if ($_SESSION["IdProfil"] == 1) /* Pour administrateur */{
    $rqt = 'SELECT f.*, nomcourt
	from t_formation as f inner join t_typeformation as t on t.id=f.idtype';
	
	$ListeForm= $mysqli->query($rqt) or exit(mysqli_error($mysqli));
	return $ListeForm;
	}
}


/*liste utilisateur pour la modification*/
function get_formModif(){
    global $mysqli;
	
	if ($_SESSION["IdProfil"] == 1) /* Pour administrateur */{
		
		$rqt = 'SELECT * from t_formation where id='.$_GET['id'].'';
			
	$Liste= $mysqli->query($rqt) or exit(mysqli_error($mysqli));
	$Form = $Liste -> fetch_assoc();
	return $Form;
	}
}


/*Modif utilisateur*/
function Modif_Form(){
	global $mysqli;
		$rqt='Update t_formation SET idtype='.$_POST["typeF"].', nom="'.$_POST["nom"].'"
		where id= '.$_POST['id'].'';
    	mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));
}
?>