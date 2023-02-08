<?php 
session_start();
require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
include_once('requete/rqtListeMS.php');

if(is_null($_SESSION['ID']))
{header('Location: index.php');}

$pageListeMS = new page_base('Mini_Stage');
$pageListeMS->corps .="";

$pageListeMSAnt = new page_base('Mini-Stages antérieures');
$pageListeMSAnt->corps .= '

 <a href="ListeMS.php"><button align="right" type="submit" class="btn btn-sm btn-primary">
  <span class="glyphicon glyphicon-check"></span> Mini-Stages postérieurs au '.date('d-m-Y').'</button>
  </a></br></br>
  
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-white">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Liste des Mini-stages</h4>
                </div>
                                <div class="panel-body">
                                   <div class="table-responsive">
								   <table id="ministageAnt" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th width="25%">Formation</th>
                                                <th width="15%">Nom professeur</th>
                                                <th width="10%">Date</th>
                                                <th width="10%">Heure début</th>
												<th width="10%">Heure fin</th>
												<th width="10%">Places</th>
												<th width="10%">Places restantes</th>';
												if ($_SESSION["IdProfil"] <> 3) /* Pour Prof */ 
												{
												$pageListeMS->corps .= ' <th width="15%">Action</th>';
												} 
												$pageListeMS->corps .= '
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Formation</th>
                                                <th>Nom professeur</th>
                                                <th>Date</th>
                                                <th>Heure début</th>
												<th>Heure fin</th>
												<th>Places</th>
												<th>Places restantes</th>';
												if ($_SESSION["IdProfil"] <> 3) /* Pour Prof */ 
												{
												$pageListeMS->corps .= ' <th>Action</th>';
												} 
												$pageListeMS->corps .= '
                                            </tr>
                                        </tfoot>
                                        <tbody>';
										$listForm= get_ListeFormAnt();
										while($data=mysqli_fetch_assoc($listForm))
										{
											$pageListeMSAnt->corps .= '
											<tr id="td'.$data['id'].'">
												<td>'.$data['typeformation'].' '.$data['formation'].'</td>
												
                                                <td><div id="nprof'.$data['id'].'">'.$data['civilite'].' '.$data['nomProf'].'</div></td>
												
 './*on garde la date us pour le tri*/'      	<td><div style="display:none">'.$data['dateUS'].'</div>
 													<div id="date'.$data['id'].'"> '.$data['dateFR'].'</div>
													
                                                <td><div id="hdebut'.$data['id'].'">'.$data['hdebut'].'</div></td>
												
												<td><div id="hfin'.$data['id'].'">'.$data['hfin'].'</div></td>
												
												<td><div id="place'.$data['id'].'">'.$data['nbplace'].'</div></td>
												
												<td><div id="placereste'.$data['id'].'">'.$data['nbplacereste'].'</div></td>';
												
												if ($_SESSION["IdProfil"] <> 3) /* Pour Prof */ 
												{
												$pageListeMS->corps .= '
												
												
												<td><a href="modifMS.php?id='.$data['id'].'"">
												<IMG SRC="image/edit.png" width="25" height="25" title="Editer le mini-stage"
												id="imgedit'.$data['id'].'" onClick=""</a>
												
												<a href="#"><IMG SRC="image/trash.png" width="25" height="25"  
												title="Supprimer le mini-stage"
												id="trash'.$data['id'].'" onClick="SupprimeMS('.$data['id'].','.$data['nbplace'].'-'.$data['nbplacereste'].')" ></a>  './*on envoie le nb de reserv*/' ';
												} 
												$pageListeMS->corps .= '
												</td>
											 </tr>';
										}
                                        $pageListeMSAnt->corps .= '
                                        </tbody>
                                       </table>  
									</div>
                                </div>
                            </div>


                 ';


$pageListeMSAnt->afficher();
?>