-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2021 at 09:58 PM
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
  `Artwork_Name` varchar(32) NOT NULL,
  `Author_Name` varchar(32) NOT NULL,
  `Current_Owner_ID` int(11) NOT NULL,
  `Current_Owner_Name` varchar(32) NOT NULL,
  `Price` int(11) NOT NULL,
  `For_Sale` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `art_pecies`
--

INSERT INTO `art_pecies` (`Artwork_ID`, `Artwork_Name`, `Author_Name`, `Current_Owner_ID`, `Current_Owner_Name`, `Price`, `For_Sale`) VALUES
(12, 'Character Running', 'Andrej', 4, 'Andrej', 500, 1),
(13, 'LaserShot', 'Andrej', 4, 'Andrej', 500, 1);

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
  MODIFY `Artwork_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
