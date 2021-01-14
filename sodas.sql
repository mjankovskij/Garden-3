-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2021 m. Sau 14 d. 09:25
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
  `quantity` int(11) NOT NULL,
  `willGrow` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Sukurta duomenų kopija lentelei `garden`
--

INSERT INTO `garden` (`id`, `type`, `img`, `quantity`, `willGrow`) VALUES
(1, 'Cucumber', '3', 2997, 11),
(2, 'Cucumber', '1', 2938, 10),
(3, 'Cucumber', '3', 2757, 19),
(4, 'Cucumber', '3', 2802, 17),
(5, 'Cucumber', '3', 2756, 10),
(6, 'Tomato', '3', 1013, 2),
(7, 'Tomato', '3', 1081, 6),
(8, 'Tomato', '3', 1136, 1),
(9, 'Tomato', '2', 908, 7),
(10, 'Tomato', '1', 1150, 2),
(11, 'Pepper', '2', 527, 4),
(12, 'Pepper', '3', 611, 3),
(13, 'Pepper', '3', 600, 1),
(14, 'Pepper', '2', 560, 3),
(15, 'Pepper', '1', 567, 1),
(16, 'Pepper', '3', 575, 4),
(17, 'Pepper', '3', 559, 3),
(18, 'Pepper', '1', 583, 2),
(19, 'Pepper', '1', 632, 5),
(20, 'Pepper', '3', 574, 1),
(21, 'Cucumber', '3', 2765, 18),
(22, 'Cucumber', '3', 2880, 16),
(23, 'Cucumber', '1', 2752, 19),
(24, 'Cucumber', '2', 2858, 15),
(25, 'Cucumber', '1', 1905, 16),
(26, 'Cucumber', '3', 494, 11),
(27, 'Cucumber', '3', 485, 11),
(28, 'Cucumber', '1', 467, 17),
(29, 'Cucumber', '2', 488, 12),
(30, 'Cucumber', '2', 441, 11),
(31, 'Cucumber', '1', 485, 10),
(32, 'Cucumber', '3', 523, 10),
(33, 'Cucumber', '3', 488, 18),
(34, 'Cucumber', '1', 482, 16),
(35, 'Cucumber', '3', 515, 20),
(36, 'Cucumber', '1', 499, 19),
(37, 'Cucumber', '3', 474, 16),
(38, 'Cucumber', '3', 496, 19),
(39, 'Cucumber', '1', 466, 11),
(40, 'Cucumber', '1', 479, 20),
(41, 'Cucumber', '3', 485, 17),
(42, 'Cucumber', '2', 465, 13),
(43, 'Cucumber', '1', 518, 19),
(44, 'Cucumber', '1', 491, 16),
(45, 'Cucumber', '1', 480, 13),
(46, 'Cucumber', '1', 486, 19),
(47, 'Cucumber', '1', 504, 14),
(48, 'Cucumber', '3', 434, 11),
(49, 'Cucumber', '3', 467, 12),
(50, 'Cucumber', '2', 469, 12),
(51, 'Tomato', '2', 123, 5),
(52, 'Tomato', '1', 157, 5),
(53, 'Tomato', '2', 144, 9),
(54, 'Tomato', '2', 157, 2),
(55, 'Tomato', '1', 154, 10),
(56, 'Tomato', '1', 141, 1),
(57, 'Tomato', '2', 161, 10),
(58, 'Tomato', '1', 156, 1),
(59, 'Tomato', '2', 121, 8),
(60, 'Tomato', '1', 169, 6),
(61, 'Tomato', '3', 136, 3),
(62, 'Tomato', '1', 167, 10),
(63, 'Tomato', '3', 138, 9),
(64, 'Tomato', '1', 161, 10),
(65, 'Pepper', '1', 82, 3),
(66, 'Pepper', '3', 77, 3),
(67, 'Pepper', '3', 90, 1),
(68, 'Pepper', '3', 69, 3),
(69, 'Pepper', '2', 94, 3),
(70, 'Cucumber', '1', 380, 18),
(71, 'Cucumber', '1', 380, 16),
(72, 'Cucumber', '1', 418, 13),
(73, 'Cucumber', '2', 383, 11),
(74, 'Cucumber', '1', 404, 20),
(75, 'Tomato', '3', 165, 3),
(76, 'Tomato', '3', 129, 4),
(77, 'Tomato', '2', 161, 9),
(78, 'Tomato', '3', 179, 4),
(79, 'Tomato', '1', 148, 6),
(80, 'Pepper', '3', 75, 4),
(81, 'Pepper', '2', 90, 5),
(82, 'Pepper', '1', 83, 3),
(83, 'Pepper', '2', 92, 4),
(84, 'Pepper', '2', 76, 4),
(85, 'Cucumber', '1', 364, 14),
(86, 'Cucumber', '1', 420, 15),
(87, 'Cucumber', '3', 379, 11),
(88, 'Cucumber', '3', 427, 15),
(89, 'Cucumber', '1', 406, 18),
(90, 'Tomato', '3', 143, 3),
(91, 'Tomato', '1', 33, 2),
(92, 'Tomato', '1', 153, 5),
(93, 'Tomato', '2', 32, 4),
(94, 'Tomato', '1', 138, 4),
(95, 'Pepper', '2', 71, 4),
(96, 'Pepper', '3', 77, 4),
(97, 'Pepper', '1', 82, 5),
(98, 'Pepper', '3', 81, 4),
(99, 'Pepper', '1', 87, 4),
(100, 'Pepper', '2', 59, 3),
(101, 'Cucumber', '1', 166, 16),
(102, 'Cucumber', '2', 153, 16),
(103, 'Cucumber', '2', 156, 17),
(104, 'Cucumber', '1', 159, 14),
(105, 'Cucumber', '2', 157, 17),
(106, 'Cucumber', '2', 146, 20),
(107, 'Tomato', '3', 15, 8),
(108, 'Tomato', '3', 35, 2),
(109, 'Tomato', '2', 20, 9),
(110, 'Tomato', '3', 15, 6),
(111, 'Tomato', '2', 17, 10),
(112, 'Cucumber', '3', 63, 20),
(113, 'Cucumber', '3', 64, 19),
(114, 'Cucumber', '2', 57, 19),
(115, 'Cucumber', '1', 73, 20),
(116, 'Cucumber', '2', 67, 12),
(117, 'Cucumber', '1', 59, 17),
(118, 'Cucumber', '1', 54, 15);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
