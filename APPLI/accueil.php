<?php
session_start();
if(is_null($_SESSION['ID']))
{header('Location: index.php');}

require_once('Class/autoload.php');
require_once('Class/Connexion.class.php');

//Création de la page d'accueil
$pageAccueil = new page_base('Accueil');

if ($_SESSION['IdProfil']!=1)
{ header('Location: reservation.php'); }

$pageAccueil->afficher();
            
?>