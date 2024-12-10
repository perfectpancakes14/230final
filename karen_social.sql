-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 05:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `karen_social`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(10) UNSIGNED NOT NULL,
  `postID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `contents` varchar(250) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `postID`, `userID`, `contents`, `date_time`) VALUES
(18, 15, 9, 'This is a comment', '2024-12-10 05:15:58'),
(19, 18, 9, 'Hello!', '2024-12-10 05:18:32'),
(20, 19, 2, 'Lorem Ipsum', '2024-12-10 05:20:16'),
(21, 19, 9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2024-12-10 05:21:19');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `contents` varchar(500) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `userID`, `title`, `contents`, `date_time`) VALUES
(15, 9, 'This is a post', 'This is part of a post', '2024-12-10 05:15:43'),
(16, 9, 'This is also a post', 'This post is better than the other one', '2024-12-10 05:16:29'),
(17, 9, 'Look, yet another post', 'I edited this one', '2024-12-10 05:17:11'),
(18, 1, 'Hello World!', 'Hi', '2024-12-10 05:18:07'),
(19, 2, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2024-12-10 05:19:55'),
(20, 1, 'Lorem Ipsum', 'Lorem ipsum odor amet, consectetuer adipiscing elit. Maximus ornare aptent commodo senectus sit odio inceptos lacus. Urna accumsan mattis sem dignissim vel. Ad sit eget metus sodales senectus tempor nascetur. Sapien a netus dictum odio interdum a hac. At dictum vehicula ad montes; ante suspendisse. Aliquam velit duis ipsum ullamcorper tempus class diam augue.', '2024-12-10 05:22:34'),
(21, 1, 'Hey, I found another post!', 'Lorem Ipsum', '2024-12-10 05:23:06'),
(24, 2, 'Lorem Ipsum 4', 'Lorem ipsum odor amet, consectetuer adipiscing elit. Viverra velit lacinia inceptos sollicitudin sapien vestibulum at montes risus. Condimentum id per quam fames non sit magnis sagittis. Donec risus eleifend vivamus senectus scelerisque felis. Sociosqu varius conubia nascetur suscipit dignissim vel mauris porta. Bibendum himenaeos quis libero cras sem dictum. Vehicula taciti eleifend ornare metus lacus viverra sociosqu curabitur. Luctus sociosqu efficitur netus inceptos tristique amet convallis.', '2024-12-10 05:25:43'),
(26, 2, 'test', 'test', '2024-12-10 05:39:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstName` varchar(64) DEFAULT NULL,
  `lastName` varchar(64) DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `email`, `password`, `firstName`, `lastName`, `isAdmin`) VALUES
(1, 'daviesm4@mymail.nku.edu', 'Filler123', 'David-Michael', 'Davies', 0),
(2, 'frondorfm2@mymail.nku.edu', 'Filler123', 'Emery', 'Frondorf', 1),
(9, 'wattsl6@mymail.nku.edu', 'Filler123', 'Logan', 'Watts', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_r_comments`
--

CREATE TABLE `users_r_comments` (
  `ID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `commentID` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_r_comments`
--

INSERT INTO `users_r_comments` (`ID`, `userID`, `commentID`, `date`) VALUES
(23, 9, 18, '2024-12-10'),
(24, 1, 19, '2024-12-10'),
(25, 2, 20, '2024-12-10'),
(26, 9, 20, '2024-12-10'),
(27, 9, 21, '2024-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `users_r_posts`
--

CREATE TABLE `users_r_posts` (
  `ID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `postID` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_r_posts`
--

INSERT INTO `users_r_posts` (`ID`, `userID`, `postID`, `date`) VALUES
(21, 9, 16, '2024-12-10'),
(22, 9, 18, '2024-12-10'),
(23, 1, 16, '2024-12-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`,`postID`,`userID`),
  ADD KEY `postID` (`postID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`,`userID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_r_comments`
--
ALTER TABLE `users_r_comments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `commentID` (`commentID`),
  ADD KEY `commentID_2` (`commentID`);

--
-- Indexes for table `users_r_posts`
--
ALTER TABLE `users_r_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `postID` (`postID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users_r_comments`
--
ALTER TABLE `users_r_comments`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users_r_posts`
--
ALTER TABLE `users_r_posts`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_r_comments`
--
ALTER TABLE `users_r_comments`
  ADD CONSTRAINT `users_r_comments_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `users_r_comments_ibfk_2` FOREIGN KEY (`commentID`) REFERENCES `comments` (`commentID`);

--
-- Constraints for table `users_r_posts`
--
ALTER TABLE `users_r_posts`
  ADD CONSTRAINT `users_r_posts_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `users_r_posts_ibfk_2` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
