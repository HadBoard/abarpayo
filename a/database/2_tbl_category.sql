-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2021 at 07:24 AM
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
-- Database: `hamitech`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `ord` int(11) NOT NULL,
  `updated_at` bigint(20) DEFAULT NULL,
  `created_at` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `icon`, `ord`, `updated_at`, `created_at`, `status`) VALUES
(3, 'رستوران و فست فود', '5fHdFrPynp.png', 1, NULL, 1618636414, 1),
(4, 'تفریحی ورزشی', 'zbtXllvBCE.png', 2, NULL, 1618636550, 1),
(5, 'سلامتی و پزشکی', 'beub5mKk0n.png', 3, NULL, 1618636573, 0),
(6, 'هنر و تئاتر', 'PqG29w86V2.png', 4, NULL, 1618636629, 1),
(7, 'آموزش', '0jkeIdtM8G.png', 5, NULL, 1618636650, 1),
(8, 'زیبایی و آرایشی', 'MazeXzGZT9.png', 6, NULL, 1618636688, 1),
(9, 'تور و سفر', 'QFQFZ2thQX.png', 7, NULL, 1618636711, 1),
(10, 'خدمات', 'YjbrAdVojJ.png', 8, 1618636995, 1618636741, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
