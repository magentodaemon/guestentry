-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2019 at 08:57 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guestentry`
--

-- --------------------------------------------------------

--
-- Table structure for table `entry`
--

CREATE TABLE `entry` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `entry`
--

INSERT INTO `entry` (`id`, `title`, `type`, `detail`, `is_approved`) VALUES
(1, 'testsadfsf', 'image', '1552634873_IDAA_YDG 313_YA_EN_C1.jpg', 0),
(2, 'asasf', 'text', 'asfafss', 0),
(5, 'tes5ffsds 555', 'text', 'safdsasdfsf 555', 0),
(8, 'ZXCZX', 'text', 'adfasdf', 0),
(9, 'adsfads', 'text', 'sadfsda', 0),
(10, 'asdfads', 'text', 'adsf', 0),
(11, 'ASDsASDasd', 'text', 'sdf', 0),
(12, 'sdfsdfdf', 'image', '1552634996_INAA_YDM3109 SIL_YA_EN_C3 - .jpg', 0),
(14, 'sdfgdsfg', 'image', '1552636270_C_Certified_Home_Safe_Yale_YSM_250_EG1.jpg', 0),
(15, 'sadfsdaf', 'image', '1552564281_download.jpg', 0),
(16, 'sadfasdf', 'text', 'asdfsadf', 0),
(17, 'asdfsadf', 'image', '1552564393_CNIR_YDM4109_YA_EN_C1.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190308062500', '2019-03-08 06:25:24'),
('20190309133545', '2019-03-09 13:36:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entry`
--
ALTER TABLE `entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entry`
--
ALTER TABLE `entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
