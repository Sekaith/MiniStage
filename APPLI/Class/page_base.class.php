<?php
class page_base {
	private $titre;
	private $corps;
    //ajout des fichiers Javascripts dans l'application
	private $script=array('VerifJS','Reserver','Liste','modifMS','ADMUtilisateur','datatable', 'formation', 'Image', 'professeur');
	
	public function __construct($t){
		$this->titre = $t;
	}

	public function __set($propriete, $valeur){
		switch ($propriete){
			case 'script':{
				$this->script[count($this->script)] = $valeur;
		break;
			}
			case 'titre':{
				$this->titre = $valeur;
				break;
			}
			case 'corps':{
				$this->corps = $valeur;
				break;
			}
		}
	}

	public function __get($propriete){
		switch ($propriete){
			case 'corps':{
				return $this->corps ;
				break;
			}
			default:
			{
				echo 'Accès Impossible à '.$propriete.' : elle est en private dans la class' ;
				break;
			}
		}
	}
	
	
	/****************************** Gestion des styles **********************************************/
	/* Insertion des feuilles de style */
	private function affiche_style(){
		
	?>
	<!-- Styles -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600" rel="stylesheet" type="text/css">
    <link href="assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
    <link href="assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
    <link href="assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
    <link href="assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
    <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
    <link href="assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet" type="text/css"/>	
    <link href="assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet" type="text/css"/>	
    <link href="assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>	
    <link href="assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>	
    <link href="assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>	
    <link href="assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/toastr/toastr.min.css" rel="stylesheet">
    
    <!-- Theme Styles -->
    <link href="assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        
    <script src="assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
    <script src="assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
	<?
	}
	/****************************** Gestion des scripts **********************************************/
	/* Insertion des script JAVASCRIPT */
	private function affiche_script() {
	?>
		
<!-- Javascripts -->
     	<script src="assets/plugins/jquery/jquery-2.1.3.min.js"></script>
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/plugins/pace-master/pace.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>
        <script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="assets/plugins/waves/waves.min.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/classie.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/main.js"></script>
        <script src="assets/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="assets/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
        <script src="assets/plugins/moment/moment.js"></script>
        <script src="assets/plugins/select2/js/select2.full.min.js"></script>
        <script src="assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
        <script src="assets/js/modern.min.js"></script>
        <script src="assets/js/pages/form-x-editable.js"></script>
        <script src="assets/js/pages/table-data.js"></script>
        <script src="assets/plugins/datatables/js/jquery.datatables.min.js"></script>
        <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
        <script src="assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
        <script src="assets/plugins/toastr/toastr.min.js"></script>
        <script src="assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
    
    <?php
	
	foreach ($this->script as $s) {
			echo "<script type='text/javascript' src='js/".$s.".js'></script>\n";
		}
		
		}
	/****************************** Gestion du footer **********************************************/
	private function affiche_footer() {
	?>
		<div class="page-footer">
             <p class="no-s">2015 &copy; Mini-Stages</p>
        </div>
     <?php
     }
	/****************************** Gestion de l'entete **********************************************/
	private function affiche_entete() {
		?>
	<body class="page-header-fixed  pace-done page-sidebar-fixed">
    <main class="page-content content-wrap">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="sidebar-pusher">
                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <div class="logo-box">
                    <a href="accueil.php" class="logo-text"><span>Mini-stages</span></a>
                </div><!-- Logo Box -->
				<div class="topmenu-outer">
                    <div class="top-menu">
                        <ul class="nav navbar-nav navbar-left">
                            <li>		
                                <a href="javascript:void(0);" class="waves-effect waves-button waves-classic sidebar-toggle"><i class="fa fa-bars"></i></a>
                            </li>
                         </ul>
                                
                      	 <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a>
									<span class="user-name"><?php echo $_SESSION["Prenom"]; ?>  <?php echo $_SESSION["Nom"]; ?></span>
                                    <img class="img-circle avatar" src="assets/images/avatar1.png" width="40" height="40" alt="">
								</a>
                                    
                                </li>
                           		<li>
                                	<a href="logout.php" class="log-out waves-effect waves-button waves-classic">
                                    	<span><i class="fa fa-sign-out m-r-xs"></i>Déconnexion</span>
                                </a>
                            </li>
                        </ul><!-- Nav -->
                    </div><!-- Top Menu -->
                </div>
            </div>
        </div><!-- Navbar -->
        <?php
		}
	/****************************** Gestion des menus ***************************************************/
	private function affiche_menu() {
	?>
	<div class="page-sidebar sidebar">
		<div class="page-sidebar-inner slimscroll">
			<div class="sidebar-header">
 				<div class="sidebar-profile">
					<div class="sidebar-profile-image">
						<img src="assets/images/avatar1.png" class="img-circle img-responsive" alt="">
					</div>
					<div class="sidebar-profile-details">
						<span><?php echo $_SESSION['TypeEtab']; ?><br><?php echo $_SESSION['NomEtab']; ?>
						<br><?php echo $_SESSION['Nom']; ?><br><small>Profil : <?php echo $_SESSION['Profil']; ?></small></span>
					</div>
				</div>
			</div>
			<ul class="menu accordion-menu">

				<li><a href="accueil.php" class="waves-effect waves-button">
            		<span class="menu-icon glyphicon glyphicon-home"></span><p>Accueil</p></a></li>

                <?php
				if($_SESSION['IdProfil']==1)
					{$this->affiche_menu_admin();}
				if($_SESSION['IdProfil']==2)
					{$this->affiche_menu_chef();}
				if($_SESSION['IdProfil']==3)
					{$this->affiche_menu_prof();}
				if($_SESSION['IdProfil']==4)
					{$this->affiche_menu_reservation();}
			?>
            </ul>
		</div>
	</div><!-- Page Sidebar -->

    
	<?php
	}
	
	private function affiche_menu_admin() {
	?>
                <li class="droplink"><a href="#" class="waves-effect waves-button">
                        <span class="menu-icon glyphicon glyphicon-user"></span><p>Compte</p><span class="arrow"></span></a>
                    <ul class="sub-menu">
                        <li><a href="profil.php?pbool=1">Utilisateur</a></li>
                        <li><a href="profil.php?pbool=2">Etablissement</a></li>
                        <li><a href="profil.php?pbool=3">Gestion Formations</a></li>
                        <li><a href="profil.php?pbool=4">Logo</a></li>
                        <li><a href="profil.php?pbool=5">Gestion des professeurs</a></li>
                        <li><a href="profil.php?pbool=6">Statistiques</a></li>
                    </ul>
                </li>

    			<li class="droplink"><a href="#" class="waves-effect waves-button">
                	<span class="menu-icon glyphicon glyphicon-edit"></span><p>Ajout</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li><a href="ADMajoutUtil.php">Ajout d'utilisateur</a></li>
                                <li><a href="ADMajoutForm.php">Ajout Formation</a></li>
                            </ul>
				 </li>
    
    			<li class="droplink"><a href="#" class="waves-effect waves-button">
                	<span class="menu-icon glyphicon glyphicon-list"></span><p>Listes</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li><a href="reservation.php">Réservations</a></li>
                                <li><a href="ListeMS.php">Mini-Stages</a></li>
                                <li><a href="ADMutilisateur.php">Utilisateurs</a></li>
                                <li><a href="ADMformation.php">Formations</a></li>
                                
                            </ul>
				</li>
                
                <li class="droplink"><a href="#" class="waves-effect waves-button"><p>Outils d'administration</p>
            		<span class="arrow"></span></a>
						<ul class="sub-menu">
							<li><a href="gestionsmtp.php">Gestion du SMTP</a></li>
						</ul>
				</li>
    <?php
	}
    
	private function affiche_menu_chef() {
	?>
                <li class="droplink"><a href="#" class="waves-effect waves-button">
                    <span class="menu-icon glyphicon glyphicon-user"></span><p>Compte</p><span class="arrow"></span></a>
                    <ul class="sub-menu">
                        <li><a href="profil.php?pbool=1">Utilisateur</a></li>
                        <li><a href="profil.php?pbool=2">Etablissement</a></li>
                        <li><a href="profil.php?pbool=3">Gestion Formations</a></li>
                        <li><a href="profil.php?pbool=4">Logo</a></li>
                        <li><a href="profil.php?pbool=5">Gestion des professeurs</a></li>
                        <li><a href="profil.php?pbool=6">Statistiques</a></li>
                    </ul>
                </li>

    			<li class="droplink"><a href="#" class="waves-effect waves-button">
                	<span class="menu-icon glyphicon glyphicon-list"></span><p>Mini-Stages</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                            	<li><a href="reservation.php">Réservations effectuées</a></li>
                            	<li><a href="reserver.php">Réserver un mini-stage</a></li>
                            	<li><a href="ajoutMS.php">Créer un Mini-stage </a></li>
                                <li><a href="ListeMS.php">Liste des Mini-stages</a></li>
                                
                            </ul>
				</li>
                
                    
                <li><a href="editconv.php" class="waves-effect waves-button">
                	<span class="menu-icon glyphicon glyphicon-log-in"></span><p>Edition de la convention</p></a>
                </li>
    <?php
	}
    
	private function affiche_menu_reservation() {
	?>
                <li class="droplink"><a href="#" class="waves-effect waves-button">
                        <span class="menu-icon glyphicon glyphicon-user"></span><p>Compte</p><span class="arrow"></span></a>
                    <ul class="sub-menu">
                        <li><a href="profil.php?pbool=1">Utilisateur</a></li>
                        <li><a href="profil.php?pbool=2">Etablissement</a></li>
                        <li><a href="profil.php?pbool=4">Logo</a></li>
                    </ul>
                </li>
    			<li class="droplink"><a href="#" class="waves-effect waves-button">
                	<span class="menu-icon glyphicon glyphicon-list"></span><p>Mini-Stages</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                            	<li><a href="reserver.php">Réserver un mini-stage</a></li>
                            </ul>
				</li>
    <?php
	}
	
	private function affiche_menu_prof() {
	?>
                <li class="droplink"><a href="#" class="waves-effect waves-button">
                        <span class="menu-icon glyphicon glyphicon-user"></span><p>Compte</p><span class="arrow"></span></a>
                    <ul class="sub-menu">
                        <li><a href="profil.php?pbool=1">Utilisateur</a></li>
                        <li><a href="profil.php?pbool=2">Etablissement</a></li>
                        <li><a href="profil.php?pbool=3">Gestion Formations</a></li>
                        <li><a href="profil.php?pbool=4">Logo</a></li>
                        <li><a href="profil.php?pbool=6">Statistiques</a></li>
                    </ul>
                </li>
    			<li class="droplink"><a href="#" class="waves-effect waves-button">
                	<span class="menu-icon glyphicon glyphicon-list"></span><p>Mini-Stages</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li><a href="reservation.php">Liste des réservations</a>
								<li><a href="ListeMS.php">Liste des Mini-stages</a></li>
                                
                                
                            </ul>
				</li>
    <?php
	}
	
	/******************************Gestion de l'affichage **********************************************/
	public function afficher() {
		
	?> 
    <!DOCTYPE html>
	<html>
		
		<head>
        
		<meta content="width=device-width, initial-scale=1" name="viewport"/>
    	<meta charset="UTF-8">
    	<meta name="description" content="Admin Dashboard Template" />
    	<meta name="keywords" content="admin,dashboard" />
    	<meta name="author" content="Steelcoders" />
        <link rel="icon" type="image/png" href="assets/images/avatar1.png" />
        <TITLE><?php echo $this->titre ?></TITLE>
			<?php  $this->affiche_style();?>
		</head>
        
			<?php $this->affiche_entete();?>
            <?php $this->affiche_menu(); ?>
            
            <div class="page-inner">
            	<div class="page-title">
                 	<h3><?php echo $this->titre ?></h3>
            	</div>
			<div id="main-wrapper">
                
				<?php echo $this->corps;?>
                    
			</div><!-- Main Wrapper -->
				<?php $this->affiche_footer(); ?>
        	</div><!-- Page Inner -->
        </main><!-- Page Content 
        
			<?php $this->affiche_script(); ?>
			
			
		</body>
	</html>
<?php 
	}
}
?>