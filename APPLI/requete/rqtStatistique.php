<?php
	
	function get_statistique(){
		
		$requete = "SELECT id FROM t_utilisateur";
        $resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.$mysqli->error);
        $nbrUtilisateur= $resultat->num_rows;

        $requete2 = "SELECT id FROM t_etablissement";
        $resultat2 = $mysqli->query($requete2) or die ('Erreur '.$requete2.' '.$mysqli->error);
        $nbrEtab = $resultat2->num_rows;

        $requete3 = "SELECT id FROM t_ministage";
        $resultat3 = $mysqli->query($requete3) or die ('Erreur '.$requete3.' '.$mysqli->error);
        $nbrMinistage = $resultat3->num_rows;

        $requete4 = "SELECT id FROM t_formation";
        $resultat4 = $mysqli->query($requete4) or die ('Erreur '.$requete4.' '.$mysqli->error);
        $nbrFormation = $resultat4->num_rows;
		
		return $nbrUtilisateur;/*,$nbrEtab, $nbrMinistage, $nbrFormation)*/;
	}
	
?>