<?php 
session_start();
require_once('Class/Connexion.class.php');
include_once('requete/rqtProfil.php');
require "phpmailer/class.phpmailer.php";
require "phpmailer/class.smtp.php";  
require "phpmailer/class.pop3.php";  

if(!empty($_POST['nom']))
{$mailetab=inscription();
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    	window.alert(\"Inscription réussie. Un mail contenant vos identifiants de connexion a été envoyé à l'adresse ".$mailetab." \")
    	window.location.href='index.php';
		</SCRIPT>");
}
?>

<!DOCTYPE html>
<html>
    <head>
        
        <!-- Title -->
        <title>Inscription</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <link rel="icon" type="image/png" href="assets/images/avatar1.png" />
        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
        
        <!-- Theme Styles -->
        <link href="assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/themes/white.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        
        <script src="assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
 
     <body class="page-register">
        <main class="page-content">
            <div class="page-inner">
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-3 center">
                            <div class="login-box">
                                <a href="index.php" class="logo-name text-lg text-center">Inscription</a>
                            
    <?php
    
    if(empty($_POST['rne']))
{
	?>
				<form class="m-t-md"  method="post" action="inscription.php" name="FormInscription" onSubmit="return validRNE1()">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="RNE  ex(0491234A)" name="rne" id="rne" onblur="MAJ(this);verifRNE(this);"" required>
					</div>
					<button type="submit" class="btn btn-success btn-block m-t-xs">Vérifier</button>
				</form>
    <?php
}
else
{ 
	if(!Verif_RNE() AND empty($_POST['etab']))
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    	window.alert(\"RNE déjà utilisé \")
    	window.location.href='index.php';
		</SCRIPT>");
	}
	else{
	?>
	<form class="m-t-md"  method="post" action="inscription.php" name="FormInscription" onSubmit="return validerInscription()">
					<div class="form-group">
						<input type="text" class="form-control" value="<?php echo $_POST['rne']?>" name="rne" id="rne" 
                        onblur="verifRNE(this)" readOnly required>
                        
					</br></br><label class="logo-name text-lg text-center"> Académie </label></br>
						<SELECT name="academie" class="form-control" name="academie" id="academie" onchange="verifList(this)">
                        	<option value="-1">--Choix de l'académie--</option>
							<?php
                            $academie= get_academie();
								while($data=mysqli_fetch_array($academie))
              					{
									echo '<option value="'.$data["idacademie"].'">'.$data["nom_academie"].'</option>';
								}
							?>
						</SELECT>
                        
					</br></br><label class="logo-name text-lg text-center"> Etablissement </label></br>
						<SELECT name="type" class="form-control" name="type" id="type" onchange="verifList(this)">
                        	<option value="-1">--Choix du type d'établissement--</option>
							<?php
                            $type= get_type();
								while($data=mysqli_fetch_array($type))
              					{
									echo '<option value="'.$data["idtypeetab"].'">'.$data["nom_typeetab"].'</option>';
								}
							?>
						</SELECT>
                        </br>
                        <input type="text" class="form-control" name="etab" id="etab" placeholder="Nom établissement (sans le type)" 
                        onblur="verifChaine(this);MAJ(this)" required>
                        </br>               
                        <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse" required>
                        </br>            
                        <input type="text" class="form-control" name="cp" id="cp" placeholder="Code Postal" 
                        onblur="verifCP(this)"required>
                        </br>            
                        <input type="text" class="form-control"  name="ville" id="ville" placeholder="Ville" 
                        onblur="verifChaine(this);MAJ(this)" required>
                        
					</br></br><label class="logo-name text-lg text-center"> Utilisateur </label></br>
                    	<select name="menu_destination" class="form-control" onchange="verifList(this)" >
                        <option value="-1">--Sélectionner--</option>
							<option value="Mr">M.</option>
							<option value="Mme">Mme</option>
						</select>
                        </br>
                        <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" 
                        onblur="verifChaine(this);MAJ(this)" required>
                        </br>                      
                        <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom" 
                        onblur="verifChaine(this);Maj(this);"required>
                        </br> 
                        <SELECT name="fonction" class="form-control" name="fonction" id="fonction" onchange="verifList(this)">
							<option value="-1" id="none">--Choix de la fonction--</option>
                        	<?php
                            $fonction= get_fonction();
								while($data=mysqli_fetch_array($fonction))
              					{
									echo '<option value="'.$data["idfonction"].'">'.$data["nom_fonct"].'</option>';
								}
							?>
						</SELECT>
                        </br>
                        <input type="email" name="mail" id="mail"class="form-control" placeholder="Mail" 
                        onblur="verifMail(this)" required>
                        </br>
                        <input type="text" class="form-control" name="tel" id="tel" placeholder="Numéro Tel" 
                        onblur="verifTel(this)" required>
                   </div></br>
                   		<button type="submit" class="btn btn-success btn-block m-t-xs">Inscription</button>
                </form>
    <?php
	}
}
   ?>
							</div>
                        </div>
                    </div><!-- Row -->
                </div><!-- Main Wrapper -->
            </div><!-- Page Inner -->
        </main><!-- Page Content -->

        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.1.3.min.js"></script>
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/plugins/pace-master/pace.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>
        <script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/classie.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/main.js"></script>
        <script src="assets/plugins/waves/waves.min.js"></script>
        <script src="assets/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="assets/js/modern.min.js"></script>
        <script src="js/VerifJS.js")></script>
        
    </body>
</html>