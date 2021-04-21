-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2021 at 01:07 PM
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
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `last_login` bigint(20) DEFAULT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `access` tinyint(1) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `first_name`, `last_name`, `phone`, `username`, `password`, `last_login`, `created_at`, `updated_at`, `access`, `status`) VALUES
(1, 'دانیال', 'قاسمی', '09218248954', 'root', '123456', 1618204685, 1617910804, 1618032287, 1, 1),
(7, 'تست', 'تست', '09138525201', 'test', '1234', 1618032404, 1618032366, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`id`, `name`) VALUES
(1, 'سامان'),
(2, 'صادرات');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `ord` int(11) NOT NULL,
  `slag` varchar(20) NOT NULL,
  `updated_at` bigint(20) DEFAULT NULL,
  `created_at` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `icon`, `ord`, `slag`, `updated_at`, `created_at`, `status`) VALUES
(3, 'رستوران و فست فود', '5fHdFrPynp.png', 1, 'restaurant', 1619001333, 1618636414, 1),
(4, 'تفریحی ورزشی', 'zbtXllvBCE.png', 2, 'sport', 1619001317, 1618636550, 1),
(5, 'سلامتی و پزشکی', 'beub5mKk0n.png', 3, 'medical', 1619001305, 1618636573, 1),
(6, 'هنر و تئاتر', 'PqG29w86V2.png', 4, 'art', 1619001294, 1618636629, 1),
(7, 'آموزش', '0jkeIdtM8G.png', 5, 'education', 1619001282, 1618636650, 1),
(8, 'زیبایی و آرایشی', 'MazeXzGZT9.png', 6, 'beauty', 1619001267, 1618636688, 1),
(9, 'تور و سفر', 'QFQFZ2thQX.png', 7, 'tour', 1619001255, 1618636711, 1),
(10, 'خدمات', 'YjbrAdVojJ.png', 8, 'services', 1619001242, 1618636741, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

CREATE TABLE `tbl_city` (
  `id` int(12) UNSIGNED NOT NULL,
  `province_id` int(12) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` bigint(20) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`id`, `province_id`, `name`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 'تبريز', 1617910804, NULL, 1),
(2, 1, 'كندوان', 1617910804, NULL, 1),
(3, 1, 'بندر شرفخانه', 1617910804, NULL, 1),
(4, 1, 'مراغه', 1617910804, NULL, 1),
(5, 1, 'ميانه', 1617910804, NULL, 1),
(6, 1, 'شبستر', 1617910804, NULL, 1),
(7, 1, 'مرند', 1617910804, NULL, 1),
(8, 1, 'جلفا', 1617910804, NULL, 1),
(9, 1, 'سراب', 1617910804, NULL, 1),
(10, 1, 'هاديشهر', 1617910804, NULL, 1),
(11, 1, 'بناب', 1617910804, NULL, 1),
(12, 1, 'كليبر', 1617910804, NULL, 1),
(13, 1, 'تسوج', 1617910804, NULL, 1),
(14, 1, 'اهر', 1617910804, NULL, 1),
(15, 1, 'هريس', 1617910804, NULL, 1),
(16, 1, 'عجبشير', 1617910804, NULL, 1),
(17, 1, 'هشترود', 1617910804, NULL, 1),
(18, 1, 'ملكان', 1617910804, NULL, 1),
(19, 1, 'بستان آباد', 1617910804, NULL, 1),
(20, 1, 'ورزقان', 1617910804, NULL, 1),
(21, 1, 'اسكو', 1617910804, NULL, 1),
(22, 1, 'آذر شهر', 1617910804, NULL, 1),
(23, 1, 'قره آغاج', 1617910804, NULL, 1),
(24, 1, 'ممقان', 1617910804, NULL, 1),
(25, 1, 'صوفیان', 1617910804, NULL, 1),
(26, 1, 'ایلخچی', 1617910804, NULL, 1),
(27, 1, 'خسروشهر', 1617910804, NULL, 1),
(28, 1, 'باسمنج', 1617910804, NULL, 1),
(29, 1, 'سهند', 1617910804, NULL, 1),
(30, 2, 'اروميه', 1617910804, NULL, 1),
(31, 2, 'نقده', 1617910804, NULL, 1),
(32, 2, 'ماكو', 1617910804, NULL, 1),
(33, 2, 'تكاب', 1617910804, NULL, 1),
(34, 2, 'خوي', 1617910804, NULL, 1),
(35, 2, 'مهاباد', 1617910804, NULL, 1),
(36, 2, 'سر دشت', 1617910804, NULL, 1),
(37, 2, 'چالدران', 1617910804, NULL, 1),
(38, 2, 'بوكان', 1617910804, NULL, 1),
(39, 2, 'مياندوآب', 1617910804, NULL, 1),
(40, 2, 'سلماس', 1617910804, NULL, 1),
(41, 2, 'شاهين دژ', 1617910804, NULL, 1),
(42, 2, 'پيرانشهر', 1617910804, NULL, 1),
(43, 2, 'سيه چشمه', 1617910804, NULL, 1),
(44, 2, 'اشنويه', 1617910804, NULL, 1),
(45, 2, 'چایپاره', 1617910804, NULL, 1),
(46, 2, 'پلدشت', 1617910804, NULL, 1),
(47, 2, 'شوط', 1617910804, NULL, 1),
(48, 3, 'اردبيل', 1617910804, NULL, 1),
(49, 3, 'سرعين', 1617910804, NULL, 1),
(50, 3, 'بيله سوار', 1617910804, NULL, 1),
(51, 3, 'پارس آباد', 1617910804, NULL, 1),
(52, 3, 'خلخال', 1617910804, NULL, 1),
(53, 3, 'مشگين شهر', 1617910804, NULL, 1),
(54, 3, 'مغان', 1617910804, NULL, 1),
(55, 3, 'نمين', 1617910804, NULL, 1),
(56, 3, 'نير', 1617910804, NULL, 1),
(57, 3, 'كوثر', 1617910804, NULL, 1),
(58, 3, 'كيوي', 1617910804, NULL, 1),
(59, 3, 'گرمي', 1617910804, NULL, 1),
(60, 4, 'اصفهان', 1617910804, NULL, 1),
(61, 4, 'فريدن', 1617910804, NULL, 1),
(62, 4, 'فريدون شهر', 1617910804, NULL, 1),
(63, 4, 'فلاورجان', 1617910804, NULL, 1),
(64, 4, 'گلپايگان', 1617910804, NULL, 1),
(65, 4, 'دهاقان', 1617910804, NULL, 1),
(66, 4, 'نطنز', 1617910804, NULL, 1),
(67, 4, 'نايين', 1617910804, NULL, 1),
(68, 4, 'تيران', 1617910804, NULL, 1),
(69, 4, 'كاشان', 1617910804, NULL, 1),
(70, 4, 'فولاد شهر', 1617910804, NULL, 1),
(71, 4, 'اردستان', 1617910804, NULL, 1),
(72, 4, 'سميرم', 1617910804, NULL, 1),
(73, 4, 'درچه', 1617910804, NULL, 1),
(74, 4, 'کوهپایه', 1617910804, NULL, 1),
(75, 4, 'مباركه', 1617910804, NULL, 1),
(76, 4, 'شهرضا', 1617910804, NULL, 1),
(77, 4, 'خميني شهر', 1617910804, NULL, 1),
(78, 4, 'شاهين شهر', 1617910804, NULL, 1),
(79, 4, 'نجف آباد', 1617910804, NULL, 1),
(80, 4, 'دولت آباد', 1617910804, NULL, 1),
(81, 4, 'زرين شهر', 1617910804, NULL, 1),
(82, 4, 'آران و بيدگل', 1617910804, NULL, 1),
(83, 4, 'باغ بهادران', 1617910804, NULL, 1),
(84, 4, 'خوانسار', 1617910804, NULL, 1),
(85, 4, 'مهردشت', 1617910804, NULL, 1),
(86, 4, 'علويجه', 1617910804, NULL, 1),
(87, 4, 'عسگران', 1617910804, NULL, 1),
(88, 4, 'نهضت آباد', 1617910804, NULL, 1),
(89, 4, 'حاجي آباد', 1617910804, NULL, 1),
(90, 4, 'تودشک', 1617910804, NULL, 1),
(91, 4, 'ورزنه', 1617910804, NULL, 1),
(92, 6, 'ايلام', 1617910804, NULL, 1),
(93, 6, 'مهران', 1617910804, NULL, 1),
(94, 6, 'دهلران', 1617910804, NULL, 1),
(95, 6, 'آبدانان', 1617910804, NULL, 1),
(96, 6, 'شيروان چرداول', 1617910804, NULL, 1),
(97, 6, 'دره شهر', 1617910804, NULL, 1),
(98, 6, 'ايوان', 1617910804, NULL, 1),
(99, 6, 'سرابله', 1617910804, NULL, 1),
(100, 7, 'بوشهر', 1617910804, NULL, 1),
(101, 7, 'تنگستان', 1617910804, NULL, 1),
(102, 7, 'دشتستان', 1617910804, NULL, 1),
(103, 7, 'دير', 1617910804, NULL, 1),
(104, 7, 'ديلم', 1617910804, NULL, 1),
(105, 7, 'كنگان', 1617910804, NULL, 1),
(106, 7, 'گناوه', 1617910804, NULL, 1),
(107, 7, 'ريشهر', 1617910804, NULL, 1),
(108, 7, 'دشتي', 1617910804, NULL, 1),
(109, 7, 'خورموج', 1617910804, NULL, 1),
(110, 7, 'اهرم', 1617910804, NULL, 1),
(111, 7, 'برازجان', 1617910804, NULL, 1),
(112, 7, 'خارك', 1617910804, NULL, 1),
(113, 7, 'جم', 1617910804, NULL, 1),
(114, 7, 'کاکی', 1617910804, NULL, 1),
(115, 7, 'عسلویه', 1617910804, NULL, 1),
(116, 7, 'بردخون', 1617910804, NULL, 1),
(117, 8, 'تهران', 1617910804, NULL, 1),
(118, 8, 'ورامين', 1617910804, NULL, 1),
(119, 8, 'فيروزكوه', 1617910804, NULL, 1),
(120, 8, 'ري', 1617910804, NULL, 1),
(121, 8, 'دماوند', 1617910804, NULL, 1),
(122, 8, 'اسلامشهر', 1617910804, NULL, 1),
(123, 8, 'رودهن', 1617910804, NULL, 1),
(124, 8, 'لواسان', 1617910804, NULL, 1),
(125, 8, 'بومهن', 1617910804, NULL, 1),
(126, 8, 'تجريش', 1617910804, NULL, 1),
(127, 8, 'فشم', 1617910804, NULL, 1),
(128, 8, 'كهريزك', 1617910804, NULL, 1),
(129, 8, 'پاكدشت', 1617910804, NULL, 1),
(130, 8, 'چهاردانگه', 1617910804, NULL, 1),
(131, 8, 'شريف آباد', 1617910804, NULL, 1),
(132, 8, 'قرچك', 1617910804, NULL, 1),
(133, 8, 'باقرشهر', 1617910804, NULL, 1),
(134, 8, 'شهريار', 1617910804, NULL, 1),
(135, 8, 'رباط كريم', 1617910804, NULL, 1),
(136, 8, 'قدس', 1617910804, NULL, 1),
(137, 8, 'ملارد', 1617910804, NULL, 1),
(138, 9, 'شهركرد', 1617910804, NULL, 1),
(139, 9, 'فارسان', 1617910804, NULL, 1),
(140, 9, 'بروجن', 1617910804, NULL, 1),
(141, 9, 'چلگرد', 1617910804, NULL, 1),
(142, 9, 'اردل', 1617910804, NULL, 1),
(143, 9, 'لردگان', 1617910804, NULL, 1),
(144, 9, 'سامان', 1617910804, NULL, 1),
(145, 10, 'قائن', 1617910804, NULL, 1),
(146, 10, 'فردوس', 1617910804, NULL, 1),
(147, 10, 'بيرجند', 1617910804, NULL, 1),
(148, 10, 'نهبندان', 1617910804, NULL, 1),
(149, 10, 'سربيشه', 1617910804, NULL, 1),
(150, 10, 'طبس مسینا', 1617910804, NULL, 1),
(151, 10, 'قهستان', 1617910804, NULL, 1),
(152, 10, 'درمیان', 1617910804, NULL, 1),
(153, 11, 'مشهد', 1617910804, NULL, 1),
(154, 11, 'نيشابور', 1617910804, NULL, 1),
(155, 11, 'سبزوار', 1617910804, NULL, 1),
(156, 11, 'كاشمر', 1617910804, NULL, 1),
(157, 11, 'گناباد', 1617910804, NULL, 1),
(158, 11, 'طبس', 1617910804, NULL, 1),
(159, 11, 'تربت حيدريه', 1617910804, NULL, 1),
(160, 11, 'خواف', 1617910804, NULL, 1),
(161, 11, 'تربت جام', 1617910804, NULL, 1),
(162, 11, 'تايباد', 1617910804, NULL, 1),
(163, 11, 'قوچان', 1617910804, NULL, 1),
(164, 11, 'سرخس', 1617910804, NULL, 1),
(165, 11, 'بردسكن', 1617910804, NULL, 1),
(166, 11, 'فريمان', 1617910804, NULL, 1),
(167, 11, 'چناران', 1617910804, NULL, 1),
(168, 11, 'درگز', 1617910804, NULL, 1),
(169, 11, 'كلات', 1617910804, NULL, 1),
(170, 11, 'طرقبه', 1617910804, NULL, 1),
(171, 11, 'سر ولایت', 1617910804, NULL, 1),
(172, 12, 'بجنورد', 1617910804, NULL, 1),
(173, 12, 'اسفراين', 1617910804, NULL, 1),
(174, 12, 'جاجرم', 1617910804, NULL, 1),
(175, 12, 'شيروان', 1617910804, NULL, 1),
(176, 12, 'آشخانه', 1617910804, NULL, 1),
(177, 12, 'گرمه', 1617910804, NULL, 1),
(178, 12, 'ساروج', 1617910804, NULL, 1),
(179, 13, 'اهواز', 1617910804, NULL, 1),
(180, 13, 'ايرانشهر', 1617910804, NULL, 1),
(181, 13, 'شوش', 1617910804, NULL, 1),
(182, 13, 'آبادان', 1617910804, NULL, 1),
(183, 13, 'خرمشهر', 1617910804, NULL, 1),
(184, 13, 'مسجد سليمان', 1617910804, NULL, 1),
(185, 13, 'ايذه', 1617910804, NULL, 1),
(186, 13, 'شوشتر', 1617910804, NULL, 1),
(187, 13, 'انديمشك', 1617910804, NULL, 1),
(188, 13, 'سوسنگرد', 1617910804, NULL, 1),
(189, 13, 'هويزه', 1617910804, NULL, 1),
(190, 13, 'دزفول', 1617910804, NULL, 1),
(191, 13, 'شادگان', 1617910804, NULL, 1),
(192, 13, 'بندر ماهشهر', 1617910804, NULL, 1),
(193, 13, 'بندر امام خميني', 1617910804, NULL, 1),
(194, 13, 'اميديه', 1617910804, NULL, 1),
(195, 13, 'بهبهان', 1617910804, NULL, 1),
(196, 13, 'رامهرمز', 1617910804, NULL, 1),
(197, 13, 'باغ ملك', 1617910804, NULL, 1),
(198, 13, 'هنديجان', 1617910804, NULL, 1),
(199, 13, 'لالي', 1617910804, NULL, 1),
(200, 13, 'رامشیر', 1617910804, NULL, 1),
(201, 13, 'حمیدیه', 1617910804, NULL, 1),
(202, 13, 'دغاغله', 1617910804, NULL, 1),
(203, 13, 'ملاثانی', 1617910804, NULL, 1),
(204, 13, 'شادگان', 1617910804, NULL, 1),
(205, 13, 'ویسی', 1617910804, NULL, 1),
(206, 14, 'زنجان', 1617910804, NULL, 1),
(207, 14, 'ابهر', 1617910804, NULL, 1),
(208, 14, 'خدابنده', 1617910804, NULL, 1),
(209, 14, 'طارم', 1617910804, NULL, 1),
(210, 14, 'ماهنشان', 1617910804, NULL, 1),
(211, 14, 'خرمدره', 1617910804, NULL, 1),
(212, 14, 'ايجرود', 1617910804, NULL, 1),
(213, 14, 'زرين آباد', 1617910804, NULL, 1),
(214, 14, 'آب بر', 1617910804, NULL, 1),
(215, 14, 'قيدار', 1617910804, NULL, 1),
(216, 15, 'سمنان', 1617910804, NULL, 1),
(217, 15, 'شاهرود', 1617910804, NULL, 1),
(218, 15, 'گرمسار', 1617910804, NULL, 1),
(219, 15, 'ايوانكي', 1617910804, NULL, 1),
(220, 15, 'دامغان', 1617910804, NULL, 1),
(221, 15, 'بسطام', 1617910804, NULL, 1),
(222, 16, 'زاهدان', 1617910804, NULL, 1),
(223, 16, 'چابهار', 1617910804, NULL, 1),
(224, 16, 'خاش', 1617910804, NULL, 1),
(225, 16, 'سراوان', 1617910804, NULL, 1),
(226, 16, 'زابل', 1617910804, NULL, 1),
(227, 16, 'سرباز', 1617910804, NULL, 1),
(228, 16, 'نيكشهر', 1617910804, NULL, 1),
(229, 16, 'ايرانشهر', 1617910804, NULL, 1),
(230, 16, 'راسك', 1617910804, NULL, 1),
(231, 16, 'ميرجاوه', 1617910804, NULL, 1),
(232, 17, 'شيراز', 1617910804, NULL, 1),
(233, 17, 'اقليد', 1617910804, NULL, 1),
(234, 17, 'داراب', 1617910804, NULL, 1),
(235, 17, 'فسا', 1617910804, NULL, 1),
(236, 17, 'مرودشت', 1617910804, NULL, 1),
(237, 17, 'خرم بيد', 1617910804, NULL, 1),
(238, 17, 'آباده', 1617910804, NULL, 1),
(239, 17, 'كازرون', 1617910804, NULL, 1),
(240, 17, 'ممسني', 1617910804, NULL, 1),
(241, 17, 'سپيدان', 1617910804, NULL, 1),
(242, 17, 'لار', 1617910804, NULL, 1),
(243, 17, 'فيروز آباد', 1617910804, NULL, 1),
(244, 17, 'جهرم', 1617910804, NULL, 1),
(245, 17, 'ني ريز', 1617910804, NULL, 1),
(246, 17, 'استهبان', 1617910804, NULL, 1),
(247, 17, 'لامرد', 1617910804, NULL, 1),
(248, 17, 'مهر', 1617910804, NULL, 1),
(249, 17, 'حاجي آباد', 1617910804, NULL, 1),
(250, 17, 'نورآباد', 1617910804, NULL, 1),
(251, 17, 'اردكان', 1617910804, NULL, 1),
(252, 17, 'صفاشهر', 1617910804, NULL, 1),
(253, 17, 'ارسنجان', 1617910804, NULL, 1),
(254, 17, 'قيروكارزين', 1617910804, NULL, 1),
(255, 17, 'سوريان', 1617910804, NULL, 1),
(256, 17, 'فراشبند', 1617910804, NULL, 1),
(257, 17, 'سروستان', 1617910804, NULL, 1),
(258, 17, 'ارژن', 1617910804, NULL, 1),
(259, 17, 'گويم', 1617910804, NULL, 1),
(260, 17, 'داريون', 1617910804, NULL, 1),
(261, 17, 'زرقان', 1617910804, NULL, 1),
(262, 17, 'خان زنیان', 1617910804, NULL, 1),
(263, 17, 'کوار', 1617910804, NULL, 1),
(264, 17, 'ده بید', 1617910804, NULL, 1),
(265, 17, 'باب انار/خفر', 1617910804, NULL, 1),
(266, 17, 'بوانات', 1617910804, NULL, 1),
(267, 17, 'خرامه', 1617910804, NULL, 1),
(268, 17, 'خنج', 1617910804, NULL, 1),
(269, 17, 'سیاخ دارنگون', 1617910804, NULL, 1),
(270, 18, 'قزوين', 1617910804, NULL, 1),
(271, 18, 'تاكستان', 1617910804, NULL, 1),
(272, 18, 'آبيك', 1617910804, NULL, 1),
(273, 18, 'بوئين زهرا', 1617910804, NULL, 1),
(274, 19, 'قم', 1617910804, NULL, 1),
(275, 5, 'طالقان', 1617910804, NULL, 1),
(276, 5, 'نظرآباد', 1617910804, NULL, 1),
(277, 5, 'اشتهارد', 1617910804, NULL, 1),
(278, 5, 'هشتگرد', 1617910804, NULL, 1),
(279, 5, 'كن', 1617910804, NULL, 1),
(280, 5, 'آسارا', 1617910804, NULL, 1),
(281, 5, 'شهرک گلستان', 1617910804, NULL, 1),
(282, 5, 'اندیشه', 1617910804, NULL, 1),
(283, 5, 'كرج', 1617910804, NULL, 1),
(284, 5, 'نظر آباد', 1617910804, NULL, 1),
(285, 5, 'گوهردشت', 1617910804, NULL, 1),
(286, 5, 'ماهدشت', 1617910804, NULL, 1),
(287, 5, 'مشکین دشت', 1617910804, NULL, 1),
(288, 20, 'سنندج', 1617910804, NULL, 1),
(289, 20, 'ديواندره', 1617910804, NULL, 1),
(290, 20, 'بانه', 1617910804, NULL, 1),
(291, 20, 'بيجار', 1617910804, NULL, 1),
(292, 20, 'سقز', 1617910804, NULL, 1),
(293, 20, 'كامياران', 1617910804, NULL, 1),
(294, 20, 'قروه', 1617910804, NULL, 1),
(295, 20, 'مريوان', 1617910804, NULL, 1),
(296, 20, 'صلوات آباد', 1617910804, NULL, 1),
(297, 20, 'حسن آباد', 1617910804, NULL, 1),
(298, 21, 'كرمان', 1617910804, NULL, 1),
(299, 21, 'راور', 1617910804, NULL, 1),
(300, 21, 'بابك', 1617910804, NULL, 1),
(301, 21, 'انار', 1617910804, NULL, 1),
(302, 21, 'کوهبنان', 1617910804, NULL, 1),
(303, 21, 'رفسنجان', 1617910804, NULL, 1),
(304, 21, 'بافت', 1617910804, NULL, 1),
(305, 21, 'سيرجان', 1617910804, NULL, 1),
(306, 21, 'كهنوج', 1617910804, NULL, 1),
(307, 21, 'زرند', 1617910804, NULL, 1),
(308, 21, 'بم', 1617910804, NULL, 1),
(309, 21, 'جيرفت', 1617910804, NULL, 1),
(310, 21, 'بردسير', 1617910804, NULL, 1),
(311, 22, 'كرمانشاه', 1617910804, NULL, 1),
(312, 22, 'اسلام آباد غرب', 1617910804, NULL, 1),
(313, 22, 'سر پل ذهاب', 1617910804, NULL, 1),
(314, 22, 'كنگاور', 1617910804, NULL, 1),
(315, 22, 'سنقر', 1617910804, NULL, 1),
(316, 22, 'قصر شيرين', 1617910804, NULL, 1),
(317, 22, 'گيلان غرب', 1617910804, NULL, 1),
(318, 22, 'هرسين', 1617910804, NULL, 1),
(319, 22, 'صحنه', 1617910804, NULL, 1),
(320, 22, 'پاوه', 1617910804, NULL, 1),
(321, 22, 'جوانرود', 1617910804, NULL, 1),
(322, 22, 'شاهو', 1617910804, NULL, 1),
(323, 23, 'ياسوج', 1617910804, NULL, 1),
(324, 23, 'گچساران', 1617910804, NULL, 1),
(325, 23, 'دنا', 1617910804, NULL, 1),
(326, 23, 'دوگنبدان', 1617910804, NULL, 1),
(327, 23, 'سي سخت', 1617910804, NULL, 1),
(328, 23, 'دهدشت', 1617910804, NULL, 1),
(329, 23, 'ليكك', 1617910804, NULL, 1),
(330, 24, 'گرگان', 1617910804, NULL, 1),
(331, 24, 'آق قلا', 1617910804, NULL, 1),
(332, 24, 'گنبد كاووس', 1617910804, NULL, 1),
(333, 24, 'علي آباد كتول', 1617910804, NULL, 1),
(334, 24, 'مينو دشت', 1617910804, NULL, 1),
(335, 24, 'تركمن', 1617910804, NULL, 1),
(336, 24, 'كردكوي', 1617910804, NULL, 1),
(337, 24, 'بندر گز', 1617910804, NULL, 1),
(338, 24, 'كلاله', 1617910804, NULL, 1),
(339, 24, 'آزاد شهر', 1617910804, NULL, 1),
(340, 24, 'راميان', 1617910804, NULL, 1),
(341, 25, 'رشت', 1617910804, NULL, 1),
(342, 25, 'منجيل', 1617910804, NULL, 1),
(343, 25, 'لنگرود', 1617910804, NULL, 1),
(344, 25, 'رود سر', 1617910804, NULL, 1),
(345, 25, 'تالش', 1617910804, NULL, 1),
(346, 25, 'آستارا', 1617910804, NULL, 1),
(347, 25, 'ماسوله', 1617910804, NULL, 1),
(348, 25, 'آستانه اشرفيه', 1617910804, NULL, 1),
(349, 25, 'رودبار', 1617910804, NULL, 1),
(350, 25, 'فومن', 1617910804, NULL, 1),
(351, 25, 'صومعه سرا', 1617910804, NULL, 1),
(352, 25, 'بندرانزلي', 1617910804, NULL, 1),
(353, 25, 'كلاچاي', 1617910804, NULL, 1),
(354, 25, 'هشتپر', 1617910804, NULL, 1),
(355, 25, 'رضوان شهر', 1617910804, NULL, 1),
(356, 25, 'ماسال', 1617910804, NULL, 1),
(357, 25, 'شفت', 1617910804, NULL, 1),
(358, 25, 'سياهكل', 1617910804, NULL, 1),
(359, 25, 'املش', 1617910804, NULL, 1),
(360, 25, 'لاهیجان', 1617910804, NULL, 1),
(361, 25, 'خشک بيجار', 1617910804, NULL, 1),
(362, 25, 'خمام', 1617910804, NULL, 1),
(363, 25, 'لشت نشا', 1617910804, NULL, 1),
(364, 25, 'بندر کياشهر', 1617910804, NULL, 1),
(365, 26, 'خرم آباد', 1617910804, NULL, 1),
(366, 26, 'ماهشهر', 1617910804, NULL, 1),
(367, 26, 'دزفول', 1617910804, NULL, 1),
(368, 26, 'بروجرد', 1617910804, NULL, 1),
(369, 26, 'دورود', 1617910804, NULL, 1),
(370, 26, 'اليگودرز', 1617910804, NULL, 1),
(371, 26, 'ازنا', 1617910804, NULL, 1),
(372, 26, 'نور آباد', 1617910804, NULL, 1),
(373, 26, 'كوهدشت', 1617910804, NULL, 1),
(374, 26, 'الشتر', 1617910804, NULL, 1),
(375, 26, 'پلدختر', 1617910804, NULL, 1),
(376, 27, 'ساري', 1617910804, NULL, 1),
(377, 27, 'آمل', 1617910804, NULL, 1),
(378, 27, 'بابل', 1617910804, NULL, 1),
(379, 27, 'بابلسر', 1617910804, NULL, 1),
(380, 27, 'بهشهر', 1617910804, NULL, 1),
(381, 27, 'تنكابن', 1617910804, NULL, 1),
(382, 27, 'جويبار', 1617910804, NULL, 1),
(383, 27, 'چالوس', 1617910804, NULL, 1),
(384, 27, 'رامسر', 1617910804, NULL, 1),
(385, 27, 'سواد كوه', 1617910804, NULL, 1),
(386, 27, 'قائم شهر', 1617910804, NULL, 1),
(387, 27, 'نكا', 1617910804, NULL, 1),
(388, 27, 'نور', 1617910804, NULL, 1),
(389, 27, 'بلده', 1617910804, NULL, 1),
(390, 27, 'نوشهر', 1617910804, NULL, 1),
(391, 27, 'پل سفيد', 1617910804, NULL, 1),
(392, 27, 'محمود آباد', 1617910804, NULL, 1),
(393, 27, 'فريدون كنار', 1617910804, NULL, 1),
(394, 28, 'اراك', 1617910804, NULL, 1),
(395, 28, 'آشتيان', 1617910804, NULL, 1),
(396, 28, 'تفرش', 1617910804, NULL, 1),
(397, 28, 'خمين', 1617910804, NULL, 1),
(398, 28, 'دليجان', 1617910804, NULL, 1),
(399, 28, 'ساوه', 1617910804, NULL, 1),
(400, 28, 'سربند', 1617910804, NULL, 1),
(401, 28, 'محلات', 1617910804, NULL, 1),
(402, 28, 'شازند', 1617910804, NULL, 1),
(403, 29, 'بندرعباس', 1617910804, NULL, 1),
(404, 29, 'قشم', 1617910804, NULL, 1),
(405, 29, 'كيش', 1617910804, NULL, 1),
(406, 29, 'بندر لنگه', 1617910804, NULL, 1),
(407, 29, 'بستك', 1617910804, NULL, 1),
(408, 29, 'حاجي آباد', 1617910804, NULL, 1),
(409, 29, 'دهبارز', 1617910804, NULL, 1),
(410, 29, 'انگهران', 1617910804, NULL, 1),
(411, 29, 'ميناب', 1617910804, NULL, 1),
(412, 29, 'ابوموسي', 1617910804, NULL, 1),
(413, 29, 'بندر جاسك', 1617910804, NULL, 1),
(414, 29, 'تنب بزرگ', 1617910804, NULL, 1),
(415, 29, 'بندر خمیر', 1617910804, NULL, 1),
(416, 29, 'پارسیان', 1617910804, NULL, 1),
(417, 29, 'قشم', 1617910804, NULL, 1),
(418, 30, 'همدان', 1617910804, NULL, 1),
(419, 30, 'ملاير', 1617910804, NULL, 1),
(420, 30, 'تويسركان', 1617910804, NULL, 1),
(421, 30, 'نهاوند', 1617910804, NULL, 1),
(422, 30, 'كبودر اهنگ', 1617910804, NULL, 1),
(423, 30, 'رزن', 1617910804, NULL, 1),
(424, 30, 'اسدآباد', 1617910804, NULL, 1),
(425, 30, 'بهار', 1617910804, NULL, 1),
(426, 31, 'يزد', 1617910804, NULL, 1),
(427, 31, 'تفت', 1617910804, NULL, 1),
(428, 31, 'اردكان', 1617910804, NULL, 1),
(429, 31, 'ابركوه', 1617910804, NULL, 1),
(430, 31, 'ميبد', 1617910804, NULL, 1),
(431, 31, 'طبس', 1617910804, NULL, 1),
(432, 31, 'بافق', 1617910804, NULL, 1),
(433, 31, 'مهريز', 1617910804, 1618149886, 1),
(434, 31, 'اشكذر', 1617910804, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `cart_number` varchar(20) NOT NULL,
  `refrence_code` varchar(100) NOT NULL,
  `date` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`id`, `user_id`, `amount`, `cart_number`, `refrence_code`, `date`, `status`) VALUES
(1, 27, '200000', '123', '1234', 1618817025, 1),
(2, 27, '100000', '', '12345678', 1618821470, 1),
(3, 27, '5000', '', '12345678', 1618842554, 1),
(4, 30, '200000', '', '12345678', 1618985794, 1),
(5, 27, '100000', '', '12345678', 1618988779, 1),
(6, 27, '200000', '', '12345678', 1618998187, 1),
(7, 27, '5000', '', '12345678', 1618999696, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `discription` text NOT NULL,
  `price` varchar(20) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `updated_at` bigint(20) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `category_id`, `shop_id`, `title`, `discription`, `price`, `discount`, `score`, `updated_at`, `created_at`, `status`) VALUES
(7, 10, 33, 'اسلایدر', 'نتال', '123000', 98, 432, 0, 1618906595, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_comment`
--

CREATE TABLE `tbl_product_comment` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `score` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_favorite`
--

CREATE TABLE `tbl_product_favorite` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_province`
--

CREATE TABLE `tbl_province` (
  `id` int(12) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_province`
--

INSERT INTO `tbl_province` (`id`, `name`, `created_at`, `updated_at`, `status`) VALUES
(1, 'آذربايجان شرقي', 1617910804, NULL, 1),
(2, 'آذربايجان غربي', 1617910804, NULL, 1),
(3, 'اردبيل', 1617910804, NULL, 1),
(4, 'اصفهان', 1617910804, NULL, 1),
(5, 'البرز', 1617910804, NULL, 1),
(6, 'ايلام', 1617910804, NULL, 1),
(7, 'بوشهر', 1617910804, NULL, 1),
(8, 'تهران', 1617910804, NULL, 1),
(9, 'چهارمحال بختياري', 1617910804, NULL, 1),
(10, 'خراسان جنوبي', 1617910804, NULL, 1),
(11, 'خراسان رضوي', 1617910804, NULL, 1),
(12, 'خراسان شمالي', 1617910804, NULL, 1),
(13, 'خوزستان', 1617910804, NULL, 1),
(14, 'زنجان', 1617910804, NULL, 1),
(15, 'سمنان', 1617910804, NULL, 1),
(16, 'سيستان و بلوچستان', 1617910804, NULL, 1),
(17, 'فارس', 1617910804, NULL, 1),
(18, 'قزوين', 1617910804, NULL, 1),
(19, 'قم', 1617910804, NULL, 1),
(20, 'كردستان', 1617910804, NULL, 1),
(21, 'كرمان', 1617910804, NULL, 1),
(22, 'كرمانشاه', 1617910804, NULL, 1),
(23, 'كهكيلويه و بويراحمد', 1617910804, NULL, 1),
(24, 'گلستان', 1617910804, NULL, 1),
(25, 'گيلان', 1617910804, NULL, 1),
(26, 'لرستان', 1617910804, NULL, 1),
(27, 'مازندران', 1617910804, NULL, 1),
(28, 'مركزي', 1617910804, NULL, 1),
(29, 'هرمزگان', 1617910804, NULL, 1),
(30, 'همدان', 1617910804, NULL, 1),
(31, 'يزد', 1617910804, 1618149876, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request`
--

CREATE TABLE `tbl_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `description` text DEFAULT NULL,
  `paymented_at` bigint(20) DEFAULT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_request`
--

INSERT INTO `tbl_request` (`id`, `user_id`, `cart_id`, `amount`, `description`, `paymented_at`, `created_at`, `updated_at`, `status`) VALUES
(5, 27, 0, '200000', 'واریز', 1618860600, 1618909863, 1618911261, 1),
(6, 30, 0, '5000', 'واریز شد', 1618947000, 1618985804, 1618985836, 1),
(7, 27, 0, '100000', NULL, NULL, 1618988804, NULL, 0),
(8, 27, 0, '100000', NULL, NULL, 1618996738, NULL, 0),
(9, 27, 15, '100000', NULL, NULL, 1618996826, NULL, 0),
(10, 27, 15, '100000', NULL, NULL, 1618999714, NULL, 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shop_comment`
--

CREATE TABLE `tbl_shop_comment` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `score` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_shop_comment`
--

INSERT INTO `tbl_shop_comment` (`id`, `shop_id`, `user_id`, `text`, `score`, `created_at`, `status`) VALUES
(1, 1, 1, 'hjgf', 12, 1676754, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `link` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `title`, `link`, `image`, `status`, `created_at`, `updated_at`) VALUES
(3, 'اسلایدر', 'index.php', 'xvZSIkLtE8.png', 1, 1618725135, 1618725202),
(4, 'اسلایدر', 'index.php', 'bOkdUs0rHz.png', 1, 1618725183, NULL),
(5, 'اسلایدر', 'index.php', 'ML028RLIHQ.png', 1, 1618725224, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket`
--

CREATE TABLE `tbl_ticket` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `type` int(11) NOT NULL,
  `view` tinyint(1) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `solve` text DEFAULT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) DEFAULT NULL,
  `solved_at` bigint(20) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ticket`
--

INSERT INTO `tbl_ticket` (`id`, `user_id`, `subject`, `text`, `type`, `view`, `admin_id`, `solve`, `created_at`, `updated_at`, `solved_at`, `status`) VALUES
(2, 1, 'تست', 'تست', 0, 0, 1, 'تغییر وضعیت', 1676754, 1618229752, 1618229788, 3),
(3, 1, 'gbfv', 'vdc', 0, 0, 1, 'پاسخ دادی؟', 1676754, 1618230521, 1618637605, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `national_code` varchar(10) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `reference_code` varchar(10) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `birthday` bigint(20) DEFAULT NULL,
  `profile` text DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `wallet` varchar(20) DEFAULT NULL,
  `iban` varchar(26) DEFAULT NULL,
  `last_login` bigint(20) DEFAULT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `first_name`, `last_name`, `national_code`, `phone`, `city_id`, `address`, `postal_code`, `reference_code`, `reference_id`, `birthday`, `profile`, `score`, `wallet`, `iban`, `last_login`, `created_at`, `updated_at`, `status`) VALUES
(27, 'زکیه', 'امیری ', '0023407255', '09130898272', 151, 'یزد/یزد/قاسم اباد', '987654', 'u05ZE5', 0, 968009400, '', 432, '705000', '65432', NULL, 1618655399, 1618999697, 0),
(30, 'علی', 'علویی', '0023407255', '09030933038', 243, 'یزد/یزد/قاسم اباد', '8916153344', 'MHgby2', 0, 1617046200, NULL, NULL, '195000', NULL, NULL, 1618985640, 1618985836, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_cart`
--

CREATE TABLE `tbl_user_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `cart_number` varchar(16) NOT NULL,
  `account_number` int(11) NOT NULL,
  `iban` varchar(26) NOT NULL,
  `validation` tinyint(1) NOT NULL,
  `updated_at` bigint(20) DEFAULT NULL,
  `created_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_cart`
--

INSERT INTO `tbl_user_cart` (`id`, `user_id`, `bank_id`, `title`, `cart_number`, `account_number`, `iban`, `validation`, `updated_at`, `created_at`) VALUES
(15, 27, 1, 'زکیه  امیری ', '0000000000', 8765432, '98765', 0, 1618995747, 1618634885),
(16, 27, 2, 'زکیه  امیری ', '000000', 0, '000000000', 0, 1618994570, 1618994189);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_validation_code`
--

CREATE TABLE `tbl_validation_code` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wallet_log`
--

CREATE TABLE `tbl_wallet_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` text NOT NULL,
  `amount` varchar(20) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_wallet_log`
--

INSERT INTO `tbl_wallet_log` (`id`, `user_id`, `action`, `amount`, `type`, `payment_id`) VALUES
(6, 27, 'increase wallet by user', '200000', 1, 1),
(7, 27, 'increase wallet by user', '100000', 1, 2),
(8, 27, 'increase wallet by user', '5000', 1, 3),
(9, 27, 'decrease wallet confirmed by admin', '200000', 0, 0),
(10, 30, 'increase wallet by user', '200000', 1, 4),
(11, 30, 'decrease wallet confirmed by admin', '5000', 0, 0),
(12, 27, 'increase wallet by user', '100000', 1, 5),
(13, 27, 'increase wallet by user', '200000', 1, 6),
(14, 27, 'increase wallet by user', '5000', 1, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_city`
--
ALTER TABLE `tbl_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product_comment`
--
ALTER TABLE `tbl_product_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_province`
--
ALTER TABLE `tbl_province`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_shop`
--
ALTER TABLE `tbl_shop`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `tbl_shop_comment`
--
ALTER TABLE `tbl_shop_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ticket`
--
ALTER TABLE `tbl_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference_code` (`reference_code`);

--
-- Indexes for table `tbl_user_cart`
--
ALTER TABLE `tbl_user_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_validation_code`
--
ALTER TABLE `tbl_validation_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wallet_log`
--
ALTER TABLE `tbl_wallet_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_city`
--
ALTER TABLE `tbl_city`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=444;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_product_comment`
--
ALTER TABLE `tbl_product_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_province`
--
ALTER TABLE `tbl_province`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_request`
--
ALTER TABLE `tbl_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_shop`
--
ALTER TABLE `tbl_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_shop_comment`
--
ALTER TABLE `tbl_shop_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_ticket`
--
ALTER TABLE `tbl_ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_user_cart`
--
ALTER TABLE `tbl_user_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_validation_code`
--
ALTER TABLE `tbl_validation_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `tbl_wallet_log`
--
ALTER TABLE `tbl_wallet_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
