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
                        <td style="text-align: left;"> ' . $data["nom_formation"] . ' </td>
                         <td style="text-align: center;">  ' . $data["nb_ministages"] . '</td>
                        </br>
                        </tr>';
                }
                $pageStats->corps .= '    
        </div>         
       </div>
        ';

            break ;
    }

    $pageStats->afficher();
}
