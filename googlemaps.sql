-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Gazda: localhost
-- Timp de generare: 30 Dec 2011 la 14:05
-- Versiune server: 5.5.19
-- Versiune PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza de date: `googlemaps`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `imagini`
--

CREATE DATABASE  GoogleMaps;
USE GoogleMaps;

DROP TABLE IF EXISTS `imagini`;
CREATE TABLE IF NOT EXISTS `imagini` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `URLImg` varchar(1024) NOT NULL,
  `Lat` varchar(20) NOT NULL,
  `Lng` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Salvarea datelor din tabel `imagini`
--

INSERT INTO `imagini` (`Id`, `UserId`, `URLImg`, `Lat`, `Lng`) VALUES
(1, 1, 'http://stud.euro.ubbcluj.ro/~mm3200/Timisoara%2008.jpg', '45.67187408510425', '21.2646484375'),
(5, 2, 'http://www.venicecarservice.com/www.venicecarservice.com/home/wp/wp-content/uploads/2011/01/bibione.jpg', '44.490862721935564', '28.827362060546875');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `utilizatori`
--

DROP TABLE IF EXISTS `utilizatori`;
CREATE TABLE IF NOT EXISTS `utilizatori` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `User` varchar(255) NOT NULL,
  `Parola` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Salvarea datelor din tabel `utilizatori`
--

INSERT INTO `utilizatori` (`Id`, `User`, `Parola`, `Email`) VALUES
(1, 'allle90', 'capricorn', 'alexandra_bugariu@yahoo.com'),
(2, 'tudor', 'tudorbejan', 'tudor_bejan@yahoo.com');
