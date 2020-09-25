-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 20, 2019 at 08:05 AM
-- Server version: 5.7.25-0ubuntu0.16.04.2
-- PHP Version: 7.0.33-0ubuntu0.16.04.1

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
(503, 22, 9, 3, '2019-02-19 17:39:40', '2019-02-19 23:09:44'),
(504, 22, 10, 2, '2019-02-19 17:39:46', '2019-02-19 23:09:48');

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
(7, 'Beverages', 0, '2018-08-14 11:17:54', '2018-08-14 11:17:54');

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
(2, 'TESTADMIN', 1, 10.00, '2018-11-14', '2018-11-30', 10, 10, 1, '2018-11-14 13:26:40', '2018-11-14 13:26:40');

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
(1, 'South Indian', 'public/uploads/V7mwdW41PLpPxyvR5JC5tDUmYgb706RW.png', 0, '2018-08-09 18:28:57', '2018-12-23 17:30:07'),
(2, 'Andhra', 'public/uploads/V7mwdW41PLpPxyvR5JC5tDUmYgb706RW.png', 0, '2018-08-09 18:29:10', '2018-08-09 18:29:10'),
(3, 'Arabian', 'public/uploads/V7mwdW41PLpPxyvR5JC5tDUmYgb706RW.png', 0, '2018-08-09 18:29:25', '2018-08-09 18:29:25'),
(4, 'Chinese', 'public/uploads/V7mwdW41PLpPxyvR5JC5tDUmYgb706RW.png', 0, '2018-08-09 18:29:42', '2018-08-09 18:29:42'),
(5, 'Briyani', 'public/uploads/V7mwdW41PLpPxyvR5JC5tDUmYgb706RW.png', 0, '2018-08-09 18:30:12', '2018-08-09 18:30:12');

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
(48, 22, '153, Mecricar Rd, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005564, 76.954461, '228', 'opposite to BPC', 0, 2, '2018-11-15 19:03:26', '2019-02-19 23:09:56'),
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
(98, 22, 'No 3, Near K G Hospital, Bungalow Road, Gopalapuram, Coimbatore, Tamil Nadu 641018, India', 11.000180, 11.000180, '3/233', 'race course road', 1, 3, '2019-01-25 05:52:56', '2019-02-19 23:09:57'),
(99, 22, 'North Mada Street,Thiruvanmiyur, Chennai', 12.986985, 80.259625, '12', 'starlight hosp', 0, 3, '2019-02-17 05:10:58', '2019-02-19 23:09:57'),
(100, 22, 'Global Infocity', 12.969581, 80.241567, '12', 'RMZ', 0, 3, '2019-02-17 05:16:30', '2019-02-17 05:16:30'),
(101, 22, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, '67', 'bank', 0, 3, '2019-02-17 07:45:42', '2019-02-17 07:45:42'),
(102, 22, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 53.955670, 14.521259, '78', 'guindy', 0, 3, '2019-02-17 07:48:33', '2019-02-17 07:48:33'),
(103, 22, '780 64 Lima, Sweden', 60.958544, 13.525164, '78', 'guindy', 0, 3, '2019-02-17 07:49:28', '2019-02-17 07:49:28'),
(104, 22, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, '78', 'guindy', 0, 3, '2019-02-17 07:50:12', '2019-02-17 07:50:12'),
(105, 22, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, 'as', 'dr', 0, 3, '2019-02-17 07:51:09', '2019-02-17 07:51:09'),
(106, 22, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, 'buzz', 'shhs', 0, 3, '2019-02-17 07:51:49', '2019-02-17 07:51:49'),
(107, 22, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, '78', 'guindy', 0, 3, '2019-02-17 07:57:48', '2019-02-17 07:57:48'),
(108, 22, '3 Stonehenge Rd, Amesbury, Salisbury SP4 7BA, UK', 51.178900, -1.826400, '78', 'guindy', 0, 3, '2019-02-17 07:57:52', '2019-02-17 07:57:52'),
(109, 65, '37, Ramachandra Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.006273, 11.006273, 'jhku', 'jfhn', 1, 1, '2019-02-19 11:34:41', '2019-02-19 11:34:41');

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
(1, 'PAT00001', 'Praveen', '919600771099', 'praveenkumartup@gmail.com', 'RS Puram, Coimbatore', 'Coimbatore', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'YJpak2ynMEhL33h1', 'e94R0MRrc5E:APA91bHNJLhZt_FfbgR3Xdfk5KoB-Nb6V3OsMWr--hnMr5yaT_ezkz0FIdAFIslh_h6-yNLo12kkZvpvLwJbYP-ZwHOu6taEiHoiYfikgwJinwX6j5MTqoFXMevxe3vH_SAxFnVzg6xJ', 'public/uploads/profile_icon.png', 3.00, 'JH87gUYVy77v', 'Canara Bank', '872387325753278325', 'CNRB000872', 220.82, 1, '2018-08-29 05:27:44', '2019-02-15 15:25:15'),
(3, 'PAT00003', 'Gowtham', '919092510425', 'murugasendhivya3@gmail.com', 'Gandhipuram', 'Coimbatore', 'REVobTNMY0pQa2tPRkN0TmtiNnk2QT09', NULL, NULL, 'public/uploads/profile_icon.png', 3.00, 'HGJ87yHVg87sad', 'SBI', '2175327853275323', 'SBI0000217', 0.00, 1, '2018-09-05 07:48:58', '2018-11-28 20:52:53'),
(4, 'PAT00004', 'Dinesh', '918870129402', 'dhivyamurugesan3995@gmail.com', 'Ukkadam', 'Coimbatore', 'REVobTNMY0pQa2tPRkN0TmtiNnk2QT09', 'kXDNIKlNb96QKMEF', 'dR2bqWhc8ec:APA91bFV0j72Vd7hE-MexXLcMINExbGvXrmmF5K1u8G_ZC7rHbOF8QhWHi9IHbkbxt-fwRhYUjv__s6MPFXPKBj5LnTem3h4gA3l3pdANYaBNj9CnZCYeti6dzCLg-h0NC-e1H6FWmuS', 'public/uploads/profile_icon.png', 3.00, '98JHG78yGG87HJ', 'Canara', '3283289723474442', 'CNRB000328', 0.00, 1, '2018-09-06 07:11:29', '2018-09-06 14:01:37'),
(5, 'PAT00005', 'Praveen kumar', '918508082716', 'praveen@gmail.com', 'Coimbatore, RS Puram', 'Coimbatore', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'SWGDRUIWI3UdaqTI', 'dHLHOeOLMSs:APA91bFcAVYchODdBH_VwnQQPH2BxAC8n6BghPOhrtzmrb0Zwn17T_af6bDYklMqdCU_TT2D3Dmb80eNBfgFUCEKLL2Ii_YQkl4MjyukxGwKmNWRlPTszgMmrIfLprpMCuY3HSdddRgI', 'public/uploads/profile_icon.png', 3.00, '8hghj878g8g', 'IDBI', '37258732578352783', 'IDBI000372', 251.07, 1, '2018-11-15 12:40:09', '2019-02-19 17:31:17'),
(6, 'PAT00006', 'Giri', '919003649725', 'giri@sparkouttech.com', 'RS Puram, Coimbatore', 'Coimbatore', 'dzBiT3pSNURwcWZiY3R5aURCc0pEQT09', NULL, NULL, 'public/uploads/profile_icon.png', 3.00, '3298GH28JH877', 'HDFC', '273857832575427', 'HDFC0000273', 0.00, 1, '2018-11-28 18:17:21', '2018-11-28 18:17:21'),
(7, 'PAT00007', 'GiriVignesh', '917010662843', 'girivignesh3@gmail.com', 'test', 'Coimbatore', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'sgnyxuAlVUPOx9Gj', 'fgoQ6tlvq7A:APA91bGeLn7KFlI1J89S3sZ87jclqD_5vrIJAJAxEDkH9OzsMfQ8VNaWIoV-lx_sabxMRpw5q4iVwajlsazNOh8VThhtT4hv1KVdeV1GP92KA8t0OI9T5wEL79bc8qFDIrsXPKWv3jbr', 'public/restaurant_uploads/mX6fUarl3CPtIMkznZHs6fjxXgA1Wi7j.jpg', 3.00, 'TN12BJT5678909876', 'Karur Vysya Bank', '1674000006789045', 'KVB12345', 0.00, 0, '2018-12-11 07:08:48', '2018-12-11 12:41:13');

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
(192, 16, 3, '2018-12-15 12:44:18', '2018-12-15 12:44:18'),
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
(224, 16, 2, '2019-01-24 12:30:00', '2019-01-24 12:30:00'),
(225, 16, 1, '2019-01-24 17:26:36', '2019-01-24 17:26:36'),
(241, 22, 1, '2019-02-11 16:43:58', '2019-02-11 16:43:58'),
(242, 22, 3, '2019-02-11 16:44:01', '2019-02-11 16:44:01'),
(245, 22, 4, '2019-02-14 17:52:34', '2019-02-14 17:52:34'),
(246, 80, 1, '2019-02-18 16:38:31', '2019-02-18 16:38:31'),
(247, 81, 1, '2019-02-19 08:33:22', '2019-02-19 08:33:22'),
(249, 65, 2, '2019-02-19 11:04:03', '2019-02-19 11:04:03'),
(250, 65, 3, '2019-02-19 11:04:05', '2019-02-19 11:04:05'),
(251, 65, 4, '2019-02-19 11:04:06', '2019-02-19 11:04:06'),
(255, 22, 2, '2019-02-19 17:50:00', '2019-02-19 17:50:00');

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
(1, 1, 1, 1, 'BBQ Chicken Wings', 159.00, 0.00, 0.00, NULL, 'Chicken wings cooked with BBQ and Honey', 0, 1, '2018-08-13 05:35:53', '2018-08-13 05:35:53'),
(2, 1, 3, 1, 'Panner Toast ada Pizza', 129.00, 0.00, 0.00, NULL, 'Bread topped with panner and cheese', 1, 1, '2018-08-13 05:35:53', '2018-08-13 05:35:53'),
(3, 1, 2, 2, 'Burger', 139.00, 0.00, 0.00, NULL, 'Bread topped with panner and cheese', 1, 1, '2018-08-13 11:17:34', '2018-08-13 11:17:34'),
(4, 2, 1, 4, 'BBQ Chicken Wings', 139.00, 0.00, 0.00, NULL, 'Chicken wings cooked with BBQ and Honey', 0, 1, '2018-08-14 09:20:06', '2018-08-14 09:20:06'),
(5, 2, 2, 5, 'Burger', 99.00, 0.00, 0.00, NULL, 'Bread topped with panner and cheese', 1, 1, '2018-08-14 09:20:06', '2018-08-14 09:20:06'),
(6, 1, 4, 7, 'Noodles', 119.00, 0.00, 0.00, NULL, '', 0, 1, '2018-08-14 11:12:04', '2018-08-14 11:12:04'),
(7, 1, 5, 6, 'Veg Meals', 90.00, 0.00, 0.00, NULL, '', 1, 1, '2018-08-14 11:13:27', '2018-08-14 11:13:27'),
(8, 1, 7, 1, 'Vanilla Milkshake', 49.00, 0.00, 0.00, NULL, '', 0, 1, '2018-08-14 11:19:02', '2018-08-14 11:19:02'),
(9, 1, 1, 1, 'BBQ Chicken', 200.00, 0.00, 0.00, NULL, 'Chicken wings cooked with BBQ and Honey', 0, 1, '2018-11-29 12:31:50', '2018-11-29 12:31:50'),
(10, 1, 1, 3, 'Noodles', 70.00, 0.00, 0.00, NULL, 'Noodles cooked with BBQ and Honey', 0, 1, '2018-11-29 12:31:50', '2018-11-29 12:31:50'),
(11, 1, 1, 1, 'Veg Noodles', 65.00, 0.00, 0.00, NULL, 'Veg Noodles cooked with BBQ and Honey', 1, 1, '2018-11-29 12:33:18', '2018-11-29 12:33:18'),
(12, 1, 3, 1, 'Fried Rice', 80.00, 0.00, 0.00, NULL, 'Hot and Crispy', 1, 1, '2018-11-29 12:33:18', '2018-11-29 12:33:18'),
(13, 1, 3, 1, 'Egg Fried Rice', 100.00, 0.00, 0.00, NULL, 'Hot and Spicy', 0, 1, '2018-11-29 12:34:35', '2018-11-29 12:34:35'),
(14, 1, 3, 2, 'Chicken Noodles', 190.00, 0.00, 0.00, NULL, 'Hot and Tasty', 0, 1, '2018-11-29 12:34:35', '2018-11-29 12:34:35'),
(15, 1, 3, 2, 'Pron Fried Rice', 220.00, 0.00, 0.00, NULL, 'Hot and Chilli', 0, 1, '2018-11-29 12:35:55', '2018-11-29 12:35:55'),
(16, 1, 7, 1, 'Veg Briyani', 290.00, 0.00, 0.00, NULL, 'Tasty', 1, 1, '2018-11-29 12:35:55', '2018-11-29 12:35:55'),
(17, 1, 7, 2, 'Egg Briyani', 200.00, 0.00, 0.00, NULL, 'Tasty', 0, 1, '2018-11-29 12:40:15', '2018-11-29 12:40:15'),
(18, 1, 7, 1, 'Chicken Briyani', 199.00, 0.00, 0.00, NULL, 'Tasty and Spicy', 0, 1, '2018-11-29 12:40:15', '2018-11-29 12:40:15'),
(19, 1, 5, 6, 'Non-veg Meals', 175.00, 0.00, 0.00, NULL, 'Hot', 0, 1, '2018-11-29 12:41:13', '2018-11-29 12:41:13'),
(20, 1, 1, 1, 'Bucket Chicken', 150.00, 0.00, 0.00, NULL, 'Hot and Spicy', 1, 1, '2019-02-20 08:00:33', '2019-02-20 08:00:33');

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
(7, 1, 'Fast Food', 0, '2018-08-14 11:10:05', '2018-08-14 11:10:05');

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
(1, 1, 'public/uploads/dnCXEyiDoYVQVnIzhFNbG7ReqDJjeZWs.jpg', 'Shawarma Starting @ Rs.39', 'Tab the banner to get Order', 2, 1, 0, '2018-08-10 11:05:54', '2018-12-23 17:23:40'),
(2, 2, 'public/uploads/ezgif-3-c4aa4796c86f.jpg', 'Beef Shawarma Starting @ Rs.59', 'Tab the banner to get Order', 1, 0, 0, '2018-08-10 11:05:54', '2018-08-10 11:05:54'),
(3, 2, 'public/uploads/ezgif-3-d0181df9b78c.jpg', 'Offer @ Rs.99', 'Tab the banner to get Order', 3, 0, 0, '2018-09-19 05:50:33', '2018-09-19 05:50:33'),
(4, 1, 'public/uploads/ezgif-3-ad31ee68d207.jpg', 'Shawarma Starting @ Rs.39', 'Tab the banner to get Order', 4, 0, 1, '2018-11-12 18:54:14', '2018-11-12 18:54:14'),
(5, 2, 'public/uploads/Ia8k8Ok88p2bbQB1J8uC7LWkVx3M3NtM.jpg', NULL, NULL, NULL, 1, 0, '2019-02-20 02:13:48', '2019-02-20 02:13:48');

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
(13, 'EATZILLA013', 22, 1, 0, 853.00, 0.00, 0.00, 0.00, 0.00, 853.00, 85.30, 742.11, 25.59, 'NA', 0, 0, 1, 0, '13/4, Kamaraj Nagar, Thiruvanmiyur, Chennai, Tamil Nadu 600041, India', 12.986701, 80.260217, '2019-02-17 16:11:16', NULL, '2019-02-17 10:41:16', '2019-02-17 10:41:16'),
(14, 'EATZILLA014', 65, 1, 5, 477.00, 0.00, 0.00, 0.00, 0.00, 477.00, 47.70, 414.99, 14.31, 'NA', 1, 1, 1, 7, '37, Ramachandra Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.006273, 76.954287, '2019-02-19 17:05:45', NULL, '2019-02-19 11:35:45', '2019-02-19 17:23:14'),
(15, 'EATZILLA015', 65, 2, 5, 417.00, 0.00, 10.00, 0.00, 0.00, 427.00, 42.70, 371.49, 12.81, 'NA', 1, 1, 1, 7, '37, Ramachandra Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.006273, 76.954287, '2019-02-19 17:26:12', NULL, '2019-02-19 11:56:12', '2019-02-19 17:27:56'),
(16, 'EATZILLA016', 65, 1, 0, 318.00, 0.00, 0.00, 0.00, 0.00, 318.00, 31.80, 276.66, 9.54, 'NA', 0, 0, 1, 1, '37, Ramachandra Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.006273, 76.954287, '2019-02-19 17:33:28', NULL, '2019-02-19 12:03:28', '2019-02-19 17:36:56'),
(17, 'EATZILLA017', 65, 1, 0, 318.00, 0.00, 0.00, 0.00, 0.00, 318.00, 31.80, 276.66, 9.54, 'NA', 0, 0, 1, 0, '37, Ramachandra Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.006273, 76.954287, '2019-02-19 19:09:56', NULL, '2019-02-19 13:39:56', '2019-02-19 13:39:56');

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
(38, 17, 1, 1, 2, 0, '2019-02-19 13:39:56', '2019-02-19 13:39:56');

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
  `shop_description` varchar(300) DEFAULT NULL,
  `rating` double(2,1) NOT NULL DEFAULT '5.0',
  `is_open` int(11) NOT NULL DEFAULT '0' COMMENT '1 - open, 0- closed',
  `estimated_delivery_time` varchar(100) NOT NULL DEFAULT '15-25 mins',
  `packaging_charge` double(6,2) NOT NULL DEFAULT '0.00',
  `address` varchar(350) DEFAULT NULL,
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

INSERT INTO `restaurants` (`id`, `restaurant_name`, `image`, `email`, `phone`, `discount`, `shop_description`, `rating`, `is_open`, `estimated_delivery_time`, `packaging_charge`, `address`, `lat`, `lng`, `opening_time`, `closing_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 'KFC', 'http://54.218.62.130/eatzilla/public/restaurant_uploads/dsdfKcxbXt1PObXfIxgg6agu0SVGo0PC.jpg', 'kfc@gmail.com', '12345', '0', 'test', 5.0, 1, '15-25 mins', 0.00, 'RS Puram, Coimbatore', 11.01268300, 76.98948700, '10:00:00', '22:00:00', 1, '2018-08-10 06:29:25', '2018-12-11 19:39:15'),
(2, 'McDonalds', 'http://54.218.62.130/eatzilla/public/restaurant_uploads/qa9JZFQQ0ZRGoqqa3S7oAtKEHoUxMEcc.jpg', 'macd@gmail.com', '123456', '0', '', 3.4, 1, '15-25 mins', 10.00, 'RS Puram, Coimbatore', 11.01268300, 76.98948700, '00:00:00', '00:00:00', 0, '2018-08-10 06:48:07', '2018-12-11 19:39:34'),
(3, 'Pizza Hut', 'http://54.218.62.130/eatzilla/public/restaurant_uploads/n66tRuk1gsi2xEe6CUWxyB0g9pHqGi04.jpg', 'pizzahut@gmail.com', '12345', '0', '', 4.5, 1, '15-25 mins', 0.00, 'Gandhipuram, Coimbatore', 11.01268300, 76.98948700, '10:00:00', '20:00:00', 1, '2018-08-10 06:49:20', '2018-12-11 19:38:20'),
(4, 'Aasife Biriyani', 'http://54.218.62.130/eatzilla/public/restaurant_uploads/s3SdgpodTq3IC0XkxdBDoS8pL4694WMx.jpg', 'dominos@gmail.com', '12345', '0', '', 5.0, 1, '20-25 mins', 10.00, 'RS Puram, Coimbatore', 11.01268300, 0.00000000, '10:00:00', '21:00:00', 1, '2018-08-31 05:19:31', '2018-12-11 19:40:29'),
(5, 'Papa Johns', 'http://54.218.62.130/eatzilla/public/restaurant_uploads/sk9mqFpOeAqPSy3R5GtjoRJCs5kPvazY.jpg', 'papajohns@gmail.com', '12345678', '0', '', 5.0, 0, '20-45 mins', 10.00, '148/112, Above More Mall, Bannerghatta Main Rd, NS Palya, Bengaluru, Karnataka', 11.01268300, 0.00000000, '10:00:00', '22:00:00', 1, '2018-11-15 11:37:40', '2018-12-11 19:40:54');

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
(2, 1, 2, '2018-08-10 06:51:35', '2018-08-10 06:51:35'),
(3, 1, 3, '2018-08-10 06:51:44', '2018-08-10 06:51:44'),
(4, 2, 1, '2018-08-10 06:51:52', '2018-08-10 06:51:52'),
(5, 2, 2, '2018-08-10 06:52:00', '2018-08-10 06:52:00'),
(6, 2, 4, '2018-08-10 06:52:21', '2018-08-10 06:52:21'),
(7, 3, 4, '2018-08-10 06:52:36', '2018-08-10 06:52:36'),
(8, 3, 5, '2018-08-10 06:52:43', '2018-08-10 06:52:43');

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
(1, 'admin_commission', '25', 1, '2018-09-30 17:57:23', '2018-09-30 17:57:23'),
(2, 'restaurant_commission', '87', 1, '2018-09-30 17:58:08', '2018-09-30 17:58:08'),
(3, 'delivery_boy_commission', '3', 1, '2018-09-30 17:58:08', '2018-09-30 17:58:08');

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
(121, 17, 0, 'Order Placed', '2019-02-19 13:39:56', '2019-02-19 13:39:56');

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
  `otp` smallint(6) NOT NULL DEFAULT '0',
  `profile_image` varchar(200) DEFAULT NULL,
  `referral_code` varchar(20) DEFAULT NULL,
  `referral_amount` double(6,2) NOT NULL DEFAULT '0.00',
  `login_type` int(11) NOT NULL DEFAULT '0' COMMENT '0- mobile, 1- Gmail, 2 - Facebook',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `authToken`, `device_type`, `device_token`, `otp`, `profile_image`, `referral_code`, `referral_amount`, `login_type`, `created_at`, `updated_at`) VALUES
(2, NULL, '8600771099', NULL, NULL, '2jFEQuIuwpRM6Jzz', 'android', 'abc123', 6089, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'qHjWQHe7', 0.00, 0, '2018-08-09 12:35:15', '2018-08-09 12:35:15'),
(6, 'Praveen', '91850808716', 'praveen@sparkouttech.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'c3iGKK1yNx8:APA91bF0wbzT0QUr_JqiB_P5iBEB8ICCbIq6A2KOMiGnxVqiKNdkc8lkPDZSFUzpdyQp3QP0RA5lTnIw3TM3eEpVqJdZgifzhe77LsKnb5qSpSnGAUJOdenlwPJAHQM2wPgC6GSUTV5u', 0, 'http://54.218.62.130/eatzilla/public/uploads/CgsbJA4xPiGjUh8u4ecNPCEHnd7QOaAr.svg', 'PM6YHWZT', 0.00, 0, '2018-08-18 12:27:52', '2018-11-21 10:06:24'),
(7, NULL, '919943291177', 'sangkarthi94@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'OsD92gRRqIthfEsj', 'android', 'dAQTfN0UOY0:APA91bGpducEO1Pd5sE6EnYOmcZnS-3zV3ukoWJPP_hEm1b4qVbSlQfH7nZrf9RVTTB9tw4xlp0iEqOIcriMjbXgSnroZyoclmykmw-UjE52F6a7AT4HhXro8MRFmQ2Edvkaxh3DiyfdJlzNr_7dzhtTREF_qt3EIw', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'LNBRgL8o', 0.00, 0, '2018-08-18 15:55:28', '2018-08-18 16:07:25'),
(8, 'Praveen', '8825653478', 'sangkarthi@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'Rq1mMpiwTCJYNJPj', 'web', 'cxiOaTU2oto:APA91bGpPZfk2W0wmunFH3iNPesNGKL0vMgakrsZ0c47mxHaiob11gyoX402lqBx5p0Fq_EcfBL2RINWlHcbnbcVpm0_6reIN_i38C7SzlZH4yX1IhdMRPDK9IRwQ8h_5lZTn0l9cdxz', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', '3Hn4WVcI', 0.00, 0, '2018-08-19 14:52:25', '2018-09-20 06:58:17'),
(9, NULL, '9500739244', 'lokeshmurali44@gmail.com', 'WmMveXV5eHhhK0pLb3pIMk9Sc3lUQT09', 'SJtiSfjdZnHck659', 'android', 'fL3eMyn1mAQ:APA91bHf0vgUEvhy-gWKe9irxYsIcLFxjrie4zG-FKGOMHIgxBvJWk-QQkjcPAUk-90TxIK0q6diwciOUWr_c_-rC9jLMfN2Ho3APC34urxCkFWs1TVYN4vDOgAboN4kbjQMKVMSy--n', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'Z6djRFRi', 0.00, 0, '2018-08-31 09:55:20', '2018-09-29 22:04:46'),
(10, NULL, '919908011736', 'sairam.nsn@gmail.com', 'dE9DY2EzRGZpcThYeVlxVW1OTjBrdz09', 'ZC3bH1Bft6H3M8kv', 'android', 'c95KlRvAawo:APA91bEP9MDcw4-7O8xPUXRmDrmbsRgCVnyyC1VN1YvpQU4Z235R1sbcV4eCLq28ax_iXw3j5_cDDGdTX0G4sFkQAOfAP2yX8CpCN6D0KSbzj_2lvj9gCvSxIcuEP67ENG4FzthYnjcx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'qdyAKHFN', 0.00, 0, '2018-09-03 17:54:51', '2018-09-03 17:54:51'),
(11, NULL, '8870129402', 'dhivyamurugesan3995@gmail.com', 'REVobTNMY0pQa2tPRkN0TmtiNnk2QT09', 'zcYrIkVpjarHcJ4z', 'android', 'c2Mh6EQ2vgU:APA91bHf4X_CmwpubwKX6my9cxOMAWvHcydyta0K22AJ_nn7-8nn9iLmGjKHkY8is84u5Hprx3rn69pTk9C9PUSbMKox_E0c3l-6LRgZgxzUal0jdoVjFIE-k0AecfgPzggrs6GMMmM6', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'ZD8VeTXH', 0.00, 0, '2018-09-04 06:48:10', '2018-09-06 10:23:17'),
(12, NULL, '7010662843', 'murugasendhivya3@gmail.com', 'REVobTNMY0pQa2tPRkN0TmtiNnk2QT09', 'Kyc662NxZLeUvPDr', 'android', 'caBCHZGFrMc:APA91bG2S2kT4Itnug9EPRcsMNBIEn9k0OJxTsc71Q6tsN-IJI1QTF9Yk_KteMXzfmgNBydzmg0AxgkzUKn5QffjFw3LcaWwfnMI1n6VmjFHGcLT7i5sNTWw0M1QClDlv9A6eJWs_ywP', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'zm9YnU4T', 0.00, 0, '2018-09-05 07:41:12', '2018-09-06 13:50:27'),
(13, NULL, '8056359277', 'gotocva@gmail.com', 'REVobTNMY0pQa2tPRkN0TmtiNnk2QT09', '0', 'android', 'c2Mh6EQ2vgU:APA91bHf4X_CmwpubwKX6my9cxOMAWvHcydyta0K22AJ_nn7-8nn9iLmGjKHkY8is84u5Hprx3rn69pTk9C9PUSbMKox_E0c3l-6LRgZgxzUal0jdoVjFIE-k0AecfgPzggrs6GMMmM6', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'sJxHmiL6', 0.00, 0, '2018-09-06 08:23:16', '2018-09-06 08:38:23'),
(14, NULL, '9994810451', 'gksarun@gmail.com', 'REVobTNMY0pQa2tPRkN0TmtiNnk2QT09', '0', 'android', 'c2Mh6EQ2vgU:APA91bHf4X_CmwpubwKX6my9cxOMAWvHcydyta0K22AJ_nn7-8nn9iLmGjKHkY8is84u5Hprx3rn69pTk9C9PUSbMKox_E0c3l-6LRgZgxzUal0jdoVjFIE-k0AecfgPzggrs6GMMmM6', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'aTNMZUFc', 0.00, 0, '2018-09-06 09:37:57', '2018-09-06 10:14:31'),
(15, NULL, '8760868844', 'giriraaja@gmail.com', 'REVobTNMY0pQa2tPRkN0TmtiNnk2QT09', '0', 'android', 'c2Mh6EQ2vgU:APA91bHf4X_CmwpubwKX6my9cxOMAWvHcydyta0K22AJ_nn7-8nn9iLmGjKHkY8is84u5Hprx3rn69pTk9C9PUSbMKox_E0c3l-6LRgZgxzUal0jdoVjFIE-k0AecfgPzggrs6GMMmM6', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'Ckt08OGe', 0.00, 0, '2018-09-06 10:08:32', '2018-09-06 10:11:58'),
(16, 'GiriVignesh', '919524722184', 'Giri3@test.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'qSyeC7DUwpQU8xfU', 'android', 'ceI-fN5fGnE:APA91bGohbw5_pgF9KOX87AAlqSkPu7yIuBNhaHzA9ljEyqB_RMxNj6dO1SaW7gleDC_NYTd1KtVY2HJ1-jKEyeLtCrCe2xg_JOsBgknGAS48VjApex7DfiCm8rRFNTd_5Xi5xuplVQT', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'wpn8j9RP', 0.00, 0, '2018-09-11 08:32:26', '2019-02-17 14:25:43'),
(17, NULL, '7823948822', 'soundariyalingan@gmail.com', 'dE9DY2EzRGZpcThYeVlxVW1OTjBrdz09', 'OGqQtg9Yp46GqDhe', 'android', 'cRwLa5AE_sQ:APA91bFSjh9nD52i4aiIYSLG-BT6NWHHYGNYKig1r7FCi_hdJjEGtLxLJR2Muqe-QAa9PNHlhKe3YTUIL1vH6sOUKZQffxQmuQoJwIe2OqpvWtLtOnkYZngYIJdghETCS3HU0CmnrbDV', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'bdsJ9Qoz', 0.00, 0, '2018-09-13 10:44:26', '2018-09-13 10:44:26'),
(18, NULL, '86677617798', 'vishnuvardhanamz@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'gELpYGOxMhM5bRNZ', 'android', 'crymDd_aigY:APA91bHH00Fd98WHXSALU3PFzIYp2jqn-vVLzDeWyU3OnJznl7LLOSfDIjf44LxpYQ6Hxvg80GC_lGRPHu4fUYNkn4tEhP5Y5YQ2nZbiIv2EAm-4-68fYderVTXaeekWDlON_0EarWJ-', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'Pjhcd7wI', 0.00, 0, '2018-09-29 10:17:24', '2018-10-04 01:09:12'),
(19, NULL, '9597434949', 'vishnuvardhan4006@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'eNbU-Q1nBkc:APA91bGOv-TB-IXvMRmSYagNrmSnJxYkQSa8McUtX4s7oJu8B_q1V4vxwqE35CxQ6FX7XZo0WL8eo0-ryjwAQm8Kb7Y-ERzUT4ppqlckqutYtddl7UcbafpWGwmVsY6EPIR5_jg0I9P6', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'WDLPT52S', 0.00, 0, '2018-09-30 00:31:07', '2018-09-30 18:45:57'),
(20, NULL, '7708889555', 'vishnuvardhan4@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'TuXFxdIHz2r71NbW', 'web', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'ggbUtbTh', 0.00, 0, '2018-09-30 18:56:56', '2019-01-18 14:38:03'),
(21, NULL, '9655788935', 'senthilbaskaran001@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'efc2SzoBqgg:APA91bE1Oohcy57GqEUNqSgAVHSM4qshl25H6vN57VnxVq9jVQYcfkw9T54u9AHiDb8u0st4CSgbQqq16aN-OU5IEA9ihfdLFAkSt9c8xRUVWd-CYPCiF6SxUuxae8tEWpqCQQU0mXdP', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'Lng6mMvi', 0.00, 0, '2018-10-01 11:45:42', '2018-10-01 11:49:06'),
(22, 'Praveenkumar', '919600771099', 'praveenkumartup@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'jzlc9MXaFObjRBdw', 'web', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'U1r5ourq', 0.00, 0, '2018-10-03 13:52:28', '2019-02-19 23:08:05'),
(23, NULL, '9524722184', 'girivignesh3@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', '0', 'android', 'dzjqtHZVJU0:APA91bGAKujbZwYWcs0c-ys0B7gyNVxRHBK7Cg8IXRTzm-lyhZ7e37TV2iQ9jV1lzt8uVsn_QpBwhJT9Wg08WUZnw9ZeZ0qpB9tiwW-5C1B7eucvEV5rjpRrjHXeOERg2H3xu2YhePi-', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', '8cBUIk50', 0.00, 0, '2018-10-04 06:43:24', '2018-10-04 08:01:31'),
(24, NULL, '8508904650', 'praveenkumartup@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', 'KDR52FtAyDmCdMuM', 'android', 'dzjqtHZVJU0:APA91bGAKujbZwYWcs0c-ys0B7gyNVxRHBK7Cg8IXRTzm-lyhZ7e37TV2iQ9jV1lzt8uVsn_QpBwhJT9Wg08WUZnw9ZeZ0qpB9tiwW-5C1B7eucvEV5rjpRrjHXeOERg2H3xu2YhePi-', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'oKB12Evi', 0.00, 0, '2018-10-04 08:03:22', '2018-10-04 08:03:22'),
(25, NULL, '9876543210', 'itprojecttemp@gmail.com', 'VGlyR0piazZ1b29KcDM0NnM4dFZ4UT09', 'a309i5qZbPzOjXzT', 'android', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', '35b53Gec', 0.00, 0, '2018-10-13 06:44:07', '2018-10-13 06:44:07'),
(26, NULL, '1234567890', 'ft@sparkouttech.com', 'VGlyR0piazZ1b29KcDM0NnM4dFZ4UT09', 'yXhvYJeFBgXVtKSh', 'android', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'DOE1u226', 0.00, 0, '2018-10-13 10:49:50', '2018-10-13 10:49:50'),
(27, NULL, '23467845', 'sample@blankpagers.com', 'UkFuVTVYS1hwOEU3Q3pTQy9LTGtEUT09', '70ErYek1jw6mclzq', 'android', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'X3Ov7oef', 0.00, 0, '2018-10-13 11:27:20', '2018-10-13 11:27:20'),
(28, NULL, '523465985487', 'jsadhg@hsjdf.d', 'UkFuVTVYS1hwOEU3Q3pTQy9LTGtEUT09', 'Nm8CrOQag8CdWcIp', 'android', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'HAcFJZCZ', 0.00, 0, '2018-10-13 11:28:51', '2018-10-13 11:28:51'),
(29, NULL, '1276434562', 'sa@gb.v', 'UkFuVTVYS1hwOEU3Q3pTQy9LTGtEUT09', '1OfEShRLOeVoNa72', 'android', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'Zur2NG3c', 0.00, 0, '2018-10-13 11:31:46', '2018-10-13 11:31:46'),
(30, NULL, '129834765', 'sample@sd.cm', 'UkFuVTVYS1hwOEU3Q3pTQy9LTGtEUT09', 'RLWy9myTj28uQkwc', 'android', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'bo055TTe', 0.00, 0, '2018-10-13 11:34:32', '2018-10-13 11:34:32'),
(31, NULL, '6549821514', 'as@dsf.sdf', 'UkFuVTVYS1hwOEU3Q3pTQy9LTGtEUT09', 'PIu6EkTzTT94aHaU', 'android', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'Z9VUWBRe', 0.00, 0, '2018-10-14 03:26:39', '2018-10-14 03:26:39'),
(32, NULL, '5677813256', 'as@df.df', 'UkFuVTVYS1hwOEU3Q3pTQy9LTGtEUT09', 'en43YTO1TLW7MY4A', 'android', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', '4RVMb7DE', 0.00, 0, '2018-10-14 03:29:18', '2018-10-14 03:29:18'),
(33, NULL, '9865214577', 'test@blank.com', 'ZURYcDU1RllENXhMUUwycmpnY2tkQT09', 'HBSFF76e3QguGV3Q', 'android', 'abc123', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'VXvlyqnL', 0.00, 0, '2018-10-14 03:30:32', '2018-10-14 03:41:18'),
(34, NULL, '96001099', 'praveen@spaekouttech.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'duje0A3iDuY:APA91bEnIyFNRIEo4yy54bLIYi61soPDUONpkt2HCFS0ntBhjE-RxznfrCYd0FAmsuX1YzFcQojFpdMnihB9nPdbT9PBzvbGzCD2sEs0Wpc8GdBsqQsiYmAMHte6qJcR0pnJjPuKL1yq', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'g27euyOM', 0.00, 0, '2018-10-15 18:41:13', '2018-10-16 09:11:01'),
(35, NULL, '8095819472', 'poojariabhijeeth@gmail.com', 'VGpXUlRIWlRMTmt1UHR0b2NWMlFKdz09', 'pvSfo5TY3WcNZoCp', 'android', 'dlF-1XVj5FA:APA91bGWGqEepx5yBZMeEO1Si56gwq9GEXlUe-RyfK9qyOFfgD0B4oSZTYoZvdcXrESgmNVDOJvecg-VyvbqT1MR7jPdKXXmqtIBA03q2pw2CDBKLKdLgmPbESE0srTl6zqUDZofFjgD', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', '77vOWSaT', 0.00, 0, '2018-10-26 12:03:03', '2018-10-26 12:03:03'),
(36, NULL, '+918309435509', 'mangodinefood@gmail.com', 'dE9DY2EzRGZpcThYeVlxVW1OTjBrdz09', 'UJOnbYYuimDCWvkh', 'android', 'fYZlcwo71rA:APA91bFSTVVekoJ1y1oEazrpPtNQXnu1e5f8L44sbYrBgti6EkF0_-ApHngkpziAvIc1HN6sfD6Ey-IJazcOvlBxCCNJzDP7Mo_8x3cGBcmooLSc3tSyHK7enWWhcTcTXXzDdBPGWwZm', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'u8ZXsuZ4', 0.00, 0, '2018-10-28 02:31:55', '2018-10-28 02:34:00'),
(37, 'santhosh', '9942174014', 'santhosh@gmail.com', 'RTlHeExFbDB6OTd6amxhWE80VzBEdz09', '0', 'web', 'jhsvjx', 0, 'http://54.218.62.130/eatzilla/public/uploads/N9iKAFVk0HFIQ5gx9RHGDLn9wLjI9r4X.png', 'IKr3gGnK', 0.00, 0, '2018-10-28 03:36:11', '2019-01-19 15:48:37'),
(38, NULL, '9095471451', 's.santhosh51@yahoo.com', 'RTlHeExFbDB6OTd6amxhWE80VzBEdz09', '6VZaoaiGVe81iIYd', 'android', 'abc123', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'j4htPd4h', 0.00, 0, '2018-10-28 04:33:48', '2018-10-28 05:57:51'),
(39, 'santhosh santi', '99421740140', 'sssanthosh298@gmail.com', 'VGlyR0piazZ1b29KcDM0NnM4dFZ4UT09', '0', 'web', 'jhsvjx', 0, 'http://54.218.62.130/eatzilla/public/uploads/tDLNYQf6HB2GbVUL9UdmVo0N6nPHawOD.jpg', 't1fY1X9J', 0.00, 0, '2018-10-28 06:00:03', '2018-11-24 10:47:51'),
(40, 'DhivyaMurugesan', '9600975087', 'shobikababu1996@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', '0', 'android', 'dbby22clE3A:APA91bGViHZyhoxXsbWXjZ6H1PCPS6OoZkYkJrX326nOnqBD2C6dBd8hUC8GYgJbDX10uLrIZU3QZK4l8w8DfINEnYQ5UtJEfCJbikjiYXWQ61axA90wO6KaYlhO-WeCqUTA_dfHipHE', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'e0yDXr6e', 0.00, 0, '2018-11-09 10:55:07', '2019-01-14 13:22:37'),
(41, ' ', '99421740146', 's.santhosh561@yahoo.com', 'VGlyR0piazZ1b29KcDM0NnM4dFZ4UT09', '1CXXIaUfe9TsdZnJ', 'web', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'ybN8iK1B', 0.00, 0, '2018-11-14 11:49:28', '2018-11-14 11:49:28'),
(42, ' ', '919600771', 'praveen4@sparkouttech.com', 'VGlyR0piazZ1b29KcDM0NnM4dFZ4UT09', 'Zek5yvHyEwLkTPig', 'web', 'abc123', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'VumzyneO', 0.00, 0, '2018-11-14 12:24:35', '2018-11-14 12:29:02'),
(43, NULL, '9876543329', 'jeeva@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'dhcKLEQyHtg:APA91bH4CM13QejBnk63FFL51cmHS-R9zPD_dCj9-43AEWzlQpoMRvlJ4CfIGu_oZM_U1u66PtVi5SLw-pUhmP2rjvtN9g8cxVXv923r7OZlvqlDka8rTgGCe8DBdl0ZWrmOSVkHYt2L', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'rAMatisF', 0.00, 0, '2018-11-15 05:39:10', '2018-11-15 05:55:44'),
(44, NULL, '9976790909', 'ken@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0IdwOkRbGgeWWC3g', 'android', 'dhcKLEQyHtg:APA91bH4CM13QejBnk63FFL51cmHS-R9zPD_dCj9-43AEWzlQpoMRvlJ4CfIGu_oZM_U1u66PtVi5SLw-pUhmP2rjvtN9g8cxVXv923r7OZlvqlDka8rTgGCe8DBdl0ZWrmOSVkHYt2L', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'nBFxcJww', 0.00, 0, '2018-11-15 05:56:46', '2018-11-15 05:56:46'),
(45, NULL, '9789369927', 'keerthi@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'D6YKLiVdj90vC6ep', 'android', 'eam6MYNY8k8:APA91bFhrB4T7FrMHKHFe5RDAFYg2YCd-YOAd5Cg5ko1FBwwvjwP7WTauAXGHyVAJcYSFuy4gKglt-VCbOK1i32DKf9lk5f8Ho7YjOZ_0JYAvh8rPstSYqq9OUvAvVyr4Eys3PVlgNiO', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', '3OhTa9cd', 0.00, 0, '2018-11-15 16:26:09', '2018-11-16 04:58:15'),
(48, 'Praveen kumar', '8508082716', 'praveenkumartup1@gmail.com.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'fhlWbYZh0HI:APA91bFk4HVF1S4R-hov9ZXiU1PG7itbVROrkN-q7vjI00JrphrFsxZrWz2M4ouM82CWgmBv2uHLDv7VDbFPllrU-RZZRMFmQFMTqni4QM4NbTbUTItUygzP76c8tPwp-xr10iWHBPm6', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'mbt3aEHS', 0.00, 0, '2018-11-15 19:25:56', '2019-01-24 20:32:53'),
(49, 'saminathan v', '7373343302', 'santhoshsaminathan3@gmail.com', 'RTlHeExFbDB6OTd6amxhWE80VzBEdz09', '0', 'web', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'Iely6NwO', 0.00, 0, '2018-11-17 07:45:02', '2018-11-18 13:44:10'),
(50, NULL, '9788429214', 'devicetesting000@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', 'D6YKLiVdj90vC6ep', 'android', 'cssfeNcb7RY:APA91bEIMmI0WGZivCMvnMvXEKVLctEER-0uq9egM6n-a45dIhdtsZxBX1CuAZR81Tx8xYaaes8nc97NcjJQRjZakhT2xskAvaVPAUTttuScBNAuc7QHDQVD8XbhwU9lSses5AbITw1q', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'sH61onRG', 0.00, 0, '2018-11-26 07:04:34', '2018-11-26 11:59:29'),
(51, NULL, '867726177', 'vishnu@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', '0', 'android', 'cssfeNcb7RY:APA91bEIMmI0WGZivCMvnMvXEKVLctEER-0uq9egM6n-a45dIhdtsZxBX1CuAZR81Tx8xYaaes8nc97NcjJQRjZakhT2xskAvaVPAUTttuScBNAuc7QHDQVD8XbhwU9lSses5AbITw1q', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', '2svWqvpg', 0.00, 0, '2018-11-26 12:10:00', '2018-11-26 12:32:10'),
(52, NULL, '8667726177', 'vishnuvardhan@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', '4Q2wToaicI28gwjw', 'android', 'cssfeNcb7RY:APA91bEIMmI0WGZivCMvnMvXEKVLctEER-0uq9egM6n-a45dIhdtsZxBX1CuAZR81Tx8xYaaes8nc97NcjJQRjZakhT2xskAvaVPAUTttuScBNAuc7QHDQVD8XbhwU9lSses5AbITw1q', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'SBIhJETv', 0.00, 0, '2018-11-26 12:35:19', '2018-11-26 12:47:38'),
(53, NULL, '988556899', 'nivi@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'qEXCbmU6utAUoDHl', 'android', 'es8RqS98JBY:APA91bEYyuG1S3B1ZkyHZ9B6_2Xv3SsNn-9rlR0pGP5Lk5Pv8kEITzUmkaGm-9--LscpwqPXz-pVpr1YRm-kEUWFSndEgwhgl6dKiYW16ueX2HF3h5NKOCoLGg4T5bMdm3rNo3wRMcEF', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'LFOl1wA1', 0.00, 0, '2018-12-04 12:30:17', '2018-12-04 12:30:17'),
(54, 'Sri Nataraj', '9677552235', 'srinatraj.kailash@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'RBVEJr4HDkQhJath', 'android', 'dfwiDSDBlSo:APA91bF3t5DQrw9_SiOB2JMSWTxjHu64Hx2arIjS1CmAl0KSqH_T91KJh8ry-C6OQvYZsvmyDd4p6yY3mDV6u_fEHWL7vIVR3MxCm70g4lrzkVjlM_9Nc6vJelSn36TnjYyuZaaY3BKY', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'CeolHgFc', 0.00, 0, '2018-12-24 06:24:51', '2019-01-19 15:04:54'),
(55, 'Kailash', '8754188861', 'sriangel13.17@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', '51HRCQYT0e07z03e', 'web', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'vgp2g0Zc', 0.00, 0, '2018-12-24 10:43:04', '2018-12-25 18:05:14'),
(56, 'balayuvi', '918667745527', 'bk', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', '0', 'android', 'cSMxNwiHhj4:APA91bEDVBSh-vS54WQmZYeE_0HphTGZJLvytUY__Y8LWHAvWAqCVaoY_obiiOxQnDY1AQ5CITYSd7vs0rwWaXEEewMG67zNfIBy6fmtMTPiySdCrEUxJTVbIlwiLyrCKC6LRf8EYKUI', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'Dl2bjPzL', 0.00, 0, '2019-01-04 08:05:54', '2019-01-08 11:56:03'),
(57, 'Balayuvi', '919445523942', 'balamc1717@gmail.com', 'QmN6emZVUFNPVHlGUXVLK0lzc21BQT09', 'o8kGi2wO3gNX3T8l', 'android', 'eTB2ttFCS-I:APA91bFQmZH9ZE2OyeHVqPP-gSZxpkPIQddH5FU61zT4uaCvhSmC2jks2MIUDQsqPioV9jVUA_0dUgQPocvuhj6LrWYujDlygFyb164PaWcV7dVaU3FutDkdq8KWkzRY1f-zcBV55s8G', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'tcss3vnJ', 0.00, 0, '2019-01-04 12:08:56', '2019-01-09 12:58:49'),
(58, NULL, '9578650552', 'sundareshwaran2308@gmail.com', 'ajk0T1FxTlFvaXVKZit3MUZ0RHNrZz09', 'NYSxd0fTzyjVvCyQ', 'android', 'f8bXhtjDTFY:APA91bG1CpR99yGkqZV7gGwcjWmGZZJpeLc04jKyfLkVlaPnQ-DEMYJp2rt4IhmIzuRQfJuJrKPc12BWR4NsunYgCpf-f5sH69ygmk4DIyhIzosfi1h3tTGeYKmAB6HadexxTTcE6sC6', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'wBSD7tgS', 0.00, 0, '2019-01-07 09:57:25', '2019-01-07 17:17:03'),
(59, NULL, '+918072511253', 'hariharasudhan2802999@gmail.com', 'OU1UNFpHZVdsYzB6bU01TkZLTDFHdz09', 'GUgmLtBa69xrli3v', 'android', 'eWaow1okQis:APA91bHCGqhhNKKdYs2Jk00b__b-fuyMKGF-EyBCW2wmcET_MI49ZgSCWXmdgtJSlX1ZS1LgUg573StNPnZ2-x6jnikEpeWDR9MsR4air7gIFz4xO4dOiL2Vrp6QVqBUcjXm_NXyGYBc', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'T4XyGOva', 0.00, 0, '2019-01-11 03:59:16', '2019-01-11 03:59:16'),
(60, NULL, '88701559', 'siva@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'dIfngOGGDak:APA91bECq5I1P_ZewtcEHbsNp1d7ZApQmfoj3iZnkkLDzW-MhJKgp7--60DArKmD3OQ9XXS6djJx24tABlg_S1VsFwg62m-6S4c2dTi_Eq39YmfUN-hs-9PUmonQZmdJU7jQsIfyXuXs', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'Fr1JR9wT', 0.00, 0, '2019-01-14 12:16:17', '2019-01-14 17:55:44'),
(61, NULL, '8870155970', 'marc@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'dIfngOGGDak:APA91bECq5I1P_ZewtcEHbsNp1d7ZApQmfoj3iZnkkLDzW-MhJKgp7--60DArKmD3OQ9XXS6djJx24tABlg_S1VsFwg62m-6S4c2dTi_Eq39YmfUN-hs-9PUmonQZmdJU7jQsIfyXuXs', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'VqwfylpO', 0.00, 0, '2019-01-14 12:30:24', '2019-01-14 18:04:10'),
(62, 'Senthil Kumaran Baskran', '9363009450', 'senthil@sparkouttech.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'V6fk8eX1a4LXTLeg', 'web', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'OOVayTVb', 0.00, 0, '2019-01-15 06:55:39', '2019-01-18 14:35:15'),
(63, 'Dhivya Murugesan', '9677861702', 'dhivyamurugesan@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'NbYCKU3BJ3gV5RrC', 'ios', 'dcfgvhbjn', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 's85Gj6BR', 0.00, 0, '2019-01-17 07:54:09', '2019-02-20 12:42:42'),
(64, 'karthik s', '9677861703', 'senthilnagalakshmi1998@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'rBIRjiWht6FgnKNp', 'web', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'uCFtvbLj', 0.00, 0, '2019-01-17 09:51:28', '2019-01-17 09:51:28'),
(65, 'riykarthik sk', '8072531377', 'sanjeevnaga1998@gmail.com.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'epru3GeBXkI:APA91bEZgGStwyOn618hXMhEXHaXR4PVAFpDonw-b1_9KhbvG1uIkFkE1iQPRYOoVgFT9aFDxSdVOp4fLWVp_6AtBmO-46ApbTCww48T_6OhkwxHDDLvheb7wZDZRZ7xRLhrh5rCTYBK', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'gDzmf0On', 0.00, 0, '2019-01-17 11:38:19', '2019-02-20 12:41:34'),
(66, 'karthik keyan2', '9894815993', 'sanjeevnaga1998@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'uQ5uoK7kbVXudVeX', 'web', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'rPIm9IUK', 0.00, 0, '2019-01-18 05:06:18', '2019-01-18 11:32:18'),
(67, 'santi s', '9999999999', 'santhosh@gmail.co.in', 'RTlHeExFbDB6OTd6amxhWE80VzBEdz09', '0', 'web', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'RDypzKdU', 0.00, 0, '2019-01-19 03:15:22', '2019-01-19 18:04:32'),
(68, 'Dhivya Murugesan', '7010972363', 'yokesh@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', 'LfTbWd7LIyx40xTx', 'web', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'HJZOpUeh', 0.00, 0, '2019-01-24 11:49:49', '2019-01-24 17:29:51'),
(69, NULL, '8072325352', 'ssveinfo.91@gmail.com', 'dHI1a293clJlWURnR0dWM05RU3lBQT09', 'o7XTsJ6VqDbPLJD7', 'android', 'fIGjeP9AEao:APA91bGauvYjllA_QsDIKgkEJdi_v0AbUjfBFRcMzDWuQ97bFVyhInqZCipw-hkIaWpa5ZvRrZ_XrjYewSwlO8fnVV3REb4N9e0Nrc8u5vxshaRbvbLXJizElWcz42xPyOGEfIXOvJfc', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', '0SOQSY3R', 0.00, 0, '2019-01-30 07:43:39', '2019-01-30 07:43:39'),
(70, NULL, '918508082716', 'praveen1@sparkouttech.com', 'VGlyR0piazZ1b29KcDM0NnM4dFZ4UT09', 'dJ0Gzjlxc73O3wmN', 'ios', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'NLAV0rhI', 0.00, 0, '2019-01-30 16:43:18', '2019-01-30 16:43:18'),
(71, NULL, '1231', 'wfwdf', 'YktYRjI0WGlSaXBnQmlrdFFXcUFwQT09', 'aYv9MvMSHRbs2ZSB', 'ios', 'dfw', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', '2vMggcyY', 0.00, 0, '2019-01-30 16:58:38', '2019-01-30 16:58:38'),
(72, NULL, '27383', 'Shen', 'cTVQMlY2WURWbGp5dTZIYU5vS1lYQT09', 'txU2kywxhxeQRAo4', 'ios', 'dcfgvhbjn', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'HrSLYeyM', 0.00, 0, '2019-01-30 17:05:24', '2019-01-30 17:05:24'),
(73, NULL, '27383shhs', 'Shenjsjsjs', 'cTVQMlY2WURWbGp5dTZIYU5vS1lYQT09', 'ZZCxtqYlG7JiLDBr', 'ios', 'dcfgvhbjn', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'zKFs5kFf', 0.00, 0, '2019-01-30 17:11:35', '2019-01-30 17:11:35'),
(74, NULL, '983920288:9292', 'Shenjsspkjnqjsjjsjsjskkjdjs', 'cTVQMlY2WURWbGp5dTZIYU5vS1lYQT09', 'v7HL9XhNQHz041ow', 'ios', 'dcfgvhbjn', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'GFprypt4', 0.00, 0, '2019-01-30 17:12:41', '2019-01-30 17:12:41'),
(75, NULL, '272839393', 'hdhdjsjsjsjsjshhs', 'SmpKL0dGTHIwTW5uekhoUFJPNm9Gdz09', '7tp3XNd7MIhye4qV', 'ios', 'dcfgvhbjn', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'VCnXCgzE', 0.00, 0, '2019-01-30 17:14:00', '2019-01-30 17:14:00'),
(76, NULL, '12344321', '1234@gmail.com', 'VlQzZExLNjE5dk16MElTL01jeGVMUT09', 'NLYTAcFt0nhHpVbl', 'ios', 'dcfgvhbjn', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'zEoXqQaB', 0.00, 0, '2019-01-31 14:44:47', '2019-02-12 22:40:07'),
(77, NULL, '918095819472', 'poojariabhijeeth@gmajl.com', 'VGpXUlRIWlRMTmt1UHR0b2NWMlFKdz09', 'tuZrf7VnIGpOoFUs', 'android', 'ecE6vMciS6M:APA91bHrJhiQVLYvizN-iLw6G2JaDs3wYqY2phA4Y21YtyTxQx9vhzSahsvu-3yRFDDW6I-4Z6_aOnHoUhRfg0SmfrAbBb47ir8kR_u2j__vKJJdOJRmv6zEgxGCWqkqHCa4eSc-Fz5j', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'zpgE76RL', 0.00, 0, '2019-02-03 08:21:56', '2019-02-03 08:21:56'),
(78, NULL, '919894279369', 'sathish0073@gmail.com', 'dE9DY2EzRGZpcThYeVlxVW1OTjBrdz09', 'cZWF3TR6exwsBLHi', 'android', 'eb1QF44Lj1Q:APA91bHNfQAq_eJIyvEMA1pbtcigVm2bT4QtH_hzN6-2Xhnv6rO338JjvKIxal7CQrOJ5sUHLnu6KxBqjXIqVQ2p0-4dIfwd7ov6VUgYIXRRC12RiK98TGdJBstrTKYlx3rvgTzVALbe', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'JIu5Wdo5', 0.00, 0, '2019-02-07 15:41:03', '2019-02-07 15:41:03'),
(79, NULL, '9894279239', 'vino.ece94@gmil.com', 'MGlLcHc0VEF4S29aa09PM0Y1OFdMUT09', '8hyxeuGjSlUnlzMc', 'android', 'ffVRBxil3Vw:APA91bHVG_9LqtHUlRv2Qe5gcs8zfUfIwxbrYZROCRFjWQyz1FlwI95AIEpTH3OpNWWwERw3SASdrM0wLx3vtlZmisy9D-iRwMJN6eLNuKvTmaIz--3mrGGq8fZY3Tus3cJkDLtEWbl3', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'x5IPgAqB', 0.00, 0, '2019-02-09 06:59:14', '2019-02-09 06:59:14'),
(80, NULL, 'ycy', 'cut', 'SW1MWVFjS0NQSk8wdFY1MHh0eVkydz09', '0', 'ios', 'dcfgvhbjn', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', '6VINmqke', 0.00, 0, '2019-02-18 11:18:07', '2019-02-18 22:08:33'),
(81, NULL, '908042697571801', 'rubanrubi24@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'EeDjmYbtSlk9oWAW', 'android', 'fcjLgfKKlrk:APA91bGz1S7l9VSre81w1IHf6rd1TzKepX_1z_g8qlEqJqr1tukrsikHal83CzptjSPNaOKsZk6y_IipWuFmarXc5f0wsqzd-7Bh4WZCVb3tHe91Jx1ZaW36_jhdqUIiyTwes-pgVBdz', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'G5tjWoze', 0.00, 0, '2019-02-19 08:33:12', '2019-02-19 08:33:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=505;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `coupon_code`
--
ALTER TABLE `coupon_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cuisines`
--
ALTER TABLE `cuisines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT for table `delivery_partners`
--
ALTER TABLE `delivery_partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `favourite_list`
--
ALTER TABLE `favourite_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;
--
-- AUTO_INCREMENT for table `food_list`
--
ALTER TABLE `food_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `request_detail`
--
ALTER TABLE `request_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `restaurant_cuisines`
--
ALTER TABLE `restaurant_cuisines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `track_order_status`
--
ALTER TABLE `track_order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
