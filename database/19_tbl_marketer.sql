-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2021 at 02:22 PM
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
-- Table structure for table `tbl_marketer`
--

CREATE TABLE `tbl_marketer` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `package_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `reference_code` varchar(50) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `national_code` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) DEFAULT NULL,
  `payment_type` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_marketer`
--

INSERT INTO `tbl_marketer` (`id`, `first_name`, `last_name`, `phone`, `package_id`, `payment_id`, `reference_code`, `reference_id`, `national_code`, `status`, `created_at`, `updated_at`, `payment_type`) VALUES
(8, 'زکیه', 'امیری', '09130898272', 1, 0, 'U5kafh', 0, '876543', 1, 1619351593, 1619351598, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_marketer`
--
ALTER TABLE `tbl_marketer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_marketer`
--
ALTER TABLE `tbl_marketer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
