-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 14 Avril 2019 à 13:33
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `projet_web`
--
DROP DATABASE `projet_web`;
CREATE DATABASE IF NOT EXISTS `projet_web` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `projet_web`;

-- --------------------------------------------------------

--
-- Structure de la table `consigne`
--

DROP TABLE IF EXISTS `consigne`;
CREATE TABLE `consigne` (
  `ID_CONSIGNE` int(11) NOT NULL,
  `TEMPS` int(11) NOT NULL,
  `BAREME` int(11) NOT NULL,
  `RETOUR` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `est_compose`
--

DROP TABLE IF EXISTS `est_compose`;
CREATE TABLE `est_compose` (
  `ID_QUESTION` int(11) NOT NULL,
  `ID_QUESTIONNAIRE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

DROP TABLE IF EXISTS `participe`;
CREATE TABLE `participe` (
  `ID_USER` int(11) NOT NULL,
  `ID_QUESTIONNAIRE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `ID_QUESTION` int(11) NOT NULL,
  `ID_CONSIGNE` int(11) NOT NULL,
  `TAG` varchar(30) DEFAULT NULL,
  `TYPE_QUESTION` varchar(10) NOT NULL,
  `NB_REPONSES` int(11) DEFAULT NULL,
  `DESCRIPTION_QUESTION` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `questionnaire`
--

DROP TABLE IF EXISTS `questionnaire`;
CREATE TABLE `questionnaire` (
  `ID_QUESTIONNAIRE` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ID_CONSIGNE` int(11) NOT NULL,
  `TITRE` varchar(100) NOT NULL,
  `DESCRIPTION_QUESTIONNAIRE` text NOT NULL,
  `DATE_OUVERTURE` datetime NOT NULL,
  `DATE_FERMETURE` datetime NOT NULL,
  `ETAT` varchar(15) NOT NULL,
  `PROMO` int(10) DEFAULT NULL,
  `GROUPE` tinyint(1) DEFAULT NULL,
  `TD` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reliee_a`
--

DROP TABLE IF EXISTS `reliee_a`;
CREATE TABLE `reliee_a` (
  `ID_REPONSESP` int(11) NOT NULL,
  `REP_ID_REPONSESP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reponse_choisie`
--

DROP TABLE IF EXISTS `reponse_choisie`;
CREATE TABLE `reponse_choisie` (
  `ID_REPONSEC` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ID_QUESTION` int(11) NOT NULL,
  `ID_QUESTIONNAIRE` int(11) NOT NULL,
  `EST_JUSTE_C` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reponse_proposee`
--

DROP TABLE IF EXISTS `reponse_proposee`;
CREATE TABLE `reponse_proposee` (
  `ID_REPONSESP` int(11) NOT NULL,
  `ID_QUESTION` int(11) NOT NULL,
  `EST_JUSTE_P` tinyint(1) NOT NULL,
  `COLONNE` tinyint(1) DEFAULT NULL,
  `CONTENU` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `LOGIN` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `NOM` varchar(30) NOT NULL,
  `PRENOM` varchar(30) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `ROLE` varchar(30) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `MATRICULE` int(10) DEFAULT NULL,
  `INTERN_EXT` tinyint(1) DEFAULT NULL,
  `MATIERE` varchar(30) DEFAULT NULL,
  `PROMO` int(10) DEFAULT NULL,
  `TD` int(2) DEFAULT NULL,
  `GROUPE` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `consigne`
--
ALTER TABLE `consigne`
  ADD PRIMARY KEY (`ID_CONSIGNE`);

--
-- Index pour la table `est_compose`
--
ALTER TABLE `est_compose`
  ADD PRIMARY KEY (`ID_QUESTION`,`ID_QUESTIONNAIRE`),
  ADD KEY `FK_EST_COMPOSE2` (`ID_QUESTIONNAIRE`);

--
-- Index pour la table `participe`
--
ALTER TABLE `participe`
  ADD PRIMARY KEY (`ID_USER`,`ID_QUESTIONNAIRE`),
  ADD KEY `FK_PARTICIPE` (`ID_QUESTIONNAIRE`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`ID_QUESTION`),
  ADD KEY `FK_DEFINI_QUESTION` (`ID_CONSIGNE`);

--
-- Index pour la table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD PRIMARY KEY (`ID_QUESTIONNAIRE`),
  ADD KEY `TITRE_FK` (`TITRE`),
  ADD KEY `FK_DEFINI_QUESTIONNAIRE` (`ID_CONSIGNE`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Index pour la table `reliee_a`
--
ALTER TABLE `reliee_a`
  ADD PRIMARY KEY (`ID_REPONSESP`,`REP_ID_REPONSESP`),
  ADD KEY `FK_RELIEE_A2` (`REP_ID_REPONSESP`);

--
-- Index pour la table `reponse_choisie`
--
ALTER TABLE `reponse_choisie`
  ADD PRIMARY KEY (`ID_REPONSEC`),
  ADD KEY `FK_CHOISIT` (`ID_USER`),
  ADD KEY `FK_EST_REPONDU` (`ID_QUESTION`);

--
-- Index pour la table `reponse_proposee`
--
ALTER TABLE `reponse_proposee`
  ADD PRIMARY KEY (`ID_REPONSESP`),
  ADD KEY `FK_PROPOSE` (`ID_QUESTION`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`),
  ADD KEY `USER_PRENOM_FK` (`PRENOM`),
  ADD KEY `USER_NOM_FK` (`NOM`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `consigne`
--
ALTER TABLE `consigne`
  MODIFY `ID_CONSIGNE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `ID_QUESTION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT pour la table `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `ID_QUESTIONNAIRE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT pour la table `reponse_choisie`
--
ALTER TABLE `reponse_choisie`
  MODIFY `ID_REPONSEC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT pour la table `reponse_proposee`
--
ALTER TABLE `reponse_proposee`
  MODIFY `ID_REPONSESP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Contraintes pour les tables exportées
--
