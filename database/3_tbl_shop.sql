-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2021 at 01:19 PM
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
-- Table structure for table `tbl_shop`
--

CREATE TABLE `tbl_shop` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `city_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `updated_at` bigint(20) DEFAULT NULL,
  `created_at` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_shop`
--

INSERT INTO `tbl_shop` (`id`, `category_id`, `title`, `image`, `phone`, `fax`, `city_id`, `address`, `longitude`, `latitude`, `updated_at`, `created_at`, `status`) VALUES
(1, 3, '1فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(2, 3, '2فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(3, 3, '3فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(4, 3, '4فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(5, 4, '5فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(6, 4, '6فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(7, 4, '7فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(8, 4, '8فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(9, 5, '9فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(10, 5, '10فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(11, 5, '11فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(12, 5, '12فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(13, 6, '13فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(14, 6, '14فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(15, 6, 'فروشگاه15', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(16, 6, '16فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(17, 7, '17فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(18, 7, '18فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(19, 7, '19فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(20, 7, '20فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(21, 8, '21فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(22, 8, '22فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(23, 8, '23فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(24, 8, '24فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(25, 9, '25فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(26, 9, '26فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(27, 9, '27فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(28, 9, '28فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(30, 10, '29فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(31, 10, '30فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(32, 10, '31فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1),
(33, 10, '32فروشگاه', 'PN8i226FJS.png', '09130898272', '76543', 426, 'میدان اطلسی', '224', '212', NULL, 1618827285, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_shop`
--
ALTER TABLE `tbl_shop`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_shop`
--
ALTER TABLE `tbl_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
