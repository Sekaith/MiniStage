<?php


/* Affiche profil utilisateur */
function get_profil(){
    global $mysqli;

    if ($_SESSION["IdProfil"] == 3){
//    $rqtProfil = 'SELECT u.id,identifiant,mdp,idprofil,u.nom,prenom,mail,idfonction,
//	tel from t_utilisateur as u  where id='.$_SESSION['IdUtilisateur'].'';
//	} else {
//	$rqtProfil = 'SELECT u.id,identifiant,mdp,idprofil,u.nom,prenom,mail,idfonction,
//	tel,nometab,idtype,ville,adresse,mailetab,idacademie,cp, t.nom as nomtype
//	from t_utilisateur as u inner join t_typeetab as t on u.idtype=t.id where u.id='.$_SESSION['IdUtilisateur'].' ';
        $rqtProfil = 'SELECT u.idcompte as id, u.identifiant, u.mdp, u.idprofil, u.nom_compte as nom, u.prenom_compte as prenom ,u.mail_compte as mail, u.idfonction,
	tel from t_compte as u  where u.idcompte='.$_SESSION['IdUtilisateur'].'';
    } else {
        $rqtProfil = 'SELECT u.idcompte as id,u.identifiant,u.mdp,u.idprofil,u.nom_compte as nom,u.prenom_compte as prenom,u.mail_compte as mail,u.idfonction,
	tel,e.nometab,e.idtypeetab as idtype,e.ville,e.adresse,e.mailetab,e.idacademie,e.cp, t.nom_typeetab as nomtype,e.idetab 
	from t_compte as u inner join t_etablissement e on e.idetab=u.idetab inner join t_typeetab as t on e.idtypeetab=t.idtypeetab where u.idcompte='.$_SESSION['IdUtilisateur'].' ';
    }

    $tabProfil= mysqli_query($mysqli,$rqtProfil) or exit(mysqli_error($mysqli));
    $Profil = $tabProfil -> fetch_assoc();

    return $Profil;
}


/* Modifie profil utilisateur */
function updateProfil(){
    global $mysqli;

    $rqt ='UPDATE t_compte SET identifiant="'.$_POST['id'].'",mdp="'.$_POST['mdp'].'",
	nom_compte="'.$_POST['nom'].'",prenom_compte="'.$_POST['prenom'].'", idfonction="'.$_POST['fct'].'",
    mail_compte="'.$_POST['mail'].'",tel="'.$_POST['tel'].'"  
	where idcompte= '.$_SESSION['IdUtilisateur'].'';
    mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));
}


/* Modifie Etablissement */
function updateEtab(){
    global $mysqli;

    $rqt ='UPDATE t_etablissement SET nometab = "'.$_POST['nometab'].'", idtypeetab = '.$_POST['type'].', ville = "'.$_POST['ville'].'",
	cp =  '.$_POST['cp'].' WHERE idetab= '.$_SESSION['IdUtilisateur'].'';
    mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));
}


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


/* Vérifie si le RNE est déjà utilisé */
function Verif_RNE(){
    global $mysqli;

    $Rqt = mysqli_query($mysqli,'SELECT * FROM t_compte WHERE identifiant = "'.$_POST['rne'].'"');
    if(mysqli_num_rows($Rqt) == 0) {
        return true;
    }
    else {
        return false;
    }
}


/* Inscription */
function inscription(){
    global $mysqli;

    //Génération du mot de passe
    $caracteres = array("a", "b", "c", "d", "e", "f","g", "h", "i", "j", "k", "l","m",
        "n", "o", "p", "q", "r","s", "t", "u", "v", "w", "x","y","z", 0, 1, 2, 3, 4, 5, 6,
        7, 8, 9);
    $caracteres_aleatoires = array_rand($caracteres, 8);
    $pass = "";
    foreach($caracteres_aleatoires as $i)
    {
        $pass .= $caracteres[$i];
    }

    //recup nom academie
    $rqt = 'SELECT nom_academie FROM t_academie where idacademie='.$_POST['academie'].'';
    $tabAcademie=  mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));
    $academie= $tabAcademie->fetch_assoc();

    $academiemin = strtolower($academie['nom']);	//academie en miniscule pour l'adresse mail
    $RNEmin= strtolower($_POST['rne']);
    $mailetab = 'ce.'.$RNEmin.'@ac-'.$academiemin.'.fr';

    //insertion
    $rqt='INSERT INTO `t_etablissement`(`nometab`,`idtypeetab`,`ville`,`adresse`,`mailetab`,`idacademie`,`cp`,`logo`,`cachet`,`important`,`important2`) 
	 VALUES("'.$_POST['etab'].'",'.$_POST['type'].',"'.$_POST['ville'].'","'.$_POST['adresse'].'","'.$mailetab.'", '.$_POST['academie'].', '.$_POST['cp'].',"","","")';

    mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));

    $rqt = 'SELECT idetab FROM t_etablissement where nometab='.$_POST['etab'].'';
    $etab = $mysqli->query($rqt);

    $rqt2='INSERT INTO `t_compte`(`identifiant`,`mdp`,`idprofil`,`nom`,`prenom`,`mail`,`idfonction`,`tel`,`idetab`) 
	 VALUES(NULL,"'.$_POST['rne'].'","'.$pass.'",4,"'.$_POST['nom'].'","'.$_POST['prenom'].'","'.$_POST['mail'].'",
	 '.$_POST['fonction'].',"'.$_POST['tel'].'","'.$etab.'")';

    mysqli_query($mysqli,$rqt2) or exit(mysqli_error($mysqli));


//envoie du mail d'inscription


    //on débute l'envoi de mail

    $mail = new PHPmailer();

    //Pour un envoi par SMTP

    $mail->IsSMTP(); // spécifie que le mail sera envoyé sur un serveur SMTP
    $mail->SMTPAuth=true;
    //$mail->Host='smtp-heberg.ac-nantes.fr'; // Spécifie l'hôte SMTP auquel il faut se connecter.
    //$mail->Username = "heberg-0490003M"; // GMail username (including @gmail.com)
    //$mail->Password = "ZpMk8==";
    //$mail->Port = 465;



    //Vous devez bien sur choisir un moyen d'envoi mais pas les trois en même temps

    $mail->IsHTML(false); // si votre message est au format HTML

    $mail->From='ddfp.louisarmand@ac-nantes.fr'; // votre adresse
    $mail->FromName='Administrateur Application Mini-Stage'; // votre nom
    $mail->AddAddress($mailetab); // adresse du destinataire

    $mail->AddReplyTo('ddfp.louisarmand@ac-nantes.fr');    // adresse de retour
    $mail->Subject='Confirmation d\'inscription'; // sujet de votre message
    $mail->Body=utf8_decode($_POST['prenom']." ".$_POST['nom']."  a inscrit votre établissement sur le site de réservation de mini-stages des Lycées Publics Professionnels et Technologiques de Loire Atlantique. Si cette personne est bien membre de votre établissement merci de lui communiquer les informations suivantes:\r\nIdentifiant: ".$_POST['rne']."\r\nMot de Passe: ".$pass." \r\nVous pouvez lui transférer à cette adresse: ".$_POST['mail']." "); //pour un message HTML ne pas oubliez IsHTML(true)

    if(!$mail->Send()){ // on teste la fonction Send() -> envoyer
        echo $mail->ErrorInfo; //Affiche le message d'erreur
    }
    else{
    }
    $mail->SmtpClose(); // à supprimer si vous n'utilisez pas SMTP
    unset($mail);

    return $mailetab;

}


/*mdp oublié*/
function mdpoublie(){
    global $mysqli;


    $rqt = "SELECT mdp FROM t_compte where identifiant = '".$_POST['rne']."'";
    $motdp= $mysqli->query($rqt) or exit(mysqli_error($mysqli));

    if(mysqli_num_rows($motdp) == 1)
    {
        $mdp = $motdp->fetch_assoc();
        $pass=$mdp['mdp'];
        //recup nom academie
        $rqt = "SELECT mailetab FROM t_compte where identifiant='".$_POST['rne']."'";
        $tabMail=  $mysqli->query($rqt) or exit(mysqli_error($mysqli));
        $mailEta= $tabMail->fetch_assoc();



        //envoie du mail


        //on débute l'envoi de mail

        $mail = new PHPmailer();

        //Pour un envoi par SMTP

        $mail->IsSMTP(); // spécifie que le mail sera envoyé sur un serveur SMTP
        $mail->SMTPAuth=true;
        //$mail->Host='smtp-heberg.ac-nantes.fr'; // Spécifie l'hôte SMTP auquel il faut se connecter.
        //$mail->Username = "heberg-0490003M"; // GMail username (including @gmail.com)
        //$mail->Password = "ZpMk8==";
        //$mail->Port = 465;



        //Vous devez bien sur choisir un moyen d'envoi mais pas les trois en même temps

        $mail->IsHTML(false); // si votre message est au format HTML

        $mail->From='ddfp.louisarmand@ac-nantes.fr'; // votre adresse
        $mail->FromName='Administrateur Application Mini-Stage'; // votre nom
        $mail->AddAddress($mailEta['mailetab']); // adresse du destinataire

        $mail->AddReplyTo('ddfp.louisarmand@ac-nantes.fr');    // adresse de retour
        $mail->Subject='Ministage44 / Mot de passe oublié'; // sujet de votre message
        $mail->Body=utf8_decode("Vous avez demandé vos informations personnelles sur le site de réservation de mini-stages des Lycées Publics Professionnels et Technologiques de Loire Atlantique.\r\nIdentifiant : ".$_POST['rne']."\r\nMot de Passe : ".$pass." "); //pour un message HTML ne pas oubliez IsHTML(true)

        if(!$mail->Send()){ // on teste la fonction Send() -> envoyer
            echo $mail->ErrorInfo; //Affiche le message d'erreur
        }
        else{
        }
        $mail->SmtpClose(); // à supprimer si vous n'utilisez pas SMTP
        unset($mail);



    }
    else
    {
        $mailetab=false;
    }

    return $mailEta['mailetab'];




}

//Formations qui ne sont pas affectés à l'établissement de l'utilisateur
function getFormationsNotInProfil(){
    global $mysqli;

    $rqt = 'select f.idformation, concat(tf.nomcourt_typeformation, " ", f.nom_formation) as nom_formation from t_formation f 
inner join t_typeformation as tf on f.idtypeform = tf.idtypeform
left join t_formation_compte as fc on fc.idformation=f.idformation
where fc.idcompte is null or fc.idcompte != '.$_SESSION['IdUtilisateur'].' ORDER BY nom_formation';

    $Formations= $mysqli->query($rqt) or exit(mysqli_error($mysqli));

    return $Formations;


}
//Formations qui sont affectés à l'établissement de l'utilisateur

function getFormationsInProfil(){
    global $mysqli;

    $rqt = 'select f.idformation, concat(tf.nomcourt_typeformation, " ", f.nom_formation) as nom_formation from t_formation f 
    inner join t_typeformation as tf on f.idtypeform = tf.idtypeform
left join t_formation_compte as fc on fc.idformation=f.idformation
where fc.idcompte = '.$_SESSION['IdUtilisateur'].' ORDER BY nom_formation';

    $Formations= $mysqli->query($rqt) or exit(mysqli_error($mysqli));

    return $Formations;

}
//Liste des professeurs qui sont liés à un compte
function getProfesseursInProfil(){
    global $mysqli;

    $rqt = 'select p.idProf, p.nom_prof, p.prenom_prof, p.civilite, p.idetab from t_professeur as p natural join t_compte as tc
        where tc.idcompte = '.$_SESSION['IdUtilisateur'];

    $Professeurs= $mysqli->query($rqt) or exit(mysqli_error($mysqli));

    return $Professeurs;
}

//Obtention du logo
function getLogo(){
    global $mysqli;

    $rqt = 'select logo from t_etablissement
natural join t_compte c
where c.idcompte= '.$_SESSION['IdUtilisateur'];

    $logo= $mysqli->query($rqt) or exit(mysqli_error($mysqli));

    return $logo;

}

//Obtention du cachet de l'établissement
function getSignature(){
    global $mysqli;

    $rqt = 'select cachet from t_etablissement
natural join t_compte c
where c.idcompte= '.$_SESSION['IdUtilisateur'];

    $sign= $mysqli->query($rqt) or exit(mysqli_error($mysqli));

    return $sign;

}
