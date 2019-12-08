-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 08, 2019 at 12:42 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ad-posting-site`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `name` varchar(255) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `expiration` date DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `price` float NOT NULL DEFAULT 0,
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`name`, `description`, `expiration`, `views`, `price`, `id`, `user_id`, `created_at`) VALUES
('Bmw 330d', 'Bmw 330d geras.', '2020-03-25', 11, 2500, 116, 2, '2019-12-08 10:44:11'),
('Toyota yaris', 'Gera toyota yaris.', '2020-04-24', 1, 6000, 117, 2, '2019-12-08 10:45:46'),
('Volkswagen Passat 2.8 l.', '2,8l 142kw 4motion VW Passat 2000m tvarkingas iš Voketijos.T.A 2021m.Lietuvoje neeksplotuotas,daug privalumų.', '2019-12-26', 40, 1550, 120, 2, '2019-12-08 10:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `message` varchar(255) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`message`, `id`, `user_id`, `ad_id`, `created_at`, `comment_id`) VALUES
('Gera masina', 32, 2, 120, '2019-12-08 11:09:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `link` varchar(255) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`link`, `id`, `ad_id`) VALUES
('116/1575801851.jpeg', 28, 116),
('117/1575801946.jpg', 29, 117),
('120/15758024130.jpg', 36, 120),
('120/15758024131.jpg', 37, 120),
('120/15758024142.jpg', 38, 120);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_Roles` int(11) NOT NULL,
  `NAME` char(9) COLLATE utf8_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_Roles`, `NAME`) VALUES
(1, 'User'),
(2, 'Admin'),
(3, 'Moderator');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_lithuanian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `role` int(11) DEFAULT 1,
  `mobile_number` varchar(20) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `create_ad` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `mobile_number`, `remember_token`, `created_at`, `updated_at`, `create_ad`) VALUES
(2, 'Justas', 'justaskarpis@gmail.com', NULL, '$2y$10$Q6RySmiesjMT.cP5hjj/Fujx0YjQntb7cox1gFoMjW9ClKjUljOPi', 1, '860516247', 'x47t5YaBzmVoEwM5u0B60VyWaoltUQp7rSAkGuwTwD9pcQ4Jw5Bcm0Zz1zzG', '2019-11-09 18:52:28', '2019-12-07 09:17:09', 1),
(3, 'asd', 'tomas@gmail.com', NULL, '$2y$10$Jcm2CQgICFPBb1r2cC42her/BAbmALS4cQnG7NFYNZiySIOje0o2C', 1, NULL, NULL, '2019-11-10 05:38:27', '2019-11-10 05:38:27', 0),
(4, 'Geras', 'geras@gmail.com', NULL, '$2y$10$WECM35ncutNlh8nJ1s5kZexzm8dyuJ9bkrVUCn1ytvlLp1RxC.cVu', 1, NULL, NULL, '2019-11-10 05:40:49', '2019-11-10 05:40:49', 0),
(5, 'asfasf', 'asfasf@gmail.com', NULL, '$2y$10$aw/xmECwVF6XcJNALNY7L.1.UH9VB7GNLytFHUW4..dCj5TNmNk8G', 1, 'asfasfas', NULL, '2019-11-10 05:42:55', '2019-11-10 05:42:55', 0),
(6, 'fasfasf', 'fffsaf@gmail.com', NULL, '$2y$10$TphcZnv9f9HvCpXfcqhSSOVkTLzzw0CNuVVBDh4YPKawcgCuboHxa', 1, NULL, NULL, '2019-11-10 07:43:43', '2019-11-10 07:43:43', 0),
(7, 'asdffasfsafasffas', 'asfsfafssfs@gmail.com', NULL, '$2y$10$vtrSTwU2QpsioViyhJw11.qauN9Deodo/BAkVVtiwDX28lIdOrlXG', 1, '860516327', NULL, '2019-11-10 07:45:20', '2019-11-10 07:45:20', 0),
(8, 'asfasffasf', 'sfffffffff@gmail.com', NULL, '$2y$10$i7hI9A/VZ8WbbSZ2vhisL.aO4/nP5DQzwRvtGnPicLsWh44MsiG0q', 1, '860516327', NULL, '2019-11-10 07:47:22', '2019-11-10 07:47:22', 0),
(9, 'Naujas', 'naujas@gmail.com', NULL, '$2y$10$njtM8i4SnUo8CVWF.6J/WON5pYksVNvseWNl7A3BMYvu6Aq1MW2va', 1, '86461654', NULL, '2019-11-11 05:47:32', '2019-11-11 05:47:32', 0),
(10, 'asfasfasf', 'gfasfas@gmail.com', NULL, '$2y$10$.cUOoAeeek4Rtb.Hr1IVBO0WnF.x2vyNN736kcRF9XFEq8xzcmQS2', 1, '551955', NULL, '2019-11-11 08:37:35', '2019-11-11 08:37:35', 0),
(11, 'User', 'user@gmail.com', NULL, '$2y$10$y6I02WvgKy9LXPACXkkLBOjUj50HmGCccoj4bCKppE/pfcLy.vp3i', 2, '860516327', NULL, '2019-11-18 08:38:31', '2019-11-18 08:38:31', 0),
(12, 'admin', 'admin@admin.lt', NULL, '$2y$10$fkaFsuNP7iAov1bK21DiGuHLye2CL/gaEa/xZwQjRqH7eJqpdNevu', 2, '868542321', 'BlxkFNIq8I7Qq7Pf6j1e2nTZLkpLUYHeD50MVjQ1oWjKdyePEPJvuRrGxix7', '2019-12-07 08:50:55', '2019-12-07 08:50:55', 0),
(13, 'moderatorius', 'mod@mod.lt', NULL, '$2y$10$O1DqUrhQjuVLT86/pKiYFOZ8GJPjL1G3Tr9NGZ/8ITHPo1KzdxUn2', 3, '8605163287', NULL, '2019-12-08 09:40:36', '2019-12-08 09:40:36', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creates` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `writes` (`user_id`),
  ADD KEY `have2` (`ad_id`),
  ADD KEY `have3` (`comment_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `have` (`ad_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_Roles`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_Roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `creates` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `have2` FOREIGN KEY (`ad_id`) REFERENCES `ads` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `have3` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `writes` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `have` FOREIGN KEY (`ad_id`) REFERENCES `ads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`id_Roles`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
