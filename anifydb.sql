-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2021 at 11:48 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anifydb`
--
CREATE DATABASE IF NOT EXISTS `anifydb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `anifydb`;

-- --------------------------------------------------------

--
-- Table structure for table `anime`
--

DROP TABLE IF EXISTS `anime`;
CREATE TABLE `anime` (
  `anime_id` int(11) NOT NULL,
  `anime_name` varchar(100) NOT NULL,
  `anime_creator` varchar(30) NOT NULL,
  `anime_date` date NOT NULL,
  `anime_description` text NOT NULL,
  `anime_episodes` int(11) NOT NULL,
  `anime_status` varchar(20) NOT NULL,
  `anime_rating` int(11) NOT NULL,
  `anime_studio` varchar(30) NOT NULL,
  `anime_genre` varchar(30) NOT NULL,
  `picture_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `animelist`
--

DROP TABLE IF EXISTS `animelist`;
CREATE TABLE `animelist` (
  `animelist_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `anime_in_list`
--

DROP TABLE IF EXISTS `anime_in_list`;
CREATE TABLE `anime_in_list` (
  `anime_id` int(11) NOT NULL,
  `animelist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `favoritanime`
--

DROP TABLE IF EXISTS `favoritanime`;
CREATE TABLE `favoritanime` (
  `favoriteanime_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `anime_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post_like`
--

DROP TABLE IF EXISTS `post_like`;
CREATE TABLE `post_like` (
  `post_like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bio` varchar(140) NOT NULL,
  `filename` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `user_id`, `bio`, `filename`) VALUES
(3, 11, 'No bio yet...', '/uploads/defaultAvatar.png'),
(4, 12, 'No bio yet...', '/uploads/defaultAvatar.png'),
(5, 13, 'No bio yet...', '/uploads/defaultAvatar.png'),
(8, 16, 'Ali Zoubeidi was here', '/uploads/defaultAvatar.png'),
(10, 17, 'No bio yet...', '/uploads/defaultAvatar.png'),
(14, 24, 'No bio yet...', '/uploads/defaultAvatar.png'),
(18, 27, 'asdfasdf', '/uploads/61a549b6949eb.png');

-- --------------------------------------------------------

--
-- Table structure for table `profile_post`
--

DROP TABLE IF EXISTS `profile_post`;
CREATE TABLE `profile_post` (
  `profile_post_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `hash` text NOT NULL,
  `role` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `hash`, `role`) VALUES
(11, 'Jeremie', '$2y$10$.jHKBRPadup9L0L/qa8vi.7.9eMUZowjFR7zO21SssVZiX7PhsNp6', 'regular'),
(12, 'Vincent', '$2y$10$KzoArnqS9FwGBdLoYolli.N1ya68SksdUKvWgZut5vTpASBc7EEwW', 'regular'),
(13, 'Jerbear', '$2y$10$t4ustspM3eXgCiHcqc843.FrotG81PElSwejN8eF.l9JbOPgZZw1W', 'regular'),
(16, 'c', '$2y$10$oDFrcAeRadTzpMayFV2PtOIjJQhh6pgZORcPSxG7DubaUQxufhdne', 'regular'),
(17, 'z', '$2y$10$hpxBHu1dAwpy1YVE5pto6eAWfT3LXofYi1IeCE.NKJywFA1f6RLQ6', 'regular'),
(22, 'ass', '$2y$10$Wheen4aBXvDPeOrsT/JEn.DbtukVUPuuVhqTp5/X9DuVfUqqLzHl2', 'regular'),
(24, 'ali1', '$2y$10$Pxq4cmB/8CDbPdQlIquFh.dWVJnmRoricKhoz7BAKPhPY8u1p8BCq', 'regular'),
(27, 'alia', '$2y$10$D0PouWBVVSiW5Ig81z/Es.Er3tpD7u1zdb2XgiXQqkDhc4/MTtmIK', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_review`
--

DROP TABLE IF EXISTS `user_review`;
CREATE TABLE `user_review` (
  `user_review_id` int(11) NOT NULL,
  `review` varchar(1000) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `anime_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anime`
--
ALTER TABLE `anime`
  ADD PRIMARY KEY (`anime_id`);

--
-- Indexes for table `animelist`
--
ALTER TABLE `animelist`
  ADD PRIMARY KEY (`animelist_id`),
  ADD KEY `to_user_id_fk` (`user_id`);

--
-- Indexes for table `anime_in_list`
--
ALTER TABLE `anime_in_list`
  ADD KEY `animeinlist_to_anime` (`anime_id`),
  ADD KEY `animeinlist_to_animelist` (`animelist_id`);

--
-- Indexes for table `favoritanime`
--
ALTER TABLE `favoritanime`
  ADD PRIMARY KEY (`favoriteanime_id`),
  ADD KEY `favoriteanime_to_anime` (`anime_id`),
  ADD KEY `favoriteanime_to_user` (`user_id`);

--
-- Indexes for table `post_like`
--
ALTER TABLE `post_like`
  ADD PRIMARY KEY (`post_like_id`),
  ADD KEY `postlike_to_user` (`user_id`),
  ADD KEY `postlike_to_profilepost` (`profile_post_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `profile_to_user` (`user_id`);

--
-- Indexes for table `profile_post`
--
ALTER TABLE `profile_post`
  ADD PRIMARY KEY (`profile_post_id`),
  ADD KEY `profilepost_to_user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_review`
--
ALTER TABLE `user_review`
  ADD PRIMARY KEY (`user_review_id`),
  ADD KEY `userreview_to_anime` (`anime_id`),
  ADD KEY `userreview_to_user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anime`
--
ALTER TABLE `anime`
  MODIFY `anime_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `animelist`
--
ALTER TABLE `animelist`
  MODIFY `animelist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favoritanime`
--
ALTER TABLE `favoritanime`
  MODIFY `favoriteanime_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_like`
--
ALTER TABLE `post_like`
  MODIFY `post_like_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `profile_post`
--
ALTER TABLE `profile_post`
  MODIFY `profile_post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_review`
--
ALTER TABLE `user_review`
  MODIFY `user_review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animelist`
--
ALTER TABLE `animelist`
  ADD CONSTRAINT `to_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `anime_in_list`
--
ALTER TABLE `anime_in_list`
  ADD CONSTRAINT `animeinlist_to_anime` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`anime_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `animeinlist_to_animelist` FOREIGN KEY (`animelist_id`) REFERENCES `animelist` (`animelist_id`);

--
-- Constraints for table `favoritanime`
--
ALTER TABLE `favoritanime`
  ADD CONSTRAINT `favoriteanime_to_anime` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`anime_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoriteanime_to_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `post_like`
--
ALTER TABLE `post_like`
  ADD CONSTRAINT `postlike_to_profilepost` FOREIGN KEY (`profile_post_id`) REFERENCES `profile_post` (`profile_post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `postlike_to_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_to_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `profile_post`
--
ALTER TABLE `profile_post`
  ADD CONSTRAINT `profilepost_to_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_review`
--
ALTER TABLE `user_review`
  ADD CONSTRAINT `userreview_to_anime` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`anime_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `userreview_to_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
