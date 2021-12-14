-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 10:44 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `Transaction_ID` int(11) NOT NULL,
  `Buyer_ID` int(11) NOT NULL,
  `Seller_ID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `Transaction_Amount` int(11) NOT NULL,
  `Time_Stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`Transaction_ID`, `Buyer_ID`, `Seller_ID`, `Product_ID`, `Transaction_Amount`, `Time_Stamp`) VALUES
(1, 11, 10, 15, 300, '0000-00-00 00:00:00'),
(2, 11, 8, 20, 500, '2021-12-14 20:52:00'),
(3, 11, 10, 17, 550, '2021-12-14 20:52:57'),
(4, 4, 11, 15, 300, '2021-12-14 20:55:08'),
(5, 4, 10, 18, 500, '2021-12-14 21:06:45'),
(6, 4, 11, 20, 500, '2021-12-14 21:08:23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_ID` int(11) NOT NULL,
  `User_Name` varchar(32) NOT NULL,
  `Hashed_Password` varchar(64) NOT NULL,
  `Currency_Balance` int(11) NOT NULL,
  `Owned_Art_Amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_ID`, `User_Name`, `Hashed_Password`, `Currency_Balance`, `Owned_Art_Amount`) VALUES
(2, 'FirstUser', 'dea0f8ca08684ebffa9cb6359fad87d6f3f0e4b16f7bf560beb7c88c7b264006', 0, 0),
(3, 'SecondUser', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0, 0),
(4, 'Andrej', 'e6a0562f152a42eb11a80b0218a4758818a9948e2dcd3ff7d0813a3492f5df69', 3100, 7),
(5, 'SuperUser', '35cc3e8e38bb83615bdfeda41b3ae42528080cca11a6f7bf9470e61c1918b1fb', 100, 0),
(6, 'CrazyUser', '8ab239e195fa6c3102654e335c1b0369e7a9f63c9928b8183e8cd84e80bbfe5b', 100, 0),
(7, 'QuirkyUser', 'd5e7e2e07c7c87d88d00ccb223828e30e31f138a82b18e59d606a822fb548500', 100, 0),
(8, 'Jonas', 'c530d68060b5f707cc2d3520bedac876c18b68d1bca56bca4a5d884607f83cc6', 7600, 1),
(9, 'Jonas@!', '94ee921db8e533b706883ee3923db9df23e5146ba5ad39a957d959c131567f13', 100, 0),
(10, 'HackerMan', '4ba1fb0ea117d92ba4e3a24b96431089825db2a4bbcbffad1bbfb92d9c0a2176', 10100, 0),
(11, 'FisherMan', '2836bfabff610c7570da9460d2d6153115c76b259b3dc8f5d5f2c598d8ee9630', 8600, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `art_pecies`
--
ALTER TABLE `art_pecies`
  ADD PRIMARY KEY (`Artwork_ID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`Transaction_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `art_pecies`
--
ALTER TABLE `art_pecies`
  MODIFY `Artwork_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `Transaction_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
