

-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 15 Janvier 2019 à 15:18
-- Version du serveur: 5.5.61-0ubuntu0.14.04.1-log
-- Version de PHP: 5.5.9-1ubuntu4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `web287_main`
--

-- --------------------------------------------------------

--
-- Structure de la table `trajets`
--

CREATE TABLE IF NOT EXISTS `trajets` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_Pseudo` varchar(20) NOT NULL,
  `Lieu_Depart` varchar(20) NOT NULL,
  `Lieu_Arrivee` varchar(20) NOT NULL,
  `Heure_Depart` datetime NOT NULL,
  `Nombre_de_places` int(11) NOT NULL,
  `Prix` float NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `trajets`
--

INSERT INTO `trajets` (`ID`, `User_Pseudo`, `Lieu_Depart`, `Lieu_Arrivee`, `Heure_Depart`, `Nombre_de_places`, `Prix`) VALUES
(1, 'Test', 'Plouzané', 'Brest', '2019-01-15 00:00:00', 2, 4.3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
