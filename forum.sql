-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 28, 2024 at 09:22 PM
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
  `id` int NOT NULL AUTO_INCREMENT,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `thread_id` int NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkuser_id` (`user_id`),
  KEY `fkthread_id` (`thread_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `thread_id`, `created`) VALUES
(33, 'CSS is used to style the presentation of web pages, including elements such as layout, colors, fonts, and spacing. By separating the presentation layer from the HTML markup, CSS enables developers to create consistent and visually appealing designs across multiple web pages.', 36, 56, '2024-04-28 21:06:26'),
(34, ' While there is some overlap, a software developer primarily focuses on coding and implementing software solutions', 36, 55, '2024-04-28 21:07:16'),
(35, 'whereas a software engineer is involved in the entire software development lifecycle, including requirements gathering, design, testing, deployment, and maintenance.', 36, 55, '2024-04-28 21:07:30'),
(36, 'Agile is an iterative and incremental approach to software development, emphasizing flexibility, collaboration, and customer feedback throughout the development process. Waterfall, on the other hand, follows a linear sequential model, with distinct phases (requirements, design, implementation, testing, deployment) and minimal customer involvement after the initial requirements gathering phase.', 36, 57, '2024-04-28 21:08:54'),
(37, 'Who farted in room L.03 ????&#13;&#10;It smelled pretty bad I can&#39;t focus...', 35, 58, '2024-04-28 21:13:46'),
(38, 'thx for answering!!&#13;&#10;', 35, 57, '2024-04-28 21:14:03'),
(39, 'Oh ok, I understand now. Thx for replying!&#13;&#10;', 35, 55, '2024-04-28 21:14:39'),
(40, 'It was me, sry', 37, 58, '2024-04-28 21:15:29'),
(41, 'this thread is gonna be removed soon...&#13;&#10;', 36, 58, '2024-04-28 21:16:00'),
(42, 'I founded it under the lecture stand, I&#39;m returning it now.', 35, 59, '2024-04-28 21:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf16;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `subject`, `message`, `email`, `created_at`) VALUES
(2, 'Help!', 'I can&#39;t find my laptop on room R.21 can you notify the students to find my laptop?', 'user2@gmail.com', '2024-04-28 21:17:16'),
(3, 'Where is the restroom near the west wing??', 'Hello, where is the restroom in the west wing of the college? pls reply soon thx!', 'user1@gmail.com', '2024-04-28 21:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf16;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `created`) VALUES
(1, 'Computing', '2024-04-23 21:19:24'),
(2, 'Pro Project Management', '2024-04-23 21:20:13'),
(3, 'UID Design', '2024-04-23 21:20:30'),
(4, 'General Discussion', '2024-04-28 21:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

DROP TABLE IF EXISTS `threads`;
CREATE TABLE IF NOT EXISTS `threads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `img` varchar(5028) DEFAULT NULL,
  `module_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fkuser` (`user_id`),
  KEY `fkmoduleid` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf16;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `name`, `description`, `img`, `module_id`, `user_id`, `created_at`) VALUES
(55, 'Question about tech', 'Hello, What is the difference between a software developer and a software engineer?', '/img/images.png', 1, 35, '2024-04-29 03:58:50'),
(56, 'What is the purpose of a CSS (Cascading Style Sheets) file in web development?', 'What is css used for in web? ', '/img/pexels-photo-1658967.jpeg', 1, 35, '2024-04-29 04:01:32'),
(57, ' What is the difference between agile and waterfall methodologies in software development?', 'Pls explain!', '/img/3607444.png', 2, 35, '2024-04-29 04:05:17'),
(58, 'General Discussion Thread', 'A thread for user to post discussion!', '/img/wallpaperflare.com_wallpaper.jpg', 4, 31, '2024-04-29 04:11:19'),
(59, 'Missing Laptop in room R.21!!', 'if any body see any abandoned laptop pls report to the school faculty. thanks!', '/img/wp9755174-artistic-building-pixel-art-wallpapers.jpg', 4, 38, '2024-04-29 04:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf16;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pass`, `created`, `is_admin`) VALUES
(31, 'long123', 'long@gmail.com', '$2y$10$kUe9ERGQgUchVG4giddFS.6Gkw5lNN6f/HEyzO.rduCfJ.JtwqbfW', '2024-04-28 19:55:22', 1),
(35, 'user1', 'user1@gmail.com', '$2y$10$hmx6THP.GMJRsk6zbncW5ejm.ngdyQIir9/RcXu/YQ4KlM8ZAfkuq', '2024-04-29 03:55:48', 0),
(36, 'user2', 'user2@gmail.com', '$2y$10$9/yaCTTygD4VMmcmSPjx7uMjq6Fp.aYNLWw6DjH2iFt71POaiAh.2', '2024-04-29 03:56:04', 0),
(37, 'user3', 'user3@gmail.com', '$2y$10$HsYyzdSZeIucR67IW5AJ8eq7S0H7OGPLPKLYUJzLf2iMZ4X5nnDJq', '2024-04-29 03:56:21', 0),
(38, 'admin1', 'admin1@gmail.com', '$2y$10$xT6i84JdrcnB2JY.fjU9nOINq.H8STPThgTbftDRXi5YXYRR14kDS', '2024-04-29 03:56:42', 1);

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

