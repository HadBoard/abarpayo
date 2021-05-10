-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2021 at 10:16 AM
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
-- Table structure for table `tbl_shop_request`
--

CREATE TABLE `tbl_shop_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `access` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `confirmed_at` bigint(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_shop_request`
--

INSERT INTO `tbl_shop_request` (`id`, `user_id`, `category_id`, `reference_id`, `title`, `owner`, `address`, `access`, `created_at`, `confirmed_at`, `status`) VALUES
(2, 8, 9, NULL, 'شاپ', 'زکیه امیری', 'شیراز', 1, 1619941274, 1619943613, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_shop_request`
--
ALTER TABLE `tbl_shop_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_shop_request`
--
ALTER TABLE `tbl_shop_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
