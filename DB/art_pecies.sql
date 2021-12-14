-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 10:37 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arttradedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `art_pecies`
--

CREATE TABLE `art_pecies` (
  `Artwork_ID` int(11) NOT NULL,
  `Name_On_Server` varchar(64) NOT NULL,
  `Artwork_Name` varchar(32) NOT NULL,
  `Author_Name` varchar(32) NOT NULL,
  `Current_Owner_ID` int(11) NOT NULL,
  `Current_Owner_Name` varchar(32) NOT NULL,
  `Price` int(11) NOT NULL,
  `For_Sale` tinyint(1) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `art_pecies`
--

INSERT INTO `art_pecies` (`Artwork_ID`, `Name_On_Server`, `Artwork_Name`, `Author_Name`, `Current_Owner_ID`, `Current_Owner_Name`, `Price`, `For_Sale`, `upload_date`) VALUES
(12, 'art_pecies/12.png', 'Character Running', 'Andrej', 11, 'Andrej', 500, 1, '2021-12-14 20:49:11'),
(13, 'art_pecies/13.png', 'LaserShot', 'Andrej', 4, 'Andrej', 500, 1, '2021-12-14 17:51:06'),
(15, 'art_pecies/14.png', 'Pistol Jump', 'Andrej', 4, 'Andrej', 300, 1, '2021-12-14 20:55:08'),
(16, 'art_pecies/16.png', 'Bot No Arm', 'Andrej', 11, 'Andrej', 450, 1, '2021-12-14 20:48:33'),
(17, 'art_pecies/17.png', 'Sword Dash', 'Andrej', 11, 'Andrej', 550, 1, '2021-12-14 20:52:57'),
(18, 'art_pecies/18.png', 'mano', 'Jonas', 4, 'Jonas', 500, 1, '2021-12-14 21:06:45'),
(19, 'art_pecies/19.png', 'man', 'Jonas', 8, 'Jonas', 500, 1, '2021-12-14 17:51:06'),
(20, 'art_pecies/20.png', 'manaaaa', 'Jonas', 4, 'Jonas', 500, 1, '2021-12-14 21:08:23'),
(27, 'art_pecies/21.png', 'BAWS', 'Andrej', 4, 'Andrej', 1000, 1, '2021-12-14 21:10:49'),
(28, 'art_pecies/28.png', 'Alibaba Intelligence', 'Andrej', 4, 'Andrej', 700, 1, '2021-12-14 21:18:21'),
(29, 'art_pecies/29.png', 'HamdCmpoter', 'Andrej', 4, 'Andrej', 650, 1, '2021-12-14 21:22:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `art_pecies`
--
ALTER TABLE `art_pecies`
  ADD PRIMARY KEY (`Artwork_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `art_pecies`
--
ALTER TABLE `art_pecies`
  MODIFY `Artwork_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
