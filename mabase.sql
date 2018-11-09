-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 14 mai 2018 à 12:40
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

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
-- Structure de la table `consulter`
--

DROP TABLE IF EXISTS `consulter`;
CREATE TABLE IF NOT EXISTS `consulter` (
  `matricule` varchar(255) NOT NULL,
  `id_publication` int(11) NOT NULL,
  PRIMARY KEY (`matricule`,`id_publication`),
  KEY `FK_consulter_id_publication` (`id_publication`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `dirige`
--

DROP TABLE IF EXISTS `dirige`;
CREATE TABLE IF NOT EXISTS `dirige` (
  `matricule_personnel` varchar(255) NOT NULL,
  `id_promo` int(11) NOT NULL,
  PRIMARY KEY (`matricule_personnel`,`id_promo`),
  KEY `FK_dirige_id_promo` (`id_promo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dirige`
--

INSERT INTO `dirige` (`matricule_personnel`, `id_promo`) VALUES
('P04', 2),
('P04', 3);

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE IF NOT EXISTS `enseignant` (
  `nom` char(255) DEFAULT NULL,
  `prenom` char(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `motDePasse` varchar(255) DEFAULT NULL,
  `matricule_enseignant` varchar(255) NOT NULL,
  PRIMARY KEY (`matricule_enseignant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`nom`, `prenom`, `email`, `motDePasse`, `matricule_enseignant`) VALUES
('LATROCH', 'BACHIR', 'latroch@gmail.com', '151aad7698c1105e7c094f5315706b7c', 'E02'),
('ABID', 'MERIEM', 'abid@gmail.com', '151aad7698c1105e7c094f5315706b7c', 'E07'),
('HENNI', 'FOUAD', 'henni@gmail.com', '151aad7698c1105e7c094f5315706b7c', 'E43');

-- --------------------------------------------------------

--
-- Structure de la table `enseigne`
--

DROP TABLE IF EXISTS `enseigne`;
CREATE TABLE IF NOT EXISTS `enseigne` (
  `matricule_enseignant` varchar(255) NOT NULL,
  `id_promo` int(11) NOT NULL,
  PRIMARY KEY (`matricule_enseignant`,`id_promo`),
  KEY `FK_enseigne_id_promo` (`id_promo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `enseigne`
--

INSERT INTO `enseigne` (`matricule_enseignant`, `id_promo`) VALUES
('E07', 2),
('E07', 3),
('E07', 4),
('E02', 5),
('E07', 5),
('E07', 7);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `nom` char(255) DEFAULT NULL,
  `prenom` char(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `motDePasse` varchar(255) DEFAULT NULL,
  `matricule` varchar(255) NOT NULL,
  `id_promo` int(11) DEFAULT NULL,
  PRIMARY KEY (`matricule`),
  KEY `FK_Etudiant_id_promo` (`id_promo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`nom`, `prenom`, `email`, `motDePasse`, `matricule`, `id_promo`) VALUES
('BENHALIMA', 'MOUNIR', 'benhalima@mounir.com', '151aad7698c1105e7c094f5315706b7c', 'A141414', 2),
('BENGATTAT', 'HADJ ALI', 'bengattat@gmail.com', '14b3abeaa1bb5b452f70c26237f4428f', 'A153703', 2),
('BENBERNOU', 'YASSER', 'benyasser@gmail.com', '151aad7698c1105e7c094f5315706b7c', 'A213242', 4),
('KHELIL', 'YACINE', 'khelil@gmail.com', '151aad7698c1105e7c094f5315706b7c', 'A354332', 5),
('BENDJALOUL', 'NOUREDDINE', 'bendji@benz.com', '151aad7698c1105e7c094f5315706b7c', 'A544332', 2);

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE IF NOT EXISTS `personnel` (
  `nom` char(255) DEFAULT NULL,
  `prenom` char(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `motDePasse` varchar(255) DEFAULT NULL,
  `matricule_personnel` varchar(255) NOT NULL,
  PRIMARY KEY (`matricule_personnel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`nom`, `prenom`, `email`, `motDePasse`, `matricule_personnel`) VALUES
('MALTI', 'HBIB', 'malti@gmail.com', '151aad7698c1105e7c094f5315706b7c', 'P04'),
('ABDELLAH', 'ISMAIL', NULL, NULL, 'P07'),
('BENSMAINE', 'MEJDOUB', NULL, NULL, 'P09'),
('BENHLIMA', 'MOHAMMED', NULL, NULL, 'P20'),
('HAMADI', 'ABDELKADER', NULL, NULL, 'P30'),
('MENAD', 'MOHAMMED', 'menad@gmail.com', '151aad7698c1105e7c094f5315706b7c', 'P32'),
('BENDANI', 'AMINE', NULL, NULL, 'P43'),
('KHELIL', 'MOURAD', NULL, NULL, 'P44'),
('BENDANI', 'KADDOUR', NULL, NULL, 'P73'),
('LATROCH', 'MOHAMMED', NULL, NULL, 'P90');

-- --------------------------------------------------------

--
-- Structure de la table `promo`
--

DROP TABLE IF EXISTS `promo`;
CREATE TABLE IF NOT EXISTS `promo` (
  `id_promo` int(255) NOT NULL AUTO_INCREMENT,
  `intitule` char(255) DEFAULT NULL,
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
  `matricule_personnel` varchar(255) DEFAULT NULL,
  `matricule_enseignant` varchar(255) DEFAULT NULL,
  `id_promo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_publication`),
  KEY `FK_Publication_matricule_personnel` (`matricule_personnel`),
  KEY `FK_Publication_matricule_enseignant` (`matricule_enseignant`),
  KEY `FK_Publication_id_promo` (`id_promo`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`id_publication`, `datePublication`, `contenu`, `matricule_personnel`, `matricule_enseignant`, `id_promo`) VALUES
(23, '2018-04-27 00:44:04', 'bonjour les geek', NULL, 'E07', 3),
(25, '2018-04-24 04:06:12', 'bonjour 2', NULL, 'E43', 2),
(26, '2018-04-27 02:26:02', 'bonsoir', NULL, 'E07', 3),
(27, '2018-04-27 02:26:21', 'bonne nuit', NULL, 'E07', 3),
(36, '2018-04-29 23:01:08', 'bonjour je suis abid', NULL, 'E07', 2),
(37, '2018-05-03 10:15:38', 'bonjour les geek', NULL, 'E07', 2),
(38, '2018-05-03 10:47:57', 'bonjour on est jeudi ', NULL, 'E07', 2),
(39, '2018-05-03 10:47:57', 'bonjour on est jeudi ', NULL, 'E07', 3),
(40, '2018-05-03 10:47:57', 'bonjour on est jeudi ', NULL, 'E07', 4),
(41, '2018-05-03 10:47:57', 'bonjour on est jeudi ', NULL, 'E07', 5),
(42, '2018-05-03 10:47:57', 'bonjour on est jeudi ', NULL, 'E07', 7),
(43, '2018-05-03 10:58:39', 'test', NULL, 'E07', 5),
(44, '2018-05-03 11:19:47', 'je suis bachir', NULL, 'E02', 5),
(46, '2018-05-04 00:50:32', 'bonjour les examens seront remporté', 'P04', NULL, 3),
(47, '2018-05-04 00:50:39', 'annulation', 'P04', NULL, 3),
(48, '2018-05-14 13:20:06', 'bonjour les gens', 'P04', NULL, 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `consulter`
--
ALTER TABLE `consulter`
  ADD CONSTRAINT `FK_consulter_id_publication` FOREIGN KEY (`id_publication`) REFERENCES `publication` (`id_publication`),
  ADD CONSTRAINT `FK_consulter_matricule` FOREIGN KEY (`matricule`) REFERENCES `etudiant` (`matricule`);

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
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `FK_Etudiant_id_promo` FOREIGN KEY (`id_promo`) REFERENCES `promo` (`id_promo`);

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
