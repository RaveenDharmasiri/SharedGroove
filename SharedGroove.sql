-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2020 at 01:09 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SharedGroove`
--

-- --------------------------------------------------------

--
-- Table structure for table `Contact`
--

CREATE TABLE `Contact` (
  `contactId` int(11) NOT NULL,
  `contactName` varchar(60) NOT NULL,
  `contactEmail` varchar(60) NOT NULL,
  `contactTelephoneNo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Contact`
--

INSERT INTO `Contact` (`contactId`, `contactName`, `contactEmail`, `contactTelephoneNo`) VALUES
(28, 'sadsd', 'sdasdasd', 711909627),
(29, 'Raveen Dharmasiri', 'raveen.dharmasiri@gmail.com', 711090637),
(31, 'Anjula', 'anjula@email.com', 961234564);

-- --------------------------------------------------------

--
-- Table structure for table `ContactTag`
--

CREATE TABLE `ContactTag` (
  `contactTagId` int(11) NOT NULL,
  `tagType` varchar(10) NOT NULL,
  `contactId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ContactTag`
--

INSERT INTO `ContactTag` (`contactTagId`, `tagType`, `contactId`) VALUES
(1, 'Friends', 28),
(2, 'Friends', 29),
(3, 'Work', 29),
(4, 'Family', 29),
(6, 'Friends', 31),
(7, 'Family', 31);

-- --------------------------------------------------------

--
-- Table structure for table `Post`
--

CREATE TABLE `Post` (
  `postId` int(11) NOT NULL,
  `postContent` varchar(1000) NOT NULL,
  `creatorEmail` varchar(60) NOT NULL,
  `postTimestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Post`
--

INSERT INTO `Post` (`postId`, `postContent`, `creatorEmail`, `postTimestamp`) VALUES
(30, 'Hello World 3 ', 'anjularatnayaka@gmail.com', '2019-11-24 23:21:48'),
(31, 'My name is  <a href=\'http://example.com\'>http://example.com</a>. My age is  <a href=\'https://www.google.com/\'>https://www.google.com/</a> and my profile pic is  <br><img style=\'width:160px\' src=\'https://www.qries.com/images/banner_logo.png\'/> <br>', 'anjularatnayaka@gmail.com', '2019-11-24 23:27:21'),
(32, 'My name is  <a href=\'http://example.com\'>http://example.com</a>. My age is  <a href=\'https://www.google.com/\'>https://www.google.com/</a> and my profile pic is  <br><img style=\'width:160px\' src=\'https://www.qries.com/images/banner_logo.png\'/> <br>', 'raveen.dharmasiri@gmail.com', '2019-11-24 23:28:40'),
(33, 'Hello World - Raveen ', 'raveen.dharmasiri@gmail.com', '2019-11-24 23:29:13'),
(34, ' <br><img style=\'width:160px\' src=\'https://media.giphy.com/media/NVBR6cLvUjV9C/giphy.gif\'/> <br>', 'raveen.dharmasiri@gmail.com', '2019-11-24 23:32:00'),
(35, ' <br><img style=\'width:160px\' src=\'https://media.giphy.com/media/NVBR6cLvUjV9C/giphy.gif\'/> <br>', 'raveen.dharmasiri@gmail.com', '2019-11-24 23:47:46'),
(36, 'Hello!! My name is Lex Luthor ', 'lex@gmail.com', '2019-11-25 01:04:42'),
(37, 'Hello This is my second post ', 'lex@gmail.com', '2019-11-25 01:07:10'),
(38, ' Hello.....\r\n\r\n<br><img style=\'width:160px\' src=\'https://media.giphy.com/media/NVBR6cLvUjV9C/giphy.gif\'/> <br>', 'raveen.dharmasiri@gmail.com', '2019-12-31 06:56:45');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `profilePicture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`userId`, `firstName`, `lastName`, `email`, `password`, `profilePicture`) VALUES
(1, 'Raveen', 'Dharmasiri', 'raveen.dharmasiri@gmail.com', '$2y$10$g2a10jYGKgZZ6G4h6mxt8u5mw33R6R9UkVEF70Rwrty4g46Lh7AlC', 'uploads/IMAG0115_1_14.jpg'),
(15, 'Jason', 'Todd', 'jason.Todd@gmail.com', '$2y$10$g2a10jYGKgZZ6G4h6mxt8u5mw33R6R9UkVEF70Rwrty4g46Lh7AlC', 'uploads/jason_todd.jpg'),
(20, 'Clark', 'Kent', 'clark.kent@gmail.com', '$2y$10$g2a10jYGKgZZ6G4h6mxt8u5mw33R6R9UkVEF70Rwrty4g46Lh7AlC', 'uploads/clark_kent.png'),
(21, 'Bruce', 'Wayne', 'bruce.wayne@gmail.com', '$2y$10$g2a10jYGKgZZ6G4h6mxt8u5mw33R6R9UkVEF70Rwrty4g46Lh7AlC', 'uploads/batman.png'),
(22, 'Anjula', 'Rathnayaka', 'anjula.rathnayaka@gmail.com', '$2y$10$g2a10jYGKgZZ6G4h6mxt8u5mw33R6R9UkVEF70Rwrty4g46Lh7AlC', 'uploads/RaveenD_(2)-1.jpg'),
(23, 'Anjala', 'Botejue', 'anjala.botejue@gmail.com', '$2y$10$g2a10jYGKgZZ6G4h6mxt8u5mw33R6R9UkVEF70Rwrty4g46Lh7AlC', 'uploads/IMG-20170522-WA0012.jpg'),
(24, 'Lois', 'Lane', 'lois.lane@gmail.com', '$2y$10$g2a10jYGKgZZ6G4h6mxt8u5mw33R6R9UkVEF70Rwrty4g46Lh7AlC', 'uploads/lois_lane.png'),
(27, 'Lex', 'Luthor', 'lex@gmail.com', '$2y$10$g2a10jYGKgZZ6G4h6mxt8u5mw33R6R9UkVEF70Rwrty4g46Lh7AlC', 'uploads/lex_luthor1.png'),
(28, 'Jonathen', 'Kent', 'jon.kent@gmail.com', '$2y$10$NwelHE.d.TPN54NuSjdaau3PBZNwTaOp7.XI.oh8L42uw2zPp5R4y', 'uploads/jon_kent.png'),
(29, 'Anjula', 'Ratnayaka', 'anjularatnayaka@gmail.com', '$2y$10$GzWHSx5appWNdDVsXI0DHOBeV13x2wB4Ma7Lp1/7tsf9lMecSAps6', 'uploads/lex_luthor.png');

-- --------------------------------------------------------

--
-- Table structure for table `UserFollowing`
--

CREATE TABLE `UserFollowing` (
  `userFollowingId` int(11) NOT NULL,
  `mainUser` varchar(60) NOT NULL,
  `followingUser` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `UserFollowing`
--

INSERT INTO `UserFollowing` (`userFollowingId`, `mainUser`, `followingUser`) VALUES
(1, 'raveen.dharmasiri@gmail.com', 'clark.kent@gmail.com'),
(2, 'raveen.dharmasiri@gmail.com', 'bruce.wayne@gmail.com'),
(3, 'raveen.dharmasiri@gmail.com', 'anjula.rathnayaka@gmail.com'),
(4, 'anjula.rathnayaka@gmail.com', 'raveen.dharmasiri@gmail.com'),
(5, 'clark.kent@gmail.com', 'raveen.dharmasiri@gmail.com'),
(6, 'anjala.botejue@gmail.com', 'raveen.dharmasiri@gmail.com'),
(15, 'raveen.dharmasiri@gmail.com', 'jason.Todd@gmail.com'),
(24, 'raveen.dharmasiri@gmail.com', 'lex@gmail.com'),
(25, 'lex@gmail.com', 'raveen.dharmasiri@gmail.com'),
(26, 'anjularatnayaka@gmail.com', 'jason.Todd@gmail.com'),
(27, 'anjularatnayaka@gmail.com', 'raveen.dharmasiri@gmail.com'),
(35, 'lex@gmail.com', 'clark.kent@gmail.com'),
(36, 'lex@gmail.com', 'bruce.wayne@gmail.com'),
(37, 'lex@gmail.com', 'lois.lane@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `UserGenre`
--

CREATE TABLE `UserGenre` (
  `userGenreId` int(11) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `genreType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `UserGenre`
--

INSERT INTO `UserGenre` (`userGenreId`, `userEmail`, `genreType`) VALUES
(4, 'jason.Todd@gmail.com', 'Jazz'),
(5, 'jason.Todd@gmail.com', 'Disco'),
(6, 'jason.Todd@gmail.com', 'Rock'),
(7, 'clark.kent@gmail.com', 'Techno'),
(8, 'clark.kent@gmail.com', 'Disco'),
(9, 'clark.kent@gmail.com', 'Rock'),
(11, 'raveen.dharmasiri@gmail.com', 'Jazz'),
(12, 'clark.kent@gmail.com', 'Jazz'),
(13, 'bruce.wayne@gmail.com', 'Jazz'),
(14, 'raveen.dharmasiri@gmail.com', 'Rock'),
(15, 'raveen.dharmasiri@gmail.com', 'Disco'),
(16, 'anjula.rathnayaka@gmail.com', 'Disco'),
(17, 'anjala.botejue@gmail.com', 'Techno'),
(18, 'lois.lane@gmail.com', 'Jazz'),
(19, 'lois.lane@gmail.com', 'Techno'),
(20, 'lois.lane@gmail.com', 'Rock'),
(25, 'lex@gmail.com', 'Techno'),
(26, 'jon.kent@gmail.com', 'Techno'),
(27, 'jon.kent@gmail.com', 'Disco'),
(28, 'jon.kent@gmail.com', 'Rock'),
(29, 'anjularatnayaka@gmail.com', 'Disco');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Contact`
--
ALTER TABLE `Contact`
  ADD PRIMARY KEY (`contactId`);

--
-- Indexes for table `ContactTag`
--
ALTER TABLE `ContactTag`
  ADD PRIMARY KEY (`contactTagId`),
  ADD KEY `contactId` (`contactId`);

--
-- Indexes for table `Post`
--
ALTER TABLE `Post`
  ADD PRIMARY KEY (`postId`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `UserFollowing`
--
ALTER TABLE `UserFollowing`
  ADD PRIMARY KEY (`userFollowingId`);

--
-- Indexes for table `UserGenre`
--
ALTER TABLE `UserGenre`
  ADD PRIMARY KEY (`userGenreId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Contact`
--
ALTER TABLE `Contact`
  MODIFY `contactId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `ContactTag`
--
ALTER TABLE `ContactTag`
  MODIFY `contactTagId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Post`
--
ALTER TABLE `Post`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `UserFollowing`
--
ALTER TABLE `UserFollowing`
  MODIFY `userFollowingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `UserGenre`
--
ALTER TABLE `UserGenre`
  MODIFY `userGenreId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ContactTag`
--
ALTER TABLE `ContactTag`
  ADD CONSTRAINT `contacttag_ibfk_1` FOREIGN KEY (`contactId`) REFERENCES `Contact` (`contactId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
