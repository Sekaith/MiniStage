<?php

/* Liste les formations */
function get_formation($idtype){
    global $mysqli;

    /*
     $rqt = 'SELECT f.id, f.nom, tf.nom as typeformation FROM t_formation as f
	inner join t_typeformation as tf on f.idtype=tf.id
	where idtype='.$idtype.' order by nom asc';
    */

    $rqt = 'SELECT f.idformation as id, f.nom_formation as nom, tf.nom_typeformation as typeformation 
FROM t_formation as f 
    inner join t_typeformation as tf on f.idtypeform=tf.idtypeform 
where f.idtypeform='.$idtype.'
order by nom asc';
    $Formation= $mysqli->query($rqt) or exit(mysqli_error());

    return $Formation;
}

//ajout ministage
function insertMinistage(){
    global $mysqli;

    $rqt='INSERT INTO t_ministage (idOffrant,idformation,civilite,nomProf,date,hdebut,hfin,nbplace,nbplacereste,lieu)
	values ('.$_SESSION['IdUtilisateur'].', '.$_POST['formation'].', "'.$_POST['civilite'].'", "'.$_POST['nomprof'].'", STR_TO_DATE("'.$_POST['date'].'", "%d-%m-%Y"), 
	"'.$_POST['heure1'].'", "'.$_POST['heure2'].'",'.$_POST['place'].', '.$_POST['place'].', "'.$_POST['lieu'].'")';

    mysqli_query($mysqli, $rqt) or exit(mysqli_error($mysqli));

}


function testV2insertMinistage(){
    global $mysqli;

    $rqt='INSERT INTO t_ministage (idOffrant,idformation,idProf,date,hdebut,hfin,nbplace,lieu)
	values ('.$_SESSION['IdUtilisateur'].', '.$_POST['formation'].', "'.$_POST['idprof'].'", STR_TO_DATE("'.$_POST['date'].'", "%d-%m-%Y"), 
	"'.$_POST['heure1'].'", "'.$_POST['heure2'].'",'.$_POST['place'].', "'.$_POST['lieu'].'")';
    echo die($rqt);
    //mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));

}


//si besoin d'ajout de formation --> coordonnées de l'administrateur
function getCoordAdmin(){
    global $mysqli;

    /*
     $rqt = 'select prenom, nom, mail, tel from t_utilisateur where idprofil=1	limit 0,1';
     */

    $rqt = 'select prenom_compte as prenom, nom_compte as nom, mail_compte as mail, tel from t_compte where idprofil = 1 limit 0,1';
    $data= $mysqli->query($rqt) or exit(mysqli_error());
    $coord = $data -> fetch_assoc();

    return $coord;
}


?>