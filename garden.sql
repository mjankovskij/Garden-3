-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2021 m. Sau 05 d. 22:33
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sodas`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `garden`
--

CREATE TABLE `garden` (
  `id` int(11) NOT NULL,
  `type` text COLLATE utf8_bin NOT NULL,
  `img` text COLLATE utf8_bin NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Sukurta duomenų kopija lentelei `garden`
--

INSERT INTO `garden` (`id`, `type`, `img`, `count`) VALUES
(2, 'cucumber', '2', 87),
(4, 'tomato', '1', 42),
(6, 'tomato', '3', 27),
(8, 'cucumber', '1', 106),
(9, 'cucumber', '3', 111),
(10, 'tomato', '3', 38),
(12, 'tomato', '2', 20),
(16, 'pepper', '2', 22),
(20, 'pepper', '3', 24),
(21, 'pepper', '3', 20),
(22, 'pepper', '1', 16),
(24, 'cucumber', '1', 104),
(25, 'cucumber', '2', 101),
(26, 'cucumber', '3', 104),
(27, 'tomato', '1', 37),
(29, 'tomato', '3', 37),
(30, 'pepper', '1', 19),
(31, 'pepper', '3', 25),
(32, 'pepper', '2', 25),
(33, 'tomato', '2', 55),
(34, 'tomato', '1', 27),
(36, 'cucumber', '2', 100),
(37, 'cucumber', '3', 93),
(42, 'pepper', '1', 19),
(44, 'pepper', '1', 18),
(45, 'pepper', '3', 13),
(46, 'pepper', '2', 11),
(47, 'pepper', '1', 15),
(48, 'cucumber', '3', 60),
(51, 'cucumber', '1', 49),
(52, 'pepper', '3', 18),
(53, 'pepper', '3', 13),
(54, 'pepper', '2', 15),
(56, 'pepper', '1', 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `garden`
--
ALTER TABLE `garden`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `garden`
--
ALTER TABLE `garden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
