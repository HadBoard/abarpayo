-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2021 at 01:40 PM
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
-- Table structure for table `tbl_guild_ticket`
--

CREATE TABLE `tbl_guild_ticket` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `type` int(11) NOT NULL,
  `viwe` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `solve` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  `solved_at` bigint(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_guild_ticket`
--

INSERT INTO `tbl_guild_ticket` (`id`, `shop_id`, `subject`, `text`, `type`, `viwe`, `admin_id`, `solve`, `created_at`, `updated_at`, `solved_at`, `status`) VALUES
(1, 5, 'تست', 'النا', 1, 0, 0, 0, 1620683996, 0, 0, 0),
(2, 5, 'تست', 'تست', 2, 0, 0, 0, 1620684649, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_guild_ticket`
--
ALTER TABLE `tbl_guild_ticket`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_guild_ticket`
--
ALTER TABLE `tbl_guild_ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
