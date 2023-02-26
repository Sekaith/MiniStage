<?php

/* Charge important */
function get_important(){
    global $mysqli;
    /*
        $rqt = 'Select important, important2 from t_utilisateur where id='.$_SESSION['IdUtilisateur'].'';
    */
    $rqt = 'select important, important2 from t_etablissement e
inner join t_compte c on c.idetab=e.idetab
where idcompte='.$_SESSION['IdUtilisateur'];
    $data= mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));
    $important = $data -> fetch_assoc();

    return $important;

}


/* modif important */
function modif_important(){
    global $mysqli;

    /*
    $rqt = 'update t_utilisateur SET important="'.$_POST['important'].'", important2="'.$_POST['important2'].'" where id='.$_SESSION['IdUtilisateur'].'';
	*/
    $rqt = 'update t_etablissement SET important="'.$_POST['important'].'", important2="'.$_POST['important2'].'"
from t_etablissement e
inner join t_compte as c on e.idetab=c.idetab
where c.idcompte ='.$_SESSION['IdUtilisateur'];
    mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));

}


/* Affiche données de la convention */
function get_Conv(){
    global $mysqli;

    /*
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

     */

    $rqt = 'SELECT eRes.nometab as etabOrigine, eRes.adresse as adresseOrigine, eRes.ville as villeOrigine, eRes.cp as cpOrigine, 
typeRes.nom_typeetab as typeOrigine, eOff.nometab, eOff.adresse, eOff.ville, eOff.cp, eOff.logo, eOff.cachet, cOff.mail_compte as mail, cOff.tel, eOff.important, 
eOff.important2, typeOff.nom_typeetab as type, r.prenom_eleve as prenom, r.nom_eleve as nom, p.civilite, p.nom_prof as nomprof, m.lieu, DATE_FORMAT(m.date, "%d-%m-%Y") AS date, 
m.hdebut, m.hfin, f.nom_formation as formation, tf.nom_typeformation as typeformation 
FROM `t_reservation` as r
inner join t_ministage as m on r.idministage=m.idministage
inner join t_formation as f on f.idformation=m.idformation
inner join t_typeformation as tf on f.idtypeform=tf.idtypeform
inner join t_professeur as p on p.idProf = m.idProf
inner join t_compte as cRes on r.idReservant=cRes.idcompte
inner join t_compte as cOff on m.idOffrant=cOff.idcompte
inner join t_etablissement as eRes on cRes.idetab=eRes.idetab
inner join t_etablissement as eOff on cOff.idetab=eOff.idetab
inner join t_typeetab as typeOff on eOff.idtypeetab=typeOff.idtypeetab
inner join t_typeetab as typeRes on eRes.idtypeetab=typeRes.idtypeetab
where r.idreserv='.$_GET['id'];

    $Convention= mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));
    $Conv = $Convention -> fetch_assoc();

    return $Conv;
}


/* Affiche données de la convention test */
function get_ConvTest(){
    global $mysqli;
    /*
    $rqt = 'Select u.nometab, u.adresse, u.ville, u.cp, u.logo, u.cachet, u.mail, u.tel, u.important, u.important2, t.nom as type
            From t_utilisateur as u inner join t_typeetab as t on t.id=u.idtype
            where u.id= '.$_SESSION['IdUtilisateur'].'';
    */

    $rqt = 'select e.nometab, e.adresse, e.ville, e.cp, e.logo, e.cachet, c.mail_compte as mail, c.tel, e.important, e.important2, ty.nom_typeetab as type
from t_compte c
inner join t_etablissement as e on e.idetab=c.idcompte
inner join t_typeetab as ty on e.idtypeetab = ty.idtypeetab
where c.idcompte= '.$_SESSION['IdUtilisateur'];

    $Convention= mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));
    $Conv = $Convention -> fetch_assoc();

    return $Conv;
}
