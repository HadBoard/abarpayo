-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 10, 2021 at 03:44 PM
-- Server version: 10.3.28-MariaDB-cll-lve
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `netstep_faralms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_province`
--

CREATE TABLE `tbl_province` (
  `id` int(12) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `cdate` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_province`
--

INSERT INTO `tbl_province` (`id`, `name`, `status`, `cdate`) VALUES
(1, 'آذربايجان شرقي', 1, 0),
(2, 'آذربايجان غربي', 1, 0),
(3, 'اردبيل', 1, 0),
(4, 'اصفهان', 1, 0),
(5, 'البرز', 1, 0),
(6, 'ايلام', 1, 0),
(7, 'بوشهر', 1, 0),
(8, 'تهران', 1, 0),
(9, 'چهارمحال بختياري', 1, 0),
(10, 'خراسان جنوبي', 1, 0),
(11, 'خراسان رضوي', 1, 0),
(12, 'خراسان شمالي', 1, 0),
(13, 'خوزستان', 1, 0),
(14, 'زنجان', 1, 0),
(15, 'سمنان', 1, 0),
(16, 'سيستان و بلوچستان', 1, 0),
(17, 'فارس', 1, 0),
(18, 'قزوين', 1, 0),
(19, 'قم', 1, 0),
(20, 'كردستان', 1, 0),
(21, 'كرمان', 1, 0),
(22, 'كرمانشاه', 1, 0),
(23, 'كهكيلويه و بويراحمد', 1, 0),
(24, 'گلستان', 1, 0),
(25, 'گيلان', 1, 0),
(26, 'لرستان', 1, 0),
(27, 'مازندران', 1, 0),
(28, 'مركزي', 1, 0),
(29, 'هرمزگان', 1, 0),
(30, 'همدان', 1, 0),
(31, 'يزد', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_province`
--
ALTER TABLE `tbl_province`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_province`
--
ALTER TABLE `tbl_province`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
