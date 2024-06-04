-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: sql681.your-server.de
-- Generation Time: Jun 04, 2024 at 08:01 AM
-- Server version: 10.11.6-MariaDB-0+deb12u1
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rtmis_db1`
--

-- --------------------------------------------------------

--
-- Table structure for table `clockins`
--

CREATE TABLE `clockins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `long` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clockins`
--

INSERT INTO `clockins` (`id`, `user_id`, `time`, `lat`, `long`, `created_at`, `updated_at`) VALUES
(1, 1, '1711625728', '32.45567', '44.4594', '2024-03-28 10:35:30', '2024-03-28 10:35:30'),
(2, 1, '1712041609', '32.45567', '44.4594', '2024-04-02 05:06:50', '2024-04-02 05:06:50'),
(21, 1, '1712398432', '-1.3253795', '36.896395', '2024-04-06 08:13:52', '2024-04-06 08:13:52'),
(23, 1, '1712672276', '-1.1871527', '36.9935586', '2024-04-09 12:17:58', '2024-04-09 12:17:58'),
(24, 1, '3232', '23.23', '23.323', '2024-04-09 12:20:01', '2024-04-09 12:20:01'),
(25, 1, '1712672427', '-1.176953', '36.989393', '2024-04-09 12:20:29', '2024-04-09 12:20:29'),
(26, 1, '1712672451', '-1.176953', '36.989393', '2024-04-09 12:20:52', '2024-04-09 12:20:52'),
(29, 1, '1712824558', '-1.1769265', '36.9894034', '2024-04-11 06:35:59', '2024-04-11 06:35:59'),
(30, 1, '1712824605', '-1.1769265', '36.9894034', '2024-04-11 06:36:47', '2024-04-11 06:36:47'),
(31, 1, '1713345452', '-1.1769493', '36.9893889', '2024-04-17 07:17:32', '2024-04-17 07:17:32'),
(32, 1, '1713432860', '-1.1769535', '36.9893802', '2024-04-18 07:34:21', '2024-04-18 07:34:21'),
(51, 1, '1714055537', '-1.3300619', '36.8628608', '2024-04-25 15:32:17', '2024-04-25 15:32:17'),
(53, 1, '1714122321', '-1.1769122', '36.9893843', '2024-04-26 10:05:23', '2024-04-26 10:05:23'),
(54, 1, '1714122625', '-1.1769274', '36.9893639', '2024-04-26 10:10:26', '2024-04-26 10:10:26'),
(55, 1, '1714319385', '-1.3254585', '36.8963268', '2024-04-28 16:49:45', '2024-04-28 16:49:45'),
(56, 1, '1714474972', '-1.1769349', '36.9894486', '2024-04-30 12:02:54', '2024-04-30 12:02:54'),
(57, 1, '1714630214', '-1.1768182', '36.9898512', '2024-05-02 07:10:16', '2024-05-02 07:10:16'),
(58, 1, '1714983143', '-1.3253746', '36.8961436', '2024-05-06 09:12:23', '2024-05-06 09:12:23'),
(59, 1, '1715060898', '-1.1769819', '36.9895626', '2024-05-07 06:48:18', '2024-05-07 06:48:18'),
(60, 2, '1715233204', '-1.1769873', '36.9895493', '2024-05-09 06:40:04', '2024-05-09 06:40:04'),
(61, 2, '1715233490', '-1.1769873', '36.9895493', '2024-05-09 06:44:50', '2024-05-09 06:44:50'),
(62, 2, '1715233510', '-1.1769873', '36.9895493', '2024-05-09 06:45:10', '2024-05-09 06:45:10'),
(63, 2, '1715239194', '-1.1769818', '36.9895616', '2024-05-09 08:19:54', '2024-05-09 08:19:54'),
(64, 2, '1715239383', '-1.1769818', '36.9895616', '2024-05-09 08:23:02', '2024-05-09 08:23:02'),
(65, 2, '1715319981', '-1.3253514', '36.8962168', '2024-05-10 06:46:21', '2024-05-10 06:46:21'),
(66, 3, '1715532897', '-1.3254095', '36.8962705', '2024-05-12 17:54:56', '2024-05-12 17:54:56'),
(67, 3, '1715580079', '-1.1769859', '36.9895594', '2024-05-13 07:01:18', '2024-05-13 07:01:18'),
(68, 1, '1715580111', '-1.1769859', '36.9895594', '2024-05-12 07:01:49', '2024-05-13 07:01:49'),
(69, 5, '1715587740', '-1.1769322', '36.9894742', '2024-05-13 09:08:59', '2024-05-13 09:08:59'),
(70, 4, '1715587922', '-1.1769322', '36.9894742', '2024-05-13 09:12:00', '2024-05-13 09:12:00'),
(71, 1, '1715598107', '-1.1769872', '36.9895491', '2024-05-13 12:01:49', '2024-05-13 12:01:49'),
(72, 1, '1715776594', '-1.1769704', '36.9894302', '2024-05-15 13:36:36', '2024-05-15 13:36:36'),
(74, 1, '1715867658', '-1.1769699', '36.9894287', '2024-05-16 14:54:20', '2024-05-16 14:54:20'),
(75, 1, '1715930292', '-1.1769701', '36.9894294', '2024-05-17 08:18:13', '2024-05-17 08:18:13'),
(76, 1, '1716035645', '-1.2732866', '36.8171206', '2024-05-18 13:34:07', '2024-05-18 13:34:07'),
(77, 1, '1716068368', '-1.325286', '36.8961633', '2024-05-18 22:39:30', '2024-05-18 22:39:30'),
(78, 1, '1716177136', '-1.325314', '36.8965099', '2024-05-20 04:52:17', '2024-05-20 04:52:17'),
(82, 1, '1716269235', '-1.1769549', '36.9894059', '2024-05-21 06:27:16', '2024-05-21 06:27:16'),
(83, 1, '1716348166', '-1.3253386', '36.8963182', '2024-05-22 04:22:47', '2024-05-22 04:22:47'),
(84, 1, '1716435685', '-1.3253471', '36.8962619', '2024-05-23 04:41:26', '2024-05-23 04:41:26'),
(85, 4, '1716458166', '-1.1769497', '36.9894056', '2024-05-23 10:56:07', '2024-05-23 10:56:07'),
(86, 1, '1716512959', '-1.3253348', '36.8962288', '2024-05-24 02:09:20', '2024-05-24 02:09:20'),
(87, 1, '1716609418', '-1.2845381', '36.82495', '2024-05-25 04:56:59', '2024-05-25 04:56:59'),
(90, 1, '1716825979', '-1.2159463', '36.9912089', '2024-05-27 17:06:20', '2024-05-27 17:06:20'),
(91, 1, '1716863369', '-1.3253423', '36.896244', '2024-05-28 03:29:30', '2024-05-28 03:29:30'),
(92, 1, '1716994588', '-1.284115', '36.8232953', '2024-05-29 15:56:29', '2024-05-29 15:56:29'),
(93, 1, '1717045473', '-1.1857244', '36.992216', '2024-05-30 06:04:34', '2024-05-30 06:04:34'),
(105, 1, '1717157039', '-1.1769211', '36.9893068', '2024-05-31 13:04:01', '2024-05-31 13:04:01'),
(106, 1, '1717333941', '-1.3253304', '36.8963581', '2024-06-02 14:12:24', '2024-06-02 14:12:24');

-- --------------------------------------------------------

--
-- Table structure for table `clockouts`
--

CREATE TABLE `clockouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `long` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clockouts`
--

INSERT INTO `clockouts` (`id`, `user_id`, `time`, `lat`, `long`, `created_at`, `updated_at`) VALUES
(6, 1, '1712337448', '-1.3253343', '36.896132', '2024-04-05 15:17:29', '2024-04-05 15:17:29'),
(7, 1, '1712337452', '-1.3253343', '36.896132', '2024-04-05 15:17:33', '2024-04-05 15:17:33'),
(19, 4, '1716458294', '-1.1769524', '36.9894056', '2024-05-23 10:58:15', '2024-05-23 10:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `competitors`
--

CREATE TABLE `competitors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `visit_id` int(11) NOT NULL,
  `brand_visibility` longtext NOT NULL,
  `pricing` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `competitors`
--

INSERT INTO `competitors` (`id`, `user_id`, `outlet_id`, `visit_id`, `brand_visibility`, `pricing`, `created_at`, `updated_at`) VALUES
(1, '1', 2, 3, 'YProduct posters have been updated', 'XProduct reduced to KSh. 300', '2024-04-11 12:38:46', '2024-04-11 12:38:46'),
(2, '1', 3, 45, 'No change in branding', 'Prices are the same', '2024-04-11 12:51:37', '2024-04-11 12:51:37'),
(3, '1', 3, 69, 'More units of XProduct available', 'ZProduct is on offer at KSh. 110', '2024-04-26 11:47:07', '2024-04-26 11:47:07'),
(4, '1', 16, 77, ' No change in branding', 'YProduct reduced to KSh. 200', '2024-04-26 15:29:57', '2024-04-26 15:29:57'),
(5, '1', 3, 101, 'XProduct banners have been placed', 'Prices are the same', '2024-05-07 15:20:34', '2024-05-07 15:20:34'),
(6, '2', 30, 112, 'No change in branding', 'Prices are the same', '2024-05-09 12:38:34', '2024-05-09 12:38:34'),
(9, '1', 38, 237, 'Banners have been placed above ours', 'Prices are lower than ours', '2024-05-27 09:02:21', '2024-05-27 09:02:21'),
(10, '1', 38, 238, 'XProduct banners placed', 'XProduct offer to KSh. 90', '2024-05-27 12:03:04', '2024-05-27 12:03:04'),
(11, '1', 94, 251, 'Products are well placed', 'Prices have reduced', '2024-05-29 15:59:32', '2024-05-29 15:59:32'),
(12, '1', 93, 265, 'The products have been well placed and the posters and banners updated this week', 'Huawei Note 20 has been reduced to KSh. 64,500', '2024-05-31 09:43:36', '2024-05-31 09:43:36'),
(13, '1', 93, 274, 'The competitor has removed their banners', 'New Sony Xperia X poster spotted at the entrance', '2024-05-31 14:29:21', '2024-05-31 14:29:21'),
(14, '1', 99, 277, 'Samsung Galaxy Note 20 banner has been placed on the entrance', 'The prices observed last week are exactly the same', '2024-06-02 15:15:23', '2024-06-02 15:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `visit_id` int(11) NOT NULL,
  `feedback` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `outlet_id`, `visit_id`, `feedback`, `created_at`, `updated_at`) VALUES
(1, '1', 2, 3, 'Change of shop owner', '2024-04-11 11:42:44', '2024-04-11 11:42:44'),
(2, '1', 2, 3, 'Fridge is faulty', '2024-04-11 11:45:00', '2024-04-11 11:45:00'),
(3, '1', 2, 3, 'Everything is fine', '2024-04-11 12:28:03', '2024-04-11 12:28:03'),
(4, '1', 3, 45, 'Clients are happy', '2024-04-11 12:54:00', '2024-04-11 12:54:00'),
(5, '1', 3, 69, 'Needs more stock', '2024-04-26 11:47:26', '2024-04-26 11:47:26'),
(6, '1', 16, 77, 'Retailer is considering moving', '2024-04-26 15:20:13', '2024-04-26 15:20:13'),
(7, '1', 2, 100, 'Requires latest products', '2024-05-07 15:18:10', '2024-05-07 15:18:10'),
(8, '1', 3, 101, 'XProduct is fast moving', '2024-05-07 15:20:14', '2024-05-07 15:20:14'),
(9, '2', 4, 109, 'YProduct is slow', '2024-05-09 08:03:19', '2024-05-09 08:03:19'),
(10, '2', 30, 112, 'ZProduct isn\'t available', '2024-05-09 12:39:04', '2024-05-09 12:39:04'),
(13, '1', 38, 237, 'The store is doing quite well', '2024-05-27 09:03:03', '2024-05-27 09:03:03'),
(14, '1', 38, 238, 'YProduct is fast moving', '2024-05-27 12:03:30', '2024-05-27 12:03:30'),
(15, '1', 84, 239, 'The products are well placed', '2024-05-28 04:41:56', '2024-05-28 04:41:56'),
(16, '1', 94, 251, 'Retailer is happy', '2024-05-29 15:59:55', '2024-05-29 15:59:55'),
(17, '1', 93, 265, 'Retailer says clients want products with more variety', '2024-05-31 09:44:11', '2024-05-31 09:44:11'),
(18, '1', 93, 274, 'The retailer requested that we should offer credit similar to CompetitorX', '2024-05-31 14:30:17', '2024-05-31 14:30:17'),
(19, '1', 99, 277, 'The retailer is very happy with our products', '2024-06-02 15:15:57', '2024-06-02 15:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `log`, `created_at`, `updated_at`) VALUES
(1, ' OutletLat: \"23.3222\"\' OutletLong: \"23.32\" CheckinLat: \"23.32232\" CheckinLong: \"23.23223\"', '2024-05-22 08:41:52', '2024-05-22 08:41:52'),
(2, ' OutletLat: -1.1769549 OutletLong: 36.9894059 CheckinLat: -1.1812084 CheckinLong: 36.9875164', '2024-05-22 08:44:02', '2024-05-22 08:44:02'),
(3, ' OutletLat: -1.1769458 OutletLong: 36.9894008 CheckinLat: -1.1812084 CheckinLong: 36.9875164', '2024-05-22 08:44:42', '2024-05-22 08:44:42'),
(4, ' OutletLat: -1.1769518 OutletLong: 36.9893972 CheckinLat: -1.3228712 CheckinLong: 36.899175', '2024-05-22 08:52:38', '2024-05-22 08:52:38'),
(5, ' OutletLat: -1.1769439 OutletLong: 36.9893962 CheckinLat: -1.3228712 CheckinLong: 36.899175', '2024-05-22 08:55:08', '2024-05-22 08:55:08'),
(6, ' OutletLat: -1.1812084 OutletLong: 36.9875164 CheckinLat: -1.176951 CheckinLong: 36.9894062', '2024-05-22 09:41:52', '2024-05-22 09:41:52'),
(7, ' OutletLat: -1.2652733 OutletLong: 36.9849099 CheckinLat: -1.1769526 CheckinLong: 36.9894074', '2024-05-22 09:45:08', '2024-05-22 09:45:08'),
(8, ' OutletLat: -1.3234707 OutletLong: 36.896206 CheckinLat: -1.1769332 CheckinLong: 36.9893338', '2024-05-22 09:48:13', '2024-05-22 09:48:13'),
(9, ' OutletLat: -1.1769699 OutletLong: 36.9894287 CheckinLat: -1.176894 CheckinLong: 36.9894172', '2024-05-22 09:56:57', '2024-05-22 09:56:57'),
(10, ' OutletLat: -1.1769699 OutletLong: 36.9894287 CheckinLat: -1.176894 CheckinLong: 36.9894172', '2024-05-22 09:56:57', '2024-05-22 09:56:57'),
(11, ' OutletLat: -1.1769859 OutletLong: 36.9895594 CheckinLat: -1.1769532 CheckinLong: 36.9893981', '2024-05-22 09:57:46', '2024-05-22 09:57:46'),
(12, ' OutletLat: -1.1769859 OutletLong: 36.9895594 CheckinLat: -1.1769532 CheckinLong: 36.9893981', '2024-05-22 09:57:46', '2024-05-22 09:57:46'),
(13, ' OutletLat: -1.3228712 OutletLong: 36.899175 CheckinLat: -1.1769153 CheckinLong: 36.9893571', '2024-05-22 10:01:24', '2024-05-22 10:01:24'),
(14, ' OutletLat: -1.1812084 OutletLong: 36.9875164 CheckinLat: -1.1769536 CheckinLong: 36.9893994', '2024-05-22 10:02:58', '2024-05-22 10:02:58'),
(15, ' OutletLat: 15.6789 OutletLong: 15.6789 CheckinLat: -1.1766063 CheckinLong: 36.9894838', '2024-05-22 12:04:50', '2024-05-22 12:04:50'),
(16, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1766035 CheckinLong: 36.9894776', '2024-05-22 12:04:55', '2024-05-22 12:04:55'),
(17, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1766035 CheckinLong: 36.9894776', '2024-05-22 12:04:58', '2024-05-22 12:04:58'),
(18, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.176606 CheckinLong: 36.9894775', '2024-05-22 12:22:27', '2024-05-22 12:22:27'),
(19, ' OutletLat: -1.1812084 OutletLong: 36.9875164 CheckinLat: -1.1766049 CheckinLong: 36.9894748', '2024-05-22 12:55:14', '2024-05-22 12:55:14'),
(20, ' OutletLat: \"23.3222\"\' OutletLong: \"23.32\" CheckinLat: \"23.32232\" CheckinLong: \"23.23223\"', '2024-05-22 13:09:37', '2024-05-22 13:09:37'),
(21, ' OutletLat: -1.1812084 OutletLong: 36.9875164 CheckinLat: -1.1769549 CheckinLong: 36.9894059', '2024-05-22 16:13:35', '2024-05-22 16:13:35'),
(22, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1769248 CheckinLong: 36.9893548', '2024-05-22 16:14:03', '2024-05-22 16:14:03'),
(23, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1769248 CheckinLong: 36.9893548', '2024-05-22 16:14:03', '2024-05-22 16:14:03'),
(24, ' OutletLat: -1.1812084 OutletLong: 36.9875164 CheckinLat: -1.3253293 CheckinLong: 36.896306', '2024-05-23 04:41:36', '2024-05-23 04:41:36'),
(25, ' OutletLat: -1.3234152 OutletLong: 36.8992693 CheckinLat: -1.3234257 CheckinLong: 36.8993211', '2024-05-23 05:04:59', '2024-05-23 05:04:59'),
(26, ' OutletLat: -1.3234152 OutletLong: 36.8992693 CheckinLat: -1.3234257 CheckinLong: 36.8993211', '2024-05-23 05:04:59', '2024-05-23 05:04:59'),
(27, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.3234014 CheckinLong: 36.8993298', '2024-05-23 05:13:15', '2024-05-23 05:13:15'),
(28, ' OutletLat: -1.3234152 OutletLong: 36.8992693 CheckinLat: -1.3234158 CheckinLong: 36.8993311', '2024-05-23 05:18:27', '2024-05-23 05:18:27'),
(29, ' OutletLat: -1.3234152 OutletLong: 36.8992693 CheckinLat: -1.3234158 CheckinLong: 36.8993311', '2024-05-23 05:18:27', '2024-05-23 05:18:27'),
(30, ' OutletLat: -1.2640292 OutletLong: 36.9808665 CheckinLat: -1.2637445 CheckinLong: 36.9826541', '2024-05-23 05:52:15', '2024-05-23 05:52:15'),
(31, ' OutletLat: -1.2637406 OutletLong: 36.982659 CheckinLat: -1.2637414 CheckinLong: 36.982658', '2024-05-23 05:52:30', '2024-05-23 05:52:30'),
(32, ' OutletLat: -1.2637406 OutletLong: 36.982659 CheckinLat: -1.2637414 CheckinLong: 36.982658', '2024-05-23 05:52:30', '2024-05-23 05:52:30'),
(33, ' OutletLat: -1.2637462 OutletLong: 36.9826606 CheckinLat: -1.2637422 CheckinLong: 36.9826578', '2024-05-23 06:01:37', '2024-05-23 06:01:37'),
(34, ' OutletLat: -1.2637462 OutletLong: 36.9826606 CheckinLat: -1.2637422 CheckinLong: 36.9826578', '2024-05-23 06:01:37', '2024-05-23 06:01:37'),
(35, ' OutletLat: -1.2637416 OutletLong: 36.9826575 CheckinLat: -1.2637417 CheckinLong: 36.9826582', '2024-05-23 06:02:12', '2024-05-23 06:02:12'),
(36, ' OutletLat: -1.2637416 OutletLong: 36.9826575 CheckinLat: -1.2637417 CheckinLong: 36.9826582', '2024-05-23 06:02:12', '2024-05-23 06:02:12'),
(37, ' OutletLat: -1.2637406 OutletLong: 36.982659 CheckinLat: -1.2637407 CheckinLong: 36.9826614', '2024-05-23 06:02:42', '2024-05-23 06:02:42'),
(38, ' OutletLat: -1.2637406 OutletLong: 36.982659 CheckinLat: -1.2637407 CheckinLong: 36.9826614', '2024-05-23 06:02:42', '2024-05-23 06:02:42'),
(39, ' OutletLat: -1.2783282 OutletLong: 36.9681923 CheckinLat: -1.2637387 CheckinLong: 36.9826926', '2024-05-23 06:03:20', '2024-05-23 06:03:20'),
(40, ' OutletLat: -1.2637478 OutletLong: 36.9826563 CheckinLat: -1.2637406 CheckinLong: 36.982659', '2024-05-23 06:03:38', '2024-05-23 06:03:38'),
(41, ' OutletLat: -1.2637478 OutletLong: 36.9826563 CheckinLat: -1.2637406 CheckinLong: 36.982659', '2024-05-23 06:03:39', '2024-05-23 06:03:39'),
(42, ' OutletLat: -1.2637462 OutletLong: 36.9826606 CheckinLat: -1.2637406 CheckinLong: 36.9826598', '2024-05-23 06:03:55', '2024-05-23 06:03:55'),
(43, ' OutletLat: -1.2637462 OutletLong: 36.9826606 CheckinLat: -1.2637406 CheckinLong: 36.9826598', '2024-05-23 06:03:56', '2024-05-23 06:03:56'),
(44, ' OutletLat: -1.2640292 OutletLong: 36.9808665 CheckinLat: -1.2637445 CheckinLong: 36.9826541', '2024-05-23 06:04:40', '2024-05-23 06:04:40'),
(45, ' OutletLat: -1.2577737 OutletLong: 36.9860604 CheckinLat: -1.1855512 CheckinLong: 36.9955335', '2024-05-23 06:19:29', '2024-05-23 06:19:29'),
(46, ' OutletLat: -1.2577737 OutletLong: 36.9860604 CheckinLat: -1.1847518 CheckinLong: 36.9941311', '2024-05-23 06:19:44', '2024-05-23 06:19:44'),
(47, ' OutletLat: -1.2577737 OutletLong: 36.9860604 CheckinLat: -1.1844167 CheckinLong: 36.9934315', '2024-05-23 06:19:58', '2024-05-23 06:19:58'),
(48, ' OutletLat: -1.2577737 OutletLong: 36.9860604 CheckinLat: -1.1853681 CheckinLong: 36.9951502', '2024-05-23 06:20:27', '2024-05-23 06:20:27'),
(49, ' OutletLat: -1.2577737 OutletLong: 36.9860604 CheckinLat: -1.1843874 CheckinLong: 36.993373', '2024-05-23 06:20:49', '2024-05-23 06:20:49'),
(50, ' OutletLat: -1.1812084 OutletLong: 36.9875164 CheckinLat: -1.1798289 CheckinLong: 36.986647', '2024-05-23 06:24:21', '2024-05-23 06:24:21'),
(51, ' OutletLat: -1.1812084 OutletLong: 36.9875164 CheckinLat: -1.1798389 CheckinLong: 36.9865473', '2024-05-23 06:24:41', '2024-05-23 06:24:41'),
(52, ' OutletLat: -1.1812084 OutletLong: 36.9875164 CheckinLat: -1.1798389 CheckinLong: 36.9865473', '2024-05-23 06:24:56', '2024-05-23 06:24:56'),
(53, ' OutletLat: -1.2783282 OutletLong: 36.9681923 CheckinLat: -1.1798834 CheckinLong: 36.9866691', '2024-05-23 06:25:06', '2024-05-23 06:25:06'),
(54, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1799096 CheckinLong: 36.9887786', '2024-05-23 06:26:02', '2024-05-23 06:26:02'),
(55, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1799888 CheckinLong: 36.9878584', '2024-05-23 06:26:36', '2024-05-23 06:26:36'),
(56, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1797569 CheckinLong: 36.9877054', '2024-05-23 06:27:01', '2024-05-23 06:27:01'),
(57, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1797478 CheckinLong: 36.9882074', '2024-05-23 06:27:24', '2024-05-23 06:27:24'),
(58, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1797006 CheckinLong: 36.9886084', '2024-05-23 06:27:50', '2024-05-23 06:27:50'),
(59, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1796943 CheckinLong: 36.9886284', '2024-05-23 06:28:02', '2024-05-23 06:28:02'),
(60, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1788844 CheckinLong: 36.9887222', '2024-05-23 06:28:18', '2024-05-23 06:28:18'),
(61, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1786355 CheckinLong: 36.9889001', '2024-05-23 06:28:33', '2024-05-23 06:28:33'),
(62, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1786072 CheckinLong: 36.9889489', '2024-05-23 06:29:02', '2024-05-23 06:29:02'),
(63, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1797152 CheckinLong: 36.9886627', '2024-05-23 06:29:28', '2024-05-23 06:29:28'),
(64, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1775543 CheckinLong: 36.9891208', '2024-05-23 06:29:46', '2024-05-23 06:29:46'),
(65, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1771572 CheckinLong: 36.989805', '2024-05-23 06:30:01', '2024-05-23 06:30:01'),
(66, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1770185 CheckinLong: 36.9900171', '2024-05-23 06:30:17', '2024-05-23 06:30:17'),
(67, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1771363 CheckinLong: 36.9898414', '2024-05-23 06:30:35', '2024-05-23 06:30:35'),
(68, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1770169 CheckinLong: 36.9900193', '2024-05-23 06:30:43', '2024-05-23 06:30:43'),
(69, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1768877 CheckinLong: 36.9894808', '2024-05-23 06:31:02', '2024-05-23 06:31:02'),
(70, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1768877 CheckinLong: 36.9894808', '2024-05-23 06:31:02', '2024-05-23 06:31:02'),
(73, ' OutletLat: -1.2637517 OutletLong: 36.9826966 CheckinLat: -1.1769515 CheckinLong: 36.9894048', '2024-05-23 07:34:32', '2024-05-23 07:34:32'),
(74, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1767539 CheckinLong: 36.9901415', '2024-05-23 07:35:22', '2024-05-23 07:35:22'),
(75, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1768151 CheckinLong: 36.990068', '2024-05-23 07:35:27', '2024-05-23 07:35:27'),
(76, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1768098 CheckinLong: 36.9900553', '2024-05-23 07:35:40', '2024-05-23 07:35:40'),
(77, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1769518 CheckinLong: 36.9894047', '2024-05-23 08:41:37', '2024-05-23 08:41:37'),
(78, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1769518 CheckinLong: 36.9894047', '2024-05-23 08:41:38', '2024-05-23 08:41:38'),
(79, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.176946 CheckinLong: 36.9894011', '2024-05-23 08:42:29', '2024-05-23 08:42:29'),
(80, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.176946 CheckinLong: 36.9894011', '2024-05-23 08:42:29', '2024-05-23 08:42:29'),
(81, ' OutletLat: -1.1769322 OutletLong: 36.9894742 CheckinLat: -1.1769442 CheckinLong: 36.9893966', '2024-05-23 10:56:13', '2024-05-23 10:56:13'),
(82, ' OutletLat: -1.1769322 OutletLong: 36.9894742 CheckinLat: -1.1769442 CheckinLong: 36.9893966', '2024-05-23 10:56:13', '2024-05-23 10:56:13'),
(83, ' OutletLat: -1.1769322 OutletLong: 36.9894742 CheckinLat: -1.176952 CheckinLong: 36.9894028', '2024-05-23 10:56:45', '2024-05-23 10:56:45'),
(84, ' OutletLat: -1.1769322 OutletLong: 36.9894742 CheckinLat: -1.176952 CheckinLong: 36.9894028', '2024-05-23 10:56:46', '2024-05-23 10:56:46'),
(85, ' OutletLat: -1.1769322 OutletLong: 36.9894742 CheckinLat: -1.1769524 CheckinLong: 36.9894035', '2024-05-23 10:57:30', '2024-05-23 10:57:30'),
(86, ' OutletLat: -1.1769322 OutletLong: 36.9894742 CheckinLat: -1.1769524 CheckinLong: 36.9894035', '2024-05-23 10:57:30', '2024-05-23 10:57:30'),
(87, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1769321 CheckinLong: 36.9893317', '2024-05-23 13:48:36', '2024-05-23 13:48:36'),
(88, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1769321 CheckinLong: 36.9893317', '2024-05-23 13:48:36', '2024-05-23 13:48:36'),
(89, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1768544 CheckinLong: 36.9900593', '2024-05-23 16:10:57', '2024-05-23 16:10:57'),
(90, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1771402 CheckinLong: 36.9894763', '2024-05-23 16:11:13', '2024-05-23 16:11:13'),
(91, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1771402 CheckinLong: 36.9894763', '2024-05-23 16:11:13', '2024-05-23 16:11:13'),
(92, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1769348 CheckinLong: 36.989419', '2024-05-23 16:11:35', '2024-05-23 16:11:35'),
(93, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1769348 CheckinLong: 36.989419', '2024-05-23 16:11:35', '2024-05-23 16:11:35'),
(94, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1774649 CheckinLong: 36.9891412', '2024-05-23 16:11:56', '2024-05-23 16:11:56'),
(95, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1775407 CheckinLong: 36.9890408', '2024-05-23 16:12:16', '2024-05-23 16:12:16'),
(96, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1786627 CheckinLong: 36.9889508', '2024-05-23 16:12:30', '2024-05-23 16:12:30'),
(97, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1785844 CheckinLong: 36.9889932', '2024-05-23 16:12:49', '2024-05-23 16:12:49'),
(98, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1786064 CheckinLong: 36.98895', '2024-05-23 16:12:59', '2024-05-23 16:12:59'),
(99, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1786089 CheckinLong: 36.9889435', '2024-05-23 16:13:12', '2024-05-23 16:13:12'),
(100, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1786138 CheckinLong: 36.9889518', '2024-05-23 16:13:41', '2024-05-23 16:13:41'),
(101, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1798105 CheckinLong: 36.9887022', '2024-05-23 16:13:57', '2024-05-23 16:13:57'),
(102, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1797182 CheckinLong: 36.988627', '2024-05-23 16:14:14', '2024-05-23 16:14:14'),
(103, ' OutletLat: -1.2637462 OutletLong: 36.9826606 CheckinLat: -1.1798665 CheckinLong: 36.98688', '2024-05-23 16:35:55', '2024-05-23 16:35:55'),
(104, ' OutletLat: -1.2640292 OutletLong: 36.9808665 CheckinLat: -1.2401745 CheckinLong: 36.9885234', '2024-05-23 16:36:04', '2024-05-23 16:36:04'),
(105, ' OutletLat: -1.2640292 OutletLong: 36.9808665 CheckinLat: -1.2461691 CheckinLong: 36.9888018', '2024-05-23 16:36:20', '2024-05-23 16:36:20'),
(106, ' OutletLat: -1.2640292 OutletLong: 36.9808665 CheckinLat: -1.2461691 CheckinLong: 36.9888018', '2024-05-23 16:36:38', '2024-05-23 16:36:38'),
(107, ' OutletLat: -1.2640292 OutletLong: 36.9808665 CheckinLat: -1.2497503 CheckinLong: 36.9880551', '2024-05-23 16:36:55', '2024-05-23 16:36:55'),
(108, ' OutletLat: -1.2640292 OutletLong: 36.9808665 CheckinLat: -1.2497481 CheckinLong: 36.9880815', '2024-05-23 16:37:03', '2024-05-23 16:37:03'),
(109, ' OutletLat: -1.2640292 OutletLong: 36.9808665 CheckinLat: -1.2497644 CheckinLong: 36.9880204', '2024-05-23 16:37:17', '2024-05-23 16:37:17'),
(110, ' OutletLat: -1.2640292 OutletLong: 36.9808665 CheckinLat: -1.249769 CheckinLong: 36.9879957', '2024-05-23 16:37:30', '2024-05-23 16:37:30'),
(111, ' OutletLat: -1.2640292 OutletLong: 36.9808665 CheckinLat: -1.2497702 CheckinLong: 36.987989', '2024-05-23 16:37:41', '2024-05-23 16:37:41'),
(112, ' OutletLat: -1.2637462 OutletLong: 36.9826606 CheckinLat: -1.2543392 CheckinLong: 36.9868197', '2024-05-23 16:38:47', '2024-05-23 16:38:47'),
(113, ' OutletLat: -1.2637406 OutletLong: 36.982659 CheckinLat: -1.2578034 CheckinLong: 36.9860951', '2024-05-23 16:38:54', '2024-05-23 16:38:54'),
(114, ' OutletLat: -1.2640292 OutletLong: 36.9808665 CheckinLat: -1.2578034 CheckinLong: 36.9860951', '2024-05-23 16:39:23', '2024-05-23 16:39:23'),
(115, ' OutletLat: -1.2643023 OutletLong: 36.978452 CheckinLat: -1.2626629 CheckinLong: 36.9839692', '2024-05-23 16:41:01', '2024-05-23 16:41:01'),
(116, ' OutletLat: -1.2640292 OutletLong: 36.9808665 CheckinLat: -1.2626661 CheckinLong: 36.9839646', '2024-05-23 16:41:45', '2024-05-23 16:41:45'),
(117, ' OutletLat: -1.2577737 OutletLong: 36.9860604 CheckinLat: -1.2652776 CheckinLong: 36.9817151', '2024-05-23 16:45:17', '2024-05-23 16:45:17'),
(118, ' OutletLat: -1.2653077 OutletLong: 36.9816932 CheckinLat: -1.2653553 CheckinLong: 36.9816971', '2024-05-23 16:46:44', '2024-05-23 16:46:44'),
(119, ' OutletLat: -1.2653077 OutletLong: 36.9816932 CheckinLat: -1.2653553 CheckinLong: 36.9816971', '2024-05-23 16:46:44', '2024-05-23 16:46:44'),
(120, ' OutletLat: -1.2653077 OutletLong: 36.9816932 CheckinLat: -1.2679951 CheckinLong: 36.9797506', '2024-05-23 16:49:48', '2024-05-23 16:49:48'),
(121, ' OutletLat: -1.2653077 OutletLong: 36.9816932 CheckinLat: -1.2679951 CheckinLong: 36.9797506', '2024-05-23 16:50:01', '2024-05-23 16:50:01'),
(122, ' OutletLat: -1.2653077 OutletLong: 36.9816932 CheckinLat: -1.2750651 CheckinLong: 36.9720727', '2024-05-23 16:50:11', '2024-05-23 16:50:11'),
(123, ' OutletLat: -1.2653077 OutletLong: 36.9816932 CheckinLat: -1.2728536 CheckinLong: 36.9738068', '2024-05-23 16:50:33', '2024-05-23 16:50:33'),
(124, ' OutletLat: -1.2653077 OutletLong: 36.9816932 CheckinLat: -1.2750095 CheckinLong: 36.9722925', '2024-05-23 16:50:58', '2024-05-23 16:50:58'),
(125, ' OutletLat: -1.2653077 OutletLong: 36.9816932 CheckinLat: -1.2750055 CheckinLong: 36.9724275', '2024-05-23 16:51:12', '2024-05-23 16:51:12'),
(126, ' OutletLat: -1.2653077 OutletLong: 36.9816932 CheckinLat: -1.2807176 CheckinLong: 36.9637162', '2024-05-23 16:55:49', '2024-05-23 16:55:49'),
(127, ' OutletLat: -1.2783282 OutletLong: 36.9681923 CheckinLat: -1.2810883 CheckinLong: 36.9635223', '2024-05-23 16:55:53', '2024-05-23 16:55:53'),
(128, ' OutletLat: -1.2903367 OutletLong: 36.9475427 CheckinLat: -1.2812978 CheckinLong: 36.9624245', '2024-05-23 16:56:11', '2024-05-23 16:56:11'),
(129, ' OutletLat: -1.3234152 OutletLong: 36.8992693 CheckinLat: -1.3235822 CheckinLong: 36.9001833', '2024-05-23 17:11:34', '2024-05-23 17:11:34'),
(130, ' OutletLat: -1.3234152 OutletLong: 36.8992693 CheckinLat: -1.3201702 CheckinLong: 36.9001002', '2024-05-23 17:12:23', '2024-05-23 17:12:23'),
(131, ' OutletLat: -1.3234152 OutletLong: 36.8992693 CheckinLat: -1.3216587 CheckinLong: 36.9006997', '2024-05-23 17:12:38', '2024-05-23 17:12:38'),
(132, ' OutletLat: -1.1812084 OutletLong: 36.9875164 CheckinLat: -1.3236247 CheckinLong: 36.899088', '2024-05-23 17:13:02', '2024-05-23 17:13:02'),
(133, ' OutletLat: -1.3234152 OutletLong: 36.8992693 CheckinLat: -1.3236763 CheckinLong: 36.8990463', '2024-05-23 17:13:20', '2024-05-23 17:13:20'),
(134, ' OutletLat: -1.3234152 OutletLong: 36.8992693 CheckinLat: -1.3236763 CheckinLong: 36.8990463', '2024-05-23 17:13:20', '2024-05-23 17:13:20'),
(135, ' OutletLat: -1.3234707 OutletLong: 36.896206 CheckinLat: -1.324582 CheckinLong: 36.8968898', '2024-05-23 17:20:11', '2024-05-23 17:20:11'),
(136, ' OutletLat: -1.3228712 OutletLong: 36.899175 CheckinLat: -1.3243004 CheckinLong: 36.8967694', '2024-05-23 17:20:25', '2024-05-23 17:20:25'),
(137, ' OutletLat: -1.3234707 OutletLong: 36.896206 CheckinLat: -1.3242158 CheckinLong: 36.8967413', '2024-05-23 17:20:34', '2024-05-23 17:20:34'),
(138, ' OutletLat: -1.3234707 OutletLong: 36.896206 CheckinLat: -1.3240778 CheckinLong: 36.8966565', '2024-05-23 17:20:45', '2024-05-23 17:20:45'),
(139, ' OutletLat: -1.3234707 OutletLong: 36.896206 CheckinLat: -1.3240173 CheckinLong: 36.8966224', '2024-05-23 17:20:57', '2024-05-23 17:20:57'),
(140, ' OutletLat: -1.3234707 OutletLong: 36.896206 CheckinLat: -1.3238015 CheckinLong: 36.8965053', '2024-05-23 17:21:26', '2024-05-23 17:21:26'),
(141, ' OutletLat: -1.3234707 OutletLong: 36.896206 CheckinLat: -1.3236149 CheckinLong: 36.8963455', '2024-05-23 17:21:43', '2024-05-23 17:21:43'),
(142, ' OutletLat: -1.3234707 OutletLong: 36.896206 CheckinLat: -1.3236149 CheckinLong: 36.8963455', '2024-05-23 17:21:44', '2024-05-23 17:21:44'),
(143, ' OutletLat: -1.3234707 OutletLong: 36.896206 CheckinLat: -1.3234851 CheckinLong: 36.8962577', '2024-05-23 17:22:08', '2024-05-23 17:22:08'),
(144, ' OutletLat: -1.3234707 OutletLong: 36.896206 CheckinLat: -1.3234851 CheckinLong: 36.8962577', '2024-05-23 17:22:09', '2024-05-23 17:22:09'),
(145, ' OutletLat: -1.3253746 OutletLong: 36.8961436 CheckinLat: -1.3239396 CheckinLong: 36.8965792', '2024-05-23 17:29:07', '2024-05-23 17:29:07'),
(146, ' OutletLat: -1.3253746 OutletLong: 36.8961436 CheckinLat: -1.3243509 CheckinLong: 36.8968403', '2024-05-23 17:30:38', '2024-05-23 17:30:38'),
(147, ' OutletLat: -1.3253746 OutletLong: 36.8961436 CheckinLat: -1.3253266 CheckinLong: 36.8961782', '2024-05-23 17:42:26', '2024-05-23 17:42:26'),
(148, ' OutletLat: -1.3253746 OutletLong: 36.8961436 CheckinLat: -1.3253266 CheckinLong: 36.8961782', '2024-05-23 17:42:27', '2024-05-23 17:42:27'),
(149, ' OutletLat: -1.325279 OutletLong: 36.8961562 CheckinLat: -1.3253196 CheckinLong: 36.8961789', '2024-05-23 17:42:48', '2024-05-23 17:42:48'),
(150, ' OutletLat: -1.325279 OutletLong: 36.8961562 CheckinLat: -1.3253196 CheckinLong: 36.8961789', '2024-05-23 17:42:48', '2024-05-23 17:42:48'),
(151, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3253199 CheckinLong: 36.8961865', '2024-05-23 17:46:32', '2024-05-23 17:46:32'),
(152, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3253199 CheckinLong: 36.8961865', '2024-05-23 17:46:32', '2024-05-23 17:46:32'),
(153, ' OutletLat: -1.3247388 OutletLong: 36.8961368 CheckinLat: -1.325308 CheckinLong: 36.8962186', '2024-05-24 02:09:30', '2024-05-24 02:09:30'),
(154, ' OutletLat: -1.3253746 OutletLong: 36.8961436 CheckinLat: -1.325308 CheckinLong: 36.8962186', '2024-05-24 02:11:01', '2024-05-24 02:11:01'),
(155, ' OutletLat: -1.3253746 OutletLong: 36.8961436 CheckinLat: -1.325308 CheckinLong: 36.8962186', '2024-05-24 02:11:02', '2024-05-24 02:11:02'),
(156, ' OutletLat: -1.3247388 OutletLong: 36.8961368 CheckinLat: -1.3253214 CheckinLong: 36.8962623', '2024-05-24 02:12:49', '2024-05-24 02:12:49'),
(157, ' OutletLat: -1.1798505 OutletLong: 36.986624 CheckinLat: -1.3253123 CheckinLong: 36.8961864', '2024-05-24 02:15:11', '2024-05-24 02:15:11'),
(158, ' OutletLat: -1.3247388 OutletLong: 36.8961368 CheckinLat: -1.3253123 CheckinLong: 36.8961864', '2024-05-24 02:15:19', '2024-05-24 02:15:19'),
(159, ' OutletLat: -1.3247388 OutletLong: 36.8961368 CheckinLat: -1.3253076 CheckinLong: 36.8962568', '2024-05-24 02:37:55', '2024-05-24 02:37:55'),
(160, ' OutletLat: -1.2653077 OutletLong: 36.9816932 CheckinLat: -1.3253076 CheckinLong: 36.8962568', '2024-05-24 02:38:06', '2024-05-24 02:38:06'),
(161, ' OutletLat: -1.3234152 OutletLong: 36.8992693 CheckinLat: -1.3253076 CheckinLong: 36.8962568', '2024-05-24 02:38:21', '2024-05-24 02:38:21'),
(162, ' OutletLat: -1.3247388 OutletLong: 36.8961368 CheckinLat: -1.3253076 CheckinLong: 36.8962568', '2024-05-24 02:51:09', '2024-05-24 02:51:09'),
(163, ' OutletLat: -1.3247388 OutletLong: 36.8961368 CheckinLat: -1.3253076 CheckinLong: 36.8962568', '2024-05-24 02:51:10', '2024-05-24 02:51:10'),
(164, ' OutletLat: -1.2653077 OutletLong: 36.9816932 CheckinLat: -1.3253076 CheckinLong: 36.8962568', '2024-05-24 02:52:24', '2024-05-24 02:52:24'),
(165, ' OutletLat: -1.1798505 OutletLong: 36.986624 CheckinLat: -1.3253076 CheckinLong: 36.8962568', '2024-05-24 02:52:39', '2024-05-24 02:52:39'),
(166, ' OutletLat: -1.3247388 OutletLong: 36.8961368 CheckinLat: -1.3253076 CheckinLong: 36.8962568', '2024-05-24 02:52:49', '2024-05-24 02:52:49'),
(167, ' OutletLat: -1.2783282 OutletLong: 36.9681923 CheckinLat: -1.3253076 CheckinLong: 36.8962568', '2024-05-24 02:53:08', '2024-05-24 02:53:08'),
(168, ' OutletLat: -1.3253746 OutletLong: 36.8961436 CheckinLat: -1.3253076 CheckinLong: 36.8962568', '2024-05-24 02:53:15', '2024-05-24 02:53:15'),
(169, ' OutletLat: -1.3253746 OutletLong: 36.8961436 CheckinLat: -1.3253076 CheckinLong: 36.8962568', '2024-05-24 02:53:16', '2024-05-24 02:53:16'),
(170, ' OutletLat: -1.3234707 OutletLong: 36.896206 CheckinLat: -1.3253251 CheckinLong: 36.8962304', '2024-05-24 02:53:56', '2024-05-24 02:53:56'),
(171, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3253251 CheckinLong: 36.8962304', '2024-05-24 03:15:08', '2024-05-24 03:15:08'),
(172, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3253251 CheckinLong: 36.8962304', '2024-05-24 03:15:08', '2024-05-24 03:15:08'),
(173, ' OutletLat: -1.3247388 OutletLong: 36.8961368 CheckinLat: -1.3252955 CheckinLong: 36.8962587', '2024-05-24 03:23:32', '2024-05-24 03:23:32'),
(174, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3252955 CheckinLong: 36.8962587', '2024-05-24 03:23:52', '2024-05-24 03:23:52'),
(175, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.3252955 CheckinLong: 36.8962587', '2024-05-24 03:24:09', '2024-05-24 03:24:09'),
(176, ' OutletLat: -1.325279 OutletLong: 36.8961562 CheckinLat: -1.3252955 CheckinLong: 36.8962587', '2024-05-24 03:24:16', '2024-05-24 03:24:16'),
(177, ' OutletLat: -1.2637406 OutletLong: 36.982659 CheckinLat: -1.3252955 CheckinLong: 36.8962587', '2024-05-24 03:24:43', '2024-05-24 03:24:43'),
(178, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3252955 CheckinLong: 36.8962587', '2024-05-24 03:31:45', '2024-05-24 03:31:45'),
(179, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3252955 CheckinLong: 36.8962587', '2024-05-24 03:31:57', '2024-05-24 03:31:57'),
(180, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3252955 CheckinLong: 36.8962587', '2024-05-24 03:32:08', '2024-05-24 03:32:08'),
(181, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3252955 CheckinLong: 36.8962587', '2024-05-24 03:32:21', '2024-05-24 03:32:21'),
(182, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3253145 CheckinLong: 36.8962247', '2024-05-24 03:51:56', '2024-05-24 03:51:56'),
(183, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3253987 CheckinLong: 36.896353', '2024-05-24 03:52:30', '2024-05-24 03:52:30'),
(184, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3253501 CheckinLong: 36.8962002', '2024-05-24 03:52:46', '2024-05-24 03:52:46'),
(185, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3253132 CheckinLong: 36.8961757', '2024-05-24 03:53:01', '2024-05-24 03:53:01'),
(186, ' OutletLat: -1.1812084 OutletLong: 36.9875164 CheckinLat: -1.3253336 CheckinLong: 36.8961852', '2024-05-24 03:53:17', '2024-05-24 03:53:17'),
(187, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3253754 CheckinLong: 36.8962943', '2024-05-24 03:53:27', '2024-05-24 03:53:27'),
(188, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.325353 CheckinLong: 36.8962458', '2024-05-24 03:53:51', '2024-05-24 03:53:51'),
(189, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3253575 CheckinLong: 36.8962921', '2024-05-24 04:43:35', '2024-05-24 04:43:35'),
(190, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3253198 CheckinLong: 36.8962055', '2024-05-24 04:46:34', '2024-05-24 04:46:34'),
(191, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3253254 CheckinLong: 36.8962571', '2024-05-24 04:47:39', '2024-05-24 04:47:39'),
(192, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3253357 CheckinLong: 36.8963726', '2024-05-24 05:16:36', '2024-05-24 05:16:36'),
(193, ' OutletLat: -1.325279 OutletLong: 36.8961562 CheckinLat: -1.325334 CheckinLong: 36.8963719', '2024-05-24 05:16:51', '2024-05-24 05:16:51'),
(194, ' OutletLat: -1.3234152 OutletLong: 36.8992693 CheckinLat: -1.3233897 CheckinLong: 36.8993193', '2024-05-24 05:27:39', '2024-05-24 05:27:39'),
(195, ' OutletLat: -1.3228712 OutletLong: 36.899175 CheckinLat: -1.323391 CheckinLong: 36.8993213', '2024-05-24 05:27:47', '2024-05-24 05:27:47'),
(196, ' OutletLat: -1.2637502 OutletLong: 36.9826734 CheckinLat: -1.2637415 CheckinLong: 36.9826653', '2024-05-24 05:53:31', '2024-05-24 05:53:31'),
(197, ' OutletLat: -1.2637502 OutletLong: 36.9826734 CheckinLat: -1.2637425 CheckinLong: 36.9826616', '2024-05-24 05:53:50', '2024-05-24 05:53:50'),
(198, ' OutletLat: -1.2577737 OutletLong: 36.9860604 CheckinLat: -1.184427 CheckinLong: 36.9934241', '2024-05-24 06:11:00', '2024-05-24 06:11:00'),
(199, ' OutletLat: -1.184427 OutletLong: 36.9934241 CheckinLat: -1.1844135 CheckinLong: 36.9934287', '2024-05-24 06:11:11', '2024-05-24 06:11:11'),
(200, ' OutletLat: -1.1798174 OutletLong: 36.9877747 CheckinLat: -1.1798138 CheckinLong: 36.9878177', '2024-05-24 06:15:08', '2024-05-24 06:15:08'),
(201, ' OutletLat: -1.1798505 OutletLong: 36.986624 CheckinLat: -1.1796162 CheckinLong: 36.9876375', '2024-05-24 06:15:27', '2024-05-24 06:15:27'),
(202, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1798002 CheckinLong: 36.9877137', '2024-05-24 06:15:53', '2024-05-24 06:15:53'),
(203, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1801222 CheckinLong: 36.9878929', '2024-05-24 06:16:09', '2024-05-24 06:16:09'),
(204, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1799684 CheckinLong: 36.9879488', '2024-05-24 06:16:28', '2024-05-24 06:16:28'),
(205, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1797456 CheckinLong: 36.9882175', '2024-05-24 06:16:47', '2024-05-24 06:16:47'),
(206, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1797589 CheckinLong: 36.9886073', '2024-05-24 06:17:12', '2024-05-24 06:17:12'),
(207, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.179656 CheckinLong: 36.988588', '2024-05-24 06:17:28', '2024-05-24 06:17:28'),
(208, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1796358 CheckinLong: 36.988616', '2024-05-24 06:17:43', '2024-05-24 06:17:43'),
(209, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1785919 CheckinLong: 36.9889269', '2024-05-24 06:18:06', '2024-05-24 06:18:06'),
(210, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.177392 CheckinLong: 36.9892331', '2024-05-24 06:18:28', '2024-05-24 06:18:28'),
(211, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1775298 CheckinLong: 36.9891465', '2024-05-24 06:18:43', '2024-05-24 06:18:43'),
(212, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1797908 CheckinLong: 36.9887168', '2024-05-24 06:18:59', '2024-05-24 06:18:59'),
(213, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1774273 CheckinLong: 36.9891632', '2024-05-24 06:19:12', '2024-05-24 06:19:12'),
(214, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1770608 CheckinLong: 36.9899684', '2024-05-24 06:19:29', '2024-05-24 06:19:29'),
(215, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1769458 CheckinLong: 36.9899477', '2024-05-24 06:19:44', '2024-05-24 06:19:44'),
(216, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1768509 CheckinLong: 36.9900426', '2024-05-24 06:20:17', '2024-05-24 06:20:17'),
(217, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1769278 CheckinLong: 36.9894119', '2024-05-24 06:20:29', '2024-05-24 06:20:29'),
(218, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1769834 CheckinLong: 36.9893765', '2024-05-24 06:20:45', '2024-05-24 06:20:45'),
(219, ' OutletLat: -1.179812 OutletLong: 36.9877958 CheckinLat: -1.1769527 CheckinLong: 36.9894027', '2024-05-27 08:53:54', '2024-05-27 08:53:54'),
(220, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1769448 CheckinLong: 36.9894015', '2024-05-27 08:54:14', '2024-05-27 08:54:14'),
(221, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1769448 CheckinLong: 36.9894015', '2024-05-27 08:54:14', '2024-05-27 08:54:14'),
(222, ' OutletLat: -1.2113372 OutletLong: 36.992216 CheckinLat: -1.1769535 CheckinLong: 36.9894026', '2024-05-27 08:57:28', '2024-05-27 08:57:28'),
(223, ' OutletLat: -1.2845381 OutletLong: 36.82495 CheckinLat: -1.1769526 CheckinLong: 36.9893999', '2024-05-27 08:57:40', '2024-05-27 08:57:40'),
(224, ' OutletLat: -1.184427 OutletLong: 36.9934241 CheckinLat: -1.1769528 CheckinLong: 36.9893997', '2024-05-27 08:57:47', '2024-05-27 08:57:47'),
(225, ' OutletLat: -1.2637462 OutletLong: 36.9826606 CheckinLat: -1.1769559 CheckinLong: 36.9894012', '2024-05-27 08:58:06', '2024-05-27 08:58:06'),
(226, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1769567 CheckinLong: 36.989385', '2024-05-27 08:58:19', '2024-05-27 08:58:19'),
(227, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1769567 CheckinLong: 36.989385', '2024-05-27 08:58:20', '2024-05-27 08:58:20'),
(228, ' OutletLat: -1.2903367 OutletLong: 36.9475427 CheckinLat: -1.1769511 CheckinLong: 36.9893987', '2024-05-27 09:40:00', '2024-05-27 09:40:00'),
(229, ' OutletLat: -1.2113372 OutletLong: 36.992216 CheckinLat: -1.1769513 CheckinLong: 36.9894066', '2024-05-27 11:38:18', '2024-05-27 11:38:18'),
(230, ' OutletLat: -1.3253746 OutletLong: 36.8961436 CheckinLat: -1.1769532 CheckinLong: 36.9894053', '2024-05-27 11:38:39', '2024-05-27 11:38:39'),
(231, ' OutletLat: -1.179812 OutletLong: 36.9877958 CheckinLat: -1.176951 CheckinLong: 36.989405', '2024-05-27 11:58:46', '2024-05-27 11:58:46'),
(232, ' OutletLat: -1.179812 OutletLong: 36.9877958 CheckinLat: -1.1769514 CheckinLong: 36.9894061', '2024-05-27 12:00:11', '2024-05-27 12:00:11'),
(233, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1769513 CheckinLong: 36.9894035', '2024-05-27 12:00:23', '2024-05-27 12:00:23'),
(234, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1769513 CheckinLong: 36.9894035', '2024-05-27 12:00:24', '2024-05-27 12:00:24'),
(235, ' OutletLat: -1.2577737 OutletLong: 36.9860604 CheckinLat: -1.2096398 CheckinLong: 36.9925516', '2024-05-27 17:06:30', '2024-05-27 17:06:30'),
(236, ' OutletLat: -1.2653077 OutletLong: 36.9816932 CheckinLat: -1.2662759 CheckinLong: 36.9816725', '2024-05-27 17:17:13', '2024-05-27 17:17:13'),
(237, ' OutletLat: -1.2653077 OutletLong: 36.9816932 CheckinLat: -1.266275 CheckinLong: 36.981672', '2024-05-27 17:17:17', '2024-05-27 17:17:17'),
(238, ' OutletLat: -1.2637462 OutletLong: 36.9826606 CheckinLat: -1.266275 CheckinLong: 36.981672', '2024-05-27 17:17:23', '2024-05-27 17:17:23'),
(239, ' OutletLat: -1.2653077 OutletLong: 36.9816932 CheckinLat: -1.266275 CheckinLong: 36.981672', '2024-05-27 17:17:26', '2024-05-27 17:17:26'),
(240, ' OutletLat: -1.2653077 OutletLong: 36.9816932 CheckinLat: -1.2658703 CheckinLong: 36.9817167', '2024-05-27 17:17:33', '2024-05-27 17:17:33'),
(241, ' OutletLat: -1.2904629 OutletLong: 36.946879 CheckinLat: -1.2918574 CheckinLong: 36.9458566', '2024-05-28 04:54:23', '2024-05-28 04:54:23'),
(242, ' OutletLat: -1.1798505 OutletLong: 36.986624 CheckinLat: -1.1853386 CheckinLong: 36.9945815', '2024-05-28 05:24:19', '2024-05-28 05:24:19'),
(243, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1795664 CheckinLong: 36.9882887', '2024-05-28 05:29:46', '2024-05-28 05:29:46'),
(244, ' OutletLat: -1.1769111 OutletLong: 36.9893807 CheckinLat: -1.2841199 CheckinLong: 36.8232974', '2024-05-28 14:34:08', '2024-05-28 14:34:08'),
(245, ' OutletLat: -1.2892851 OutletLong: 36.9497116 CheckinLat: -1.2841104 CheckinLong: 36.8232776', '2024-05-28 14:52:26', '2024-05-28 14:52:26'),
(246, ' OutletLat: -1.2892851 OutletLong: 36.9497116 CheckinLat: -1.2840772 CheckinLong: 36.8232849', '2024-05-28 14:52:27', '2024-05-28 14:52:27'),
(247, ' OutletLat: -1.2786649 OutletLong: 36.9680687 CheckinLat: -1.2841253 CheckinLong: 36.823283', '2024-05-28 14:52:51', '2024-05-28 14:52:51'),
(248, ' OutletLat: -1.2786649 OutletLong: 36.9680687 CheckinLat: -1.2841253 CheckinLong: 36.823283', '2024-05-28 14:52:55', '2024-05-28 14:52:55'),
(249, ' OutletLat: -1.2786649 OutletLong: 36.9680687 CheckinLat: -1.2841253 CheckinLong: 36.823283', '2024-05-28 14:52:56', '2024-05-28 14:52:56'),
(250, ' OutletLat: -1.2786649 OutletLong: 36.9680687 CheckinLat: -1.2841161 CheckinLong: 36.8232838', '2024-05-28 14:52:57', '2024-05-28 14:52:57'),
(251, ' OutletLat: -1.2786649 OutletLong: 36.9680687 CheckinLat: -1.2840781 CheckinLong: 36.8232825', '2024-05-28 14:53:07', '2024-05-28 14:53:07'),
(252, ' OutletLat: -1.2786649 OutletLong: 36.9680687 CheckinLat: -1.2841461 CheckinLong: 36.8232858', '2024-05-28 14:53:42', '2024-05-28 14:53:42'),
(253, ' OutletLat: -1.2892851 OutletLong: 36.9497116 CheckinLat: -1.2841086 CheckinLong: 36.8232795', '2024-05-28 14:54:06', '2024-05-28 14:54:06'),
(254, ' OutletLat: -1.2892851 OutletLong: 36.9497116 CheckinLat: -1.2840892 CheckinLong: 36.8232882', '2024-05-28 14:54:18', '2024-05-28 14:54:18'),
(255, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3253995 CheckinLong: 36.8963595', '2024-05-29 09:30:40', '2024-05-29 09:30:40'),
(256, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3253995 CheckinLong: 36.8963595', '2024-05-29 09:30:41', '2024-05-29 09:30:41'),
(257, ' OutletLat: -1.2840533 OutletLong: 36.8232819 CheckinLat: -1.2840693 CheckinLong: 36.8233146', '2024-05-29 15:56:59', '2024-05-29 15:56:59'),
(258, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1801684 CheckinLong: 36.9878919', '2024-05-30 06:05:53', '2024-05-30 06:05:53'),
(259, ' OutletLat: -1.2840533 OutletLong: 36.8232819 CheckinLat: -1.1768588 CheckinLong: 36.9893611', '2024-05-30 15:52:01', '2024-05-30 15:52:01'),
(260, ' OutletLat: -1.1769704 OutletLong: 36.9894302 CheckinLat: -1.1768315 CheckinLong: 36.9894359', '2024-05-30 15:52:17', '2024-05-30 15:52:17'),
(261, ' OutletLat: -1.3234055 OutletLong: 36.8993314 CheckinLat: -1.3234244 CheckinLong: 36.8992881', '2024-05-31 05:14:57', '2024-05-31 05:14:57'),
(262, ' OutletLat: -1.3177856 OutletLong: 36.9175705 CheckinLat: -1.3179097 CheckinLong: 36.9178419', '2024-05-31 05:21:37', '2024-05-31 05:21:37'),
(263, ' OutletLat: -1.2636772 OutletLong: 36.9824342 CheckinLat: -1.2637512 CheckinLong: 36.9826534', '2024-05-31 05:45:17', '2024-05-31 05:45:17'),
(264, ' OutletLat: -1.1857389 OutletLong: 36.9947882 CheckinLat: -1.1856082 CheckinLong: 36.994752', '2024-05-31 06:00:49', '2024-05-31 06:00:49'),
(265, ' OutletLat: -1.1808653 OutletLong: 36.9873449 CheckinLat: -1.1800321 CheckinLong: 36.9855022', '2024-05-31 06:03:35', '2024-05-31 06:03:35'),
(266, ' OutletLat: -1.1808653 OutletLong: 36.9873449 CheckinLat: -1.1809303 CheckinLong: 36.9874251', '2024-05-31 06:03:50', '2024-05-31 06:03:50'),
(267, ' OutletLat: -1.18046 OutletLong: 36.987742 CheckinLat: -1.1805365 CheckinLong: 36.9877103', '2024-05-31 06:04:41', '2024-05-31 06:04:41'),
(268, ' OutletLat: -1.1769111 OutletLong: 36.9893807 CheckinLat: -1.1800123 CheckinLong: 36.9880389', '2024-05-31 06:05:36', '2024-05-31 06:05:36'),
(269, ' OutletLat: -1.1769111 OutletLong: 36.9893807 CheckinLat: -1.1769823 CheckinLong: 36.9892465', '2024-05-31 06:10:17', '2024-05-31 06:10:17'),
(270, ' OutletLat: -1.1769111 OutletLong: 36.9893807 CheckinLat: -1.1769223 CheckinLong: 36.9892862', '2024-05-31 06:14:46', '2024-05-31 06:14:46'),
(271, ' OutletLat: -1.1804624 OutletLong: 36.9878045 CheckinLat: -1.1769249 CheckinLong: 36.9892997', '2024-05-31 07:58:27', '2024-05-31 07:58:27'),
(272, ' OutletLat: -1.1769701 OutletLong: 36.9894294 CheckinLat: -1.1769275 CheckinLong: 36.9892995', '2024-05-31 07:58:41', '2024-05-31 07:58:41'),
(273, ' OutletLat: -1.2640129 OutletLong: 36.9826296 CheckinLat: -1.1769255 CheckinLong: 36.9893044', '2024-05-31 09:25:52', '2024-05-31 09:25:52'),
(274, ' OutletLat: -1.1769111 OutletLong: 36.9893807 CheckinLat: -1.1769255 CheckinLong: 36.9893044', '2024-05-31 09:25:56', '2024-05-31 09:25:56'),
(275, ' OutletLat: -1.18046 OutletLong: 36.987742 CheckinLat: -1.1769252 CheckinLong: 36.9893044', '2024-05-31 09:33:38', '2024-05-31 09:33:38'),
(276, ' OutletLat: -1.1808653 OutletLong: 36.9873449 CheckinLat: -1.1769249 CheckinLong: 36.9892995', '2024-05-31 09:35:01', '2024-05-31 09:35:01'),
(277, ' OutletLat: -1.2786649 OutletLong: 36.9680687 CheckinLat: -1.1769258 CheckinLong: 36.9893042', '2024-05-31 09:36:09', '2024-05-31 09:36:09'),
(278, ' OutletLat: -1.3234055 OutletLong: 36.8993314 CheckinLat: -1.176925 CheckinLong: 36.9892963', '2024-05-31 09:36:17', '2024-05-31 09:36:17'),
(279, ' OutletLat: -1.2845381 OutletLong: 36.82495 CheckinLat: -1.1769241 CheckinLong: 36.9893003', '2024-05-31 09:36:33', '2024-05-31 09:36:33'),
(280, ' OutletLat: -1.1769111 OutletLong: 36.9893807 CheckinLat: -1.1769245 CheckinLong: 36.9892943', '2024-05-31 09:37:23', '2024-05-31 09:37:23'),
(281, ' OutletLat: -1.1804624 OutletLong: 36.9878045 CheckinLat: -1.1769184 CheckinLong: 36.98931', '2024-05-31 09:53:30', '2024-05-31 09:53:30'),
(282, ' OutletLat: -1.2841954 OutletLong: 36.8232109 CheckinLat: -1.1769209 CheckinLong: 36.9893086', '2024-05-31 09:53:35', '2024-05-31 09:53:35'),
(283, ' OutletLat: -1.2840533 OutletLong: 36.8232819 CheckinLat: -1.1769209 CheckinLong: 36.9893086', '2024-05-31 09:53:38', '2024-05-31 09:53:38'),
(284, ' OutletLat: -1.1769111 OutletLong: 36.9893807 CheckinLat: -1.1769209 CheckinLong: 36.9893086', '2024-05-31 09:53:41', '2024-05-31 09:53:41'),
(285, ' OutletLat: -1.1769144 OutletLong: 36.98933 CheckinLat: -1.1769204 CheckinLong: 36.989318', '2024-05-31 10:33:17', '2024-05-31 10:33:17'),
(286, ' OutletLat: -1.1769111 OutletLong: 36.9893807 CheckinLat: -1.1769247 CheckinLong: 36.9892965', '2024-05-31 12:53:04', '2024-05-31 12:53:04'),
(287, ' OutletLat: -1.1769144 OutletLong: 36.98933 CheckinLat: -1.1769247 CheckinLong: 36.9892967', '2024-05-31 13:07:03', '2024-05-31 13:07:03'),
(288, ' OutletLat: -1.2840533 OutletLong: 36.8232819 CheckinLat: -1.1769234 CheckinLong: 36.9893094', '2024-05-31 13:39:55', '2024-05-31 13:39:55'),
(289, ' OutletLat: -1.1769111 OutletLong: 36.9893807 CheckinLat: -1.1769234 CheckinLong: 36.9893094', '2024-05-31 13:40:00', '2024-05-31 13:40:00'),
(290, ' OutletLat: -1.1769144 OutletLong: 36.98933 CheckinLat: -1.1769249 CheckinLong: 36.9893072', '2024-05-31 13:40:23', '2024-05-31 13:40:23'),
(291, ' OutletLat: -1.1769144 OutletLong: 36.98933 CheckinLat: -1.1769254 CheckinLong: 36.9893043', '2024-05-31 14:02:23', '2024-05-31 14:02:23'),
(292, ' OutletLat: -1.1769111 OutletLong: 36.9893807 CheckinLat: -1.1769231 CheckinLong: 36.9892984', '2024-05-31 14:26:25', '2024-05-31 14:26:25'),
(293, ' OutletLat: -1.1769111 OutletLong: 36.9893807 CheckinLat: -1.1769192 CheckinLong: 36.9893056', '2024-05-31 15:09:10', '2024-05-31 15:09:10'),
(294, ' OutletLat: -1.3234055 OutletLong: 36.8993314 CheckinLat: -1.3254176 CheckinLong: 36.8963647', '2024-06-02 14:12:40', '2024-06-02 14:12:40'),
(295, ' OutletLat: -1.3247388 OutletLong: 36.8961368 CheckinLat: -1.325414 CheckinLong: 36.8963691', '2024-06-02 14:12:59', '2024-06-02 14:12:59'),
(296, ' OutletLat: -1.3253995 OutletLong: 36.8963657 CheckinLat: -1.3254052 CheckinLong: 36.8963629', '2024-06-02 14:13:13', '2024-06-02 14:13:13'),
(297, ' OutletLat: -1.3234055 OutletLong: 36.8993314 CheckinLat: -1.3242899 CheckinLong: 36.8397236', '2024-06-02 15:45:42', '2024-06-02 15:45:42'),
(298, ' OutletLat: -1.3234152 OutletLong: 36.8992693 CheckinLat: -1.3242826 CheckinLong: 36.839743', '2024-06-02 15:45:57', '2024-06-02 15:45:57'),
(299, ' OutletLat: -1.2905278 OutletLong: 36.9471795 CheckinLat: -1.3242902 CheckinLong: 36.8397168', '2024-06-02 15:46:07', '2024-06-02 15:46:07'),
(300, ' OutletLat: -1.324273 OutletLong: 36.8397461 CheckinLat: -1.3242848 CheckinLong: 36.8397509', '2024-06-02 16:10:16', '2024-06-02 16:10:16'),
(301, ' OutletLat: -1.324273 OutletLong: 36.8397461 CheckinLat: -1.3254219 CheckinLong: 36.8963755', '2024-06-02 19:46:50', '2024-06-02 19:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(85, '2014_10_12_000000_create_users_table', 1),
(86, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(87, '2019_08_19_000000_create_failed_jobs_table', 1),
(88, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(89, '2024_03_01_060357_create_outlets_table', 1),
(90, '2024_03_01_060646_create_sales_table', 1),
(91, '2024_03_01_060732_create_posaudits_table', 1),
(92, '2024_03_01_061143_create_competitors_table', 1),
(93, '2024_03_01_061209_create_feedback_table', 1),
(94, '2024_03_06_060148_create_products_table', 1),
(95, '2024_03_06_113858_create_clockins_table', 1),
(96, '2024_03_06_123240_create_clockouts_table', 1),
(97, '2024_03_13_081811_create_visits_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `outlets`
--

CREATE TABLE `outlets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_person_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `long` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `outlets`
--

INSERT INTO `outlets` (`id`, `user_id`, `name`, `contact_person_name`, `phone`, `lat`, `long`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Javis Apartments', 'Javis Otieno', '0707641174', '11.4445', '12.3445', '', '2024-03-28 10:32:32', '2024-03-28 10:32:32'),
(2, 1, 'Javis Apartments', 'Javis Otieno', '0707641174', '11.4445', '12.3445', '', '2024-03-28 10:32:32', '2024-03-28 10:32:32'),
(3, 1, 'Javis Apartments', 'Javis Otieno', '0707641174', '11.4445', '12.3445', '', '2024-03-28 10:32:32', '2024-03-28 10:32:32'),
(4, 1, 'Javis Apartments', 'Javis Otieno', '0707641174', '11.4445', '12.3445', '', '2024-03-28 10:32:32', '2024-03-28 10:32:32'),
(5, 1, 'Milka Supermarkets', 'James Obanji', '0707666777', '15.6789', '15.6789', '', '2024-03-28 10:39:52', '2024-03-28 10:39:52'),
(6, 1, 'Testing Outlet', 'Javis Otieno', '07076411174', '-1.3253782', '36.8963946', '', '2024-04-05 15:03:04', '2024-04-05 15:03:04'),
(7, 1, 'Mukurwe Supermarket', 'James Otwal', '0798786543', '-1.3253431', '36.8961912', '', '2024-04-06 02:07:03', '2024-04-06 02:07:03'),
(8, 1, 'Sam Supermarket', 'Sam', '0709678688', '-1.3253775', '36.8963964', '', '2024-04-06 08:17:17', '2024-04-06 08:17:17'),
(9, 1, 'Poster Shop', 'John', '0765789890', '-1.177009', '36.9895604', '', '2024-04-08 04:43:25', '2024-04-08 04:43:25'),
(10, 1, 'Testing Outlet', 'Test Name', '0707641174', '-1.1768882', '36.9894314', '', '2024-04-11 05:25:30', '2024-04-11 05:25:30'),
(11, 1, 'Test', 'Tes', '02822892', '-1.176954', '36.9893833', '', '2024-04-11 06:37:27', '2024-04-11 06:37:27'),
(12, 1, 'Testing Again', 'Robert Mutei', '0788996556', '-1.1777806', '36.9905376', '', '2024-04-11 06:41:54', '2024-04-11 06:41:54'),
(13, 1, 'Test Outlet', 'Test Name', '0798989797', '-1.1769219', '36.9893672', '', '2024-04-22 10:48:10', '2024-04-22 10:48:10'),
(14, 1, 'mark', 'mainq', '0706335789', '-1.1769303', '36.9893453', '', '2024-04-24 13:00:48', '2024-04-24 13:00:48'),
(15, 1, 'Mwembe Tayari', 'Kanai', '0741408360', '-1.3300619', '36.8628608', '', '2024-04-25 15:32:47', '2024-04-25 15:32:47'),
(16, 1, 'Javis Test', 'Javis Test', '0707665544', '-1.1769078', '36.9893729', '', '2024-04-26 15:19:42', '2024-04-26 15:19:42'),
(17, 1, 'Nuni Stores', 'Peter Nuni', '0706456866', '-1.1769349', '36.9894486', '', '2024-04-30 12:10:58', '2024-04-30 12:10:58'),
(18, 1, 'Muthurwa Supermarket', 'Martin Tuji', '0709876549', '-1.3253746', '36.8961436', '', '2024-05-06 09:13:16', '2024-05-06 09:13:16'),
(19, 1, 'Muthurwa Supermarket', 'Martin Tuji', '0709876549', '-1.3253746', '36.8961436', '', '2024-05-06 09:15:20', '2024-05-06 09:15:20'),
(20, 1, 'Dakar Supermarket', 'Fanis Otal', '0707976543', '-1.3253746', '36.8961436', '', '2024-05-06 09:24:02', '2024-05-06 09:24:02'),
(21, 1, 'Dakar Supermarket', 'Fanis Otal', '0707976543', '-1.3253746', '36.8961436', '', '2024-05-06 09:25:29', '2024-05-06 09:25:29'),
(22, 1, 'FH Shop', 'John Mwangi', '0700657896', '-1.3253746', '36.8961436', '', '2024-05-06 09:28:24', '2024-05-06 09:28:24'),
(23, 1, 'FH Shop', 'John Mwangi', '0700657896', '-1.3253746', '36.8961436', '', '2024-05-06 09:32:57', '2024-05-06 09:32:57'),
(24, 1, 'Tive Shop', 'James Chali', '0207897654', '-1.3253746', '36.8961436', '', '2024-05-06 09:34:15', '2024-05-06 09:34:15'),
(25, 1, 'Zepa Shop', 'Jane Pato', '0754678765', '-1.1770032', '36.9895669', '', '2024-05-06 10:14:52', '2024-05-06 10:14:52'),
(26, 1, 'Taro Apartments', 'George Asanta', '0798654321', '-1.1770032', '36.9895669', 'posaudits/1715762136137.jpg', '2024-05-06 10:18:00', '2024-05-15 09:35:39'),
(27, 1, 'Dazu Outlet', 'David Wambugu', '0745676543', '-1.1769832', '36.9895612', '', '2024-05-07 08:40:56', '2024-05-07 08:40:56'),
(28, 1, 'Fire Shop', 'Jane Mutua', '0700112233', '-1.1769832', '36.9895612', 'outlets/1715068622733.jpg', '2024-05-07 08:56:54', '2024-05-07 08:57:03'),
(29, 1, 'Sago Shop', 'Dany Hali', '0798876678', '-1.1769832', '36.9895612', 'outlets/1715076374894.jpg', '2024-05-07 11:06:08', '2024-05-07 11:06:16'),
(30, 2, 'Miradi Shops', 'Hubert Mwangi', '0798765432', '-1.1769818', '36.9895616', 'outlets/1715239838875.jpg', '2024-05-09 08:30:30', '2024-05-09 08:30:39'),
(31, 1, 'Testing Outlet', 'Testing Name', '0798765567', '12.6733', '23.5662', '', '2024-05-09 14:59:05', '2024-05-09 14:59:05'),
(32, 1, 'SCG Wamuyu Desk', 'Wamuyu', '0799887766', '-1.1769859', '36.9895594', 'outlets/1715580769529.jpg', '2024-05-13 07:12:38', '2024-05-13 07:12:49'),
(33, 3, 'SCG Wamuyu Desk', 'Wamuyu', '0711223344', '-1.1769264', '36.9894622', 'outlets/1715586581800.jpg', '2024-05-13 08:49:34', '2024-05-13 08:49:41'),
(34, 5, 'SCG Wamuyu Desk 4', 'Wamuyu', '0788997766', '-1.1769322', '36.9894742', 'outlets/1715587779726.jpg', '2024-05-13 09:09:31', '2024-05-13 09:09:39'),
(35, 4, 'SCG Wamuyu Desk 3', 'Wamuyu', '0765432165', '-1.1769322', '36.9894742', 'outlets/1715587956057.jpg', '2024-05-13 09:12:28', '2024-05-13 09:12:35'),
(37, 1, 'Kola Shops', 'John Otwal', '0789654664', '-1.1769704', '36.9894302', 'outlets/1715777176258.jpg', '2024-05-15 13:44:08', '2024-05-15 13:46:19'),
(38, 1, 'SCG Javis Desk', 'Javis Otieno', '0707641174', '-1.1769704', '36.9894302', 'outlets/1715777631969.jpg', '2024-05-15 13:53:43', '2024-05-15 13:53:55'),
(39, 1, 'Transami', 'Javis Otieno', '0707641174', '-1.325279', '36.8961562', 'outlets/1715795325393.jpg', '2024-05-15 18:48:34', '2024-05-15 18:48:48'),
(40, 1, 'Test Location', 'Huan', '0778654654', '-1.1769699', '36.9894287', 'outlets/1715863126155.jpg', '2024-05-16 13:38:33', '2024-05-16 13:38:49'),
(41, 1, 'SCG Faith Desk', 'Faith Muka', '0734567567', '-1.1769699', '36.9894287', 'outlets/1715867766480.jpg', '2024-05-16 14:55:53', '2024-05-16 14:56:09'),
(42, 1, 'Olive Hotel', 'Mwasha Mkita', '0788665544', '-1.2843058', '36.8258684', 'outlets/1715877791573.jpg', '2024-05-16 17:42:56', '2024-05-16 17:43:14'),
(43, 1, 'Javis SCG Desk 17-05-24', 'Javis Otieno', '0707641174', '-1.1769701', '36.9894294', 'outlets/1715930739830.jpg', '2024-05-17 08:25:31', '2024-05-17 08:25:43'),
(44, 1, 'Mission Care Hospital', 'Paul Mutalo', '0798654543', '-1.3180058', '36.8931837', 'outlets/1716045222339.jpg', '2024-05-18 16:13:29', '2024-05-18 16:13:45'),
(45, 1, 'Tabasamu Dishes', 'Martin Mjiku', '0789765567', '-1.3234707', '36.896206', 'outlets/1716052109327.jpg', '2024-05-18 18:08:19', '2024-05-18 18:08:32'),
(46, 1, 'Transami Stage to Ruai Bypass', 'John Kaji', '0786789789', '-1.3228712', '36.899175', 'outlets/1716264263536.jpg', '2024-05-21 05:04:12', '2024-05-21 05:04:25'),
(47, 1, 'Jewel 4802', 'Javis Omondi', '0707641174', '-1.3253995', '36.8963657', 'outlets/1716348327980.jpg', '2024-05-22 04:25:15', '2024-05-22 04:25:30'),
(48, 1, 'Ruai Bypass Pole', 'Samuel Mutiso', '0745663889', '-1.2652733', '36.9849099', 'outlets/1716352967709.jpg', '2024-05-22 05:42:39', '2024-05-22 05:42:50'),
(49, 1, 'Karuguru Stage to Ruiru bypass', 'Javis Sapi', '0766889900', '-1.1812084', '36.9875164', 'outlets/1716354027751.jpg', '2024-05-22 06:00:19', '2024-05-22 06:00:30'),
(50, 1, 'Transami Stage to Ruai Bypass 2nd Test', 'Javis Omondi', '0788998877', '-1.3234152', '36.8992693', 'outlets/1716437063634.jpg', '2024-05-23 05:04:12', '2024-05-23 05:04:25'),
(51, 1, '75 Roundabout to Ruai', 'Javis Otieno', '0766557788', '-1.3162846', '36.9212423', 'outlets/1716438778950.jpg', '2024-05-23 05:32:51', '2024-05-23 05:33:01'),
(52, 1, 'Astrol stage outside petrol station', 'Javis Otieno', '0788997766', '-1.2904629', '36.946879', 'outlets/1716439004614.jpg', '2024-05-23 05:36:35', '2024-05-23 05:36:46'),
(53, 1, 'Shooters inn stage', 'Javis Otieno', '0755667788', '-1.2903367', '36.9475427', 'outlets/1716439147998.jpg', '2024-05-23 05:38:58', '2024-05-23 05:39:09'),
(54, 1, 'Digitech Fabricators Prob Benedicta', 'Javis Otieno', '0799887766', '-1.2783282', '36.9681923', 'outlets/1716439481005.jpg', '2024-05-23 05:44:34', '2024-05-23 05:44:42'),
(55, 1, 'Ruai Bypass stage under bridge flyover', 'Javis Otieno', '073344566', '-1.2643023', '36.978452', 'outlets/1716439743069.jpg', '2024-05-23 05:48:54', '2024-05-23 05:49:04'),
(56, 1, 'Ruai Bypass stage pole 2nd test', 'Javis Otieno', '0705763357', '-1.2640292', '36.9808665', 'outlets/1716439835825.jpg', '2024-05-23 05:50:28', '2024-05-23 05:50:37'),
(57, 1, 'Ruai Bypass Pole 3rd test', 'Javis Otieno', '0788996655', '-1.2637406', '36.982659', 'outlets/1716439910081.jpg', '2024-05-23 05:51:39', '2024-05-23 05:51:51'),
(66, 1, 'Ruai Bypass Stage', 'Javis Otieno', '0745667788', '-1.2637462', '36.9826606', 'outlets/1716440447216.jpg', '2024-05-23 06:00:38', '2024-05-23 06:00:49'),
(67, 1, 'Kona Corner Stage', 'Javis Otieno', '0746889977', '-1.2577737', '36.9860604', 'outlets/1716441549033.jpg', '2024-05-23 06:19:03', '2024-05-23 06:19:12'),
(68, 1, 'Karuguru stage to Ruiru second tear', 'Javis Otieno', '0744567467', '-1.1798505', '36.986624', 'outlets/1716441832802.jpg', '2024-05-23 06:23:45', '2024-05-23 06:23:54'),
(69, 1, 'Ruai Bypass Stage to Transami', 'James Otwal', '07895778344', '-1.2653077', '36.9816932', 'outlets/1716479166107.jpg', '2024-05-23 16:45:57', '2024-05-23 16:46:07'),
(70, 1, 'Blessed Supermarket', 'John Mutiso', '0766554433', '-1.3247388', '36.8961368', 'outlets/1716482035974.jpg', '2024-05-23 17:33:47', '2024-05-23 17:33:57'),
(71, 1, 'Ruai Bypass Pole Friday', 'Javis Otieno', '0707641174', '-1.2637502', '36.9826734', 'outlets/1716526388958.jpg', '2024-05-24 05:53:00', '2024-05-24 05:53:11'),
(72, 1, 'Kona stage friday', 'Javis', '0777999888', '-1.184427', '36.9934241', 'outlets/1716527442204.jpg', '2024-05-24 06:10:36', '2024-05-24 06:10:46'),
(73, 1, 'karuguru stage northland\'s hardware', 'Javis Otieno', '0766554433', '-1.1798174', '36.9877747', 'outlets/1716527678365.jpg', '2024-05-24 06:14:31', '2024-05-24 06:14:40'),
(74, 1, 'karuguru stage northland\'s hardware', 'Javis Otieno', '0766554433', '-1.1799346', '36.9877862', 'outlets/1716527690329.jpg', '2024-05-24 06:14:40', '2024-05-24 06:14:51'),
(75, 1, 'Galitos Moi Avenue', 'Javis Otieno', '0707641174', '-1.2845381', '36.82495', 'outlets/1716609406087.jpg', '2024-05-25 04:56:40', '2024-05-25 04:56:48'),
(76, 1, 'Total Petrol Station', 'Javis Otieno', '0766556677', '-1.3177856', '36.9175705', 'outlets/1716783629743.jpg', '2024-05-27 05:20:21', '2024-05-27 05:20:32'),
(77, 1, 'Shooters inn second test', 'Javis Otieno', '0711223344', '-1.287585', '36.9520433', 'outlets/1716784460995.jpg', '2024-05-27 05:34:11', '2024-05-27 05:34:22'),
(78, 1, 'Nairobi Gate', 'Javis Otieno', '0766778899', '-1.2113372', '36.992216', 'outlets/1716786389342.jpg', '2024-05-27 06:06:22', '2024-05-27 06:06:30'),
(79, 1, 'Ruai Bypass Stage Monday', 'Javis Otieno', '0711223344', '-1.1808653', '36.9872962', 'outlets/1716786869648.jpg', '2024-05-27 06:14:22', '2024-05-27 06:14:31'),
(80, 1, 'Northlands Karuguru 2nd test', 'Javis Otieno', '0733445577', '-1.179812', '36.9877958', 'outlets/1716786977605.jpg', '2024-05-27 06:16:09', '2024-05-27 06:16:18'),
(84, 1, 'Transami Stage 28/5/24', 'Javis Otieno Omondi', '0707641174', '-1.3234055', '36.8993314', 'outlets/1716867651836.jpg', '2024-05-28 04:40:43', '2024-05-28 04:40:54'),
(85, 1, 'GSU Stage 28/5/24', 'Javis Otieno Omondi', '0707641174', '-1.2905278', '36.9471795', 'outlets/1716868536506.jpg', '2024-05-28 04:55:27', '2024-05-28 04:55:38'),
(86, 1, 'Astrol Petrol Station 28/5/24', 'Javis Otieno', '0707641174', '-1.2892851', '36.9497116', 'outlets/1716868763705.jpg', '2024-05-28 04:59:16', '2024-05-28 04:59:24'),
(87, 1, 'Benedicta Stage 28/05/24', 'Javis Otieno', '0707641174', '-1.2786649', '36.9680687', 'outlets/1716869039484.jpg', '2024-05-28 05:03:49', '2024-05-28 05:04:00'),
(88, 1, 'Ruai Bypass Under Bridge 28/05/24', 'Javis Otieno', '0707641174', '-1.2640129', '36.9826296', 'outlets/1716869441104.jpg', '2024-05-28 05:10:35', '2024-05-28 05:10:42'),
(89, 1, 'Ruai Bypass Pole 28/05/24', 'Javis Otieno', '0707641174', '-1.2636772', '36.9824342', 'outlets/1716869515501.jpg', '2024-05-28 05:11:50', '2024-05-28 05:11:56'),
(90, 1, 'Kona Stage 28/05/24', 'Javis Otieno', '0707641174', '-1.1857389', '36.9947882', 'outlets/1716870233247.jpg', '2024-05-28 05:23:47', '2024-05-28 05:23:54'),
(91, 1, 'Karuguru Stage 28/05/24', 'Javis Otieno', '0707641174', '-1.1808653', '36.9873449', 'outlets/1716870415915.jpg', '2024-05-28 05:26:51', '2024-05-28 05:26:57'),
(92, 1, 'Northlands Hardware 28/05/24', 'Javis Otieno', '0707641174', '-1.18046', '36.987742', 'outlets/1716870490495.jpg', '2024-05-28 05:28:05', '2024-05-28 05:28:11'),
(93, 1, 'SCG Javis Desk 28/5/24', 'Javis Otieno', '0707641174', '-1.1769111', '36.9893807', 'outlets/1716871800821.jpg', '2024-05-28 05:49:54', '2024-05-28 05:50:03'),
(94, 1, 'Phones & Tablets Kenya', 'Javis Otieno', '0707641174', '-1.2840533', '36.8232819', 'outlets/1716903322211.jpg', '2024-05-28 14:35:08', '2024-05-28 14:35:24'),
(95, 1, 'Phones Tablets Kenya 2nd Test', 'Javis Otieno', '0724567876', '-1.2841954', '36.8232109', 'outlets/1716994875886.jpg', '2024-05-29 16:01:05', '2024-05-29 16:01:18'),
(96, 1, 'Northlands 30/5/24', 'Javis', '0756464735', '-1.1804624', '36.9878045', 'outlets/1717045517419.jpg', '2024-05-30 06:05:12', '2024-05-30 06:05:20'),
(97, 1, 'Shaflyn Desk 31/05/2024', 'Javis Otieno', '0707641174', '-1.1769144', '36.98933', 'outlets/1717145313311.jpg', '2024-05-31 09:48:24', '2024-05-31 09:48:36'),
(98, 3, 'Testing Again', 'Testing Again', '0788998899', '23.2322', '23.3223', '', '2024-05-31 14:32:41', '2024-05-31 14:32:41'),
(99, 1, 'Stockwell C11', 'Javis Otieno', '0707641174', '-1.324273', '36.8397461', 'outlets/1717337511062.jpg', '2024-06-02 15:11:41', '2024-06-02 15:11:53'),
(100, 1, 'GM', 'Javis Otieno', '0707641174', '-1.3257528', '36.869917', 'outlets/1717345323775.jpg', '2024-06-02 17:21:54', '2024-06-02 17:22:05'),
(101, 1, 'Cooperative Stage', 'Javis Otieno', '0707641174', '-1.3263061', '36.8958778', 'outlets/1717346160532.jpg', '2024-06-02 17:35:53', '2024-06-02 17:36:02');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'AuthToken', '788d21ab191acdc9523e47b15c616d8b4dc211932b735710272f7156296319e9', '[\"*\"]', NULL, NULL, '2024-04-08 11:04:47', '2024-04-08 11:04:47'),
(2, 'App\\Models\\User', 1, 'AuthToken', '562831a96b119ad434d8758cfe57278a7c62196cc1ac50fc8e0f6c44a7d2e47f', '[\"*\"]', NULL, NULL, '2024-04-08 11:05:18', '2024-04-08 11:05:18'),
(3, 'App\\Models\\User', 1, 'AuthToken', '180a096161643be85b5b11d76d07b14c805c705769c44a4089e1d06da5634dd0', '[\"*\"]', NULL, NULL, '2024-04-08 11:05:49', '2024-04-08 11:05:49'),
(4, 'App\\Models\\User', 1, 'AuthToken', '6b249986b99fbd0e438a55bc19bdc25fa530d85e08a2c6b209aaca805f6e86de', '[\"*\"]', NULL, NULL, '2024-04-08 11:42:40', '2024-04-08 11:42:40'),
(5, 'App\\Models\\User', 1, 'AuthToken', '033a324be2c9d7ecae7dacd142235eea0031ec61999cffcfa9d97cba78084e3c', '[\"*\"]', NULL, NULL, '2024-04-08 11:57:21', '2024-04-08 11:57:21'),
(6, 'App\\Models\\User', 1, 'AuthToken', '135b4d249c9078591adb3606e62bc61d56b7827f4df6332b71b36aa0fc466c48', '[\"*\"]', '2024-04-15 09:09:31', NULL, '2024-04-08 14:25:27', '2024-04-15 09:09:31'),
(7, 'App\\Models\\User', 1, 'AuthToken', 'a09da82cf15a62ec177645ea8035a114a0be4a0503d6336ea100730600d35f42', '[\"*\"]', '2024-04-09 12:20:01', NULL, '2024-04-09 11:44:02', '2024-04-09 12:20:01'),
(8, 'App\\Models\\User', 1, 'AuthToken', '0b0e7c5247a5108e08bf7e6e447bdd9459e40871f6e4da561955b011183c8e44', '[\"*\"]', NULL, NULL, '2024-04-10 10:11:30', '2024-04-10 10:11:30'),
(9, 'App\\Models\\User', 1, 'AuthToken', 'd2b40237cc25b3c6d2f2ae188f6e82c207c63a02e71dead0747f765276ccd69b', '[\"*\"]', '2024-04-10 10:58:07', NULL, '2024-04-10 10:57:16', '2024-04-10 10:58:07'),
(10, 'App\\Models\\User', 1, 'AuthToken', 'cc424d82bd8d73555842579a0f1169f323edcf990bdda776071bb5de2e6201b2', '[\"*\"]', '2024-06-03 09:36:38', NULL, '2024-04-11 11:09:17', '2024-06-03 09:36:38'),
(11, 'App\\Models\\User', 1, 'AuthToken', 'b997a333a2741907e00a22429f131fa4b1bfd8e66d084c35e868ce7cdc6d3806', '[\"*\"]', NULL, NULL, '2024-04-12 03:24:46', '2024-04-12 03:24:46'),
(12, 'App\\Models\\User', 1, 'AuthToken', '353a06dc24bbd2845d92d3dd24c4704072207c6651290c7ee4444941a53f86cf', '[\"*\"]', '2024-04-16 00:32:55', NULL, '2024-04-15 09:13:12', '2024-04-16 00:32:55'),
(13, 'App\\Models\\User', 1, 'AuthToken', 'f8d4e664177b08b102ea9c734e87c24e2e3cd09f087196f202e72aa57bdcb3fb', '[\"*\"]', '2024-04-19 14:24:06', NULL, '2024-04-16 05:24:52', '2024-04-19 14:24:06'),
(14, 'App\\Models\\User', 1, 'AuthToken', 'f6a8c1aa71345770a7772023115106c62fc7ae2f3ded655ac2bcf8d5e94baa11', '[\"*\"]', '2024-04-19 04:49:59', NULL, '2024-04-17 10:59:08', '2024-04-19 04:49:59'),
(15, 'App\\Models\\User', 1, 'AuthToken', 'b903796066dd130b0c76361b2307fa39249b0b0296c397cfaeec3ffd3b94e1a0', '[\"*\"]', '2024-04-19 04:50:52', NULL, '2024-04-19 04:50:37', '2024-04-19 04:50:52'),
(16, 'App\\Models\\User', 1, 'AuthToken', '8bf7cf4afe8153796a6a9e1aab9f5c8d1457646f784df2952797ad93bc5731b1', '[\"*\"]', '2024-04-25 11:27:10', NULL, '2024-04-19 04:51:29', '2024-04-25 11:27:10'),
(17, 'App\\Models\\User', 1, 'AuthToken', 'e808ba41f4e8161c47b252574dfd7c9476e7eb0a09bc65c5504fad5d76813101', '[\"*\"]', '2024-04-23 09:44:12', NULL, '2024-04-19 09:37:07', '2024-04-23 09:44:12'),
(18, 'App\\Models\\User', 1, 'AuthToken', 'a06ff0b357446e7fff7a55445e32ee9f5fd04491d38947ad20defa1b45c6c38a', '[\"*\"]', '2024-04-23 08:42:57', NULL, '2024-04-23 08:41:32', '2024-04-23 08:42:57'),
(19, 'App\\Models\\User', 1, 'AuthToken', 'cb6f3701caba910caad1ea9076d1f0812a0c683727e01bb5c44805c88071d6ff', '[\"*\"]', '2024-04-25 15:23:04', NULL, '2024-04-23 09:41:17', '2024-04-25 15:23:04'),
(20, 'App\\Models\\User', 1, 'AuthToken', '24c995aecda113f5e5e333769d0eddc79981e63bcef10e1b4ccaf67d3bfe5ab3', '[\"*\"]', '2024-05-16 14:27:58', NULL, '2024-04-23 09:45:31', '2024-05-16 14:27:58'),
(21, 'App\\Models\\User', 1, 'AuthToken', '30aeeb576c9b161cc3b0d9fd2361519f11f002c9367e7ae1b9d63c646ef012b8', '[\"*\"]', '2024-04-25 12:54:54', NULL, '2024-04-25 12:45:58', '2024-04-25 12:54:54'),
(22, 'App\\Models\\User', 1, 'AuthToken', 'a033a5c57ee32ff6d8e74136055a814090e0e6d9395f1581b0c2a725d1431fc0', '[\"*\"]', '2024-04-25 13:01:04', NULL, '2024-04-25 12:55:24', '2024-04-25 13:01:04'),
(23, 'App\\Models\\User', 1, 'AuthToken', '8b008d3ed7a0200a6aec4ce9c8a6c5118749c298528b5a7b2fa860060c77f136', '[\"*\"]', '2024-04-25 14:02:38', NULL, '2024-04-25 13:04:56', '2024-04-25 14:02:38'),
(24, 'App\\Models\\User', 1, 'AuthToken', '52404ee11922b821d593a17992ec17f1ece2b3a47b51391558faa30912cd7a95', '[\"*\"]', '2024-04-25 14:24:45', NULL, '2024-04-25 14:24:10', '2024-04-25 14:24:45'),
(25, 'App\\Models\\User', 1, 'AuthToken', '79adab9e5036047947e2b9ec0a68d70e4840b09cb922b29d9af1d0679ab894f9', '[\"*\"]', '2024-04-25 14:25:24', NULL, '2024-04-25 14:25:23', '2024-04-25 14:25:24'),
(26, 'App\\Models\\User', 1, 'AuthToken', '4265a128fa874b9778c95ed03d41d09d8b6589160b710d9bd0446c47277a22d2', '[\"*\"]', '2024-04-25 15:10:50', NULL, '2024-04-25 14:53:38', '2024-04-25 15:10:50'),
(27, 'App\\Models\\User', 1, 'AuthToken', 'f277de78dd110dc1e6d4746e91e5149944faecc745dd0354a873c9a939686632', '[\"*\"]', '2024-04-25 17:04:20', NULL, '2024-04-25 15:11:23', '2024-04-25 17:04:20'),
(28, 'App\\Models\\User', 1, 'AuthToken', '37a295bd569101bdd55c9c09c36573ef0ed66c526b94aabb678ed20b096afa4e', '[\"*\"]', '2024-04-25 15:32:47', NULL, '2024-04-25 15:32:09', '2024-04-25 15:32:47'),
(29, 'App\\Models\\User', 1, 'AuthToken', '38d6372aa357a23caefcbfb43064455bdce2cdede562176be78d2d3a7379b3fc', '[\"*\"]', '2024-04-25 17:22:44', NULL, '2024-04-25 17:10:40', '2024-04-25 17:22:44'),
(30, 'App\\Models\\User', 1, 'AuthToken', 'c1bdd697f3ea02311d0c2bcbd5f89288b1d5b28ef81b49a7711a9bcfd8323be4', '[\"*\"]', '2024-04-26 07:45:31', NULL, '2024-04-25 17:30:10', '2024-04-26 07:45:31'),
(31, 'App\\Models\\User', 1, 'AuthToken', 'ff3828af12afce20ad3ea16f4a6959afc82050e4449557b9a9faef7cf06a4c56', '[\"*\"]', '2024-04-26 10:46:20', NULL, '2024-04-26 07:45:48', '2024-04-26 10:46:20'),
(32, 'App\\Models\\User', 1, 'AuthToken', 'ed788bfec4a0b14cdbe0aaa8ab5869ad206a4ba9ac0fb0f224812dc03e09d5ec', '[\"*\"]', '2024-04-26 17:10:01', NULL, '2024-04-26 10:59:20', '2024-04-26 17:10:01'),
(33, 'App\\Models\\User', 1, 'AuthToken', '8a67f42121f4d899ccbb447e06b2baf90c402fab6c5e0102729445b53f43450b', '[\"*\"]', '2024-04-27 04:29:20', NULL, '2024-04-26 17:25:35', '2024-04-27 04:29:20'),
(34, 'App\\Models\\User', 1, 'AuthToken', '25296ee529d2b5cb085b66c7c72122d76e73ef55cc09245be1b024f16f6114be', '[\"*\"]', '2024-05-07 15:32:21', NULL, '2024-04-28 16:46:22', '2024-05-07 15:32:21'),
(35, 'App\\Models\\User', 2, 'AuthToken', '8e5465ce3922abf86559c6982e8369e25537653abd4cc8b30317a2f977972bb7', '[\"*\"]', '2024-05-10 08:16:08', NULL, '2024-05-07 15:40:00', '2024-05-10 08:16:08'),
(36, 'App\\Models\\User', 3, 'AuthToken', 'f69c521a12925e94e11d9bef912a271cd48b2946069baccef9209a0ade4155ae', '[\"*\"]', '2024-05-10 10:54:24', NULL, '2024-05-10 08:27:28', '2024-05-10 10:54:24'),
(37, 'App\\Models\\User', 1, 'AuthToken', 'cc7099a15c199f4e043e22eed37d33583bba2bf807ee457c951a6d198c0cf678', '[\"*\"]', '2024-05-12 17:52:52', NULL, '2024-05-12 17:52:03', '2024-05-12 17:52:52'),
(38, 'App\\Models\\User', 3, 'AuthToken', '4cf961fb820678048a9299d6dfb4f7e0def2e5145790d86592ab2f6b2b73a50b', '[\"*\"]', '2024-05-13 07:01:31', NULL, '2024-05-12 17:53:34', '2024-05-13 07:01:31'),
(39, 'App\\Models\\User', 1, 'AuthToken', '6f20eb0a22b7682054a19d64c13e9e8078ce4cb69833df0bd5253c6c31a05578', '[\"*\"]', '2024-05-13 08:30:08', NULL, '2024-05-13 07:01:46', '2024-05-13 08:30:08'),
(40, 'App\\Models\\User', 1, 'AuthToken', 'c55a36ea54aca291610bd7da0c125a63065a69e609c5cc3e8f1893206c5f93a1', '[\"*\"]', '2024-05-13 08:34:24', NULL, '2024-05-13 08:31:05', '2024-05-13 08:34:24'),
(41, 'App\\Models\\User', 3, 'AuthToken', '1e6dae1d4c1d13eb5f8125e03f34b53fe09438641b1e30cfddfbc74c9b10e784', '[\"*\"]', '2024-05-13 09:07:33', NULL, '2024-05-13 08:35:29', '2024-05-13 09:07:33'),
(42, 'App\\Models\\User', 5, 'AuthToken', '03cf76ce7e490d10aa048c1efcfd3f04fa60ae0ba3d6ecf11755a485d58db4c2', '[\"*\"]', '2024-05-13 09:10:16', NULL, '2024-05-13 09:08:51', '2024-05-13 09:10:16'),
(43, 'App\\Models\\User', 4, 'AuthToken', '797eb1c0af6d572257135cca40d9384e9d772c74e32f5e9d6f17a97338369714', '[\"*\"]', '2024-05-13 10:51:01', NULL, '2024-05-13 09:11:57', '2024-05-13 10:51:01'),
(44, 'App\\Models\\User', 1, 'AuthToken', '436f2f2044268c0b613138cc794818192809db9d95fcb735c571c3cedff6b7ba', '[\"*\"]', '2024-05-23 10:21:37', NULL, '2024-05-13 10:51:26', '2024-05-23 10:21:37'),
(45, 'App\\Models\\User', 4, 'AuthToken', '7acbf1c8dd531d7b181998e8095780285b490191cd999f8c562f3c8657f9141d', '[\"*\"]', '2024-05-23 10:58:16', NULL, '2024-05-23 10:22:24', '2024-05-23 10:58:16'),
(46, 'App\\Models\\User', 1, 'AuthToken', '4bdee21586817f27c67e02f6e18d78a016d01e9ade7f3fae346de24100556863', '[\"*\"]', '2024-05-27 12:24:29', NULL, '2024-05-23 10:58:48', '2024-05-27 12:24:29'),
(47, 'App\\Models\\User', 1, 'AuthToken', '10e5babe018406998a6b1296fdd6539156c45899acbab8ce19bcf58118b02a49', '[\"*\"]', '2024-05-27 12:54:44', NULL, '2024-05-27 12:26:59', '2024-05-27 12:54:44'),
(48, 'App\\Models\\User', 1, 'AuthToken', '7fdc204bc6b1e0624249f4aff558bf23663526167a9b5825a7ebccc111719029', '[\"*\"]', '2024-05-28 06:31:25', NULL, '2024-05-27 17:06:14', '2024-05-28 06:31:25'),
(49, 'App\\Models\\User', 1, 'AuthToken', '24f92b484b55919db446127778d3a4a791d4ed4b2ebbf07d41a817fcecd58212', '[\"*\"]', '2024-05-29 14:40:42', NULL, '2024-05-28 14:32:53', '2024-05-29 14:40:42'),
(50, 'App\\Models\\User', 1, 'AuthToken', '63d38371905445b7bf606bc1cae1c11dc977a69e9e2d4e2a351ddc126bd8269c', '[\"*\"]', '2024-05-29 14:47:11', NULL, '2024-05-29 14:45:42', '2024-05-29 14:47:11'),
(51, 'App\\Models\\User', 1, 'AuthToken', 'ea8027560a591cdaedef41a185f500843713f41b030684d74150035e9444cd92', '[\"*\"]', '2024-06-03 09:41:58', NULL, '2024-05-29 14:55:08', '2024-06-03 09:41:58');

-- --------------------------------------------------------

--
-- Table structure for table `posaudits`
--

CREATE TABLE `posaudits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `visit_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posaudits`
--

INSERT INTO `posaudits` (`id`, `user_id`, `outlet_id`, `visit_id`, `image`, `created_at`, `updated_at`) VALUES
(24, '1', 2, 30, '', '2024-04-15 07:02:28', '2024-04-15 07:02:28'),
(25, '1', 3, 45, '', '2024-04-15 07:03:14', '2024-04-15 07:03:14'),
(26, '1', 3, 45, '', '2024-04-15 07:07:10', '2024-04-15 07:07:10'),
(27, '1', 3, 45, '', '2024-04-15 07:07:46', '2024-04-15 07:07:46'),
(29, '1', 7, 80, '', '2024-05-02 10:08:35', '2024-05-02 10:08:35'),
(30, '1', 7, 80, '', '2024-05-02 10:09:13', '2024-05-02 10:09:13'),
(31, '1', 7, 80, '', '2024-05-02 10:10:44', '2024-05-02 10:10:44'),
(32, '1', 7, 80, '', '2024-05-02 10:13:06', '2024-05-02 10:13:06'),
(33, '1', 7, 80, '', '2024-05-02 10:15:17', '2024-05-02 10:15:17'),
(34, '1', 7, 80, '', '2024-05-02 10:18:39', '2024-05-02 10:18:39'),
(35, '1', 7, 80, '', '2024-05-02 10:25:36', '2024-05-02 10:25:36'),
(36, '1', 7, 80, '', '2024-05-02 13:01:17', '2024-05-02 13:01:17'),
(37, '1', 7, 80, '', '2024-05-02 13:20:19', '2024-05-02 13:20:19'),
(38, '1', 7, 80, '', '2024-05-02 13:32:05', '2024-05-02 13:32:05'),
(39, '2', 30, 112, '', '2024-05-09 12:14:19', '2024-05-09 12:14:19'),
(40, '1', 26, 134, '', '2024-05-15 07:33:40', '2024-05-15 07:33:40'),
(41, '1', 26, 134, '', '2024-05-15 07:37:35', '2024-05-15 07:37:35'),
(42, '1', 26, 134, '', '2024-05-15 07:38:06', '2024-05-15 07:38:06'),
(43, '1', 26, 134, '', '2024-05-15 07:40:15', '2024-05-15 07:40:15'),
(44, '1', 26, 134, '', '2024-05-15 07:48:31', '2024-05-15 07:48:31'),
(45, '1', 26, 134, '', '2024-05-15 07:49:38', '2024-05-15 07:49:38'),
(46, '1', 26, 134, '', '2024-05-15 07:52:13', '2024-05-15 07:52:13'),
(47, '1', 26, 134, '', '2024-05-15 07:53:01', '2024-05-15 07:53:01'),
(48, '1', 26, 134, '', '2024-05-15 07:55:21', '2024-05-15 07:55:21'),
(49, '1', 26, 134, '', '2024-05-15 07:57:37', '2024-05-15 07:57:37'),
(50, '1', 26, 134, '', '2024-05-15 08:34:38', '2024-05-15 08:34:38'),
(51, '1', 26, 134, '', '2024-05-15 08:36:48', '2024-05-15 08:36:48'),
(52, '1', 26, 134, '', '2024-05-15 08:38:33', '2024-05-15 08:38:33'),
(53, '1', 26, 134, '', '2024-05-15 08:50:32', '2024-05-15 08:50:32'),
(54, '1', 26, 134, '', '2024-05-15 09:00:22', '2024-05-15 09:00:22'),
(55, '1', 26, 134, '', '2024-05-15 09:04:52', '2024-05-15 09:04:52'),
(56, '1', 26, 134, '', '2024-05-15 09:35:28', '2024-05-15 09:35:28'),
(57, '1', 26, 134, '', '2024-05-15 13:09:37', '2024-05-15 13:09:37'),
(58, '1', 26, 134, '', '2024-05-15 13:14:07', '2024-05-15 13:14:07'),
(59, '1', 26, 134, '', '2024-05-15 13:24:49', '2024-05-15 13:24:49'),
(60, '1', 26, 134, '', '2024-05-15 13:25:39', '2024-05-15 13:25:39'),
(61, '1', 26, 134, '', '2024-05-15 13:33:45', '2024-05-15 13:33:45'),
(62, '1', 26, 134, '', '2024-05-15 13:35:41', '2024-05-15 13:35:41'),
(63, '1', 26, 134, 'posaudits/1715776563885.jpg', '2024-05-15 13:36:01', '2024-05-15 13:36:06'),
(66, '1', 38, 137, 'posaudits/1715777889453.jpg', '2024-05-15 13:58:02', '2024-05-15 13:58:12'),
(67, '1', 38, 137, 'posaudits/1715777947002.jpg', '2024-05-15 13:59:03', '2024-05-15 13:59:09'),
(68, '1', 50, 179, 'posaudits/1716437154427.jpg', '2024-05-23 05:05:39', '2024-05-23 05:05:55'),
(69, '1', 76, 231, 'posaudits/1716783654866.jpg', '2024-05-27 05:20:48', '2024-05-27 05:20:56'),
(70, '1', 38, 237, 'posaudits/1716796751285.jpg', '2024-05-27 08:59:04', '2024-05-27 08:59:13'),
(71, '1', 38, 238, 'posaudits/1716807734434.jpg', '2024-05-27 12:02:07', '2024-05-27 12:02:16'),
(72, '1', 94, 251, 'posaudits/1716994739342.jpg', '2024-05-29 15:58:52', '2024-05-29 15:59:01'),
(73, '1', 95, 252, 'posaudits/1716994935554.jpg', '2024-05-29 16:02:10', '2024-05-29 16:02:17'),
(74, '1', 93, 265, 'posaudits/1717144709006.jpg', '2024-05-31 09:38:20', '2024-05-31 09:38:32'),
(75, '1', 93, 274, 'posaudits/1717162053172.jpg', '2024-05-31 14:27:27', '2024-05-31 14:27:36'),
(76, '1', 99, 277, 'posaudits/1717337572149.jpg', '2024-06-02 15:12:45', '2024-06-02 15:12:53');

-- --------------------------------------------------------

--
-- Table structure for table `posaudit_items`
--

CREATE TABLE `posaudit_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `posaudit_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `pieces` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posaudit_items`
--

INSERT INTO `posaudit_items` (`id`, `posaudit_id`, `product_id`, `pieces`, `created_at`, `updated_at`) VALUES
(2, '24', '1', '9', '2024-04-15 07:02:28', '2024-04-15 07:02:28'),
(3, '24', '2', '8', '2024-04-15 07:02:28', '2024-04-15 07:02:28'),
(4, '24', '3', '7', '2024-04-15 07:02:28', '2024-04-15 07:02:28'),
(5, '25', '1', '9', '2024-04-15 07:03:14', '2024-04-15 07:03:14'),
(6, '25', '2', '8', '2024-04-15 07:03:14', '2024-04-15 07:03:14'),
(7, '25', '3', '7', '2024-04-15 07:03:14', '2024-04-15 07:03:14'),
(8, '26', '1', '10', '2024-04-15 07:07:10', '2024-04-15 07:07:10'),
(9, '26', '2', '10', '2024-04-15 07:07:10', '2024-04-15 07:07:10'),
(10, '26', '3', '10', '2024-04-15 07:07:10', '2024-04-15 07:07:10'),
(11, '27', '1', '10', '2024-04-15 07:07:46', '2024-04-15 07:07:46'),
(12, '27', '2', '10', '2024-04-15 07:07:46', '2024-04-15 07:07:46'),
(13, '27', '3', '10', '2024-04-15 07:07:46', '2024-04-15 07:07:46'),
(17, '29', '2', '6', '2024-05-02 10:08:35', '2024-05-02 10:08:35'),
(18, '30', '2', '6', '2024-05-02 10:09:13', '2024-05-02 10:09:13'),
(19, '31', '2', '6', '2024-05-02 10:10:44', '2024-05-02 10:10:44'),
(20, '31', '3', '8', '2024-05-02 10:10:44', '2024-05-02 10:10:44'),
(21, '32', '1', '9', '2024-05-02 10:13:06', '2024-05-02 10:13:06'),
(22, '32', '2', '3', '2024-05-02 10:13:06', '2024-05-02 10:13:06'),
(23, '33', '2', '9', '2024-05-02 10:15:17', '2024-05-02 10:15:17'),
(24, '33', '3', '6', '2024-05-02 10:15:17', '2024-05-02 10:15:17'),
(25, '34', '1', '9', '2024-05-02 10:18:39', '2024-05-02 10:18:39'),
(26, '34', '2', '6', '2024-05-02 10:18:39', '2024-05-02 10:18:39'),
(27, '35', '3', '5', '2024-05-02 10:25:36', '2024-05-02 10:25:36'),
(28, '36', '1', '5', '2024-05-02 13:01:17', '2024-05-02 13:01:17'),
(29, '36', '2', '5', '2024-05-02 13:01:17', '2024-05-02 13:01:17'),
(30, '37', '1', '8', '2024-05-02 13:20:19', '2024-05-02 13:20:19'),
(31, '38', '2', '2', '2024-05-02 13:32:05', '2024-05-02 13:32:05'),
(32, '39', '1', '2', '2024-05-09 12:14:19', '2024-05-09 12:14:19'),
(33, '40', '1', '5', '2024-05-15 07:33:40', '2024-05-15 07:33:40'),
(34, '41', '1', '5', '2024-05-15 07:37:35', '2024-05-15 07:37:35'),
(35, '42', '1', '5', '2024-05-15 07:38:06', '2024-05-15 07:38:06'),
(36, '43', '1', '5', '2024-05-15 07:40:15', '2024-05-15 07:40:15'),
(37, '44', '2', '5', '2024-05-15 07:48:31', '2024-05-15 07:48:31'),
(38, '45', '1', '5', '2024-05-15 07:49:38', '2024-05-15 07:49:38'),
(39, '46', '1', '5', '2024-05-15 07:52:13', '2024-05-15 07:52:13'),
(40, '47', '1', '5', '2024-05-15 07:53:01', '2024-05-15 07:53:01'),
(41, '48', '1', '5', '2024-05-15 07:55:21', '2024-05-15 07:55:21'),
(42, '49', '1', '5', '2024-05-15 07:57:37', '2024-05-15 07:57:37'),
(43, '50', '1', '5', '2024-05-15 08:34:38', '2024-05-15 08:34:38'),
(44, '51', '1', '5', '2024-05-15 08:36:48', '2024-05-15 08:36:48'),
(45, '52', '1', '6', '2024-05-15 08:38:33', '2024-05-15 08:38:33'),
(46, '53', '1', '5', '2024-05-15 08:50:32', '2024-05-15 08:50:32'),
(47, '54', '1', '5', '2024-05-15 09:00:22', '2024-05-15 09:00:22'),
(48, '55', '1', '5', '2024-05-15 09:04:52', '2024-05-15 09:04:52'),
(49, '56', '1', '5', '2024-05-15 09:35:28', '2024-05-15 09:35:28'),
(50, '57', '1', '5', '2024-05-15 13:09:37', '2024-05-15 13:09:37'),
(51, '58', '1', '5', '2024-05-15 13:14:07', '2024-05-15 13:14:07'),
(52, '59', '1', '5', '2024-05-15 13:24:49', '2024-05-15 13:24:49'),
(53, '60', '1', '5', '2024-05-15 13:25:39', '2024-05-15 13:25:39'),
(54, '61', '1', '5', '2024-05-15 13:33:45', '2024-05-15 13:33:45'),
(55, '62', '1', '5', '2024-05-15 13:35:41', '2024-05-15 13:35:41'),
(56, '63', '1', '5', '2024-05-15 13:36:01', '2024-05-15 13:36:01'),
(57, '64', '1', '5', '2024-05-15 13:40:11', '2024-05-15 13:40:11'),
(59, '66', '1', '5', '2024-05-15 13:58:02', '2024-05-15 13:58:02'),
(60, '67', '2', '5', '2024-05-15 13:59:03', '2024-05-15 13:59:03'),
(61, '68', '3', '10', '2024-05-23 05:05:39', '2024-05-23 05:05:39'),
(62, '69', '2', '6', '2024-05-27 05:20:48', '2024-05-27 05:20:48'),
(63, '70', '1', '5', '2024-05-27 08:59:04', '2024-05-27 08:59:04'),
(64, '71', '3', '2', '2024-05-27 12:02:07', '2024-05-27 12:02:07'),
(65, '71', '2', '5', '2024-05-27 12:02:07', '2024-05-27 12:02:07'),
(66, '71', '1', '4', '2024-05-27 12:02:07', '2024-05-27 12:02:07'),
(67, '72', '3', '2', '2024-05-29 15:58:52', '2024-05-29 15:58:52'),
(68, '72', '2', '6', '2024-05-29 15:58:52', '2024-05-29 15:58:52'),
(69, '72', '1', '4', '2024-05-29 15:58:52', '2024-05-29 15:58:52'),
(70, '73', '3', '5', '2024-05-29 16:02:10', '2024-05-29 16:02:10'),
(71, '74', '3', '5', '2024-05-31 09:38:20', '2024-05-31 09:38:20'),
(72, '74', '2', '5', '2024-05-31 09:38:20', '2024-05-31 09:38:20'),
(73, '74', '1', '2', '2024-05-31 09:38:20', '2024-05-31 09:38:20'),
(74, '75', '3', '5', '2024-05-31 14:27:27', '2024-05-31 14:27:27'),
(75, '75', '2', '50', '2024-05-31 14:27:27', '2024-05-31 14:27:27'),
(76, '75', '1', '6', '2024-05-31 14:27:27', '2024-05-31 14:27:27'),
(77, '76', '3', '6', '2024-06-02 15:12:45', '2024-06-02 15:12:45'),
(78, '76', '2', '8', '2024-06-02 15:12:45', '2024-06-02 15:12:45'),
(79, '76', '1', '10', '2024-06-02 15:12:45', '2024-06-02 15:12:45');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `price` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `description`, `price`, `stock`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Oppo A18', 'WJ6788', 'RAM: 4GB\r\nStorage: 128/64GB\r\nBattery: 5,000 mAh\r\nCamera: 8MP + 2MP\r\nSelfie: 5MP\r\nDisplay: 6.56 inch, IPS LCD,90Hz\r\nProcessor: Mediatek MT6769 Helio G85 (12nm)\r\nConnectivity: Dual SIM, 4G, Wi-Fi\r\nColors: Glowing Black, Glowing Blue\r\nOS: Android 13, ColorOS 13.1', '15000', 961, '', '2024-03-28 10:34:59', '2024-06-02 15:12:09'),
(2, 'Samsung  A03s', 'SG2050', '5 inch display\r\n5000mAh battery\r\n3GB RAM', '10000', 965, '', '2024-03-28 10:14:59', '2024-06-02 15:12:09'),
(3, 'Tecno Pop 7', 'TC2390', 'RAM: 8GB /12GB\r\nInternal Memory: 256GB, 512GB\r\nDisplay: 6.78-inches, AMOLED, 120 Hz\r\nProcessor: Mediatek Dimensity 7020 (6 nm)\r\nOS: Android 14 with HiOS 14\r\nMain Camera: 50MP+2MP+ 0.08 MP\r\nSelfie Camera: 50MP\r\nConnectivity: 5G\r\nBattery: 5,000mAh, 70W', '20000', 940, '', '2024-03-28 11:34:59', '2024-06-02 15:12:09'),
(47, 'Test Product', 'SD3456', '- Test\r\n- Test', '5567', 20000000, '1717055248.png', '2024-05-30 08:47:28', '2024-05-30 08:47:28'),
(48, 'Test Product2', 'TP2345', '- Test\r\n- Test', '230', 20, 'products/1717055630.png', '2024-05-30 08:53:50', '2024-05-30 08:53:50'),
(49, 'Test Product', 'TP2345', '- Test\r\n- Test', '20000', 20, '', '2024-05-30 09:04:50', '2024-05-30 09:04:50'),
(50, 'Test Product', 'PL3455', '- Test\r\n- Test', '2000', 200, 'products/1717074701.png', '2024-05-30 09:05:35', '2024-05-30 15:22:56'),
(51, 'Testing Again', 'PL3232', '- Test\r\n- Test', '900', 20, '', '2024-05-31 13:43:16', '2024-05-31 13:43:16');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `visit_id` int(11) NOT NULL,
  `pieces` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `outlet_id`, `visit_id`, `pieces`, `value`, `created_at`, `updated_at`) VALUES
(9, 1, 2, 30, '24', '288000', '2024-05-02 14:19:09', '2024-05-02 14:19:09'),
(10, 1, 2, 30, '24', '288000', '2024-05-02 14:20:35', '2024-05-02 14:20:35'),
(11, 1, 2, 30, '24', '288000', '2024-05-02 14:45:22', '2024-05-02 14:45:22'),
(12, 1, 2, 30, '24', '288000', '2024-05-02 14:45:56', '2024-05-02 14:45:56'),
(13, 1, 7, 80, '6', '72000', '2024-05-02 14:53:08', '2024-05-02 14:53:08'),
(14, 1, 7, 80, '18', '216000', '2024-05-03 08:51:20', '2024-05-03 08:51:20'),
(15, 1, 2, 97, '5', '60000', '2024-05-07 12:46:06', '2024-05-07 12:46:06'),
(17, 1, 5, 98, '2000', '24000000', '2024-05-07 14:06:03', '2024-05-07 14:06:03'),
(19, 1, 2, 100, '6', '72000', '2024-05-07 14:55:20', '2024-05-07 14:55:20'),
(20, 1, 2, 100, '6', '72000', '2024-05-07 15:04:10', '2024-05-07 15:04:10'),
(21, 1, 3, 101, '6', '72000', '2024-05-07 15:20:43', '2024-05-07 15:20:43'),
(22, 1, 3, 101, '3', '36000', '2024-05-07 15:22:11', '2024-05-07 15:22:11'),
(25, 2, 30, 111, '2', '24000', '2024-05-09 09:06:25', '2024-05-09 09:06:25'),
(29, 2, 30, 112, '15', '180000', '2024-05-09 16:22:46', '2024-05-09 16:22:46'),
(30, 2, 30, 115, '2', '24000', '2024-05-10 06:58:09', '2024-05-10 06:58:09'),
(31, 3, 33, 124, '5', '60000', '2024-05-13 08:49:57', '2024-05-13 08:49:57'),
(32, 5, 34, 126, '10', '120000', '2024-05-13 09:09:51', '2024-05-13 09:09:51'),
(35, 1, 42, 142, '5', '60000', '2024-05-16 17:43:30', '2024-05-16 17:43:30'),
(36, 1, 42, 142, '10', '120000', '2024-05-16 17:43:43', '2024-05-16 17:43:43'),
(37, 1, 42, 142, '10', '120000', '2024-05-16 18:53:16', '2024-05-16 18:53:16'),
(38, 1, 43, 143, '3', '36000', '2024-05-17 08:26:11', '2024-05-17 08:26:11'),
(39, 1, 46, 146, '20', '240000', '2024-05-21 05:04:40', '2024-05-21 05:04:40'),
(40, 1, 9, 152, '2', '24000', '2024-05-21 06:50:26', '2024-05-21 06:50:26'),
(41, 1, 47, 157, '5', '90000', '2024-05-22 04:25:43', '2024-05-22 04:25:43'),
(42, 1, 47, 160, '50', '900000', '2024-05-22 04:34:27', '2024-05-22 04:34:27'),
(43, 1, 48, 161, '5', '50000', '2024-05-22 05:43:00', '2024-05-22 05:43:00'),
(44, 1, 49, 162, '5', '50000', '2024-05-22 06:00:41', '2024-05-22 06:00:41'),
(45, 1, 43, 165, '10', '180000', '2024-05-22 06:39:42', '2024-05-22 06:39:42'),
(46, 1, 43, 177, '10', '150000', '2024-05-22 16:14:20', '2024-05-22 16:14:20'),
(47, 1, 43, 177, '5', '50000', '2024-05-22 16:50:35', '2024-05-22 16:50:35'),
(48, 1, 50, 178, '5', '50000', '2024-05-23 05:04:38', '2024-05-23 05:04:38'),
(49, 1, 50, 179, '20', '300000', '2024-05-23 05:09:25', '2024-05-23 05:09:25'),
(50, 1, 51, 181, '10', '100000', '2024-05-23 05:33:13', '2024-05-23 05:33:13'),
(51, 1, 52, 182, '3', '40000', '2024-05-23 05:37:09', '2024-05-23 05:37:09'),
(52, 1, 53, 183, '5', '50000', '2024-05-23 05:39:21', '2024-05-23 05:39:21'),
(56, 4, 35, 208, '5', '50000', '2024-05-23 10:56:30', '2024-05-23 10:56:30'),
(57, 4, 35, 209, '5', '90000', '2024-05-23 10:56:54', '2024-05-23 10:56:54'),
(58, 4, 35, 209, '5', '60000', '2024-05-23 10:57:05', '2024-05-23 10:57:05'),
(59, 4, 35, 209, '5', '90000', '2024-05-23 10:57:14', '2024-05-23 10:57:14'),
(60, 4, 35, 210, '20', '280000', '2024-05-23 10:57:45', '2024-05-23 10:57:45'),
(61, 1, 38, 207, '5', '50000', '2024-05-23 12:34:28', '2024-05-23 12:34:28'),
(65, 1, 84, 239, '5', '100000', '2024-05-28 04:41:31', '2024-05-28 04:41:31'),
(66, 1, 94, 251, '10', '150000', '2024-05-29 15:58:30', '2024-05-29 15:58:30'),
(67, 1, 93, 265, '30', '450000', '2024-05-31 09:37:54', '2024-05-31 09:37:54'),
(68, 1, 93, 265, '10', '100000', '2024-05-31 09:44:37', '2024-05-31 09:44:37'),
(71, 1, 97, 273, '10', '200000', '2024-05-31 14:02:43', '2024-05-31 14:02:43'),
(72, 1, 97, 273, '10', '200000', '2024-05-31 14:03:59', '2024-05-31 14:03:59'),
(73, 1, 97, 273, '60', '900000', '2024-05-31 14:25:50', '2024-05-31 14:25:50'),
(74, 1, 93, 274, '16', '240000', '2024-05-31 14:26:57', '2024-05-31 14:26:57'),
(75, 1, 93, 275, '9', '160000', '2024-05-31 15:11:25', '2024-05-31 15:11:25'),
(76, 1, 47, 276, '15', '225000', '2024-06-02 14:14:32', '2024-06-02 14:14:32'),
(77, 1, 99, 277, '14', '210000', '2024-06-02 15:12:09', '2024-06-02 15:12:09');

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `pieces` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`id`, `sale_id`, `product_id`, `pieces`, `price`, `value`, `created_at`, `updated_at`) VALUES
(1, '9', '1', '9', '12000', '108000', '2024-05-02 14:19:09', '2024-05-02 14:19:09'),
(2, '9', '2', '8', '12000', '96000', '2024-05-02 14:19:09', '2024-05-02 14:19:09'),
(3, '9', '3', '7', '12000', '84000', '2024-05-02 14:19:09', '2024-05-02 14:19:09'),
(4, '10', '1', '9', '12000', '108000', '2024-05-02 14:20:35', '2024-05-02 14:20:35'),
(5, '10', '2', '8', '12000', '96000', '2024-05-02 14:20:35', '2024-05-02 14:20:35'),
(6, '10', '3', '7', '12000', '84000', '2024-05-02 14:20:35', '2024-05-02 14:20:35'),
(7, '11', '1', '9', '12000', '108000', '2024-05-02 14:45:22', '2024-05-02 14:45:22'),
(8, '11', '2', '8', '12000', '96000', '2024-05-02 14:45:22', '2024-05-02 14:45:22'),
(9, '11', '3', '7', '12000', '84000', '2024-05-02 14:45:22', '2024-05-02 14:45:22'),
(10, '12', '1', '9', '12000', '108000', '2024-05-02 14:45:56', '2024-05-02 14:45:56'),
(11, '12', '2', '8', '12000', '96000', '2024-05-02 14:45:56', '2024-05-02 14:45:56'),
(12, '12', '3', '7', '12000', '84000', '2024-05-02 14:45:56', '2024-05-02 14:45:56'),
(13, '13', '1', '3', '12000', '36000', '2024-05-02 14:53:08', '2024-05-02 14:53:08'),
(14, '13', '2', '3', '12000', '36000', '2024-05-02 14:53:08', '2024-05-02 14:53:08'),
(15, '14', '1', '9', '12000', '108000', '2024-05-03 08:51:20', '2024-05-03 08:51:20'),
(16, '14', '2', '9', '12000', '108000', '2024-05-03 08:51:20', '2024-05-03 08:51:20'),
(17, '15', '1', '5', '12000', '60000', '2024-05-07 12:46:06', '2024-05-07 12:46:06'),
(18, '17', '1', '2000', '12000', '24000000', '2024-05-07 14:06:03', '2024-05-07 14:06:03'),
(19, '19', '1', '4', '12000', '48000', '2024-05-07 14:55:20', '2024-05-07 14:55:20'),
(20, '19', '2', '2', '12000', '24000', '2024-05-07 14:55:20', '2024-05-07 14:55:20'),
(21, '20', '1', '4', '12000', '48000', '2024-05-07 15:04:10', '2024-05-07 15:04:10'),
(22, '20', '2', '2', '12000', '24000', '2024-05-07 15:04:10', '2024-05-07 15:04:10'),
(23, '21', '1', '6', '12000', '72000', '2024-05-07 15:20:43', '2024-05-07 15:20:43'),
(24, '22', '2', '3', '12000', '36000', '2024-05-07 15:22:11', '2024-05-07 15:22:11'),
(25, '23', '1', '1', '12000', '12000', '2024-05-09 07:41:15', '2024-05-09 07:41:15'),
(26, '23', '2', '1', '12000', '12000', '2024-05-09 07:41:15', '2024-05-09 07:41:15'),
(27, '24', '1', '3', '12000', '36000', '2024-05-09 08:38:20', '2024-05-09 08:38:20'),
(28, '25', '1', '2', '12000', '24000', '2024-05-09 09:06:25', '2024-05-09 09:06:25'),
(29, '29', '1', '5', '12000', '60000', '2024-05-09 16:22:46', '2024-05-09 16:22:46'),
(30, '29', '2', '5', '12000', '60000', '2024-05-09 16:22:46', '2024-05-09 16:22:46'),
(31, '29', '3', '5', '12000', '60000', '2024-05-09 16:22:46', '2024-05-09 16:22:46'),
(32, '30', '1', '2', '12000', '24000', '2024-05-10 06:58:09', '2024-05-10 06:58:09'),
(33, '31', '1', '5', '12000', '60000', '2024-05-13 08:49:57', '2024-05-13 08:49:57'),
(34, '32', '1', '5', '12000', '60000', '2024-05-13 09:09:51', '2024-05-13 09:09:51'),
(35, '32', '2', '5', '12000', '60000', '2024-05-13 09:09:51', '2024-05-13 09:09:51'),
(36, '33', '2', '100', '12000', '1200000', '2024-05-13 09:12:57', '2024-05-13 09:12:57'),
(37, '34', '2', '2000', '12000', '24000000', '2024-05-13 09:13:05', '2024-05-13 09:13:05'),
(38, '35', '1', '5', '12000', '60000', '2024-05-16 17:43:30', '2024-05-16 17:43:30'),
(39, '36', '2', '10', '12000', '120000', '2024-05-16 17:43:43', '2024-05-16 17:43:43'),
(40, '37', '3', '10', '12000', '120000', '2024-05-16 18:53:16', '2024-05-16 18:53:16'),
(41, '38', '2', '1', '12000', '12000', '2024-05-17 08:26:11', '2024-05-17 08:26:11'),
(42, '38', '3', '2', '12000', '24000', '2024-05-17 08:26:11', '2024-05-17 08:26:11'),
(43, '39', '1', '10', '12000', '120000', '2024-05-21 05:04:40', '2024-05-21 05:04:40'),
(44, '39', '2', '10', '12000', '120000', '2024-05-21 05:04:40', '2024-05-21 05:04:40'),
(45, '40', '1', '2', '12000', '24000', '2024-05-21 06:50:26', '2024-05-21 06:50:26'),
(46, '41', '3', '5', '18000', '90000', '2024-05-22 04:25:43', '2024-05-22 04:25:43'),
(47, '42', '3', '50', '18000', '900000', '2024-05-22 04:34:27', '2024-05-22 04:34:27'),
(48, '43', '2', '5', '10000', '50000', '2024-05-22 05:43:00', '2024-05-22 05:43:00'),
(49, '44', '2', '5', '10000', '50000', '2024-05-22 06:00:41', '2024-05-22 06:00:41'),
(50, '45', '3', '10', '18000', '180000', '2024-05-22 06:39:42', '2024-05-22 06:39:42'),
(51, '46', '3', '5', '18000', '90000', '2024-05-22 16:14:20', '2024-05-22 16:14:20'),
(52, '46', '1', '5', '12000', '60000', '2024-05-22 16:14:20', '2024-05-22 16:14:20'),
(53, '47', '2', '5', '10000', '50000', '2024-05-22 16:50:35', '2024-05-22 16:50:35'),
(54, '48', '2', '5', '10000', '50000', '2024-05-23 05:04:38', '2024-05-23 05:04:38'),
(55, '49', '3', '10', '18000', '180000', '2024-05-23 05:09:25', '2024-05-23 05:09:25'),
(56, '49', '1', '10', '12000', '120000', '2024-05-23 05:09:25', '2024-05-23 05:09:25'),
(57, '50', '2', '10', '10000', '100000', '2024-05-23 05:33:13', '2024-05-23 05:33:13'),
(58, '51', '3', '1', '18000', '18000', '2024-05-23 05:37:09', '2024-05-23 05:37:09'),
(59, '51', '2', '1', '10000', '10000', '2024-05-23 05:37:09', '2024-05-23 05:37:09'),
(60, '51', '1', '1', '12000', '12000', '2024-05-23 05:37:09', '2024-05-23 05:37:09'),
(61, '52', '2', '5', '10000', '50000', '2024-05-23 05:39:21', '2024-05-23 05:39:21'),
(62, '53', '2', '4', '10000', '40000', '2024-05-23 06:01:16', '2024-05-23 06:01:16'),
(63, '54', '2', '5', '10000', '50000', '2024-05-23 08:41:58', '2024-05-23 08:41:58'),
(64, '55', '2', '5', '10000', '50000', '2024-05-23 08:42:43', '2024-05-23 08:42:43'),
(65, '56', '2', '5', '10000', '50000', '2024-05-23 10:56:30', '2024-05-23 10:56:30'),
(66, '57', '3', '5', '18000', '90000', '2024-05-23 10:56:54', '2024-05-23 10:56:54'),
(67, '58', '1', '5', '12000', '60000', '2024-05-23 10:57:05', '2024-05-23 10:57:05'),
(68, '59', '3', '5', '18000', '90000', '2024-05-23 10:57:14', '2024-05-23 10:57:14'),
(69, '60', '3', '10', '18000', '180000', '2024-05-23 10:57:45', '2024-05-23 10:57:45'),
(70, '60', '2', '10', '10000', '100000', '2024-05-23 10:57:45', '2024-05-23 10:57:45'),
(71, '61', '2', '5', '10000', '50000', '2024-05-23 12:34:28', '2024-05-23 12:34:28'),
(72, '62', '3', '5', '18000', '90000', '2024-05-27 06:06:46', '2024-05-27 06:06:46'),
(73, '63', '2', '10', '10000', '100000', '2024-05-27 08:58:45', '2024-05-27 08:58:45'),
(74, '64', '3', '5', '20000', '100000', '2024-05-27 12:01:45', '2024-05-27 12:01:45'),
(75, '64', '2', '5', '10000', '50000', '2024-05-27 12:01:45', '2024-05-27 12:01:45'),
(76, '65', '3', '5', '20000', '100000', '2024-05-28 04:41:31', '2024-05-28 04:41:31'),
(77, '66', '3', '5', '20000', '100000', '2024-05-29 15:58:30', '2024-05-29 15:58:30'),
(78, '66', '2', '5', '10000', '50000', '2024-05-29 15:58:30', '2024-05-29 15:58:30'),
(79, '67', '3', '10', '20000', '200000', '2024-05-31 09:37:54', '2024-05-31 09:37:54'),
(80, '67', '2', '10', '10000', '100000', '2024-05-31 09:37:54', '2024-05-31 09:37:54'),
(81, '67', '1', '10', '15000', '150000', '2024-05-31 09:37:54', '2024-05-31 09:37:54'),
(82, '68', '2', '10', '10000', '100000', '2024-05-31 09:44:37', '2024-05-31 09:44:37'),
(86, '71', '3', '10', '20000', '200000', '2024-05-31 14:02:43', '2024-05-31 14:02:43'),
(87, '72', '3', '10', '20000', '200000', '2024-05-31 14:03:59', '2024-05-31 14:03:59'),
(88, '73', '3', '20', '20000', '400000', '2024-05-31 14:25:50', '2024-05-31 14:25:50'),
(89, '73', '2', '20', '10000', '200000', '2024-05-31 14:25:50', '2024-05-31 14:25:50'),
(90, '73', '1', '20', '15000', '300000', '2024-05-31 14:25:50', '2024-05-31 14:25:50'),
(91, '74', '3', '5', '20000', '100000', '2024-05-31 14:26:57', '2024-05-31 14:26:57'),
(92, '74', '2', '5', '10000', '50000', '2024-05-31 14:26:57', '2024-05-31 14:26:57'),
(93, '74', '1', '6', '15000', '90000', '2024-05-31 14:26:57', '2024-05-31 14:26:57'),
(94, '75', '3', '5', '20000', '100000', '2024-05-31 15:11:25', '2024-05-31 15:11:25'),
(95, '75', '1', '4', '15000', '60000', '2024-05-31 15:11:25', '2024-05-31 15:11:25'),
(96, '76', '3', '5', '20000', '100000', '2024-06-02 14:14:32', '2024-06-02 14:14:32'),
(97, '76', '2', '5', '10000', '50000', '2024-06-02 14:14:32', '2024-06-02 14:14:32'),
(98, '76', '1', '5', '15000', '75000', '2024-06-02 14:14:32', '2024-06-02 14:14:32'),
(99, '77', '3', '5', '20000', '100000', '2024-06-02 15:12:09', '2024-06-02 15:12:09'),
(100, '77', '2', '5', '10000', '50000', '2024-06-02 15:12:09', '2024-06-02 15:12:09'),
(101, '77', '1', '4', '15000', '60000', '2024-06-02 15:12:09', '2024-06-02 15:12:09');

-- --------------------------------------------------------

--
-- Table structure for table `target_groups`
--

CREATE TABLE `target_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `target_groups`
--

INSERT INTO `target_groups` (`id`, `name`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'Ruaraka Group', 50000, '2024-05-13 14:06:14', '2024-05-27 11:56:47'),
(2, 'Utawala Group', 20000, '2024-05-27 09:39:34', '2024-05-27 11:57:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL,
  `target_group_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `usertype`, `target_group_id`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'JAVIS OTIENO OMONDI', '+254707641174', 'admin', 0, 'javisotieno@gmail.com', NULL, '$2y$12$fEYoaOn7rTJvGW0z1KOti.Um9PMNtX44cVB6rs5.wfb3TVQ5Lid7m', NULL, '2024-03-28 10:31:16', '2024-05-31 15:01:40'),
(2, 'Testing Account', '0788998877', 'admin', 2, 'testingaccount@gmail.com', NULL, '$2y$12$6qMhacQFTisK3B9S1agwLOBtEoB0gbwxQeoL5qR.1S2olsnGj7h7O', NULL, '2024-04-20 05:24:32', '2024-05-29 14:44:55'),
(3, 'Testing Account', '0788998877', 'sales', 0, 'testingaccount2@gmail.com', NULL, '$2y$12$6qMhacQFTisK3B9S1agwLOBtEoB0gbwxQeoL5qR.1S2olsnGj7h7O', NULL, '2024-04-20 05:24:32', '2024-05-13 15:49:45'),
(4, 'Testing Account', '0788998877', 'sales', 0, 'testingaccount3@gmail.com', NULL, '$2y$12$6qMhacQFTisK3B9S1agwLOBtEoB0gbwxQeoL5qR.1S2olsnGj7h7O', NULL, '2024-04-20 05:24:32', '2024-05-09 09:12:23'),
(5, 'Testing Account', '0788998877', 'sales', 0, 'testingaccount4@gmail.com', NULL, '$2y$12$6qMhacQFTisK3B9S1agwLOBtEoB0gbwxQeoL5qR.1S2olsnGj7h7O', NULL, '2024-04-20 05:24:32', '2024-05-09 09:12:23');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `checkin_time` varchar(255) NOT NULL,
  `checkin_latitude` varchar(255) NOT NULL,
  `checkin_longitude` varchar(255) NOT NULL,
  `checkout_time` varchar(255) NOT NULL,
  `checkout_latitude` varchar(255) NOT NULL,
  `checkout_longitude` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `outlet_id`, `user_id`, `checkin_time`, `checkin_latitude`, `checkin_longitude`, `checkout_time`, `checkout_latitude`, `checkout_longitude`, `duration`, `created_at`, `updated_at`) VALUES
(29, 6, 1, '1712337351', '-1.3253851', '36.8963908', '1712337364', '-1.3253851', '36.8963891', '', '2024-04-05 15:15:52', '2024-04-05 15:16:05'),
(30, 5, 1, '1712337402', '-1.3253811', '36.8963934', '1712337440', '-1.3253811', '36.8963934', '', '2024-04-05 15:16:43', '2024-04-05 15:17:22'),
(31, 7, 1, '1712376422', '-1.3253431', '36.8961912', '1712376445', '-1.3253806', '36.8963964', '', '2024-04-06 02:07:03', '2024-04-06 02:07:25'),
(32, 7, 1, '1712376459', '-1.3253855', '36.8963859', '1712376473', '-1.3253823', '36.8963935', '', '2024-04-06 02:07:40', '2024-04-06 02:07:53'),
(33, 4, 1, '1712394834', '-1.3253824', '36.8963943', '1712394853', '-1.3253735', '36.8963926', '', '2024-04-06 07:13:56', '2024-04-06 07:14:14'),
(34, 3, 1, '1712398446', '-1.3253353', '36.896127', '1712398594', '-1.3253353', '36.896127', '', '2024-04-06 08:14:07', '2024-04-06 08:16:35'),
(35, 8, 1, '1712398636', '-1.3253775', '36.8963964', '1712398647', '-1.3253787', '36.8963952', '', '2024-04-06 08:17:17', '2024-04-06 08:17:28'),
(36, 5, 1, '1712545354', '-1.3253715', '36.8962933', '1712545363', '-1.3253715', '36.8962933', '', '2024-04-08 01:02:36', '2024-04-08 01:02:44'),
(37, 6, 1, '1712557761', '-1.177009', '36.9895604', '1712557769', '-1.1770396', '36.9895719', '', '2024-04-08 04:29:22', '2024-04-08 04:29:30'),
(38, 9, 1, '1712558601', '-1.177009', '36.9895604', '1712558618', '-1.1770008', '36.989559', '', '2024-04-08 04:43:25', '2024-04-08 04:43:39'),
(39, 7, 1, '1712586231', '-1.1769511', '36.9893901', '1712586242', '-1.1769511', '36.9893901', '', '2024-04-08 12:23:52', '2024-04-08 12:24:02'),
(40, 3, 1, '1712820289', '-1.1768882', '36.9894314', '', '', '', '', '2024-04-11 05:24:50', '2024-04-11 05:24:50'),
(41, 10, 1, '1712820328', '-1.1768882', '36.9894314', '1712822937', '-1.1769299', '36.9893989', '', '2024-04-11 05:25:30', '2024-04-11 06:08:59'),
(42, 2, 1, '1712824568', '-1.1769265', '36.9894034', '', '', '', '', '2024-04-11 06:36:09', '2024-04-11 06:36:09'),
(43, 11, 1, '1712824645', '-1.176954', '36.9893833', '1712824865', '-1.1768881', '36.9894303', '', '2024-04-11 06:37:27', '2024-04-11 06:41:07'),
(44, 12, 1, '1712824912', '-1.1777806', '36.9905376', '1712824920', '-1.1769509', '36.9893875', '', '2024-04-11 06:41:54', '2024-04-11 06:42:01'),
(45, 3, 1, '1712843482', '-1.1769575', '36.9893924', '1713345439', '-1.1769287', '36.9894079', '', '2024-04-11 11:51:24', '2024-04-17 07:17:20'),
(46, 1, 1, '1713345721', '-1.1768872', '36.9894309', '', '', '', '', '2024-04-17 07:22:02', '2024-04-17 07:22:02'),
(47, 1, 1, '1713345732', '-1.1769145', '36.9894081', '', '', '', '', '2024-04-17 07:22:12', '2024-04-17 07:22:12'),
(48, 1, 1, '1713345771', '-1.176568', '36.9908732', '1713424738', '-1.1769535', '36.9893802', '', '2024-04-17 07:22:51', '2024-04-18 05:19:00'),
(49, 7, 1, '1713506654', '-1.1729512', '36.9905376', '1713543406', '-1.324845', '36.8962352', '', '2024-04-19 04:04:15', '2024-04-19 14:16:47'),
(50, 5, 1, '1713776679', '-1.1769219', '36.9893672', '1713776884', '-1.1769219', '36.9893672', '', '2024-04-22 07:04:41', '2024-04-22 07:08:07'),
(51, 13, 1, '1713790088', '-1.1769219', '36.9893672', '1713857939', '-1.176888', '36.9894339', '', '2024-04-22 10:48:10', '2024-04-23 05:39:01'),
(52, 14, 1, '1713960046', '-1.1769303', '36.9893453', '1713960082', '-1.1768879', '36.9894362', '', '2024-04-24 13:00:48', '2024-04-24 13:01:23'),
(53, 3, 1, '1714015828', '-1.3254488', '36.8963298', '1714047175', '-1.176929', '36.9893485', '', '2024-04-25 04:30:30', '2024-04-25 13:12:56'),
(54, 3, 1, '1714048126', '-1.1769303', '36.989341', '', '', '', '', '2024-04-25 13:28:47', '2024-04-25 13:28:47'),
(55, 2, 1, '1714048148', '-1.1768907', '36.9894358', '1714048577', '-1.1769251', '36.9893582', '', '2024-04-25 13:29:09', '2024-04-25 13:36:18'),
(56, 10, 1, '1714048585', '-1.1769299', '36.9893427', '1714048627', '-1.1769299', '36.9893427', '', '2024-04-25 13:36:25', '2024-04-25 13:37:07'),
(57, 2, 1, '1714048632', '-1.1769314', '36.9893444', '1714055501', '-1.176903', '36.9894639', '', '2024-04-25 13:37:12', '2024-04-25 15:31:43'),
(58, 15, 1, '1714055566', '-1.3300619', '36.8628608', '', '', '', '', '2024-04-25 15:32:47', '2024-04-25 15:32:47'),
(59, 1, 1, '1714055581', '-1.1769294', '36.9893584', '1714055600', '-1.1765732', '36.9905376', '', '2024-04-25 15:33:02', '2024-04-25 15:33:21'),
(60, 7, 1, '1714060972', '-1.3254086', '36.8962806', '1714067505', '-1.3253968', '36.896282', '', '2024-04-25 17:02:53', '2024-04-25 18:51:46'),
(61, 1, 1, '1714101041', '-1.3253968', '36.896282', '1714108891', '-1.1769303', '36.989341', '', '2024-04-26 04:10:42', '2024-04-26 06:21:33'),
(62, 4, 1, '1714108925', '-1.1769287', '36.9893495', '1714108939', '-1.1769129', '36.9893731', '', '2024-04-26 06:22:06', '2024-04-26 06:22:20'),
(63, 3, 1, '1714115194', '-1.17693', '36.9893448', '1714117755', '-1.1769298', '36.9893459', '', '2024-04-26 08:06:35', '2024-04-26 08:49:17'),
(64, 11, 1, '1714117910', '-1.1769062', '36.9893696', '', '', '', '', '2024-04-26 08:51:52', '2024-04-26 08:51:52'),
(65, 2, 1, '1714118467', '-1.1769268', '36.989354', '1714119587', '-1.1769296', '36.9893416', '', '2024-04-26 09:01:08', '2024-04-26 09:19:48'),
(66, 2, 1, '1714120991', '-1.1769287', '36.9893482', '1714121035', '-1.1769287', '36.9893553', '', '2024-04-26 09:43:13', '2024-04-26 09:43:56'),
(67, 2, 1, '1714121278', '-1.1768149', '36.9894486', '1714121339', '-1.1769296', '36.9893416', '', '2024-04-26 09:48:00', '2024-04-26 09:49:01'),
(68, 5, 1, '1714122335', '-1.1769122', '36.9893843', '', '', '', '', '2024-04-26 10:05:36', '2024-04-26 10:05:36'),
(69, 3, 1, '1714122629', '-1.1769274', '36.9893639', '1714128450', '-1.1769134', '36.989369', '', '2024-04-26 10:10:30', '2024-04-26 11:47:32'),
(70, 2, 1, '1714133526', '-1.1768013', '36.9896004', '', '', '', '', '2024-04-26 13:12:07', '2024-04-26 13:12:07'),
(71, 3, 1, '1714133541', '-1.176903', '36.9893815', '1714134451', '-1.1769287', '36.9893482', '', '2024-04-26 13:12:22', '2024-04-26 13:27:33'),
(72, 3, 1, '1714134483', '-1.1769235', '36.9893657', '1714135233', '-1.1768887', '36.9894379', '', '2024-04-26 13:28:04', '2024-04-26 13:40:35'),
(73, 3, 1, '1714135304', '-1.1768253', '36.9900616', '1714135855', '-1.1768882', '36.9894379', '', '2024-04-26 13:41:46', '2024-04-26 13:50:57'),
(74, 4, 1, '1714135992', '-1.1769382', '36.98935', '1714135997', '-1.1769329', '36.9893422', '', '2024-04-26 13:53:13', '2024-04-26 13:53:18'),
(75, 3, 1, '1714136392', '-1.1769121', '36.9893835', '1714139121', '-1.1769053', '36.9894006', '', '2024-04-26 13:59:53', '2024-04-26 14:45:24'),
(76, 2, 1, '1714139608', '-1.1769249', '36.9893583', '1714140327', '-1.1766877', '36.9891992', '', '2024-04-26 14:53:30', '2024-04-26 15:05:29'),
(77, 16, 1, '1714141181', '-1.1769078', '36.9893729', '1714319370', '-1.3254568', '36.8963296', '', '2024-04-26 15:19:42', '2024-04-28 16:49:32'),
(78, 12, 1, '1714319391', '-1.3254585', '36.8963268', '1714319395', '-1.3254585', '36.8963268', '', '2024-04-28 16:49:51', '2024-04-28 16:49:56'),
(79, 17, 1, '1714475456', '-1.1769349', '36.9894486', '1714477806', '-1.1769599', '36.9894497', '', '2024-04-30 12:10:58', '2024-04-30 12:50:08'),
(80, 7, 1, '1714630219', '-1.1768182', '36.9898512', '1714983141', '-1.3253746', '36.8961436', '', '2024-05-02 07:10:21', '2024-05-06 09:12:21'),
(81, 18, 1, '1714983196', '-1.3253746', '36.8961436', '', '', '', '', '2024-05-06 09:13:16', '2024-05-06 09:13:16'),
(82, 19, 1, '1714983320', '-1.3253746', '36.8961436', '1714983361', '-1.3253746', '36.8961436', '', '2024-05-06 09:15:20', '2024-05-06 09:16:01'),
(83, 20, 1, '1714983842', '-1.3253746', '36.8961436', '', '', '', '', '2024-05-06 09:24:02', '2024-05-06 09:24:02'),
(84, 21, 1, '1714983929', '-1.3253746', '36.8961436', '1714984052', '-1.3253746', '36.8961436', '', '2024-05-06 09:25:29', '2024-05-06 09:27:32'),
(85, 22, 1, '1714984104', '-1.3253746', '36.8961436', '', '', '', '', '2024-05-06 09:28:24', '2024-05-06 09:28:24'),
(86, 23, 1, '1714984377', '-1.3253746', '36.8961436', '1714984411', '-1.3253746', '36.8961436', '', '2024-05-06 09:32:57', '2024-05-06 09:33:31'),
(87, 24, 1, '1714984455', '-1.3253746', '36.8961436', '1714986845', '-1.1770032', '36.9895669', '', '2024-05-06 09:34:15', '2024-05-06 10:14:05'),
(88, 25, 1, '1714986892', '-1.1770032', '36.9895669', '1714987047', '-1.1770032', '36.9895669', '', '2024-05-06 10:14:52', '2024-05-06 10:17:27'),
(89, 26, 1, '1714987080', '-1.1770032', '36.9895669', '1714987832', '-1.1770031', '36.9895691', '', '2024-05-06 10:18:00', '2024-05-06 10:30:32'),
(90, 27, 1, '1715067656', '-1.1769832', '36.9895612', '', '', '', '', '2024-05-07 08:40:56', '2024-05-07 08:40:56'),
(91, 28, 1, '1715068614', '-1.1769832', '36.9895612', '1715075233', '-1.1769832', '36.9895612', '', '2024-05-07 08:56:54', '2024-05-07 10:47:13'),
(92, 2, 1, '1715075717', '-1.1769832', '36.9895612', '1715076324', '-1.1769832', '36.9895612', '', '2024-05-07 10:55:17', '2024-05-07 11:05:24'),
(93, 1, 1, '1715076334', '-1.1769832', '36.9895612', '1715076338', '-1.1769832', '36.9895612', '', '2024-05-07 11:05:33', '2024-05-07 11:05:38'),
(95, 3, 1, '1715081363', '-1.1769832', '36.9895612', '1715081585', '-1.1769832', '36.9895612', '', '2024-05-07 12:29:23', '2024-05-07 12:33:05'),
(96, 4, 1, '1715081590', '-1.1769832', '36.9895612', '1715082341', '-1.1769832', '36.9895612', '', '2024-05-07 12:33:10', '2024-05-07 12:45:41'),
(97, 2, 1, '1715082350', '-1.1769832', '36.9895612', '1715087040', '-1.1769872', '36.9895608', '', '2024-05-07 12:45:49', '2024-05-07 14:04:00'),
(98, 5, 1, '1715087048', '-1.1769872', '36.9895608', '1715088347', '-1.1769872', '36.9895608', '', '2024-05-07 14:04:08', '2024-05-07 14:25:47'),
(99, 25, 1, '1715088355', '-1.1769872', '36.9895608', '', '', '', '', '2024-05-07 14:25:55', '2024-05-07 14:25:55'),
(100, 2, 1, '1715088834', '-1.1769872', '36.9895608', '1715091589', '-1.1769872', '36.9895608', '', '2024-05-07 14:33:54', '2024-05-07 15:19:49'),
(101, 3, 1, '1715091601', '-1.1769872', '36.9895608', '1715091788', '-1.1769872', '36.9895608', '', '2024-05-07 15:20:00', '2024-05-07 15:23:08'),
(102, 7, 1, '1715091806', '-1.1769872', '36.9895608', '', '', '', '', '2024-05-07 15:23:26', '2024-05-07 15:23:26'),
(103, 6, 1, '1715091913', '-1.1769872', '36.9895608', '', '', '', '', '2024-05-07 15:25:12', '2024-05-07 15:25:12'),
(104, 3, 1, '1715092097', '-1.1769872', '36.9895608', '', '', '', '', '2024-05-07 15:28:17', '2024-05-07 15:28:17'),
(105, 5, 1, '1715092239', '-1.1769872', '36.9895608', '1715092822', '-1.1769872', '36.9895608', '', '2024-05-07 15:30:39', '2024-05-07 15:40:21'),
(110, 30, 2, '1715239830', '-1.1769818', '36.9895616', '1715239856', '-1.1769818', '36.9895616', '', '2024-05-09 08:30:30', '2024-05-09 08:30:55'),
(111, 30, 2, '1715240077', '-1.1769818', '36.9895616', '1715242037', '-1.1769818', '36.9895616', '', '2024-05-09 08:34:37', '2024-05-09 09:07:16'),
(112, 30, 2, '1715253249', '-1.1769862', '36.9895579', '1715274432', '-1.266261', '36.9816954', '', '2024-05-09 12:14:09', '2024-05-09 18:07:12'),
(113, 30, 2, '1715274587', '-1.2662296', '36.9816892', '', '', '', '', '2024-05-09 18:09:46', '2024-05-09 18:09:46'),
(114, 30, 2, '1715274853', '-1.2788847', '36.9670647', '1715319949', '-1.3253514', '36.8962168', '', '2024-05-09 18:14:13', '2024-05-10 06:45:49'),
(115, 30, 2, '1715319986', '-1.3253514', '36.8962168', '1715324493', '-1.3254084', '36.8962526', '', '2024-05-10 06:46:26', '2024-05-10 08:01:33'),
(116, 30, 2, '1715325247', '-1.3254084', '36.8962526', '', '', '', '', '2024-05-10 08:14:07', '2024-05-10 08:14:07'),
(117, 32, 1, '1715580759', '-1.1769859', '36.9895594', '1715580777', '-1.1769859', '36.9895594', '', '2024-05-13 07:12:38', '2024-05-13 07:12:56'),
(118, 9, 1, '1715581768', '-1.1769155', '36.9894506', '1715581794', '-1.1769155', '36.9894506', '', '2024-05-13 07:29:27', '2024-05-13 07:29:53'),
(119, 10, 1, '1715582009', '-1.1769627', '36.9895052', '1715584076', '-1.1769627', '36.9895052', '', '2024-05-13 07:33:28', '2024-05-13 08:07:55'),
(120, 9, 1, '1715584129', '-1.1769627', '36.9895052', '1715584293', '-1.1769627', '36.9895052', '', '2024-05-13 08:08:48', '2024-05-13 08:11:31'),
(121, 27, 1, '1715584393', '-1.1769627', '36.9895052', '1715584400', '-1.1769627', '36.9895052', '', '2024-05-13 08:13:12', '2024-05-13 08:13:19'),
(122, 32, 1, '1715584528', '-1.1769627', '36.9895052', '1715585408', '-1.1768857', '36.989438', '', '2024-05-13 08:15:27', '2024-05-13 08:30:07'),
(123, 32, 1, '1715585611', '-1.1769264', '36.9894622', '1715585616', '-1.1769264', '36.9894622', '', '2024-05-13 08:33:30', '2024-05-13 08:33:35'),
(124, 33, 3, '1715586575', '-1.1769264', '36.9894622', '1715586603', '-1.1769264', '36.9894622', '', '2024-05-13 08:49:34', '2024-05-13 08:50:01'),
(125, 33, 3, '1715586618', '-1.1769264', '36.9894622', '1715586621', '-1.1769264', '36.9894622', '', '2024-05-13 08:50:16', '2024-05-13 08:50:20'),
(126, 34, 5, '1715587772', '-1.1769322', '36.9894742', '1715587795', '-1.1769322', '36.9894742', '', '2024-05-13 09:09:31', '2024-05-13 09:09:54'),
(127, 35, 4, '1715587949', '-1.1769322', '36.9894742', '1715587988', '-1.1769322', '36.9894742', '', '2024-05-13 09:12:28', '2024-05-13 09:13:07'),
(128, 35, 4, '1715591220', '-1.1769831', '36.989559', '1715591549', '-1.1769831', '36.989559', '', '2024-05-13 10:06:59', '2024-05-13 10:12:29'),
(129, 9, 1, '1715593937', '-1.1769824', '36.9895589', '1715593950', '-1.1769824', '36.9895589', '', '2024-05-13 10:52:17', '2024-05-13 10:52:29'),
(130, 9, 1, '1715594659', '-1.1769872', '36.9895491', '1715594666', '-1.1769872', '36.9895491', '', '2024-05-13 11:04:17', '2024-05-13 11:04:25'),
(131, 29, 1, '1715594765', '-1.1769872', '36.9895491', '1715594769', '-1.1769872', '36.9895491', '', '2024-05-13 11:06:05', '2024-05-13 11:06:08'),
(132, 32, 1, '1715594800', '-1.1769872', '36.9895491', '1715594803', '-1.1769872', '36.9895491', '', '2024-05-13 11:06:39', '2024-05-13 11:06:42'),
(133, 26, 1, '1715663798', '-1.1769619', '36.989428', '', '', '', '', '2024-05-14 06:16:41', '2024-05-14 06:16:41'),
(134, 26, 1, '1715663812', '-1.1769619', '36.989428', '1715776588', '-1.1769704', '36.9894302', '', '2024-05-14 06:16:54', '2024-05-15 13:36:30'),
(136, 37, 1, '1715777046', '-1.1769704', '36.9894302', '1715777581', '-1.1769704', '36.9894302', '', '2024-05-15 13:44:08', '2024-05-15 13:53:03'),
(137, 38, 1, '1715777621', '-1.1769704', '36.9894302', '1715777977', '-1.1769704', '36.9894302', '', '2024-05-15 13:53:43', '2024-05-15 13:59:39'),
(138, 9, 1, '1715783249', '-1.1769707', '36.989431', '1715783284', '-1.1769707', '36.989431', '', '2024-05-15 15:27:31', '2024-05-15 15:28:06'),
(140, 40, 1, '1715863112', '-1.1769699', '36.9894287', '1715863132', '-1.1769699', '36.9894287', '', '2024-05-16 13:38:33', '2024-05-16 13:38:53'),
(141, 41, 1, '1715867752', '-1.1769699', '36.9894287', '1715867797', '-1.1769699', '36.9894287', '', '2024-05-16 14:55:53', '2024-05-16 14:56:39'),
(142, 42, 1, '1715877775', '-1.2843058', '36.8258684', '1715930284', '-1.1769701', '36.9894294', '', '2024-05-16 17:42:56', '2024-05-17 08:18:05'),
(143, 43, 1, '1715930729', '-1.1769701', '36.9894294', '1715930796', '-1.1769701', '36.9894294', '', '2024-05-17 08:25:31', '2024-05-17 08:26:37'),
(144, 44, 1, '1716045207', '-1.3180058', '36.8931837', '1716045233', '-1.3180058', '36.8931837', '', '2024-05-18 16:13:29', '2024-05-18 16:13:55'),
(145, 45, 1, '1716052097', '-1.3234707', '36.896206', '1716052116', '-1.3234707', '36.896206', '', '2024-05-18 18:08:19', '2024-05-18 18:08:38'),
(147, 41, 1, '1716270491', '-1.1769526', '36.9894074', '', '', '', '', '2024-05-21 06:48:11', '2024-05-21 06:48:11'),
(148, 38, 1, '1716270498', '-1.1769538', '36.9894007', '', '', '', '', '2024-05-21 06:48:19', '2024-05-21 06:48:19'),
(149, 43, 1, '1716270504', '-1.1769447', '36.9893952', '', '', '', '', '2024-05-21 06:48:25', '2024-05-21 06:48:25'),
(150, 28, 1, '1716270511', '-1.1769449', '36.9893971', '', '', '', '', '2024-05-21 06:48:32', '2024-05-21 06:48:32'),
(151, 32, 1, '1716270545', '-1.176944', '36.9893953', '', '', '', '', '2024-05-21 06:49:07', '2024-05-21 06:49:07'),
(152, 9, 1, '1716270580', '-1.1769513', '36.9893981', '1716270628', '-1.176893', '36.9894178', '', '2024-05-21 06:49:41', '2024-05-21 06:50:29'),
(153, 23, 1, '1716348179', '-1.3253977', '36.8963649', '', '', '', '', '2024-05-22 04:22:59', '2024-05-22 04:22:59'),
(154, 22, 1, '1716348193', '-1.3254048', '36.896365', '', '', '', '', '2024-05-22 04:23:14', '2024-05-22 04:23:14'),
(155, 24, 1, '1716348241', '-1.3254035', '36.8963664', '', '', '', '', '2024-05-22 04:24:02', '2024-05-22 04:24:02'),
(156, 39, 1, '1716348259', '-1.3253549', '36.8962383', '1716348277', '-1.3254022', '36.8963643', '', '2024-05-22 04:24:20', '2024-05-22 04:24:38'),
(157, 47, 1, '1716348314', '-1.3253995', '36.8963657', '1716348352', '-1.3254084', '36.8963575', '', '2024-05-22 04:25:15', '2024-05-22 04:25:53'),
(158, 47, 1, '1716348366', '-1.3254059', '36.8963628', '1716348387', '-1.3254077', '36.8963624', '', '2024-05-22 04:26:07', '2024-05-22 04:26:28'),
(159, 47, 1, '1716348404', '-1.3253497', '36.8962466', '1716348758', '-1.3253502', '36.8962179', '', '2024-05-22 04:26:45', '2024-05-22 04:32:39'),
(160, 47, 1, '1716348822', '-1.3253891', '36.8963593', '1716348873', '-1.3253562', '36.8963564', '', '2024-05-22 04:33:42', '2024-05-22 04:34:34'),
(161, 48, 1, '1716352958', '-1.2652733', '36.9849099', '1716352992', '-1.2652731', '36.984907', '', '2024-05-22 05:42:39', '2024-05-22 05:43:13'),
(163, 43, 1, '1716356293', '-1.1769521', '36.9894073', '1716356313', '-1.176936', '36.9893855', '', '2024-05-22 06:38:13', '2024-05-22 06:38:35'),
(164, 43, 1, '1716356335', '-1.1769435', '36.9893935', '1716356344', '-1.1769545', '36.9894022', '', '2024-05-22 06:38:57', '2024-05-22 06:39:06'),
(165, 43, 1, '1716356368', '-1.1769533', '36.9894034', '1716356396', '-1.1769538', '36.9894073', '', '2024-05-22 06:39:30', '2024-05-22 06:39:58'),
(166, 43, 1, '1716356640', '-1.1769521', '36.9894073', '1716356671', '-1.1769465', '36.9894017', '', '2024-05-22 06:44:01', '2024-05-22 06:44:32'),
(167, 43, 1, '1716356789', '-1.176951', '36.9894056', '', '', '', '', '2024-05-22 06:46:31', '2024-05-22 06:46:31'),
(168, 32, 1, '1716356806', '-1.1769511', '36.9894036', '1716357066', '-1.1769487', '36.9894042', '', '2024-05-22 06:46:47', '2024-05-22 06:51:07'),
(169, 43, 1, '1716357558', '-1.1769519', '36.9894055', '1716357562', '-1.1769508', '36.9894012', '', '2024-05-22 06:59:19', '2024-05-22 06:59:23'),
(170, 32, 1, '1716357587', '-1.1769474', '36.9894016', '1716357636', '-1.176951', '36.9894062', '', '2024-05-22 06:59:49', '2024-05-22 07:00:37'),
(171, 38, 1, '1716357647', '-1.176955', '36.9894052', '', '', '', '', '2024-05-22 07:00:49', '2024-05-22 07:00:49'),
(172, 41, 1, '1716357673', '-1.1769539', '36.9894072', '', '', '', '', '2024-05-22 07:01:14', '2024-05-22 07:01:14'),
(173, 38, 1, '1716357682', '-1.1769544', '36.989407', '', '', '', '', '2024-05-22 07:01:23', '2024-05-22 07:01:23'),
(174, 13, 1, '1716357738', '-1.1769518', '36.9894069', '1716357748', '-1.1769522', '36.9894051', '', '2024-05-22 07:02:19', '2024-05-22 07:02:30'),
(175, 41, 1, '1716368215', '-1.176894', '36.9894172', '1716368245', '-1.1769317', '36.9893285', '', '2024-05-22 09:56:57', '2024-05-22 09:57:25'),
(176, 32, 1, '1716368265', '-1.1769532', '36.9893981', '1716368269', '-1.1769173', '36.9893596', '', '2024-05-22 09:57:46', '2024-05-22 09:57:49'),
(177, 43, 1, '1716390841', '-1.1769248', '36.9893548', '1716435667', '-1.3253367', '36.8962022', '', '2024-05-22 16:14:03', '2024-05-23 04:41:07'),
(178, 50, 1, '1716437051', '-1.3234152', '36.8992693', '1716437081', '-1.3234287', '36.8993116', '', '2024-05-23 05:04:12', '2024-05-23 05:04:41'),
(179, 50, 1, '1716437098', '-1.3234257', '36.8993211', '1716437439', '-1.3234287', '36.8993116', '', '2024-05-23 05:04:59', '2024-05-23 05:10:40'),
(180, 50, 1, '1716437906', '-1.3234158', '36.8993311', '1716437923', '-1.3234094', '36.8992576', '', '2024-05-23 05:18:27', '2024-05-23 05:18:44'),
(181, 51, 1, '1716438770', '-1.3162846', '36.9212423', '1716438796', '-1.3129926', '36.9230343', '', '2024-05-23 05:32:51', '2024-05-23 05:33:16'),
(182, 52, 1, '1716438995', '-1.2904629', '36.946879', '1716439062', '-1.2903181', '36.947414', '', '2024-05-23 05:36:35', '2024-05-23 05:37:42'),
(183, 53, 1, '1716439138', '-1.2903367', '36.9475427', '1716439162', '-1.2875889', '36.9519768', '', '2024-05-23 05:38:58', '2024-05-23 05:39:23'),
(184, 54, 1, '1716439473', '-1.2783282', '36.9681923', '1716439488', '-1.2783', '36.9682292', '', '2024-05-23 05:44:34', '2024-05-23 05:44:49'),
(185, 55, 1, '1716439733', '-1.2643023', '36.978452', '1716439760', '-1.2647515', '36.9832491', '', '2024-05-23 05:48:54', '2024-05-23 05:49:21'),
(186, 56, 1, '1716439827', '-1.2640292', '36.9808665', '1716439855', '-1.2637445', '36.9826541', '', '2024-05-23 05:50:28', '2024-05-23 05:50:55'),
(187, 57, 1, '1716439896', '-1.2637406', '36.982659', '1716439921', '-1.2637406', '36.982659', '', '2024-05-23 05:51:39', '2024-05-23 05:52:02'),
(188, 57, 1, '1716439949', '-1.2637414', '36.982658', '1716439996', '-1.2637433', '36.9826557', '', '2024-05-23 05:52:30', '2024-05-23 05:53:16'),
(197, 66, 1, '1716440437', '-1.2637462', '36.9826606', '1716440479', '-1.2641038', '36.9829054', '', '2024-05-23 06:00:38', '2024-05-23 06:01:20'),
(198, 66, 1, '1716440496', '-1.2637422', '36.9826578', '1716440516', '-1.2637474', '36.9826612', '', '2024-05-23 06:01:37', '2024-05-23 06:01:57'),
(200, 57, 1, '1716440561', '-1.2637407', '36.9826614', '1716440569', '-1.2637415', '36.9826579', '', '2024-05-23 06:02:42', '2024-05-23 06:02:50'),
(202, 66, 1, '1716440635', '-1.2637406', '36.9826598', '1716440669', '-1.2637458', '36.9826606', '', '2024-05-23 06:03:56', '2024-05-23 06:04:30'),
(203, 67, 1, '1716441542', '-1.2577737', '36.9860604', '1716441554', '-1.2577737', '36.9860604', '', '2024-05-23 06:19:03', '2024-05-23 06:19:15'),
(204, 68, 1, '1716441824', '-1.1798505', '36.986624', '1716441837', '-1.1798289', '36.986647', '', '2024-05-23 06:23:45', '2024-05-23 06:23:58'),
(205, 38, 1, '1716442256', '-1.1768877', '36.9894808', '1716442299', '-1.176932', '36.9893852', '', '2024-05-23 06:31:02', '2024-05-23 06:31:40'),
(206, 43, 1, '1716450096', '-1.1769518', '36.9894047', '1716450121', '-1.1769513', '36.9894063', '', '2024-05-23 08:41:38', '2024-05-23 08:42:02'),
(207, 38, 1, '1716450148', '-1.176946', '36.9894011', '1716468462', '-1.1769509', '36.9894043', '', '2024-05-23 08:42:29', '2024-05-23 13:47:42'),
(208, 35, 4, '1716458171', '-1.1769442', '36.9893966', '1716458195', '-1.1769447', '36.9894038', '', '2024-05-23 10:56:13', '2024-05-23 10:56:37'),
(209, 35, 4, '1716458204', '-1.176952', '36.9894028', '1716458240', '-1.1769524', '36.9894025', '', '2024-05-23 10:56:46', '2024-05-23 10:57:21'),
(210, 35, 4, '1716458248', '-1.1769524', '36.9894035', '1716458267', '-1.1769514', '36.9894067', '', '2024-05-23 10:57:30', '2024-05-23 10:57:48'),
(211, 38, 1, '1716468515', '-1.1769321', '36.9893317', '1716476928', '-1.1769097', '36.9894352', '', '2024-05-23 13:48:36', '2024-05-23 16:08:49'),
(212, 43, 1, '1716477072', '-1.1771402', '36.9894763', '1716477085', '-1.1769752', '36.9895217', '', '2024-05-23 16:11:13', '2024-05-23 16:11:25'),
(213, 43, 1, '1716477094', '-1.1769348', '36.989419', '1716477102', '-1.1772731', '36.9893403', '', '2024-05-23 16:11:35', '2024-05-23 16:11:43'),
(214, 69, 1, '1716479156', '-1.2653077', '36.9816932', '1716479176', '-1.2655212', '36.9829483', '', '2024-05-23 16:45:57', '2024-05-23 16:46:16'),
(215, 69, 1, '1716479203', '-1.2653553', '36.9816971', '1716479313', '-1.2655977', '36.9831503', '', '2024-05-23 16:46:44', '2024-05-23 16:48:34'),
(216, 50, 1, '1716480798', '-1.3236763', '36.8990463', '1716480817', '-1.3240308', '36.8989553', '', '2024-05-23 17:13:20', '2024-05-23 17:13:38'),
(217, 45, 1, '1716481302', '-1.3236149', '36.8963455', '1716481312', '-1.3235362', '36.8963525', '', '2024-05-23 17:21:44', '2024-05-23 17:21:53'),
(218, 45, 1, '1716481327', '-1.3234851', '36.8962577', '1716481343', '-1.3234545', '36.896215', '', '2024-05-23 17:22:09', '2024-05-23 17:22:24'),
(219, 70, 1, '1716482026', '-1.3247388', '36.8961368', '1716482041', '-1.324737', '36.8961458', '', '2024-05-23 17:33:47', '2024-05-23 17:34:02'),
(220, 22, 1, '1716482546', '-1.3253266', '36.8961782', '1716482553', '-1.3253294', '36.896201', '', '2024-05-23 17:42:27', '2024-05-23 17:42:34'),
(221, 39, 1, '1716482567', '-1.3253196', '36.8961789', '1716482575', '-1.3253473', '36.8962006', '', '2024-05-23 17:42:48', '2024-05-23 17:42:56'),
(222, 47, 1, '1716482791', '-1.3253199', '36.8961865', '1716483469', '-1.3253833', '36.8962969', '', '2024-05-23 17:46:32', '2024-05-23 17:57:50'),
(223, 23, 1, '1716513060', '-1.325308', '36.8962186', '1716513110', '-1.3253147', '36.8961823', '', '2024-05-24 02:11:02', '2024-05-24 02:11:51'),
(224, 22, 1, '1716515594', '-1.3253076', '36.8962568', '1716515612', '-1.3253076', '36.8962568', '', '2024-05-24 02:53:16', '2024-05-24 02:53:33'),
(225, 47, 1, '1716516907', '-1.3253251', '36.8962304', '1716517207', '-1.3253251', '36.8962304', '', '2024-05-24 03:15:08', '2024-05-24 03:20:08'),
(226, 71, 1, '1716526379', '-1.2637502', '36.9826734', '1716526397', '-1.2637502', '36.9826734', '', '2024-05-24 05:53:00', '2024-05-24 05:53:18'),
(227, 72, 1, '1716527435', '-1.184427', '36.9934241', '1716527448', '-1.184427', '36.9934241', '', '2024-05-24 06:10:36', '2024-05-24 06:10:48'),
(228, 73, 1, '1716527670', '-1.1798174', '36.9877747', '', '', '', '', '2024-05-24 06:14:31', '2024-05-24 06:14:31'),
(229, 74, 1, '1716527679', '-1.1799346', '36.9877862', '1716527694', '-1.1799346', '36.9877862', '', '2024-05-24 06:14:40', '2024-05-24 06:14:55'),
(230, 75, 1, '1716609398', '-1.2845381', '36.82495', '1716609412', '-1.2845381', '36.82495', '', '2024-05-25 04:56:40', '2024-05-25 04:56:53'),
(231, 76, 1, '1716783621', '-1.3177856', '36.9175705', '1716783662', '-1.3177856', '36.9175705', '', '2024-05-27 05:20:21', '2024-05-27 05:21:03'),
(232, 77, 1, '1716784450', '-1.287585', '36.9520433', '1716784466', '-1.287585', '36.9520433', '', '2024-05-27 05:34:11', '2024-05-27 05:34:26'),
(233, 78, 1, '1716786382', '-1.2113372', '36.992216', '1716786407', '-1.2113372', '36.992216', '', '2024-05-27 06:06:22', '2024-05-27 06:06:48'),
(234, 79, 1, '1716786862', '-1.1808653', '36.9872962', '1716786873', '-1.1808653', '36.9872962', '', '2024-05-27 06:14:22', '2024-05-27 06:14:33'),
(235, 80, 1, '1716786969', '-1.179812', '36.9877958', '1716786980', '-1.179812', '36.9877958', '', '2024-05-27 06:16:09', '2024-05-27 06:16:21'),
(236, 38, 1, '1716796453', '-1.1769448', '36.9894015', '1716796537', '-1.1769448', '36.9894015', '', '2024-05-27 08:54:14', '2024-05-27 08:55:38'),
(237, 38, 1, '1716796699', '-1.1769567', '36.989385', '1716796990', '-1.1769567', '36.989385', '', '2024-05-27 08:58:20', '2024-05-27 09:03:11'),
(238, 38, 1, '1716807623', '-1.1769513', '36.9894035', '1716807822', '-1.1769513', '36.9894035', '', '2024-05-27 12:00:24', '2024-05-27 12:03:42'),
(239, 84, 1, '1716867642', '-1.3234055', '36.8993314', '1716867721', '-1.3234015', '36.8993299', '', '2024-05-28 04:40:43', '2024-05-28 04:42:02'),
(240, 85, 1, '1716868527', '-1.2905278', '36.9471795', '1716868542', '-1.2905081', '36.9471716', '', '2024-05-28 04:55:27', '2024-05-28 04:55:43'),
(241, 86, 1, '1716868755', '-1.2892851', '36.9497116', '1716868767', '-1.2892721', '36.9497032', '', '2024-05-28 04:59:16', '2024-05-28 04:59:28'),
(242, 87, 1, '1716869028', '-1.2786649', '36.9680687', '1716869042', '-1.2786198', '36.9681141', '', '2024-05-28 05:03:49', '2024-05-28 05:04:03'),
(243, 88, 1, '1716869435', '-1.2640129', '36.9826296', '1716869444', '-1.2640001', '36.9826265', '', '2024-05-28 05:10:35', '2024-05-28 05:10:44'),
(244, 89, 1, '1716869509', '-1.2636772', '36.9824342', '1716869518', '-1.2636859', '36.9824481', '', '2024-05-28 05:11:50', '2024-05-28 05:11:59'),
(245, 90, 1, '1716870226', '-1.1857389', '36.9947882', '1716870236', '-1.1856726', '36.9947244', '', '2024-05-28 05:23:47', '2024-05-28 05:23:57'),
(246, 91, 1, '1716870410', '-1.1808653', '36.9873449', '1716870418', '-1.1808697', '36.9873391', '', '2024-05-28 05:26:51', '2024-05-28 05:26:59'),
(247, 92, 1, '1716870485', '-1.18046', '36.987742', '1716870493', '-1.18046', '36.9877419', '', '2024-05-28 05:28:05', '2024-05-28 05:28:13'),
(248, 93, 1, '1716871793', '-1.1769111', '36.9893807', '1716871806', '-1.1769253', '36.9892996', '', '2024-05-28 05:49:54', '2024-05-28 05:50:07'),
(249, 94, 1, '1716903308', '-1.2840533', '36.8232819', '1716903328', '-1.2840971', '36.8232757', '', '2024-05-28 14:35:08', '2024-05-28 14:35:29'),
(250, 47, 1, '1716971439', '-1.3253995', '36.8963595', '1716994584', '-1.284115', '36.8232953', '', '2024-05-29 09:30:41', '2024-05-29 15:56:25'),
(251, 94, 1, '1716994618', '-1.2840693', '36.8233146', '1716994806', '-1.2840693', '36.8233146', '', '2024-05-29 15:56:59', '2024-05-29 16:00:07'),
(252, 95, 1, '1716994864', '-1.2841954', '36.8232109', '1716994938', '-1.2840722', '36.8233046', '', '2024-05-29 16:01:05', '2024-05-29 16:02:19'),
(253, 96, 1, '1717045510', '-1.1804624', '36.9878045', '1717045523', '-1.1804633', '36.9877832', '', '2024-05-30 06:05:12', '2024-05-30 06:05:25'),
(254, 38, 1, '1717080735', '-1.1768315', '36.9894359', '1717128866', '-1.3234225', '36.8992785', '', '2024-05-30 15:52:17', '2024-05-31 05:14:28'),
(255, 84, 1, '1717128895', '-1.3234244', '36.8992881', '1717128912', '-1.3235751', '36.8991168', '', '2024-05-31 05:14:58', '2024-05-31 05:15:14'),
(256, 76, 1, '1717129295', '-1.3179097', '36.9178419', '1717129304', '-1.3178892', '36.917802', '', '2024-05-31 05:21:37', '2024-05-31 05:21:46'),
(257, 89, 1, '1717130715', '-1.2637512', '36.9826534', '1717130718', '-1.2637516', '36.9826618', '', '2024-05-31 05:45:18', '2024-05-31 05:45:21'),
(258, 90, 1, '1717131647', '-1.1856082', '36.994752', '1717131653', '-1.1856018', '36.9947499', '', '2024-05-31 06:00:49', '2024-05-31 06:00:55'),
(259, 91, 1, '1717131828', '-1.1809303', '36.9874251', '1717131833', '-1.180894', '36.9873948', '', '2024-05-31 06:03:50', '2024-05-31 06:03:55'),
(260, 92, 1, '1717131879', '-1.1805365', '36.9877103', '1717131886', '-1.1804867', '36.9877446', '', '2024-05-31 06:04:42', '2024-05-31 06:04:47'),
(261, 93, 1, '1717132215', '-1.1769823', '36.9892465', '1717132220', '-1.1769765', '36.9892357', '', '2024-05-31 06:10:17', '2024-05-31 06:10:22'),
(262, 93, 1, '1717132484', '-1.1769223', '36.9892862', '1717133948', '-1.176927', '36.9892946', '', '2024-05-31 06:14:47', '2024-05-31 06:39:10'),
(263, 43, 1, '1717138720', '-1.1769275', '36.9892995', '1717143086', '-1.1769205', '36.9893035', '', '2024-05-31 07:58:42', '2024-05-31 09:11:28'),
(264, 93, 1, '1717143954', '-1.1769255', '36.9893044', '1717144018', '-1.1767517', '36.9892885', '', '2024-05-31 09:25:57', '2024-05-31 09:27:00'),
(265, 93, 1, '1717144641', '-1.1769245', '36.9892943', '1717145136', '-1.1769231', '36.9893008', '', '2024-05-31 09:37:23', '2024-05-31 09:45:38'),
(266, 97, 1, '1717145303', '-1.1769144', '36.98933', '1717145325', '-1.176924', '36.9893075', '', '2024-05-31 09:48:24', '2024-05-31 09:48:47'),
(267, 93, 1, '1717145619', '-1.1769209', '36.9893086', '1717145625', '-1.176924', '36.9893023', '', '2024-05-31 09:53:41', '2024-05-31 09:53:47'),
(268, 97, 1, '1717147995', '-1.1769204', '36.989318', '1717154293', '-1.176921', '36.9893115', '', '2024-05-31 10:33:18', '2024-05-31 12:18:15'),
(269, 93, 1, '1717156381', '-1.1769247', '36.9892965', '1717156952', '-1.1769229', '36.9892937', '', '2024-05-31 12:53:04', '2024-05-31 13:02:33'),
(270, 97, 1, '1717157221', '-1.1769247', '36.9892967', '1717157955', '-1.1769248', '36.9892972', '', '2024-05-31 13:07:03', '2024-05-31 13:19:17'),
(271, 93, 1, '1717159198', '-1.1769234', '36.9893094', '1717159209', '-1.1769238', '36.9893041', '', '2024-05-31 13:40:01', '2024-05-31 13:40:10'),
(272, 97, 1, '1717159222', '-1.1769249', '36.9893072', '1717160528', '-1.1769233', '36.9893248', '', '2024-05-31 13:40:24', '2024-05-31 14:02:09'),
(273, 97, 1, '1717160541', '-1.1769254', '36.9893043', '1717161967', '-1.1769246', '36.989304', '', '2024-05-31 14:02:24', '2024-05-31 14:26:09'),
(274, 93, 1, '1717161984', '-1.1769231', '36.9892984', '1717162218', '-1.1769238', '36.9893054', '', '2024-05-31 14:26:26', '2024-05-31 14:30:20'),
(275, 93, 1, '1717164548', '-1.1769192', '36.9893056', '1717333913', '-1.3254272', '36.8963667', '', '2024-05-31 15:09:11', '2024-06-02 14:11:54'),
(276, 47, 1, '1717333993', '-1.3254052', '36.8963629', '1717334104', '-1.3254195', '36.8963683', '', '2024-06-02 14:13:14', '2024-06-02 14:15:05'),
(277, 99, 1, '1717337501', '-1.324273', '36.8397461', '1717337774', '-1.3242831', '36.8397074', '', '2024-06-02 15:11:41', '2024-06-02 15:16:15'),
(278, 99, 1, '1717341015', '-1.3242848', '36.8397509', '1717341062', '-1.3242636', '36.8397376', '', '2024-06-02 16:10:16', '2024-06-02 16:11:03'),
(279, 100, 1, '1717345313', '-1.3257528', '36.869917', '1717345370', '-1.3283443', '36.8722704', '', '2024-06-02 17:21:54', '2024-06-02 17:22:50'),
(280, 101, 1, '1717346152', '-1.3263061', '36.8958778', '1717346165', '-1.3266294', '36.895191', '', '2024-06-02 17:35:53', '2024-06-02 17:36:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clockins`
--
ALTER TABLE `clockins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clockouts`
--
ALTER TABLE `clockouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `competitors`
--
ALTER TABLE `competitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outlets`
--
ALTER TABLE `outlets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posaudits`
--
ALTER TABLE `posaudits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posaudit_items`
--
ALTER TABLE `posaudit_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `target_groups`
--
ALTER TABLE `target_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clockins`
--
ALTER TABLE `clockins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `clockouts`
--
ALTER TABLE `clockouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `competitors`
--
ALTER TABLE `competitors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `outlets`
--
ALTER TABLE `outlets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `posaudits`
--
ALTER TABLE `posaudits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `posaudit_items`
--
ALTER TABLE `posaudit_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `target_groups`
--
ALTER TABLE `target_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
