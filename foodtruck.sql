-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 03 fév. 2022 à 17:11
-- Version du serveur :  5.7.32
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `foodtruck`
--

-- --------------------------------------------------------

--
-- Structure de la table `foodtruck`
--

CREATE TABLE `foodtruck` (
  `id` int(11) NOT NULL,
  `nom` varchar(60) NOT NULL,
  `siteweb` varchar(360) NOT NULL,
  `fk_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `foodtruck`
--

INSERT INTO `foodtruck` (`id`, `nom`, `siteweb`, `fk_utilisateur`) VALUES
(1, 'Butcher', 'https://www.google.be', 2),
(2, 'Frites', 'https://www.technobel.be', 3),
(3, 'Hamburger', 'https://www.microsoft.com', 4);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `fk_statut` int(11) NOT NULL,
  `fk_foodtruck` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `date`, `fk_statut`, `fk_foodtruck`) VALUES
(1, '2021-11-28', 1, 1),
(2, '2021-11-29', 2, 2),
(3, '2021-11-30', 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `id` int(11) NOT NULL,
  `nom` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`id`, `nom`) VALUES
(1, 'En cours'),
(2, 'Accepté'),
(3, 'Décliné');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `login` varchar(60) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `mdp`, `role`) VALUES
(1, 'techno', 'techno', 1),
(2, 'butcher', 'butcher', 2),
(3, 'frites', 'frites', 2),
(4, 'hamburger', 'hamburger', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `foodtruck`
--
ALTER TABLE `foodtruck`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_foodtruck_nom` (`nom`),
  ADD KEY `fk_foodtruck_utilisateur` (`fk_utilisateur`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reservation_statut` (`fk_statut`),
  ADD KEY `fk_reservation_foodtruck` (`fk_foodtruck`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_login` (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `foodtruck`
--
ALTER TABLE `foodtruck`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `foodtruck`
--
ALTER TABLE `foodtruck`
  ADD CONSTRAINT `fk_foodtruck_utilisateur` FOREIGN KEY (`fk_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_reservation_foodtruck` FOREIGN KEY (`fk_foodtruck`) REFERENCES `foodtruck` (`id`),
  ADD CONSTRAINT `fk_reservation_statut` FOREIGN KEY (`fk_statut`) REFERENCES `statut` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
