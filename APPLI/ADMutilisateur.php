<?php 
session_start();
require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
include_once('requete/rqtADM.php');

if(is_null($_SESSION['ID']))
{header('Location: index.php');}

$pageListeUtil = new page_base('Utilisateurs');
$pageListeUtil->corps .= '

<a href="ADMajoutUtil.php"><button align="centers" class="btn btn-success">Créer un utilisateur</button></a></br></br>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-white">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Liste des Utilisateurs</h4>
                </div>
                                <div class="panel-body">
                                   <div class="table-responsive">
								   <table id="utilisateur" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th width="">Identifiant</th>
												<th width="">Nom</th>
												<th width="">Prenom</th>
                                                <th width="">Profil</th>
                                                <th width="">Etablissement</th>
												<th width="">Ville</th>
												<th width="10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th width="">Identifiant</th>
												<th width="">Nom</th>
												<th width="">Prenom</th>
                                                <th width="">Profil</th>
                                                <th width="">Etablissement</th>
												<th width="">Ville</th>
												<th width="10%">Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>';
										$ListeUtil= get_utilisateur();
										while($data=mysqli_fetch_assoc($ListeUtil))
										{
											$pageListeUtil->corps .= '
											<tr id="td'.$data['idcompte'].'">
												<td>'.$data['identifiant'].'</td>
												
												<td>'.$data['nom_compte'].'</td>
												
												<td>'.$data['prenom_compte'].'</td>
												
 												<td>'.$data['profil'].'</td>
													
                                                <td>'.$data['nometab'].'</td>
												
												<td>'.$data['ville'].'</td>
												
												<td><a href="ADMmodifUtil.php?idcompte='.$data['idcompte'].'">
												<IMG SRC="image/edit.png" width="25" height="25" title="Modifier l\'utilisateur"
												id="imgedit'.$data['idcompte'].'" onClick=""</a>
												
												<a href="#"><IMG SRC="image/trash.png" width="25" height="25"  
												title="Supprimer l\'utilisateur"
												id="trash'.$data['idcompte'].'" onClick="SupprimeUtil('.$data['idcompte'].')" ></a>
												
												</td>
											 </tr>';
										}
                                        $pageListeUtil->corps .= '
                                        </tbody>
                                       </table>  
									</div>
                                </div>
                            </div>


                 ';


$pageListeUtil->afficher();
?>