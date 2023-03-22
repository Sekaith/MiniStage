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
$idetab = isset($Profil["idetab"]) ? $Profil["idetab"] : "";
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
								value = "' . $identifiant . '" required ></td>
								
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
    <span class="span7 text-center" style="margin-left: 17.5%"><button onClick="AjouterFormation(' . $idcompte . ')" class="btn btn-primary btn-sucess">Ajouter formation</button></br></span>
       
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
            if ($_SESSION["IdProfil"] == 2 || $_SESSION["IdProfil"] == 4) {

                $pageProfil->corps .= '
<div class="panel-white">
	<div class="panel-heading">
		<h4 class="panel-title"><p><center>Gestion des images de la convention</center></p></h4>
	</div>
	    <div class="panel-body">
<table class="table" style="text-align: center">
    <th style="text-align: center">Logo établissement</th>
    <th style="text-align: center">Signature établissement</th>
    
    <tr>
    
    ';
                //Logo
                $pageProfil->corps .= '      
        <td>
  <div> 
<span class="changer_image_profil">
  <label for="image_uploadsLogo" style="cursor: pointer; margin-bottom: 0px;">Sélectionner l\'image à modifier ! </label>
</span>    <input type="file" id="image_uploadsLogo" name="image_uploadsLogo" accept=".jpg, .jpeg, .png" class="inputLogo">
  </div>
  <div class="previewLogo">';

                $logo = getLogo();
                $data = mysqli_fetch_array($logo);

                if(!empty($data[0])){
                    $pageProfil->corps .= '
    <img src="../image/logos/' . $data[0] . '"  style="max-block-size: 300px; size: 300px; max-height:300px;max-width:300px"/>
  </div>
  
  
  </td>
';
                }else{
                    $pageProfil->corps .= '
<span>Vous n\'avez pas encore d\'image !</span>
  </div></td>
';
                }

                //signature
                $pageProfil->corps .= '  
                <td>
  <div> 
<span class="changer_image_profil">
  <label for="image_uploadsSignature" style="cursor: pointer; margin-bottom: 0px;">Sélectionner l\'image à modifier ! </label>
</span>    
<input type="file" id="image_uploadsSignature" name="image_uploadsSignature" accept=".jpg, .jpeg, .png" class="inputSignature">
  </div>
  <div class="previewSignature">';

                $signature = getSignature();
                $data = mysqli_fetch_array($signature);
                if(!empty($data[0])){
                $pageProfil->corps .= '
    <img src="../image/signatures/' . $data[0] . '"  style="max-block-size: 300px; size: 300px; max-height:300px;max-width:300px"/>
  </div>
  
  </td>
';
 }else{
                    $pageProfil->corps .= '
<span>Vous n\'avez pas encore d\'image !</span>
  </div></td>
';
                }

                $pageProfil->corps .= '  
    </tr>
    <tr>
    <td style="border-top: 0px">
          <div>
      <span><i>Les dimensions doivent être de 300px par 300px</i></span>
</div>
        <div><br>
        <button class="btn btn-primary btn-sucess" onClick="AjouterLogo('.$idetab.')">Envoyer</button>
      </div>

  </td>
    <td style="border-top: 0px">
              <div>
      <span><i>Les dimensions doivent être de 300px par 300px</i></span>
</div>
        <div><br>
        <button class="btn btn-primary btn-sucess" onClick="AjouterSignature('.$idetab.')">Envoyer</button>
      </div>
  </td>
</tr>
</table>';


                $pageProfil->corps .= "<script>

var inputLogo = document.querySelector('.inputLogo');
var previewLogo = document.querySelector('.previewLogo');

var inputSignature = document.querySelector('.inputSignature');
var previewSignature = document.querySelector('.previewSignature');


inputLogo.style.opacity = 0;
inputSignature.style.opacity = 0;

inputLogo.addEventListener('change', updateImageDisplayLogo);
inputSignature.addEventListener('change', updateImageDisplaySignature);

function updateImageDisplayLogo() {
  while(previewLogo.firstChild) {
    previewLogo.removeChild(previewLogo.firstChild);
  }

  var curFiles = inputLogo.files;

  
  if(curFiles.length === 0) {
    var para = document.createElement('p');
    para.textContent = 'Pas d\'image encore séléctionnée !';
    previewLogo.appendChild(para);
  } else {
    var list = document.createElement('ol');
    previewLogo.appendChild(list);
      
      if(validFileType(curFiles[0])) {
            var image = document.createElement('img');
            image.setAttribute('style', 'max-height:300px;max-width:300px;max-block-size: 300px; size: 300px;')

            image.src = window.URL.createObjectURL(curFiles[0]);
            list.appendChild(image);

      } else {    
            var para = document.createElement('p');
            para.textContent = 'Image ' + curFiles[0].name + ': Ce n\'est pas un bon format de fichier. Merci de le modifier.';
            list.appendChild(para);
            
    }
  }
}


function updateImageDisplaySignature() {
  while(previewSignature.firstChild) {
    previewSignature.removeChild(previewSignature.firstChild);
  }

  var curFiles = inputSignature.files;

  
  if(curFiles.length === 0) {
    var para = document.createElement('p');
    para.textContent = 'Pas d\'image encore séléctionnée !';
    previewSignature.appendChild(para);
  } else {
    var list = document.createElement('ol');
    previewSignature.appendChild(list);
      
      if(validFileType(curFiles[0])) {
            var image = document.createElement('img');
            image.setAttribute('style', 'max-height:300px;max-width:300px;max-block-size: 300px; size: 300px;')

            image.src = window.URL.createObjectURL(curFiles[0]);
            list.appendChild(image);

      } else {    
            var para = document.createElement('p');
            para.textContent = 'Image ' + curFiles[0].name + ': Ce n\'est pas un bon format de fichier. Merci de le modifier.';
            list.appendChild(para);
            
    }
  }
}

var fileTypes = [
  'image/jpeg',
  'image/jpg',
  'image/pjpeg',
  'image/png'
]

function validFileType(file) {
  for(var i = 0; i < fileTypes.length; i++) {
    if(file.type === fileTypes[i]) {
      return true;
    }
  }

  return false;
}

</script>";

            }

            break;

        case "5":
            // Gestion des professeurs
            if ($_SESSION["IdProfil"] == 2 ) {

                $pageProfil->corps .= '
<div class="panel-white">
	<div class="panel-heading">
		<h4 class="panel-title"><p><center>Professeurs</center></p></h4>
	</div>
	<div class="panel-body">      	
        
        </br>
        <a href="ajoutPROF.php"><button class="btn btn-primary btn-sucess">Ajouter professeur</button></a></br>
       </br>
        	<table class="table" width="600" height="100" style="text-align: center;" >
                    <thead>
                			<th style="text-align: left;">Liste des professeur de l\'établissement : </th>
                			<th style="text-align: center;">Action</th>
                    </thead>
              
                    ';

                $professeurs = getProfesseursInProfil();

                while ($data = mysqli_fetch_array($professeurs)) {

                    $pageProfil->corps .=
                        '<tr id="td' . $data['idProf'] . '"> 
<td style="text-align: left;"> ' . $data["nom_prof"] . ' ' . $data["prenom_prof"] . '</td>
<td> 
<a href="">
        <IMG SRC="image/trash.png" width="25" height="25" title="Supprimer le professeur de l\'établissement"
        id="imgedit' . $data['idProf'] . '" onClick="SupprimerProfesseur(' . $data['idProf'] . ',' . $idetab . ' )"</a></td>
</tr>';
                }
                $pageProfil->corps .= '             
       </div>
	</div>
';
            }
            break;

        case "6" :
            $pageProfil->corps .= ' 
                        <li><a href="stats.php?sbool=1"> <button align="centers" class="btn btn-success">Mini_stages par formation</button></a></li> </br>
                        <li><a href="stats.php?sbool=2"><button align="centers" class="btn btn-success">Nombre de places par formation</button></a></li> </br>
                        <li><a href="stats.php?sbool=3"><button align="centers" class="btn btn-success">Nombre de réservations par formation</button></a></li> </br>
                        <li><a href="stats.php?sbool=4"><button align="centers" class="btn btn-success">Classement des établissements par réservation</button></a></li> </br>
                        <li><a href="stats.php?sbool=5"><button align="centers" class="btn btn-success">Classement des établissements par réservation annulée</button></a></li> </br>
                        <li><a href="stats.php?sbool=6"><button align="centers" class="btn btn-success">Classement des établissements par nombre d\'absences</button></a></li> </br>
                        <li><a href="stats.php?sbool=7"><button align="centers" class="btn btn-success">Nombre de réservations par formation de votre établissement</button></a></li>'
            ;
            break;
    }
}


$pageProfil->afficher();

?>

