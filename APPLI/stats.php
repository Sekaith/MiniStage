<?php
session_start();
if (is_null($_SESSION['ID'])) {
    header('Location: index.php');
}

require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');
include_once('requete/rqtProfil.php');
include_once('requete/rqtStatistique.php');
$pageStats = new page_base('Stats');

$Profil = get_profil();


$idetab = isset($Profil["idetab"]) ? $Profil["idetab"] : "";


if (isset($_GET["sbool"])) {

    switch ($_GET["sbool"]) {

        case "1" :
            $pageStats->corps .= '
            <div class="panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title"><p><center>Nombre de mini_stages par formation</center></p></h4>
                </div>
                <div class="panel-body">
                
                </br>
        <a href="profil.php?pbool=6"><button align="centers" class="btn btn-success">Liste des statistiques</button></a></br>
        </br>
        <table class="table" width="600" height="100" style="text-align: center;" >
                    <thead>
                			<th style="text-align: left;">Nom des formations : </th>
                			<th style="text-align: center;">Nombre de ministages : </th>
                    </thead>
       ';

             $nbMSform = getNbMSform();

                while ($data = mysqli_fetch_array($nbMSform)) {

                    $pageStats->corps .=
                        '<tr id="td' . $data['idformation'] . '"> 
                        <td style="text-align: left;">' . $data["nom_typeformation"] . ' ' . $data["nom_formation"] . ' </td>
                         <td style="text-align: center;">  ' . $data["nb_ministages"] . '</td>
                        
                        </tr>';
                }
                $pageStats->corps .= '    
        </div>         
       </div>
        ';

            break ;

        case 2 :
            $pageStats->corps .= '
            <div class="panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title"><p><center>Nombre de places par formation</center></p></h4>
                </div>
                <div class="panel-body">
                
                </br>
        <a href="profil.php?pbool=6"><button align="centers" class="btn btn-success">Liste des statistiques</button></a></br>
        </br>
        <table class="table" width="600" height="100" style="text-align: center;" >
                    <thead>
                			<th style="text-align: left;">Nom des formations : </th>
                			<th style="text-align: center;">Nombre de places : </th>
                    </thead>
       ';

            $nbPlcform = getNbPlaceform();

            while ($data = mysqli_fetch_array($nbPlcform)) {

                $pageStats->corps .=
                    '<tr id="td' . $data['idformation'] . '"> 
                        <td style="text-align: left;"> ' . $data["nom_typeformation"] . ' ' . $data["nom_formation"] . ' </td>
                         <td style="text-align: center;">  ' . $data["Nb_places"] . '</td>
                        
                        </tr>';
            }
            $pageStats->corps .= '    
        </div>         
       </div>
        ';
            break;

        case 3 :
            $pageStats->corps .= '
            <div class="panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title"><p><center>Nombre de réservation par formation</center></p></h4>
                </div>
                <div class="panel-body">
                
                </br>
        <a href="profil.php?pbool=6"><button align="centers" class="btn btn-success">Liste des statistiques</button></a></br>
        </br>
        <table class="table" width="600" height="100" style="text-align: center;" >
                    <thead>
                			<th style="text-align: left;">Nom des formations : </th>
                			<th style="text-align: center;">Nombre de réservations : </th>
                    </thead>
       ';

            $nbResaform = getNbResaForm();

            while ($data = mysqli_fetch_array($nbResaform)) {

                $pageStats->corps .=
                    '<tr id="td' . $data['idformation'] . '"> 
                        <td style="text-align: left;"> ' . $data["nom_typeformation"] . ' ' . $data["nom_formation"] . ' </td>
                         <td style="text-align: center;">  ' . $data["Nb_reserv_actee"] . '</td>
                        
                        </tr>';
            }
            $pageStats->corps .= '    
        </div>         
       </div>
        ';
            break;

        case 4 :
            $pageStats->corps .= '
            <div class="panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title"><p><center>Classement des établissements par réservations</center></p></h4>
                </div>
                <div class="panel-body">
                
                </br>
        <a href="profil.php?pbool=6"><button align="centers" class="btn btn-success">Liste des statistiques</button></a></br>
        </br>
        <table class="table" width="600" height="100" style="text-align: center;" >
                    <thead>
                			<th style="text-align: left;">Nom des établissements : </th>
                			<th style="text-align: center;">Nombre de réservations : </th>
                    </thead>
       ';

            $rankEtab = getEtabResa();

            while ($data = mysqli_fetch_array($rankEtab)) {

                $pageStats->corps .=
                    '<tr id="td' . $data['idetab'] . '"> 
                        <td style="text-align: left;"> ' . $data["nom_typeetab"] . ' ' . $data["nometab"] . ' </td>
                         <td style="text-align: center;">  ' . $data["Nb_reserv"] . '</td>
                        
                        </tr>';
            }
            $pageStats->corps .= '    
        </div>         
       </div>
        ';
            break;

        case 5 :
            $pageStats->corps .= '
            <div class="panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title"><p><center>Classement des établissements par réservations annulées</center></p></h4>
                </div>
                <div class="panel-body">
                
                </br>
        <a href="profil.php?pbool=6"><button align="centers" class="btn btn-success">Liste des statistiques</button></a></br>
        </br>
        <table class="table" width="600" height="100" style="text-align: center;" >
                    <thead>
                			<th style="text-align: left;">Nom des établissements : </th>
                			<th style="text-align: center;">Nombre de réservations annulées : </th>
                    </thead>
       ';

            $rankEtabCancel = getEtabResaAnnul();

            while ($data = mysqli_fetch_array($rankEtabCancel)) {

                $pageStats->corps .=
                    '<tr id="td' . $data['idetab'] . '"> 
                        <td style="text-align: left;"> ' . $data["nom_typeetab"] . ' ' . $data["nometab"] . ' </td>
                         <td style="text-align: center;">  ' . $data["Nb_reserv_annulee"] . '</td>
                        
                        </tr>';
            }
            $pageStats->corps .= '    
        </div>         
       </div>
        ';
            break;

        case 6 :
            $pageStats->corps .= '
            <div class="panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title"><p><center>Classement des établissements par nombre d\'absences</center></p></h4>
                </div>
                <div class="panel-body">
                
                </br>
        <a href="profil.php?pbool=6"><button align="centers" class="btn btn-success">Liste des statistiques</button></a></br>
        </br>
        <table class="table" width="600" height="100" style="text-align: center;" >
                    <thead>
                			<th style="text-align: left;">Nom des établissements : </th>
                			<th style="text-align: center;">Nombre d\'absences : </th>
                    </thead>
       ';

            $rankEtabAbs = getEtabNbAbs();

            while ($data = mysqli_fetch_array($rankEtabAbs)) {

                $pageStats->corps .=
                    '<tr id="td' . $data['idetab'] . '"> 
                        <td style="text-align: left;"> ' . $data["nom_typeetab"] . ' ' . $data["nometab"] . ' </td>
                         <td style="text-align: center;">  ' . $data["Nb_absences"] . '</td>
                        
                        </tr>';
            }
            $pageStats->corps .= '    
        </div>         
       </div>
        ';
            break;

        case 7 :
            $pageStats->corps .= '
            <div class="panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title"><p><center>Nombre de réservations par formation de votre établissement</center></p></h4>
                </div>
                <div class="panel-body">
                
                </br>
        <a href="profil.php?pbool=6"><button align="centers" class="btn btn-success">Liste des statistiques</button></a></br>
        </br>
        <table class="table" width="600" height="100" style="text-align: center;" >
                    <thead>
                			<th style="text-align: left;">Nom des formation : </th>
                			<th style="text-align: center;">Nombre de réservations : </th>
                    </thead>
       ';

            $EtabNbResaForm = getResaFormEtab();

            while ($data = mysqli_fetch_array($EtabNbResaForm)) {

                $pageStats->corps .=
                    '<tr id="td' . $data['idformation'] . '"> 
                        <td style="text-align: left;"> ' . $data["nom_typeformation"] . ' ' . $data["nom_formation"] . ' </td>
                         <td style="text-align: center;">  ' . $data["nbreserv"] . '</td>
                        
                        </tr>';
            }
            $pageStats->corps .= '    
        </div>         
       </div>
        ';
            break;
    }

    $pageStats->afficher();

}
