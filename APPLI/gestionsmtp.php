<?php
session_start();
if(is_null($_SESSION['ID']))
{header('Location: index.php');}

require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');

$pageGestionSMTP = new page_base('GestionSMTP');


$pageGestionSMTP->corps .= '

                        <div class="col-md-12">
                            <div class="panel panel-white">
                                
                                <div class="panel-body">
                                    <form class=" form-horizontal" action="indexsupadmin.php" method="post">


                                        <div class="form-group">
                                            
                                                <div class="col-sm-10">
                                                  <i> Les paramètres d\'envoi de mail sont a modifier dans le fichier <span style="color:red;font-weight:bold;">class.phpmailer.php</span></i>
                                                </div>
                                            </div>


                                        <div class="form-group">
                                            
                                            <div class="col-sm-2">
                                                <input type="text" name="hote" class="form-control" value="Hôte" id="input-Default" required disabled>
                                            </div>
                                            <p>Modifier  <span style="font-weight:bold;"> ligne 225</span> : public $Host = "<span style="color:red;font-weight:bold;">smtp-heberg.ac-nantes.fr</span>";</p>

                                        </div>
                                        <div class="form-group">
                                            
                                            <div class="col-sm-2">
                                                <input type="text" name="hote" class="form-control" value="Port" id="input-Default" required disabled>
                                            </div>


                                            <p>Modifier  <span style="font-weight:bold;"> ligne 232</span> : public $Port =<span style="color:red;font-weight:bold;"> 465</span>;</p>
                                        </div>
                                        <div class="form-group">
                                            
                                            <div class="col-sm-2">
                                                <input type="text" name="hote" class="form-control" value="Certification (ssl/tcp)" id="input-Default" required disabled>
                                            </div>


                                            <p>Modifier <span style="font-weight:bold;"> ligne 247 </span> : public $SMTPSecure = "<span style="color:red;font-weight:bold;">ssl</span>";</p>
                                        </div>
                                        <div class="form-group">
                                            
                                            <div class="col-sm-2">
                                                <input type="text" name="hote" class="form-control" value="Identifiant" id="input-Default" required disabled>
                                            </div>


                                            <p>Modifier <span style="font-weight:bold;"> ligne 276 </span> : public $Username = "<span style="color:red;font-weight:bold;">Monidentifiant</span>";</p>
                                        </div>
                                        <div class="form-group">
                                            
                                            <div class="col-sm-2">
                                                <input type="text" name="hote" class="form-control" value="Mot de passe" id="input-Default" required disabled>
                                            </div>


                                            <p>Modifier  <span style="font-weight:bold;">ligne 282</span> : public $Password = "<span style="color:red;font-weight:bold;">MonMotdepasse</span>";</p>
                                        </div>

                                    </div>
                                    </div>
                                </div>
                                
                          </div> 
                        </div>';
	$pageGestionSMTP->afficher();