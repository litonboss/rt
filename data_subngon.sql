-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 14 Juillet 2017 à 22:42
-- Version du serveur :  5.6.32-78.1
-- Version de PHP :  5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `maxwell_botlike`
--

-- --------------------------------------------------------

--
-- Structure de la table `acc`
--

CREATE TABLE IF NOT EXISTS `acc` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1750 DEFAULT CHARSET=utf8;


--
-- Structure de la table `log_bot`
--

CREATE TABLE IF NOT EXISTS `log_bot` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_nguoita` varchar(100) NOT NULL,
  `name_nguoita` varchar(100) NOT NULL,
  `thoigian` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=821 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `bot` (
  `id` int(11) NOT NULL,
  `user_id` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `gioitinh` varchar(10) NOT NULL,
  `camxuc` varchar(32) NOT NULL,
  `choc` varchar(32) NOT NULL,
  `theogioi` varchar(32) NOT NULL,
  `share` varchar(32) NOT NULL,
  `cmt` varchar(32) NOT NULL,
  `noidung` varchar(9999) NOT NULL,
  `inbox` varchar(32) NOT NULL,
  `noidungib` varchar(999) NOT NULL,
  `access_token` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1461 DEFAULT CHARSET=utf8;
--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `user_id` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1269 DEFAULT CHARSET=utf8;

--
-- Index pour la table `acc`
--
ALTER TABLE `acc`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bot`
--
ALTER TABLE `bot`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `log_bot`
--
ALTER TABLE `log_bot`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `acc`
--
ALTER TABLE `acc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1750;
--
-- AUTO_INCREMENT pour la table `bot`
--
ALTER TABLE `bot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1461;
--
-- AUTO_INCREMENT pour la table `log_bot`
--
ALTER TABLE `log_bot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=821;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1269;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
