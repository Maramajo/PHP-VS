-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 16-Set-2019 às 11:20
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projetogeral`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT ' ',
  `email` varchar(50) DEFAULT '746569786569726140686f746d61696c2e636f6d',
  `last_login` datetime DEFAULT NULL,
  `profile` varchar(500) DEFAULT NULL,
  `purl` varchar(20) DEFAULT NULL,
  `purl_time` datetime DEFAULT NULL,
  `active` bit(1) DEFAULT b'1',
  `deleted` int(10) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_user`, `username`, `senha`, `name`, `email`, `last_login`, `profile`, `purl`, `purl_time`, `active`, `deleted`) VALUES
(1, 'ze', 'sad', 'josé', 'teixeira@hotmail.com', '2019-09-14 00:00:00', 'aa', 'aa', '2019-09-14 00:00:00', b'1', 0),
(2, 'a', '72d248c85c645d5fb58771d85eaa0a0e', 'ze', 'teixeira.j.mc@hotmail.com', '2019-09-16 00:46:35', NULL, '', NULL, b'1', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
