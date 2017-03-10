-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 03 Mars 2017 à 15:31
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
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `nom` char(25) DEFAULT NULL,
  `prenom` char(25) DEFAULT NULL,
  `id` int(11) NOT NULL
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
-- Structure de la table `camion`
--

CREATE TABLE `camion` (
  `poids` int(11) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `hauteur` varchar(25) DEFAULT NULL,
  `immatriculation` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `gere`
--

CREATE TABLE `gere` (
  `id` int(11) NOT NULL,
  `immatriculation` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `loue`
--

CREATE TABLE `loue` (
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `pk_user` int(11) NOT NULL,
  `immatriculation` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

CREATE TABLE `reclamation` (
  `date_ouverture` date DEFAULT NULL,
  `reclamation_pk` int(11) NOT NULL,
  `etat` varchar(25) DEFAULT NULL,
  `objet` varchar(25) DEFAULT NULL,
  `texte` varchar(280) DEFAULT NULL,
  `date_fermeture` date DEFAULT NULL,
  `pk_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `name_user` varchar(25) DEFAULT NULL,
  `mail_adress_user` varchar(30) DEFAULT NULL,
  `firstname_user` varchar(30) DEFAULT NULL,
  `city_user` varchar(25) DEFAULT NULL,
  `inscription_date_user` date DEFAULT NULL,
  `pk_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`name_user`, `mail_adress_user`, `firstname_user`, `city_user`, `inscription_date_user`, `pk_user`) VALUES
('Kloproe', 'kloproe.c@gmail.com', 'Corentin', 'Cavaillon', '2017-03-03', 1),
('Trounier', 'philtrounier@yahoo.fr', 'Philippe', 'Avignon', '2017-03-03', 2);

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `immatriculation` varchar(25) NOT NULL,
  `carburant` varchar(25) DEFAULT NULL,
  `power` int(11) DEFAULT NULL,
  `marque` varchar(25) DEFAULT NULL,
  `modele` varchar(60) DEFAULT NULL,
  `transmission` varchar(25) DEFAULT NULL,
  `image_path` varchar(200) DEFAULT NULL,
  `climatisation` tinyint(1) DEFAULT NULL,
  `empreinte_carbone` int(11) DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT NULL,
  `pk_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `vehicule`
--

INSERT INTO `vehicule` (`immatriculation`, `carburant`, `power`, `marque`, `modele`, `transmission`, `image_path`, `climatisation`, `empreinte_carbone`, `disponible`, `pk_user`) VALUES
('IK-648-FU', 'Diesel', 105, 'Peugeot', '208 Diesel', 'Manuelle', NULL, 1, 88, 1, NULL),
('LJ-452-RT', 'SP95', 87, 'Skoda', 'Yeti', 'Manuelle', NULL, 1, 128, 1, NULL),
('UZ-894-KI', 'SP98', 80, 'Volkswagen', 'Polo', 'Manuelle', NULL, 1, 139, 1, NULL),
('YY-777-XW', 'SP95', 90, 'Toyota', 'Prius', 'Automatique', NULL, 1, 115, 1, NULL),
('ZX-455-TG', 'SP95', 87, 'Citroën', 'C1', 'Automatique', NULL, 1, 99, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `voiture`
--

CREATE TABLE `voiture` (
  `portes` int(11) DEFAULT NULL,
  `couleur` char(25) DEFAULT NULL,
  `immatriculation` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `voiture`
--

INSERT INTO `voiture` (`portes`, `couleur`, `immatriculation`) VALUES
(5, 'Bleu', 'IK-648-FU'),
(5, 'Vert', 'LJ-452-RT'),
(5, 'Rouge', 'UZ-894-KI'),
(5, 'Gris', 'YY-777-XW'),
(5, 'Jaune', 'ZX-455-TG');

--
-- Index pour les tables exportées
--

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
-- Index pour la table `camion`
--
ALTER TABLE `camion`
  ADD PRIMARY KEY (`immatriculation`);

--
-- Index pour la table `gere`
--
ALTER TABLE `gere`
  ADD PRIMARY KEY (`id`,`immatriculation`),
  ADD KEY `FK_gere_immatriculation` (`immatriculation`);

--
-- Index pour la table `loue`
--
ALTER TABLE `loue`
  ADD PRIMARY KEY (`pk_user`,`immatriculation`),
  ADD KEY `FK_loue_immatriculation` (`immatriculation`);

--
-- Index pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`reclamation_pk`),
  ADD KEY `FK_Reclamation_pk_user` (`pk_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`pk_user`),
  ADD UNIQUE KEY `mail_adress_user` (`mail_adress_user`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`immatriculation`),
  ADD KEY `FK_Vehicule_pk_user` (`pk_user`);

--
-- Index pour la table `voiture`
--
ALTER TABLE `voiture`
  ADD PRIMARY KEY (`immatriculation`);

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
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `pk_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `administre`
--
ALTER TABLE `administre`
  ADD CONSTRAINT `FK_administre_id` FOREIGN KEY (`id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_administre_reclamation_pk` FOREIGN KEY (`reclamation_pk`) REFERENCES `reclamation` (`reclamation_pk`);

--
-- Contraintes pour la table `camion`
--
ALTER TABLE `camion`
  ADD CONSTRAINT `FK_Camion_immatriculation` FOREIGN KEY (`immatriculation`) REFERENCES `vehicule` (`immatriculation`);

--
-- Contraintes pour la table `gere`
--
ALTER TABLE `gere`
  ADD CONSTRAINT `FK_gere_id` FOREIGN KEY (`id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_gere_immatriculation` FOREIGN KEY (`immatriculation`) REFERENCES `vehicule` (`immatriculation`);

--
-- Contraintes pour la table `loue`
--
ALTER TABLE `loue`
  ADD CONSTRAINT `FK_loue_immatriculation` FOREIGN KEY (`immatriculation`) REFERENCES `vehicule` (`immatriculation`),
  ADD CONSTRAINT `FK_loue_pk_user` FOREIGN KEY (`pk_user`) REFERENCES `user` (`pk_user`);

--
-- Contraintes pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `FK_Reclamation_pk_user` FOREIGN KEY (`pk_user`) REFERENCES `user` (`pk_user`);

--
-- Contraintes pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `FK_Vehicule_pk_user` FOREIGN KEY (`pk_user`) REFERENCES `user` (`pk_user`);

--
-- Contraintes pour la table `voiture`
--
ALTER TABLE `voiture`
  ADD CONSTRAINT `FK_Voiture_immatriculation` FOREIGN KEY (`immatriculation`) REFERENCES `vehicule` (`immatriculation`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;