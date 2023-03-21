<?php
//On obtient les informations sur les ministages que l'utilisateur propose
function get_ListeForm()
{
    global $mysqli;

    if ($_SESSION["IdProfil"] == 1) /* Pour administrateur */ {
        /*
             $rqt = 'SELECT m.id, tf.nomcourt as typeformation, f.nom as formation, civilite, nomProf, date as dateUS,
         DATE_FORMAT(date, "%d-%m-%Y") AS dateFR,
         hdebut, hfin, nbplace, nbplacereste
         from t_ministage as m inner join t_formation as f on m.idformation=f.id
         inner join t_typeformation as tf on f.idtype=tf.id
         where date>ADDDATE(NOW(), INTERVAL -7 DAY)
         ORDER BY date';*/

        $rqt = 'SELECT m.idministage as id, tf.nomcourt_typeformation as typeformation, f.nom_formation as formation, p.civilite, p.nom_prof as nomProf, m.date as dateUS, 
	DATE_FORMAT(m.date, "%d-%m-%Y") AS dateFR, 
	m.hdebut, m.hfin, m.nbplace, case when t1.nbreserv is null then m.nbplace else (m.nbplace - t1.nbreserv) end as nbplacereste
	from t_ministage as m 
    left join (
    select m1.idministage, count(distinct r1.idreserv) as nbreserv from t_reservation as r1
inner join t_ministage as m1 on m1.idministage=r1.idministage
GROUP by r1.idministage) t1 on t1.idministage = m.idministage
left join t_professeur as p on p.idProf = m.idProf
    inner join t_formation as f on m.idformation=f.idformation
	inner join t_typeformation as tf on f.idtypeform=tf.idtypeform
	where date>ADDDATE(NOW(), INTERVAL -7 DAY)
	ORDER BY date;';

    } else {

        if ($_SESSION["IdProfil"] == 3) /* Pour Prof */ {
            /*
                        $rqt = 'SELECT m.id, tf.nomcourt as typeformation, f.nom as formation, civilite, nomProf, date as dateUS,
                DATE_FORMAT(date, "%d-%m-%Y") AS dateFR,
                hdebut, hfin, nbplace, nbplacereste
                from t_ministage as m inner join t_formation as f on m.idformation=f.id
                inner join t_typeformation as tf on f.idtype=tf.id
                where idOffrant = ' . $_SESSION['Idrattacher'] . ' AND date>=DATE(NOW())
                ORDER BY date';

            */

            $rqt = 'SELECT m.idministage as id, tf.nomcourt_typeformation as typeformation, f.nom_formation as formation, p.civilite, p.nom_prof as nomProf, m.date as dateUS, 
	DATE_FORMAT(m.date, "%d-%m-%Y") AS dateFR, 
	m.hdebut, m.hfin, m.nbplace, case when t1.nbreserv is null then m.nbplace else (m.nbplace - t1.nbreserv) end as nbplacereste
	from t_ministage as m 
    left join (
    select m1.idministage, count(distinct r1.idreserv) as nbreserv from t_reservation as r1
inner join t_ministage as m1 on m1.idministage=r1.idministage
GROUP by r1.idministage) t1 on t1.idministage = m.idministage
left join t_professeur as p on p.idProf = m.idProf
    inner join t_formation as f on m.idformation=f.idformation
	inner join t_typeformation as tf on f.idtypeform=tf.idtypeform
	where m.idOffrant=' . $_SESSION['Idrattacher'] . ' and date>=DATE(NOW())
	ORDER BY date;';

        } else {
            /*
                        $rqt = 'SELECT m.id, tf.nomcourt as typeformation, f.nom as formation, civilite, nomProf, date as dateUS,
                DATE_FORMAT(date, "%d-%m-%Y") AS dateFR,
                hdebut, hfin, nbplace, nbplacereste
                from t_ministage as m inner join t_formation as f on m.idformation=f.id
                inner join t_typeformation as tf on f.idtype=tf.id
                where idOffrant = ' . $_SESSION['IdUtilisateur'] . ' AND date>=DATE(NOW())
                ORDER BY date';
            */

            $rqt = 'SELECT m.idministage as id, tf.nomcourt_typeformation as typeformation, f.nom_formation as formation, p.civilite, p.nom_prof as nomProf, m.date as dateUS, 
	DATE_FORMAT(m.date, "%d-%m-%Y") AS dateFR, 
	m.hdebut, m.hfin, m.nbplace, case when t1.nbreserv is null then m.nbplace else (m.nbplace - t1.nbreserv) end as nbplacereste
	from t_ministage as m 
    left join (
    select m1.idministage, count(distinct r1.idreserv) as nbreserv from t_reservation as r1
inner join t_ministage as m1 on m1.idministage=r1.idministage
GROUP by r1.idministage) t1 on t1.idministage = m.idministage
left join t_professeur as p on p.idProf = m.idProf
    inner join t_formation as f on m.idformation=f.idformation
	inner join t_typeformation as tf on f.idtypeform=tf.idtypeform
	where m.idOffrant=' . $_SESSION['IdUtilisateur'] . ' and date>=DATE(NOW())
	ORDER BY date;';

        }
    }

    $ListeForm = $mysqli->query($rqt) or exit(mysqli_error($mysqli));
    return $ListeForm;
}

//On obtient les informations sur les ministages que l'utilisateur propose pour une date antérieur

function get_ListeFormAnt()
{
    global $mysqli;

    if ($_SESSION["IdProfil"] == 1) /* Pour administrateur */ {
        /*
        $rqt = 'SELECT m.id, tf.nomcourt as typeformation, f.nom as formation, civilite, nomProf, date as dateUS,
	DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, 
	hdebut, hfin, nbplace, nbplacereste
	from t_ministage as m inner join t_formation as f on m.idformation=f.id
	inner join t_typeformation as tf on f.idtype=tf.id
	where date<=ADDDATE(NOW(), INTERVAL -7 DAY)
	ORDER BY date';
      */

        $rqt = 'SELECT m.idministage as id, tf.nomcourt_typeformation as typeformation, f.nom_formation as formation, p.civilite, p.nom_prof as nomProf, m.date as dateUS, 
	DATE_FORMAT(m.date, "%d-%m-%Y") AS dateFR, 
	m.hdebut, m.hfin, m.nbplace, case when t1.nbreserv is null then m.nbplace else (m.nbplace - t1.nbreserv) end as nbplacereste
    
	from t_ministage as m 
    left join (
    select m1.idministage, count(distinct r1.idreserv) as nbreserv from t_reservation as r1
inner join t_ministage as m1 on m1.idministage=r1.idministage
GROUP by r1.idministage) t1 on t1.idministage = m.idministage
left join t_professeur as p on p.idProf = m.idProf
    inner join t_formation as f on m.idformation=f.idformation
	inner join t_typeformation as tf on f.idtypeform=tf.idtypeform
	where date<=ADDDATE(NOW(), INTERVAL -7 DAY)
	ORDER BY date;';


    } else {
        if ($_SESSION["IdProfil"] == 3) /* Pour Prof */ {
            /*
            $rqt = 'SELECT m.id, tf.nomcourt as typeformation, f.nom as formation, civilite, nomProf, date as dateUS,
	DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, 
	hdebut, hfin, nbplace, nbplacereste
	from t_ministage as m inner join t_formation as f on m.idformation=f.id
	inner join t_typeformation as tf on f.idtype=tf.id
	where idOffrant = ' . $_SESSION['Idrattacher'] . ' AND date<DATE(NOW())
	ORDER BY date';
*/

            $rqt = 'SELECT m.idministage as id, tf.nomcourt_typeformation as typeformation, f.nom_formation as formation, p.civilite, p.nom_prof as nomProf, m.date as dateUS, 
	DATE_FORMAT(m.date, "%d-%m-%Y") AS dateFR, 
	m.hdebut, m.hfin, m.nbplace, case when t1.nbreserv is null then m.nbplace else (m.nbplace - t1.nbreserv) end as nbplacereste
	from t_ministage as m 
    left join (
    select m1.idministage, count(distinct r1.idreserv) as nbreserv from t_reservation as r1
inner join t_ministage as m1 on m1.idministage=r1.idministage
GROUP by r1.idministage) t1 on t1.idministage = m.idministage
left join t_professeur as p on p.idProf = m.idProf
    inner join t_formation as f on m.idformation=f.idformation
	inner join t_typeformation as tf on f.idtypeform=tf.idtypeform
	where m.idOffrant=' . $_SESSION['Idrattacher'] . ' and date<=DATE(NOW())
	ORDER BY date;';

        } else {
            /*
            $rqt = 'SELECT m.id, tf.nomcourt as typeformation, f.nom as formation, civilite, nomProf, date as dateUS,
	DATE_FORMAT(date, "%d-%m-%Y") AS dateFR, 
	hdebut, hfin, nbplace, nbplacereste
	from t_ministage as m inner join t_formation as f on m.idformation=f.id
	inner join t_typeformation as tf on f.idtype=tf.id
	where idOffrant = ' . $_SESSION['IdUtilisateur'] . ' AND date<DATE(NOW())
	ORDER BY date';
            */

            $rqt = 'SELECT m.idministage as id, tf.nomcourt_typeformation as typeformation, f.nom_formation as formation, p.civilite, p.nom_prof as nomProf, m.date as dateUS, 
	DATE_FORMAT(m.date, "%d-%m-%Y") AS dateFR, 
	m.hdebut, m.hfin, m.nbplace, case when t1.nbreserv is null then m.nbplace else (m.nbplace - t1.nbreserv) end as nbplacereste
	from t_ministage as m 
    left join (
    select m1.idministage, count(distinct r1.idreserv) as nbreserv from t_reservation as r1
inner join t_ministage as m1 on m1.idministage=r1.idministage
GROUP by r1.idministage) t1 on t1.idministage = m.idministage
left join t_professeur as p on p.idProf = m.idProf
    inner join t_formation as f on m.idformation=f.idformation
	inner join t_typeformation as tf on f.idtypeform=tf.idtypeform
	where m.idOffrant=' . $_SESSION['IdUtilisateur'] . ' and date<=DATE(NOW())
	ORDER BY date;';

        }
    }

    $ListeForm = $mysqli->query($rqt) or exit(mysqli_error($mysqli));
    return $ListeForm;
}

?>