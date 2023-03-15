<?php
session_start();

if (is_null($_SESSION['ID'])) {
    header('Location: index.php');
}

require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
include_once('requete/rqtCreation.php');
include_once('requete/rqtProfil.php');

$pageAjoutMS = new page_base('Créer un Mini-stage');

if (!empty($_POST['place'])) {
    insertMinistage();
    echo("<SCRIPT LANGUAGE='JavaScript'>
    	window.alert(\"Création du ministage réussi \")
    	window.location.href='accueil.php';
		</SCRIPT>");
}

$pageAjoutMS->corps .= '

<a href="ListeMS.php"><button align="centers" class="btn btn-success">Liste des mini_stages</button></a></br></br>

<div class="panel-white">
	<div class="panel-heading">
    <h3 class="panel-title">Créneau</h3>
    </div>
	<div class="panel-body">
		<form  class=" form-horizontal" action="ajoutMS.php" method="post" 
		id="formulaireCreerMS" name="formulaireCreerMS" onsubmit="return validerCreer()">
				
				<div class="form-group">
				<label for="input-Default"  class="col-sm-2 control-label">Formation</label>
				<div class="col-sm-10"><SELECT name="formation" class="form-control" tabindex="-1" 
				id=formation onchange="verifList(this)">
            		<option value="-1">--Choix de la formation--</option>
					';

                $formation = get_formation(1); //bacpro
                if ($formation->num_rows != 0) {
                    $pageAjoutMS->corps .= '<optgroup label="BAC PROFESSIONNEL">';
                    while ($data = mysqli_fetch_array($formation)) {
                        $pageAjoutMS->corps .= ' <option value="' . $data["id"] . '">' . $data["typeformation"] . ' ' . $data["nom"] . '</option>';
                    }
                    $pageAjoutMS->corps .= '</optgroup>';
                }

$formation = get_formation(2); //bacpro
if ($formation->num_rows != 0) {
    $pageAjoutMS->corps .= '<optgroup label="CAP">';
    while ($data = mysqli_fetch_array($formation)) {
        $pageAjoutMS->corps .= ' <option value="' . $data["id"] . '">' . $data["typeformation"] . ' ' . $data["nom"] . '</option>';
    }
    $pageAjoutMS->corps .= '</optgroup>';
}

$formation = get_formation(3); //bacpro
if ($formation->num_rows != 0) {
    $pageAjoutMS->corps .= '<optgroup label="BAC TECHNOLOGIQUE">';
    while ($data = mysqli_fetch_array($formation)) {
        $pageAjoutMS->corps .= ' <option value="' . $data["id"] . '">' . $data["typeformation"] . ' ' . $data["nom"] . '</option>';
    }
    $pageAjoutMS->corps .= '</optgroup>';
}
$formation = get_formation(4); //bacpro
if ($formation->num_rows != 0) {
    $pageAjoutMS->corps .= '<optgroup label="BAC GENERAL">';
    while ($data = mysqli_fetch_array($formation)) {
        $pageAjoutMS->corps .= ' <option value="' . $data["id"] . '">' . $data["typeformation"] . ' ' . $data["nom"] . '</option>';
    }
    $pageAjoutMS->corps .= '</optgroup>';
}
$formation = get_formation(5); //bacpro
if ($formation->num_rows != 0) {
    $pageAjoutMS->corps .= '<optgroup label="BTS">';
    while ($data = mysqli_fetch_array($formation)) {
        $pageAjoutMS->corps .= ' <option value="' . $data["id"] . '">' . $data["typeformation"] . ' ' . $data["nom"] . '</option>';
    }
    $pageAjoutMS->corps .= '</optgroup>';
}
$formation = get_formation(6); //bacpro
if ($formation->num_rows != 0) {
    $pageAjoutMS->corps .= '<optgroup label="ENSEIGNEMENT OPTIONNEL">';
    while ($data = mysqli_fetch_array($formation)) {
        $pageAjoutMS->corps .= ' <option value="' . $data["id"] . '">' . $data["typeformation"] . ' ' . $data["nom"] . '</option>';
    }
    $pageAjoutMS->corps .= '</optgroup>';
}
$formation = get_formation(8); //bacpro
if ($formation->num_rows != 0) {
    $pageAjoutMS->corps .= '<optgroup label="ENSEIGNEMENT DE SPECIALITE">';
    while ($data = mysqli_fetch_array($formation)) {
        $pageAjoutMS->corps .= ' <option value="' . $data["id"] . '">' . $data["typeformation"] . ' ' . $data["nom"] . '</option>';
    }
    $pageAjoutMS->corps .= '</optgroup>';
}$formation = get_formation(7); //bacpro
if ($formation->num_rows != 0) {
    $pageAjoutMS->corps .= '<optgroup label="AUTRES">';
    while ($data = mysqli_fetch_array($formation)) {
        $pageAjoutMS->corps .= ' <option value="' . $data["id"] . '">' . $data["typeformation"] . ' ' . $data["nom"] . '</option>';
    }
    $pageAjoutMS->corps .= '</optgroup> ';
}

$pageAjoutMS->corps .= '</SELECT>';/* si la formation n'est pas dans la liste on commmunique les coordonnées de l'admin (le premier de la table si plusieurs) */
$coord = getCoordAdmin();
$pageAjoutMS->corps .= '
								<p class="help-block"><i class="fa fa-question-circle">
								</i> La formation n\'est pas dans la liste ? Contactez l\'administrateur en cliquant sur le téléphone. 
								<a href="#myModal" data-toggle="modal"><IMG SRC="image/phone.png" width="20" height="20"  title="Contact"></a>
								
								' . /*popus*/
    '	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
																aria-labelledby="myModalLabel" aria-hidden="true">
                                                				<div class="modal-dialog">
                                                    				<div class="modal-content">
                                                        				<div class="modal-header">
                                                           					<button type="button" class="close" data-dismiss="modal"
																			 	aria-label="Fermer">
																			 	<span aria-hidden="true">&times;</span>
																			</button>
																			
                                                     <h4 class="modal-title" id="myModalLabel">' . $coord['prenom'] . ' ' . $coord['nom'] . '</h4>
													 
                                                        				</div>
                                                        				<div class="modal-body">
                                                            				
																			<b>Adresse mail : </b>' . $coord['mail'] . ' </br>
																			<b>Numéro de téléphone : </b>' . $coord['tel'] . '
																			
                                                       					 </div>
                                                       					 <div class="modal-footer">
                                                            				<button type="button" class="btn btn-default"
																			 data-dismiss="modal">Fermer</button>
																		 </div>
                                                    				</div>
                                                					</div>
                                            					</div>
								</p>
				</div></div>
				
				
				
				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label">Date</label>
					<div class="col-sm-10">
						<input size="25" type="date"  class="col-sm-2 control-label" id="date" 
						name="date" onBlur="" required>
					</div>
				</div>
				
				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label">Horaires</label>
					<div class="col-sm-10">
						<input size="25" type="text" value="" class="col-sm-2 control-label" id="heure1" 
						placeholder="début"  name="heure1" required/>
						<input size="25" type="text" value="" id="heure2" class="col-sm-2 control-label" 
						placeholder="fin"  name="heure2" required" /> 
					</div>
				</div>
				
				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label">Nombre de places</label>
					<div class="col-sm-10">
						<input size="25" type="number" value="" class="col-sm-2 control-label" id="place" name="place" 
						required  onblur="verifNB(this)"/>
					</div>
				</div>

				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label">lieu</label>
					<div class="col-sm-10">
						<input size="25" type="text" value="" class="col-sm-4 control-label" id="lieu" 
						placeholder="ex : Atelier" name="lieu" required/>
					</div>
				</div>
				
				<div class="form-group">
				<label for="input-Default"  class="col-sm-2 control-label">Professeur en charge</label>
				<div class="col-sm-6"><SELECT name="professeur" class="form-control" tabindex="-1" 
				id=professeur onchange="verifList(this)">
            		<option value="-1">--Choix du professeur--</option>
				';

                $professeurs = getProfesseursInProfil();
                while ($data = mysqli_fetch_array($professeurs)) {
                    $pageAjoutMS->corps .= ' <option value="' . $data["idProf"] . '">' . $data["civilite"] . ' ' . $data["prenom_prof"] .  ' ' . $data["nom_prof"]. '</option>';
                }


    $pageAjoutMS->corps .= '</SELECT>
                    </div>
				</div>
				
				<div align="center">
					<button type="submit" class="btn btn-success ">Créer</button>
                </div>
			</form>
	</div>
</div>


';

$pageAjoutMS->afficher();

?>

