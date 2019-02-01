-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 24 déc. 2018 à 23:31
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mabase`
--

-- --------------------------------------------------------

--
-- Structure de la table `dirige`
--

DROP TABLE IF EXISTS `dirige`;
CREATE TABLE IF NOT EXISTS `dirige` (
  `matricule_personnel` varchar(50) NOT NULL,
  `id_promo` int(11) NOT NULL,
  PRIMARY KEY (`matricule_personnel`,`id_promo`),
  KEY `FK_dirige_id_promo` (`id_promo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE IF NOT EXISTS `enseignant` (
  `nom` char(50) DEFAULT NULL,
  `prenom` char(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `motDePasse` varchar(50) DEFAULT NULL,
  `matricule_enseignant` varchar(50) NOT NULL,
  `EmailConfirm` tinyint(4) NOT NULL,
  `token` varchar(250) NOT NULL,
  PRIMARY KEY (`matricule_enseignant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `enseigne`
--

DROP TABLE IF EXISTS `enseigne`;
CREATE TABLE IF NOT EXISTS `enseigne` (
  `matricule_enseignant` varchar(50) NOT NULL,
  `id_promo` int(11) NOT NULL,
  PRIMARY KEY (`matricule_enseignant`,`id_promo`),
  KEY `FK_enseigne_id_promo` (`id_promo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `nom` char(50) DEFAULT NULL,
  `prenom` char(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `motDePasse` varchar(50) DEFAULT NULL,
  `EmailConfirm` tinyint(4) NOT NULL,
  `token` varchar(250) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE IF NOT EXISTS `personnel` (
  `nom` char(50) DEFAULT NULL,
  `prenom` char(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `motDePasse` varchar(50) DEFAULT NULL,
  `matricule_personnel` varchar(50) NOT NULL,
  `EmailConfirm` tinyint(4) NOT NULL,
  `token` varchar(250) NOT NULL,
  PRIMARY KEY (`matricule_personnel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `promo`
--

DROP TABLE IF EXISTS `promo`;
CREATE TABLE IF NOT EXISTS `promo` (
  `id_promo` int(50) NOT NULL AUTO_INCREMENT,
  `intitule` char(50) DEFAULT NULL,
  PRIMARY KEY (`id_promo`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `promo`
--

INSERT INTO `promo` (`id_promo`, `intitule`) VALUES
(1, 'L1-SM'),
(2, 'L1-MI'),
(3, 'L2-INFORMATIQUE'),
(4, 'L2-MATHEMATIQUE'),
(5, 'L2-CHIME'),
(6, 'L2-PHYSIQUE'),
(7, 'L3-INFORMATIQUE'),
(8, 'L3-MATHEMATIQUE'),
(9, 'L3-CHIMIE'),
(10, 'L3-PHYSIQUE'),
(11, 'M1-SIG'),
(12, 'M1-ISI'),
(13, 'M1-MATH_FOND'),
(14, 'M1-CHIMIE_FOND'),
(15, 'M1-PHYSIQU'),
(16, 'M2-SIG'),
(17, 'M2-ISI'),
(18, 'M2-MATH_FOND'),
(19, 'M2-CHIMIE_FOND'),
(20, 'M2-PHYSIQUE');

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

DROP TABLE IF EXISTS `publication`;
CREATE TABLE IF NOT EXISTS `publication` (
  `id_publication` int(11) NOT NULL AUTO_INCREMENT,
  `datePublication` datetime DEFAULT NULL,
  `contenu` text,
  `matricule_personnel` varchar(50) DEFAULT NULL,
  `matricule_enseignant` varchar(50) DEFAULT NULL,
  `id_promo` int(11) DEFAULT NULL,
  `name_file` varchar(50) NOT NULL,
  `mime_file` varchar(50) NOT NULL,
  `data_file` longblob,
  PRIMARY KEY (`id_publication`),
  KEY `FK_Publication_matricule_personnel` (`matricule_personnel`),
  KEY `FK_Publication_matricule_enseignant` (`matricule_enseignant`),
  KEY `FK_Publication_id_promo` (`id_promo`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `dirige`
--
ALTER TABLE `dirige`
  ADD CONSTRAINT `FK_dirige_id_promo` FOREIGN KEY (`id_promo`) REFERENCES `promo` (`id_promo`),
  ADD CONSTRAINT `FK_dirige_matricule_personnel` FOREIGN KEY (`matricule_personnel`) REFERENCES `personnel` (`matricule_personnel`);

--
-- Contraintes pour la table `enseigne`
--
ALTER TABLE `enseigne`
  ADD CONSTRAINT `FK_enseigne_id_promo` FOREIGN KEY (`id_promo`) REFERENCES `promo` (`id_promo`),
  ADD CONSTRAINT `FK_enseigne_matricule_enseignant` FOREIGN KEY (`matricule_enseignant`) REFERENCES `enseignant` (`matricule_enseignant`);

--
-- Contraintes pour la table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `FK_Publication_id_promo` FOREIGN KEY (`id_promo`) REFERENCES `promo` (`id_promo`),
  ADD CONSTRAINT `FK_Publication_matricule_enseignant` FOREIGN KEY (`matricule_enseignant`) REFERENCES `enseignant` (`matricule_enseignant`),
  ADD CONSTRAINT `FK_Publication_matricule_personnel` FOREIGN KEY (`matricule_personnel`) REFERENCES `personnel` (`matricule_personnel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
