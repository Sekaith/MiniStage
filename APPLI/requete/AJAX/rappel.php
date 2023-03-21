<?php

require_once('../../Class/autoload.php');
require_once('../../Class/Connexion.class.php');
require "../../phpmailer/class.phpmailer.php";
require "../../phpmailer/class.smtp.php";
require "../../phpmailer/class.pop3.php";

//Notifier si on a fait un rappel à l'établissement pour avoir la convention d'un élève
if (isset($_POST['id'])) {
    global $mysqli;
    $rqt = "UPDATE t_reservation SET rappel = 1 WHERE id = " . $_POST['id'];
    $rappel = $mysqli->query($rqt);

    /*recup information pour mail*/
    /*
 $rqt = 'Select uO.mail as destinataire,
        u.nom as nomoffrant, u.prenom as prenomoffrant, u.nometab, u.mail as expediteur, t.nom as type,
        r.prenom, r.nom,
        DATE_FORMAT(date, "%d-%m-%Y") AS date, f.nom as formation, tf.nom as typeformation
        From t_reservation as r inner join t_utilisateur as uO on r.idreservant=uO.id
        inner join t_ministage as m on r.idmini=m.id
        inner join t_utilisateur as u on m.idOffrant=u.id
        inner join t_formation as f on f.id=m.idformation
        inner join t_typeformation as tf on f.idtype=tf.id
        inner join t_typeetab as tyO on uO.idtype=tyO.id
        inner join t_typeetab as t on t.id=u.idtype
        where r.id= '.$_POST['id'].'';

 */

    $rqt = 'Select cRes.mail_compte as destinataire,
			cOff.nom_compte as nomoffrant, cOff.prenom_compte as prenomoffrant, eOff.nometab, eOff.mailetab as expediteur,  tyRes.nom_typeetab as type,
			r.prenom_eleve as prenom, r.nom_eleve as prenom,
			DATE_FORMAT(m.date, "%d-%m-%Y") AS date, f.nom_formation as formation, tf.nom_typeformation as typeformation 
From t_reservation as r
inner join t_compte as cRes on cRes.idcompte = r.idReservant
inner join t_etablissement eRes on eRes.idetab=cRes.idetab
inner join t_ministage as m on r.idministage=m.idministage
inner join t_compte as cOff on cOff.idcompte = m.idOffrant
inner join t_etablissement eOff on eOff.idetab=cOff.idetab
inner join t_formation as f on f.idformation=m.idformation
inner join t_typeformation as tf on f.idtypeform=tf.idtypeform
inner join t_typeetab as tyOff on eOff.idtypeetab=tyOff.idtypeetab
inner join t_typeetab as tyRes on tyRes.idtypeetab=eRes.idtypeetab
where r.idreserv= ' . $_POST['id'];


    $data = mysqli_query($mysqli, $rqt) or exit(mysqli_error());
    $mail = $data->fetch_assoc();

    $expediteur = $mail['expediteur'];
    $destinataire = $mail['destinataire'];
    $prenom = $mail['prenom'];
    $nom = $mail['nom'];
    $type = $mail['type'];
    $nometab = $mail['nometab'];
    $nomoffrant = $mail['nomoffrant'];
    $prenomoffrant = $mail['prenomoffrant'];
    $date = $mail['date'];
    $formation = $mail['formation'];
    $typeformation = $mail['typeformation'];

    //Ensuite on débute l'envoi de mail

    $mail = new PHPmailer();

    //Pour un envoi par SMTP

    $mail->IsSMTP(); // spécifie que le mail sera envoyé sur un serveur SMTP
    $mail->SMTPAuth = true;
    //$mail->Host='smtp-heberg.ac-nantes.fr'; // Spécifie l'hôte SMTP auquel il faut se connecter.
    //$mail->Username = "heberg-0490003M"; // GMail username (including @gmail.com)
    //$mail->Password = "ZpMk8==";
    //$mail->Port = 465;


    //Vous devez bien sur choisir un moyen d'envoi mais pas les trois en même temps

    $mail->IsHTML(false); // si votre message est au format HTML

    $mail->From = $expediteur; // votre adresse
    $mail->FromName = 'Administrateur Application Mini-Stage'; // votre nom
    $mail->AddAddress($destinataire); // adresse du destinataire

    $mail->AddReplyTo($expediteur);    // adresse de retour
    $mail->Subject = 'Rappel Convention Mini-stage '; // sujet de votre message
    $mail->Body = utf8_decode("Bonjour\r\nSauf erreur de notre part, nous n'avons pas reçu la convention de " . $prenom . " " . $nom . " pour le mini stage en " . $typeformation . " " . $formation . " du " . $date . " au " . $type . " " . $nometab . ".\r\nMerci de nous la retourner ou de désinscrire votre élève.\r\nSans retour rapide, nous supprimerons la réservation afin de liberer la place pour un autre élève.\r\nCordialement\r\n" . $prenomoffrant . " " . $nomoffrant . "");
    //pour un message HTML ne pas oubliez IsHTML(true)

    if (!$mail->Send()) { // on teste la fonction Send() -> envoyer
        echo $mail->ErrorInfo; //Affiche le message d'erreur
    }

    $mail->SmtpClose(); // à supprimer si vous n'utilisez pas SMTP
    unset($mail);


    //echo print_r($mail);

}
?>