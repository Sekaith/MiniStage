<?php
session_start();
if(is_null($_SESSION['ID']))
{header('Location: index.php');}

require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
include_once('requete/rqtReserver.php');

$pageReserver = new page_base('Réserver');

if(!empty($_POST['nom']))
{$Reserv=insertMinistage();
echo ("<SCRIPT LANGUAGE='JavaScript'>
    	window.alert(\"La réservation pour ".$_POST['nom']." ".$_POST['prenom']." en mini-stage ".$Reserv['typeformation']." ".$Reserv['form']."  au ".$Reserv['nom']." ".$Reserv['nometab']." a reussi \")
    	window.location.href='reservation.php';
		</SCRIPT>");
}

if(!empty($_POST['nomR']))
{$Reserv=insertMinistageR();
echo ("<SCRIPT LANGUAGE='JavaScript'>
    	window.alert(\"La réservation pour ".$_POST['nomR']." ".$_POST['prenomR']." en mini-stage ".$Reserv['typeformation']." ".$Reserv['form']."  au ".$Reserv['nom']." ".$Reserv['nometab']." a reussi \")
    	window.location.href='reservation.php';
		</SCRIPT>");
}


/*************************************************Reservation pour un chef de travaux **************************************************/
if ($_SESSION['IdProfil']==2)
{

	$pageReserver->corps .= '
	
	<form class=" form-horizontal" action="reserver.php" method="post" 
				id="formulaireReservChef" name="formulaireReservChef" onsubmit="return validerReserverChef()">
	
				<div id=champ class="panel-white" >
				<div class="panel-heading">
   				<h3 id="titre" class="panel-title">Choisir une formation</h3>
    			</div>
				<div class="panel-body">
	
				<div id="champFormR" class="form-group">
				<label for="input-Default"  class="col-sm-2 control-label">Formations</label>
				<input type="text" name="etabR" style="display:none" id="etabR" value="'.$_SESSION['IdUtilisateur'].'"> './*pour l'ajax on envoie l'id etab'*/'
				<div class="col-sm-10"><SELECT name="formationR" class="form-control" tabindex="-1" 
				id="formationR" onchange="charge_mini3()">
					<option value="-1">--Choix de la formation--</option>';
					$Formation= get_formationR(1); //bacpro
					if (mysqli_num_rows($Formation)>0){
					$pageReserver->corps .='
					<optgroup label="BAC PROFESSIONNEL">';
						while($data=mysqli_fetch_array($Formation))
              			{
							$pageReserver->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
						}
						$pageReserver->corps .='
						</optgroup>';
						}
						
					$Formation= get_formationR(2); //cap
					if (mysqli_num_rows($Formation)>0){
					$pageReserver->corps .='
					<optgroup label="CAP">';
						while($data=mysqli_fetch_array($Formation))
           	 	  		{
							$pageReserver->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
						}
						$pageReserver->corps .='
					</optgroup>';
					}
					
					$Formation= get_formationR(3); //bactechno
					if (mysqli_num_rows($Formation)>0){
					$pageReserver->corps .='
					<optgroup label="BAC TECHNOLOGIQUE">';
						while($data=mysqli_fetch_array($Formation))
	            	  	{
							$pageReserver->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
						}
						$pageReserver->corps .='
					</optgroup>';
					}
					
					$Formation= get_formationR(4); //bacG
					if (mysqli_num_rows($Formation)>0){
					$pageReserver->corps .='
					<optgroup label="BAC GENERAL">';
						while($data=mysqli_fetch_array($Formation))
              			{
							$pageReserver->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
						}
						$pageReserver->corps .='
					</optgroup>';
					}
					
					$Formation= get_formationR(5); //BTS
					if (mysqli_num_rows($Formation)>0){
					$pageReserver->corps .='
					<optgroup label="BTS">';
						while($data=mysqli_fetch_array($Formation))
              			{
							$pageReserver->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
						}
						$pageReserver->corps .='
					</optgroup>';
					}
					
					$Formation= get_formationR(6); //ENSEIGNEMENT D'EXPLORATION
					if (mysqli_num_rows($Formation)>0){
					$pageReserver->corps .='
					<optgroup label="ENSEIGNEMENT D\'EXPLORATION">';
						while($data=mysqli_fetch_array($Formation))
             		 	{
							$pageReserver->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
						}
						$pageReserver->corps .='
					</optgroup>';
					}
					
					$Formation= get_formationR(7); //autre
					if (mysqli_num_rows($Formation)>0){
					$pageReserver->corps .='
					<optgroup label="AUTRE">';
						while($data=mysqli_fetch_array($Formation))
             	 		{
							$pageReserver->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
						}
						$pageReserver->corps .='
					</optgroup>';
					}
					$pageReserver->corps .='
				</SELECT></div></div>';
				
				
				
				$pageReserver->corps .='

				<div id="champMiniR" style="display:none" class="form-group">
				<label for="input-Default"  class="col-sm-2 control-label">Créneaux</label>
				<div class="col-sm-10"><SELECT name="miniR" class="form-control" tabindex="-1" 
				id="miniR" onchange="charge_inscriptionR()">
				</SELECT></div></div>
				</div></div></br>';
				
				
				
				
				
				
/******************************************** Formulaire éleve (chef) ***************************************************/
$pageReserver->corps .='

				<div id="inscriptionR" style="visibility:hidden;" class="panel-white">
					<div class="panel-heading">
    				<h3 id="titre" class="panel-title">Inscription de l\'élève</h3>
    				</div>
				<div class="panel-body">
					<div class="form-group">
                    	<label for="input-Default" class="col-sm-2 control-label">Nom</label>
							<div class="col-sm-10">
								<input type="text" name="nomR" class="form-control" id="nomR" 
								 onblur="verifChaine(this);MAJ(this)">
							</div>
					</div>
                                
					<div class="form-group">
						<label for="input-Default" class="col-sm-2 control-label">Prénom</label>
							<div class="col-sm-10">
								<input type="text" name="prenomR" class="form-control" id="prenomR" 
								 onblur="verifChaine(this);Maj(this)">
							</div>
					</div>
						
				<div class="form-group">
				<label for="input-Default"  class="col-sm-2 control-label">Etablissements</label>
				<div class="col-sm-10"><SELECT name="etablissementR" class="form-control" tabindex="-1" 
				id="etablissementR" onchange="verifList(this)">
            		<option value="-1">--Séléctionner un établissement--</option>';
					$Etab= get_etabR();
					while($data=mysqli_fetch_array($Etab))
              		{
						$pageReserver->corps .=' <option value="'.$data["id"].'">'.$data['nom'].' '.$data["nometab"].' - '.$data["ville"].'</option>';
					}
					$pageReserver->corps .='
				</SELECT>
				<p class="help-block"><i class="fa fa-question-circle">
								</i> L\'établissement n\'est pas enregistré ? Cocher cette case : <INPUT type="checkbox" name="autre" id="autre" value="1" onChange="BTN_autre()">
				</div></div>
					
					
				
				 	<div align="center">
						<button type="submit" class="btn btn-success ">Réserver</button>
						</div>
                	</div>
				</div>
			</form>
';
}
	


/**************************************************Reservation pour un collège *********************************************************/
if ($_SESSION['IdProfil']==4)
{
	$pageReserver->corps .= '

		<div id=bouton class="panel-white">
			<div class="panel-heading">
    			<h3 id="titre0" class="panel-title">Recherche</h3>
    		</div>
		<div class="panel-body">
				
				 <div id="choix" style="text-align:center;">
                   <button id="afficheEtab" class="btn btn-info btn-rounded" 
				  	onClick="affiche_Etab()">Je cherche un établissement</button></br></br>
				   <button id="afficheForm" class="btn btn-info btn-rounded" 
				   	onClick="affiche_Form()">Je cherche une formation</button>
				</div>
		</div>
		</div>
				';

/******************************************** Recherche par établissement **********************************************************/				
$pageReserver->corps .= '
			
				<form class=" form-horizontal" action="reserver.php" method="post" 
				id="formulaireReserver" name="formulaireReserver" onsubmit="return validerReserver()">
	
				<div id=champ class="panel-white" style="display:none";>
				<div class="panel-heading">
   				<h3 id="titre" class="panel-title">Recherche</h3>
    			</div>
				<div class="panel-body">
	
				

				<div id="champEtab" style="display:none" class="form-group">
				<label for="input-Default"  class="col-sm-2 control-label">Etablissements</label>
				<div class="col-sm-10"><SELECT name="etablissement" class="form-control" tabindex="-1" 
				id="etablissement" onchange="charge_form()">
            		<option value="-1">--Séléctionner un établissement--</option>';
					$Etab= get_etab();
					while($data=mysqli_fetch_array($Etab))
              		{
						$pageReserver->corps .=' <option value="'.$data["id"].'">'.$data['nom'].' '.$data["nometab"].' - '.$data["ville"].'</option>';
					}
					$pageReserver->corps .='
				</SELECT></div></div>
				
				
				<div id="champForm" style="display:none" class="form-group">
				<label for="input-Default"  class="col-sm-2 control-label">Formations</label>
				<div class="col-sm-10"><SELECT name="formation" class="form-control" tabindex="-1" 
				id="formation" onchange="charge_mini()">
				</SELECT></div></div>';
				
				
				
/******************************************** Recherche par Formation **********************************************************/				
$pageReserver->corps .= '	

				<div id="champForm2" style="display:none" class="form-group">
				<label for="input-Default"  class="col-sm-2 control-label">Formations</label>
				<div class="col-sm-10"><SELECT name="formation2" class="form-control" tabindex="-1" 
				id="formation2" onchange="charge_Etab()">
					<option value="-1">--Choix de la formation--</option>';
					$Formation= get_formation(1); //bacpro
					if (mysqli_num_rows($Formation)>0){
					$pageReserver->corps .='
					<optgroup label="BAC PROFESSIONNEL">';
						while($data=mysqli_fetch_array($Formation))
              			{
							$pageReserver->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
						}
						$pageReserver->corps .='
						</optgroup>';
						}
						
					$Formation= get_formation(2); //cap
					if (mysqli_num_rows($Formation)>0){
					$pageReserver->corps .='
					<optgroup label="CAP">';
						while($data=mysqli_fetch_array($Formation))
           	 	  		{
							$pageReserver->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
						}
						$pageReserver->corps .='
					</optgroup>';
					}
					
					$Formation= get_formation(3); //bactechno
					if (mysqli_num_rows($Formation)>0){
					$pageReserver->corps .='
					<optgroup label="BAC TECHNOLOGIQUE">';
						while($data=mysqli_fetch_array($Formation))
	            	  	{
							$pageReserver->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
						}
						$pageReserver->corps .='
					</optgroup>';
					}
					
					$Formation= get_formation(4); //bacG
					if (mysqli_num_rows($Formation)>0){
					$pageReserver->corps .='
					<optgroup label="BAC GENERAL">';
						while($data=mysqli_fetch_array($Formation))
              			{
							$pageReserver->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
						}
						$pageReserver->corps .='
					</optgroup>';
					}
					
					$Formation= get_formation(5); //BTS
					if (mysqli_num_rows($Formation)>0){
					$pageReserver->corps .='
					<optgroup label="BTS">';
						while($data=mysqli_fetch_array($Formation))
              			{
							$pageReserver->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
						}
						$pageReserver->corps .='
					</optgroup>';
					}
					
					$Formation= get_formation(6); //ENSEIGNEMENT D'EXPLORATION
					if (mysqli_num_rows($Formation)>0){
					$pageReserver->corps .='
					<optgroup label="ENSEIGNEMENT D\'EXPLORATION">';
						while($data=mysqli_fetch_array($Formation))
             		 	{
							$pageReserver->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
						}
						$pageReserver->corps .='
					</optgroup>';
					}
					
					$Formation= get_formation(7); //autre
					if (mysqli_num_rows($Formation)>0){
					$pageReserver->corps .='
					<optgroup label="AUTRE">';
						while($data=mysqli_fetch_array($Formation))
             	 		{
							$pageReserver->corps .=' <option value="'.$data["id"].'">'.$data["typeformation"].' '.$data["nom"].'</option>';
						}
						$pageReserver->corps .='
					</optgroup>';
					}
					$pageReserver->corps .='
				</SELECT></div></div>



				<div id="champEtab2" style="display:none" class="form-group">
				<label for="input-Default"  class="col-sm-2 control-label">Etablissement</label>
				<div class="col-sm-10"><SELECT name="etablissement2" class="form-control" tabindex="-1" 
				id="etablissement2" onchange="charge_mini2()">
				</SELECT></div></div>';


/***************************************************************** Choix du créneau (pour les 2 recherches) **************************************************/			
$pageReserver->corps .='

				<div id="champMini" style="display:none" class="form-group">
				<label for="input-Default"  class="col-sm-2 control-label">Créneaux</label>
				<div class="col-sm-10"><SELECT name="mini" class="form-control" tabindex="-1" 
				id="mini" onchange="charge_inscription()">
				</SELECT></div></div>
			</div></div></br>'; //on ferme le panel white	
				
/******************************************** Formulaire éleve ***************************************************/
$pageReserver->corps .='

				<div id="inscription" style="visibility:hidden;" class="panel-white">
					<div class="panel-heading">
    				<h3 id="titre" class="panel-title">Inscription de l\'élève</h3>
    				</div>
				<div class="panel-body">
					<div class="form-group">
                    	<label for="input-Default" class="col-sm-2 control-label">Nom</label>
							<div class="col-sm-10">
								<input type="text" name="nom" class="form-control" id="nom" 
								 onblur="verifChaine(this);MAJ(this)">
							</div>
					</div>
                                
					<div class="form-group">
						<label for="input-Default" class="col-sm-2 control-label">Prénom</label>
							<div class="col-sm-10">
								<input type="text" name="prenom" class="form-control" id="prenom" 
								 onblur="verifChaine(this);Maj(this)">
							</div>
					</div>
				
				 	<div align="center">
						<button type="submit" class="btn btn-success ">Réserver</button>
                	</div>
				</div>
				</div>
			</form>
';
}
$pageReserver->afficher();

?>