<?php 
require_once('Class/autoload.php');


	// on v�rifie que le champ "Pseudo" n'est pas vide
    // empty v�rifie � la fois si le champ est vide et si le champ existe belle et bien (is set)
         include("Class/Connexion.class.php");
            // les champs sont bien post� et pas vide, on s�curise les donn�es entr�es par le membre:
            $Pseudo = ($_POST['id']); // le htmlentities() passera les guillemets en entit�s HTML, ce qui emp�chera les injections SQL
            $MotDePasse = htmlentities($_POST['mdp'], ENT_QUOTES, "ISO-8859-1");
            //on se connecte � la base de donn�es:
            
                // on fait maintenant la requ�te dans la base de donn�es pour rechercher si ces donn�es existe et correspondent:
                $Requete = mysqli_query($mysqli,"SELECT * FROM t_utilisateur WHERE identifiant = '".$Pseudo."' AND mdp = '".$MotDePasse."'");
                // si il y a un r�sultat, mysqli_num_rows() nous donnera alors 1
                // si mysqli_num_rows() retourne 0 c'est qu'il a trouv� aucun r�sultat
                if(mysqli_num_rows($Requete) == 0) {
                   
				   echo ("<script>alert('Erreur dans votre identifiant ou votre mot de passe')
				   document.location.href='index.php'
				   </script>"); 
				   
                   
					

                } else {
					
					header('Location: accueil.php');
					session_start();
					
					
/**************************************************ENREGISTREMENTS INFORMATIONS DE SESSIONS**********************************************/
					//Informations de l'utilisateur
					$RqtUtilisateur = "Select * from t_utilisateur
					where identifiant = '".$Pseudo."'";
                    $tabUtilisateur = $mysqli->query ($RqtUtilisateur);
                    $Utilisateur=$tabUtilisateur->fetch_assoc();
                
                    $_SESSION['Nom']=$Utilisateur['nom'];
					$_SESSION['Prenom']=$Utilisateur['prenom'];
					$_SESSION['IdProfil']=$Utilisateur['idprofil'];
					$_SESSION['ID']=$Utilisateur['identifiant'];
					$_SESSION['NomEtab']=$Utilisateur['nometab'];
					$_SESSION['VilleEtab']=$Utilisateur['ville'];
					$_SESSION['CP']=$Utilisateur['cp'];
					$_SESSION['MailEtab']=$Utilisateur['mailetab'];
					$_SESSION['AdresseEtab']=$Utilisateur['adresse'];
					$_SESSION['IdTypeEtab']=$Utilisateur['idtype'];
					$_SESSION['IdUtilisateur']=$Utilisateur['id'];
					$_SESSION['Idrattacher']=$Utilisateur['rattacher'];
					
					
					//Nom du profil
					$RqtProfil = "SELECT * FROM t_profil  WHERE id = '".$_SESSION['IdProfil']."'";
                    $tabProfil = $mysqli->query ($RqtProfil);
                    $Profil=$tabProfil->fetch_assoc();
                    
					$_SESSION['Profil']=$Profil['nom'];
					
					//Nom du type d'�tablissement
					$RqtProfil = "SELECT nom FROM t_typeetab  WHERE id = '".$_SESSION['IdTypeEtab']."'";
                    $tabProfil = $mysqli->query ($RqtProfil);
                    $Profil=$tabProfil->fetch_assoc();
                    
					$_SESSION['TypeEtab']=$Utilisateur['type'];
					
					
					/*
					//Informations l'Etablissement de l'utilisateur
					$RqtEtab = 'Select t.nom as type, e.nom, ville, cp, mailetab, adresse, rne from t_typeetab as t 
					inner join t_etablissement as e on t.id=e.idtype
					inner join t_utilisateur as u on e.id=u.idetab
					where identifiant= "'.$_SESSION['ID'].'" ';
					$tabEtab = $mysqli->query ($RqtEtab);
					$Etab=$tabEtab->fetch_assoc();
                	
					
					$_SESSION['RNE']=$Etab['rne'];
					*/
				}
					
            
?>