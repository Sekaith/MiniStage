<?php
session_start();
if(is_null($_SESSION['ID']))
{header('Location: index.php');}

require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
include_once('requete/rqtADM.php');

$pagemodifForm = new page_base('Modification Formation');

if(!empty($_POST['id']))
{ Modif_Form();
echo ("<SCRIPT LANGUAGE='JavaScript'>
    	window.alert(\"Formation modifiée \")
    	window.location.href='ADMformation.php';
		</SCRIPT>");
}

$Form=get_formModif();

$pagemodifForm->corps .= '

<a href="ADMformation.php"><button align="centers" class="btn btn-success">Retour</button></a></br></br>

<form class=" form-horizontal" action="ADMmodifForm.php" method="post" id="formulaire" style="">
    <div class="panel panel-white">
        <div class="panel-heading clearfix">
            <h4 id="titre" class="panel-title"></h4>
        </div>
        <div class="panel-body">
                    
			'/*pour la requète*/.'
			<div style="display:none"><input type="text" id="id" name="id" value="'.$Form['idformation'].'"></div>	
					               
			<div class="form-group">
                <label class="col-sm-2 control-label"> Type de la formation </label>
                <div class="col-sm-10">
                    <SELECT name="typeF" class="form-control" id="typeF" onchange="verifList(this)">
							<option value="-1" id="none">--Choix du type de la formation--</option>';
                            $typeF= get_typeF();
								while($data=mysqli_fetch_array($typeF))
              					{
									if($data["idtypeform"]==$Form["idtypeform"])
									{
                                        echo $data["idtypeform"];
										$pagemodifForm->corps .= '<option selected value="'.$data["idtypeform"].'">'.$data["nom_typeformation"].'</option>';
									}
									else
									{
										$pagemodifForm->corps .= '
										<option value="'.$data["idtypeform"].'">'.$data["nom_typeformation"].'</option>';
									}
								}
								$pagemodifForm->corps .= '
						</SELECT>
                </div>
            </div>
			
			<div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Nom</label>
                <div class="col-sm-10">
					<input type="text" name="nom" class="form-control" id="nom" 
					placeholder="ex : Systèmes électroniques numériques" 
					value="'.$Form['nom_formation'].'">
                </div>
            </div>
			
			<div align="center">
                <button type="submit" class="btn btn-sm btn-primary">Modifier la formation</button>
            </div>
		
		</div> 
    </div>
</form>
';

$pagemodifForm->afficher();

?>