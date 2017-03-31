-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 31 Mars 2017 à 08:29
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

--
-- Contenu de la table `camion_achat`
--

INSERT INTO `camion_achat` (`poids`, `volume`, `hauteur`, `idVehicule_achat`) VALUES
(1200, 7, '1.971m', 5);

--
-- Contenu de la table `vehicule_achat`
--

INSERT INTO `vehicule_achat` (`idVehicule_achat`, `prix_achat`, `carburant`, `puissance`, `marque`, `modele`, `transmission`, `chemin_image`, `climatisation`, `empreinte_carbone`, `nb_disponible`) VALUES
(1, '11500.000', 'S95', 70, 'Renault', 'Twingo Life', 'Manuelle', 'TwingoLife.jpg', 1, 112, 5),
(2, '23940.000', 'Diesel', 105, 'Volkswagen', 'Golf Match', 'Manuelle', 'GolfMatch.jpg', 1, 115, 5),
(3, '60970.000', 'Diesel', 150, 'Audi', 'A7 Sportback', 'Manuelle', 'A7Sportback.png', 1, 140, 3),
(4, '15320.000', 'S98', 110, 'Citroën', 'C3', 'Automatique', 'NouvelleC3.jpg', 1, 103, 4),
(5, '20600.000', 'Diesel', 95, 'Renault', 'Trafic', 'Manuelle', 'Trafic.png', 1, 160, 6);

--
-- Contenu de la table `voiture_achat`
--

INSERT INTO `voiture_achat` (`portes`, `couleur`, `idVehicule_achat`) VALUES
(3, 'Blanche', 1),
(3, 'Blanche', 2),
(5, 'Gris foncé', 3),
(5, 'Blanche', 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
