-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 01 mai 2020 à 12:17
-- Version du serveur :  10.2.6-MariaDB-log
-- Version de PHP : 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bidy`
--

-- --------------------------------------------------------

--
-- Structure de la table `approvisionnement`
--

CREATE TABLE `approvisionnement` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin NOT NULL,
  `montant` int(11) NOT NULL,
  `fournisseur_id` int(11) NOT NULL,
  `operation_id` int(11) DEFAULT NULL,
  `datelivraison` datetime DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin DEFAULT NULL,
  `employe_id_reception` int(11) DEFAULT NULL,
  `visibility` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `approvisionnement`
--

INSERT INTO `approvisionnement` (`id`, `reference`, `montant`, `fournisseur_id`, `operation_id`, `datelivraison`, `etat_id`, `employe_id`, `comment`, `employe_id_reception`, `visibility`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'INITIAL', 0, 1, 3, NULL, 3, 0, 'approvisionnemnt initial, système !', NULL, 0, '2020-04-26 19:39:52', '2020-04-26 19:39:52', 1, 1),
(2, 'APP/27042020-8BA97F', 507500, 1, 5, NULL, 3, 1, NULL, NULL, 1, '2020-04-27 10:49:30', '2020-04-27 10:49:30', 0, 1),
(3, 'APP/01052020-7BFAC0', 151800, 1, 16, NULL, 2, 1, NULL, NULL, 1, '2020-05-01 04:38:23', '2020-05-01 04:38:23', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `carplan`
--

CREATE TABLE `carplan` (
  `id` int(11) NOT NULL,
  `matricule` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `sexe_id` int(2) DEFAULT NULL,
  `adresse` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `contact` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `fonction` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `login` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `password` text COLLATE utf8_bin DEFAULT NULL,
  `is_new` int(11) NOT NULL DEFAULT 0,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `allowed` int(11) NOT NULL DEFAULT 1,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1,
  `visibility` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `categorieoperation`
--

CREATE TABLE `categorieoperation` (
  `id` int(11) NOT NULL,
  `typeoperationcaisse_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `color` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `categorieoperation`
--

INSERT INTO `categorieoperation` (`id`, `typeoperationcaisse_id`, `name`, `color`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 'Réglement de commande', '#60dfd2', '2020-04-26 19:39:50', '2020-04-26 19:39:50', 1, 1),
(2, 1, 'Autre entrée en caisse', '#ffffff', '2020-04-26 19:39:50', '2020-04-26 19:39:50', 1, 1),
(3, 2, 'Réglement de facture d\'approvisionnemnt', '#ffffff', '2020-04-26 19:39:50', '2020-04-26 19:39:50', 1, 1),
(4, 2, 'Payement de salaire du personnel', '#ffffff', '2020-04-26 19:39:50', '2020-04-26 19:39:50', 1, 1),
(5, 2, 'Réglement de facture de reparation / d\'entretien', '#ffffff', '2020-04-26 19:39:50', '2020-04-26 19:39:50', 1, 1),
(6, 2, 'Remboursement du client', '#ffffff', '2020-04-26 19:39:50', '2020-04-26 19:39:50', 1, 1),
(7, 2, 'Autre dépense', '#ffffff', '2020-04-26 19:39:51', '2020-04-26 19:39:51', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `chauffeur`
--

CREATE TABLE `chauffeur` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `matricule` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `sexe_id` int(2) NOT NULL,
  `nationalite` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `adresse` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `typepermis` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `numero_permis` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `date_fin_permis` date DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `contact` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `salaire` int(11) NOT NULL,
  `etatchauffeur_id` int(11) NOT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `visibility` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `chauffeur`
--

INSERT INTO `chauffeur` (`id`, `name`, `lastname`, `matricule`, `sexe_id`, `nationalite`, `adresse`, `typepermis`, `numero_permis`, `date_fin_permis`, `email`, `contact`, `salaire`, `etatchauffeur_id`, `image`, `visibility`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'SON PROPRE CHAUFFEUR', '.', NULL, 1, NULL, '...', '...', NULL, NULL, NULL, '...', 0, 1, 'default.png', 0, '2020-04-26 19:39:45', '2020-04-26 19:39:45', 1, 1),
(2, 'chauffeur', 'Armand', NULL, 1, NULL, 'Port-Bouet Rue de la baltique', 'ABCDE', NULL, NULL, NULL, '47 58 93 21', 75000, 2, 'default.png', 1, '2020-04-27 10:24:02', '2020-04-27 10:24:02', 0, 1),
(3, 'Kouamé', 'Jerome', NULL, 1, NULL, '22 rue des chantilles, korogho 24 Bd', 'ABCD', NULL, NULL, NULL, '47 58 93 21', 60000, 1, 'default.png', 1, '2020-04-27 10:25:07', '2020-04-27 10:25:07', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `typeclient_id` int(2) NOT NULL,
  `acompte` int(11) DEFAULT NULL,
  `dette` int(11) NOT NULL,
  `adresse` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `contact` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `visibility` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `name`, `typeclient_id`, `acompte`, `dette`, `adresse`, `email`, `contact`, `visibility`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Devaris 21', 1, 0, 0, '...', 'info@devaris21.com', '...', 0, '2020-04-26 19:39:47', '2020-04-26 19:39:47', 1, 1),
(2, 'Client A', 1, 100000, 0, '22 rue des chantilles, korogho 24 Bd', 'infos@artci.com', '47 58 93 21', 1, '2020-04-27 10:12:15', '2020-04-27 10:12:15', 0, 1),
(3, 'client B', 1, 22000, 300000, '22 rue des chantilles, korogho 24 Bd', 'glpiadmin@artci.lan', '47 58 93 21', 1, '2020-04-27 10:43:56', '2020-04-27 10:43:56', 0, 1),
(4, 'client C', 1, -393500, 200000, '', '', '', 1, '2020-04-27 10:48:10', '2020-04-27 10:48:10', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin NOT NULL,
  `groupecommande_id` int(20) NOT NULL,
  `zonelivraison_id` int(11) NOT NULL,
  `lieu` varchar(200) COLLATE utf8_bin NOT NULL,
  `taux_tva` int(11) DEFAULT NULL,
  `tva` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `avance` int(11) NOT NULL,
  `reste` int(11) NOT NULL,
  `operation_id` int(11) DEFAULT NULL,
  `datelivraison` date NOT NULL,
  `employe_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `reference`, `groupecommande_id`, `zonelivraison_id`, `lieu`, `taux_tva`, `tva`, `montant`, `avance`, `reste`, `operation_id`, `datelivraison`, `employe_id`, `etat_id`, `comment`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'BCO/27042020-58AB48', 1, 4, 'Katiala, Ferké, Boudiali', NULL, 0, 530000, 0, 0, 1, '2020-04-27', 1, 3, NULL, '2020-04-27 10:35:54', '2020-04-27 10:35:54', 0, 1),
(2, 'BCO/27042020-BF5A27', 2, 1, 'Katiala, Ferké, Boudiali', NULL, 0, 80000, 0, 0, 2, '2020-04-27', 1, 3, NULL, '2020-04-27 11:03:17', '2020-04-27 11:03:17', 0, 1),
(3, 'BCO/27042020-C73A22', 3, 4, 'Katiala, Ferké, Boudiali', NULL, 0, 100000, 0, 0, 3, '2020-04-27', 1, 3, NULL, '2020-04-27 11:05:23', '2020-04-27 11:05:23', 0, 1),
(4, 'BCO/28042020-9E87B0', 4, 1, 'Katiala, Ferké, Boudiali', 5, 18000, 378000, 178000, 200000, 4, '2020-04-30', 1, 3, 'deeee', '2020-04-28 23:19:04', '2020-04-28 23:19:04', 0, 1),
(5, 'BCO/28042020-18CD2C', 5, 3, 'Katiala, Ferké, Boudiali', 5, 3000, 63000, 63000, 0, 5, '2020-04-30', 1, 3, '', '2020-04-28 23:51:40', '2020-04-28 23:51:40', 0, 1),
(6, 'BCO/29042020-524516', 4, 1, 'Katiala, Ferké, Boudiali', 5, 20500, 430500, 37000, 393500, 6, '2020-05-01', 1, 3, '', '2020-04-29 00:07:00', '2020-04-29 00:07:00', 0, 1),
(7, 'BCO/29042020-731317', 8, 1, 'Katiala, Ferké, Boudiali', 5, 17000, 357000, 20000, 337000, 3, '2020-05-01', 1, 3, '', '2020-04-29 00:15:45', '2020-04-29 00:15:45', 0, 1),
(8, 'BCO/29042020-8786D8', 9, 1, 'Katiala, Ferké, Boudiali', 5, 30000, 630000, 0, 630000, NULL, '2020-05-01', 1, 3, '', '2020-04-29 00:21:12', '2020-04-29 00:21:12', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

CREATE TABLE `connexion` (
  `id` int(11) NOT NULL,
  `date_connexion` datetime DEFAULT NULL,
  `date_deconnexion` timestamp NULL DEFAULT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `connexion`
--

INSERT INTO `connexion` (`id`, `date_connexion`, `date_deconnexion`, `employe_id`, `prestataire_id`, `created`, `modified`, `protected`, `valide`) VALUES
(1, '2020-04-26 20:44:19', '2020-04-27 10:09:50', 1, NULL, '2020-04-26 20:44:19', '2020-04-26 20:44:19', 0, 1),
(2, '2020-04-27 10:09:50', '2020-04-27 11:27:01', 1, NULL, '2020-04-27 10:09:50', '2020-04-27 10:09:50', 0, 1),
(3, '2020-04-27 11:27:01', '2020-04-28 21:30:10', 1, NULL, '2020-04-27 11:27:01', '2020-04-27 11:27:01', 0, 1),
(4, '2020-04-28 21:30:10', '2020-04-28 22:23:47', 1, NULL, '2020-04-28 21:30:10', '2020-04-28 21:30:10', 0, 1),
(5, '2020-04-28 22:23:48', '2020-04-28 22:27:24', 1, NULL, '2020-04-28 22:23:48', '2020-04-28 22:23:48', 0, 1),
(6, '2020-04-28 22:27:24', '2020-04-28 22:40:52', 1, NULL, '2020-04-28 22:27:24', '2020-04-28 22:27:24', 0, 1),
(7, '2020-04-28 22:40:53', '2020-04-29 00:21:49', 1, NULL, '2020-04-28 22:40:53', '2020-04-28 22:40:53', 0, 1),
(8, '2020-04-29 00:21:49', '2020-04-29 11:48:03', 1, NULL, '2020-04-29 00:21:49', '2020-04-29 00:21:49', 0, 1),
(9, '2020-04-29 11:48:04', '2020-04-29 12:46:34', 1, NULL, '2020-04-29 11:48:04', '2020-04-29 11:48:04', 0, 1),
(10, '2020-04-29 12:46:34', '2020-04-29 18:24:06', 1, NULL, '2020-04-29 12:46:34', '2020-04-29 12:46:34', 0, 1),
(11, '2020-04-29 18:24:06', '2020-04-29 19:11:24', 1, NULL, '2020-04-29 18:24:06', '2020-04-29 18:24:06', 0, 1),
(12, '2020-04-29 19:11:24', '2020-04-30 07:27:16', 1, NULL, '2020-04-29 19:11:24', '2020-04-29 19:11:24', 0, 1),
(13, '2020-04-30 07:27:16', '2020-05-01 03:33:36', 1, NULL, '2020-04-30 07:27:16', '2020-04-30 07:27:16', 0, 1),
(14, '2020-05-01 03:33:37', '2020-05-01 11:48:14', 1, NULL, '2020-05-01 03:33:37', '2020-05-01 03:33:37', 0, 1),
(15, '2020-05-01 11:48:15', NULL, 1, NULL, '2020-05-01 11:48:15', '2020-05-01 11:48:15', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `demandeentretien`
--

CREATE TABLE `demandeentretien` (
  `id` int(11) NOT NULL,
  `typeentretienvehicule_id` int(11) NOT NULL,
  `reference` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `vehicule_id` int(11) NOT NULL,
  `carplan_id` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `image` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `date_approuve` datetime DEFAULT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `adresse` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `contact` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  `image` varchar(50) COLLATE utf8_bin NOT NULL,
  `is_new` int(11) NOT NULL DEFAULT 0,
  `is_allowed` int(11) NOT NULL DEFAULT 1,
  `visibility` int(11) NOT NULL DEFAULT 0,
  `pass` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`id`, `name`, `adresse`, `email`, `contact`, `login`, `password`, `image`, `is_new`, `is_allowed`, `visibility`, `pass`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Super Administrateur', '...', 'info@devaris21.com', '...', 'root', '5e9795e3f3ab55e7790a6283507c085db0d764fc', 'default.png', 0, 1, 1, '', '2020-04-26 19:39:51', '2020-04-26 19:39:51', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `energie`
--

CREATE TABLE `energie` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `energie`
--

INSERT INTO `energie` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'standart', '2020-04-26 19:40:02', '2020-04-26 19:40:02', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `entretienmachine`
--

CREATE TABLE `entretienmachine` (
  `id` int(11) NOT NULL,
  `reference` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `machine_id` int(11) NOT NULL,
  `panne_id` int(11) DEFAULT NULL,
  `started` datetime DEFAULT NULL,
  `finished` datetime DEFAULT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `date_approuve` datetime DEFAULT NULL,
  `employe_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `entretienvehicule`
--

CREATE TABLE `entretienvehicule` (
  `id` int(11) NOT NULL,
  `reference` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `typeentretienvehicule_id` int(11) NOT NULL,
  `demandeentretien_id` int(11) DEFAULT NULL,
  `vehicule_id` int(11) NOT NULL,
  `started` datetime DEFAULT NULL,
  `finished` datetime DEFAULT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `date_approuve` datetime DEFAULT NULL,
  `comment` text COLLATE utf8_bin DEFAULT NULL,
  `employe_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `class` varchar(50) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`id`, `name`, `class`, `protected`, `valide`) VALUES
(1, 'Annulé', 'danger', 1, 1),
(2, 'En cours', 'info', 1, 1),
(3, 'Validé', 'primary', 1, 1),
(4, 'Partiellement', 'warning', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `etatchauffeur`
--

CREATE TABLE `etatchauffeur` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `class` varchar(50) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `etatchauffeur`
--

INSERT INTO `etatchauffeur` (`id`, `name`, `class`, `protected`, `valide`) VALUES
(1, 'RAS', 'primary', 1, 1),
(2, 'En mission', 'warning', 1, 1),
(3, 'Indisponible', 'danger', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `etatmanoeuvre`
--

CREATE TABLE `etatmanoeuvre` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `class` varchar(50) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `etatvehicule`
--

CREATE TABLE `etatvehicule` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `class` varchar(50) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `etatvehicule`
--

INSERT INTO `etatvehicule` (`id`, `name`, `class`, `protected`, `valide`) VALUES
(1, 'RAS', 'primary', 1, 1),
(2, 'En mission', 'warning', 1, 1),
(3, 'En panne', 'success', 1, 1),
(4, 'En entretien', 'success', 1, 1),
(5, 'Indisponible', 'danger', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `exigenceproduction`
--

CREATE TABLE `exigenceproduction` (
  `id` int(11) NOT NULL,
  `produit_id` int(20) NOT NULL,
  `quantite` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `exigenceproduction`
--

INSERT INTO `exigenceproduction` (`id`, `produit_id`, `quantite`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 700, '2020-04-26 19:39:53', '2020-04-26 19:39:53', 0, 1),
(2, 2, 300, '2020-04-26 19:39:54', '2020-04-26 19:39:54', 0, 1),
(3, 3, 150, '2020-04-26 19:39:55', '2020-04-26 19:39:55', 0, 1),
(4, 4, 500, '2020-04-26 19:39:56', '2020-04-26 19:39:56', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `acompte` int(11) NOT NULL,
  `dette` int(11) NOT NULL,
  `contact` varchar(150) COLLATE utf8_bin NOT NULL,
  `fax` varchar(200) COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin DEFAULT NULL,
  `adresse` text COLLATE utf8_bin NOT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `description` text COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `name`, `acompte`, `dette`, `contact`, `fax`, `email`, `adresse`, `image`, `description`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Devaris FOURNISSEUR', 30000, 6800, '...', '...', 'info@devaris21.com', '...', 'default.png', NULL, '2020-04-26 19:39:47', '2020-04-26 19:39:47', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `groupecommande`
--

CREATE TABLE `groupecommande` (
  `id` int(11) NOT NULL,
  `client_id` int(20) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `groupecommande`
--

INSERT INTO `groupecommande` (`id`, `client_id`, `etat_id`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 2, 2, '2020-04-27 10:35:54', '2020-04-27 10:35:54', 0, 1),
(2, 3, 3, '2020-04-27 11:03:17', '2020-04-27 11:03:17', 0, 1),
(3, 3, 3, '2020-04-27 11:05:23', '2020-04-27 11:05:23', 0, 1),
(4, 4, 2, '2020-04-28 23:19:04', '2020-04-28 23:19:04', 0, 1),
(5, 4, 3, '2020-04-28 23:51:40', '2020-04-28 23:51:40', 0, 1),
(6, 4, 3, '2020-04-29 00:01:24', '2020-04-29 00:01:24', 0, 1),
(7, 4, 3, '2020-04-29 00:05:08', '2020-04-29 00:05:08', 0, 1),
(8, 3, 2, '2020-04-29 00:15:44', '2020-04-29 00:15:44', 0, 1),
(9, 3, 2, '2020-04-29 00:21:12', '2020-04-29 00:21:12', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `groupemanoeuvre`
--

CREATE TABLE `groupemanoeuvre` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `groupemanoeuvre`
--

INSERT INTO `groupemanoeuvre` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'standart', '2020-04-26 19:40:02', '2020-04-26 19:40:02', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `groupevehicule`
--

CREATE TABLE `groupevehicule` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `groupevehicule`
--

INSERT INTO `groupevehicule` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Camion de livraison', '2020-04-26 19:39:44', '2020-04-26 19:39:44', 1, 1),
(2, 'Véhicule de mission', '2020-04-26 19:39:44', '2020-04-26 19:39:44', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `sentense` text COLLATE utf8_bin NOT NULL,
  `type_save` varchar(50) COLLATE utf8_bin NOT NULL,
  `record` varchar(200) COLLATE utf8_bin NOT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `carplan_id` int(11) DEFAULT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1,
  `record_key` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `history`
--

INSERT INTO `history` (`id`, `sentense`, `type_save`, `record`, `employe_id`, `carplan_id`, `prestataire_id`, `created`, `modified`, `protected`, `valide`, `record_key`) VALUES
(1, 'Ajout d\'une nouvelle zone de livraison : Abidjan dans les paramétrages', 'insert', 'zonelivraison', 1, NULL, NULL, '2020-04-26 19:39:42', '2020-04-26 19:39:42', 0, 1, 1),
(2, 'Ajout d\'un nouveau type de sinistre : Voiture dans les paramétrages', 'insert', 'typevehicule', 1, NULL, NULL, '2020-04-26 19:39:42', '2020-04-26 19:39:42', 0, 1, 1),
(3, 'Ajout d\'un nouveau type de sinistre : Camion benne dans les paramétrages', 'insert', 'typevehicule', 1, NULL, NULL, '2020-04-26 19:39:42', '2020-04-26 19:39:42', 0, 1, 2),
(4, 'Ajout d\'un nouveau type de sinistre : Tricycle dans les paramétrages', 'insert', 'typevehicule', 1, NULL, NULL, '2020-04-26 19:39:42', '2020-04-26 19:39:42', 0, 1, 3),
(5, 'Ajout d\'un nouveau type de sinistre : Moto dans les paramétrages', 'insert', 'typevehicule', 1, NULL, NULL, '2020-04-26 19:39:43', '2020-04-26 19:39:43', 0, 1, 4),
(6, 'Ajout d\'un nouveau type d\'operation de vehicule : Entrée de caisse dans les paramétrages', 'insert', 'typeoperationcaisse', 1, NULL, NULL, '2020-04-26 19:39:43', '2020-04-26 19:39:43', 0, 1, 1),
(7, 'Ajout d\'un nouveau type d\'operation de vehicule : Sortie de caisse dans les paramétrages', 'insert', 'typeoperationcaisse', 1, NULL, NULL, '2020-04-26 19:39:43', '2020-04-26 19:39:43', 0, 1, 2),
(8, 'Ajout d\'un nouveau type d\'entretien de vehicule : Accrochage dans les paramétrages', 'insert', 'typeentretienvehicule', 1, NULL, NULL, '2020-04-26 19:39:43', '2020-04-26 19:39:43', 0, 1, 1),
(9, 'Ajout d\'un nouveau type d\'entretien de vehicule : Crevaison dans les paramétrages', 'insert', 'typeentretienvehicule', 1, NULL, NULL, '2020-04-26 19:39:44', '2020-04-26 19:39:44', 0, 1, 2),
(10, 'Ajout d\'un nouveau type d\'entretien de vehicule : Autre dans les paramétrages', 'insert', 'typeentretienvehicule', 1, NULL, NULL, '2020-04-26 19:39:44', '2020-04-26 19:39:44', 0, 1, 3),
(11, 'Ajout d\'un nouveau groupe de vehicule : Camion de livraison dans les paramétrages', 'insert', 'groupevehicule', 1, NULL, NULL, '2020-04-26 19:39:44', '2020-04-26 19:39:44', 0, 1, 1),
(12, 'Ajout d\'un nouveau groupe de vehicule : Véhicule de mission dans les paramétrages', 'insert', 'groupevehicule', 1, NULL, NULL, '2020-04-26 19:39:44', '2020-04-26 19:39:44', 0, 1, 2),
(13, 'Enregistrement d\'un nouveau véhicule N°1 immatriculé ....', 'insert', 'vehicule', 1, NULL, NULL, '2020-04-26 19:39:44', '2020-04-26 19:39:44', 0, 1, 1),
(14, 'Ajout d\'un nouveau chauffeur dans votre gestion : SON PROPRE CHAUFFEUR .', 'insert', 'chauffeur', 1, NULL, NULL, '2020-04-26 19:39:45', '2020-04-26 19:39:45', 0, 1, 1),
(15, 'Ajout d\'un nouveau type de client : Entreprise dans les paramétrages', 'insert', 'typeclient', 1, NULL, NULL, '2020-04-26 19:39:45', '2020-04-26 19:39:45', 0, 1, 1),
(16, 'Ajout d\'un nouveau type de client : Particulier dans les paramétrages', 'insert', 'typeclient', 1, NULL, NULL, '2020-04-26 19:39:45', '2020-04-26 19:39:45', 0, 1, 2),
(17, 'Ajout d\'un nouveau genre : Homme dans les paramétrages', 'insert', 'sexe', 1, NULL, NULL, '2020-04-26 19:39:45', '2020-04-26 19:39:45', 0, 1, 1),
(18, 'Ajout d\'un nouveau genre : Femme dans les paramétrages', 'insert', 'sexe', 1, NULL, NULL, '2020-04-26 19:39:45', '2020-04-26 19:39:45', 0, 1, 2),
(19, 'Ajout d\'un nouveau type d\'operation de vehicule : master dans les paramétrages', 'insert', 'role', 1, NULL, NULL, '2020-04-26 19:39:46', '2020-04-26 19:39:46', 0, 1, 1),
(20, 'Ajout d\'un nouveau type d\'operation de vehicule : production dans les paramétrages', 'insert', 'role', 1, NULL, NULL, '2020-04-26 19:39:46', '2020-04-26 19:39:46', 0, 1, 2),
(21, 'Ajout d\'un nouveau type d\'operation de vehicule : caisse dans les paramétrages', 'insert', 'role', 1, NULL, NULL, '2020-04-26 19:39:46', '2020-04-26 19:39:46', 0, 1, 3),
(22, 'Ajout d\'un nouveau type d\'operation de vehicule : parametres dans les paramétrages', 'insert', 'role', 1, NULL, NULL, '2020-04-26 19:39:46', '2020-04-26 19:39:46', 0, 1, 4),
(23, 'Ajout d\'un nouveau type d\'operation de vehicule : paye des manoeuvre dans les paramétrages', 'insert', 'role', 1, NULL, NULL, '2020-04-26 19:39:46', '2020-04-26 19:39:46', 0, 1, 5),
(24, 'Ajout d\'un nouveau type d\'operation de vehicule : modifier-supprimer dans les paramétrages', 'insert', 'role', 1, NULL, NULL, '2020-04-26 19:39:46', '2020-04-26 19:39:46', 0, 1, 6),
(25, 'Nouvelle Installation, premier démarrage', 'insert', 'mycompte', 1, NULL, NULL, '2020-04-26 19:39:47', '2020-04-26 19:39:47', 0, 1, 1),
(26, 'Ajout d\'un nouveau prestataire : Devaris PRESTATAIRE', 'insert', 'prestataire', 1, NULL, NULL, '2020-04-26 19:39:47', '2020-04-26 19:39:47', 0, 1, 1),
(27, 'Ajout d\'un nouveau prestataire : Devaris FOURNISSEUR', 'insert', 'fournisseur', 1, NULL, NULL, '2020-04-26 19:39:47', '2020-04-26 19:39:47', 0, 1, 1),
(28, 'Ajout d\'un nouvel employé dans votre gestion :Devaris 21', 'insert', 'client', 1, NULL, NULL, '2020-04-26 19:39:47', '2020-04-26 19:39:47', 0, 1, 1),
(29, 'Ajout d\'un nouveau employe dans le parc auto : Super Administrateur', 'insert', 'employe', 1, NULL, NULL, '2020-04-26 19:39:51', '2020-04-26 19:39:51', 0, 1, 1),
(30, 'Ajout d\'un nouveau produit : HOURDIS dans les paramétrages', 'insert', 'produit', 1, NULL, NULL, '2020-04-26 19:39:53', '2020-04-26 19:39:53', 0, 1, 1),
(31, 'Ajout d\'un nouveau produit : AC 15 dans les paramétrages', 'insert', 'produit', 1, NULL, NULL, '2020-04-26 19:39:54', '2020-04-26 19:39:54', 0, 1, 2),
(32, 'Ajout d\'un nouveau produit : AP 15 dans les paramétrages', 'insert', 'produit', 1, NULL, NULL, '2020-04-26 19:39:55', '2020-04-26 19:39:55', 0, 1, 3),
(33, 'Ajout d\'un nouveau produit : BTC dans les paramétrages', 'insert', 'produit', 1, NULL, NULL, '2020-04-26 19:39:55', '2020-04-26 19:39:55', 0, 1, 4),
(34, 'Ajout d\'une nouvelle ressource : CIMENT dans les paramétrages', 'insert', 'ressource', 1, NULL, NULL, '2020-04-26 19:39:56', '2020-04-26 19:39:56', 0, 1, 1),
(35, 'Ajout d\'une nouvelle ressource : SABLE dans les paramétrages', 'insert', 'ressource', 1, NULL, NULL, '2020-04-26 19:39:58', '2020-04-26 19:39:58', 0, 1, 2),
(36, 'Ajout d\'une nouvelle ressource : GRAVIER dans les paramétrages', 'insert', 'ressource', 1, NULL, NULL, '2020-04-26 19:39:59', '2020-04-26 19:39:59', 0, 1, 3),
(37, 'Ajout d\'une nouvelle ressource : EAU dans les paramétrages', 'insert', 'ressource', 1, NULL, NULL, '2020-04-26 19:40:00', '2020-04-26 19:40:00', 0, 1, 4),
(38, 'Ajout d\'un nouveau type de transmission de vehicule : standart dans les paramétrages', 'insert', 'typetransmission', 1, NULL, NULL, '2020-04-26 19:40:01', '2020-04-26 19:40:01', 0, 1, 1),
(39, 'Ajout d\'un nouveau type de prestataire : standart dans les paramétrages', 'insert', 'typeprestataire', 1, NULL, NULL, '2020-04-26 19:40:01', '2020-04-26 19:40:01', 0, 1, 1),
(40, 'Ajout d\'un nouveau type de demande de vehicule : standart dans les paramétrages', 'insert', 'groupemanoeuvre', 1, NULL, NULL, '2020-04-26 19:40:02', '2020-04-26 19:40:02', 0, 1, 1),
(41, 'Ajout d\'un nouveau type de vehicule : standart dans les paramétrages', 'insert', 'typesuggestion', 1, NULL, NULL, '2020-04-26 19:40:02', '2020-04-26 19:40:02', 0, 1, 1),
(42, 'Modification des informations du employe 1 Super Administrateur', 'update', 'employe', NULL, NULL, NULL, '2020-04-26 20:44:19', '2020-04-26 20:44:19', 0, 1, 1),
(43, 'Nouvelle connexion', 'insert', 'connexion', 1, NULL, NULL, '2020-04-26 20:44:19', '2020-04-26 20:44:19', 0, 1, 1),
(44, 'Modification des informations de la connexion de Super Administrateur du  26 April 2020 à 20:44', 'update', 'connexion', NULL, NULL, NULL, '2020-04-27 10:09:50', '2020-04-27 10:09:50', 0, 1, 1),
(45, 'Nouvelle connexion', 'insert', 'connexion', 1, NULL, NULL, '2020-04-27 10:09:50', '2020-04-27 10:09:50', 0, 1, 2),
(46, 'Ajout d\'un nouvel employé dans votre gestion :Client A', 'insert', 'client', 1, NULL, NULL, '2020-04-27 10:12:15', '2020-04-27 10:12:15', 0, 1, 2),
(47, 'Ajout d\'une nouvelle zone de livraison : Bonoua & environs dans les paramétrages', 'insert', 'zonelivraison', 1, NULL, NULL, '2020-04-27 10:13:36', '2020-04-27 10:13:36', 0, 1, 2),
(48, 'Ajout d\'une nouvelle zone de livraison : Grand Abidjan dans les paramétrages', 'insert', 'zonelivraison', 1, NULL, NULL, '2020-04-27 10:14:03', '2020-04-27 10:14:03', 0, 1, 3),
(49, 'Ajout d\'une nouvelle zone de livraison : Bouaké et centre du pays dans les paramétrages', 'insert', 'zonelivraison', 1, NULL, NULL, '2020-04-27 10:14:37', '2020-04-27 10:14:37', 0, 1, 4),
(50, 'Ajout d\'un nouveau chauffeur dans votre gestion : manoeuvre 1 ', 'insert', 'manoeuvre', 1, NULL, NULL, '2020-04-27 10:21:55', '2020-04-27 10:21:55', 0, 1, 1),
(51, 'Ajout d\'un nouveau chauffeur dans votre gestion : manoeuvre 2 ', 'insert', 'manoeuvre', 1, NULL, NULL, '2020-04-27 10:22:18', '2020-04-27 10:22:18', 0, 1, 2),
(52, 'Ajout d\'un nouveau chauffeur dans votre gestion : manoeuvre 3 ', 'insert', 'manoeuvre', 1, NULL, NULL, '2020-04-27 10:23:00', '2020-04-27 10:23:00', 0, 1, 3),
(53, 'Ajout d\'un nouveau chauffeur dans votre gestion : chauffeur Armand', 'insert', 'chauffeur', 1, NULL, NULL, '2020-04-27 10:24:02', '2020-04-27 10:24:02', 0, 1, 2),
(54, 'Ajout d\'un nouveau chauffeur dans votre gestion : Kouamé Jerome', 'insert', 'chauffeur', 1, NULL, NULL, '2020-04-27 10:25:07', '2020-04-27 10:25:07', 0, 1, 3),
(55, 'Enregistrement d\'un nouveau machine Machine de BTX', 'insert', 'machine', 1, NULL, NULL, '2020-04-27 10:27:17', '2020-04-27 10:27:17', 0, 1, 1),
(56, 'Enregistrement d\'un nouveau machine Machine de Hors', 'insert', 'machine', 1, NULL, NULL, '2020-04-27 10:28:17', '2020-04-27 10:28:17', 0, 1, 2),
(57, 'Modification des informations de l\'employé Client A', 'update', 'client', 1, NULL, NULL, '2020-04-27 10:41:22', '2020-04-27 10:41:22', 0, 1, 2),
(58, 'Modification des informations de l\'employé Client A', 'update', 'client', 1, NULL, NULL, '2020-04-27 10:42:31', '2020-04-27 10:42:31', 0, 1, 2),
(59, 'Enregistrement d\'un nouveau véhicule N°2 immatriculé 4785 GT 01.', 'insert', 'vehicule', 1, NULL, NULL, '2020-04-27 10:43:08', '2020-04-27 10:43:08', 0, 1, 2),
(60, 'Ajout d\'un nouvel employé dans votre gestion :client B', 'insert', 'client', 1, NULL, NULL, '2020-04-27 10:43:56', '2020-04-27 10:43:56', 0, 1, 3),
(61, 'Modification des informations de l\'employé client B', 'update', 'client', 1, NULL, NULL, '2020-04-27 10:44:21', '2020-04-27 10:44:21', 0, 1, 3),
(62, 'Enregistrement d\'un nouveau véhicule N°3 immatriculé 8993 GT 01.', 'insert', 'vehicule', 1, NULL, NULL, '2020-04-27 10:44:48', '2020-04-27 10:44:48', 0, 1, 3),
(63, 'Enregistrement d\'un nouveau véhicule N°4 immatriculé 4785 GT 01.', 'insert', 'vehicule', 1, NULL, NULL, '2020-04-27 10:45:06', '2020-04-27 10:45:06', 0, 1, 4),
(64, 'Ajout d\'un nouvel employé dans votre gestion :client C', 'insert', 'client', 1, NULL, NULL, '2020-04-27 10:48:10', '2020-04-27 10:48:10', 0, 1, 4),
(65, 'Modification des informations de l\'employé client B', 'update', 'client', 1, NULL, NULL, '2020-04-27 11:03:18', '2020-04-27 11:03:18', 0, 1, 3),
(66, 'Modification des informations de l\'employé client B', 'update', 'client', 1, NULL, NULL, '2020-04-27 11:05:24', '2020-04-27 11:05:24', 0, 1, 3),
(67, 'Modification des informations de la connexion de Super Administrateur du  27 April 2020 à 10:09', 'update', 'connexion', NULL, NULL, NULL, '2020-04-27 11:27:01', '2020-04-27 11:27:01', 0, 1, 2),
(68, 'Nouvelle connexion', 'insert', 'connexion', 1, NULL, NULL, '2020-04-27 11:27:01', '2020-04-27 11:27:01', 0, 1, 3),
(69, 'Modification des informations du produit 2 : AC 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-27 11:54:49', '2020-04-27 11:54:49', 0, 1, 2),
(70, 'Modification des informations du produit 3 : AP 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-27 11:54:49', '2020-04-27 11:54:49', 0, 1, 3),
(71, 'Modification des informations du produit 4 : BTC ', 'update', 'produit', 1, NULL, NULL, '2020-04-27 11:54:50', '2020-04-27 11:54:50', 0, 1, 4),
(72, 'Modification des informations du produit 2 : AC 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-27 11:56:24', '2020-04-27 11:56:24', 0, 1, 2),
(73, 'Modification des informations du produit 3 : AP 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-27 11:56:25', '2020-04-27 11:56:25', 0, 1, 3),
(74, 'Modification des informations du produit 4 : BTC ', 'update', 'produit', 1, NULL, NULL, '2020-04-27 11:56:25', '2020-04-27 11:56:25', 0, 1, 4),
(75, 'Modification des informations du produit 2 : AC 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-27 12:00:27', '2020-04-27 12:00:27', 0, 1, 2),
(76, 'Modification des informations du produit 4 : BTC ', 'update', 'produit', 1, NULL, NULL, '2020-04-27 12:00:27', '2020-04-27 12:00:27', 0, 1, 4),
(77, 'Modification des informations du chauffeur N°2 : chauffeur Armand.', 'update', 'chauffeur', 1, NULL, NULL, '2020-04-27 12:00:28', '2020-04-27 12:00:28', 0, 1, 2),
(78, 'Modification des informations de la connexion de Super Administrateur du  27 April 2020 à 11:27', 'update', 'connexion', NULL, NULL, NULL, '2020-04-28 21:30:10', '2020-04-28 21:30:10', 0, 1, 3),
(79, 'Nouvelle connexion', 'insert', 'connexion', 1, NULL, NULL, '2020-04-28 21:30:10', '2020-04-28 21:30:10', 0, 1, 4),
(80, 'Modification des informations de la connexion de Super Administrateur du  28 April 2020 à 21:30', 'update', 'connexion', NULL, NULL, NULL, '2020-04-28 22:23:48', '2020-04-28 22:23:48', 0, 1, 4),
(81, 'Nouvelle connexion', 'insert', 'connexion', 1, NULL, NULL, '2020-04-28 22:23:48', '2020-04-28 22:23:48', 0, 1, 5),
(82, 'Modification des informations de la connexion de Super Administrateur du  28 April 2020 à 22:23', 'update', 'connexion', NULL, NULL, NULL, '2020-04-28 22:27:24', '2020-04-28 22:27:24', 0, 1, 5),
(83, 'Nouvelle connexion', 'insert', 'connexion', 1, NULL, NULL, '2020-04-28 22:27:24', '2020-04-28 22:27:24', 0, 1, 6),
(84, 'Modification des informations du chauffeur N°2 : chauffeur Armand.', 'update', 'chauffeur', 1, NULL, NULL, '2020-04-28 22:28:46', '2020-04-28 22:28:46', 0, 1, 2),
(85, 'Modification des infos du véhicule N°3 immatriculé 8993 GT 01.', 'update', 'vehicule', 1, NULL, NULL, '2020-04-28 22:28:46', '2020-04-28 22:28:46', 0, 1, 3),
(86, 'Modification des informations de la connexion de Super Administrateur du  28 April 2020 à 22:27', 'update', 'connexion', NULL, NULL, NULL, '2020-04-28 22:40:53', '2020-04-28 22:40:53', 0, 1, 6),
(87, 'Nouvelle connexion', 'insert', 'connexion', 1, NULL, NULL, '2020-04-28 22:40:53', '2020-04-28 22:40:53', 0, 1, 7),
(88, 'Modification des informations de l\'employé client C', 'update', 'client', 1, NULL, NULL, '2020-04-28 23:10:20', '2020-04-28 23:10:20', 0, 1, 4),
(89, 'Modification des informations de l\'employé client C', 'update', 'client', 1, NULL, NULL, '2020-04-28 23:19:05', '2020-04-28 23:19:05', 0, 1, 4),
(90, 'Modification des informations de l\'employé client C', 'update', 'client', 1, NULL, NULL, '2020-04-28 23:51:42', '2020-04-28 23:51:42', 0, 1, 4),
(91, 'Modification des informations de l\'employé client C', 'update', 'client', 1, NULL, NULL, '2020-04-29 00:07:01', '2020-04-29 00:07:01', 0, 1, 4),
(92, 'Modification des informations de l\'employé client B', 'update', 'client', 1, NULL, NULL, '2020-04-29 00:15:46', '2020-04-29 00:15:46', 0, 1, 3),
(93, 'Modification des informations de l\'employé client B', 'update', 'client', 1, NULL, NULL, '2020-04-29 00:21:13', '2020-04-29 00:21:13', 0, 1, 3),
(94, 'Modification des informations de la connexion de Super Administrateur du  28 April 2020 à 22:40', 'update', 'connexion', NULL, NULL, NULL, '2020-04-29 00:21:49', '2020-04-29 00:21:49', 0, 1, 7),
(95, 'Nouvelle connexion', 'insert', 'connexion', 1, NULL, NULL, '2020-04-29 00:21:49', '2020-04-29 00:21:49', 0, 1, 8),
(96, 'Modification des informations de l\'employé client B', 'update', 'client', 1, NULL, NULL, '2020-04-29 10:26:01', '2020-04-29 10:26:01', 0, 1, 3),
(97, 'Modification des informations de l\'employé client B', 'update', 'client', 1, NULL, NULL, '2020-04-29 10:37:44', '2020-04-29 10:37:44', 0, 1, 3),
(98, 'Modification des informations de l\'employé client B', 'update', 'client', 1, NULL, NULL, '2020-04-29 10:39:30', '2020-04-29 10:39:30', 0, 1, 3),
(99, 'Modification des informations de l\'employé client B', 'update', 'client', 1, NULL, NULL, '2020-04-29 10:40:26', '2020-04-29 10:40:26', 0, 1, 3),
(100, 'Modification des informations de l\'employé client B', 'update', 'client', 1, NULL, NULL, '2020-04-29 10:41:46', '2020-04-29 10:41:46', 0, 1, 3),
(101, 'Modification des informations de l\'employé client B', 'update', 'client', 1, NULL, NULL, '2020-04-29 10:51:41', '2020-04-29 10:51:41', 0, 1, 3),
(102, 'Modification des informations de la connexion de Super Administrateur du  29 April 2020 à 00:21', 'update', 'connexion', NULL, NULL, NULL, '2020-04-29 11:48:04', '2020-04-29 11:48:04', 0, 1, 8),
(103, 'Nouvelle connexion', 'insert', 'connexion', 1, NULL, NULL, '2020-04-29 11:48:04', '2020-04-29 11:48:04', 0, 1, 9),
(104, 'Modification des informations de la connexion de Super Administrateur du  29 April 2020 à 11:48', 'update', 'connexion', NULL, NULL, NULL, '2020-04-29 12:46:34', '2020-04-29 12:46:34', 0, 1, 9),
(105, 'Nouvelle connexion', 'insert', 'connexion', 1, NULL, NULL, '2020-04-29 12:46:34', '2020-04-29 12:46:34', 0, 1, 10),
(106, 'Modification des informations de la connexion de Super Administrateur du  29 April 2020 à 12:46', 'update', 'connexion', NULL, NULL, NULL, '2020-04-29 18:24:06', '2020-04-29 18:24:06', 0, 1, 10),
(107, 'Nouvelle connexion', 'insert', 'connexion', 1, NULL, NULL, '2020-04-29 18:24:06', '2020-04-29 18:24:06', 0, 1, 11),
(108, 'Modification des informations de la connexion de Super Administrateur du  29 April 2020 à 18:24', 'update', 'connexion', NULL, NULL, NULL, '2020-04-29 19:11:24', '2020-04-29 19:11:24', 0, 1, 11),
(109, 'Nouvelle connexion', 'insert', 'connexion', 1, NULL, NULL, '2020-04-29 19:11:24', '2020-04-29 19:11:24', 0, 1, 12),
(110, 'Modification des informations du produit 2 : AC 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-29 21:14:03', '2020-04-29 21:14:03', 0, 1, 2),
(111, 'Modification des informations du produit 4 : BTC ', 'update', 'produit', 1, NULL, NULL, '2020-04-29 21:14:04', '2020-04-29 21:14:04', 0, 1, 4),
(112, 'Modification des informations de la connexion de Super Administrateur du  29 April 2020 à 19:11', 'update', 'connexion', NULL, NULL, NULL, '2020-04-30 07:27:16', '2020-04-30 07:27:16', 0, 1, 12),
(113, 'Nouvelle connexion', 'insert', 'connexion', 1, NULL, NULL, '2020-04-30 07:27:16', '2020-04-30 07:27:16', 0, 1, 13),
(114, 'Modification des informations du produit 2 : AC 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 08:14:59', '2020-04-30 08:14:59', 0, 1, 2),
(115, 'Modification des informations du produit 3 : AP 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 08:14:59', '2020-04-30 08:14:59', 0, 1, 3),
(116, 'Modification des informations du produit 4 : BTC ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 08:15:00', '2020-04-30 08:15:00', 0, 1, 4),
(117, 'Modification des informations du produit 2 : AC 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 12:21:46', '2020-04-30 12:21:46', 0, 1, 2),
(118, 'Modification des informations du produit 3 : AP 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 12:21:46', '2020-04-30 12:21:46', 0, 1, 3),
(119, 'Modification des informations du produit 4 : BTC ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 12:21:47', '2020-04-30 12:21:47', 0, 1, 4),
(120, 'Modification des informations du produit 2 : AC 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 12:47:19', '2020-04-30 12:47:19', 0, 1, 2),
(121, 'Modification des informations du produit 3 : AP 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 12:47:20', '2020-04-30 12:47:20', 0, 1, 3),
(122, 'Modification des informations du produit 4 : BTC ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 12:47:20', '2020-04-30 12:47:20', 0, 1, 4),
(123, 'Modification des informations du produit 2 : AC 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 12:48:57', '2020-04-30 12:48:57', 0, 1, 2),
(124, 'Modification des informations du produit 3 : AP 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 12:48:57', '2020-04-30 12:48:57', 0, 1, 3),
(125, 'Modification des informations du produit 4 : BTC ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 12:48:58', '2020-04-30 12:48:58', 0, 1, 4),
(126, 'Modification des informations du produit 2 : AC 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 13:18:27', '2020-04-30 13:18:27', 0, 1, 2),
(127, 'Modification des informations du produit 3 : AP 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 13:18:28', '2020-04-30 13:18:28', 0, 1, 3),
(128, 'Modification des informations du produit 4 : BTC ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 13:18:28', '2020-04-30 13:18:28', 0, 1, 4),
(129, 'Modification des informations du produit 2 : AC 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 13:51:26', '2020-04-30 13:51:26', 0, 1, 2),
(130, 'Modification des informations du produit 3 : AP 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 13:51:27', '2020-04-30 13:51:27', 0, 1, 3),
(131, 'Modification des informations du produit 4 : BTC ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 13:51:27', '2020-04-30 13:51:27', 0, 1, 4),
(132, 'Modification des informations du produit 2 : AC 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 13:52:36', '2020-04-30 13:52:36', 0, 1, 2),
(133, 'Modification des informations du produit 3 : AP 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 13:52:37', '2020-04-30 13:52:37', 0, 1, 3),
(134, 'Modification des informations du produit 4 : BTC ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 13:52:38', '2020-04-30 13:52:38', 0, 1, 4),
(135, 'Modification des informations du produit 2 : AC 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 13:56:32', '2020-04-30 13:56:32', 0, 1, 2),
(136, 'Modification des informations du produit 3 : AP 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 13:56:33', '2020-04-30 13:56:33', 0, 1, 3),
(137, 'Modification des informations du produit 4 : BTC ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 13:56:33', '2020-04-30 13:56:33', 0, 1, 4),
(138, 'Modification des informations du produit 2 : AC 15 ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 13:57:17', '2020-04-30 13:57:17', 0, 1, 2),
(139, 'Modification des informations du produit 4 : BTC ', 'update', 'produit', 1, NULL, NULL, '2020-04-30 13:57:18', '2020-04-30 13:57:18', 0, 1, 4),
(140, 'Modification des infos du véhicule N°2 immatriculé 4785 GT 01.', 'update', 'vehicule', 1, NULL, NULL, '2020-04-30 13:57:19', '2020-04-30 13:57:19', 0, 1, 2),
(141, 'Modification des informations du chauffeur N°2 : chauffeur Armand.', 'update', 'chauffeur', 1, NULL, NULL, '2020-04-30 13:57:19', '2020-04-30 13:57:19', 0, 1, 2),
(142, 'Modification des informations de la connexion de Super Administrateur du  30 April 2020 à 07:27', 'update', 'connexion', NULL, NULL, NULL, '2020-05-01 03:33:37', '2020-05-01 03:33:37', 0, 1, 13),
(143, 'Nouvelle connexion', 'insert', 'connexion', 1, NULL, NULL, '2020-05-01 03:33:37', '2020-05-01 03:33:37', 0, 1, 14),
(144, 'Modification des informations du prestataire 1 : Devaris FOURNISSEUR ', 'update', 'fournisseur', 1, NULL, NULL, '2020-05-01 04:16:04', '2020-05-01 04:16:04', 0, 1, 1),
(145, 'Modification des informations du prestataire 1 : Devaris FOURNISSEUR ', 'update', 'fournisseur', 1, NULL, NULL, '2020-05-01 04:38:23', '2020-05-01 04:38:23', 0, 1, 1),
(146, 'Modification des informations du prestataire 1 : Devaris FOURNISSEUR ', 'update', 'fournisseur', 1, NULL, NULL, '2020-05-01 05:15:43', '2020-05-01 05:15:43', 0, 1, 1),
(147, 'Modification des informations du prestataire 1 : Devaris FOURNISSEUR ', 'update', 'fournisseur', 1, NULL, NULL, '2020-05-01 05:22:12', '2020-05-01 05:22:12', 0, 1, 1),
(148, 'Modification des informations de la connexion de Super Administrateur du  01 May 2020 à 03:33', 'update', 'connexion', NULL, NULL, NULL, '2020-05-01 11:48:15', '2020-05-01 11:48:15', 0, 1, 14),
(149, 'Nouvelle connexion', 'insert', 'connexion', 1, NULL, NULL, '2020-05-01 11:48:15', '2020-05-01 11:48:15', 0, 1, 15);

-- --------------------------------------------------------

--
-- Structure de la table `ligneapprovisionnement`
--

CREATE TABLE `ligneapprovisionnement` (
  `id` int(11) NOT NULL,
  `approvisionnement_id` int(11) NOT NULL,
  `ressource_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `quantite_recu` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ligneapprovisionnement`
--

INSERT INTO `ligneapprovisionnement` (`id`, `approvisionnement_id`, `ressource_id`, `quantite`, `quantite_recu`, `price`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 1, 100, 100, 0, '2020-04-26 19:39:57', '2020-04-26 19:39:57', 0, 1),
(2, 1, 2, 100, 100, 0, '2020-04-26 19:39:58', '2020-04-26 19:39:58', 0, 1),
(3, 1, 3, 100, 100, 0, '2020-04-26 19:40:00', '2020-04-26 19:40:00', 0, 1),
(4, 1, 4, 100, 100, 0, '2020-04-26 19:40:01', '2020-04-26 19:40:01', 0, 1),
(5, 2, 2, 2, 2, 175000, '2020-04-27 10:49:30', '2020-04-27 10:49:30', 0, 1),
(6, 2, 1, 350, 350, 300000, '2020-04-27 10:49:31', '2020-04-27 10:49:31', 0, 1),
(7, 2, 3, 3, 3, 15000, '2020-04-27 10:49:31', '2020-04-27 10:49:31', 0, 1),
(8, 2, 4, 1000, 1000, 17500, '2020-04-27 10:49:31', '2020-04-27 10:49:31', 0, 1),
(9, 3, 2, 1, 1, 102300, '2020-05-01 04:38:24', '2020-05-01 04:38:24', 0, 1),
(10, 3, 3, 1, 1, 48500, '2020-05-01 04:38:24', '2020-05-01 04:38:24', 0, 1),
(11, 3, 4, 1, 1, 1000, '2020-05-01 04:38:24', '2020-05-01 04:38:24', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `lignecommande`
--

CREATE TABLE `lignecommande` (
  `id` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `lignecommande`
--

INSERT INTO `lignecommande` (`id`, `commande_id`, `produit_id`, `quantite`, `price`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 3, 1000, 300000, '2020-04-27 10:35:55', '2020-04-27 10:35:55', 0, 1),
(2, 1, 2, 700, 140000, '2020-04-27 10:35:55', '2020-04-27 10:35:55', 0, 1),
(3, 1, 1, 150, 75000, '2020-04-27 10:35:55', '2020-04-27 10:35:55', 0, 1),
(4, 1, 4, 100, 15000, '2020-04-27 10:35:55', '2020-04-27 10:35:55', 0, 1),
(5, 2, 2, 300, 30000, '2020-04-27 11:03:18', '2020-04-27 11:03:18', 0, 1),
(6, 2, 3, 100, 20000, '2020-04-27 11:03:18', '2020-04-27 11:03:18', 0, 1),
(7, 2, 4, 100, 30000, '2020-04-27 11:03:18', '2020-04-27 11:03:18', 0, 1),
(8, 3, 4, 300, 45000, '2020-04-27 11:05:23', '2020-04-27 11:05:23', 0, 1),
(9, 3, 2, 200, 40000, '2020-04-27 11:05:24', '2020-04-27 11:05:24', 0, 1),
(10, 3, 3, 50, 15000, '2020-04-27 11:05:24', '2020-04-27 11:05:24', 0, 1),
(11, 4, 1, 100, 40000, '2020-04-28 23:19:04', '2020-04-28 23:19:04', 0, 1),
(12, 4, 3, 100, 20000, '2020-04-28 23:19:05', '2020-04-28 23:19:05', 0, 1),
(13, 4, 4, 1000, 300000, '2020-04-28 23:19:05', '2020-04-28 23:19:05', 0, 1),
(14, 5, 2, 100, 15000, '2020-04-28 23:51:41', '2020-04-28 23:51:41', 0, 1),
(15, 5, 3, 100, 20000, '2020-04-28 23:51:41', '2020-04-28 23:51:41', 0, 1),
(16, 5, 4, 100, 25000, '2020-04-28 23:51:41', '2020-04-28 23:51:41', 0, 1),
(17, 6, 3, 2000, 400000, '2020-04-29 00:07:00', '2020-04-29 00:07:00', 0, 1),
(18, 6, 2, 100, 10000, '2020-04-29 00:07:00', '2020-04-29 00:07:00', 0, 1),
(19, 7, 4, 1000, 300000, '2020-04-29 00:15:45', '2020-04-29 00:15:45', 0, 1),
(20, 7, 1, 100, 40000, '2020-04-29 00:15:45', '2020-04-29 00:15:45', 0, 1),
(21, 8, 4, 2000, 600000, '2020-04-29 00:21:12', '2020-04-29 00:21:12', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ligneconsommationjour`
--

CREATE TABLE `ligneconsommationjour` (
  `id` int(11) NOT NULL,
  `productionjour_id` int(11) NOT NULL,
  `ressource_id` int(11) NOT NULL,
  `consommation` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ligneconsommationjour`
--

INSERT INTO `ligneconsommationjour` (`id`, `productionjour_id`, `ressource_id`, `consommation`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 1, 0, '2020-04-26 19:39:57', '2020-04-26 19:39:57', 0, 1),
(2, 1, 2, 0, '2020-04-26 19:39:59', '2020-04-26 19:39:59', 0, 1),
(3, 1, 3, 0, '2020-04-26 19:40:00', '2020-04-26 19:40:00', 0, 1),
(4, 1, 4, 0, '2020-04-26 19:40:01', '2020-04-26 19:40:01', 0, 1),
(5, 2, 1, 300, '2020-04-26 20:44:20', '2020-04-26 20:44:20', 0, 1),
(6, 2, 2, 15, '2020-04-26 20:44:20', '2020-04-26 20:44:20', 0, 1),
(7, 2, 3, 56, '2020-04-26 20:44:21', '2020-04-26 20:44:21', 0, 1),
(8, 2, 4, 300, '2020-04-26 20:44:21', '2020-04-26 20:44:21', 0, 1),
(9, 3, 1, 120, '2020-04-27 10:09:52', '2020-04-27 10:09:52', 0, 1),
(10, 3, 2, 60, '2020-04-27 10:09:52', '2020-04-27 10:09:52', 0, 1),
(11, 3, 3, 45, '2020-04-27 10:09:52', '2020-04-27 10:09:52', 0, 1),
(12, 3, 4, 650, '2020-04-27 10:09:53', '2020-04-27 10:09:53', 0, 1),
(13, 4, 1, 0, '2020-04-28 21:30:11', '2020-04-28 21:30:11', 0, 1),
(14, 4, 2, 0, '2020-04-28 21:30:11', '2020-04-28 21:30:11', 0, 1),
(15, 4, 3, 0, '2020-04-28 21:30:12', '2020-04-28 21:30:12', 0, 1),
(16, 4, 4, 0, '2020-04-28 21:30:12', '2020-04-28 21:30:12', 0, 1),
(17, 5, 1, 0, '2020-04-29 00:06:08', '2020-04-29 00:06:08', 0, 1),
(18, 5, 2, 0, '2020-04-29 00:06:08', '2020-04-29 00:06:08', 0, 1),
(19, 5, 3, 0, '2020-04-29 00:06:08', '2020-04-29 00:06:08', 0, 1),
(20, 5, 4, 0, '2020-04-29 00:06:08', '2020-04-29 00:06:08', 0, 1),
(21, 6, 1, 0, '2020-04-30 07:27:18', '2020-04-30 07:27:18', 0, 1),
(22, 6, 2, 0, '2020-04-30 07:27:18', '2020-04-30 07:27:18', 0, 1),
(23, 6, 3, 0, '2020-04-30 07:27:18', '2020-04-30 07:27:18', 0, 1),
(24, 6, 4, 0, '2020-04-30 07:27:19', '2020-04-30 07:27:19', 0, 1),
(25, 7, 1, 0, '2020-05-01 03:33:40', '2020-05-01 03:33:40', 0, 1),
(26, 7, 2, 0, '2020-05-01 03:33:40', '2020-05-01 03:33:40', 0, 1),
(27, 7, 3, 0, '2020-05-01 03:33:40', '2020-05-01 03:33:40', 0, 1),
(28, 7, 4, 0, '2020-05-01 03:33:40', '2020-05-01 03:33:40', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ligneexigenceproduction`
--

CREATE TABLE `ligneexigenceproduction` (
  `id` int(11) NOT NULL,
  `exigenceproduction_id` int(11) NOT NULL,
  `ressource_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ligneexigenceproduction`
--

INSERT INTO `ligneexigenceproduction` (`id`, `exigenceproduction_id`, `ressource_id`, `quantite`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 1, 150, '2020-04-26 19:39:56', '2020-04-26 19:39:56', 0, 1),
(2, 2, 1, 50, '2020-04-26 19:39:56', '2020-04-26 19:39:56', 0, 1),
(3, 3, 1, 30, '2020-04-26 19:39:57', '2020-04-26 19:39:57', 0, 1),
(4, 4, 1, 200, '2020-04-26 19:39:57', '2020-04-26 19:39:57', 0, 1),
(5, 1, 2, 15, '2020-04-26 19:39:58', '2020-04-26 19:39:58', 0, 1),
(6, 2, 2, 3, '2020-04-26 19:39:58', '2020-04-26 19:39:58', 0, 1),
(7, 3, 2, 2, '2020-04-26 19:39:58', '2020-04-26 19:39:58', 0, 1),
(8, 4, 2, 10, '2020-04-26 19:39:58', '2020-04-26 19:39:58', 0, 1),
(9, 1, 3, 10, '2020-04-26 19:39:59', '2020-04-26 19:39:59', 0, 1),
(10, 2, 3, 3, '2020-04-26 19:39:59', '2020-04-26 19:39:59', 0, 1),
(11, 3, 3, 1, '2020-04-26 19:39:59', '2020-04-26 19:39:59', 0, 1),
(12, 4, 3, 3, '2020-04-26 19:39:59', '2020-04-26 19:39:59', 0, 1),
(13, 1, 4, 300, '2020-04-26 19:40:00', '2020-04-26 19:40:00', 0, 1),
(14, 2, 4, 100, '2020-04-26 19:40:00', '2020-04-26 19:40:00', 0, 1),
(15, 3, 4, 75, '2020-04-26 19:40:01', '2020-04-26 19:40:01', 0, 1),
(16, 4, 4, 0, '2020-04-26 19:40:01', '2020-04-26 19:40:01', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `lignelivraison`
--

CREATE TABLE `lignelivraison` (
  `id` int(11) NOT NULL,
  `livraison_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `quantite_livree` int(11) NOT NULL,
  `reste` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `lignelivraison`
--

INSERT INTO `lignelivraison` (`id`, `livraison_id`, `produit_id`, `quantite`, `quantite_livree`, `reste`, `created`, `modified`, `protected`, `valide`) VALUES
(7, 3, 2, 50, 50, 0, '2020-04-27 12:00:27', '2020-04-27 12:00:27', 0, 1),
(8, 3, 4, 50, 50, 0, '2020-04-27 12:00:27', '2020-04-27 12:00:27', 0, 1),
(14, 2, 2, 50, 50, 0, '2020-04-30 12:21:46', '2020-04-30 12:21:46', 0, 1),
(15, 2, 3, 50, 50, 0, '2020-04-30 12:21:46', '2020-04-30 12:21:46', 0, 1),
(16, 2, 4, 50, 50, 0, '2020-04-30 12:21:47', '2020-04-30 12:21:47', 0, 1),
(20, 6, 2, 20, 20, 0, '2020-04-30 12:48:57', '2020-04-30 12:48:57', 0, 1),
(21, 6, 3, 20, 20, 0, '2020-04-30 12:48:57', '2020-04-30 12:48:57', 0, 1),
(22, 6, 4, 20, 20, 0, '2020-04-30 12:48:58', '2020-04-30 12:48:58', 0, 1),
(23, 1, 2, 300, 300, 0, '2020-04-30 13:18:27', '2020-04-30 13:18:27', 0, 1),
(24, 1, 3, 100, 100, 0, '2020-04-30 13:18:28', '2020-04-30 13:18:28', 0, 1),
(25, 1, 4, 100, 100, 0, '2020-04-30 13:18:28', '2020-04-30 13:18:28', 0, 1),
(32, 5, 2, 80, 80, 0, '2020-04-30 13:56:32', '2020-04-30 13:56:32', 0, 1),
(33, 5, 3, 80, 80, 0, '2020-04-30 13:56:33', '2020-04-30 13:56:33', 0, 1),
(34, 5, 4, 80, 80, 0, '2020-04-30 13:56:33', '2020-04-30 13:56:33', 0, 1),
(35, 4, 2, 50, 50, 0, '2020-04-30 13:57:18', '2020-04-30 13:57:18', 0, 1),
(36, 4, 4, 50, 50, 0, '2020-04-30 13:57:18', '2020-04-30 13:57:18', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ligneproductionjour`
--

CREATE TABLE `ligneproductionjour` (
  `id` int(11) NOT NULL,
  `productionjour_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `production` int(11) NOT NULL,
  `perte` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ligneproductionjour`
--

INSERT INTO `ligneproductionjour` (`id`, `productionjour_id`, `produit_id`, `production`, `perte`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 1, 100, 10, '2020-04-25 00:00:00', '2020-04-26 19:39:53', 0, 1),
(2, 1, 2, 100, 10, '2020-04-25 00:00:00', '2020-04-26 19:39:54', 0, 1),
(3, 1, 3, 100, 10, '2020-04-25 00:00:00', '2020-04-26 19:39:55', 0, 1),
(4, 1, 4, 100, 10, '2020-04-25 00:00:00', '2020-04-26 19:39:56', 0, 1),
(5, 2, 1, 500, 0, '2020-04-26 20:44:20', '2020-04-26 20:44:20', 0, 1),
(6, 2, 2, 250, 50, '2020-04-26 20:44:20', '2020-04-26 20:44:20', 0, 1),
(7, 2, 3, 1500, 0, '2020-04-26 20:44:20', '2020-04-26 20:44:20', 0, 1),
(8, 2, 4, 750, 50, '2020-04-26 20:44:20', '2020-04-26 20:44:20', 0, 1),
(9, 3, 1, 2000, 0, '2020-04-27 10:09:51', '2020-04-27 10:09:51', 0, 1),
(10, 3, 2, 500, 15, '2020-04-27 10:09:51', '2020-04-27 10:09:51', 0, 1),
(11, 3, 3, 300, 30, '2020-04-27 10:09:51', '2020-04-27 10:09:51', 0, 1),
(12, 3, 4, 500, 2, '2020-04-27 10:09:51', '2020-04-27 10:09:51', 0, 1),
(13, 4, 1, 0, 0, '2020-04-28 21:30:10', '2020-04-28 21:30:10', 0, 1),
(14, 4, 2, 0, 0, '2020-04-28 21:30:11', '2020-04-28 21:30:11', 0, 1),
(15, 4, 3, 0, 0, '2020-04-28 21:30:11', '2020-04-28 21:30:11', 0, 1),
(16, 4, 4, 0, 0, '2020-04-28 21:30:11', '2020-04-28 21:30:11', 0, 1),
(17, 5, 1, 0, 0, '2020-04-29 00:06:07', '2020-04-29 00:06:07', 0, 1),
(18, 5, 2, 0, 0, '2020-04-29 00:06:07', '2020-04-29 00:06:07', 0, 1),
(19, 5, 3, 0, 0, '2020-04-29 00:06:07', '2020-04-29 00:06:07', 0, 1),
(20, 5, 4, 0, 0, '2020-04-29 00:06:07', '2020-04-29 00:06:07', 0, 1),
(21, 6, 1, 0, 0, '2020-04-30 07:27:17', '2020-04-30 07:27:17', 0, 1),
(22, 6, 2, 0, 0, '2020-04-30 07:27:17', '2020-04-30 07:27:17', 0, 1),
(23, 6, 3, 0, 0, '2020-04-30 07:27:17', '2020-04-30 07:27:17', 0, 1),
(24, 6, 4, 0, 0, '2020-04-30 07:27:18', '2020-04-30 07:27:18', 0, 1),
(25, 7, 1, 0, 0, '2020-05-01 03:33:38', '2020-05-01 03:33:38', 0, 1),
(26, 7, 2, 0, 0, '2020-05-01 03:33:39', '2020-05-01 03:33:39', 0, 1),
(27, 7, 3, 0, 0, '2020-05-01 03:33:39', '2020-05-01 03:33:39', 0, 1),
(28, 7, 4, 0, 0, '2020-05-01 03:33:39', '2020-05-01 03:33:39', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `groupecommande_id` int(20) NOT NULL,
  `zonelivraison_id` int(11) DEFAULT NULL,
  `lieu` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `vehicule_id` int(11) DEFAULT NULL,
  `chauffeur_id` int(11) DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `datelivraison` date DEFAULT NULL,
  `comment` text COLLATE utf8_bin DEFAULT NULL,
  `nom_receptionniste` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `contact_receptionniste` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`id`, `reference`, `groupecommande_id`, `zonelivraison_id`, `lieu`, `vehicule_id`, `chauffeur_id`, `etat_id`, `employe_id`, `datelivraison`, `comment`, `nom_receptionniste`, `contact_receptionniste`, `created`, `modified`, `protected`, `valide`) VALUES
(2, 'BLI/27042020-866E65', 3, 4, 'Quartier france', 1, 1, 4, 1, '2020-05-01', NULL, NULL, NULL, '2020-04-27 11:56:23', '2020-04-27 11:56:23', 0, 1),
(3, 'BLI/27042020-95AAF3', 3, 4, 'quartier france', 1, 2, 2, 1, '2020-05-01', NULL, NULL, NULL, '2020-04-27 12:00:26', '2020-04-27 12:00:26', 0, 1),
(4, 'BLI/30042020-93C8F4', 3, 4, 'Katiala, Ferké, Boudiali', 2, 2, 2, 1, '2020-04-30', NULL, NULL, NULL, '2020-04-29 21:14:03', '2020-04-29 21:14:03', 0, 1),
(5, 'BLI/30042020-90ED01', 5, 3, 'Katiala, Ferké, Boudiali', 1, 1, 2, 1, '2020-04-30', NULL, NULL, NULL, '2020-04-30 12:47:18', '2020-04-30 12:47:18', 0, 1),
(6, NULL, 5, NULL, NULL, NULL, 0, 4, 0, '2020-05-02', NULL, NULL, NULL, '2020-04-30 12:48:56', '2020-04-30 12:48:56', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `machine`
--

CREATE TABLE `machine` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `marque` varchar(50) COLLATE utf8_bin NOT NULL,
  `modele` varchar(200) COLLATE utf8_bin NOT NULL,
  `image` text COLLATE utf8_bin DEFAULT NULL,
  `etatvehicule_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `machine`
--

INSERT INTO `machine` (`id`, `name`, `marque`, `modele`, `image`, `etatvehicule_id`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Machine de BTX', 'Bosch', 'Alpha 162 AK', 'default.jpg', 1, '2020-04-27 10:27:17', '2020-04-27 10:27:17', 0, 1),
(2, 'Machine de Hors', 'Watchok', 'LAND CRUSER', 'default.jpg', 1, '2020-04-27 10:28:17', '2020-04-27 10:28:17', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `manoeuvre`
--

CREATE TABLE `manoeuvre` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `groupemanoeuvre_id` int(2) NOT NULL,
  `adresse` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `contact` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `manoeuvre`
--

INSERT INTO `manoeuvre` (`id`, `name`, `groupemanoeuvre_id`, `adresse`, `contact`, `image`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'manoeuvre 1', 1, 'koumassi', '47 58 93 21', 'default.png', '2020-04-27 10:21:55', '2020-04-27 10:21:55', 0, 1),
(2, 'manoeuvre 2', 1, 'Port-Bouet Rue de la baltique', '47 58 93 21', 'default.png', '2020-04-27 10:22:17', '2020-04-27 10:22:17', 0, 1),
(3, 'manoeuvre 3', 1, '22 rue des chantilles, korogho 24 Bd', '22775896', 'default.png', '2020-04-27 10:22:59', '2020-04-27 10:22:59', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `manoeuvredujour`
--

CREATE TABLE `manoeuvredujour` (
  `id` int(11) NOT NULL,
  `productionjour_id` int(11) NOT NULL,
  `manoeuvre_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `manoeuvredujour`
--

INSERT INTO `manoeuvredujour` (`id`, `productionjour_id`, `manoeuvre_id`, `price`, `created`, `modified`, `protected`, `valide`) VALUES
(10, 3, 1, 26000, '2020-04-27 11:51:28', '2020-04-27 11:51:28', 0, 1),
(11, 3, 2, 26000, '2020-04-27 11:51:28', '2020-04-27 11:51:28', 0, 1),
(12, 3, 3, 26000, '2020-04-27 11:51:28', '2020-04-27 11:51:28', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `manoeuvredurangement`
--

CREATE TABLE `manoeuvredurangement` (
  `id` int(11) NOT NULL,
  `productionjour_id` int(11) NOT NULL,
  `manoeuvre_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `manoeuvredurangement`
--

INSERT INTO `manoeuvredurangement` (`id`, `productionjour_id`, `manoeuvre_id`, `price`, `created`, `modified`, `protected`, `valide`) VALUES
(16, 2, 1, 0, '2020-04-29 13:20:49', '2020-04-29 13:20:49', 0, 1),
(17, 2, 2, 0, '2020-04-29 13:20:49', '2020-04-29 13:20:49', 0, 1),
(18, 2, 3, 0, '2020-04-29 13:20:49', '2020-04-29 13:20:49', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE `marque` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `logo` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`id`, `name`, `logo`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'ABARTH', '', NULL, '2019-10-28 14:12:43', 0, 1),
(2, 'ACURA', '', NULL, '2019-10-28 14:12:43', 0, 1),
(3, 'ALFA ROMEO', '', NULL, '2019-10-28 14:12:43', 0, 1),
(4, 'ALPINA', '', NULL, '2019-10-28 14:12:43', 0, 1),
(5, 'AMC', '', NULL, '2019-10-28 14:12:43', 0, 1),
(6, 'ASR', '', NULL, '2019-10-28 14:12:43', 0, 1),
(7, 'ASTON MARTIN', '', NULL, '2019-10-28 14:12:43', 0, 1),
(8, 'AUDI', '', NULL, '2019-10-28 14:12:43', 0, 1),
(9, 'BENTLEY', '', NULL, '2019-10-28 14:12:43', 0, 1),
(10, 'BMW', '', NULL, '2019-10-28 14:12:43', 0, 1),
(11, 'BRILLIANCE', '', NULL, '2019-10-28 14:12:43', 0, 1),
(12, 'BUGATTI', '', NULL, '2019-10-28 14:12:43', 0, 1),
(13, 'BUICK', '', NULL, '2019-10-28 14:12:43', 0, 1),
(14, 'CADILLAC', '', NULL, '2019-10-28 14:12:43', 0, 1),
(15, 'CHERY', '', NULL, '2019-10-28 14:12:43', 0, 1),
(16, 'CHEVROLET', '', NULL, '2019-10-28 14:12:43', 0, 1),
(17, 'CHRYSLER', '', NULL, '2019-10-28 14:12:43', 0, 1),
(18, 'CIZETA', '', NULL, '2019-10-28 14:12:43', 0, 1),
(19, 'CORVETTE', '', NULL, '2019-10-28 14:12:43', 0, 1),
(20, 'COVINI', '', NULL, '2019-10-28 14:12:43', 0, 1),
(21, 'DACIA', '', NULL, '2019-10-28 14:12:43', 0, 1),
(22, 'DAEWOO', '', NULL, '2019-10-28 14:12:43', 0, 1),
(23, 'DAIHATSU', '', NULL, '2019-10-28 14:12:43', 0, 1),
(24, 'DATSUN', '', NULL, '2019-10-28 14:12:43', 0, 1),
(25, 'DKW', '', NULL, '2019-10-28 14:12:43', 0, 1),
(26, 'DODGE', '', NULL, '2019-10-28 14:12:43', 0, 1),
(27, 'EAGLE', '', NULL, '2019-10-28 14:12:43', 0, 1),
(28, 'FARBIO', '', NULL, '2019-10-28 14:12:43', 0, 1),
(29, 'FERRARI', '', NULL, '2019-10-28 14:12:43', 0, 1),
(30, 'FIAT', '', NULL, '2019-10-28 14:12:43', 0, 1),
(31, 'FISKER', '', NULL, '2019-10-28 14:12:43', 0, 1),
(32, 'FORD', '', NULL, '2019-10-28 14:12:43', 0, 1),
(33, 'GEELY', '', NULL, '2019-10-28 14:12:43', 0, 1),
(34, 'GEO', '', NULL, '2019-10-28 14:12:43', 0, 1),
(35, 'GMC', '', NULL, '2019-10-28 14:12:43', 0, 1),
(36, 'GREAT WALL', '', NULL, '2019-10-28 14:12:43', 0, 1),
(37, 'HOLDEN', '', NULL, '2019-10-28 14:12:43', 0, 1),
(38, 'HONDA', '', NULL, '2019-10-28 14:12:43', 0, 1),
(39, 'HORCH', '', NULL, '2019-10-28 14:12:43', 0, 1),
(40, 'HUMMER', '', NULL, '2019-10-28 14:12:43', 0, 1),
(41, 'HYUNDAI', '', NULL, '2019-10-28 14:12:43', 0, 1),
(42, 'INFINITI', '', NULL, '2019-10-28 14:12:43', 0, 1),
(43, 'ISUZU', '', NULL, '2019-10-28 14:12:43', 0, 1),
(44, 'JAGUAR', '', NULL, '2019-10-28 14:12:43', 0, 1),
(45, 'JEEP', '', NULL, '2019-10-28 14:12:43', 0, 1),
(46, 'KIA', '', NULL, '2019-10-28 14:12:43', 0, 1),
(47, 'KOENIGSEGG', '', NULL, '2019-10-28 14:12:43', 0, 1),
(48, 'LADA', '', NULL, '2019-10-28 14:12:43', 0, 1),
(49, 'LAMBORGHINI', '', NULL, '2019-10-28 14:12:43', 0, 1),
(50, 'LANCIA', '', NULL, '2019-10-28 14:12:43', 0, 1),
(51, 'LAND ROVER', '', NULL, '2019-10-28 14:12:43', 0, 1),
(52, 'LEBLANC', '', NULL, '2019-10-28 14:12:43', 0, 1),
(53, 'LEXUS', '', NULL, '2019-10-28 14:12:43', 0, 1),
(54, 'LINCOLN', '', NULL, '2019-10-28 14:12:43', 0, 1),
(55, 'LOTUS', '', NULL, '2019-10-28 14:12:43', 0, 1),
(56, 'MAHINDRA', '', NULL, '2019-10-28 14:12:43', 0, 1),
(57, 'MARUTI', '', NULL, '2019-10-28 14:12:43', 0, 1),
(58, 'MASERATI', '', NULL, '2019-10-28 14:12:43', 0, 1),
(59, 'MAYBACH', '', NULL, '2019-10-28 14:12:43', 0, 1),
(60, 'MAZDA', '', NULL, '2019-10-28 14:12:43', 0, 1),
(61, 'MERCEDES-BENZ', '', NULL, '2019-10-28 14:12:43', 0, 1),
(62, 'MG', '', NULL, '2019-10-28 14:12:43', 0, 1),
(63, 'MINI', '', NULL, '2019-10-28 14:12:43', 0, 1),
(64, 'MITSUBISHI', '', NULL, '2019-10-28 14:12:44', 0, 1),
(65, 'MORGAN', '', NULL, '2019-10-28 14:12:44', 0, 1),
(66, 'MOSKVICH', '', NULL, '2019-10-28 14:12:44', 0, 1),
(67, 'NANJING', '', NULL, '2019-10-28 14:12:44', 0, 1),
(68, 'NAZA', '', NULL, '2019-10-28 14:12:44', 0, 1),
(69, 'NISSAN', '', NULL, '2019-10-28 14:12:44', 0, 1),
(70, 'NOBLE', '', NULL, '2019-10-28 14:12:44', 0, 1),
(71, 'OLDSMOBILE', '', NULL, '2019-10-28 14:12:44', 0, 1),
(72, 'OPEL', '', NULL, '2019-10-28 14:12:44', 0, 1),
(73, 'PAGANI', '', NULL, '2019-10-28 14:12:44', 0, 1),
(74, 'PANOZ', '', NULL, '2019-10-28 14:12:44', 0, 1),
(75, 'PEUGEOT', '', NULL, '2019-10-28 14:12:44', 0, 1),
(76, 'PIAGGIO', '', NULL, '2019-10-28 14:12:44', 0, 1),
(77, 'PLYMOUTH', '', NULL, '2019-10-28 14:12:44', 0, 1),
(78, 'PONTIAC', '', NULL, '2019-10-28 14:12:44', 0, 1),
(79, 'PORSCHE', '', NULL, '2019-10-28 14:12:44', 0, 1),
(80, 'PERODUA', '', NULL, '2019-10-28 14:12:44', 0, 1),
(81, 'PROTON', '', NULL, '2019-10-28 14:12:44', 0, 1),
(82, 'RAPP MOTERNWERKE', '', NULL, '2019-10-28 14:12:44', 0, 1),
(83, 'RENAULT', '', NULL, '2019-10-28 14:12:44', 0, 1),
(84, 'ROEWE', '', NULL, '2019-10-28 14:12:44', 0, 1),
(85, 'ROLLS-ROYCE', '', NULL, '2019-10-28 14:12:44', 0, 1),
(86, 'ROVER', '', NULL, '2019-10-28 14:12:44', 0, 1),
(87, 'ROSSION', '', NULL, '2019-10-28 14:12:44', 0, 1),
(88, 'SAAB', '', NULL, '2019-10-28 14:12:44', 0, 1),
(89, 'SATURN', '', NULL, '2019-10-28 14:12:44', 0, 1),
(90, 'SCION', '', NULL, '2019-10-28 14:12:44', 0, 1),
(91, 'SEAT', '', NULL, '2019-10-28 14:12:44', 0, 1),
(92, 'SKODA', '', NULL, '2019-10-28 14:12:44', 0, 1),
(93, 'SMART', '', NULL, '2019-10-28 14:12:44', 0, 1),
(94, 'SPYKER', '', NULL, '2019-10-28 14:12:44', 0, 1),
(95, 'SSANGYONG', '', NULL, '2019-10-28 14:12:44', 0, 1),
(96, 'STEALTH', '', NULL, '2019-10-28 14:12:44', 0, 1),
(97, 'SUZUKI', '', NULL, '2019-10-28 14:12:44', 0, 1),
(98, 'TATA', '', NULL, '2019-10-28 14:12:44', 0, 1),
(99, 'TESLA', '', NULL, '2019-10-28 14:12:44', 0, 1),
(100, 'TOYOTA', '', NULL, '2019-10-28 14:12:44', 0, 1),
(101, 'TONIQ', '', NULL, '2019-10-28 14:12:44', 0, 1),
(102, 'TRABANT', '', NULL, '2019-10-28 14:12:44', 0, 1),
(103, 'VAUXHALL', '', NULL, '2019-10-28 14:12:44', 0, 1),
(104, 'VECTOR', '', NULL, '2019-10-28 14:12:44', 0, 1),
(105, 'VENTURI', '', NULL, '2019-10-28 14:12:44', 0, 1),
(106, 'VOLKSWAGEN', '', NULL, '2019-10-28 14:12:44', 0, 1),
(107, 'VOLVO', '', NULL, '2019-10-28 14:12:44', 0, 1),
(108, 'WANDERER', '', NULL, '2019-10-28 14:12:44', 0, 1),
(109, 'WARTBURG', '', NULL, '2019-10-28 14:12:44', 0, 1),
(110, 'WESTFIELD', '', NULL, '2019-10-28 14:12:44', 0, 1),
(111, 'ZASTAVA ', '', NULL, '2019-10-28 14:12:44', 0, 1),
(112, 'DISCOVERY', NULL, '2019-10-18 12:21:02', '2019-10-28 14:12:44', 0, 1),
(113, 'CHANGAN', NULL, '2019-10-18 12:22:32', '2019-10-28 14:12:44', 0, 1),
(114, 'OUTLANDER', NULL, '2019-10-28 11:09:31', '2019-10-28 14:12:44', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `modepayement`
--

CREATE TABLE `modepayement` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `initial` varchar(3) COLLATE utf8_bin NOT NULL,
  `etat_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `modepayement`
--

INSERT INTO `modepayement` (`id`, `name`, `initial`, `etat_id`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Espèces', 'ES', 3, '2020-04-26 19:39:47', '2020-04-26 19:39:47', 1, 1),
(2, 'Prelevement sur acompte', 'PA', 3, '2020-04-26 19:39:47', '2020-04-26 19:39:47', 1, 1),
(3, 'Chèque', 'CH', 2, '2020-04-26 19:39:48', '2020-04-26 19:39:48', 1, 1),
(4, 'Virement banquaire', 'VB', 2, '2020-04-26 19:39:48', '2020-04-26 19:39:48', 1, 1),
(5, 'Mobile money', 'MM', 2, '2020-04-26 19:39:48', '2020-04-26 19:39:48', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `mycompte`
--

CREATE TABLE `mycompte` (
  `id` int(11) NOT NULL,
  `identifiant` varchar(9) COLLATE utf8_bin NOT NULL,
  `tentative` int(11) NOT NULL,
  `expired` datetime NOT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `mycompte`
--

INSERT INTO `mycompte` (`id`, `identifiant`, `tentative`, `expired`, `protected`, `valide`) VALUES
(1, '382D863', 0, '2020-05-03 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

CREATE TABLE `operation` (
  `id` int(11) NOT NULL,
  `categorieoperation_id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin NOT NULL,
  `montant` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `manoeuvre_id` int(11) DEFAULT NULL,
  `fournisseur_id` int(11) DEFAULT NULL,
  `modepayement_id` int(11) NOT NULL,
  `structure` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `numero` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `comment` text COLLATE utf8_bin DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `date_approbation` datetime DEFAULT NULL,
  `isModified` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `operation`
--

INSERT INTO `operation` (`id`, `categorieoperation_id`, `reference`, `montant`, `client_id`, `manoeuvre_id`, `fournisseur_id`, `modepayement_id`, `structure`, `numero`, `comment`, `etat_id`, `employe_id`, `date_approbation`, `isModified`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 'BCA/27042020-58C0A2', 530000, 2, NULL, NULL, 1, '', '', 'Réglement de la facture pour la commande N°BCO/27042020-58AB48', 3, 1, NULL, 0, '2020-04-27 10:35:56', '2020-04-27 10:35:56', 0, 1),
(2, 1, 'BCA/27042020-6D1D89', 150000, 2, NULL, NULL, 1, '', '', 'Acréditation du compte du client Client A d\'un montant de 150 000 Fcfa', 3, 1, NULL, 0, '2020-04-27 10:41:21', '2020-04-27 10:41:21', 0, 1),
(3, 6, 'BCA/27042020-717032', 50000, 2, NULL, NULL, 1, '', '', 'Rembourser à partir du acompte du client Client A d\'un montant de 50 000 Fcfa\n Erreur lors de la saisie du montant pour crediter le acompte', 3, 1, NULL, 0, '2020-04-27 10:42:31', '2020-04-27 10:42:31', 0, 1),
(4, 1, 'BCA/27042020-784947', 200000, 3, NULL, NULL, 3, 'ORANGE MONEY', 'ee5e6bce', 'Acréditation du compte du client client B d\'un montant de 200 000 Fcfa', 2, 1, NULL, 0, '2020-04-27 10:44:20', '2020-04-27 10:44:20', 0, 1),
(5, 3, 'BCA/27042020-8BA547', 507500, 1, NULL, NULL, 1, '', '', 'Réglement de la facture d\'approvisionnement N°APP/27042020-8BA97F', 4, 1, NULL, 0, '2020-04-27 10:49:30', '2020-04-27 10:49:30', 0, 1),
(6, 4, 'BCA/27042020-DB14F6', 20000, 1, 2, NULL, 1, NULL, NULL, 'Réglement de la paye de manoeuvre 2', 3, 1, NULL, 0, '2020-04-27 11:10:41', '2020-04-27 11:10:41', 0, 1),
(7, 4, 'BCA/27042020-E2727B', 20000, 1, 3, NULL, 1, NULL, NULL, 'Réglement de la paye de manoeuvre 3', 3, 1, NULL, 0, '2020-04-27 11:12:39', '2020-04-27 11:12:39', 0, 1),
(8, 1, 'BCA/28042020-7DBE4E', 100000, 4, NULL, NULL, 1, '', '', 'Acréditation du compte du client client C d\'un montant de 100 000 Fcfa', 3, 1, NULL, 0, '2020-04-28 23:10:19', '2020-04-28 23:10:19', 0, 1),
(9, 1, 'BCA/28042020-9E9AB7', 378000, 4, NULL, NULL, 1, '', '', 'Réglement de la facture pour la commande N°BCO/28042020-9E87B0', 3, 1, NULL, 0, '2020-04-28 23:19:05', '2020-04-28 23:19:05', 0, 1),
(10, 1, 'BCA/29042020-63924A', 500000, 3, NULL, NULL, 1, '', '', 'Acréditation du compte du client client B d\'un montant de 500 000 Fcfa', 3, 1, NULL, 0, '2020-04-29 10:26:01', '2020-04-29 10:26:01', 0, 1),
(11, 1, 'BCA/29042020-8F7EFE', 63000, 3, NULL, NULL, 1, '', '', 'Reglement de la dette du client client B d\'un montant de 63 000 Fcfa', 3, 1, NULL, 0, '2020-04-29 10:37:44', '2020-04-29 10:37:44', 0, 1),
(12, 1, 'BCA/29042020-96233B', 63000, 3, NULL, NULL, 1, '', '', 'Reglement de la dette du client client B d\'un montant de 63 000 Fcfa', 3, 1, NULL, 0, '2020-04-29 10:39:30', '2020-04-29 10:39:30', 0, 1),
(13, 1, 'BCA/29042020-99A5D6', 63000, 3, NULL, NULL, 1, '', '', 'Reglement de la dette du client client B d\'un montant de 63 000 Fcfa', 3, 1, NULL, 0, '2020-04-29 10:40:26', '2020-04-29 10:40:26', 0, 1),
(14, 1, 'BCA/29042020-9EA32A', 63000, 3, NULL, NULL, 2, '', '', 'Reglement de la dette du client client B d\'un montant de 63 000 Fcfa à partir de son acompte', 3, 1, NULL, 0, '2020-04-29 10:41:46', '2020-04-29 10:41:46', 0, 1),
(15, 3, 'BCA/01052020-283971', 100000, 1, NULL, 1, 1, '', '', 'Acréditation du compte du fournisseur Devaris FOURNISSEUR d\'un montant de 100 000 Fcfa', 3, 1, NULL, 0, '2020-05-01 04:16:03', '2020-05-01 04:16:03', 0, 1),
(16, 3, 'BCA/01052020-7BF31E', 151800, 1, NULL, 1, 2, '', '', 'Réglement de la facture d\'approvisionnement N°APP/01052020-7BFAC0', 2, 1, NULL, 0, '2020-05-01 04:38:23', '2020-05-01 04:38:23', 0, 1),
(17, 3, 'BCA/01052020-07F01B', 45000, 1, NULL, 1, 3, 'ORANGE MONEY', 'da018663', 'Reglement de la dette du fournisseur Devaris FOURNISSEUR d\'un montant de 45 000 Fcfa', 3, 1, NULL, 0, '2020-05-01 05:15:43', '2020-05-01 05:15:43', 0, 1),
(18, 3, 'BCA/01052020-2037BF', 30000, 1, NULL, 1, 1, '', '', 'Acréditation du compte du fournisseur Devaris FOURNISSEUR d\'un montant de 30 000 Fcfa', 3, 1, NULL, 0, '2020-05-01 05:22:11', '2020-05-01 05:22:11', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `panne`
--

CREATE TABLE `panne` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8_bin NOT NULL,
  `reference` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `machine_id` int(11) NOT NULL,
  `manoeuvre_id` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `image` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `date_approuve` datetime DEFAULT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `params`
--

CREATE TABLE `params` (
  `id` int(11) NOT NULL,
  `societe` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(200) COLLATE utf8_bin NOT NULL,
  `contact` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `devise` varchar(50) COLLATE utf8_bin NOT NULL,
  `tva` int(11) NOT NULL,
  `seuilCredit` int(11) NOT NULL,
  `adresse` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `postale` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `autoriserVersementAttente` varchar(11) COLLATE utf8_bin NOT NULL,
  `bloquerOrfonds` varchar(11) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `params`
--

INSERT INTO `params` (`id`, `societe`, `email`, `contact`, `fax`, `devise`, `tva`, `seuilCredit`, `adresse`, `postale`, `image`, `autoriserVersementAttente`, `bloquerOrfonds`, `protected`, `valide`) VALUES
(1, 'briqueterie indistruelle de yaou', 'info@bidy.com', '47 58 93 21 - 02 015 -256', '45 45 45 89', 'Fcfa', 5, 1000000, 'Port-Bouet Rue de la baltique', '54 BP 64 ABIDJAN 45', '35188e9a.png', 'on', 'off', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `paye_chauffeur`
--

CREATE TABLE `paye_chauffeur` (
  `id` int(11) NOT NULL,
  `chauffeur_id` int(11) NOT NULL,
  `mois` int(11) NOT NULL,
  `annee` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `paye_produit`
--

CREATE TABLE `paye_produit` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `price_rangement` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `paye_produit`
--

INSERT INTO `paye_produit` (`id`, `produit_id`, `price`, `price_rangement`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 20, 21, '2020-04-26 19:39:53', '2020-04-26 19:39:53', 0, 1),
(2, 2, 15, 16, '2020-04-26 19:39:54', '2020-04-26 19:39:54', 0, 1),
(3, 3, 35, 36, '2020-04-26 19:39:55', '2020-04-26 19:39:55', 0, 1),
(4, 4, 40, 41, '2020-04-26 19:39:56', '2020-04-26 19:39:56', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `prestataire`
--

CREATE TABLE `prestataire` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `typeprestataire_id` int(11) NOT NULL,
  `contact` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `email` text COLLATE utf8_bin DEFAULT NULL,
  `adresse` text COLLATE utf8_bin DEFAULT NULL,
  `registre` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `login` text COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  `is_new` int(11) NOT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `is_allowed` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `prestataire`
--

INSERT INTO `prestataire` (`id`, `name`, `typeprestataire_id`, `contact`, `fax`, `email`, `adresse`, `registre`, `login`, `password`, `is_new`, `image`, `is_allowed`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Devaris PRESTATAIRE', 1, '...', NULL, 'info@devaris21.com', '...', NULL, '...', '...', 1, 'default.png', 1, '2020-04-26 19:39:47', '2020-04-26 19:39:47', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `prix_zonelivraison`
--

CREATE TABLE `prix_zonelivraison` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `zonelivraison_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `prix_zonelivraison`
--

INSERT INTO `prix_zonelivraison` (`id`, `produit_id`, `zonelivraison_id`, `price`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 1, 400, '2020-04-26 19:39:53', '2020-04-26 19:39:53', 0, 1),
(2, 2, 1, 100, '2020-04-26 19:39:54', '2020-04-26 19:39:54', 0, 1),
(3, 3, 1, 200, '2020-04-26 19:39:55', '2020-04-26 19:39:55', 0, 1),
(4, 4, 1, 300, '2020-04-26 19:39:55', '2020-04-26 19:39:55', 0, 1),
(5, 1, 2, 410, '2020-04-27 10:13:36', '2020-04-27 10:13:36', 0, 1),
(6, 2, 2, 225, '2020-04-27 10:13:37', '2020-04-27 10:13:37', 0, 1),
(7, 3, 2, 175, '2020-04-27 10:13:37', '2020-04-27 10:13:37', 0, 1),
(8, 4, 2, 230, '2020-04-27 10:13:37', '2020-04-27 10:13:37', 0, 1),
(9, 1, 3, 300, '2020-04-27 10:14:03', '2020-04-27 10:14:03', 0, 1),
(10, 2, 3, 150, '2020-04-27 10:14:03', '2020-04-27 10:14:03', 0, 1),
(11, 3, 3, 200, '2020-04-27 10:14:03', '2020-04-27 10:14:03', 0, 1),
(12, 4, 3, 250, '2020-04-27 10:14:03', '2020-04-27 10:14:03', 0, 1),
(13, 1, 4, 500, '2020-04-27 10:14:37', '2020-04-27 10:14:37', 0, 1),
(14, 2, 4, 200, '2020-04-27 10:14:37', '2020-04-27 10:14:37', 0, 1),
(15, 3, 4, 300, '2020-04-27 10:14:37', '2020-04-27 10:14:37', 0, 1),
(16, 4, 4, 150, '2020-04-27 10:14:37', '2020-04-27 10:14:37', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `productionjour`
--

CREATE TABLE `productionjour` (
  `id` int(11) NOT NULL,
  `ladate` date DEFAULT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `groupemanoeuvre_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `groupemanoeuvre_id_rangement` int(11) NOT NULL,
  `dateRangement` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `productionjour`
--

INSERT INTO `productionjour` (`id`, `ladate`, `comment`, `groupemanoeuvre_id`, `employe_id`, `etat_id`, `groupemanoeuvre_id_rangement`, `dateRangement`, `created`, `modified`, `protected`, `valide`) VALUES
(1, '2020-04-25', '', 0, 0, 4, 0, NULL, '2020-04-26 19:39:52', '2020-04-26 19:39:52', 1, 1),
(2, '2020-04-26', '', 1, 0, 3, 1, '2020-04-29', '2020-04-26 20:44:19', '2020-04-26 20:44:19', 0, 1),
(3, '2020-04-27', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean ma', 1, 1, 4, 0, NULL, '2020-04-27 10:09:50', '2020-04-27 10:09:50', 0, 1),
(4, '2020-04-28', '', 1, 0, 2, 0, NULL, '2020-04-28 21:30:10', '2020-04-28 21:30:10', 0, 1),
(5, '2020-04-29', '', 0, 0, 2, 0, NULL, '2020-04-29 00:06:06', '2020-04-29 00:06:06', 0, 1),
(6, '2020-04-30', '', 0, 0, 2, 0, NULL, '2020-04-30 07:27:17', '2020-04-30 07:27:17', 0, 1),
(7, '2020-05-01', '', 0, 0, 2, 0, NULL, '2020-05-01 03:33:38', '2020-05-01 03:33:38', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `name`, `description`, `image`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'HOURDIS', '', 'default.png', '2020-04-26 19:39:52', '2020-04-26 19:39:52', 0, 1),
(2, 'AC 15', '', 'default.png', '2020-04-26 19:39:54', '2020-04-26 19:39:54', 0, 1),
(3, 'AP 15', '', 'default.png', '2020-04-26 19:39:55', '2020-04-26 19:39:55', 0, 1),
(4, 'BTC', '', 'default.png', '2020-04-26 19:39:55', '2020-04-26 19:39:55', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ressource`
--

CREATE TABLE `ressource` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `unite` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `abbr` varchar(20) COLLATE utf8_bin NOT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ressource`
--

INSERT INTO `ressource` (`id`, `name`, `unite`, `abbr`, `image`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'CIMENT', NULL, 'Sacs', 'default.png', '2020-04-26 19:39:56', '2020-04-26 19:39:56', 0, 1),
(2, 'SABLE', NULL, 'Chgs', 'default.png', '2020-04-26 19:39:57', '2020-04-26 19:39:57', 0, 1),
(3, 'GRAVIER', NULL, 'T', 'default.png', '2020-04-26 19:39:59', '2020-04-26 19:39:59', 0, 1),
(4, 'EAU', NULL, 'L', 'default.png', '2020-04-26 19:40:00', '2020-04-26 19:40:00', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `name`, `description`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'master', NULL, '2020-04-26 19:39:45', '2020-04-26 19:39:45', 1, 1),
(2, 'production', NULL, '2020-04-26 19:39:46', '2020-04-26 19:39:46', 1, 1),
(3, 'caisse', NULL, '2020-04-26 19:39:46', '2020-04-26 19:39:46', 1, 1),
(4, 'parametres', NULL, '2020-04-26 19:39:46', '2020-04-26 19:39:46', 1, 1),
(5, 'paye des manoeuvre', NULL, '2020-04-26 19:39:46', '2020-04-26 19:39:46', 1, 1),
(6, 'modifier-supprimer', NULL, '2020-04-26 19:39:46', '2020-04-26 19:39:46', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `role_employe`
--

CREATE TABLE `role_employe` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `role_employe`
--

INSERT INTO `role_employe` (`id`, `role_id`, `employe_id`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 1, '2020-04-26 19:39:51', '2020-04-26 19:39:51', 1, 1),
(2, 2, 1, '2020-04-26 19:39:51', '2020-04-26 19:39:51', 1, 1),
(3, 3, 1, '2020-04-26 19:39:51', '2020-04-26 19:39:51', 1, 1),
(4, 4, 1, '2020-04-26 19:39:52', '2020-04-26 19:39:52', 1, 1),
(5, 5, 1, '2020-04-26 19:39:52', '2020-04-26 19:39:52', 1, 1),
(6, 6, 1, '2020-04-26 19:39:52', '2020-04-26 19:39:52', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sexe`
--

CREATE TABLE `sexe` (
  `id` int(11) NOT NULL,
  `name` varchar(15) COLLATE utf8_bin NOT NULL,
  `abreviation` varchar(11) COLLATE utf8_bin NOT NULL,
  `icon` varchar(50) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `sexe`
--

INSERT INTO `sexe` (`id`, `name`, `abreviation`, `icon`, `protected`, `valide`) VALUES
(1, 'Homme', 'H', 'fa fa-venus-mars', 1, 1),
(2, 'Femme', 'F', 'fa fa-venus-mars', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `suggestion`
--

CREATE TABLE `suggestion` (
  `id` int(11) NOT NULL,
  `ticket` varchar(10) COLLATE utf8_bin NOT NULL,
  `typesuggestion_id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `etat_id` int(11) NOT NULL,
  `date_approuve` datetime DEFAULT NULL,
  `gestionnaire_id` int(11) DEFAULT NULL,
  `carplan_id` int(11) DEFAULT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `typeclient`
--

CREATE TABLE `typeclient` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `typeclient`
--

INSERT INTO `typeclient` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Entreprise', '2020-04-26 19:39:45', '2020-04-26 19:39:45', 1, 1),
(2, 'Particulier', '2020-04-26 19:39:45', '2020-04-26 19:39:45', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeentretienvehicule`
--

CREATE TABLE `typeentretienvehicule` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `typeentretienvehicule`
--

INSERT INTO `typeentretienvehicule` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Accrochage', '2020-04-26 19:39:43', '2020-04-26 19:39:43', 1, 1),
(2, 'Crevaison', '2020-04-26 19:39:43', '2020-04-26 19:39:43', 1, 1),
(3, 'Autre', '2020-04-26 19:39:44', '2020-04-26 19:39:44', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeoperationcaisse`
--

CREATE TABLE `typeoperationcaisse` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `typeoperationcaisse`
--

INSERT INTO `typeoperationcaisse` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Entrée de caisse', '2020-04-26 19:39:43', '2020-04-26 19:39:43', 1, 1),
(2, 'Sortie de caisse', '2020-04-26 19:39:43', '2020-04-26 19:39:43', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeprestataire`
--

CREATE TABLE `typeprestataire` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `typeprestataire`
--

INSERT INTO `typeprestataire` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'standart', '2020-04-26 19:40:01', '2020-04-26 19:40:01', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typesuggestion`
--

CREATE TABLE `typesuggestion` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `typesuggestion`
--

INSERT INTO `typesuggestion` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'standart', '2020-04-26 19:40:02', '2020-04-26 19:40:02', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typetransmission`
--

CREATE TABLE `typetransmission` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `typetransmission`
--

INSERT INTO `typetransmission` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'standart', '2020-04-26 19:40:01', '2020-04-26 19:40:01', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typevehicule`
--

CREATE TABLE `typevehicule` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `typevehicule`
--

INSERT INTO `typevehicule` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Voiture', '2020-04-26 19:39:42', '2020-04-26 19:39:42', 1, 1),
(2, 'Camion benne', '2020-04-26 19:39:42', '2020-04-26 19:39:42', 1, 1),
(3, 'Tricycle', '2020-04-26 19:39:42', '2020-04-26 19:39:42', 1, 1),
(4, 'Moto', '2020-04-26 19:39:43', '2020-04-26 19:39:43', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL,
  `immatriculation` varchar(20) COLLATE utf8_bin NOT NULL,
  `typevehicule_id` int(11) NOT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `nb_place` int(11) DEFAULT NULL,
  `nb_porte` int(11) DEFAULT NULL,
  `marque_id` int(11) NOT NULL,
  `modele` varchar(200) COLLATE utf8_bin NOT NULL,
  `energie_id` int(11) DEFAULT NULL,
  `typetransmission_id` int(11) DEFAULT NULL,
  `affectation` int(11) DEFAULT NULL,
  `puissance` int(10) DEFAULT NULL,
  `date_mise_circulation` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `date_sortie` date DEFAULT NULL,
  `date_visitetechnique` date DEFAULT NULL,
  `date_assurance` date DEFAULT NULL,
  `date_vidange` datetime DEFAULT NULL,
  `image` text COLLATE utf8_bin DEFAULT NULL,
  `visibility` int(11) NOT NULL,
  `groupevehicule_id` int(11) DEFAULT NULL,
  `chasis` text COLLATE utf8_bin DEFAULT NULL,
  `date_acquisition` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `etatvehicule_id` int(11) NOT NULL,
  `possession` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1,
  `kilometrage` int(11) DEFAULT NULL,
  `location` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `immatriculation`, `typevehicule_id`, `prestataire_id`, `nb_place`, `nb_porte`, `marque_id`, `modele`, `energie_id`, `typetransmission_id`, `affectation`, `puissance`, `date_mise_circulation`, `date_sortie`, `date_visitetechnique`, `date_assurance`, `date_vidange`, `image`, `visibility`, `groupevehicule_id`, `chasis`, `date_acquisition`, `price`, `etatvehicule_id`, `possession`, `created`, `modified`, `protected`, `valide`, `kilometrage`, `location`) VALUES
(1, '...', 1, 1, NULL, NULL, 0, 'SON PROPRE VEHICULE', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.jpg', 0, 1, NULL, NULL, 0, 1, 0, '2020-04-26 19:39:44', '2020-04-26 19:39:44', 1, 1, NULL, 0),
(2, '4785 GT 01', 2, 1, NULL, NULL, 5, 'LAND CRUSER', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.jpg', 1, 1, NULL, NULL, 0, 2, 0, '2020-04-27 10:43:07', '2020-04-27 10:43:07', 0, 1, NULL, 0),
(3, '8993 GT 01', 1, 1, NULL, NULL, 7, 'Alpha 162 AK', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.jpg', 1, 2, NULL, NULL, 0, 1, 0, '2020-04-27 10:44:48', '2020-04-27 10:44:48', 0, 1, NULL, 0),
(4, '4785 GT 01', 2, 1, NULL, NULL, 11, 'LAND CRUSER', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.jpg', 1, 1, NULL, NULL, 0, 1, 0, '2020-04-27 10:45:06', '2020-04-27 10:45:06', 0, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `zonelivraison`
--

CREATE TABLE `zonelivraison` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `zonelivraison`
--

INSERT INTO `zonelivraison` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Abidjan', '2020-04-26 19:39:42', '2020-04-26 19:39:42', 1, 1),
(2, 'Bonoua & environs', '2020-04-27 10:13:36', '2020-04-27 10:13:36', 0, 1),
(3, 'Grand Abidjan', '2020-04-27 10:14:03', '2020-04-27 10:14:03', 0, 1),
(4, 'Bouaké et centre du pays', '2020-04-27 10:14:37', '2020-04-27 10:14:37', 0, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `approvisionnement`
--
ALTER TABLE `approvisionnement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `carplan`
--
ALTER TABLE `carplan`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorieoperation`
--
ALTER TABLE `categorieoperation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `chauffeur`
--
ALTER TABLE `chauffeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `connexion`
--
ALTER TABLE `connexion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `demandeentretien`
--
ALTER TABLE `demandeentretien`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `energie`
--
ALTER TABLE `energie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entretienmachine`
--
ALTER TABLE `entretienmachine`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entretienvehicule`
--
ALTER TABLE `entretienvehicule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etatchauffeur`
--
ALTER TABLE `etatchauffeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etatmanoeuvre`
--
ALTER TABLE `etatmanoeuvre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etatvehicule`
--
ALTER TABLE `etatvehicule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `exigenceproduction`
--
ALTER TABLE `exigenceproduction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupecommande`
--
ALTER TABLE `groupecommande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupemanoeuvre`
--
ALTER TABLE `groupemanoeuvre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupevehicule`
--
ALTER TABLE `groupevehicule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneapprovisionnement`
--
ALTER TABLE `ligneapprovisionnement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignecommande`
--
ALTER TABLE `lignecommande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneconsommationjour`
--
ALTER TABLE `ligneconsommationjour`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneexigenceproduction`
--
ALTER TABLE `ligneexigenceproduction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignelivraison`
--
ALTER TABLE `lignelivraison`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneproductionjour`
--
ALTER TABLE `ligneproductionjour`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `machine`
--
ALTER TABLE `machine`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `manoeuvre`
--
ALTER TABLE `manoeuvre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `manoeuvredujour`
--
ALTER TABLE `manoeuvredujour`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `manoeuvredurangement`
--
ALTER TABLE `manoeuvredurangement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `marque`
--
ALTER TABLE `marque`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `modepayement`
--
ALTER TABLE `modepayement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mycompte`
--
ALTER TABLE `mycompte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panne`
--
ALTER TABLE `panne`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `params`
--
ALTER TABLE `params`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paye_chauffeur`
--
ALTER TABLE `paye_chauffeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paye_produit`
--
ALTER TABLE `paye_produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prestataire`
--
ALTER TABLE `prestataire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prix_zonelivraison`
--
ALTER TABLE `prix_zonelivraison`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `productionjour`
--
ALTER TABLE `productionjour`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ressource`
--
ALTER TABLE `ressource`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role_employe`
--
ALTER TABLE `role_employe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sexe`
--
ALTER TABLE `sexe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `suggestion`
--
ALTER TABLE `suggestion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeclient`
--
ALTER TABLE `typeclient`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeentretienvehicule`
--
ALTER TABLE `typeentretienvehicule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeoperationcaisse`
--
ALTER TABLE `typeoperationcaisse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeprestataire`
--
ALTER TABLE `typeprestataire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typesuggestion`
--
ALTER TABLE `typesuggestion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typetransmission`
--
ALTER TABLE `typetransmission`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typevehicule`
--
ALTER TABLE `typevehicule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `zonelivraison`
--
ALTER TABLE `zonelivraison`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `approvisionnement`
--
ALTER TABLE `approvisionnement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `carplan`
--
ALTER TABLE `carplan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categorieoperation`
--
ALTER TABLE `categorieoperation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `chauffeur`
--
ALTER TABLE `chauffeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `connexion`
--
ALTER TABLE `connexion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `demandeentretien`
--
ALTER TABLE `demandeentretien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `energie`
--
ALTER TABLE `energie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `entretienmachine`
--
ALTER TABLE `entretienmachine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `entretienvehicule`
--
ALTER TABLE `entretienvehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `etatchauffeur`
--
ALTER TABLE `etatchauffeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `etatmanoeuvre`
--
ALTER TABLE `etatmanoeuvre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etatvehicule`
--
ALTER TABLE `etatvehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `exigenceproduction`
--
ALTER TABLE `exigenceproduction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `groupecommande`
--
ALTER TABLE `groupecommande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `groupemanoeuvre`
--
ALTER TABLE `groupemanoeuvre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `groupevehicule`
--
ALTER TABLE `groupevehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT pour la table `ligneapprovisionnement`
--
ALTER TABLE `ligneapprovisionnement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `lignecommande`
--
ALTER TABLE `lignecommande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `ligneconsommationjour`
--
ALTER TABLE `ligneconsommationjour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `ligneexigenceproduction`
--
ALTER TABLE `ligneexigenceproduction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `lignelivraison`
--
ALTER TABLE `lignelivraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `ligneproductionjour`
--
ALTER TABLE `ligneproductionjour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `machine`
--
ALTER TABLE `machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `manoeuvre`
--
ALTER TABLE `manoeuvre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `manoeuvredujour`
--
ALTER TABLE `manoeuvredujour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `manoeuvredurangement`
--
ALTER TABLE `manoeuvredurangement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `marque`
--
ALTER TABLE `marque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT pour la table `modepayement`
--
ALTER TABLE `modepayement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `mycompte`
--
ALTER TABLE `mycompte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `operation`
--
ALTER TABLE `operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `panne`
--
ALTER TABLE `panne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `params`
--
ALTER TABLE `params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `paye_chauffeur`
--
ALTER TABLE `paye_chauffeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paye_produit`
--
ALTER TABLE `paye_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `prestataire`
--
ALTER TABLE `prestataire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `prix_zonelivraison`
--
ALTER TABLE `prix_zonelivraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `productionjour`
--
ALTER TABLE `productionjour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `ressource`
--
ALTER TABLE `ressource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `role_employe`
--
ALTER TABLE `role_employe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `sexe`
--
ALTER TABLE `sexe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `suggestion`
--
ALTER TABLE `suggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `typeclient`
--
ALTER TABLE `typeclient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `typeentretienvehicule`
--
ALTER TABLE `typeentretienvehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `typeoperationcaisse`
--
ALTER TABLE `typeoperationcaisse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `typeprestataire`
--
ALTER TABLE `typeprestataire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `typesuggestion`
--
ALTER TABLE `typesuggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `typetransmission`
--
ALTER TABLE `typetransmission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `typevehicule`
--
ALTER TABLE `typevehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `zonelivraison`
--
ALTER TABLE `zonelivraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
