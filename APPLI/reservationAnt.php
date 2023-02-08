<?php 
session_start();
require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
include_once('requete/rqtListe.php');

if(is_null($_SESSION['ID']))
{header('Location: index.php');}

$pageReservationAnt = new page_base('Réservations antérieures');

if ($_SESSION['IdProfil']==2)
	{$pageReservationAnt->corps .= '
  <a href="ajoutMS.php"><button align="right" type="submit" class="btn btn-warning">
  <span class="glyphicon glyphicon-check"></span> Créer un MIni-Stage</button>
  </a>';}
  
  if (($_SESSION['IdProfil']==2) or ($_SESSION['IdProfil']==4))
	{$pageReservationAnt->corps .= '
  <a href="reserver.php"><button align="right" type="submit" class="btn btn-success">
  <span class="glyphicon glyphicon-check"></span> Réserver un mini-stage</button>
  </a>';}
  
  $pageReservationAnt->corps .= '
  
  <a href="reservation.php"><button align="right" type="submit" class="btn btn-sm btn-primary">
  <span class="glyphicon glyphicon-check"></span> Réservations postérieures au '.date('d-m-Y').'</button>
  </a></br></br>
  
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-white">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Liste des réservations</h4>
                </div>
                                <div class="panel-body">
                                   <div class="table-responsive">
                                    <table id="reservAnt" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th width="15%">Elève</th>
                                                <th width="20%">Etablissement</th>
                                                <th width="20%">Formation</th>';
												if (($_SESSION['IdProfil']==2) or ($_SESSION['IdProfil']==3))
/*seul les chef de tvx voient les profs*/		{$pageReservationAnt->corps .= '<th width="15%">Professeur</th>';}
                                                $pageReservationAnt->corps .= '
												<th width="15%">Date et Heures</th>
												<th width="15%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Elève</th>
                                                <th>Etablissement</th>
                                                <th>Formation</th>';
												if (($_SESSION['IdProfil']==2) or ($_SESSION['IdProfil']==3))
/*seul les chef de tvx voient les profs*/		{$pageReservationAnt->corps .= '<th>Professeur</th>';}
                                                $pageReservationAnt->corps .= '
                                                <th>Date et Heures</th>
												<th>Actions</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>';
               					          		if($_SESSION['IdProfil']==4)
												{$list= get_ListeReservAnt();}
												else if ($_SESSION['IdProfil']==2)
												{$list= get_ListeReservLyceeAnt();}
												else if ($_SESSION['IdProfil']==3)
												{$list= get_ListeReservProfAnt();}
												else if ($_SESSION['IdProfil']==1)
												{$list= get_ListeReservAdminAnt();}
												while($data=mysqli_fetch_assoc($list))
												{
													$pageReservationAnt->corps .= '
													<tr id="td'.$data['id'].'">
												 		<td>'.$data['nom'].' '.$data['prenom'].'</td>
														<td><div style="display:none">'.$data['nometab'].'</div>'.$data['type'].' 
														'.$data['nometab'].' - '.$data['ville'].'</td></td>
														<td>'.$data['typeformation'].' '.$data['formation'].'</td>';
														if (($_SESSION['IdProfil']==2) or ($_SESSION['IdProfil']==3))
/*seul les chef de tvx +profs voient les prof + profs*/{$pageReservationAnt->corps .= '<td>'.$data['civilite'].' '.$data['nomProf'].' </td>';}
                                                		$pageReservationAnt->corps .= '
														<td><div style="display:none">'.$data['dateUS'].'</div> '.$data['dateFR'].'
															 '.$data['hdebut'].'-'.$data['hfin'].'</td>
														<td align="center">';



/******************************************icone confirmer reception ********************************************************/												
												
/*seul les chef de tvx peuvent confirmer une reception*/
												if (($_SESSION['IdProfil']==2) or ($_SESSION['IdProfil']==1))
												{
													if($data['confirmation']==0)
													{$pageReservationAnt->corps .= '
													<a href="#"><img src="image/confirm0.png" width="25" height="25" 
													title="Valider le mini-stage" id="'.$data['id'].'" 
													onclick="validReception('.$data['id'].',0)"> </a>
													<div style="display:none" id="val'.$data['id'].'" >0</div>';
													}
													else
													{$pageReservationAnt->corps .= '
													<a href="#"><img src="image/confirm1.png" width="25" height="25" 
													title="Annuler la validation" id="'.$data['id'].'" 
													onClick="validReception('.$data['id'].',1)"> </a>
													<div style="display:none" id="val'.$data['id'].'" >1</div>';	
													}
												}
/*si autre utilisateurs*/						else
												{
													if($data['confirmation']==0)
													{$pageReservationAnt->corps .= '
													<img src="image/confirm0.png" width="25" height="25" 
													title="Mini-stage non validé" id="'.$data['id'].'">
													<div style="display:none" id="val'.$data['id'].'" >0</div>';
													}
													else
													{$pageReservationAnt->corps .= '
													<img src="image/confirm1.png" width="25" height="25" 
													title=""Mini-stage validée" id="'.$data['id'].'">
													<div style="display:none" id="val'.$data['id'].'" >1</div>';
														
													}
												}

				
/*********************************************************icone convention**************************************************************/
				
															$pageReservationAnt->corps .= ' 
															<a href="PDF.php?id='.$data['id'].'" target="_blank" >
															<IMG SRC="image/print.png" width="25"  title="Générer la convention"
															id="conv'.$data['id'].'"></a>';
															
/**********************************************************icone supprimer**************************************************************/
															
															if (($_SESSION['IdProfil']==2) or ($_SESSION['IdProfil']==4))
															$pageReservationAnt->corps .= ' 	
															<a href="#"><IMG SRC="image/trash.png" width="25" height="25"  
															title="Supprimer le mini-stage"
															id="trash'.$data['id'].'" onClick="SupprimeReserv('.$data['id'].')" ></a>';
				
															
/************************************************************icone tel**************************************************************/
															
															
			/*popus pour offrant et profs*/				if ($_SESSION['IdProfil']==2 or ($_SESSION['IdProfil']==3))
														{$pageReservationAnt->corps .= '
															<a href="#myModal'.$data['id'].'" data-toggle="modal">
															<IMG SRC="image/phone.png" width="25" height="25"  title="Contact">
															</a><div class="modal fade" id="myModal'.$data['id'].'" tabindex="-1" role="dialog" 
																aria-labelledby="ModalLabel" aria-hidden="true">
                                                				<div class="modal-dialog">
                                                    				<div class="modal-content">
                                                        				<div class="modal-header">
                                                           					<button type="button" class="close" data-dismiss="modal"
																			 	aria-label="Fermer">
																			 	<span aria-hidden="true">&times;</span>
																			</button>
																			
                                                     <h4 class="modal-title" id="myModalLabel">'/*.$data['typel'].' '*/.$data['nometab'].'</h4>
													 
                                                        				</div>
                                                        				<div class="modal-body" style="text-align:left">
																			</br>
																			<b>Contact : </b>'.$data['prenomR'].' '.$data['nomR'].'</br>
																			<b>Fonction : </b>'.$data['fonction'].'</br>
																			<b>Numéro de téléphone : </b>'.$data['tel'].'</br>
																			<b>Mail : </b>'.$data['mail'].'
																			
                                                       					 </div>
                                                       					 <div class="modal-footer">
                                                            				<button type="button" class="btn btn-default"
																			 data-dismiss="modal">Fermer</button>
																		 </div>
                                                    				</div>
                                                					</div>
                                            					</div>';
														}
														else
		/*popus pour reservant*/						{$pageReservationAnt->corps .= '
														<a href="#myModal'.$data['id'].'" data-toggle="modal">
															<IMG SRC="image/phone.png" width="25" height="25"  title="Contact">
															</a><div class="modal fade" id="myModal'.$data['id'].'" tabindex="-1" role="dialog" 
																aria-labelledby="ModalLabel" aria-hidden="true">
                                                				<div class="modal-dialog">
                                                    				<div class="modal-content">
                                                        				<div class="modal-header">
                                                           					<button type="button" class="close" data-dismiss="modal"
																			 	aria-label="Fermer">
																			 	<span aria-hidden="true">&times;</span>
																			</button>
																			
                                                     <h4 class="modal-title" id="myModalLabel">  ' /* .$data['typel'].' '*/.$data['nometab'].'</h4>
													 
                                                        				</div>
                                                        				<div class="modal-body" style="text-align:left">
																			</br>
																			<b>Mail de l\'établissement : </b>'.$data['mailetab'].'</br></br>
																			
																			<b>Contact : </b>'.$data['prenomO'].' '.$data['nomO'].'</br>
																			<b>Fonction : </b>'.$data['fonction'].'</br>
																			<b>Numéro de téléphone : </b>'.$data['tel'].'</br>
																			<b>Mail : </b>'.$data['mail'].'
																			
                                                       					 </div>
                                                       					 <div class="modal-footer">
                                                            				<button type="button" class="btn btn-default"
																			 data-dismiss="modal">Fermer</button>
																		 </div>
                                                    				</div>
                                                					</div>
                                            					</div>';
														}
							
/**************************************************************icone rappel*************************************************************/				
							
																
															
/*seul les chef de tvx peuvent envoyer un rappel*/			if (($_SESSION['IdProfil']==2) && ($data['dateUS'] >= date('Y-m-d')))
															{	
/*chargement de l'image correspondante au rappel mail*/ 		if($data['rappel']==0)
																{$pageReservationAnt->corps .= '
																<a href="#" ><IMG SRC="image/mail0.png" width="25" height="25"
																title="Envoyer un rappel par mail" id="rap'.$data['id'].'" 
																onClick="Rappel('.$data['id'].')"></a>';} 
																else{
																$pageReservationAnt->corps .=  '
																<IMG SRC="image/mail1.png" width="25" height="25"
																title="Rappel envoyé" id="rap'.$data['id'].'">';
																}
															}
															
															
/***************************************************************icone absence************************************************************/				
							
																
															
/*seul les chef de tvx et les profs peuvent gérer les absences*/
															if ((($_SESSION['IdProfil']==2) or ($_SESSION['IdProfil']==3)) && 
																($data['dateUS'] <= date('Y-m-d')))
															{	
/*chargement de l'image correspondante à l'absence*/ 		if($data['absence']==0)
																{$pageReservationAnt->corps .= '
																<a href="#" ><IMG SRC="image/abs0.png" width="25" height="25"
																title="Signaler une absence" id="abs'.$data['id'].'" 
																onClick="absence('.$data['id'].',0)"></a>';} 
																else{
																$pageReservationAnt->corps .=  '
																<a href="#" ><IMG SRC="image/abs1.png" width="25" height="25"
																title="Annuler l\'absence" id="abs'.$data['id'].'"
																onClick="absence('.$data['id'].',1)"></a>';
																}
															}
															else
															{$pageReservationAnt->corps .=  '
																<IMG SRC="image/blanck.png" width="25" height="25">';
															}
															
															$pageReservationAnt->corps .= '
														</td>
													</tr>';
												} 
                                            $pageReservationAnt->corps .= '
                                        </tbody>
                                       </table>  
									</div>
                                </div>
                            </div>


                 ';


$pageReservationAnt->afficher();
?>