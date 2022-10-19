<?php
session_start();
if(is_null($_SESSION['ID']))
{header('Location: index.php');}

require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
include_once('requete/rqtProfil.php');

$pageProfil = new page_base('Profil');

if($_POST['mdp'])
{updateProfil();}

if($_POST['cp'])
{updateEtab();}

$Profil = get_profil();

$pageProfil->corps .= '

<div class="panel-white">
	<div class="panel-heading">
		<h4 class="panel-title"><p><center>Utilisateur : '.$Profil['prenom'].' '.$Profil['nom'].'</center></p></h4>
	</div>
	<div class="panel-body">
		
				<form  action="profil.php" method="post" name="formulaireProfil" onsubmit="return validerProfil()" align=center>
					<table class="table" width="600" height="100" style="text-align: center;" >
                		<thead>
                			<p>
                			<th style="text-align: center;">Identifiant</th>
                			<th style="text-align: center;">Mot de passe</th>
                			<th style="text-align: center;">Nom</th>
                			<th style="text-align: center;">Prénom</th>
							<th style="text-align: center;">Fonction</th>
                			<th style="text-align: center;">Mail</th>
                			<th style="text-align: center;">Téléphone</th>
                			</p>
						</thead>
				
						<tr>
							<td><input type="text" name="id" style="text-align : center" class="form-control" id="id" 
								value = "'.$Profil["identifiant"].'" required disabled></td>
								
                			<td><input type="text" name="mdp" style="text-align : center" class="form-control" id="mdp" 
								value = "'.$Profil["mdp"].'" required></td>
								
                			<td><input type="text" name="nom" style="text-align : center" class="form-control" id="nom" 
								value = "'.$Profil["nom"].'" onblur="verifChaine(this);MAJ(this);" required></td>
								
                			<td><input type="text" name="prenom" style="text-align : center" class="form-control" id="prenom" 
								value = "'.$Profil["prenom"].'" onblur="verifChaine(this);Maj(this);" required></td>
								
							<td><select name="fct" id="fct" requiered>
							';
								$fct= get_fonction();
								while($data=mysqli_fetch_array($fct))
              					{
									if($data["id"]==$Profil["idfonction"])
									{
										$pageProfil->corps .='<option selected value='.$data["id"].'>'.$data["nom"].'</option>';
									}
									else
									{
								$pageProfil->corps .='
								<option value='.$data["id"].'>'.$data["nom"].'</option>';
									}
								}
								
								$pageProfil->corps .='</select></td>
								
                			<td><input type="text" name="mail" style="text-align : center" class="form-control" id="mail" 
								value = "'.$Profil["mail"].'" onblur="verifMail(this)" required></td>
								
                			<td><input type="text" name="tel" style="text-align : center" class="form-control" id="tel" 
								value = "'.$Profil["tel"].'" onblur="verifTel(this)" required></td>
						</tr>
					</table>
					<br/> <br/>
					<div class="span7 text-center"><button type="submit" class="btn btn-primary btn-sucess">Modifier</button></br></div>
				</form>
	</div>
</div>


<br/><br/><br/>';

if ($_SESSION["IdProfil"] == 2  || $_SESSION["IdProfil"] == 4)
	{
		$pageProfil->corps .= '
<div class="panel-white">
	<div class="panel-heading">
		<h4 class="panel-title"><p><center>Etablissement : '.$Profil['nomtype'].' '.$Profil['nometab'].'</center></p></h4>
	</div>
	<div class="panel-body">
		
				<form  action="profil.php" method="post" name="formulaireEtab" onsubmit="return validerEtab()" align=center>
					<table class="table" width="600" height="100" style="text-align: center;" >
                		<thead>
                			<p>
                			<th style="text-align: center;">Type</th>
                			<th style="text-align: center;">Nom</th>
                			<th style="text-align: center;">Ville</th>
                			<th style="text-align: center;">Code Postal</th>
                			<th style="text-align: center;">Adresse</th>';
							if ($_SESSION["IdProfil"] == 4)
							{$pageProfil->corps .='
							<th style="text-align: center;">Mail</th>';
							}$pageProfil->corps .='
                			</p>
						</thead>
				
						<tr>
							<td><select name="type" id="type" requiered>
							';
								$type= get_type();
								while($data=mysqli_fetch_array($type))
              					{
									if($data["nom"]==$Profil["nomtype"])
									{
										$pageProfil->corps .='<option selected value='.$data["id"].'>'.$data["nom"].'</option>';
									}
									else
									{
								$pageProfil->corps .='
								<option value='.$data["id"].'>'.$data["nom"].'</option>';
									}
								}
								
								$pageProfil->corps .='</select></td>
								
                			<td><input type="text" name="nometab" style="text-align : center" class="form-control" id="nometab" 
								value = "'.$Profil["nometab"].'" onblur="verifChaine(this);MAJ(this)" required></td>
								
                			<td><input type="text" name="ville" style="text-align : center" class="form-control" id="ville" 
								value = "'.$Profil["ville"].'" onblur="verifChaine(this);MAJ(this)" required></td>
								
                			<td><input type="text" name="cp" style="text-align : center" class="form-control" id="cp" 
								value = "'.$Profil["cp"].'" onblur="verifCP(this)" required></td>
								
                			<td><input type="text" name="adresse" style="text-align : center" class="form-control" id="adresse" 
								value = "'.$Profil["adresse"].'" onblur="" required></td>';
							
							if ($_SESSION["IdProfil"] == 4)
							{$pageProfil->corps .='
							<td><input type="text" name="mailetab" style="text-align : center" class="form-control" id="mailetab" 
								value = "'.$Profil["mailetab"].'" onblur="verifMail(this)" required disabled>
								<p class="help-block"><i class="fa fa-question-circle">
								</i> Toutes les informations seront</br>envoyées à cette adresse.</p></td>';
							}$pageProfil->corps .='
						</tr>
					</table>
					<br/>
					<div class="span7 text-center"><button type="submit" class="btn btn-primary btn-sucess">Modifier</button></br></div>
				</form>
	</div>
</div>

';
	}

$pageProfil->afficher();
            
?>