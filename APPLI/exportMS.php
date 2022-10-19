<?php
session_start();
if(is_null($_SESSION['ID']))
{header('Location: index.php');}

require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
include_once('requete/rqtCreation.php');

$pageExportMS = new page_base('Exporter les mini-stages');

$pageExportMS->corps .= ' 
	<div class="panel-white">
	<div class="panel-heading">
    <h3 class="panel-title">Critères d\'exportation</h3>
    </div>
	<div class="panel-body">
		<form  class=" form-horizontal" action="exportCSV.php" method="post" 
		id="formulaireCreerMS" name="formulaireCreerMS">
				
				<div class="form-group">
				<label for="input-Default"  class="col-sm-2 control-label">Formation (facultatif)</label>
				<div class="col-sm-10"><SELECT name="formation" class="form-control" tabindex="-1" 
				id=formation>
					<option value="-1">--Choix de la formation--</option>
					<optgroup label="BAC PROFESSIONNEL">';
					$Formation= get_formation_export(1,$_SESSION['ID']); //bacpro
					while($data=mysqli_fetch_array($Formation))
              		{
						$pageExportMS->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
					}
					$pageExportMS->corps .='
					</optgroup>

					<optgroup label="CAP">';
					$Formation= get_formation_export(2, $_SESSION['ID']); //cap
					while($data=mysqli_fetch_array($Formation))
              		{
						$pageExportMS->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
					}
					$pageExportMS->corps .='
					</optgroup>
					
					<optgroup label="BAC TECHNOLOGIQUE">';
					$Formation= get_formation_export(3, $_SESSION['ID']); //bactechno
					while($data=mysqli_fetch_array($Formation))
              		{
						$pageExportMS->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
					}
					$pageExportMS->corps .='
					</optgroup>
				
					<optgroup label="BAC GENERAL">';
					$Formation= get_formation_export(4, $_SESSION['ID']); //bacG
					while($data=mysqli_fetch_array($Formation))
              		{
						$pageExportMS->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
					}
					$pageExportMS->corps .='
					</optgroup>
				
					<optgroup label="BTS">';
					$Formation= get_formation_export(5, $_SESSION['ID']); //BTS
					while($data=mysqli_fetch_array($Formation))
              		{
						$pageExportMS->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
					}
					$pageExportMS->corps .='
					</optgroup>
					<optgroup label="Brevet des Métiers d\'Art">';
					$Formation= get_formation_export(7, $_SESSION['ID']); //BMA
					while($data=mysqli_fetch_array($Formation))
              		{
						$pageExportMS->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
					}
					$pageExportMS->corps .='
					</optgroup>					
					<optgroup label="AUTRE">';
					$Formation= get_formation_export(8, $_SESSION['ID']); //autre
					while($data=mysqli_fetch_array($Formation))
              		{
						$pageExportMS->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
					}
					$pageExportMS->corps .='
					</optgroup>					

					</optgroup>
				</SELECT>
				
				</div></div>
				
				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label">Date (facultatif)</label>
					<div class="col-sm-10">
						<input size="25" type="text" class="col-sm-2 control-label" id="date"
						name="date" onBlur="">
					</div>
				</div>
				
				<div align="center">
					<button type="submit" name="export" class="btn btn-success ">Exporter les données (format .csv)</button>
               </div>
			</form></div>
</div>


';

$pageExportMS->afficher();

?>