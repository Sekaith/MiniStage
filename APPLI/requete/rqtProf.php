<?php
//Insertion d'un professeur
function insertProfesseur(){

        global $mysqli;

        $rqt = 'INSERT INTO t_professeur (nom_prof, prenom_prof, civilite, idetab) VALUES ( "'.$_POST['nomprof'].'","'.$_POST['prenomprof'].'"
        ,"'.$_POST['civilite'].'", '.$_POST['idetab'].')';

    mysqli_query($mysqli,$rqt) or exit(mysqli_error($mysqli));

}


?>