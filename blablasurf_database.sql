-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 26 mars 2019 à 13:39
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blablasurf`
--

-- --------------------------------------------------------

--
-- Structure de la table `demandes`
--

DROP TABLE IF EXISTS `demandes`;
CREATE TABLE IF NOT EXISTS `demandes` (
  `ID` int(11) NOT NULL,
  `User_Pseudo` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Nombre_de_Places` int(11) NOT NULL,
  `Nombre_de_Planches` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `demandes`
--

INSERT INTO `demandes` (`ID`, `User_Pseudo`, `Nombre_de_Places`, `Nombre_de_Planches`) VALUES
(1, 'alibra', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `mail` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`ID`, `pseudo`, `pass`, `date_enregistrement`, `phone`, `mail`) VALUES
(2, 'alibra', '123456azerty', '2019-01-15 19:34:11', '0770446486', 'ali.brahimi@imt-atlantique.net'),
(6, 'test', 'test', '2019-01-16 17:36:17', '0124536398', 'test@test.com'),
(7, 'Test2', '123456azerty', '2019-01-18 15:42:19', '00000000', 'test@test.com'),
(8, 'groupe18', '123456', '2019-01-18 16:27:58', '01236547896', 'groupe18@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `trajets`
--

DROP TABLE IF EXISTS `trajets`;
CREATE TABLE IF NOT EXISTS `trajets` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_Pseudo` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Lieu_Depart` varchar(35) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Lieu_Arrivee` varchar(35) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Heure_Depart` datetime NOT NULL,
  `Nombre_de_places` int(11) NOT NULL,
  `Nombre_de_planches` int(11) NOT NULL,
  `Prix` float NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `trajets`
--

INSERT INTO `trajets` (`ID`, `User_Pseudo`, `Lieu_Depart`, `Lieu_Arrivee`, `Heure_Depart`, `Nombre_de_places`, `Nombre_de_planches`, `Prix`) VALUES
(1, 'Test', 'Paris', 'Brest', '2019-01-16 09:45:03', 2, 2, 30),
(2, 'Test', 'PlouzanÃ©', 'Brest', '2019-01-17 09:45:48', 3, 2, 5),
(10, 'alibra', 'PlouzanÃ©', 'Brest', '2019-01-18 10:44:51', 1, 1, 10),
(8, 'test', 'PlouzanÃ©', 'PlouzanÃ©', '2019-01-16 16:36:28', 1, 1, 5),
(12, 'test', 'Guipavas', 'Les blancs sablons', '2019-01-19 10:40:00', 0, 0, 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
