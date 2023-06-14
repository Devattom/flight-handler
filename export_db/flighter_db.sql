-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 23 avr. 2023 à 07:51
-- Version du serveur : 5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `flighter_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'Paris'),
(2, 'Madrid'),
(3, 'Tokyo'),
(4, 'Bogota');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230417201848', '2023-04-17 20:19:14', 258),
('DoctrineMigrations\\Version20230417202436', '2023-04-17 20:24:57', 192),
('DoctrineMigrations\\Version20230418164449', '2023-04-18 16:46:24', 319);

-- --------------------------------------------------------

--
-- Structure de la table `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `flight_nb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departure_datetime` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `arrival_datetime` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `price` int(11) NOT NULL,
  `discount` tinyint(1) NOT NULL,
  `available_seat` int(11) NOT NULL,
  `departure_city_id` int(11) NOT NULL,
  `arrival_city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `flights`
--

INSERT INTO `flights` (`id`, `flight_nb`, `departure_datetime`, `arrival_datetime`, `price`, `discount`, `available_seat`, `departure_city_id`, `arrival_city_id`) VALUES
(2, 'ON3628', '2023-04-26 00:00:00', '2023-04-28 00:08:00', 520, 0, 7, 1, 2),
(4, 'PJ1639', '2023-04-20 09:00:00', '2023-04-21 00:00:00', 160, 1, 30, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `roles`, `password`, `lastname`, `firstname`) VALUES
(1, 'test@test.com', '[\"ROLE_USER\"]', '$2y$13$VyRQH75eFmRtDXmfRNpN7.jn4Sl7F0jM.0i9L/wYS5W5FpnwMom0S', 'Rousselin', 'Thomas'),
(3, 'test2@test.com', '[\"ROLE_ADMIN\"]', '$2y$13$.zLyT5AB0Y7lSNSpQx7OveJXNbl4cYOj5JmBIryaeK77EMHP31Dhy', 'Rousselin', 'Thomas');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FC74B5EA918B251E` (`departure_city_id`),
  ADD KEY `IDX_FC74B5EA4067ACA7` (`arrival_city_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `FK_FC74B5EA4067ACA7` FOREIGN KEY (`arrival_city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `FK_FC74B5EA918B251E` FOREIGN KEY (`departure_city_id`) REFERENCES `cities` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
