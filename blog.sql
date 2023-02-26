-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : dim. 26 fév. 2023 à 12:32
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `image_path` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `description`, `content`, `image_path`, `user_id`, `created_at`, `updated_at`) VALUES
(5, 'Article 1', 'description de l\'article 1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas ipsa perspiciatis, quam praesentium tempora optio magnam nostrum, recusandae ratione illo harum quod voluptatem! Mollitia non sit eaque est recusandae quis!<br />\r\nSoluta culpa doloremque repellat? Animi quae obcaecati velit veritatis, reprehenderit asperiores similique corporis exercitationem nulla repellat doloremque voluptates accusantium. Doloribus hic esse quasi cum vitae nam iste modi deleniti inventore.<br />\r\nConsequatur odio illum nostrum consequuntur in laboriosam accusamus odit eos inventore, saepe perspiciatis ex atque totam fuga rem dolor. Libero, veritatis magni beatae repellat iste sed ipsam molestias minus labore.<br />\r\nTenetur corporis, odit, perferendis corrupti quod velit animi eos culpa cupiditate quo atque illum ea? Nihil soluta error rem modi illo assumenda numquam sit recusandae neque, beatae eaque illum voluptate.<br />\r\nOdio, beatae ut? Aut doloribus error, sit itaque delectus illo incidunt qui nobis nesciunt distinctio architecto rem dignissimos, cum libero inventore iure, eveniet quidem quod? Doloribus aliquam ab placeat eum.', 'public/asset/img/article/articleUn.jpeg', 42, '2023-02-26 13:26:11', '2023-02-26 13:26:11'),
(6, 'Article 2', 'description de l\'article 2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas ipsa perspiciatis, quam praesentium tempora optio magnam nostrum, recusandae ratione illo harum quod voluptatem! Mollitia non sit eaque est recusandae quis!<br />\r\nSoluta culpa doloremque repellat? Animi quae obcaecati velit veritatis, reprehenderit asperiores similique corporis exercitationem nulla repellat doloremque voluptates accusantium. Doloribus hic esse quasi cum vitae nam iste modi deleniti inventore.<br />\r\nConsequatur odio illum nostrum consequuntur in laboriosam accusamus odit eos inventore, saepe perspiciatis ex atque totam fuga rem dolor. Libero, veritatis magni beatae repellat iste sed ipsam molestias minus labore.<br />\r\nTenetur corporis, odit, perferendis corrupti quod velit animi eos culpa cupiditate quo atque illum ea? Nihil soluta error rem modi illo assumenda numquam sit recusandae neque, beatae eaque illum voluptate.<br />\r\nOdio, beatae ut? Aut doloribus error, sit itaque delectus illo incidunt qui nobis nesciunt distinctio architecto rem dignissimos, cum libero inventore iure, eveniet quidem quod? Doloribus aliquam ab placeat eum.', 'public/asset/img/article/articleDeux.jpeg', 42, '2023-02-26 13:26:40', '2023-02-26 13:26:40'),
(7, 'Article 3', 'description de l\'article 3', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas ipsa perspiciatis, quam praesentium tempora optio magnam nostrum, recusandae ratione illo harum quod voluptatem! Mollitia non sit eaque est recusandae quis!<br />\r\nSoluta culpa doloremque repellat? Animi quae obcaecati velit veritatis, reprehenderit asperiores similique corporis exercitationem nulla repellat doloremque voluptates accusantium. Doloribus hic esse quasi cum vitae nam iste modi deleniti inventore.<br />\r\nConsequatur odio illum nostrum consequuntur in laboriosam accusamus odit eos inventore, saepe perspiciatis ex atque totam fuga rem dolor. Libero, veritatis magni beatae repellat iste sed ipsam molestias minus labore.<br />\r\nTenetur corporis, odit, perferendis corrupti quod velit animi eos culpa cupiditate quo atque illum ea? Nihil soluta error rem modi illo assumenda numquam sit recusandae neque, beatae eaque illum voluptate.<br />\r\nOdio, beatae ut? Aut doloribus error, sit itaque delectus illo incidunt qui nobis nesciunt distinctio architecto rem dignissimos, cum libero inventore iure, eveniet quidem quod? Doloribus aliquam ab placeat eum.', 'public/asset/img/article/articleTrois.png', 42, '2023-02-26 13:27:07', '2023-02-26 13:27:07');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `token` varchar(100) NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `mail`, `password`, `auth`, `date`) VALUES
(42, 'Admin', 'test.test@test.com', '$2y$10$cZ.nkkGKqigXa4gkdx4DAe5mveNAK/n0ne45tWs2Qlt9aeDYGystC', 1, '2023-02-26 13:14:52');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Index pour la table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
