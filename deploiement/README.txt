Procédure pour le déploiement de l'application :

1 - Vérifier la connexion de la base de données dans le code :
    - Faire une sauvegarde de la base de données !
    - Dans le fichier deploiement.php, remplir le nom du domaine du site (hostname), le nom de l'utilisateur de phpmyadmin (user), le mot de passe (password) et le nom de la base de données
    avec les informations qui se trouvent dans le fichier Class/Connexion.class.php

2 - Vérifier la cohérence de la base de données :
    - Allez dans le gestionnaire de la base de données et executer cette requête : SELECT * FROM `t_utilisateur` WHERE length(RNE) != 8 OR RNE is NULL;
        On aura en résultat les comptes utilisateurs avec des RNE qui ne seront pas pris en compte par le déploiement
        Il est necéssaire de les modifier avant le traitement
    - Vérifier que les codes postaux sont complets : SELECT * FROM `t_utilisateur` WHERE length(CP) != 5;
    - Vérifier que l'utilisateur administrateur à l'id est égal à 1
    - Vérifier que les id des types de formations sont cohérents : SELECT * FROM `t_formation` where idtype not in (1,2,3,4,5,6,7,8);
    - Vérifier que les id des types d'établissements sont cohérents : SELECT * FROM `t_utilisateur` where idtype not in (1,2,3,4,5,6,7,8,9,10,11,12);
    - Vérifier que les id des académies sont cohérents : SELECT * FROM `t_utilisateur` where idacademie not in (select id from t_academie);

    - Faire les modifications nécessaires pour que les données soit cohérentes au risque de perdre une partie des données !

3 - Tout est prêt pour le déploiement !
    - Appuyer sur le bouton sur la page : http://ministages44.ac-nantes.fr/deploiement/deploiement.php
    - Attendre la fin du déploiement

4 - Changer le site internet
    - Faire une sauvegarde du site internet !
    - Changer le site internet avec le nouveau

5 - C'est fini
