-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 87.229.6.116
-- Generation Time: Mar 29, 2023 at 01:28 PM
-- Server version: 8.0.32-0ubuntu0.20.04.2
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Game2Racker`
--
CREATE DATABASE IF NOT EXISTS `Game2Racker` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci;
USE `Game2Racker`;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `parentID` int DEFAULT '0',
  `madeBy` int NOT NULL,
  `madeOn` int NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` varchar(6000) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratingTable`
--

CREATE TABLE `ratingTable` (
  `id` int NOT NULL,
  `ratedThing` int NOT NULL,
  `ratedBy` int NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `rating` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratios`
--

CREATE TABLE `ratios` (
  `id` int NOT NULL,
  `commentID` int NOT NULL,
  `userID` int NOT NULL,
  `ratio` tinyint(1) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int NOT NULL,
  `userID` int NOT NULL,
  `active` tinyint(1) NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_hungarian_ci NOT NULL,
  `acquired` datetime NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nev` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci DEFAULT 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png',
  `email` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `jelszo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `madeBy` (`madeBy`);

--
-- Indexes for table `ratingTable`
--
ALTER TABLE `ratingTable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratedUser` (`ratedThing`),
  ADD KEY `ratedBy` (`ratedBy`);

--
-- Indexes for table `ratios`
--
ALTER TABLE `ratios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentID` (`commentID`,`userID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratingTable`
--
ALTER TABLE `ratingTable`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratios`
--
ALTER TABLE `ratios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`madeBy`) REFERENCES `users` (`id`);

--
-- Constraints for table `ratingTable`
--
ALTER TABLE `ratingTable`
  ADD CONSTRAINT `ratingTable_ibfk_1` FOREIGN KEY (`ratedBy`) REFERENCES `users` (`id`);

--
-- Constraints for table `ratios`
--
ALTER TABLE `ratios`
  ADD CONSTRAINT `ratios_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ratios_ibfk_3` FOREIGN KEY (`commentID`) REFERENCES `comment` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
