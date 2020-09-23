-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2018 at 08:26 AM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 7.0.32-0ubuntu0.16.04.1

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
(67, 16, 1, 1, '2018-11-30 05:59:21', '2018-11-30 05:59:21'),
(68, 16, 9, 1, '2018-11-30 05:59:23', '2018-11-30 05:59:23'),
(69, 16, 11, 1, '2018-11-30 05:59:26', '2018-11-30 05:59:26'),
(70, 16, 10, 1, '2018-11-30 05:59:28', '2018-11-30 05:59:28'),
(71, 16, 14, 1, '2018-11-30 05:59:30', '2018-11-30 05:59:30'),
(72, 16, 7, 1, '2018-11-30 05:59:34', '2018-11-30 05:59:34'),
(73, 16, 8, 1, '2018-11-30 05:59:36', '2018-11-30 05:59:36'),
(74, 22, 1, 2, '2018-11-30 09:28:48', '2018-11-30 09:29:05'),
(75, 22, 9, 1, '2018-11-30 09:28:51', '2018-11-30 09:28:51'),
(77, 22, 12, 1, '2018-11-30 09:28:57', '2018-11-30 09:28:57'),
(78, 37, 1, 1, '2018-11-30 12:02:33', '2018-11-30 12:02:33'),
(79, 37, 9, 1, '2018-11-30 12:02:47', '2018-11-30 12:02:47');

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
(1, 'Starter', 0, '2018-08-13 05:32:23', '2018-08-13 05:32:23'),
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
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon_code`
--

INSERT INTO `coupon_code` (`id`, `code`, `offer_type`, `value`, `available_from`, `valid_till`, `use_per_customer`, `total_use`, `status`, `created_at`, `update_at`) VALUES
(1, 'TESTCODE', 0, 10.00, '2018-08-01', '2018-08-18', 1, 10, 1, '2018-08-16 10:30:33', '2018-08-16 10:30:33'),
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
(1, 'American', 'public/uploads/V7mwdW41PLpPxyvR5JC5tDUmYgb706RW.png', 0, '2018-08-09 18:28:57', '2018-08-09 18:28:57'),
(2, 'Andhra', 'public/uploads/V7mwdW41PLpPxyvR5JC5tDUmYgb706RW.png', 0, '2018-08-09 18:29:10', '2018-08-09 18:29:10'),
(3, 'Arabian', 'public/uploads/V7mwdW41PLpPxyvR5JC5tDUmYgb706RW.png', 0, '2018-08-09 18:29:25', '2018-08-09 18:29:25'),
(4, 'Chinese', 'public/uploads/V7mwdW41PLpPxyvR5JC5tDUmYgb706RW.png', 0, '2018-08-09 18:29:42', '2018-08-09 18:29:42'),
(5, 'Briyani', 'public/uploads/V7mwdW41PLpPxyvR5JC5tDUmYgb706RW.png', 0, '2018-08-09 18:30:12', '2018-08-09 18:30:12'),
(6, 'Test', NULL, 0, '2018-08-29 19:55:27', '2018-08-29 19:55:27');

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
(48, 22, '153, Mecricar Rd, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005540, 11.005540, '228', 'opposite to BPC', 1, 2, '2018-11-15 19:03:26', '2018-11-15 19:03:26'),
(49, 45, '62 B, Park Street, Kattoor,, Coimbatore, Tamil Nadu 641009, India', 11.006937, 11.006937, 'eg', 'ugjhh', 1, 2, '2018-11-16 09:42:05', '2018-11-16 09:42:05'),
(52, 52, 'Hope College, Peelamedu, Coimbatore, Tamil Nadu 641004, India', 11.023811, 11.023811, '23', 'Opp to central mall', 1, 1, '2018-11-26 13:24:40', '2018-11-26 13:24:40'),
(53, 16, 'Gandhipuram Town Bus Stand, 11/20, Bharathiyar Rd, ATT Colony, New Siddhapudur, Coimbatore, Tamil Nadu 641044, India', 11.016111, 11.016111, '15.teet Street', 'cbe', 1, 1, '2018-11-27 08:41:41', '2018-11-27 08:41:41'),
(54, 50, 'Tirupur', 12.213320, 87.121224, NULL, NULL, 1, 1, '2018-11-28 10:13:03', '2018-11-28 10:13:03'),
(55, 37, 'Jains Apartment,Avinashi Rd, Peelamedu, Coimbatore, Tamil Nadu 641004, India', 11.025369, 76.997248, NULL, NULL, 1, 1, '2018-11-28 15:45:44', '2018-11-28 15:45:44'),
(56, 37, 'Jain Cambrae East,Avinashi Rd, Peelamedu, Coimbatore, Tamil Nadu 641004, India', 11.023872, 76.997555, NULL, NULL, 1, 1, '2018-11-28 15:49:17', '2018-11-28 15:49:17'),
(58, 37, 'Tirupur', 12.000000, 12.000000, NULL, NULL, 1, 1, '2018-11-29 08:58:53', '2018-11-29 08:58:53'),
(60, 37, 'Chennai,Chennai, Tamil Nadu, India', 13.261166, 80.081701, NULL, NULL, 1, 1, '2018-12-01 06:39:05', '2018-12-01 06:39:05');

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
(1, 'PAT00001', 'Praveen', '919600771099', 'praveenkumartup@gmail.com', 'RS Puram, Coimbatore', 'Coimbatore', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'NMV3BRMzCoFael29', 'abc123', 'public/uploads/profile_icon.png', 3.00, 'JH87gUYVy77v', 'Canara', '872387325753278325', 'CNRB000872', 0.00, 1, '2018-08-29 05:27:44', '2018-11-30 11:04:42'),
(3, 'PAT00003', 'Gowtham', '919092510425', 'murugasendhivya3@gmail.com', 'Gandhipuram', 'Coimbatore', 'REVobTNMY0pQa2tPRkN0TmtiNnk2QT09', NULL, NULL, 'public/uploads/profile_icon.png', 3.00, 'HGJ87yHVg87sad', 'SBI', '2175327853275323', 'SBI0000217', 0.00, 1, '2018-09-05 07:48:58', '2018-11-28 20:52:53'),
(4, 'PAT00004', 'Dinesh', '918870129402', 'dhivyamurugesan3995@gmail.com', 'Ukkadam', 'Coimbatore', 'REVobTNMY0pQa2tPRkN0TmtiNnk2QT09', 'kXDNIKlNb96QKMEF', 'dR2bqWhc8ec:APA91bFV0j72Vd7hE-MexXLcMINExbGvXrmmF5K1u8G_ZC7rHbOF8QhWHi9IHbkbxt-fwRhYUjv__s6MPFXPKBj5LnTem3h4gA3l3pdANYaBNj9CnZCYeti6dzCLg-h0NC-e1H6FWmuS', 'public/uploads/profile_icon.png', 3.00, '98JHG78yGG87HJ', 'Canara', '3283289723474442', 'CNRB000328', 0.00, 1, '2018-09-06 07:11:29', '2018-09-06 14:01:37'),
(5, 'PAT00005', 'Praveen kumar', '918508082716', 'praveen@gmail.com', 'Coimbatore, RS Puram', 'Coimbatore', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'IUPJfNe9f5daom5G', 'f-dqQfmq0dk:APA91bEWDAZN5XpV6NNyLmwfywzxJqQPlX0TSTFwiCbrrpfYkDVmSkKbQEcRqxHVEgsOWtvXBql_ZtXZBTVlBbMeVQNsfJfF-xIBcu8vPkOaAN36ErGcYFrTgr3CBHeqrIIFoQFiCW6y', 'public/uploads/profile_icon.png', 3.00, '8hghj878g8g', 'IDBI', '37258732578352783', 'IDBI000372', 0.00, 1, '2018-11-15 12:40:09', '2018-12-01 07:15:51'),
(6, 'PAT00006', 'Giri', '919003649725', 'giri@sparkouttech.com', 'RS Puram, Coimbatore', 'Coimbatore', 'dzBiT3pSNURwcWZiY3R5aURCc0pEQT09', NULL, NULL, 'public/uploads/profile_icon.png', 3.00, '3298GH28JH877', 'HDFC', '273857832575427', 'HDFC0000273', 0.00, 1, '2018-11-28 18:17:21', '2018-11-28 18:17:21');

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
(148, 22, 1, '2018-11-17 04:55:23', '2018-11-17 04:55:23'),
(168, 51, 2, '2018-11-26 12:27:55', '2018-11-26 12:27:55'),
(181, 37, 2, '2018-11-30 11:38:06', '2018-11-30 11:38:06'),
(182, 37, 3, '2018-11-30 11:39:11', '2018-11-30 11:39:11'),
(183, 37, 1, '2018-11-30 11:41:37', '2018-11-30 11:41:37');

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_list`
--

INSERT INTO `food_list` (`id`, `restaurant_id`, `category_id`, `menu_id`, `name`, `price`, `tax`, `packaging_charge`, `image`, `description`, `is_veg`, `created_at`, `update_at`) VALUES
(1, 1, 1, 1, 'BBQ Chicken Wings', 159.00, 0.00, 0.00, NULL, 'Chicken wings cooked with BBQ and Honey', 0, '2018-08-13 05:35:53', '2018-08-13 05:35:53'),
(2, 1, 3, 1, 'Panner Toast ada Pizza', 129.00, 0.00, 0.00, NULL, 'Bread topped with panner and cheese', 1, '2018-08-13 05:35:53', '2018-08-13 05:35:53'),
(3, 1, 2, 2, 'Burger', 139.00, 0.00, 0.00, NULL, 'Bread topped with panner and cheese', 1, '2018-08-13 11:17:34', '2018-08-13 11:17:34'),
(4, 2, 1, 4, 'BBQ Chicken Wings', 139.00, 0.00, 0.00, NULL, 'Chicken wings cooked with BBQ and Honey', 0, '2018-08-14 09:20:06', '2018-08-14 09:20:06'),
(5, 2, 2, 5, 'Burger', 99.00, 0.00, 0.00, NULL, 'Bread topped with panner and cheese', 1, '2018-08-14 09:20:06', '2018-08-14 09:20:06'),
(6, 1, 4, 7, 'Noodles', 119.00, 0.00, 0.00, NULL, '', 0, '2018-08-14 11:12:04', '2018-08-14 11:12:04'),
(7, 1, 5, 6, 'Veg Meals', 90.00, 0.00, 0.00, NULL, '', 1, '2018-08-14 11:13:27', '2018-08-14 11:13:27'),
(8, 1, 7, 1, 'Vanilla Milkshake', 49.00, 0.00, 0.00, NULL, '', 0, '2018-08-14 11:19:02', '2018-08-14 11:19:02'),
(9, 1, 1, 1, 'BBQ Chicken', 200.00, 0.00, 0.00, NULL, 'Chicken wings cooked with BBQ and Honey', 0, '2018-11-29 12:31:50', '2018-11-29 12:31:50'),
(10, 1, 1, 3, 'Noodles', 70.00, 0.00, 0.00, NULL, 'Noodles cooked with BBQ and Honey', 0, '2018-11-29 12:31:50', '2018-11-29 12:31:50'),
(11, 1, 1, 1, 'Veg Noodles', 65.00, 0.00, 0.00, NULL, 'Veg Noodles cooked with BBQ and Honey', 1, '2018-11-29 12:33:18', '2018-11-29 12:33:18'),
(12, 1, 3, 1, 'Fried Rice', 80.00, 0.00, 0.00, NULL, 'Hot and Crispy', 1, '2018-11-29 12:33:18', '2018-11-29 12:33:18'),
(13, 1, 3, 1, 'Egg Fried Rice', 100.00, 0.00, 0.00, NULL, 'Hot and Spicy', 0, '2018-11-29 12:34:35', '2018-11-29 12:34:35'),
(14, 1, 3, 2, 'Chicken Noodles', 190.00, 0.00, 0.00, NULL, 'Hot and Tasty', 0, '2018-11-29 12:34:35', '2018-11-29 12:34:35'),
(15, 1, 3, 2, 'Pron Fried Rice', 220.00, 0.00, 0.00, NULL, 'Hot and Chilli', 0, '2018-11-29 12:35:55', '2018-11-29 12:35:55'),
(16, 1, 7, 1, 'Veg Briyani', 290.00, 0.00, 0.00, NULL, 'Tasty', 1, '2018-11-29 12:35:55', '2018-11-29 12:35:55'),
(17, 1, 7, 2, 'Egg Briyani', 200.00, 0.00, 0.00, NULL, 'Tasty', 0, '2018-11-29 12:40:15', '2018-11-29 12:40:15'),
(18, 1, 7, 1, 'Chicken Briyani', 199.00, 0.00, 0.00, NULL, 'Tasty and Spicy', 0, '2018-11-29 12:40:15', '2018-11-29 12:40:15'),
(19, 1, 5, 6, 'Non-veg Meals', 175.00, 0.00, 0.00, NULL, 'Hot', 0, '2018-11-29 12:41:13', '2018-11-29 12:41:13');

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
  `title` varchar(150) NOT NULL,
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
(1, 1, 'public/uploads/kfc1.jpeg', 'Shawarma Starting @ Rs.39', 'Tab the banner to get Order', 2, 0, 0, '2018-08-10 11:05:54', '2018-08-10 11:05:54'),
(2, 2, 'public/uploads/beef-shawarma.jpg', 'Beef Shawarma Starting @ Rs.59', 'Tab the banner to get Order', 1, 0, 0, '2018-08-10 11:05:54', '2018-08-10 11:05:54'),
(3, 2, 'public/uploads/225a8f59-1cf8-4171-870a-0095358b161a.JPG', 'Offer @ Rs.99', 'Tab the banner to get Order', 3, 0, 0, '2018-09-19 05:50:33', '2018-09-19 05:50:33'),
(4, 1, 'public/uploads/kfc1.jpeg', 'Shawarma Starting @ Rs.39', 'Tab the banner to get Order', 4, 0, 1, '2018-11-12 18:54:14', '2018-11-12 18:54:14'),
(5, 2, 'public/uploads/225a8f59-1cf8-4171-870a-0095358b161a.JPG', 'Offer @ Rs.99', 'Tab the banner to get Order', 5, 0, 1, '2018-11-12 18:54:14', '2018-11-12 18:54:14'),
(6, 4, 'public/uploads/dominos1.png', '10% Discount on Morning Menu', 'Tab the banner to get Order', 6, 0, 1, '2018-11-12 18:57:25', '2018-11-12 18:57:25');

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
(1, 'EATZILLA001', 16, 1, 0, 427.00, 0.00, 10.00, 0.00, 0.00, 437.00, 0.00, 0.00, 0.00, 'NA', 0, 0, 1, 0, '153, Mecricar Rd, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005512, 76.954429, '2018-11-26 11:35:02', NULL, '2018-11-26 11:35:02', '2018-11-26 11:35:02'),
(2, 'EATZILLA002', 16, 1, 2, 159.00, 0.00, 10.00, 0.00, 0.00, 169.00, 0.00, 0.00, 0.00, 'NA', 0, 0, 1, 2, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005493, 76.954433, '2018-11-26 11:53:16', NULL, '2018-11-26 11:53:16', '2018-11-27 06:10:06'),
(3, 'EATZILLA003', 50, 1, 0, 556.00, 0.00, 10.00, 0.00, 0.00, 566.00, 0.00, 0.00, 0.00, 'NA', 0, 0, 1, 0, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005536, 76.954465, '2018-11-26 11:55:05', NULL, '2018-11-26 11:55:05', '2018-11-26 11:55:05'),
(4, 'EATZILLA004', 51, 1, 0, 695.00, 0.00, 10.00, 0.00, 0.00, 705.00, 0.00, 0.00, 0.00, 'NA', 0, 0, 1, 0, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005544, 76.954453, '2018-11-26 12:25:31', NULL, '2018-11-26 12:25:31', '2018-11-26 12:25:31'),
(5, 'EATZILLA005', 51, 1, 2, 159.00, 0.00, 10.00, 0.00, 0.00, 169.00, 0.00, 0.00, 0.00, 'NA', 0, 0, 1, 2, '27, Mecricar Rd, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005545, 76.954451, '2018-11-26 12:26:46', NULL, '2018-11-26 12:26:46', '2018-11-27 06:09:20'),
(6, 'EATZILLA006', 52, 1, 2, 507.00, 0.00, 10.00, 0.00, 0.00, 517.00, 0.00, 0.00, 0.00, 'NA', 1, 1, 1, 7, '153, Mecricar Rd, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005511, 76.954429, '2018-11-26 13:06:38', NULL, '2018-11-26 13:06:38', '2018-11-26 13:11:42'),
(7, 'EATZILLA007', 52, 2, 2, 238.00, 0.00, 10.00, 0.00, 0.00, 248.00, 0.00, 0.00, 0.00, 'NA', 1, 1, 1, 7, 'Shop No.31, 31, Mecricar Rd, Poo Market, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005532, 76.954506, '2018-11-26 13:16:27', NULL, '2018-11-26 13:16:27', '2018-11-26 13:16:44'),
(8, 'EATZILLA008', 52, 1, 2, 427.00, 0.00, 10.00, 0.00, 0.00, 437.00, 0.00, 0.00, 0.00, 'NA', 1, 1, 1, 7, 'Shop No.31, 31, Mecricar Rd, Poo Market, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005504, 76.954514, '2018-11-26 13:18:47', NULL, '2018-11-26 13:18:47', '2018-11-26 13:18:58'),
(9, 'EATZILLA009', 52, 1, 2, 685.00, 0.00, 10.00, 0.00, 0.00, 695.00, 0.00, 0.00, 0.00, 'NA', 1, 1, 1, 7, 'Hope College, Peelamedu, Coimbatore, Tamil Nadu 641004, India', 11.023811, 11.023811, '2018-11-26 13:30:47', NULL, '2018-11-26 13:30:47', '2018-11-26 13:31:00'),
(10, 'EATZILLA010', 52, 2, 2, 238.00, 0.00, 10.00, 0.00, 0.00, 248.00, 0.00, 0.00, 0.00, 'NA', 1, 1, 1, 7, '153, Mecricar Rd, Sukrawar Pettai, R.S. Puram, Coimbatore, Tamil Nadu 641002, India', 11.005519, 76.954436, '2018-11-26 13:34:03', NULL, '2018-11-26 13:34:03', '2018-11-26 13:34:16'),
(11, 'EATZILLA011', 37, 1, 0, 159.00, 15.90, 10.00, 0.00, 0.00, 153.10, 0.00, 0.00, 0.00, 'testcode', 0, 0, 1, 0, 'Jains Apartment,Avinashi Rd, Peelamedu, Coimbatore, Tamil Nadu 641004, India', 11.025369, 76.997248, '2018-11-27 12:27:06', NULL, '2018-11-27 12:27:06', '2018-11-27 12:27:06'),
(12, 'EATZILLA012', 37, 2, 0, 377.00, 37.70, 10.00, 0.00, 0.00, 349.30, 0.00, 0.00, 0.00, 'testcode', 0, 0, 1, 0, 'Jains Apartment,Avinashi Rd, Peelamedu, Coimbatore, Tamil Nadu 641004, India', 11.025369, 76.997248, '2018-11-28 07:27:22', NULL, '2018-11-28 07:27:22', '2018-11-28 07:27:22'),
(13, 'EATZILLA013', 37, 1, 0, 338.00, 33.80, 10.00, 0.00, 0.00, 314.20, 0.00, 0.00, 0.00, 'testcode', 0, 0, 1, 0, 'Jains Apartment,Avinashi Rd, Peelamedu, Coimbatore, Tamil Nadu 641004, India', 11.025369, 76.997248, '2018-11-28 15:52:00', NULL, '2018-11-28 15:52:00', '2018-11-28 15:52:00'),
(14, 'EATZILLA014', 37, 1, 0, 417.00, 41.70, 10.00, 0.00, 0.00, 385.30, 0.00, 0.00, 0.00, 'testcode', 0, 0, 1, 0, 'Jains Apartment,Avinashi Rd, Peelamedu, Coimbatore, Tamil Nadu 641004, India', 11.025369, 76.997248, '2018-11-29 06:59:16', NULL, '2018-11-29 06:59:16', '2018-11-29 06:59:16');

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
(1, 1, 1, 1, 1, 0, '2018-11-26 11:35:02', '2018-11-26 11:35:02'),
(2, 1, 1, 3, 1, 0, '2018-11-26 11:35:02', '2018-11-26 11:35:02'),
(3, 1, 1, 2, 1, 0, '2018-11-26 11:35:02', '2018-11-26 11:35:02'),
(4, 2, 1, 1, 1, 0, '2018-11-26 11:53:16', '2018-11-26 11:53:16'),
(5, 3, 1, 1, 1, 0, '2018-11-26 11:55:05', '2018-11-26 11:55:05'),
(6, 3, 1, 3, 1, 0, '2018-11-26 11:55:05', '2018-11-26 11:55:05'),
(7, 3, 1, 2, 2, 0, '2018-11-26 11:55:05', '2018-11-26 11:55:05'),
(8, 4, 1, 1, 1, 0, '2018-11-26 12:25:31', '2018-11-26 12:25:31'),
(9, 4, 1, 3, 2, 0, '2018-11-26 12:25:31', '2018-11-26 12:25:31'),
(10, 4, 1, 2, 2, 0, '2018-11-26 12:25:31', '2018-11-26 12:25:31'),
(11, 5, 1, 1, 1, 0, '2018-11-26 12:26:46', '2018-11-26 12:26:46'),
(12, 6, 1, 1, 1, 0, '2018-11-26 13:06:38', '2018-11-26 13:06:38'),
(13, 6, 1, 3, 1, 0, '2018-11-26 13:06:38', '2018-11-26 13:06:38'),
(14, 6, 1, 6, 1, 0, '2018-11-26 13:06:38', '2018-11-26 13:06:38'),
(15, 6, 1, 7, 1, 0, '2018-11-26 13:06:38', '2018-11-26 13:06:38'),
(16, 7, 2, 4, 1, 0, '2018-11-26 13:16:27', '2018-11-26 13:16:27'),
(17, 7, 2, 5, 1, 0, '2018-11-26 13:16:27', '2018-11-26 13:16:27'),
(18, 8, 1, 1, 1, 0, '2018-11-26 13:18:47', '2018-11-26 13:18:47'),
(19, 8, 1, 3, 1, 0, '2018-11-26 13:18:47', '2018-11-26 13:18:47'),
(20, 8, 1, 2, 1, 0, '2018-11-26 13:18:47', '2018-11-26 13:18:47'),
(21, 9, 1, 1, 1, 0, '2018-11-26 13:30:47', '2018-11-26 13:30:47'),
(22, 9, 1, 3, 1, 0, '2018-11-26 13:30:47', '2018-11-26 13:30:47'),
(23, 9, 1, 2, 1, 0, '2018-11-26 13:30:47', '2018-11-26 13:30:47'),
(24, 9, 1, 6, 1, 0, '2018-11-26 13:30:47', '2018-11-26 13:30:47'),
(25, 9, 1, 7, 1, 0, '2018-11-26 13:30:47', '2018-11-26 13:30:47'),
(26, 9, 1, 8, 1, 0, '2018-11-26 13:30:47', '2018-11-26 13:30:47'),
(27, 10, 2, 4, 1, 0, '2018-11-26 13:34:03', '2018-11-26 13:34:03'),
(28, 10, 2, 5, 1, 0, '2018-11-26 13:34:03', '2018-11-26 13:34:03'),
(29, 11, 1, 1, 1, 0, '2018-11-27 12:27:06', '2018-11-27 12:27:06'),
(30, 12, 2, 4, 2, 0, '2018-11-28 07:27:22', '2018-11-28 07:27:22'),
(31, 12, 2, 5, 1, 0, '2018-11-28 07:27:22', '2018-11-28 07:27:22'),
(32, 13, 1, 2, 1, 0, '2018-11-28 15:52:00', '2018-11-28 15:52:00'),
(33, 13, 1, 6, 1, 0, '2018-11-28 15:52:00', '2018-11-28 15:52:00'),
(34, 13, 1, 7, 1, 0, '2018-11-28 15:52:00', '2018-11-28 15:52:00'),
(35, 14, 1, 1, 1, 0, '2018-11-29 06:59:16', '2018-11-29 06:59:16'),
(36, 14, 1, 3, 1, 0, '2018-11-29 06:59:16', '2018-11-29 06:59:16'),
(37, 14, 1, 6, 1, 0, '2018-11-29 06:59:16', '2018-11-29 06:59:16');

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
(1, 'KFC', 'http://54.218.62.130/eatzilla/public/uploads/kfc1.jpeg', 'kfc@gmail.com', '12345', '10% Discount on Morning Menu', NULL, 5.0, 1, '15-25 mins', 10.00, 'RS Puram, Coimbatore', 11.01268300, 76.98948700, NULL, NULL, 0, '2018-08-10 06:29:25', '2018-08-10 06:29:25'),
(2, 'McDonalds', 'http://54.218.62.130/eatzilla/public/uploads/mcdonalds1.jpeg', 'macd@gmail.com', '123456', '10% Discount on Morning Menu', NULL, 3.4, 1, '15-25 mins', 10.00, 'RS Puram, Coimbatore', 11.01268300, 76.98948700, NULL, NULL, 0, '2018-08-10 06:48:07', '2018-08-10 06:48:07'),
(3, 'Pizza Hut', 'http://54.218.62.130/eatzilla/public/uploads/pizzahut1.png', NULL, NULL, '0', NULL, 4.5, 0, '15-25 mins', 0.00, 'Gandhipuram, Coimbatore', 11.01268300, 76.98948700, NULL, NULL, 0, '2018-08-10 06:49:20', '2018-08-10 06:49:20'),
(4, 'Dominos', 'http://54.218.62.130/eatzilla/public/uploads/dominos1.png', 'dominos@gmail.com', '12345', '10% Discount on Morning Menu', '', 5.0, 0, '20-25 mins', 10.00, 'RS Puram, Coimbatore', 11.01268300, 0.00000000, '10:00:00', '21:00:00', 1, '2018-08-31 05:19:31', '2018-08-31 05:19:31'),
(5, 'Papa Johns', 'http://54.218.62.130/eatzilla/public/uploads/5KWf21WNtBCAl8zRcUPsiO4sYi4yY4F4.jpeg', 'papajohns@gmail.com', '12345678', 'Explore Our Top Rated Eateries', '', 5.0, 0, '20-45 mins', 10.00, '148/112, Above More Mall, Bannerghatta Main Rd, NS Palya, Bengaluru, Karnataka', 11.01268300, 0.00000000, '10:00:00', '22:00:00', 1, '2018-11-15 11:37:40', '2018-11-15 11:37:40');

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
(1, 'admin_commission', '10', 1, '2018-09-30 17:57:23', '2018-09-30 17:57:23'),
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
(1, 1, 0, 'Order Placed', '2018-11-26 11:35:02', '2018-11-26 11:35:02'),
(2, 2, 0, 'Order Placed', '2018-11-26 11:53:16', '2018-11-26 11:53:16'),
(3, 3, 0, 'Order Placed', '2018-11-26 11:55:05', '2018-11-26 11:55:05'),
(4, 4, 0, 'Order Placed', '2018-11-26 12:25:32', '2018-11-26 12:25:32'),
(5, 5, 0, 'Order Placed', '2018-11-26 12:26:47', '2018-11-26 12:26:47'),
(6, 6, 0, 'Order Placed', '2018-11-26 13:06:38', '2018-11-26 13:06:38'),
(7, 6, 1, 'Order Accepted by Restaurant', '2018-11-26 13:11:42', '2018-11-26 13:11:42'),
(8, 6, 2, 'Food is being prepared', '2018-11-26 13:11:50', '2018-11-26 13:11:50'),
(9, 6, 3, 'Delivery Boy Started towards Restaurant', '2018-11-26 13:12:00', '2018-11-26 13:12:00'),
(10, 6, 4, 'Delivery Boy Reached restaurant', '2018-11-26 13:13:04', '2018-11-26 13:13:04'),
(11, 6, 5, 'Started towards Customer', '2018-11-26 13:13:10', '2018-11-26 13:13:10'),
(12, 6, 6, 'Food delivered', '2018-11-26 13:13:16', '2018-11-26 13:13:16'),
(13, 6, 7, 'Cash Received. Order Completed', '2018-11-26 13:13:23', '2018-11-26 13:13:23'),
(14, 7, 0, 'Order Placed', '2018-11-26 13:16:28', '2018-11-26 13:16:28'),
(15, 7, 1, 'Order Accepted by Restaurant', '2018-11-26 13:16:44', '2018-11-26 13:16:44'),
(16, 7, 2, 'Food is being prepared', '2018-11-26 13:16:51', '2018-11-26 13:16:51'),
(17, 7, 3, 'Delivery Boy Started towards Restaurant', '2018-11-26 13:16:56', '2018-11-26 13:16:56'),
(18, 7, 4, 'Delivery Boy Reached restaurant', '2018-11-26 13:17:41', '2018-11-26 13:17:41'),
(19, 7, 5, 'Started towards Customer', '2018-11-26 13:17:45', '2018-11-26 13:17:45'),
(20, 7, 6, 'Food delivered', '2018-11-26 13:18:03', '2018-11-26 13:18:03'),
(21, 7, 7, 'Cash Received. Order Completed', '2018-11-26 13:18:08', '2018-11-26 13:18:08'),
(22, 8, 0, 'Order Placed', '2018-11-26 13:18:48', '2018-11-26 13:18:48'),
(23, 8, 1, 'Order Accepted by Restaurant', '2018-11-26 13:18:58', '2018-11-26 13:18:58'),
(24, 8, 2, 'Food is being prepared', '2018-11-26 13:19:03', '2018-11-26 13:19:03'),
(25, 8, 3, 'Delivery Boy Started towards Restaurant', '2018-11-26 13:19:07', '2018-11-26 13:19:07'),
(26, 8, 3, 'Delivery Boy Started towards Restaurant', '2018-11-26 13:19:08', '2018-11-26 13:19:08'),
(27, 8, 4, 'Delivery Boy Reached restaurant', '2018-11-26 13:19:22', '2018-11-26 13:19:22'),
(28, 8, 5, 'Started towards Customer', '2018-11-26 13:19:28', '2018-11-26 13:19:28'),
(29, 8, 6, 'Food delivered', '2018-11-26 13:19:34', '2018-11-26 13:19:34'),
(30, 8, 7, 'Cash Received. Order Completed', '2018-11-26 13:19:41', '2018-11-26 13:19:41'),
(31, 9, 0, 'Order Placed', '2018-11-26 13:30:48', '2018-11-26 13:30:48'),
(32, 9, 1, 'Order Accepted by Restaurant', '2018-11-26 13:31:00', '2018-11-26 13:31:00'),
(33, 9, 2, 'Food is being prepared', '2018-11-26 13:31:22', '2018-11-26 13:31:22'),
(34, 9, 3, 'Delivery Boy Started towards Restaurant', '2018-11-26 13:32:51', '2018-11-26 13:32:51'),
(35, 9, 4, 'Delivery Boy Reached restaurant', '2018-11-26 13:33:06', '2018-11-26 13:33:06'),
(36, 9, 5, 'Started towards Customer', '2018-11-26 13:33:12', '2018-11-26 13:33:12'),
(37, 9, 6, 'Food delivered', '2018-11-26 13:33:13', '2018-11-26 13:33:13'),
(38, 9, 7, 'Cash Received. Order Completed', '2018-11-26 13:33:19', '2018-11-26 13:33:19'),
(39, 10, 0, 'Order Placed', '2018-11-26 13:34:04', '2018-11-26 13:34:04'),
(40, 10, 1, 'Order Accepted by Restaurant', '2018-11-26 13:34:16', '2018-11-26 13:34:16'),
(41, 10, 2, 'Food is being prepared', '2018-11-26 13:34:21', '2018-11-26 13:34:21'),
(42, 10, 3, 'Delivery Boy Started towards Restaurant', '2018-11-26 13:34:45', '2018-11-26 13:34:45'),
(43, 10, 4, 'Delivery Boy Reached restaurant', '2018-11-26 13:34:57', '2018-11-26 13:34:57'),
(44, 10, 5, 'Started towards Customer', '2018-11-26 13:35:06', '2018-11-26 13:35:06'),
(45, 10, 6, 'Food delivered', '2018-11-26 13:35:11', '2018-11-26 13:35:11'),
(46, 10, 7, 'Cash Received. Order Completed', '2018-11-26 13:35:16', '2018-11-26 13:35:16'),
(47, 5, 1, 'Order Accepted by Restaurant', '2018-11-27 06:09:20', '2018-11-27 06:09:20'),
(48, 5, 2, 'Food is being prepared', '2018-11-27 06:09:25', '2018-11-27 06:09:25'),
(49, 2, 1, 'Order Accepted by Restaurant', '2018-11-27 06:10:06', '2018-11-27 06:10:06'),
(50, 2, 2, 'Food is being prepared', '2018-11-27 06:10:12', '2018-11-27 06:10:12'),
(51, 11, 0, 'Order Placed', '2018-11-27 12:27:06', '2018-11-27 12:27:06'),
(52, 12, 0, 'Order Placed', '2018-11-28 07:27:22', '2018-11-28 07:27:22'),
(53, 13, 0, 'Order Placed', '2018-11-28 15:52:01', '2018-11-28 15:52:01'),
(54, 14, 0, 'Order Placed', '2018-11-29 06:59:17', '2018-11-29 06:59:17');

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
(16, 'GiriVignesh', '919524722184', 'Giri3@test.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'S2EfmcrmYvoml9yv', 'android', 'f2uhmNBBh-k:APA91bFQv0a7VWCDA2zyYG8x4zA16oHcXpRTGG6H1VBXC-1KsQcxYufxVbT0ZphUzvVfIqprC_-ReCcQq58WEhCcVS63PcucH0E7wEkOKIzTeEO4YldkPNGQkM26ja8afGaNrUyPkyr7', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'wpn8j9RP', 0.00, 0, '2018-09-11 08:32:26', '2018-11-30 10:05:03'),
(17, NULL, '7823948822', 'soundariyalingan@gmail.com', 'dE9DY2EzRGZpcThYeVlxVW1OTjBrdz09', 'OGqQtg9Yp46GqDhe', 'android', 'cRwLa5AE_sQ:APA91bFSjh9nD52i4aiIYSLG-BT6NWHHYGNYKig1r7FCi_hdJjEGtLxLJR2Muqe-QAa9PNHlhKe3YTUIL1vH6sOUKZQffxQmuQoJwIe2OqpvWtLtOnkYZngYIJdghETCS3HU0CmnrbDV', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'bdsJ9Qoz', 0.00, 0, '2018-09-13 10:44:26', '2018-09-13 10:44:26'),
(18, NULL, '86677617798', 'vishnuvardhanamz@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'gELpYGOxMhM5bRNZ', 'android', 'crymDd_aigY:APA91bHH00Fd98WHXSALU3PFzIYp2jqn-vVLzDeWyU3OnJznl7LLOSfDIjf44LxpYQ6Hxvg80GC_lGRPHu4fUYNkn4tEhP5Y5YQ2nZbiIv2EAm-4-68fYderVTXaeekWDlON_0EarWJ-', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'Pjhcd7wI', 0.00, 0, '2018-09-29 10:17:24', '2018-10-04 01:09:12'),
(19, NULL, '9597434949', 'vishnuvardhan4006@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'eNbU-Q1nBkc:APA91bGOv-TB-IXvMRmSYagNrmSnJxYkQSa8McUtX4s7oJu8B_q1V4vxwqE35CxQ6FX7XZo0WL8eo0-ryjwAQm8Kb7Y-ERzUT4ppqlckqutYtddl7UcbafpWGwmVsY6EPIR5_jg0I9P6', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'WDLPT52S', 0.00, 0, '2018-09-30 00:31:07', '2018-09-30 18:45:57'),
(20, NULL, '7708889555', 'vishnuvardhan4@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'KG9jjIPuLzsJaS7D', 'android', 'efc2SzoBqgg:APA91bE1Oohcy57GqEUNqSgAVHSM4qshl25H6vN57VnxVq9jVQYcfkw9T54u9AHiDb8u0st4CSgbQqq16aN-OU5IEA9ihfdLFAkSt9c8xRUVWd-CYPCiF6SxUuxae8tEWpqCQQU0mXdP', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'ggbUtbTh', 0.00, 0, '2018-09-30 18:56:56', '2018-10-01 11:49:19'),
(21, NULL, '9655788935', 'senthilbaskaran001@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'efc2SzoBqgg:APA91bE1Oohcy57GqEUNqSgAVHSM4qshl25H6vN57VnxVq9jVQYcfkw9T54u9AHiDb8u0st4CSgbQqq16aN-OU5IEA9ihfdLFAkSt9c8xRUVWd-CYPCiF6SxUuxae8tEWpqCQQU0mXdP', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'Lng6mMvi', 0.00, 0, '2018-10-01 11:45:42', '2018-10-01 11:49:06'),
(22, 'Praveenkumar', '919600771099', 'vishnu.wardhan8@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'TThpY2SstHN1mFZe', 'web', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'U1r5ourq', 0.00, 0, '2018-10-03 13:52:28', '2018-11-30 09:28:03'),
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
(37, 'santhosh', '9942174014', 'santhosh@gmail.com', 'RTlHeExFbDB6OTd6amxhWE80VzBEdz09', 'pbK2EZLlYJGJLgwd', 'web', 'jhsvjx', 0, 'http://54.218.62.130/eatzilla/public/uploads/N9iKAFVk0HFIQ5gx9RHGDLn9wLjI9r4X.png', 'IKr3gGnK', 0.00, 0, '2018-10-28 03:36:11', '2018-12-01 06:09:03'),
(38, NULL, '9095471451', 's.santhosh51@yahoo.com', 'RTlHeExFbDB6OTd6amxhWE80VzBEdz09', '6VZaoaiGVe81iIYd', 'android', 'abc123', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'j4htPd4h', 0.00, 0, '2018-10-28 04:33:48', '2018-10-28 05:57:51'),
(39, 'santhosh santi', '99421740140', 'sssanthosh298@gmail.com', 'VGlyR0piazZ1b29KcDM0NnM4dFZ4UT09', '0', 'web', 'jhsvjx', 0, 'http://54.218.62.130/eatzilla/public/uploads/tDLNYQf6HB2GbVUL9UdmVo0N6nPHawOD.jpg', 't1fY1X9J', 0.00, 0, '2018-10-28 06:00:03', '2018-11-24 10:47:51'),
(40, NULL, '9600975087', 'shobikababu1996@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', 'WSnSwqx4jKCT49Mj', 'android', 'dlgOD_-FOC8:APA91bFqmap3M6pBnOHU0nGymcxa7CckLU7IhTJ7YiQxT1caL1d3E9-zshUmu68-5mv_WCtYHgUmrc6mFeggDgJaZb7xeobhWylDwpaS4px-h2c-9LTnDBrdOnS6Tw3g_dpbjUiEXCrk', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'e0yDXr6e', 0.00, 0, '2018-11-09 10:55:07', '2018-11-10 09:41:43'),
(41, ' ', '99421740146', 's.santhosh561@yahoo.com', 'VGlyR0piazZ1b29KcDM0NnM4dFZ4UT09', '1CXXIaUfe9TsdZnJ', 'web', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'ybN8iK1B', 0.00, 0, '2018-11-14 11:49:28', '2018-11-14 11:49:28'),
(42, ' ', '919600771', 'praveen4@sparkouttech.com', 'VGlyR0piazZ1b29KcDM0NnM4dFZ4UT09', 'Zek5yvHyEwLkTPig', 'web', 'abc123', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'VumzyneO', 0.00, 0, '2018-11-14 12:24:35', '2018-11-14 12:29:02'),
(43, NULL, '9876543329', 'jeeva@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'android', 'dhcKLEQyHtg:APA91bH4CM13QejBnk63FFL51cmHS-R9zPD_dCj9-43AEWzlQpoMRvlJ4CfIGu_oZM_U1u66PtVi5SLw-pUhmP2rjvtN9g8cxVXv923r7OZlvqlDka8rTgGCe8DBdl0ZWrmOSVkHYt2L', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'rAMatisF', 0.00, 0, '2018-11-15 05:39:10', '2018-11-15 05:55:44'),
(44, NULL, '9976790909', 'ken@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0IdwOkRbGgeWWC3g', 'android', 'dhcKLEQyHtg:APA91bH4CM13QejBnk63FFL51cmHS-R9zPD_dCj9-43AEWzlQpoMRvlJ4CfIGu_oZM_U1u66PtVi5SLw-pUhmP2rjvtN9g8cxVXv923r7OZlvqlDka8rTgGCe8DBdl0ZWrmOSVkHYt2L', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'nBFxcJww', 0.00, 0, '2018-11-15 05:56:46', '2018-11-15 05:56:46'),
(45, NULL, '9789369927', 'keerthi@gmail.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', 'D6YKLiVdj90vC6ep', 'android', 'eam6MYNY8k8:APA91bFhrB4T7FrMHKHFe5RDAFYg2YCd-YOAd5Cg5ko1FBwwvjwP7WTauAXGHyVAJcYSFuy4gKglt-VCbOK1i32DKf9lk5f8Ho7YjOZ_0JYAvh8rPstSYqq9OUvAvVyr4Eys3PVlgNiO', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', '3OhTa9cd', 0.00, 0, '2018-11-15 16:26:09', '2018-11-16 04:58:15'),
(48, 'Praveen kumar', '8508082716', 'praveenkumartup1@gmail.com.com', 'ZHJhRlZnaE9MMFRDS21uM3BuQ3AxQT09', '0', 'web', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'mbt3aEHS', 0.00, 0, '2018-11-15 19:25:56', '2018-11-15 19:33:03'),
(49, 'saminathan v', '7373343302', 'santhoshsaminathan3@gmail.com', 'RTlHeExFbDB6OTd6amxhWE80VzBEdz09', '0', 'web', 'jhsvjx', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'Iely6NwO', 0.00, 0, '2018-11-17 07:45:02', '2018-11-18 13:44:10'),
(50, NULL, '9788429214', 'devicetesting000@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', 'D6YKLiVdj90vC6ep', 'android', 'cssfeNcb7RY:APA91bEIMmI0WGZivCMvnMvXEKVLctEER-0uq9egM6n-a45dIhdtsZxBX1CuAZR81Tx8xYaaes8nc97NcjJQRjZakhT2xskAvaVPAUTttuScBNAuc7QHDQVD8XbhwU9lSses5AbITw1q', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'sH61onRG', 0.00, 0, '2018-11-26 07:04:34', '2018-11-26 11:59:29'),
(51, NULL, '867726177', 'vishnu@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', '0', 'android', 'cssfeNcb7RY:APA91bEIMmI0WGZivCMvnMvXEKVLctEER-0uq9egM6n-a45dIhdtsZxBX1CuAZR81Tx8xYaaes8nc97NcjJQRjZakhT2xskAvaVPAUTttuScBNAuc7QHDQVD8XbhwU9lSses5AbITw1q', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', '2svWqvpg', 0.00, 0, '2018-11-26 12:10:00', '2018-11-26 12:32:10'),
(52, NULL, '8667726177', 'vishnuvardhan@gmail.com', 'SmtxQkFQUWRsdFN0N0UxMy92NU1oUT09', '4Q2wToaicI28gwjw', 'android', 'cssfeNcb7RY:APA91bEIMmI0WGZivCMvnMvXEKVLctEER-0uq9egM6n-a45dIhdtsZxBX1CuAZR81Tx8xYaaes8nc97NcjJQRjZakhT2xskAvaVPAUTttuScBNAuc7QHDQVD8XbhwU9lSses5AbITw1q', 0, 'http://www.freeiconspng.com/uploads/account-profile-icon-1.png', 'SBIhJETv', 0.00, 0, '2018-11-26 12:35:19', '2018-11-26 12:47:38');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `delivery_partners`
--
ALTER TABLE `delivery_partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `favourite_list`
--
ALTER TABLE `favourite_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;
--
-- AUTO_INCREMENT for table `food_list`
--
ALTER TABLE `food_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `offers_banner`
--
ALTER TABLE `offers_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `request_detail`
--
ALTER TABLE `request_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
