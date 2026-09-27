-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 18, 2026 at 11:13 AM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u603611739_bundlepro`
--

-- --------------------------------------------------------

--
-- Table structure for table `credit`
--

CREATE TABLE `credit` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `credit`
--

INSERT INTO `credit` (`id`, `name`) VALUES
(1, '');

-- --------------------------------------------------------

--
-- Table structure for table `Feature`
--

CREATE TABLE `Feature` (
  `id` int(11) NOT NULL,
  `ESP` varchar(3) NOT NULL,
  `Item` varchar(3) NOT NULL,
  `SilentAim` varchar(3) NOT NULL,
  `AIM` varchar(3) NOT NULL,
  `BulletTrack` varchar(3) NOT NULL,
  `Memory` varchar(3) NOT NULL,
  `Floating` varchar(3) NOT NULL,
  `Setting` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `Feature`
--

INSERT INTO `Feature` (`id`, `ESP`, `Item`, `SilentAim`, `AIM`, `BulletTrack`, `Memory`, `Floating`, `Setting`) VALUES
(1, 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id_history` int(11) NOT NULL,
  `keys_id` varchar(33) DEFAULT NULL,
  `user_do` varchar(33) DEFAULT NULL,
  `info` mediumtext NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id_history`, `keys_id`, `user_do`, `info`, `created_at`, `updated_at`) VALUES
(1, '10', 'reseller', 'PUBG|resel|24|1', '2025-12-12 13:01:01', '2025-12-12 13:01:01'),
(2, '11', 'admin', 'PUBG|LAUDA|168|1', '2025-12-13 18:52:46', '2025-12-13 18:52:46'),
(3, '12', 'admin1', 'PUBG|admin|720|1', '2025-12-15 12:58:21', '2025-12-15 12:58:21'),
(4, '13', 'reseller', 'PUBG|resel|720|1', '2025-12-15 13:02:40', '2025-12-15 13:02:40'),
(5, '14', 'admin1', 'PUBG|admin|2|1', '2025-12-15 13:03:17', '2025-12-15 13:03:17'),
(6, '19', 'reseller', 'PUBG|resel|2|1', '2025-12-18 09:50:58', '2025-12-18 09:50:58'),
(7, '20', 'KHANBHAI76', 'PUBG|KHANB|2|1', '2026-01-16 10:53:58', '2026-01-16 10:53:58'),
(8, '21', 'KHANBHAI76', 'PUBG|KHANB|2|5', '2026-01-16 11:01:55', '2026-01-16 11:01:55'),
(9, '22', 'KHANBHAI76', 'PUBG|realx|2|2', '2026-01-16 11:44:51', '2026-01-16 11:44:51'),
(10, '23', 'BOTNETOP', 'PUBG|YOOUR|72|10', '2026-01-17 14:07:28', '2026-01-17 14:07:28'),
(11, '24', 'BOTNETOP', 'PUBG|GODPR|24|600', '2026-01-17 14:22:39', '2026-01-17 14:22:39'),
(12, '25', 'KHANBHAI76', 'PUBG|KHANB|24|50', '2026-01-17 14:37:16', '2026-01-17 14:37:16'),
(13, '26', 'KHANBHAI76', 'PUBG|GODMO|24|50', '2026-01-17 14:55:28', '2026-01-17 14:55:28'),
(14, '27', 'BOTNETOP', 'PUBG|MODTE|24|20', '2026-01-17 20:49:18', '2026-01-17 20:49:18'),
(15, '28', 'BOTNETOP', 'PUBG|JALDI|5|30', '2026-01-18 12:14:28', '2026-01-18 12:14:28'),
(16, '29', 'KHANBHAI76', 'PUBG|FAADD|24|50', '2026-01-18 19:16:17', '2026-01-18 19:16:17'),
(17, '30', 'BOTNETOP', 'PUBG|GODGA|24|1000', '2026-01-18 20:11:59', '2026-01-18 20:11:59'),
(18, '31', 'BOTNETOP', 'PUBG|Rb_ha|720|1', '2026-01-18 21:23:20', '2026-01-18 21:23:20'),
(19, '32', 'BOTNETOP', 'PUBG|1devi|2|1', '2026-01-19 09:58:20', '2026-01-19 09:58:20'),
(20, '33', 'BOTNETOP', 'PUBG|TESTI|5|5', '2026-01-19 10:13:34', '2026-01-19 10:13:34'),
(21, '34', 'BOTNETOP', 'PUBG|Jjhhh|5|1', '2026-01-19 11:01:13', '2026-01-19 11:01:13'),
(22, '35', 'BOTNETOP', 'PUBG|Neyke|24|10', '2026-01-19 11:02:34', '2026-01-19 11:02:34'),
(23, '36', 'BOTNETOP', 'PUBG|BRUTA|24|10', '2026-01-19 13:08:10', '2026-01-19 13:08:10'),
(24, '37', 'BOTNETOP', 'PUBG|SAHIL|5|30', '2026-01-19 13:30:09', '2026-01-19 13:30:09'),
(25, '38', 'BOTNETOP', 'PUBG|GODGA|24|500', '2026-01-19 14:34:30', '2026-01-19 14:34:30'),
(26, '39', 'BOTNETOP', 'PUBG|Rb_ha|720|1', '2026-01-19 15:04:37', '2026-01-19 15:04:37'),
(27, '40', 'GODMODVIP', 'PUBG|GODMO|5|1', '2026-01-19 20:02:09', '2026-01-19 20:02:09'),
(28, '41', 'KHANBHAI76', 'PUBG|GODMO|24|10', '2026-01-19 20:19:59', '2026-01-19 20:19:59'),
(29, '42', 'BOTNETOP', 'PUBG|HARSH|168|1', '2026-01-19 22:36:34', '2026-01-19 22:36:34'),
(30, '43', 'ACRAZYGAMER001', 'PUBG|ACRAZ|2|1', '2026-01-20 08:09:24', '2026-01-20 08:09:24'),
(31, '44', 'ACRAZYGAMER001', 'PUBG|ACRAZ|2|1', '2026-01-20 08:20:00', '2026-01-20 08:20:00'),
(32, '45', 'ACRAZYGAMER001', 'PUBG|ACRAZ|2|1', '2026-01-20 08:20:29', '2026-01-20 08:20:29'),
(33, '46', 'ACRAZYGAMER001', 'PUBG|ACRAZ|2|1', '2026-01-20 08:20:38', '2026-01-20 08:20:38'),
(34, '47', 'BOTNETOP', 'PUBG|CONQU|24|900', '2026-01-20 11:10:06', '2026-01-20 11:10:06'),
(35, '48', 'BOTNETOP', 'PUBG|SKYKI|720|7', '2026-01-20 19:17:21', '2026-01-20 19:17:21'),
(36, '49', 'KHANBHAI76', 'PUBG|Rankp|24|10', '2026-01-20 20:31:02', '2026-01-20 20:31:02'),
(37, '50', 'BOTNETOP', 'PUBG|HATER|24|1000', '2026-01-20 21:41:12', '2026-01-20 21:41:12'),
(38, '51', 'BOTNETOP', 'PUBG|DEVIL|24|60', '2026-01-20 23:02:26', '2026-01-20 23:02:26'),
(39, '52', 'ACRAZYGAMER00', 'PUBG|ACRAZ|2|1', '2026-01-21 08:43:19', '2026-01-21 08:43:19'),
(40, '53', 'ACRAZYGAMER00', 'PUBG|ACRAZ|2|1', '2026-01-21 09:18:15', '2026-01-21 09:18:15'),
(41, '54', 'BOTNETOP', 'PUBG|HATER|24|1000', '2026-01-21 10:15:45', '2026-01-21 10:15:45'),
(42, '55', 'BOTNETOP', 'PUBG|Keyh|24|2', '2026-01-21 13:31:14', '2026-01-21 13:31:14'),
(43, '56', 'BOTNETOP', 'PUBG|Harsh|168|5', '2026-01-21 16:52:05', '2026-01-21 16:52:05'),
(44, '57', 'GODMODVIP', 'PUBG|GODMO|5|1', '2026-01-21 21:33:24', '2026-01-21 21:33:24'),
(45, '58', 'KHANBHAI76', 'PUBG|GODOP|2|1', '2026-01-22 07:58:55', '2026-01-22 07:58:55'),
(46, '59', 'ACRAZYGAMER00', 'PUBG|ACRAZ|2|1', '2026-01-22 14:58:21', '2026-01-22 14:58:21'),
(47, '60', 'BOTNETOP', 'PUBG|BOTNE|720|1', '2026-01-22 15:19:11', '2026-01-22 15:19:11'),
(48, '61', 'ACRAZYGAMER00', 'PUBG|ACRAZ|5|60', '2026-01-22 15:40:28', '2026-01-22 15:40:28'),
(49, '62', 'BOTNETOP', 'PUBG|GODMO|24|1000', '2026-01-22 15:42:24', '2026-01-22 15:42:24'),
(50, '63', 'KHANBHAI76', 'PUBG|Godub|24|10', '2026-01-22 16:47:41', '2026-01-22 16:47:41'),
(51, '64', 'KHANBHAI76', 'PUBG|GODUB|24|10', '2026-01-22 17:01:49', '2026-01-22 17:01:49'),
(52, '65', 'BOTNETOP', 'PUBG|SKTIG|720|1', '2026-01-22 18:09:38', '2026-01-22 18:09:38'),
(53, '66', 'BOTNETOP', 'PUBG|GODMO|24|500', '2026-01-22 19:21:49', '2026-01-22 19:21:49'),
(54, '67', 'BOTNETOP', 'PUBG|BOTNE|72|3', '2026-01-22 22:07:45', '2026-01-22 22:07:45'),
(55, '68', 'BOTNETOP', 'PUBG|Testi|5|30', '2026-01-23 07:40:01', '2026-01-23 07:40:01'),
(56, '69', 'BOTNETOP', 'PUBG|BOTNE|72|10', '2026-01-25 11:34:04', '2026-01-25 11:34:04'),
(57, '70', 'BOTNETOP', 'PUBG|Loade|24|30', '2026-01-25 11:39:12', '2026-01-25 11:39:12'),
(58, '71', 'BOTNETOP', 'PUBG|Botne|2|10', '2026-01-25 17:08:20', '2026-01-25 17:08:20'),
(59, '72', 'BOTNETOP', 'PUBG|GODMO|24|500', '2026-01-25 17:42:12', '2026-01-25 17:42:12'),
(60, '73', 'KHANBHAI76', 'PUBG|GODOP|24|5', '2026-01-25 18:28:09', '2026-01-25 18:28:09'),
(61, '74', 'BOTNETOP', 'PUBG|BOTNE|24|1', '2026-01-25 19:31:44', '2026-01-25 19:31:44'),
(62, '75', 'GODMODVIP', 'PUBG|GODMO|2|1', '2026-01-26 03:01:40', '2026-01-26 03:01:40'),
(63, '76', 'BOTNETOP', 'PUBG|Rb_ha|720|1', '2026-01-26 16:19:15', '2026-01-26 16:19:15'),
(64, '176', 'BOTNETOP', 'PUBG|BOTNE|24|60', '2026-01-26 18:58:22', '2026-01-26 18:58:22'),
(65, '276', 'BOTNETOP', 'PUBG|BOTNE|24|1', '2026-01-26 18:58:54', '2026-01-26 18:58:54'),
(66, '277', 'KHANBHAI76', 'PUBG|GODMO|24|10', '2026-01-26 19:05:49', '2026-01-26 19:05:49'),
(67, '278', 'BOTNETOP', 'PUBG|BOTNE|24|10', '2026-01-26 19:14:44', '2026-01-26 19:14:44'),
(68, '279', 'BOTNETOP', 'PUBG|OMPRA|72|10', '2026-01-26 19:19:33', '2026-01-26 19:19:33'),
(69, '280', 'BOTNETOP', 'PUBG|GODMO|24|1500', '2026-01-26 19:29:40', '2026-01-26 19:29:40'),
(70, '281', 'BOTNETOP', 'PUBG|GLOSY|168|3', '2026-01-26 20:49:56', '2026-01-26 20:49:56'),
(71, '282', 'KHANBHAI76', 'PUBG|GODMO|24|10', '2026-01-26 21:26:46', '2026-01-26 21:26:46'),
(72, '283', 'BOTNETOP', 'PUBG|OMPRA|168|5', '2026-01-27 07:21:05', '2026-01-27 07:21:05'),
(73, '284', 'BOTNETOP', 'PUBG|Rb_ha|720|2', '2026-01-27 07:25:35', '2026-01-27 07:25:35'),
(74, '285', 'BOTNETOP', 'PUBG|BOTNE|168|1', '2026-01-27 17:12:21', '2026-01-27 17:12:21'),
(75, '286', 'BOTNETOP', 'PUBG|BOTNE|2|2', '2026-01-27 20:10:53', '2026-01-27 20:10:53'),
(76, '287', 'BOTNETOP', 'PUBG|Pelo|5|10', '2026-01-27 20:30:54', '2026-01-27 20:30:54'),
(77, '288', 'BOTNETOP', 'PUBG|GODGA|24|1000', '2026-01-27 20:47:14', '2026-01-27 20:47:14'),
(78, '289', 'KHANBHAI76', 'PUBG|GODOP|24|10', '2026-01-27 20:50:04', '2026-01-27 20:50:04'),
(79, '290', 'BOTNETOP', 'PUBG|BOTNE|720|10', '2026-01-28 18:40:41', '2026-01-28 18:40:41'),
(80, '291', 'BOTNETOP', 'PUBG|BOTNE|720|1', '2026-01-28 18:52:56', '2026-01-28 18:52:56'),
(81, '292', 'BOTNETOP', 'PUBG|GODMO|24|1000', '2026-01-28 19:17:55', '2026-01-28 19:17:55'),
(82, '293', 'BOTNETOP', 'PUBG|GODOP|720|10', '2026-01-28 20:10:27', '2026-01-28 20:10:27'),
(83, '294', 'KHANBHAI76', 'PUBG|GODMO|24|10', '2026-01-28 20:18:17', '2026-01-28 20:18:17'),
(84, '295', 'ACRAZYGAMER00', 'PUBG|ACRAZ|2|1', '2026-01-28 20:26:16', '2026-01-28 20:26:16'),
(85, '296', 'ACRAZYGAMER00', 'PUBG|ACRAZ|2|1', '2026-01-28 20:26:30', '2026-01-28 20:26:30'),
(86, '297', 'ACRAZYGAMER00', 'PUBG|ACRAZ|24|100', '2026-01-28 20:43:03', '2026-01-28 20:43:03'),
(87, '298', 'BOTNETOP', 'PUBG|BOTNE|5|10', '2026-01-29 08:13:51', '2026-01-29 08:13:51'),
(88, '299', 'ACRAZYGAMER00', 'PUBG|ACRAZ|24|50', '2026-01-29 12:33:43', '2026-01-29 12:33:43'),
(89, '300', 'KHANBHAI76', 'PUBG|Harsh|24|1', '2026-01-29 12:43:10', '2026-01-29 12:43:10'),
(90, '301', 'ACRAZYGAMER00', 'PUBG|ACRAZ|24|1', '2026-01-29 18:20:34', '2026-01-29 18:20:34'),
(91, '302', 'KHANBHAI76', 'PUBG|Harsh|24|2', '2026-01-29 19:17:47', '2026-01-29 19:17:47'),
(92, '303', 'BOTNETOP', 'PUBG|BOTNE|24|1000', '2026-01-29 20:14:06', '2026-01-29 20:14:06'),
(93, '304', 'BOTNETOP', 'PUBG|GANDE|24|1000', '2026-01-29 20:17:09', '2026-01-29 20:17:09'),
(94, '305', 'ACRAZYGAMER00', 'PUBG|ACRAZ|5|25', '2026-01-29 21:23:56', '2026-01-29 21:23:56'),
(95, '306', 'ACRAZYGAMER00', 'PUBG|ACRAZ|24|150', '2026-01-30 10:11:21', '2026-01-30 10:11:21'),
(96, '307', 'KHANBHAI76', 'PUBG|Pushp|168|1', '2026-01-30 12:13:22', '2026-01-30 12:13:22'),
(97, '308', 'ACRAZYGAMER00', 'PUBG|ACRAZ|2|1', '2026-01-30 12:56:40', '2026-01-30 12:56:40'),
(98, '309', 'KHANBHAI76', 'PUBG|Faiza|2|1', '2026-01-30 14:53:26', '2026-01-30 14:53:26'),
(99, '310', 'BOTNETOP', 'PUBG|BOTNE|72|10', '2026-01-30 18:53:37', '2026-01-30 18:53:37'),
(100, '311', 'KHANBHAI76', 'PUBG|GODOP|2|5', '2026-01-30 18:55:13', '2026-01-30 18:55:13'),
(101, '312', 'KHANBHAI76', 'PUBG|Harsh|2|5', '2026-01-30 20:47:11', '2026-01-30 20:47:11'),
(102, '313', 'BOTNETOP', 'PUBG|GODMO|24|1000', '2026-01-30 20:58:05', '2026-01-30 20:58:05'),
(103, '314', 'ACRAZYGAMER00', 'PUBG|ACRAZ|24|50', '2026-01-31 10:34:07', '2026-01-31 10:34:07'),
(104, '315', 'BOTNETOP', 'PUBG|BOTNE|2|1', '2026-01-31 17:33:20', '2026-01-31 17:33:20'),
(105, '316', 'BOTNETOP', 'PUBG|GODMO|24|600', '2026-01-31 21:30:29', '2026-01-31 21:30:29'),
(106, '317', 'KHANBHAI76', 'PUBG|SPORT|24|10', '2026-01-31 21:40:36', '2026-01-31 21:40:36'),
(107, '318', 'BOTNETOP', 'PUBG|GODBO|720|10', '2026-02-01 11:50:57', '2026-02-01 11:50:57'),
(108, '319', 'BOTNETOP', 'PUBG|BOTNE|720|3', '2026-02-01 13:58:54', '2026-02-01 13:58:54'),
(109, '320', 'BOTNETOP', 'PUBG|GANDE|24|1000', '2026-02-01 14:02:42', '2026-02-01 14:02:42'),
(110, '321', 'KHANBHAI76', 'PUBG|Godof|2|1', '2026-02-01 16:22:20', '2026-02-01 16:22:20'),
(111, '322', 'KHANBHAI76', 'PUBG|OverK|2|1', '2026-02-01 16:29:22', '2026-02-01 16:29:22'),
(112, '323', 'ACRAZYGAMER00', 'PUBG|ACRAZ|24|50', '2026-02-01 18:25:01', '2026-02-01 18:25:01'),
(113, '324', 'ACRAZYGAMER00', 'PUBG|ACRAZ|168|1', '2026-02-01 20:06:17', '2026-02-01 20:06:17'),
(114, '325', 'BOTNETOP', 'PUBG|GODMO|720|10', '2026-02-02 15:16:06', '2026-02-02 15:16:06'),
(115, '326', 'BOTNETOP', 'PUBG|GODMO|72|2000', '2026-02-02 17:25:08', '2026-02-02 17:25:08'),
(116, '327', 'KHANBHAI76', 'PUBG|OWNER|24|10', '2026-02-02 17:52:13', '2026-02-02 17:52:13'),
(117, '328', 'ACRAZYGAMER00', 'PUBG|ACRAZ|24|50', '2026-02-02 21:04:44', '2026-02-02 21:04:44'),
(118, '329', 'KHANBHAI76', 'PUBG|Faisa|2|1', '2026-02-04 11:39:46', '2026-02-04 11:39:46'),
(119, '330', 'KHANBHAI76', 'PUBG|GODOP|24|10', '2026-02-04 12:18:49', '2026-02-04 12:18:49'),
(120, '331', 'BOTNETOP', 'PUBG|GODMO|24|1500', '2026-02-04 17:45:06', '2026-02-04 17:45:06'),
(121, '332', 'BOTNETOP', 'PUBG|Altam|720|3', '2026-02-04 17:45:49', '2026-02-04 17:45:49'),
(122, '333', 'BOTNETOP', 'PUBG|GODKE|2|3', '2026-02-04 17:51:10', '2026-02-04 17:51:10'),
(123, '334', 'ACRAZYGAMER00', 'PUBG|ACRAZ|24|50', '2026-02-04 20:05:46', '2026-02-04 20:05:46'),
(124, '335', 'BOTNETOP', 'PUBG|BOTNE|24|30', '2026-02-05 19:54:03', '2026-02-05 19:54:03'),
(125, '336', 'BOTNETOP', 'PUBG|GODMO|24|30', '2026-02-05 19:58:51', '2026-02-05 19:58:51'),
(126, '337', 'KHANBHAI76', 'PUBG|Abuta|2|1', '2026-02-05 20:39:42', '2026-02-05 20:39:42'),
(127, '338', 'KHANBHAI76', 'PUBG|Broth|2|5', '2026-02-05 20:52:56', '2026-02-05 20:52:56'),
(128, '339', 'ACRAZYGAMER00', 'PUBG|ACRAZ|24|50', '2026-02-06 00:42:17', '2026-02-06 00:42:17'),
(129, '340', 'BOTNETOP', 'PUBG|BOTNE|24|1000', '2026-02-06 20:29:18', '2026-02-06 20:29:18'),
(130, '341', 'KHANBHAI76', 'PUBG|GODLO|24|10', '2026-02-06 20:40:48', '2026-02-06 20:40:48'),
(131, '342', 'BOTNETOP', 'PUBG|GANDE|24|1000', '2026-02-07 14:56:25', '2026-02-07 14:56:25'),
(132, '343', 'BOTNETOP', 'PUBG|BOTNE|2|1', '2026-02-07 14:56:27', '2026-02-07 14:56:27'),
(133, '344', 'BOTNETOP', 'PUBG|BOTNE|2|10', '2026-02-07 20:18:19', '2026-02-07 20:18:19'),
(134, '345', 'BOTNETOP', 'PUBG|BOTNE|24|10', '2026-02-07 21:44:35', '2026-02-07 21:44:35'),
(135, '346', 'BOTNETOP', 'PUBG|GANDE|24|1000', '2026-02-07 22:35:51', '2026-02-07 22:35:51'),
(136, '347', 'BOTNETOP', 'PUBG|PRASA|720|5', '2026-02-08 13:19:42', '2026-02-08 13:19:42'),
(137, '348', 'KHANBHAI76', 'PUBG|GODMO|24|10', '2026-02-08 21:03:53', '2026-02-08 21:03:53'),
(138, '349', 'BOTNETOP', 'PUBG|GANDE|168|3000', '2026-02-08 23:09:47', '2026-02-08 23:09:47'),
(139, '350', 'BOTNETOP', 'PUBG|BOTNE|2|1', '2026-02-08 23:09:49', '2026-02-08 23:09:49'),
(140, '351', 'BOTNETOP', 'PUBG|Rb_ha|720|10', '2026-02-10 21:19:34', '2026-02-10 21:19:34'),
(141, '352', 'BOTNETOP', 'PUBG|HIMAN|720|10', '2026-02-11 20:45:59', '2026-02-11 20:45:59'),
(142, '353', 'KHANBHAI76', 'PUBG|GODMO|24|10', '2026-02-11 21:31:30', '2026-02-11 21:31:30'),
(143, '354', 'BOTNETOP', 'PUBG|GANDE|24|1000', '2026-02-11 21:37:54', '2026-02-11 21:37:54'),
(144, '355', 'KHANBHAI76', 'PUBG|GODMO|24|10', '2026-02-12 21:42:35', '2026-02-12 21:42:35'),
(145, '356', 'BOTNETOP', 'PUBG|GANDE|24|1000', '2026-02-12 22:00:26', '2026-02-12 22:00:26'),
(146, '357', 'BOTNETOP', 'PUBG|Arman|168|3', '2026-02-12 22:20:43', '2026-02-12 22:20:43'),
(147, '358', 'KHANBHAI76', 'PUBG|KHANO|720|2', '2026-02-13 17:40:45', '2026-02-13 17:40:45'),
(148, '359', 'KHANBHAI76', 'PUBG|GODMO|168|10', '2026-02-13 20:21:57', '2026-02-13 20:21:57'),
(149, '360', 'BOTNETOP', 'PUBG|GODLA|24|1000', '2026-02-13 20:48:05', '2026-02-13 20:48:05'),
(150, '361', 'BOTNETOP', 'PUBG|Omfo|336|10', '2026-02-14 21:17:11', '2026-02-14 21:17:11'),
(151, '362', 'BOTNETOP', 'PUBG|GODLA|24|1000', '2026-02-14 21:49:59', '2026-02-14 21:49:59'),
(152, '363', 'BOTNETOP', 'PUBG|SENDF|24|100', '2026-02-15 11:32:46', '2026-02-15 11:32:46'),
(153, '364', 'KHANBHAI76', 'PUBG|KHANO|24|5', '2026-02-15 20:32:40', '2026-02-15 20:32:40'),
(154, '365', 'BOTNETOP', 'PUBG|GANDM|24|1000', '2026-02-15 22:00:41', '2026-02-15 22:00:41'),
(155, '366', 'GODMODVIP', 'PUBG|GODMO|5|1', '2026-02-16 16:50:31', '2026-02-16 16:50:31'),
(156, '367', 'BOTNETOP', 'PUBG|Jaia|24|2', '2026-02-16 19:10:37', '2026-02-16 19:10:37'),
(157, '368', 'BOTNETOP', 'PUBG|Ajaja|24|2', '2026-02-16 19:46:50', '2026-02-16 19:46:50'),
(158, '369', 'BOTNETOP', 'PUBG|Ishwj|24|2', '2026-02-16 19:47:31', '2026-02-16 19:47:31'),
(159, '370', 'BOTNETOP', 'PUBG|Uwiwi|24|2', '2026-02-16 19:49:25', '2026-02-16 19:49:25'),
(160, '371', 'BOTNETOP', 'PUBG|Hwiwi|24|2', '2026-02-16 19:51:16', '2026-02-16 19:51:16'),
(161, '372', 'BOTNETOP', 'PUBG|Uaiaa|24|2', '2026-02-16 19:52:44', '2026-02-16 19:52:44'),
(162, '373', 'BOTNETOP', 'PUBG|Jakak|24|2', '2026-02-16 19:54:40', '2026-02-16 19:54:40'),
(163, '374', 'BOTNETOP', 'PUBG|Ssdff|24|2', '2026-02-16 19:57:12', '2026-02-16 19:57:12'),
(164, '375', 'BOTNETOP', 'PUBG|Kskos|24|2', '2026-02-16 19:58:04', '2026-02-16 19:58:04'),
(165, '425', 'BOTNETOP', 'PUBG|BOTNE|24|2', '2026-02-16 20:01:22', '2026-02-16 20:01:22'),
(166, '426', 'BOTNETOP', 'PUBG|GODLA|24|1000', '2026-02-16 20:16:42', '2026-02-16 20:16:42'),
(167, '427', 'KHANBHAI76', 'PUBG|KHANO|24|10', '2026-02-16 21:08:13', '2026-02-16 21:08:13'),
(168, '428', 'GODMODVIP', 'PUBG|GODMO|2|1', '2026-02-17 03:06:50', '2026-02-17 03:06:50'),
(169, '429', 'BOTNETOP', 'PUBG|BOTNE|720|3', '2026-02-17 08:49:30', '2026-02-17 08:49:30'),
(170, '430', 'GODMODVIP', 'PUBG|GODMO|168|1', '2026-02-17 19:52:02', '2026-02-17 19:52:02'),
(171, '431', 'KHANBHAI76', 'PUBG|KHANO|168|15', '2026-02-17 20:33:22', '2026-02-17 20:33:22'),
(172, '432', 'BOTNETOP', 'PUBG|GODLA|24|1000', '2026-02-17 20:45:19', '2026-02-17 20:45:19'),
(173, '433', 'BOTNETOP', 'PUBG|BOTNE|720|2', '2026-02-18 19:55:07', '2026-02-18 19:55:07'),
(174, '434', 'BOTNETOP', 'PUBG|ZAIDK|720|2', '2026-02-18 20:03:44', '2026-02-18 20:03:44'),
(175, '435', 'BOTNETOP', 'PUBG|GODMO|24|1000', '2026-02-18 20:14:51', '2026-02-18 20:14:51'),
(176, '436', 'BOTNETOP', 'PUBG|GODMO|24|1000', '2026-02-19 22:13:20', '2026-02-19 22:13:20'),
(177, '437', 'KHANBHAI76', 'PUBG|HARSH|24|2', '2026-02-20 14:47:35', '2026-02-20 14:47:35'),
(178, '438', 'KHANBHAI76', 'PUBG|Udayp|720|1', '2026-02-20 21:46:42', '2026-02-20 21:46:42'),
(179, '439', 'BOTNETOP', 'PUBG|AJAY|720|10', '2026-02-20 22:18:09', '2026-02-20 22:18:09'),
(180, '440', 'BOTNETOP', 'PUBG|GANDE|24|10000', '2026-02-20 22:23:25', '2026-02-20 22:23:25'),
(181, '441', 'BOTNETOP', 'PUBG|HIMAN|24|10', '2026-02-21 20:26:28', '2026-02-21 20:26:28'),
(182, '442', 'BOTNETOP', 'PUBG|GHAPA|24|1000', '2026-02-21 21:49:42', '2026-02-21 21:49:42'),
(183, '443', 'KHANBHAI76', 'PUBG|Ashis|720|1', '2026-02-21 21:55:51', '2026-02-21 21:55:51'),
(184, '444', 'BOTNETOP', 'PUBG|FOLLO|24|10000', '2026-02-22 17:11:57', '2026-02-22 17:11:57'),
(185, '445', 'BOTNETOP', 'PUBG|ADITY|24|5', '2026-02-23 17:36:41', '2026-02-23 17:36:41'),
(186, '446', 'BOTNETOP', 'PUBG|FOLLO|24|10000', '2026-02-23 17:50:22', '2026-02-23 17:50:22'),
(187, '447', 'BOTNETOP', 'PUBG|SHARE|24|500', '2026-02-24 22:42:30', '2026-02-24 22:42:30'),
(188, '448', 'BOTNETOP', 'PUBG|THANK|720|10', '2026-02-25 16:05:15', '2026-02-25 16:05:15'),
(189, '449', 'KHANBHAI76', 'PUBG|HARSH|168|2', '2026-02-25 16:44:04', '2026-02-25 16:44:04'),
(190, '450', 'BOTNETOP', 'PUBG|GODMO|24|1000', '2026-02-25 20:39:44', '2026-02-25 20:39:44'),
(191, '451', 'BOTNETOP', 'PUBG|GODMO|2|10000', '2026-02-26 20:19:18', '2026-02-26 20:19:18'),
(192, '452', 'BOTNETOP', 'PUBG|GODMO|24|1000', '2026-02-26 20:19:36', '2026-02-26 20:19:36'),
(193, '453', 'KHANBHAI76', 'PUBG|SAMEE|168|1', '2026-02-26 22:18:23', '2026-02-26 22:18:23'),
(194, '454', 'KHANBHAI76', 'PUBG|GODMO|2|2', '2026-02-26 22:27:29', '2026-02-26 22:27:29'),
(195, '455', 'KHANBHAI76', 'PUBG|SAMEE|168|1', '2026-02-26 22:29:09', '2026-02-26 22:29:09'),
(196, '456', 'BOTNETOP', 'PUBG|DEVIL|24|150', '2026-02-27 16:58:48', '2026-02-27 16:58:48'),
(197, '457', 'BOTNETOP', 'PUBG|BOTNE|24|500', '2026-02-27 19:57:01', '2026-02-27 19:57:01'),
(198, '458', 'BOTNETOP', 'PUBG|GODFA|24|1000', '2026-02-27 19:57:54', '2026-02-27 19:57:54'),
(199, '459', 'BOTNETOP', 'PUBG|GODBO|24|1000', '2026-02-28 15:15:36', '2026-02-28 15:15:36'),
(200, '460', 'KHANBHAI76', 'PUBG|GODMO|2|1', '2026-03-01 16:59:26', '2026-03-01 16:59:26'),
(201, '461', 'BOTNETOP', 'PUBG|BOTNE|24|1', '2026-03-01 20:09:54', '2026-03-01 20:09:54'),
(202, '462', 'BOTNETOP', 'PUBG|BOTNE|24|10', '2026-03-01 23:13:23', '2026-03-01 23:13:23'),
(203, '463', 'BOTNETOP', 'PUBG|GODBO|24|10000', '2026-03-01 23:20:19', '2026-03-01 23:20:19'),
(204, '464', 'KHANBHAI76', 'PUBG|TRAIL|24|1', '2026-03-02 21:42:35', '2026-03-02 21:42:35'),
(205, '465', 'KHANBHAI76', 'PUBG|Ashis|336|1', '2026-03-03 20:07:58', '2026-03-03 20:07:58'),
(206, '466', 'KHANBHAI76', 'PUBG|CHACK|2|1', '2026-03-03 21:34:53', '2026-03-03 21:34:53'),
(207, '467', 'KHANBHAI76', 'PUBG|Ashis|336|1', '2026-03-03 22:43:48', '2026-03-03 22:43:48'),
(208, '468', 'BOTNETOP', 'PUBG|2MATC|24|1000', '2026-03-04 18:15:14', '2026-03-04 18:15:14'),
(209, '469', 'BOTNETOP', 'PUBG|GODMO|24|1000', '2026-03-04 21:15:54', '2026-03-04 21:15:54'),
(210, '470', 'BOTNETOP', 'PUBG|BOOMB|24|1000', '2026-03-04 21:31:25', '2026-03-04 21:31:25'),
(211, '471', 'KHANBHAI76', 'PUBG|Ashis|336|1', '2026-03-04 21:42:52', '2026-03-04 21:42:52'),
(212, '472', 'KHANBHAI76', 'PUBG|SAMEE|24|1', '2026-03-04 21:44:04', '2026-03-04 21:44:04'),
(213, '473', 'BOTNETOP', 'PUBG|1KSOO|24|1000', '2026-03-05 16:59:54', '2026-03-05 16:59:54'),
(214, '474', 'BOTNETOP', 'PUBG|SUBSC|24|1000', '2026-03-06 12:27:17', '2026-03-06 12:27:17'),
(215, '475', 'KHANBHAI76', 'PUBG|Conqu|24|1', '2026-03-06 18:20:08', '2026-03-06 18:20:08'),
(216, '476', 'BOTNETOP', 'PUBG|200SU|24|1000', '2026-03-07 15:35:47', '2026-03-07 15:35:47'),
(217, '477', 'BOTNETOP', 'PUBG|SUBSC|24|1000', '2026-03-08 17:33:06', '2026-03-08 17:33:06'),
(218, '478', 'BOTNETOP', 'PUBG|SUBSC|24|300', '2026-03-08 21:23:17', '2026-03-08 21:23:17'),
(219, '479', 'BOTNETOP', 'PUBG|ENJOY|24|1000', '2026-03-09 22:11:40', '2026-03-09 22:11:40'),
(220, '480', 'BOTNETOP', 'PUBG|GODMO|24|1000', '2026-03-10 22:32:19', '2026-03-10 22:32:19'),
(221, '481', 'BOTNETOP', 'PUBG|Suppo|24|1000', '2026-03-11 16:56:46', '2026-03-11 16:56:46'),
(222, '482', 'BOTNETOP', 'PUBG|SUPPO|24|1000', '2026-03-11 21:51:05', '2026-03-11 21:51:05'),
(223, '483', 'BOTNETOP', 'PUBG|PLEAS|24|1000', '2026-03-12 19:44:16', '2026-03-12 19:44:16'),
(224, '484', 'BOTNETOP', 'PUBG|SUBSC|24|1000', '2026-03-13 17:36:12', '2026-03-13 17:36:12'),
(225, '485', 'BOTNETOP', 'PUBG|SUSCR|24|300', '2026-03-13 17:42:09', '2026-03-13 17:42:09'),
(226, '486', 'BOTNETOP', 'PUBG|SUBSC|24|300', '2026-03-13 17:42:50', '2026-03-13 17:42:50'),
(227, '487', 'BOTNETOP', 'PUBG|GODMO|24|300', '2026-03-14 20:49:50', '2026-03-14 20:49:50'),
(228, '488', 'BOTNETOP', 'PUBG|THANK|720|4', '2026-03-15 15:36:54', '2026-03-15 15:36:54'),
(229, '489', 'BOTNETOP', 'PUBG|ARMAN|720|2', '2026-03-15 19:42:00', '2026-03-15 19:42:00'),
(230, '490', 'BOTNETOP', 'PUBG|LASTD|24|150', '2026-03-15 21:50:01', '2026-03-15 21:50:01'),
(231, '491', 'BOTNETOP', 'PUBG|AJAYO|24|10', '2026-03-17 20:12:45', '2026-03-17 20:12:45'),
(232, '492', 'reseller', 'PUBG|resel|24|1', '2026-03-18 16:34:57', '2026-03-18 16:34:57'),
(233, '542', 'reseller', 'PUBG|resel|2|1', '2026-03-18 16:35:40', '2026-03-18 16:35:40');

-- --------------------------------------------------------

--
-- Table structure for table `keys_code`
--

CREATE TABLE `keys_code` (
  `id_keys` int(11) NOT NULL,
  `game` varchar(32) NOT NULL,
  `user_key` varchar(32) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `expired_date` datetime DEFAULT NULL,
  `max_devices` int(11) DEFAULT NULL,
  `devices` mediumtext DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `registrator` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Dumping data for table `keys_code`
--

INSERT INTO `keys_code` (`id_keys`, `game`, `user_key`, `duration`, `expired_date`, `max_devices`, `devices`, `status`, `registrator`, `created_at`, `updated_at`, `created_by`) VALUES
(493, 'PUBG', 'reseller-2-S4hyo', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(494, 'PUBG', 'reseller-2-wInBs', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(495, 'PUBG', 'reseller-2-ndPJU', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(496, 'PUBG', 'reseller-2-omOHT', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(497, 'PUBG', 'reseller-2-epyT7', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(498, 'PUBG', 'reseller-2-KqB2R', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(499, 'PUBG', 'reseller-2-3GvsA', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(500, 'PUBG', 'reseller-2-8UtIb', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(501, 'PUBG', 'reseller-2-SqPY6', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(502, 'PUBG', 'reseller-2-qF6Tc', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(503, 'PUBG', 'reseller-2-GywkH', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(504, 'PUBG', 'reseller-2-zex7v', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(505, 'PUBG', 'reseller-2-qc9hD', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(506, 'PUBG', 'reseller-2-JT5vW', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(507, 'PUBG', 'reseller-2-VKAyS', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(508, 'PUBG', 'reseller-2-TD5Af', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(509, 'PUBG', 'reseller-2-K9SaD', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(510, 'PUBG', 'reseller-2-PhkGB', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(511, 'PUBG', 'reseller-2-samrA', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(512, 'PUBG', 'reseller-2-ReVur', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(513, 'PUBG', 'reseller-2-qL7OP', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(514, 'PUBG', 'reseller-2-WL41i', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(515, 'PUBG', 'reseller-2-TSmO3', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(516, 'PUBG', 'reseller-2-cXpDk', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(517, 'PUBG', 'reseller-2-MS1T2', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(518, 'PUBG', 'reseller-2-7xUao', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(519, 'PUBG', 'reseller-2-rYqiK', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(520, 'PUBG', 'reseller-2-6vuGE', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(521, 'PUBG', 'reseller-2-KcfWO', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(522, 'PUBG', 'reseller-2-DrnRf', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(523, 'PUBG', 'reseller-2-L7I9u', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(524, 'PUBG', 'reseller-2-9KBQz', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(525, 'PUBG', 'reseller-2-p3gqf', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(526, 'PUBG', 'reseller-2-U07gj', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(527, 'PUBG', 'reseller-2-rxdmW', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(528, 'PUBG', 'reseller-2-ISvVd', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(529, 'PUBG', 'reseller-2-xRhOS', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(530, 'PUBG', 'reseller-2-8fgJY', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(531, 'PUBG', 'reseller-2-VspB5', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(532, 'PUBG', 'reseller-2-4cD7e', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(533, 'PUBG', 'reseller-2-pwN91', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(534, 'PUBG', 'reseller-2-vilsw', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(535, 'PUBG', 'reseller-2-pntU8', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(536, 'PUBG', 'reseller-2-IJysl', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(537, 'PUBG', 'reseller-2-18F2O', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(538, 'PUBG', 'reseller-2-QWjsc', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(539, 'PUBG', 'reseller-2-cTlh8', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(540, 'PUBG', 'reseller-2-fz9w6', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(541, 'PUBG', 'reseller-2-wrdsg', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0),
(542, 'PUBG', 'reseller-2-aIDS4', 2, NULL, 1, NULL, 1, 'reseller', '2026-03-18 16:35:40', '2026-03-18 16:35:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lib`
--

CREATE TABLE `lib` (
  `id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `file_size` varchar(32) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `lib`
--

INSERT INTO `lib` (`id`, `file`, `file_type`, `file_size`, `time`) VALUES
(1, 'lib.so', 'Onlinelib/lib.so', '555 KB', '2022-06-04 23:43:38');

-- --------------------------------------------------------

--
-- Table structure for table `modname`
--

CREATE TABLE `modname` (
  `id` int(11) NOT NULL,
  `modname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `modname`
--

INSERT INTO `modname` (`id`, `modname`) VALUES
(1, 'VIP MOD');

-- --------------------------------------------------------

--
-- Table structure for table `onoff`
--

CREATE TABLE `onoff` (
  `id` int(11) NOT NULL,
  `status` varchar(5) NOT NULL,
  `myinput` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `onoff`
--

INSERT INTO `onoff` (`id`, `status`, `myinput`) VALUES
(1, 'off', '');

-- --------------------------------------------------------

--
-- Table structure for table `referral_code`
--

CREATE TABLE `referral_code` (
  `id_reff` int(11) NOT NULL,
  `code` varchar(128) NOT NULL,
  `Referral` varchar(7) NOT NULL,
  `level` int(11) NOT NULL,
  `set_saldo` int(11) NOT NULL DEFAULT 0,
  `used_by` varchar(66) NOT NULL,
  `created_by` varchar(66) NOT NULL DEFAULT 'Owner',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `acc_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Dumping data for table `referral_code`
--

INSERT INTO `referral_code` (`id_reff`, `code`, `Referral`, `level`, `set_saldo`, `used_by`, `created_by`, `created_at`, `updated_at`, `acc_expiration`) VALUES
(1, 'daa3aa485d207403dfc684aa90499431', 'single', 2, 5000000, '', 'admin', '2025-12-12 11:31:40', '2025-12-12 11:31:40', '2026-01-11 11:31:39'),
(2, 'f6dbc2ec4961fbdab51d5096852f3a86', 'tCM6up', 2, 50000000, 'admin1', 'admin', '2025-12-12 12:36:46', '2025-12-12 12:37:11', '2026-01-11 12:36:46'),
(3, '4cbf5a7fa4eaa2fdbce63d936f1a173e', 'yTHQF1', 1, 5, 'reseller', 'admin1', '2025-12-12 12:47:47', '2025-12-12 12:53:04', '2025-12-13 12:47:47'),
(4, '94c9d150eb9285f253cf2eb87f0dd933', '2oXuv5', 1, 5000, '', 'admin1', '2025-12-12 12:51:00', '2025-12-12 12:51:00', '2025-12-13 12:51:00'),
(5, '63c6b84168f742a59552d8c2d9cf7940', 'TeUZhS', 3, 100000, 'KHANBHAI76', 'admin', '2026-01-16 10:33:35', '2026-01-16 10:46:33', '2026-03-17 10:33:35'),
(6, '00986163f133802e3e95dc0517becba5', 'Qu6nBG', 1, 5, '', 'admin1', '2026-01-16 11:52:25', '2026-01-16 11:52:25', '2026-02-15 11:52:25'),
(7, 'ac3e7ca4d34c7fe7f6cf2e4a9eea2ba4', 'SBv95G', 3, 2500, 'GODMODVIP', 'BOTNETOP', '2026-01-18 15:40:16', '2026-01-18 15:49:35', '2026-03-19 15:40:16'),
(8, 'cd763ecbb35d0031b2cb4a917ba87533', 'IAJrmd', 3, 500, 'ACRAZYGAMER001', 'BOTNETOP', '2026-01-19 20:37:04', '2026-01-19 20:44:56', '2026-02-18 20:37:04'),
(9, 'ead5e1c3af80c17a49d5b39d7cc94f70', 'PNaApj', 2, 2147483647, 'ACRAZYGAMER00', 'BOTNETOP', '2026-01-21 08:14:07', '2026-01-21 08:42:37', '2026-03-22 08:14:07'),
(10, '2b368c4ae19ab9b612b55350ebbe8b67', 'bk4ozV', 2, 50000, 'admin', 'owner', '2026-03-18 16:30:30', '2026-03-18 16:31:16', '2026-04-17 16:30:30'),
(11, '507dcb1fc27edd2f397ec32c4fc0ffd2', 'CGME0b', 3, 500000, 'reseller', 'admin', '2026-03-18 16:31:47', '2026-03-18 16:32:44', '2026-04-02 16:31:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `fullname` varchar(155) DEFAULT NULL,
  `username` varchar(66) NOT NULL,
  `email` varchar(40) NOT NULL,
  `reset_link_token` varchar(255) NOT NULL,
  `exp_date` varchar(250) NOT NULL,
  `level` int(11) NOT NULL,
  `saldo` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `uplink` varchar(66) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 3,
  `parent_id` int(11) DEFAULT NULL,
  `user_ip` varchar(155) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `fullname`, `username`, `email`, `reset_link_token`, `exp_date`, `level`, `saldo`, `status`, `uplink`, `password`, `role`, `parent_id`, `user_ip`, `created_at`, `updated_at`, `expiration_date`) VALUES
(1, 'ADITYA', 'owner', 'support@aloneboy.com', 'a886a84c38036225b4bcabfd81e7d1f0582', '2050-07-23 01:22:54', 1, 2138995454, 1, 'Owner', '$2y$08$/CsSVgrGgCqVcievCuR2COPnlMIpRz6kA.hzItBD/xd1Cx0hj0kMK', 3, 0, '42.109.149.*', '2022-06-22 22:15:21', '2026-03-17 20:12:45', '2050-01-01 00:00:00'),
(9, 'Kumar', 'admin', '', '', '', 2, 50000, 1, 'owner', '$2y$08$WF3NAhIImEsSWR1EE5fFjOwqfdKRIdYYfXFNV55BCVVjPgu.XY/RK', 3, NULL, '2406:7400:50:2fb:4840:b892:185c:868e', '2026-03-18 16:31:16', '2026-03-18 16:31:16', '2026-04-17 16:30:30'),
(10, 'raja', 'reseller', '', '', '', 3, 499910, 1, 'admin', '$2y$08$HV/KcU3KElwabFCfZ5NaseSWvQDp2S7lTvxLaHok76KdaFzN38ckO', 3, NULL, '2406:7400:50:2fb:4840:b892:185c:868e', '2026-03-18 16:32:43', '2026-03-18 16:35:40', '2026-04-02 16:31:47');

-- --------------------------------------------------------

--
-- Table structure for table `_ftext`
--

CREATE TABLE `_ftext` (
  `id` int(11) NOT NULL,
  `_status` varchar(100) NOT NULL,
  `_ftext` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `_ftext`
--

INSERT INTO `_ftext` (`id`, `_status`, `_ftext`) VALUES
(1, 'Safe', 'MOD STATUS :- 100% SAFE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credit`
--
ALTER TABLE `credit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Feature`
--
ALTER TABLE `Feature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `keys_code`
--
ALTER TABLE `keys_code`
  ADD PRIMARY KEY (`id_keys`),
  ADD UNIQUE KEY `user_key` (`user_key`),
  ADD KEY `idx_created_by` (`created_by`);

--
-- Indexes for table `lib`
--
ALTER TABLE `lib`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modname`
--
ALTER TABLE `modname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onoff`
--
ALTER TABLE `onoff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_code`
--
ALTER TABLE `referral_code`
  ADD PRIMARY KEY (`id_reff`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `username` (`username`,`email`),
  ADD KEY `idx_role` (`role`),
  ADD KEY `idx_parent` (`parent_id`);

--
-- Indexes for table `_ftext`
--
ALTER TABLE `_ftext`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `credit`
--
ALTER TABLE `credit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Feature`
--
ALTER TABLE `Feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `keys_code`
--
ALTER TABLE `keys_code`
  MODIFY `id_keys` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=543;

--
-- AUTO_INCREMENT for table `lib`
--
ALTER TABLE `lib`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `modname`
--
ALTER TABLE `modname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `onoff`
--
ALTER TABLE `onoff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `referral_code`
--
ALTER TABLE `referral_code`
  MODIFY `id_reff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `_ftext`
--
ALTER TABLE `_ftext`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
