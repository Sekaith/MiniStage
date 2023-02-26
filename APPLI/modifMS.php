<?php
session_start();
if(is_null($_SESSION['ID']))
{header('Location: index.php');}

require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
include_once('requete/rqtModifMS.php');

$pagemodifMS = new page_base('Modification d\'un mini-stage');

if(!empty($_POST['place']))
{updateMS();
echo ("<SCRIPT LANGUAGE='JavaScript'>
    	window.alert(\"Modification du ministage réussi \")
    	window.location.href='ListeMS.php';
		</SCRIPT>");
}

$MS=get_MS();

$prenomProf = isset($MS['prenomProf']) ? $MS['prenomProf'] : "";

$pagemodifMS->corps .= '
  
  <a href="ListeMS.php"><button align="centers" class="btn btn-success">Retour</button></a></br></br>

<div class="panel-white">
	<div class="panel-heading">
    <h3 class="panel-title">Créneau</h3>
    </div>
	<div class="panel-body">
		<form  class=" form-horizontal" action="modifMS.php" method="post" 
		id="formulaireModifMS" name="formulaireModifMS" onsubmit="return validerModifMS()">
				
				'/*on reprend l'id pour l'utiliser dans la requete update*/.'
				
				<div style="display:none" ><input type="text" id="id" name="id" value="'.$MS['id'].'"></div>
				
				<div class="form-group">
				<label for="input-Default"  class="col-sm-2 control-label">Formation</label>
				<div class="col-sm-10">
					<input size="120" type="text" disabled id="formation" name="formation"
					 required value="'.$MS['typeformation'].' '.$MS['formation'].'">
            		</div></div>
				
				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label">Date</label>
					<div class="col-sm-10">
						<input size="25" type="text" class="col-sm-2 control-label" id="date" 
						name="date" required value="'.$MS['dateFR'].'">
					</div>
				</div>
				
				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label">Horaires</label>
					<div class="col-sm-10">
						<input size="25" type="text" class="col-sm-2 control-label" id="heure1" 
						placeholder="début"  name="heure1" required value="'.$MS['hdebut'].'"/>
						<input size="25" type="text" id="heure2" class="col-sm-2 control-label" 
						placeholder="fin" name="heure2" required" value="'.$MS['hfin'].'"/> 
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
				
				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label">Professeur en charge</label>
					<div class="col-sm-10">
					<select name="civilite" class="form-control" onchange="verifList(this)" style="width:150px" id="civilite" value="'.$prenomProf.'">
							<option value="M.">M.</option>
							<option value="Mme">Mme</option>
						</select>
						<input size="25" type="text" class="col-sm-2 control-label" id="nomprof" name="nomprof" 
						placeholder="Nom" onblur="MAJ(this)" value="'.$MS['nomProf'].'"/>
					</div>
				</div>
				
				<div id="placeO" style="display:none">'.$MS['nbplace'].'</div>
				
				<div align="center">
					<button type="submit" class="btn btn-sm btn-primary">Modifier</button>
                </div>
			</form>
	</div>
</div>


';

$pagemodifMS->afficher();

?>