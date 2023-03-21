<?php
	
	/*function get_statistique(){
		
		$requete = "SELECT idcompte FROM t_compte";
        $resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.$mysqli->error);
        $nbrUtilisateur= $resultat->num_rows;

        $requete2 = "SELECT idetab FROM t_etablissement";
        $resultat2 = $mysqli->query($requete2) or die ('Erreur '.$requete2.' '.$mysqli->error);
        $nbrEtab = $resultat2->num_rows;

        $requete3 = "SELECT idministage FROM t_ministage";
        $resultat3 = $mysqli->query($requete3) or die ('Erreur '.$requete3.' '.$mysqli->error);
        $nbrMinistage = $resultat3->num_rows;

        $requete4 = "SELECT idformation FROM t_formation";
        $resultat4 = $mysqli->query($requete4) or die ('Erreur '.$requete4.' '.$mysqli->error);
        $nbrFormation = $resultat4->num_rows;
		
		return $nbrUtilisateur;/*,$nbrEtab, $nbrMinistage, $nbrFormation);
	}*/

    function getNbMSform(){  // Renvoie le nombre de ministage par formations
        global $mysqli;

        $rqt = "SELECT idformation, nom_typeformation, nom_formation, COUNT(idministage) AS nb_ministages
        FROM t_ministage NATURAL JOIN t_formation NATURAL JOIN t_typeformation
        GROUP BY idformation
        ORDER BY nom_typeformation, nom_formation ASC";

        $nbMSf = $mysqli->query($rqt) or exit(mysqli_error($mysqli));
        return $nbMSf;
    }

    function getNbPlaceform(){ // Renvoie le nombre total de places par formations
        global $mysqli;

        $rqt = "SELECT idformation, nom_typeformation, nom_formation, SUM(nbplace) AS Nb_places
        FROM t_ministage NATURAL JOIN t_formation NATURAL JOIN t_typeformation
        GROUP BY idformation
        ORDER BY nom_typeformation, nom_formation ASC";

        $nbPlc = $mysqli->query($rqt) or exit(mysqli_error($mysqli));
        return $nbPlc;
    }

    function getNbResaForm(){  // Renvoie le nombre de réservations actées par formations
        global $mysqli;

        $rqt = "SELECT idformation, nom_typeformation, nom_formation, COUNT(confirmation) AS Nb_reserv_actee
        FROM t_ministage NATURAL JOIN t_reservation NATURAL JOIN t_formation NATURAL JOIN t_typeformation
        WHERE confirmation = 1
        GROUP BY idformation
        ORDER BY nom_typeformation, nom_formation ASC";

        $nbResa = $mysqli->query($rqt) or exit(mysqli_error($mysqli));
        return $nbResa;
    }

    function getEtabResa(){ // Renvoie un classement des établissement par nombre de réservations
        global $mysqli;
        $rqt = "SELECT idetab, nom_typeetab, nometab, COUNT(idreserv) AS Nb_reserv
        FROM t_reservation INNER JOIN t_compte ON t_reservation.idReservant = t_compte.idcompte NATURAL JOIN t_etablissement NATURAL JOIN t_typeetab
        GROUP BY idetab
        ORDER BY Nb_reserv DESC";

        $rankEtab = $mysqli->query($rqt) or exit(mysqli_error($mysqli));
        return $rankEtab;
    }

    function getEtabResaAnnul(){  // Renvoie un classement des établissements par nombre de réservations annulées
        global $mysqli;
        $rqt = "SELECT idetab, nom_typeetab, nometab, COUNT(confirmation) AS Nb_reserv_annulee
        FROM t_reservation INNER JOIN t_compte ON t_reservation.idReservant = t_compte.idcompte NATURAL JOIN t_etablissement NATURAL JOIN t_typeetab
        WHERE confirmation = 0
        GROUP BY idetab
        ORDER BY Nb_reserv_annulee DESC";

        $rankEtabCancel = $mysqli->query($rqt) or exit(mysqli_error($mysqli));
        return $rankEtabCancel;
    }

    function getEtabNbAbs(){ // Renvoie un classement des établissements avec le plus d'absence à des mini_stages
        global $mysqli;
        $rqt = "SELECT idetab, nom_typeetab, nometab, COUNT(absence) AS Nb_absences
        FROM t_reservation INNER JOIN t_compte ON t_reservation.idReservant = t_compte.idcompte NATURAL JOIN t_etablissement NATURAL JOIN t_typeetab
        WHERE absence = 1
        GROUP BY idetab
        ORDER BY Nb_absences DESC";

        $rankEtabAbs = $mysqli->query($rqt) or exit(mysqli_error($mysqli));
        return $rankEtabAbs;
    }

    function getResaFormEtab(){ // Renvoie pour l'établissement de l'utilisateur, son nombre de réservation par formation
        global $mysqli;
        $rqt ='select f.idformation, tf.nom_typeformation ,f.nom_formation,  count(r.idreserv) as nbreserv from t_reservation as r
        inner join t_ministage as m on r.idministage = m.idministage
        inner join t_formation as f on f.idformation = m.idformation
        left join t_formation_compte as fc on fc.idcompte=m.idOffrant
        inner join t_compte as c on c.idcompte = fc.idcompte
        inner join t_etablissement as e on e.idetab = c.idetab
        natural join t_typeformation as tf
        where e.idetab = '.$_SESSION['IdUtilisateur'].'
        group by f.idformation, f.nom_formation
        order by nbreserv DESC';

        $EtabNbResaForm = $mysqli->query($rqt) or exit(mysqli_error($mysqli));
        return $EtabNbResaForm;
    }
?>