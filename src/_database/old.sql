-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 21 nov. 2024 à 23:39
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mdubois_api_reigns`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id_administrateur` int(11) NOT NULL,
  `ad_mail_admin` varchar(255) DEFAULT NULL,
  `mdp_admin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id_administrateur`, `ad_mail_admin`, `mdp_admin`) VALUES
(1, 'admin@gmail.com', '$2y$10$c899C2sLdxbAiDAZlT9lqePt9iGq0MjAQi43rn.YBRA9vOP4zLCgi'),
(3, 'bdmin@gmail.com', '$2y$10$Z2.WB8BWGTvQpycWFY/Pr.5b7l7UOJcRQRGVvkvlNsrbiQ6KPOifS');

-- --------------------------------------------------------

--
-- Structure de la table `carte`
--

CREATE TABLE `carte` (
  `id_carte` int(11) NOT NULL,
  `texte_carte` text NOT NULL,
  `valeurs_choix1` varchar(100) DEFAULT NULL,
  `valeurs_choix2` varchar(100) DEFAULT NULL,
  `date_soumission` date DEFAULT NULL,
  `ordre_soumission` int(11) DEFAULT NULL,
  `id_createur` int(11) DEFAULT NULL,
  `id_administrateur` int(11) DEFAULT NULL,
  `id_deck` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `carte`
--

INSERT INTO `carte` (`id_carte`, `texte_carte`, `valeurs_choix1`, `valeurs_choix2`, `date_soumission`, `ordre_soumission`, `id_createur`, `id_administrateur`, `id_deck`) VALUES
(33, 'Le royaume est en proie à la famine. Investir dans l\'agriculture ? Ou augmenter les impôts pour remplir les caisses ?', '10/-5', '-5/15', '2024-10-26', 1, NULL, 1, 5),
(34, 'Un voisin propose une alliance. Accepterais-tu d\'ignorer son armée ? Ou refuserais-tu pour garder ton indépendance ?', '15/-10', '-5/20', '2024-10-26', 2, 20, NULL, 5),
(35, 'première carte\r\n555555555555555555555555555555555555555555555555555555555555', '12/24', '1/2', '2024-11-18', 1, NULL, 1, 6),
(36, 'ezzfzeferhtrhezzfzeferhtrhezzfzeferhtrhezzfzeferhtrhezzfzeferhtrhezzfzeferhtrhezzfzeferhtrhezzfzeferhtrhezzfzeferhtrhezzfzeferhtrhezzfzeferhtrhezzfzeferhtrhezzfzeferhtrhezzfzeferhtrhezzfzeferhtrhezzfzeferhtrhezzfzeferhtrhezzfzeferhtrh', '4/-3', '2/-4', '2024-11-18', 2, 21, NULL, 6);

-- --------------------------------------------------------

--
-- Structure de la table `carte_aleatoire`
--

CREATE TABLE `carte_aleatoire` (
  `num_carte` int(11) NOT NULL,
  `id_deck` int(11) DEFAULT NULL,
  `id_createur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `carte_aleatoire`
--

INSERT INTO `carte_aleatoire` (`num_carte`, `id_deck`, `id_createur`) VALUES
(33, 5, 20),
(35, 6, 21);

-- --------------------------------------------------------

--
-- Structure de la table `createur`
--

CREATE TABLE `createur` (
  `id_createur` int(11) NOT NULL,
  `nom_createur` varchar(100) NOT NULL,
  `ad_mail_createur` varchar(100) NOT NULL,
  `mdp_createur` varchar(100) NOT NULL,
  `genre` varchar(10) DEFAULT NULL,
  `ddn` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `createur`
--

INSERT INTO `createur` (`id_createur`, `nom_createur`, `ad_mail_createur`, `mdp_createur`, `genre`, `ddn`) VALUES
(20, 'Camille', 'c@gmail.com', '$2y$10$LJNnUDApO8jB.UscqAUuFuHX14H9opQBwbpu/99H3RiVaI36NOGfO', 'F', '2000-07-13'),
(21, 'lapin', 'lapin@gmail.com', '$2y$10$YLiFMYqt/5FAkBceKhUdAuJzaD71RFW/TYT8Qn5Ac15rrdsUxG4oy', 'M', '2024-11-03');

-- --------------------------------------------------------

--
-- Structure de la table `deck`
--

CREATE TABLE `deck` (
  `id_deck` int(11) NOT NULL,
  `titre_deck` varchar(50) DEFAULT NULL,
  `body_deck` varchar(5000) DEFAULT NULL,
  `date_debut_deck` date DEFAULT NULL,
  `date_fin_deck` date DEFAULT NULL,
  `nb_cartes` int(11) DEFAULT NULL,
  `nb_jaime` int(11) DEFAULT NULL,
  `id_administrateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `deck`
--

INSERT INTO `deck` (`id_deck`, `titre_deck`, `body_deck`, `date_debut_deck`, `date_fin_deck`, `nb_cartes`, `nb_jaime`, `id_administrateur`) VALUES
(5, 'Moyen Age', 'Ce deck est à propos du moyen Âge', '2024-10-26', '2024-10-30', 3, 0, 1),
(6, 'Trello', 'Ce deck est à propos de Trello.', '2024-11-18', '2024-12-27', 5, 0, 1),
(9, 'FromApi', 'J\'ai fait ce deck grâce à l\'api', '2024-11-20', '2024-12-30', 5, 0, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id_administrateur`);

--
-- Index pour la table `carte`
--
ALTER TABLE `carte`
  ADD PRIMARY KEY (`id_carte`),
  ADD KEY `id_createur` (`id_createur`),
  ADD KEY `id_administrateur` (`id_administrateur`),
  ADD KEY `id_deck` (`id_deck`);

--
-- Index pour la table `carte_aleatoire`
--
ALTER TABLE `carte_aleatoire`
  ADD KEY `id_deck` (`id_deck`),
  ADD KEY `id_createur` (`id_createur`);

--
-- Index pour la table `createur`
--
ALTER TABLE `createur`
  ADD PRIMARY KEY (`id_createur`);

--
-- Index pour la table `deck`
--
ALTER TABLE `deck`
  ADD PRIMARY KEY (`id_deck`),
  ADD KEY `deck_ibfk_1` (`id_administrateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id_administrateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `carte`
--
ALTER TABLE `carte`
  MODIFY `id_carte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `createur`
--
ALTER TABLE `createur`
  MODIFY `id_createur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `deck`
--
ALTER TABLE `deck`
  MODIFY `id_deck` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `carte`
--
ALTER TABLE `carte`
  ADD CONSTRAINT `carte_ibfk_1` FOREIGN KEY (`id_createur`) REFERENCES `createur` (`id_createur`),
  ADD CONSTRAINT `carte_ibfk_2` FOREIGN KEY (`id_administrateur`) REFERENCES `administrateur` (`id_administrateur`),
  ADD CONSTRAINT `carte_ibfk_3` FOREIGN KEY (`id_deck`) REFERENCES `deck` (`id_deck`);

--
-- Contraintes pour la table `carte_aleatoire`
--
ALTER TABLE `carte_aleatoire`
  ADD CONSTRAINT `carte_aleatoire_ibfk_1` FOREIGN KEY (`id_deck`) REFERENCES `deck` (`id_deck`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carte_aleatoire_ibfk_2` FOREIGN KEY (`id_createur`) REFERENCES `createur` (`id_createur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `deck`
--
ALTER TABLE `deck`
  ADD CONSTRAINT `deck_ibfk_1` FOREIGN KEY (`id_administrateur`) REFERENCES `administrateur` (`id_administrateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
