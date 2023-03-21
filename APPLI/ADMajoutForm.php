<?php
session_start();
if(is_null($_SESSION['ID']))
{header('Location: index.php');}

require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
require_once('requete/rqtADM.php');

if(!empty($_POST["nom"]))
{insert_Form();
echo ("<SCRIPT LANGUAGE='JavaScript'>
    	window.alert(\"Formation créée \")
		</SCRIPT>");
}

//Page pour l'ajout d'une formation par un administrateur
$pageAjoutForm = new page_base('Ajout Formation');
$pageAjoutForm->corps .= '


		
		
<form class=" form-horizontal" action="ADMajoutForm.php" method="post" id="formulaire">
    <div class="panel panel-white">
        <div class="panel-heading clearfix">
            <h4 id="titre" class="panel-title">Ajout d\'une formation</h4>
        </div>
        <div class="panel-body">
                    
 				<div class="form-group">
                <label class="col-sm-2 control-label"> Type de la formation </label>
                <div class="col-sm-10">
                    <SELECT name="typeF" class="form-control" id="typeF" onchange="verifList(this)">
							<option value="-1" id="none">--Choix du type de la formation--</option>';
                            //on récupère les types de formations existantes
                            $typeF = get_typeF();
								while($data=mysqli_fetch_array($typeF))
              					{
									$pageAjoutForm->corps .= '<option value="'.$data["idtypeform"].'">'.$data["nom_typeformation"].'</option>';
								}
								$pageAjoutForm->corps .= '
						</SELECT>
                </div>
            </div>
			                 
			<div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Sigle</label>
                <div class="col-sm-10">
					<input type="text" name="sigle" class="form-control" id="sigle" onblur="MAJ(this)"  placeholder="ex : SEN" >
                </div>
            </div>
			
			<div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Nom</label>
                <div class="col-sm-10">
					<input type="text" name="nom" class="form-control" id="nom" 
					placeholder="ex : Systèmes électroniques numériques" required>
                </div>
            </div>
			
			<div align="center">
                <button type="submit" class="btn btn-sm btn-primary">Créer la formation</button>
            </div>
		
		</div> 
    </div>
</form>
';

$pageAjoutForm->afficher();

?>