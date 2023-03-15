<?php
session_start();

if (is_null($_SESSION['ID'])) {
    header('Location: index.php');
}

require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
include_once('requete/rqtProf.php');
include_once('requete/rqtProfil.php');

$pageAjoutProf = new page_base('Ajouter un professeur');

$Profil = get_profil();

$idetab = isset($Profil["idetab"]) ? $Profil["idetab"] : "";



if (!empty($_POST['nomprof'])) {
    insertProfesseur();
    echo("<SCRIPT LANGUAGE='JavaScript'>
    	window.alert(\"Ajout du professeur réussi \")
    	window.location.href='profil.php?pbool=5';
		</SCRIPT>");
}

$pageAjoutProf->corps .= '

<a href="profil.php?pbool=5"><button align="centers" class="btn btn-success">Liste des professeurs</button></a></br></br>

<div class="panel-white">
	<div class="panel-heading">
    <h3 class="panel-title">Professeur</h3>
    </div>
	<div class="panel-body">
		<form  class=" form-horizontal" action="ajoutPROF.php" method="post" 
		id="formulaireAjoutProf" name="formulaireAjoutProf" onsubmit="return validerCreer()">
		
		 <div style="display:none" ><input type="text" id="idetab" name="idetab" value="'.$idetab.'"></div>
		
				<div class="form-group">
					<div class="col-sm-10">
						Civilite :<select name="civilite" class="form-control" onchange="verifList(this)" style="width:150px" id="civilite"" >
                        <option value="-1">--Sélectionner--</option>
							<option value="M.">M.</option>
							<option value="Mme">Mme</option>
						</select>
						</br>
						<input size="25" type="text" value="" class="col-sm-2 control-label" id="nomprof" name="nomprof" 
						placeholder="Nom" onblur="verifChaine(this)"/>
						<input size="25" type="text" value="" class="col-sm-2 control-label" id="prenomprof" name="prenomprof" 
						placeholder="Prenom" onblur="verifChaine(this)"/>
						
					</div>
				</div>
				
				<div align="center">
					<button type="submit" class="btn btn-success ">Ajouter</button>
                </div>
			</form>
	</div>
</div>


';

$pageAjoutProf->afficher();

?>
