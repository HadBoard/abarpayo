-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2021 at 01:39 PM
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
-- Table structure for table `tbl_shop_admin`
--

CREATE TABLE `tbl_shop_admin` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `first_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `national_code` varchar(20) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `birthday` bigint(20) NOT NULL,
  `last_login` bigint(20) DEFAULT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_shop_admin`
--

INSERT INTO `tbl_shop_admin` (`id`, `shop_id`, `first_name`, `last_name`, `phone`, `username`, `password`, `national_code`, `postal_code`, `birthday`, `last_login`, `created_at`, `updated_at`, `status`) VALUES
(2, 5, 'دانیال', 'قاسمی', '09138525201', 'mr', '1234', '0023407247', '', 0, 1620549147, 1620287548, 1620289237, 1),
(3, 48, 'هدیه', 'مکی', '09030933038', 'hadiye', '123', '0023407247', '', 0, NULL, 1620561312, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_shop_admin`
--
ALTER TABLE `tbl_shop_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_shop_admin`
--
ALTER TABLE `tbl_shop_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
