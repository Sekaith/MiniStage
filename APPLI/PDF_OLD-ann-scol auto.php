<?php
session_start();
require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
include_once('requete/rqtConv.php');

if(is_null($_SESSION['ID']))
{header('Location: index.php');}

$Conv=get_Conv();

ob_start();

$datarchiv = date ("Y", mktime (0,0,0,date('m'),date('d'),date('Y')-1));
   
?>

<div style="width:300px;height:235px; position:absolute;left:20px;top:0px;">
<img src="image/logos/<? echo $Conv['logo'] ?>">
</div>


<div style="position:absolute;right:25px">

<h2 style="text-align:center">CONVENTION de MINI-STAGE<h4><br>Année scolaire <? echo $datarchiv ?> - <?echo date("Y")?></h4></h2>


</div>



<div style="position:absolute;left:20px;top:210px;font-size:14px;line-height:13pt;">

<p style="text-align:left;font">et l'établissement demandeur : <br><b><? echo $Conv['typeOrigine'].' ' ?><? echo $Conv['etabOrigine'] ?><br><? echo $Conv['adresseOrigine'] ?><br><? echo $Conv['cpOrigine'] ?>  <? echo $Conv['villeOrigine'] ?></b> </p>

</div>

<div style="position:absolute;right:20px;top:180px;line-height:13pt;">

<p style="text-align:left;font-size:14px;"> Entre l'établissement d'accueil : <br><b><? echo $Conv['type'] ?>  <? echo $Conv['nometab'] ?><br><? echo $Conv['adresse'] ?><br><? echo $Conv['cp'] ?> <? echo $Conv['ville'] ?><br>Tél. : <? echo $Conv['tel'] ?><br>Email :<span  style="color:#1E00FF;font-weight: bold;" > <? echo $Conv['mail'] ?></span></b></p>

</div>

<div style="position:absolute;left:20px;top:275px;line-height:15pt;">

<p style="text-align:left;font-size:14px;"> <br>et l'élève stagiaire : <b><? echo $Conv['prenom'] ?> <? echo $Conv['nom'] ?><br></b>élève en classe de   ....... <br>date de naissance : ....... / ........ / ......... <br><br>Mini-stage suivi : <b> <? echo $Conv['typeformation'] ?> <? echo $Conv['formation'] ?> </b><br>Date : <b><? echo ($Conv['date']) ?> </b> Horaires : <b><? echo $Conv['hdebut'] ?>-<? echo $Conv['hfin'] ?></b> Lieu : <b><? echo ($Conv['lieu']) ?> </b><br>
Professeur encadrant : <b><? echo $Conv['civilite'] ?> <? echo $Conv['nomprof'] ?> </b>  
</p>

</div>

<div style="position:absolute;left:20px;top:450px;">

<p style="text-align:left;font-size:14px;">Il est convenu comme suit : </p>



</div>
<div style="position:absolute;left:20px;top:465px;right:10px;">

<blockquote><p style="text-align:justify;font-size:14px;">- NATURE DU MINI-STAGE : La séquence d'observations permet de découvrir les formations professionnelles, technologiques, ou d'enseignement supérieur, de voir les élèves en situation de travail dans les ateliers ou les salles spécialisées.<br>
- Il est destiné aux élèves de 3ème, aux élèves de 2nde en recherche de réorientation, ainsi qu’aux élèves de terminale souhaitant poursuivre leurs études.<br>
- L’élève se rendra par ses propres moyens dans l'établissement d'accueil, sous la responsabilité des parents.<br>
- Pendant son séjour dans l'établissement d'accueil, l'élève stagiaire reste sous la responsabilité du Chef d'établissement d’origine.<br>
- Il doit se soumettre au règlement, respecter les personnes, locaux, matériels et particulièrement les consignes de sécurité de l'établissement d'accueil. Rappel : L’utilisation de machines dangereuses est interdite (Article R. 234-22 du code du travail)<br>
- Pour tout incident ou accident, le Proviseur du lycée d’accueil prend contact avec l’établissement de l’élève pour fixer la conduite à tenir.</p>
</blockquote>
</div>

<div style="position:absolute;left:20px;top:660px;right:10px;">

<blockquote><p style="text-align:left;font-size:14px;"><b>Mise en place:</b><br>
L’établissement d’origine renseigne sur ce document les informations manquantes relatives à l'élève, il fait signer le représentant légal et signe à son tour.
Une fois complétée, il envoie une copie à l’établissement d’accueil par courrier électronique à l'adresse ci-dessus.<br>ATTENTION : Le mini-stage n'est validé qu'à la réception de la convention</p> </blockquote>



</div>
<div style="position:absolute;left:20px;top:750px;right:10px;">
<blockquote>
<p style="text-align:left;font-size:14px;"><b>Important:</b><br>
	
<? echo $Conv['important'] ?> <br>
<? echo $Conv['important2'] ?> </p></blockquote>




</div>

<div style="position:absolute;left:20px;top:875px;line-height:15pt;">

<p style="text-align:left;font-size:14px;">Pour l'établissement d'accueil :<br> Date : <? echo date("d/m/Y") ?><br> Cachet-Signature<br>		<br><img src="image/signatures/<? echo $Conv['cachet'] ?>" style="width:150px;height:90px;" >
</p>



</div>

<div style="position:absolute;left:280px;top:875px;line-height:15pt;">

<p style="text-align:left;font-size:14px;">Pour l'établissement d'origine:<br> Date : ....... / ........ / <?echo date("Y")?> <br> Cachet-Signature<br><br>
	 </p>




</div>

<div style="position:absolute;left:550px;top:875px;line-height:15pt;">

<p style="text-align:left;font-size:14px;">Pour le représentant légal :<br> Date : ....... / ........ /<?echo date("Y")?><br>Signature<br><br>

 </p>



</div>



<?php
$content= ob_get_clean();

require('html2pdf/html2pdf.class.php');
try{
	$pdf= new html2pdf('P','A4','fr');
	$pdf->writeHTML($content);
	$pdf->Output('convention.pdf');




}catch(html2pdf_exeption $e){
	die($e);
}

