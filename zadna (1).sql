-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2020 at 05:16 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zadna`
--

-- --------------------------------------------------------

--
-- Table structure for table `boxes`
--

CREATE TABLE `boxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `crop_id` int(11) DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `row` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `column` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signed` int(11) NOT NULL DEFAULT 0,
  `signed_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `point1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `point2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `point3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `point4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `column_count` int(11) DEFAULT NULL,
  `row_count` int(11) DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Workers` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Supervisors` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `boxes`
--

INSERT INTO `boxes` (`id`, `crop_id`, `code`, `row`, `column`, `signed`, `signed_file`, `point1`, `point2`, `point3`, `point4`, `size`, `column_count`, `row_count`, `note`, `Workers`, `Supervisors`, `created_at`, `updated_at`) VALUES
(1, 3, '34f', '34', 'f', 0, NULL, '1|,,,|,,,', '3|,,,|,,,', '4|,,,|,,,', '5|,,,|,,,', '36.3', 33, 55, 'fff', '', '', '2019-01-15 12:49:48', '2019-01-15 12:49:48'),
(7, NULL, '55', NULL, NULL, 0, NULL, '45|,,,|,,,', '45|,,,|,,,', '45|,,,|,,,', '45|,,,|,,,', '45', 45, 45, NULL, '', '', '2019-01-28 19:57:41', '2019-01-28 19:57:41'),
(8, NULL, '54', NULL, NULL, 0, NULL, '1|10,45,55,66|62,45,55,66', '2|10,45,55,66|62,45,55,66', '3|10,45,55,66|5,45,55,66', '4|10,45,55,66|62,45,55,66', '1200', 50, 20, NULL, '', '', '2019-08-27 08:12:35', '2019-08-27 08:12:35'),
(9, NULL, '38', NULL, NULL, 0, NULL, '1|10,45,55,66|62,45,55,66', '2|10,45,55,66|62,45,55,66', '3|10,45,55,66|62,45,55,66', '4|10,45,55,66|62,45,55,66', '50000', 500, 500, NULL, '', '', '2019-09-15 06:11:15', '2019-09-15 06:11:15'),
(10, NULL, '54', NULL, NULL, 0, NULL, '1|10,45,55,66|62,45,55,66', '2|10,45,55,66|62,45,55,66', '3|10,45,55,66|62,45,55,66', '4|10,45,55,66|62,45,55,66', '50000', 500, 500, NULL, '', '', '2019-09-15 06:11:16', '2019-09-15 06:11:16'),
(11, NULL, '88', NULL, NULL, 0, NULL, '1|10,45,55,66|62,45,55,66', '2|10,45,55,66|62,45,55,66', '3|10,45,55,66|62,45,55,66', '4|10,45,55,66|62,45,55,66', '1212', 12, 12, NULL, '', '', '2019-09-29 06:31:48', '2019-09-29 06:31:48'),
(12, NULL, '46', NULL, NULL, 0, NULL, '1|10,45,55,66|62,45,55,66', '2|10,45,55,66|62,45,55,66', '3|10,45,55,66|62,45,55,66', '4|10,45,55,66|62,45,55,66', '324321', 234, 23, NULL, '', '', '2019-09-29 09:51:57', '2019-09-29 09:51:57'),
(13, NULL, '45', NULL, NULL, 0, NULL, '1|10,45,55,66|62,45,55,66', '2|10,45,55,66|62,45,55,66', '3|10,45,55,66|62,45,55,66', '4|10,45,55,66|62,45,55,66', '234533', 999, 999, NULL, '', '', '2019-09-29 09:52:58', '2019-09-29 09:52:58'),
(14, NULL, '86', NULL, NULL, 0, NULL, '1|10,45,55,66|62,45,55,66', '2|10,45,55,66|62,45,55,66', '3|10,45,55,66|62,45,55,66', '4|10,45,55,66|62,45,55,66', '232323', 23, 23, NULL, '', '', '2019-09-29 10:45:46', '2019-09-29 10:45:46'),
(15, NULL, '85', NULL, NULL, 0, NULL, '1213|3,2,1,0|1,5,3,4', '1425|1,4,3,5|7,5,3,1', '3789|1,4,3,2|5,5,4,3', '7453|3,2,4,4|5,3,2,4', '250', 41, 41, NULL, '', '', '2019-09-30 08:43:53', '2019-09-30 08:43:53'),
(16, NULL, '18', NULL, NULL, 0, NULL, '1|10,45,55,66|62,45,55,66', '2|10,45,55,66|62,45,55,66', '3|10,45,55,66|62,45,55,66', '4|10,45,55,66|62,45,55,66', '856', 250, 120, NULL, '', '', '2019-10-01 09:54:58', '2019-10-01 09:54:58'),
(17, NULL, '48', NULL, NULL, 0, NULL, '1|10,45,55,66|62,45,55,66', '2|10,45,55,66|62,45,55,66', '3|10,45,55,66|62,45,55,66', '4|10,45,55,66|62,45,55,66', '345', 1205, 120, NULL, 'test', 'tesgt', '2019-10-01 12:43:54', '2019-10-01 12:43:54');

-- --------------------------------------------------------

--
-- Table structure for table `box_irrigation`
--

CREATE TABLE `box_irrigation` (
  `id` int(10) UNSIGNED NOT NULL,
  `irrigation_id` int(10) UNSIGNED DEFAULT NULL,
  `box_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `box_irrigation`
--

INSERT INTO `box_irrigation` (`id`, `irrigation_id`, `box_id`, `created_at`, `updated_at`) VALUES
(3, 2, 7, NULL, NULL),
(4, 1, 1, NULL, NULL),
(5, 3, 7, NULL, NULL),
(6, 4, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `box_soil_analysis`
--

CREATE TABLE `box_soil_analysis` (
  `id` int(10) UNSIGNED NOT NULL,
  `box_id` int(10) UNSIGNED NOT NULL,
  `datetime` date DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recommendation` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cleaning`
--

CREATE TABLE `cleaning` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `box_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `palm_tree` int(11) DEFAULT NULL,
  `qyt` int(11) DEFAULT NULL,
  `implementation` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cleaning`
--

INSERT INTO `cleaning` (`id`, `code`, `box_id`, `user_id`, `start_date`, `end_date`, `palm_tree`, `qyt`, `implementation`, `created_at`, `updated_at`) VALUES
(2, 1001, 1, NULL, '2019-01-03', NULL, NULL, NULL, 1, '2019-01-28 22:38:12', '2019-01-28 22:38:12'),
(3, 1002, 10, NULL, '2019-09-17', NULL, NULL, NULL, 1, '2019-09-17 09:35:19', '2019-09-17 09:35:19'),
(4, 1003, 7, NULL, '2019-09-15', NULL, NULL, NULL, 1, '2019-09-17 09:36:05', '2019-09-17 09:36:05'),
(5, 1004, 9, NULL, '2019-09-17', NULL, NULL, NULL, 1, '2019-09-17 09:36:29', '2019-09-17 09:36:29'),
(6, 1005, 8, NULL, '2019-09-24', '1970-01-01', NULL, NULL, 2, '2019-09-17 09:37:01', '2019-09-17 12:03:00'),
(7, 1006, 7, NULL, '2019-09-17', NULL, NULL, NULL, 1, '2019-09-17 12:03:41', '2019-09-17 12:03:41');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'signature_wells', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `crew`
--

CREATE TABLE `crew` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `crew_id` int(10) UNSIGNED DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_id` bigint(20) NOT NULL,
  `day_work_num` int(11) DEFAULT NULL,
  `cost_by_day` int(11) DEFAULT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `process` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost_by_month` int(11) DEFAULT NULL,
  `total_cost` int(11) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crops`
--

CREATE TABLE `crops` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qyt` int(11) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `crop_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crops`
--

INSERT INTO `crops` (`id`, `code`, `title`, `type`, `qyt`, `type_id`, `description`, `notes`, `date`, `crop_id`, `created_at`, `updated_at`) VALUES
(16, 20, 'bianbahaa', NULL, NULL, 5234, 'dsdspp', '2364', '2019-09-29', NULL, '2019-09-29 13:17:28', '2019-10-01 13:23:17'),
(17, 21, 'bian', NULL, NULL, 123, 'testhbj', 'UUYY', '2019-10-20', NULL, '2019-10-01 09:23:54', '2019-10-01 09:23:54'),
(18, 22, 'bianbahaa', NULL, NULL, 2334, 'TEST2', 'RETEST', '2019-10-27', NULL, '2019-10-01 09:24:23', '2019-10-01 09:24:23'),
(19, 23, 'اااا', NULL, NULL, 50, 'تاسلبس', 'يتي', '2019-10-08', NULL, '2019-10-01 12:44:03', '2019-10-01 12:44:03'),
(20, 24, 'بلح 10', NULL, NULL, 9897, 'عغعاعا', 'رلررلرل', '2019-10-14', NULL, '2019-10-13 06:42:42', '2019-10-13 06:42:42'),
(21, 25, 'بلح 677', NULL, NULL, 76565, 'بلح', 'بلح زغلول', '2019-10-13', NULL, '2019-10-13 06:43:38', '2019-10-13 06:43:38');

-- --------------------------------------------------------

--
-- Table structure for table `crop_box`
--

CREATE TABLE `crop_box` (
  `id` int(10) UNSIGNED NOT NULL,
  `crop_id` int(10) UNSIGNED NOT NULL,
  `rows` int(11) NOT NULL,
  `columns` int(11) NOT NULL,
  `box_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diseases`
--

CREATE TABLE `diseases` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diseases`
--

INSERT INTO `diseases` (`id`, `title`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'test', 'rertert', '2019-01-27 17:47:51', '2019-01-27 17:47:51'),
(2, 'nasr city', 'hhhhhhhhhhhhhhhh', '2019-09-15 12:58:41', '2019-09-15 12:58:41'),
(3, 'ضش', 'ناعاعاع', '2019-10-08 09:29:37', '2019-10-08 09:29:37'),
(4, 'اتلات', 'هتهتت', '2019-10-08 09:30:06', '2019-10-08 09:30:06'),
(5, 'برد', 'عندها زكام', '2019-10-13 10:58:50', '2019-10-13 10:58:50');

-- --------------------------------------------------------

--
-- Table structure for table `disease_combact_plan`
--

CREATE TABLE `disease_combact_plan` (
  `id` int(10) UNSIGNED NOT NULL,
  `disease_id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `used_way` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `repeat` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disease_control_plan`
--

CREATE TABLE `disease_control_plan` (
  `id` int(10) UNSIGNED NOT NULL,
  `disease_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disease_follow`
--

CREATE TABLE `disease_follow` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `disease_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `note_date` date NOT NULL,
  `writen_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `disease_follow`
--

INSERT INTO `disease_follow` (`id`, `code`, `disease_code`, `note`, `note_date`, `writen_by`, `created_at`, `updated_at`) VALUES
(1, 1000, '1000', 'sfsafsafsaf', '2019-09-20', 1, '2019-09-19 09:50:22', '2019-09-19 09:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `disease_palm_tree`
--

CREATE TABLE `disease_palm_tree` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `disease_id` int(10) UNSIGNED NOT NULL,
  `box_id` int(10) UNSIGNED NOT NULL,
  `plam_tree_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `recovery_percent` int(11) DEFAULT NULL,
  `losses_reason` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 2,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disease_plan_materials`
--

CREATE TABLE `disease_plan_materials` (
  `id` int(10) UNSIGNED NOT NULL,
  `disease_combact_plan_id` int(10) UNSIGNED NOT NULL,
  `pesticide` int(10) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

CREATE TABLE `equipments` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `qyt` int(11) NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`id`, `code`, `title`, `price`, `qyt`, `type_id`, `created_at`, `updated_at`) VALUES
(1, '10', 'bian', 100, 100, 3, '2019-08-22 09:23:57', '2019-08-22 09:28:42'),
(2, '11', 'الة', 200000, 100, 9, '2019-08-25 10:05:58', '2019-08-25 10:05:58'),
(3, '12', 'الاا', 7000, 6757, 10, '2019-08-25 10:07:09', '2019-08-25 10:07:09'),
(4, '13', 'test202', 120365, 117, 11, '2019-09-29 13:25:53', '2019-09-29 13:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_matrial`
--

CREATE TABLE `equipment_matrial` (
  `id` int(10) UNSIGNED NOT NULL,
  `equipment_id` int(10) UNSIGNED NOT NULL,
  `matrial_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipment_matrial`
--

INSERT INTO `equipment_matrial` (`id`, `equipment_id`, `matrial_id`, `created_at`, `updated_at`) VALUES
(2, 1, 1, NULL, NULL),
(3, 2, 1, NULL, NULL),
(4, 3, 2, NULL, NULL),
(7, 4, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `experiments`
--

CREATE TABLE `experiments` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `box_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experiment_type` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `execution_appointment` time NOT NULL,
  `success_percent` int(11) NOT NULL,
  `palms` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `execution_date` date NOT NULL,
  `alert_before_execution` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alert_measure` int(11) NOT NULL DEFAULT 1,
  `experiment_reason` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experiments`
--

INSERT INTO `experiments` (`id`, `code`, `box_id`, `name`, `experiment_type`, `create_date`, `execution_appointment`, `success_percent`, `palms`, `execution_date`, `alert_before_execution`, `alert_measure`, `experiment_reason`, `description`, `created_at`, `updated_at`) VALUES
(1, 1000, 1, 'wer', 1, '2019-01-01', '01:00:00', 2, '34f_23_23_11', '2019-01-17', '2', 2, 'wewr', 'werwer', '2019-01-27 17:42:02', '2019-01-27 17:42:02');

-- --------------------------------------------------------

--
-- Table structure for table `experiment_execute_steps`
--

CREATE TABLE `experiment_execute_steps` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `experiment_id` int(10) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recommendation` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experiment_execute_steps`
--

INSERT INTO `experiment_execute_steps` (`id`, `code`, `experiment_id`, `description`, `recommendation`, `date`, `created_at`, `updated_at`) VALUES
(1, 1000, 1, 'test', 'test', '2019-08-29', '2019-08-22 10:54:34', '2019-08-22 10:54:34');

-- --------------------------------------------------------

--
-- Table structure for table `farms`
--

CREATE TABLE `farms` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `creation_date` date NOT NULL,
  `map_farm` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farms`
--

INSERT INTO `farms` (`id`, `title`, `location`, `area`, `price`, `creation_date`, `map_farm`, `created_at`, `updated_at`) VALUES
(3, 'مزرعة 1', 'NASR CITY', 6005, 420000, '2019-08-29', NULL, '2019-08-27 08:06:44', '2019-09-24 10:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `faults`
--

CREATE TABLE `faults` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL,
  `fault_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `fault_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faults`
--

INSERT INTO `faults` (`id`, `type`, `fault_code`, `desc`, `date`, `fault_status`, `created_at`, `updated_at`) VALUES
(1, 1, '10', 'rty', '2019-01-12', 3, '2019-01-27 17:44:09', '2019-01-27 17:44:09'),
(2, 3, '10', 'test', '2019-01-04', 1, '2019-01-29 20:51:42', '2019-08-22 11:33:11'),
(3, 1, '10', 'aassdad', '2019-08-29', 2, '2019-08-22 11:04:59', '2019-08-22 11:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `fertilizing`
--

CREATE TABLE `fertilizing` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `box_id` int(10) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `used_type_id` int(11) DEFAULT NULL,
  `palm_tree_QYT` int(11) DEFAULT NULL,
  `matrial_id` int(10) UNSIGNED DEFAULT NULL,
  `fertilizer_QYT` int(11) DEFAULT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `palm_tree` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fertilizing`
--

INSERT INTO `fertilizing` (`id`, `code`, `box_id`, `start_date`, `end_date`, `used_type_id`, `palm_tree_QYT`, `matrial_id`, `fertilizer_QYT`, `notes`, `palm_tree`, `level_id`, `created_at`, `updated_at`) VALUES
(1, 1000, 1, '2019-01-28', '2019-01-22', NULL, NULL, 2, 34, NULL, NULL, 1, '2019-01-28 22:38:37', '2019-01-28 22:39:31');

-- --------------------------------------------------------

--
-- Table structure for table `fixedassets`
--

CREATE TABLE `fixedassets` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `fixedasset_type_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Purchasing_value` int(11) NOT NULL,
  `Market_value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fixedassets`
--

INSERT INTO `fixedassets` (`id`, `code`, `fixedasset_type_id`, `title`, `desc`, `note`, `Purchasing_value`, `Market_value`, `created_at`, `updated_at`) VALUES
(1, 1000, 6, 'bian', 'bian', 'bian', 55, 555, '2019-01-28 22:36:24', '2019-08-22 09:14:34'),
(2, 1001, 4, 'bian', 'bian', 'bian', 100, 155, '2019-08-22 09:15:19', '2019-08-22 09:15:19'),
(3, 1002, 5, 'bian', 'bian', 'rgtefdg', 55, 58, '2019-08-22 09:16:17', '2019-08-22 09:16:17'),
(4, 1003, 4, 'nawal', 'test', 'test', 123456, 258963, '2019-10-14 07:47:49', '2019-10-14 07:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `harvest`
--

CREATE TABLE `harvest` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `box_id` int(10) UNSIGNED NOT NULL,
  `crop_id` int(10) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `qyt` int(11) DEFAULT NULL,
  `row` int(11) DEFAULT NULL,
  `column` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `intersection`
--

CREATE TABLE `intersection` (
  `id` int(10) UNSIGNED NOT NULL,
  `irrigation_id` int(10) UNSIGNED NOT NULL,
  `line_type_id` int(11) DEFAULT NULL,
  `coordinates` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `irrigation`
--

CREATE TABLE `irrigation` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `signed` int(11) NOT NULL DEFAULT 0,
  `signed_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `line_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `water_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `lenght` int(11) NOT NULL,
  `point1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `point2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diameter_half` int(11) NOT NULL,
  `water_speed` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `irrigation`
--

INSERT INTO `irrigation` (`id`, `code`, `signed`, `signed_file`, `title`, `line_type`, `water_amount`, `cost`, `lenght`, `point1`, `point2`, `diameter_half`, `water_speed`, `created_at`, `updated_at`) VALUES
(1, 10, 1, NULL, 'ssf', '1', '43', '25', 23, '123|12,12,12,12|12,12,122,12', '2313|12,2,32,23|12,1,23,23', 23, 23, '2019-01-27 17:34:22', '2019-10-08 09:09:57'),
(2, 11, 0, NULL, 'bian', '1', '12', '789654', 120, '1|10,45,55,66|62,46,69,45', '2|20,49,55,10|20,98,12,789', 33, 1206, '2019-08-22 10:02:20', '2019-08-22 10:02:20'),
(3, 12, 0, NULL, 'شيماء', '1', '123', '233', 122, '1213|3,2,1,4|1,2,1,4', '1425|3,2,1,4|1,2,1,0', 233, 43, '2019-10-15 09:54:35', '2019-10-15 09:54:35'),
(4, 13, 0, NULL, 'esraaesraa', '1', '23', '789654', 23, '1|10,45,55,66|62,45,55,66', '2|10,45,55,66|62,45,55,66', 33, 1206, '2019-10-20 09:05:45', '2019-10-20 09:05:45');

-- --------------------------------------------------------

--
-- Table structure for table `irrigation_mahbas`
--

CREATE TABLE `irrigation_mahbas` (
  `id` int(10) UNSIGNED NOT NULL,
  `irrigation_id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `irrigation_mahbas`
--

INSERT INTO `irrigation_mahbas` (`id`, `irrigation_id`, `code`, `location`, `desc`, `created_at`, `updated_at`) VALUES
(1, 1, 10, '1|10,45,55,2|58,20,55,12', 'test', '2019-08-22 09:59:52', '2019-08-22 09:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `jura`
--

CREATE TABLE `jura` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `box_id` int(10) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `achieve` int(11) DEFAULT 1,
  `recommendation` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specifications` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jura`
--

INSERT INTO `jura` (`id`, `code`, `box_id`, `start_date`, `end_date`, `achieve`, `recommendation`, `specifications`, `depth`, `created_at`, `updated_at`) VALUES
(1, 1000, 1, '2019-01-04', '2019-01-25', 1, NULL, 'sdfsdf', 23, '2019-01-27 17:36:43', '2019-01-27 17:36:43'),
(2, 1001, 1, '2019-01-01', '2019-04-01', 2, NULL, 'ثصثصسثص', 656445, '2019-08-25 08:34:22', '2019-10-15 13:04:57');

-- --------------------------------------------------------

--
-- Table structure for table `jura_materials`
--

CREATE TABLE `jura_materials` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material_id` int(10) UNSIGNED NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `moduel_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jura_materials`
--

INSERT INTO `jura_materials` (`id`, `name`, `material_id`, `amount`, `post_id`, `moduel_id`, `created_at`, `updated_at`) VALUES
(1, 'service_matrial_id', 1, 23, 1, 14, NULL, NULL),
(2, 'cleansing_matrial_id', 1, 23, 1, 14, NULL, NULL),
(5, 'service_matrial_id', 3, 3232, 2, 14, NULL, NULL),
(6, 'cleansing_matrial_id', 1, 2456, 2, 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(10) UNSIGNED NOT NULL,
  `material_type_id` int(10) UNSIGNED NOT NULL,
  `material_unit_id` int(10) UNSIGNED NOT NULL,
  `main_groub` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `QYT` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `material_type_id`, `material_unit_id`, `main_groub`, `title`, `cost`, `code`, `QYT`, `note`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 3, 'test20', '5555', '10_11', 54, 'tetss', '2019-01-23 20:27:44', '2019-10-14 07:26:40'),
(2, 2, 2, 2, 'صثقث', '23', '11_11', 3, 'test', '2019-01-28 22:37:01', '2019-08-22 11:31:25'),
(3, 1, 2, 1, 'bian', '100.0000', '12_10', 100, 'test', '2019-08-22 09:20:46', '2019-08-22 09:20:46'),
(4, 1, 1, 2, 'bian', '1233344', '13_10', 323, 'edddddddddd', '2019-10-14 07:27:28', '2019-10-14 07:27:28');

-- --------------------------------------------------------

--
-- Table structure for table `material_units`
--

CREATE TABLE `material_units` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `material_units`
--

INSERT INTO `material_units` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'كجم', '2019-01-15 09:48:45', '2019-01-15 09:48:45'),
(2, 'سم', '2019-01-16 11:53:32', '2019-01-16 11:53:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_08_19_054951_material_units', 1),
(2, '2017_08_19_083636_create_irrigation_table', 1),
(3, '2017_10_14_212956_create_irrigation_mahbas_table', 1),
(4, '2018_07_16_095252_role', 1),
(5, '2018_08_15_102936_modules', 1),
(6, '2018_08_16_083353_users', 1),
(7, '2018_08_16_101045_permission', 1),
(8, '2018_08_19_050000_fixed_assets', 1),
(9, '2018_08_19_050957_materials', 1),
(10, '2018_08_19_083637_create_boxes_table', 1),
(11, '2018_08_19_083854_create_crops_table', 1),
(12, '2018_08_19_083909_create_crop_box_table', 1),
(13, '2018_08_19_084401_create_user_box_table', 1),
(14, '2018_08_26_142626_create_equipments_table', 1),
(15, '2018_08_26_193055_create_equipment_matrial_table', 1),
(16, '2018_08_27_130638_create_wells_table', 1),
(17, '2018_08_30_071442_create_well_tec_specifications_table', 1),
(18, '2018_08_30_075528_creat_config_table', 1),
(19, '2018_08_31_055520_create_moduels_details_table', 1),
(20, '2018_08_31_065953_create_moduels_type_table', 1),
(21, '2018_08_31_073547_create_moduels_test_table', 1),
(22, '2018_08_31_082341_create_role_permission_table', 1),
(23, '2018_09_01_111227_create_well_statistics_water_table', 1),
(24, '2018_09_01_135438_create_box_soil_analysis_table', 1),
(25, '2018_09_01_151624_create_intersection_table', 1),
(26, '2018_09_01_181830_create_operation_resources_table', 1),
(27, '2018_09_01_181905_create_notes_table', 1),
(28, '2018_09_01_181943_create_recommendations_table', 1),
(29, '2018_09_02_085309_create_seasons_table', 1),
(30, '2018_09_02_095017_create_jura_table', 1),
(31, '2018_09_03_115804_create_planting_table', 1),
(32, '2018_09_03_115853_create_plam_tree_table', 1),
(33, '2018_09_03_153616_create_crew_table', 1),
(34, '2018_09_04_075404_create_box_irrigation_table', 1),
(35, '2018_09_04_084557_create_cleaning_table', 1),
(36, '2018_09_04_144710_create_planning_irrigation_table', 1),
(37, '2018_09_05_065747_create_protection_table', 1),
(38, '2018_09_05_070630_create_nutria_table', 1),
(39, '2018_09_05_072410_create_harvest_table', 1),
(40, '2018_09_05_072844_create_sustainable_operation_table', 1),
(41, '2018_09_05_081333_create_fertilizing_table', 1),
(42, '2018_09_05_100516_create_user_notes_table', 1),
(43, '2018_09_10_114446_create_diseases_table', 1),
(44, '2018_09_10_122157_create_disease_palm_tree_table', 1),
(45, '2018_09_17_091702_create_separation_table', 1),
(46, '2018_09_18_095658_create_experiments_table', 1),
(47, '2018_09_18_104631_create_user_experiments_table', 1),
(48, '2018_09_18_110225_create_experiment_execute_steps_table', 1),
(49, '2018_09_20_082907_create_disease_control_plan_table', 1),
(50, '2018_09_24_092134_create_tasks_table', 1),
(51, '2018_09_25_120026_disease_follow', 1),
(52, '2018_09_25_131546_disease_combact_plan', 1),
(53, '2018_09_27_103610_create-fault-table', 1),
(54, '2018_10_01_082941_create_store_request_table', 1),
(55, '2018_10_04_095532_create_noti_table', 1),
(56, '2018_10_18_114138_create_disease_plan_materials_table', 1),
(57, '2018_10_28_143148_create_jura_materials_table', 1),
(58, '2018_12_12_134429_create_farms_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `moduels_details`
--

CREATE TABLE `moduels_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `moduel_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `moduels_details`
--

INSERT INTO `moduels_details` (`id`, `name`, `value`, `post_id`, `moduel_id`, `created_at`, `updated_at`) VALUES
(11, 'drilling_start_date', '2019-01-01', 1, 14, NULL, NULL),
(12, 'drilling_end_date', '2019-01-31', 1, 14, NULL, NULL),
(13, 'replacement_start_date', '2019-01-04', 1, 14, NULL, NULL),
(14, 'replacement_end_date', '2019-01-31', 1, 14, NULL, NULL),
(15, 'service_start_date', '2019-01-01', 1, 14, NULL, NULL),
(16, 'service_end_date', '2019-01-28', 1, 14, NULL, NULL),
(17, 'service_way', 'wee', 1, 14, NULL, NULL),
(18, 'landfill_start_date', '2019-01-01', 1, 14, NULL, NULL),
(19, 'landfill_end_date', '2019-01-26', 1, 14, NULL, NULL),
(20, 'clean_start_date', '2019-01-02', 1, 14, NULL, NULL),
(21, 'clean_end_date', '2019-01-15', 1, 14, NULL, NULL),
(22, 'clean_water_qyt', '23', 1, 14, NULL, NULL),
(23, 'clean_repet', '23', 1, 14, NULL, NULL),
(24, 'clean_duration', '2', 1, 14, NULL, NULL),
(25, 'planting_num_palm_trees', '23', 1, 15, NULL, NULL),
(26, 'irrigation_location', '234234', 1, 15, NULL, NULL),
(27, 'irrigation_implementation', '1', 1, 15, NULL, NULL),
(28, 'irrigation_num_palm_trees', '3', 1, 15, NULL, NULL),
(29, 'irrigation_start_date', '2019-01-08', 1, 15, NULL, NULL),
(30, 'irrigation_end_date', '2019-01-03', 1, 15, NULL, NULL),
(31, 'protection_pesticide', '1', 1, 15, NULL, NULL),
(32, 'protection_start_date', '2019-01-01', 1, 15, NULL, NULL),
(33, 'protection_end_date', '2019-01-29', 1, 15, NULL, NULL),
(34, 'protection_palm_qyt', '23', 1, 15, NULL, NULL),
(35, 'protection_total_amount', '23', 1, 15, NULL, NULL),
(36, 'protection_implementation', 'on', 1, 15, NULL, NULL),
(37, 'protection_how_to_use', '2344werwe', 1, 15, NULL, NULL),
(38, 'fertilization_start_date', '2019-01-16', 1, 15, NULL, NULL),
(39, 'fertilization_end_date', '2019-01-10', 1, 15, NULL, NULL),
(40, 'fertilization_row', '34', 1, 15, NULL, NULL),
(41, 'fertilization_column', '43', 1, 15, NULL, NULL),
(42, 'fertilization_fertilizer', '3', 1, 15, NULL, NULL),
(43, 'fertilization_palm_qyt', '34', 1, 15, NULL, NULL),
(44, 'fertilization_implementation', '1', 1, 15, NULL, NULL),
(45, 'fertilization_how_to_use', 'ertert', 1, 15, NULL, NULL),
(53, 'date_of_purchase', '2019-08-13', 1, 4, NULL, NULL),
(54, 'power', 'xxxxx', 1, 4, NULL, NULL),
(55, 'consumption_rate', '100', 1, 4, NULL, NULL),
(56, 'production_rate', '6565', 1, 4, NULL, NULL),
(57, 'depreciation_rate', '1000', 1, 4, NULL, NULL),
(58, 'model', 'xxxz', 1, 4, NULL, NULL),
(59, 'note', 'scz', 1, 4, NULL, NULL),
(60, 'depth', '34', 1, 8, NULL, NULL),
(61, 'well_radius', NULL, 1, 8, NULL, NULL),
(62, 'cost', '23221', 1, 8, NULL, NULL),
(63, 'minimum_water_quantity', '343', 1, 8, NULL, NULL),
(64, 'geological_profile_date', NULL, 1, 8, NULL, NULL),
(65, 'note', 'ملاحظه بير1', 1, 8, NULL, NULL),
(90, 'date_of_purchase', '2019-06-01', 2, 4, NULL, NULL),
(91, 'power', '1989', 2, 4, NULL, NULL),
(92, 'consumption_rate', '200', 2, 4, NULL, NULL),
(93, 'production_rate', '100', 2, 4, NULL, NULL),
(94, 'depreciation_rate', '200000', 2, 4, NULL, NULL),
(95, 'model', 'M276786', 2, 4, NULL, NULL),
(96, 'note', NULL, 2, 4, NULL, NULL),
(97, 'date_of_purchase', '2019-03-20', 3, 4, NULL, NULL),
(98, 'power', '1989', 3, 4, NULL, NULL),
(99, 'consumption_rate', '455', 3, 4, NULL, NULL),
(100, 'production_rate', '5757', 3, 4, NULL, NULL),
(101, 'depreciation_rate', '786776', 3, 4, NULL, NULL),
(102, 'model', 'M276786', 3, 4, NULL, NULL),
(103, 'note', NULL, 3, 4, NULL, NULL),
(104, 'depth', '200', 2, 8, NULL, NULL),
(105, 'well_radius', NULL, 2, 8, NULL, NULL),
(106, 'cost', '10000', 2, 8, NULL, NULL),
(107, 'minimum_water_quantity', '100', 2, 8, NULL, NULL),
(108, 'geological_profile_date', NULL, 2, 8, NULL, NULL),
(109, 'note', 'k\'\r\nl\'lllllllllllllll\'ll\'l\'l\'', 2, 8, NULL, NULL),
(110, 'depth', '22', 3, 8, NULL, NULL),
(111, 'well_radius', '121', 3, 8, NULL, NULL),
(112, 'cost', '121212', 3, 8, NULL, NULL),
(113, 'minimum_water_quantity', '1212', 3, 8, NULL, NULL),
(114, 'geological_profile_date', '2019-09-08', 3, 8, NULL, NULL),
(115, 'water_quantity_num', '120', 3, 8, NULL, NULL),
(116, 'water_quantity_term', '1', 3, 8, NULL, NULL),
(117, 'note', 'test', 3, 8, NULL, NULL),
(118, 'recommendation', 'test2', 3, 8, NULL, NULL),
(164, 'depth', '22', 6, 8, NULL, NULL),
(165, 'well_radius', '34', 6, 8, NULL, NULL),
(166, 'cost', '121212', 6, 8, NULL, NULL),
(167, 'minimum_water_quantity', '1212', 6, 8, NULL, NULL),
(168, 'geological_profile_date', '2019-09-23', 6, 8, NULL, NULL),
(169, 'note', 'ssdsdsd', 6, 8, NULL, NULL),
(170, 'depth', '234', 5, 8, NULL, NULL),
(171, 'well_radius', '34', 5, 8, NULL, NULL),
(172, 'cost', '34342', 5, 8, NULL, NULL),
(173, 'minimum_water_quantity', '1212', 5, 8, NULL, NULL),
(174, 'geological_profile_date', '2019-09-22', 5, 8, NULL, NULL),
(175, 'note', 'EWREWRE', 5, 8, NULL, NULL),
(190, 'date_of_purchase', '2019-09-29', 4, 4, NULL, NULL),
(191, 'power', 'xxxxx', 4, 4, NULL, NULL),
(192, 'consumption_rate', '123', 4, 4, NULL, NULL),
(193, 'production_rate', '456', 4, 4, NULL, NULL),
(194, 'depreciation_rate', '555', 4, 4, NULL, NULL),
(195, 'model', 'xxxz', 4, 4, NULL, NULL),
(196, 'note', 'test203', 4, 4, NULL, NULL),
(203, 'depth', '22', 7, 8, NULL, NULL),
(204, 'well_radius', '121', 7, 8, NULL, NULL),
(205, 'cost', '121212', 7, 8, NULL, NULL),
(206, 'minimum_water_quantity', '1212', 7, 8, NULL, NULL),
(207, 'geological_profile_date', '2019-10-01', 7, 8, NULL, NULL),
(208, 'water_quantity_num', '120', 7, 8, NULL, NULL),
(209, 'water_quantity_term', '2', 7, 8, NULL, NULL),
(210, 'note', 'TEST', 7, 8, NULL, NULL),
(211, 'recommendation', 'TEST2', 7, 8, NULL, NULL),
(212, 'depth', 'kkkkkkk', 4, 8, NULL, NULL),
(213, 'well_radius', NULL, 4, 8, NULL, NULL),
(214, 'cost', 'lkjjjjjjjjjjjkj', 4, 8, NULL, NULL),
(215, 'minimum_water_quantity', 'l;dgdsgdhkl;g', 4, 8, NULL, NULL),
(216, 'geological_profile_date', '2019-09-05', 4, 8, NULL, NULL),
(217, 'note', 'j;jl;j;ljl;', 4, 8, NULL, NULL),
(382, 'drilling_start_date', '2019-05-01', 2, 14, NULL, NULL),
(383, 'drilling_end_date', '2019-09-01', 2, 14, NULL, NULL),
(384, 'replacement_start_date', '2019-10-01', 2, 14, NULL, NULL),
(385, 'replacement_end_date', '2019-11-01', 2, 14, NULL, NULL),
(386, 'service_start_date', '2019-12-01', 2, 14, NULL, NULL),
(387, 'service_end_date', '2019-01-07', 2, 14, NULL, NULL),
(388, 'service_way', 'يصسسصي', 2, 14, NULL, NULL),
(389, 'landfill_start_date', '2019-02-18', 2, 14, NULL, NULL),
(390, 'landfill_end_date', '2019-03-01', 2, 14, NULL, NULL),
(391, 'clean_start_date', '2019-01-01', 2, 14, NULL, NULL),
(392, 'clean_end_date', '2019-02-01', 2, 14, NULL, NULL),
(393, 'clean_water_qyt', '1200', 2, 14, NULL, NULL),
(394, 'clean_repet', '10', 2, 14, NULL, NULL),
(395, 'clean_duration', '3', 2, 14, NULL, NULL),
(396, 'cleansing_start_date', NULL, 2, 14, NULL, NULL),
(397, 'cleansing_end_date', NULL, 2, 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `moduels_test`
--

CREATE TABLE `moduels_test` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `moduel_id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `test_num` int(11) DEFAULT NULL,
  `test_duration` int(11) DEFAULT NULL,
  `extension` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `moduels_test`
--

INSERT INTO `moduels_test` (`id`, `title`, `post_id`, `moduel_id`, `code`, `test_num`, `test_duration`, `extension`, `datetime`, `file`, `created_at`, `updated_at`) VALUES
(1, 'test bbbbflll', 1, 12, 1000, 7, 2, 102, '2019-08-28 00:00:00', NULL, '2019-08-22 09:55:39', '2019-08-22 09:55:39'),
(2, 'trestsgn', 1, 8, 1001, 6, 3, 46, '2019-08-13 00:00:00', NULL, '2019-08-22 09:58:26', '2019-08-22 09:58:26'),
(3, 'صيانة كمية المياه و تحليل المياه', 6, 8, 1002, 2, 1, 10, '2019-09-25 00:00:00', NULL, '2019-09-25 12:50:46', '2019-09-25 12:50:46'),
(4, 'test3', 4, 4, 1003, 12, 43, NULL, '2019-09-29 00:00:00', NULL, '2019-09-29 13:28:33', '2019-09-29 13:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `moduels_type`
--

CREATE TABLE `moduels_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moduel_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `moduels_type`
--

INSERT INTO `moduels_type` (`id`, `code`, `title`, `moduel_id`, `created_at`, `updated_at`) VALUES
(1, 10, 'اساسيه', 7, NULL, NULL),
(2, 11, 'مساعده', 7, NULL, NULL),
(3, NULL, 'نقل', 4, '2019-01-16 13:02:15', '2019-01-16 13:02:15'),
(4, NULL, 'مطعم', 5, '2019-01-16 13:04:08', '2019-01-16 13:04:08'),
(5, NULL, 'cv', 5, '2019-01-23 19:48:42', '2019-01-23 19:48:42'),
(6, NULL, 'bian', 5, '2019-08-22 09:13:46', '2019-08-22 09:13:46'),
(9, NULL, 'نقل2', 4, '2019-08-25 10:04:29', '2019-08-25 10:04:29'),
(10, NULL, 'نقل3', 4, '2019-08-25 10:06:33', '2019-08-25 10:06:33'),
(11, NULL, 'مساعده2', 4, '2019-09-29 13:24:45', '2019-09-29 13:24:45'),
(12, NULL, 'sdsd', 5, '2019-10-14 09:09:18', '2019-10-14 09:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `controller` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `moduel_id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `from_id` int(10) UNSIGNED NOT NULL,
  `datetime` date DEFAULT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opertion` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `noti`
--

CREATE TABLE `noti` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `noti_type_id` int(11) NOT NULL,
  `url_redirect` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nutria`
--

CREATE TABLE `nutria` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `box_id` int(10) UNSIGNED NOT NULL,
  `palm_tree_QYT` int(11) DEFAULT NULL,
  `palm_tree_count` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nutria`
--

INSERT INTO `nutria` (`id`, `code`, `box_id`, `palm_tree_QYT`, `palm_tree_count`, `created_at`, `updated_at`) VALUES
(1, 1000, 1, 2, NULL, '2019-01-22 23:07:35', '2019-01-22 23:07:35');

-- --------------------------------------------------------

--
-- Table structure for table `operation_resources`
--

CREATE TABLE `operation_resources` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `moduel_id` int(10) UNSIGNED NOT NULL,
  `opertion_type_id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `equipment_id` int(10) UNSIGNED DEFAULT NULL,
  `matrial_id` int(10) UNSIGNED DEFAULT NULL,
  `box_id` int(10) UNSIGNED DEFAULT NULL,
  `datetime` date DEFAULT NULL,
  `datetime_end` date DEFAULT NULL,
  `qyt` int(11) DEFAULT NULL,
  `sent_qyt` int(11) DEFAULT NULL,
  `rest_qyt` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `expected_cost` int(11) DEFAULT NULL,
  `working_number_days` int(11) DEFAULT NULL,
  `working_number_hours_per_day` int(11) DEFAULT NULL,
  `workers_count` int(11) DEFAULT NULL,
  `hours_used` int(11) DEFAULT NULL,
  `workers_type_id` int(11) DEFAULT NULL,
  `store_done` int(11) NOT NULL DEFAULT 0,
  `palm_tree` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `operation_resources`
--

INSERT INTO `operation_resources` (`id`, `post_id`, `moduel_id`, `opertion_type_id`, `code`, `title`, `equipment_id`, `matrial_id`, `box_id`, `datetime`, `datetime_end`, `qyt`, `sent_qyt`, `rest_qyt`, `cost`, `expected_cost`, `working_number_days`, `working_number_hours_per_day`, `workers_count`, `hours_used`, `workers_type_id`, `store_done`, `palm_tree`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, 1000, 'نكاليف أساسيه', NULL, 2, 1, '2019-01-28', NULL, 34, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-01-28 22:38:37', '2019-01-28 22:38:37'),
(2, 1, 4, 4, 1001, 'خامه أساسيه', NULL, 2, 1, '2019-01-28', NULL, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-01-28 22:38:37', '2019-01-28 22:38:37'),
(3, 1, 5, 1, 1002, 'نكاليف أساسيه', NULL, 1, 1, '2019-01-28', NULL, 23, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-01-28 22:39:56', '2019-01-28 22:39:56'),
(4, 1, 5, 4, 1003, 'خامه أساسيه', NULL, 1, 1, '2019-01-28', NULL, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-01-28 22:39:56', '2019-01-28 22:39:56'),
(5, 1, 11, 1, 1004, 'test', NULL, NULL, NULL, '2019-01-15', NULL, NULL, NULL, NULL, 23, 23, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-01-29 17:49:52', '2019-01-29 17:49:52'),
(6, 1, 3, 1, 1005, 'bian', NULL, NULL, 1, '2019-08-29', NULL, NULL, NULL, NULL, 225, 120, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-08-22 10:09:54', '2019-08-22 10:09:54'),
(7, 1, 3, 2, 1006, NULL, NULL, NULL, 1, '2019-08-22', '2019-08-31', NULL, NULL, NULL, 6850, NULL, 5, 12, 100, NULL, 2, 0, NULL, '2019-08-22 10:12:51', '2019-08-22 10:12:51'),
(8, 1, 3, 3, 1007, NULL, 1, NULL, NULL, '2019-08-22', '2019-08-28', 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, 0, NULL, '2019-08-22 10:14:09', '2019-08-22 10:14:09'),
(9, 1, 3, 4, 1008, 'bian', NULL, 3, NULL, '2019-08-22', NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-08-22 10:15:07', '2019-08-22 10:15:07'),
(10, 1, 29, 1, 1009, 'sss', NULL, NULL, NULL, '2019-08-29', NULL, NULL, NULL, NULL, 13, 23, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-08-22 10:55:20', '2019-08-22 10:55:20'),
(11, 3, 3, 1, 1010, 'fdfdg', NULL, NULL, 10, '2019-09-17', NULL, NULL, NULL, NULL, 232444, 1323, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-09-17 12:15:41', '2019-09-17 12:15:41'),
(12, 3, 3, 2, 1011, NULL, NULL, NULL, 10, '2019-09-17', '2019-09-23', NULL, NULL, NULL, 2424, NULL, 23243, 3242, 324, NULL, 1, 0, NULL, '2019-09-17 12:16:14', '2019-09-17 12:16:14'),
(13, 3, 3, 3, 1012, NULL, 1, NULL, NULL, '2019-09-17', '2019-09-30', 24546, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 234, NULL, 0, NULL, '2019-09-17 12:18:11', '2019-09-17 12:18:11'),
(14, 3, 3, 3, 1013, NULL, 2, NULL, NULL, '2019-09-17', '2019-09-30', 2323, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, 0, NULL, '2019-09-17 12:18:34', '2019-09-17 12:18:34'),
(15, 3, 3, 4, 1014, 'ff', NULL, 3, NULL, '2019-09-17', NULL, 2323, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-09-17 12:19:00', '2019-09-17 12:19:00'),
(16, 5, 10, 1, 1015, 'fdfdfd', NULL, NULL, NULL, '2019-09-23', NULL, NULL, NULL, NULL, 34232324, 32434, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-09-23 10:39:19', '2019-09-23 10:39:19'),
(17, 5, 10, 4, 1016, 'cfdfdf', NULL, 3, NULL, '2019-09-23', NULL, 3434, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-09-23 10:39:38', '2019-09-23 10:39:38'),
(19, 2, 1, 1, 1017, 'التللاتبا', NULL, NULL, 1, '2019-10-15', NULL, NULL, NULL, NULL, 2000, 1000, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-10-15 13:07:48', '2019-10-15 13:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'إضافه', NULL, NULL),
(2, 'تعديل', NULL, NULL),
(3, 'مشاهده', NULL, NULL),
(4, 'دخول', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plam_tree`
--

CREATE TABLE `plam_tree` (
  `id` int(10) UNSIGNED NOT NULL,
  `crop_id` int(10) UNSIGNED NOT NULL,
  `box_id` int(10) UNSIGNED NOT NULL,
  `planting_id` int(10) UNSIGNED NOT NULL,
  `row` int(11) NOT NULL,
  `column` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `planning_irrigation`
--

CREATE TABLE `planning_irrigation` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `irrigation_id` int(10) UNSIGNED DEFAULT NULL,
  `planting_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `qyt` int(11) DEFAULT NULL,
  `repeat` int(11) DEFAULT NULL,
  `irrigation_date` date DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `planning_irrigation`
--

INSERT INTO `planning_irrigation` (`id`, `code`, `irrigation_id`, `planting_id`, `start_date`, `end_date`, `qyt`, `repeat`, `irrigation_date`, `note`, `created_at`, `updated_at`) VALUES
(1, 1000, NULL, 3, '2019-09-17', '2019-09-24', 23, 23, '2019-09-17', 'ff', '2019-09-17 12:10:47', '2019-09-17 12:10:47'),
(2, 1001, NULL, 3, '2019-09-23', '2019-09-24', 23, 2345, '2019-09-15', 'eee', '2019-09-17 12:15:18', '2019-09-17 12:15:18');

-- --------------------------------------------------------

--
-- Table structure for table `planting`
--

CREATE TABLE `planting` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `box_id` int(10) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `fertlize_crop_id` int(10) UNSIGNED NOT NULL,
  `protection_user_id` int(10) UNSIGNED NOT NULL,
  `irrigation_user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `protection`
--

CREATE TABLE `protection` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `box_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `Pesticide_QYT` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matrial_id` int(10) UNSIGNED DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `palm_tree` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `palm_tree_QYT` int(11) DEFAULT NULL,
  `used_type_id` int(11) DEFAULT NULL,
  `recommendation` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `implementation` int(11) NOT NULL DEFAULT 1,
  `level_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recommendations`
--

CREATE TABLE `recommendations` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `moduel_id` int(10) UNSIGNED NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` int(10) UNSIGNED DEFAULT NULL,
  `datetime` date DEFAULT NULL,
  `recommendation_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `moduel_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `season_start` date NOT NULL,
  `season_end` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`id`, `code`, `title`, `season_start`, `season_end`, `created_at`, `updated_at`) VALUES
(1, 1000, 'test', '2019-01-01', '2019-01-30', '2019-01-29 20:53:21', '2019-01-29 20:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `separation`
--

CREATE TABLE `separation` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `box_id` int(10) UNSIGNED NOT NULL,
  `crop_id` int(10) UNSIGNED NOT NULL,
  `plam_tree` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crops_in_box` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `market_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `number_of_separation` int(11) DEFAULT NULL,
  `case` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `crop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_request`
--

CREATE TABLE `store_request` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `code` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `qyt` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordered_from` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` date DEFAULT NULL,
  `order_date_required` date DEFAULT NULL,
  `order_date_actaual` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_request`
--

INSERT INTO `store_request` (`id`, `user_id`, `code`, `type_id`, `status_id`, `qyt`, `cost`, `title`, `ordered_from`, `order_date`, `order_date_required`, `order_date_actaual`, `created_at`, `updated_at`) VALUES
(3, NULL, 1002, 3, 1, 2332, 233, 'شيماء', 'يثثبصيب', NULL, NULL, NULL, '2019-10-15 13:59:45', '2019-10-15 13:59:45');

-- --------------------------------------------------------

--
-- Table structure for table `sustainable_operation`
--

CREATE TABLE `sustainable_operation` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `box_id` int(10) UNSIGNED NOT NULL,
  `operation_type_id` int(11) DEFAULT NULL,
  `used_type_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `recommendation` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `box_id` int(10) UNSIGNED NOT NULL,
  `from_id` int(10) UNSIGNED NOT NULL,
  `to_id` int(10) UNSIGNED NOT NULL,
  `seen` int(11) NOT NULL,
  `task_type_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `task` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `implementation_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `type_id` int(11) NOT NULL DEFAULT 1,
  `blocked` int(11) DEFAULT 0,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hiring_date` date DEFAULT NULL,
  `permission_login` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_box`
--

CREATE TABLE `user_box` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `box_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_experiments`
--

CREATE TABLE `user_experiments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `experiment_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_notes`
--

CREATE TABLE `user_notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `added_from` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `job` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `process` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wells`
--

CREATE TABLE `wells` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `signed` int(11) NOT NULL DEFAULT 0,
  `signed_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_excavation` datetime NOT NULL,
  `water_quantity_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `water_analysis_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `geological_profile_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wells`
--

INSERT INTO `wells` (`id`, `code`, `location`, `title`, `status`, `signed`, `signed_file`, `date_of_excavation`, `water_quantity_file`, `water_analysis_file`, `geological_profile_file`, `created_at`, `updated_at`) VALUES
(1, '10', '3|4,34,55,34|33,12,33,14', 'بير1', 2, 0, NULL, '2019-01-24 00:00:00', NULL, NULL, 'Multi-sided ecommerce website BRD (1).pdf', '2019-01-16 09:00:17', '2019-08-22 09:31:56'),
(2, '11', '1213|1,2,1,4|1,5,3,2', 'شيماء', 2, 0, NULL, '2019-03-01 00:00:00', NULL, NULL, NULL, '2019-08-25 09:55:39', '2019-09-03 11:12:55'),
(3, '12', '1|45,45,55,66|34,23,55,66', 'bianbahaa', 2, 0, NULL, '2019-09-03 00:00:00', NULL, NULL, NULL, '2019-09-15 05:40:50', '2019-09-15 05:40:50'),
(4, '13', 'jjjjjj|,,,|,,,', 'kjjkjkljkljkl', 2, 0, NULL, '2019-09-18 00:00:00', NULL, 'chrome_proxy.exe', NULL, '2019-09-19 07:22:07', '2019-10-01 09:08:59'),
(5, '14', '1|45,45,55,66|34,45,55,66', 'BIAN', 1, 1, NULL, '2019-09-22 00:00:00', NULL, NULL, NULL, '2019-09-22 09:00:15', '2019-09-23 10:55:08'),
(6, '15', '1|45,45,55,66|34,45,55,66', 'bianxuyjh', 1, 1, NULL, '2019-09-23 00:00:00', NULL, NULL, NULL, '2019-09-23 09:22:34', '2019-09-23 10:53:09'),
(7, '16', '1|45,45,55,66|34,45,55,66', 'bian', 1, 0, NULL, '2019-10-01 00:00:00', NULL, NULL, NULL, '2019-10-01 08:23:00', '2019-10-01 08:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `well_statistics_water`
--

CREATE TABLE `well_statistics_water` (
  `id` int(10) UNSIGNED NOT NULL,
  `well_id` int(10) UNSIGNED NOT NULL,
  `datetime` date DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qyt` int(11) DEFAULT NULL,
  `statistics_type` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `well_statistics_water`
--

INSERT INTO `well_statistics_water` (`id`, `well_id`, `datetime`, `file`, `qyt`, `statistics_type`, `created_at`, `updated_at`) VALUES
(1, 2, '2019-08-27', NULL, 1000, 1, '2019-08-27 08:22:04', '2019-08-27 08:22:04'),
(2, 5, '2019-09-23', NULL, 2324, 1, '2019-09-23 10:36:33', '2019-09-23 10:36:33'),
(3, 6, NULL, NULL, 5000, 1, '2019-09-25 12:49:10', '2019-09-25 12:49:10');

-- --------------------------------------------------------

--
-- Table structure for table `well_tec_specifications`
--

CREATE TABLE `well_tec_specifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `well_id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `length` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ability` int(11) DEFAULT NULL,
  `diameter` int(11) DEFAULT NULL,
  `tec_type` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `well_tec_specifications`
--

INSERT INTO `well_tec_specifications` (`id`, `well_id`, `code`, `length`, `type`, `desc`, `ability`, `diameter`, `tec_type`, `created_at`, `updated_at`) VALUES
(1, 1, 1000, NULL, 1, '15.6', 10, NULL, 3, '2019-08-22 09:54:10', '2019-08-22 09:54:10'),
(2, 1, 1001, NULL, 2, '96.5', 16, NULL, 4, '2019-08-22 09:56:36', '2019-08-22 09:56:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boxes`
--
ALTER TABLE `boxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `box_irrigation`
--
ALTER TABLE `box_irrigation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `box_irrigation_irrigation_id_foreign` (`irrigation_id`),
  ADD KEY `box_irrigation_box_id_foreign` (`box_id`);

--
-- Indexes for table `box_soil_analysis`
--
ALTER TABLE `box_soil_analysis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `box_soil_analysis_box_id_foreign` (`box_id`);

--
-- Indexes for table `cleaning`
--
ALTER TABLE `cleaning`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cleaning_code_unique` (`code`),
  ADD KEY `cleaning_box_id_foreign` (`box_id`),
  ADD KEY `cleaning_user_id_foreign` (`user_id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crew`
--
ALTER TABLE `crew`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crew_user_id_foreign` (`user_id`),
  ADD KEY `crew_crew_id_foreign` (`crew_id`);

--
-- Indexes for table `crops`
--
ALTER TABLE `crops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crops_crop_id_foreign` (`crop_id`);

--
-- Indexes for table `crop_box`
--
ALTER TABLE `crop_box`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crop_box_crop_id_foreign` (`crop_id`),
  ADD KEY `crop_box_box_id_foreign` (`box_id`);

--
-- Indexes for table `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disease_combact_plan`
--
ALTER TABLE `disease_combact_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disease_combact_plan_disease_id_foreign` (`disease_id`);

--
-- Indexes for table `disease_control_plan`
--
ALTER TABLE `disease_control_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disease_control_plan_disease_id_foreign` (`disease_id`);

--
-- Indexes for table `disease_follow`
--
ALTER TABLE `disease_follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disease_palm_tree`
--
ALTER TABLE `disease_palm_tree`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disease_palm_tree_disease_id_foreign` (`disease_id`),
  ADD KEY `disease_palm_tree_box_id_foreign` (`box_id`),
  ADD KEY `disease_palm_tree_user_id_foreign` (`user_id`);

--
-- Indexes for table `disease_plan_materials`
--
ALTER TABLE `disease_plan_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disease_plan_materials_disease_combact_plan_id_foreign` (`disease_combact_plan_id`),
  ADD KEY `disease_plan_materials_pesticide_foreign` (`pesticide`);

--
-- Indexes for table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `equipments_code_unique` (`code`);

--
-- Indexes for table `equipment_matrial`
--
ALTER TABLE `equipment_matrial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_matrial_equipment_id_foreign` (`equipment_id`),
  ADD KEY `equipment_matrial_matrial_id_foreign` (`matrial_id`);

--
-- Indexes for table `experiments`
--
ALTER TABLE `experiments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experiments_box_id_foreign` (`box_id`);

--
-- Indexes for table `experiment_execute_steps`
--
ALTER TABLE `experiment_execute_steps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experiment_execute_steps_experiment_id_foreign` (`experiment_id`);

--
-- Indexes for table `farms`
--
ALTER TABLE `farms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faults`
--
ALTER TABLE `faults`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fertilizing`
--
ALTER TABLE `fertilizing`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fertilizing_code_unique` (`code`),
  ADD KEY `fertilizing_box_id_foreign` (`box_id`),
  ADD KEY `fertilizing_matrial_id_foreign` (`matrial_id`);

--
-- Indexes for table `fixedassets`
--
ALTER TABLE `fixedassets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `harvest`
--
ALTER TABLE `harvest`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `harvest_code_unique` (`code`),
  ADD KEY `harvest_box_id_foreign` (`box_id`),
  ADD KEY `harvest_crop_id_foreign` (`crop_id`);

--
-- Indexes for table `intersection`
--
ALTER TABLE `intersection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `intersection_irrigation_id_foreign` (`irrigation_id`);

--
-- Indexes for table `irrigation`
--
ALTER TABLE `irrigation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `irrigation_mahbas`
--
ALTER TABLE `irrigation_mahbas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `irrigation_mahbas_irrigation_id_foreign` (`irrigation_id`);

--
-- Indexes for table `jura`
--
ALTER TABLE `jura`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jura_code_unique` (`code`),
  ADD KEY `jura_box_id_foreign` (`box_id`);

--
-- Indexes for table `jura_materials`
--
ALTER TABLE `jura_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jura_materials_material_id_foreign` (`material_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materials_material_unit_id_foreign` (`material_unit_id`);

--
-- Indexes for table `material_units`
--
ALTER TABLE `material_units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `material_units_title_unique` (`title`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moduels_details`
--
ALTER TABLE `moduels_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moduels_test`
--
ALTER TABLE `moduels_test`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `moduels_test_code_unique` (`code`);

--
-- Indexes for table `moduels_type`
--
ALTER TABLE `moduels_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modules_controller_unique` (`controller`),
  ADD KEY `modules_module_id_foreign` (`module_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `notes_code_unique` (`code`),
  ADD KEY `notes_from_id_foreign` (`from_id`);

--
-- Indexes for table `noti`
--
ALTER TABLE `noti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noti_user_id_foreign` (`user_id`);

--
-- Indexes for table `nutria`
--
ALTER TABLE `nutria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nutria_code_unique` (`code`),
  ADD KEY `nutria_box_id_foreign` (`box_id`);

--
-- Indexes for table `operation_resources`
--
ALTER TABLE `operation_resources`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `operation_resources_code_unique` (`code`),
  ADD KEY `operation_resources_equipment_id_foreign` (`equipment_id`),
  ADD KEY `operation_resources_matrial_id_foreign` (`matrial_id`),
  ADD KEY `operation_resources_box_id_foreign` (`box_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plam_tree`
--
ALTER TABLE `plam_tree`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plam_tree_crop_id_foreign` (`crop_id`),
  ADD KEY `plam_tree_box_id_foreign` (`box_id`),
  ADD KEY `plam_tree_planting_id_foreign` (`planting_id`);

--
-- Indexes for table `planning_irrigation`
--
ALTER TABLE `planning_irrigation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planning_irrigation_irrigation_id_foreign` (`irrigation_id`);

--
-- Indexes for table `planting`
--
ALTER TABLE `planting`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `planting_code_unique` (`code`),
  ADD KEY `planting_box_id_foreign` (`box_id`),
  ADD KEY `planting_fertlize_crop_id_foreign` (`fertlize_crop_id`),
  ADD KEY `planting_protection_user_id_foreign` (`protection_user_id`),
  ADD KEY `planting_irrigation_user_id_foreign` (`irrigation_user_id`);

--
-- Indexes for table `protection`
--
ALTER TABLE `protection`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `protection_code_unique` (`code`),
  ADD KEY `protection_box_id_foreign` (`box_id`),
  ADD KEY `protection_user_id_foreign` (`user_id`),
  ADD KEY `protection_matrial_id_foreign` (`matrial_id`);

--
-- Indexes for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recommendations_from_id_foreign` (`from_id`),
  ADD KEY `recommendations_recommendation_id_foreign` (`recommendation_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_code_unique` (`code`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permission_role_id_foreign` (`role_id`);

--
-- Indexes for table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `separation`
--
ALTER TABLE `separation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `separation_code_unique` (`code`),
  ADD KEY `separation_box_id_foreign` (`box_id`),
  ADD KEY `separation_crop_id_foreign` (`crop_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_request`
--
ALTER TABLE `store_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_request_user_id_foreign` (`user_id`);

--
-- Indexes for table `sustainable_operation`
--
ALTER TABLE `sustainable_operation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sustainable_operation_code_unique` (`code`),
  ADD KEY `sustainable_operation_box_id_foreign` (`box_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_box_id_foreign` (`box_id`),
  ADD KEY `tasks_from_id_foreign` (`from_id`),
  ADD KEY `tasks_to_id_foreign` (`to_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_box`
--
ALTER TABLE `user_box`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_box_user_id_foreign` (`user_id`),
  ADD KEY `user_box_box_id_foreign` (`box_id`);

--
-- Indexes for table `user_experiments`
--
ALTER TABLE `user_experiments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_experiments_user_id_foreign` (`user_id`),
  ADD KEY `user_experiments_experiment_id_foreign` (`experiment_id`);

--
-- Indexes for table `user_notes`
--
ALTER TABLE `user_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_notes_user_id_foreign` (`user_id`);

--
-- Indexes for table `wells`
--
ALTER TABLE `wells`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wells_code_unique` (`code`);

--
-- Indexes for table `well_statistics_water`
--
ALTER TABLE `well_statistics_water`
  ADD PRIMARY KEY (`id`),
  ADD KEY `well_statistics_water_well_id_foreign` (`well_id`);

--
-- Indexes for table `well_tec_specifications`
--
ALTER TABLE `well_tec_specifications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `well_tec_specifications_code_unique` (`code`),
  ADD KEY `well_tec_specifications_well_id_foreign` (`well_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boxes`
--
ALTER TABLE `boxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `box_irrigation`
--
ALTER TABLE `box_irrigation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `box_soil_analysis`
--
ALTER TABLE `box_soil_analysis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cleaning`
--
ALTER TABLE `cleaning`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `crew`
--
ALTER TABLE `crew`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `crops`
--
ALTER TABLE `crops`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `crop_box`
--
ALTER TABLE `crop_box`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `diseases`
--
ALTER TABLE `diseases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `disease_combact_plan`
--
ALTER TABLE `disease_combact_plan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disease_control_plan`
--
ALTER TABLE `disease_control_plan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disease_follow`
--
ALTER TABLE `disease_follow`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `disease_palm_tree`
--
ALTER TABLE `disease_palm_tree`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `disease_plan_materials`
--
ALTER TABLE `disease_plan_materials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `equipment_matrial`
--
ALTER TABLE `equipment_matrial`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `experiments`
--
ALTER TABLE `experiments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `experiment_execute_steps`
--
ALTER TABLE `experiment_execute_steps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `farms`
--
ALTER TABLE `farms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `faults`
--
ALTER TABLE `faults`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fertilizing`
--
ALTER TABLE `fertilizing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fixedassets`
--
ALTER TABLE `fixedassets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `harvest`
--
ALTER TABLE `harvest`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `intersection`
--
ALTER TABLE `intersection`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `irrigation`
--
ALTER TABLE `irrigation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `irrigation_mahbas`
--
ALTER TABLE `irrigation_mahbas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jura`
--
ALTER TABLE `jura`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jura_materials`
--
ALTER TABLE `jura_materials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `material_units`
--
ALTER TABLE `material_units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `moduels_details`
--
ALTER TABLE `moduels_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=398;

--
-- AUTO_INCREMENT for table `moduels_test`
--
ALTER TABLE `moduels_test`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `moduels_type`
--
ALTER TABLE `moduels_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `noti`
--
ALTER TABLE `noti`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `nutria`
--
ALTER TABLE `nutria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `operation_resources`
--
ALTER TABLE `operation_resources`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `plam_tree`
--
ALTER TABLE `plam_tree`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `planning_irrigation`
--
ALTER TABLE `planning_irrigation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `planting`
--
ALTER TABLE `planting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `protection`
--
ALTER TABLE `protection`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recommendations`
--
ALTER TABLE `recommendations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `separation`
--
ALTER TABLE `separation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_request`
--
ALTER TABLE `store_request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sustainable_operation`
--
ALTER TABLE `sustainable_operation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_box`
--
ALTER TABLE `user_box`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_experiments`
--
ALTER TABLE `user_experiments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_notes`
--
ALTER TABLE `user_notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wells`
--
ALTER TABLE `wells`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `well_statistics_water`
--
ALTER TABLE `well_statistics_water`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `well_tec_specifications`
--
ALTER TABLE `well_tec_specifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `box_irrigation`
--
ALTER TABLE `box_irrigation`
  ADD CONSTRAINT `box_irrigation_box_id_foreign` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `box_irrigation_irrigation_id_foreign` FOREIGN KEY (`irrigation_id`) REFERENCES `irrigation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `box_soil_analysis`
--
ALTER TABLE `box_soil_analysis`
  ADD CONSTRAINT `box_soil_analysis_box_id_foreign` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cleaning`
--
ALTER TABLE `cleaning`
  ADD CONSTRAINT `cleaning_box_id_foreign` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cleaning_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `crew`
--
ALTER TABLE `crew`
  ADD CONSTRAINT `crew_crew_id_foreign` FOREIGN KEY (`crew_id`) REFERENCES `crew` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `crew_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `crops`
--
ALTER TABLE `crops`
  ADD CONSTRAINT `crops_crop_id_foreign` FOREIGN KEY (`crop_id`) REFERENCES `crops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `crop_box`
--
ALTER TABLE `crop_box`
  ADD CONSTRAINT `crop_box_box_id_foreign` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `crop_box_crop_id_foreign` FOREIGN KEY (`crop_id`) REFERENCES `crops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `disease_combact_plan`
--
ALTER TABLE `disease_combact_plan`
  ADD CONSTRAINT `disease_combact_plan_disease_id_foreign` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `disease_control_plan`
--
ALTER TABLE `disease_control_plan`
  ADD CONSTRAINT `disease_control_plan_disease_id_foreign` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `disease_palm_tree`
--
ALTER TABLE `disease_palm_tree`
  ADD CONSTRAINT `disease_palm_tree_box_id_foreign` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disease_palm_tree_disease_id_foreign` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disease_palm_tree_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `disease_plan_materials`
--
ALTER TABLE `disease_plan_materials`
  ADD CONSTRAINT `disease_plan_materials_disease_combact_plan_id_foreign` FOREIGN KEY (`disease_combact_plan_id`) REFERENCES `disease_combact_plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disease_plan_materials_pesticide_foreign` FOREIGN KEY (`pesticide`) REFERENCES `materials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `equipment_matrial`
--
ALTER TABLE `equipment_matrial`
  ADD CONSTRAINT `equipment_matrial_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `equipments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipment_matrial_matrial_id_foreign` FOREIGN KEY (`matrial_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `experiments`
--
ALTER TABLE `experiments`
  ADD CONSTRAINT `experiments_box_id_foreign` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `experiment_execute_steps`
--
ALTER TABLE `experiment_execute_steps`
  ADD CONSTRAINT `experiment_execute_steps_experiment_id_foreign` FOREIGN KEY (`experiment_id`) REFERENCES `experiments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fertilizing`
--
ALTER TABLE `fertilizing`
  ADD CONSTRAINT `fertilizing_box_id_foreign` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fertilizing_matrial_id_foreign` FOREIGN KEY (`matrial_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `harvest`
--
ALTER TABLE `harvest`
  ADD CONSTRAINT `harvest_box_id_foreign` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `harvest_crop_id_foreign` FOREIGN KEY (`crop_id`) REFERENCES `crops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `intersection`
--
ALTER TABLE `intersection`
  ADD CONSTRAINT `intersection_irrigation_id_foreign` FOREIGN KEY (`irrigation_id`) REFERENCES `irrigation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `irrigation_mahbas`
--
ALTER TABLE `irrigation_mahbas`
  ADD CONSTRAINT `irrigation_mahbas_irrigation_id_foreign` FOREIGN KEY (`irrigation_id`) REFERENCES `irrigation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jura`
--
ALTER TABLE `jura`
  ADD CONSTRAINT `jura_box_id_foreign` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jura_materials`
--
ALTER TABLE `jura_materials`
  ADD CONSTRAINT `jura_materials_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_material_unit_id_foreign` FOREIGN KEY (`material_unit_id`) REFERENCES `material_units` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_from_id_foreign` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `noti`
--
ALTER TABLE `noti`
  ADD CONSTRAINT `noti_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nutria`
--
ALTER TABLE `nutria`
  ADD CONSTRAINT `nutria_box_id_foreign` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `operation_resources`
--
ALTER TABLE `operation_resources`
  ADD CONSTRAINT `operation_resources_box_id_foreign` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `operation_resources_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `equipments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `operation_resources_matrial_id_foreign` FOREIGN KEY (`matrial_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `plam_tree`
--
ALTER TABLE `plam_tree`
  ADD CONSTRAINT `plam_tree_box_id_foreign` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plam_tree_crop_id_foreign` FOREIGN KEY (`crop_id`) REFERENCES `crops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plam_tree_planting_id_foreign` FOREIGN KEY (`planting_id`) REFERENCES `planting` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `planning_irrigation`
--
ALTER TABLE `planning_irrigation`
  ADD CONSTRAINT `planning_irrigation_irrigation_id_foreign` FOREIGN KEY (`irrigation_id`) REFERENCES `irrigation_mahbas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `planting`
--
ALTER TABLE `planting`
  ADD CONSTRAINT `planting_box_id_foreign` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `planting_fertlize_crop_id_foreign` FOREIGN KEY (`fertlize_crop_id`) REFERENCES `crops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `planting_irrigation_user_id_foreign` FOREIGN KEY (`irrigation_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `planting_protection_user_id_foreign` FOREIGN KEY (`protection_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `protection`
--
ALTER TABLE `protection`
  ADD CONSTRAINT `protection_box_id_foreign` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `protection_matrial_id_foreign` FOREIGN KEY (`matrial_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `protection_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD CONSTRAINT `recommendations_from_id_foreign` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recommendations_recommendation_id_foreign` FOREIGN KEY (`recommendation_id`) REFERENCES `recommendations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `separation`
--
ALTER TABLE `separation`
  ADD CONSTRAINT `separation_box_id_foreign` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `separation_crop_id_foreign` FOREIGN KEY (`crop_id`) REFERENCES `crops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `store_request`
--
ALTER TABLE `store_request`
  ADD CONSTRAINT `store_request_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sustainable_operation`
--
ALTER TABLE `sustainable_operation`
  ADD CONSTRAINT `sustainable_operation_box_id_foreign` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_box_id_foreign` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_from_id_foreign` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_to_id_foreign` FOREIGN KEY (`to_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_box`
--
ALTER TABLE `user_box`
  ADD CONSTRAINT `user_box_box_id_foreign` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_box_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_experiments`
--
ALTER TABLE `user_experiments`
  ADD CONSTRAINT `user_experiments_experiment_id_foreign` FOREIGN KEY (`experiment_id`) REFERENCES `experiments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_experiments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_notes`
--
ALTER TABLE `user_notes`
  ADD CONSTRAINT `user_notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `well_statistics_water`
--
ALTER TABLE `well_statistics_water`
  ADD CONSTRAINT `well_statistics_water_well_id_foreign` FOREIGN KEY (`well_id`) REFERENCES `wells` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `well_tec_specifications`
--
ALTER TABLE `well_tec_specifications`
  ADD CONSTRAINT `well_tec_specifications_well_id_foreign` FOREIGN KEY (`well_id`) REFERENCES `wells` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
