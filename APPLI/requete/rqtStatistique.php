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

    function getNbMSform(){
        global $mysqli;

        $rqt = "SELECT idformation, nom_formation, COUNT(idministage) AS nb_ministages
        FROM t_ministage NATURAL JOIN t_formation
        GROUP BY idformation
        ORDER BY Nb_ministages DESC";

        $nbMSf = $mysqli->query($rqt) or exit(mysqli_error($mysqli));
        return $nbMSf;
    }
	
?>