<?php
session_start();
if (is_null($_SESSION['ID'])) {
    header('Location: index.php');
}

require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
require_once('requete/rqtADM.php');
//Ajout d'un
if (!empty($_POST["idprofil"])) {
    insert_Util();
    echo("<SCRIPT LANGUAGE='JavaScript'>
    	window.alert(\"Utilisateur créé \")
		</SCRIPT>");
}


$pageAjoutUtil = new page_base('Ajout Utilisateur');
$pageAjoutUtil->corps .= '

<div id="bouton" class="panel-white">
	<div class="panel-heading">
		<h3 id="titre0" class="panel-title">Ajout d\'un utilisateur</h3>
	</div>
	<div class="panel-body">
		<div id="choix" style="text-align:center;">
		<button id="afficheDDFPT" class="btn btn-info btn-rounded" 
		onClick="affiche_DDFPT()">Création DDFPT</button>
		<button id="afficheProf" class="btn btn-info btn-rounded" 
		onClick="affiche_Prof()">Création Prof</button>
		<button id="afficheReserv" class="btn btn-info btn-rounded" 
		onClick="affiche_Reserv()">Création Réservant</button>
		</div>
	</div>
</div>
		
		
<form class=" form-horizontal" action="ADMajoutUtil.php" method="post" id="formulaire" style="display:none">
    <div class="panel panel-white">
        <div class="panel-heading clearfix">
            <h4 id="titre" class="panel-title"></h4>
        </div>
        <div class="panel-body">
                    
			'/*bloc nécéssaire à la requette mais invisible*/ . '
			<div class="form-group" style="display:none">
                <label for="input-Default" class="col-sm-2 control-label">Id profil</label>
                <div class="col-sm-10">
					<input type="text" name="idprofil" class="form-control" id="idprofil" required>
                </div>
            </div>		
					               
			<div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Identifiant</label>
                <div class="col-sm-10">
					<input type="text" name="identifiant" class="form-control" id="identifiant" required>
                </div>
            </div>
                                        
			<div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Mot de passe</label>
                <div class="col-sm-10">
					<input type="text" name="mdp" class="form-control" id="mdp" required>
                </div>
            </div>
                                        
			<div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Nom</label>
                <div class="col-sm-10">
					<input type="text" name="nom" class="form-control" id="nom" onblur="verifChaine(this);MAJ(this)" required>
                </div>
            </div>
                                        
			<div class="form-group">
				<label for="input-help-block" class="col-sm-2 control-label">Prénom</label>
				<div class="col-sm-10">
					<input type="text" name="prenom" class="form-control" id="prenom" onblur="verifChaine(this);Maj(this)" required>
				</div>
            </div>

			<div class="form-group">
                <label for="input-rounded" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
					<input type="text" name="mail" " class="form-control" id="mail" onblur="verifMail(this)" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label"> fonction </label>
                <div class="col-sm-10">
                    <SELECT name="fonction" class="form-control" id="fonction" onchange="verifList(this)">
							<option value="-1" id="none">--Choix de la fonction--</option>';
$fonction = get_fonction();
while ($data = mysqli_fetch_array($fonction)) {
    $pageAjoutUtil->corps .= '<option value="' . $data["idfonction"] . '">' . $data["nom_fonct"] . '</option>';
}
$pageAjoutUtil->corps .= '
						</SELECT>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Téléphone</label>
                <div class="col-sm-10">
                   <input type="text" name="tel" class="form-control" id="tel" onblur="verifTel(this)" required></td>
				</div>
			</div>
		
	<div id="etab"> '/* devient invisible pour un prof */ . '
			<div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Etablissement</label>
                <div class="col-sm-10">
					<input type="text" name="etab" class="form-control" id="etab" onblur="verifChaine(this);MAJ(this)">
                </div>
            </div>
			
			<div class="form-group">
                <label class="col-sm-2 control-label"> Type </label>
                <div class="col-sm-10">
                    <SELECT name="type" class="form-control" id="academie" onchange="verifList(this)">
                        	<option value="-1">--Choix du type--</option>';
$type = get_type();
while ($data = mysqli_fetch_array($type)) {
    $pageAjoutUtil->corps .= '<option value="' . $data["idtypeetab"] . '">' . $data["nom_typeetab"] . '</option>';
}
$pageAjoutUtil->corps .= '
						</SELECT>
				</div>
			</div>
			
			<div class="form-group">
                <label class="col-sm-2 control-label"> Académie </label>
                <div class="col-sm-10">
                    <SELECT name="academie" class="form-control" id="academie" onchange="verifList(this)">
                        	<option value="-1">--Choix de l\'académie--</option>';
$type = get_academie();
while ($data = mysqli_fetch_array($type)) {
    $pageAjoutUtil->corps .= ' <option value=' . $data["idacademie"] . '>' . $data["nom_academie"] . '</option>';
}
$pageAjoutUtil->corps .= '
						</SELECT>
				</div>
			</div>
			
			<div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Adresse</label>
                <div class="col-sm-10">
					<input type="text" name="adresse" class="form-control" id="adresse" onblur="">
                </div>
            </div>
			
			<div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Ville</label>
                <div class="col-sm-10">
					<input type="text" name="ville" class="form-control" id="ville" onblur="verifChaine(this);MAJ(this)">
                </div>
            </div>
			
			<div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Code postal</label>
                <div class="col-sm-10">
					<input type="text" name="cp" class="form-control" id="cp" onblur="verifCP(this)">
                </div>
            </div>
			
			<div class="form-group">
                <label for="input-rounded" class="col-sm-2 control-label">Email etablissement</label>
                <div class="col-sm-10">
					<input type="text" name="mailEtab" " class="form-control" id="mailEtab" onblur="verifMail(this)">
                </div>
            </div>
            
	</div>
	<div id="logosign">
	<div class="form-group">
                <label for="input-rounded" class="col-sm-2 control-label">Nom logo</label>
                <div class="col-sm-10">
					<input type="text" name="logo" class="form-control" id="logo" onblur="" placeholder="image.png">
                </div>
            </div>
			
			
			<div class="form-group">
                <label for="input-rounded" class="col-sm-2 control-label">Nom signature</label>
                <div class="col-sm-10">
					<input type="text" name="sign" class="form-control" id="sign" onblur="" placeholder="image.png">
                </div>
            </div>
	</div>
	
	
	
	
	
	
	<div id="rattacher"> '/* pour rattacher un profil prof à un compte type 2 */ . '
			<div class="form-group">
                <label class="col-sm-2 control-label"> Etablissement </label>
                <div class="col-sm-10">
                    <SELECT name="idrattache" class="form-control" id="idrattache" onchange="verifList(this)">
                        	<option value="-1">--Choix de l\'établissement rattaché--</option>';
$offrant = get_Offrant();
while ($data = mysqli_fetch_array($offrant)) {
    $pageAjoutUtil->corps .= '<option value=' . $data["idetab"] . '> ' . $data["nomcourt_typeetab"] . ' ' . $data["nometab"] . ' - ' . $data["ville"] . '
									( id : ' . $data["idetab"] . ' )</option>';
}
$pageAjoutUtil->corps .= '
					</SELECT>
				</div>
			</div>
	</div>
			
			
			
			<div align="center">
                <button type="submit" class="btn btn-sm btn-primary">Créer l\'utilisateur</button>
            </div>
		
		</div> 
    </div>
</form>
';

$pageAjoutUtil->afficher();

?>

                                
                         