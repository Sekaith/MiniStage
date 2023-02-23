<?php
session_start();
if(is_null($_SESSION['ID']))
{header('Location: index.php');}

require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
include_once('requete/rqtADM.php');

$pagemodifUtil = new page_base('Modification Utilisateur');


if(!empty($_POST['idcompte']))
{ Modif_Util();
echo ("<SCRIPT LANGUAGE='JavaScript'>
    	window.alert(\"Utilisateur modifié \")
    	window.location.href='ADMutilisateur.php';
		</SCRIPT>");
}

$Util=get_utilModif();


$pagemodifUtil->corps .= '

<a href="ADMutilisateur.php"><button align="centers" class="btn btn-success">Retour</button></a></br></br>

<form class=" form-horizontal" action="ADMmodifUtil.php" method="post" id="formulaire" style="">
    <div class="panel panel-white">
        <div class="panel-heading clearfix">
            <h4 id="titre" class="panel-title"></h4>
        </div>
        <div class="panel-body">
                    
			'/*bloc nécéssaire à la requette mais invisible*/.'
			<div class="form-group" style="display:none">
                <label for="input-Default" class="col-sm-2 control-label">Id profil</label>
                <div class="col-sm-10">
					<input type="text" name="idprofil" class="form-control" id="idprofil" 
					value="'.$Util['idprofil'].'" >
                </div>
            </div>	
			'/*même chose*/.'
			<div style="display:none"><input type="text" id="idcompte" name="idcompte" value="'.$Util['idcompte'].'"></div>	
					               
			<div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Identifiant</label>
                <div class="col-sm-10">
					<input type="text" name="identifiant" class="form-control" id="identifiant" 
					value="'.$Util['identifiant'].'" >
                </div>
            </div>
                                        
			<div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Mot de passe</label>
                <div class="col-sm-10">
					<input type="text" name="mdp" class="form-control" id="mdp" 
					value="'.$Util['mdp'].'" >
                </div>
            </div>
                                        
			<div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Nom</label>
                <div class="col-sm-10">
					<input type="text" name="nom" class="form-control" id="nom" onblur="verifChaine(this);MAJ(this)" 
					value="'.$Util['nom_compte'].'" >
                </div>
            </div>
                                        
			<div class="form-group">
				<label for="input-help-block" class="col-sm-2 control-label">Prénom</label>
				<div class="col-sm-10">
					<input type="text" name="prenom" class="form-control" id="prenom" onblur="verifChaine(this);Maj(this)" 
					value="'.$Util['prenom_compte'].'" >
				</div>
            </div>

			<div class="form-group">
                <label for="input-rounded" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
					<input type="text" name="mail" class="form-control" id="mail" onblur="verifMail(this)" 
					value="'.$Util['mail_compte'].'" >
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label"> fonction </label>
                <div class="col-sm-10">
                    <SELECT name="fonction" class="form-control" id="fonction" onchange="verifList(this)">
							<option value="-1" id="none">--Choix de la fonction--</option>';
                            $fonction= get_fonction();
								while($data=mysqli_fetch_array($fonction))
              					{
									if($data["idfonction"]==$Util["idfonction"])
									{
										$pagemodifUtil->corps .='<option selected value='.$data["idfonction"].'>'.$data["nom_fonct"].'</option>';
									}
									else
									{
										$pagemodifUtil->corps .='
										<option value='.$data["idfonction"].'>'.$data["nom_fonct"].'</option>';
									}
								}
								
								$pagemodifUtil->corps .= '
						</SELECT>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Téléphone</label>
                <div class="col-sm-10">
                   <input type="text" name="tel" class="form-control" id="tel" onblur="verifTel(this)" 
				   value="'.$Util['tel'].'" ></td>
				</div>
			</div>';
		
		if ($Util['idprofil']!=3)
		{$pagemodifUtil->corps .='
	<div id="etab"> '/* devient invisible pour un prof */.'
	    <div class="form-group" style="display:none">
                <label for="input-Default" class="col-sm-2 control-label">Id etab</label>
                <div class="col-sm-10">
					<input type="text" name="idetab" class="form-control" id="idetab" 
					value="'.$Util['idetab'].'" >
                </div>
            </div>	
			<div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Etablissement</label>
                <div class="col-sm-10">
					<input type="text" name="etab" class="form-control" id="etab" onblur="verifChaine(this);MAJ(this)"
					value="'.$Util['nometab'].'" >
                </div>
            </div>
			
			<div class="form-group">
                <label class="col-sm-2 control-label"> Type </label>
                <div class="col-sm-10">
                    <SELECT name="type" class="form-control" id="type" onchange="verifList(this)">
                        	<option value="-1">--Choix du type--</option>';
							 $type= get_type();
								while($data=mysqli_fetch_array($type))
              					{
									if($data["idtypeetab"]==$Util["idtypeetab"])
									{
										$pagemodifUtil->corps .='<option selected value='.$data["idtypeetab"].'>'.$data["nom_typeetab"].'</option>';
									}
									else
									{
										$pagemodifUtil->corps .='
										<option value='.$data["idtypeetab"].'>'.$data["nom_typeetab"].'</option>';
									}
								}
								
								$pagemodifUtil->corps .= '
						</SELECT>
				</div>
			</div>
			
			<div class="form-group">
                <label class="col-sm-2 control-label"> Académie </label>
                <div class="col-sm-10">
                    <SELECT name="academie" class="form-control" id="academie" onchange="verifList(this)">
                        	<option value="-1">--Choix de l\'académie--</option>';
							 $academie= get_academie();
								while($data=mysqli_fetch_array($academie))
              					{
									if($data["idacademie"]==$Util["idacademie"])
									{
										$pagemodifUtil->corps .='<option selected value='.$data["idacademie"].'>'.$data["nom_academie"].'</option>';
									}
									else
									{
										$pagemodifUtil->corps .='
										<option value='.$data["idacademie"].'>'.$data["nom_academie"].'</option>';
									}
								}
								
								$pagemodifUtil->corps .= '
						</SELECT>
				</div>
			</div>
			
			<div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Adresse</label>
                <div class="col-sm-10">
					<input type="text" name="adresse" class="form-control" id="adresse" onblur=""
					value="'.$Util['adresse'].'" >
                </div>
            </div>
			
			<div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Ville</label>
                <div class="col-sm-10">
					<input type="text" name="ville" class="form-control" id="ville" onblur="verifChaine(this);MAJ(this)"
					value="'.$Util['ville'].'" >
                </div>
            </div>
			
			<div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Code postal</label>
                <div class="col-sm-10">
					<input type="text" name="cp" class="form-control" id="cp" onblur="verifCP(this)"
					value="'.$Util['cp'].'" >
                </div>
            </div>
			
			<div class="form-group">
                <label for="input-rounded" class="col-sm-2 control-label">Email etablissement</label>
                <div class="col-sm-10">
					<input type="text" name="mailEtab" " class="form-control" id="mailEtab" onblur="verifMail(this)"
					value="'.$Util['mailetab'].'" >
                </div>
            </div>
	</div>';
	if (($Util['idprofil']==2) or ($Util['idprofil']==1))
	{$pagemodifUtil->corps .='
	<div id="logosign">
	<div class="form-group">
                <label for="input-rounded" class="col-sm-2 control-label">Nom logo</label>
                <div class="col-sm-10">
					<input type="text" name="logo" class="form-control" id="logo" onblur="" placeholder="image.png"
					value="'.$Util['logo'].'">
                </div>
            </div>
			
			
			<div class="form-group">
                <label for="input-rounded" class="col-sm-2 control-label">Nom signature</label>
                <div class="col-sm-10">
					<input type="text" name="sign" class="form-control" id="sign" onblur="" placeholder="image.png"
					value="'.$Util['cachet'].'">
                </div>
            </div>
	</div>';}
	
	
	}else{
	
	$pagemodifUtil->corps .='
	<div id="rattacher"> '/* pour rattacher un profil prof à un compte type 2 */.'
			<div class="form-group">
                <label class="col-sm-2 control-label"> Etablissement </label>
                <div class="col-sm-10">
                    <SELECT name="idrattache" class="form-control" id="idrattache" onchange="verifList(this)">
                        	<option value="-1">--Choix de l\'établissement rattaché--</option>';
							 $offrant= get_Offrant();
								while($data=mysqli_fetch_array($offrant))
              					{
									if($data["idetab"]==$Util["idetab"])
									{
										$pagemodifUtil->corps .='<option selected value='.$data["idetab"].'> '.$data["nomcourt_typeetab"].' 
															'.$data["nometab"].' - '.$data["ville"].' ( id : '.$data["idetab"].' )</option>';
									}
									else
									{
										$pagemodifUtil->corps .='
										<option value='.$data["idetab"].'> '.$data["nomcourt_typeetab"].' '.$data["nometab"].' - '.$data["ville"].'
										( id : '.$data["idetab"].' )</option>';
									}
								}
								
								$pagemodifUtil->corps .= '
					</SELECT>
				</div>
			</div>
	</div>';
			
	}
	$pagemodifUtil->corps .='
			
			<div align="center">
                <button type="submit" class="btn btn-sm btn-primary">Modifier l\'utilisateur</button>
            </div>
		
		</div> 
    </div>
</form>
';

$pagemodifUtil->afficher();

?>