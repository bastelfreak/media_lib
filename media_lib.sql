-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Host: 192.168.0.12:3306
-- Erstellungszeit: 03. Mai 2014 um 23:18
-- Server Version: 5.5.35
-- PHP-Version: 5.4.4-14+deb7u9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Datenbank: `bastelfreak_dev_01`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur füelle `media_movies`
--
-- Erzeugt am: 03. Mai 2014 um 21:16
--

DROP TABLE IF EXISTS `media_movies`;
CREATE TABLE IF NOT EXISTS `media_movies` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tmdb_id` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `release` date DEFAULT NULL,
  `average_vote` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `original_title` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `poster_path` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
	`rating` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
	`length` int(11) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur füelle `media_series`
--
-- Erzeugt am: 03. Mai 2014 um 21:17
--

DROP TABLE IF EXISTS `media_series`;
CREATE TABLE IF NOT EXISTS `media_series` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rating` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `length` int(11) NOT NULL,
  `genre` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
COMMIT;

