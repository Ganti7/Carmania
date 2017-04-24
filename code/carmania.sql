-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 24 Avril 2017 à 15:23
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

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

--
-- Contenu de la table `camion_location`
--

INSERT INTO `camion_location` (`poids`, `volume`, `hauteur`, `idVehicule_location`) VALUES
(1200, 7, '1.971', 2);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `idCommande` int(11) NOT NULL,
  `prix_journee` decimal(15,3) DEFAULT NULL,
  `carburant` varchar(25) DEFAULT NULL,
  `puissance` int(11) DEFAULT NULL,
  `marque` varchar(25) DEFAULT NULL,
  `modele` varchar(25) DEFAULT NULL,
  `transmission` varchar(25) DEFAULT NULL,
  `chemin_image` varchar(25) DEFAULT NULL,
  `climatisation` tinyint(1) DEFAULT NULL,
  `empreinte_carbone` int(11) DEFAULT NULL,
  `prix_achat` decimal(15,3) DEFAULT NULL,
  `date_achat` date DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `adresse_mail_vendeur` varchar(25) DEFAULT NULL,
  `adresse_mail_utilisateur` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`idCommande`, `prix_journee`, `carburant`, `puissance`, `marque`, `modele`, `transmission`, `chemin_image`, `climatisation`, `empreinte_carbone`, `prix_achat`, `date_achat`, `date_debut`, `date_fin`, `adresse_mail_vendeur`, `adresse_mail_utilisateur`) VALUES
(2, NULL, 'Diesel', 150, 'Audi', 'A7 Sportback', 'Manuelle', 'A7Sportback.png', 1, 140, '60970.000', '2017-04-24', NULL, NULL, NULL, 'babtou@ken.fr'),
(3, NULL, 'S95', 70, 'Renault', 'Twingo Life', 'Manuelle', 'TwingoLife.png', 1, 112, '11500.000', '2017-04-24', NULL, NULL, NULL, 'babtou@ken.fr'),
(4, '10.000', 'S95', 70, 'Renault', 'Twingo Life', 'Manuelle', 'TwingoLife.png', 1, 112, NULL, NULL, '2017-04-25', '2017-04-30', NULL, 'babtou@ken.fr');

-- --------------------------------------------------------

--
-- Structure de la table `gere`
--

CREATE TABLE `gere` (
  `adresse_mail_utilisateur` varchar(30) NOT NULL,
  `reclamation_pk` int(11) NOT NULL
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

--
-- Contenu de la table `reclamation`
--

INSERT INTO `reclamation` (`reclamation_pk`, `date_ouverture`, `etat`, `objet`, `texte`, `date_fermeture`, `adresse_mail_utilisateur`) VALUES
(7, '2017-04-24', 'rÃ©solu', 'RÃ©clamation', 'J\'ai une rÃ©clamation ui', '2017-04-24', 'babtou@ken.fr'),
(8, '2017-04-24', 'Non rÃ©solu', 'RÃ©clamation encore', 'Ui encore une Ui', NULL, 'babtou@ken.fr');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `adresse_mail_utilisateur` varchar(30) NOT NULL,
  `mot_de_passe` varchar(200) NOT NULL,
  `nom_utilisateur` varchar(25) NOT NULL,
  `prenom_utilisateur` varchar(30) NOT NULL,
  `ville_utilisateur` varchar(25) DEFAULT NULL,
  `date_inscription_utilisateur` date DEFAULT NULL,
  `droit` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`adresse_mail_utilisateur`, `mot_de_passe`, `nom_utilisateur`, `prenom_utilisateur`, `ville_utilisateur`, `date_inscription_utilisateur`, `droit`) VALUES
('axelf@gmail.com', '$2y$10$3HFkf.03CGUvtBs2tjaOeOq4P6NIZgt64URID.ChEFNxMKj5FWOLq', 'Fauconnier', 'Axel', 'Marseille', '2017-04-24', 1),
('babtou@ken.fr', '$2y$10$VSu0E0VOlJT6WsYV9y/HBu8VPFKD9OPRc4fJdT.HzpC1mESn0fiRG', 'bab', 'tout', 'ville', '2017-04-24', 0),
('boii@gmail.com', '$2y$10$I3QCobAQTVpF6WCcYU90pesye7fpIURNG1fGzezh4ccEXrQs91Xmu', 'Cast', 'Fidel', 'Cuba', '2017-04-24', 0),
('carmania@pro.fr', '$2y$10$qSG7P/AeVoF0S8764REACetBuhtXIvSBvThFVjsE1tpFvu3UuxVpW', 'Car', 'Mania', 'cary', '2017-04-24', 0),
('commu@yahoo.fr', '$2y$10$nVagSvBErhP591s3Ph4.6.FjgnMk3lhPSpaEGyq2tQifpeyW6BGou', 'Stal', 'Joseph', 'Moscou', '2017-04-24', 0),
('jean@gmail.com', '$2y$10$PkbtJs/fnvtsntHxif0tf.Ki2u6evPLVa82n4WbpD6WBg/itn8Hzq', 'Moulin', 'Jean', 'France', '2017-04-24', 0),
('leonel@yahoo.fr', '$2y$10$5r5sYtp4t.glRBNSwIf1qu2aHpGTdSHBrF8TeSTBDzkOra6QWo4k.', 'Trot', 'Leon', 'SaoPaulo', '2017-04-24', 0),
('lol@hotmail.fr', '$2y$10$ueCLHhYL1v.dFhnmDyuaoOYi7HddomIENneJPT.HOzgo9qo2BNuyO', 'Bessai', 'Sofiane', 'Marseille', '2017-04-24', 1),
('lol@lol.fr', '$2y$10$f2iW/JUqFA/XQvJZo9kzOOgKy/VRpHv9jJ9UZlr1JFKfXBBX4G1bO', 'Bessai', 'Sofiane', 'Marseille', '2017-04-24', 0),
('mmp@live.fr', '$2y$10$jThLmDMuOTCJnOOcxurEleXiVsgpFBwUPdGkmXqiAzvbtPQuKzABW', 'Petaing', 'MarionMarechal', 'Vichy', '2017-04-24', 0);

-- --------------------------------------------------------

--
-- Structure de la table `vehicule_achat`
--

CREATE TABLE `vehicule_achat` (
  `idVehicule_achat` int(11) NOT NULL,
  `prix_achat` decimal(15,3) DEFAULT NULL,
  `carburant` varchar(25) DEFAULT NULL,
  `puissance` int(11) DEFAULT NULL,
  `marque` varchar(25) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `modele` varchar(60) DEFAULT NULL,
  `transmission` varchar(25) DEFAULT NULL,
  `chemin_image` varchar(200) DEFAULT NULL,
  `climatisation` tinyint(1) DEFAULT NULL,
  `empreinte_carbone` int(11) DEFAULT NULL,
  `nb_disponible` int(11) DEFAULT NULL,
  `adresse_mail_utilisateur` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `vehicule_achat`
--

INSERT INTO `vehicule_achat` (`idVehicule_achat`, `prix_achat`, `carburant`, `puissance`, `marque`, `modele`, `transmission`, `chemin_image`, `climatisation`, `empreinte_carbone`, `nb_disponible`, `adresse_mail_utilisateur`) VALUES
(1, '60970.000', 'Diesel', 150, 'Audi', 'A7 Sportback', 'Manuelle', 'A7Sportback.png', 1, 140, 1, NULL),
(2, '11500.000', 'S95', 70, 'Renault', 'Twingo Life', 'Manuelle', 'TwingoLife.png', 1, 112, 1, NULL),
(3, '23940.000', 'Diesel', 105, 'Volkswagen', 'Golf Match', 'Manuelle', 'GolfMatch.png', 1, 115, 3, NULL),
(4, '15320.000', 'S98', 110, 'Citroen', 'C3', 'Automatique', 'NouvelleC3.png', 1, 103, 4, NULL),
(5, '20600.000', 'Diesel', 95, 'Renault', 'Trafic', 'Manuelle', 'Trafic.png', 1, 160, 5, NULL),
(15, '14000.000', 'Diesel', 70, 'peugeot', '207', 'Manuelle', 'https://www.greasenergy-shop.com/WebRoot/Store2/Shops/63102114/5177/A070/BE69/4900/537E/C0A8/28B8/EFEE/Peugeot-307-bea.png', 1, 70, 1, 'babtou@ken.fr');

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
  `nb_stock` int(11) DEFAULT NULL,
  `adresse_mail_utilisateur` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `vehicule_location`
--

INSERT INTO `vehicule_location` (`idVehicule_location`, `prix_journee`, `carburant`, `puissance`, `marque`, `modele`, `transmission`, `chemin_image`, `climatisation`, `empreinte_carbone`, `nb_disponible`, `nb_stock`, `adresse_mail_utilisateur`) VALUES
(1, '10.000', 'S95', 70, 'Renault', 'Twingo Life', 'Manuelle', 'TwingoLife.png', 1, 112, 1, 2, NULL),
(2, '17.000', 'Diesel', 95, 'Renault', 'Trafic', 'Manuelle', 'Trafic.png', 1, 160, 2, 2, NULL);

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
(5, 'Gris foncé', 1),
(3, 'Rouge', 2),
(3, 'Blanche', 3),
(5, 'Blanche', 4),
(5, 'noir', 15);

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
-- Contenu de la table `voiture_location`
--

INSERT INTO `voiture_location` (`portes`, `couleur`, `idVehicule_location`) VALUES
(3, 'rouge', 1);

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
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idCommande`),
  ADD KEY `FK_Commande_adresse_mail_utilisateur` (`adresse_mail_utilisateur`);

--
-- Index pour la table `gere`
--
ALTER TABLE `gere`
  ADD PRIMARY KEY (`adresse_mail_utilisateur`,`reclamation_pk`),
  ADD KEY `FK_gere_adresse_mail_utilisateur` (`adresse_mail_utilisateur`),
  ADD KEY `FK_gere_reclamation_pk` (`reclamation_pk`);

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
  ADD PRIMARY KEY (`idVehicule_achat`),
  ADD KEY `FK_Vehicule_achat_adresse_mail_utilisateur` (`adresse_mail_utilisateur`);

--
-- Index pour la table `vehicule_location`
--
ALTER TABLE `vehicule_location`
  ADD PRIMARY KEY (`idVehicule_location`),
  ADD KEY `FK_Vehicule_location_adresse_mail_utilisateur` (`adresse_mail_utilisateur`);

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
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `reclamation_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `vehicule_achat`
--
ALTER TABLE `vehicule_achat`
  MODIFY `idVehicule_achat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `vehicule_location`
--
ALTER TABLE `vehicule_location`
  MODIFY `idVehicule_location` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_Commande_adresse_mail_utilisateur` FOREIGN KEY (`adresse_mail_utilisateur`) REFERENCES `utilisateur` (`adresse_mail_utilisateur`);

--
-- Contraintes pour la table `gere`
--
ALTER TABLE `gere`
  ADD CONSTRAINT `FK_gere_adresse_mail_utilisateur` FOREIGN KEY (`adresse_mail_utilisateur`) REFERENCES `utilisateur` (`adresse_mail_utilisateur`),
  ADD CONSTRAINT `FK_gere_reclamation_pk` FOREIGN KEY (`reclamation_pk`) REFERENCES `reclamation` (`reclamation_pk`);

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
-- Contraintes pour la table `vehicule_achat`
--
ALTER TABLE `vehicule_achat`
  ADD CONSTRAINT `FK_Vehicule_achat_adresse_mail_utilisateur` FOREIGN KEY (`adresse_mail_utilisateur`) REFERENCES `utilisateur` (`adresse_mail_utilisateur`);

--
-- Contraintes pour la table `vehicule_location`
--
ALTER TABLE `vehicule_location`
  ADD CONSTRAINT `FK_Vehicule_location_adresse_mail_utilisateur` FOREIGN KEY (`adresse_mail_utilisateur`) REFERENCES `utilisateur` (`adresse_mail_utilisateur`);

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
