<?php
session_start();
if(is_null($_SESSION['ID']))
{header('Location: index.php');}

require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
include_once('requete/rqtConv.php');

$pageEditConv = new page_base('Edition de la convention');

if(!empty($_POST['important']))
{modif_important();
echo ("<SCRIPT LANGUAGE='JavaScript'>
    	window.alert(\"Modification apportée\")
		</SCRIPT>");
}
$id = isset($data['id']) ? $data['id'] : 1;
$imp= get_important();

$pageEditConv->corps .= 

' <div class="panel-white">
	<div class="panel-heading">
		<h4 class="panel-title">Edition de la convention</h4>
	</div>
	<div class="panel-body">
		
				<form  action="editconv.php" method="post" name="testPDF">
					
					 	<div class="form-group">
                             <label for="input-Default"  class="col-sm-2 control-label"><i> Dans la zone de texte, remplir les détails du mini-stage (heure,salle,materiel à prévoir...)</i></label>
                         <div class="col-sm-10">
							<textarea rows="3" cols="200" name="important" class="form-control" id="important">'.$imp['important'].'</textarea>										
							</br>
							<textarea rows="3" cols="200" name="important2" class="form-control" id="important">'.$imp['important2'].'</textarea>
						</div>
                        </div>
						
					<div class="span7 text-center">
					<button type="submit" class="btn btn-success">Modifier</button>
					<a href="PDFtest.php" target="_blank"><input type="button" class="btn btn-warning" value=" Aperçu "</button></a>
					<a href="PDF.php?id='.$id .'" target="_blank" >
					</div>
				</form>
	</div>
</div>
';


$pageEditConv->afficher();
            
?>