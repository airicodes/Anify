-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2021 at 06:02 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

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
  `anime_rating` int(11) DEFAULT NULL,
  `anime_studio` varchar(30) NOT NULL,
  `anime_genre` varchar(30) NOT NULL,
  `picture_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anime`
--

INSERT INTO `anime` (`anime_id`, `anime_name`, `anime_creator`, `anime_date`, `anime_description`, `anime_episodes`, `anime_status`, `anime_rating`, `anime_studio`, `anime_genre`, `picture_link`) VALUES
(1, 'One Piece', 'Eiichiro Oda', '1999-10-20', 'Yeah, it\'s aight.', 1001, 'Ongoing', NULL, 'Toei Animation', 'Adventure', '/uploads/61a6a0aadfdaf.png'),
(2, 'Steins;Gate', 'Jukki Hanada', '2021-11-01', 'Nothing can get better than this.', 24, 'Finished', NULL, 'White Fox', 'Science', '/uploads/61a6b6f403f85.jpg'),
(3, 'Naruto', 'Kishimoto', '2021-02-16', 'Almost as good as one piece', 600, 'Finished', NULL, 'Mappa', 'Action', '/uploads/61a6b7809be30.jpg'),
(4, 'Hunter x Hunter', 'Togashi', '2021-10-31', 'Hunter x Hunter is one of the best anime of all time because it is made by one of the best mangaka of all time. It follows the story of Gon that is looking for his father. In order to find his father, he must become a hunter. He is also super cute and small.', 140, 'On Pause', NULL, 'Mappa', 'Adventure', '/uploads/61a6e87be9a34.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `animelist`
--

DROP TABLE IF EXISTS `animelist`;
CREATE TABLE `animelist` (
  `animelist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animelist`
--

INSERT INTO `animelist` (`animelist_id`, `user_id`) VALUES
(1, 29),
(3, 36),
(4, 37),
(5, 38),
(7, 40);

-- --------------------------------------------------------

--
-- Table structure for table `anime_in_list`
--

DROP TABLE IF EXISTS `anime_in_list`;
CREATE TABLE `anime_in_list` (
  `anime_id` int(11) NOT NULL,
  `animelist_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `watching_status` varchar(20) NOT NULL,
  `favorite` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anime_in_list`
--

INSERT INTO `anime_in_list` (`anime_id`, `animelist_id`, `rating`, `watching_status`, `favorite`) VALUES
(3, 1, 5, 'watching', 'n'),
(1, 4, 0, 'Watching', 'y'),
(3, 4, 0, 'Finished', 'n'),
(2, 1, 6, 'Planning', 'y'),
(1, 7, 0, 'Planning', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT utc_timestamp(),
  `read_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `sender`, `receiver`, `message`, `timestamp`, `read_status`) VALUES
(4, 38, 37, 'hi', '2021-12-06 04:37:42', 'unread'),
(5, 38, 37, 'olah', '2021-12-06 04:37:49', 'unread'),
(6, 38, 37, 'im so done', '2021-12-06 04:37:56', 're read'),
(7, 29, 37, 'Hello', '2021-12-06 06:03:06', 'unread'),
(9, 29, 37, 'Hello vince', '2021-12-06 06:45:40', 'unread'),
(10, 29, 37, 'hello v', '2021-12-06 07:52:43', 'unread');

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

--
-- Dumping data for table `post_like`
--

INSERT INTO `post_like` (`post_like_id`, `user_id`, `profile_post_id`) VALUES
(48, 38, 4);

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
(3, 11, 'aaaaera', '/uploads/61aec11111cd4.png'),
(4, 12, 'No bio yet...', '/uploads/defaultAvatar.png'),
(5, 13, 'No bio yet...', '/uploads/defaultAvatar.png'),
(8, 16, 'Ali Zoubeidi was here', '/uploads/defaultAvatar.png'),
(10, 17, 'asdf', '/uploads/61a5b490d5064.jpg'),
(18, 27, 'asdf', '/uploads/defaultAvatar.png'),
(24, 29, 'Hi.', '/uploads/61ab0fa489f64.png'),
(27, 36, 'No bio yet...', '/uploads/defaultAvatar.png'),
(28, 37, 'JERBEAR IS GAY', '/uploads/defaultAvatar.png'),
(29, 38, 'Vince', '/uploads/defaultAvatar.png'),
(31, 40, 'No bio yet...', '/uploads/defaultAvatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `profile_post`
--

DROP TABLE IF EXISTS `profile_post`;
CREATE TABLE `profile_post` (
  `profile_post_id` int(11) NOT NULL,
  `post` text NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile_post`
--

INSERT INTO `profile_post` (`profile_post_id`, `post`, `date`, `user_id`) VALUES
(4, 'Lisa is my queen', '2021-12-04', 37),
(9, 'hello', '2021-12-05', 37),
(10, 'heloo', '2021-12-05', 29),
(11, 'my name is jeremie guerchon', '2021-12-05', 29);

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
(11, 'Jeremieea', '$2y$10$.jHKBRPadup9L0L/qa8vi.7.9eMUZowjFR7zO21SssVZiX7PhsNp6', 'regular'),
(12, 'Vincent', '$2y$10$KzoArnqS9FwGBdLoYolli.N1ya68SksdUKvWgZut5vTpASBc7EEwW', 'regular'),
(13, 'Jerbear', '$2y$10$t4ustspM3eXgCiHcqc843.FrotG81PElSwejN8eF.l9JbOPgZZw1W', 'regular'),
(16, 'c', '$2y$10$oDFrcAeRadTzpMayFV2PtOIjJQhh6pgZORcPSxG7DubaUQxufhdne', 'regular'),
(17, 'zaaaaaaaaaaaaaaaaaa', '$2y$10$hpxBHu1dAwpy1YVE5pto6eAWfT3LXofYi1IeCE.NKJywFA1f6RLQ6', 'regular'),
(27, 'aliab', '$2y$10$D0PouWBVVSiW5Ig81z/Es.Er3tpD7u1zdb2XgiXQqkDhc4/MTtmIK', 'admin'),
(29, 'airi', '$2y$10$vAgq7KKdDWY58zjamt3N3eIYMcON3WZqjNfJUFZdTOVez0OBfp8Te', 'admin'),
(36, 'airii', '$2y$10$zUXSie1vSXAVL3xSkNULfeuNOGEEznu8gO5r7q0BYBBkZBtTjjWoW', 'regular'),
(37, 'v', '$2y$10$wBCZKRI2JmcfJtpdyMVyze3mAKXW6pUx4roz/wS97KKjR/KX.mYuu', 'regular'),
(38, 'vincebry', '$2y$10$Ov3GUIbH.Ne0h/qwCB34vOD1QD/mUybOv3gw8cufT3F7uS4Ao4.x6', 'regular'),
(40, 'airiairi', '$2y$10$l1YxKHmAqY.jB91bpfblJe7k2soKqfEzWyH3LnXjOS95ZlhXwohKq', 'regular');

-- --------------------------------------------------------

--
-- Table structure for table `user_review`
--

DROP TABLE IF EXISTS `user_review`;
CREATE TABLE `user_review` (
  `user_review_id` int(11) NOT NULL,
  `review` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `anime_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_review`
--

INSERT INTO `user_review` (`user_review_id`, `review`, `user_id`, `anime_id`) VALUES
(2, 'a', 40, 1);

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
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sender_user_id` (`sender`),
  ADD KEY `receiver_user_id` (`receiver`);

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
  MODIFY `anime_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `animelist`
--
ALTER TABLE `animelist`
  MODIFY `animelist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `post_like`
--
ALTER TABLE `post_like`
  MODIFY `post_like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `profile_post`
--
ALTER TABLE `profile_post`
  MODIFY `profile_post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user_review`
--
ALTER TABLE `user_review`
  MODIFY `user_review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animelist`
--
ALTER TABLE `animelist`
  ADD CONSTRAINT `to_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `anime_in_list`
--
ALTER TABLE `anime_in_list`
  ADD CONSTRAINT `animeinlist_to_anime` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`anime_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `animeinlist_to_animelist` FOREIGN KEY (`animelist_id`) REFERENCES `animelist` (`animelist_id`) ON DELETE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `receiver_user_id` FOREIGN KEY (`receiver`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `sender_user_id` FOREIGN KEY (`sender`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `post_like`
--
ALTER TABLE `post_like`
  ADD CONSTRAINT `postlike_to_profilepost` FOREIGN KEY (`profile_post_id`) REFERENCES `profile_post` (`profile_post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `postlike_to_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

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
