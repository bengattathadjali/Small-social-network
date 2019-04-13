-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  sam. 13 avr. 2019 à 02:20
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.3.1

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

CREATE TABLE `dirige` (
  `matricule_personnel` varchar(50) NOT NULL,
  `id_promo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `nom` char(50) DEFAULT NULL,
  `prenom` char(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `motDePasse` varchar(50) DEFAULT NULL,
  `matricule_enseignant` varchar(50) NOT NULL,
  `EmailConfirm` tinyint(4) NOT NULL,
  `token` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `enseigne`
--

CREATE TABLE `enseigne` (
  `matricule_enseignant` varchar(50) NOT NULL,
  `id_promo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `nom` char(50) DEFAULT NULL,
  `prenom` char(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `motDePasse` varchar(50) DEFAULT NULL,
  `EmailConfirm` tinyint(4) NOT NULL,
  `token` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE `personnel` (
  `nom` char(50) DEFAULT NULL,
  `prenom` char(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `motDePasse` varchar(50) DEFAULT NULL,
  `matricule_personnel` varchar(50) NOT NULL,
  `EmailConfirm` tinyint(4) NOT NULL,
  `token` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `promo`
--

CREATE TABLE `promo` (
  `id_promo` int(50) NOT NULL,
  `intitule` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `promo`
--

INSERT INTO `promo` (`id_promo`, `intitule`) VALUES
(1, 'Rsi'),
(2, 'IBD'),
(3, 'Automatisme'),
(4, 'Électronique'),
(5, 'Archive'),
(6, 'Secrétariat'),
(7, 'ASRI');

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE `publication` (
  `id_publication` int(11) NOT NULL,
  `datePublication` datetime DEFAULT NULL,
  `contenu` text,
  `matricule_personnel` varchar(50) DEFAULT NULL,
  `matricule_enseignant` varchar(50) DEFAULT NULL,
  `id_promo` int(11) DEFAULT NULL,
  `name_file` varchar(50) NOT NULL,
  `mime_file` varchar(50) NOT NULL,
  `data_file` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `dirige`
--
ALTER TABLE `dirige`
  ADD PRIMARY KEY (`matricule_personnel`,`id_promo`),
  ADD KEY `FK_dirige_id_promo` (`id_promo`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`matricule_enseignant`);

--
-- Index pour la table `enseigne`
--
ALTER TABLE `enseigne`
  ADD PRIMARY KEY (`matricule_enseignant`,`id_promo`),
  ADD KEY `FK_enseigne_id_promo` (`id_promo`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`matricule_personnel`);

--
-- Index pour la table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`);

--
-- Index pour la table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`id_publication`),
  ADD KEY `FK_Publication_matricule_personnel` (`matricule_personnel`),
  ADD KEY `FK_Publication_matricule_enseignant` (`matricule_enseignant`),
  ADD KEY `FK_Publication_id_promo` (`id_promo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `promo`
--
ALTER TABLE `promo`
  MODIFY `id_promo` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `publication`
--
ALTER TABLE `publication`
  MODIFY `id_publication` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
