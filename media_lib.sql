-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 03. Mai 2014 um 22:06
-- Server Version: 5.5.35
-- PHP-Version: 5.4.4-14+deb7u8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `media_lib`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `rating` text NOT NULL,
  `length` int(11) NOT NULL,
  `genre` text NOT NULL,
  `status` text NOT NULL,
  UNIQUE KEY `index` (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `media_movies`
--

CREATE TABLE IF NOT EXISTS `media_movies` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `tmdb_id` text,
  `release` date DEFAULT NULL,
  `average_vote` text,
  `original_title` text,
  `poster_path` text,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=710 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `media_series`
--

CREATE TABLE IF NOT EXISTS `media_series` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `rating` text NOT NULL,
  `length` int(11) NOT NULL,
  `genre` text NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
