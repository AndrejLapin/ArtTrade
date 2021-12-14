-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 09:53 PM
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
(4, 'Andrej', 'e6a0562f152a42eb11a80b0218a4758818a9948e2dcd3ff7d0813a3492f5df69', 3400, 0),
(5, 'SuperUser', '35cc3e8e38bb83615bdfeda41b3ae42528080cca11a6f7bf9470e61c1918b1fb', 100, 0),
(6, 'CrazyUser', '8ab239e195fa6c3102654e335c1b0369e7a9f63c9928b8183e8cd84e80bbfe5b', 100, 0),
(7, 'QuirkyUser', 'd5e7e2e07c7c87d88d00ccb223828e30e31f138a82b18e59d606a822fb548500', 100, 0),
(8, 'Jonas', 'c530d68060b5f707cc2d3520bedac876c18b68d1bca56bca4a5d884607f83cc6', 7600, 0),
(9, 'Jonas@!', '94ee921db8e533b706883ee3923db9df23e5146ba5ad39a957d959c131567f13', 100, 0),
(10, 'HackerMan', '4ba1fb0ea117d92ba4e3a24b96431089825db2a4bbcbffad1bbfb92d9c0a2176', 9600, 0),
(11, 'FisherMan', '2836bfabff610c7570da9460d2d6153115c76b259b3dc8f5d5f2c598d8ee9630', 7800, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
