<?php
session_start();
if(is_null($_SESSION['ID']))
{header('Location: index.php');}

require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
include_once('requete/rqtCreation.php');
include_once('requete/rqtModifMS.php');

$pageAjoutMS = new page_base('Créer un Mini-stage');

if(!empty($_POST['place']))
{insertMinistage();
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    	window.alert(\"Création du ministage réussi \")
    	window.location.href='ListeMS.php';
		</SCRIPT>");
}

$MS=get_MS();
$prenomProf = isset($MS['prenomProf']) ? $MS['prenomProf'] : "";


$pageAjoutMS->corps .= '

<a href="ListeMS.php"><button align="centers" class="btn btn-success">Retour</button></a></br></br>

<div class="panel-white">
	<div class="panel-heading">
    <h3 class="panel-title">Créneau</h3>
    </div>
	<div class="panel-body">
		<form  class=" form-horizontal" action="dupliMS.php" method="post" 
		id="formulaireCreerMS" name="formulaireCreerMS" onsubmit="return validerCreer()">
		
		        <div style="display:none" ><input type="text" id="id" name="id" value="'.$MS['id'].'"></div>
		        
		        <div style="display:none" ><input type="text" id="formation" name="formation" value="'.$MS['idformation'].'"></div>
				
				<div class="form-group">
				<label for="input-Default"  class="col-sm-2 control-label">Formation</label>
				<div class="col-sm-10">
					<input size="120" type="text" readonly id="tformation" name="tformation" tabindex="-1"
					 required value=" '.$MS["typeformation"].' '.$MS["formation"].' ">
					 </div>
					 </div>
				
				
				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label">Date</label>
					<div class="col-sm-10">
						<input size="25" type="date" class="col-sm-2 control-label" id="date" 
						name="date" required value="'.$MS['dateFR'].'">
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
						<input size="25" type="number" class="col-sm-2 control-label" id="place" name="place" 
						required onchange="verifplace(this)" onblur="verifNB(this)" value="'.$MS['nbplace'].'"/>
					</div>
				</div>

				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label">lieu</label>
					<div class="col-sm-10">
						<input size="25" type="text" class="col-sm-4 control-label" id="lieu" name="lieu"
						onblur="MAJ(this)" value="'.$MS['lieu'].'"/>
					</div>
				</div>
				
				<div style="display:none" ><input type="text" id="professeur" name="professeur" value="'.$MS['idprof'].'"></div>
				
				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label">Professeur en charge</label>
					<div class="col-sm-10">
					<select name="civilite" readonly class="form-control" onchange="verifList(this)" style="width:150px" id="civilite" value="'.$prenomProf.'">
							<option readonly value="M.">M.</option>
							<option readonly value="Mme">Mme</option>
						</select>
						<input size="25" type="text" readonly class="col-sm-2 control-label" id="nomprof" name="nomprof" 
						placeholder="Nom" onblur="MAJ(this)" value="'.$MS['nomProf'].'"/>
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