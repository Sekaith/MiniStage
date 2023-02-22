<?php 
session_start();
require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
require_once('requete/rqtADM.php');

if(is_null($_SESSION['ID']))
{header('Location: index.php');}

$pageListeForm = new page_base('Formations');
$pageListeForm->corps .= '

<a href="ADMajoutForm.php"><button align="centers" class="btn btn-success">Créer une formation</button></a></br></br>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-white">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Liste des Formations</h4>
                </div>
                                <div class="panel-body">
                                   <div class="table-responsive">
								   <table id="formation" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th width="">Type</th>
                                                <th width="">Nom</th>
												<th width="10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th width="">Type</th>
                                                <th width="">Nom</th>
												<th width="">Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>';
										$ListeForm= get_formations();
										while($data=mysqli_fetch_assoc($ListeForm))
										{
											$pageListeForm->corps .= '
											<tr id="td'.$data['id'].'">
												<td>'.$data['nomcourt'].'</td>
												
                                                <td>'.$data['nom'].'</td>
												
												<td><a href="ADMmodifForm.php?id='.$data['id'].'">
												<IMG SRC="image/edit.png" width="25" height="25" title="Modifier la formation"
												id="imgedit'.$data['id'].'" onClick=""</a>
												
												<a href="#"><IMG SRC="image/trash.png" width="25" height="25"  
												title="Supprimer la formation"
												id="trash'.$data['id'].'" onClick="SupprimeForm('.$data['id'].')" ></a>
												
												</td>
											 </tr>';
										}
                                        $pageListeForm->corps .= '
                                        </tbody>
                                       </table>  
									</div>
                                </div>
                            </div>


                 ';


$pageListeForm->afficher();
?>