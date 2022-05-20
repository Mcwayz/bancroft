-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2021 at 12:54 PM
-- Server version: 10.6.5-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bancroft_music`
--
CREATE DATABASE IF NOT EXISTS `bancroft_music` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `bancroft_music`;

-- --------------------------------------------------------

--
-- Table structure for table `Artist_tbl`
--

CREATE TABLE `Artist_tbl` (
  `artist_id` int(11) NOT NULL,
  `artist_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `artist_desc` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Artist_tbl`
--

INSERT INTO `Artist_tbl` (`artist_id`, `artist_name`, `contact_no`, `artist_desc`) VALUES
(1, 'Fresh Ice', '0970002440', 'Kelvin Musankabala A.K.A Fresh Ice is a Zambian based artist who was born and rised in the Copperbelt,  he spent most of his time growing up in Chililabombwe.');

-- --------------------------------------------------------

--
-- Table structure for table `Music_tbl`
--

CREATE TABLE `Music_tbl` (
  `song_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `song_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `song_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `song_details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `song_type` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `upload_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `downloads` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Pic_tbl`
--

CREATE TABLE `Pic_tbl` (
  `pic_id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  `pic_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `User_tbl`
--

CREATE TABLE `User_tbl` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `User_tbl`
--

INSERT INTO `User_tbl` (`user_id`, `username`, `user_email`, `user_role`, `user_password`) VALUES
(1, 'Muj Dollar', 'admin@bancroft.com', 'admin', 'admin@bancroft');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Artist_tbl`
--
ALTER TABLE `Artist_tbl`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `Music_tbl`
--
ALTER TABLE `Music_tbl`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `Music_tbl_ibfk_1` (`artist_id`),
  ADD KEY `Music_tbl_ibfk_2` (`user_id`);

--
-- Indexes for table `Pic_tbl`
--
ALTER TABLE `Pic_tbl`
  ADD PRIMARY KEY (`pic_id`),
  ADD KEY `Pic_tbl_ibfk_1` (`song_id`);

--
-- Indexes for table `User_tbl`
--
ALTER TABLE `User_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Artist_tbl`
--
ALTER TABLE `Artist_tbl`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Music_tbl`
--
ALTER TABLE `Music_tbl`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Pic_tbl`
--
ALTER TABLE `Pic_tbl`
  MODIFY `pic_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `User_tbl`
--
ALTER TABLE `User_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Music_tbl`
--
ALTER TABLE `Music_tbl`
  ADD CONSTRAINT `Music_tbl_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `Artist_tbl` (`artist_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Music_tbl_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `User_tbl` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Pic_tbl`
--
ALTER TABLE `Pic_tbl`
  ADD CONSTRAINT `Pic_tbl_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `Music_tbl` (`song_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
