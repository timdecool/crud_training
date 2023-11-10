-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 10 nov. 2023 à 16:04
-- Version du serveur : 10.4.10-MariaDB
-- Version de PHP : 8.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dwwm_231020`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_image` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_posted` datetime NOT NULL DEFAULT current_timestamp(),
  `date_edited` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_commentsidimage_imagesid` (`id_image`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `id_image`, `id_user`, `comment`, `date_posted`, `date_edited`) VALUES
(18, 17, 32, 'Coucou !', '2023-11-02 15:21:12', '2023-11-03 08:37:59'),
(26, 22, 31, 'Wow !', '2023-11-07 16:33:53', '2023-11-07 16:33:53'),
(20, 16, 30, 'J\'aime bien la forêt !', '2023-11-03 09:45:17', '2023-11-03 09:45:17'),
(21, 21, 30, 'ça fait réfléchir...', '2023-11-03 10:55:12', '2023-11-03 10:55:12'),
(23, 18, 31, 'C\'est l\'automne... snif', '2023-11-03 11:37:02', '2023-11-03 11:37:02'),
(24, 18, 34, 'Magnifique ! J\'ai les mêmes dans mon jardin :)', '2023-11-03 11:58:04', '2023-11-03 11:58:04');

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_creator` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`id`, `id_creator`, `date_created`, `date_updated`) VALUES
(1, 30, '2023-11-09 11:16:21', '2023-11-09 11:16:21'),
(2, 30, '2023-11-09 14:20:47', '2023-11-09 14:20:47');

-- --------------------------------------------------------

--
-- Structure de la table `conversations_users`
--

DROP TABLE IF EXISTS `conversations_users`;
CREATE TABLE IF NOT EXISTS `conversations_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_conv` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `last_seen` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `conversations_users`
--

INSERT INTO `conversations_users` (`id`, `id_conv`, `id_user`, `last_seen`) VALUES
(1, 1, 30, '2023-11-10 09:36:41'),
(2, 1, 37, '2023-11-09 15:06:31'),
(3, 2, 30, '2023-11-10 09:36:39'),
(4, 2, 37, '2023-11-09 15:06:25'),
(5, 2, 31, '2023-11-09 14:55:48');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(150) DEFAULT NULL,
  `author` varchar(60) NOT NULL DEFAULT 'Unknown',
  `author_link` varchar(200) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `src`, `title`, `description`, `author`, `author_link`, `date_added`, `date_updated`, `id_user`) VALUES
(22, 'https://images.unsplash.com/photo-1698901241480-52223fbd8e8b?auto=format&fit=crop&q=80&w=2070&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Un couple de méduses nageant l\'une à côté de l\'autre', 'J\'aime bien la nature, surtout les animaux marins. Les méduses sont fascinantes pour leur sens du collectif !', 'Dustin Humes', 'https://unsplash.com/fr/@dustinhumes_photography', '2023-11-03 16:55:00', '2023-11-03 16:55:00', 32),
(2, 'https://images.unsplash.com/photo-1697806959316-4864f26a09cf?auto=format&fit=crop&q=80&w=2080&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Un groupe d\'hommes en costumes et masques', 'Un groupe d\'hommes en costumes et masques qui nous fait vraiment réfléchir sur la société. À méditer...', 'Igor Omilaev', 'https://unsplash.com/fr/@omilaev', '2023-10-24 00:00:00', '2023-10-24 10:18:59', NULL),
(4, 'https://images.unsplash.com/photo-1695479626917-e0fb0fc76ec4?auto=format&fit=crop&q=80&w=1976&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Une vue d\'une ville avec une montagne en arrière-plan', 'Une vue d\'une ville avec une montagne en arrière-plan', 'Yorgos Triantafyllou', 'https://unsplash.com/fr/@yorgostriantafyllou', '2023-10-24 10:19:17', '2023-10-24 10:19:17', NULL),
(5, 'https://images.unsplash.com/photo-1697615235353-8547a571f0ea?auto=format&fit=crop&q=80&w=2070&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Une vue aérienne de la ville de Londres la nuit', 'Une vue aérienne de la ville de Londres la nuit', 'Marc Kleen', 'https://unsplash.com/fr/@marckleen', '2023-10-24 10:26:10', '2023-10-24 10:26:10', NULL),
(6, 'https://images.unsplash.com/photo-1697918498916-db7a3acab055?auto=format&fit=crop&q=80&w=1974&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'L\'intérieur d\'un bâtiment avec beaucoup de plantes qui poussent à l\'intérieur', 'L\'intérieur d\'un bâtiment avec beaucoup de plantes qui poussent à l\'intérieur', 'Joshua Kettle', 'https://unsplash.com/fr/@joshuakettle', '2023-10-24 10:28:42', '2023-10-24 10:28:42', NULL),
(8, 'https://images.unsplash.com/photo-1697432907709-68134c2c4c5b?auto=format&fit=crop&q=80&w=1974&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Un cerf couché sur le sol à côté d\'un banc', 'Un cerf couché sur le sol à côté d\'un banc', 'Spenser Sembrat', 'https://unsplash.com/fr/@spensersembrat', '2023-10-24 10:30:15', '2023-10-24 10:30:15', NULL),
(9, 'https://images.unsplash.com/photo-1697308034255-1839fce9d30a?auto=format&fit=crop&q=80&w=1974&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Un gros plan d\'un tas de boules de couleurs différentes', 'Un gros plan d\'un tas de boules de couleurs différentes', 'Nick Design', 'https://unsplash.com/fr/@nickshuperdesign', '2023-10-24 10:31:36', '2023-10-24 10:31:36', NULL),
(10, 'https://images.unsplash.com/photo-1696428862415-dfb24a63adda?auto=format&fit=crop&q=80&w=1974&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Une vue aérienne d\'une route à côté d\'un plan d\'eau', 'Une vue aérienne d\'une route à côté d\'un plan d\'eau', 'Thomas Ensley', 'https://unsplash.com/fr/@thethomasensley', '2023-10-24 11:56:46', '2023-10-24 11:56:46', NULL),
(18, 'https://images.unsplash.com/photo-1698848053125-56ffcd25c7f1?auto=format&fit=crop&q=80&w=2070&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Un bouquet de feuilles qui se trouvent sur un arbre', 'Un bouquet de feuilles qui se trouvent sur un arbre', 'Andy Feliciotti', 'https://unsplash.com/fr/@someguy', '2023-11-02 11:35:09', '2023-11-02 11:35:09', NULL),
(19, 'https://images.unsplash.com/photo-1698692937363-7eaf265c7d3f?auto=format&fit=crop&q=80&w=1974&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Une vue aérienne d\'une île au milieu de l\'océan', 'Une vue aérienne d\'une île au milieu de l\'océan', 'Jono Hirst', 'https://unsplash.com/fr/@jonohirst', '2023-11-02 17:00:03', '2023-11-02 17:00:03', NULL),
(17, 'https://images.unsplash.com/photo-1698765141491-4feee29e0f8c?auto=format&fit=crop&q=80&w=2070&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Trois oiseaux assis sur le dos d\'un chien', 'Trois oiseaux assis sur le dos d\'un chien !', 'Charl van Rooy', 'https://unsplash.com/fr/@redcharlie', '2023-11-02 09:52:57', '2023-11-02 09:52:57', NULL),
(15, 'https://images.unsplash.com/photo-1697856107138-d832d2edf9f3?auto=format&fit=crop&q=80&w=1972&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Une femme avec ses mains sur son visage', 'Une femme avec ses mains sur son visage, c\'est rigolo parce qu\'on a l\'impression qu\'elle a six yeux.', 'isi martínez', 'https://unsplash.com/fr/@isimartinez', '2023-10-25 12:02:33', '2023-10-25 12:02:33', NULL),
(16, 'https://images.unsplash.com/photo-1697450267156-d25ec832e807?auto=format&fit=crop&q=80&w=1974&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Une route au milieu d\'une forêt entourée de grands arbres !', 'Une route au milieu d\'une forêt entourée de grands arbres', 'Annie Spratt', 'https://unsplash.com/fr/@anniespratt', '2023-10-25 16:25:11', '2023-10-25 16:25:11', NULL),
(20, 'https://images.unsplash.com/photo-1698788370196-c12567cf663f?auto=format&fit=crop&q=80&w=2087&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Un grand amas d\'étoiles dans le ciel', 'Les étoiles dans le ciel nous rappellent notre petitesse dans l\'immensité d\'un univers en expansion. Une belle contemplation !', 'Anders Drange', 'https://unsplash.com/fr/@deep_sky_prints', '2023-11-03 09:19:34', '2023-11-03 09:19:34', NULL),
(21, 'https://images.unsplash.com/photo-1691929601779-ead6aeb78d1b?auto=format&fit=crop&q=80&w=2071&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Une vue aérienne d\'une ville avec beaucoup de grands immeubles', 'La ville, c\'est beau et laid, riche et pauvre, le meilleur et le pire de l\'humanité. Cette image le rappelle de façon époustouflante !!', 'taro ohtani', 'https://unsplash.com/fr/@taro_ohtani', '2023-11-03 09:22:41', '2023-11-07 16:24:45', 31),
(23, 'https://images.unsplash.com/photo-1699111260099-9769fb81ce65?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw0fHx8ZW58MHx8fHx8', 'Un gros plan d\'un cerf avec arrière-plan flou', 'Un gros plan d\'un cerf avec arrière-plan flou', 'Tim Schmidbauer', 'https://unsplash.com/fr/@timschmidbauer', '2023-11-07 16:50:12', '2023-11-07 16:50:12', 31),
(24, './uploads/30-1699521414.jpeg', 'Photo d\'un mec (pas moi)', 'Je suis aussi photographe de mode à mes heures !', 'Michel Boulon', 'https://instagram.com/mboulon', '2023-11-09 10:16:54', '2023-11-09 10:16:54', 30),
(25, 'https://images.unsplash.com/photo-1686476020928-1834ccef445b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Un bâtiment noir avec une horloge sur le côté', 'La dureté du metal d\'une façade d\'entreprise en zone industriel. Aïe !', 'refargotohp', 'https://unsplash.com/fr/@refargotohp', '2023-11-09 10:21:28', '2023-11-09 10:21:28', 30),
(26, './uploads/30-1699521802.png', 'Des motos engagées dans une course endiablée', 'Vroum vroum !', 'Michel Boulon', 'https://instagram.com/mboulon', '2023-11-09 10:23:22', '2023-11-09 10:23:22', 30);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_image` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `id_user`, `id_image`) VALUES
(25, 30, 22),
(26, 30, 18),
(28, 30, 20),
(29, 30, 16),
(39, 31, 22),
(31, 31, 21),
(32, 31, 20),
(36, 31, 16),
(41, 36, 23),
(42, 30, 21),
(43, 30, 25),
(44, 30, 24);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_conv` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_sent` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `id_conv`, `id_sender`, `message`, `date_sent`) VALUES
(1, 1, 30, 'Salut Martin, tout roule pour toi aujourd\'hui ?', '2023-11-08 11:43:39'),
(2, 1, 30, 'J\'avais une question, d\'où tu sors la dernière image que tu as trouvée ? Elle est super !', '2023-11-08 11:51:09'),
(3, 1, 37, 'Yo Michel ! Tout va super. Elle vient d\'unsplash je crois. Hésite pas à mettre un like si tu aimes :)', '2023-11-08 11:53:27'),
(4, 1, 30, 'J\'y vais de ce pas !', '2023-11-08 12:15:20'),
(18, 1, 30, 'coucou', '2023-11-08 16:47:50'),
(17, 1, 30, 'Coucou !', '2023-11-08 16:46:29'),
(16, 1, 30, 'Salut', '2023-11-08 16:14:23'),
(15, 1, 30, 'Coucou', '2023-11-08 16:12:05'),
(14, 1, 30, 'ça roule ?', '2023-11-08 15:23:27'),
(13, 1, 30, 'oui', '2023-11-08 14:01:04'),
(19, 1, 30, 'coucou', '2023-11-08 16:48:43'),
(20, 1, 37, 'ça va j\'ai compris arrête de forcer', '2023-11-08 16:50:44'),
(21, 1, 30, 'J\'aime les pâtes', '2023-11-08 16:51:09'),
(22, 1, 37, 'je casse mon crâne', '2023-11-08 16:51:55'),
(23, 1, 37, 'hahaha', '2023-11-08 16:52:41'),
(24, 1, 30, 'yo', '2023-11-08 16:53:08'),
(25, 1, 37, 'ça roule ?', '2023-11-08 16:53:54'),
(26, 1, 30, 'move_uploaded_file donne un booléen', '2023-11-08 16:54:49'),
(27, 1, 37, 'hey', '2023-11-08 16:57:18'),
(28, 1, 30, 'Bonjour Michel', '2023-11-08 17:03:23'),
(29, 1, 30, 'Bonjour', '2023-11-08 17:05:48'),
(30, 1, 30, 'Bonjour !!', '2023-11-09 08:35:44'),
(31, 1, 37, 'ça va ?', '2023-11-09 08:36:12'),
(32, 1, 37, 'yo', '2023-11-09 08:38:08'),
(33, 1, 30, 'hey', '2023-11-09 08:46:04'),
(34, 1, 30, 'ça remarche ?', '2023-11-09 14:17:09'),
(35, 1, 30, 'ça remarche !!!', '2023-11-09 14:17:15'),
(36, 2, 30, 'Salut la compagnie !', '2023-11-09 14:24:38'),
(37, 2, 31, 'Salut Michel, salut Martin !', '2023-11-09 14:25:01'),
(38, 2, 37, 'Salut les potos :D', '2023-11-09 14:25:54'),
(39, 1, 30, 'Est-ce que ça fonctionne ?', '2023-11-10 12:43:04'),
(42, 1, 30, 'et maintenant ?', '2023-11-10 12:56:47'),
(43, 1, 30, 'salut la team', '2023-11-10 13:03:43'),
(44, 1, 30, 'salut la team', '2023-11-10 13:03:48'),
(45, 1, 30, 'merde', '2023-11-10 13:03:53'),
(46, 1, 30, 'yo', '2023-11-10 13:14:33'),
(47, 1, 30, 'heyyy', '2023-11-10 15:24:09'),
(48, 1, 30, 'yoooo', '2023-11-10 15:35:08'),
(49, 1, 30, 'pouya', '2023-11-10 15:35:44'),
(50, 1, 30, 'pourquoi ?', '2023-11-10 15:55:32');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` tinytext NOT NULL DEFAULT 'user',
  `first_name` varchar(130) DEFAULT NULL,
  `last_name` varchar(130) DEFAULT NULL,
  `mail` varchar(180) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp(),
  `last_visit` datetime NOT NULL DEFAULT current_timestamp(),
  `password` varchar(200) NOT NULL,
  `id_image` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `role`, `first_name`, `last_name`, `mail`, `date_created`, `date_updated`, `last_visit`, `password`, `id_image`) VALUES
(30, 'admin', 'Michel', 'Boulon', 'michel.boulon@laposte.net', '2023-11-02 15:01:57', '2023-11-02 16:50:09', '2023-11-02 15:01:57', '$2y$10$7WWK3DveUYErlfD7DtbOjuRWA2/oF0ZlEppO4ic85ikkQYTJhlLRa', 24),
(31, 'editor', 'Miranda', 'Portique', 'mirandaaa@yahoo.fr', '2023-11-02 15:03:04', '2023-11-07 16:18:29', '2023-11-02 15:03:04', '$2y$10$2abDBJ0DUGeO7I5YQFPRcuIoiEvvOkz7dzmrkgqNHqsnpOi.XnGmC', 25),
(32, 'editor', 'Paul', 'Tourniquet', 'ptourniquet@gmail.com', '2023-11-02 15:12:57', '2023-11-03 13:59:19', '2023-11-02 15:12:57', '$2y$10$xO7SWXAufcXz3pg3rHcv2.1qmYm.C8klQfxXBV2SeZrZc7NRdxrz2', NULL),
(35, 'user', 'Fred', 'Coucou', 'f.coucou@gmail.com', '2023-11-03 13:12:09', '2023-11-03 13:31:04', '2023-11-03 13:12:09', '$2y$10$Zi18Wd8ZSbuZLU.WvpYBte5DIHLnlUN3nyTxWlgsrt14exmscZy8O', NULL),
(36, 'user', 'Patrick', 'Planche', 'patrickplanche@orange.fr', '2023-11-08 09:36:21', '2023-11-08 09:36:21', '2023-11-08 09:36:21', '$2y$10$cFGndsmGFFCt25zWqmMR3.x7x3.ACKEXg.6enBYmd9yVS6.WAj1jC', NULL),
(37, 'editor', 'Martin', 'Matin', 'martinmatin@gmail.com', '2023-11-08 10:08:21', '2023-11-08 13:22:01', '2023-11-08 10:08:21', '$2y$10$At6ilypBQfuPUoyhq02eb.FSrZ4wCEIBlhZnUAxqpQPfkUj.GBJ5m', 26);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
