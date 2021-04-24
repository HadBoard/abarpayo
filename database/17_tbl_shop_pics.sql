-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2021 at 11:49 AM
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
-- Table structure for table `tbl_shop_pics`
--

CREATE TABLE `tbl_shop_pics` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_shop_pics`
--

INSERT INTO `tbl_shop_pics` (`id`, `shop_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, '0qmMiJLEK6.jpg', 1619257282, 0),
(2, 2, '0qmMiJLEK6.jpg', 1619257282, 0),
(3, 3, '0qmMiJLEK6.jpg', 1619257282, 0),
(4, 4, '0qmMiJLEK6.jpg', 1619257282, 0),
(5, 5, '0qmMiJLEK6.jpg', 1619257282, 0),
(6, 6, '0qmMiJLEK6.jpg', 1619257282, 0),
(7, 7, '0qmMiJLEK6.jpg', 1619257282, 0),
(8, 8, '0qmMiJLEK6.jpg', 1619257282, 0),
(9, 9, '0qmMiJLEK6.jpg', 1619257282, 0),
(10, 10, '0qmMiJLEK6.jpg', 1619257282, 0),
(11, 11, '0qmMiJLEK6.jpg', 1619257282, 0),
(12, 12, '0qmMiJLEK6.jpg', 1619257282, 0),
(13, 13, '0qmMiJLEK6.jpg', 1619257282, 0),
(14, 14, '0qmMiJLEK6.jpg', 1619257282, 0),
(15, 15, '0qmMiJLEK6.jpg', 1619257282, 0),
(16, 16, '0qmMiJLEK6.jpg', 1619257282, 0),
(17, 17, '0qmMiJLEK6.jpg', 1619257282, 0),
(18, 18, '0qmMiJLEK6.jpg', 1619257282, 0),
(19, 19, '0qmMiJLEK6.jpg', 1619257282, 0),
(20, 20, '0qmMiJLEK6.jpg', 1619257282, 0),
(21, 21, '0qmMiJLEK6.jpg', 1619257282, 0),
(22, 22, '0qmMiJLEK6.jpg', 1619257282, 0),
(23, 23, '0qmMiJLEK6.jpg', 1619257282, 0),
(24, 24, '0qmMiJLEK6.jpg', 1619257282, 0),
(25, 25, '0qmMiJLEK6.jpg', 1619257282, 0),
(26, 26, '0qmMiJLEK6.jpg', 1619257282, 0),
(27, 27, '0qmMiJLEK6.jpg', 1619257282, 0),
(28, 28, '0qmMiJLEK6.jpg', 1619257282, 0),
(29, 29, '0qmMiJLEK6.jpg', 1619257282, 0),
(30, 30, '0qmMiJLEK6.jpg', 1619257282, 0),
(31, 31, '0qmMiJLEK6.jpg', 1619257282, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_shop_pics`
--
ALTER TABLE `tbl_shop_pics`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_shop_pics`
--
ALTER TABLE `tbl_shop_pics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
