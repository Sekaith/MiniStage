<?php
session_start();
if (is_null($_SESSION['ID'])) {
    header('Location: index.php');
}

require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
include_once('requete/rqtProfil.php');

$pageProfil = new page_base('Profil');

if (isset($_POST['mdp'])) {
    updateProfil();
}

if (isset($_POST['cp'])) {
    updateEtab();
}


$Profil = get_profil();

$prenom = isset($Profil['prenom']) ? $Profil['prenom'] : "";
$idcompte = isset($Profil['id']) ? $Profil['id'] : "";
$nom = isset($Profil['nom']) ? $Profil['nom'] : "";
$identifiant = isset($Profil["identifiant"]) ? $Profil['identifiant'] : "";
$mdp = isset($Profil["mdp"]) ? $Profil['mdp'] : "";
$mail = isset($Profil["mail"]) ? $Profil["mail"] : "";
$tel = isset($Profil["tel"]) ? $Profil["tel"] : "";
$idfonction = isset($Profil["idfonction"]) ? $Profil["idfonction"] : "";
$mailetab = isset($Profil["mailetab"]) ? $Profil["mailetab"] : "";
$nomType = isset($Profil['nomtype']) ? $Profil['nomtype'] : "";
$nomEtab = isset($Profil['nometab']) ? $Profil['nometab'] : "";
$ville = isset($Profil["ville"]) ? $Profil["ville"] : "";
$cp = isset($Profil["cp"]) ? $Profil["cp"] : "";
$adresse = isset($Profil["adresse"]) ? $Profil["adresse"] : "";

if (isset($_GET["pbool"])) {

    switch ($_GET["pbool"]) {

        case "1":

            $pageProfil->corps .= '
<div class="panel-white">
	<div class="panel-heading">
		<h4 class="panel-title"><p><center>Utilisateur : ' . $prenom . ' ' . $nom . '</center></p></h4>
	</div>
	<div class="panel-body">
		
				<form  action="profil.php" method="post" name="formulaireProfil" onsubmit="return validerProfil()" align=center>
					<table class="table" width="600" height="100" style="text-align: center;" >
                		<thead>
                			<p>
                			<th style="text-align: center;">Identifiant</th>
                			<th style="text-align: center;">Mot de passe</th>
                			<th style="text-align: center;">Nom</th>
                			<th style="text-align: center;">Prénom</th>
							<th style="text-align: center;">Fonction</th>
                			<th style="text-align: center;">Mail</th>
                			<th style="text-align: center;">Téléphone</th>
                			</p>
						</thead>
				
						<tr>
							<td><input type="text" name="id" style="text-align : center" class="form-control" id="id" 
								value = "' . $identifiant . '" required disabled></td>
								
                			<td><input type="text" name="mdp" style="text-align : center" class="form-control" id="mdp" 
								value = "' . $mdp . '" required></td>
								
                			<td><input type="text" name="nom" style="text-align : center" class="form-control" id="nom" 
								value = "' . $nom . '" onblur="verifChaine(this);MAJ(this);" required></td>
								
                			<td><input type="text" name="prenom" style="text-align : center" class="form-control" id="prenom" 
								value = "' . $prenom . '" onblur="verifChaine(this);Maj(this);" required></td>
								
							<td><select name="fct" id="fct" required>
							';
            $fct = get_fonction();
            while ($data = mysqli_fetch_array($fct)) {
                if ($data["idfonction"] == $idfonction) {
                    $pageProfil->corps .= '<option selected value=' . $data["idfonction"] . '>' . $data["nom_fonct"] . '</option>';
                } else {
                    $pageProfil->corps .= '
								<option value=' . $data["idfonction"] . '>' . $data["nom_fonct"] . '</option>';
                }
            }

            $pageProfil->corps .= '</select></td>
								
                			<td><input type="text" name="mail" style="text-align : center" class="form-control" id="mail" 
								value = "' . $mail . '" onblur="verifMail(this)" required></td>
								
                			<td><input type="text" name="tel" style="text-align : center" class="form-control" id="tel" 
								value = "' . $tel . '" onblur="verifTel(this)" required></td>
						</tr>
					</table>
					<br/> <br/>
					<div class="span7 text-center"><button type="submit" class="btn btn-primary btn-sucess">Modifier</button></br></div>
				</form>
	</div>
</div>
';
            break;

        case "2":
            if ($_SESSION["IdProfil"] == 2 || $_SESSION["IdProfil"] == 4) {
                $pageProfil->corps .= '
<div class="panel-white">
	<div class="panel-heading">
		<h4 class="panel-title"><p><center>Etablissement : ' . $nomType . ' ' . $nomEtab . '</center></p></h4>
	</div>
	<div class="panel-body">
		
				<form  action="profil.php" method="post" name="formulaireEtab" onsubmit="return validerEtab()" align=center>
					<table class="table" width="600" height="100" style="text-align: center;" >
                		<thead>
                			<p>
                			<th style="text-align: center;">Type</th>
                			<th style="text-align: center;">Nom</th>
                			<th style="text-align: center;">Ville</th>
                			<th style="text-align: center;">Code Postal</th>
                			<th style="text-align: center;">Adresse</th>';
                if ($_SESSION["IdProfil"] == 4) {
                    $pageProfil->corps .= '
							<th style="text-align: center;">Mail</th>';
                }
                $pageProfil->corps .= '
                			</p>
						</thead>
				
						<tr>
							<td><select name="type" id="type" required>
							';
                $type = get_type();
                while ($data = mysqli_fetch_array($type)) {
                    if ($data["nom_typeetab"] == $nomType) {
                        $pageProfil->corps .= '<option selected value=' . $data["idtypeetab"] . '>' . $data["nom_typeetab"] . '</option>';
                    } else {
                        $pageProfil->corps .= '
								<option value=' . $data["idtypeetab"] . '>' . $data["nom_typeetab"] . '</option>';
                    }
                }

                $pageProfil->corps .= '</select></td>
								
                			<td><input type="text" name="nometab" style="text-align : center" class="form-control" id="nometab" 
								value = "' . $nomEtab . '" onblur="verifChaine(this);MAJ(this)" required></td>
								
                			<td><input type="text" name="ville" style="text-align : center" class="form-control" id="ville" 
								value = "' . $ville . '" onblur="verifChaine(this);MAJ(this)" required></td>
								
                			<td><input type="text" name="cp" style="text-align : center" class="form-control" id="cp" 
								value = "' . $cp . '" onblur="verifCP(this)" required></td>
								
                			<td><input type="text" name="adresse" style="text-align : center" class="form-control" id="adresse" 
								value = "' . $adresse . '" onblur="" required></td>';

                if ($_SESSION["IdProfil"] == 4) {
                    $pageProfil->corps .= '
							<td><input type="text" name="mailetab" style="text-align : center" class="form-control" id="mailetab" 
								value = "' . $mailetab . '" onblur="verifMail(this)" required disabled>
								<p class="help-block"><i class="fa fa-question-circle">
								</i> Toutes les informations seront</br>envoyées à cette adresse.</p></td>';
                }
                $pageProfil->corps .= '
						</tr>
					</table>
					<br/>
					<div class="span7 text-center"><button type="submit" class="btn btn-primary btn-sucess">Modifier</button></br></div>
				</form>
	</div>
</div>

';
            }

            break;
        case "3":

            if ($_SESSION["IdProfil"] == 2 || $_SESSION["IdProfil"] == 4) {

                $pageProfil->corps .= '
<div class="panel-white">
	<div class="panel-heading">
		<h4 class="panel-title"><p><center>Formations proposées :</center></p></h4>
	</div>
	<div class="panel-body">      	

        <select name="fct_select" id="fct_select" style="margin-left: 5%" required>
        <option value="-1">--Choix de la formation à ajouter--</option>';

                $formations = getFormationsNotInProfil();
                while ($data = mysqli_fetch_array($formations)) {

                    $pageProfil->corps .= '
								<option value=' . $data["idformation"] . '>' . $data["nom_formation"] . '</option>';

                }

                $pageProfil->corps .= '</select>
    <span class="span7 text-center" style="margin-left: 17.5%"><button onClick="AjouterFormation('.$idcompte.')" class="btn btn-primary btn-sucess">Ajouter formation</button></br></span>
       
        	<table class="table" width="600" height="100" style="text-align: center;" >
                    <thead>
                			<th style="text-align: left;">Liste des formations disponibles dans l\'établissement : </th>
                			<th style="text-align: center;">Action</th>
                    </thead>
                    
                    ';

                $formations = getFormationsInProfil();

                while ($data = mysqli_fetch_array($formations)) {

                    $pageProfil->corps .=
                        '<tr id="td' . $data['idformation'] . '"> 
<td style="text-align: left;"> ' . $data["nom_formation"] . ' </td>
<td> 
<a href="">
        <IMG SRC="image/trash.png" width="25" height="25" title="Supprimer la formation"
        id="imgedit' . $data['idformation'] . '" onClick="SupprimeFormation(' . $data['idformation'] . ',' . $idcompte . ' )"</a></td>
</tr>';
                }
                $pageProfil->corps .= '             
       </div>
	</div>
';
            }
            break;

        case "4":

            //gestion des logos


            break;
    }
}


$pageProfil->afficher();

?>

