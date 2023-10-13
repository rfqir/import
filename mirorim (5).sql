-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2023 at 03:35 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mirorim`
--

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `id_tracking` int(11) NOT NULL,
  `no_resi` varchar(50) NOT NULL,
  `admin` varchar(20) NOT NULL,
  `picking` varchar(20) NOT NULL,
  `box` varchar(20) NOT NULL,
  `checking` varchar(20) NOT NULL,
  `packing` varchar(20) NOT NULL,
  `dikurir` varchar(20) NOT NULL,
  `refaund` varchar(20) NOT NULL,
  `kelompok` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`id_tracking`, `no_resi`, `admin`, `picking`, `box`, `checking`, `packing`, `dikurir`, `refaund`, `kelompok`) VALUES
(2, 'GK-11-731912500', 'check', '', '', '', '', '', '', 'C'),
(3, 'GK-11-731909017', 'check', '', '', '', '', '', '', 'A'),
(4, 'GK-11-731912260', 'check', '', '', '', '', '', '', 'A'),
(5, 'GK-11-731912261', 'check', '', '', '', '', '', '', 'C'),
(6, 'kepolu', 'check', '', '', '', '', '', '', 'B'),
(7, 'GK-11-731907478', 'check', '', '', '', '', '', '', 'C'),
(8, '10007853591635', 'check', '', '', '', '', '', '', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`id_tracking`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `id_tracking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
