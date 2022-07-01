-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2022 at 05:38 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `athleticfitness`
--

-- --------------------------------------------------------

--
-- Table structure for table `coach`
--

CREATE TABLE `coach` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coach`
--

INSERT INTO `coach` (`id`, `name`, `address`, `phone`, `deleted_at`) VALUES
(1, 'Ilham', 'Tembokrejo No. 14', '081553600400\r\n', NULL),
(2, 'Anton S', 'Diponegoro 126', '0812312323', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `uid` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `usename` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `description` varchar(128) NOT NULL,
  `session_left` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `uid`, `name`, `usename`, `password`, `address`, `phone`, `description`, `session_left`, `created_at`, `deleted_at`) VALUES
(2, '100152', 'John Doe', '', '', 'Niaga 12', '0876767632323', '', 8, '2022-06-11 19:36:16', NULL),
(3, '100153', 'Mellina Audina', '', '', 'Wisata Bukit Mas 2 ', '081233232233', '', 0, '2022-06-12 00:37:52', NULL),
(4, '100154', 'Dhani', '', '', 'Panglima Sudirman 161', '081233323232', '', 16, '2022-06-12 09:17:54', NULL),
(5, '', 'Agus', '', '', 'Niaga 17', '08123323233', '', 0, '2022-06-13 10:47:59', '2022-06-13 11:01:37'),
(6, '100158', 'Agus', '', '', 'Niaga 17', '0812323233233', '', 0, '2022-06-13 11:01:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_payment`
--

CREATE TABLE `member_payment` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_payment`
--

INSERT INTO `member_payment` (`id`, `member_id`, `payment_id`) VALUES
(7, 4, 7),
(10, 2, 9),
(11, 4, 10),
(13, 4, 11),
(15, 2, 12),
(16, 4, 13);

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `uid` varchar(128) NOT NULL,
  `pricelist_id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deposited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `uid`, `pricelist_id`, `coach_id`, `total`, `created_at`, `deposited_at`, `deleted_at`) VALUES
(1, '', 5, 1, 250000, '2022-06-12 05:36:02', '2022-06-13 08:51:21', NULL),
(2, '', 5, 2, 250000, '2022-06-12 05:44:57', '2022-06-12 10:47:45', NULL),
(8, '1655093626', 7, 1, 0, NULL, NULL, NULL),
(9, '1655093661', 7, 1, 0, NULL, NULL, NULL),
(10, '1655098084', 7, 1, 0, NULL, NULL, NULL),
(11, '1655098409', 7, 1, 375000, '2022-06-13 12:43:46', '2022-06-13 22:40:19', NULL),
(12, '1655180495', 7, 1, 375000, '2022-06-14 11:22:15', '2022-06-14 11:34:26', NULL),
(13, '1655264309', 7, 1, 375000, '2022-06-15 10:38:39', '2022-06-15 10:38:56', NULL),
(14, '1656483182', 7, 2, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pricelist`
--

CREATE TABLE `pricelist` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `price` int(11) NOT NULL,
  `total_member` int(11) NOT NULL,
  `session_per_member` int(11) NOT NULL,
  `validity` int(11) NOT NULL COMMENT 'on Days',
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pricelist`
--

INSERT INTO `pricelist` (`id`, `name`, `price`, `total_member`, `session_per_member`, `validity`, `created_at`, `deleted_at`) VALUES
(1, 'Isidental Package', 80000, 1, 1, 1, '2022-06-11 19:59:10', '2022-06-12 00:00:00'),
(2, '4x', 250000, 1, 4, 30, '2022-06-12 00:00:00', '2022-06-12 00:00:00'),
(3, '8x', 375000, 1, 8, 30, '2022-06-12 00:00:00', '2022-06-12 04:47:28'),
(5, '4x Package', 250000, 1, 4, 30, '2022-06-12 09:49:21', NULL),
(6, 'Isidental', 80000, 1, 1, 1, '2022-06-13 09:06:46', NULL),
(7, '8x Package', 375000, 1, 8, 30, '2022-06-13 09:07:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '0 regular | 1 repeat',
  `scheduled_start` datetime NOT NULL,
  `scheduled_finish` datetime NOT NULL,
  `description` varchar(128) NOT NULL,
  `reference` int(11) DEFAULT NULL,
  `started_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `sport_id`, `coach_id`, `type`, `scheduled_start`, `scheduled_finish`, `description`, `reference`, `started_at`, `created_at`, `deleted_at`) VALUES
(1, 2, 2, 1, '2022-06-15 15:00:00', '2022-06-15 17:00:00', '', NULL, NULL, '2022-06-14 05:11:40', NULL),
(2, 1, 2, 0, '2022-06-15 17:00:00', '2022-06-15 19:00:00', '', NULL, NULL, '2022-06-12 17:00:00', '2022-06-29 11:39:10'),
(3, 1, 2, 1, '2022-06-15 17:00:00', '2022-06-15 19:00:00', '', NULL, NULL, '2022-06-12 17:00:00', NULL),
(4, 3, 2, 0, '2022-06-15 17:00:00', '2022-06-15 19:00:00', '', NULL, NULL, '2022-06-12 17:00:00', NULL),
(9, 1, 2, 0, '2022-06-29 17:00:00', '2022-06-29 19:00:00', '', 3, NULL, '2022-06-29 16:35:27', NULL),
(10, 2, 2, 0, '2022-06-29 15:00:00', '2022-06-29 17:00:00', '', 1, NULL, '2022-06-29 16:55:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sport`
--

CREATE TABLE `sport` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(128) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sport`
--

INSERT INTO `sport` (`id`, `name`, `description`, `deleted_at`) VALUES
(1, 'Muathay', '', NULL),
(2, 'Boxing', '', NULL),
(3, 'Mix Martial Art', '', NULL),
(4, 'Hapkido', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_payment`
--
ALTER TABLE `member_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricelist`
--
ALTER TABLE `pricelist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coach`
--
ALTER TABLE `coach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `member_payment`
--
ALTER TABLE `member_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `participant`
--
ALTER TABLE `participant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pricelist`
--
ALTER TABLE `pricelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sport`
--
ALTER TABLE `sport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
