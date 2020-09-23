-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 22, 2019 at 11:20 AM
-- Server version: 5.7.25-0ubuntu0.16.04.2
-- PHP Version: 7.0.33-0ubuntu0.16.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_area`
--

CREATE TABLE `add_area` (
  `id` int(11) NOT NULL,
  `add_city_id` varchar(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `add_city`
--

CREATE TABLE `add_city` (
  `id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `admin_commision` varchar(50) NOT NULL,
  `default_delivery_amount` varchar(50) DEFAULT NULL,
  `target_amount` varchar(50) DEFAULT NULL,
  `driver_base_price` varchar(50) DEFAULT NULL,
  `min_dist_base_price` varchar(50) DEFAULT NULL,
  `extra_fee_amount` varchar(50) DEFAULT NULL,
  `extra_fee_amount_each` varchar(50) DEFAULT NULL,
  `night_fare_amount` varchar(50) DEFAULT NULL,
  `night_driver_share` varchar(50) DEFAULT NULL,
  `surge_fare_amount` varchar(50) DEFAULT NULL,
  `surge_driver_share` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '12345', '2018-08-31 11:22:00', '2018-08-31 11:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `cancellation_reason`
--

CREATE TABLE `cancellation_reason` (
  `id` int(11) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `cancellation_for` varchar(100) NOT NULL,
  `status` int(111) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cancellation_reason`
--

INSERT INTO `cancellation_reason` (`id`, `reason`, `cancellation_for`, `status`, `created_at`, `updated_at`) VALUES
(1, 'reason', '1', 1, '2019-03-20 13:02:52', '2019-03-20 13:02:52');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_four` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` int(11) NOT NULL,
  `card_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'na',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `user_id`, `customer_id`, `last_four`, `card_token`, `is_default`, `card_type`, `is_deleted`, `created_at`, `updated_at`) VALUES
(3, 22, 'card_1ED5VTIUwp4CY88XGQMLtpQ6', '4242', 'tok_1ED5VTIUwp4CY88XhATjtRhp', 1, 'na', 0, '2019-03-12 13:28:39', '2019-03-12 13:28:39');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `food_id`, `quantity`, `created_at`, `updated_at`) VALUES
(282, 57, 4, 1, '2019-01-09 07:59:50', '2019-01-09 07:59:50'),
(283, 57, 5, 1, '2019-01-09 07:59:54', '2019-01-09 07:59:54'),
(287, 59, 5, 1, '2019-01-11 04:00:02', '2019-01-11 04:00:02'),
(335, 64, 1, 2, '2019-01-17 09:59:54', '2019-01-17 16:29:39'),
(352, 66, 5, 1, '2019-01-18 05:59:53', '2019-01-18 05:59:53'),
(354, 20, 1, 1, '2019-01-18 08:59:48', '2019-01-18 08:59:48'),
(355, 20, 3, 1, '2019-01-18 08:59:52', '2019-01-18 08:59:52'),
(385, 37, 11, 1, '2019-01-19 07:37:31', '2019-01-19 07:37:31'),
(386, 54, 7, 1, '2019-01-19 10:16:43', '2019-01-19 10:16:43'),
(387, 62, 9, 1, '2019-01-19 11:36:34', '2019-01-19 11:36:34'),
(388, 62, 1, 1, '2019-01-19 11:36:37', '2019-01-19 11:36:37'),
(389, 62, 15, 2, '2019-01-19 11:36:42', '2019-01-19 17:06:45'),
(433, 77, 1, 1, '2019-02-03 08:22:18', '2019-02-03 08:22:18'),
(460, 76, 2, 3, '2019-02-10 15:55:09', '2019-02-10 21:25:55'),
(461, 76, 3, 1, '2019-02-10 16:51:47', '2019-02-10 16:51:47'),
(570, 82, 1, 1, '2019-02-25 12:15:02', '2019-02-25 12:15:02'),
(571, 82, 9, 1, '2019-02-25 12:15:04', '2019-02-25 12:15:04'),
(572, 82, 10, 1, '2019-02-25 12:15:05', '2019-02-25 12:15:05'),
(573, 82, 3, 1, '2019-02-25 12:15:08', '2019-02-25 12:15:08'),
(607, 16, 7, 1, '2019-03-01 13:40:29', '2019-03-01 13:40:29'),
(648, 97, 1, 1, '2019-03-04 10:24:07', '2019-03-04 10:24:07'),
(683, 95, 1, 1, '2019-03-06 11:31:41', '2019-03-06 11:31:41'),
(686, 105, 4, 3, '2019-03-06 15:44:20', '2019-03-06 21:24:37'),
(687, 101, 4, 1, '2019-03-06 16:24:45', '2019-03-06 16:24:45'),
(688, 101, 5, 1, '2019-03-06 16:24:47', '2019-03-06 16:24:47'),
(689, 104, 1, 1, '2019-03-07 06:52:10', '2019-03-07 06:52:10'),
(694, 111, 9, 1, '2019-03-08 20:39:05', '2019-03-08 20:39:05'),
(698, 104, 3, 1, '2019-03-10 00:52:30', '2019-03-10 00:52:30'),
(704, 115, 22, 1, '2019-03-11 20:11:42', '2019-03-11 20:11:42'),
(706, 116, 1, 1, '2019-03-12 07:14:27', '2019-03-12 07:14:27'),
(707, 116, 9, 1, '2019-03-12 07:14:30', '2019-03-12 07:14:30');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Starter', 1, '2018-08-13 05:32:23', '2018-12-23 18:03:54'),
(2, 'Soups', 0, '2018-08-13 05:32:48', '2018-08-13 05:32:48'),
(3, 'Fish', 0, '2018-08-13 05:32:48', '2018-08-13 05:32:48'),
(4, 'Main Course', 0, '2018-08-14 11:16:34', '2018-08-14 11:16:34'),
(5, 'Desserts', 0, '2018-08-14 11:16:53', '2018-08-14 11:16:53'),
(7, 'Beverages', 0, '2018-08-14 11:17:54', '2018-08-14 11:17:54'),
(8, 'Cordobesa', 1, '2019-03-01 20:04:26', '2019-03-01 20:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_code`
--

CREATE TABLE `coupon_code` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `offer_type` int(11) NOT NULL DEFAULT '0' COMMENT '0 - %, 1 - amount',
  `value` double(6,2) NOT NULL,
  `available_from` date DEFAULT NULL,
  `valid_till` date NOT NULL,
  `use_per_customer` int(11) NOT NULL DEFAULT '1',
  `total_use` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon_code`
--

INSERT INTO `coupon_code` (`id`, `code`, `offer_type`, `value`, `available_from`, `valid_till`, `use_per_customer`, `total_use`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TESTCODE', 0, 10.00, '2018-12-11', '2018-12-20', 1, 10, 1, '2018-08-16 10:30:33', '2018-12-11 01:51:37'),
(2, 'TESTADMIN', 1, 10.00, '2018-11-14', '2018-11-30', 10, 10, 1, '2018-11-14 13:26:40', '2018-11-14 13:26:40'),
(3, 'HOLA123', 0, 20.00, '2019-03-02', '2019-03-21', 2, 1, 1, '2019-03-01 19:59:04', '2019-03-01 19:59:04');

-- --------------------------------------------------------

--
-- Table structure for table `cuisines`
--

CREATE TABLE `cuisines` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `cuisine_image` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuisines`
--

INSERT INTO `cuisines` (`id`, `name`, `cuisine_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Combo@99', 'public/uploads/V7mwdW41PLpPxyvR5JC5tDUmYgb706RW.png', 0, '2018-08-09 18:28:57', '2019-03-13 15:32:42'),
(2, 'Andhra', 'public/uploads/V7mwdW41PLpPxyvR5JC5tDUmYgb706RW.png', 0, '2018-08-09 18:29:10', '2018-08-09 18:29:10'),
(3, 'Arabian', 'public/uploads/V7mwdW41PLpPxyvR5JC5tDUmYgb706RW.png', 0, '2018-08-09 18:29:25', '2018-08-09 18:29:25'),
(4, 'Chinese', 'public/uploads/V7mwdW41PLpPxyvR5JC5tDUmYgb706RW.png', 0, '2018-08-09 18:29:42', '2018-08-09 18:29:42'),
(5, 'Briyani', 'public/uploads/V7mwdW41PLpPxyvR5JC5tDUmYgb706RW.png', 0, '2018-08-09 18:30:12', '2018-08-09 18:30:12'),
(6, 'Arave', NULL, 0, '2019-03-01 20:03:38', '2019-03-01 20:03:38'),
(7, 'Argentina', NULL, 0, '2019-03-01 20:03:50', '2019-03-01 20:03:50');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_address`
--

CREATE TABLE `delivery_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(500) NOT NULL,
  `lat` double(8,6) NOT NULL DEFAULT '0.000000',
  `lng` double(8,6) NOT NULL DEFAULT '0.000000',
  `flat_no` varchar(50) DEFAULT NULL,
  `landmark` varchar(200) DEFAULT NULL,
  `is_default` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1- Home, 2- Work, 3- Others',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_address`
--

INSERT INTO `delivery_address` (`id`, `user_id`, `address`, `lat`, `lng`, `flat_no`, `landmark`, `is_default`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mecricar Road, R.S. Puram, Coimbatore', 0.000000, 0.000000, NULL, NULL, 0, 1, '2018-08-09 18:17:13', '2018-08-26 12:02:24'),
(6, 1, 'Tirupur', 12.213320, 87.121224, NULL, NULL, 0, 1, '2018-08-27 08:06:57', '2018-08-27 11:40:02'),
(15, 1, '66, Street Number 1, Puthiyavan Nagar, layout, R.S. Puram, Coimbatore, Tamil Nadu 641001, India', 12.213320, 87.121224, NULL, NULL, 1, 1, '2018-08-27 11:40:02', '2018-08-27 11:40:02'),
(23, 8, 'Ukkadam, Coimbatore, Tamil Nadu, India', 10.990213, 76.962866, NULL, NULL, 0, 1, '2018-08-27 11:51:21', '2018-08-27 11:51:31'),
(24, 8, 'Ukkadam Bus Shed, Ukkadam, Coimbatore, Tamil Nadu, India', 10.988560, 76.961738, NULL, NULL, 0, 1, '2018-08-27 11:51:31', '2018-08-27 11:57:42'),
(25, 8, 'Kovaipudur Main Road, GVL Nagar, Perur, Coimbatore, Tamil Nadu, India', 10.966621, 76.913256, NULL, NULL, 1, 1, '2018-08-27 11:57:42', '2018-08-27 11:57:42'),
(28, 8, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005564, 76.954461, NULL, NULL, 1, 1, '2018-08-28 05:19:55', '2018-08-28 05:19:55'),
(29, 8, '66, Street Number 1, Puthiyavan Nagar, layout, R.S. Puram, Coimbatore, Tamil Nadu 641001, India', 12.213320, 87.121224, NULL, NULL, 1, 1, '2018-08-28 05:25:25', '2018-08-28 05:25:25'),
(30, 11, 'Vadakarapathy, Kerala, India', 10.770667, 10.770667, NULL, NULL, 0, 2, '2018-09-04 06:51:44', '2018-09-04 06:51:44'),
(31, 11, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005562, 11.005562, NULL, NULL, 0, 2, '2018-09-05 07:23:05', '2018-09-05 07:23:05'),
(32, 11, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005562, 11.005562, NULL, NULL, 0, 2, '2018-09-05 07:23:39', '2018-09-05 07:23:39'),
(33, 12, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005475, 11.005475, NULL, NULL, 0, 1, '2018-09-06 07:20:07', '2018-09-06 07:20:07'),
(34, 12, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005518, 11.005518, NULL, NULL, 0, 1, '2018-09-06 07:22:56', '2018-09-06 07:22:56'),
(35, 12, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005555, 11.005555, NULL, NULL, 0, 1, '2018-09-06 07:25:17', '2018-09-06 07:25:17'),
(36, 11, 'Sivananda Colony - Ist Layout, Tatabad, Sivananda Colony, Tatabad, Coimbatore, Tamil Nadu 641012, India', 11.022764, 11.022764, NULL, NULL, 0, 1, '2018-09-06 10:24:50', '2018-09-06 10:24:50'),
(37, 17, '157, Mecricar Rd, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005447, 11.005447, NULL, NULL, 0, 2, '2018-09-13 14:11:47', '2018-09-13 14:11:47'),
(38, 17, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005526, 11.005526, NULL, NULL, 0, 1, '2018-09-13 14:12:29', '2018-09-13 14:12:29'),
(39, 17, '138, Ramachandra Rd, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.007346, 11.007346, NULL, NULL, 0, 1, '2018-09-13 14:13:04', '2018-09-13 14:13:04'),
(44, 44, '1044, Avinashi Rd, ATT Colony, Gopalapuram, Coimbatore, Tamil Nadu 641018, India', 11.005831, 11.005831, NULL, NULL, 0, 1, '2018-11-15 08:47:00', '2018-11-15 08:47:00'),
(45, 8, 'RS Puram, Coimbatore, Tamil Nadu', 11.008951, 11.008951, '1', 'Opposite to School', 0, 1, '2018-11-15 09:24:21', '2018-11-15 09:24:21'),
(46, 44, '1044, Avinashi Rd, ATT Colony, Gopalapuram, Coimbatore, Tamil Nadu 641018, India', 11.006851, 11.006851, 'hfhf', 'hfuig', 1, 1, '2018-11-15 09:55:55', '2018-11-15 09:55:55'),
(47, 44, '47, Puliakulam, Coimbatore, Tamil Nadu 641045, India', 11.006885, 11.006885, 'g ct', 'ubub', 0, 1, '2018-11-15 09:56:19', '2018-11-15 09:56:19'),
(48, 22, '153, Mecricar Rd, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005564, 76.954461, '228', 'opposite to BPC', 1, 2, '2018-11-15 19:03:26', '2019-03-13 09:25:07'),
(49, 45, '62 B, Park Street, Kattoor,, Coimbatore, Tamil Nadu 641009, India', 11.006937, 11.006937, 'eg', 'ugjhh', 1, 2, '2018-11-16 09:42:05', '2018-11-16 09:42:05'),
(52, 52, 'Hope College, Peelamedu, Coimbatore, Tamil Nadu 641004, India', 11.023811, 11.023811, '23', 'Opp to central mall', 1, 1, '2018-11-26 13:24:40', '2018-11-26 13:24:40'),
(53, 16, 'Gandhipuram Town Bus Stand, 11/20, Bharathiyar Rd, ATT Colony, New Siddhapudur, Coimbatore, Tamil Nadu 641044, India', 11.016111, 11.016111, '15.teet Street', 'cbe', 1, 1, '2018-11-27 08:41:41', '2018-11-27 08:41:41'),
(58, 37, 'Tirupur', 12.000000, 12.000000, NULL, NULL, 0, 1, '2018-11-29 08:58:53', '2018-12-04 12:23:26'),
(68, 40, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005541, 11.005541, '44', 'Near HMR', 1, 1, '2018-12-03 14:14:26', '2018-12-03 14:14:26'),
(69, 40, 'No.41/A, 9th St, Gandhipuram, Coimbatore, Tamil Nadu 641012, India', 11.020452, 11.020452, '44', 'near hmr', 0, 2, '2018-12-03 14:15:03', '2018-12-03 14:15:03'),
(70, 37, 'Chennai,Chennai, Tamil Nadu, India', 13.261166, 80.081701, NULL, NULL, 0, 1, '2018-12-04 12:02:12', '2018-12-04 12:23:26'),
(73, 37, 'Maharashtra,Maharashtra, India', 22.028441, 72.659363, NULL, NULL, 1, 1, '2018-12-04 12:23:26', '2018-12-04 12:23:26'),
(74, 40, 'Brookefields, No 67-71, Dr Krishnasamy Mudaliyar Rd, Puthiyavan Nagar, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641001, India', 11.008868, 11.008868, '45', 'Opp to mall', 0, 1, '2018-12-10 07:54:27', '2018-12-10 07:54:27'),
(75, 40, '135, 100 Feet Road, Gandhipuram, Gandhipuram, Coimbatore, Tamil Nadu 641012, India', 11.020983, 11.020983, '56', 'Opp to ganapathy silks', 0, 2, '2018-12-19 07:18:50', '2018-12-19 07:18:50'),
(76, 54, 'Sabapathi Puram', 11.090137, 11.090137, '49', 'Near Leepebble hotel', 1, 1, '2018-12-24 06:43:59', '2018-12-24 06:43:59'),
(77, 55, '6, 2nd St, Kannipiran Colony, Valipalayam, Tiruppur, Tamil Nadu 641602, India', 11.106123, 11.106123, '49', 'Near hotel lepebble', 1, 3, '2018-12-24 11:00:50', '2018-12-24 11:00:50'),
(78, 56, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005528, 11.005528, 'akakks', 'wkkwk', 1, 1, '2019-01-04 09:54:49', '2019-01-04 09:54:49'),
(79, 56, 'ro o, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005528, 11.005528, 'jeie', 'dioe', 0, 3, '2019-01-04 09:56:41', '2019-01-04 09:56:41'),
(80, 56, 'ro o, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005528, 11.005528, 'jeie', 'dioe', 0, 3, '2019-01-04 09:56:42', '2019-01-04 09:56:42'),
(81, 56, '2, E Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.012656, 11.012656, '12', 'eru', 0, 1, '2019-01-08 06:17:47', '2019-01-08 06:17:47'),
(82, 56, '2, E Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.012656, 11.012656, '12', 'eru', 0, 1, '2019-01-08 06:17:48', '2019-01-08 06:17:48'),
(83, 57, '38, Sir Shanmugam Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.007874, 11.007874, '123', 'sertu', 1, 2, '2019-01-08 06:36:41', '2019-01-08 06:36:41'),
(84, 37, 'Jains Apartment,Avinashi Rd, Peelamedu, Coimbatore, Tamil Nadu 641004, India', 11.025369, 76.997248, NULL, NULL, 1, 1, '2019-01-12 05:36:17', '2019-01-12 05:36:17'),
(86, 37, 'Palladam,Palladam, Tamil Nadu, India', 10.999667, 77.280742, NULL, NULL, 1, 1, '2019-01-19 02:53:56', '2019-01-19 02:53:56'),
(87, 37, 'Palladam,Palladam, Tamil Nadu, India', 10.999667, 77.280742, '665', 'near bus stand', 0, 2, '2019-01-19 02:53:56', '2019-01-19 02:53:56'),
(88, 37, 'Surat,Surat, Gujarat, India', 21.270583, 72.701382, NULL, NULL, 1, 1, '2019-01-19 02:56:56', '2019-01-19 02:56:56'),
(89, 37, 'Jain Cambrae East,Avinashi Rd, Peelamedu, Coimbatore, Tamil Nadu 641004, India', 11.023872, 76.997555, NULL, NULL, 1, 1, '2019-01-19 02:58:09', '2019-01-19 02:58:09'),
(92, 50, 'Tirupur', 12.213320, 87.121224, NULL, NULL, 1, 1, '2019-01-19 04:27:07', '2019-01-19 16:10:08'),
(93, 67, 'RVS College of Arts & Science,242 – B, Trichy Rd, Mathiyalagan Nagar, Sulur, Tamil Nadu 641402, India', 11.026314, 77.132092, NULL, NULL, 0, 1, '2019-01-19 05:51:04', '2019-01-19 15:50:00'),
(94, 67, 'Panapalayam,Panapalayam, Palladam, Tamil Nadu 641664, India', 10.994071, 77.295824, NULL, NULL, 1, 1, '2019-01-19 10:20:00', '2019-01-19 15:51:37'),
(95, 67, 'Panapalayam,Panapalayam, Palladam, Tamil Nadu 641664, India', 10.994071, 77.295824, '85-A', 'Near samathuvapuram', 0, 2, '2019-01-19 10:20:00', '2019-01-19 10:20:00'),
(96, 68, 'Saibaba Colony,Saibaba Colony, Coimbatore, Tamil Nadu, India', 11.023578, 76.942585, NULL, NULL, 1, 1, '2019-01-24 12:01:55', '2019-01-24 12:01:55'),
(97, 68, 'Saibaba Colony,Saibaba Colony, Coimbatore, Tamil Nadu, India', 11.023578, 76.942585, '23', 'Central mal', 0, 2, '2019-01-24 12:01:55', '2019-01-24 12:01:55'),
(98, 22, 'No 3, Near K G Hospital, Bungalow Road, Gopalapuram, Coimbatore, Tamil Nadu 641018, India', 11.000180, 11.000180, '3/233', 'race course road', 0, 3, '2019-01-25 05:52:56', '2019-02-21 20:30:47'),
(99, 22, 'North Mada Street,Thiruvanmiyur, Chennai', 12.986985, 80.259625, '12', 'starlight hosp', 0, 3, '2019-02-17 05:10:58', '2019-02-21 20:30:50'),
(100, 22, 'Global Infocity', 12.969581, 80.241567, '12', 'RMZ', 0, 3, '2019-02-17 05:16:30', '2019-02-21 20:30:54'),
(101, 22, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, '67', 'bank', 0, 3, '2019-02-17 07:45:42', '2019-03-13 09:25:07'),
(102, 22, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 53.955670, 14.521259, '78', 'guindy', 0, 3, '2019-02-17 07:48:33', '2019-02-17 07:48:33'),
(103, 22, '780 64 Lima, Sweden', 60.958544, 13.525164, '78', 'guindy', 0, 3, '2019-02-17 07:49:28', '2019-03-10 08:31:20'),
(104, 22, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, '78', 'guindy', 0, 3, '2019-02-17 07:50:12', '2019-02-17 07:50:12'),
(105, 22, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, 'as', 'dr', 0, 3, '2019-02-17 07:51:09', '2019-02-17 07:51:09'),
(106, 22, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, 'buzz', 'shhs', 0, 3, '2019-02-17 07:51:49', '2019-02-17 07:51:49'),
(107, 22, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, '78', 'guindy', 0, 3, '2019-02-17 07:57:48', '2019-02-17 07:57:48'),
(108, 22, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, '78', 'guindy', 0, 3, '2019-02-17 07:57:52', '2019-02-17 07:57:52'),
(109, 65, '37, Ramachandra Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.006273, 11.006273, 'jhku', 'jfhn', 1, 1, '2019-02-19 11:34:41', '2019-02-19 11:34:41'),
(110, 48, 'Unnamed Road, Sakthi Nagar, Aladu, Tamil Nadu 601204, India', 13.320820, 80.229630, '56', 'an', 1, 3, '2019-02-23 05:55:49', '2019-02-23 05:55:49'),
(111, 48, 'Unnamed Road, Sakthi Nagar, Aladu, Tamil Nadu 601204, India', 13.320820, 80.229630, '56', 'an', 0, 3, '2019-02-23 05:55:56', '2019-02-23 05:55:56'),
(112, 48, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, '34', 'the', 0, 3, '2019-02-23 06:38:12', '2019-02-23 06:38:12'),
(113, 48, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005573, 76.954497, '27', 'near poo market', 0, 3, '2019-02-23 06:58:47', '2019-02-23 06:58:47'),
(114, 48, 'Ramasamy Naidu 2nd St, Kamachipuram, Coimbatore, Tamil Nadu 641016, India', 11.003354, 77.065618, '39', 'kadiri mills all', 0, 2, '2019-02-23 07:01:30', '2019-02-23 07:01:30'),
(115, 89, 'Córdoba,Córdoba, Cordoba, Argentina', -31.420083, -64.188776, NULL, NULL, 1, 1, '2019-02-27 11:31:11', '2019-02-27 11:31:11'),
(116, 89, 'Córdoba,Córdoba, Cordoba, Argentina', -31.420083, -64.188776, '1', 'escuela', 0, 2, '2019-02-27 11:31:11', '2019-02-27 11:31:11'),
(117, 90, 'avinashi', 11.005541, 11.005541, '102', 'cheyur road', 1, 1, '2019-02-28 06:35:54', '2019-02-28 06:35:54'),
(118, 89, '3-50, RTC Colony, Chanda Nagar, Hyderabad, Telangana 500050, India', 17.488500, 17.488500, '1', 'saludos cordiales y', 0, 3, '2019-03-01 14:52:38', '2019-03-01 14:52:38'),
(119, 89, 'RP13, Córdoba, Argentina', -31.669273, -31.669273, '1255', 'Escuela', 0, 3, '2019-03-01 19:22:20', '2019-03-01 19:22:20'),
(120, 22, '19, Kuppam Beach Rd, Teachers Colony, Jayaram Nagar, Thiruvanmiyur, Chennai, Tamil Nadu 600041, India', 12.983861, 80.266563, '57', 'bans', 0, 3, '2019-03-02 06:58:39', '2019-03-02 06:58:39'),
(121, 95, 'CSIR Rd, Taramani, Chennai, Tamil Nadu 600113, India', 12.986413, 80.247671, '78', 'he', 1, 3, '2019-03-03 12:03:43', '2019-03-03 12:03:43'),
(122, 90, '39, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.001318, 76.950051, 'wow', 'Shalaka', 0, 3, '2019-03-04 05:55:06', '2019-03-04 05:55:06');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_partners`
--

CREATE TABLE `delivery_partners` (
  `id` int(11) NOT NULL,
  `partner_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `service_zone` varchar(200) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `authToken` varchar(50) DEFAULT NULL,
  `device_token` varchar(300) DEFAULT NULL,
  `profile_pic` varchar(300) NOT NULL,
  `partner_commision` double(8,2) NOT NULL DEFAULT '0.00' COMMENT 'in %',
  `driving_license_no` varchar(200) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `acc_no` varchar(40) DEFAULT NULL,
  `ifsc_code` varchar(40) DEFAULT NULL,
  `total_earnings` double(8,2) NOT NULL DEFAULT '0.00',
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_partners`
--

INSERT INTO `delivery_partners` (`id`, `partner_id`, `name`, `phone`, `email`, `address`, `service_zone`, `password`, `authToken`, `device_token`, `profile_pic`, `partner_commision`, `driving_license_no`, `bank_name`, `acc_no`, `ifsc_code`, `total_earnings`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PAT00001', 'Praveen', '919600771099', 'praveenkumartup@gmail.com', 'RS Puram, Coimbatore', 'Coimbatore', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '1q5ZUnKFmvRVYspA', 'evogNT1N6g4:APA91bHzjg4CJIC0TxWKwjcYtcTADeR54VjJtU9s_6ejh0KFdkw6Jv2AWfOFg2kwnUtMaI4SAXRaY7YIKVvDC37E1obcQNm5i4pnW-jBZLwZN_-LmOFzuoWoeyk8OHcMNOV1iumZJtou', 'public/uploads/profile_icon.png', 3.00, 'JH87gUYVy77v', 'Canara Bank', '872387325753278325', 'CNRB000872', 220.82, 1, '2018-08-29 05:27:44', '2019-03-13 10:27:03'),
(3, 'PAT00003', 'Gowtham', '919092510425', 'murugasendhivya3@gmail.com', 'Gandhipuram', 'Coimbatore', 'REVobTNMY0pQa2tPRkN0TmtiNnk2QT09', NULL, NULL, 'public/uploads/profile_icon.png', 3.00, 'HGJ87yHVg87sad', 'SBI', '2175327853275323', 'SBI0000217', 0.00, 1, '2018-09-05 07:48:58', '2018-11-28 20:52:53'),
(4, 'PAT00004', 'Dinesh', '918870129402', 'dhivyamurugesan3995@gmail.com', 'Ukkadam', 'Coimbatore', 'REVobTNMY0pQa2tPRkN0TmtiNnk2QT09', 'kXDNIKlNb96QKMEF', 'dR2bqWhc8ec:APA91bFV0j72Vd7hE-MexXLcMINExbGvXrmmF5K1u8G_ZC7rHbOF8QhWHi9IHbkbxt-fwRhYUjv__s6MPFXPKBj5LnTem3h4gA3l3pdANYaBNj9CnZCYeti6dzCLg-h0NC-e1H6FWmuS', 'public/uploads/profile_icon.png', 3.00, '98JHG78yGG87HJ', 'Canara', '3283289723474442', 'CNRB000328', 0.00, 1, '2018-09-06 07:11:29', '2018-09-06 14:01:37'),
(5, 'PAT00005', 'Praveen kumar', '918508082716', 'praveen@gmail.com', 'Coimbatore, RS Puram', 'Coimbatore', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'dkpUxFOWMdt97wTE', 'clNUvGd30rE:APA91bHFTj9fIjIGlhI_VOZ5PA1HICnqrYHegbIPvBXgzzH_u5jLxwT9OkLYkNdBHRl3RhweANxoHk-Yo0X55oNnFgG6zMocea4Z1VKyBUFOzfz3TLrGalChWbvyEw8ANinnpFqzw6mL', 'public/uploads/profile_icon.png', 3.00, '8hghj878g8g', 'IDBI', '37258732578352783', 'IDBI000372', 506.71, 1, '2018-11-15 12:40:09', '2019-03-06 17:13:31'),
(6, 'PAT00006', 'Giri', '919003649725', 'giri@sparkouttech.com', 'RS Puram, Coimbatore', 'Coimbatore', 'dzBiT3pSNURwcWZiY3R5aURCc0pEQT09', NULL, NULL, 'public/uploads/profile_icon.png', 3.00, '3298GH28JH877', 'HDFC', '273857832575427', 'HDFC0000273', 0.00, 1, '2018-11-28 18:17:21', '2018-11-28 18:17:21'),
(7, 'PAT00007', 'GiriVignesh', '917010662843', 'girivignesh3@gmail.com', 'test', 'Coimbatore', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'sgnyxuAlVUPOx9Gj', 'fgoQ6tlvq7A:APA91bGeLn7KFlI1J89S3sZ87jclqD_5vrIJAJAxEDkH9OzsMfQ8VNaWIoV-lx_sabxMRpw5q4iVwajlsazNOh8VThhtT4hv1KVdeV1GP92KA8t0OI9T5wEL79bc8qFDIrsXPKWv3jbr', 'public/restaurant_uploads/mX6fUarl3CPtIMkznZHs6fjxXgA1Wi7j.jpg', 3.00, 'TN12BJT5678909876', 'Karur Vysya Bank', '1674000006789045', 'KVB12345', 0.00, 0, '2018-12-11 07:08:48', '2018-12-11 12:41:13'),
(9, 'PAT00008', 'aaa', '543415830335', 'pruebaparkeon1@gmail.com', 'aaa', '11', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', NULL, NULL, 'public/uploads/profile_icon.png', 5.00, '111', 'aa', 'ss', 'aa', 0.00, 0, '2019-03-02 05:07:45', '2019-03-02 05:07:45'),
(10, 'PAT00010', 'joni', '628174161758', 'myfacefx@gmail.com', 'blora', 'blora', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'xZkvHf8VuthRBswH', 'fdQXa7L7oLY:APA91bFIn6MFog61WUWnOaGYJzE2Io3wPdENTAuRTwWB5bkXlFO4zE77dx9w6cwLat3EvGJGPHTY9VUW1KFUdBmTQsP_2u39Cb9THlBpdmxSlUjlfHKBRn1a_8pYdPEPGMLZbkYR2oG8', 'public/uploads/profile_icon.png', 5.00, '13131', 'bbba', '122222222222', '3333333333333', 0.00, 0, '2019-03-06 16:38:16', '2019-03-06 22:41:16'),
(11, 'PAT00011', 'Marcos', '81997580840', 'chillimarcos@gmail.com', 'Rua do forte', 'Delivery', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', NULL, NULL, 'public/restaurant_uploads/oNKzgGSN7rSbQuZjzYSGg4u9Os4wUyBi.jpg', 10.00, '22664', 'Caixa econômica federal', '26784849927', '67', 0.00, 0, '2019-03-13 04:50:04', '2019-03-13 04:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `document_for` varchar(100) NOT NULL,
  `document_name` varchar(100) NOT NULL,
  `expiry_date_needed` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `document_for`, `document_name`, `expiry_date_needed`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'Test', '1', 1, '2019-03-20 09:44:15', '2019-03-20 09:44:15');

-- --------------------------------------------------------

--
-- Table structure for table `favourite_list`
--

CREATE TABLE `favourite_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favourite_list`
--

INSERT INTO `favourite_list` (`id`, `user_id`, `restaurant_id`, `created_at`, `updated_at`) VALUES
(98, 1, 2, '2018-08-30 11:25:04', '2018-08-30 11:25:04'),
(102, 9, 1, '2018-08-31 10:02:22', '2018-08-31 10:02:22'),
(110, 14, 1, '2018-09-06 09:50:07', '2018-09-06 09:50:07'),
(119, 17, 1, '2018-09-13 11:36:43', '2018-09-13 11:36:43'),
(124, 8, 1, '2018-09-20 07:06:36', '2018-09-20 07:06:36'),
(125, 20, 1, '2018-09-30 18:59:41', '2018-09-30 18:59:41'),
(127, 18, 2, '2018-10-03 20:17:48', '2018-10-03 20:17:48'),
(131, 18, 1, '2018-10-04 01:00:48', '2018-10-04 01:00:48'),
(135, 34, 1, '2018-10-15 18:41:22', '2018-10-15 18:41:22'),
(145, 45, 1, '2018-11-15 18:05:56', '2018-11-15 18:05:56'),
(146, 6, 1, '2018-11-15 18:31:07', '2018-11-15 18:31:07'),
(147, 6, 2, '2018-11-15 18:31:08', '2018-11-15 18:31:08'),
(168, 40, 2, '2018-11-26 12:27:55', '2018-11-26 12:27:55'),
(181, 37, 2, '2018-11-30 11:38:06', '2018-11-30 11:38:06'),
(183, 37, 1, '2018-11-30 11:41:37', '2018-11-30 11:41:37'),
(187, 40, 5, '2018-12-10 12:56:59', '2018-12-10 12:56:59'),
(198, 16, 4, '2018-12-16 07:57:34', '2018-12-16 07:57:34'),
(204, 40, 1, '2018-12-18 10:59:13', '2018-12-18 10:59:13'),
(208, 56, 1, '2019-01-08 05:47:45', '2019-01-08 05:47:45'),
(209, 56, 2, '2019-01-08 06:13:00', '2019-01-08 06:13:00'),
(212, 57, 2, '2019-01-09 07:53:08', '2019-01-09 07:53:08'),
(213, 57, 3, '2019-01-09 07:53:10', '2019-01-09 07:53:10'),
(214, 57, 1, '2019-01-09 07:57:28', '2019-01-09 07:57:28'),
(216, 60, 1, '2019-01-14 12:24:58', '2019-01-14 12:24:58'),
(217, 61, 1, '2019-01-14 12:30:31', '2019-01-14 12:30:31'),
(218, 66, 1, '2019-01-18 05:23:10', '2019-01-18 05:23:10'),
(246, 80, 1, '2019-02-18 16:38:31', '2019-02-18 16:38:31'),
(247, 81, 1, '2019-02-19 08:33:22', '2019-02-19 08:33:22'),
(279, 48, 3, '2019-02-22 06:07:37', '2019-02-22 06:07:37'),
(280, 65, 4, '2019-02-22 06:10:46', '2019-02-22 06:10:46'),
(281, 65, 1, '2019-02-22 08:04:52', '2019-02-22 08:04:52'),
(299, 83, 1, '2019-02-26 11:08:38', '2019-02-26 11:08:38'),
(301, 22, 4, '2019-02-27 09:39:04', '2019-02-27 09:39:04'),
(303, 87, 1, '2019-02-27 11:03:23', '2019-02-27 11:03:23'),
(305, 88, 2, '2019-02-27 12:26:35', '2019-02-27 12:26:35'),
(326, 16, 1, '2019-03-01 13:25:49', '2019-03-01 13:25:49'),
(327, 16, 2, '2019-03-01 13:25:54', '2019-03-01 13:25:54'),
(348, 89, 3, '2019-03-01 19:19:28', '2019-03-01 19:19:28'),
(351, 89, 4, '2019-03-01 19:24:04', '2019-03-01 19:24:04'),
(353, 89, 5, '2019-03-01 19:24:10', '2019-03-01 19:24:10'),
(354, 89, 7, '2019-03-01 19:53:47', '2019-03-01 19:53:47'),
(355, 89, 10, '2019-03-01 20:07:43', '2019-03-01 20:07:43'),
(356, 89, 9, '2019-03-01 20:11:42', '2019-03-01 20:11:42'),
(357, 89, 8, '2019-03-01 20:11:43', '2019-03-01 20:11:43'),
(358, 89, 6, '2019-03-01 20:11:45', '2019-03-01 20:11:45'),
(359, 89, 1, '2019-03-01 20:18:30', '2019-03-01 20:18:30'),
(363, 95, 1, '2019-03-03 10:48:29', '2019-03-03 10:48:29'),
(373, 97, 3, '2019-03-04 10:18:05', '2019-03-04 10:18:05'),
(375, 104, 2, '2019-03-06 12:44:42', '2019-03-06 12:44:42'),
(380, 22, 1, '2019-03-08 22:35:59', '2019-03-08 22:35:59'),
(382, 112, 1, '2019-03-09 16:28:12', '2019-03-09 16:28:12'),
(385, 117, 1, '2019-03-13 02:27:06', '2019-03-13 02:27:06'),
(386, 117, 2, '2019-03-13 02:41:47', '2019-03-13 02:41:47'),
(387, 117, 3, '2019-03-13 03:11:25', '2019-03-13 03:11:25');

-- --------------------------------------------------------

--
-- Table structure for table `food_list`
--

CREATE TABLE `food_list` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `price` double(8,2) NOT NULL,
  `tax` double(6,2) NOT NULL DEFAULT '0.00',
  `packaging_charge` double(6,2) NOT NULL DEFAULT '0.00',
  `image` varchar(300) DEFAULT NULL,
  `description` varchar(100) NOT NULL,
  `is_veg` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_list`
--

INSERT INTO `food_list` (`id`, `restaurant_id`, `category_id`, `menu_id`, `name`, `price`, `tax`, `packaging_charge`, `image`, `description`, `is_veg`, `status`, `created_at`, `update_at`) VALUES
(1, 1, 1, 1, 'BBQ Chicken Wings', 159.00, 5.00, 10.00, NULL, 'Chicken wings cooked with BBQ and Honey', 0, 1, '2018-08-13 05:35:53', '2018-08-13 05:35:53'),
(2, 1, 3, 1, 'Panner Toast ada Pizza', 129.00, 5.00, 10.00, NULL, 'Bread topped with panner and cheese', 1, 1, '2018-08-13 05:35:53', '2018-08-13 05:35:53'),
(3, 1, 2, 2, 'Burger', 139.00, 5.00, 10.00, NULL, 'Bread topped with panner and cheese', 1, 1, '2018-08-13 11:17:34', '2018-08-13 11:17:34'),
(4, 2, 1, 4, 'BBQ Chicken Wings', 139.00, 0.00, 10.00, NULL, 'Chicken wings cooked with BBQ and Honey', 0, 1, '2018-08-14 09:20:06', '2018-08-14 09:20:06'),
(5, 2, 2, 5, 'Burger', 99.00, 0.00, 10.00, NULL, 'Bread topped with panner and cheese', 1, 1, '2018-08-14 09:20:06', '2018-08-14 09:20:06'),
(6, 1, 4, 7, 'Noodles', 119.00, 5.00, 10.00, NULL, '', 0, 1, '2018-08-14 11:12:04', '2018-08-14 11:12:04'),
(7, 1, 5, 6, 'Veg Meals', 90.00, 5.00, 10.00, NULL, '', 1, 1, '2018-08-14 11:13:27', '2018-08-14 11:13:27'),
(8, 1, 7, 1, 'Vanilla Milkshake', 49.00, 5.00, 10.00, NULL, '', 0, 1, '2018-08-14 11:19:02', '2018-08-14 11:19:02'),
(9, 1, 1, 1, 'BBQ Chicken', 200.00, 5.00, 10.00, NULL, 'Chicken wings cooked with BBQ and Honey', 0, 1, '2018-11-29 12:31:50', '2018-11-29 12:31:50'),
(10, 1, 1, 3, 'Noodles', 70.00, 5.00, 10.00, NULL, 'Noodles cooked with BBQ and Honey', 0, 1, '2018-11-29 12:31:50', '2018-11-29 12:31:50'),
(11, 1, 1, 1, 'Veg Noodles', 65.00, 5.00, 10.00, NULL, 'Veg Noodles cooked with BBQ and Honey', 1, 1, '2018-11-29 12:33:18', '2018-11-29 12:33:18'),
(12, 1, 3, 1, 'Fried Rice', 80.00, 5.00, 10.00, NULL, 'Hot and Crispy', 1, 1, '2018-11-29 12:33:18', '2018-11-29 12:33:18'),
(13, 1, 3, 1, 'Egg Fried Rice', 100.00, 5.00, 10.00, NULL, 'Hot and Spicy', 0, 1, '2018-11-29 12:34:35', '2018-11-29 12:34:35'),
(14, 1, 3, 2, 'Chicken Noodles', 190.00, 5.00, 10.00, NULL, 'Hot and Tasty', 0, 1, '2018-11-29 12:34:35', '2018-11-29 12:34:35'),
(15, 1, 3, 2, 'Pron Fried Rice', 220.00, 5.00, 10.00, NULL, 'Hot and Chilli', 0, 1, '2018-11-29 12:35:55', '2018-11-29 12:35:55'),
(16, 1, 7, 1, 'Veg Briyani', 290.00, 5.00, 10.00, NULL, 'Tasty', 1, 1, '2018-11-29 12:35:55', '2018-11-29 12:35:55'),
(17, 1, 7, 2, 'Egg Briyani', 200.00, 5.00, 10.00, NULL, 'Tasty', 0, 1, '2018-11-29 12:40:15', '2018-11-29 12:40:15'),
(18, 1, 7, 1, 'Chicken Briyani', 199.00, 5.00, 10.00, NULL, 'Tasty and Spicy', 0, 1, '2018-11-29 12:40:15', '2018-11-29 12:40:15'),
(19, 1, 5, 6, 'Non-veg Meals', 175.00, 5.00, 10.00, NULL, 'Hot', 0, 1, '2018-11-29 12:41:13', '2018-11-29 12:41:13'),
(20, 1, 1, 1, 'Bucket Chicken', 150.00, 5.00, 10.00, NULL, 'Hot and Spicy', 1, 1, '2019-02-20 08:00:33', '2019-02-20 08:00:33'),
(21, 12, 1, 6, 'Black Banana', 500.00, 5.00, 1.00, NULL, 'very black banana', 1, 1, '2019-03-11 19:32:08', '2019-03-11 19:32:08'),
(22, 12, 2, 3, 'Black Banana', 500.00, 5.00, 1.00, NULL, 'Toasted Black Banana', 1, 1, '2019-03-11 19:57:23', '2019-03-11 19:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `menu_name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `restaurant_id`, `menu_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Combo@99', 0, '2018-08-13 05:31:29', '2018-08-13 05:31:29'),
(2, 1, 'Rolls', 0, '2018-08-13 05:31:29', '2018-08-13 05:31:29'),
(3, 1, 'Sandwiches', 0, '2018-08-13 05:31:47', '2018-08-13 05:31:47'),
(4, 2, 'Combo@99', 0, '2018-08-14 09:18:47', '2018-08-14 09:18:47'),
(5, 2, 'Rolls', 0, '2018-08-14 09:18:47', '2018-08-14 09:18:47'),
(6, 1, 'Meals', 0, '2018-08-14 11:10:05', '2018-08-14 11:10:05'),
(7, 1, 'Fast Food', 0, '2018-08-14 11:10:05', '2018-08-14 11:10:05'),
(8, 12, 'Combo@199', 0, '2019-03-11 19:55:47', '2019-03-11 19:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `offers_banner`
--

CREATE TABLE `offers_banner` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `image` varchar(300) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `is_suffle` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offers_banner`
--

INSERT INTO `offers_banner` (`id`, `restaurant_id`, `image`, `title`, `description`, `position`, `status`, `is_suffle`, `created_at`, `updated_at`) VALUES
(2, 2, 'public/uploads/ezgif-3-c4aa4796c86f.jpg', 'Beef Shawarma Starting @ Rs.59', 'Tab the banner to get Order', 1, 0, 0, '2018-08-10 11:05:54', '2018-08-10 11:05:54'),
(3, 2, 'public/uploads/ezgif-3-d0181df9b78c.jpg', 'Offer @ Rs.99', 'Tab the banner to get Order', 3, 0, 0, '2018-09-19 05:50:33', '2018-09-19 05:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `popular_brands_list`
--

CREATE TABLE `popular_brands_list` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `popular_brands_list`
--

INSERT INTO `popular_brands_list` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'KFC', 'public/uploads/kfc.jpeg', 0, '2018-08-11 06:04:30', '2018-08-11 06:04:30'),
(2, 'Pizza Hut', 'public/uploads/pizzahut.png', 0, '2018-08-11 06:04:30', '2018-08-11 06:04:30'),
(3, 'Dominos', 'public/uploads/dominos.jpeg', 0, '2018-08-11 06:05:08', '2018-08-11 06:05:08'),
(4, 'A2B', 'public/uploads/a2b.jpeg', 0, '2018-08-11 07:50:00', '2018-08-11 07:50:00'),
(5, 'Mcdonalds', 'public/uploads/mcdonalds.jpeg', 0, '2018-08-11 07:51:20', '2018-08-11 07:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `relevance`
--

CREATE TABLE `relevance` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relevance`
--

INSERT INTO `relevance` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Relevance', 0, '2018-08-10 07:00:08', '2018-08-10 07:00:08'),
(2, 'Rating', 0, '2018-08-10 07:00:21', '2018-08-10 07:00:21'),
(3, 'Time', 0, '2018-08-10 07:00:29', '2018-08-10 07:00:29'),
(4, 'Cost (Low to High)', 0, '2018-08-10 07:01:04', '2018-08-10 07:01:04'),
(5, 'Cost (High to Low)', 0, '2018-08-10 07:01:16', '2018-08-10 07:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `delivery_boy_id` int(11) NOT NULL DEFAULT '0',
  `item_total` double(6,2) NOT NULL DEFAULT '0.00',
  `offer_discount` double(6,2) NOT NULL DEFAULT '0.00',
  `restaurant_packaging_charge` double(6,2) NOT NULL DEFAULT '0.00',
  `tax` double(6,2) NOT NULL DEFAULT '0.00',
  `delivery_charge` double(6,2) NOT NULL DEFAULT '0.00',
  `bill_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `admin_commision` double(8,2) NOT NULL DEFAULT '0.00',
  `restaurant_commision` double(8,2) NOT NULL DEFAULT '0.00',
  `delivery_boy_commision` double(8,2) NOT NULL DEFAULT '0.00',
  `coupon_code` varchar(20) NOT NULL DEFAULT 'NA',
  `is_confirmed` int(4) NOT NULL DEFAULT '0',
  `is_paid` int(4) NOT NULL DEFAULT '0',
  `paid_type` int(4) NOT NULL DEFAULT '0',
  `status` int(4) NOT NULL DEFAULT '0',
  `delivery_address` varchar(600) DEFAULT NULL,
  `d_lat` double(8,6) NOT NULL DEFAULT '0.000000',
  `d_lng` double(8,6) NOT NULL DEFAULT '0.000000',
  `ordered_time` datetime DEFAULT NULL,
  `delivered_time` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `order_id`, `user_id`, `restaurant_id`, `delivery_boy_id`, `item_total`, `offer_discount`, `restaurant_packaging_charge`, `tax`, `delivery_charge`, `bill_amount`, `admin_commision`, `restaurant_commision`, `delivery_boy_commision`, `coupon_code`, `is_confirmed`, `is_paid`, `paid_type`, `status`, `delivery_address`, `d_lat`, `d_lng`, `ordered_time`, `delivered_time`, `created_at`, `updated_at`) VALUES
(1, 'EATZILLA001', 68, 1, 1, 494.00, 49.40, 0.00, 0.00, 0.00, 444.60, 44.46, 386.80, 13.34, 'testcode', 1, 1, 1, 7, 'Saibaba Colony,Saibaba Colony, Coimbatore, Tamil Nadu, India', 11.023578, 76.942585, '2019-01-24 17:32:06', NULL, '2019-01-24 12:02:06', '2019-02-15 15:19:07'),
(2, 'EATZILLA002', 16, 1, 5, 424.00, 0.00, 0.00, 0.00, 0.00, 424.00, 42.40, 368.88, 12.72, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005494, 76.954446, '2019-01-24 17:34:49', NULL, '2019-01-24 12:04:49', '2019-01-24 17:35:21'),
(3, 'EATZILLA003', 16, 1, 5, 608.00, 0.00, 0.00, 0.00, 0.00, 608.00, 60.80, 528.96, 18.24, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005542, 76.954425, '2019-01-24 18:05:38', NULL, '2019-01-24 12:35:38', '2019-01-24 18:11:10'),
(4, 'EATZILLA004', 22, 1, 5, 359.00, 0.00, 0.00, 0.00, 0.00, 359.00, 35.90, 312.33, 10.77, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005591, 76.954401, '2019-01-25 10:56:32', NULL, '2019-01-25 05:26:32', '2019-01-25 10:57:40'),
(5, 'EATZILLA005', 22, 1, 5, 265.00, 0.00, 0.00, 0.00, 0.00, 265.00, 26.50, 230.55, 7.95, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005567, 76.954414, '2019-01-25 11:01:14', NULL, '2019-01-25 05:31:14', '2019-01-25 11:02:53'),
(6, 'EATZILLA006', 22, 1, 5, 340.00, 0.00, 0.00, 0.00, 0.00, 340.00, 34.00, 295.80, 10.20, 'NA', 1, 1, 1, 7, 'No.1, VCV Rd, VCV Layout,R.R Layout, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.008927, 76.957663, '2019-01-25 11:33:00', NULL, '2019-01-25 06:03:00', '2019-01-25 11:33:27'),
(7, 'EATZILLA007', 22, 1, 5, 333.00, 0.00, 0.00, 0.00, 0.00, 333.00, 33.30, 289.71, 9.99, 'NA', 1, 1, 1, 7, 'No 3, Near K G Hospital, Bungalow Road, Gopalapuram, Coimbatore, Tamil Nadu 641018, India', 11.000180, 11.000180, '2019-01-25 12:24:27', NULL, '2019-01-25 06:54:27', '2019-01-25 12:25:01'),
(8, 'EATZILLA008', 22, 1, 5, 194.00, 0.00, 0.00, 0.00, 0.00, 194.00, 19.40, 168.78, 5.82, 'NA', 1, 1, 1, 7, 'No 3, Near K G Hospital, Bungalow Road, Gopalapuram, Coimbatore, Tamil Nadu 641018, India', 11.000180, 11.000180, '2019-01-25 12:31:07', NULL, '2019-01-25 07:01:07', '2019-01-25 12:31:41'),
(9, 'EATZILLA009', 22, 1, 5, 239.00, 0.00, 0.00, 0.00, 0.00, 239.00, 23.90, 207.93, 7.17, 'NA', 1, 1, 1, 7, 'Peelamedu, Coimbatore, Tamil Nadu, India', 11.033151, 77.027660, '2019-01-25 12:34:13', NULL, '2019-01-25 07:04:13', '2019-01-25 12:34:46'),
(10, 'EATZILLA010', 22, 1, 5, 359.00, 0.00, 0.00, 0.00, 0.00, 359.00, 35.90, 312.33, 10.77, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005510, 76.954436, '2019-01-25 14:03:21', NULL, '2019-01-25 08:33:21', '2019-01-25 14:09:30'),
(11, 'EATZILLA011', 22, 1, 5, 359.00, 0.00, 0.00, 0.00, 0.00, 359.00, 35.90, 312.33, 10.77, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005574, 76.954435, '2019-01-26 12:18:15', NULL, '2019-01-26 06:48:15', '2019-01-26 12:21:47'),
(12, 'EATZILLA012', 22, 2, 1, 238.00, 0.00, 10.00, 0.00, 0.00, 248.00, 24.80, 215.76, 7.44, 'NA', 1, 1, 1, 7, 'R. Gov. Jorge Lacerda, 1802 - Velha, Blumenau - SC, 89045-001, Brasil', -26.927773, -49.116123, '2019-02-06 11:49:06', NULL, '2019-02-06 06:19:06', '2019-02-13 18:30:25'),
(13, 'EATZILLA013', 22, 1, 0, 853.00, 0.00, 0.00, 0.00, 0.00, 853.00, 85.30, 742.11, 25.59, 'NA', 0, 0, 1, 10, '13/4, Kamaraj Nagar, Thiruvanmiyur, Chennai, Tamil Nadu 600041, India', 12.986701, 80.260217, '2019-02-17 16:11:16', NULL, '2019-02-17 10:41:16', '2019-02-17 10:41:16'),
(14, 'EATZILLA014', 65, 1, 5, 477.00, 0.00, 0.00, 0.00, 0.00, 477.00, 47.70, 414.99, 14.31, 'NA', 1, 1, 1, 7, '37, Ramachandra Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.006273, 76.954287, '2019-02-19 17:05:45', NULL, '2019-02-19 11:35:45', '2019-02-19 17:23:14'),
(15, 'EATZILLA015', 65, 2, 5, 417.00, 0.00, 10.00, 0.00, 0.00, 427.00, 42.70, 371.49, 12.81, 'NA', 1, 1, 1, 7, '37, Ramachandra Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.006273, 76.954287, '2019-02-19 17:26:12', NULL, '2019-02-19 11:56:12', '2019-02-19 17:27:56'),
(16, 'EATZILLA016', 65, 1, 5, 318.00, 0.00, 0.00, 0.00, 0.00, 318.00, 31.80, 276.66, 9.54, 'NA', 1, 1, 1, 7, '37, Ramachandra Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.006273, 76.954287, '2019-02-19 17:33:28', NULL, '2019-02-19 12:03:28', '2019-02-19 17:36:56'),
(17, 'EATZILLA017', 65, 1, 5, 318.00, 0.00, 0.00, 0.00, 0.00, 318.00, 31.80, 276.66, 9.54, 'NA', 1, 1, 1, 7, '37, Ramachandra Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.006273, 76.954287, '2019-02-19 19:09:56', NULL, '2019-02-19 13:39:56', '2019-02-22 12:14:16'),
(18, 'EATZILLA018', 22, 1, 5, 1278.00, 127.80, 0.00, 0.00, 0.00, 1150.20, 287.55, 1000.67, 34.51, 'testcode', 1, 1, 1, 7, 'No 3, Near K G Hospital, Bungalow Road, Gopalapuram, Coimbatore, Tamil Nadu 641018, India', 11.000180, 11.000180, '2019-02-21 12:52:55', NULL, '2019-02-21 07:22:55', '2019-02-22 20:26:32'),
(19, 'EATZILLA019', 22, 1, 0, 359.00, 35.90, 0.00, 0.00, 0.00, 323.10, 80.78, 281.10, 9.69, 'testcode', 0, 0, 1, 10, 'No 3, Near K G Hospital, Bungalow Road, Gopalapuram, Coimbatore, Tamil Nadu 641018, India', 11.000180, 11.000180, '2019-02-21 20:27:36', NULL, '2019-02-21 14:57:36', '2019-02-21 14:57:36'),
(20, 'EATZILLA020', 48, 1, 0, 159.00, 0.00, 0.00, 0.00, 0.00, 159.00, 39.75, 143.10, 7.95, 'NA', 0, 0, 1, 10, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005531, 76.954418, '2019-02-22 10:06:20', NULL, '2019-02-22 04:36:20', '2019-02-22 04:36:20'),
(21, 'EATZILLA021', 65, 2, 5, 417.00, 0.00, 10.00, 0.00, 0.00, 427.00, 106.75, 384.30, 21.35, 'NA', 1, 1, 1, 7, '37, Ramachandra Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.006274, 76.954286, '2019-02-22 11:56:53', NULL, '2019-02-22 06:26:53', '2019-02-22 12:08:42'),
(22, 'EATZILLA022', 65, 1, 5, 229.00, 0.00, 0.00, 0.00, 0.00, 229.00, 57.25, 206.10, 11.45, 'NA', 1, 1, 1, 7, '144-A, Ramachandra Rd, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.006464, 76.953942, '2019-02-22 13:35:10', NULL, '2019-02-22 08:05:10', '2019-02-22 13:40:46'),
(23, 'EATZILLA023', 65, 2, 5, 238.00, 0.00, 10.00, 0.00, 0.00, 248.00, 62.00, 223.20, 12.40, 'NA', 1, 1, 1, 7, '144-A, Ramachandra Rd, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.006464, 76.953942, '2019-02-22 13:42:49', NULL, '2019-02-22 08:12:49', '2019-02-22 13:43:05'),
(24, 'EATZILLA024', 65, 1, 0, 617.00, 0.00, 0.00, 0.00, 0.00, 617.00, 154.25, 555.30, 30.85, 'NA', 0, 0, 1, 1, '144-A, Ramachandra Rd, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.006380, 76.954266, '2019-02-22 13:57:11', NULL, '2019-02-22 08:27:11', '2019-02-22 17:22:28'),
(25, 'EATZILLA025', 65, 1, 0, 159.00, 0.00, 0.00, 0.00, 0.00, 159.00, 39.75, 143.10, 7.95, 'NA', 0, 0, 1, 10, '144-A, Ramachandra Rd, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.006380, 76.954266, '2019-02-22 13:59:00', NULL, '2019-02-22 08:29:00', '2019-02-22 08:29:00'),
(26, 'EATZILLA026', 65, 1, 0, 318.00, 0.00, 0.00, 0.00, 0.00, 318.00, 79.50, 286.20, 15.90, 'NA', 0, 0, 1, 10, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005558, 76.954430, '2019-02-22 16:42:07', NULL, '2019-02-22 11:12:07', '2019-02-22 11:12:07'),
(27, 'EATZILLA027', 65, 1, 0, 477.00, 0.00, 0.00, 0.00, 0.00, 477.00, 119.25, 429.30, 23.85, 'NA', 0, 0, 1, 1, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005555, 76.954428, '2019-02-22 16:42:46', NULL, '2019-02-22 11:12:46', '2019-02-22 17:22:58'),
(28, 'EATZILLA028', 22, 1, 0, 526.00, 0.00, 0.00, 0.00, 0.00, 526.00, 131.50, 473.40, 26.30, 'NA', 0, 0, 1, 10, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005561, 76.954418, '2019-02-22 17:23:47', NULL, '2019-02-22 11:53:47', '2019-02-22 11:53:47'),
(29, 'EATZILLA029', 22, 1, 0, 258.00, 0.00, 0.00, 0.00, 0.00, 258.00, 64.50, 232.20, 12.90, 'NA', 0, 0, 1, 10, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005561, 76.954418, '2019-02-22 17:28:27', NULL, '2019-02-22 11:58:27', '2019-02-22 11:58:27'),
(30, 'EATZILLA030', 22, 1, 0, 258.00, 0.00, 0.00, 0.00, 0.00, 258.00, 64.50, 232.20, 12.90, 'NA', 0, 0, 1, 10, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005561, 76.954418, '2019-02-22 17:28:48', NULL, '2019-02-22 11:58:48', '2019-02-22 11:58:48'),
(31, 'EATZILLA031', 22, 1, 0, 129.00, 0.00, 0.00, 0.00, 0.00, 129.00, 32.25, 116.10, 6.45, 'NA', 0, 0, 1, 10, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005561, 76.954418, '2019-02-22 17:29:22', NULL, '2019-02-22 11:59:22', '2019-02-22 11:59:22'),
(32, 'EATZILLA032', 22, 1, 0, 387.00, 0.00, 0.00, 0.00, 0.00, 387.00, 96.75, 348.30, 19.35, 'NA', 0, 0, 1, 10, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005561, 76.954418, '2019-02-22 17:40:35', NULL, '2019-02-22 12:10:35', '2019-02-22 12:10:35'),
(33, 'EATZILLA033', 22, 1, 0, 258.00, 0.00, 0.00, 0.00, 0.00, 258.00, 64.50, 232.20, 12.90, 'NA', 0, 0, 1, 10, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005561, 76.954418, '2019-02-22 17:42:19', NULL, '2019-02-22 12:12:19', '2019-02-22 12:12:19'),
(34, 'EATZILLA034', 22, 1, 0, 258.00, 0.00, 0.00, 0.00, 0.00, 258.00, 64.50, 232.20, 12.90, 'NA', 0, 0, 1, 10, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005561, 76.954418, '2019-02-22 17:43:23', NULL, '2019-02-22 12:13:23', '2019-02-22 12:13:23'),
(35, 'EATZILLA035', 22, 1, 0, 387.00, 0.00, 0.00, 0.00, 0.00, 387.00, 96.75, 348.30, 19.35, 'NA', 0, 0, 1, 10, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005561, 76.954418, '2019-02-22 17:44:29', NULL, '2019-02-22 12:14:29', '2019-02-22 12:14:29'),
(36, 'EATZILLA036', 22, 1, 0, 258.00, 0.00, 0.00, 0.00, 0.00, 258.00, 64.50, 232.20, 12.90, 'NA', 0, 0, 1, 10, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005561, 76.954418, '2019-02-22 17:48:28', NULL, '2019-02-22 12:18:28', '2019-02-22 12:18:28'),
(37, 'EATZILLA037', 22, 1, 0, 258.00, 0.00, 0.00, 0.00, 0.00, 258.00, 64.50, 232.20, 12.90, 'NA', 0, 0, 1, 10, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005561, 76.954418, '2019-02-22 17:49:01', NULL, '2019-02-22 12:19:01', '2019-02-22 12:19:01'),
(38, 'EATZILLA038', 22, 1, 0, 258.00, 0.00, 0.00, 0.00, 0.00, 258.00, 64.50, 232.20, 12.90, 'NA', 0, 0, 1, 10, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005561, 76.954418, '2019-02-22 17:49:02', NULL, '2019-02-22 12:19:02', '2019-02-22 12:19:02'),
(39, 'EATZILLA039', 22, 1, 0, 258.00, 0.00, 0.00, 0.00, 0.00, 258.00, 64.50, 232.20, 12.90, 'NA', 0, 0, 1, 10, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005561, 76.954418, '2019-02-22 17:49:58', NULL, '2019-02-22 12:19:58', '2019-02-22 12:19:58'),
(40, 'EATZILLA040', 22, 1, 0, 129.00, 0.00, 0.00, 0.00, 0.00, 129.00, 32.25, 116.10, 6.45, 'NA', 0, 0, 1, 10, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005561, 76.954418, '2019-02-22 17:50:28', NULL, '2019-02-22 12:20:28', '2019-02-22 12:20:28'),
(41, 'EATZILLA041', 22, 1, 5, 129.00, 0.00, 0.00, 0.00, 0.00, 129.00, 32.25, 116.10, 6.45, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005561, 76.954418, '2019-02-22 17:54:03', NULL, '2019-02-22 12:24:03', '2019-02-22 20:26:21'),
(42, 'EATZILLA042', 22, 1, 5, 129.00, 0.00, 0.00, 0.00, 0.00, 129.00, 32.25, 116.10, 6.45, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005561, 76.954418, '2019-02-22 18:13:34', NULL, '2019-02-22 12:43:34', '2019-02-22 18:16:51'),
(43, 'EATZILLA043', 22, 1, 5, 129.00, 0.00, 0.00, 0.00, 0.00, 129.00, 32.25, 116.10, 6.45, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005561, 76.954418, '2019-02-22 18:13:54', NULL, '2019-02-22 12:43:54', '2019-02-22 18:16:23'),
(44, 'EATZILLA044', 22, 1, 5, 318.00, 0.00, 0.00, 0.00, 0.00, 318.00, 79.50, 286.20, 15.90, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005555, 76.954426, '2019-02-22 20:39:41', NULL, '2019-02-22 15:09:41', '2019-02-22 20:40:08'),
(45, 'EATZILLA045', 22, 1, 0, 429.00, 42.90, 0.00, 0.00, 0.00, 386.10, 96.53, 347.49, 19.30, 'testcode', 0, 0, 1, 10, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, '2019-02-23 05:39:48', NULL, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(46, 'EATZILLA046', 22, 1, 0, 429.00, 42.90, 0.00, 0.00, 0.00, 386.10, 96.53, 347.49, 19.30, 'testcode', 0, 0, 1, 10, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, '2019-02-23 05:39:48', NULL, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(47, 'EATZILLA046', 22, 1, 0, 429.00, 42.90, 0.00, 0.00, 0.00, 386.10, 96.53, 347.49, 19.30, 'testcode', 0, 0, 1, 10, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, '2019-02-23 05:39:48', NULL, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(48, 'EATZILLA048', 22, 1, 0, 429.00, 42.90, 0.00, 0.00, 0.00, 386.10, 96.53, 347.49, 19.30, 'testcode', 0, 0, 1, 10, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, '2019-02-23 05:39:48', NULL, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(49, 'EATZILLA049', 22, 1, 0, 429.00, 42.90, 0.00, 0.00, 0.00, 386.10, 96.53, 347.49, 19.30, 'testcode', 0, 0, 1, 10, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, '2019-02-23 05:39:48', NULL, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(50, 'EATZILLA050', 48, 1, 0, 129.00, 0.00, 0.00, 0.00, 0.00, 129.00, 32.25, 116.10, 6.45, 'NA', 0, 0, 1, 1, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005561, 76.954437, '2019-02-23 10:52:17', NULL, '2019-02-23 05:22:17', '2019-03-02 11:16:35'),
(51, 'EATZILLA051', 22, 2, 5, 139.00, 0.00, 10.00, 0.00, 0.00, 149.00, 37.25, 134.10, 7.45, 'NA', 1, 1, 1, 7, 'Coimbatore, Tamil Nadu, India', 11.016845, 76.955832, '2019-02-23 11:06:57', NULL, '2019-02-23 05:36:57', '2019-02-23 16:20:59'),
(52, 'EATZILLA052', 22, 2, 5, 198.00, 0.00, 10.00, 0.00, 0.00, 208.00, 52.00, 187.20, 10.40, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005638, 76.954356, '2019-02-23 16:35:47', NULL, '2019-02-23 11:05:47', '2019-02-23 16:36:04'),
(53, 'EATZILLA053', 22, 1, 5, 129.00, 0.00, 0.00, 0.00, 0.00, 129.00, 32.25, 116.10, 6.45, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005600, 76.954465, '2019-02-23 16:40:09', NULL, '2019-02-23 11:10:09', '2019-02-23 16:40:24'),
(54, 'EATZILLA054', 22, 1, 5, 258.00, 0.00, 0.00, 0.00, 0.00, 258.00, 64.50, 232.20, 12.90, 'NA', 1, 1, 1, 7, '151, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005766, 76.954174, '2019-02-23 16:50:09', NULL, '2019-02-23 11:20:09', '2019-02-23 16:50:28'),
(55, 'EATZILLA055', 22, 1, 5, 129.00, 0.00, 0.00, 0.00, 0.00, 129.00, 32.25, 116.10, 6.45, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005639, 76.954441, '2019-02-23 16:52:21', NULL, '2019-02-23 11:22:21', '2019-02-23 16:52:37'),
(56, 'EATZILLA056', 22, 1, 0, 549.00, 54.90, 0.00, 0.00, 0.00, 494.10, 123.52, 444.69, 24.70, 'testcode', 1, 0, 1, 4, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, '2019-02-25 12:38:55', NULL, '2019-02-25 07:08:55', '2019-02-25 12:43:59'),
(57, 'EATZILLA057', 89, 2, 0, 238.00, 23.80, 10.00, 0.00, 0.00, 224.20, 56.05, 201.78, 11.21, 'testcode', 0, 0, 1, 1, 'Córdoba,Córdoba, Cordoba, Argentina', -31.420083, -64.188776, '2019-02-27 17:01:59', NULL, '2019-02-27 11:31:59', '2019-03-01 21:48:58'),
(58, 'EATZILLA058', 88, 1, 5, 129.00, 0.00, 0.00, 0.00, 0.00, 129.00, 32.25, 116.10, 6.45, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005618, 76.954443, '2019-02-27 17:58:00', NULL, '2019-02-27 12:28:00', '2019-02-27 18:00:31'),
(59, 'EATZILLA059', 88, 1, 5, 129.00, 0.00, 0.00, 0.00, 0.00, 129.00, 32.25, 116.10, 6.45, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005618, 76.954443, '2019-02-27 17:58:01', NULL, '2019-02-27 12:28:01', '2019-02-27 17:58:58'),
(60, 'EATZILLA060', 88, 2, 5, 99.00, 0.00, 10.00, 0.00, 0.00, 109.00, 27.25, 98.10, 5.45, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005630, 76.954417, '2019-02-27 18:09:49', NULL, '2019-02-27 12:39:49', '2019-02-27 18:12:57'),
(61, 'EATZILLA061', 88, 2, 5, 99.00, 0.00, 10.00, 0.00, 0.00, 109.00, 27.25, 98.10, 5.45, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005557, 76.954426, '2019-02-27 18:31:58', NULL, '2019-02-27 13:01:58', '2019-02-27 18:32:29'),
(62, 'EATZILLA062', 88, 1, 5, 129.00, 0.00, 0.00, 0.00, 0.00, 129.00, 32.25, 116.10, 6.45, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005553, 76.954426, '2019-02-27 18:37:29', NULL, '2019-02-27 13:07:29', '2019-02-27 18:39:43'),
(63, 'EATZILLA063', 88, 1, 5, 129.00, 0.00, 0.00, 0.00, 0.00, 129.00, 32.25, 116.10, 6.45, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005553, 76.954426, '2019-02-27 18:37:29', NULL, '2019-02-27 13:07:29', '2019-02-27 18:39:12'),
(64, 'EATZILLA064', 88, 1, 5, 129.00, 0.00, 0.00, 0.00, 0.00, 129.00, 32.25, 116.10, 6.45, 'NA', 1, 1, 1, 7, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005553, 76.954426, '2019-02-27 18:37:30', NULL, '2019-02-27 13:07:30', '2019-02-27 18:38:27'),
(65, 'EATZILLA065', 90, 2, 5, 99.00, 0.00, 10.00, 0.00, 0.00, 109.00, 27.25, 98.10, 5.45, 'NA', 1, 1, 1, 7, 'avinashi', 11.005541, 11.005541, '2019-02-28 12:57:43', NULL, '2019-02-28 07:27:43', '2019-02-28 13:00:02'),
(66, 'EATZILLA066', 92, 1, 0, 559.00, 0.00, 0.00, 0.00, 0.00, 559.00, 139.75, 503.10, 27.95, 'NA', 0, 0, 1, 1, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005553, 76.954428, '2019-03-01 14:56:03', NULL, '2019-03-01 09:26:03', '2019-03-01 19:31:07'),
(67, 'EATZILLA067', 22, 1, 0, 727.00, 0.00, 5.00, 0.00, 0.00, 732.00, 1464.00, 3660.00, 36.60, 'NA', 0, 0, 1, 1, 'Callao 1234, S2000QKJ Rosario, Santa Fe, Argentina', -32.948017, -60.661555, '2019-03-02 11:09:04', NULL, '2019-03-02 05:39:04', '2019-03-02 11:16:08'),
(68, 'EATZILLA068', 22, 2, 0, 139.00, 0.00, 10.00, 0.00, 0.00, 149.00, 298.00, 745.00, 7.45, 'NA', 0, 0, 1, 1, 'No 3, Near K G Hospital, Bungalow Road, Gopalapuram, Coimbatore, Tamil Nadu 641018, India', 11.000180, 11.000180, '2019-03-02 11:10:55', NULL, '2019-03-02 05:40:55', '2019-03-02 21:27:24'),
(69, 'EATZILLA069', 22, 1, 0, 200.00, 0.00, 5.00, 0.00, 0.00, 205.00, 410.00, 1025.00, 10.25, 'NA', 0, 0, 1, 1, 'Callao 1234, S2000QKJ Rosario, Santa Fe, Argentina', -32.948018, -60.661555, '2019-03-02 11:17:42', NULL, '2019-03-02 05:47:42', '2019-03-02 21:27:18'),
(70, 'EATZILLA070', 22, 1, 0, 407.00, 0.00, 5.00, 0.00, 0.00, 412.00, 824.00, 2060.00, 20.60, 'NA', 0, 0, 1, 1, '153, Mecricar Rd, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005564, 76.954461, '2019-03-02 12:53:12', NULL, '2019-03-02 07:23:12', '2019-03-02 21:26:14'),
(71, 'EATZILLA071', 89, 1, 0, 6683.00, 0.00, 5.00, 0.00, 0.00, 6688.00, 13376.00, 33440.00, 334.40, 'NA', 0, 0, 1, 1, 'Au 9, Córdoba, Argentina', -31.667904, -63.843782, '2019-03-02 19:54:40', NULL, '2019-03-02 14:24:40', '2019-03-02 21:27:10'),
(72, 'EATZILLA072', 89, 2, 0, 1586.00, 317.20, 10.00, 0.00, 0.00, 1278.80, 2557.60, 6394.00, 63.94, 'HOLA123', 0, 0, 1, 0, 'Au 9, Córdoba, Argentina', -31.667904, -63.843782, '2019-03-02 21:32:20', NULL, '2019-03-02 16:02:20', '2019-03-02 16:02:20'),
(73, 'EATZILLA073', 22, 2, 0, 99.00, 0.00, 10.00, 0.00, 0.00, 109.00, 218.00, 545.00, 5.45, 'NA', 0, 0, 1, 0, 'Global Infocity', 12.969581, 80.241567, '2019-03-02 23:23:42', NULL, '2019-03-02 17:53:42', '2019-03-02 17:53:42'),
(74, 'EATZILLA074', 22, 2, 0, 99.00, 0.00, 10.00, 0.00, 0.00, 109.00, 218.00, 545.00, 5.45, 'NA', 0, 0, 1, 1, 'Coimbatore, Tamil Nadu, India', 11.016845, 76.955832, '2019-03-02 23:31:25', NULL, '2019-03-02 18:01:25', '2019-03-02 23:35:16'),
(75, 'EATZILLA075', 22, 1, 0, 65.00, 0.00, 5.00, 0.00, 0.00, 70.00, 140.00, 350.00, 3.50, 'NA', 0, 0, 1, 1, 'Coimbatore, Tamil Nadu, India', 11.016845, 76.955832, '2019-03-02 23:32:59', NULL, '2019-03-02 18:02:59', '2019-03-02 23:33:46'),
(76, 'EATZILLA076', 95, 1, 0, 383.00, 0.00, 5.00, 0.00, 0.00, 388.00, 776.00, 1940.00, 19.40, 'NA', 0, 0, 1, 0, 'CSIR Rd, Taramani, Chennai, Tamil Nadu 600113, India', 12.986413, 80.247671, '2019-03-03 17:33:56', NULL, '2019-03-03 12:03:56', '2019-03-03 12:03:56'),
(77, 'EATZILLA077', 90, 1, 5, 215.00, 0.00, 5.00, 0.00, 0.00, 220.00, 440.00, 1100.00, 11.00, 'NA', 1, 1, 1, 7, 'avinashi', 11.005541, 11.005541, '2019-03-04 11:33:47', NULL, '2019-03-04 06:03:47', '2019-03-04 11:39:04'),
(78, 'EATZILLA078', 90, 2, 5, 139.00, 0.00, 10.00, 0.00, 0.00, 149.00, 298.00, 745.00, 7.45, 'NA', 1, 1, 1, 7, 'avinashi', 11.005541, 11.005541, '2019-03-04 12:26:33', NULL, '2019-03-04 06:56:33', '2019-03-04 12:31:54'),
(79, 'EATZILLA079', 90, 2, 5, 99.00, 0.00, 10.00, 0.00, 0.00, 109.00, 218.00, 545.00, 5.45, 'NA', 1, 1, 1, 7, 'avinashi', 11.005541, 11.005541, '2019-03-04 12:35:58', NULL, '2019-03-04 07:05:58', '2019-03-04 12:36:58'),
(80, 'EATZILLA080', 97, 2, 5, 99.00, 0.00, 10.00, 0.00, 0.00, 109.00, 218.00, 545.00, 5.45, 'NA', 1, 1, 1, 7, 'Avinashi Road, Athikuttai, Rangasamy Gounden Pudur, Coimbatore, Tamil Nadu, India', 11.050392, 77.058772, '2019-03-04 15:29:03', NULL, '2019-03-04 09:59:03', '2019-03-04 15:38:01'),
(81, 'EATZILLA081', 89, 1, 0, 195.00, 0.00, 5.00, 0.00, 0.00, 200.00, 400.00, 1000.00, 10.00, 'NA', 0, 0, 1, 0, 'Au 9, Córdoba, Argentina', -31.668045, -63.843666, '2019-03-04 17:25:49', NULL, '2019-03-04 11:55:49', '2019-03-04 11:55:49'),
(82, 'EATZILLA082', 89, 2, 0, 417.00, 0.00, 10.00, 0.00, 0.00, 427.00, 854.00, 2135.00, 21.35, 'NA', 0, 0, 1, 0, 'Au 9, Córdoba, Argentina', -31.668045, -63.843666, '2019-03-04 17:27:17', NULL, '2019-03-04 11:57:17', '2019-03-04 11:57:17'),
(83, 'EATZILLA083', 22, 1, 0, 1101.00, 110.10, 5.00, 0.00, 0.00, 995.90, 1991.80, 4979.50, 49.80, 'testcode', 0, 0, 1, 0, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, '2019-03-05 11:16:37', NULL, '2019-03-05 05:46:37', '2019-03-05 05:46:37'),
(84, 'EATZILLA084', 22, 1, 0, 359.00, 35.90, 5.00, 0.00, 0.00, 328.10, 656.20, 1640.50, 16.41, 'testcode', 0, 0, 1, 0, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, '2019-03-05 12:37:50', NULL, '2019-03-05 07:07:50', '2019-03-05 07:07:50'),
(85, 'EATZILLA085', 89, 1, 0, 159.00, 0.00, 5.00, 0.00, 0.00, 164.00, 328.00, 820.00, 8.20, 'NA', 0, 0, 1, 0, 'Au 9, Córdoba, Argentina', -31.667904, -63.843782, '2019-03-05 19:44:34', NULL, '2019-03-05 14:14:34', '2019-03-05 14:14:34'),
(86, 'EATZILLA086', 99, 1, 0, 359.00, 0.00, 5.00, 0.00, 0.00, 364.00, 728.00, 1820.00, 18.20, 'NA', 0, 0, 1, 0, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005511, 76.954429, '2019-03-06 11:55:04', NULL, '2019-03-06 06:25:04', '2019-03-06 06:25:04'),
(87, 'EATZILLA087', 99, 1, 0, 359.00, 0.00, 5.00, 0.00, 0.00, 364.00, 728.00, 1820.00, 18.20, 'NA', 0, 0, 1, 0, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005511, 76.954429, '2019-03-06 11:59:12', NULL, '2019-03-06 06:29:12', '2019-03-06 06:29:12'),
(88, 'EATZILLA088', 99, 1, 0, 200.00, 0.00, 5.00, 0.00, 0.00, 205.00, 410.00, 1025.00, 10.25, 'NA', 0, 0, 1, 0, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005511, 76.954429, '2019-03-06 12:02:16', NULL, '2019-03-06 06:32:16', '2019-03-06 06:32:16'),
(89, 'EATZILLA089', 99, 1, 0, 200.00, 0.00, 5.00, 0.00, 0.00, 205.00, 410.00, 1025.00, 10.25, 'NA', 0, 0, 1, 0, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005511, 76.954429, '2019-03-06 12:03:42', NULL, '2019-03-06 06:33:42', '2019-03-06 06:33:42'),
(90, 'EATZILLA090', 99, 1, 0, 159.00, 0.00, 5.00, 0.00, 0.00, 164.00, 328.00, 820.00, 8.20, 'NA', 0, 0, 1, 0, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005511, 76.954429, '2019-03-06 12:12:14', NULL, '2019-03-06 06:42:14', '2019-03-06 06:42:14'),
(91, 'EATZILLA091', 102, 1, 10, 159.00, 0.00, 5.00, 0.00, 0.00, 164.00, 328.00, 820.00, 8.20, 'NA', 0, 0, 1, 2, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005541, 76.954436, '2019-03-06 16:43:46', NULL, '2019-03-06 11:13:46', '2019-03-07 18:59:29'),
(92, 'EATZILLA092', 102, 1, 10, 159.00, 0.00, 5.00, 0.00, 0.00, 164.00, 328.00, 820.00, 8.20, 'NA', 0, 0, 1, 2, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005552, 76.954429, '2019-03-06 16:48:18', NULL, '2019-03-06 11:18:18', '2019-03-07 17:13:12'),
(93, 'EATZILLA093', 103, 1, 5, 644.00, 0.00, 5.00, 0.00, 0.00, 649.00, 1298.00, 3245.00, 32.45, 'NA', 1, 0, 1, 4, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005570, 76.954425, '2019-03-06 16:54:48', NULL, '2019-03-06 11:24:48', '2019-03-06 16:55:42'),
(94, 'EATZILLA094', 22, 1, 10, 159.00, 15.90, 5.00, 0.00, 0.00, 148.10, 296.20, 740.50, 7.40, 'testcode', 0, 0, 1, 2, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, '2019-03-06 21:00:09', NULL, '2019-03-06 15:30:09', '2019-03-07 17:11:58'),
(95, 'EATZILLA095', 108, 1, 10, 159.00, 0.00, 5.00, 0.00, 0.00, 164.00, 32.80, 123.00, 8.20, 'NA', 0, 0, 1, 2, '103 N Arlington Ave, East Orange, NJ 07017, USA', 40.764113, -74.208470, '2019-03-07 16:41:48', NULL, '2019-03-07 11:11:48', '2019-03-07 17:11:39'),
(96, 'EATZILLA096', 22, 1, 0, 464.00, 0.00, 5.00, 0.00, 0.00, 469.00, 93.80, 351.75, 23.45, 'NA', 0, 0, 1, 1, 'Urb. Bellavista Zambrana, 49, 29130 Alhaurín de la Torre, Málaga, España', 36.656834, -4.545512, '2019-03-08 03:32:07', NULL, '2019-03-07 22:02:07', '2019-03-12 08:53:23'),
(97, 'EATZILLA097', 22, 1, 10, 359.00, 0.00, 5.00, 0.00, 0.00, 364.00, 72.80, 273.00, 18.20, 'NA', 0, 0, 1, 2, 'Urb. Bellavista Zambrana, 49, 29130 Alhaurín de la Torre, Málaga, España', 36.656844, -4.545526, '2019-03-09 04:07:03', NULL, '2019-03-08 22:37:03', '2019-03-10 10:31:23'),
(98, 'EATZILLA098', 22, 2, 0, 139.00, 0.00, 10.00, 0.00, 0.00, 149.00, 29.80, 111.75, 7.45, 'NA', 0, 0, 1, 0, 'Urb. Bellavista Zambrana, 49, 29130 Alhaurín de la Torre, Málaga, España', 36.656837, -4.545483, '2019-03-10 06:16:40', NULL, '2019-03-10 00:46:40', '2019-03-10 00:46:40'),
(99, 'EATZILLA099', 22, 2, 0, 1668.00, 0.00, 10.00, 0.00, 0.00, 1678.00, 335.60, 1258.50, 83.90, 'NA', 0, 0, 1, 0, 'Urb. Bellavista Zambrana, 49, 29130 Alhaurín de la Torre, Málaga, España', 36.656838, -4.545505, '2019-03-10 06:32:21', NULL, '2019-03-10 01:02:21', '2019-03-10 01:02:21'),
(100, 'EATZILLA100', 22, 2, 0, 139.00, 0.00, 10.00, 0.00, 0.00, 149.00, 29.80, 111.75, 7.45, 'NA', 0, 0, 1, 0, 'Urb. Bellavista Zambrana, 49, 29130 Alhaurín de la Torre, Málaga, España', 36.656834, -4.545512, '2019-03-11 02:05:45', NULL, '2019-03-10 20:35:45', '2019-03-10 20:35:45'),
(101, 'EATZILLA101', 22, 1, 0, 359.00, 0.00, 5.00, 0.00, 0.00, 364.00, 72.80, 273.00, 18.20, 'NA', 0, 0, 1, 0, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005565, 76.954428, '2019-03-11 11:48:21', NULL, '2019-03-11 06:18:21', '2019-03-11 06:18:21'),
(102, 'EATZILLA102', 22, 1, 10, 477.00, 0.00, 5.00, 0.00, 0.00, 482.00, 96.40, 361.50, 24.10, 'NA', 0, 0, 1, 2, 'Tv. São Miguel Dois, 37, Caetité - BA, 46400-000, Brasil', -14.074569, -42.482680, '2019-03-12 09:24:03', NULL, '2019-03-12 03:54:03', '2019-03-12 09:32:21'),
(103, 'EATZILLA103', 117, 1, 0, 139.00, 0.00, 5.00, 0.00, 0.00, 144.00, 28.80, 108.00, 7.20, 'NA', 0, 0, 1, 0, 'R. Jose Carlos Oliveira, 20, Tamandaré - PE, 55578-000, Brasil', -8.757478, -35.103441, '2019-03-13 07:57:21', NULL, '2019-03-13 02:27:21', '2019-03-13 02:27:21'),
(104, 'EATZILLA104', 117, 1, 0, 265.00, 0.00, 5.00, 0.00, 0.00, 270.00, 54.00, 202.50, 13.50, 'NA', 0, 0, 1, 0, 'R. Jose Carlos Oliveira, 20, Tamandaré - PE, 55578-000, Brasil', -8.757485, -35.103444, '2019-03-13 07:59:41', NULL, '2019-03-13 02:29:41', '2019-03-13 02:29:41'),
(105, 'EATZILLA105', 117, 12, 0, 1500.00, 0.00, 1.00, 10.00, 0.00, 1511.00, 302.20, 1133.25, 75.55, 'NA', 0, 0, 1, 0, 'R. Jose Carlos Oliveira, 20, Tamandaré - PE, 55578-000, Brasil', -8.757478, -35.103443, '2019-03-13 08:15:25', NULL, '2019-03-13 02:45:25', '2019-03-13 02:45:25'),
(106, 'EATZILLA106', 117, 2, 0, 198.00, 0.00, 10.00, 0.00, 0.00, 208.00, 41.60, 156.00, 10.40, 'NA', 0, 0, 1, 0, 'R. Jose Carlos Oliveira, 20, Tamandaré - PE, 55578-000, Brasil', -8.757485, -35.103444, '2019-03-13 08:40:43', NULL, '2019-03-13 03:10:43', '2019-03-13 03:10:43'),
(107, 'EATZILLA107', 117, 2, 0, 794.00, 0.00, 10.00, 0.00, 0.00, 804.00, 160.80, 603.00, 40.20, 'NA', 0, 0, 1, 0, 'R. Jose Carlos Oliveira, 20, Tamandaré - PE, 55578-000, Brasil', -8.757485, -35.103444, '2019-03-13 08:42:05', NULL, '2019-03-13 03:12:05', '2019-03-13 03:12:05'),
(108, 'EATZILLA108', 22, 1, 0, 429.00, 42.90, 5.00, 0.00, 0.00, 391.10, 78.22, 293.32, 19.55, 'testcode', 0, 0, 1, 0, '153, Mecricar Rd, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005564, 76.954461, '2019-03-13 09:28:15', NULL, '2019-03-13 03:58:15', '2019-03-13 03:58:15'),
(109, 'EATZILLA109', 22, 12, 0, 1000.00, 0.00, 1.00, 5.00, 0.00, 1006.00, 201.20, 754.50, 50.30, 'NA', 0, 0, 1, 0, 'R. São Miguel, 201, Caetité - BA, 46400-000, Brasil', -14.074577, -42.482640, '2019-03-13 09:31:58', NULL, '2019-03-13 04:01:58', '2019-03-13 04:01:58'),
(110, 'EATZILLA110', 22, 1, 0, 858.00, 0.00, 5.00, 42.90, 10.00, 915.90, 183.18, 686.92, 45.79, 'NA', 0, 0, 1, 0, '72, RR layout, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.008930, 76.957658, '2019-03-22 16:46:13', NULL, '2019-03-22 11:16:13', '2019-03-22 11:16:13');

-- --------------------------------------------------------

--
-- Table structure for table `request_detail`
--

CREATE TABLE `request_detail` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `addon_list` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_detail`
--

INSERT INTO `request_detail` (`id`, `request_id`, `restaurant_id`, `food_id`, `quantity`, `addon_list`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 0, '2019-01-24 12:02:06', '2019-01-24 12:02:06'),
(2, 1, 1, 9, 1, 0, '2019-01-24 12:02:07', '2019-01-24 12:02:07'),
(3, 1, 1, 10, 1, 0, '2019-01-24 12:02:07', '2019-01-24 12:02:07'),
(4, 1, 1, 11, 1, 0, '2019-01-24 12:02:07', '2019-01-24 12:02:07'),
(5, 2, 1, 1, 1, 0, '2019-01-24 12:04:49', '2019-01-24 12:04:49'),
(6, 2, 1, 9, 1, 0, '2019-01-24 12:04:49', '2019-01-24 12:04:49'),
(7, 2, 1, 11, 1, 0, '2019-01-24 12:04:49', '2019-01-24 12:04:49'),
(8, 3, 1, 1, 1, 0, '2019-01-24 12:35:38', '2019-01-24 12:35:38'),
(9, 3, 1, 9, 1, 0, '2019-01-24 12:35:38', '2019-01-24 12:35:38'),
(10, 3, 1, 8, 1, 0, '2019-01-24 12:35:38', '2019-01-24 12:35:38'),
(11, 3, 1, 17, 1, 0, '2019-01-24 12:35:38', '2019-01-24 12:35:38'),
(12, 4, 1, 1, 1, 0, '2019-01-25 05:26:32', '2019-01-25 05:26:32'),
(13, 4, 1, 9, 1, 0, '2019-01-25 05:26:32', '2019-01-25 05:26:32'),
(14, 5, 1, 7, 1, 0, '2019-01-25 05:31:14', '2019-01-25 05:31:14'),
(15, 5, 1, 19, 1, 0, '2019-01-25 05:31:14', '2019-01-25 05:31:14'),
(16, 6, 1, 7, 2, 0, '2019-01-25 06:03:00', '2019-01-25 06:03:00'),
(17, 6, 1, 12, 2, 0, '2019-01-25 06:03:00', '2019-01-25 06:03:00'),
(18, 7, 1, 3, 1, 0, '2019-01-25 06:54:27', '2019-01-25 06:54:27'),
(19, 7, 1, 11, 1, 0, '2019-01-25 06:54:27', '2019-01-25 06:54:27'),
(20, 7, 1, 2, 1, 0, '2019-01-25 06:54:27', '2019-01-25 06:54:27'),
(21, 8, 1, 11, 1, 0, '2019-01-25 07:01:07', '2019-01-25 07:01:07'),
(22, 8, 1, 2, 1, 0, '2019-01-25 07:01:07', '2019-01-25 07:01:07'),
(23, 9, 1, 1, 1, 0, '2019-01-25 07:04:13', '2019-01-25 07:04:13'),
(24, 9, 1, 12, 1, 0, '2019-01-25 07:04:13', '2019-01-25 07:04:13'),
(25, 10, 1, 1, 1, 0, '2019-01-25 08:33:21', '2019-01-25 08:33:21'),
(26, 10, 1, 9, 1, 0, '2019-01-25 08:33:21', '2019-01-25 08:33:21'),
(27, 11, 1, 1, 1, 0, '2019-01-26 06:48:15', '2019-01-26 06:48:15'),
(28, 11, 1, 9, 1, 0, '2019-01-26 06:48:15', '2019-01-26 06:48:15'),
(29, 12, 2, 4, 1, 0, '2019-02-06 06:19:06', '2019-02-06 06:19:06'),
(30, 12, 2, 5, 1, 0, '2019-02-06 06:19:06', '2019-02-06 06:19:06'),
(31, 13, 1, 1, 2, 0, '2019-02-17 10:41:16', '2019-02-17 10:41:16'),
(32, 13, 1, 9, 2, 0, '2019-02-17 10:41:16', '2019-02-17 10:41:16'),
(33, 13, 1, 10, 1, 0, '2019-02-17 10:41:16', '2019-02-17 10:41:16'),
(34, 13, 1, 11, 1, 0, '2019-02-17 10:41:16', '2019-02-17 10:41:16'),
(35, 14, 1, 1, 3, 0, '2019-02-19 11:35:45', '2019-02-19 11:35:45'),
(36, 15, 2, 4, 3, 0, '2019-02-19 11:56:12', '2019-02-19 11:56:12'),
(37, 16, 1, 1, 2, 0, '2019-02-19 12:03:28', '2019-02-19 12:03:28'),
(38, 17, 1, 1, 2, 0, '2019-02-19 13:39:56', '2019-02-19 13:39:56'),
(39, 18, 1, 9, 3, 0, '2019-02-21 07:22:55', '2019-02-21 07:22:55'),
(40, 18, 1, 10, 2, 0, '2019-02-21 07:22:55', '2019-02-21 07:22:55'),
(41, 18, 1, 1, 2, 0, '2019-02-21 07:22:55', '2019-02-21 07:22:55'),
(42, 18, 1, 15, 1, 0, '2019-02-21 07:22:55', '2019-02-21 07:22:55'),
(43, 19, 1, 1, 1, 0, '2019-02-21 14:57:36', '2019-02-21 14:57:36'),
(44, 19, 1, 9, 1, 0, '2019-02-21 14:57:36', '2019-02-21 14:57:36'),
(45, 20, 1, 1, 1, 0, '2019-02-22 04:36:20', '2019-02-22 04:36:20'),
(46, 21, 2, 4, 3, 0, '2019-02-22 06:26:53', '2019-02-22 06:26:53'),
(47, 22, 1, 1, 1, 0, '2019-02-22 08:05:10', '2019-02-22 08:05:10'),
(48, 22, 1, 10, 1, 0, '2019-02-22 08:05:10', '2019-02-22 08:05:10'),
(49, 23, 2, 4, 1, 0, '2019-02-22 08:12:49', '2019-02-22 08:12:49'),
(50, 23, 2, 5, 1, 0, '2019-02-22 08:12:49', '2019-02-22 08:12:49'),
(51, 24, 1, 2, 2, 0, '2019-02-22 08:27:11', '2019-02-22 08:27:11'),
(52, 24, 1, 1, 1, 0, '2019-02-22 08:27:11', '2019-02-22 08:27:11'),
(53, 24, 1, 9, 1, 0, '2019-02-22 08:27:11', '2019-02-22 08:27:11'),
(54, 25, 1, 1, 1, 0, '2019-02-22 08:29:00', '2019-02-22 08:29:00'),
(55, 26, 1, 1, 2, 0, '2019-02-22 11:12:07', '2019-02-22 11:12:07'),
(56, 27, 1, 1, 3, 0, '2019-02-22 11:12:46', '2019-02-22 11:12:46'),
(57, 28, 1, 2, 2, 0, '2019-02-22 11:53:47', '2019-02-22 11:53:47'),
(58, 29, 1, 2, 2, 0, '2019-02-22 11:58:27', '2019-02-22 11:58:27'),
(59, 30, 1, 2, 2, 0, '2019-02-22 11:58:48', '2019-02-22 11:58:48'),
(60, 31, 1, 2, 2, 0, '2019-02-22 11:59:22', '2019-02-22 11:59:22'),
(61, 32, 1, 2, 2, 0, '2019-02-22 12:10:35', '2019-02-22 12:10:35'),
(62, 33, 1, 2, 2, 0, '2019-02-22 12:12:19', '2019-02-22 12:12:19'),
(63, 34, 1, 2, 2, 0, '2019-02-22 12:13:23', '2019-02-22 12:13:23'),
(64, 35, 1, 2, 2, 0, '2019-02-22 12:14:29', '2019-02-22 12:14:29'),
(65, 36, 1, 2, 2, 0, '2019-02-22 12:18:28', '2019-02-22 12:18:28'),
(66, 37, 1, 2, 2, 0, '2019-02-22 12:19:01', '2019-02-22 12:19:01'),
(67, 38, 1, 2, 2, 0, '2019-02-22 12:19:02', '2019-02-22 12:19:02'),
(68, 39, 1, 2, 2, 0, '2019-02-22 12:19:58', '2019-02-22 12:19:58'),
(69, 40, 1, 2, 2, 0, '2019-02-22 12:20:28', '2019-02-22 12:20:28'),
(70, 41, 1, 2, 2, 0, '2019-02-22 12:24:03', '2019-02-22 12:24:03'),
(71, 42, 1, 2, 2, 0, '2019-02-22 12:43:34', '2019-02-22 12:43:34'),
(72, 43, 1, 2, 2, 0, '2019-02-22 12:43:54', '2019-02-22 12:43:54'),
(73, 44, 1, 2, 1, 0, '2019-02-22 15:09:41', '2019-02-22 15:09:41'),
(74, 44, 1, 10, 1, 0, '2019-02-22 15:09:41', '2019-02-22 15:09:41'),
(75, 44, 1, 6, 1, 0, '2019-02-22 15:09:41', '2019-02-22 15:09:41'),
(76, 45, 1, 1, 1, 0, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(77, 45, 1, 9, 1, 0, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(78, 45, 1, 10, 1, 0, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(79, 47, 1, 1, 1, 0, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(80, 47, 1, 9, 1, 0, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(81, 47, 1, 1, 1, 0, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(82, 47, 1, 10, 1, 0, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(83, 47, 1, 9, 1, 0, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(84, 47, 1, 10, 1, 0, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(85, 48, 1, 1, 1, 0, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(86, 48, 1, 9, 1, 0, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(87, 48, 1, 10, 1, 0, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(88, 49, 1, 1, 1, 0, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(89, 49, 1, 9, 1, 0, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(90, 49, 1, 10, 1, 0, '2019-02-23 00:09:48', '2019-02-23 00:09:48'),
(91, 50, 1, 2, 2, 0, '2019-02-23 05:22:17', '2019-02-23 05:22:17'),
(92, 51, 2, 4, 1, 0, '2019-02-23 05:36:57', '2019-02-23 05:36:57'),
(93, 52, 2, 5, 5, 0, '2019-02-23 11:05:47', '2019-02-23 11:05:47'),
(94, 53, 1, 2, 2, 0, '2019-02-23 11:10:09', '2019-02-23 11:10:09'),
(95, 54, 1, 2, 2, 0, '2019-02-23 11:20:09', '2019-02-23 11:20:09'),
(96, 55, 1, 2, 2, 0, '2019-02-23 11:22:21', '2019-02-23 11:22:21'),
(97, 56, 1, 14, 1, 0, '2019-02-25 07:08:55', '2019-02-25 07:08:55'),
(98, 56, 1, 1, 1, 0, '2019-02-25 07:08:55', '2019-02-25 07:08:55'),
(99, 56, 1, 9, 1, 0, '2019-02-25 07:08:55', '2019-02-25 07:08:55'),
(100, 57, 2, 4, 1, 0, '2019-02-27 11:31:59', '2019-02-27 11:31:59'),
(101, 57, 2, 5, 1, 0, '2019-02-27 11:31:59', '2019-02-27 11:31:59'),
(102, 58, 1, 2, 2, 0, '2019-02-27 12:28:00', '2019-02-27 12:28:00'),
(103, 59, 1, 2, 2, 0, '2019-02-27 12:28:01', '2019-02-27 12:28:01'),
(104, 60, 2, 5, 5, 0, '2019-02-27 12:39:49', '2019-02-27 12:39:49'),
(105, 61, 2, 5, 5, 0, '2019-02-27 13:01:58', '2019-02-27 13:01:58'),
(106, 62, 1, 2, 2, 0, '2019-02-27 13:07:29', '2019-02-27 13:07:29'),
(107, 63, 1, 2, 2, 0, '2019-02-27 13:07:29', '2019-02-27 13:07:29'),
(108, 64, 1, 2, 2, 0, '2019-02-27 13:07:30', '2019-02-27 13:07:30'),
(109, 65, 2, 5, 1, 0, '2019-02-28 07:27:43', '2019-02-28 07:27:43'),
(110, 66, 1, 1, 1, 0, '2019-03-01 09:26:03', '2019-03-01 09:26:03'),
(111, 66, 1, 9, 2, 0, '2019-03-01 09:26:03', '2019-03-01 09:26:03'),
(112, 67, 1, 1, 2, 0, '2019-03-02 05:39:04', '2019-03-02 05:39:04'),
(113, 67, 1, 8, 1, 0, '2019-03-02 05:39:04', '2019-03-02 05:39:04'),
(114, 67, 1, 7, 1, 0, '2019-03-02 05:39:04', '2019-03-02 05:39:04'),
(115, 67, 1, 9, 1, 0, '2019-03-02 05:39:04', '2019-03-02 05:39:04'),
(116, 67, 1, 10, 1, 0, '2019-03-02 05:39:04', '2019-03-02 05:39:04'),
(117, 68, 2, 4, 1, 0, '2019-03-02 05:40:55', '2019-03-02 05:40:55'),
(118, 69, 1, 9, 1, 0, '2019-03-02 05:47:42', '2019-03-02 05:47:42'),
(119, 70, 1, 2, 2, 0, '2019-03-02 07:23:12', '2019-03-02 07:23:12'),
(120, 71, 1, 9, 5, 0, '2019-03-02 14:24:40', '2019-03-02 14:24:40'),
(121, 71, 1, 1, 7, 0, '2019-03-02 14:24:40', '2019-03-02 14:24:40'),
(122, 71, 1, 11, 3, 0, '2019-03-02 14:24:40', '2019-03-02 14:24:40'),
(123, 71, 1, 20, 5, 0, '2019-03-02 14:24:40', '2019-03-02 14:24:40'),
(124, 71, 1, 2, 3, 0, '2019-03-02 14:24:40', '2019-03-02 14:24:40'),
(125, 71, 1, 12, 7, 0, '2019-03-02 14:24:40', '2019-03-02 14:24:40'),
(126, 71, 1, 17, 3, 0, '2019-03-02 14:24:40', '2019-03-02 14:24:40'),
(127, 71, 1, 16, 2, 0, '2019-03-02 14:24:40', '2019-03-02 14:24:40'),
(128, 71, 1, 8, 2, 0, '2019-03-02 14:24:40', '2019-03-02 14:24:40'),
(129, 71, 1, 19, 8, 0, '2019-03-02 14:24:40', '2019-03-02 14:24:40'),
(130, 72, 2, 4, 5, 0, '2019-03-02 16:02:20', '2019-03-02 16:02:20'),
(131, 72, 2, 5, 9, 0, '2019-03-02 16:02:20', '2019-03-02 16:02:20'),
(132, 73, 2, 5, 1, 0, '2019-03-02 17:53:42', '2019-03-02 17:53:42'),
(133, 74, 2, 5, 1, 0, '2019-03-02 18:01:25', '2019-03-02 18:01:25'),
(134, 75, 1, 11, 1, 0, '2019-03-02 18:02:59', '2019-03-02 18:02:59'),
(135, 76, 1, 1, 1, 0, '2019-03-03 12:03:56', '2019-03-03 12:03:56'),
(136, 77, 1, 1, 1, 0, '2019-03-04 06:03:47', '2019-03-04 06:03:47'),
(137, 78, 2, 4, 4, 0, '2019-03-04 06:56:33', '2019-03-04 06:56:33'),
(138, 79, 2, 5, 5, 0, '2019-03-04 07:05:58', '2019-03-04 07:05:58'),
(139, 80, 2, 5, 1, 0, '2019-03-04 09:59:03', '2019-03-04 09:59:03'),
(140, 81, 1, 11, 3, 0, '2019-03-04 11:55:49', '2019-03-04 11:55:49'),
(141, 82, 2, 4, 3, 0, '2019-03-04 11:57:17', '2019-03-04 11:57:17'),
(142, 83, 1, 3, 1, 0, '2019-03-05 05:46:37', '2019-03-05 05:46:37'),
(143, 83, 1, 2, 1, 0, '2019-03-05 05:46:37', '2019-03-05 05:46:37'),
(144, 83, 1, 12, 1, 0, '2019-03-05 05:46:37', '2019-03-05 05:46:37'),
(145, 83, 1, 13, 1, 0, '2019-03-05 05:46:37', '2019-03-05 05:46:37'),
(146, 83, 1, 19, 1, 0, '2019-03-05 05:46:37', '2019-03-05 05:46:37'),
(147, 83, 1, 8, 1, 0, '2019-03-05 05:46:37', '2019-03-05 05:46:37'),
(148, 83, 1, 1, 1, 0, '2019-03-05 05:46:37', '2019-03-05 05:46:37'),
(149, 83, 1, 9, 1, 0, '2019-03-05 05:46:37', '2019-03-05 05:46:37'),
(150, 83, 1, 10, 1, 0, '2019-03-05 05:46:37', '2019-03-05 05:46:37'),
(151, 84, 1, 1, 1, 0, '2019-03-05 07:07:50', '2019-03-05 07:07:50'),
(152, 84, 1, 9, 1, 0, '2019-03-05 07:07:50', '2019-03-05 07:07:50'),
(153, 85, 1, 1, 1, 0, '2019-03-05 14:14:34', '2019-03-05 14:14:34'),
(154, 86, 1, 1, 1, 0, '2019-03-06 06:25:04', '2019-03-06 06:25:04'),
(155, 86, 1, 9, 1, 0, '2019-03-06 06:25:04', '2019-03-06 06:25:04'),
(156, 87, 1, 9, 1, 0, '2019-03-06 06:29:12', '2019-03-06 06:29:12'),
(157, 87, 1, 1, 1, 0, '2019-03-06 06:29:12', '2019-03-06 06:29:12'),
(158, 88, 1, 9, 1, 0, '2019-03-06 06:32:16', '2019-03-06 06:32:16'),
(159, 89, 1, 9, 1, 0, '2019-03-06 06:33:42', '2019-03-06 06:33:42'),
(160, 90, 1, 1, 1, 0, '2019-03-06 06:42:14', '2019-03-06 06:42:14'),
(161, 91, 1, 1, 1, 0, '2019-03-06 11:13:46', '2019-03-06 11:13:46'),
(162, 92, 1, 1, 1, 0, '2019-03-06 11:18:18', '2019-03-06 11:18:18'),
(163, 93, 1, 1, 1, 0, '2019-03-06 11:24:48', '2019-03-06 11:24:48'),
(164, 93, 1, 9, 1, 0, '2019-03-06 11:24:48', '2019-03-06 11:24:48'),
(165, 93, 1, 10, 1, 0, '2019-03-06 11:24:48', '2019-03-06 11:24:48'),
(166, 93, 1, 11, 1, 0, '2019-03-06 11:24:48', '2019-03-06 11:24:48'),
(167, 93, 1, 20, 1, 0, '2019-03-06 11:24:48', '2019-03-06 11:24:48'),
(168, 94, 1, 1, 1, 0, '2019-03-06 15:30:09', '2019-03-06 15:30:09'),
(169, 95, 1, 1, 1, 0, '2019-03-07 11:11:48', '2019-03-07 11:11:48'),
(170, 96, 1, 11, 1, 0, '2019-03-07 22:02:07', '2019-03-07 22:02:07'),
(171, 96, 1, 18, 1, 0, '2019-03-07 22:02:07', '2019-03-07 22:02:07'),
(172, 96, 1, 17, 1, 0, '2019-03-07 22:02:07', '2019-03-07 22:02:07'),
(173, 97, 1, 1, 1, 0, '2019-03-08 22:37:03', '2019-03-08 22:37:03'),
(174, 97, 1, 9, 1, 0, '2019-03-08 22:37:03', '2019-03-08 22:37:03'),
(175, 98, 2, 4, 1, 0, '2019-03-10 00:46:40', '2019-03-10 00:46:40'),
(176, 99, 2, 4, 12, 0, '2019-03-10 01:02:21', '2019-03-10 01:02:21'),
(177, 100, 2, 4, 1, 0, '2019-03-10 20:35:45', '2019-03-10 20:35:45'),
(178, 101, 1, 1, 1, 0, '2019-03-11 06:18:21', '2019-03-11 06:18:21'),
(179, 101, 1, 9, 1, 0, '2019-03-11 06:18:21', '2019-03-11 06:18:21'),
(180, 102, 1, 1, 3, 0, '2019-03-12 03:54:03', '2019-03-12 03:54:03'),
(181, 103, 1, 3, 1, 0, '2019-03-13 02:27:21', '2019-03-13 02:27:21'),
(182, 104, 1, 9, 1, 0, '2019-03-13 02:29:41', '2019-03-13 02:29:41'),
(183, 104, 1, 11, 1, 0, '2019-03-13 02:29:41', '2019-03-13 02:29:41'),
(184, 105, 12, 22, 2, 0, '2019-03-13 02:45:25', '2019-03-13 02:45:25'),
(185, 105, 12, 21, 1, 0, '2019-03-13 02:45:25', '2019-03-13 02:45:25'),
(186, 106, 2, 5, 2, 0, '2019-03-13 03:10:43', '2019-03-13 03:10:43'),
(187, 107, 2, 4, 5, 0, '2019-03-13 03:12:05', '2019-03-13 03:12:05'),
(188, 107, 2, 5, 1, 0, '2019-03-13 03:12:05', '2019-03-13 03:12:05'),
(189, 108, 1, 1, 1, 0, '2019-03-13 03:58:15', '2019-03-13 03:58:15'),
(190, 108, 1, 9, 1, 0, '2019-03-13 03:58:15', '2019-03-13 03:58:15'),
(191, 108, 1, 10, 1, 0, '2019-03-13 03:58:15', '2019-03-13 03:58:15'),
(192, 109, 12, 21, 2, 0, '2019-03-13 04:01:58', '2019-03-13 04:01:58'),
(193, 110, 1, 10, 2, 0, '2019-03-22 11:16:13', '2019-03-22 11:16:13'),
(194, 110, 1, 1, 2, 0, '2019-03-22 11:16:13', '2019-03-22 11:16:13'),
(195, 110, 1, 9, 2, 0, '2019-03-22 11:16:13', '2019-03-22 11:16:13');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `restaurant_name` varchar(100) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `discount` varchar(100) NOT NULL DEFAULT '0',
  `discount_type` varchar(11) NOT NULL,
  `target_amount` varchar(100) NOT NULL,
  `offer_amount` varchar(100) NOT NULL,
  `admin_commision` varchar(50) NOT NULL,
  `shop_description` varchar(300) DEFAULT NULL,
  `rating` double(2,1) NOT NULL DEFAULT '5.0',
  `is_open` int(11) NOT NULL DEFAULT '0' COMMENT '1 - open, 0- closed',
  `estimated_delivery_time` varchar(100) NOT NULL DEFAULT '15-25 mins',
  `packaging_charge` double(6,2) NOT NULL DEFAULT '0.00',
  `address` varchar(350) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  `lat` double(10,8) NOT NULL DEFAULT '0.00000000',
  `lng` double(10,8) NOT NULL DEFAULT '0.00000000',
  `opening_time` time DEFAULT NULL,
  `closing_time` time DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `restaurant_name`, `image`, `email`, `phone`, `discount`, `discount_type`, `target_amount`, `offer_amount`, `admin_commision`, `shop_description`, `rating`, `is_open`, `estimated_delivery_time`, `packaging_charge`, `address`, `city`, `area`, `lat`, `lng`, `opening_time`, `closing_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 'KFC', 'http://54.218.62.130/eatzilla/public/restaurant_uploads/dsdfKcxbXt1PObXfIxgg6agu0SVGo0PC.jpg', 'kfc@gmail.com', '12345', '0', '1', '2', '2', '2', 'El mejor restaurante de la zona', 5.0, 0, '15-25 mins', 5.00, 'Cordoba', '1', '2', 11.01268300, 76.98948700, '00:00:09', '00:00:21', 1, '2018-08-10 06:29:25', '2019-03-19 17:23:38'),
(2, 'McDonalds', 'http://54.218.62.130/eatzilla/public/restaurant_uploads/qa9JZFQQ0ZRGoqqa3S7oAtKEHoUxMEcc.jpg', 'macd@gmail.com', '123456', '0', '', '', '', '', '', 3.4, 1, '15-25 mins', 10.00, 'RS Puram, Coimbatore', '', '', 11.01268300, 76.98948700, '00:00:00', '00:00:00', 0, '2018-08-10 06:48:07', '2019-03-01 21:38:35'),
(3, 'Pizza Hut', 'http://54.218.62.130/eatzilla/public/restaurant_uploads/n66tRuk1gsi2xEe6CUWxyB0g9pHqGi04.jpg', 'pizzahut@gmail.com', '12345', '0', '', '', '', '', '', 4.5, 1, '15-25 mins', 0.00, 'Gandhipuram, Coimbatore', '', '', 11.01268300, 76.98948700, '10:00:00', '20:00:00', 1, '2018-08-10 06:49:20', '2018-12-11 19:38:20'),
(4, 'Aasife Biriyani', 'http://54.218.62.130/eatzilla/public/restaurant_uploads/s3SdgpodTq3IC0XkxdBDoS8pL4694WMx.jpg', 'dominos@gmail.com', '12345', '0', '', '', '', '', '', 5.0, 1, '20-25 mins', 10.00, 'RS Puram, Coimbatore', '', '', 11.01268300, 0.00000000, '10:00:00', '21:00:00', 1, '2018-08-31 05:19:31', '2018-12-11 19:40:29'),
(5, 'Papa Johns', 'http://54.218.62.130/eatzilla/public/restaurant_uploads/sk9mqFpOeAqPSy3R5GtjoRJCs5kPvazY.jpg', 'papajohns@gmail.com', '12345678', '0', '', '', '', '', '', 5.0, 0, '20-45 mins', 10.00, '148/112, Above More Mall, Bannerghatta Main Rd, NS Palya, Bengaluru, Karnataka', '', '', 11.01268300, 0.00000000, '10:00:00', '22:00:00', 1, '2018-11-15 11:37:40', '2019-03-01 20:38:03'),
(6, 'Don Zenon', 'http://54.218.62.130/eatzilla/public/restaurant_uploads/pnSUG058ReiMzAttlPtIeOUtq8K7lqgK.png', 'vicof09@gmail.com', '9600771099', '0', '', '', '', '', '', 5.0, 0, '30 mins', 13.00, 'Cordoba', '', '', 0.00000000, 0.00000000, '08:00:00', '21:00:00', 1, '2019-02-27 12:01:28', '2019-03-01 20:38:43'),
(7, 'Todo ya', 'http://54.218.62.130/eatzilla/public/restaurant_uploads/3Y6xEKlUXAi8EvgMX5UmDvSumXlPNTNQ.jpg', 'vicof09@gmail.com', '9600771099', '0', '', '', '', '', 'Italia: la comida italiana ha esclavizado paladares alrededor del mundo durante siglos, con sus deliciosas salsas de tomate, esas creaciones inteligentes que hacen con la harina de trigo (pizza) y los postres que básicamente son vehículos para la crema.', 5.0, 0, '30 mins mins', 2.00, 'Malet St\r\nBloomsbury, London WC1E 7HU, UK', '', '', 0.00000000, 0.00000000, '00:00:00', '20:00:00', 1, '2019-03-01 19:51:14', '2019-03-01 19:51:14'),
(8, 'Los Alamos', 'http://54.218.62.130/eatzilla/public/restaurant_uploads/GQxQ1nHQb4vaYL5g69vZNBpdGiPAUc0A.jpg', 'francovico34@gmail.com', '12345', '0', '', '', '', '', 'Malet St\r\nBloomsbury, London WC1E 7HU, UK', 5.0, 0, '15-25 mins mins', 6.00, 'Malet St\r\nBloomsbury, London WC1E 7HU, UK', '', '', 0.00000000, 0.00000000, '00:00:00', '00:00:00', 1, '2019-03-01 19:52:01', '2019-03-01 19:52:01'),
(9, 'Carne asada', 'http://54.218.62.130/eatzilla/public/restaurant_uploads/Qb81Hfl6Cs3OmuLvqHNok4g50TLnYujP.jpg', 'kfc@gmail.com', '9600771099', '0', '', '', '', '', '1. Italia: la comida italiana ha esclavizado paladares alrededor del mundo durante siglos, con sus deliciosas salsas de tomate, esas creaciones inteligentes que hacen con la harina de trigo (pizza) y los postres que básicamente son vehículos para la crema.', 5.0, 0, '30 mins mins', 6.00, 'Cordoba', '', '', 0.00000000, 0.00000000, '00:00:00', '00:00:00', 1, '2019-03-01 19:52:59', '2019-03-02 01:23:18'),
(10, 'La villa', 'http://54.218.62.130/eatzilla/public/restaurant_uploads/aQb1QTpkyOMja1hQvHzZStWUYeoR7rrh.jpg', 'francovico34@gmail.com', '9600771099', '15', '', '', '', '', '1. Italia: la comida italiana ha esclavizado paladares alrededor del mundo durante siglos, con sus deliciosas salsas de tomate, esas creaciones inteligentes que hacen con la harina de trigo (pizza) y los postres que básicamente son vehículos para la crema.', 5.0, 0, '15-25 mins mins', 2.00, 'Cordoba', '', '', 0.00000000, 0.00000000, '08:00:00', '23:00:00', 1, '2019-03-01 19:56:00', '2019-03-01 19:56:00'),
(12, 'Brazil test 1', 'http://54.218.62.130/eatzilla/public/restaurant_uploads/TSImejZ6UtfLX1NXtzm5sUlfU7aFJTyD.png', 'baima@prazeremservir.com.br', '8533333333', '0', '', '', '', '', 'Best Meal in town', 5.0, 1, '15-25 mins', 1.00, 'Rua Gal. Melo machado, 50, Aldeota Fortaleza Ceará 60.125-200', '', '', 0.00000000, 0.00000000, '08:00:00', '22:00:00', 1, '2019-03-11 18:23:22', '2019-03-12 00:10:56');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_cuisines`
--

CREATE TABLE `restaurant_cuisines` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `cuisine_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant_cuisines`
--

INSERT INTO `restaurant_cuisines` (`id`, `restaurant_id`, `cuisine_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2018-08-10 06:51:27', '2018-08-10 06:51:27'),
(4, 2, 1, '2018-08-10 06:51:52', '2018-08-10 06:51:52'),
(5, 2, 2, '2018-08-10 06:52:00', '2018-08-10 06:52:00'),
(6, 2, 4, '2018-08-10 06:52:21', '2018-08-10 06:52:21'),
(7, 3, 4, '2018-08-10 06:52:36', '2018-08-10 06:52:36'),
(8, 3, 5, '2018-08-10 06:52:43', '2018-08-10 06:52:43'),
(9, 1, 4, '2019-02-28 20:17:56', '2019-02-28 20:17:56'),
(10, 1, 7, '2019-03-09 20:45:30', '2019-03-09 20:45:30'),
(11, 1, 5, '2019-03-11 19:34:27', '2019-03-11 19:34:27'),
(12, 12, 7, '2019-03-11 19:41:20', '2019-03-11 19:41:20');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key_word` varchar(50) NOT NULL,
  `value` varchar(100) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key_word`, `value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin_commission', '20', 1, '2018-09-30 17:57:23', '2018-09-30 17:57:23'),
(2, 'restaurant_commission', '75', 1, '2018-09-30 17:58:08', '2018-09-30 17:58:08'),
(3, 'delivery_boy_commission', '5', 1, '2018-09-30 17:58:08', '2018-09-30 17:58:08'),
(4, 'stripe_sk_key', 'sk_test_BlD4SrbP60Qa94PrQ1pTHYtB', 1, '2019-03-11 18:42:58', '2019-03-11 18:42:58'),
(5, 'stripe_pk_key', 'pk_test_uzFnOtl3tNwStqKIi5Vflq61', 1, '2019-03-11 18:43:19', '2019-03-11 18:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `track_order_status`
--

CREATE TABLE `track_order_status` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `detail` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `track_order_status`
--

INSERT INTO `track_order_status` (`id`, `request_id`, `status`, `detail`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Order Placed', '2019-01-24 12:02:07', '2019-01-24 12:02:07'),
(2, 2, 0, 'Order Placed', '2019-01-24 12:04:49', '2019-01-24 12:04:49'),
(3, 2, 1, 'Order Accepted by Restaurant', '2019-01-24 12:05:21', '2019-01-24 12:05:21'),
(4, 2, 2, 'Food is being prepared', '2019-01-24 12:05:26', '2019-01-24 12:05:26'),
(5, 2, 3, 'Delivery Boy Started towards Restaurant', '2019-01-24 12:05:31', '2019-01-24 12:05:31'),
(6, 2, 4, 'Delivery Boy Reached restaurant', '2019-01-24 12:05:40', '2019-01-24 12:05:40'),
(7, 2, 5, 'Started towards Customer', '2019-01-24 12:05:42', '2019-01-24 12:05:42'),
(8, 2, 6, 'Food delivered', '2019-01-24 12:05:44', '2019-01-24 12:05:44'),
(9, 2, 7, 'Cash Received. Order Completed', '2019-01-24 12:05:47', '2019-01-24 12:05:47'),
(10, 3, 0, 'Order Placed', '2019-01-24 12:35:39', '2019-01-24 12:35:39'),
(11, 3, 1, 'Order Accepted by Restaurant', '2019-01-24 12:41:10', '2019-01-24 12:41:10'),
(12, 3, 2, 'Food is being prepared', '2019-01-24 12:42:18', '2019-01-24 12:42:18'),
(13, 3, 3, 'Delivery Boy Started towards Restaurant', '2019-01-24 12:45:37', '2019-01-24 12:45:37'),
(14, 3, 4, 'Delivery Boy Reached restaurant', '2019-01-24 12:47:25', '2019-01-24 12:47:25'),
(15, 3, 5, 'Started towards Customer', '2019-01-24 12:48:05', '2019-01-24 12:48:05'),
(16, 3, 6, 'Food delivered', '2019-01-24 12:48:17', '2019-01-24 12:48:17'),
(17, 3, 7, 'Cash Received. Order Completed', '2019-01-24 12:48:24', '2019-01-24 12:48:24'),
(18, 4, 0, 'Order Placed', '2019-01-25 05:26:32', '2019-01-25 05:26:32'),
(19, 4, 1, 'Order Accepted by Restaurant', '2019-01-25 05:27:40', '2019-01-25 05:27:40'),
(20, 4, 2, 'Food is being prepared', '2019-01-25 05:28:10', '2019-01-25 05:28:10'),
(21, 4, 3, 'Delivery Boy Started towards Restaurant', '2019-01-25 05:28:25', '2019-01-25 05:28:25'),
(22, 4, 4, 'Delivery Boy Reached restaurant', '2019-01-25 05:28:38', '2019-01-25 05:28:38'),
(23, 4, 5, 'Started towards Customer', '2019-01-25 05:28:59', '2019-01-25 05:28:59'),
(24, 4, 6, 'Food delivered', '2019-01-25 05:29:00', '2019-01-25 05:29:00'),
(25, 4, 7, 'Cash Received. Order Completed', '2019-01-25 05:29:16', '2019-01-25 05:29:16'),
(26, 5, 0, 'Order Placed', '2019-01-25 05:32:01', '2019-01-25 05:32:01'),
(27, 5, 1, 'Order Accepted by Restaurant', '2019-01-25 05:32:53', '2019-01-25 05:32:53'),
(28, 5, 2, 'Food is being prepared', '2019-01-25 05:32:59', '2019-01-25 05:32:59'),
(29, 5, 3, 'Delivery Boy Started towards Restaurant', '2019-01-25 05:33:05', '2019-01-25 05:33:05'),
(30, 5, 4, 'Delivery Boy Reached restaurant', '2019-01-25 05:33:21', '2019-01-25 05:33:21'),
(31, 5, 5, 'Started towards Customer', '2019-01-25 05:33:44', '2019-01-25 05:33:44'),
(32, 5, 6, 'Food delivered', '2019-01-25 05:34:09', '2019-01-25 05:34:09'),
(33, 5, 7, 'Cash Received. Order Completed', '2019-01-25 05:34:11', '2019-01-25 05:34:11'),
(34, 6, 0, 'Order Placed', '2019-01-25 06:03:00', '2019-01-25 06:03:00'),
(35, 6, 1, 'Order Accepted by Restaurant', '2019-01-25 06:03:27', '2019-01-25 06:03:27'),
(36, 6, 2, 'Food is being prepared', '2019-01-25 06:03:45', '2019-01-25 06:03:45'),
(37, 6, 3, 'Delivery Boy Started towards Restaurant', '2019-01-25 06:04:46', '2019-01-25 06:04:46'),
(38, 6, 4, 'Delivery Boy Reached restaurant', '2019-01-25 06:04:48', '2019-01-25 06:04:48'),
(39, 6, 5, 'Started towards Customer', '2019-01-25 06:04:50', '2019-01-25 06:04:50'),
(40, 6, 6, 'Food delivered', '2019-01-25 06:04:51', '2019-01-25 06:04:51'),
(41, 6, 7, 'Cash Received. Order Completed', '2019-01-25 06:04:52', '2019-01-25 06:04:52'),
(42, 7, 0, 'Order Placed', '2019-01-25 06:54:27', '2019-01-25 06:54:27'),
(43, 7, 1, 'Order Accepted by Restaurant', '2019-01-25 06:55:01', '2019-01-25 06:55:01'),
(44, 7, 2, 'Food is being prepared', '2019-01-25 06:55:08', '2019-01-25 06:55:08'),
(45, 7, 3, 'Delivery Boy Started towards Restaurant', '2019-01-25 06:55:16', '2019-01-25 06:55:16'),
(46, 7, 4, 'Delivery Boy Reached restaurant', '2019-01-25 06:55:18', '2019-01-25 06:55:18'),
(47, 7, 5, 'Started towards Customer', '2019-01-25 06:55:19', '2019-01-25 06:55:19'),
(48, 7, 6, 'Food delivered', '2019-01-25 06:55:20', '2019-01-25 06:55:20'),
(49, 7, 7, 'Cash Received. Order Completed', '2019-01-25 06:55:22', '2019-01-25 06:55:22'),
(50, 8, 0, 'Order Placed', '2019-01-25 07:01:07', '2019-01-25 07:01:07'),
(51, 8, 1, 'Order Accepted by Restaurant', '2019-01-25 07:01:41', '2019-01-25 07:01:41'),
(52, 8, 2, 'Food is being prepared', '2019-01-25 07:02:05', '2019-01-25 07:02:05'),
(53, 8, 3, 'Delivery Boy Started towards Restaurant', '2019-01-25 07:02:07', '2019-01-25 07:02:07'),
(54, 8, 4, 'Delivery Boy Reached restaurant', '2019-01-25 07:02:09', '2019-01-25 07:02:09'),
(55, 8, 5, 'Started towards Customer', '2019-01-25 07:02:11', '2019-01-25 07:02:11'),
(56, 8, 6, 'Food delivered', '2019-01-25 07:02:12', '2019-01-25 07:02:12'),
(57, 8, 7, 'Cash Received. Order Completed', '2019-01-25 07:02:14', '2019-01-25 07:02:14'),
(58, 9, 0, 'Order Placed', '2019-01-25 07:04:13', '2019-01-25 07:04:13'),
(59, 9, 1, 'Order Accepted by Restaurant', '2019-01-25 07:04:46', '2019-01-25 07:04:46'),
(60, 9, 2, 'Food is being prepared', '2019-01-25 07:05:07', '2019-01-25 07:05:07'),
(61, 9, 3, 'Delivery Boy Started towards Restaurant', '2019-01-25 07:05:29', '2019-01-25 07:05:29'),
(62, 9, 4, 'Delivery Boy Reached restaurant', '2019-01-25 07:05:57', '2019-01-25 07:05:57'),
(63, 9, 5, 'Started towards Customer', '2019-01-25 07:06:14', '2019-01-25 07:06:14'),
(64, 9, 6, 'Food delivered', '2019-01-25 07:06:34', '2019-01-25 07:06:34'),
(65, 9, 7, 'Cash Received. Order Completed', '2019-01-25 07:06:51', '2019-01-25 07:06:51'),
(66, 10, 0, 'Order Placed', '2019-01-25 08:33:21', '2019-01-25 08:33:21'),
(67, 10, 1, 'Order Accepted by Restaurant', '2019-01-25 08:39:30', '2019-01-25 08:39:30'),
(68, 10, 2, 'Food is being prepared', '2019-01-25 08:39:57', '2019-01-25 08:39:57'),
(69, 10, 3, 'Delivery Boy Started towards Restaurant', '2019-01-25 08:40:15', '2019-01-25 08:40:15'),
(70, 10, 4, 'Delivery Boy Reached restaurant', '2019-01-25 08:40:17', '2019-01-25 08:40:17'),
(71, 10, 5, 'Started towards Customer', '2019-01-25 08:40:18', '2019-01-25 08:40:18'),
(72, 10, 6, 'Food delivered', '2019-01-25 08:40:20', '2019-01-25 08:40:20'),
(73, 10, 7, 'Cash Received. Order Completed', '2019-01-25 08:40:21', '2019-01-25 08:40:21'),
(74, 11, 0, 'Order Placed', '2019-01-26 06:48:16', '2019-01-26 06:48:16'),
(75, 11, 1, 'Order Accepted by Restaurant', '2019-01-26 06:51:47', '2019-01-26 06:51:47'),
(76, 11, 2, 'Food is being prepared', '2019-01-26 06:52:00', '2019-01-26 06:52:00'),
(77, 11, 3, 'Delivery Boy Started towards Restaurant', '2019-01-26 06:52:05', '2019-01-26 06:52:05'),
(78, 11, 4, 'Delivery Boy Reached restaurant', '2019-01-26 06:53:39', '2019-01-26 06:53:39'),
(79, 11, 5, 'Started towards Customer', '2019-01-26 06:53:40', '2019-01-26 06:53:40'),
(80, 11, 6, 'Food delivered', '2019-01-26 06:54:20', '2019-01-26 06:54:20'),
(81, 11, 7, 'Cash Received. Order Completed', '2019-01-26 06:54:23', '2019-01-26 06:54:23'),
(82, 12, 0, 'Order Placed', '2019-02-06 06:19:07', '2019-02-06 06:19:07'),
(83, 12, 1, 'Order Accepted by Restaurant', '2019-02-13 13:00:25', '2019-02-13 13:00:25'),
(84, 12, 2, 'Food is being prepared', '2019-02-15 09:14:16', '2019-02-15 09:14:16'),
(85, 12, 3, 'Delivery Boy Started towards Restaurant', '2019-02-15 09:14:20', '2019-02-15 09:14:20'),
(86, 12, 4, 'Delivery Boy Reached restaurant', '2019-02-15 09:44:42', '2019-02-15 09:44:42'),
(87, 12, 5, 'Started towards Customer', '2019-02-15 09:44:43', '2019-02-15 09:44:43'),
(88, 12, 6, 'Food delivered', '2019-02-15 09:44:51', '2019-02-15 09:44:51'),
(89, 12, 7, 'Cash Received. Order Completed', '2019-02-15 09:44:54', '2019-02-15 09:44:54'),
(90, 1, 1, 'Order Accepted by Restaurant', '2019-02-15 09:49:07', '2019-02-15 09:49:07'),
(91, 1, 2, 'Food is being prepared', '2019-02-15 09:49:14', '2019-02-15 09:49:14'),
(92, 1, 3, 'Delivery Boy Started towards Restaurant', '2019-02-15 09:55:13', '2019-02-15 09:55:13'),
(93, 1, 4, 'Delivery Boy Reached restaurant', '2019-02-15 09:55:13', '2019-02-15 09:55:13'),
(94, 1, 5, 'Started towards Customer', '2019-02-15 09:55:14', '2019-02-15 09:55:14'),
(95, 1, 6, 'Food delivered', '2019-02-15 09:55:15', '2019-02-15 09:55:15'),
(96, 1, 7, 'Cash Received. Order Completed', '2019-02-15 09:55:17', '2019-02-15 09:55:17'),
(97, 13, 0, 'Order Placed', '2019-02-17 10:41:16', '2019-02-17 10:41:16'),
(98, 14, 0, 'Order Placed', '2019-02-19 11:35:46', '2019-02-19 11:35:46'),
(99, 14, 1, 'Order Accepted by Restaurant', '2019-02-19 11:53:14', '2019-02-19 11:53:14'),
(100, 14, 2, 'Food is being prepared', '2019-02-19 11:53:25', '2019-02-19 11:53:25'),
(101, 15, 0, 'Order Placed', '2019-02-19 11:56:12', '2019-02-19 11:56:12'),
(102, 15, 1, 'Order Accepted by Restaurant', '2019-02-19 11:57:56', '2019-02-19 11:57:56'),
(103, 15, 2, 'Food is being prepared', '2019-02-19 11:58:43', '2019-02-19 11:58:43'),
(104, 14, 3, 'Delivery Boy Started towards Restaurant', '2019-02-19 11:58:57', '2019-02-19 11:58:57'),
(105, 14, 4, 'Delivery Boy Reached restaurant', '2019-02-19 11:59:19', '2019-02-19 11:59:19'),
(106, 14, 5, 'Started towards Customer', '2019-02-19 11:59:41', '2019-02-19 11:59:41'),
(107, 14, 6, 'Food delivered', '2019-02-19 12:00:17', '2019-02-19 12:00:17'),
(108, 14, 7, 'Cash Received. Order Completed', '2019-02-19 12:00:36', '2019-02-19 12:00:36'),
(109, 15, 3, 'Delivery Boy Started towards Restaurant', '2019-02-19 12:00:46', '2019-02-19 12:00:46'),
(110, 15, 4, 'Delivery Boy Reached restaurant', '2019-02-19 12:01:01', '2019-02-19 12:01:01'),
(111, 15, 5, 'Started towards Customer', '2019-02-19 12:01:12', '2019-02-19 12:01:12'),
(112, 15, 6, 'Food delivered', '2019-02-19 12:01:17', '2019-02-19 12:01:17'),
(113, 15, 7, 'Cash Received. Order Completed', '2019-02-19 12:01:22', '2019-02-19 12:01:22'),
(114, 16, 0, 'Order Placed', '2019-02-19 12:03:28', '2019-02-19 12:03:28'),
(115, 16, 1, 'Order Accepted by Restaurant', '2019-02-19 12:05:17', '2019-02-19 12:05:17'),
(116, 16, 1, 'Order Accepted by Restaurant', '2019-02-19 12:05:22', '2019-02-19 12:05:22'),
(117, 16, 1, 'Order Accepted by Restaurant', '2019-02-19 12:05:28', '2019-02-19 12:05:28'),
(118, 16, 1, 'Order Accepted by Restaurant', '2019-02-19 12:05:37', '2019-02-19 12:05:37'),
(119, 16, 2, 'Food is being prepared', '2019-02-19 12:05:42', '2019-02-19 12:05:42'),
(120, 16, 1, 'Order Accepted by Restaurant', '2019-02-19 12:06:56', '2019-02-19 12:06:56'),
(121, 17, 0, 'Order Placed', '2019-02-19 13:39:56', '2019-02-19 13:39:56'),
(122, 18, 0, 'Order Placed', '2019-02-21 07:22:55', '2019-02-21 07:22:55'),
(123, 19, 0, 'Order Placed', '2019-02-21 14:57:36', '2019-02-21 14:57:36'),
(124, 20, 0, 'Order Placed', '2019-02-22 04:36:20', '2019-02-22 04:36:20'),
(125, 21, 0, 'Order Placed', '2019-02-22 06:26:53', '2019-02-22 06:26:53'),
(126, 21, 1, 'Order Accepted by Restaurant', '2019-02-22 06:38:42', '2019-02-22 06:38:42'),
(127, 21, 2, 'Food is being prepared', '2019-02-22 06:38:57', '2019-02-22 06:38:57'),
(128, 21, 3, 'Delivery Boy Started towards Restaurant', '2019-02-22 06:39:05', '2019-02-22 06:39:05'),
(129, 21, 4, 'Delivery Boy Reached restaurant', '2019-02-22 06:39:17', '2019-02-22 06:39:17'),
(130, 21, 5, 'Started towards Customer', '2019-02-22 06:39:35', '2019-02-22 06:39:35'),
(131, 21, 6, 'Food delivered', '2019-02-22 06:39:46', '2019-02-22 06:39:46'),
(132, 21, 7, 'Cash Received. Order Completed', '2019-02-22 06:39:53', '2019-02-22 06:39:53'),
(133, 17, 1, 'Order Accepted by Restaurant', '2019-02-22 06:44:16', '2019-02-22 06:44:16'),
(134, 17, 2, 'Food is being prepared', '2019-02-22 06:44:38', '2019-02-22 06:44:38'),
(135, 17, 3, 'Delivery Boy Started towards Restaurant', '2019-02-22 06:45:27', '2019-02-22 06:45:27'),
(136, 17, 4, 'Delivery Boy Reached restaurant', '2019-02-22 06:46:15', '2019-02-22 06:46:15'),
(137, 17, 5, 'Started towards Customer', '2019-02-22 06:47:10', '2019-02-22 06:47:10'),
(138, 17, 6, 'Food delivered', '2019-02-22 06:47:13', '2019-02-22 06:47:13'),
(139, 17, 7, 'Cash Received. Order Completed', '2019-02-22 06:47:41', '2019-02-22 06:47:41'),
(140, 16, 3, 'Delivery Boy Started towards Restaurant', '2019-02-22 06:49:31', '2019-02-22 06:49:31'),
(141, 16, 4, 'Delivery Boy Reached restaurant', '2019-02-22 06:49:35', '2019-02-22 06:49:35'),
(142, 16, 5, 'Started towards Customer', '2019-02-22 06:50:06', '2019-02-22 06:50:06'),
(143, 16, 6, 'Food delivered', '2019-02-22 06:50:30', '2019-02-22 06:50:30'),
(144, 16, 7, 'Cash Received. Order Completed', '2019-02-22 06:52:30', '2019-02-22 06:52:30'),
(145, 22, 0, 'Order Placed', '2019-02-22 08:05:10', '2019-02-22 08:05:10'),
(146, 22, 1, 'Order Accepted by Restaurant', '2019-02-22 08:10:46', '2019-02-22 08:10:46'),
(147, 22, 2, 'Food is being prepared', '2019-02-22 08:10:54', '2019-02-22 08:10:54'),
(148, 22, 3, 'Delivery Boy Started towards Restaurant', '2019-02-22 08:10:58', '2019-02-22 08:10:58'),
(149, 22, 4, 'Delivery Boy Reached restaurant', '2019-02-22 08:11:04', '2019-02-22 08:11:04'),
(150, 22, 5, 'Started towards Customer', '2019-02-22 08:11:08', '2019-02-22 08:11:08'),
(151, 22, 6, 'Food delivered', '2019-02-22 08:11:11', '2019-02-22 08:11:11'),
(152, 22, 7, 'Cash Received. Order Completed', '2019-02-22 08:11:14', '2019-02-22 08:11:14'),
(153, 23, 0, 'Order Placed', '2019-02-22 08:12:49', '2019-02-22 08:12:49'),
(154, 23, 1, 'Order Accepted by Restaurant', '2019-02-22 08:13:05', '2019-02-22 08:13:05'),
(155, 23, 2, 'Food is being prepared', '2019-02-22 08:13:11', '2019-02-22 08:13:11'),
(156, 23, 3, 'Delivery Boy Started towards Restaurant', '2019-02-22 08:13:14', '2019-02-22 08:13:14'),
(157, 23, 4, 'Delivery Boy Reached restaurant', '2019-02-22 08:17:16', '2019-02-22 08:17:16'),
(158, 23, 5, 'Started towards Customer', '2019-02-22 08:19:00', '2019-02-22 08:19:00'),
(159, 23, 6, 'Food delivered', '2019-02-22 08:19:31', '2019-02-22 08:19:31'),
(160, 24, 0, 'Order Placed', '2019-02-22 08:27:11', '2019-02-22 08:27:11'),
(161, 25, 0, 'Order Placed', '2019-02-22 08:29:00', '2019-02-22 08:29:00'),
(162, 26, 0, 'Order Placed', '2019-02-22 11:12:08', '2019-02-22 11:12:08'),
(163, 27, 0, 'Order Placed', '2019-02-22 11:12:46', '2019-02-22 11:12:46'),
(164, 24, 1, 'Order Accepted by Restaurant', '2019-02-22 11:52:28', '2019-02-22 11:52:28'),
(165, 27, 1, 'Order Accepted by Restaurant', '2019-02-22 11:52:58', '2019-02-22 11:52:58'),
(166, 28, 0, 'Order Placed', '2019-02-22 11:53:48', '2019-02-22 11:53:48'),
(167, 29, 0, 'Order Placed', '2019-02-22 11:58:27', '2019-02-22 11:58:27'),
(168, 30, 0, 'Order Placed', '2019-02-22 11:58:48', '2019-02-22 11:58:48'),
(169, 31, 0, 'Order Placed', '2019-02-22 11:59:22', '2019-02-22 11:59:22'),
(170, 32, 0, 'Order Placed', '2019-02-22 12:10:35', '2019-02-22 12:10:35'),
(171, 33, 0, 'Order Placed', '2019-02-22 12:12:19', '2019-02-22 12:12:19'),
(172, 34, 0, 'Order Placed', '2019-02-22 12:13:23', '2019-02-22 12:13:23'),
(173, 35, 0, 'Order Placed', '2019-02-22 12:14:29', '2019-02-22 12:14:29'),
(174, 36, 0, 'Order Placed', '2019-02-22 12:18:28', '2019-02-22 12:18:28'),
(175, 37, 0, 'Order Placed', '2019-02-22 12:19:01', '2019-02-22 12:19:01'),
(176, 38, 0, 'Order Placed', '2019-02-22 12:19:02', '2019-02-22 12:19:02'),
(177, 39, 0, 'Order Placed', '2019-02-22 12:19:58', '2019-02-22 12:19:58'),
(178, 40, 0, 'Order Placed', '2019-02-22 12:20:29', '2019-02-22 12:20:29'),
(179, 41, 0, 'Order Placed', '2019-02-22 12:24:03', '2019-02-22 12:24:03'),
(180, 42, 0, 'Order Placed', '2019-02-22 12:43:34', '2019-02-22 12:43:34'),
(181, 43, 0, 'Order Placed', '2019-02-22 12:43:54', '2019-02-22 12:43:54'),
(182, 43, 1, 'Order Accepted by Restaurant', '2019-02-22 12:45:38', '2019-02-22 12:45:38'),
(183, 43, 1, 'Order Accepted by Restaurant', '2019-02-22 12:45:44', '2019-02-22 12:45:44'),
(184, 43, 1, 'Order Accepted by Restaurant', '2019-02-22 12:46:23', '2019-02-22 12:46:23'),
(185, 42, 1, 'Order Accepted by Restaurant', '2019-02-22 12:46:51', '2019-02-22 12:46:51'),
(186, 23, 7, 'Cash Received. Order Completed', '2019-02-22 14:53:39', '2019-02-22 14:53:39'),
(187, 43, 2, 'Food is being prepared', '2019-02-22 14:55:04', '2019-02-22 14:55:04'),
(188, 43, 3, 'Delivery Boy Started towards Restaurant', '2019-02-22 14:55:07', '2019-02-22 14:55:07'),
(189, 43, 4, 'Delivery Boy Reached restaurant', '2019-02-22 14:55:09', '2019-02-22 14:55:09'),
(190, 43, 5, 'Started towards Customer', '2019-02-22 14:55:11', '2019-02-22 14:55:11'),
(191, 43, 6, 'Food delivered', '2019-02-22 14:55:12', '2019-02-22 14:55:12'),
(192, 43, 7, 'Cash Received. Order Completed', '2019-02-22 14:55:14', '2019-02-22 14:55:14'),
(193, 42, 2, 'Food is being prepared', '2019-02-22 14:55:34', '2019-02-22 14:55:34'),
(194, 42, 3, 'Delivery Boy Started towards Restaurant', '2019-02-22 14:55:37', '2019-02-22 14:55:37'),
(195, 42, 4, 'Delivery Boy Reached restaurant', '2019-02-22 14:55:38', '2019-02-22 14:55:38'),
(196, 42, 5, 'Started towards Customer', '2019-02-22 14:55:40', '2019-02-22 14:55:40'),
(197, 42, 6, 'Food delivered', '2019-02-22 14:55:41', '2019-02-22 14:55:41'),
(198, 42, 7, 'Cash Received. Order Completed', '2019-02-22 14:55:42', '2019-02-22 14:55:42'),
(199, 18, 1, 'Order Accepted by Restaurant', '2019-02-22 14:56:04', '2019-02-22 14:56:04'),
(200, 41, 1, 'Order Accepted by Restaurant', '2019-02-22 14:56:08', '2019-02-22 14:56:08'),
(201, 41, 1, 'Order Accepted by Restaurant', '2019-02-22 14:56:12', '2019-02-22 14:56:12'),
(202, 41, 1, 'Order Accepted by Restaurant', '2019-02-22 14:56:21', '2019-02-22 14:56:21'),
(203, 18, 1, 'Order Accepted by Restaurant', '2019-02-22 14:56:32', '2019-02-22 14:56:32'),
(204, 41, 2, 'Food is being prepared', '2019-02-22 14:58:47', '2019-02-22 14:58:47'),
(205, 41, 3, 'Delivery Boy Started towards Restaurant', '2019-02-22 14:58:49', '2019-02-22 14:58:49'),
(206, 41, 4, 'Delivery Boy Reached restaurant', '2019-02-22 14:58:51', '2019-02-22 14:58:51'),
(207, 41, 5, 'Started towards Customer', '2019-02-22 14:58:52', '2019-02-22 14:58:52'),
(208, 41, 6, 'Food delivered', '2019-02-22 14:58:54', '2019-02-22 14:58:54'),
(209, 41, 7, 'Cash Received. Order Completed', '2019-02-22 14:58:56', '2019-02-22 14:58:56'),
(210, 18, 2, 'Food is being prepared', '2019-02-22 15:00:18', '2019-02-22 15:00:18'),
(211, 18, 3, 'Delivery Boy Started towards Restaurant', '2019-02-22 15:00:21', '2019-02-22 15:00:21'),
(212, 18, 4, 'Delivery Boy Reached restaurant', '2019-02-22 15:00:22', '2019-02-22 15:00:22'),
(213, 18, 5, 'Started towards Customer', '2019-02-22 15:00:24', '2019-02-22 15:00:24'),
(214, 18, 6, 'Food delivered', '2019-02-22 15:00:26', '2019-02-22 15:00:26'),
(215, 18, 7, 'Cash Received. Order Completed', '2019-02-22 15:00:28', '2019-02-22 15:00:28'),
(216, 44, 0, 'Order Placed', '2019-02-22 15:09:42', '2019-02-22 15:09:42'),
(217, 44, 1, 'Order Accepted by Restaurant', '2019-02-22 15:10:08', '2019-02-22 15:10:08'),
(218, 44, 2, 'Food is being prepared', '2019-02-22 15:10:18', '2019-02-22 15:10:18'),
(219, 44, 3, 'Delivery Boy Started towards Restaurant', '2019-02-22 15:10:32', '2019-02-22 15:10:32'),
(220, 44, 4, 'Delivery Boy Reached restaurant', '2019-02-22 15:10:46', '2019-02-22 15:10:46'),
(221, 44, 5, 'Started towards Customer', '2019-02-22 15:10:57', '2019-02-22 15:10:57'),
(222, 44, 6, 'Food delivered', '2019-02-22 15:11:04', '2019-02-22 15:11:04'),
(223, 44, 7, 'Cash Received. Order Completed', '2019-02-22 15:11:06', '2019-02-22 15:11:06'),
(224, 47, 0, 'Order Placed', '2019-02-23 00:09:49', '2019-02-23 00:09:49'),
(225, 49, 0, 'Order Placed', '2019-02-23 00:09:49', '2019-02-23 00:09:49'),
(226, 45, 0, 'Order Placed', '2019-02-23 00:09:49', '2019-02-23 00:09:49'),
(227, 48, 0, 'Order Placed', '2019-02-23 00:09:49', '2019-02-23 00:09:49'),
(228, 47, 0, 'Order Placed', '2019-02-23 00:09:49', '2019-02-23 00:09:49'),
(229, 50, 0, 'Order Placed', '2019-02-23 05:22:17', '2019-02-23 05:22:17'),
(230, 50, 1, 'Order Accepted by Restaurant', '2019-02-23 05:34:32', '2019-02-23 05:34:32'),
(231, 51, 0, 'Order Placed', '2019-02-23 05:36:57', '2019-02-23 05:36:57'),
(232, 51, 1, 'Order Accepted by Restaurant', '2019-02-23 10:50:59', '2019-02-23 10:50:59'),
(233, 51, 2, 'Food is being prepared', '2019-02-23 10:51:51', '2019-02-23 10:51:51'),
(234, 51, 3, 'Delivery Boy Started towards Restaurant', '2019-02-23 10:52:45', '2019-02-23 10:52:45'),
(235, 51, 4, 'Delivery Boy Reached restaurant', '2019-02-23 10:56:44', '2019-02-23 10:56:44'),
(236, 51, 5, 'Started towards Customer', '2019-02-23 11:03:38', '2019-02-23 11:03:38'),
(237, 51, 6, 'Food delivered', '2019-02-23 11:03:47', '2019-02-23 11:03:47'),
(238, 51, 7, 'Cash Received. Order Completed', '2019-02-23 11:03:56', '2019-02-23 11:03:56'),
(239, 52, 0, 'Order Placed', '2019-02-23 11:05:47', '2019-02-23 11:05:47'),
(240, 52, 1, 'Order Accepted by Restaurant', '2019-02-23 11:06:04', '2019-02-23 11:06:04'),
(241, 52, 2, 'Food is being prepared', '2019-02-23 11:06:33', '2019-02-23 11:06:33'),
(242, 52, 3, 'Delivery Boy Started towards Restaurant', '2019-02-23 11:07:30', '2019-02-23 11:07:30'),
(243, 52, 4, 'Delivery Boy Reached restaurant', '2019-02-23 11:09:37', '2019-02-23 11:09:37'),
(244, 52, 5, 'Started towards Customer', '2019-02-23 11:09:41', '2019-02-23 11:09:41'),
(245, 52, 6, 'Food delivered', '2019-02-23 11:09:48', '2019-02-23 11:09:48'),
(246, 52, 7, 'Cash Received. Order Completed', '2019-02-23 11:09:51', '2019-02-23 11:09:51'),
(247, 53, 0, 'Order Placed', '2019-02-23 11:10:09', '2019-02-23 11:10:09'),
(248, 53, 1, 'Order Accepted by Restaurant', '2019-02-23 11:10:24', '2019-02-23 11:10:24'),
(249, 53, 2, 'Food is being prepared', '2019-02-23 11:11:27', '2019-02-23 11:11:27'),
(250, 53, 3, 'Delivery Boy Started towards Restaurant', '2019-02-23 11:11:47', '2019-02-23 11:11:47'),
(251, 53, 4, 'Delivery Boy Reached restaurant', '2019-02-23 11:17:01', '2019-02-23 11:17:01'),
(252, 53, 5, 'Started towards Customer', '2019-02-23 11:17:05', '2019-02-23 11:17:05'),
(253, 53, 6, 'Food delivered', '2019-02-23 11:17:13', '2019-02-23 11:17:13'),
(254, 53, 7, 'Cash Received. Order Completed', '2019-02-23 11:17:16', '2019-02-23 11:17:16'),
(255, 54, 0, 'Order Placed', '2019-02-23 11:20:09', '2019-02-23 11:20:09'),
(256, 54, 1, 'Order Accepted by Restaurant', '2019-02-23 11:20:28', '2019-02-23 11:20:28'),
(257, 54, 2, 'Food is being prepared', '2019-02-23 11:20:38', '2019-02-23 11:20:38'),
(258, 54, 3, 'Delivery Boy Started towards Restaurant', '2019-02-23 11:21:14', '2019-02-23 11:21:14'),
(259, 54, 4, 'Delivery Boy Reached restaurant', '2019-02-23 11:21:22', '2019-02-23 11:21:22'),
(260, 54, 5, 'Started towards Customer', '2019-02-23 11:21:30', '2019-02-23 11:21:30'),
(261, 54, 6, 'Food delivered', '2019-02-23 11:21:47', '2019-02-23 11:21:47'),
(262, 54, 7, 'Cash Received. Order Completed', '2019-02-23 11:21:58', '2019-02-23 11:21:58'),
(263, 55, 0, 'Order Placed', '2019-02-23 11:22:21', '2019-02-23 11:22:21'),
(264, 55, 1, 'Order Accepted by Restaurant', '2019-02-23 11:22:37', '2019-02-23 11:22:37'),
(265, 56, 0, 'Order Placed', '2019-02-25 07:08:56', '2019-02-25 07:08:56'),
(266, 56, 1, 'Order Accepted by Restaurant', '2019-02-25 07:13:59', '2019-02-25 07:13:59'),
(267, 56, 2, 'Food is being prepared', '2019-02-25 07:14:48', '2019-02-25 07:14:48'),
(268, 55, 2, 'Food is being prepared', '2019-02-25 12:09:06', '2019-02-25 12:09:06'),
(269, 57, 0, 'Order Placed', '2019-02-27 11:32:00', '2019-02-27 11:32:00'),
(270, 56, 3, 'Delivery Boy Started towards Restaurant', '2019-02-27 12:16:53', '2019-02-27 12:16:53'),
(271, 56, 4, 'Delivery Boy Reached restaurant', '2019-02-27 12:16:54', '2019-02-27 12:16:54'),
(272, 58, 0, 'Order Placed', '2019-02-27 12:28:00', '2019-02-27 12:28:00'),
(273, 59, 0, 'Order Placed', '2019-02-27 12:28:02', '2019-02-27 12:28:02'),
(274, 59, 1, 'Order Accepted by Restaurant', '2019-02-27 12:28:58', '2019-02-27 12:28:58'),
(275, 59, 2, 'Food is being prepared', '2019-02-27 12:29:20', '2019-02-27 12:29:20'),
(276, 59, 3, 'Delivery Boy Started towards Restaurant', '2019-02-27 12:29:26', '2019-02-27 12:29:26'),
(277, 59, 4, 'Delivery Boy Reached restaurant', '2019-02-27 12:29:31', '2019-02-27 12:29:31'),
(278, 59, 5, 'Started towards Customer', '2019-02-27 12:29:34', '2019-02-27 12:29:34'),
(279, 59, 6, 'Food delivered', '2019-02-27 12:29:41', '2019-02-27 12:29:41'),
(280, 59, 7, 'Cash Received. Order Completed', '2019-02-27 12:29:48', '2019-02-27 12:29:48'),
(281, 58, 1, 'Order Accepted by Restaurant', '2019-02-27 12:30:31', '2019-02-27 12:30:31'),
(282, 58, 2, 'Food is being prepared', '2019-02-27 12:30:44', '2019-02-27 12:30:44'),
(283, 58, 3, 'Delivery Boy Started towards Restaurant', '2019-02-27 12:31:10', '2019-02-27 12:31:10'),
(284, 58, 4, 'Delivery Boy Reached restaurant', '2019-02-27 12:31:12', '2019-02-27 12:31:12'),
(285, 58, 5, 'Started towards Customer', '2019-02-27 12:31:16', '2019-02-27 12:31:16'),
(286, 58, 6, 'Food delivered', '2019-02-27 12:31:20', '2019-02-27 12:31:20'),
(287, 58, 7, 'Cash Received. Order Completed', '2019-02-27 12:31:24', '2019-02-27 12:31:24'),
(288, 60, 0, 'Order Placed', '2019-02-27 12:39:50', '2019-02-27 12:39:50'),
(289, 60, 1, 'Order Accepted by Restaurant', '2019-02-27 12:42:57', '2019-02-27 12:42:57'),
(290, 60, 2, 'Food is being prepared', '2019-02-27 12:43:41', '2019-02-27 12:43:41'),
(291, 60, 3, 'Delivery Boy Started towards Restaurant', '2019-02-27 12:44:45', '2019-02-27 12:44:45'),
(292, 60, 4, 'Delivery Boy Reached restaurant', '2019-02-27 12:44:48', '2019-02-27 12:44:48'),
(293, 60, 5, 'Started towards Customer', '2019-02-27 12:44:51', '2019-02-27 12:44:51'),
(294, 60, 6, 'Food delivered', '2019-02-27 12:44:53', '2019-02-27 12:44:53'),
(295, 60, 7, 'Cash Received. Order Completed', '2019-02-27 12:44:56', '2019-02-27 12:44:56'),
(296, 61, 0, 'Order Placed', '2019-02-27 13:01:58', '2019-02-27 13:01:58'),
(297, 61, 1, 'Order Accepted by Restaurant', '2019-02-27 13:02:29', '2019-02-27 13:02:29'),
(298, 61, 2, 'Food is being prepared', '2019-02-27 13:03:10', '2019-02-27 13:03:10'),
(299, 61, 3, 'Delivery Boy Started towards Restaurant', '2019-02-27 13:03:14', '2019-02-27 13:03:14'),
(300, 61, 4, 'Delivery Boy Reached restaurant', '2019-02-27 13:04:17', '2019-02-27 13:04:17'),
(301, 61, 5, 'Started towards Customer', '2019-02-27 13:04:21', '2019-02-27 13:04:21'),
(302, 61, 6, 'Food delivered', '2019-02-27 13:04:27', '2019-02-27 13:04:27'),
(303, 61, 7, 'Cash Received. Order Completed', '2019-02-27 13:04:30', '2019-02-27 13:04:30'),
(304, 62, 0, 'Order Placed', '2019-02-27 13:07:29', '2019-02-27 13:07:29'),
(305, 63, 0, 'Order Placed', '2019-02-27 13:07:30', '2019-02-27 13:07:30'),
(306, 64, 0, 'Order Placed', '2019-02-27 13:07:30', '2019-02-27 13:07:30'),
(307, 64, 1, 'Order Accepted by Restaurant', '2019-02-27 13:08:27', '2019-02-27 13:08:27'),
(308, 64, 2, 'Food is being prepared', '2019-02-27 13:08:44', '2019-02-27 13:08:44'),
(309, 64, 3, 'Delivery Boy Started towards Restaurant', '2019-02-27 13:08:50', '2019-02-27 13:08:50'),
(310, 64, 4, 'Delivery Boy Reached restaurant', '2019-02-27 13:08:52', '2019-02-27 13:08:52'),
(311, 64, 5, 'Started towards Customer', '2019-02-27 13:09:02', '2019-02-27 13:09:02'),
(312, 64, 6, 'Food delivered', '2019-02-27 13:09:03', '2019-02-27 13:09:03'),
(313, 64, 7, 'Cash Received. Order Completed', '2019-02-27 13:09:05', '2019-02-27 13:09:05'),
(314, 63, 1, 'Order Accepted by Restaurant', '2019-02-27 13:09:12', '2019-02-27 13:09:12'),
(315, 63, 2, 'Food is being prepared', '2019-02-27 13:09:23', '2019-02-27 13:09:23'),
(316, 63, 3, 'Delivery Boy Started towards Restaurant', '2019-02-27 13:09:27', '2019-02-27 13:09:27'),
(317, 63, 4, 'Delivery Boy Reached restaurant', '2019-02-27 13:09:29', '2019-02-27 13:09:29'),
(318, 63, 5, 'Started towards Customer', '2019-02-27 13:09:31', '2019-02-27 13:09:31'),
(319, 63, 6, 'Food delivered', '2019-02-27 13:09:34', '2019-02-27 13:09:34'),
(320, 63, 7, 'Cash Received. Order Completed', '2019-02-27 13:09:37', '2019-02-27 13:09:37'),
(321, 62, 1, 'Order Accepted by Restaurant', '2019-02-27 13:09:43', '2019-02-27 13:09:43'),
(322, 62, 2, 'Food is being prepared', '2019-02-27 13:09:54', '2019-02-27 13:09:54'),
(323, 62, 3, 'Delivery Boy Started towards Restaurant', '2019-02-27 13:10:10', '2019-02-27 13:10:10'),
(324, 62, 4, 'Delivery Boy Reached restaurant', '2019-02-27 13:10:12', '2019-02-27 13:10:12'),
(325, 62, 5, 'Started towards Customer', '2019-02-27 13:10:14', '2019-02-27 13:10:14'),
(326, 62, 6, 'Food delivered', '2019-02-27 13:10:15', '2019-02-27 13:10:15'),
(327, 62, 7, 'Cash Received. Order Completed', '2019-02-27 13:10:17', '2019-02-27 13:10:17'),
(328, 65, 0, 'Order Placed', '2019-02-28 07:27:44', '2019-02-28 07:27:44'),
(329, 65, 1, 'Order Accepted by Restaurant', '2019-02-28 07:30:02', '2019-02-28 07:30:02'),
(330, 65, 2, 'Food is being prepared', '2019-02-28 07:30:26', '2019-02-28 07:30:26'),
(331, 65, 3, 'Delivery Boy Started towards Restaurant', '2019-02-28 07:30:46', '2019-02-28 07:30:46'),
(332, 65, 4, 'Delivery Boy Reached restaurant', '2019-02-28 07:32:30', '2019-02-28 07:32:30'),
(333, 65, 5, 'Started towards Customer', '2019-02-28 07:32:43', '2019-02-28 07:32:43'),
(334, 65, 6, 'Food delivered', '2019-02-28 07:34:04', '2019-02-28 07:34:04'),
(335, 65, 7, 'Cash Received. Order Completed', '2019-02-28 07:34:13', '2019-02-28 07:34:13'),
(336, 66, 0, 'Order Placed', '2019-03-01 09:26:04', '2019-03-01 09:26:04'),
(337, 66, 1, 'Order Accepted by Restaurant', '2019-03-01 14:01:07', '2019-03-01 14:01:07'),
(338, 66, 2, 'Food is being prepared', '2019-03-01 14:01:45', '2019-03-01 14:01:45'),
(339, 57, 1, 'Order Accepted by Restaurant', '2019-03-01 16:18:58', '2019-03-01 16:18:58'),
(340, 57, 2, 'Food is being prepared', '2019-03-01 16:19:25', '2019-03-01 16:19:25'),
(341, 67, 0, 'Order Placed', '2019-03-02 05:39:04', '2019-03-02 05:39:04'),
(342, 68, 0, 'Order Placed', '2019-03-02 05:40:56', '2019-03-02 05:40:56'),
(343, 67, 1, 'Order Accepted by Restaurant', '2019-03-02 05:46:08', '2019-03-02 05:46:08'),
(344, 67, 2, 'Food is being prepared', '2019-03-02 05:46:22', '2019-03-02 05:46:22'),
(345, 50, 1, 'Order Accepted by Restaurant', '2019-03-02 05:46:35', '2019-03-02 05:46:35'),
(346, 69, 0, 'Order Placed', '2019-03-02 05:47:43', '2019-03-02 05:47:43'),
(347, 55, 3, 'Delivery Boy Started towards Restaurant', '2019-03-02 05:53:59', '2019-03-02 05:53:59'),
(348, 55, 4, 'Delivery Boy Reached restaurant', '2019-03-02 05:55:15', '2019-03-02 05:55:15'),
(349, 55, 5, 'Started towards Customer', '2019-03-02 05:56:03', '2019-03-02 05:56:03'),
(350, 55, 6, 'Food delivered', '2019-03-02 05:56:28', '2019-03-02 05:56:28'),
(351, 55, 7, 'Cash Received. Order Completed', '2019-03-02 05:56:29', '2019-03-02 05:56:29'),
(352, 70, 0, 'Order Placed', '2019-03-02 07:23:12', '2019-03-02 07:23:12'),
(353, 71, 0, 'Order Placed', '2019-03-02 14:24:40', '2019-03-02 14:24:40'),
(354, 70, 1, 'Order Accepted by Restaurant', '2019-03-02 15:56:13', '2019-03-02 15:56:13'),
(355, 70, 1, 'Order Accepted by Restaurant', '2019-03-02 15:56:14', '2019-03-02 15:56:14'),
(356, 71, 1, 'Order Accepted by Restaurant', '2019-03-02 15:56:31', '2019-03-02 15:56:31'),
(357, 71, 1, 'Order Accepted by Restaurant', '2019-03-02 15:57:10', '2019-03-02 15:57:10'),
(358, 69, 1, 'Order Accepted by Restaurant', '2019-03-02 15:57:18', '2019-03-02 15:57:18'),
(359, 68, 1, 'Order Accepted by Restaurant', '2019-03-02 15:57:24', '2019-03-02 15:57:24'),
(360, 72, 0, 'Order Placed', '2019-03-02 16:02:20', '2019-03-02 16:02:20'),
(361, 73, 0, 'Order Placed', '2019-03-02 17:53:42', '2019-03-02 17:53:42'),
(362, 74, 0, 'Order Placed', '2019-03-02 18:01:26', '2019-03-02 18:01:26'),
(363, 75, 0, 'Order Placed', '2019-03-02 18:02:59', '2019-03-02 18:02:59'),
(364, 75, 1, 'Order Accepted by Restaurant', '2019-03-02 18:03:46', '2019-03-02 18:03:46'),
(365, 74, 1, 'Order Accepted by Restaurant', '2019-03-02 18:05:16', '2019-03-02 18:05:16'),
(366, 76, 0, 'Order Placed', '2019-03-03 12:03:56', '2019-03-03 12:03:56'),
(367, 77, 0, 'Order Placed', '2019-03-04 06:03:47', '2019-03-04 06:03:47'),
(368, 77, 1, 'Order Accepted by Restaurant', '2019-03-04 06:09:04', '2019-03-04 06:09:04'),
(369, 77, 2, 'Food is being prepared', '2019-03-04 06:09:27', '2019-03-04 06:09:27'),
(370, 77, 3, 'Delivery Boy Started towards Restaurant', '2019-03-04 06:09:34', '2019-03-04 06:09:34'),
(371, 77, 4, 'Delivery Boy Reached restaurant', '2019-03-04 06:09:37', '2019-03-04 06:09:37'),
(372, 77, 5, 'Started towards Customer', '2019-03-04 06:09:40', '2019-03-04 06:09:40'),
(373, 77, 6, 'Food delivered', '2019-03-04 06:09:49', '2019-03-04 06:09:49'),
(374, 77, 7, 'Cash Received. Order Completed', '2019-03-04 06:10:04', '2019-03-04 06:10:04'),
(375, 78, 0, 'Order Placed', '2019-03-04 06:56:34', '2019-03-04 06:56:34'),
(376, 78, 1, 'Order Accepted by Restaurant', '2019-03-04 07:01:54', '2019-03-04 07:01:54'),
(377, 78, 2, 'Food is being prepared', '2019-03-04 07:03:34', '2019-03-04 07:03:34'),
(378, 78, 3, 'Delivery Boy Started towards Restaurant', '2019-03-04 07:03:39', '2019-03-04 07:03:39'),
(379, 78, 4, 'Delivery Boy Reached restaurant', '2019-03-04 07:04:07', '2019-03-04 07:04:07'),
(380, 78, 5, 'Started towards Customer', '2019-03-04 07:04:09', '2019-03-04 07:04:09'),
(381, 78, 6, 'Food delivered', '2019-03-04 07:04:16', '2019-03-04 07:04:16'),
(382, 78, 7, 'Cash Received. Order Completed', '2019-03-04 07:04:18', '2019-03-04 07:04:18'),
(383, 79, 0, 'Order Placed', '2019-03-04 07:05:58', '2019-03-04 07:05:58'),
(384, 79, 1, 'Order Accepted by Restaurant', '2019-03-04 07:06:58', '2019-03-04 07:06:58'),
(385, 79, 2, 'Food is being prepared', '2019-03-04 07:07:22', '2019-03-04 07:07:22'),
(386, 79, 3, 'Delivery Boy Started towards Restaurant', '2019-03-04 07:07:31', '2019-03-04 07:07:31'),
(387, 79, 4, 'Delivery Boy Reached restaurant', '2019-03-04 07:07:34', '2019-03-04 07:07:34'),
(388, 79, 5, 'Started towards Customer', '2019-03-04 07:07:50', '2019-03-04 07:07:50'),
(389, 79, 6, 'Food delivered', '2019-03-04 07:07:53', '2019-03-04 07:07:53'),
(390, 79, 7, 'Cash Received. Order Completed', '2019-03-04 07:07:56', '2019-03-04 07:07:56'),
(391, 80, 0, 'Order Placed', '2019-03-04 09:59:03', '2019-03-04 09:59:03'),
(392, 80, 1, 'Order Accepted by Restaurant', '2019-03-04 10:08:01', '2019-03-04 10:08:01'),
(393, 80, 2, 'Food is being prepared', '2019-03-04 10:08:33', '2019-03-04 10:08:33'),
(394, 80, 3, 'Delivery Boy Started towards Restaurant', '2019-03-04 10:08:37', '2019-03-04 10:08:37'),
(395, 80, 4, 'Delivery Boy Reached restaurant', '2019-03-04 10:08:49', '2019-03-04 10:08:49'),
(396, 80, 5, 'Started towards Customer', '2019-03-04 10:08:57', '2019-03-04 10:08:57'),
(397, 80, 6, 'Food delivered', '2019-03-04 10:09:10', '2019-03-04 10:09:10'),
(398, 80, 7, 'Cash Received. Order Completed', '2019-03-04 10:09:22', '2019-03-04 10:09:22'),
(399, 81, 0, 'Order Placed', '2019-03-04 11:55:49', '2019-03-04 11:55:49'),
(400, 82, 0, 'Order Placed', '2019-03-04 11:57:18', '2019-03-04 11:57:18'),
(401, 83, 0, 'Order Placed', '2019-03-05 05:46:38', '2019-03-05 05:46:38'),
(402, 84, 0, 'Order Placed', '2019-03-05 07:07:50', '2019-03-05 07:07:50'),
(403, 85, 0, 'Order Placed', '2019-03-05 14:14:35', '2019-03-05 14:14:35'),
(404, 86, 0, 'Order Placed', '2019-03-06 06:25:04', '2019-03-06 06:25:04'),
(405, 87, 0, 'Order Placed', '2019-03-06 06:29:13', '2019-03-06 06:29:13'),
(406, 88, 0, 'Order Placed', '2019-03-06 06:32:16', '2019-03-06 06:32:16'),
(407, 89, 0, 'Order Placed', '2019-03-06 06:33:42', '2019-03-06 06:33:42'),
(408, 90, 0, 'Order Placed', '2019-03-06 06:42:15', '2019-03-06 06:42:15'),
(409, 91, 0, 'Order Placed', '2019-03-06 11:13:47', '2019-03-06 11:13:47'),
(410, 92, 0, 'Order Placed', '2019-03-06 11:18:18', '2019-03-06 11:18:18'),
(411, 93, 0, 'Order Placed', '2019-03-06 11:24:49', '2019-03-06 11:24:49'),
(412, 93, 1, 'Order Accepted by Restaurant', '2019-03-06 11:25:42', '2019-03-06 11:25:42'),
(413, 93, 2, 'Food is being prepared', '2019-03-06 11:26:03', '2019-03-06 11:26:03'),
(414, 93, 3, 'Delivery Boy Started towards Restaurant', '2019-03-06 11:26:22', '2019-03-06 11:26:22'),
(415, 93, 3, 'Delivery Boy Started towards Restaurant', '2019-03-06 11:26:22', '2019-03-06 11:26:22'),
(416, 93, 4, 'Delivery Boy Reached restaurant', '2019-03-06 11:27:11', '2019-03-06 11:27:11'),
(417, 94, 0, 'Order Placed', '2019-03-06 15:30:09', '2019-03-06 15:30:09'),
(418, 95, 0, 'Order Placed', '2019-03-07 11:11:49', '2019-03-07 11:11:49'),
(419, 95, 1, 'Order Accepted by Restaurant', '2019-03-07 11:41:39', '2019-03-07 11:41:39'),
(420, 94, 1, 'Order Accepted by Restaurant', '2019-03-07 11:41:58', '2019-03-07 11:41:58'),
(421, 95, 2, 'Food is being prepared', '2019-03-07 11:42:17', '2019-03-07 11:42:17'),
(422, 94, 2, 'Food is being prepared', '2019-03-07 11:42:32', '2019-03-07 11:42:32'),
(423, 92, 1, 'Order Accepted by Restaurant', '2019-03-07 11:43:12', '2019-03-07 11:43:12'),
(424, 92, 2, 'Food is being prepared', '2019-03-07 12:58:52', '2019-03-07 12:58:52'),
(425, 91, 1, 'Order Accepted by Restaurant', '2019-03-07 13:29:29', '2019-03-07 13:29:29'),
(426, 96, 0, 'Order Placed', '2019-03-07 22:02:07', '2019-03-07 22:02:07'),
(427, 97, 0, 'Order Placed', '2019-03-08 22:37:03', '2019-03-08 22:37:03'),
(428, 98, 0, 'Order Placed', '2019-03-10 00:46:41', '2019-03-10 00:46:41'),
(429, 99, 0, 'Order Placed', '2019-03-10 01:02:21', '2019-03-10 01:02:21'),
(430, 97, 1, 'Order Accepted by Restaurant', '2019-03-10 05:01:23', '2019-03-10 05:01:23'),
(431, 100, 0, 'Order Placed', '2019-03-10 20:35:45', '2019-03-10 20:35:45'),
(432, 101, 0, 'Order Placed', '2019-03-11 06:18:22', '2019-03-11 06:18:22'),
(433, 96, 1, 'Order Accepted by Restaurant', '2019-03-12 03:23:23', '2019-03-12 03:23:23'),
(434, 91, 2, 'Food is being prepared', '2019-03-12 03:23:39', '2019-03-12 03:23:39'),
(435, 102, 0, 'Order Placed', '2019-03-12 03:54:03', '2019-03-12 03:54:03'),
(436, 102, 1, 'Order Accepted by Restaurant', '2019-03-12 04:02:21', '2019-03-12 04:02:21'),
(437, 97, 2, 'Food is being prepared', '2019-03-12 04:02:37', '2019-03-12 04:02:37'),
(438, 102, 2, 'Food is being prepared', '2019-03-12 04:02:57', '2019-03-12 04:02:57'),
(439, 103, 0, 'Order Placed', '2019-03-13 02:27:22', '2019-03-13 02:27:22'),
(440, 104, 0, 'Order Placed', '2019-03-13 02:29:41', '2019-03-13 02:29:41'),
(441, 105, 0, 'Order Placed', '2019-03-13 02:45:25', '2019-03-13 02:45:25'),
(442, 106, 0, 'Order Placed', '2019-03-13 03:10:43', '2019-03-13 03:10:43'),
(443, 107, 0, 'Order Placed', '2019-03-13 03:12:05', '2019-03-13 03:12:05'),
(444, 108, 0, 'Order Placed', '2019-03-13 03:58:15', '2019-03-13 03:58:15'),
(445, 109, 0, 'Order Placed', '2019-03-13 04:01:58', '2019-03-13 04:01:58'),
(446, 110, 0, 'Order Placed', '2019-03-22 11:16:13', '2019-03-22 11:16:13');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `erc_trans_id` varchar(200) NOT NULL,
  `no_of_token` int(8) NOT NULL,
  `stripe_trans_id` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `authToken` varchar(150) NOT NULL,
  `device_type` varchar(30) NOT NULL DEFAULT 'android',
  `device_token` varchar(200) NOT NULL,
  `default_card` int(11) NOT NULL DEFAULT '0',
  `otp` smallint(6) NOT NULL DEFAULT '0',
  `profile_image` varchar(200) DEFAULT NULL,
  `wallet_amount` double(6,2) NOT NULL DEFAULT '0.00',
  `referral_code` varchar(20) DEFAULT NULL,
  `referral_amount` double(6,2) NOT NULL DEFAULT '0.00',
  `login_type` int(11) NOT NULL DEFAULT '0' COMMENT '0- mobile, 1- Gmail, 2 - Facebook',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `authToken`, `device_type`, `device_token`, `default_card`, `otp`, `profile_image`, `wallet_amount`, `referral_code`, `referral_amount`, `login_type`, `created_at`, `updated_at`) VALUES
(2, NULL, '8600771099', NULL, NULL, '2jFEQuIuwpRM6Jzz', 'android', 'abc123', 0, 6089, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'qHjWQHe7', 0.00, 0, '2018-08-09 12:35:15', '2018-08-09 12:35:15'),
(6, 'Praveennnn', '91850808716', 'praveen@sparkouttech.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'c3iGKK1yNx8:APA91bF0wbzT0QUr_JqiB_P5iBEB8ICCbIq6A2KOMiGnxVqiKNdkc8lkPDZSFUzpdyQp3QP0RA5lTnIw3TM3eEpVqJdZgifzhe77LsKnb5qSpSnGAUJOdenlwPJAHQM2wPgC6GSUTV5u', 0, 0, 'http://54.218.62.130/eatzilla/public/uploads/CgsbJA4xPiGjUh8u4ecNPCEHnd7QOaAr.svg', 0.00, 'PM6YHWZT', 0.00, 0, '2018-08-18 12:27:52', '2019-02-22 13:23:50'),
(7, NULL, '919943291177', 'sangkarthi94@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'OsD92gRRqIthfEsj', 'android', 'dAQTfN0UOY0:APA91bGpducEO1Pd5sE6EnYOmcZnS-3zV3ukoWJPP_hEm1b4qVbSlQfH7nZrf9RVTTB9tw4xlp0iEqOIcriMjbXgSnroZyoclmykmw-UjE52F6a7AT4HhXro8MRFmQ2Edvkaxh3DiyfdJlzNr_7dzhtTREF_qt3EIw', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'LNBRgL8o', 0.00, 0, '2018-08-18 15:55:28', '2018-08-18 16:07:25'),
(8, 'Praveen', '8825653478', 'sangkarthi@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'Rq1mMpiwTCJYNJPj', 'web', 'cxiOaTU2oto:APA91bGpPZfk2W0wmunFH3iNPesNGKL0vMgakrsZ0c47mxHaiob11gyoX402lqBx5p0Fq_EcfBL2RINWlHcbnbcVpm0_6reIN_i38C7SzlZH4yX1IhdMRPDK9IRwQ8h_5lZTn0l9cdxz', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, '3Hn4WVcI', 0.00, 0, '2018-08-19 14:52:25', '2018-09-20 06:58:17'),
(9, NULL, '9500739244', 'lokeshmurali44@gmail.com', 'WmMveXV5eHhhK0pLb3pIMk9Sc3lUQT09', 'SJtiSfjdZnHck659', 'android', 'fL3eMyn1mAQ:APA91bHf0vgUEvhy-gWKe9irxYsIcLFxjrie4zG-FKGOMHIgxBvJWk-QQkjcPAUk-90TxIK0q6diwciOUWr_c_-rC9jLMfN2Ho3APC34urxCkFWs1TVYN4vDOgAboN4kbjQMKVMSy--n', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'Z6djRFRi', 0.00, 0, '2018-08-31 09:55:20', '2018-09-29 22:04:46'),
(10, NULL, '919908011736', 'sairam.nsn@gmail.com', 'dE9DY2EzRGZpcThYeVlxVW1OTjBrdz09', 'ZC3bH1Bft6H3M8kv', 'android', 'c95KlRvAawo:APA91bEP9MDcw4-7O8xPUXRmDrmbsRgCVnyyC1VN1YvpQU4Z235R1sbcV4eCLq28ax_iXw3j5_cDDGdTX0G4sFkQAOfAP2yX8CpCN6D0KSbzj_2lvj9gCvSxIcuEP67ENG4FzthYnjcx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'qdyAKHFN', 0.00, 0, '2018-09-03 17:54:51', '2018-09-03 17:54:51'),
(11, NULL, '8870129402', 'dhivyamurugesan3995@gmail.com', 'REVobTNMY0pQa2tPRkN0TmtiNnk2QT09', 'zcYrIkVpjarHcJ4z', 'android', 'c2Mh6EQ2vgU:APA91bHf4X_CmwpubwKX6my9cxOMAWvHcydyta0K22AJ_nn7-8nn9iLmGjKHkY8is84u5Hprx3rn69pTk9C9PUSbMKox_E0c3l-6LRgZgxzUal0jdoVjFIE-k0AecfgPzggrs6GMMmM6', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'ZD8VeTXH', 0.00, 0, '2018-09-04 06:48:10', '2018-09-06 10:23:17'),
(12, NULL, '7010662843', 'murugasendhivya3@gmail.com', 'REVobTNMY0pQa2tPRkN0TmtiNnk2QT09', 'Kyc662NxZLeUvPDr', 'android', 'caBCHZGFrMc:APA91bG2S2kT4Itnug9EPRcsMNBIEn9k0OJxTsc71Q6tsN-IJI1QTF9Yk_KteMXzfmgNBydzmg0AxgkzUKn5QffjFw3LcaWwfnMI1n6VmjFHGcLT7i5sNTWw0M1QClDlv9A6eJWs_ywP', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'zm9YnU4T', 0.00, 0, '2018-09-05 07:41:12', '2018-09-06 13:50:27'),
(13, NULL, '8056359277', 'gotocva@gmail.com', 'REVobTNMY0pQa2tPRkN0TmtiNnk2QT09', '0', 'android', 'c2Mh6EQ2vgU:APA91bHf4X_CmwpubwKX6my9cxOMAWvHcydyta0K22AJ_nn7-8nn9iLmGjKHkY8is84u5Hprx3rn69pTk9C9PUSbMKox_E0c3l-6LRgZgxzUal0jdoVjFIE-k0AecfgPzggrs6GMMmM6', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'sJxHmiL6', 0.00, 0, '2018-09-06 08:23:16', '2018-09-06 08:38:23'),
(14, NULL, '9994810451', 'gksarun@gmail.com', 'REVobTNMY0pQa2tPRkN0TmtiNnk2QT09', '0', 'android', 'c2Mh6EQ2vgU:APA91bHf4X_CmwpubwKX6my9cxOMAWvHcydyta0K22AJ_nn7-8nn9iLmGjKHkY8is84u5Hprx3rn69pTk9C9PUSbMKox_E0c3l-6LRgZgxzUal0jdoVjFIE-k0AecfgPzggrs6GMMmM6', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'aTNMZUFc', 0.00, 0, '2018-09-06 09:37:57', '2018-09-06 10:14:31'),
(15, NULL, '8760868844', 'giriraaja@gmail.com', 'REVobTNMY0pQa2tPRkN0TmtiNnk2QT09', '0', 'android', 'c2Mh6EQ2vgU:APA91bHf4X_CmwpubwKX6my9cxOMAWvHcydyta0K22AJ_nn7-8nn9iLmGjKHkY8is84u5Hprx3rn69pTk9C9PUSbMKox_E0c3l-6LRgZgxzUal0jdoVjFIE-k0AecfgPzggrs6GMMmM6', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'Ckt08OGe', 0.00, 0, '2018-09-06 10:08:32', '2018-09-06 10:11:58'),
(16, 'GiriVignesh', '919524722184', 'Giri3@test.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '4WBNLDx3nmz27vbw', 'android', 'cv9isv9d4uk:APA91bG2_kx-l-kyLgrcjEyfkl6K1oaKzYl3DC4vdKpgpQjhiWPHYodRmV8ARo9SWclTzWcFHpNR1I8QSB3NaPyxjH08PhALnt6N6n9eDcLeU5VotdsQnUQ90uS0w4-C33N0HMIs1xYe', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'wpn8j9RP', 0.00, 0, '2018-09-11 08:32:26', '2019-03-02 17:58:34'),
(17, NULL, '7823948822', 'soundariyalingan@gmail.com', 'dE9DY2EzRGZpcThYeVlxVW1OTjBrdz09', 'OGqQtg9Yp46GqDhe', 'android', 'cRwLa5AE_sQ:APA91bFSjh9nD52i4aiIYSLG-BT6NWHHYGNYKig1r7FCi_hdJjEGtLxLJR2Muqe-QAa9PNHlhKe3YTUIL1vH6sOUKZQffxQmuQoJwIe2OqpvWtLtOnkYZngYIJdghETCS3HU0CmnrbDV', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'bdsJ9Qoz', 0.00, 0, '2018-09-13 10:44:26', '2018-09-13 10:44:26'),
(18, NULL, '86677617798', 'vishnuvardhanamz@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'gELpYGOxMhM5bRNZ', 'android', 'crymDd_aigY:APA91bHH00Fd98WHXSALU3PFzIYp2jqn-vVLzDeWyU3OnJznl7LLOSfDIjf44LxpYQ6Hxvg80GC_lGRPHu4fUYNkn4tEhP5Y5YQ2nZbiIv2EAm-4-68fYderVTXaeekWDlON_0EarWJ-', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'Pjhcd7wI', 0.00, 0, '2018-09-29 10:17:24', '2018-10-04 01:09:12'),
(19, NULL, '9597434949', 'vishnuvardhan4006@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'eNbU-Q1nBkc:APA91bGOv-TB-IXvMRmSYagNrmSnJxYkQSa8McUtX4s7oJu8B_q1V4vxwqE35CxQ6FX7XZo0WL8eo0-ryjwAQm8Kb7Y-ERzUT4ppqlckqutYtddl7UcbafpWGwmVsY6EPIR5_jg0I9P6', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'WDLPT52S', 0.00, 0, '2018-09-30 00:31:07', '2018-09-30 18:45:57'),
(20, NULL, '7708889555', 'vishnuvardhan4@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'TuXFxdIHz2r71NbW', 'web', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'ggbUtbTh', 0.00, 0, '2018-09-30 18:56:56', '2019-01-18 14:38:03'),
(21, NULL, '9655788935', 'senthilbaskaran001@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'efc2SzoBqgg:APA91bE1Oohcy57GqEUNqSgAVHSM4qshl25H6vN57VnxVq9jVQYcfkw9T54u9AHiDb8u0st4CSgbQqq16aN-OU5IEA9ihfdLFAkSt9c8xRUVWd-CYPCiF6SxUuxae8tEWpqCQQU0mXdP', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'Lng6mMvi', 0.00, 0, '2018-10-01 11:45:42', '2018-10-01 11:49:06'),
(22, 'Praveenkumarrrr', '919600771099', 'praveenkumartup@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '6CCYNMmYlJxuyiw2', 'android', 'dTzUNsCbEow:APA91bFWjCpoGNOYEH8g3FKhw9qfJXerr74n-cCOpm2HRqOk6UZFUbfDV5py4r4pdkvNN4F0UIarMeFQKQ63_5RhWei0tITY86PT7Fz0-IjNRNdUqH08j7BRRqIqBZJKBvBjP_tuyVqN', 3, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'U1r5ourq', 0.00, 0, '2018-10-03 13:52:28', '2019-03-22 10:48:01'),
(23, NULL, '9524722184', 'girivignesh3@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', '0', 'android', 'dzjqtHZVJU0:APA91bGAKujbZwYWcs0c-ys0B7gyNVxRHBK7Cg8IXRTzm-lyhZ7e37TV2iQ9jV1lzt8uVsn_QpBwhJT9Wg08WUZnw9ZeZ0qpB9tiwW-5C1B7eucvEV5rjpRrjHXeOERg2H3xu2YhePi-', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, '8cBUIk50', 0.00, 0, '2018-10-04 06:43:24', '2018-10-04 08:01:31'),
(24, NULL, '8508904650', 'praveenkumartup@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', 'KDR52FtAyDmCdMuM', 'android', 'dzjqtHZVJU0:APA91bGAKujbZwYWcs0c-ys0B7gyNVxRHBK7Cg8IXRTzm-lyhZ7e37TV2iQ9jV1lzt8uVsn_QpBwhJT9Wg08WUZnw9ZeZ0qpB9tiwW-5C1B7eucvEV5rjpRrjHXeOERg2H3xu2YhePi-', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'oKB12Evi', 0.00, 0, '2018-10-04 08:03:22', '2018-10-04 08:03:22'),
(25, NULL, '9876543210', 'itprojecttemp@gmail.com', 'VGlyR0piazZ1b29KcDM0NnM4dFZ4UT09', 'a309i5qZbPzOjXzT', 'android', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, '35b53Gec', 0.00, 0, '2018-10-13 06:44:07', '2018-10-13 06:44:07'),
(26, NULL, '1234567890', 'ft@sparkouttech.com', 'VGlyR0piazZ1b29KcDM0NnM4dFZ4UT09', 'yXhvYJeFBgXVtKSh', 'android', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'DOE1u226', 0.00, 0, '2018-10-13 10:49:50', '2018-10-13 10:49:50'),
(27, NULL, '23467845', 'sample@blankpagers.com', 'UkFuVTVYS1hwOEU3Q3pTQy9LTGtEUT09', '70ErYek1jw6mclzq', 'android', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'X3Ov7oef', 0.00, 0, '2018-10-13 11:27:20', '2018-10-13 11:27:20'),
(28, NULL, '523465985487', 'jsadhg@hsjdf.d', 'UkFuVTVYS1hwOEU3Q3pTQy9LTGtEUT09', 'Nm8CrOQag8CdWcIp', 'android', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'HAcFJZCZ', 0.00, 0, '2018-10-13 11:28:51', '2018-10-13 11:28:51'),
(29, NULL, '1276434562', 'sa@gb.v', 'UkFuVTVYS1hwOEU3Q3pTQy9LTGtEUT09', '1OfEShRLOeVoNa72', 'android', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'Zur2NG3c', 0.00, 0, '2018-10-13 11:31:46', '2018-10-13 11:31:46'),
(30, NULL, '129834765', 'sample@sd.cm', 'UkFuVTVYS1hwOEU3Q3pTQy9LTGtEUT09', 'RLWy9myTj28uQkwc', 'android', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'bo055TTe', 0.00, 0, '2018-10-13 11:34:32', '2018-10-13 11:34:32'),
(31, NULL, '6549821514', 'as@dsf.sdf', 'UkFuVTVYS1hwOEU3Q3pTQy9LTGtEUT09', 'PIu6EkTzTT94aHaU', 'android', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'Z9VUWBRe', 0.00, 0, '2018-10-14 03:26:39', '2018-10-14 03:26:39'),
(32, NULL, '5677813256', 'as@df.df', 'UkFuVTVYS1hwOEU3Q3pTQy9LTGtEUT09', 'en43YTO1TLW7MY4A', 'android', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, '4RVMb7DE', 0.00, 0, '2018-10-14 03:29:18', '2018-10-14 03:29:18'),
(33, NULL, '9865214577', 'test@blank.com', 'ZURYcDU1RllENXhMUUwycmpnY2tkQT09', 'HBSFF76e3QguGV3Q', 'android', 'abc123', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'VXvlyqnL', 0.00, 0, '2018-10-14 03:30:32', '2018-10-14 03:41:18'),
(34, NULL, '96001099', 'praveen@spaekouttech.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'duje0A3iDuY:APA91bEnIyFNRIEo4yy54bLIYi61soPDUONpkt2HCFS0ntBhjE-RxznfrCYd0FAmsuX1YzFcQojFpdMnihB9nPdbT9PBzvbGzCD2sEs0Wpc8GdBsqQsiYmAMHte6qJcR0pnJjPuKL1yq', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'g27euyOM', 0.00, 0, '2018-10-15 18:41:13', '2018-10-16 09:11:01'),
(35, NULL, '8095819472', 'poojariabhijeeth@gmail.com', 'VGpXUlRIWlRMTmt1UHR0b2NWMlFKdz09', 'pvSfo5TY3WcNZoCp', 'android', 'dlF-1XVj5FA:APA91bGWGqEepx5yBZMeEO1Si56gwq9GEXlUe-RyfK9qyOFfgD0B4oSZTYoZvdcXrESgmNVDOJvecg-VyvbqT1MR7jPdKXXmqtIBA03q2pw2CDBKLKdLgmPbESE0srTl6zqUDZofFjgD', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, '77vOWSaT', 0.00, 0, '2018-10-26 12:03:03', '2018-10-26 12:03:03'),
(36, NULL, '+918309435509', 'mangodinefood@gmail.com', 'dE9DY2EzRGZpcThYeVlxVW1OTjBrdz09', 'UJOnbYYuimDCWvkh', 'android', 'fYZlcwo71rA:APA91bFSTVVekoJ1y1oEazrpPtNQXnu1e5f8L44sbYrBgti6EkF0_-ApHngkpziAvIc1HN6sfD6Ey-IJazcOvlBxCCNJzDP7Mo_8x3cGBcmooLSc3tSyHK7enWWhcTcTXXzDdBPGWwZm', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'u8ZXsuZ4', 0.00, 0, '2018-10-28 02:31:55', '2018-10-28 02:34:00'),
(37, 'santhosh', '9942174014', 'santhosh@gmail.com', 'RTlHeExFbDB6OTd6amxhWE80VzBEdz09', '0', 'web', 'jhsvjx', 0, 0, 'http://54.218.62.130/eatzilla/public/uploads/N9iKAFVk0HFIQ5gx9RHGDLn9wLjI9r4X.png', 0.00, 'IKr3gGnK', 0.00, 0, '2018-10-28 03:36:11', '2019-01-19 15:48:37'),
(38, NULL, '9095471451', 's.santhosh51@yahoo.com', 'RTlHeExFbDB6OTd6amxhWE80VzBEdz09', '6VZaoaiGVe81iIYd', 'android', 'abc123', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'j4htPd4h', 0.00, 0, '2018-10-28 04:33:48', '2018-10-28 05:57:51'),
(39, 'santhosh santi', '99421740140', 'sssanthosh298@gmail.com', 'VGlyR0piazZ1b29KcDM0NnM4dFZ4UT09', '0', 'web', 'jhsvjx', 0, 0, 'http://54.218.62.130/eatzilla/public/uploads/tDLNYQf6HB2GbVUL9UdmVo0N6nPHawOD.jpg', 0.00, 't1fY1X9J', 0.00, 0, '2018-10-28 06:00:03', '2018-11-24 10:47:51'),
(40, 'DhivyaMurugesan', '9600975087', 'shobikababu1996@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', '0', 'android', 'dbby22clE3A:APA91bGViHZyhoxXsbWXjZ6H1PCPS6OoZkYkJrX326nOnqBD2C6dBd8hUC8GYgJbDX10uLrIZU3QZK4l8w8DfINEnYQ5UtJEfCJbikjiYXWQ61axA90wO6KaYlhO-WeCqUTA_dfHipHE', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'e0yDXr6e', 0.00, 0, '2018-11-09 10:55:07', '2019-01-14 13:22:37'),
(41, ' ', '99421740146', 's.santhosh561@yahoo.com', 'VGlyR0piazZ1b29KcDM0NnM4dFZ4UT09', '1CXXIaUfe9TsdZnJ', 'web', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'ybN8iK1B', 0.00, 0, '2018-11-14 11:49:28', '2018-11-14 11:49:28'),
(42, ' ', '919600771', 'praveen4@sparkouttech.com', 'VGlyR0piazZ1b29KcDM0NnM4dFZ4UT09', 'Zek5yvHyEwLkTPig', 'web', 'abc123', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'VumzyneO', 0.00, 0, '2018-11-14 12:24:35', '2018-11-14 12:29:02'),
(43, NULL, '9876543329', 'jeeva@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'dhcKLEQyHtg:APA91bH4CM13QejBnk63FFL51cmHS-R9zPD_dCj9-43AEWzlQpoMRvlJ4CfIGu_oZM_U1u66PtVi5SLw-pUhmP2rjvtN9g8cxVXv923r7OZlvqlDka8rTgGCe8DBdl0ZWrmOSVkHYt2L', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'rAMatisF', 0.00, 0, '2018-11-15 05:39:10', '2018-11-15 05:55:44'),
(44, NULL, '9976790909', 'ken@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0IdwOkRbGgeWWC3g', 'android', 'dhcKLEQyHtg:APA91bH4CM13QejBnk63FFL51cmHS-R9zPD_dCj9-43AEWzlQpoMRvlJ4CfIGu_oZM_U1u66PtVi5SLw-pUhmP2rjvtN9g8cxVXv923r7OZlvqlDka8rTgGCe8DBdl0ZWrmOSVkHYt2L', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'nBFxcJww', 0.00, 0, '2018-11-15 05:56:46', '2018-11-15 05:56:46'),
(45, NULL, '9789369927', 'keerthi@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'D6YKLiVdj90vC6ep', 'android', 'eam6MYNY8k8:APA91bFhrB4T7FrMHKHFe5RDAFYg2YCd-YOAd5Cg5ko1FBwwvjwP7WTauAXGHyVAJcYSFuy4gKglt-VCbOK1i32DKf9lk5f8Ho7YjOZ_0JYAvh8rPstSYqq9OUvAvVyr4Eys3PVlgNiO', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, '3OhTa9cd', 0.00, 0, '2018-11-15 16:26:09', '2018-11-16 04:58:15'),
(48, 'Praveen kumar', '8508082716', 'praveenkumartup1@gmail.com.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'h5WffiHajK3i7I1W', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'mbt3aEHS', 0.00, 0, '2018-11-15 19:25:56', '2019-02-23 17:12:29'),
(49, 'saminathan v', '7373343302', 'santhoshsaminathan3@gmail.com', 'RTlHeExFbDB6OTd6amxhWE80VzBEdz09', '0', 'web', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'Iely6NwO', 0.00, 0, '2018-11-17 07:45:02', '2018-11-18 13:44:10'),
(50, NULL, '9788429214', 'devicetesting000@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', 'D6YKLiVdj90vC6ep', 'android', 'cssfeNcb7RY:APA91bEIMmI0WGZivCMvnMvXEKVLctEER-0uq9egM6n-a45dIhdtsZxBX1CuAZR81Tx8xYaaes8nc97NcjJQRjZakhT2xskAvaVPAUTttuScBNAuc7QHDQVD8XbhwU9lSses5AbITw1q', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'sH61onRG', 0.00, 0, '2018-11-26 07:04:34', '2018-11-26 11:59:29'),
(51, NULL, '867726177', 'vishnu@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', '0', 'android', 'cssfeNcb7RY:APA91bEIMmI0WGZivCMvnMvXEKVLctEER-0uq9egM6n-a45dIhdtsZxBX1CuAZR81Tx8xYaaes8nc97NcjJQRjZakhT2xskAvaVPAUTttuScBNAuc7QHDQVD8XbhwU9lSses5AbITw1q', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, '2svWqvpg', 0.00, 0, '2018-11-26 12:10:00', '2018-11-26 12:32:10'),
(52, NULL, '8667726177', 'vishnuvardhan@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', '4Q2wToaicI28gwjw', 'android', 'cssfeNcb7RY:APA91bEIMmI0WGZivCMvnMvXEKVLctEER-0uq9egM6n-a45dIhdtsZxBX1CuAZR81Tx8xYaaes8nc97NcjJQRjZakhT2xskAvaVPAUTttuScBNAuc7QHDQVD8XbhwU9lSses5AbITw1q', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'SBIhJETv', 0.00, 0, '2018-11-26 12:35:19', '2018-11-26 12:47:38'),
(53, NULL, '988556899', 'nivi@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'qEXCbmU6utAUoDHl', 'android', 'es8RqS98JBY:APA91bEYyuG1S3B1ZkyHZ9B6_2Xv3SsNn-9rlR0pGP5Lk5Pv8kEITzUmkaGm-9--LscpwqPXz-pVpr1YRm-kEUWFSndEgwhgl6dKiYW16ueX2HF3h5NKOCoLGg4T5bMdm3rNo3wRMcEF', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'LFOl1wA1', 0.00, 0, '2018-12-04 12:30:17', '2018-12-04 12:30:17'),
(54, 'Sri Nataraj', '9677552235', 'srinatraj.kailash@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'RBVEJr4HDkQhJath', 'android', 'dfwiDSDBlSo:APA91bF3t5DQrw9_SiOB2JMSWTxjHu64Hx2arIjS1CmAl0KSqH_T91KJh8ry-C6OQvYZsvmyDd4p6yY3mDV6u_fEHWL7vIVR3MxCm70g4lrzkVjlM_9Nc6vJelSn36TnjYyuZaaY3BKY', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'CeolHgFc', 0.00, 0, '2018-12-24 06:24:51', '2019-01-19 15:04:54'),
(55, 'Kailash', '8754188861', 'sriangel13.17@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', '51HRCQYT0e07z03e', 'web', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'vgp2g0Zc', 0.00, 0, '2018-12-24 10:43:04', '2018-12-25 18:05:14'),
(56, 'balayuvi', '918667745527', 'bk', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', '0', 'android', 'eegYt4RPRHU:APA91bHjDlbBB3P53t7ybnL-j4U8MRI3LttnNYG82lJHqYDuraZRq5SeeveqN8P9ny1mwKMlc0wT14ObhKkKOPQQ8OLfEGRqkiRKI5dko0Ucu_wkBTuemqRNwsItRnldStw3AotlCXoH', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'Dl2bjPzL', 0.00, 0, '2019-01-04 08:05:54', '2019-03-04 15:17:54'),
(57, 'Balayuvi', '919445523942', 'balamc1717@gmail.com', 'QmN6emZVUFNPVHlGUXVLK0lzc21BQT09', 'o8kGi2wO3gNX3T8l', 'android', 'eTB2ttFCS-I:APA91bFQmZH9ZE2OyeHVqPP-gSZxpkPIQddH5FU61zT4uaCvhSmC2jks2MIUDQsqPioV9jVUA_0dUgQPocvuhj6LrWYujDlygFyb164PaWcV7dVaU3FutDkdq8KWkzRY1f-zcBV55s8G', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'tcss3vnJ', 0.00, 0, '2019-01-04 12:08:56', '2019-01-09 12:58:49'),
(58, NULL, '9578650552', 'sundareshwaran2308@gmail.com', 'ajk0T1FxTlFvaXVKZit3MUZ0RHNrZz09', 'NYSxd0fTzyjVvCyQ', 'android', 'f8bXhtjDTFY:APA91bG1CpR99yGkqZV7gGwcjWmGZZJpeLc04jKyfLkVlaPnQ-DEMYJp2rt4IhmIzuRQfJuJrKPc12BWR4NsunYgCpf-f5sH69ygmk4DIyhIzosfi1h3tTGeYKmAB6HadexxTTcE6sC6', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'wBSD7tgS', 0.00, 0, '2019-01-07 09:57:25', '2019-01-07 17:17:03'),
(59, NULL, '+918072511253', 'hariharasudhan2802999@gmail.com', 'OU1UNFpHZVdsYzB6bU01TkZLTDFHdz09', 'GUgmLtBa69xrli3v', 'android', 'eWaow1okQis:APA91bHCGqhhNKKdYs2Jk00b__b-fuyMKGF-EyBCW2wmcET_MI49ZgSCWXmdgtJSlX1ZS1LgUg573StNPnZ2-x6jnikEpeWDR9MsR4air7gIFz4xO4dOiL2Vrp6QVqBUcjXm_NXyGYBc', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'T4XyGOva', 0.00, 0, '2019-01-11 03:59:16', '2019-01-11 03:59:16'),
(60, NULL, '88701559', 'siva@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'dIfngOGGDak:APA91bECq5I1P_ZewtcEHbsNp1d7ZApQmfoj3iZnkkLDzW-MhJKgp7--60DArKmD3OQ9XXS6djJx24tABlg_S1VsFwg62m-6S4c2dTi_Eq39YmfUN-hs-9PUmonQZmdJU7jQsIfyXuXs', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'Fr1JR9wT', 0.00, 0, '2019-01-14 12:16:17', '2019-01-14 17:55:44'),
(61, NULL, '8870155970', 'marc@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'dIfngOGGDak:APA91bECq5I1P_ZewtcEHbsNp1d7ZApQmfoj3iZnkkLDzW-MhJKgp7--60DArKmD3OQ9XXS6djJx24tABlg_S1VsFwg62m-6S4c2dTi_Eq39YmfUN-hs-9PUmonQZmdJU7jQsIfyXuXs', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'VqwfylpO', 0.00, 0, '2019-01-14 12:30:24', '2019-01-14 18:04:10'),
(62, 'Senthil Kumaran Baskran', '9363009450', 'senthil@sparkouttech.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'V6fk8eX1a4LXTLeg', 'web', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'OOVayTVb', 0.00, 0, '2019-01-15 06:55:39', '2019-01-18 14:35:15'),
(63, 'Dhivya Murugesan', '9677861702', 'dhivyamurugesan@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'NbYCKU3BJ3gV5RrC', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 's85Gj6BR', 0.00, 0, '2019-01-17 07:54:09', '2019-02-20 12:42:42'),
(64, 'karthik s', '9677861703', 'senthilnagalakshmi1998@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'rBIRjiWht6FgnKNp', 'web', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'uCFtvbLj', 0.00, 0, '2019-01-17 09:51:28', '2019-01-17 09:51:28'),
(65, 'riykarthik sk', '8072531377', 'sanjeevnaga1998@gmail.com.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'eCjyFrmnQDM:APA91bEWvAHjQ-MfBTn_AfFAHLfUUdkU28fww1ILrPB5MM-xqjVVvvlMIpCrSBPqPrj8OGPDB3as5n-GnD-8Tz0_nkZRiAkHdqi3u9xrbyzmWfVzR8r5CcR8Cv1Phd5aRpKDgDU54Xk2', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'gDzmf0On', 0.00, 0, '2019-01-17 11:38:19', '2019-02-23 17:21:39'),
(66, 'karthik keyan2', '9894815993', 'sanjeevnaga1998@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'uQ5uoK7kbVXudVeX', 'web', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'rPIm9IUK', 0.00, 0, '2019-01-18 05:06:18', '2019-01-18 11:32:18'),
(67, 'santi s', '9999999999', 'santhosh@gmail.co.in', 'RTlHeExFbDB6OTd6amxhWE80VzBEdz09', '0', 'web', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'RDypzKdU', 0.00, 0, '2019-01-19 03:15:22', '2019-01-19 18:04:32'),
(68, 'Dhivya Murugesan', '7010972363', 'yokesh@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', 'LfTbWd7LIyx40xTx', 'web', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'HJZOpUeh', 0.00, 0, '2019-01-24 11:49:49', '2019-01-24 17:29:51'),
(69, NULL, '8072325352', 'ssveinfo.91@gmail.com', 'dHI1a293clJlWURnR0dWM05RU3lBQT09', 'o7XTsJ6VqDbPLJD7', 'android', 'fIGjeP9AEao:APA91bGauvYjllA_QsDIKgkEJdi_v0AbUjfBFRcMzDWuQ97bFVyhInqZCipw-hkIaWpa5ZvRrZ_XrjYewSwlO8fnVV3REb4N9e0Nrc8u5vxshaRbvbLXJizElWcz42xPyOGEfIXOvJfc', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, '0SOQSY3R', 0.00, 0, '2019-01-30 07:43:39', '2019-01-30 07:43:39'),
(70, NULL, '918508082716', 'praveen1@sparkouttech.com', 'VGlyR0piazZ1b29KcDM0NnM4dFZ4UT09', 'dJ0Gzjlxc73O3wmN', 'ios', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'NLAV0rhI', 0.00, 0, '2019-01-30 16:43:18', '2019-01-30 16:43:18'),
(71, NULL, '1231', 'wfwdf', 'YktYRjI0WGlSaXBnQmlrdFFXcUFwQT09', 'aYv9MvMSHRbs2ZSB', 'ios', 'dfw', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, '2vMggcyY', 0.00, 0, '2019-01-30 16:58:38', '2019-01-30 16:58:38'),
(72, NULL, '27383', 'Shen', 'cTVQMlY2WURWbGp5dTZIYU5vS1lYQT09', 'txU2kywxhxeQRAo4', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'HrSLYeyM', 0.00, 0, '2019-01-30 17:05:24', '2019-01-30 17:05:24'),
(73, NULL, '27383shhs', 'Shenjsjsjs', 'cTVQMlY2WURWbGp5dTZIYU5vS1lYQT09', 'ZZCxtqYlG7JiLDBr', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'zKFs5kFf', 0.00, 0, '2019-01-30 17:11:35', '2019-01-30 17:11:35'),
(74, NULL, '983920288:9292', 'Shenjsspkjnqjsjjsjsjskkjdjs', 'cTVQMlY2WURWbGp5dTZIYU5vS1lYQT09', 'v7HL9XhNQHz041ow', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'GFprypt4', 0.00, 0, '2019-01-30 17:12:41', '2019-01-30 17:12:41'),
(75, NULL, '272839393', 'hdhdjsjsjsjsjshhs', 'SmpKL0dGTHIwTW5uekhoUFJPNm9Gdz09', '7tp3XNd7MIhye4qV', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'VCnXCgzE', 0.00, 0, '2019-01-30 17:14:00', '2019-01-30 17:14:00'),
(76, NULL, '12344321', '1234@gmail.com', 'VlQzZExLNjE5dk16MElTL01jeGVMUT09', 'NLYTAcFt0nhHpVbl', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'zEoXqQaB', 0.00, 0, '2019-01-31 14:44:47', '2019-02-12 22:40:07'),
(77, NULL, '918095819472', 'poojariabhijeeth@gmajl.com', 'VGpXUlRIWlRMTmt1UHR0b2NWMlFKdz09', 'tuZrf7VnIGpOoFUs', 'android', 'ecE6vMciS6M:APA91bHrJhiQVLYvizN-iLw6G2JaDs3wYqY2phA4Y21YtyTxQx9vhzSahsvu-3yRFDDW6I-4Z6_aOnHoUhRfg0SmfrAbBb47ir8kR_u2j__vKJJdOJRmv6zEgxGCWqkqHCa4eSc-Fz5j', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'zpgE76RL', 0.00, 0, '2019-02-03 08:21:56', '2019-02-03 08:21:56'),
(78, NULL, '919894279369', 'sathish0073@gmail.com', 'dE9DY2EzRGZpcThYeVlxVW1OTjBrdz09', 'cZWF3TR6exwsBLHi', 'android', 'eb1QF44Lj1Q:APA91bHNfQAq_eJIyvEMA1pbtcigVm2bT4QtH_hzN6-2Xhnv6rO338JjvKIxal7CQrOJ5sUHLnu6KxBqjXIqVQ2p0-4dIfwd7ov6VUgYIXRRC12RiK98TGdJBstrTKYlx3rvgTzVALbe', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'JIu5Wdo5', 0.00, 0, '2019-02-07 15:41:03', '2019-02-07 15:41:03'),
(79, NULL, '9894279239', 'vino.ece94@gmil.com', 'MGlLcHc0VEF4S29aa09PM0Y1OFdMUT09', '8hyxeuGjSlUnlzMc', 'android', 'ffVRBxil3Vw:APA91bHVG_9LqtHUlRv2Qe5gcs8zfUfIwxbrYZROCRFjWQyz1FlwI95AIEpTH3OpNWWwERw3SASdrM0wLx3vtlZmisy9D-iRwMJN6eLNuKvTmaIz--3mrGGq8fZY3Tus3cJkDLtEWbl3', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'x5IPgAqB', 0.00, 0, '2019-02-09 06:59:14', '2019-02-09 06:59:14'),
(80, NULL, 'ycy', 'cut', 'SW1MWVFjS0NQSk8wdFY1MHh0eVkydz09', '0', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, '6VINmqke', 0.00, 0, '2019-02-18 11:18:07', '2019-02-18 22:08:33'),
(81, NULL, '908042697571801', 'rubanrubi24@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'EeDjmYbtSlk9oWAW', 'android', 'fcjLgfKKlrk:APA91bGz1S7l9VSre81w1IHf6rd1TzKepX_1z_g8qlEqJqr1tukrsikHal83CzptjSPNaOKsZk6y_IipWuFmarXc5f0wsqzd-7Bh4WZCVb3tHe91Jx1ZaW36_jhdqUIiyTwes-pgVBdz', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'G5tjWoze', 0.00, 0, '2019-02-19 08:33:12', '2019-02-19 08:33:12'),
(82, 'Ljiljak Aleksandar', '38163500250', 'ljiljakaleksandar@gmail.com', 'VXkwUzFucEVPdWRULzBiMzBCMWU2Zz09', 'mykWywSP7xdkoMyz', 'web', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'giPNgCOL', 0.00, 0, '2019-02-25 12:14:29', '2019-02-25 12:14:29'),
(83, NULL, '8870934251', 'keethi@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'PbBIyCucG9NZ4HxA', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, '5kRUldpf', 0.00, 0, '2019-02-26 11:08:04', '2019-02-26 11:08:04'),
(84, NULL, '8870558283', 'dhivyadinesh3995@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', '0', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, '1ixpLs4w', 0.00, 0, '2019-02-27 10:49:02', '2019-02-27 16:20:02'),
(85, NULL, 'hookah', 'balamc1717@gma', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'y4VgbXjx', 0.00, 0, '2019-02-27 10:51:50', '2019-02-27 16:23:07'),
(86, NULL, 'Cunningham', 'hello', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'Apo9fZSO', 0.00, 0, '2019-02-27 10:55:03', '2019-02-27 16:25:27'),
(87, NULL, 'hello', 'hi', 'RkphUFRrMWxNemJ3Y0VRQzRWT0l5dz09', '0', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'l0mokbfB', 0.00, 0, '2019-02-27 10:55:40', '2019-02-27 16:34:16'),
(88, NULL, '9994667854', 'balamc1717', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'xjMSKaHJz522rART', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'foYSuUMM', 0.00, 0, '2019-02-27 11:10:37', '2019-02-27 16:43:33'),
(89, 'Franco Garcia', '3572505012', 'francovico34@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'fR2wD0qN5-U:APA91bHUiwURK6XlSkT9xqUwAY1lsxSkYic6gRJtvJwgatfqMxM2yTzikEhcwSjjSie2REH6-0jNaoJNrIgIG1MyMhYpp0W4iZpIXNwkcaorDBqWRGVJKpccqCKpw16YkJ8quLmyBAzw', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'OJL1VTVT', 0.00, 0, '2019-02-27 11:27:31', '2019-03-05 19:51:12'),
(90, 'Bala', '9487757356', 'balasteyn1717@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'UzDHe5H09KOqj2tX', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'Obs0U90S', 0.00, 0, '2019-02-28 06:16:38', '2019-03-04 11:04:32'),
(91, NULL, '917010972363', 'gv@test.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'Q0AYAjq7GAklurfS', 'android', 'cRvMFBmMYf0:APA91bHAUvIjIQqcvtSmT6_jxcQdOddfPV578aYQPDoeFT-omKp3pcJve-zWQ6_7q7GH_MaOLoHcPmdJ-yJgE9o_QKhGiA-_TT-Rjmj72yy4QOK-EFoatGx_mfpQHW8CciFjiCeLGWfC', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'EFR9SfNc', 0.00, 0, '2019-03-01 08:13:33', '2019-03-01 08:13:33'),
(92, NULL, '919994810451', 'karthik.1bca1417@gmail.com', 'SVp6TnZHbFRqdiszMlM1WktKdXZjQT09', 'cAV0C33k8HSW4rQv', 'android', 'fJkShkPoWd0:APA91bHmolqNZAzbaQa9jo6fh3qINoxowosJy3XQaK4Zpvp0ItAmLv8-ks8zeP6E160217_NEE9OBE6fViNcf1KejNX41AXRzNmjBv7ZhCsonrwWt2kwvB7Qt0WwUsz3tMV6hLheMq2Z', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'rojSQiVK', 0.00, 0, '2019-03-01 09:24:53', '2019-03-01 09:24:53'),
(93, NULL, '12345qwerty', 'awe', 'emhXTGhub1ovVkU0ZlZSUWN4SDBSZz09', '0', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'K3ZKsBVK', 0.00, 0, '2019-03-02 08:20:04', '2019-03-02 14:05:20'),
(94, 'hello', '9080706050', '9080706050@gmail.com', 'ZVBlMC84dFZMdU1VMFRQVEIySnFwUT09', '0', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, '4z3o2Duq', 0.00, 0, '2019-03-02 08:36:18', '2019-03-02 17:42:19'),
(95, 'Saranya', '919629456271', 'fg@gmail.com', 'VlQzZExLNjE5dk16MElTL01jeGVMUT09', '0', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'cWygdXh8', 0.00, 0, '2019-03-02 12:25:56', '2019-03-06 17:07:37'),
(96, NULL, '7904749314', 'dinesh@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', 'My0yMsQcG0G2o46u', 'android', 'cMSSlhlEep4:APA91bH51jPSxerWfIauZGiEsFiXUqh_jKRWlP1UxuB4VkWulApDBvJ12AcwNXIn-Fx8SsZHtTgG9G-bECFPs5eUIsVqykJYa7l6G7U8YFomFhX0ObLLiauBO0NiNstxr6ky1S8g7ilO', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'uEoiCMQV', 0.00, 0, '2019-03-04 05:02:52', '2019-03-04 05:02:52'),
(97, 'Balki', '6385754231', 'baladhoni1717@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', 'uR9ln4ersyoTwbNl', 'android', 'eegYt4RPRHU:APA91bHjDlbBB3P53t7ybnL-j4U8MRI3LttnNYG82lJHqYDuraZRq5SeeveqN8P9ny1mwKMlc0wT14ObhKkKOPQQ8OLfEGRqkiRKI5dko0Ucu_wkBTuemqRNwsItRnldStw3AotlCXoH', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'maD7Kdi5', 0.00, 0, '2019-03-04 09:53:05', '2019-03-04 15:32:01'),
(98, NULL, '962893018', 'dsf@gmail.com', 'dDlXbERGUFMxVjZiTUcyZVhiOGo2Zz09', '0', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'BKtradsg', 0.00, 0, '2019-03-06 01:56:45', '2019-03-06 07:26:53'),
(99, NULL, '19524722188', 'base@test.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'cv9isv9d4uk:APA91bG2_kx-l-kyLgrcjEyfkl6K1oaKzYl3DC4vdKpgpQjhiWPHYodRmV8ARo9SWclTzWcFHpNR1I8QSB3NaPyxjH08PhALnt6N6n9eDcLeU5VotdsQnUQ90uS0w4-C33N0HMIs1xYe', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'ND2y7tIl', 0.00, 0, '2019-03-06 06:00:43', '2019-03-06 14:28:54'),
(100, NULL, '15536956339', 'fg@gy.uj', 'NEVmallkV1lDQmtEcW0zdWVrRW5QUT09', '0', 'android', 'cv9isv9d4uk:APA91bG2_kx-l-kyLgrcjEyfkl6K1oaKzYl3DC4vdKpgpQjhiWPHYodRmV8ARo9SWclTzWcFHpNR1I8QSB3NaPyxjH08PhALnt6N6n9eDcLeU5VotdsQnUQ90uS0w4-C33N0HMIs1xYe', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'Cbou9Xnl', 0.00, 0, '2019-03-06 08:59:14', '2019-03-06 14:29:22'),
(101, NULL, '628174161758', 'myfacefx@gmail.com', 'UDdOanRkdmhlOFlYOFRTR21wYlZRZz09', '06xWurtaLBp2IPFL', 'android', 'cjkVfPbsaKU:APA91bGc_y809KPj4K1wZIDoVu1sGpU8zrdwmCsEBN-84Z84NHyB17asQE0NYsU4xsWlyjRqAUc7Xr_FgLn-YBkCHp5Bz8S4YQfhpVbJM8aoobQUeGdFKvUf5tuPqrHuJ01M7M2TIvQc', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'UK5jT33d', 0.00, 0, '2019-03-06 09:15:14', '2019-03-06 21:54:25'),
(102, NULL, '1986646768668', 'hxh@heje.jdjd', 'Vm1acHBJZ2p6YkNzMnI3NW4yczByUT09', '0', 'android', 'cv9isv9d4uk:APA91bG2_kx-l-kyLgrcjEyfkl6K1oaKzYl3DC4vdKpgpQjhiWPHYodRmV8ARo9SWclTzWcFHpNR1I8QSB3NaPyxjH08PhALnt6N6n9eDcLeU5VotdsQnUQ90uS0w4-C33N0HMIs1xYe', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'd0Ncj6Ol', 0.00, 0, '2019-03-06 11:13:24', '2019-03-06 16:58:37'),
(103, NULL, '919442409160', 'mail.nivethacse@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', 'Z2dXO1C4XDcXXDYm', 'android', 'fZosz4SVK7M:APA91bGZrusSWvxFdzuBiLTH6ozHRrAdblXZWG-12dRFxxtXWViDiDLLoTMNUptxPM2mFq7OwT-pxiuVubkACYLmr1-OUbI2l3tVfGkGc-_CtT4_HjZvNEl0MGwVvkcKCXd9KE7Kiuhr', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'U9mhZUMH', 0.00, 0, '2019-03-06 11:15:56', '2019-03-06 18:23:34'),
(104, NULL, '13069995200', 'omarmahfooz@hotmail.com', 'dE9DY2EzRGZpcThYeVlxVW1OTjBrdz09', 'xxJ0u0Rv7x3bSLwm', 'android', 'd6gOEGusxxE:APA91bEzw9jFJEMf378pCff0vgbEJEbGDgOzdlCcKV7w_QJyaQ21j-PXezc2fmIRmZWNrcnxT2WBmM1sBlqXsZ0BUQyf_ckrY7e5m2DBc07xuUT13bfrhR-GJBZkCqzQRRlDf4XE6aQY', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'xPcvXEEu', 0.00, 0, '2019-03-06 12:39:48', '2019-03-06 12:39:48'),
(105, NULL, '6281235962100', 'trivaroom@gmail.com', 'UXROVkNpRmM0S0d0VmZYWTQ2RjAxQT09', '0', 'android', 'fHf_k02tR1k:APA91bEhc_MfKpuae9GAS9ND5bC4H56CUXSkPl8OTxw0a-_UVn4VFxa3lXqMNrje1OayWhS2c9UmDLWV8X6L5IHxYQQnJyOGtkarMMufVrpx3JvCgDbCpOiZd6-kMUWvs4aPYooVxKFI', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'oUWVtaPQ', 0.00, 0, '2019-03-06 15:43:17', '2019-03-06 21:27:23'),
(106, NULL, '918056359277', 'siva@sparkouttech.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'oN6cXh3gfXGKrBOZ', 'android', 'f5phrw_GXrk:APA91bFWrYBsDqdwpVahy-VlX7PuKhIXkX4fkGWE6Tl8SJ4yYPnyZhNTRcyWpg-DeBS2HRthCUKrZ0bxk5A4W6OkntDuvOJQ-_H8Fzjrqc1i-nRqNn1vB0TIEc5GuGAzW56YcO8OGn0I', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'B8uioDeS', 0.00, 0, '2019-03-06 18:12:04', '2019-03-06 18:12:04'),
(107, 'Steven G. Catt', '9702301145', 'sgcattent@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'x5F0PO7PtrX8a179', 'web', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'DKVzHLls', 0.00, 0, '2019-03-07 05:13:03', '2019-03-07 05:13:03'),
(108, NULL, '8622333096', '1rohanwebb@gmail.com', 'NUtybWdjQllYaHExa2VQL3Vzd0x5QT09', '0', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'EOd0yFfH', 0.00, 0, '2019-03-07 11:03:01', '2019-03-07 17:08:23'),
(109, NULL, 'iPhone', 'Airline', 'Yjh3cXowOXcvWUQySzF1RllaUVZvUT09', 'pDhyrEBa3kODLUiQ', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, '1u5JJlyI', 0.00, 0, '2019-03-07 11:21:23', '2019-03-07 11:21:23'),
(110, NULL, '17855636666', 'ft@fg.hjj', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'YCDDvNWBpUs8eBAf', 'android', 'fwAQSWX1GMk:APA91bFDdM64tH3kW-XtPvEJZu7zI5j54E8mxpHKMBvs6ktAHgmKqjnwqP1-IImFdt1F2wRq2JdQeEczmn7faWmcNwXg6TOuwZPqH5Oxb53XiMKyxMYtt68FQEOuxNgTS9POXh-nVtIx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'EMJnHrwh', 0.00, 0, '2019-03-08 11:05:21', '2019-03-08 11:05:21'),
(111, 'Jose Gomez', '3412345678', 'mescalante1988@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '8ZRcfkWxuW4SFY2m', 'web', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, '59jCnUfe', 0.00, 0, '2019-03-08 20:35:44', '2019-03-09 02:07:38'),
(112, NULL, '917814092325', 'vishk65@gmail.com', 'c1lPL3plcnVXUnNDSnd4bWtHOEZjZz09', '4kcbc2pygbFRt8Ai', 'android', 'dQ-pyHVDih0:APA91bExtM7WWVYcIA_ZJsL8oJ8Hvy5kGeaZ_Z_UvngMH864qFhOZqSHZQQaVqzmIcUKMuZTJztYeVPykATqTQ2bonWk8QLiesC8s1kEUYWVCKOHqtnNb-Lodn2GRijRymT9d6UEf6L3', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'pEpdzkxF', 0.00, 0, '2019-03-09 04:15:56', '2019-03-09 04:15:56'),
(113, NULL, '123409', 'as', 'SVVwTndzeHZOcC9nTS9lZkNKWFp6UT09', '0', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, '0Kbm7cft', 0.00, 0, '2019-03-09 05:29:07', '2019-03-09 10:59:50'),
(114, NULL, '213', 'ewe', 'QXVDa3pPbWpZQWE3WFppYXpsajFWZz09', '0', 'ios', 'dcfgvhbjn', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'vuzshQQu', 0.00, 0, '2019-03-09 05:32:09', '2019-03-09 11:02:33'),
(115, 'brazilcr', '5585987203023', 'baima@mediaflex.com.br', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'yCox8v5eo3mReWES', 'android', 'cPqOM6ZimmE:APA91bF0fbSd1pgqfKyl6_kVTd9mD7CB6RpIfLsDwBZ_Pnlyk5WpveGL8ikLmLbJs2hiOtlGQukEyemE0Roybh4hUmRQo3iSeBJXiYbJlhqNSMOyQ3ZueUow0FnrY2QNbky4PaIQ5F0l', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'L1fcofqP', 0.00, 0, '2019-03-11 18:35:48', '2019-03-12 00:15:30'),
(116, 'andrea tedeschi', '069089962', 'andreatedeschi.it@gmail.com', 'cStHbHc5eThveTRHWEVTdE9hY3N1dz09', 'DuJidk4nOQOsLLcq', 'web', 'jhsvjx', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, '9NurevsL', 0.00, 0, '2019-03-12 07:12:30', '2019-03-12 07:12:30'),
(117, 'Marcos', '5581997580840', 'chillimarcos@gmail.com', 'dnFrakVCcW5RemZwWDhOaStiQzhQUT09', 'mmiY3rkCZLq6hv1O', 'android', 'c84uvT7l3dY:APA91bH5oqKh8ruwBWUWhY7aSQGyeEME50Ey7QArfxl5dXz0OmDRkZfCZYFt7uO9KMju2MDLjXWGX86KFZ0qbvaZPVHoCNrSbXMACwUYkFpj5ZAfIEj4ALvWtrdqUqJgjqda6G4M1CrV', 0, 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 0.00, 'T7g0tSiC', 0.00, 0, '2019-03-13 02:26:51', '2019-03-13 08:16:26');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `vehicle_name` varchar(100) NOT NULL,
  `status` int(111) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `vehicle_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Duke', 1, '2019-03-20 10:49:01', '2019-03-20 10:49:01'),
(2, 'Hornet', 2, '2019-03-20 12:01:56', '2019-03-20 12:01:56');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_list`
--

CREATE TABLE `vehicle_list` (
  `id` int(11) NOT NULL,
  `delivery_partners_id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `vehicle_name` varchar(100) NOT NULL,
  `address_line_1` varchar(200) NOT NULL,
  `address_line_2` varchar(200) NOT NULL,
  `address_city` varchar(200) NOT NULL,
  `state_province` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zip_code` varchar(100) NOT NULL,
  `about` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_area`
--
ALTER TABLE `add_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_city`
--
ALTER TABLE `add_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancellation_reason`
--
ALTER TABLE `cancellation_reason`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_code`
--
ALTER TABLE `coupon_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cuisines`
--
ALTER TABLE `cuisines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_partners`
--
ALTER TABLE `delivery_partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourite_list`
--
ALTER TABLE `favourite_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_list`
--
ALTER TABLE `food_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers_banner`
--
ALTER TABLE `offers_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popular_brands_list`
--
ALTER TABLE `popular_brands_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relevance`
--
ALTER TABLE `relevance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_detail`
--
ALTER TABLE `request_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_cuisines`
--
ALTER TABLE `restaurant_cuisines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `track_order_status`
--
ALTER TABLE `track_order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_list`
--
ALTER TABLE `vehicle_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_area`
--
ALTER TABLE `add_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `add_city`
--
ALTER TABLE `add_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cancellation_reason`
--
ALTER TABLE `cancellation_reason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=720;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `coupon_code`
--
ALTER TABLE `coupon_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cuisines`
--
ALTER TABLE `cuisines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
--
-- AUTO_INCREMENT for table `delivery_partners`
--
ALTER TABLE `delivery_partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `favourite_list`
--
ALTER TABLE `favourite_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=388;
--
-- AUTO_INCREMENT for table `food_list`
--
ALTER TABLE `food_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `offers_banner`
--
ALTER TABLE `offers_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `popular_brands_list`
--
ALTER TABLE `popular_brands_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `relevance`
--
ALTER TABLE `relevance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `request_detail`
--
ALTER TABLE `request_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;
--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `restaurant_cuisines`
--
ALTER TABLE `restaurant_cuisines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `track_order_status`
--
ALTER TABLE `track_order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=447;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;
--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vehicle_list`
--
ALTER TABLE `vehicle_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
