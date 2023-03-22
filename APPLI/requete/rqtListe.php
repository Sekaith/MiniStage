<?php


/* Affiche Liste reservation pour les collèges */      /*on garde la date US pour effectuer le trie par date dans le tableau*/
function get_ListeReserv(){
    global $mysqli;

    /*
    $rqt = 'SELECT r.id as id, r.nom as nom, r.prenom, mailetab, mail, ville, tel, t.nomcourt as type, nometab, tf.nomcourt as typeformation, f.nom as formation,
     date as dateUS, DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, hdebut, hfin, confirmation, rappel, absence, u.nom as nomO, u.prenom as prenomO, fo.nom as fonction
    From t_reservation as r inner join t_ministage as m on m.id=r.idmini
    inner join t_formation as f on f.id=m.idformation
    inner join t_typeformation as tf on f.idtype=tf.id
    inner join t_utilisateur as u on m.idOffrant=u.id
    inner join t_typeetab as t on t.id=u.idtype
    inner join t_fonction as fo on u.idfonction=fo.id
    where idReservant = '.$_SESSION['IdUtilisateur'].' AND date>=DATE(NOW())
    ORDER BY date';
    */

    $rqt = 'select r.idreserv as id, r.nom_eleve as nom, r.prenom_eleve as prenom, e.mailetab, c.mail_compte, e.ville, c.tel, t.nomcourt_typeetab as type, 
	e.nometab, tf.nomcourt_typeformation as typeformation, f.nom_formation as formation, 
	 date as dateUS, DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, hdebut, hfin, 
     confirmation, rappel, absence, c.nom_compte as nomO, c.prenom_compte as prenomO, fo.nom_fonct as fonction

from t_reservation as r 
inner join t_ministage as m on m.idministage=r.idministage
	inner join t_formation as f on f.idformation=m.idformation
	inner join t_typeformation as tf on f.idtypeform=tf.idtypeform
	inner join t_compte as c on m.idOffrant=c.idcompte
    inner join t_etablissement as e on e.idetab = c.idetab
	inner join t_typeetab as t on t.idtypeetab=e.idtypeetab
	inner join t_fonction as fo on c.idfonction=fo.idfonction
	where idReservant = '.$_SESSION['IdUtilisateur'].' AND date>=DATE(NOW())
	ORDER BY date;';
    $ListeReserv= $mysqli->query($rqt) or exit(mysqli_error($mysqli));

    return $ListeReserv;
}


/* Affiche Liste reservation pour les lycées */      /*on garde la date US pour effectuer le trie par date dans le tableau*/
function get_ListeReservLycee(){
    global $mysqli;

    /*
      $rqt = 'SELECT r.id as id, r.nom as nom, r.prenom, u.mailetab, u.mail, u.ville, u.tel, t.nom as typel, t.nomcourt as type, u.nometab,
	tf.nomcourt as typeformation, f.nom as formation,  u.nom as nomR, u.prenom as prenomR, fo.nom as fonction,
	date as dateUS, DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, hdebut, hfin, confirmation, rappel, absence, nomProf, civilite
	From t_reservation as r inner join t_ministage as m on m.id=r.idmini
	inner join t_formation as f on f.id=m.idformation
	inner join t_typeformation as tf on f.idtype=tf.id
	inner join t_utilisateur as u on r.idReservant=u.id
	inner join t_typeetab as t on t.id=u.idtype
	inner join t_fonction as fo on u.idfonction=fo.id
	where m.idOffrant = '.$_SESSION['IdUtilisateur'].' AND date>=DATE(NOW())
	ORDER BY date';
     */

    $rqt = 'select r.idreserv as id, r.nom_eleve as nom, r.prenom_eleve as prenom, e.mailetab, c.mail_compte as mail, e.ville, c.tel, tye.nom_typeetab as typel, tye.nomcourt_typeetab as type, e.nometab, tyf.nomcourt_typeformation as typeformation, f.nom_formation as formation, c.nom_compte as nomR, c.prenom_compte as prenomR, fon.nom_fonct as fonction, date as dateUS,  DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, hdebut, hfin, confirmation, rappel, absence, p.nom_prof as nomProf, civilite
from t_reservation as r
inner join t_ministage as m on m.idministage=r.idministage
inner join t_formation as f on f.idformation=m.idformation
inner join t_typeformation as tyf on tyf.idtypeform=f.idtypeform
inner join t_compte as c on c.idcompte=r.idreserv
inner join t_etablissement as e on e.idetab=c.idetab
inner join t_typeetab as tye on tye.idtypeetab=e.idtypeetab
inner join t_fonction as fon on fon.idfonction=c.idfonction
inner join t_professeur as p on m.idProf=p.idProf
where c.idcompte = '.$_SESSION['IdUtilisateur'].' and m.date>= DATE(NOW())
order by date;';


    $ListeReserv= $mysqli->query($rqt) or exit(mysqli_error($mysqli));

    return $ListeReserv;
}


/* Affiche Liste reservation pour les Profs */      /*on garde la date US pour effectuer le trie par date dans le tableau*/
function get_ListeReservProf(){
    global $mysqli;

   /*
    $rqt = 'SELECT r.id as id, r.nom as nom, r.prenom, u.mailetab, u.mail, u.ville, u.tel, t.nom as typel, t.nomcourt as type, u.nometab, 
	tf.nomcourt as typeformation, f.nom as formation,  u.nom as nomR, u.prenom as prenomR, fo.nom as fonction,
	date as dateUS, DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, hdebut, hfin, confirmation, rappel, absence, nomProf, civilite
	From t_reservation as r inner join t_ministage as m on m.id=r.idmini 
	inner join t_formation as f on f.id=m.idformation
	inner join t_typeformation as tf on f.idtype=tf.id
	inner join t_utilisateur as u on r.idReservant=u.id
	inner join t_typeetab as t on t.id=u.idtype
	inner join t_fonction as fo on u.idfonction=fo.id
	where m.idOffrant = '.$_SESSION['Idrattacher'].' AND date>=DATE(NOW())
	ORDER BY date';
    */

    $rqt = 'select r.idreserv as id, r.nom_eleve as nom, r.prenom_eleve as prenom, e.mailetab, c.mail_compte as mail, e.ville, c.tel, tye.nom_typeetab as typel, tye.nomcourt_typeetab as type, e.nometab, tyf.nomcourt_typeformation as typeformation, f.nom_formation as formation, c.nom_compte as nomR, c.prenom_compte as prenomR, fon.nom_fonct as fonction, date as dateUS,  DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, hdebut, hfin, confirmation, rappel, absence, p.nom_prof as nomProf, civilite
from t_reservation as r
inner join t_ministage as m on m.idministage=r.idministage
inner join t_formation as f on f.idformation=m.idformation
inner join t_typeformation as tyf on tyf.idtypeform=f.idtypeform
inner join t_compte as c on c.idcompte=r.idreserv
inner join t_etablissement as e on e.idetab=c.idetab
inner join t_typeetab as tye on tye.idtypeetab=e.idtypeetab
inner join t_fonction as fon on fon.idfonction=c.idfonction
inner join t_professeur as p on m.idProf=p.idProf
where c.idcompte = '.$_SESSION['Idrattacher'].' and date>= DATE(NOW())
order by date;';


    $ListeReserv= $mysqli->query($rqt) or exit(mysqli_error($mysqli));

    return $ListeReserv;
}


/* Affiche Liste reservation pour les Profs */      /*on garde la date US pour effectuer le trie par date dans le tableau*/
function get_ListeReservAdmin(){
    global $mysqli;
/*
    $rqt = 'SELECT r.id as id, r.nom as nom, r.prenom, u.mailetab, u.mail, u.ville, u.tel, t.nom as typel, t.nomcourt as type, u.nometab, 
	tf.nomcourt as typeformation, f.nom as formation,  u.nom as nomR, u.prenom as prenomR, fo.nom as fonction,
	date as dateUS, DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, hdebut, hfin, confirmation, rappel, absence, nomProf, civilite
	From t_reservation as r inner join t_ministage as m on m.id=r.idmini 
	inner join t_formation as f on f.id=m.idformation
	inner join t_typeformation as tf on f.idtype=tf.id
	inner join t_utilisateur as u on r.idReservant=u.id
	inner join t_typeetab as t on t.id=u.idtype
	inner join t_fonction as fo on u.idfonction=fo.id
	where date>=DATE(NOW())
	ORDER BY date';
*/
    $rqt = 'select r.idreserv as id, r.nom_eleve as nom, r.prenom_eleve as prenom, e.mailetab, c.mail_compte as mail, e.ville, c.tel, tye.nom_typeetab as typel, tye.nomcourt_typeetab as type, e.nometab, tyf.nomcourt_typeformation as typeformation, f.nom_formation as formation, c.nom_compte as nomR, c.prenom_compte as prenomR, fon.nom_fonct as fonction, date as dateUS,  DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, hdebut, hfin, confirmation, rappel, absence, p.nom_prof as nomProf, civilite
from t_reservation as r
inner join t_ministage as m on m.idministage=r.idministage
inner join t_formation as f on f.idformation=m.idformation
inner join t_typeformation as tyf on tyf.idtypeform=f.idtypeform
inner join t_compte as c on c.idcompte=r.idreserv
inner join t_etablissement as e on e.idetab=c.idetab
inner join t_typeetab as tye on tye.idtypeetab=e.idtypeetab
inner join t_fonction as fon on fon.idfonction=c.idfonction
inner join t_professeur as p on m.idProf=p.idProf
where date>= DATE(NOW())
order by date;';

    $ListeReserv= $mysqli->query($rqt) or exit(mysqli_error($mysqli));

    return $ListeReserv;
}


/* Affiche Liste reservation pour les collèges */      /*on garde la date US pour effectuer le trie par date dans le tableau*/
function get_ListeReservAnt(){
    global $mysqli;

    /*
    $rqt = 'SELECT r.id as id, r.nom as nom, r.prenom, mailetab, mail, ville, tel, t.nomcourt as type, nometab, tf.nomcourt as typeformation, f.nom as formation, 
	 date as dateUS, DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, hdebut, hfin, confirmation, rappel, absence, u.nom as nomO, u.prenom as prenomO, fo.nom as fonction
	From t_reservation as r inner join t_ministage as m on m.id=r.idmini 
	inner join t_formation as f on f.id=m.idformation
	inner join t_typeformation as tf on f.idtype=tf.id
	inner join t_utilisateur as u on m.idOffrant=u.id
	inner join t_typeetab as t on t.id=u.idtype
	inner join t_fonction as fo on u.idfonction=fo.id
	where idReservant = '.$_SESSION['IdUtilisateur'].' AND date<DATE(NOW())
	ORDER BY date';
    */

    $rqt = 'select r.idreserv as id, r.nom_eleve as nom, r.prenom_eleve as prenom, e.mailetab, c.mail_compte, e.ville, c.tel, t.nomcourt_typeetab as type, 
	e.nometab, tf.nomcourt_typeformation as typeformation, f.nom_formation as formation, 
	 date as dateUS, DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, hdebut, hfin, 
     confirmation, rappel, absence, c.nom_compte as nomO, c.prenom_compte as prenomO, fo.nom_fonct as fonction
from t_reservation as r 
inner join t_ministage as m on m.idministage=r.idministage
	inner join t_formation as f on f.idformation=m.idformation
	inner join t_typeformation as tf on f.idformation=tf.idtypeform
	inner join t_compte as c on m.idOffrant=c.idcompte
    inner join t_etablissement as e on e.idetab = c.idetab
	inner join t_typeetab as t on t.idtypeetab=e.idtypeetab
	inner join t_fonction as fo on c.idfonction=fo.idfonction
	where idReservant = '.$_SESSION['IdUtilisateur'].' AND date<DATE(NOW())
	ORDER BY date;';

    $ListeReserv= $mysqli->query($rqt) or exit(mysqli_error($mysqli));

    return $ListeReserv;
}


/* Affiche Liste reservation pour les lycées */      /*on garde la date US pour effectuer le trie par date dans le tableau*/
function get_ListeReservLyceeAnt(){
    global $mysqli;

    /*
    $rqt = 'SELECT r.id as id, r.nom as nom, r.prenom, u.mailetab, u.mail, u.ville, u.tel, t.nom as typel, t.nomcourt as type, u.nometab, 
	tf.nomcourt as typeformation, f.nom as formation,  u.nom as nomR, u.prenom as prenomR, fo.nom as fonction,
	date as dateUS, DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, hdebut, hfin, confirmation, rappel, absence, nomProf, civilite
	From t_reservation as r inner join t_ministage as m on m.id=r.idmini 
	inner join t_formation as f on f.id=m.idformation
	inner join t_typeformation as tf on f.idtype=tf.id
	inner join t_utilisateur as u on r.idReservant=u.id
	inner join t_typeetab as t on t.id=u.idtype
	inner join t_fonction as fo on u.idfonction=fo.id
	where m.idOffrant = '.$_SESSION['IdUtilisateur'].' AND date<DATE(NOW())
	ORDER BY date';
*/

    $rqt = 'select r.idreserv as id, r.nom_eleve as nom, r.prenom_eleve as prenom, e.mailetab, c.mail_compte as mail, e.ville, c.tel, tye.nom_typeetab as typel, tye.nomcourt_typeetab as type, e.nometab, tyf.nomcourt_typeformation as typeformation, f.nom_formation as formation, c.nom_compte as nomR, c.prenom_compte as prenomR, fon.nom_fonct as fonction, date as dateUS,  DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, hdebut, hfin, confirmation, rappel, absence, p.nom_prof as nomProf, civilite
from t_reservation as r
inner join t_ministage as m on m.idministage=r.idministage
inner join t_formation as f on f.idformation=m.idformation
inner join t_typeformation as tyf on tyf.idtypeform=f.idtypeform
inner join t_compte as c on c.idcompte=r.idreserv
inner join t_etablissement as e on e.idetab=c.idetab
inner join t_typeetab as tye on tye.idtypeetab=e.idtypeetab
inner join t_fonction as fon on fon.idfonction=c.idfonction
inner join t_professeur as p on m.idProf=p.idProf
where c.idcompte = '.$_SESSION['IdUtilisateur'].' and date<DATE(NOW())
order by date;';

    $ListeReserv= $mysqli->query($rqt) or exit(mysqli_error($mysqli));

    return $ListeReserv;
}


/* Affiche Liste reservation pour les Profs */      /*on garde la date US pour effectuer le trie par date dans le tableau*/
function get_ListeReservProfAnt(){
    global $mysqli;
/*
    $rqt = 'SELECT r.id as id, r.nom as nom, r.prenom, u.mailetab, u.mail, u.ville, u.tel, t.nom as typel, t.nomcourt as type, u.nometab, 
	tf.nomcourt as typeformation, f.nom as formation,  u.nom as nomR, u.prenom as prenomR, fo.nom as fonction,
	date as dateUS, DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, hdebut, hfin, confirmation, rappel, absence, nomProf, civilite
	From t_reservation as r inner join t_ministage as m on m.id=r.idmini 
	inner join t_formation as f on f.id=m.idformation
	inner join t_typeformation as tf on f.idtype=tf.id
	inner join t_utilisateur as u on r.idReservant=u.id
	inner join t_typeetab as t on t.id=u.idtype
	inner join t_fonction as fo on u.idfonction=fo.id
	where m.idOffrant = '.$_SESSION['Idrattacher'].' AND date<DATE(NOW())
	ORDER BY date';
*/

    $rqt = 'select r.idreserv as id, r.nom_eleve as nom, r.prenom_eleve as prenom, e.mailetab, c.mail_compte as mail, e.ville, c.tel, tye.nom_typeetab as typel, tye.nomcourt_typeetab as type, e.nometab, tyf.nomcourt_typeformation as typeformation, f.nom_formation as formation, c.nom_compte as nomR, c.prenom_compte as prenomR, fon.nom_fonct as fonction, date as dateUS,  DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, hdebut, hfin, confirmation, rappel, absence, p.nom_prof as nomProf, civilite
from t_reservation as r
inner join t_ministage as m on m.idministage=r.idministage
inner join t_formation as f on f.idformation=m.idformation
inner join t_typeformation as tyf on tyf.idtypeform=f.idtypeform
inner join t_compte as c on c.idcompte=r.idreserv
inner join t_etablissement as e on e.idetab=c.idetab
inner join t_typeetab as tye on tye.idtypeetab=e.idtypeetab
inner join t_fonction as fon on fon.idfonction=c.idfonction
inner join t_professeur as p on m.idProf=p.idProf
where c.idcompte = '.$_SESSION['Idrattacher'].' and date<DATE(NOW())
order by date;';

    $ListeReserv= $mysqli->query($rqt) or exit(mysqli_error($mysqli));

    return $ListeReserv;
}


/* Affiche Liste reservation pour les Profs */      /*on garde la date US pour effectuer le trie par date dans le tableau*/
function get_ListeReservAdminAnt(){
    global $mysqli;
/*
    $rqt = 'SELECT r.id as id, r.nom as nom, r.prenom, u.mailetab, u.mail, u.ville, u.tel, t.nom as typel, t.nomcourt as type, u.nometab, 
	tf.nomcourt as typeformation, f.nom as formation,  u.nom as nomR, u.prenom as prenomR, fo.nom as fonction,
	date as dateUS, DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, hdebut, hfin, confirmation, rappel, absence, nomProf, civilite
	From t_reservation as r inner join t_ministage as m on m.id=r.idmini 
	inner join t_formation as f on f.id=m.idformation
	inner join t_typeformation as tf on f.idtype=tf.id
	inner join t_utilisateur as u on r.idReservant=u.id
	inner join t_typeetab as t on t.id=u.idtype
	inner join t_fonction as fo on u.idfonction=fo.id
	where date<DATE(NOW())
	ORDER BY date';
*/
    $rqt = 'select r.idreserv as id, r.nom_eleve as nom, r.prenom_eleve as prenom, e.mailetab, c.mail_compte as mail, e.ville, c.tel, tye.nom_typeetab as typel, tye.nomcourt_typeetab as type, e.nometab, tyf.nomcourt_typeformation as typeformation, f.nom_formation as formation, c.nom_compte as nomR, c.prenom_compte as prenomR, fon.nom_fonct as fonction, date as dateUS,  DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, hdebut, hfin, confirmation, rappel, absence, p.nom_prof as nomProf, civilite
from t_reservation as r
inner join t_ministage as m on m.idministage=r.idministage
inner join t_formation as f on f.idformation=m.idformation
inner join t_typeformation as tyf on tyf.idtypeform=f.idtypeform
inner join t_compte as c on c.idcompte=r.idreserv
inner join t_etablissement as e on e.idetab=c.idetab
inner join t_typeetab as tye on tye.idtypeetab=e.idtypeetab
inner join t_fonction as fon on fon.idfonction=c.idfonction
inner join t_professeur as p on m.idProf=p.idProf
where date<DATE(NOW())
order by date;';

    $ListeReserv= $mysqli->query($rqt) or exit(mysqli_error($mysqli));

    return $ListeReserv;
}



?>