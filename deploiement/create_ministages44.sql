-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 08 fév. 2023 à 14:56
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ministages44_2`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_academie`
--

DROP TABLE IF EXISTS `t_academie`;
CREATE TABLE IF NOT EXISTS `t_academie` (
  `idacademie` int(2) NOT NULL AUTO_INCREMENT,
  `nom_academie` varchar(25) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idacademie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `t_compte`
--

DROP TABLE IF EXISTS `t_compte`;
CREATE TABLE IF NOT EXISTS `t_compte` (
  `idcompte` int(5) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(25) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(25) COLLATE utf8_bin NOT NULL,
  `idprofil` int(2) NOT NULL,
  `nom_compte` varchar(50) COLLATE utf8_bin NOT NULL,
  `prenom_compte` varchar(50) COLLATE utf8_bin NOT NULL,
  `mail_compte` varchar(50) COLLATE utf8_bin NOT NULL,
  `idfonction` int(2) NOT NULL,
  `tel` varchar(20) COLLATE utf8_bin NOT NULL,
  `idetab` int(5) NOT NULL,
  `dateCreation` DATETIME NULL,
  PRIMARY KEY (`idcompte`),
  KEY `FK_CompteToEtab` (`idetab`),
  KEY `FK_CompteToFonction` (`idfonction`),
  KEY `FK_CompteToProfil` (`idprofil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `t_etablissement`
--

DROP TABLE IF EXISTS `t_etablissement`;
CREATE TABLE IF NOT EXISTS `t_etablissement` (
  `idetab` int(5) NOT NULL AUTO_INCREMENT,
  `nometab` varchar(50) COLLATE utf8_bin ,
  `idtypeetab` int(2) ,
  `ville` varchar(100) COLLATE utf8_bin ,
  `adresse` varchar(150) COLLATE utf8_bin ,
  `mailetab` varchar(50) COLLATE utf8_bin ,
  `idacademie` int(2) ,
  `cp` int(5) DEFAULT NULL,
  `logo` text COLLATE utf8_bin ,
  `cachet` text COLLATE utf8_bin ,
  `important` text COLLATE utf8_bin ,
  `important2` text COLLATE utf8_bin ,
  `RNE` varchar(50) COLLATE utf8_bin ,
  PRIMARY KEY (`idetab`),
  KEY `FK_EtabToAcademie` (`idacademie`),
  KEY `FK_EtabToTypeetab` (`idtypeetab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `t_fonction`
--

DROP TABLE IF EXISTS `t_fonction`;
CREATE TABLE IF NOT EXISTS `t_fonction` (
  `idfonction` int(2) NOT NULL AUTO_INCREMENT,
  `nom_fonct` varchar(25) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idfonction`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `t_formation`
--

DROP TABLE IF EXISTS `t_formation`;
CREATE TABLE IF NOT EXISTS `t_formation` (
  `idformation` int(5) NOT NULL AUTO_INCREMENT,
  `idtypeform` int(5) NOT NULL,
  `nom_formation` varchar(250) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idformation`),
  KEY `FK_FormationToTypeform` (`idtypeform`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `t_formation_compte`
--

DROP TABLE IF EXISTS `t_formation_compte`;
CREATE TABLE IF NOT EXISTS `t_formation_compte` (
  `idformation` int(5) NOT NULL,
  `idcompte` int(5) NOT NULL,
  PRIMARY KEY (`idformation`,`idcompte`),
  KEY `FK_Formation_CompteToCompte` (`idcompte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `t_ministage`
--

DROP TABLE IF EXISTS `t_ministage`;
CREATE TABLE IF NOT EXISTS `t_ministage` (
  `idministage` int(5) NOT NULL AUTO_INCREMENT,
  `idOffrant` int(5) NOT NULL,
  `idformation` int(5) NOT NULL,
  `idProf` int(5) ,
  `date` date NOT NULL,
  `hdebut` varchar(5) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `hfin` varchar(5) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nbplace` int(5) NOT NULL,
  `lieu` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idministage`),
  KEY `FK_MinistageToCompte` (`idOffrant`),
  KEY `FK_MinistageToFormation` (`idformation`),
  KEY `FK_MinistageToProfesseur` (`idProf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_professeur`
--

DROP TABLE IF EXISTS `t_professeur`;
CREATE TABLE IF NOT EXISTS `t_professeur` (
  `idProf` int(2) NOT NULL AUTO_INCREMENT,
  `nom_prof` varchar(25) COLLATE utf8_bin NOT NULL,
  `prenom_prof` varchar(25) COLLATE utf8_bin NOT NULL,
  `civilite` varchar(4) COLLATE utf8_bin NOT NULL,
  `idetab` int(5) NOT NULL,
  PRIMARY KEY (`idProf`),
  KEY `FK_ProfesseurToEtab` (`idetab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `t_profil`
--

DROP TABLE IF EXISTS `t_profil`;
CREATE TABLE IF NOT EXISTS `t_profil` (
  `idprofil` int(2) NOT NULL AUTO_INCREMENT,
  `nom_profil` varchar(25) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idprofil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `t_reservation`
--

DROP TABLE IF EXISTS `t_reservation`;
CREATE TABLE IF NOT EXISTS `t_reservation` (
  `idreserv` int(5) NOT NULL AUTO_INCREMENT,
  `idministage` int(5) NOT NULL,
  `nom_eleve` varchar(30) COLLATE utf8_bin NOT NULL,
  `prenom_eleve` varchar(30) COLLATE utf8_bin NOT NULL,
  `idReservant` int(5) NOT NULL,
  `confirmation` tinyint(1) NOT NULL,
  `rappel` smallint(1) NOT NULL,
  `absence` smallint(1) NOT NULL,
  PRIMARY KEY (`idreserv`),
  KEY `FK_ReservationToCompte` (`idReservant`),
  KEY `FK_ReservationToMinistage` (`idministage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `t_typeetab`
--

DROP TABLE IF EXISTS `t_typeetab`;
CREATE TABLE IF NOT EXISTS `t_typeetab` (
  `idtypeetab` int(5) NOT NULL AUTO_INCREMENT,
  `nom_typeetab` varchar(25) CHARACTER SET utf8 NOT NULL,
  `nomcourt_typeetab` varchar(5) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idtypeetab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `t_typeformation`
--

DROP TABLE IF EXISTS `t_typeformation`;
CREATE TABLE IF NOT EXISTS `t_typeformation` (
  `idtypeform` int(5) NOT NULL AUTO_INCREMENT,
  `nom_typeformation` varchar(50) COLLATE utf8_bin NOT NULL,
  `nomcourt_typeformation` varchar(13) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idtypeform`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_compte`
--
ALTER TABLE `t_compte`
  ADD CONSTRAINT `FK_CompteToEtab` FOREIGN KEY (`idetab`) REFERENCES `t_etablissement` (`idetab`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CompteToFonction` FOREIGN KEY (`idfonction`) REFERENCES `t_fonction` (`idfonction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CompteToProfil` FOREIGN KEY (`idprofil`) REFERENCES `t_profil` (`idprofil`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_etablissement`
--
ALTER TABLE `t_etablissement`
  ADD CONSTRAINT `FK_EtabToAcademie` FOREIGN KEY (`idacademie`) REFERENCES `t_academie` (`idacademie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_EtabToTypeetab` FOREIGN KEY (`idtypeetab`) REFERENCES `t_typeetab` (`idtypeetab`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_formation`
--
ALTER TABLE `t_formation`
  ADD CONSTRAINT `FK_FormationToTypeform` FOREIGN KEY (`idtypeform`) REFERENCES `t_typeformation` (`idtypeform`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_formation_compte`
--
ALTER TABLE `t_formation_compte`
  ADD CONSTRAINT `FK_Formation_CompteToCompte` FOREIGN KEY (`idcompte`) REFERENCES `t_compte` (`idcompte`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Formation_CompteToFormation` FOREIGN KEY (`idformation`) REFERENCES `t_formation` (`idformation`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_ministage`
--
ALTER TABLE `t_ministage`
  ADD CONSTRAINT `FK_MinistageToCompte` FOREIGN KEY (`idOffrant`) REFERENCES `t_compte` (`idcompte`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MinistageToFormation` FOREIGN KEY (`idformation`) REFERENCES `t_formation` (`idformation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MinistageToProfesseur` FOREIGN KEY (`idProf`) REFERENCES `t_professeur` (`idProf`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_professeur`
--
ALTER TABLE `t_professeur`
  ADD CONSTRAINT `FK_ProfesseurToEtab` FOREIGN KEY (`idetab`) REFERENCES `t_etablissement` (`idetab`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_reservation`
--
ALTER TABLE `t_reservation`
  ADD CONSTRAINT `FK_ReservationToCompte` FOREIGN KEY (`idReservant`) REFERENCES `t_compte` (`idcompte`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ReservationToMinistage` FOREIGN KEY (`idministage`) REFERENCES `t_ministage` (`idministage`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
