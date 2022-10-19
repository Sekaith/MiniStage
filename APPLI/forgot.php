<?php 
session_start();
require_once('Class/Connexion.class.php');
include_once('requete/rqtProfil.php');
require "phpmailer/class.phpmailer.php";
require "phpmailer/class.smtp.php";  
require "phpmailer/class.pop3.php";  

if(!empty($_POST['rne']))
{	$mailetab=mdpoublie();
	if (!$mailetab==false)
	{
	 echo ("<SCRIPT LANGUAGE='JavaScript'>
    	window.alert(\"Un mail contenant vos identifiants de connexion a été envoyé à l'adresse    ".$mailetab."\" )
    	window.location.href='index.php';
		</SCRIPT>");
	}
	else
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    	window.alert(\"Votre RNE n'est pas reconnu , votre établissement ne doit pas être inscrit\")
    	window.location.href='forgot.php';
		</SCRIPT>");
	}
}	
?>

<!DOCTYPE html>
<html>
    <head>
        
        <!-- Title -->
        <title>Mot de passe oublié</title>
        
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
						<p class="logo-name text-lg text-center"> Mot de passe oublié</p>
                        <p class="text-center m-t-md">Entrer le RNE de votre établissement</p>
								<p class="text-center m-t-md">Votre mot de passe vous sera envoyé par mail à l'adresse correspondante à votre établissement</p>
				<form class="m-t-md"  method="post" action="forgot.php" name="FormOublie" onSubmit="return validRNE2()">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="RNE  ex(0491234A)" name="rne" id="rne" onblur="MAJ(this);verifRNE(this);"" required>
					</div>
					<button type="submit" class="btn btn-success btn-block m-t-xs" onsubmit="Verif_RNE()">Envoyer</button>
                    <a href="login.php" class="btn btn-default btn-block m-t-md">Retour</a>
				</form>
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