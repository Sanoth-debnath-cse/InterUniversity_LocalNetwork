-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2019 at 06:18 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_network`
--
CREATE DATABASE IF NOT EXISTS `social_network` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `social_network`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(225) NOT NULL,
  `comment_author` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `post_id`, `user_id`, `comment`, `comment_author`, `date`) VALUES
(1, 383, 32, '            \r\n            ', 'Sanoth Debnath', '2019-01-26 16:52:59'),
(2, 383, 32, '            \r\n            hi', 'Sanoth Debnath', '2019-01-26 16:53:23'),
(3, 383, 32, '', 'Sanoth Debnath', '2019-01-26 16:56:56'),
(4, 382, 31, 'adh', 'Sanoth Debnath', '2019-01-26 16:59:20'),
(5, 382, 31, '            ', 'Sanoth Debnath', '2019-01-26 17:12:57'),
(6, 382, 31, 'fuck u', 'Sanoth Debnath', '2019-01-26 17:20:18'),
(7, 384, 33, 'panna ke to khaye dilo.kS', 'Fardin islam', '2019-01-26 18:43:57'),
(8, 384, 33, 'what?', 'Sanoth Debnath', '2019-01-26 21:44:30'),
(9, 387, 34, 'hello', 'Sujon', '2019-01-27 06:25:14'),
(10, 388, 36, 'ki obasta?', 'Jahin', '2019-01-27 06:54:26'),
(11, 389, 37, 'gd morning..', 'Azharul islam', '2019-01-27 06:57:48'),
(12, 379, 28, 'valo..', 'Azharul islam', '2019-01-27 06:58:04'),
(13, 390, 38, 'oh', 'shohan', '2019-01-27 07:50:19'),
(14, 389, 37, 'good morning\r\n', 'Sanoth Debnath', '2019-01-28 05:20:42'),
(15, 391, 27, 'kokhon?', 'Sanoth Debnath', '2019-01-28 05:52:08'),
(16, 391, 27, '11 tai xm suru..@sanothdebnath', 'shohan', '2019-01-28 05:58:29'),
(17, 392, 39, 'hi..', 'ab', '2019-01-28 06:21:14'),
(18, 392, 39, 'fhfdytfhf', 'ab', '2019-01-28 06:26:21'),
(19, 392, 39, 'hhhhhhhhhhhhhhhhhhhhhhhhhh', 'ab', '2019-01-28 06:26:45'),
(20, 392, 39, 'hi..', 'Sanoth Debnath', '2019-02-02 12:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `msg_sub` text NOT NULL,
  `msg_topic` text NOT NULL,
  `reply` text NOT NULL,
  `status` text NOT NULL,
  `msg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `sender`, `receiver`, `msg_sub`, `msg_topic`, `reply`, `status`, `msg_date`) VALUES
(1, '33', '27', 'problem', 'hi', 'no_reply', 'read', '2019-02-02 17:47:07'),
(2, '33', '27', 'problem', 'hi', 'no_reply', 'read', '2019-02-02 17:46:19'),
(3, '33', '27', 'problem', 'hi', 'no_reply', 'read', '2019-02-02 17:46:15'),
(4, '33', '27', 'problem', 'hi', 'no_reply', 'read', '2019-02-02 17:42:06'),
(16, '28', '27', 'problem', 'kal cls ase?', 'yes', 'read', '2019-02-02 18:11:34'),
(17, '27', '28', 'class', 'koitai cls suru?', '9 tai...', 'read', '2019-02-02 18:13:47'),
(18, '27', '29', 'study', 'MAT LAB download korchis?', 'YES', 'read', '2019-02-02 18:23:23'),
(19, '31', '27', '...', 'kemon achis?', 'valo tui..?', 'read', '2019-02-02 22:35:55'),
(20, '36', '27', 'study', 'project show koita thake?', '11 ta thake.....', 'read', '2019-02-03 05:01:25'),
(21, '39', '27', 'study', 'hello', 'hello', 'read', '2019-02-03 06:38:58');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `topic_id`, `post_content`, `post_date`) VALUES
(379, 28, 0, 'ki khobor?', '2019-01-18 09:28:28'),
(381, 30, 0, 'onek pora baki....', '2019-01-18 09:33:52'),
(387, 34, 0, 'hello everyone?\r\n???', '2019-01-27 05:20:56'),
(388, 36, 0, 'hello bondhura?', '2019-01-27 06:24:51'),
(389, 37, 0, 'Good morning...!', '2019-01-27 06:54:12'),
(391, 27, 0, 'aj exam...', '2019-01-28 05:51:51'),
(393, 29, 0, 'kal project show...', '2019-02-02 22:31:30');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(50) NOT NULL,
  `sender_id` int(50) NOT NULL,
  `receiver_id` int(50) NOT NULL,
  `count` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `sender_id`, `receiver_id`, `count`) VALUES
(34, 27, 28, 'yes'),
(35, 27, 29, 'no'),
(36, 27, 39, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(225) NOT NULL,
  `describe_user` varchar(225) NOT NULL,
  `Relationship` varchar(225) NOT NULL,
  `user_pass` varchar(225) NOT NULL,
  `user_email` varchar(225) NOT NULL,
  `user_country` text NOT NULL,
  `user_gender` text NOT NULL,
  `user_birthday` text NOT NULL,
  `user_image` text NOT NULL,
  `user_reg_date` text NOT NULL,
  `status` text NOT NULL,
  `ver_code` int(100) NOT NULL,
  `posts` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `describe_user`, `Relationship`, `user_pass`, `user_email`, `user_country`, `user_gender`, `user_birthday`, `user_image`, `user_reg_date`, `status`, `ver_code`, `posts`) VALUES
(27, 'Sanoth Debnath', 'is my name.I am a student of PSTU.', 'Single', 'sanothsanoth', 'sanoth@gmail.com', 'Bangladesh', 'Male', '1996-11-10', 'pic.jpg', '2019-01-18 15:16:43', 'verified', 1191983675, 'yes'),
(28, 'Nazmus sakib', 'is my name.I am a student of PSTU.', '.......', 'sakibsakib', 'sakib@gmail.com', 'Bangladesh', 'Male', '2005-01-11', '21318951_1532167473509543_8064925813403864688_o.jpg', '2019-01-18 15:27:24', 'verified', 475874921, 'yes'),
(29, 'Azharul islam', 'is my name.I am a student of PSTU.', '.......', 'azharulazharul', 'azharul@gmail.com', 'Bangladesh', 'Male', '2010-01-11', '42654703_2026089397449386_8404979925706080256_n.jpg', '2019-01-18 15:30:39', 'verified', 31642727, 'yes'),
(30, 'Tamim', 'is my name.I am a student of PSTU.', '.......', 'tamimtamim', 'tamim@gmail.com', 'Bangladesh', 'Male', '1900-01-11', '49342420_1031301247076893_852651158303408128_n.jpg', '2019-01-18 15:33:10', 'verified', 1168276273, 'yes'),
(31, 'Rifat Akash', 'is my name.I am a student of PSTU.', 'In a Relationship', 'akashakash', 'akash@gmail.com', 'Bangladesh', 'Male', '2015-10-29', '50580503_2307000459529910_6309425636360323072_n.jpg', '2019-01-21 16:32:59', 'verified', 704425669, 'yes'),
(33, 'Fardin islam', 'is my name.I am a student of PSTU.', 'Married', 'fardinfardin', 'fardin@gmail.com', 'Bangladesh', 'Male', '2012-12-24', '28279290_159873321479484_7251632807335705349_n.jpg', '2019-01-27 00:41:01', 'verified', 115115278, 'yes'),
(34, 'Monir nayon', 'is my name.I am a student of PSTU.', 'Engaged', 'nayonnayon', 'nayon@gmail.com', 'Bangladesh', 'Male', '2012-01-17', '33379607_405076253328553_788956479771115520_n.jpg', '2019-01-27 11:20:16', 'verified', 201734197, 'yes'),
(35, 'Surajit', 'is my name.I am a student of PSTU.', '.......', 'surajitsurajit', 'surajit@gmail.com', 'USA', 'Male', '2019-01-07', '47172456_1267261316748022_2001964228956651520_n.jpg', '2019-01-27 11:28:48', 'verified', 1033647610, 'no'),
(36, 'Sujon', 'is my name.I am a student of PSTU.', 'In a Relationship', 'sujonsujon', 'sujon@gmail.com', 'Bangladesh', 'Male', '2018-12-30', '17098676_1912318605669110_1141988951036927981_n.jpg', '2019-01-27 12:24:20', 'verified', 1789210315, 'yes'),
(37, 'Jahin', 'is my name.I am a student of PSTU.', '.......', 'jahinjahin', 'jahin@gmail.com', 'Bangladesh', 'Male', '2017-01-03', '49321413_2043661395715983_1683968608457195520_n.jpg', '2019-01-27 12:51:33', 'verified', 711573617, 'yes'),
(38, 'shohan', 'is my name.I am a student of PSTU.', 'Complicated', 'shohanshohan', 'shohan@gmail.com', 'China', 'Male', '2012-12-18', '21318951_1532167473509543_8064925813403.jpg', '2019-01-27 13:47:57', 'verified', 789024971, 'yes'),
(39, 'sir', 'is my name.I am a student of PSTU.', '.......', '12345678', 'sir@gmail.com', 'Bangladesh', 'Male', '2019-02-05', '', '2019-02-03 12:27:29', 'verified', 1129474365, 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=394;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
