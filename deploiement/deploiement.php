<?php
echo '<html>
<form action="" method="post">
    <button name="launch" value="launch">Lancer le script</button>
</form>
</html><br>';


if (isset($_POST["launch"])) {

    echo("Script lancé, merci d'attendre !<br><br>");


    $hostname = "localhost";
    $user = "root";
    $password = "root";
    $nom_base_donnees = "ministages44_2";
    $mysqli = new mysqli($hostname, $user, $password, $nom_base_donnees) or die(mysqli_error($mysqli));
    $mysqli->set_charset("utf8");

    //on sauvegarde les data de la base de données

    $rqt = "SELECT * FROM t_academie";
    $academies = $mysqli->query($rqt)->fetch_all() or exit(mysqli_error($mysqli));

    $rqt = "SELECT * FROM t_fonction";
    $fonctions = $mysqli->query($rqt)->fetch_all() or exit(mysqli_error($mysqli));

    $rqt = "SELECT * FROM t_formation";
    $formations = $mysqli->query($rqt)->fetch_all() or exit(mysqli_error($mysqli));

    $rqt = "SELECT * FROM t_ministage";
    $ministages = $mysqli->query($rqt)->fetch_all() or exit(mysqli_error($mysqli));

    $rqt = "SELECT * FROM t_profil";
    $profils = $mysqli->query($rqt)->fetch_all() or exit(mysqli_error($mysqli));

    $rqt = "SELECT * FROM t_reservation";
    $reservations = $mysqli->query($rqt)->fetch_all() or exit(mysqli_error($mysqli));

    $rqt = "SELECT * FROM t_typeetab";
    $typeetabs = $mysqli->query($rqt)->fetch_all() or exit(mysqli_error($mysqli));

    $rqt = "SELECT * FROM t_typeformation";
    $typeformations = $mysqli->query($rqt)->fetch_all() or exit(mysqli_error($mysqli));

    $rqt = "SELECT * FROM t_utilisateur";
    $utilisateurs = $mysqli->query($rqt)->fetch_all() or exit(mysqli_error($mysqli));


    $delete = "DROP TABLE t_academie;";
    $delete .= "DROP TABLE t_fonction;";
    $delete .= "DROP TABLE t_formation;";
    $delete .= "DROP TABLE t_ministage;";
    $delete .= "DROP TABLE t_profil;";
    $delete .= "DROP TABLE t_reservation;";
    $delete .= "DROP TABLE t_typeetab;";
    $delete .= "DROP TABLE t_typeformation;";
    $delete .= "DROP TABLE t_utilisateur;";

    $result = $mysqli->multi_query($delete) or exit(mysqli_error($mysqli));
    while ($mysqli->next_result()) ;

    $location = "create_ministages44.sql";
    $create_table = file_get_contents($location);
    $result = $mysqli->multi_query($create_table) or exit(mysqli_error($mysqli));
    while ($mysqli->next_result()) ;

//insertion des typeformations
    $rqt_insert = "INSERT INTO t_typeformation (idtypeform, nom_typeformation, nomcourt_typeformation) VALUES ";
    foreach ($typeformations as $tf) {
        $rqt_insert .= "($tf[0], '$tf[1]', '$tf[2]'),";
    }
    $rqt_insert = substr($rqt_insert, 0, -1);
    $rqt_insert .= ";";

    $result = $mysqli->query($rqt_insert);

//insertion des formations
    $rqt_insert = "INSERT INTO t_formation (idformation, idtypeform, nom_formation) VALUES ";
    foreach ($formations as $f) {
        $lat = str_replace('"', "", $f[2]);
        $lat = str_replace("'", "\'", $lat);
        $id = str_replace("-1", "1", $f[1]);
        $rqt_insert .= "($f[0], '$id', '$lat'),";
    }
    $rqt_insert = substr($rqt_insert, 0, -1);
    $rqt_insert .= ";";

    $result = $mysqli->query($rqt_insert);

    //insertion des academies
    $rqt_insert = "INSERT INTO t_academie (idacademie, nom_academie) VALUES ";
    foreach ($academies as $a) {
        $rqt_insert .= "($a[0], '$a[1]'),";
    }
    $rqt_insert = substr($rqt_insert, 0, -1);
    $rqt_insert .= ";";

    $result = $mysqli->query($rqt_insert);

//insertion des typeetabs
    $rqt_insert = "INSERT INTO t_typeetab (idtypeetab, nom_typeetab, nomcourt_typeetab) VALUES ";
    foreach ($typeetabs as $te) {
        $rqt_insert .= "($te[0], '$te[1]', '$te[2]'),";
    }
    $rqt_insert = substr($rqt_insert, 0, -1);
    $rqt_insert .= ";";

    $result = $mysqli->query($rqt_insert);

//insertion des fonctions
    $rqt_insert = "INSERT INTO t_fonction (idfonction, nom_fonct) VALUES ";
    foreach ($fonctions as $fn) {
        $rqt_insert .= "($fn[0], '$fn[1]'),";
    }
    $rqt_insert = substr($rqt_insert, 0, -1);
    $rqt_insert .= ";";

    $result = $mysqli->query($rqt_insert);

//insertion des profils
    $rqt_insert = "INSERT INTO t_profil (idprofil, nom_profil) VALUES ";
    foreach ($profils as $p) {
        $rqt_insert .= "($p[0], '$p[1]'),";
    }
    $rqt_insert = substr($rqt_insert, 0, -1);
    $rqt_insert .= ";";

    $result = $mysqli->query($rqt_insert);

    //creation des comptes et etabs
    $comptes = array();
    $etabs = array();
    $RNE = array();

    foreach ($utilisateurs as $u) {
        $compte = array(
            "identifiant" => $u[1],
            "mdp" => $u[2],
            "idprofil" => $u[3],
            "nom" => $u[4],
            "prenom" => $u[5],
            "mail" => $u[6],
            "idfonction" => $u[7],
            "tel" => $u[8],
            "RNE" => $u[10]

        );

        $etab = array(
            "nometab" => $u[9],
            "idtype" => $u[11],
            "ville" => $u[12],
            "adresse" => $u[13],
            "mailetab" => $u[14],
            "idacademie" => $u[15],
            "cp" => $u[16],
            "logo" => $u[17],
            "cachet" => $u[18],
            "important" => $u[19],
            "important2" => $u[20],
            "RNE" => $u[10],
        );

        $comptes[] = $compte;

        if (!array_key_exists($u[10], $RNE)) {
            $RNE[$u[10]] = $u[10];
            $etabs[] = $etab;
        }
    }

    //insertion des etablissements
    $rqt_insert = "INSERT INTO t_etablissement (nometab, idtypeetab, ville, adresse, mailetab, idacademie, cp, logo, cachet, important, important2, RNE) VALUES ";
    foreach ($etabs as $id => &$e) {

        if ($id != 0 ) {
            if($id != 27){

                $e["nometab"] = str_replace("'", "\'", $e["nometab"]);
                $e["adresse"] = str_replace("'", "\'", $e["adresse"]);
                $e["ville"] = str_replace("'", "\'", $e["ville"]);
                $e["important"] = str_replace("'", "\'", $e["important"]);
                $e["important2"] = str_replace("'", "\'", $e["important2"]);

                if($e["idtype"] == '-1' || $e["idtype"] == NULL ||$e["idtype"] == '0'){
                        $e["idtype"] = '12';
                }

                if($e["cp"] == NULL || $e["cp"] == '0'){
                    $e["cp"] = '00000';
                }
                if($e["idacademie"] == NULL || $e["idacademie"] == '0'){
                    $e["idacademie"] = '1';
                }
                $rqt_insert .= "('" . $e['nometab'] . "', " . $e['idtype'] . ", '" . $e['ville'] . "', '" . $e['adresse'] . "', '" . $e['mailetab'] . "', " . $e['idacademie'] . ", '" . $e['cp'] . "', '" . $e['logo'] . "', '" . $e['cachet'] . "', '" . $e['important'] . "', '" . $e['important2'] . "', '" . $e['RNE'] . "'),";

            }

        } else {
            $rqt_insert .= "('Administrateur', '12', 'NULL', 'NULL', 'NULL', '1', '00000', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),";

        }
    }

    $rqt_insert = substr($rqt_insert, 0, -1);
    $rqt_insert .= ";";

    $result = $mysqli->query($rqt_insert);


    $rqt = "SELECT idetab, RNE  FROM t_etablissement";
    $etabRNE = $mysqli->query($rqt)->fetch_all() or exit(mysqli_error($mysqli));

    $rqt_insert = "INSERT INTO t_compte (identifiant, mdp, idprofil, nom_compte, prenom_compte, mail_compte, idfonction, tel, idetab, datecreation) VALUES ";

    foreach ($comptes as $id=>&$c) {
        if ($id == 0){
            $rqt_insert .= "('" . $c["identifiant"] . "','" . $c["mdp"] . "'," . $c["idprofil"] . ",'" . $c["nom"] . "','" . $c["prenom"] . "','" . $c["mail"] . "'," . $c["idfonction"] . ",'" . $c["tel"] . "','1', NOW() ),";

        }else{
            foreach ($etabRNE as $eRNE) {
                if ($eRNE[1] == $c["RNE"]) {
                    if($c["prenom"] == " 'Equipe'"){
                        $c["prenom"] = "Equipe";
                    }
                    $c["nom"] = str_replace("'", "\'", $c["nom"]);
                    $c["prenom"] = str_replace("'", "\'", $c["prenom"]);


                    if($c["idfonction"] == 0){
                        $c["idfonction"] = 6;
                    }

                    $rqt_insert .= "('" . $c["identifiant"] . "','" . $c["mdp"] . "'," . $c["idprofil"] . ",'" . $c["nom"] . "','" . $c["prenom"] . "','" . $c["mail"] . "'," . $c["idfonction"] . ",'" . $c["tel"] . "','" . $eRNE[0] . "', NOW() ),";
                }
            }
        }
    }
    $rqt_insert = substr($rqt_insert, 0, -1);
    $rqt_insert .= ";";


    $result = $mysqli->query($rqt_insert);

    echo("Script fini !");


} else {
    echo("Script pas encore lancé !<br><br>");

}
