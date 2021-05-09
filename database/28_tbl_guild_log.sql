-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2021 at 09:50 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hamitech`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guild_log`
--

CREATE TABLE `tbl_guild_log` (
  `id` int(11) NOT NULL,
  `guild_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `ip` int(11) NOT NULL,
  `admin_view` int(11) NOT NULL,
  `view` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_guild_log`
--

INSERT INTO `tbl_guild_log` (`id`, `guild_id`, `shop_id`, `action_id`, `ip`, `admin_view`, `view`, `created_at`) VALUES
(1, 2, 0, 1, 0, 0, 1, 1620375853),
(2, 2, 5, 1, 0, 0, 0, 1620546108);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_guild_log`
--
ALTER TABLE `tbl_guild_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_guild_log`
--
ALTER TABLE `tbl_guild_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
