-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 13 Avril 2017 à 22:38
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

--
-- Contenu de la table `achete`
--

INSERT INTO `achete` (`date_achat`, `adresse_mail_utilisateur`, `idVehicule_achat`) VALUES
('2017-04-10', 'babtou@ken.fr', 1),
('2017-04-14', 'babtou@ken.fr', 2),
('2017-04-11', 'babtou@ken.fr', 3),
('2017-04-14', 'babtou@ken.fr', 5);

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
(1200, 7, '1.971m', 2);

-- --------------------------------------------------------

--
-- Structure de la table `gere`
--

CREATE TABLE gere(
        adresse_mail_utilisateur Varchar (30) NOT NULL ,
        reclamation_pk           Int NOT NULL ,
        PRIMARY KEY (adresse_mail_utilisateur ,reclamation_pk )
)ENGINE=InnoDB;
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

--
-- Contenu de la table `loue`
--

INSERT INTO `loue` (`date_debut`, `date_fin`, `adresse_mail_utilisateur`, `idVehicule_location`) VALUES
('2017-04-14', '2017-04-17', 'babtou@ken.fr', 1);

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
(4, '2017-04-13', 'Non rÃ©solu', 'ntt', 'ukl', '2017-04-13', 'babtou@ken.fr'),
(5, '2017-04-13', 'Non rÃ©solu', 'sef', 'Entrez votre message ici...', '2017-04-13', 'babtou@ken.fr'),
(6, '2017-04-13', 'Non rÃ©solu', 'fes', 'fsef', NULL, 'babtou@ken.fr');

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
  `date_inscription_utilisateur` date DEFAULT NULL,
  `droit` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`adresse_mail_utilisateur`, `mot_de_passe`, `nom_utilisateur`, `prenom_utilisateur`, `ville_utilisateur`, `date_inscription_utilisateur`, `droit`) VALUES
('axelf@gmail.com', 'good', 'Fauconnier', 'Axel', 'Marseille', '2017-03-31', 1),
('babtou@ken.fr', 'idk', 'bab', 'tout', 'ville', '2017-03-31', NULL),
('boii@gmail.com', 'missile', 'Cast', 'Fidel', 'Cuba', '2017-03-31', NULL),
('carmania@pro.fr', 'idk', 'Car', 'Mania', 'cary', '2017-03-31', NULL),
('commu@yahoo.fr', 'kompot', 'Stal', 'Joseph', 'Moscou', '2017-03-31', NULL),
('coucou@yahoo.fr', 'idk', 'couille', 'bite', 'kool', '2017-03-31', NULL),
('jean@gmail.com', 'idk', 'Moulin', 'Jean', 'France', '2017-03-31', NULL),
('leonel@yahoo.fr', 'hola', 'Trot', 'Leon', 'SaoPaulo', '2017-03-31', NULL),
('mmp@live.fr', 'idk', 'Petaing', 'MarionMarechal', 'Vichy', '2017-03-31', NULL);

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
(1, '11500.000', 'S95', 70, 'Renault', 'Twingo Life', 'Manuelle', 'TwingoLife.png', 1, 112, 2, NULL),
(2, '23940.000', 'Diesel', 105, 'Volkswagen', 'Golf Match', 'Manuelle', 'GolfMatch.png', 1, 115, 3, NULL),
(3, '60970.000', 'Diesel', 150, 'Audi', 'A7 Sportback', 'Manuelle', 'A7Sportback.png', 1, 140, 2, NULL),
(4, '15320.000', 'S98', 110, 'Citroen', 'C3', 'Automatique', 'NouvelleC3.png', 1, 103, 4, NULL),
(5, '20600.000', 'Diesel', 95, 'Renault', 'Trafic', 'Manuelle', 'Trafic.png', 1, 160, 5, NULL),
(6, '15000.000', 'Diesel', 70, 'volkswagen', 'polo', 'Manuelle', 'sg', 1, 70, 1, 'babtou@ken.fr');

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
(1, '10.000', 'S95', 70, 'Renault', 'Twingo Life', 'Manuelle', 'TwingoLife.png', 1, 112, 4, 6, NULL),
(2, '17.000', 'Diesel', 95, 'Renault', 'Trafic', 'Manuelle', 'Trafic.png', 1, 160, 3, 3, NULL);

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
(5, 'Blanche', 4),
(5, 'bleu', 6);

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
(3, 'Blanche', 1);

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
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `reclamation_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `vehicule_achat`
--
ALTER TABLE `vehicule_achat`
  MODIFY `idVehicule_achat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `vehicule_location`
--
ALTER TABLE `vehicule_location`
  MODIFY `idVehicule_location` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
