-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 31 Mars 2017 à 08:25
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `carmania`
--

-- --------------------------------------------------------

--
-- Structure de la table `achete`
--

CREATE TABLE `achete` (
  `date_achat` date DEFAULT NULL,
  `adresse_mail_utilisateur` varchar(30) NOT NULL,
  `idVehicule_achat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nom` char(25) DEFAULT NULL,
  `prenom` char(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `administre`
--

CREATE TABLE `administre` (
  `reclamation_pk` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `camion_achat`
--

CREATE TABLE `camion_achat` (
  `poids` int(11) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `hauteur` varchar(25) DEFAULT NULL,
  `idVehicule_achat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `camion_achat`
--

INSERT INTO `camion_achat` (`poids`, `volume`, `hauteur`, `idVehicule_achat`) VALUES
(1200, 7, '1.971m', 5);

-- --------------------------------------------------------

--
-- Structure de la table `camion_location`
--

CREATE TABLE `camion_location` (
  `poids` int(11) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `hauteur` varchar(25) DEFAULT NULL,
  `idVehicule_location` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `gere`
--

CREATE TABLE `gere` (
  `id` int(11) NOT NULL,
  `idVehicule_location` int(11) NOT NULL,
  `idVehicule_achat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `loue`
--

CREATE TABLE `loue` (
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `adresse_mail_utilisateur` varchar(30) NOT NULL,
  `idVehicule_location` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

CREATE TABLE `reclamation` (
  `reclamation_pk` int(11) NOT NULL,
  `date_ouverture` date DEFAULT NULL,
  `etat` varchar(25) DEFAULT NULL,
  `objet` varchar(25) DEFAULT NULL,
  `texte` varchar(280) DEFAULT NULL,
  `date_fermeture` date DEFAULT NULL,
  `adresse_mail_utilisateur` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `adresse_mail_utilisateur` varchar(30) NOT NULL,
  `mot_de_passe` varchar(12) NOT NULL,
  `nom_utilisateur` varchar(25) NOT NULL,
  `prenom_utilisateur` varchar(30) NOT NULL,
  `ville_utilisateur` varchar(25) DEFAULT NULL,
  `date_inscription_utilisateur` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vehicule_achat`
--

CREATE TABLE `vehicule_achat` (
  `idVehicule_achat` int(11) NOT NULL,
  `prix_achat` decimal(15,3) DEFAULT NULL,
  `carburant` varchar(25) DEFAULT NULL,
  `puissance` int(11) DEFAULT NULL,
  `marque` varchar(25) DEFAULT NULL,
  `modele` varchar(60) DEFAULT NULL,
  `transmission` varchar(25) DEFAULT NULL,
  `chemin_image` varchar(200) DEFAULT NULL,
  `climatisation` tinyint(1) DEFAULT NULL,
  `empreinte_carbone` int(11) DEFAULT NULL,
  `nb_disponible` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `vehicule_achat`
--

INSERT INTO `vehicule_achat` (`idVehicule_achat`, `prix_achat`, `carburant`, `puissance`, `marque`, `modele`, `transmission`, `chemin_image`, `climatisation`, `empreinte_carbone`, `nb_disponible`) VALUES
(1, '11500.000', 'S95', 70, 'Renault', 'Twingo Life', 'Manuelle', 'TwingoLife.jpg', 1, 112, 5),
(2, '23940.000', 'Diesel', 105, 'Volkswagen', 'Golf Match', 'Manuelle', 'GolfMatch.jpg', 1, 115, 5),
(3, '60970.000', 'Diesel', 150, 'Audi', 'A7 Sportback', 'Manuelle', 'A7Sportback.png', 1, 140, 3),
(4, '15320.000', 'S98', 110, 'Citroën', 'C3', 'Automatique', 'NouvelleC3.jpg', 1, 103, 4),
(5, '20600.000', 'Diesel', 95, 'Renault', 'Trafic', 'Manuelle', 'Trafic.png', 1, 160, 6);

-- --------------------------------------------------------

--
-- Structure de la table `vehicule_location`
--

CREATE TABLE `vehicule_location` (
  `idVehicule_location` int(11) NOT NULL,
  `prix_journee` decimal(15,3) DEFAULT NULL,
  `carburant` varchar(25) DEFAULT NULL,
  `puissance` int(11) DEFAULT NULL,
  `marque` varchar(25) DEFAULT NULL,
  `modele` varchar(60) DEFAULT NULL,
  `transmission` varchar(25) DEFAULT NULL,
  `chemin_image` varchar(200) DEFAULT NULL,
  `climatisation` tinyint(1) DEFAULT NULL,
  `empreinte_carbone` int(11) DEFAULT NULL,
  `nb_disponible` int(11) DEFAULT NULL,
  `nb_stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `voiture_achat`
--

CREATE TABLE `voiture_achat` (
  `portes` int(11) DEFAULT NULL,
  `couleur` char(25) DEFAULT NULL,
  `idVehicule_achat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `voiture_achat`
--

INSERT INTO `voiture_achat` (`portes`, `couleur`, `idVehicule_achat`) VALUES
(3, 'Blanche', 1),
(3, 'Blanche', 2),
(5, 'Gris foncé', 3),
(5, 'Blanche', 4);

-- --------------------------------------------------------

--
-- Structure de la table `voiture_location`
--

CREATE TABLE `voiture_location` (
  `portes` int(11) DEFAULT NULL,
  `couleur` char(25) DEFAULT NULL,
  `idVehicule_location` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `achete`
--
ALTER TABLE `achete`
  ADD PRIMARY KEY (`adresse_mail_utilisateur`,`idVehicule_achat`),
  ADD KEY `FK_achete_idVehicule_achat` (`idVehicule_achat`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `administre`
--
ALTER TABLE `administre`
  ADD PRIMARY KEY (`reclamation_pk`,`id`),
  ADD KEY `FK_administre_id` (`id`);

--
-- Index pour la table `camion_achat`
--
ALTER TABLE `camion_achat`
  ADD PRIMARY KEY (`idVehicule_achat`);

--
-- Index pour la table `camion_location`
--
ALTER TABLE `camion_location`
  ADD PRIMARY KEY (`idVehicule_location`);

--
-- Index pour la table `gere`
--
ALTER TABLE `gere`
  ADD PRIMARY KEY (`id`,`idVehicule_location`,`idVehicule_achat`),
  ADD KEY `FK_gere_idVehicule_location` (`idVehicule_location`),
  ADD KEY `FK_gere_idVehicule_achat` (`idVehicule_achat`);

--
-- Index pour la table `loue`
--
ALTER TABLE `loue`
  ADD PRIMARY KEY (`adresse_mail_utilisateur`,`idVehicule_location`),
  ADD KEY `FK_loue_idVehicule_location` (`idVehicule_location`);

--
-- Index pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`reclamation_pk`),
  ADD KEY `FK_Reclamation_adresse_mail_utilisateur` (`adresse_mail_utilisateur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`adresse_mail_utilisateur`);

--
-- Index pour la table `vehicule_achat`
--
ALTER TABLE `vehicule_achat`
  ADD PRIMARY KEY (`idVehicule_achat`);

--
-- Index pour la table `vehicule_location`
--
ALTER TABLE `vehicule_location`
  ADD PRIMARY KEY (`idVehicule_location`);

--
-- Index pour la table `voiture_achat`
--
ALTER TABLE `voiture_achat`
  ADD PRIMARY KEY (`idVehicule_achat`);

--
-- Index pour la table `voiture_location`
--
ALTER TABLE `voiture_location`
  ADD PRIMARY KEY (`idVehicule_location`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `reclamation_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `vehicule_achat`
--
ALTER TABLE `vehicule_achat`
  MODIFY `idVehicule_achat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `vehicule_location`
--
ALTER TABLE `vehicule_location`
  MODIFY `idVehicule_location` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `achete`
--
ALTER TABLE `achete`
  ADD CONSTRAINT `FK_achete_adresse_mail_utilisateur` FOREIGN KEY (`adresse_mail_utilisateur`) REFERENCES `utilisateur` (`adresse_mail_utilisateur`),
  ADD CONSTRAINT `FK_achete_idVehicule_achat` FOREIGN KEY (`idVehicule_achat`) REFERENCES `vehicule_achat` (`idVehicule_achat`);

--
-- Contraintes pour la table `administre`
--
ALTER TABLE `administre`
  ADD CONSTRAINT `FK_administre_id` FOREIGN KEY (`id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_administre_reclamation_pk` FOREIGN KEY (`reclamation_pk`) REFERENCES `reclamation` (`reclamation_pk`);

--
-- Contraintes pour la table `camion_achat`
--
ALTER TABLE `camion_achat`
  ADD CONSTRAINT `FK_Camion_achat_idVehicule_achat` FOREIGN KEY (`idVehicule_achat`) REFERENCES `vehicule_achat` (`idVehicule_achat`);

--
-- Contraintes pour la table `camion_location`
--
ALTER TABLE `camion_location`
  ADD CONSTRAINT `FK_Camion_location_idVehicule_location` FOREIGN KEY (`idVehicule_location`) REFERENCES `vehicule_location` (`idVehicule_location`);

--
-- Contraintes pour la table `gere`
--
ALTER TABLE `gere`
  ADD CONSTRAINT `FK_gere_id` FOREIGN KEY (`id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_gere_idVehicule_achat` FOREIGN KEY (`idVehicule_achat`) REFERENCES `vehicule_achat` (`idVehicule_achat`),
  ADD CONSTRAINT `FK_gere_idVehicule_location` FOREIGN KEY (`idVehicule_location`) REFERENCES `vehicule_location` (`idVehicule_location`);

--
-- Contraintes pour la table `loue`
--
ALTER TABLE `loue`
  ADD CONSTRAINT `FK_loue_adresse_mail_utilisateur` FOREIGN KEY (`adresse_mail_utilisateur`) REFERENCES `utilisateur` (`adresse_mail_utilisateur`),
  ADD CONSTRAINT `FK_loue_idVehicule_location` FOREIGN KEY (`idVehicule_location`) REFERENCES `vehicule_location` (`idVehicule_location`);

--
-- Contraintes pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `FK_Reclamation_adresse_mail_utilisateur` FOREIGN KEY (`adresse_mail_utilisateur`) REFERENCES `utilisateur` (`adresse_mail_utilisateur`);

--
-- Contraintes pour la table `voiture_achat`
--
ALTER TABLE `voiture_achat`
  ADD CONSTRAINT `FK_Voiture_achat_idVehicule_achat` FOREIGN KEY (`idVehicule_achat`) REFERENCES `vehicule_achat` (`idVehicule_achat`);

--
-- Contraintes pour la table `voiture_location`
--
ALTER TABLE `voiture_location`
  ADD CONSTRAINT `FK_Voiture_location_idVehicule_location` FOREIGN KEY (`idVehicule_location`) REFERENCES `vehicule_location` (`idVehicule_location`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
