-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  sam. 18 avr. 2020 à 21:29
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bidy`
--

-- --------------------------------------------------------

--
-- Structure de la table `approvisionnement`
--

CREATE TABLE `approvisionnement` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `montant` int(11) NOT NULL,
  `prestataire_id` int(11) NOT NULL,
  `operation_id` int(11) DEFAULT NULL,
  `datelivraison` datetime DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `comment` text,
  `employe_id_reception` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `carplan`
--

CREATE TABLE `carplan` (
  `id` int(11) NOT NULL,
  `matricule` varchar(20) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(150) DEFAULT NULL,
  `sexe_id` int(2) DEFAULT NULL,
  `adresse` varchar(150) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(200) DEFAULT NULL,
  `fonction` varchar(100) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `password` text,
  `is_new` int(11) NOT NULL DEFAULT '0',
  `image` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `allowed` int(11) NOT NULL DEFAULT '1',
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1',
  `visibility` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `categorieoperation`
--

CREATE TABLE `categorieoperation` (
  `id` int(11) NOT NULL,
  `typeoperationcaisse_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `color` varchar(10) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorieoperation`
--

INSERT INTO `categorieoperation` (`id`, `typeoperationcaisse_id`, `name`, `color`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 'Réglement de commande', NULL, NULL, '2019-09-23 13:19:22', 1, 1),
(2, 2, 'Approvisionnement de ressource', NULL, NULL, '2019-09-23 14:05:30', 1, 1),
(3, 1, 'Apport du DG', '#c5fb88', '2019-09-23 13:18:55', '2020-04-12 23:24:04', 0, 1),
(4, 2, 'Payement de salaire', '#ff00ff', '2020-04-12 23:29:15', '2020-04-12 23:29:15', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `chauffeur`
--

CREATE TABLE `chauffeur` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(150) DEFAULT NULL,
  `matricule` varchar(50) DEFAULT NULL,
  `sexe_id` int(2) NOT NULL,
  `nationalite` varchar(200) DEFAULT NULL,
  `adresse` varchar(150) DEFAULT NULL,
  `typepermis` varchar(50) DEFAULT NULL,
  `numero_permis` varchar(200) DEFAULT NULL,
  `date_fin_permis` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(200) DEFAULT NULL,
  `etatchauffeur_id` int(11) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `typeclient_id` int(2) NOT NULL,
  `acompte` int(11) DEFAULT NULL,
  `adresse` varchar(150) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `code`
--

CREATE TABLE `code` (
  `id` int(11) NOT NULL,
  `code` varchar(25) NOT NULL,
  `jour` int(11) NOT NULL,
  `matricule` varchar(50) DEFAULT NULL,
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `groupecommande_id` int(20) NOT NULL,
  `zonelivraison_id` int(11) NOT NULL,
  `lieu` varchar(200) NOT NULL,
  `tva` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `operation_id` int(11) DEFAULT NULL,
  `datelivraison` date NOT NULL,
  `employe_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `connexion`
--

INSERT INTO `connexion` (`id`, `date_connexion`, `date_deconnexion`, `employe_id`, `prestataire_id`, `created`, `modified`, `protected`, `valide`) VALUES
(1, '2020-04-18 21:22:01', NULL, 1, NULL, '2020-04-18 21:22:01', '2020-04-18 21:22:01', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `demandeentretien`
--

CREATE TABLE `demandeentretien` (
  `id` int(11) NOT NULL,
  `typeentretienvehicule_id` int(11) NOT NULL,
  `reference` varchar(10) DEFAULT NULL,
  `vehicule_id` int(11) NOT NULL,
  `carplan_id` int(11) DEFAULT NULL,
  `comment` text NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `date_approuve` datetime DEFAULT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `adresse` varchar(150) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(200) DEFAULT NULL,
  `login` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `is_new` int(11) NOT NULL DEFAULT '0',
  `is_allowed` int(11) NOT NULL DEFAULT '1',
  `visibility` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`id`, `name`, `adresse`, `email`, `contact`, `login`, `password`, `image`, `is_new`, `is_allowed`, `visibility`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'GPA ', 'Marcory Quartier anoumanbo', 'infos@artci.ci', '22775896', 'root', '5e9795e3f3ab55e7790a6283507c085db0d764fc', 'default.png', 0, 1, 1, NULL, '2019-10-17 17:51:13', 1, 1),
(5, 'Aristide', 'Port-Bouet Rue de la baltique', 'glpiadmin@artci.lan', '59 57 33 07', 'ari', '5e9795e3f3ab55e7790a6283507c085db0d764fc', 'default.png', 0, 1, 1, '2019-10-17 17:49:16', '2020-03-29 12:43:37', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `energie`
--

CREATE TABLE `energie` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `energie`
--

INSERT INTO `energie` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Diesel', NULL, NULL, 1, 1),
(2, 'Essence / Super', NULL, '2019-10-18 12:19:54', 1, 1),
(3, 'Gazoil', NULL, NULL, 1, 1),
(4, 'Electricité', NULL, NULL, 1, 1),
(5, 'Gaz', NULL, '2019-10-18 12:20:05', 1, 1),
(6, 'GPL / GNV', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `entretienmachine`
--

CREATE TABLE `entretienmachine` (
  `id` int(11) NOT NULL,
  `reference` varchar(10) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `machine_id` int(11) NOT NULL,
  `started` datetime DEFAULT NULL,
  `finished` datetime DEFAULT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `date_approuve` datetime DEFAULT NULL,
  `employe_id` int(11) NOT NULL,
  `comment` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `entretienvehicule`
--

CREATE TABLE `entretienvehicule` (
  `id` int(11) NOT NULL,
  `reference` varchar(10) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `typeentretienvehicule_id` int(11) NOT NULL,
  `vehicule_id` int(11) NOT NULL,
  `started` datetime DEFAULT NULL,
  `finished` datetime DEFAULT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `date_approuve` datetime DEFAULT NULL,
  `comment` text,
  `employe_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `class` varchar(50) NOT NULL,
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`id`, `name`, `class`, `protected`, `valide`) VALUES
(-2, 'Expiré', 'danger', 1, 1),
(-1, 'annulé', 'danger', 1, 1),
(0, 'en cours', 'info', 1, 1),
(1, 'approuvé', 'success', 1, 1),
(2, 'terminé', 'success', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `etatchauffeur`
--

CREATE TABLE `etatchauffeur` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `class` varchar(50) NOT NULL,
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etatchauffeur`
--

INSERT INTO `etatchauffeur` (`id`, `name`, `class`, `protected`, `valide`) VALUES
(-1, 'Indisponible', 'danger', 1, 1),
(0, 'libre, dans le parc', 'success', 1, 1),
(1, 'En mission', 'warning', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `etatmanoeuvre`
--

CREATE TABLE `etatmanoeuvre` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `class` varchar(50) NOT NULL,
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etatmanoeuvre`
--

INSERT INTO `etatmanoeuvre` (`id`, `name`, `class`, `protected`, `valide`) VALUES
(-1, 'Indisponible', 'danger', 1, 1),
(0, 'libre, dans le parc', 'success', 1, 1),
(1, 'En mission', 'warning', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `etatvehicule`
--

CREATE TABLE `etatvehicule` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `class` varchar(50) NOT NULL,
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etatvehicule`
--

INSERT INTO `etatvehicule` (`id`, `name`, `class`, `protected`, `valide`) VALUES
(-1, 'Indisponible', 'danger', 1, 1),
(0, 'RAS', 'success', 1, 1),
(1, 'En entretien', 'warning', 1, 1),
(2, 'En mission', 'primary', 1, 1),
(3, 'Affecté temporairement', 'info', 1, 1);

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
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `contact` varchar(150) NOT NULL,
  `fax` varchar(200) NOT NULL,
  `email` text,
  `adresse` text NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `groupemanoeuvre`
--

CREATE TABLE `groupemanoeuvre` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groupemanoeuvre`
--

INSERT INTO `groupemanoeuvre` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Groupe 1', NULL, '2020-04-17 23:20:39', 1, 1),
(2, 'Magasin de pièces détachées', NULL, '2019-09-21 04:46:16', 1, 1),
(3, 'Lavage Automobile', '2019-09-21 04:48:43', '2019-09-23 12:55:59', 1, 1),
(4, 'Parc Automobile', '2019-09-21 05:40:11', '2019-09-21 05:40:11', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `groupevehicule`
--

CREATE TABLE `groupevehicule` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groupevehicule`
--

INSERT INTO `groupevehicule` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Véhicules de Pool', NULL, '2019-10-01 15:36:02', 1, 1),
(2, 'Cars de ramassage', NULL, '2019-09-23 14:05:30', 1, 1),
(3, 'Véhicules de missions', '2019-09-23 13:18:55', '2019-09-23 13:18:55', 1, 1),
(4, 'Véhicule du ministère', '2019-10-01 15:36:38', '2019-10-01 15:36:38', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `sentense` text NOT NULL,
  `type_save` varchar(50) NOT NULL,
  `record` varchar(200) NOT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `carplan_id` int(11) DEFAULT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1',
  `record_key` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `history`
--

INSERT INTO `history` (`id`, `sentense`, `type_save`, `record`, `employe_id`, `carplan_id`, `prestataire_id`, `created`, `modified`, `protected`, `valide`, `record_key`) VALUES
(1, 'Nouvelle connexion', 'insert', 'connexion', 1, NULL, NULL, '2020-04-18 21:22:01', '2020-04-18 21:22:01', 0, 1, 1);

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
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ligneconsommationjour`
--

INSERT INTO `ligneconsommationjour` (`id`, `productionjour_id`, `ressource_id`, `consommation`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 1, 0, '2020-04-18 21:22:02', '2020-04-18 21:22:02', 0, 1),
(2, 1, 2, 0, '2020-04-18 21:22:02', '2020-04-18 21:22:02', 0, 1),
(3, 1, 3, 0, '2020-04-18 21:22:02', '2020-04-18 21:22:02', 0, 1),
(4, 1, 4, 0, '2020-04-18 21:22:02', '2020-04-18 21:22:02', 0, 1);

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
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lignegroupecommande`
--

CREATE TABLE `lignegroupecommande` (
  `id` int(11) NOT NULL,
  `groupecommande_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lignepayejour`
--

CREATE TABLE `lignepayejour` (
  `id` int(11) NOT NULL,
  `productionjour_id` int(11) NOT NULL,
  `manoeuvre_id` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ligneproductionjour`
--

INSERT INTO `ligneproductionjour` (`id`, `productionjour_id`, `produit_id`, `production`, `perte`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 1, 0, 0, '2020-04-18 21:22:01', '2020-04-18 21:22:01', 0, 1),
(2, 1, 2, 0, 0, '2020-04-18 21:22:01', '2020-04-18 21:22:01', 0, 1),
(3, 1, 3, 0, 0, '2020-04-18 21:22:01', '2020-04-18 21:22:01', 0, 1),
(4, 1, 4, 0, 0, '2020-04-18 21:22:02', '2020-04-18 21:22:02', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `groupecommande_id` int(20) NOT NULL,
  `zonelivraison_id` int(11) NOT NULL,
  `lieu` varchar(200) NOT NULL,
  `vehicule_id` int(11) NOT NULL,
  `chauffeur_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `datelivraison` date DEFAULT NULL,
  `comment` text,
  `nom_receptionniste` varchar(50) DEFAULT NULL,
  `contact_receptionniste` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `machine`
--

CREATE TABLE `machine` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `marque` varchar(50) NOT NULL,
  `modele` varchar(200) NOT NULL,
  `image` text,
  `etatvehicule_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `manoeuvre`
--

CREATE TABLE `manoeuvre` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `groupemanoeuvre_id` int(2) NOT NULL,
  `adresse` varchar(150) DEFAULT NULL,
  `contact` varchar(200) DEFAULT NULL,
  `etatmanoeuvre_id` int(11) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `manoeuvre`
--

INSERT INTO `manoeuvre` (`id`, `name`, `groupemanoeuvre_id`, `adresse`, `contact`, `etatmanoeuvre_id`, `image`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Aboulaye touré', 1, '22 rue des chantilles, korogho 24 Bd', '47 58 93 21', 0, '', '2020-02-07 20:54:42', '2020-04-01 17:22:07', 0, 1),
(2, 'Aya', 2, '22 rue des chantilles, korogho 24 Bd', '47 58 93 21', 0, '0212e9a4.png', '2020-02-07 20:55:02', '2020-04-01 17:22:08', 0, 1),
(3, 'Kouamé Yves', 1, '22 rue des chantilles, korogho 24 Bd', '47 58 93 21', 0, 'fffe5c6a.png', '2020-02-07 20:55:58', '2020-04-01 17:22:08', 0, 1),
(4, '21shamman06', 2, 'Port-Bouet Rue de la baltique', '47 58 93 21', 0, '5bab6315.png', '2020-02-08 08:47:28', '2020-04-17 23:21:31', 0, 1);

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
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE `marque` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `name` varchar(50) NOT NULL,
  `initial` varchar(3) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `modepayement`
--

INSERT INTO `modepayement` (`id`, `name`, `initial`, `etat_id`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Espèces', 'ES', 1, NULL, NULL, 1, 1),
(2, 'Prelevement sur acompte', 'PR', 1, NULL, '2019-10-18 12:19:54', 1, 1),
(3, 'Chèque', 'CH', 0, NULL, NULL, 1, 1),
(4, 'Virement Banquaire', 'VB', 0, NULL, NULL, 1, 1),
(5, 'Mobile money', 'MM', 0, NULL, '2019-10-18 12:20:05', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `mycompte`
--

CREATE TABLE `mycompte` (
  `id` int(11) NOT NULL,
  `identifiant` varchar(9) NOT NULL,
  `tentative` int(11) NOT NULL,
  `expired` datetime NOT NULL,
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mycompte`
--

INSERT INTO `mycompte` (`id`, `identifiant`, `tentative`, `expired`, `protected`, `valide`) VALUES
(1, '598SZE-0T', 0, '2020-11-28 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

CREATE TABLE `operation` (
  `id` int(11) NOT NULL,
  `categorieoperation_id` int(11) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `montant` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `manoeuvre_id` int(11) DEFAULT NULL,
  `modepayement_id` int(11) NOT NULL,
  `comment` text,
  `etat_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `panne`
--

CREATE TABLE `panne` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `reference` varchar(10) DEFAULT NULL,
  `machine_id` int(11) NOT NULL,
  `manoeuvre_id` int(11) DEFAULT NULL,
  `comment` text NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `date_approuve` datetime DEFAULT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `params`
--

CREATE TABLE `params` (
  `id` int(11) NOT NULL,
  `societe` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `timeout` int(11) NOT NULL DEFAULT '5',
  `devise` varchar(50) NOT NULL,
  `tva` int(11) NOT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  `postale` varchar(200) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `params`
--

INSERT INTO `params` (`id`, `societe`, `email`, `contact`, `fax`, `timeout`, `devise`, `tva`, `adresse`, `postale`, `image`, `protected`, `valide`) VALUES
(1, 'bidy', 'info@bidy.com', '47 58 93 21', '45 45 45 89', 70, 'Fcfa', 18, 'Port-Bouet Rue de la baltique', '54 BP 64 ABIDJAN 45', '2568eb7f.png', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `paye_produit`
--

CREATE TABLE `paye_produit` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `paye_produit`
--

INSERT INTO `paye_produit` (`id`, `produit_id`, `price`, `created`, `modified`, `protected`, `valide`) VALUES
(2, 1, 45, '2020-04-12 23:48:56', '2020-04-17 20:52:09', 0, 1),
(3, 2, 200, '2020-04-12 23:48:56', '2020-04-13 08:53:56', 0, 1),
(4, 3, 90, '2020-04-12 23:48:56', '2020-04-17 20:52:38', 0, 1),
(5, 4, 300, '2020-04-12 23:48:56', '2020-04-13 08:53:56', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `prestataire`
--

CREATE TABLE `prestataire` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `typeprestataire_id` int(11) NOT NULL,
  `contact` varchar(150) NOT NULL,
  `fax` varchar(200) NOT NULL,
  `email` text,
  `adresse` text NOT NULL,
  `registre` varchar(50) DEFAULT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `is_new` int(11) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `is_allowed` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `prestataire`
--

INSERT INTO `prestataire` (`id`, `name`, `typeprestataire_id`, `contact`, `fax`, `email`, `adresse`, `registre`, `login`, `password`, `is_new`, `image`, `is_allowed`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Universal Garage', 1, '47 58 93 21', '15 45 45 478', 'Universalinfod@artci.com', 'angré 8em tranche tranche star 10', NULL, '230ec0df', '41cd8c3af6317039f0e2fbb3a89ce6cd45669cb0', 1, '', 1, '2020-02-08 15:22:24', '2020-02-08 15:22:24', 1, 1),
(3, 'Lavage Pro', 3, '47 58 93 21', '15 45 45 478', 'ffrsalinfod@artci.com', 'angré 9em tranche tranche star 10', '89484dfhdfhf', '25c662de', '1e2a1b15342e2d01328a8c39bec735eb7533c2a1', 1, '8a17cc7c.png', 1, '2020-02-08 15:23:08', '2020-02-08 19:14:41', 0, 1);

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
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `productionjour`
--

CREATE TABLE `productionjour` (
  `id` int(11) NOT NULL,
  `ladate` date NOT NULL,
  `comment` text NOT NULL,
  `groupemanoeuvre_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `productionjour`
--

INSERT INTO `productionjour` (`id`, `ladate`, `comment`, `groupemanoeuvre_id`, `employe_id`, `created`, `modified`, `protected`, `valide`) VALUES
(1, '2020-04-18', '', 0, 0, '2020-04-18 21:22:01', '2020-04-18 21:22:01', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `name`, `description`, `image`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'AC 15', 'Agglos creux 15', 'c23bed5a.png', '2020-02-08 20:27:34', '2020-04-12 22:54:50', 0, 1),
(2, 'AP 15', 'Agglos pleins 15', 'c4e02301.png', '2020-02-08 20:28:05', '2020-04-12 22:55:43', 0, 1),
(3, 'HOURDIS', 'Hourdis', '', '2020-02-08 20:28:35', '2020-04-12 22:56:28', 0, 1),
(4, 'BTC', 'Briques en terre compressée', '', '2020-02-08 20:52:24', '2020-04-12 22:55:54', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ressource`
--

CREATE TABLE `ressource` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `unite` varchar(20) DEFAULT NULL,
  `abbr` varchar(20) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ressource`
--

INSERT INTO `ressource` (`id`, `name`, `unite`, `abbr`, `image`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Gravier', 'en Tonne', 'T', NULL, '2020-02-08 20:27:34', '2020-02-08 21:54:04', 0, 1),
(2, 'CIMENT', 'En sac', 'Sacs', 'fcc179bc.jpg', '2020-02-08 20:28:05', '2020-04-12 23:10:04', 0, 1),
(3, 'Sables', 'En chargement', 'Chgs', NULL, '2020-02-08 20:28:35', '2020-02-08 21:51:21', 0, 1),
(4, 'Eau', 'en Litres', 'L', NULL, '2020-02-08 20:52:24', '2020-02-08 20:52:24', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `name`, `description`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Master', '', NULL, NULL, 1, 1),
(2, 'Production', '', NULL, NULL, 1, 1),
(4, 'Caisse', '', '2019-09-22 07:38:48', '2019-09-22 07:38:48', 1, 1),
(5, 'Administration', '', '2019-10-18 12:20:33', '2019-10-18 12:20:33', 1, 1),
(6, 'modifier-supprimer', '', NULL, NULL, 0, 1),
(7, 'paye des manoeuvres', '', NULL, NULL, 0, 1);

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
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sexe`
--

CREATE TABLE `sexe` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `abreviation` varchar(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sexe`
--

INSERT INTO `sexe` (`id`, `name`, `abreviation`, `icon`, `protected`, `valide`) VALUES
(1, 'Homme', 'Mr', 'fa fa-mars', 1, 1),
(2, 'Femme', 'Me', 'fa fa-venus', 1, 1),
(3, 'Entreprise', 'Inc', 'fa fa-bank', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `suggestion`
--

CREATE TABLE `suggestion` (
  `id` int(11) NOT NULL,
  `ticket` varchar(10) NOT NULL,
  `typesuggestion_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `etat_id` int(11) NOT NULL,
  `date_approuve` datetime DEFAULT NULL,
  `gestionnaire_id` int(11) DEFAULT NULL,
  `carplan_id` int(11) DEFAULT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `suggestion`
--

INSERT INTO `suggestion` (`id`, `ticket`, `typesuggestion_id`, `title`, `description`, `etat_id`, `date_approuve`, `gestionnaire_id`, `carplan_id`, `prestataire_id`, `utilisateur_id`, `created`, `modified`, `protected`, `valide`) VALUES
(3, 'BKDSJ487', 2, 'ceci est un titre', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda repudiandae, tempora labore minima, ipsa debitis reprehenderit ipsam sequi aut. Reiciendis, ipsa nam ab dolorem vitae suscipit nisi deserunt corporis aperiam.\r\n', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1),
(4, 'DS78FDYTY', 3, 'ceci est un titre 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda repudiandae, tempora labore minima, ipsa debitis reprehenderit ipsam sequi aut. Reiciendis, ipsa nam ab dolorem vitae suscipit nisi deserunt corporis aperiam.\r\n', 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeadministrateur`
--

CREATE TABLE `typeadministrateur` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typeadministrateur`
--

INSERT INTO `typeadministrateur` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Gestionnaire', NULL, NULL, 1, 1),
(2, 'Gestionnaire en Chef', NULL, NULL, 1, 1),
(3, 'Administrateur', NULL, NULL, 1, 1),
(4, 'Super Administrateur', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeclient`
--

CREATE TABLE `typeclient` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typeclient`
--

INSERT INTO `typeclient` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Voiture', NULL, NULL, 0, 1),
(2, 'Moto', NULL, NULL, 0, 0),
(3, 'Camion', '2019-09-22 07:38:31', '2019-09-22 07:38:31', 0, 0),
(4, 'Mini-car', '2019-09-22 07:38:48', '2019-09-22 07:38:48', 0, 1),
(5, 'pick-up', '2019-10-18 12:20:33', '2019-10-18 12:20:33', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeentretienvehicule`
--

CREATE TABLE `typeentretienvehicule` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typeentretienvehicule`
--

INSERT INTO `typeentretienvehicule` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'entretien dû au sinistre', NULL, '2019-10-02 10:12:14', 1, 1),
(2, 'Lavage Auto', NULL, NULL, 1, 1),
(3, 'Révision', NULL, NULL, 1, 1),
(4, 'Autre', NULL, NULL, 1, 1),
(5, 'Réparation Technique', '2019-09-22 07:57:03', '2019-09-22 07:57:03', 0, 1),
(6, 'Vidange + changement filtre', '2019-10-02 10:08:38', '2019-10-02 10:08:38', 0, 1),
(7, 'Simple vidange', '2019-10-02 10:09:00', '2019-10-02 10:09:00', 0, 0),
(8, 'simple vidange', NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeoperationcaisse`
--

CREATE TABLE `typeoperationcaisse` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typeoperationcaisse`
--

INSERT INTO `typeoperationcaisse` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Entrée en caisse', NULL, '2019-09-23 13:19:22', 1, 1),
(2, 'Sortie de Caisse', NULL, '2019-09-23 14:05:30', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeprestataire`
--

CREATE TABLE `typeprestataire` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typeprestataire`
--

INSERT INTO `typeprestataire` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Mission programmée', NULL, NULL, 1, 1),
(2, 'mission innopinée', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typesinistre`
--

CREATE TABLE `typesinistre` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typesinistre`
--

INSERT INTO `typesinistre` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'accrochage', NULL, NULL, 0, 1),
(2, 'Crevaison', NULL, NULL, 0, 1),
(3, 'Défaillanec moteur', '2019-09-22 07:50:45', '2019-09-22 07:50:45', 0, 0),
(4, 'Vol', '2019-10-02 10:03:19', '2019-10-02 10:03:19', 0, 1),
(5, 'Accident garve', '2019-10-02 10:03:53', '2019-10-02 10:03:53', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typesuggestion`
--

CREATE TABLE `typesuggestion` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typesuggestion`
--

INSERT INTO `typesuggestion` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'affectattion permanente', NULL, NULL, 0, 1),
(2, 'Affectation temporaire', NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typetransmission`
--

CREATE TABLE `typetransmission` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typetransmission`
--

INSERT INTO `typetransmission` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Manuelle', NULL, NULL, 0, 1),
(2, 'Automatique', NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typevehicule`
--

CREATE TABLE `typevehicule` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typevehicule`
--

INSERT INTO `typevehicule` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Voiture', NULL, NULL, 0, 1),
(2, 'Moto', NULL, NULL, 0, 0),
(3, 'Camion', '2019-09-22 07:38:31', '2019-09-22 07:38:31', 0, 0),
(4, 'Camion Benne', '2019-09-22 07:38:48', '2020-04-17 23:34:23', 0, 1),
(5, 'pick-up', '2019-10-18 12:20:33', '2019-10-18 12:20:33', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL,
  `immatriculation` varchar(20) NOT NULL,
  `typevehicule_id` int(11) NOT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `nb_place` int(11) DEFAULT NULL,
  `nb_porte` int(11) DEFAULT NULL,
  `marque_id` int(11) NOT NULL,
  `modele` varchar(200) NOT NULL,
  `energie_id` int(11) DEFAULT NULL,
  `typetransmission_id` int(11) DEFAULT NULL,
  `affectation` int(11) DEFAULT NULL,
  `puissance` int(10) DEFAULT NULL,
  `date_mise_circulation` varchar(20) DEFAULT NULL,
  `date_sortie` date DEFAULT NULL,
  `date_visitetechnique` date DEFAULT NULL,
  `date_assurance` date DEFAULT NULL,
  `date_vidange` datetime DEFAULT NULL,
  `image` text,
  `groupevehicule_id` int(11) DEFAULT NULL,
  `chasis` text,
  `date_acquisition` varchar(20) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `etatvehicule_id` int(11) NOT NULL,
  `possession` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1',
  `kilometrage` int(11) DEFAULT NULL,
  `location` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `zonelivraison`
--

CREATE TABLE `zonelivraison` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `zonelivraison`
--

INSERT INTO `zonelivraison` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(4, 'District d\'Abidjan', '2020-04-12 23:48:56', '2020-04-12 23:48:56', 0, 1),
(5, 'Périphérique d\'Abidjan', '2020-04-12 23:49:22', '2020-04-12 23:49:22', 0, 1),
(6, 'Yaou / Bonoua', '2020-04-12 23:49:42', '2020-04-12 23:49:42', 0, 1);

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
-- Index pour la table `code`
--
ALTER TABLE `code`
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
-- Index pour la table `lignegroupecommande`
--
ALTER TABLE `lignegroupecommande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignelivraison`
--
ALTER TABLE `lignelivraison`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignepayejour`
--
ALTER TABLE `lignepayejour`
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
-- Index pour la table `typeadministrateur`
--
ALTER TABLE `typeadministrateur`
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
-- Index pour la table `typesinistre`
--
ALTER TABLE `typesinistre`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `carplan`
--
ALTER TABLE `carplan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categorieoperation`
--
ALTER TABLE `categorieoperation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `chauffeur`
--
ALTER TABLE `chauffeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `code`
--
ALTER TABLE `code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `connexion`
--
ALTER TABLE `connexion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `demandeentretien`
--
ALTER TABLE `demandeentretien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `energie`
--
ALTER TABLE `energie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `etatchauffeur`
--
ALTER TABLE `etatchauffeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `etatmanoeuvre`
--
ALTER TABLE `etatmanoeuvre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `etatvehicule`
--
ALTER TABLE `etatvehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `exigenceproduction`
--
ALTER TABLE `exigenceproduction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `groupecommande`
--
ALTER TABLE `groupecommande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `groupemanoeuvre`
--
ALTER TABLE `groupemanoeuvre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `groupevehicule`
--
ALTER TABLE `groupevehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ligneapprovisionnement`
--
ALTER TABLE `ligneapprovisionnement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lignecommande`
--
ALTER TABLE `lignecommande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligneconsommationjour`
--
ALTER TABLE `ligneconsommationjour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `ligneexigenceproduction`
--
ALTER TABLE `ligneexigenceproduction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lignegroupecommande`
--
ALTER TABLE `lignegroupecommande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lignelivraison`
--
ALTER TABLE `lignelivraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lignepayejour`
--
ALTER TABLE `lignepayejour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligneproductionjour`
--
ALTER TABLE `ligneproductionjour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `machine`
--
ALTER TABLE `machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `manoeuvre`
--
ALTER TABLE `manoeuvre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `manoeuvredujour`
--
ALTER TABLE `manoeuvredujour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT pour la table `paye_produit`
--
ALTER TABLE `paye_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `prestataire`
--
ALTER TABLE `prestataire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `prix_zonelivraison`
--
ALTER TABLE `prix_zonelivraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `productionjour`
--
ALTER TABLE `productionjour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `role_employe`
--
ALTER TABLE `role_employe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sexe`
--
ALTER TABLE `sexe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `suggestion`
--
ALTER TABLE `suggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `typeadministrateur`
--
ALTER TABLE `typeadministrateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `typeclient`
--
ALTER TABLE `typeclient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `typeentretienvehicule`
--
ALTER TABLE `typeentretienvehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `typeoperationcaisse`
--
ALTER TABLE `typeoperationcaisse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `typeprestataire`
--
ALTER TABLE `typeprestataire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `typesinistre`
--
ALTER TABLE `typesinistre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `typesuggestion`
--
ALTER TABLE `typesuggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `typetransmission`
--
ALTER TABLE `typetransmission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `typevehicule`
--
ALTER TABLE `typevehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `zonelivraison`
--
ALTER TABLE `zonelivraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
