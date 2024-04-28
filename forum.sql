-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 28, 2024 at 07:38 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `thread_id` int NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkuser_id` (`user_id`),
  KEY `fkthread_id` (`thread_id`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `thread_id`, `created`) VALUES
(0, 'es', 31, 50, '2024-04-28 16:54:03'),
(1, 'Hello', 31, 45, '2024-04-24 21:04:38'),
(2, 'vc', 31, 45, '2024-04-24 21:05:01'),
(3, 'Long chin', 31, 46, '2024-04-24 21:06:16'),
(4, '12', 31, 46, '2024-04-24 21:11:43'),
(5, '?', 31, 46, '2024-04-24 21:11:56'),
(6, 'as', 31, 46, '2024-04-24 21:12:32'),
(7, 'sa', 31, 46, '2024-04-24 21:12:57'),
(8, 'test', 31, 46, '2024-04-24 21:14:23'),
(9, 'tes', 31, 46, '2024-04-24 21:14:38'),
(10, 's', 31, 46, '2024-04-24 21:15:59'),
(11, 'ssa', 31, 46, '2024-04-24 21:16:02'),
(12, 'sda', 31, 46, '2024-04-24 21:16:30'),
(13, 'asd', 31, 45, '2024-04-24 21:17:52'),
(14, 'asd', 31, 46, '2024-04-24 21:18:08'),
(15, 'as', 31, 46, '2024-04-24 21:19:01'),
(16, '??&#13;&#10;', 31, 47, '2024-04-24 23:59:37'),
(17, 'ads', 31, 45, '2024-04-25 00:02:10'),
(18, 'asd&#13;&#10;', 31, 45, '2024-04-25 00:03:57'),
(19, 'asd', 31, 45, '2024-04-25 00:05:34'),
(20, 'sd', 31, 45, '2024-04-25 00:05:40'),
(21, 'sdfasf', 31, 47, '2024-04-25 00:05:50'),
(22, 'asd', 31, 46, '2024-04-25 00:08:56'),
(23, 'asd', 31, 45, '2024-04-25 00:09:04'),
(24, 'asd', 31, 45, '2024-04-25 00:11:55'),
(25, 'sad', 31, 45, '2024-04-25 00:12:08'),
(26, 'sad', 31, 45, '2024-04-25 00:12:25'),
(27, 'sad', 31, 45, '2024-04-25 00:20:56'),
(28, 'sad', 31, 45, '2024-04-25 00:21:16'),
(29, 'sd', 31, 45, '2024-04-25 00:21:19'),
(30, 'sdf', 31, 45, '2024-04-25 00:21:21'),
(31, 'sdf', 31, 45, '2024-04-25 00:21:23');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `subject`, `message`, `email`, `created_at`) VALUES
(1, 'Testingr', 'test', 'long@gmail.com', '2024-04-28 15:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `created`) VALUES
(1, 'Computing', '2024-04-23 21:19:24'),
(2, 'Pro Project Management', '2024-04-23 21:20:13'),
(3, 'UID Design', '2024-04-23 21:20:30');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

DROP TABLE IF EXISTS `threads`;
CREATE TABLE IF NOT EXISTS `threads` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `img` varchar(5028) DEFAULT NULL,
  `module_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fkuser` (`user_id`),
  KEY `fkmoduleid` (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `name`, `description`, `img`, `module_id`, `user_id`, `created_at`) VALUES
(40, 'asd', '123', '/img/3607444.png', 2, 8, '2024-04-21 17:23:03'),
(41, 'Real', 'Life is roblox', '/img/edit.png', 3, 8, '2024-04-21 17:24:33'),
(42, 'Real', 'asd', '', 3, 8, '2024-04-21 17:24:43'),
(43, 'asd', 'asdasdasd', '', 2, 8, '2024-04-21 17:25:46'),
(44, 'Real', 'Super Idol', '/img/images.jpg', 1, 8, '2024-04-23 20:31:19'),
(45, 'User Interface Design', 'How to use Axure RP 10 efficiently?', '', 3, 31, '2024-04-28 19:56:16'),
(46, 'testing', 'est', '', 1, 31, '2024-04-28 20:00:45'),
(47, 'Why have many comment', 'test', '', 1, 31, '2024-04-28 20:04:29'),
(48, 'uả sao có test', 'tị sao ', '/img/man5.jpg', 1, 31, '2024-04-28 20:05:04'),
(52, 'Anh Long', 'quá gà', '/img/z5387416546693_1f52f9dfaddfd8ebfa2db49c0eb4a763.jpg', 2, 32, '2024-04-28 22:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pass`, `created`, `is_admin`) VALUES
(5, 'root', 'asdasda@gmail.com', '$2y$10$Aaot3Lmg1F.s6aHFsnA8Q.vW5Uy9r8eaBTgjpA07cPA/TOaTL5SdO', '2024-04-06 01:42:27', 0),
(21, 'kyle123', 'kyle123123@gmail.com', '$2y$10$4F65vAYwrTAbV8xg/DA5k.NPQupMtMyP.PIm4tcMdMPeR/H4ywceq', '2024-04-16 15:27:30', 0),
(22, '123123', '123123@gmail.com', '$2y$10$uNUehc89f0qF2PV8c.C3dujncE13vf2QeNQcASm2a31NYjegKw7ua', '2024-04-20 00:10:09', 0),
(23, '12341234', '123123123123@gmail.com', '$2y$10$Y4G.93xJrBDJEri6BIbQ2.0MxrUio9Bc2iowtzykkD8/WREIq802G', '2024-04-20 14:18:44', 0),
(24, 'asdadasd', 'kyle123asdasd@gmail.com', '$2y$10$AKH1RaKx.26E31dpGuHlc.kBVo8sH1ahJq9ByvejPVQYSS1VpeOuS', '2024-04-20 17:06:50', 0),
(25, 'asdadasd123', 'kyle121233asdasd@gmail.com', '$2y$10$Gl.rORedo5Xv2C5G8fV0ZevuK6HTOeqdJtSJ.8BzIUGq.YRKCOouu', '2024-04-20 17:09:53', 0),
(26, 'asdadasd123123', 'kyle121212333asdasd@gmail.com', '$2y$10$HMxmqb/JTNVx3UmI6P8/1uHNiZ8qFXri7bmYHaUS..nF1CPNl/kXW', '2024-04-20 17:13:27', 0),
(27, 'man', 'raygun@gmail.com', '$2y$10$wg6zA4gwG.raXvZ6bNtfNeaA4nUmEByx5032Zze4aC0boiPkQZFtK', '2024-04-20 17:15:39', 0),
(28, 'hakjsdhakjdhkashd', '123456@gmail.com', '$2y$10$P7xyZwLAWfOdQ1f07eyStuccylm/VP4JJ8nydf77oYFSFmlkrXK/e', '2024-04-20 19:39:42', 0),
(29, 'Kanye West', 'west@gmail.com', '$2y$10$T1TmFQU6J0TkxlERaQiE3OJXhNJFKMawzuA5jMPgbJBiqhU3bcatG', '2024-04-21 17:09:05', 0),
(30, 'David', '1612@gmail.com', '$2y$10$P2XTsYo5pxNilMhRbb04wu2ey4zo7S1hBscfb4jmjgNkb4wL3gbYq', '2024-04-23 20:21:43', 0),
(31, 'long123', 'long@gmail.com', '$2y$10$kUe9ERGQgUchVG4giddFS.6Gkw5lNN6f/HEyzO.rduCfJ.JtwqbfW', '2024-04-28 19:55:22', 1),
(32, 'tet', 'longchina@gmail.com', '$2y$10$JoYnojnw5tFx1FIULFqDLOBJuNYqr3xU6rY6WjPri4qi1FFleDHT.', '2024-04-28 22:40:10', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fkthread_id` FOREIGN KEY (`thread_id`) REFERENCES `threads` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fkuser_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `threads`
--
ALTER TABLE `threads`
  ADD CONSTRAINT `fkmoduleid` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fkuser` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
