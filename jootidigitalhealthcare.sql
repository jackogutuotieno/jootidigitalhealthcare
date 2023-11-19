-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 30, 2023 at 02:14 PM
-- Server version: 8.0.31
-- PHP Version: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- Table structure for table `jdh_appointments`
--

DROP TABLE IF EXISTS `jdh_appointments`;
CREATE TABLE IF NOT EXISTS `jdh_appointments` (
  `appointment_id` bigint NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `user_id` int NOT NULL,
  `appointment_title` varchar(200) NOT NULL,
  `appointment_start_date` datetime NOT NULL,
  `appointment_end_date` datetime NOT NULL,
  `appointment_all_day` tinyint(1) NOT NULL,
  `appointment_description` text NOT NULL,
  `submission_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subbmitted_by_user_id` int NOT NULL,
  PRIMARY KEY (`appointment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_appointments`
--

INSERT INTO `jdh_appointments` (`appointment_id`, `patient_id`, `user_id`, `appointment_title`, `appointment_start_date`, `appointment_end_date`, `appointment_all_day`, `appointment_description`, `submission_date`, `subbmitted_by_user_id`) VALUES
(2, 1, 9, 'Coming for some checkup', '2023-11-16 19:00:00', '2023-11-16 20:00:00', 0, 'Coming for some checkup', '2023-08-06 19:00:53', 2),
(3, 2, 10, 'Coming for post surgery review.', '2023-12-13 22:20:00', '2023-12-13 23:20:00', 1, 'Coming for post surgery review.', '2023-08-09 21:23:46', 1),
(4, 1, 10, 'Coming to examine  x-ray results', '2023-08-24 21:25:00', '2023-08-24 22:25:00', 1, 'Coming to examine  x-ray results', '2023-08-16 21:26:10', 2),
(5, 5, 3, 'Post surgery review', '2023-10-23 21:45:00', '2023-08-29 22:45:00', 1, 'Post surgery review', '2023-08-29 21:46:27', 2),
(6, 4, 9, 'Cancer chemotherapy session', '2023-10-26 23:48:00', '2023-10-26 23:48:00', 1, 'Cancer chemotherapy session', '2023-08-29 23:48:58', 2),
(7, 3, 10, 'See Doctor', '2023-10-30 23:51:00', '2023-10-30 23:51:00', 1, 'Test', '2023-10-25 23:52:19', 2);

-- --------------------------------------------------------

--
-- Table structure for table `jdh_audittrail`
--

DROP TABLE IF EXISTS `jdh_audittrail`;
CREATE TABLE IF NOT EXISTS `jdh_audittrail` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `DateTime` datetime NOT NULL,
  `Script` varchar(255) DEFAULT NULL,
  `User` varchar(255) DEFAULT NULL,
  `Action` varchar(255) DEFAULT NULL,
  `Table` varchar(255) DEFAULT NULL,
  `Field` varchar(255) DEFAULT NULL,
  `KeyValue` longtext,
  `OldValue` longtext,
  `NewValue` longtext,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=969 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_audittrail`
--

INSERT INTO `jdh_audittrail` (`Id`, `DateTime`, `Script`, `User`, `Action`, `Table`, `Field`, `KeyValue`, `OldValue`, `NewValue`) VALUES
(1, '2023-08-04 18:23:01', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(2, '2023-08-04 18:24:56', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(3, '2023-08-04 18:30:57', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(4, '2023-08-04 18:33:53', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(5, '2023-08-04 18:45:30', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(6, '2023-08-04 18:45:46', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(7, '2023-08-04 18:48:46', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(8, '2023-08-04 18:57:01', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(9, '2023-08-04 18:57:55', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(10, '2023-08-04 18:58:15', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(11, '2023-08-04 18:59:58', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(12, '2023-08-04 19:00:10', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(13, '2023-08-04 19:00:41', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(14, '2023-08-04 19:01:03', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(15, '2023-08-04 19:08:30', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(16, '2023-08-04 19:08:40', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(17, '2023-08-04 19:12:37', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(18, '2023-08-04 19:45:29', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(19, '2023-08-04 19:46:58', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(20, '2023-08-04 19:47:10', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(21, '2023-08-04 19:47:31', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(22, '2023-08-04 19:54:36', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(23, '2023-08-04 19:56:16', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(24, '2023-08-04 19:56:29', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(25, '2023-08-04 20:02:01', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(26, '2023-08-04 20:03:54', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(27, '2023-08-04 20:05:52', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(28, '2023-08-05 08:53:40', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(29, '2023-08-05 09:27:56', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_category_id', '1', '', '2'),
(30, '2023-08-05 09:27:57', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_name', '1', '', 'RBS'),
(31, '2023-08-05 09:27:57', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'description', '1', '', '<p>RBS Test</p>'),
(32, '2023-08-05 09:27:57', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_id', '1', '', '1'),
(33, '2023-08-05 09:29:28', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_category_id', '2', '', '2'),
(34, '2023-08-05 09:29:28', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_name', '2', '', 'Malaria Test/RDT/Bs for MPS'),
(35, '2023-08-05 09:29:28', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'description', '2', '', '<p>Malaria Test/RDT/Bs for MPS Test</p>'),
(36, '2023-08-05 09:29:28', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_id', '2', '', '2'),
(37, '2023-08-05 09:30:07', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_category_id', '3', '', '2'),
(38, '2023-08-05 09:30:07', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_name', '3', '', 'Urinalysis'),
(39, '2023-08-05 09:30:07', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'description', '3', '', '<p>Urinalysis Test</p>'),
(40, '2023-08-05 09:30:07', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_id', '3', '', '3'),
(41, '2023-08-05 09:30:32', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_category_id', '4', '', '2'),
(42, '2023-08-05 09:30:32', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_name', '4', '', 'VDRL'),
(43, '2023-08-05 09:30:32', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'description', '4', '', '<p>VDRL Test</p>'),
(44, '2023-08-05 09:30:32', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_id', '4', '', '4'),
(45, '2023-08-05 09:31:01', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_category_id', '5', '', '2'),
(46, '2023-08-05 09:31:01', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_name', '5', '', 'SAT'),
(47, '2023-08-05 09:31:01', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'description', '5', '', '<p>SAT Test</p>'),
(48, '2023-08-05 09:31:02', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_id', '5', '', '5'),
(49, '2023-08-05 09:31:29', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_category_id', '6', '', '2'),
(50, '2023-08-05 09:31:29', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_name', '6', '', 'H. Pylori'),
(51, '2023-08-05 09:31:29', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'description', '6', '', '<p>H. Pylori Test</p>'),
(52, '2023-08-05 09:31:29', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_id', '6', '', '6'),
(53, '2023-08-05 09:31:51', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_category_id', '7', '', '2'),
(54, '2023-08-05 09:31:51', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_name', '7', '', 'Check HB'),
(55, '2023-08-05 09:31:51', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'description', '7', '', '<p>Check HB Test</p>'),
(56, '2023-08-05 09:31:51', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_id', '7', '', '7'),
(57, '2023-08-05 09:32:20', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_category_id', '8', '', '2'),
(58, '2023-08-05 09:32:20', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_name', '8', '', 'ANC Profile'),
(59, '2023-08-05 09:32:20', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'description', '8', '', '<p>ANC Profile Test</p>'),
(60, '2023-08-05 09:32:20', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_id', '8', '', '8'),
(61, '2023-08-05 09:32:54', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_category_id', '9', '', '2'),
(62, '2023-08-05 09:32:54', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_name', '9', '', 'HIV/PITC'),
(63, '2023-08-05 09:32:54', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'description', '9', '', '<p>HIV/PITC Test</p>'),
(64, '2023-08-05 09:32:54', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_id', '9', '', '9'),
(65, '2023-08-05 09:37:14', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_category_id', '10', '', '2'),
(66, '2023-08-05 09:37:14', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_name', '10', '', 'Rheumatoid Factor'),
(67, '2023-08-05 09:37:14', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'description', '10', '', '<p>Rheumatoid Factor Test</p>'),
(68, '2023-08-05 09:37:14', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_id', '10', '', '10'),
(69, '2023-08-05 09:37:58', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_category_id', '11', '', '2'),
(70, '2023-08-05 09:37:58', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_name', '11', '', 'Stool for o/c'),
(71, '2023-08-05 09:37:58', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'description', '11', '', '<p>Stool for o/c test</p>'),
(72, '2023-08-05 09:37:58', '/jootidigitalhealthcare/jdhlabtestsubcategoriesadd', '-2', 'A', 'jdh_lab_test_subcategories', 'test_subcategory_id', '11', '', '11'),
(73, '2023-08-05 10:43:49', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(74, '2023-08-05 10:44:02', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(75, '2023-08-05 10:44:28', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(76, '2023-08-05 10:44:34', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(77, '2023-08-05 10:48:38', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(78, '2023-08-05 10:48:47', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(79, '2023-08-05 10:52:46', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(80, '2023-08-05 10:53:01', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(81, '2023-08-05 10:53:25', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(82, '2023-08-05 10:53:31', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(83, '2023-08-05 10:56:45', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(84, '2023-08-05 10:56:51', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(85, '2023-08-05 10:56:59', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(86, '2023-08-05 10:57:06', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(87, '2023-08-05 10:57:23', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(88, '2023-08-05 10:57:46', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(89, '2023-08-05 11:13:55', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(90, '2023-08-05 11:14:13', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(91, '2023-08-05 11:17:10', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(92, '2023-08-05 11:17:20', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(93, '2023-08-05 11:38:12', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(94, '2023-08-05 11:38:19', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(95, '2023-08-05 13:44:31', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(96, '2023-08-05 13:44:58', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(97, '2023-08-05 13:47:56', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(98, '2023-08-05 13:48:12', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(99, '2023-08-05 13:49:42', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(100, '2023-08-05 13:49:49', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(101, '2023-08-05 14:04:06', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(102, '2023-08-05 14:04:22', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(103, '2023-08-05 14:55:21', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(104, '2023-08-05 14:58:39', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(105, '2023-08-05 14:58:55', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(106, '2023-08-05 15:03:15', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(107, '2023-08-05 15:03:35', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(108, '2023-08-05 15:07:31', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(109, '2023-08-05 15:07:54', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(110, '2023-08-05 15:13:57', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(111, '2023-08-05 15:42:02', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(112, '2023-08-05 16:04:21', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(113, '2023-08-05 16:04:47', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(114, '2023-08-05 16:05:48', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(115, '2023-08-06 09:53:35', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(116, '2023-08-06 10:51:16', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(117, '2023-08-06 10:51:22', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(118, '2023-08-06 11:22:46', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(119, '2023-08-06 11:22:57', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(120, '2023-08-06 12:50:13', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(121, '2023-08-06 12:50:19', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(122, '2023-08-06 13:16:00', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(123, '2023-08-06 13:16:07', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(124, '2023-08-06 13:33:39', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(125, '2023-08-06 13:33:50', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(126, '2023-08-06 13:34:12', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'patient_id', '2', '', '2'),
(127, '2023-08-06 13:34:12', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'chief_compaints', '2', '', 'hjhjhj'),
(128, '2023-08-06 13:34:12', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'id', '2', '', '2'),
(129, '2023-08-06 13:55:37', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'patient_id', '3', '', '2'),
(130, '2023-08-06 13:55:37', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'chief_compaints', '3', '', 'wwerr'),
(131, '2023-08-06 13:55:37', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'id', '3', '', '3'),
(132, '2023-08-06 13:57:14', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(133, '2023-08-06 13:57:20', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(134, '2023-08-06 14:57:58', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(135, '2023-08-06 14:58:05', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(136, '2023-08-06 15:03:09', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(137, '2023-08-06 15:03:14', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(138, '2023-08-06 15:18:35', '/jootidigitalhealthcare/jdhexaminationfindingslist', '3', 'A', 'jdh_examination_findings', 'patient_id', '1', '', '1'),
(139, '2023-08-06 15:18:36', '/jootidigitalhealthcare/jdhexaminationfindingslist', '3', 'A', 'jdh_examination_findings', 'general_exams', '1', '', 'Test examfr'),
(140, '2023-08-06 15:18:36', '/jootidigitalhealthcare/jdhexaminationfindingslist', '3', 'A', 'jdh_examination_findings', 'systematic_exams', '1', '', 'sytematic...'),
(141, '2023-08-06 15:18:36', '/jootidigitalhealthcare/jdhexaminationfindingslist', '3', 'A', 'jdh_examination_findings', 'id', '1', '', '1'),
(142, '2023-08-06 15:23:38', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(143, '2023-08-06 15:23:44', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(144, '2023-08-06 15:24:18', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(145, '2023-08-06 15:24:37', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(146, '2023-08-06 15:33:54', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(147, '2023-08-06 15:34:12', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(148, '2023-08-06 15:41:18', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(149, '2023-08-06 15:41:28', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(150, '2023-08-06 15:58:04', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(151, '2023-08-06 15:58:16', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(152, '2023-08-06 15:59:51', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(153, '2023-08-06 15:59:58', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(154, '2023-08-06 16:01:18', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(155, '2023-08-06 16:01:32', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(156, '2023-08-06 16:08:05', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(157, '2023-08-06 16:08:36', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(158, '2023-08-07 12:11:01', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(159, '2023-08-07 12:14:42', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(160, '2023-08-07 12:14:50', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(161, '2023-08-07 12:19:31', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(162, '2023-08-07 12:19:39', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(163, '2023-08-07 12:26:45', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(164, '2023-08-07 12:26:52', '/jootidigitalhealthcare/login', '-2', 'login', '::1', '', '', '', ''),
(165, '2023-08-07 12:28:52', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '-2', 'A', 'jdh_chief_complaints', 'patient_id', '1', '', '2'),
(166, '2023-08-07 12:28:52', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '-2', 'A', 'jdh_chief_complaints', 'chief_compaints', '1', '', 'Another complaint of headaches and fever'),
(167, '2023-08-07 12:28:52', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '-2', 'A', 'jdh_chief_complaints', 'id', '1', '', '1'),
(168, '2023-08-07 12:33:50', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(169, '2023-08-07 12:34:06', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(170, '2023-08-07 12:35:40', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'patient_id', '1', '', '3'),
(171, '2023-08-07 12:35:40', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'chief_compaints', '1', '', 'Patient has fever'),
(172, '2023-08-07 12:35:40', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'addedby_user_id', '1', '', '4'),
(173, '2023-08-07 12:35:40', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'id', '1', '', '1'),
(174, '2023-08-07 12:36:37', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(175, '2023-08-07 12:36:52', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(176, '2023-08-07 12:39:52', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(177, '2023-08-07 12:39:59', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(178, '2023-08-07 12:42:45', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(179, '2023-08-07 12:42:52', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(180, '2023-08-07 12:59:11', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(181, '2023-08-08 08:03:41', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(182, '2023-08-08 08:06:20', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(183, '2023-08-08 08:06:37', '/jootidigitalhealthcare/login', '6', 'login', '::1', '', '', '', ''),
(184, '2023-08-08 08:54:27', '/jootidigitalhealthcare/logout', '6', 'logout', '::1', '', '', '', ''),
(185, '2023-08-08 08:54:38', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(186, '2023-08-08 08:55:03', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(187, '2023-08-08 08:55:10', '/jootidigitalhealthcare/login', '6', 'login', '::1', '', '', '', ''),
(188, '2023-08-08 09:13:41', '/jootidigitalhealthcare/logout', '6', 'logout', '::1', '', '', '', ''),
(189, '2023-08-08 09:13:54', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(190, '2023-08-08 09:15:35', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(191, '2023-08-08 09:16:24', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(192, '2023-08-08 09:16:49', '/jootidigitalhealthcare/jdhpatientsedit/1', '2', 'U', 'jdh_patients', 'patient_last_name', '1', 'Demo', 'Demo Next'),
(193, '2023-08-08 09:17:02', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(194, '2023-08-08 09:17:14', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(195, '2023-08-08 09:26:48', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(196, '2023-08-08 09:26:55', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(197, '2023-08-08 09:29:04', '/jootidigitalhealthcare/jdhpatientsedit/2', '2', 'U', 'jdh_patients', 'patient_gender', '2', 'Male', 'Female'),
(198, '2023-08-08 09:31:47', '/jootidigitalhealthcare/jdhpatientsedit/1', '2', 'U', 'jdh_patients', 'patient_national_id', '1', '565657667', '001'),
(199, '2023-08-08 09:32:31', '/jootidigitalhealthcare/jdhpatientsedit/2', '2', 'U', 'jdh_patients', 'patient_national_id', '2', '45465565', '002'),
(200, '2023-08-08 09:32:31', '/jootidigitalhealthcare/jdhpatientsedit/2', '2', 'U', 'jdh_patients', 'patient_first_name', '2', 'Second', 'Patient'),
(201, '2023-08-08 09:32:31', '/jootidigitalhealthcare/jdhpatientsedit/2', '2', 'U', 'jdh_patients', 'patient_last_name', '2', 'Patient', 'Two'),
(202, '2023-08-08 09:32:31', '/jootidigitalhealthcare/jdhpatientsedit/2', '2', 'U', 'jdh_patients', 'patient_phone', '2', '454565', '0721123456'),
(203, '2023-08-08 09:32:56', '/jootidigitalhealthcare/jdhpatientsedit/3', '2', 'U', 'jdh_patients', 'patient_national_id', '3', '657787', '003'),
(204, '2023-08-08 09:32:56', '/jootidigitalhealthcare/jdhpatientsedit/3', '2', 'U', 'jdh_patients', 'patient_first_name', '3', 'Denis', 'Patient'),
(205, '2023-08-08 09:32:56', '/jootidigitalhealthcare/jdhpatientsedit/3', '2', 'U', 'jdh_patients', 'patient_last_name', '3', 'Mathogothanio', 'Three'),
(206, '2023-08-08 09:36:38', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(207, '2023-08-08 09:39:10', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(208, '2023-08-08 11:33:12', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(209, '2023-08-08 11:33:20', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(210, '2023-08-08 11:36:39', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(211, '2023-08-08 11:36:45', '/jootidigitalhealthcare/login', '7', 'login', '::1', '', '', '', ''),
(212, '2023-08-08 11:39:19', '/jootidigitalhealthcare/login', '7', 'login', '::1', '', '', '', ''),
(213, '2023-08-08 11:40:52', '/jootidigitalhealthcare/login', '7', 'login', '::1', '', '', '', ''),
(214, '2023-08-08 11:42:30', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(215, '2023-08-08 11:43:08', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(216, '2023-08-08 11:43:15', '/jootidigitalhealthcare/login', '7', 'login', '::1', '', '', '', ''),
(217, '2023-08-08 12:13:29', '/jootidigitalhealthcare/logout', '7', 'logout', '::1', '', '', '', ''),
(218, '2023-08-08 12:14:45', '/jootidigitalhealthcare/login', '7', 'login', '::1', '', '', '', ''),
(219, '2023-08-08 18:39:18', '/jootidigitalhealthcare/logout', '7', 'logout', '::1', '', '', '', ''),
(220, '2023-08-08 18:39:35', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(221, '2023-08-08 19:15:45', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(222, '2023-08-08 19:15:52', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(223, '2023-08-08 19:17:46', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(224, '2023-08-08 19:17:59', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(225, '2023-08-08 19:34:57', '/jootidigitalhealthcare/jdhtestreportsadd', '5', 'A', 'jdh_test_reports', 'request_id', '1', '', '1'),
(226, '2023-08-08 19:34:57', '/jootidigitalhealthcare/jdhtestreportsadd', '5', 'A', 'jdh_test_reports', 'patient_id', '1', '', '1'),
(227, '2023-08-08 19:34:57', '/jootidigitalhealthcare/jdhtestreportsadd', '5', 'A', 'jdh_test_reports', 'report_findings', '1', '', 'There were some blood clots...'),
(228, '2023-08-08 19:34:57', '/jootidigitalhealthcare/jdhtestreportsadd', '5', 'A', 'jdh_test_reports', 'report_submittedby_user_id', '1', '', '5'),
(229, '2023-08-08 19:34:57', '/jootidigitalhealthcare/jdhtestreportsadd', '5', 'A', 'jdh_test_reports', 'report_id', '1', '', '1'),
(230, '2023-08-08 19:41:56', '/jootidigitalhealthcare/jdhtestreportsadd', '5', 'A', 'jdh_test_reports', 'request_id', '2', '', '1'),
(231, '2023-08-08 19:41:56', '/jootidigitalhealthcare/jdhtestreportsadd', '5', 'A', 'jdh_test_reports', 'patient_id', '2', '', '1'),
(232, '2023-08-08 19:41:56', '/jootidigitalhealthcare/jdhtestreportsadd', '5', 'A', 'jdh_test_reports', 'report_findings', '2', '', 'Testing...'),
(233, '2023-08-08 19:41:56', '/jootidigitalhealthcare/jdhtestreportsadd', '5', 'A', 'jdh_test_reports', 'report_submittedby_user_id', '2', '', '5'),
(234, '2023-08-08 19:41:56', '/jootidigitalhealthcare/jdhtestreportsadd', '5', 'A', 'jdh_test_reports', 'report_id', '2', '', '2'),
(235, '2023-08-08 19:46:58', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(236, '2023-08-08 19:47:29', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(237, '2023-08-08 19:53:54', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(238, '2023-08-08 19:54:00', '/jootidigitalhealthcare/login', '7', 'login', '::1', '', '', '', ''),
(239, '2023-08-08 20:08:30', '/jootidigitalhealthcare/logout', '7', 'logout', '::1', '', '', '', ''),
(240, '2023-08-08 20:08:35', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(241, '2023-08-08 20:13:17', '/jootidigitalhealthcare/jdhtestrequestsedit/1', '3', 'U', 'jdh_test_requests', 'request_service_id', '1', '2', '13'),
(242, '2023-08-08 20:13:34', '/jootidigitalhealthcare/jdhtestrequestsedit/2', '3', 'U', 'jdh_test_requests', 'request_service_id', '2', '2', '13'),
(243, '2023-08-08 20:22:40', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(244, '2023-08-08 20:22:56', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(245, '2023-08-08 20:23:36', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(246, '2023-08-09 07:43:26', '/jootidigitalhealthcare/login', '7', 'login', '::1', '', '', '', ''),
(247, '2023-08-09 07:44:04', '/jootidigitalhealthcare/logout', '7', 'logout', '::1', '', '', '', ''),
(248, '2023-08-09 07:44:13', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(249, '2023-08-09 18:07:55', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(250, '2023-08-09 18:14:45', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(251, '2023-08-09 18:24:38', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(252, '2023-08-09 18:36:07', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(253, '2023-08-09 18:37:59', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(254, '2023-08-10 12:43:04', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(255, '2023-08-11 10:52:52', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(256, '2023-08-13 11:17:33', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(257, '2023-08-15 12:03:42', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(258, '2023-08-16 08:36:57', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(259, '2023-08-16 08:39:37', '/jootidigitalhealthcare/jdhpatientsedit/1', '1', 'U', 'jdh_patients', 'patient_name', '1', 'Patient', 'Patient One'),
(260, '2023-08-16 08:40:02', '/jootidigitalhealthcare/jdhpatientsedit/2', '1', 'U', 'jdh_patients', 'patient_name', '2', 'Patient', 'Patient Two'),
(261, '2023-08-16 08:50:38', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(262, '2023-08-16 08:50:43', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(263, '2023-08-16 08:55:26', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'patient_id', '2', '', '1'),
(264, '2023-08-16 08:55:26', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'chief_compaints', '2', '', 'Test complaint'),
(265, '2023-08-16 08:55:26', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'addedby_user_id', '2', '', '4'),
(266, '2023-08-16 08:55:26', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'id', '2', '', '2'),
(267, '2023-08-16 08:57:09', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(268, '2023-08-16 08:57:12', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(269, '2023-08-16 08:59:27', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(270, '2023-08-16 08:59:33', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(271, '2023-08-16 09:00:21', '/jootidigitalhealthcare/jdhpatientsedit/3', '1', 'U', 'jdh_patients', 'patient_name', '3', 'Patient', 'Patient Three'),
(272, '2023-08-16 09:00:21', '/jootidigitalhealthcare/jdhpatientsedit/3', '1', 'U', 'jdh_patients', 'patient_kin_name', '3', 'MUFUTA', 'Mufuta'),
(273, '2023-08-16 09:00:21', '/jootidigitalhealthcare/jdhpatientsedit/3', '1', 'U', 'jdh_patients', 'patient_kin_phone', '3', '0800009890987', '0712345678'),
(274, '2023-08-16 09:02:39', '/jootidigitalhealthcare/jdhpatientsedit/1', '1', 'U', 'jdh_patients', 'patient_phone', '1', '65467687', '0722000000'),
(275, '2023-08-16 09:20:59', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(276, '2023-08-16 09:21:08', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(277, '2023-08-16 09:42:09', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(278, '2023-08-16 09:42:15', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(279, '2023-08-16 10:10:33', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(280, '2023-08-16 10:10:40', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(281, '2023-08-16 10:49:39', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(282, '2023-08-16 12:39:38', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(283, '2023-08-16 12:39:46', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(284, '2023-08-16 12:41:51', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(285, '2023-08-16 12:42:07', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(286, '2023-08-16 12:46:00', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(287, '2023-08-16 12:46:07', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(288, '2023-08-16 12:53:19', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(289, '2023-08-16 12:53:29', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(290, '2023-08-16 12:54:56', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(291, '2023-08-16 12:54:59', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(292, '2023-08-16 13:04:33', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(293, '2023-08-16 13:04:40', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(294, '2023-08-16 17:51:29', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(295, '2023-08-16 17:51:42', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(296, '2023-08-16 17:52:52', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(297, '2023-08-16 17:53:01', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(298, '2023-08-16 18:05:52', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(299, '2023-08-16 18:05:56', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(300, '2023-08-16 18:06:02', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(301, '2023-08-16 18:06:14', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(302, '2023-08-16 18:10:48', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(303, '2023-08-16 18:10:56', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(304, '2023-08-16 18:21:24', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(305, '2023-08-16 18:21:27', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(306, '2023-08-16 18:26:10', '/jootidigitalhealthcare/jdhappointmentsadd', '2', 'A', 'jdh_appointments', 'patient_id', '4', '', '1'),
(307, '2023-08-16 18:26:10', '/jootidigitalhealthcare/jdhappointmentsadd', '2', 'A', 'jdh_appointments', 'appointment_title', '4', '', 'See Dr. Damar Otieno'),
(308, '2023-08-16 18:26:10', '/jootidigitalhealthcare/jdhappointmentsadd', '2', 'A', 'jdh_appointments', 'appointment_start_date', '4', '', '2023-08-24 21:25:00'),
(309, '2023-08-16 18:26:10', '/jootidigitalhealthcare/jdhappointmentsadd', '2', 'A', 'jdh_appointments', 'appointment_end_date', '4', '', '2023-08-24 22:25:00'),
(310, '2023-08-16 18:26:10', '/jootidigitalhealthcare/jdhappointmentsadd', '2', 'A', 'jdh_appointments', 'appointment_all_day', '4', '', '1'),
(311, '2023-08-16 18:26:10', '/jootidigitalhealthcare/jdhappointmentsadd', '2', 'A', 'jdh_appointments', 'appointment_description', '4', '', '<p>Another appointment..</p>'),
(312, '2023-08-16 18:26:10', '/jootidigitalhealthcare/jdhappointmentsadd', '2', 'A', 'jdh_appointments', 'subbmitted_by_user_id', '4', '', '2'),
(313, '2023-08-16 18:26:10', '/jootidigitalhealthcare/jdhappointmentsadd', '2', 'A', 'jdh_appointments', 'appointment_id', '4', '', '4'),
(314, '2023-08-16 18:34:16', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(315, '2023-08-16 19:12:12', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(316, '2023-08-16 19:39:09', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(317, '2023-08-16 19:44:45', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(318, '2023-08-16 19:45:10', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(319, '2023-08-16 19:54:12', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(320, '2023-08-16 19:54:18', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(321, '2023-08-16 20:02:42', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(322, '2023-08-16 20:02:55', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(323, '2023-08-16 20:06:11', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(324, '2023-08-16 20:06:19', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(325, '2023-08-16 20:07:50', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(326, '2023-08-16 20:08:00', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(327, '2023-08-16 20:33:49', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(328, '2023-08-16 20:33:56', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(329, '2023-08-16 20:43:38', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(330, '2023-08-16 20:44:09', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(331, '2023-08-17 06:59:14', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(332, '2023-08-17 07:17:49', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(333, '2023-08-17 07:18:12', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(334, '2023-08-17 07:25:09', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(335, '2023-08-17 07:25:12', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(336, '2023-08-17 07:37:26', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(337, '2023-08-17 07:37:28', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(338, '2023-08-17 07:37:33', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(339, '2023-08-17 07:37:47', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(340, '2023-08-17 07:44:29', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(341, '2023-08-17 07:44:36', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(342, '2023-08-17 07:48:45', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(343, '2023-08-17 07:49:14', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(344, '2023-08-17 08:13:05', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(345, '2023-08-17 08:13:12', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(346, '2023-08-17 08:16:34', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(347, '2023-08-17 08:16:43', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(348, '2023-08-17 08:19:08', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(349, '2023-08-17 08:19:11', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(350, '2023-08-17 08:20:45', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(351, '2023-08-17 08:20:52', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(352, '2023-08-17 08:28:40', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(353, '2023-08-17 08:28:48', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(354, '2023-08-17 08:32:35', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(355, '2023-08-17 08:37:21', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(356, '2023-08-17 08:49:38', '/jootidigitalhealthcare/jdhtestrequestsedit/1', '1', 'U', 'jdh_test_requests', 'status_id', '1', '0', '1'),
(357, '2023-08-17 08:49:52', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(358, '2023-08-17 08:50:00', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(359, '2023-08-17 09:13:00', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(360, '2023-08-17 09:13:06', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(361, '2023-08-17 09:14:22', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(362, '2023-08-17 09:14:26', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(363, '2023-08-17 09:18:56', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(364, '2023-08-17 09:19:04', '/jootidigitalhealthcare/login', '6', 'login', '::1', '', '', '', ''),
(365, '2023-08-17 09:21:48', '/jootidigitalhealthcare/logout', '6', 'logout', '::1', '', '', '', ''),
(366, '2023-08-17 09:21:52', '/jootidigitalhealthcare/login', '6', 'login', '::1', '', '', '', ''),
(367, '2023-08-17 09:26:08', '/jootidigitalhealthcare/logout', '6', 'logout', '::1', '', '', '', ''),
(368, '2023-08-17 09:26:16', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(369, '2023-08-17 09:31:58', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(370, '2023-08-17 09:32:11', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(371, '2023-08-17 13:18:33', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(372, '2023-08-17 13:18:38', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(373, '2023-08-17 13:26:59', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(374, '2023-08-17 13:27:05', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(375, '2023-08-17 13:34:49', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(376, '2023-08-22 18:28:31', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(377, '2023-08-22 18:33:06', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(378, '2023-08-22 18:33:09', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(379, '2023-08-22 18:38:24', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(380, '2023-08-22 18:38:33', '/jootidigitalhealthcare/login', '6', 'login', '::1', '', '', '', ''),
(381, '2023-08-22 18:41:01', '/jootidigitalhealthcare/logout', '6', 'logout', '::1', '', '', '', ''),
(382, '2023-08-22 18:41:15', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(383, '2023-08-22 18:46:20', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(384, '2023-08-22 18:46:25', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(385, '2023-08-22 18:59:56', '/jootidigitalhealthcare/jdhmedicinesedit/21', '1', 'U', 'jdh_medicines', 'expiry', '21', '0000-00-00', '2025-05-21'),
(386, '2023-08-22 19:00:30', '/jootidigitalhealthcare/jdhmedicinesedit/22', '1', 'U', 'jdh_medicines', 'expiry', '22', '0000-00-00', '2025-05-21'),
(387, '2023-08-22 19:02:40', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(388, '2023-08-22 19:02:47', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(389, '2023-08-22 19:04:47', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(390, '2023-08-22 19:04:51', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(391, '2023-08-22 19:05:11', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(392, '2023-08-22 19:05:14', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(393, '2023-08-22 19:07:16', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(394, '2023-08-22 19:07:26', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(395, '2023-08-23 19:41:34', '/jootidigitalhealthcare/logout', '-2', 'logout', '::1', '', '', '', ''),
(396, '2023-08-23 19:42:37', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(397, '2023-08-23 19:45:30', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(398, '2023-08-23 19:45:38', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(399, '2023-08-23 19:49:40', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(400, '2023-08-23 19:56:38', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(401, '2023-08-23 19:56:48', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(402, '2023-08-23 20:03:17', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(403, '2023-08-23 20:03:36', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(404, '2023-08-23 20:27:38', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(405, '2023-08-23 20:27:47', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(406, '2023-08-23 20:40:03', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(407, '2023-08-23 20:40:43', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(408, '2023-08-23 20:42:46', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(409, '2023-08-23 20:43:13', '/jootidigitalhealthcare/login', '7', 'login', '::1', '', '', '', ''),
(410, '2023-08-23 20:44:44', '/jootidigitalhealthcare/logout', '7', 'logout', '::1', '', '', '', ''),
(411, '2023-08-23 20:45:00', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(412, '2023-08-23 20:47:56', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(413, '2023-08-23 20:48:25', '/jootidigitalhealthcare/login', '7', 'login', '::1', '', '', '', ''),
(414, '2023-08-23 20:53:40', '/jootidigitalhealthcare/logout', '7', 'logout', '::1', '', '', '', ''),
(415, '2023-08-23 20:53:43', '/jootidigitalhealthcare/login', '7', 'login', '::1', '', '', '', ''),
(416, '2023-08-23 21:01:43', '/jootidigitalhealthcare/logout', '7', 'logout', '::1', '', '', '', ''),
(417, '2023-08-23 21:01:49', '/jootidigitalhealthcare/login', '7', 'login', '::1', '', '', '', ''),
(418, '2023-08-23 21:05:52', '/jootidigitalhealthcare/logout', '7', 'logout', '::1', '', '', '', ''),
(419, '2023-08-24 09:10:49', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(420, '2023-08-24 09:15:59', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(421, '2023-08-24 09:16:04', '/jootidigitalhealthcare/login', '8', 'login', '::1', '', '', '', ''),
(422, '2023-08-24 09:55:00', '/jootidigitalhealthcare/jdhmedicinestockadd', '8', 'A', 'jdh_medicine_stock', 'medicine_id', '1', '', '1'),
(423, '2023-08-24 09:55:00', '/jootidigitalhealthcare/jdhmedicinestockadd', '8', 'A', 'jdh_medicine_stock', 'units_available', '1', '', '1000'),
(424, '2023-08-24 09:55:00', '/jootidigitalhealthcare/jdhmedicinestockadd', '8', 'A', 'jdh_medicine_stock', 'id', '1', '', '1'),
(425, '2023-08-24 09:58:46', '/jootidigitalhealthcare/jdhmedicinestockadd', '8', 'A', 'jdh_medicine_stock', 'medicine_id', '2', '', '2'),
(426, '2023-08-24 09:58:46', '/jootidigitalhealthcare/jdhmedicinestockadd', '8', 'A', 'jdh_medicine_stock', 'units_available', '2', '', '500'),
(427, '2023-08-24 09:58:46', '/jootidigitalhealthcare/jdhmedicinestockadd', '8', 'A', 'jdh_medicine_stock', 'id', '2', '', '2'),
(428, '2023-08-24 09:59:04', '/jootidigitalhealthcare/jdhmedicinestockadd', '8', 'A', 'jdh_medicine_stock', 'medicine_id', '3', '', '15'),
(429, '2023-08-24 09:59:04', '/jootidigitalhealthcare/jdhmedicinestockadd', '8', 'A', 'jdh_medicine_stock', 'units_available', '3', '', '300'),
(430, '2023-08-24 09:59:04', '/jootidigitalhealthcare/jdhmedicinestockadd', '8', 'A', 'jdh_medicine_stock', 'id', '3', '', '3'),
(431, '2023-08-24 12:08:23', '/jootidigitalhealthcare/logout', '8', 'logout', '::1', '', '', '', ''),
(432, '2023-08-24 12:08:32', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(433, '2023-08-24 12:49:03', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(434, '2023-08-24 12:49:06', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(435, '2023-08-24 12:54:17', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(436, '2023-08-24 12:54:25', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(437, '2023-08-24 13:00:19', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(438, '2023-08-24 13:00:31', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(439, '2023-08-24 17:30:33', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(440, '2023-08-24 17:30:40', '/jootidigitalhealthcare/login', '6', 'login', '::1', '', '', '', ''),
(441, '2023-08-24 17:33:20', '/jootidigitalhealthcare/logout', '6', 'logout', '::1', '', '', '', ''),
(442, '2023-08-24 17:33:24', '/jootidigitalhealthcare/login', '6', 'login', '::1', '', '', '', ''),
(443, '2023-08-24 17:37:09', '/jootidigitalhealthcare/logout', '6', 'logout', '::1', '', '', '', '');
INSERT INTO `jdh_audittrail` (`Id`, `DateTime`, `Script`, `User`, `Action`, `Table`, `Field`, `KeyValue`, `OldValue`, `NewValue`) VALUES
(444, '2023-08-24 17:37:13', '/jootidigitalhealthcare/login', '6', 'login', '::1', '', '', '', ''),
(445, '2023-08-24 17:47:15', '/jootidigitalhealthcare/logout', '6', 'logout', '::1', '', '', '', ''),
(446, '2023-08-24 17:47:18', '/jootidigitalhealthcare/login', '6', 'login', '::1', '', '', '', ''),
(447, '2023-08-24 17:55:33', '/jootidigitalhealthcare/logout', '6', 'logout', '::1', '', '', '', ''),
(448, '2023-08-24 17:55:36', '/jootidigitalhealthcare/login', '6', 'login', '::1', '', '', '', ''),
(449, '2023-08-24 17:56:41', '/jootidigitalhealthcare/logout', '6', 'logout', '::1', '', '', '', ''),
(450, '2023-08-24 17:56:50', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(451, '2023-08-24 17:58:48', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(452, '2023-08-24 17:58:57', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(453, '2023-08-24 18:00:54', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(454, '2023-08-24 18:01:08', '/jootidigitalhealthcare/login', '6', 'login', '::1', '', '', '', ''),
(455, '2023-08-24 18:23:35', '/jootidigitalhealthcare/logout', '6', 'logout', '::1', '', '', '', ''),
(456, '2023-08-24 18:23:42', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(457, '2023-08-24 18:27:49', '/jootidigitalhealthcare/jdhprescriptionsadd', '3', 'A', 'jdh_prescriptions', 'patient_id', '1', '', '1'),
(458, '2023-08-24 18:27:49', '/jootidigitalhealthcare/jdhprescriptionsadd', '3', 'A', 'jdh_prescriptions', 'prescription_title', '1', '', 'Prescription for Patient One'),
(459, '2023-08-24 18:27:49', '/jootidigitalhealthcare/jdhprescriptionsadd', '3', 'A', 'jdh_prescriptions', 'medicine_id', '1', '', '1'),
(460, '2023-08-24 18:27:49', '/jootidigitalhealthcare/jdhprescriptionsadd', '3', 'A', 'jdh_prescriptions', 'tabs', '1', '', '1'),
(461, '2023-08-24 18:27:49', '/jootidigitalhealthcare/jdhprescriptionsadd', '3', 'A', 'jdh_prescriptions', 'frequency', '1', '', '3'),
(462, '2023-08-24 18:27:49', '/jootidigitalhealthcare/jdhprescriptionsadd', '3', 'A', 'jdh_prescriptions', 'prescription_days', '1', '', '5'),
(463, '2023-08-24 18:27:49', '/jootidigitalhealthcare/jdhprescriptionsadd', '3', 'A', 'jdh_prescriptions', 'prescription_time', '1', '', 'After Meals'),
(464, '2023-08-24 18:27:49', '/jootidigitalhealthcare/jdhprescriptionsadd', '3', 'A', 'jdh_prescriptions', 'submitted_by_user_id', '1', '', '3'),
(465, '2023-08-24 18:27:49', '/jootidigitalhealthcare/jdhprescriptionsadd', '3', 'A', 'jdh_prescriptions', 'prescription_id', '1', '', '1'),
(466, '2023-08-24 18:33:57', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(467, '2023-08-24 18:34:00', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(468, '2023-08-24 18:39:45', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(469, '2023-08-24 18:39:50', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(470, '2023-08-24 18:39:56', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(471, '2023-08-24 18:40:05', '/jootidigitalhealthcare/login', '6', 'login', '::1', '', '', '', ''),
(472, '2023-08-24 18:42:12', '/jootidigitalhealthcare/logout', '6', 'logout', '::1', '', '', '', ''),
(473, '2023-08-24 18:46:49', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(474, '2023-08-24 18:57:45', '/jootidigitalhealthcare/jdhpatientvisitsadd', '1', 'A', 'jdh_patient_visits', 'patient_id', '5', '', '3'),
(475, '2023-08-24 18:57:45', '/jootidigitalhealthcare/jdhpatientvisitsadd', '1', 'A', 'jdh_patient_visits', 'visit_type_id', '5', '', '2'),
(476, '2023-08-24 18:57:45', '/jootidigitalhealthcare/jdhpatientvisitsadd', '1', 'A', 'jdh_patient_visits', 'doctor_id', '5', '', '9'),
(477, '2023-08-24 18:57:45', '/jootidigitalhealthcare/jdhpatientvisitsadd', '1', 'A', 'jdh_patient_visits', 'insurance_id', '5', '', '1'),
(478, '2023-08-24 18:57:45', '/jootidigitalhealthcare/jdhpatientvisitsadd', '1', 'A', 'jdh_patient_visits', 'visit_description', '5', '', 'Patient needs to be admitted.'),
(479, '2023-08-24 18:57:45', '/jootidigitalhealthcare/jdhpatientvisitsadd', '1', 'A', 'jdh_patient_visits', 'visit_id', '5', '', '5'),
(480, '2023-08-24 18:57:57', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(481, '2023-08-24 18:58:01', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(482, '2023-08-24 19:24:33', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(483, '2023-08-24 19:24:37', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(484, '2023-08-24 19:40:46', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(485, '2023-08-24 19:43:24', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(486, '2023-08-24 19:44:57', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(487, '2023-08-25 08:15:16', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(488, '2023-08-25 08:59:15', '/jootidigitalhealthcare/jdhpatientsedit/1', '1', 'U', 'jdh_patients', 'patient_registration_fees', '1', '0', '100'),
(489, '2023-08-25 08:59:27', '/jootidigitalhealthcare/jdhpatientsedit/2', '1', 'U', 'jdh_patients', 'patient_registration_fees', '2', '0', '100'),
(490, '2023-08-25 08:59:39', '/jootidigitalhealthcare/jdhpatientsedit/3', '1', 'U', 'jdh_patients', 'patient_registration_fees', '3', '0', '100'),
(491, '2023-08-25 09:13:49', '/jootidigitalhealthcare/jdhpatientsedit/1', '1', 'U', 'jdh_patients', 'service_id', '1', '100', '1'),
(492, '2023-08-25 09:14:03', '/jootidigitalhealthcare/jdhpatientsedit/2', '1', 'U', 'jdh_patients', 'service_id', '2', '100', '1'),
(493, '2023-08-25 09:14:12', '/jootidigitalhealthcare/jdhpatientsedit/3', '1', 'U', 'jdh_patients', 'service_id', '3', '100', '1'),
(494, '2023-08-25 09:44:09', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(495, '2023-08-25 11:12:46', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(496, '2023-08-25 11:13:12', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(497, '2023-08-25 11:14:06', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(498, '2023-08-25 14:07:10', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(499, '2023-08-25 14:07:19', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(500, '2023-08-25 14:13:30', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(501, '2023-08-25 14:13:32', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(502, '2023-08-25 14:14:27', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(503, '2023-08-25 16:41:18', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(504, '2023-08-25 19:14:33', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(505, '2023-08-25 19:14:45', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(506, '2023-08-25 19:20:52', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(507, '2023-08-25 19:20:55', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(508, '2023-08-25 19:22:29', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(509, '2023-08-25 19:22:36', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(510, '2023-08-25 19:32:27', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(511, '2023-08-25 19:32:32', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(512, '2023-08-25 19:34:20', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(513, '2023-08-25 19:34:24', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(514, '2023-08-25 19:38:58', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(515, '2023-08-25 19:39:07', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(516, '2023-08-25 19:41:22', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(517, '2023-08-25 19:41:25', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(518, '2023-08-25 19:46:58', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(519, '2023-08-25 19:47:02', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(520, '2023-08-25 19:56:57', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(521, '2023-08-25 19:57:04', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(522, '2023-08-25 20:05:41', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(523, '2023-08-25 20:05:47', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(524, '2023-08-25 20:07:28', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(525, '2023-08-25 20:07:37', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(526, '2023-08-25 20:13:23', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(527, '2023-08-25 20:13:26', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(528, '2023-08-25 20:16:33', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(529, '2023-08-25 20:16:46', '/jootidigitalhealthcare/login', '6', 'login', '::1', '', '', '', ''),
(530, '2023-08-25 20:23:58', '/jootidigitalhealthcare/logout', '6', 'logout', '::1', '', '', '', ''),
(531, '2023-08-25 20:24:23', '/jootidigitalhealthcare/login', '6', 'login', '::1', '', '', '', ''),
(532, '2023-08-25 20:24:34', '/jootidigitalhealthcare/logout', '6', 'logout', '::1', '', '', '', ''),
(533, '2023-08-25 20:24:42', '/jootidigitalhealthcare/login', '7', 'login', '::1', '', '', '', ''),
(534, '2023-08-25 20:28:12', '/jootidigitalhealthcare/logout', '7', 'logout', '::1', '', '', '', ''),
(535, '2023-08-25 20:28:21', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(536, '2023-08-25 20:32:53', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(537, '2023-08-25 20:33:00', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(538, '2023-08-25 20:41:17', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(539, '2023-08-25 20:41:27', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(540, '2023-08-25 20:52:40', '/jootidigitalhealthcare/jdhmedicinesedit/1', '1', 'U', 'jdh_medicines', 'expiry', '1', '0000-00-00', '2025-05-21'),
(541, '2023-08-25 21:11:31', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(542, '2023-08-25 21:11:33', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(543, '2023-08-26 05:00:33', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(544, '2023-08-26 05:23:26', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(545, '2023-08-26 05:23:50', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(546, '2023-08-26 07:55:31', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(547, '2023-08-26 08:01:22', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(548, '2023-08-26 13:18:24', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(549, '2023-08-26 13:21:24', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(550, '2023-08-26 13:21:33', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(551, '2023-08-26 13:27:38', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(552, '2023-08-26 13:27:43', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(553, '2023-08-26 13:27:51', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(554, '2023-08-26 13:28:16', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(555, '2023-08-26 13:30:17', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(556, '2023-08-26 13:30:20', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(557, '2023-08-26 13:30:52', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(558, '2023-08-26 13:31:11', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(559, '2023-08-26 13:34:02', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(560, '2023-08-26 13:34:08', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(561, '2023-08-26 13:51:15', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(562, '2023-08-26 14:08:52', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(563, '2023-08-26 14:29:23', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(564, '2023-08-26 14:29:27', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(565, '2023-08-26 14:29:59', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(566, '2023-08-26 20:06:10', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(567, '2023-08-26 20:10:27', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(568, '2023-08-26 20:10:34', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(569, '2023-08-26 20:13:25', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(570, '2023-08-26 20:13:45', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(571, '2023-08-26 20:14:06', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(572, '2023-08-26 20:14:16', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(573, '2023-08-26 20:14:54', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(574, '2023-08-26 20:15:08', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(575, '2023-08-26 20:22:08', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(576, '2023-08-26 20:22:11', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(577, '2023-08-26 20:22:16', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(578, '2023-08-26 20:22:33', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(579, '2023-08-26 20:26:05', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(580, '2023-08-26 20:26:12', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(581, '2023-08-26 20:27:09', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(582, '2023-08-26 20:27:17', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(583, '2023-08-26 20:28:10', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(584, '2023-08-26 20:28:15', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(585, '2023-08-26 20:28:32', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(586, '2023-08-27 11:37:21', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(587, '2023-08-27 11:37:59', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(588, '2023-08-27 11:38:08', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(589, '2023-08-27 11:39:20', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'patient_name', '4', '', 'Susan Rende'),
(590, '2023-08-27 11:39:20', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'patient_national_id', '4', '', '232434456'),
(591, '2023-08-27 11:39:20', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'patient_dob', '4', '', '2004-08-17'),
(592, '2023-08-27 11:39:20', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'patient_gender', '4', '', 'Female'),
(593, '2023-08-27 11:39:20', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'patient_phone', '4', '', '0722476500'),
(594, '2023-08-27 11:39:20', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'patient_kin_name', '4', '', 'Cathy Majiwa'),
(595, '2023-08-27 11:39:20', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'patient_kin_phone', '4', '', '0722959779'),
(596, '2023-08-27 11:39:20', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'service_id', '4', '', '1'),
(597, '2023-08-27 11:39:20', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'submitted_by_user_id', '4', '', '2'),
(598, '2023-08-27 11:39:20', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'patient_id', '4', '', '4'),
(599, '2023-08-27 11:39:46', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(600, '2023-08-27 11:40:01', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(601, '2023-08-27 11:41:10', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(602, '2023-08-27 11:43:40', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(603, '2023-08-27 11:44:59', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'patient_id', '6', '', '4'),
(604, '2023-08-27 11:44:59', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'visit_type_id', '6', '', '1'),
(605, '2023-08-27 11:44:59', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'user_id', '6', '', '9'),
(606, '2023-08-27 11:44:59', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'insurance_id', '6', '', NULL),
(607, '2023-08-27 11:44:59', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'visit_description', '6', '', 'This is a visit by Susan'),
(608, '2023-08-27 11:44:59', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'subbmitted_by_user_id', '6', '', '2'),
(609, '2023-08-27 11:44:59', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'visit_id', '6', '', '6'),
(610, '2023-08-27 11:46:30', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(611, '2023-08-27 11:46:38', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(612, '2023-08-27 12:54:31', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(613, '2023-08-27 12:54:37', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(614, '2023-08-27 12:56:07', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'patient_id', '7', '', '1'),
(615, '2023-08-27 12:56:07', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'visit_type_id', '7', '', '1'),
(616, '2023-08-27 12:56:07', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'user_id', '7', '', '9'),
(617, '2023-08-27 12:56:07', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'insurance_id', '7', '', NULL),
(618, '2023-08-27 12:56:07', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'visit_description', '7', '', 'Test visit'),
(619, '2023-08-27 12:56:07', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'subbmitted_by_user_id', '7', '', '2'),
(620, '2023-08-27 12:56:07', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'visit_id', '7', '', '7'),
(621, '2023-08-27 14:21:49', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(622, '2023-08-27 14:22:41', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(623, '2023-08-27 14:23:00', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(624, '2023-08-27 14:23:32', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(625, '2023-08-27 14:31:44', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(626, '2023-08-27 14:31:54', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(627, '2023-08-27 14:32:25', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(628, '2023-08-27 14:32:31', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(629, '2023-08-27 14:32:38', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(630, '2023-08-27 14:32:54', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(631, '2023-08-27 14:33:13', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(632, '2023-08-27 14:33:22', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(633, '2023-08-27 14:36:20', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(634, '2023-08-27 14:36:40', '/jootidigitalhealthcare/login', '6', 'login', '::1', '', '', '', ''),
(635, '2023-08-27 14:37:09', '/jootidigitalhealthcare/logout', '6', 'logout', '::1', '', '', '', ''),
(636, '2023-08-27 14:37:14', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(637, '2023-08-27 14:42:05', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(638, '2023-08-27 14:42:22', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(639, '2023-08-27 14:47:01', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(640, '2023-08-27 14:47:17', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(641, '2023-08-27 15:15:12', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(642, '2023-08-27 15:15:25', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(643, '2023-08-27 15:18:46', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(644, '2023-08-27 15:19:25', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(645, '2023-08-27 15:20:56', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(646, '2023-08-27 15:21:12', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(647, '2023-08-27 15:24:10', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(648, '2023-08-27 15:25:06', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(649, '2023-08-27 16:28:15', '/jootidigitalhealthcare/login', 'administrator@example.com', 'autologin', '::1', '', '', '', ''),
(650, '2023-08-27 16:54:02', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(651, '2023-08-27 16:54:17', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(652, '2023-08-27 16:55:58', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(653, '2023-08-27 17:00:26', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(654, '2023-08-27 19:02:46', '/jootidigitalhealthcare/login', 'receptionist@example.com', 'autologin', '::1', '', '', '', ''),
(655, '2023-08-27 19:05:37', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(656, '2023-08-28 17:33:40', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(657, '2023-08-28 17:41:14', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(658, '2023-08-28 17:41:17', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(659, '2023-08-28 17:44:58', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(660, '2023-08-28 17:45:04', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(661, '2023-08-28 17:49:24', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(662, '2023-08-28 17:49:29', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(663, '2023-08-28 17:57:57', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(664, '2023-08-28 17:58:17', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(665, '2023-08-28 18:04:55', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(666, '2023-08-28 18:05:23', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(667, '2023-08-28 18:14:52', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(668, '2023-08-28 18:15:05', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(669, '2023-08-28 18:32:35', '/jootidigitalhealthcare/jdhpatientsedit/1', '1', 'U', 'jdh_patients', 'inpatient_outpatient_status', '1', '0', '1'),
(670, '2023-08-28 18:32:35', '/jootidigitalhealthcare/jdhpatientsedit/1', '1', 'U', 'jdh_patients', 'submitted_by_user_id', '1', '2', '1'),
(671, '2023-08-28 18:32:48', '/jootidigitalhealthcare/jdhpatientsedit/2', '1', 'U', 'jdh_patients', 'inpatient_outpatient_status', '2', '0', '2'),
(672, '2023-08-28 18:32:48', '/jootidigitalhealthcare/jdhpatientsedit/2', '1', 'U', 'jdh_patients', 'submitted_by_user_id', '2', '2', '1'),
(673, '2023-08-28 18:33:51', '/jootidigitalhealthcare/jdhpatientsedit/3', '1', 'U', 'jdh_patients', 'inpatient_outpatient_status', '3', '0', '1'),
(674, '2023-08-28 18:33:52', '/jootidigitalhealthcare/jdhpatientsedit/3', '1', 'U', 'jdh_patients', 'submitted_by_user_id', '3', '2', '1'),
(675, '2023-08-28 18:34:01', '/jootidigitalhealthcare/jdhpatientsedit/4', '1', 'U', 'jdh_patients', 'inpatient_outpatient_status', '4', '0', '2'),
(676, '2023-08-28 18:34:01', '/jootidigitalhealthcare/jdhpatientsedit/4', '1', 'U', 'jdh_patients', 'submitted_by_user_id', '4', '2', '1'),
(677, '2023-08-28 18:39:05', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(678, '2023-08-28 18:39:27', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(679, '2023-08-28 18:42:37', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(680, '2023-08-28 18:42:41', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(681, '2023-08-28 19:03:21', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(682, '2023-08-28 19:04:41', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(683, '2023-08-28 19:24:21', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(684, '2023-08-28 19:24:32', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(685, '2023-08-28 19:31:35', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(686, '2023-08-28 19:31:55', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(687, '2023-08-28 19:32:18', '/jootidigitalhealthcare/jdhpatientsedit/2', '1', 'U', 'jdh_patients', 'is_inpatient', '2', '0', '1'),
(688, '2023-08-28 20:16:08', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(689, '2023-08-28 20:16:13', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(690, '2023-08-28 20:21:34', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(691, '2023-08-28 20:21:43', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(692, '2023-08-28 20:24:13', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(693, '2023-08-28 20:24:50', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(694, '2023-08-28 20:31:25', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(695, '2023-08-28 20:31:34', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(696, '2023-08-29 12:14:44', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(697, '2023-08-29 12:14:57', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(698, '2023-08-29 12:58:16', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(699, '2023-08-29 13:29:18', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(700, '2023-08-29 13:30:01', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(701, '2023-08-29 17:56:25', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(702, '2023-08-29 17:56:36', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(703, '2023-08-29 18:22:51', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(704, '2023-08-29 18:22:56', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(705, '2023-08-29 18:31:37', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(706, '2023-08-29 18:32:14', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(707, '2023-08-29 18:33:11', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(708, '2023-08-29 18:33:18', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(709, '2023-08-29 18:36:23', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(710, '2023-08-29 18:36:28', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(711, '2023-08-29 18:39:13', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(712, '2023-08-29 18:39:21', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(713, '2023-08-29 18:41:33', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(714, '2023-08-29 18:41:39', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(715, '2023-08-29 18:42:35', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'patient_name', '5', '', 'Mary Doe'),
(716, '2023-08-29 18:42:35', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'patient_national_id', '5', '', '334454'),
(717, '2023-08-29 18:42:35', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'patient_dob', '5', '', '1993-02-03'),
(718, '2023-08-29 18:42:35', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'patient_gender', '5', '', 'Female'),
(719, '2023-08-29 18:42:35', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'patient_phone', '5', '', '0712345678'),
(720, '2023-08-29 18:42:35', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'patient_kin_name', '5', '', 'None'),
(721, '2023-08-29 18:42:35', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'patient_kin_phone', '5', '', '0712345678'),
(722, '2023-08-29 18:42:35', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'service_id', '5', '', '1'),
(723, '2023-08-29 18:42:35', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'is_inpatient', '5', '', '0'),
(724, '2023-08-29 18:42:35', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'submitted_by_user_id', '5', '', '2'),
(725, '2023-08-29 18:42:35', '/jootidigitalhealthcare/jdhpatientsadd', '2', 'A', 'jdh_patients', 'patient_id', '5', '', '5'),
(726, '2023-08-29 18:47:16', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'patient_id', '8', '', '5'),
(727, '2023-08-29 18:47:17', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'visit_type_id', '8', '', '3'),
(728, '2023-08-29 18:47:17', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'user_id', '8', '', '9'),
(729, '2023-08-29 18:47:17', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'insurance_id', '8', '', '4'),
(730, '2023-08-29 18:47:17', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'visit_description', '8', '', 'Test Visit'),
(731, '2023-08-29 18:47:17', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'subbmitted_by_user_id', '8', '', '2'),
(732, '2023-08-29 18:47:17', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'visit_id', '8', '', '8'),
(733, '2023-08-29 18:53:54', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(734, '2023-08-29 18:53:58', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(735, '2023-08-29 18:55:17', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(736, '2023-08-29 18:55:21', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(737, '2023-08-29 18:58:23', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(738, '2023-08-29 18:58:29', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(739, '2023-08-29 19:04:13', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(740, '2023-08-29 19:04:16', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(741, '2023-08-29 19:09:34', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(742, '2023-08-29 19:09:38', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(743, '2023-08-29 19:09:55', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'patient_id', '3', '', '2'),
(744, '2023-08-29 19:09:55', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'chief_compaints', '3', '', 'sddsss'),
(745, '2023-08-29 19:09:55', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'addedby_user_id', '3', '', '4'),
(746, '2023-08-29 19:09:55', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'id', '3', '', '3'),
(747, '2023-08-29 19:10:21', '/jootidigitalhealthcare/jdhchiefcomplaintsedit/3', '4', 'U', 'jdh_chief_complaints', 'chief_compaints', '3', 'sddsss', 'Some chest pain'),
(748, '2023-08-29 19:13:33', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(749, '2023-08-29 19:13:38', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(750, '2023-08-29 19:16:37', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(751, '2023-08-29 19:16:48', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(752, '2023-08-29 19:19:19', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(753, '2023-08-29 19:19:24', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(754, '2023-08-29 19:20:20', '/jootidigitalhealthcare/jdhchiefcomplaintsedit/3', '4', 'U', 'jdh_chief_complaints', 'chief_compaints', '3', 'Some chest pain', 'Some chest pain...'),
(755, '2023-08-29 19:27:00', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(756, '2023-08-29 19:27:12', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(757, '2023-08-29 19:28:22', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(758, '2023-08-29 19:28:27', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(759, '2023-08-29 19:30:08', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(760, '2023-08-29 19:30:15', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(761, '2023-08-29 19:31:33', '/jootidigitalhealthcare/jdhpatientsedit/5', '2', 'U', 'jdh_patients', 'is_inpatient', '5', '0', '1'),
(762, '2023-08-29 19:41:49', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(763, '2023-08-29 19:42:02', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(764, '2023-08-29 19:42:26', '/jootidigitalhealthcare/jdhpatientvisitsadd', '1', 'A', 'jdh_patient_visits', 'patient_id', '9', '', '1'),
(765, '2023-08-29 19:42:26', '/jootidigitalhealthcare/jdhpatientvisitsadd', '1', 'A', 'jdh_patient_visits', 'visit_type_id', '9', '', '2'),
(766, '2023-08-29 19:42:26', '/jootidigitalhealthcare/jdhpatientvisitsadd', '1', 'A', 'jdh_patient_visits', 'user_id', '9', '', '10'),
(767, '2023-08-29 19:42:26', '/jootidigitalhealthcare/jdhpatientvisitsadd', '1', 'A', 'jdh_patient_visits', 'insurance_id', '9', '', NULL),
(768, '2023-08-29 19:42:26', '/jootidigitalhealthcare/jdhpatientvisitsadd', '1', 'A', 'jdh_patient_visits', 'visit_description', '9', '', 'hujhjuhuh'),
(769, '2023-08-29 19:42:26', '/jootidigitalhealthcare/jdhpatientvisitsadd', '1', 'A', 'jdh_patient_visits', 'visit_id', '9', '', '9'),
(770, '2023-08-29 19:45:32', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(771, '2023-08-29 19:45:39', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(772, '2023-08-29 19:48:13', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(773, '2023-08-29 19:48:38', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(774, '2023-08-29 19:56:00', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(775, '2023-08-29 19:56:13', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(776, '2023-08-29 19:59:46', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '1', 'A', 'jdh_chief_complaints', 'patient_id', '4', '', '1'),
(777, '2023-08-29 19:59:46', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '1', 'A', 'jdh_chief_complaints', 'chief_compaints', '4', '', 'ddsdsf'),
(778, '2023-08-29 19:59:46', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '1', 'A', 'jdh_chief_complaints', 'id', '4', '', '4'),
(779, '2023-08-29 20:00:00', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(780, '2023-08-29 20:00:07', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(781, '2023-08-29 20:10:06', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(782, '2023-08-29 20:10:10', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(783, '2023-08-29 20:22:42', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(784, '2023-08-29 20:22:53', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(785, '2023-08-29 20:23:10', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(786, '2023-08-29 20:23:19', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(787, '2023-08-29 20:26:43', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(788, '2023-08-29 20:28:15', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(789, '2023-08-29 20:28:27', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(790, '2023-08-29 20:35:23', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(791, '2023-08-29 20:37:38', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(792, '2023-08-29 20:38:07', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(793, '2023-08-29 20:38:17', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(794, '2023-08-29 20:40:56', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(795, '2023-08-29 20:41:07', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(796, '2023-08-29 20:43:41', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(797, '2023-08-29 20:43:45', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(798, '2023-08-29 20:44:19', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'patient_id', '10', '', '2'),
(799, '2023-08-29 20:44:19', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'visit_type_id', '10', '', '1'),
(800, '2023-08-29 20:44:19', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'user_id', '10', '', '9'),
(801, '2023-08-29 20:44:19', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'insurance_id', '10', '', '2'),
(802, '2023-08-29 20:44:19', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'visit_description', '10', '', 'ewrrert frfrtr'),
(803, '2023-08-29 20:44:19', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'subbmitted_by_user_id', '10', '', '2'),
(804, '2023-08-29 20:44:19', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'visit_id', '10', '', '10'),
(805, '2023-08-29 20:47:16', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(806, '2023-08-29 20:47:20', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(807, '2023-08-29 20:48:09', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'patient_id', '11', '', '4'),
(808, '2023-08-29 20:48:09', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'visit_type_id', '11', '', '2'),
(809, '2023-08-29 20:48:09', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'user_id', '11', '', '10'),
(810, '2023-08-29 20:48:09', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'insurance_id', '11', '', '4'),
(811, '2023-08-29 20:48:09', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'visit_description', '11', '', 'Emergency operation'),
(812, '2023-08-29 20:48:09', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'subbmitted_by_user_id', '11', '', '2'),
(813, '2023-08-29 20:48:09', '/jootidigitalhealthcare/jdhpatientvisitsadd', '2', 'A', 'jdh_patient_visits', 'visit_id', '11', '', '11'),
(814, '2023-08-29 20:48:58', '/jootidigitalhealthcare/jdhappointmentsadd', '2', 'A', 'jdh_appointments', 'patient_id', '6', '', '4'),
(815, '2023-08-29 20:48:58', '/jootidigitalhealthcare/jdhappointmentsadd', '2', 'A', 'jdh_appointments', 'appointment_title', '6', '', 'Susan\'s Appointment with Dr. Miriti'),
(816, '2023-08-29 20:48:58', '/jootidigitalhealthcare/jdhappointmentsadd', '2', 'A', 'jdh_appointments', 'appointment_start_date', '6', '', '2023-08-30 23:48:00'),
(817, '2023-08-29 20:48:58', '/jootidigitalhealthcare/jdhappointmentsadd', '2', 'A', 'jdh_appointments', 'appointment_end_date', '6', '', '2023-08-30 23:48:00'),
(818, '2023-08-29 20:48:58', '/jootidigitalhealthcare/jdhappointmentsadd', '2', 'A', 'jdh_appointments', 'appointment_all_day', '6', '', '1'),
(819, '2023-08-29 20:48:58', '/jootidigitalhealthcare/jdhappointmentsadd', '2', 'A', 'jdh_appointments', 'appointment_description', '6', '', 'Susan\'s appointment'),
(820, '2023-08-29 20:48:58', '/jootidigitalhealthcare/jdhappointmentsadd', '2', 'A', 'jdh_appointments', 'subbmitted_by_user_id', '6', '', '2'),
(821, '2023-08-29 20:48:58', '/jootidigitalhealthcare/jdhappointmentsadd', '2', 'A', 'jdh_appointments', 'appointment_id', '6', '', '6'),
(822, '2023-08-29 20:49:25', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(823, '2023-08-29 20:49:33', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(824, '2023-08-29 20:50:31', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'patient_id', '5', '', '1'),
(825, '2023-08-29 20:50:31', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'chief_compaints', '5', '', 'Another test complaint'),
(826, '2023-08-29 20:50:31', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'addedby_user_id', '5', '', '4'),
(827, '2023-08-29 20:50:31', '/jootidigitalhealthcare/jdhchiefcomplaintsadd', '4', 'A', 'jdh_chief_complaints', 'id', '5', '', '5'),
(828, '2023-08-29 20:53:15', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(829, '2023-08-29 20:53:33', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(830, '2023-08-29 20:57:17', '/jootidigitalhealthcare/jdhpatientcasesadd', '3', 'A', 'jdh_patient_cases', 'patient_id', '2', '', '3'),
(831, '2023-08-29 20:57:17', '/jootidigitalhealthcare/jdhpatientcasesadd', '3', 'A', 'jdh_patient_cases', 'history', '2', '', 'Testing..'),
(832, '2023-08-29 20:57:17', '/jootidigitalhealthcare/jdhpatientcasesadd', '3', 'A', 'jdh_patient_cases', 'random_blood_sugar', '2', '', 'Testing..4567'),
(833, '2023-08-29 20:57:17', '/jootidigitalhealthcare/jdhpatientcasesadd', '3', 'A', 'jdh_patient_cases', 'medical_history', '2', '', 'sddfgrtr  rtrytt tu'),
(834, '2023-08-29 20:57:17', '/jootidigitalhealthcare/jdhpatientcasesadd', '3', 'A', 'jdh_patient_cases', 'family', '2', '', 'ddsf sdsdfdf dsdsf'),
(835, '2023-08-29 20:57:17', '/jootidigitalhealthcare/jdhpatientcasesadd', '3', 'A', 'jdh_patient_cases', 'socio_economic_history', '2', '', 'sddsd sdsdsf tuyio uo0p0o'),
(836, '2023-08-29 20:57:17', '/jootidigitalhealthcare/jdhpatientcasesadd', '3', 'A', 'jdh_patient_cases', 'notes', '2', '', 'ewee rytyuio op[p'),
(837, '2023-08-29 20:57:17', '/jootidigitalhealthcare/jdhpatientcasesadd', '3', 'A', 'jdh_patient_cases', 'submitted_by_user_id', '2', '', '3'),
(838, '2023-08-29 20:57:17', '/jootidigitalhealthcare/jdhpatientcasesadd', '3', 'A', 'jdh_patient_cases', 'case_id', '2', '', '2'),
(839, '2023-08-29 20:58:50', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(840, '2023-08-29 20:59:01', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(841, '2023-08-29 21:00:16', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(842, '2023-08-29 21:00:27', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(843, '2023-08-29 21:09:14', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(844, '2023-08-29 21:09:33', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(845, '2023-08-29 21:13:13', '/jootidigitalhealthcare/jdhtestrequestsadd', '3', 'A', 'jdh_test_requests', 'patient_id', '3', '', '4'),
(846, '2023-08-29 21:13:13', '/jootidigitalhealthcare/jdhtestrequestsadd', '3', 'A', 'jdh_test_requests', 'request_title', '3', '', 'Susan ANC Profile Test'),
(847, '2023-08-29 21:13:13', '/jootidigitalhealthcare/jdhtestrequestsadd', '3', 'A', 'jdh_test_requests', 'request_service_id', '3', '', '20'),
(848, '2023-08-29 21:13:13', '/jootidigitalhealthcare/jdhtestrequestsadd', '3', 'A', 'jdh_test_requests', 'request_description', '3', '', 'This is first test'),
(849, '2023-08-29 21:13:13', '/jootidigitalhealthcare/jdhtestrequestsadd', '3', 'A', 'jdh_test_requests', 'requested_by_user_id', '3', '', '3'),
(850, '2023-08-29 21:13:13', '/jootidigitalhealthcare/jdhtestrequestsadd', '3', 'A', 'jdh_test_requests', 'request_id', '3', '', '3'),
(851, '2023-08-29 21:14:05', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(852, '2023-08-29 21:14:11', '/jootidigitalhealthcare/login', '7', 'login', '::1', '', '', '', ''),
(853, '2023-08-29 21:16:26', '/jootidigitalhealthcare/logout', '7', 'logout', '::1', '', '', '', ''),
(854, '2023-08-29 21:16:34', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(855, '2023-08-29 21:20:08', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(856, '2023-08-29 21:20:13', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(857, '2023-08-29 21:20:53', '/jootidigitalhealthcare/jdhexaminationfindingsadd', '3', 'A', 'jdh_examination_findings', 'patient_id', '2', '', '1'),
(858, '2023-08-29 21:20:53', '/jootidigitalhealthcare/jdhexaminationfindingsadd', '3', 'A', 'jdh_examination_findings', 'general_exams', '2', '', 'ereree'),
(859, '2023-08-29 21:20:53', '/jootidigitalhealthcare/jdhexaminationfindingsadd', '3', 'A', 'jdh_examination_findings', 'systematic_exams', '2', '', 'ewewewe'),
(860, '2023-08-29 21:20:53', '/jootidigitalhealthcare/jdhexaminationfindingsadd', '3', 'A', 'jdh_examination_findings', 'submitted_by_user_id', '2', '', '3'),
(861, '2023-08-29 21:20:53', '/jootidigitalhealthcare/jdhexaminationfindingsadd', '3', 'A', 'jdh_examination_findings', 'id', '2', '', '2'),
(862, '2023-08-29 21:21:27', '/jootidigitalhealthcare/jdhexaminationfindingsadd', '3', 'A', 'jdh_examination_findings', 'patient_id', '3', '', '1'),
(863, '2023-08-29 21:21:27', '/jootidigitalhealthcare/jdhexaminationfindingsadd', '3', 'A', 'jdh_examination_findings', 'general_exams', '3', '', 'hjhgvbv'),
(864, '2023-08-29 21:21:27', '/jootidigitalhealthcare/jdhexaminationfindingsadd', '3', 'A', 'jdh_examination_findings', 'systematic_exams', '3', '', 'uityty66'),
(865, '2023-08-29 21:21:27', '/jootidigitalhealthcare/jdhexaminationfindingsadd', '3', 'A', 'jdh_examination_findings', 'submitted_by_user_id', '3', '', '3'),
(866, '2023-08-29 21:21:27', '/jootidigitalhealthcare/jdhexaminationfindingsadd', '3', 'A', 'jdh_examination_findings', 'id', '3', '', '3'),
(867, '2023-08-29 21:22:30', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(868, '2023-08-29 21:22:37', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(869, '2023-08-29 21:27:35', '/jootidigitalhealthcare/jdhtestrequestsedit/3', '5', 'U', 'jdh_test_requests', 'status_id', '3', '0', '1'),
(870, '2023-08-29 21:30:33', '/jootidigitalhealthcare/jdhtestreportsadd', '5', 'A', 'jdh_test_reports', 'request_id', '3', '', '3'),
(871, '2023-08-29 21:30:33', '/jootidigitalhealthcare/jdhtestreportsadd', '5', 'A', 'jdh_test_reports', 'patient_id', '3', '', '4'),
(872, '2023-08-29 21:30:33', '/jootidigitalhealthcare/jdhtestreportsadd', '5', 'A', 'jdh_test_reports', 'report_findings', '3', '', 'These are test findings for ANC profile'),
(873, '2023-08-29 21:30:33', '/jootidigitalhealthcare/jdhtestreportsadd', '5', 'A', 'jdh_test_reports', 'report_submittedby_user_id', '3', '', '5'),
(874, '2023-08-29 21:30:33', '/jootidigitalhealthcare/jdhtestreportsadd', '5', 'A', 'jdh_test_reports', 'report_id', '3', '', '3'),
(875, '2023-08-29 21:31:22', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(876, '2023-08-29 21:31:37', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(877, '2023-08-29 21:33:59', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(878, '2023-08-29 21:34:07', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(879, '2023-08-29 21:34:12', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(880, '2023-08-29 21:34:23', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(881, '2023-08-29 21:35:14', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(882, '2023-08-29 21:36:53', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(883, '2023-08-29 21:39:02', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', '');
INSERT INTO `jdh_audittrail` (`Id`, `DateTime`, `Script`, `User`, `Action`, `Table`, `Field`, `KeyValue`, `OldValue`, `NewValue`) VALUES
(884, '2023-08-29 21:39:09', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(885, '2023-08-29 21:39:32', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(886, '2023-08-30 16:55:25', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(887, '2023-08-30 16:56:07', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(888, '2023-08-30 17:02:01', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(889, '2023-08-30 17:57:33', '/jootidigitalhealthcare/login', 'nurse@example.com', 'autologin', '::1', '', '', '', ''),
(890, '2023-08-30 17:57:46', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(891, '2023-08-30 17:57:53', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(892, '2023-08-30 18:00:10', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(893, '2023-09-05 07:04:44', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(894, '2023-09-08 16:32:33', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(895, '2023-09-11 15:30:33', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(896, '2023-09-11 19:16:28', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(897, '2023-09-11 19:17:33', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(898, '2023-09-11 19:19:57', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(899, '2023-09-11 19:37:38', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(900, '2023-09-11 20:10:36', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(901, '2023-09-11 20:12:26', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(902, '2023-09-11 20:15:18', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(903, '2023-09-11 20:15:36', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(904, '2023-09-11 20:19:25', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(905, '2023-09-11 20:19:31', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(906, '2023-09-11 20:29:43', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(907, '2023-09-12 08:15:39', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(908, '2023-09-12 08:17:00', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(909, '2023-09-12 08:17:11', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(910, '2023-09-12 08:25:52', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(911, '2023-09-12 08:26:01', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(912, '2023-09-12 08:27:51', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(913, '2023-09-12 08:28:03', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(914, '2023-09-12 11:03:42', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(915, '2023-09-12 12:29:15', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(916, '2023-09-16 08:06:07', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(917, '2023-09-16 08:09:38', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(918, '2023-09-19 11:44:51', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(919, '2023-09-25 09:12:11', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(920, '2023-09-25 13:23:23', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(921, '2023-09-25 13:23:31', '/jootidigitalhealthcare/login', '4', 'login', '::1', '', '', '', ''),
(922, '2023-09-25 13:24:16', '/jootidigitalhealthcare/logout', '4', 'logout', '::1', '', '', '', ''),
(923, '2023-09-25 13:24:23', '/jootidigitalhealthcare/login', '2', 'login', '::1', '', '', '', ''),
(924, '2023-09-25 13:25:55', '/jootidigitalhealthcare/logout', '2', 'logout', '::1', '', '', '', ''),
(925, '2023-09-25 13:26:03', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(926, '2023-09-26 08:35:26', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(927, '2023-09-26 08:37:19', '/jootidigitalhealthcare/login', '5', 'login', '::1', '', '', '', ''),
(928, '2023-09-26 08:38:00', '/jootidigitalhealthcare/logout', '5', 'logout', '::1', '', '', '', ''),
(929, '2023-09-27 07:47:42', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(930, '2023-09-27 07:49:46', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(931, '2023-09-27 07:53:24', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(932, '2023-09-27 08:01:11', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(933, '2023-09-27 09:18:50', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(934, '2023-09-28 09:20:19', '/jootidigitalhealthcare/index', 'administrator@example.com', 'autologin', '::1', '', '', '', ''),
(935, '2023-09-30 07:09:44', '/jootidigitalhealthcare/jdhtestreportsview/1', 'administrator@example.com', 'autologin', '::1', '', '', '', ''),
(936, '2023-09-30 07:19:17', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(937, '2023-09-30 07:19:33', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(938, '2023-09-30 07:27:11', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(939, '2023-09-30 07:27:33', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(940, '2023-09-30 07:29:16', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(941, '2023-09-30 07:29:27', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(942, '2023-09-30 07:30:12', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(943, '2023-09-30 07:30:16', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(944, '2023-09-30 08:10:18', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(945, '2023-09-30 08:14:30', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(946, '2023-09-30 08:15:05', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(947, '2023-09-30 08:25:32', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(948, '2023-09-30 08:27:00', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(949, '2023-09-30 08:27:05', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(950, '2023-09-30 08:27:26', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(951, '2023-09-30 08:29:21', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(952, '2023-09-30 08:32:19', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(953, '2023-09-30 08:32:27', '/jootidigitalhealthcare/login', '7', 'login', '::1', '', '', '', ''),
(954, '2023-09-30 08:41:07', '/jootidigitalhealthcare/logout', '7', 'logout', '::1', '', '', '', ''),
(955, '2023-09-30 08:41:11', '/jootidigitalhealthcare/login', '7', 'login', '::1', '', '', '', ''),
(956, '2023-09-30 08:43:42', '/jootidigitalhealthcare/logout', '7', 'logout', '::1', '', '', '', ''),
(957, '2023-10-05 07:15:54', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(958, '2023-10-05 07:23:32', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(959, '2023-10-05 07:23:38', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(960, '2023-10-06 11:18:18', '/jootidigitalhealthcare/jdhtestreportsview/1', 'administrator@example.com', 'autologin', '::1', '', '', '', ''),
(961, '2023-10-08 09:46:05', '/jootidigitalhealthcare/index', 'administrator@example.com', 'autologin', '::1', '', '', '', ''),
(962, '2023-10-10 13:13:25', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', ''),
(963, '2023-10-10 13:13:45', '/jootidigitalhealthcare/logout', '1', 'logout', '::1', '', '', '', ''),
(964, '2023-10-10 13:13:53', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(965, '2023-10-10 13:14:33', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(966, '2023-10-10 13:14:43', '/jootidigitalhealthcare/login', '3', 'login', '::1', '', '', '', ''),
(967, '2023-10-10 13:15:38', '/jootidigitalhealthcare/logout', '3', 'logout', '::1', '', '', '', ''),
(968, '2023-10-10 13:15:47', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_beds`
--

DROP TABLE IF EXISTS `jdh_beds`;
CREATE TABLE IF NOT EXISTS `jdh_beds` (
  `id` int NOT NULL AUTO_INCREMENT,
  `facility_id` int NOT NULL,
  `ward_id` int NOT NULL,
  `bed_number` int NOT NULL,
  `assigned` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_beds`
--

INSERT INTO `jdh_beds` (`id`, `facility_id`, `ward_id`, `bed_number`, `assigned`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 1, 2, 0),
(3, 2, 2, 1, 0),
(4, 2, 2, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jdh_branding`
--

DROP TABLE IF EXISTS `jdh_branding`;
CREATE TABLE IF NOT EXISTS `jdh_branding` (
  `id` int NOT NULL AUTO_INCREMENT,
  `header_image` mediumblob,
  `footer_image` mediumblob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_branding`
--

INSERT INTO `jdh_branding` (`id`, `header_image`, `footer_image`) VALUES
(1, 0xffd8ffe000104a46494600010101004800480000ffe201d84943435f50524f46494c45000101000001c800000000043000006d6e74725247422058595a2007e00001000100000000000061637370000000000000000000000000000000000000000000000000000000010000f6d6000100000000d32d0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000964657363000000f0000000247258595a00000114000000146758595a00000128000000146258595a0000013c00000014777470740000015000000014725452430000016400000028675452430000016400000028625452430000016400000028637072740000018c0000003c6d6c756300000000000000010000000c656e5553000000080000001c007300520047004258595a200000000000006fa2000038f50000039058595a2000000000000062990000b785000018da58595a2000000000000024a000000f840000b6cf58595a20000000000000f6d6000100000000d32d706172610000000000040000000266660000f2a700000d59000013d000000a5b00000000000000006d6c756300000000000000010000000c656e5553000000200000001c0047006f006f0067006c006500200049006e0063002e00200032003000310036ffdb0043000a07070807060a0808080b0a0a0b0e18100e0d0d0e1d15161118231f2524221f2221262b372f26293429212230413134393b3e3e3e252e4449433c48373d3e3bffdb0043010a0b0b0e0d0e1c10101c3b2822283b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3bffc000110800c8078003012200021101031101ffc4001c0001000203010101000000000000000000000506030407020108ffc4005e100001040102030405040e020e050b05000100020304050611122131071341511422617181327491b21516233536374252727375a1b1b334620817243343535556929395c1d1d37682c3d2e12526444654638394a2c2f16484b4c4f0ffc4001b01010002030101000000000000000000000002030104060507ffc400301101000202010304020004050500000000000102031104122131051322513241142361710615334291245281a1b1ffda000c03010002110311003f00ecc8888088b532178538c6c389ee3b342cc44ccea11b5a2b1b96d17068dc903debc19e21d646fd2a2a3af66dbb8ec4aed8fe4b7900b6463a20ddb849f8a9cd6b1e654466b5bbd6bd9bad918ff92f07dc57b50d2639f192eaf23d87deb252ca384a2b5bd9b27e49fce599c7db759d95cfb9e9b4692a8be1700372792d09f2d131dc108ef5fe41422b33e17daf5ac6e6520bc3a58d9f29e07c545f1e42d7522169f2eab2478e693bcae7bcf992a5d111e6547bfd53aac33c994ad19db7738f9342c273959ae01cc95a09db72d5b2dab133a46dfa14666d8d6542401c8853a452d3a432e4cb48eaec9b0439a08e854464752d3c74fdc3c3dcfdb7d8052558ef5633fd50b9e665c64ccd827c0eca8bda31d66d3fa6b7a9f32fc6c316a799584eb6ac1dfd1dfb79acf16b3c6bf93bbc69fd154b2d1e4bc18c792f3a9eab826dab439eafae72627bebfe1d161d418c980e1b206fe046cb7a3b304c378e56bbdc5729743e5d57d8ec5baaf0f8a67b48e9b15e9e2c9c7cd1f1b37b17af4cfe75ff00875a454fc16ae748f6d6ba06e7907ab259c8470441cd21ce77c91e6a56c56ace9ef61e5e2cd4ebacb6dce6b46ee200f6ac0ebd59876328dfdcb41b04f69dc761e763d1a3905b428c5c3b7760fbd67a6b1e659f76d6fc619d96e090ecc9412b328ab18c63f9b378dc3a169d96bc190b18fb2daf6ddc7138ec243e09edc4c7c6588cf313abc693a8be021c371cc15f554da1111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101157b526b9c0e93b10c198b324324ec2f606c4e7ee01dbc029d826659af1cf11de39581ed3b6db8237083222220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220f84ec37f250f09f4dbcf98f36b79354b4bfde9fb791513833bd7dfc77e6ada76accb573ceed5afda518dd82f4422fa153e5b111a7cd86ca1b39543eb991bc9ece6085327aad4bfb7a33f7f25662b4d6ca39148b5105532be98c86bba5ddee1cc6fcf929faf5638dbeab42a1611a5da85c5bd038ae8918f502bb37c7b435f8ff0039dd9f43405f765f7c17cdf63b2d5d3d0ed0fbd143e7ff00a11f7852e5ca1f36e6be011efcc90aec3f94357953f0d256aff458ff00442e7d9c68666ac7b4eeba1571c35e31e4d0a89aaa27419873cb766bda362b5f3527263b56af33d6e936e2c4c7ea516be2f22469f15eb75c6e7e2e4c76dda1c4cd660d917d5f1538b2da96dc4912d79b78ded78ea15c74e092e44d9e6e7b720a9f6f9341577d28e69c731777c4cf37c10e87d23bce9606b005eb6d8af80afa4ac797651115080a3f2b544f55e36e7b7252039ac16886c2edd4b1ccc5e34a73445b1ced87093f7f8e66e772cf54fc148286d35ce94a7c3be729953c91abcc2586778e2444455ad1111011110111101111011110111101111011110111101111011110111101116292c410bd8c9668e373cecc0e7005c7d9e6832a222022220222c535882b80679a38838ec0bdc1bb9f8a0ca888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888838676fff007f313f367fd65d9b0df78e87cda3faa1719edffefe627e6cff00acbb361bef1d0f9b47f5420dd44440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044441f08dc11e6a0a9bbd0f212d577204f137dca7944e729be480598394d173e5e215b8a637d33fb6bf229335ea8f30920eddbbafa0aad63752c4fda29c86bdbc8eea5465ea91bf7cdfa52f86f12863e55261bee3b284d4579b5a83f9fac4725e6fea3a9558769039db740ab2e75cd4373621ddc82a78f1ebbcaacd9bafb436f48d473e775a7789dd5e59d14762f1f1d1acd8d8d0360a447450cb7dcade3d26b0fabe38ec375f560b72f75039de415711b9d362d6888db4ef5f731c2084174aee802f35712e7c827b8ee27efb86f80593175f8b7b523777bfa6fe0149ab6d6e9f8d5463c5d7f3bbe01b0d969e4b175f27018e66827c0f92dd45544cc4ee1b17a56f5e9b46e1cd333819b16f2e078a3df915a103f88735d2f3351b6b1d2b0b773c2b9ab586299ec23983b2a79d5ae4c13698ef0e2fd5b875e3db74f12c8888b84fdbc062b0de266ca7349e49b11f4679e7bf2510402362b58892bca268496b81f05d67a5f2abd1d12f4b83c8f6aeeb0d21c392f4552f15ab40688ec1d8f453cccfd47341ef5a3de57af38b7de1da62e762bd52dd0289cdde657a8e1bfac42d3bdaa6b4119e07071f62d3c5569b505b16ec6e2bb0faadf357e2c3d3f3b78843267f77f978fcca7b4f57757c5b38fe53fd63f1528bcb5a18d0d68d80e8bd2d7b5baad32dfa57a2b15fa11114531111011110416b5ce59d37a46fe5e9c71493d66b4b1b30258777b5bcc020f43e6b8e7f6fad55fe4fc47fa997fe62efb2c314f13a29a36491bbab1ed041f815abf61b15fe4ca7fea1bff041c33fb7d6aaff0027e23fd4cbff00313fb7d6aaff0027e23fd4cbff003157bb4f86283b45cbc50c6c8e36bd9b318d000fb9b7c02fd1b470f8b38fae4e36a12626ee4c0df21ec4154ecb75e6535bb326ec9d7a909a66211fa331cddf8b8f7df89c7f342e65a1f546a1b7da2e36ad9cee4a7aefb45ae8a4b72398e1b1e4413b10bf42d7a756a717a356860e2f95ddc61bbfbf65f97349e4eae1b5e53c95d79657ad61cf91c06e7600f820fd548b87653b7dc8bac3c6230f5a3801f51d6cb9ee23cc869007bb73ef5bda7bb796cf6e3af9fc647046f201b355c4867b4b0ee76f71f8141d8d1798e464b1b658ded7b1e039ae69dc381e841505ab759e2346d16d8c94ae3249bf735e31bc9291e43c07992827d1709b9dbee69f393470f4618b7e4d9cbe477d20b7f829bd33dbad4bb6595750d16d2e33b0b3038ba307facd3cc0f6825075b45e639192c6d9237b5ec780e6b9a77041e8415e90156f576bbc2e8dac1d9094c96641bc5562d8c8ff006fb07b4fc3752b9bcac383c25ccad81bc75217485a0ec5db0e407b49d87c57e69c651cc7697ad8b259b7b16de649e62376c318ebcbc80d801ee082cf91eddf515898fa051a3522f00e6ba47fc4ee07ee5f2876f1a92078f4da342dc7e3b31d1b8fc4123f72eb7a7f4069ad395991d4c6432cc07ad66c3049238f9ee7a7b86c16e65b49e9fce5674190c4d598386dc5dd86bdbee70e63e0504568bed1b0dacda61afc556fb1bc4fab291b91e25a7f287d07d8aa1dbae5f278a760fec7646dd3ef058e3f479dd1f16dddedbec46fb6e7e9567d1dd97e1b47e467c844f7dcb2e7115e499a378187c07f5bc0bbcbcb9ef4cfec84f97a7fdd63fec905dbb27bb6b21d9ed1b376ccd66673e50e92690bdc7691c06e4f35cd3b4ed1bab327af6c59af8eb57ebd8e015a489a5cc634340e127a3363bf5dbcfc5745ec73f16b8ffd64dfcc7282d7ddabe5b496a99713528539a2646c787cbc7c5bb86fe0420e85a6aa5ea1a6b1d53272f7b721aec64cfe2df7701cf9f8f96fe2a4d6ae2ed3ef62a9dc91a1afb10324706f405cd0797d2b9449db4dfabaca5c55da7461c7c179d04b3ecf2e6c6d7969775ebb0f241d851715cd76f9605973305888bb969d9b2dc2497fb785a46df495f70bdbe4c6cb23ce622210b8ece9aa3882cf6f0b89dfe9083b4ae21db0e95d4f96d5b15ba542d5fa4e85ac8440d2f111fca040e9b9e7bf4e7ec5da6a5baf7aa436eacad9a09d81f1c8d3c9cd2370573aed27b4cc9e8acf56c7d2a55278e6aa262e9b8b704b9c36e4472f5505ab41e372788d178da1987975c86321e0bb88b07112d6efe3b3481f0561515a632b2e734ce3f293c6c8e5b703647319bf0827cb7540d57db757c364ec637178a7d99ab4863925b0e31b4381d880ddb73cfcf641d5117046f6f9a884bbbb178c31fe686c80fd3c5fee57ed0ddab63757da18e9eb9c7e4082591b9fc4c976ebc2ed873f1d88fa505f51797bb858e70f01bae3380edd6cd9cb323ce53a7568863dd2490b5e5fb8692d00127993b0f8a0ed08b8764fb7ec93ac386270f562841f54da739ee70f321a401eee7ef525a6fb778ad5d8aae7f1d1d5648e0df4aaef25ac3e6e69e7b7b77f820ebe8be35c1ed0e6905a46e083c8ae6dad7b64a3a73212e2f1750642e4278667b9fc3146ef16f2e6e23c7a6de7e083a522e083b7cd45de6e7178ceeff37864dfe9e2ff0072bdf67bda7c9ad6f4b8f9b0efad3431191d34527147b6e073df620f3e5d5074044441c93b40ed5f3da5356d8c450a98e920898c7074f1bcbb773413cc3c0f1f25d3b0d724c8e0e85e99ad6c966b472bc306cd05cd04edbf8735f9ebb66fc645dfd543f502efba5ff04f0ff3083f96d412ab96f695da766f46ea4871b8eab42585f55b317588dee7711738783c0dbd51e0ba92fcf9dbbfe1d56fd9f1fd791076cd2b959f39a5f1d94b4c8d935a81b23db1021a09f2dc93fbd4baadf677f8bec27cd1aa91adfb5dcc697d5f7b0d571f4a686b777c2f978f88f146d71df63b75720eb68b1d790cb5e390800bd81c40f68503aef5159d2ba4ece62a4314d2c2e600c977e13c4e0d3d08f341625cafb71cc653134f0eec664add232492879ad3ba3e2d8376df848dfaa96ecc75fe435c3b262f54ad5fd0c45c1dc717adc5c7befb93f9a1577fb20bfa0e0ff5b37f0620b4764390bb93d09159bf727b739b12032cf2191db03c86e4eeaf0b81692ed4aa68dd09063abd437722e9e479638f0c71b49e449f127c87d21648bb7dcf89f79b138e7c5bfc96778d76def2e3fc107794552d15da361f5a31d0c01d56fc6de292aca773b79b4fe50fa0fb15b50111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111070cedff00efe627e6cffacbb361bef1d0f9b47f542e33dbff00dfcc4fcd9ff59766c37de3a1f368fea841ba888808888088880888808a9925cd4996d6799c563b335f1d5b1d1d77343e889cbcc8d24f3e26edb16fef5b9f61f597f9df4ffd8e3fe6a0b3a2d2c557c8d6a7dde4f211dfb1c44f7b1d7ee46de038788fd3ba85d116ecdbfb60f49b12cddce72cc51f78f2ee060e1d9a37e807920b3a222022abe82b766e626fbed5896773329698d74af2e21a2420346fe00740ad0808888088880888808a328e6e0bd9cca62638a46cb8cee7bc7bb6e17778d2e1b7b805268088abfa57316f2d3675b6cb08a39596ac3c2ddb68dad611bf99f58f3416045a399ccd1c0e325c8e425eee18c780ddcf71e8d68f127c02d3d37366ee5796fe663655f4877157a2d6fad5e3f0e3778bcf523c104d228bc1e3f258e86cb725967649f2d97cb1b9d106774c3d1836ebb7fbd7dab9b82d6a0bf86645209a8c5148f79db85c1fbedb78fe4a0934444044558d4b6ecc1ab34ac10d89638ac5a99b3318f21b20109203878ec79f341674444044440455fcbe62dd3d67a7b170960ad906da3382ddc9eed8d2dd8f8732558101157f5d662de0346e432940b1b66bb58585ede21cded0797b8953b335ef8246452777239a435fb6fc276e476f141ed1476068dec6e1a0a992c93b256a307bcb2e60617ee491c8790e5f052280888808aafa1add9b75f366cd89673166adc51991e5dc0c0fe4d1bf403c02b420222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202f8ed8b4efd365f56a642730d7e16fcb79d82cc46e748da62b1b9537258192f5f9a5abeab4bb92d56e96c99f57bcd82bd54ac2385a08e7b2d90d03c16cdb9131d9e75389d5f29fda994f471e30eb12172b3d3c7455630c637a2dc03d8beaa6d966cdaa71ab50357d017d0beaadb1e1f0a8ecbbf869b948a8dcc7f453ef53c7f9429cffe9cb7298da9c5fa016758abff00478ff442caa33e5757c40888b0cbcc838a370f30b98de6f0e5271fd65d3ddf24fb9733c97df7b1fa4b5f953ff4f673bebf1fcaacff0056bafa88b869f2e31f108046c57d45663cb6c73b82274d77d707a2c7dcbc7471d96dec9b2f631fabdeb1a95f5cf6ab4fb978e655b345e4dcd99d4243c8f36aaf91b85ea8da343270d81d0386fee5d0707d4239559c72dfe0f2ed8f3d6d33d9d4d1638656cd0b6469dc386e16456bbe89df71111191111011110111107e60ed57f19598fd633f96d5fa5e87deeadfaa6ff00bf3476abf8cacc7eb19fcb6afd2f43ef756fd537f8041b0bf2462b12fceeaaaf8a63f80dbb4232febc20bb99f80dcafd6ebf2ff0067ff008cfc5fcf0ff0283f4262745e9bc2d3655a787a9b35bb192489af7bfdae711b95c6bb68d238ed3d94a37f175d95a1bed789218c6cc6bdbb7303c370ee839725fa0571ff00ec82fe8383fd6cdfc1882d9d91df92ff006758e32b8b9f5cbe0dcf935c7847c1bb0f82e2bac728355769360deb62b54f4b155b2bfe4c30b5dc3c5fc5def2575eec4ff17917ce65fe21716d4f8c8b0fda15ea7948e5f456de2f9047c9ce85cee2ddbede1283b8e0f547671a72832962f2b8faf1b5a01737e53fdae76db93ef540ed5dda232d41995c0dfa5f64d92012c75c70f7ec3e246df281db9f96fec569a3d8d687c9528aed2b97a7af3343a391961a4387fa2bc643b20d058981b3e43216eac6f788dae96d31a0b89d80e6d41b3d8866e6c9e8f96858797bb1d3777193e11b86ed1f03c43ddb2e90abda4b44e274645663c53ac385a735d277ef0ef93bedb6c07995614149ed80c83b34c9f0742e843bdddeb7fdfb2a1f600d88e6b2ef3b77a2b3037cf84bb9fef0d5d7b52e199a874ddfc4bc86fa542e635c7a35dd5a7e0e00fc17e70d259fb9d9eeb4efadd778ee8bab5d83a38b77e7b7b41008f3dbda83f51a2d1c466b1d9ec7b2fe2edc766078f94c3cda7c88ea0fb0acf6ee55c7d57dab9622af046377c92bc35ad1ed250675c5ff00b213e5e9ff00758ffb25d1b4d6b9c0eacb16abe2ad174b59c41648de12f6fe7b478b7f7f981b85ce7fb213e5e9ff00758ffb24170ec73f16b8ff00d64dfcc72e51db4fe316cfea22faababf639f8b5c7feb26fe639728eda7f18b67f5117d541dfb4f7e0de2fe6717d40bf30e729c990ed03234a1dbbcb39596266fd3774a40fe2bf4f69efc1bc5fcce2fa817e7067e385bff483ff00ec20efb80d07a734f63e2ad5f175a591ad01f62689af9243e2493d3dc3905cc7b6dd1f8cc4474b378cab1d4efe530cf1c4de1639db7135c00e40f276fe7c97715cc3b7bfc0da3fb41bfcb9106d761f7e4b9a0dd048e27d0edc91337f0690d7ff00171546edeff0ca8fece6ff0032456dec0ff042ff00ed077f2d8aa5dbdfe1951fd9cdfe64883adf67df8bfc1fccd9fc16b65f4fe86a19a973d9c8b1d1dab3b7ad7646f09206db86b8ec4f4e7b6fc966d092773d9c61e520bb828b5db0f1d82e09868ac7691da1411666fbd8ebd238bde0f36b5ad2ee066fc8721b0ff7a0edb6f54f66d66b3a9d9bd879603c8c6630e6fc397f05c1ac4d4b03af7d230967bda752f364ad235c4eec0e040dfc7972f6aed8dec4b46b5a018aeb881d4d83b9fdcb876a7a78ec76afbb4b1327794a0b1ddc4ee2e2df6d81e7e3cf741fabe5fef2ff00d12bf25e97c21d47a9a86203cc62d4a1af78ead68e6e23dbb02bf5a4bfde5ffa257e65eca3f19787fd393f94f41fa0f1ba3b4e6269b6ad4c2d36b1ade12e7c2d7b9dfa4e2373f15c4bb65d278fd379ea96719036b57c846e26160d9ad7b48df8478021cde5ef5fa1d717fec84f9780f758ff00b3417becbefcb92ece71334ae2e9191ba124f3e4c7b9a3f700bf3f61e7834feb88a5d4749d6a3a965c2dc0e1b92e1b8df63d76773d8f5d9776ec73f16b8ffd64dfcc72dbcc691d1bae2c4f24f1d7b1720798a69aacdc32c6e6f2e176c7a8db6f58141871dda4e83ca422ab3275a06386c61b51189bb7912e1c3fbd4fe1b1183a1df5cc254a90b6ef0ba492a801926dbec7972f13d3cd738caf6078c7c323b1398b30ca012d6da0d7b49f225a0103dbcd533b23ce5fc4ebaad8c8e773aa5d7ba29a16bb7613c27670f0dc1039f96e83f4722220fcdbdb37e322efeaa1fa817ca593ed4d946bb69479ff00456c4d10f7751e5bc1b7abb1e1e636d97ded9bf19177f550fd40bbee97fc13c3fcc20fe5b50707fb2bdae7f8bd47ff00c949ff007555f52d8d436724c7ea66dd17444037d3222c7f06e76e440e5beffbd7eb55f9f3b77fc3aadfb3e3faf220ebfd9dfe2fb09f346ae15daefe33f2ff00fc1fe4c6bbaf677f8bec27cd1ab87f6c959f076937e47820588e1919ed1ddb5bfc5a507e8da5fd06bfea9bfc1537b63fc5ae43f590ff0031aacba6f295b35a728642ac8d7c7340d3c8efc2edb9b4fb41dc2a276e3a82a55d2cdc1895aeb9725638c40f3646d3bf11f2e6001e7cfc90437f63dfcbd41eeaff00f6ab63fb20bfa0e0ff005b37f062d7fec7bf97a83dd5ff00ed56c7f6417f41c1feb66fe0c41a9d8c685c764a8cba8b2d5a3b5b4a62ab0cade26376db7791d09dcec37e9b1f62ead91d3182cad2753bb8aab244e6f0eddd005bfa247307dcb9f7619a8a9cb819b0124cd65c82674b1c64ec648dc012479ec77dfe0ba9cd3455e17cd3c8c8a28da5cf7bddb35a075249e8107e5cca56b5d9e7685247525717e36cb5f138f57b080e00fbda763f15fa8a19996208e68ceec91a1cd3ec2370bf2feb6c9b75876836ec631a6565a999056007393601808f791bfc57e9da55c54a305607710c4d8c1f3d86c833a222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220e19dbffdfcc4fcd9ff0059766c37de3a1f368fea85c67b7ffbf989f9b3feb2ecd86fbc743e6d1fd508375111011110111101111073e873f4f07da5ea736e2b7277d0d3e1f46ab24db6cc76fbf003b75f1535f6ff0088ff00d972ff00ecb9ff00eeac180fc65eadfd4d1fa8f56e4186ad965ca91598c3dac9981ed1230b1c011bf307983ec2ab1a03ff00597fe905affed56d552d01ff00acbff482d7ff006a0d285b93d7b93bb28ca5ac769fa933ab44ca6feee5b8f6f273cbfa866fb800755b32e8cb78489d734be5af32dc638bd16e5974d058dbab5c1dcda4fe703c97decea5652c7ddd393b832f62ae4c1f1bbe53a37bcbd920f610eebec568bf7eae2e84d7aeccd82bc0c2f92471d8001054fb2bb3e9ba5acdbeedd177f92b32776eeadddfbec7ddbac1462c8f6833d9c84b95b78fd3ec95d0d382949dd496b84f0ba47bc73e1241d9a3ff00ce5ecaa636f49d89dd13a133646cbcc6e1b166efdf6f7859bb3499b5f4c8c04c436fe1a592bd988f223d725aedbf35cd2083e3cd061bfa3f2381aafbfa4f2f7c598071fa0dbb0e9e0b00756ecee6d27c083ff11394f370e7b468cc54e2632cd4748d1bf363b84ee37f30411f05bd96cad3c262ec64afccd8abd76173dc4f5f60f327a00ab7a471f671bd97c505b8cc53beb4f33a33f91de17bc37d9b070410fa330b90d5ba5a85fcf65320cabdc363af52bd9747c61a363248e1eb39ce209037d80dbaa9dd4990c9cf97a3a570563d16cd888d8b56c80e35ebb4f0eed07ab9c790f2d8fbc6cf67df80183f99b3f8285d458eae3b4aa16b216add4ab90a069c5356b7241f776bcbc31ce611f29ae3b03d4841bdfdaeea3077b0e7b3f1dcebe95f641ce793ed07d523d9b2cba76e5dcb55ca69dcfc9c590c7b8433cf5c98bbf89e3764ade1f9248df7dba1056cfda6d2ff002a677fdb167fefacd84c062b1776ddca362c59b12f0c33c93dc7d877a9b90d25c4ec47174f6a0a760f476367d71a9ea3ec6484757d1380b721335c78a324f1383b777b37e8ba1d0a5163a9454e174ae8e21b34cb23a471e7bf3738927e2ab5a7b9768fac01e448a2e03cc774e1bab6a02a2e98cb52c1d5d6191c84ed86bc39d9cb9c7c7d58f6007893d0057a5ce74869c8327aa75064ef4ae9e1a59b9cd6a8e1f7364dc2dde523f29db6c06fd3627a941b9a548d6f927ea6ca3870d19dd152c63bad3703b17ca0ff00853e1e0074e7d2f4aa5a8b117713933aaf4f4264b4d686e428b790bb10f11ffbc68e87c7a7b0d831196a59cc64192c7cc25af3b7769f11e608f020f221057f46993258dd4305b9e691aecc5d801ef5c1cc6716c034efbb761d36e8a0717a3b1b2f6819da4eb19211c15aab9ae6e4260f25c1fbeeee2dcf4e5bf453dd9f7f46cffedeb9f5d311eaf6a3a881e45d4aa39a3cc0e31ba09fad8dfb1d873431f33dae631e2196cbdd316b8ee417171ddc013d37e9c957bfb5f4371a5f9acf667253bb9b9de96e86369feab19b068f67352fab72d3e0b4a64b295581f3d681cf8c11b8e2e809f60df7f8289a5a32b5fa305bc8e6f2d7ec4d1b5ef9997e4898edc6feab58434379f21b20c78075fc06b29f4bd8bf62fd19a97a65296d3f8e58b6786ba32efca1cc11bf40b2eaafc33d1ff3b9ff0092e5118dc7e3715daf414a85ab133d98991d3367b2f98b097b761bb89db973dbdde6a5f557e19e8ff9dcff00c9720d8d5b97c9433e3f05837b23c9e51ee0d9dede26d6898377c9b7891b8001ea4ad61d9dd470ef65cf67df73afa5fd9070783ec03d503d9b2d4d6b4a066aec064af58b35a83c4b4e5b15ec3e0313dfb18f773482012d23cba299fb4da5fe54ceff00b62cff00df41834c647270652f69acdce2cdba6c6cd5edf0869b35dc480e207e502083f0f7ab3a82c4e9cc4e3b312dfad66d59bcc87d1a4759bd2587318487f0ece71dba03f1f6a9d4146d67918715af3495cb0c99f1b197811042e95fcd8c1c9ad049525f6ff88ffd972ffecb9ffeeac1a87f195a3ff577ff0096c56e41ccfb44d618dc9e84c9d382be49b24ad60699b1f346c1b48d3cdce6803a2e94ff0090ef72a9f6a9f8b6cbfe847fcd62b63fe43bdc82abd9fe41c3b34c7642fd87c9c15df24b2c8e2e76c1ce2492799e4147e2b1594d754db9bcd652ed2a16871d3c6d298c21b17e4ba470e6e246c76e837f80c9a1e91c9f63b52835c1a6d519a10e3e1c45e37fdea4b406522bba5aa5177dcef62e26d3b95ddc9f13e31c3cc791db707a208ebfa6ef693a92e574f64efcf1d7639f3e36dd874d1cd181bbb809e6c781cc1e7bec0293ecf679ad682c3cf6257cd2beb82e7c8e2e738ee7a93d56dea9ccd7c260ac4d29e39a5618ab4039ba7948d9ac68f1dcfd0372b47b36fc5de17e6c3f894157d2b8bc9ea0b9a8699c859c76260cd5be334dfc135990bf98e3db76b40dba752ef6293cc68c9b4f63a6cce99cb6460bb4e3331827b4f9a2b41bccb5ed71ea402011b755bfd9eff45cf7edeb9f5d5872ff0079af7cde4faa5057b3f7ad6574155d458b32473c0c8724c898f238dad01cf8ddb7505a5c36f3d959e9da86f5282e577f1c36236c91bbcdae1b83f41507a09a1fd9fe11ae0083463041f1e4ab51e4ace034b65b4bd771fb2352d8a18edcf32cb07785dbff0055a5dfeaca062f379176b48f3f2da7bb0797b72e32b445c781858008e403faef6483e23e175d439766074fddca3c717a3445cc6fe7bfa35bf17103e2a372fa5a393429c063fd492ad767a1bfa16cb1ec58ef7f1346fef2a20e5d9ad6d699a710da27b0652f33f33bb3c2d8cfff00177e5ffbb28256b60332348e3f16dce4d52dec1d76d068925713bb9e1a5dc9beb1d81d8ec0725aafecde816778ccd675b707c9b8722f3203e7e5f0d966d5f7ee8cb60b0552ebf1eccb4f2366b5181c6d6b19c5c0d24101cee9bf82f474162434ba4bd9871eae7bb2b3ee7da7d641834e4f7f53e8fc8e2f2965ccc8559e7c74d6a02584bd9d241b743cda56fe8acbcf96d3b18bdcb2345eea975a7a8963e44fc46cef8a87ecb0d538dcf7a0cce9aafd9b9fba91cf2f2f6f0c7b1e23ccefe656c4ff00f9b7da24563e4d0d44c10c9e4cb518f50fb3899b8f696a0cfaced58b526374d509e486ce566fbacb138b5d15766ce91c08e84f268fd25680035a1a3a01b0553d25ff009733594d58ff005a299de858f3ff00e9e327770fd37ee7e015b5011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101443dfe9794e5cd908dbe2a4e77f7703dfe4095198789ddd191ff0029e77255b4ed1366b6799998a47ed26de4d5f79a6dc9797bc3185ce3b00a9f2bbc43da6ea19fa8aa31c4779bec765e7ed969fe7ab630dff50a7f89c71e65388a15ba8aa3ba3c2f5f67ea7f8c0b3ecdfe8fe271fda60a8ccc1029bbd8b11d4153fc605a37f2b0de8bb988f1971db60a78f15e2db98539b9149aea2562adceb45fa03f82cab1576f0d68da7c1a02caa89f2de8f02222c32f8ef927dcb9a6506d97b1fa4ba59e61738d4113ab6665e21b077305432e29cb8ad5abc0f5dacce0acc7db4d16312b76e657def5be6b92b7a767df8717d32f68bc77adf35f43c1e85576e0e6ac6f4c74cbd2f889b2d49acc4ea58162986eddfc9655e5e37690bd0f4dcb38b344c2749d4af9a56d8b5888c1eace454daa168bbce86fbaa13eac8390f6abeaecf2477dfdbe87e9d9bdee3d67ebb0888ab6f8888808888088883846bfecdf5766f5be4b258ec4f7f5677b0c727a444de2018d0791703d415dc6a31d15382378d9cc8dad23c880b32202e0fa3fb36d5d8ad7743277713dd5486c97be4f4989db379f3d8389f1f25de1101737ed8749e735555c5330b4bd29d5df219477ac670821bb7ca237e87a2e908829fd9760b25a7346c78fcb56f47b2d9e479671b5fc89e5cda4858fb40ece69eb6aec9e391b53270b78639f8770f6fe6bfd9e47c37f82ba220fce8cecfbb4dd3f2be0c636e47193f2e8de0c63fdbc9c0fd216d57eca75eea4b8c7e7ecbe160e466bb6fbf781ec01c7e8242fd02883470d8d187c354c6b6c4d645688462599dbb9db79ade4440548d77d98e33591372393d0b26d6802c35bbb6403a078f1f7f5f7edb2bba20fcdb63b2dd7b84b24d3a7249e026a56073fde1df485f1bd9ef68b9e9590dda971cc69e4fbd67d567b7d6713f405fa4d1073eecffb2aaba46c0c9dfb0db9930d218e602238771b1e1df9927ccfd0b4bb63d219ed54ec39c250f4af461377bf76633878b836f94e1bfc93d3c974e44155ecd70b90d3fa229e37295fd1ed44f90be3e36bb6dde48e6d24742b9ef69fd9f6a9d45ad27c8e2b17e9155f146d127a444cdc86ec7939c0aed88834b0d5e5a984a15a76f04b0d68d8f6ee0ece0d008e5ed5c51bd9b6ae1da48cb9c4ff00717d98f49ef7d262fef7df71716dc5bf4e7b6dbaef0880a87dae69bcbea7d35529e1aa7a54f1dc6cae6778c66cde078df77103a90af888285d9169acbe97d3972a666a7a2cf25c3231bde31fbb781a37dda48ea0aaf76b9a1b526a7d4d52e61b1be950474db139fdfc6cd9c1ef3b6ce703d085d791042e8ec7dac568fc5e3ef45dd59af59ac959c41dc2e0398dc120ae4faabb1bcdd2cd3b23a49c2485d2779144d98452d776fbecd2481b03d0efbff15dc91070d6e07b64cc4071d6ed4f05593d491f2d989bcbc772c25c47f151196ec6f54d3cc3a1c5d137a9c623e1b267899c6785a5fea97020717101bf805fa251079901746e03a90405c2fb3eecdf56e0f5c6372592c4f7156073cc927a444ee1de3701c9ae27a91e0bbb2202e63db1e90cf6aa761ce1287a57a309bbdfbb319c3c5c1b7ca70dfe49e9e4ba7220a8f67783c9e0f4057c56423f42bccef7a39b270173dc5a79120f507aae5d90ec835be2322fb587b6db8e24913c167b994ee7c7888d8fc4aefe883f3e49a4bb5dc8c4ea9664c93a12385ed9b26de170f6fafcff007abcf66fd94fdaadc198cb4f1cf910d2d8a38b72c8771b13b9eaedb9790dcf55d291011110711ed33b3cd55a875b59c8e2b17e915648e36b64f48899b90d00f27381eabaf606b4d4b4f636a586704d0548a391bb83c2e0c008dc72ea1482202e3bdace83d4da9b55c17b0f8df49aeca6c88bfbf8d9b383de48d9ce07a10bb122084d198fb589d1d8bc7de8bbab35ebb59233883b848f0dc120fc141f68fd9dc7adaa433d69995b255816c723c1e091a79f0bb6e639f3079edcf973577441f9c63ecdbb48c448e86856b11b5e79baa5e6b1aef6fca1fbc2926f62ba8a5c1ddc85f904d967069af5193349738b87117bdc76e4de2e40fc7c177c441cc7b1cd219ed2aecc1cdd0f45f4910f75f7663f8b878f7f92e3b7ca1d7cd66ed8749e735555c5330b4bd29d5df219477ac670821bb7ca237e87a2e908838133b15d46dc254bf5646d6cab0b8cd56498020871e1731ed246fb6dc89f8f82d0b9a1fb53ca014f211e4ad45bfc9b1916c918f6f3790bf46220e69d9df64acd3369997cccb1d9c8b07dca28f9c7013e3b9f94efdc3dbd574b44404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044441c33b7ffbf989f9b3feb2ecd86fbc743e6d1fd50b8cf6ff00f7f313f367fd65d9b0df78e87cda3faa106ea2220222202222022220adddd1715ace5bcbd7cde5b1f3dc6c6d99b5258dad7060d9bc9cc27c4f8f8af1f69b67fcf1d47ffcc43ff2959d1047e2316fc5567c3264ef644b9fc5de5d7b5ce6f20361c2d6f2e5fbd7cc4612b617d3bd19f2bfd3ae49724ef083b3dfb6e06c072e5edf7a914410d99d2d8ccd598ee4a27ad7a26f0c772a4a6199adf2e21d47b0ee147d6d054fd2e3b196cae533621707c50e42c07c4c70e8ee000027da775694411d85c2d6c1569e0aaf95ed9ecc965c652090e7bb8881b01cb7e8b572fa4f1997b8dbe4d8a57dade017694c619787c891c9c3d841536882b35b42e3db622b394bd90cd4b03b8e2fb2363bc646ef30c00377f690558ac42db35a581e486cac2c2475d88d964441a587c5c184c3d5c5d67c8f86a442363a420b881e7b0037f82f593c550ccd0928e4aac766b49f2a378e5ef1e47da39adb4415676872008a0d4fa82bd5038440cb80ec3c839cd2e03e2a6b0d85c7e031eda38dae208412e3cc973dc7ab9c4f324f995be882032fa4a0c9e55996ad91bd8bbe22ee5f3d37b477acdf701cd7020ede1c94962718cc45215596ad5a3c45ee9ad4c6491e4f5249fe0000b7510147623095b0cfc83eb3e579c85c7db97bc20ecf700086ec072f5475dfdea451014563b4f54c565aee42949344dbc43e6aa1c3b93278c81bb6e1c7c763b1f2dd4aa208ec3612b611971959f2bc5cb72db93bc20ecf90ee40d80e5e5fc569e6b4a57cb64a1ca417ee637210c6621669bc02f8f7df85c1c0870df9f453a882331f82af4719363e69ece423b05c677de97bd749c43620efc80d86db0007b142c3d9fc74a235b1ba8f3b4299e95a2b4d2d60f261734b9a3dc55b5104062f45e230f93832149b33268a19223c5271f7a5e5a5cf793bb9cedda39eeb7b2184ad92c9e372133e56cb8d91f24218406b8b9a5a78b71cf91f0d948a20c176955c953969ddaf1d8af33785f1c8dddae0abbf68ac81ad871fa8b3942a3790ad0db0e6b47934bdae701f15694411983d3f8ed3d55f063e27032bf8e6964797c933fc5cf71e64a9344411b73095af6731b9795f289f1a2610b5a4703bbc686bb886db9e406db10a4911046ea0c256d4784b388b8f96382c8687ba120386ce0ee44823a8f252246e08f35f510476070b5b4ee12b626a3e57c155a5ac74a41710493cc80078f92869315a43585d92e4458fbf59ee8659ab4cf82c30b4ec43b84876dcb96fe1d15a94365b4869fcece2c6471504d381b77c37649b7e93483fbd042e5319a6f44e32d65cc6f92fbe27455e4b333e79e4791b36367112799f2f8a9ad218c9b0da43158eb0369a0acc6c83c9db6e47c092b1e2f4569bc3586d9a38985b3b3e44d2174af6fb9cf248f829d411d86c256c2476d959f2bc5cb72db93bc20ecf90ee40d80e5e5fc56e5981b6aacb5de4864ac2c716f5d88db92ca8834b0f8b830b88ab8bacf91f0d489b131d2105c40f3d801bfc1695ad2b8db7aa6a6a3944be9952231b1a1c3bb77cad9ce1b73238ddb1dfc54d220285c2695c6e032392bf484bdee4a5ef250f702d6732785836e4dddce3b799534882333da7f1da9280a7918dc5ac789229237164913c74735c3982a1ce838e7688323a8b3990a6391ab3da01920f2796b439c3de55ad1044e230d8ed3515a65693ba8aedb33f0c8e686b5ee0d6863360361ea8d8732a13b498e2c9e16b69f8bd6c964ad46da81a7d688b5c1ce97cc06b41dcfb7daacd92c5d0cc527d2c9548ad577f58e46ee37f03ec3ed5a587d2983c0d87d8c6e3db0cf23781d2b9ee91fc3f9a1ce2481ec1c906fe3a857c5e36b63eab3820ad13628c7b00d96ca2202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220d3ca3c32849fd61b04a2d0c81a3d8bc6623924a47bb6171041d828f8f28f85bb3ab4c36fea157d69d54ecd3cb93a32ee539bad4c83f6aae03c5463f5146d3b18a407f4561765cdeda38a190927f34acd305a2772af272ab68d4276b5480578f789bf24782c86ac07fc0b3e85ee205b1301ea005ed53333b6f45635e1afe8358ff8167d0be7a055ff0010cfa16ca2c754fd9d35fa6b7d8fa87fc033e85e994ebc677644d07dcb3a2754fd9d35fa111161211110169dec5d4c8376b11077b56e22cc4cc4ee11b56b78d5a370af3f46631e771c6df72f0744638ff84947c42b2229fbb7fb6acf038d3fec8568e87c7edca6947d0b46ee89746c2fa760b881f25e3aab9a27b969f2aefe9bc5bc6ba34e52f8e5ad298a7696bc15f7757cce6022ca45c6c01930e8ef3549b98fb78f7964f0bb61f940722bc8e67a75737cb1f9725cff004cc9c7b6e2375fb615f0af3de7f54fd0be179df60c71f82f3717a5e7ada34f2e31db6ddd3c7bbd45576f1711fb8ae98b9e69cc6db97315ec985cd8e376e5c46de0ba1aea2d135ad627ce9db7a256d5c13d51fb111141ed888880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888838676fff007f313f367fd65d9b0df78e87cda3faa1719edffefe627e6cff00acbb361bef1d0f9b47f5420dd4444044440444405ad90b166ad1927a949f7a766dc15d923585fcc78b8803973e7e4b651054aeeaecf63a8cf7ade8ab91d7ad1ba595fe9d5cf0b5a372760edcf21e0bd56d55a86e5586d57d1371f0cec6c91bbd3eb8dda46e0ec5fbf42a435a7e0367bf6758fe5b96c699fc16c4fcc61fa8106dd19e7b34a29ad5475399e377c0f7b5e587cb76920fc16c2ace6f5264066d9a7b4ed386d64bbaefa796c38882a30f42fdb9927c1a39f8ad499fda0622275d95d8accc4c1c52558227c3291e2233b904fb08e682e2a0f47e6ecea1d3b1e46dc713257cd330b6204376648e68ea4f800b7b0d96a99dc456c9d179741659c4ddc6c478107da0ee0fb4280eccb7fb48876ebe9367f9ef416d4513a6fecf7d891f6c7e8be9dde3ff00a2efc1c1bfabd7c7ff000f152c808a2755599a9691cc5aad218a7828cd246f6f56b8309047c56d62257cf86a534ae2f924af1b9ce3d492d049411b9ad5d4f137463a0ab6f27927338fd0e945c6f6b4f473cf20c1ef2a364d6999a119b596d1791ab45a377cf0cf14ee60f32c69dc01e255b846c6c8e9031a1ee0039c0732074dcfc4fd2b1dbb55e9539ad5a91b1410b0be47bba35a06e4941f295dad92a50dda73366af3b03e391bd1c0aac55d6596c909a5c5e92b772ac73c90b6717206079638b4901ce07a85f7b3885f4341569268dd044f74d62289dd6389cf739a3fd120fc5457679ab74e51d178fad733b8f82d3bbc9258e5b0d696b9f239dcf73fd64165c6e67396ef320bba56c5081dbf1587dc8240de5cb935c49dcf2f8a9d582a5da97e013d2b50d9889d8490c81ed3f10be5ebb5b1b4a6bb7266c35e0617c9238f268083533f9dada7f1a6e586be57b9e238208c6f24f23b9358d1e24ffc4af592ca9c569db397b559c0d6ace9e481af048d9bb96efd3d9ba83d3d4ace7f28dd599785d10e12dc55393ad788f591c3fc63c7d0360a6e78f1daa3013411d813d1bf0be232c0f0789a7769d8fd2821e0d51a8acd78ec43a22e3a39581ec77a7d61b8237079bd6b6575c6630941f7f23a36dc35d8e6b4bbd36bb892e2000035c49249f00add56bb29d486ac5bf0431b636ee79ec06c154b2bff009cbda0d2c40f5a8e0836f5cf274eee50b0fb40dde825731ab29619f05692bdab591b11f1c742a47decc47892072001e5b9207551aed61a82bb4d8b9a17251d36f373e1b114b281fab0772adbddb3bdef781bde6dc3c5b73dbcb7f247bd9146e92470631809739c76000ea4a0d0a79fc5dfc1b73705c8ce3cc66433b8f08681d77dfa6db1dc150435bdfc87dd34fe94c964ab9e6db32b995639079b7bc3b91edd82f1d9d40c9b0794b422fee0c9652cd8ab1bdbc8c0e200e47c0ec4ede455c00006c06c020af61f57c77f2830f92c6dac3e50b0bd95ecec5b301d4c6f69d9fb78f8afb93cf6728d99db0693b36eb45cc5865c8181e36dc9e173b71f428fd5bc17757e95a15bd6bd0db75b796f58ebb5a43c9f20e25a3da42b4e43ef6dafd4bff8141ad80cbc79fc153cb4513a265b8c48d638ee5ab4339abeb62afb3175295acb64dede2f44a6d04c6df073dc79307bd6bf678f6c7d9ce1a471d9ada809f70dd61ecdabf7ba6dd9d9c0377353bedcef3ccec5c431bbf90681b0f0dca0375d4d46c471ea4d3d77090cae0d6db91ec9a0693d03dec3eaefed563c95ab55683a7a341f90986dc30472b185c09ebc4e20721cd64bd4abe468cf4adc4d9609d863918ee8e046c5577b3ab33c9a51b46cc8649f17626a2f79eaeeede5adff00e9e141ebed8b537f98d73fda15bfefafb80d5d67339fb9879f053d1969461f3bdd3c72b584edc2d25848e22373b7b17dd65a9ce0eb57a34e48465b24e3154133c3591fe748f27f25a39fb4ec16fe99c254c161a3ab565f482f2659ed38eeeb123be53c9f124feed820f19cd4d4f0934150c362edfb5b9829d5671c8f03abb9ec1ad1e6485a0ed4ba8ebb4cd6f455b10379bbd1ee4334807b1808dfdc095a592b5069ded23ecbe54f7542fe3d9562b8f1f738646bcb8b1cefc90e041dcf2dc2b0d9d4d81a755d66c6668b2168df8bd21a77f76c79fc1066c3e628e771d1e431d377b049b8df620b48e45a41e6083e0a124d5d91972d90a38ad336722ca1288659996a18dbc45a1db00f703e2bc6818a67c398ca9824ad5b299192cd58a46f0bbbb21a38c83d388827e8515a475569fc7cfa80643334aacf633561e1934cd6bb8410c69e7e1b350582ae7750cd6e18a7d1d6ab44f786be675eaee118279b880edcede416c65b2d99a56c45434d58c94458099a3b50c601e7cb67b81fff002b7e8e531f948cc98fbf5ae31bc8babccd900f882b69054edeadcf50a935bb7a32cc3040c2f9247642b6cd68e64fcb535a7b2efcee0eae51d4a5a5e92de36c33105c1bbf23cbcc6c7e2aad6eed5d75aa1d87f4a8bec2e2a51e931f7837bd607311f0f531b4f33e04f2f0dd5e80006c06c020fa88880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880bc96b7c405a996bbf63f1f2581d5a397bd50ec6732765dc46cbda3c9a76499ad63769d3cde67a8e2e2cc56d1b99745eea13f90c3f05f5b146de6d6347b82e6f1e5f251f4b721f7959e3d47958f9f7e5def55c67c56ed166957d778f3e6b2e888aa989d60d96410de1c0e276e3f056963db2343984107a10ad9898eef5f8fc9c5c8af56397a444586c0888808888088880888808888088880bc3e28e51b3d81def0bdad0b33d874e6385dc3b75e4a558999ecaf25e2b1b96538ea67ad767d0beb685469dc40cfa16b0178ff861f40422f81fdfc7d014fa67ed475e3f3d3ffa48358d60d9ad007b17a51952f4cebc6acdccedb82a4d42d59acf76c63bd6f1ba8888a298888808888088a1756e69f81d3b62dc0def2e3f686a45d4c933cf0b06de3ccefee0506f51cb63f2535a8695c8a7929c9dd4ed63b731bfc8fd07e85b8b9e55c337b3dca60edb1fc55af4631f94937f953b8973263ef7973773d0382e8133dd141248c8dd2b9ad2431bb6ee20741bf9a089cdea7a784b15ea3abdbbb76c82e8ea528bbc94b475711b801bed242c94350d6b98bb190b15ade363aa5ddfb6fc3dd3a3006e4f882363d412a955b50e4bfb645eb474b649f37d8c86315f8e1e38dbde38efbf1edb127cfc17bed133f919f41df864d3791aac9a26f79348f8b862fba01b3b6793cc0f0dfe504163c76b5af92b35d91617351d7b4eda1b92d3da176fd0efbf1007c09002b2282c5e772176e475a7d3190a11107eed33e22c6ec390d9af27d9d16b6435c54af929b198bc7decd5dae769e3a5182c84f93de48683ece682cc8aaf475cd57e420c765f1b7b096ec3b86017631ddccefcd6c8d2413ec3b29acce522c261ade52763e48aa44e95cd66dc4401bec3741bc8ab2cd6b15db8dab88c45fc970b9ad9e685ad6c3013b6ed2f7100b86fcc3775239ed498dd375a396fc8fe39ddc1041130be599df9ac68e64ffc504aa8eaf9bad673f730ac64a2c538a396471038087efb6c77df7e47c1417dbd5983eef7b48e6ea52eaeb0e89af2c1e6e635c5c07d2b169eb95b21da366ae539d93d79b1d51f1c8c3b8703c682e68a0737ab6961ae331eca977237dec0f1568c0647b5a4ec1ce3c8346e0f52a386be34e78c67b4fe4b0d5a578632dce1af89a4f40f2d2783e282dea3b019bada8f095f2d4d92c70590e2c6cc0070d9c5bcc024751e6a45736d11aaaa61b40e1a8c75ad6472324523db4e9c7c7206f7af1c4ef06b77f127ddba0e92bc4d2b6085f2b812d8da5c76ebb01baaab35fc35668e3cfe17238364ae0c658b2c6ba0dcf405ed2434fbd592f9df1b648ff12ffe05062c2e5abe770f57295592320b518918d9400e00f9ec48fdeb7956bb3afc5f613e6ad5e2eeb8aedbf350c3e2efe6ecd77704e69c63ba89df9ae91c40dfd8374168455dc4eb3a990c8b317768ddc46464697475ef45c3df01d4b1c090edbdfbfb15890639e78ab5792c4cf0c8a2617bdc7a35a06e4af956d4176a436eb48d9609d8248dede8e691b823e0b4752fe0b65be6537d42b5f457e03607f6757fe5b504dad6ab90a97a4b11d59d92beaca629837f21fb03b1f6ec42d9551d11f7db567ed97ff2d882dc8a173daab1f80961ad2b2c5bbd6013052a9177934807520780f692028bfb7e14c87e774f6571159c40f4a9a36be266fc8719613c3f1082dc8b5ed5fa94f1f2642c58632ac51995f36fbb4376df7e5d5563edeadda699715a47357201d267c4d81af1e6d0f3b91f0416f51d6f355a966f1d89919299f22d95d139a0708eec02ee23bee3e50db60561d3fa968ea38267556cf04f59fddd9ab663eee581de01cdf6f81e8a2b3ff8c8d23faabff523416c4541d7d9fca53b78baf5b11916c71e5eb6d622958d6591d4c63d6df9f4f5801c959f1199bd92b0f8ad602f635ad671092c3a321c77e8385c4eff00f0419a3cdd693514d836b25f4986b36cb9e40e02d738b40077df7dc79291544bd99a582ed332572f48e6b3ec4c0c6318d2e7c8f32bf6635a39971f25b536bcbd5a336ec68cce4545bf2e62c617b47998c3b7dbcfc905c516ae37254f318e83214276cf5a76f147237c47fb8f811e0a2f37ac31f85bacc7361b590c948de36d2a51779270fe71e81a3da4a09e45501afdb4e68db9ed3f94c3412b835b6e7635f0b49e9c6e693c3bfb54ee6b3d8fc0d16dbbd23f864788e2644c323e579e61ad68e649d8a092454f76b9c831be90ed159d6d31cdd218d9de01e7ddf16eac98acad2cde320c963a713d69dbc4c78e5ec208f020f22106e22addfd738cc764afe3a686d3ecd4742c643047de3ecba469706c6d1ccec1a77df60a4f13939efd17dabb8d9f17c2e23bbb2e6f170800f11e12401ccf8f8209145513afdb71ce381c0653335d8e20da8236b2176dc8f039e4717c0293c16aaa19e9a6a8c8acd3bf5c074d4ae45ddccc07a3b6e847b412826d1110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111070cedff00efe627e6cffacbb361bef1d0f9b47f542e33dbff00dfcc4fcd9ff59766c37de3a1f368fea841ba88880888808888088882135a7e0367bf6758fe5b96c699fc16c4fcc61fa817ad438f972da73278d81cc6cd6ea4b0b1d2121a1ce69037d81e5cd65c3d4931f85a34a52d7495abc713cb0ee096b403b7b3920a5e1a2cf7db9eab663ade3a197d2e27482dd57caf2c310eec82d91beaedb8e9e6ac1e8fad3fca782ff67cdff39337a6a6b9938b3588c81c765628fba3218fbc8a78f7df8246ee371bf42082375a92b7b40b21d583b0549aee5e971996573479b63200dfde76f7a0dfd2983b580a16a0b76a19df62e4b64771118d91f1904b5a09276df73d7c5477663f81307ceacff3deac98ea8fa38e82ac96a6b6f8981ae9e63bbe43e67daa2f47e12d69fd3b1e3ad4913e66cd33f8a224b767c8e70ea01e84209d4513a6e3cf45890dd473d59af778f3c559a433837f54741cff00f052c828bab741e95ada57357a1c1d56598a94f2b2400eed7863883d7aeeb7303a0f4ab31f8dbcdc1d5165b145289363b87ec0efd7aefcd5b910639a68ab40f9e791b1451b4b9ef79d9ad03a927c02a646c9fb44b4c9e763e1d2f03c3a289c385d92703c9ce1e1103d07e5752b2eb4c06a5d417eac34dd8d930d0ed24d52ccd2466cc80f20fe161dd8391db7e67af82da6bf5eb1818ca3a6dad68d8016a7000ff5682ce1ad0de10070edb6db72d961346a38106ac241ea0c6144b296732d88b74b39257a324bb08a6c5587f1b3c77ddcd1b1dc051b1c7da250da16cd82cac4de4d9a6ef2095c3cdc1a0b7e841ada8f1b4f4be6b0999c2d78e9496b23151b70c0de08ec4726e3d668e45cd3cc1eabc6ab199c8ea782b4fa7aedfc0d2e197bbaef8b6b7372238f89c3d46fe6f891cf96ca42969ccde4b35572daa6ed493d05c5f528d163842c791b778e73b9b9c01e5c801d42b5a0ac7db565ff00ccacbffac83fe6281eccf397d9a470f499a76fc9012e6fa635f17760191dbbb62ee2d86fcf9782e8aa0f45e12ce9cd25431171f1493d66b83dd0925a777b9dc8900f43e482432f93af85c45ac9da76d0d589d23fdbb0e83da7a7c542682c658a781390c837ff002965e5376d6ff925ff00259ec0d6ec36f0e6b3eaac0dad47f63a8f790b71adb4d9afb1c4f14ad6736b00db620bb6df723a78ab020f8e7358d2e710d681b924f20152669a7ed0ecbead57be1d310bf867b0d3b3b22e079b187c2207abbf2ba0f12b6b5ce13526a0657a38b9a8b31a4f15d8a79a489f606fc99c4d69d987c76d895ee06eb9ab5e3af5f1da6a2862686b236599c35a07400777c820b3c5147042c8618db1c71b4358c68d8340e4001e01426a5d4a30a21a54ab9bd98bbbb6a5369e6ef37b8fe4b078959683f54babdbfb235f10c9847fdcbe8f34ae697ec7e5eed040df6e9b9eaaaf83d3dadf0f6ade4268b017b2571dbcd726b537170f831a047b35a3c87fc1058f4d69c76204f7f21605dcc5e21d6ed6db0e5d18c1e0c6f80f8fba5b21f7b6d7ea5ffc0a8112ebedf9d3d39ffcdcff00f2d586d44e9ea4d0b480e9237346fd37236415becfe213766d88889d83e9f09f8eebc7667317687a75241c3631ee92a58678b1ec791b1f86c7e2a5349e26c6074b63b1569f1be7ab088dee8892d27d9b807f728fc969ccad3cbcf99d2d76bd6b16b6f4ba76d85d5ec380d83fd5e6c76dcb71d796e82ccf7b58c73dee0d6b46e493b001553b370e9b4f5bc99696b32b92b3723046c781ef207ee1bac53e1b57ea48cd2cf5bc7e3b18fe53c38d2f7cb61be2c2f76dc2d3ec1bedb853995c19b987868636f4d897d52d75696b6db47c23600b4f27376ead3d506d5dc4e372641bf8fab6cb4103bf85afd81ea39855365187486bec4d2c46f063b371ced969071eee39236878918dfc9dc723b72e8b641ed2206f75c1a72d7809cba68cfbdcd00fee2b6f0ba6efc79839dd43908ef6484662819047c10d561e6e0c049249f171e7b7241a1dc7db76afcbd0c94b23b1788eea26d16bcb5961ef67197c9b73701b801a7972dd4b49a1f4a4b1777f6bb8d8fc9f1566c6f1ed0e68041f682b06574e5f66664cf69dbd154c84d1b63b30d88cbe0b41bf278b6e6d701c8387872589d27681337ba6d7d3f59dd0cfdf4d28f786708fde507cd2b6ae55cf66b4dd9b72dd8b1ddccb5a799dc527772349e07bbc4b4b4ec4f320ab21a754924d68893d496051186d2f1e2ea5f13dd9addfc992eb977e43de76e11c207c90d1d00e8a323a1af70e3d1e8dfc5e62a33946fc871c7600f005cc043bde46e506b6bdc4d1c16165d5389ad151c9e39ec944b03447df34bda1cc7edf28107c55e1a789a0ec46e37d8aa7bf4eea3d456a0fb68b7422c75795b30a18f0f709dcd3bb7bc7bf6dc03cf60362b772f87d451e524ca69dcc44c74c1a25a3906b9f5ddb0d839a5beb30f9edc8a0d9c8e8dd37948dedb586a7c4e24f7b1c4192027c43dbb107dbbad1d0176e4f8abf42ed97da9313919a8b6c487774ac66c5a5c7c4eced8fb9617c7da2de6981d360718d236759844b3c83dad6b801f4a9dc060eae9ec4c78faae7c81a4be49643bbe57b8eee7b8f89250492222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222088d4ece3c24fec1baa034eed5d2b2b07a463678c0dc961d9733602d73987a82b4b9f49b60998fd391f5fa4fb95b7f47b45f57c5c745ed59ece636c7247c5ec2a6b05a966c73c416897c3e07c42895e5ec0eea1745c2f558ad7a32786e71b97938f7eaa4ba657c9d4b2c0e8e66907dab63bc61fca1f4ae54d6399f21c47b8ace2cdb68d85893fd25e8c73b8d3fee7434ff1046be5474eef19f9c3e95f439a7a10b980b770731664ff00496cd3cbddab658f758739bbf304abb1f230e49e9ad97d3d7b15ad1135748458abca2781920e8e1bacaad74113b8dc08888c888b42cd89bd27b98481b0e6a55af54e90bde291b96fa28f0db87fc30fa1382e7f8efdcb3d1fd55fbd1f5290451fc173fc70fa1036e7f8e1f42747f567de8fa9482d166c6f49f05e80b7b6c5e0af70406325ce3bb9c79a47c58b4f5ea2219800bcbf934af6b5ad4a2389ce27a0508dcdb4964d568d3a1f76cb4f27846de10a5d4369c7f7b5a697c5d2bb9a995665fcb48f1e3f97122222ad788888088880b9de735460e4ed22bd5cb64e0ad4f051f7dc323b94b69e366f2f1e06927d85caf196bb2637136aec5565b5243139ec821617be476dc9a00e7cca8cd17879b0da7226dc3c590b6e75abaf3d5d3487777d1c9bf0410fa8358686d4181b98ab1a8a986598cb43b73ea3bab5c39750403f0529a0b510d4da52b5c7cad92cc5bc164b4ee0c8de44fc46ceff00acac6aa82a5ac2f6866cd6ad3498ece43b5931b0b9b0588c7aaf76df2439bcbda420f34bf1b394fd9307f31e9da9fe2df31fa11ff31ab2d4a965bda7646e3abca2b3f190b1b3161e07383dc480ee84f3e89da454b37b40656b53af2d99e46303228585ee77dd1a7901ccf241319fb72e3f4ee4aec1fdf6b5496567e935848fde146e82c757c768bc588002eb35d966690f374b23da1ce713e2773f46ca7e58a39e17c32b43e391a5ae69e841e442a662e7cc687ac7137315732b8a80914add160965647bf26491ee0eede9c437dc6c826b5962eb65f4964ab5968d9b5df246f3d637b5a4b5c0f8104285ca5f9b27d8b4d7ac1266b186ef2427c5c63e67e279a64eee675a53389c662aee2f1f68705cbf7d8227f747e53638f72e25c396e40014a6adc716f67d93c6e3ab3dfc341d0c1044d2e7101bb35a00e6506e697a106334be36a56606c6cacc3fa4e20124fb49249f7a84c642cc976a59db568091f89af5a0a81dd231234bdee1ed2796fe436566c531d1e22931ed2d7b6bb039ae1b10784722a03378bcae3751335360abb6dbe484417e8978619d80eed7b09e5c6ddcf5ea3920b52a1e94c656c4f69baa2bd468640f82bcad89bd232ee22e00780dc93b7b56fc9aea6909af4b49e7e5ba793629aa774c07c38a427840f682568e8cc3e6686b5ce5dcc87493deaf04924cc6110f1eeffb9b09ea1ade11e7f4a09ecb6a8a98cc8fd8eaf4ede4b24e8c3cd6a718739acdf917b890d68df7ea557f5667b2190d2396ab674765238a4a72ef248f80b63d9a4871d9e4f2201e5e4b3d97e474aeb7c9e5ce22de4b1b988e1e292947de495df1b78762cea5a473dc2c5a8b3f95d4980c8e3f0183c8c6d96b4825b772b189bc3c2776c6c3eb3dcef92361cb7dd05a34cc8f9b4ae26590eef7d185ce27c4960559ec8319569e83ab7226833dd73df349e2767b9ad1bf9003a7bfcd59b4d45241a5b130cd1ba3963a30b5ec7b4873486004107a1543d0efd43a2f4c56f4cc35ebd8e9c3a430c117f755390b882d319d8b98760ee5cc6e7d883a36471f572b8f9e85d85b357b0c2c918e1d41ff007aac687b53d9ecd62166432c90453d7ef0fe5b6373d8d3f4342f96b52e6b3f51d4f4de12fd4966f50dfc943dc47003d5c1a4f13dc3c001b6ea6e8e1a0c1e956622935ce8ebd6746de5bb9e763b9f79249f8a0ae60ae4f8eec4e2bb58f0cf5f10f9233e4e0c7107e09a4b26fc3696c7d3a7a4734e6081af74ac15f695ee00b9fb99773b93bf352ba2f1ce1d9ee331d91aaf8cba9f753c1330b5c01041041e63915a18bb599d1b54623218bb793c6d51c14ef51677afeec7c964918f5b70396e0107920d5d5d67259fc388e9e93cc4591ad2b2c529e415c08a46b81df71293b11b83cbc55ed84b98d739bc248dc83e0ab5575464b3190ad0e274fdc8aaf18366de4a235dad6788634face71f76cace823352fe0b65be6537d42aaba534de52c691c3cd1eaeca5764946173628e3878630583d51bb09d874e6ad9a822926d37938a263a491f4e56b18d1b9712c3b003c4ac1a46096b68dc2c16227c534542063e391a5ae6383002083d0841a1f6ab97ff003d72ff00eae0ff0096b47b3b824ab6b53c135992d491e5dc1d34a0073cf76ce676007d015d555f47d4b35727a99f62bcb0b67cb3a489d230b448de060e26efd4723cc2083c0e4e58f566a6c93f0192c95a178d364f58425b1451b5bb3071c8d2372788ec363b8560b1a827b55e4af634666e58656963d8f6d621cd3c8823be5af768e5b4eea2b59ac3d1391a391e137a931e1b2b2468d84b1efb03bb7916ee37d82fb36b79656be0c6698cdd8bbd1b1cd50c11877f5a477203dbcd07cd24f9701a21edcf47251ad41d2b59e945ae736b8712ce2e1246e1a40d86fd365919ac6e59689a8693ccd9aee1bb262d8a2e31e61af7876def017bd5386ca6a2d05631af15d9939628de5ac7131195ae6bcb413e04b76e7e6b5a0d78f15dadbba5f3d0ded807578e8ba40e778f0bc7aa47b490834301767b7daadf966c558c5ba7c3c6f9229cb0ba42d94b43fd42474e5e7c948e7ff191a47f557fea46b4b030e7ac7691632f97c7bea453e24321601c4d84097931cf1ea97f57103a717b14966ea59975fe97b31d795f0411dd12cad612d8f898ce1e23d06fb1db7ebb20c3da07f7bd39ff004829fd62adaab3aef1f76ee16ad9c7d7366ce32fc179b5da7d69446edcb47b7627e85b389d52dcc5d657af86cb42d2d2e926b550c2c888fc93c5b127f477410adc7d7b5db44d6e6607bea61e3745bfe4b9d238717bf6dc7c4abbaabd6a965bda7deb8eaf28acfc5431b662c3c05c24712d0ee9bec7a2b420a8767f1b6b1d474621c3056cdce2260e8c696b1dc23d9b92bcf673136cd0c96726f5aee4b213199e7ab5ac796319ee00721ed5b3a3aa59ab7b52bac579616cf9892488c8c2d1230b18039bbf51c8f31e4b59b5b2da3b317a7a38e972984bf33acba1ac477f56677cbe16923898e3cf60771cf97985b66862b10be19e264b13c6ce63da1cd70f220f55a19acde3f035629ee971324823af0c5197c92bc83b358d1cc9db750526b2ca64ff00b934f699c97a538ec67c9d735e087ccb893bbb6f26ac9aca8e4db73099fc753fb212e2267ba5a8c3b3a5648ce17166ff00943a80832fdb5e55dcd9a2f325a7a713a069dbda3bce4b47b327b9f473cd355f51acce58e1aefdb78416b1dc3c891c8b8f45b4ed71258608b1ba673935d77210cf4cc0c61febc8ef540f76eb1f677472942ae7065e3736d4d989a52feecb1926ec8fd666fd5bbee01f620c183a104ddacea8bf2303a6ad5ea47113f921ec3c5b7b7d41fbd6cf69b6268b464d0c424dadcf0d693ba203cb1ef01c06e40dc8e5cfcd65c1d4b30ebfd53665af2b209d948432b984364e18de1dc27a1d891bedd14b6a0c341a87076b1561ee636c3361237ac6e0416b87b43803f04119573d352ab155aba2f370c10b03238d8dac035a39003eeca2f27264729a930592a5a63294ecd4b4239ec58ee034d67821ed3c321276243872f02b6eb6a8cc61eb0afa93057a49e201be998d84d88a7feb6cdf5984f910b7b139dcae6729bc783b14714c8cf14f7c775348fe5b0647d40ebb976dd7d9cc2c08888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888838676fff007f313f367fd65d9b0df78e87cda3faa1719edffefe627e6cff00acbb361bef1d0f9b47f5420dd44440444404444044440450793d69a6f0d79f4b2398af5acb002e8de4ee011b8f0f25a9fdb2346ff9c34ffd23ff000416745a58acc63b394fd33196e3b55f88b3bc8cf2dc750b750111101111011110114645a831f3ea39f011c8f37abc02791bc0784349007add37e63e9f7af56b355a9e72861e464a6c64192be27340e002300bb73beff9436e45048a228cb9a831f4739430d3c8f173201e606b584821a373b9f041268888088b4b2d96a584c6cb90bf377504406e76dc924ec0003a927900837514162754372b75b55f84cc5073d85ec7dcabc0c701d7982763ec3b29d404444045ad7b214b195cd8bf6e0ab08eb24d20637e92a07fb63e8fdfefec1b7e770bf87e9db6416745ab8fca63f2d5fd231d76bdc877db8e0903c03e5b8f15b48088bcbdc18c73cf468dcec83d228fc1662bea0c2d5cb5464ac82d338d8d9400e0372398048f0f352080888808888088b0dab0ca7526b520716431ba4706f5200dcec83322d3c4e4a1cce26a64eb35ed86dc4d958d9000e01c371bec4f358303a831fa931eebd8c91f240d95d1173d859eb37af23e0824d11101114661f5063f3b25e65091ef342c3ab4dc4c2dd9edebb6fd5049a2220228ccf67f1fa6b1bf6432723d90778d8f7630bc9738f2e414975083ea222022220222202228e9f375abea0ab857b25362d4324cc700380358403b9df7df98f04122888808888088a3a1cdd69f505ac235928b156064ef710380b5e48001df7df91f04122888808888088880888808b05eb71d0a162eca1ce8ebc4e95e1a3990d049dbdbc978c66422cb62aa64a06bdb0db819331af003835cd046fb13cf62836911101111011110111101111011110111101111011110111107970dd847985cd7310fa3e5a4681b071dd74b548d614cc53b2c01c8f22b334eba5a9f6f17d6b175f1faa3f48245f1a771bafab85cf86d4bcc4c38598d3ea2f88b5e626181111360bcca766af4bc4df217a1e9d33efc254f2e87a72574b8685ceebb6ca5543e97fbc90fb94c2eceff0094be97c59de0a6fea0444516c0a347df5937f20a496839bb6489f30a74fda9cd1da3fbb7001e4beecbe85f557a5b0f3b26c17d5e79ee9a36fbb226ebe6e3cd3fb32fa54367ec8828bc6fcc8e4a59ef01a492aab9073b2b998ea339c6c70e257e0afcbaa5a5cabfc7a63cca73015bd1b171b4f570e22a4d798d8238dad1d00d97a55da7aa665b54af4d620444514c444404444044440444404444044440444404444044440444404444044440458ac5882a577d8b334704318e27c923835ad1e649e417b6b9af607b1c1cd70dc10770420f488b0d9b75a9b1afb562281af788dae95e1a1ce2760d1bf524f40833222202222022220222202222022220222202222022220222202222022220222202222022f114b1cd1892291b230f4734ee0fc57b4044440445e1d2c6c7b18f91ad74876602762e3d7979a0f6888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888838676fff007f313f367fd65d9b0df78e87cda3faa1719edffefe627e6cff00acbb361bef1d0f9b47f5420dd4444044440444404444151c07e32f56fea68fd47ab72e7d0e2ae64fb4bd4fe899ab78ceee1a7c5e8cd8cf79bb1db6fc6d3d36f0f3535f6ab97ff3d72ffeae0ff9682ceaab2f6818e63ec578695eb5761b7355653ad17792c863d839e003b06731cc90ac95617d7a914324efb0f8d81ae9a4003a4207ca3b00373ec54fecf6857664b55e40301b12e6ec425e7a86348200f8b8941b0cd7c2ada821cee0325868acbc323b33b5ae8438f40e7349e127dab6725ace2af90971d8ac55ecd5a81dc338a6c1ddc2efcd73dc4007d8b7358d586ee8dcc579d81cc75294ec47421a483f0201f82d6d034a1a5a1b11dd0f5ac5565995e79b9f248d0f7389f13b941e70dace0c8e5bec3e431b7311922d2f8e0b6d1b4cd1d4b1e0ecedbc7ff052d98cc51c163dd7b21298e1690d1c2d2e73dc4ec1ad039924f82af7682c6b19a7eeb46d357cdd60c7f8f0b9dc2e1ee20fee53f99cc63f0740ddc8c9c1171b58c0185ee7bc9f55ad68e65c4f4010401d7390737bf8745679f54732f746c649b7988cbb72a7f099ba1a83191e471d29921792d21c385cc70e45ae07a10a23edb328ff005a2d199a730fc92f30b091ee326e147f67f33e4cd6aa0ea52d00ebec94d694b7898e7c60b89e12473db7e4505922cd57935358c236178b10d5658749b0e12d738803cf7e47e950b9cfc66696f9bddfaac4a9f8dac97ec783f98f4ce7e3334b7cdeefd562097bb9df43d458ec3fd8fb52fa736477a4b19bc51708df671f6ffbc79af77b355e967f178a9217ba7c8b66314800d98236873b7f1e7b8e9e4a4d54b507e323487e85efe5b104d66b395f06da4eb2c7b9b72e4751a5bb6cc73f7d9c77f01b28576ba9ad39cec2699cae52b0df86d31ad8a293dac2e20b87b405afda7538b238dc1d29f7eeace72b4520076ddaee207f715736319146d8e36358c600d6b5a36000e800410da735551d48d9d904562adbaae0db14ed47ddcd113d371e47c0aac768398bacbd86ac30375f1439aaef64c1d1f05820388634716fb93e600e4a4efc6daddac62678806bee636c45311f9418e6b9bbfc4af5afbe5698ff00a4157f83d04b6233377253491dac0ddc6b58de21259746438efd070b8a8a935f416a7961c061f239c10b8b1f3d5635b0070ea048e2013eedd64ed22dcf4b4164e4ad218a47b590f783f25af91ac71fa1c54f6371d57138e831f4a16c55ebb0318c68e807fbfc49411187d67472991fb1566adcc5e48b78db52f45c0e91a3a96104870f71f02b7750e67ec262fbf8e1f48b5348d82ad7076efa571d9addfc07524f8004a83ed3a1647a49f998c065dc44b1d9ab2f8b5c1ed046fe441d88f72dacb1f48d77a721782191c16ec869fcf0d6307c4091df4a0d6fb0f87c05676a1d5f6e1bb7f971dab0de26444f4642cfc91e5b0e23d4ace35cd7038e4d3d9f8aa78d97e3cf006f99683c7b7fd558adc6dc9f6a356adaf5e0c5e37d3208cf4333e42ce3dbc766b4ede44ab6a0a259a986cb66f8b4a4cda199f416de8af556b7d1ec30bdcd0c9003ebee5a77dc6e3c0ee36561c3e7e4ca69f92f9a2f176b71c562931c389b333e53013b0e7cb627c082a07118b8317daf657d1fd58ed62e3b1dd8e8c7194876c3c3720bbdee2a530c3b8d71a8ebb3fbdc91d4b240e81ee6bd87e91135057313aa733f6eba849d39969c18eaed504d16f5fd5773d8bf61c5d79797357aad6a5bb89f489e9cb4e47b1dc504c5a5ecea39f0923dbd7c557f01f8cad5bfaaa3f51ead33ff004793f40ff041cef45eaeaf8cd1186c6d3c7ddcb5f6d60f92bd28f8bba05c762f7120377f0e7ba9ea3aea376560c5e6b0f7b0b62d3b86bbac86ba295df9a1ed24717b16b764d8faf47b3cc73e160125a0e9a67edcdee2e239fb8003e0b3f69f0325ecfb27211b495dac9e27f8b1ed78208f23ff001416a7bdb1b1cf7b835ad1bb9ce3b003cd54fedf9b71ce760b4fe57315da4836a18dac85db723c0e791c5f00bc76916a6fb4811c6d908bd3c15e510901e58f78e268dc81b91cb99f15b95b3f353ad156ada33371430b03238d8dac035a39003eec836f05aaa867a69aac71d9a77ab8066a5722eee6603d0ede23da090b3e7750e374e536dac94e5824770451b1a5f24af3d1ad68e64aace464c8e4f53e0f274f4ce529d8ab67bbb13d8ee434d67821e0f0c849d8ece036f02b62b44dc976b17a5b438fec45089b518ee8d329717bc7b7601bbf920fb26bcb9030d99f4667a3a639997b9639ed1e6630edc052f67274b33a42de431f61b62b4d4e52c7b7c7d53cbd847420f4532a372d0435f4ee463822644cf4699dc2c6868dcb492761e64ee834b427e01e0be6117d50b73019aaf9dc73add585f0c6c9e48785e003bb1c5a4f2f32169e84fc03c17cc22faa168f66bf83137ed1b5fcd720cf6b5d636a59bb55f5edcb6aad915a3ad047de4b65fc01e781a0f400f32760169cdda04d8f0db199d2d97c75171d8da731b2363f6bc3492d1ed58b4963eb9d7fabb22e6074edb3142c71fc86f76d276f79db7fd10ae73c315982482663648a56963d8e1b87348d88283ec334762164d0c8d92291a1cc7b4ee1c0f3041f251f85cd57cc3f22caf0be2f40bafa927101eb3da1a4b86de1eb050dd983dceecff1cc7b8bbba334409fcd6caf68fdc02f9a0ffa46a9fdbf63ea46837f39abf1f85bb1e38436b219295bc6ca54a2ef25e1fce3d0347b4951c35f8a7346dcf69fca61e095c1a2dcec6be1693d38dcd27877f6af3d9d44db34b279b98715dc8e426ef9e7ab5ac796319ee0072f7ab6cd0c56217c33c4c96278e17b1ed0e6b879107aa08fd419bad82c41c8d989f3c4248d81b1ec492f78683cfda415b593c953c3e3e6c85f98435a11bbde413b73d80d873249206c3cd573b4c0068b9001b016ab7f398ac396c9d1c36365c864a66c356100bdee04f8f2d80e64efb6c020ae1d737e66f7b47466727ae3fc2491b222e1e6d6b9db9fdca6f01a8286a3a0eb745d20eede639a1999c1242f1d5af69e85460d5d919471d6d1d9a9223f25ef10c648f3e173c11f1519a36ccb635eea9924c74f8e33475247d798b4b83b85e38bd524730078a09ecaeadc6e172a68df2f883693ad9976ddbc21ed67081d4b8970d801cd45c9aeb20c8cd91a2b3a69b79ba431b049b7988f8b88ac193c7d7bddb0e25f6181fe8b8a927603d38848003f0e2dc7b402aee83430d99a19fc5c592c74c25af28e476d8b48ead23c08f250d91d6f1c3949f1788c45fcd5bac40b1e8ad688a127f25cf71038bd8b06918db5357eb0a308e18197619c34740e9220e71f89582a479ad197b2623c2cb97c6dfbd25d6cb4dedefa22fd8b9ae6388e2e639107a2094c56ad37b2acc5ddc1e531969ed2e61b108313f61b90246923a79eca2b5264a9e23b44c4dfbf3b60ad0e32cb9ef7787acc1f124f203c54ce2358e2b2f7fec6816a964384bc54bd5dd0c840ea46e3677c0950da831d5f21daae9b1658246d7a96276b48dc1734b784fc09dfde020d87eb9c8701b10e8bcec951bccc863635e47988cbb88fb94f60f394351631991c74a6485c4b4870d9cc70ead70f023c948aa86988db5b5f6b0ab08e184bea58e01d03df1bb8cfc4b41413833701d50ec0775277eda42e779cb8384bcb36f3df70a4d549bf8e197fe8fb3ffe4395b504662737065ece4a0862918ec75a35a42fdb6738341dc6de1eb2ac4b97a383ed1b397b21388616e3aab47225ce7173f66b40e649f20b77441df2daaff6cbff0096c5a70e32adced96edbb0d0f7d3c6c2e85aee6038b9c38b6f303703f48a0db3ae6ec60cf2e8ccf3698ff0a2161781e663e2e2015830f99c7e7b1b1e431965b62bc9d1cde441f1041e60fb0ade54ec442cc4f69f97c7d40195afd08b20f8dbc9ac978dcc7103c0b8004f9a0b8aaa4daf6bcf665af81c464338e85dc124d518040d7788ef1c4027ddbacbda35eb18ed0396b155e6397b911878ead0f70613f00e2a6b158cab86c556c6d28c470568c31807b3c4fb4f53ef411385d65532b9238ab546ee2723c25ecad7a30c32b4752c70243805b19ed558dd3ef82bd813d9bb67fbc52ab1992697da1be5ed3b052cf8219258e57c4c74916fddbcb412cdf91d8f86eaa5a3e165fd4da9f356007dc8f20ea1197758e18dad2037c812e24f9a0f4fd7cfa2deff0033a63318da7e369f13646463cdfc0496fd055aab5982e568ecd69593432b43e3918776b9a7a1057b7b1b231cc7b4398e0439ae1b823c8aa8f67ec144e7b0b1126ae3726f6561bf28e3700fe01ee2e3f4a09dd4bf82f96f994df50ad7d17f80f81fd9b5ff0096d5b1a97f05f2df329bea15cfe2d5793934050a1a56acb6a4a38caff642e4401f471ddb78991efc9f2edb9dbc3de82f6751d693508c253865b76236f15a922dbbbaa3c38dc4fca3e0d1b9f1e4179ceeaac7e06686ac8cb16ef5804c34a9c5de4d201d4ede03da481d534957c341a76abf024494e76f7a262789f338fca73cf52edfaefe3cbc15574fe5268f546a6c93b0192c95afb20ea8d9eb084b638a30de160e391a475e23b0d8ee104b0d7c29b9aecee9fcae1eb38802d4d1b5f1337e438dcc2787e215b18f6c8c6bd8e0e6b86e1c0ee0855cb39f9ee5696b59d199b96199a59246f6d621cd3c883f765eb41d6c851d2b0d2c8d79a07d69248e164ee697f721c7bbdf8491b86903af820b1a222022220222202222022220222202222022220287d4749b6f1cf07c398530a37392965031b46ef90ec029e3df5c694e7ad6d8ad16f0e64e9cc47876df63b27a51f16956ec7e948ced2d8e6e3cf652bf6bb48376ee87d0b39f8fc7bdb7a72d1e91368db9f36d349d8f259daf6b8722acd92d270c8d2e846c554ecd59f1b3f04a0ede6bcde47a662bd77568727d3ed899d1788de1e370b22e539186715ba65e4da262742c72fc8591639be42d8f4eff005e19a79740d2df78e1f729850ba51dbe1221bf4534bb4bfe52fa5713be0a7f68111141b22d0f959177b02dd73831a5c7a00b469b4be47ca7f28f253af89953967c437d111416be12b1be56b1bbb88093482361738ec02a4ea1d40e7ca60aee27c392b71e39bcb5b367f6e13990d4f56a12d0789c3c375092eb77f11e083e92a3f1ba7ac645c2597700f324ab143a46a068e36ee7c56d4d3163ed2d0ebcf97bc22ddac649dbc0211c4ee439a9ed3745cc89d7261f7494efee0b4a7d270021f08e17b7a294c5db757da9da1c2e1c9aef02a3926269aa27c7acc65de4ff00c261111693d61111011110111106b6468c593c758a339788e78cb1c58ee170dfc41f0214168cca5b743670196938b2b88708a479ff00d2223fdee51ef1d7da0eeaccaabac69d8a3356d598c88c9731608b1133ad9aa79bd9ed23e537da0f9a098cfe6a0d3f869f233b4bfbb1b47137e54af3c9ac6fb49202d6d2b8bb98cc499729399b2571e6c5b7176ed63ddf90df26b46c07bb7f15118eb116b8d491e5a2777983c41fee42472b3648e726c7c180ec3fac4f92fbac5b2e733b8ad24d9a486a5c6c966fba3770b9f0b3602307c9ce3cfd8104a4bae34ac16bd165d438e6ca0ec41b0dd81f2277d829a8a58e789b2c523648de376bd8770e1e60ad0834ee12b5314e1c452657036eefb86ec47b7973f8aade269b747ebb6e12917371198af258af5c9ddb5e7611c619e4d2d76fb79a0b78bb54df340588fd28442630f17ac184edc5b796e3659d54a3fc704dfb023fe7b95b5060ad76adc7cecad62395d5e4314c18edcc6fd81e13e47621787e4e8473cf0497216495a3124cd73c0eed877d9cef21c8f3f62ae688fbe9aaff006cbff96c51367070e7bb5abf0de025a1051af34b59df266782e0c0e1e2d1bb8edd090105d7179ac666a2925c5de82e4713f81ef85e1cd0edb7db71ef5bcb1c35e1ad188e0859130746b1a1a07c02c882a9a6e695faeb57c6f91ee647355e0697121bbc209d8782b5ae7b46c67a0ed07568c363e9db6996af786cd97445a7b81b6db35dbf8a9bf4fd71fe41c47fb45fff002d063d4334aced0b4844d91ed649e9bc6d0e203b6886db8f156b5cf6d58cecfda3e93fb33429d403d33baf46b2e978bee237df76b76f05b9da1e421758c469eb79266369652491d72cbe6117dc630096071236e22e03e9413336b6d2d5edfa24ba831ec981d8b4d86f23e44efb0f8a9b8e464b1b648ded7b1c376b9a77047982aab05fece6b5214a1bda69b5c0dbbbefe020fbf9f3f8a8ed2577158dd656f0383c9d6b989b758dd82282c3656d5903835ec1b13b34ee1c07873416dca67b118568765327569f10dda269434bbdc0f33f05e311a8f0b9e0ff00b1593ad70b3e53629017347991d765177eae8bc0e4e5c9654e3a0bd6dfc666bb235d21f0f578c92072e8392ac6abcce9375cc4e5f0392c79cb56bf0b7fb95ede39a273b85ec76dd46c7e082d7da0fe2ff39f337ff05b2fcde330781a32e4afd7a6d920688cccf0d0e3c20ec375adda0fe2ff0039f337ff0005275628e5c1561246d78159bb71341dbd5082b9a53b44c3e5303425ca6671f0e4e76ed240240d21c5c401c24efe4b3768bf7a319fb62a7f302f3d99d6aeeecf30cf741197f724f1160dfe5158bb53658934c548ea4822b0ec9d6113c8df85fc7c8fc0ec826f27abb4ee1a735f2399a75e61d6274a38c7bc0e616fe3f25472b55b6b1f6e1b703b90921787b77f2dc78fb1696234b61f0b51b0d6a30b9fb7dd2c4ac0e96671eae7b8f324955f18fafa63b4cc733171b6b54ced69db62b443863ef6201c1e1bd01d9c47241762435a5ce20003724f82827ebad291daf467ea2c70937d8ff7437607dfbedfbd456a889da935763f49c923d98e155d7efb18e2d33b03b8191ee3c38b727cf65626e9dc23697a10c45115b6dbbaf4767091eed906fc723258db246f6bd8f01cd734ee083d082a2325abb4e61e630e43354abca3ac4e98718f7b4730b361f0147058e931f47be6d57c8f7b6374a48883bab587ab5be43c3750913bb3fd26e343bec3d399a367895ec329fd327d627de82c78eca50cbd516b1d720b701e5de42f0e1bf972e87d8b258bb56a3e06599e389d62411441eedb8de4121a3ccec0fd0a838dbf808fb50a6ed3376a490e529ccdbb0d4782ce38f6731e40e41c77237f7added3ab4f721d3b56b4eeaf2cf988e31333e5461d1c80b87b40276f6a0b3c5a830f3654e2a1c9d696f004babb240e7b76ebb81d3e2b36472b8ec457f48c95eaf4e2df60f9e40c04f90dfa958f1584c6612a475b1b4a1af1c6361c0c1c47da4f524f892a83a7325a57337edea5d4996c53ee4d3be3a956ed98ffb8e0638b5a031c7938edc44edcf7f6f30bce2b52e0f38e7371795a96ded1b9645282e03cf87aeca51507533f43e5a83e6a59ec253cad71ded3b905b85924720e9cc1e6d3d083e055a74c65ce7b4ce3b2ae686bed576bded1d03b6f580f66fba0955a995c9d5c362ece4aebf82bd68cc8f23aec3c07b4f40b6d543b4a024c051825e75a7cad58ec03d0c6641befecdc041ad430d9ad655db93d4390b78ea5607157c55294c5c319e86578f59c48e7b7203f72da3d9b61a01c78bb794c5d81d27af7e4277f6871208f62b7220a9e9dce652ae765d2da8dec9af322efaa5d8d9c0db916fb1ddbd03c7881ff89b2cd76ac16abd59ac46c9ed717731b9db3a4e11bbb61e3b0e6aadad5a23d43a46d45fd25b94ee9bb75eedf1bb8fe1b00bdea3fc61e8dfd3bbfc8416d581976abeec9459623759898247c41deb35a7a123c8ec567552c7fe35b31fb32bfd77a0b34976ac36e2a92588d96266b9f1c45db39e1bb71103d9b8fa56ad0cfe232b6e6ab8fc956b73403795b0c81fc1e1cf6551d6d8b39ad7ba6b1cf95f1d79e0b42cf01d8be31c04b37f00ed803ec255de9e3e963a16c14aa435a268d9ac8630c007b820d8545cc62eae77b538b1f90efdf559843308e3b124438c4fb6fea387812af4a9966d57a9db031f6678e161c0101d23c3413e90397341bbfdafb4fb01f47191ad211ca48b276439beedde42c188b992c16a96699c95d932156d5774f8fb736ddf7a8471c6f23e5100821df4a9c9b50e12b46649f3142260fca7d9601fbcaae50b03576b9a99aa2d73b1187af2c70da2d2d16669360ee0dfab5a1bf2bcfa20b53f25463b135792dc2c9608c4b2b5cf00b1877d9c7c8723cfd8b0e3b318acf4331c6de82ec51bbbb91d0bf8803b74dc7b1536f60e2cf76b966bddfba50871b04d3573f267707bc303878b46e4edd09015f60af0568c475e18e160e41b1b4340f80411ba5e8e131d81860d3ddd9c78738c6e8e43202788f17ac49df983f42d9c9e6b1785884b94c856a6c77c933ca1bc5ee07afc156bb39b2ca7d9854b52025900b323b6f213484ff05e344e9faf92a0cd579b863bd95cab44fc53343db5e33cd91c60fc901bb7b5059315a8b0b9ce2fb1794ab71cd1bb9b14a0b9a3cc8ea16f589e1ab5e5b36246c50c2c2f91ee3b06b40dc927c80559d5ba4296431d25fc742ca398a6d3354b75da18f0f0370d247569e841dfaaf3772df67bb25bb952d0d75ac34d23da3a35ddd3b880f8ee8262eea5c1e39903ae65aa402cb43a10f9403203d0b47523dab1e5f1d83b997c458ca7766ed795c6807c85a4bf604ec01f58ecd079f9289d05a6e9d3d3947236618ece46e578e59acc8d0e7005a385809e8d6b76000f2dd7dd5bf85ba43e7d2ff25c83eebad6b534ce26c0af7e9b72ac3118eb4ceddc5ae91a1c787707e4f11f8295c7eabd3f95b42ae3f334ed4e5a5c238a50e76c3a9d8286ed4a188e83bf218d85e24ae388b46ffdfe3f156b65682277147046c779b5a0141e695dab91a91dba5623b15e51bb258dc1cd773db911ed0b3121ad2e710001b927c15434e7fe6feaeca69a77ab56d6f91c7f906b8ed2b07b9fcc0f272d9d756e77e32be068bcb6ee725f45638758e2db795ff066ff0012105829dcad90a91dba73b278251bb248ceed70f305675869d482852829d6608e0af1b638d83f25a06c07d0b32022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220e19dbffdfcc4fcd9ff0059766c37de3a1f368fea85c67b7ffbf989f9b3feb2ecd86fbc743e6d1fd5083751110111101111011110511b919701da0ea1b5630f96b105d8aa0865a946499ae2c63b8b9b46df9414a7dbcd6ff206a3ff00644dff0005674411f88cbb33159f3c74ef540c7f0705dace85c7903b80eea39f550fa22a59a9f6c3e935e587bece59963ef185bc6c3c3b386fd41f35684411da862927d37938a263a4924a72b58c60dcb8961d801e2561d250cb5b4761609e27c52c58f818f8ded2d731c23682083d083e0a5d1055f5dd4b3731f8a6d5af2cee8f2f564788985c5ac0fdcb8edd00f12beeb9c6e46dd4c6e43175c5bb389bccb7e8a5db77cd00873413f95b1dc7b959d10553edeccb188eb698cfc975dc85692918c34ff5a477a807b775834352cc56ccea49f3507773dab31481cd61119de31eab09f941bf277f62b9220abd5a965bda7e42e3abca2b3f150c6d98b0f039c24712d0ee9bec7a2fb98a9665ed0b4dda8ebcaf82082e09656b096465cd670871e837d8edbf5567441137735354d458ec4b3176a78aeb6473ee307dce0e11b80e3edf8751d546e72a599b5fe96b315795f040cbbdf4ad612d8f8a3686f11e83720edbf556844157d7152cdb6e03d1abcb3f739cab2c9ddb0bb8180bb771dba01e255a111055f2952cc9da3606d32bcaeaf154b4d9256b096309e0d813d013b1d935b54b36dda77d1abcb37739caf2cbddb0bb81803f771dba01b8e655a11068e6b135b3b86b78bb60f736a231b88ea37e847b41d8fc156e96a1cde9ea6ca3a8f0b7eebe01c0cc86361efd93b4720e7341e26bbcc6db6eae4882976e2cb6b8b55ab4f8b9f17808656cd605cd9b3db734eed670027859b80493ccede0b775817636d627520697458b9dcdb7b732daf2b785eeff00aa431c7d8d2acebcbd8c9237472343d8e0439ae1b820f81082b79ec6ddfb294b54605b1dab55e17432d7e30d16ebb88770b5dd03811bb4f4e6b18d74c7b0471e9bd40eb6797a33a839a41f6bc9e003dbc4bd4584cd69dfb9e9d9ebdac783bb71d7dee6f723ca2940240feab81dbc0859466f53f1161d1ee0ef07fd918b83e9f95ffd282bb5c6674eeb293526728dab0dcad3ee9d1e3e2758151ed78e08fd51b91c3b7adb6c5dbf82b2e98ab724b192ce642abea4d93959ddd7936e38a16378581db7471ddce23c38b65278b7651f54bf2d1558a773c96c759ee7b5ade5b02e701b9ebcf6016ea0a55a9ec696d7591ca4f8ebb6b1d97ad08efa9c0e98c3245c436735bcc021dbeeac98fc8c996c5c964e3edd2e2e26b22b4c0c91c36e4ee1dc91bf91e7ec522882b7d9e55b14b41622b5baf2d79e38767c52b0b1cd3c47a83cc2fbda0d5b17741e5eb54825b13c906cc8a261739c771c801ccab1a2088cc6122cfe99931361ce8bbe89a1b20f951bc6c5ae1ed0e00fc144d7d5397c45615f52606f3e78b66fa5e36136219ffadb37d6613e442b6a2080c46732b99ca12cc1cf4714c8cef35e1ddcd2bf96dc31f50d037dcbb6df7f62d6cfe2729573d5f536061659b2c87d1ae537bc33d261df71c2e3c83da77db7ebbecad0882a52ebb901ee20d27a864b879361753e06efed937e103dbb9527b65ace91b3f65208599096b4bc5055ddc1bb83c2d07c4edb03b753d14d22084d175e6aba2b0d5ec42f8668a944d7c7234b5cd21a37041e60ad2ecfea59a5a7658add796bc86fd97864ac2d25a65710763e047356844157d2f52cd7d4baa669ebcb1473dd8dd13dec2048044d04b49ea37e5c95a111055fb39a9668e8bab5edd796bccd9ac131cac2c70066791c8f3e6083f14d1552cd59f521b35e5844d9b9e588c8c2def185acd9cddfa83b1e63c95a110539b5b2da3f317a7a38e972984c84c6cbe0ac477f56677cb2d692389ae3cf607707c3cfecbacb2993fee4d3da6725e94ee467c9d735e087ccb893bbb6f26ab8220abf68552dddd20f82b5792cce6cd67164319713b4ac2480373b00095975d622f65f4fb46318c96e53b515b8a179d9b318ddbf013ed0ac6882a6cd79c5086bb4c6a06dd3cbd1bd05dd7f4fe4ededdd6ae90ab9c1ad33f90cd5335dd720ac636b4131b00e31c01fd1e40db723c4f96caec882af354b27b52ab705794d66e1e48ccdc07803ccad21bc5d37db9ecad08882afa7aa59875beacb12d796386c4b54c323d8436402100f09e8763c8ecbe49abeee3669a1cc699c9c7c0f3ddcf462f4a8a46efc8eede6d3b781015a51051e7b13eb3cee126a389bb4eae32d7a4cb76ec061247091ddb1a79bb8b71b9e83652190a965fda561edb2bcaeaf1d0b0c7cc184b1ae259b02ee809d8ab42202abe0ea598bb40d53665af2b209e3a42295cc21b270b1e1dc27a1db71bedd3756844152d4b4f258dd4b4b5562e93ef88abba9dea916dde3e12ee20e603c896bbc3c775906b49ee34c38bd35999ad1e41b6aa9ad1b0ff5defe407bb73ec5694414eecf71791c53b3ecc9891d3cd9374a6674658d98b98c2e7337eade2dc0f72d0c9e3b5043da4ddcf61eaba5ee2942c30cbbb23b6c25dc6c6bcf20f1b348fdfd57404415366bb7cdbc30694d42eb63977325311b41f6c85dc207b775b3a5f0b90af6af6733662fb29912d0e8a277132bc4df91183e3b6e493e24ab1a20aed1b0dd71a5eec192c4dbc74760c959d0d81b3f61c83c7ffeea3c547d1cee6f4cd1663f50e1af5f158064790c745df36660e41cf603c4d76db6fc88f6ab9220ade233f99cee563741839f1d89635ddecd91677734aefc90c8c1dc0df992eea16adca396d39a92d66f1148e471f910d37e946e025648d1b0963dc80771c8b771bedbab7220a9c9acb217627c185d2d977ddf92d37abfa3c319f3739c7981d766efbad8c4e3a6d1fa52dcf2324c9e41c64bb6fb91eb5899dcc868f2e400f60e8ac88820ed5a9f33a1acd91467af3dbc7c84557b7791ae730fabb79afba2e88c6e8bc3d5357d1646d288cb116701121602ee21f9dc5befbf8a9b4414d8a85bd1da9b8b1d526b181cb4bf768208cbcd19cfe5868ff06ef1f0079fb165b74b2da6f50dacc62289c8e3f225aebb4e3786cb1c8d1b7791efb076e00ddbb83b8055b5105526d6f34ad7c18bd319bb177e4b639ea182307fad23b901f4ab252368d280de6c4db4636f7c2124b03f6e7c3bf3db759d1011110111101111011110111101111011110111107c276049f050f03cdfb6e99dcd8d3b30294b2ee1ad21f26951b85681546de6ada76acd9ab9f76bd68926b760bda04dd53b6cc46bb3c399baadea7c6473d47481bb380eaace547e59a3d0a4dff355b8e753a6a72b145a92e6351c41e15b8b498386dbf6e9c456eae6bd6b1f4e4dc3e7fc9af4de458e51bb17b421793c6cd18f245a5af59d4a674b679947fb92c1d984f23e4aef0d88a760746f0e07c972b30b495b743213e3acb1ec95dc1bf36eebb3c7cbc5c898d7974bc0f589c5118af1b874e5f1ce0d1bb8ec178af289e064a3a3802b52deefb4c8cf36edbecae8aee74eaed7d57aa1f2595f6dfc11f288753e6b6a28c31a00463034721c964dd2d6eda84694999eab085375f0a82dda1351def44a4ee7cc8e4a9d82a5f64720647f31ba99d6f211146df32bce8c63763e7baf4691d38ba9e364b7566e995b2b57642c0d6340002d9d97c1b05f765e7ccf54ee5eb529d11a87c3cd68646989a2247270e608521b2f0fe6de6b34b4d6c8e5a45a9dd831565d62a0e3f96cf54add5158d3c390b318f92362029552c91ab3386dd54899111141688888088880be2fa882a3d95003b36c46df9b27f35ebeeaf8ace33318ad5756b496a3c78921bb0c2de279824db77b478f0900ede5bab3d4a95a856656a75e2ad047bf0450b031addcefc80e4399599043c1abb4dd8a62dc79dc7f7046e5ceb2c6edef04ee0fb0a84c44c756eb366a182391b88c6577c14a57b4b7d264791c6f6eff00900340dfc4ab0cda730762e8bb361a8496473ef9f5985ff4edba910001b01b0082999db71e9ced128e72f9eeb1b7a81c7bec1f9104824e36979f007723753b77556071f57d227cad52d3c98d8e50f7c87c035a372e27c82939e086d42e82c44c9a278d9cc91a1cd70f683d56851d3782c658362861a85598ff008486bb18efa40415becd65b53bb524f72035e7972ef91d0b8f38f898c21a7da0100fb42dac6fe35337fb3ab7d67ab3c352b567caf82bc513a77f792963034c8edb6e276dd4ec0733e48da95996df6d95e26d891a18f983007b9a3a02eea40dca0cc88882a3a67f0fb597ebaa7f202b72c3154ad0589ac435e28e6b0419a4630074840d8711ea761c86eb320a8ea3fc6368dfff007dfc90bdeb4a53c76b13a8ab5475d38895fdfd663789d24123785e5a3c5cdd9ae03d855964a95a6b30d996bc524f5f8bb995cc05d1f10d9dc27a8dc723b7559904151cf695c9536dbab7b1ce888e7c4e635cdf6381d883ec2b260f3587cd4d6ce21a258eabc46eb31c5b45213d431fd1db6dcf6f30b35dd3581c958162f616859981dfbc9ab31cefa485210c315785b0c113228d8366b18d0d6b47b004141d19630d165f370668d68f501c8ca6436f84492444fdccb0bbab3876d80ff7ad7ed073b87b352be331420b73b6f567d892b6c5b59bdeb76e270e5b93b00debd4f82bd6470588cc6c7258ba970b46c0cf035e40f612392fb1613130521462c5d36550e0f103606867103b83c3b6db8201dd0457683f8bfce7ccdffc14be39bc785aadf3aec1ff00d2167b15a0b75df5ecc31cf0c8385f1c8d0e6b879107910bdb18d630318d0d6b46c001b0010527b3ccde331fd9fd482f5faf565c70921b71cd2863a17b5eedc107a2daed0ded7e1714f63839aecbd32083b823bc0a6e7d3782b390fb21630d465b7befdfbebb1cfdfc0ee46fbaddb352b5c63596abc53b58f1235b2b03835c0ee1c37e84781419954b50fe31f47fe8defe5355b56192a569acc3665af13e7afc5dccae602e8f886cee13d46e3aedd5055b5409b03a9e86ad8ebc962a475dd4b20d89a5cf8e22e0f6c800ea1ae1cfd854bb75769b753f4c19ec7771b6fc7e92ce5fbfafb3aa985153697d3f62e0b9360f1f258077ef5f5585dbf9efb7541a32e6e4d47a332977031d9648609994e47c7c0667069e17b075d89e84eca3b435dd22349d31524a10be281be96d94b1b2b6403d7326fcf7e2df995730000001b01e0a2ee696d3d90b1e9177078fb1313b9925acc7389f69239fc50540e671f98ed4b007151b5f4e086db3d2e26811ccfe06f135a7f2b8470f31cbd6f6297d73fd3f4afedc8bea48aca31f49b25791b4e00faad7360708c6f103b021a76f541d86fb792f53d4ad69d13ac578a6303c49119181c6378e41cddfa1e6798f3419950f03671da42dcfa6b38c8ab446c492e3ae4ec0229e37b8bf838cf20f6924107af2d95f162b15e0b70ba1b30c7344ef94c91a1cd3ef05041e5751e97c45612cd3549a4790d8abd66b6596571e8d6b07325496472d8cc0e37d3721623a751a5ade278d8024f21b05e2869cc1e2a633e3f0f46a4a77de486bb18efa405a7acf0f2e7f4f3b171d76cc2ccf0b642ee1fb9c7de34bde37f10d076db9ee504eb5c1cd0e690411b823c546ea3c243a8f016f133bcc6db0cd9b237ac6f0416b87b9c01f82920035a1ad00003600782fa82a589d651d22cc46ac7b3179588709926770c1680e5de46f3c8efcb972209db652b775769cc75733dace516300dc6d3b5ce77b9a0927e01485ca34f2301af7aa416a13d639a30f69f815a34b4a69dc74e2c52c1e3ebcc0ee248eb30387b8edc9041e261bbaab5443a96ed39a963b1f1b998c8271c324ae78d9f339bf9236e4d079f8f25eb5cbdd8bc8e0352ba37c957156a416b81a498e2958585fb0f069db75705f1cd0e696b802d236208e45045bb53e0194fd31d9aa02bf0f1779e92cdb6fa555f4a6424caf6939bbe617c55e6a101aa24696b9d107380710798e22091bf810acf0e95d3d5ed8b70e0b1d1d80771232ab0381f3df6eaa41b52b36d3edb6bc42c3d818f983071b9a3a027a90373cbda82b199fc67e9af9a5cfe0c56d585f52b496a2b525789f6210e6c72b980bd80f500f51bec375990151f238cc7e57b5d8e0c951ad7626e04bdb1d889b2343bbf037d9c0f3d89fa55e161f44ade99e9be8f17a5777dd77fc038f837df878baedbf3d904745a4f4d40fe3874f62e370fca6528c1fdc14b35ad63435a035a06c001b0017d44152a5f8d8ca7ec983f98f56d585b52b36dbedb6bc42cbd818e983071b9a39805dd481bf45990537b368196bb33a75a51bc737a4b1c07919a40562d239dafa7e9c7a5350588e8dec70eea1927708e3b7083ea3d8e3c8f2d811d410ae356a56a35db5a9d78abc0cdf86289818d6ee773b01cba927e2bcdca14f230182f5482d447ac73461edfa0a0adea5d5f4db4e4c5e0e78f2799b8d3157af59e24e0246dc6f23e4b5bbee495eb21896e07b28bd8a6bf8fd130d3465ff009c444edcfc4ee54fe3f158ec4c3dce3a856a719ead8226b01f7ec16c4d0c56609209e264b14ad2c7c6f68735ed2362083d410823b4bfe09e1fe6307d40a1b56fe16e90f9f4bfc972b545147044c8618db1c71b4358c60d8340e4001e01789aa56b134334d5e296481c5d13dec05d1923625a4f43b72e482b7da6c324dd9f64fba639e63114c43473e164ac7b8fd0d254cc1a870d65b54c394a8ff4cd8570266ef21db7d80df75204070208041ea0a886e170580658c9d2c1568e68d8e7b8d3a8def5fb0e61bb0dc93e482375e559a1a15751d2617dcc14de921adeb24246d333e2cdcffd50b06999e3d53a9ef6a961ef28d767a0e35c47270e4e9641ef76cd07c9abc6575c52cc63a5c5e99749772d71a61646607b457e2e45f27134708683bf3ebc95930588af80c1d3c5551f72ab10603b6dc47c5c7da4ee7e2824111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111070cedff00efe627e6cffacbb361bef1d0f9b47f542e33dbff00dfcc4fcd9ff59766c37de3a1f368fea841ba888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888831cecef207b3cda4280c15bd83ebc8367c6ed88563558ce50b34ee0c8d469734ff007c6b7f8abf0ea7749fdb4f935b46af5fd2c6d217a5038dd41059680e770b87505498bf0edb891bf4a85b0deb3ad254e4d2d1b996d74505a96f0af41e3ab9c36eab2deced7aed203c176dc805110e32e6a0b026b20c75c1dc03d4abb162e9f9dfb428cf9bdc8f6f1f7953a171ef3888db72b74157bb1a5e8cd58c4230d76db070f054ec9e12f62de78985f1f8382d1e7f12bcc8f8f9733cff004ccd8e7af5b86b22c4d987470d8af61eddbaae5b37a5e7c7fa78934987a58a6e8b20703e2b1cc7d557fa761cd5cf1b866913b748c049de61abbbfa817a9cff00e5168f26ac1a608383afec685967701921b9dbd55d66be72fa1d677c7a4ff66fb7a22c46568e7bac6fbd0c7f2a403e2aae9b4cf86c7bb4ac796ceebc48f0d6f55077352d481c5ad7f13bc828a7e472d95716d389c187f28f20afa71ed3de7b435afcb8fc6bde5ef52f777648a161dde5fd02fb868dd8cbddd48360fe616fe174dc95ec0b77a40f97c079291cbe33d3200e8766cb1f369574e5a47c23c28af1f24d6724f96f31c085ed57e866046ef47b7bb246f2f594bb6dc6f6ee1e08f7ad4be2b567c3731f22b68ef2d95af6a61144e713b6c17892f43134b9d23401ed55cca65e4bf37a15205ee7f224740a78b15ad6dcf8433722b15d57ca4f4f39d626b5689e4f7708f829d5a388a031d41906fbbbab8fb56f28e4989bccc2fc159ae3889111156b84444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044440444404444044441c43b7baf3cd9bc498a192402b3f72d693b7acbb161c1184a208d88ad1f2ff00aa16ea20222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202f85a1c0823707c1110455ad358eb4fe3e0744eea4c676584695a83ff0048b1fe90ff008222b632de3b6d4cf1f14cee6acd5b4de3eb3f8cb5d2bbff007877528d6b58d0d68000f0088a16bdade653a63ad23558d3d2f12451cade19181c0f81088a29cc6d176b4c632d7331161f361d9464fa1aab8ef0d9919efd8a22b3dcb78db5327078f93f2a4318d0a074bc7fd143a141eb74edfa288a317989dc28ff002ae27fd9ff00d58f1b41b8ea6caec717068db72b15fc6bedcac9629cc4e68d8f2df744598bda2dd5fb6f4e2a4d3a35d9a8ec25a70e77cffa2b08d2a2476f62ecaf1e4de488a7efe48f12abf85c5f4ddada771b5b98878ddf9cfe6548c70c7137863635a3d8111576b5ade6575695afe30f6888a29b4af626a5f1f758f677e7379151afd32e6f282f4ac6f91e688acae5bd63512a6f831de7730c7f6a8643b58bf2bdbe439295c7e1e9e35bb411f3fce773288b36cb7b46a64a71f1d277586f2222a97088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088883ffd9, 0xffd8ffe000104a46494600010101004800480000ffdb0043000a07070807060a0808080b0a0a0b0e18100e0d0d0e1d15161118231f2524221f2221262b372f26293429212230413134393b3e3e3e252e4449433c48373d3e3bffdb0043010a0b0b0e0d0e1c10101c3b2822283b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3b3bffc000110800c8078003012200021101031101ffc4001c0001000203010101000000000000000000000105040608030702ffc40059100001030301040605080508070408070000010203040511061217213113559394d1d2142241515607151618455461923253718191445282a2a4d3e1e3232442434683a108336266253435647475a3b3363772b1b2b4e2ffc40014010100000000000000000000000000000000ffc40014110100000000000000000000000000000000ffda000c03010002110311003f00fb3000000615d6f36eb1d2255dd2ae3a5815e8ce9245e1b4bc93fe8a0668359de3e8df8868ff0032f813bc5d1df11517e7036506b7bc4d1df1150f684ef0b47fc4541da81b1835dde0e90f88e83b641bc0d21f11dbfb74036206bdf4fb48fc476eef0d27e9ee91f88edbde1be206c00a0fa77a4be24b67796f893f4eb497c496cef4cf102f8145f4e349fc496bef6cf127e9be94f896d5df23f102f0149f4d74a7c4b69efb1f8929acf4aaff00c4b68efd17980ba052fd33d2bf12da3bf45e625358e965e5a92d1dfa2f301720a7fa5fa63e23b4f7d8fcc4fd2dd34bff00115abbec7e205b82a7e95e9bf882d7df23f127e9569d5fb7ed9df23f102d4155f4a34f2fdbd6def71f893f49ac1d796eef71f881680acfa4961ebbb777a67893f48ec5d756fef4cf102c815df486c8bf6c5077967893f3fd957ed7a1ef2cf102c0181f3ed9fada87bc33c49f9f2d1d6b45de19e2067030be7ab52fda747dbb7c47cf16b5fb4a93b76f8819a0c3f9dadabf68d2f6cdf127e75b77dfe9bb66f881960c5f9cedff007ea6ed5be24fce343f7da7ed5be2064831fd3e897f95c1da27893e9d48bfcaa1ed100f7078fa652fde61fce83d2a9fef117e7403d81e5e9102ff00be8ff3213d3c2bfef59f9900f407e3a58ff58dfe24edb3f9cdfe207e8108a8bc9724800000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000353f948d2b5fac34cb6d96e969e2992a592abaa1ce6b7088e4f622ae78a7b0db001cfdb86d55f7eb476d27f7646e1f55fdf6d3db49fdd9d0400e7ddc46abfbddabb693c846e27567dead7dbbfc87418039ef715ab7ef16ceddfe423717ab7f5f6ceddde43a1401cf3b8cd5dfadb6f6eef291b8dd5dfacb776eef29d0e00e77dc76affe75bfb75f291b8fd61efa0ef0be53a2401cedb90d61eea0ef1fe046e4758ff3287bc7f81d1400e74dc96b1fd5d1778ff023727acbf5347de13c0e8c007396e53597ea293bca11b95d67f77a5ef2d3a3801ce3b96d67f75a6ef2d217e45f5a7dce9bbcb4e8f00737ee635afdca9fbcb3c48dcceb5fb841de59e27488039b7735adbabe0ef4cf123737adfab61ef51f89d2600e6bdce6b7eac8bbd47e62373bae3aaa3ef51798e9500734ee7b5c754b3bd45e62373fae7a9dbdea1f31d2e00e67dd06baea56f7b87ce46e875d752277b87ce74c80399b743aefa8ff00b5c1e7217e48b5da7d85fdaa0f39d3400e64dd26baea25ef30f9c8dd36b9ea1777887ce74e00398b74fae7a85fde22f311ba9d71d43276f1798e9e007306eab5bf50cbdb47e61bacd6fd412f6b1f98e9f0072feeb75b7504dda47e62375fadba827fcecf31d4200e5ddd86b5f87ea3f333c48dd96b4f87ea7f337c4ea30072deecf5a7c3f53fc5be246ed759fc3d55fd5f13a9401cb3bb6d67f0f55ff04f11bb8d649ff0f567e54f13a9801cb3bbad669ff0fd6fe51bbdd669f6057fe43a9801cb3f4035a27d8370fc8a3e826b54fb0ae5d9b8ea60072cfd08d6c9f61dd3f746e1f42f5ba7d8976ecde753003967e876b84fb16efd93c7d12d729f635e7b290ea60072cfd15d749f63debb2907d18d769f645f3b194ea60072cfd1cd789f64dfbb197c07d1fd789f655ffb09bc0ea60072cfcc5af53ecbd43fba09bc07ccbafbab3517613f81d4c00e59f9a35fa7d9da8d3fe44fe03e6cd7c9fc8751a7fca9fc0ea60072cfcdfaf93f91ea34ff00953f80f43d7c9fc9b51a7fcb9cea60072cfa36be4ff71a8d3fa138e8b5f27fbbd469fd19cea60072cecebe4f66a34fdd38dad7c9edd469db9d4c00e59e975f27fbcd469fbe71e91af93fdf6a34fe94e753003967d335f27f29d469fd39c7a7ebe4fe57a8d3fe64fe2753003967e73d7c9fcbb51a7fcd9fc47cedaf93ed1d469ff3a7f13a9801cb3f3d6be4fb4f5176f3f88f9f35ea7da9a87b79fc4ea60072cfcffaf13ed5bff6f3788fa45af13ed6bf76f2f89d4c00e59fa4daed3ed7be76d2f88fa53ae93ed8bdf6d21d4c00e59fa5bae53ed9bcf6b20fa63ae13edabbfef95e753003967e9aeb64fb6eebdabc7d39d6a9f6e5cfb471d4c00e59fa79ad13eddb8f68e1f4ff0059a7dbd70ed14ea60072cef0b59a7dbf5df9d46f175927fc415bf9cea60072cef1f597c4359f993c06f2759fc4357fc53c0ea62309ee0396f795acfe21aafeaf813bccd69f10557f06f81d45b0d5ff00653f811d146bfec37f801cbfbcdd69f1054ff06f813bcfd6bf10547e56781d3dd0c5faa67e541e8f07ea63fca807316f435b75fcff00919e5277a5adbafe6ece3f29d37e8b4ebfee23fc8847a2532ff268bf2201ccbbd3d6fd7f37651f949deaeb7ebf97b18fca74c7a1527dd61ecd08f40a3fba41d9a01cd3bd6d71d7d276117949dec6b9ebe7f778bca74a7cdd43f73a7ec9be047cdb40bfc869fb26f801cdbbd9d73d7ceeef0f909ded6baebd777687c87487cd76e5fe414dd8b7c07cd36deafa5ec5be007386f735d75eaf7587c84ef775df5eff006483c8746fccf6beada4ec1be047ccd6a5fb328fb06f801ce9bded77d769dd21f213bded77d729dd21f21d13f325a57ecba3eeecf023e62b3f555177767801cf09f2bfaebaddbdd22f293be0d75d6adee91794e85f982cdd5143dd99e047d1fb2753d077667801cf9be1d73d68cee917949df16b9eb38fbac7e53a07e8ed8d7ec6b7f756780fa37615fb12dfdd59e0073f6f8f5c758c5dd63f0277cbadd3ed087bac7e07dffe8cd83a8edddd23f023e8c69fea2b6f748fc00f80ef9b5b7dfe0eeccf0277cfad7efb4fdd99e07df3e8b69d5fb06d9dce3f023e8a69c5e7a7ed7dce3f003e0dbe8d69f7ca6eecd1be9d67f7aa6eecd3ef1f44b4d2ff00c3d6aee51f811f4434cfc396aee51f940f84efab59fde697bbb49df5eb3fd7d277643ee9f43f4bfc3769ee317948fa1ba5be1ab47718bca07c377d9acbf5d47ddd3c49df6eb1fd651777ff0013ee3f4334afc3568ee317948fa15a53e1ab4f728fc00f886fbb58ff003e87bbff0088df7eb0f7d0f77ff13eddf4274a7c356aee71f811f41f49fc376bee8cf003e27bf0d61ffb87775f313bf1d5ff00cdb7f60be63ed5f41b49fc376beeacf023e82692f86ed9dd59e007c5f7e5abbf996eec1de6277e7abbf556dec1de63ecdf40f48fc376deecdf01f40748fc396eeeed03e35bf4d5bfa9b6f60ef313bf5d5bf77b6760ff0039f63fa01a43e1cb7f60846efb487c396fec500f8f6fdb567ddad7d83fce37efaafee96aec64f39f60ddee8ff87683b2423777a3fe1da1ecc0f90efe355fdced3d8c9e7277f3aabee369ec64fef0fae6eeb477c3b45f908ddce8df87a8ff0022f881f25dfd6aafb85a3b197fbc1bfad53edb7da3b197fbc3eb3bb7d1bf0f51fe55f11bb6d1bf0fd27f05f103e4fbfad51d5d69eca5fef09dfdea6eadb5767279cfab6ed7467c3f4bfd6f123769a33a829bf8bbc40f95efef52f56dabb393ce4eff00351f565aff00249e73ea5bb2d17d414ff99fe246ec745f5041f9dfe603e5fbfcd45edb5db3f2c9e6277f9a83aaadbfc24f31f4e5f92fd14bf6041da3fcc46eb744f5043da49e603e669f2fb7ef6da6ddfd7f313bfdbe7b6d16ff00ebf98fa52fc95e885fb022ed64f311ba9d0fd431f6f2f980f9beff006f7d5141fc5fe24eff006f3d4f43f99fe27d1b74fa1ba859de25f311ba6d0dd42def1379c0f9deff00af1d4d45f99fe24eff00aefd4b45f9de7d0b74ba17a89bde66f38dd1e85ea24ef5379c0f9eeffeedd4947da3c9dffdd3a8e93b571f40dd1684ea2fed73f9c8dd0e84ea3fed73f9c0d077ff0073ea2a4ed9de04fd602e5d434bdb3bc0df3741a17a917bdcde72373fa1ba99ddee6f301a2fd602e1d414ddbbbc09fac0d7fc3f4fde1de06f3b9ed0dd50fef52f988dcee87ea993bd4be60347fac0d6fc3d077977949fac0d67c3d07795f29bb6e7343f55c9dea5f311b9bd11d592f7a93c40d2feb0555f0ec3de97ca4fd60aa7e1c8bbdaf90dcb735a27aba6ef527891b99d13d5f3f797f881a7fd60a7f86e3ef8be427eb0737c34cef8be436edcc68afb8d47797f891b97d15f72a8ef2ff10353fac1cbf0cb3beaf909fac1bfe186f7eff2cdaf72da2fee953de5c46e5745fdd6abbcb80d593fed08ef6e974eff00fe593f584ffcadfdbffcb367dca68cfbbd5f79523727a37f5157de140d67eb09efd2ff00dbff00cb27eb08df8617bf7f966c9b93d1bfaaacef0be046e4b477eaeb7bc7f801aefd60e3f865ddfbfcb27eb0717c34fefa9e4361dc8e8ffe6d7778ff0003f3b8fd1feeafef09e0050fd60a0f86a4ef89e427eb054ff0dcbded3c85eee3b487bee1de13ca46e37487f3ae1dba7940a3fac152fc392f7b4f293f581a4f8766ef49e52eb719a47f5971eddbe523719a47f5b72eddbe5029feb0345f0f4fde53ca4fd60687e1fa8ef0df296db8bd25fafb9f6ecf211b89d27f79ba76ecf20157f580b7f50547786f813f580b7750d4f6edf02cb711a4fef575edd9e42370fa53ef975eda3f2015fbff00b6f515576cdf0277ff006bea3abed5a676e1b4afdf6eddb47fdd8dc3695fbfddfb68bfbb030b7ff6aea3aced5a37ff0068ea4aded18666e174af585dfb68bfbb2370ba5fac6eddac5fdd818bbfeb3f52d6fe7613bfeb3753577e6678991b84d33d6575ed23f211b84d35d6574fcf1f900f1dff00593a9ebff333c49dfed8fa9ee1fc59e27a6e0f4e759dd3f3c7e423707a77ad2e7f9a3f281f9dfed87aa2e3fd4f313bfdb0754dc7f847e61b83d3fd6b72fe31f946e0ac1d6d71ff00e9f9409dfe69eeaab97f08fcc37f9a77aaee7f963f31f9dc1587adee1fd4f291b82b1f5c5c3f833c00f4dfde9ceacba7e48fce4efef4d756dd7f247e73c770364eb9affcacf02370366eb9aefc8cf003237f7a67ab6ebd9c7e7277f5a5fabaedd945fde18bb81b3f5d56fe4611b80b4f5dd6766c03337f5a57abeefd8c5fde13bf9d2bf70bbf6317f7860ee02d5d7959d9346e02d7d7957d9340cedfce95fb95dbb18ffbc277f1a53ee776ec63f395fb80b6f5ed5762df1237016eebda9ec1be20596fdf4a7dd2ebd8c7e7277eda4feed74ec19e72b3eaff006febea8eee9e247d5fe87afe7eee9e602d77eba4bf5173ec19e7253e5cf48feaae49ff0021be62a3eafd45f104ddd93cc7e57fecfd49f114ddd53cc05d27cb96915ff7771ec1be6277e3a47f9b70ec1be628d7fecfb4decd472f744f311f57d83d9a924ee69e702fb7dfa43ff7fec13cc4efbb47fbebbb04f31aff00d5f21f895fdc93ce47d5f23f899ddcbfff00606c5bedd1ff00cfadec3fc49df6e8efd656f77ff135bfabe33e277771ff00307d5edbf142f70ff300d937d9a37f5b59ddd7c49df5e8dfd7d5f775359fabdffe68fec1fe60fabdff00e69fec1fe601b3efab467de2afbb293bead17f7aaaeece355fabdbbe274ee1fe60fabe3fe276f71ff300daf7d3a2fef753dd9c4efa3457df6a3bb3fc0d4beaf92fc4ccee4be723eaf937c4acee6be7036edf3e8afbfcfdd9fe04ef9b44f584fdd5fe069ff57da8f8923ee6be723eafb53f11c5dd17cc06e5be5d11d65377593c09df2688eb397bac9e534bfabed5fc450f755f311f57eacf8860eecbe60376df1e87eb593bacbe5277c5a1fad9fdd65f29a3fd5fab7e2183bb3bcc3eaff5ff001053f7777881bcef874375c3fbacbe5277c1a17ae5ddd26f29a27d5fee1d7f4dd83bc48fabfdcbafa97b177881be6f7f42f5daf749bc84ef7b4275e7f649fc8683b80b9f5ed2762e2370175ebca4ec9c07d037bba13af7fb24fe4277b9a17af53bacde43e7bb80bb75dd1f66f1b81bbf5d517e4781f42ded685ebd6f769bc87e93e563432fdbcceef2f94f9d6e06f1d7345f95fe042fc80debd978a1fcaff003e8fbd7d0fd7d1f612f946f5743f5f47d8cbe53e6fb82be75c507f07f811b82bef5bdbffafe007d2b7a9a23afe2eca4f293bd2d13d7f0f672794f99ee0aff00d6d6effea7948dc1ea0eb5b6ff00193ca07d3b7a3a27afe0ecdfe52779fa2be20a7fc8ff0003e5fb83d45d696cfcd27948dc1ea3eb4b67e693c807d493e53745affc414ff95fe04ef2f462fdbf4dfc1de07cad7e41352fb2e76bfcf27908dc26a7eb1b576927900fab6f2b467c414bfd6f027793a33e21a4fe2be07c9f70baa3ac6d3dacbfdd91b85d53d6168eda5feec0fb95a6f36ebed1ad5daeae3aa811eac59235e1b49cd3fea8671a9fc9be95aed1fa65d6cb84b4f2ccb50f976a9dce7370a8d4f6a22e787b8db0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000006bb61d5d05e6f372b4cb02d2d5515448c891cb94a88d8ed957b57de8bc153d994f781b102b7515d5d62d3d5f756c2933a92174a91abb651d8f667d8590000c4b9dca9ed341257552b9218d5a8e56a6578b91a9c3f6aa0196000000000d6ae973d596da4acadf9b2cefa6a58df2ffebd2a3dcc6a2af2e8b19c272cfef3f76eafd5758ca5a896db678e9a7463dcadae955ed62e15709d161570bcb3fbc0d8815369b9cf5b77bdd2ca8ce8e82a99145b2985d958637ae7dfc5ca5b00061afce5f3c222252fcd9e8fc57d6e9ba6dafcbb3b3fbf2660000adbe5d96cf4904e90a4bd355c14f857631d248d667f76d640b200000605f6e6965b0d7dd163e93d129df36c671b4ad45544fde63d9e9f5045274977b8d1d43248f2b1414ab1f44fe1c11caf5da6e33cd33cbf6016e00000000000000000c49ae54f05d296dcf5774f551c9246889c30cd9dacaff4da45d3e724a25f9a52956ab6db8f4adad8d9da4dafd1e39d9ce3f1c01980000000001875ff00396dd2fcde94aade9d3d2ba7dacf4585cec63fdace319e1cc0cc0000000000000000062dceb5b6db5d5d7bdaaf6d2c0f995a9ed46b5571ff0042b2c0dd433320adba5c28a486a2147ad3434aac58955115111eaf5ca27b729c7f002f418741f396d557ce294a8de9dde8de8fb59e8709b3b79ff6b39ce3872330002a63b9d43b58545a9519e8f1dbe2a86ae3d6db74923578fbb0c42d800000006236e54eebbbed68aef49640da854c70d87395a9c7df96a81960c3aff9cb6e97e6e4a556f4edf49f48dacf4585cec63fdace319e1cccc000152cb9ceed5f2da9519e8ecb7b2a1171eb6d2c8f6af1f761a805b00000000000002a6b6e73d3ea8b55b588ce82ae0a8924554f5b2ce8f670bfd352d8000000000000000000000000003129ee54f5371aba08d5dd351a3165454e09b68aa985f6f0432c002a5b739d757cb6a5467a3b2deca845c7adb4b239abc7dd86a16c000000000018976a9928acf5b57163a4829e4919b4994ca355533fc05a6a64adb3d155cb8e927a78e47eca6132ad455c7f1032c00000000000002a6bae73d36a5b4db988ce86b23a874994e396233185fe92816c000001f976d6c2ec636b1c33cb207e815b156d55bf4f3abafbd0367a681d2d57a2239589b28aabb3b5c79219d0cac9e08e66676246a39b9f72a640f4054e9fb9d45ce2af754231169ee13d3b36531ea31d84cfe25b000000000006254dca9e96be8e8a55724d5ae7b62444ca2ab5bb4b9f770432c000000000000000000000000000000000000000000000030dab72f9dde8e4a5f9b7a04d854dae9ba5cae73ecd9c63f1c99800000018712dcbe75a8499297e6fe8d9d02b36ba5dbe3b5b5ecc72c63f13300000000000000035ba9acbe5d2ff005d4169ada4a186dcd8d1ef9a996674d23dbb58fd26ecb5131f8ae4d899b7d1b7a456abf09b4ad4c267db803f40c4a1b953dc56a529d5cbe8b3ba9e4da4c7aed4455c7e1c50c475ce74d6115a9119e8efb7bea1571eb6d248d6a71f761540b600000000000000000624f72a7a7b952dbe45774f56d91d122270546636b2becfd2422e9f3925be4f9a12956b32dd8f4adae8f1b49b59d9e3fa39c7e3803300000000018973b953da6df257552b9218b67695a995e2a889c3f6aa196000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000d1adf635bc5b6e72534c94d72a3bdd5cb45538ffbb7edaf05f7b5c9c1c9ed45fd86f252e9ab7d55be1b936aa2e8d67b9544f1fac8bb4c73f2d5e1ef4f6730287505f12f5f2677e59615a5aea6a6922aca572f186444e5f8b579a2fb5150b9d4f5556e96db66a1a8752cb749dd1c950ce0f8a26b15ef56afb1ca888d45f6673ec2af5fe94aebadbeaab2c3b29719a9969a785551adab897922aaaa2239aab96afed4e4a5dea1b554d7c749576f9238ee16f9fa7a75973b0ff555ae639538a239ae54cfb170bec030e6d0f6b4a6ff005096b28ab5a998eb63aa91d2ed2725765576d3de8eca29477e7c5a93e4d1975b853b7d323d98dfb0e546b646ce91c98e3c955abccbc92f1a9ea204829b4bbe92a5e8ade9ea6ae174112ff3bd472bddfb36533f8115ba5e466827e9fa195249d9122b2497874b2a3b6d55deeda7673eec81e9754a3d1da6ee773b752a3648e1da46b9ee7239c9c1b9caf2cafb0a3a78748ba99aeb9dcea6bebdc9996b1ef9daf572f3566ce3613dc8dc61305faa55ea6b5d65b2eb64a9b643514eac73e49e27aed2f0f5761cbcb9e571fb0f1a7ba6a7a287d1ab74ec9709a2446a5551d4c2d8e7ff00c4ad91cd7317de985fc1540c6b1b59a974fdcac970a9a8aba7827f47655e5d1c93c586bdae55e0bb499d955f6ab57de6d6c6a318d6a670d4c26572a55a55df22d3efab96d50cf73445736861a846b57d6e0de91c98ca379ae31945c16ad5556a2b93655538a6790157aa7ffc2578ff00e027ff00edb8f7b27fec2b7fff000b1fff00c50fcdfe9a6add3b72a4a766dcd3d24b1c6dca26d3958a88995e1cd4f6b5c32535a68e095bb32450318f6e738546a2281a9dbecc977d5fa9bd36695d431d5c58a68e4731247ad3c5957ab5515c8898c272e2aab9e18c84b643a5b555a996a7490d0dd1f2c1514ab239f1a3db1ba46bda8aabb2bea2a2e382e53dc5ad9a82aa92f57ea89e2d88ab2ae392076d22edb5208daabc397acd54e3ee17aa0aaabbcd86a208b6e2a3ac7c93bb691361ab048d45e3cfd672270f781e0e91fbc4645b6ee8fe6973b673c33d2a71c7bcd75b1581f5f5cbad5d2c75ceab95b1beb659194fd0ed2f45d13b28c44d9c67db9ce4da5682a975b36e3d17faaa5b5d02c9b49fa7d223b18e7c939f23ce4ba5f206c915469a92ad72a8d751d544ac7a7b3292398a9c39a71fde067d9e8e9686d9141455124f4c9958df24eb32ecaae5111caaaaa89c938f22af5b7fecaa1ffe6d45ff00f6187ae92b554daadd529534f1d22d555c950ca489c8e6d335d8f5115387b15571c32e5c1fbd51415571b7d2c5491748f8ee14b339369130c64cd73978afb111540c1d6edac916c3050d5be9259eecd8d656736b5619b6b1ecce38a67865108b9688b67a0cb3d03aa696e5146ae82b52a647488f44ca2b95ce5da455e68bcd32585fe82aab6b2c7253c5b6da4b924f32ed226cb3a195b9e3cf8b9a984e3c4b699aaf8246b532aad544fe00693a95d0ea2f9257ddeae1459df69f486e155118f7468abc97dfef33ef14d169db5b1b6389b4d5b729e2a38e6739cf48d5ebc5f8555ce1369513df83cdf63b92fc92a58929bff48fcd294fd0edb7fef3a3c636b38e7edce0b9bf5a1f78b4fa3c33253d5432327a69953291cac54735553da994c2fe0aa060fd05b3fa3ecac95eb558ff00d796b64f48dafe76de79e7d98c7e056d4dceba7f938d471d5ccaeaeb6c3554af9d9eaac8ac62ab5fc392ab55aab8f6e4b3f9eb52f43d12e92916ab3b3d225743e8ff00feadacede3fa193c2a34e5643a0af16d6392aee77082a1f2b9b8624b3c8d5e0995c227146a67d888066d82c6ca68a0b9564b2d55ce5891659e491ca8dda44556b5b9c35a9c91113d9c72b9528f4d58997b82e33de669aae06dceae3a7a7595cd8d8d49df955445f59d9ca657922222638e774a76b994d131c98735888a9f8e0aad2f41556eb754c5571746f92e155335369172c7ccf735787bd15140d7a3b3d5536b07e9ca7b8d547639a912b5d0f4ce591aa8ed8589afced358b9472e17d984c22a99178b252696968af5654929152b6086aa26cae7473c523db1ae5aaaa9945722a2f3e05cad0557d366dc7a2ff554b6ac1d26d27e9f488ec639f24e7c86aaa0aab9595b4f4917492a565349b3b489eab27639cbc7dcd6aa81e7a9e1b43e2a796f7739a9695ae56a40ca9742d9dcb8c22ece1cec617088b8e2b94535d86a2c76ad49675d39552b195950b4d554bb52ac7235637b9afc3f82391cd4e29c55154d82e9435906a5a4bed2d1fa7b62a59299f035ed6c8cda735c8f66d2a3557861515538638fb0c4b8c17dbcdcecb51f367a1d251d7a4d2c72cac74aa9d1bdbb4bb2aad444dac6115cab9f6638863de6c36ca9d7f675969b6bd2296b1f2ffa4726d2a2c385e7c39af23375744cb6e8e74347b50b23a8a66b765cb9445a88f3c79fb54f5bf52dc23bddaaf34142eaf4a36cd0cd4f1c8c63d5926c7acd57aa3570b1a70554e67e6fb05cafba51d136dafa6ab7d442ef469258d5c8d64ec72aab91767f45aab845fc3881f9bead45db505269d8aa66a5a67d3beaeb2481eac91ec47235b1b5c9c5a8aaaaaaa9c70dc7b4f0bae95a7b65ba6b8e9f74d435f48c74b1eccef7473ab533b12355551c8b8c6578a734533af96eaf4b9525f2d0c8e5aca58df0c94d23f612a2276155bb5c765c8ad45455e1cd179e4c4b8546a3bed1bed905926b4b2a58b1cf59535113ba26af076c3637395cec72ce1139818ba96b2aaef6bd2b516da97d1bae35f13ba46f15631f4f2aafe0aa89cb3c3289c0c9b9688b67a0cb3dbdd534b728a357415a95323a447a26515cae72ed22af345e69932eeb6791574ec16f8334f6dae63de9b489d1c4d824622f15e3c5cd4e1c789773355f048d6a6555aa89fc00c1d3f717ddf4e5b6e522235f574b1ccf44e48e735157feaa606a991f1d458118f7376eed1b5d85c653a39382fe065695a2a8b6e93b4d0d5c7d1d453d1c51cacda45d97235115329c178fb8fc6a1a0aaae9aceea68b6d296e4c9e5f59136588c7a2af1e7c5538271028f503289daa255d50955f3425347e86e45912991f97749d26c70dafd1c6d70c6705d69ba2b1d3412d4582a926a49d53d48aa966898a99fd1455546aae78a27b90f6acafbc52563d23b37a7522e1637d35431b2a70e28e6c8ad4e7c951c57d8edf5b26a5adbdd45ad2d31cf4ec87d1d6463a499c8e55e91fb0aad45c2e138aae339f60199aaae5556cb2ed502b12b2a678a969dcf4cb58f91e8c472a7b719ce3f0315ba16cfe8db33beb6a2a951735b25649d3ed7f391c8bc3f62613f02c6ff69f9eed12d1b665826da64b04c899e8a56391cc763db872270f71874f76d43b0b0d4e997a54b7824d1d5c5e8ef5f7e5576d13fa0aa0625ddb5b2d5da34bc772a96fa44324b595ad723267c71eca6115113655ce7b72a9c9114fd56e8ca4a7a474f6292a2df7185aaf8666543dc8f722704911caa8f6ae11173c7f13deeb6cbacbf36dda9569a4bb5bdae47c59564550c7a26dc68ab956f16b551573c5a99e678d5dc3535ce9568692c12dae49daac7d65554c2e6c08bcdcd6c6e72bd7dc8bb299e6057df2e9577bd23a76e16f9968e7b8d652aa3d38f45b68b9e1edc65782f05c16355a12d13d32f46fab8ab9adff00475fe9522ccd7fb1db4aee3c7d9cbf03f571b0be1b5d86dd6c855f0db6b2995515c88ad8a34c2aae79affd4d8c0d2eb246ea5f9287dc6e5123ea52d92cae54556a24a91b915531f8a2f02eb4e59adf6fb7d2d452d3f472cb4cc47bb6dcb9e08bed52be86cd7087e4ca5b3494f8ae7504d0a45b6dfd3723b099ce3da9ed361b744f82d94b0cadd97c70b1ae4ce70a8888a06b543767daad1ab6e726d4de835d512358e77346c4c546fe099fff0073dadfa3a96aa899537e927b85c676a3e695f50f6b6372a716c6d45446353384c71fc4f7b6d8df251ea1a2b942ad82e75b32a2239176e27c6d6e7872e4bcf89e54159a92d54ccb755d8e4b93a9d88c8eba9aa226b6644e08e7b5ee473571cf08e4cf2030ec147556ff00941b952545549531456ca74a692576d49d1f492f07bbfda5476d2679e113395caad7d05cac57f5a8b96a1ad92574b33db4f47fe9522a78dae56b7837839cb8da572e79e13182eac96bbcc7abebaf1746468daba2898d6c5223990ab5efff00468bc15708a8aab8445572e052c579d3334b47496a75d6d724cf96058268d92d3edb95cac56c8ad47265570a8ece38638640f0d3b70a7a7d4afb5db6b27abb65453ba78d25e91cb4b235cd456239fc765c8eca22af056ae399e162b2a5f2bef925daa26a8a48ae734705224ae6b1392ab9d85f5978e11178222704ca9b15a6aef1592cf25c6d8cb7409b29044e99b24aabc7695db2aad44e584455e4a7969ca0aaa0f9d7d262e8fd22e534f17ac8bb4c7630bc3972e4bc40aca2a06698d61496fb7be46db6e74d339695f239ed8658d58bb4cda555447239729cb8218df46ed337ca255c5252658b6c8a554e91ff00a4b2c995e7f817971a0aa9f5559aba28b6a9e963a96ccfda44d957a33678735ce17918b7286e76fd56dbcd1db24b9413d1252cb1c32c6c92356bd5cd77aee6a2a2ed2a73ca61009d4b9a55d3d140e746c4bac51e1ae5e2dd87f05f7a7041a9e0b13a6a792fd739a1855159152254ba364aee6abb2c5473d53f7a27b8fddde92beeb158a64a258a482e11d45444e91aab13518f45e39c2e1553964fcd651d7506aa7dee9e81d718a7a36533a38e46365855ae73b2ddb56b55aedae3c538b539fb029ad75368b76b0b75269eaa97d16be39995148ae91636b9adda6bda8ffd15e0a8b8e794e1c0b88fff00cc8a8ffe4f17ff007a43c65a6be5cf54596e335036928a8dd36d46e958e9115d1aa239d85c271c222355dcd554cf6505526b69ae2b17faabadb1c0926d2717a48f72a639f254e3c80b8345928b43edcb0d6dce7b855b155b2d43eae69246bbdbc58bb2c54f735131ee375ab816a68e6a7491d1acb1b99b6de6dca63286bf667de6cf65a4b3b74f2ba5a485b0a4d1d444da676ca636b39db4cf354d85e7ed01a4ee12d76929965aa7d5ba965a8a76d43ff4a56b1ee46397f1d9c67f12b749698a6bc68fb5d5dfdf2dc669e8e256a4933d191b3653651ad45c67185577355cf1e4896da6ad772a0b25c29ee0d6ad54f59532e59846bd1ee554544cae1173c978a7b4cdd2f47516ed2969a1ab8fa3a8a6a2862959945d9735888a994e0bc53d8057699e92d773bcd8dd512cf4941d14d4cb33d5ef8e391aef536978aa22b1d8cf1c2a27b0c4b059a1d536c86ff7d596aa4b8352686996672434d1af1635ad4544ce31972f1ce4b7a0b7d4c3ab2f15d2c58a6aa8299913f69176959d26d2639a636939fbcafb6477ad2f0a5a22b3c975b7c2abe893d3cf1b1f1c6aaaad8ded91cdfd1e59455ca2270c81871db26b47ca259e959532cd6f5a3ab753b6791647c4ecc5b4dda5e2adfd154ce5532bc71844dd8d521b75f6b35a5bef75f4ec829e2a69e14a764a8fe832ac54572f0cb9d85ce32888d4e26d6069566b3a5f2ed7f75d2a269e8a1b93e386912573599d862ab9d85f5b9a2222f04c2f0ca9e55366a9b5eaca2b25aee1534b69ba4324b3c29339ce8ba2d9ca44e55cb36b6da8b8f72e30bc4d874f505550cd78754c5b0955727cf17ac8bb4c5631117872e28bc1788aea0aa9b575a2be38b6a9a9a9aa992bf693d573d62d94c735cecbb97b80a3d4761a2d356d76a1b2b64a3aba17b24936667b9b511ed223d8f455545ca2af1e68b852f352c36d928637ddee7350d1c727ae91d4ac2932aa611aae6e1cbfb11533f88d5f415574d2970a1a28ba5a89a2d98d9b48dcae53dab843cefb6fab7de2d578a4a64ac5b7acad7d36da35ca922226db15dc36936792aa7072f1403599aa34f5a2e56aaad37572c334b5d0d3cf023a558e78e476c2ed23b86515c8a8bcf87e26c5148fb4eb4929647b9692f31f4d06d2e5193c6888f6a7bb699b2efe8b8c4bdc57ebeb6ded86d4ea2a7a7b8d34f336a258d657b592b5cb846b95a88888ab9da555c6113899dace0dad373d6b24645516c54ada791eb846be3f5b0bf83932d5fc1ca07e6ba47dd356525b627b929edad4acab56ae369eb96c4c5feb3d53ff000b7de6c052695a39e1b63abeb99b15f73916aaa1abcd8ae44d98ff00a2c46b7f72fbcbb0345d23a7e2be5812aef92cd5cd7cd332181d2bd2389892bd3922f172aa2ae578f244c60b2b153ad8b5555d8609a57dbe4a4655d3452bd5eb4ebb6ac7b1aaaaabb2beaaa27b3899fa4a82aad9a720a4ac8ba299924ce737691d8474af72714e1c9507a0557d36f9c7a2ff0055f9b7a0e93693f4fa4dac639f2f6f202a6d56c8f57ad45e2f0f9a6a67544b0d1d1a4ce6c51c6c7ab369cd454da7b95aab95ce32889c8f58a99da67535051d2cf33ed9765923f479a574894f2b58af4562b95551ae6b5c8adce328983f54d0de34cd55453d1dadf75b6544ef9e248268d92d32bd769cc56bd5a8e6ed2aaa2a2e5338c7b4f5a3a3ba5defb4d77bb51a5be0a06bd29291656c922bde9b2b23d5beaa61b9444455fd255c81576ad316693575fe1751e6389b4db09d2bf8658ecfb4ddcd6668eed67d4f70afa4b3cb73a6b843171826898e8a48d1c985491cdca2a2a2e5157185e06c7139ef858e919d1bd5a8ae6673b2bed4cfb40d3aeb6d9eedf290b4a9572d351ada58ea9581eac9244495f8623938b515572aa9c7863da7bdeb4dc364b64f77d3cb2d1d6d0c6e9d236ccf58aa11a9973246aaaa2e511533cd170b93d2e56dbdc7adbe7cb6c4c9618eded81d1492a31b37fa4739cd45e2ad727aaa8aa98e69edca4dcdf7fd434b25a196796d34d52ce8ea6b2a2a22739b1af07246d639d972a65115718e7f801857dbed35c2e96cb754574d436e9e8d2ba75855e924c8aa88c8f69bc5a9cd55538ae113daa60dceb2c366a6f9cf4d554d156532f48b4cce99ccab6ffb4c7357865533877345c1b1dd6d55b49594776b1431493d240b4cfa491fb0d9e15c2a351dc765cd56a2a2af0e2a8bcf24b2eda86aaa29e28b4dc944c73dbd3cf595312b58ccfadb291b9cae5c72ce13de05f3551cd4727254ca1a1d6b2ceb7fb93b59aced6f4e8942ea87c8da448761b8d954f511db5b59dae3cbd86fa534d72bdd2cf331fa7df5912397a2928ea63cb9becda6c8acc2fbf0aa062be8add43a2ee6db554ba7a3929a67c6ab52b335a8ac5e0c72aafabc3967daa6158748d0dcb4d5be6be2495f512d2c6e5da99ed6449b2986b1a8a88d444e19e6bcd4fddbac95e96ad452badf1d03eea8e586df1c8d5e8d7a2d8caaa7abb4e5e2b8e1cb8af1360b353cb4964a0a69dbb12c34d1b1edca2e1c8d4454e1f88153a4dd3d2545dac7354cb531db2a5ada792676d3fa27c6d7b5aaabc576555532bec442a67a2d11e9134371b94f71ac639526964ab9647b1deef517658a9ee6a260bdb7db2aa3beea09e662c50d73a1e8646b932a8912355531c530bef30ec7f3c586c949654b03a792923485b5115444d824c70db5cbb6d1579aa6c2f155e607ae87af7d6d9268df57256368eb26a78ea25cedc91b5dea2b9579aecaa22afb70567c9f59d2af4c5a2f1749e7abac581ae876e576c42d44c370dce32a9c55572aaabeec225c692b75c6dd4b704ba23127a8b84b3a2c78d9735d8c2a715c2734e3c78713d747d0555af485aa82b62e8aa69e9991cacda476cb9138a65328bfb80d5a86e562bfbea6e3a86b64955f33d94f4599522a78d8e56b7837839eec6d2b973cd113182cb4fdc29a9b52bed96cac9eaed9514ee9d8d97a477a2c8d56a2b51cfe3b2e4765133c15ab8e664534579d333cb49496a75d6d72ccf9a1e8268d92d3edb95ce62b6456a39bb4aaa8a8ece3863864b4b4d5de2b269e4b8db196ea7446a4113a66c933978ed2bb6555a89cb088abc940a2b05a21d576e8f505f1d354babd3a582956672434f12afa888d454457630aae5e39fc0f14b5cd67f941b25345512cb6f753d53a064d22c8f85d866d351cbc55b8d9c22e71c78e30899d6d8af5a5e3f9aa0b44974b6c6e72d24d4f3c6c92262aaaa46f6c8e6a7ab9c22a2ae531c0fc476ebed76b2b65eeba9d94f4d0413c494ec951fd0a391b87397865ce54e4dca223538f103699a264f0490c88aac91aad7222e382a614a0b15d7d0b4bd42dd265596c9d2415523b9b9224ca3ff6b99b2efe91b11aa5e6c15f57a923f468dab6bb8ac4eb92ab9115ab0aed378735dbf558b8f6340f3d26b71b6dcdf47769647cb7783e71635eb9e8a5ce25893f06a3a3c27ed2cad723ee5a92e770db72d3d2628606e782b9beb4aefccad6ff00cb52754d157cd474f5f6881b3dcadf324d044e7a352545456bd8aabc132d72f3f6a219962b6ada2c94b42e7f49246cccd27eb2472ed3ddfbdcaabfbc0d423a586e5f22cc9ab51d34915a2495ae73d73b491bb8f3e3fbcd9f4f59adf6ea1a79e929fa3924a7623ddb6e5cf045f6a98368b155a7c9bc560ab6a53d53edcea69115c8ed8739aade69945e7ec32ac159777434d4570b0cd44b0c08d9275a889f1b9cd444f551ae572a2f3e2898028b4e5822bbcf7b92e7249352b6ed54d8695b23991a7afeb39c88a9b4aabc38f0444e1cd4ceb7d0b74ceb182d94324adb6dca92595b4cf915e90cb1b99956aaaaaa23924e29cb285969aa0aab7c3716d545d1acf72a89e3f5917698e7e5abc3de9ece62ba82aa6d5d68af8e2daa6a6a6aa64afda4f55cf58b6531cd73b2ee5ee02b29a89356ddee351729665b7d0d4ba929e8e395cc63d5a89b7249b2a9b4aaaaa888bc1113971151449a4aef6e9edb2ccdb7d754b692a28e495cf631ce45d8919b4abb2bb4888a89c15179703ddd4d76d3f76aca8b75bd6e7417097a79208e66472c12e111caddb546b9aec22e328a8b9e790da6bb6a0bb51d45cadeb6cb7dbe5e9e382499924b3cb8546abb6155ad6b72ab8caaaae3963887adb647bb5d5f6357b958da4a356b557822aacd9c27ee41ab647c6cb3ec3dcddabb53b5db2b8ca2aae53f61170a4b95b7523af76da3f4f8aaa9994f554cc91ac91158e72b1ed572a357f4dc8a8aa9ec5312f14b7cbed55a6565bdd454b475f0cf2452cb1acafc2f155d972b51ad455e08aaaaaa9cb1c43cb5258edd57acec124f4fb6ea992749576dc9b5b30ae392f0e49c8daa8e8e9e8295b4d4b1f471333b2dcaae32b9e6a546a3a4af5aeb4dd6df48b5b25be77ac94cd91ac73d8f62b155aae544ca65170aa99e3c4b3b75554d5d3acb556f9681fb6a8d8a5918f76cfb1576155133eeca81afeafba363b95b6cd2d74b434d56d926aa9a1da491638f653a36ab78b7695e9954e3845f795372974edbe864add395b2d2dca9d16589ad599cca8544ff00bb91abc1c8ec632bc539a29b3dfadb5d2d4d1ddad5d13abe836d12195cad64f1bd136e35727e8ae5ad545e3856fb94f05bc6a3a8e8a2a7d2f252c8e722493565542b14699e2a891bdce770e4984fdc079dde4a8a7a6a7d5940d913a2a747d5d239d849a0c6d2f05e08f671545f6f145e7c26c12c9a8eadba9247b9b43b2e65b6045c658bc1657a7f39d8e08bfa2dfc554f7bbdbab2f9728a8278ba3b344892d42ab9156adf9f562c22e51898cbb3cf8272c91496dabb2df9e941174969af73a496247227a24dcd5ed455e2c7fb51393b8fb570151456a96f9aa751455f553adb69ab63d8a68e6731247ac11676d515155a9c151bc955cb9cf03dae76d8f484b4b77b43e68697d26282b28d6573e27c723d19b6d6aaaecb9aae6ae53194ca298f6e7dde8f55ea7ada0a6f9c20756c51cb48923637b5529e2547b15deaaaf1c2a2aa724c2fb16c2782f1a96ae9a1adb5bad56ca69d95123679a37cb52e62ed31b862b9ad6a3911555555570898031ef1475174f941a6a0f4c9e0a25b63a5a86c322b1654495111b945ca22aaf154e384c7b4fc6a39e96d32da74e435525b282a12596796173fa4e8d8adf51ae4cb915ce7a65dcf08bef2e5682a975b36e3d17faaa5b5d02c9b49fa7d223b18e7c939f222fd6dad9aa28aeb6ae89d5f40af46c53395ac9e37a26dc6ae4fd155d96aa2f1c2b53d806b171974e50514959a76ba5a4b953a2cb123566736a1513feee46af0723b18caf14e68a66dfe68abebad753788eb99619a8d647b61e911ad9955aade9b638e11b9c67867392cd6f1a92a1238a9f4bc94b2bd511f3565542b14699e2bfe8deae770e4984fdc67dc2aeed4954d5a5b5b6ba955899e8e76b256bb2b9e0ec355318ff693da057e9ca1d38c7cb59a6aae37b1ccd87c5055ba489173c15599546bb8633c1799ad5aa9b4bcd49147ab649a1bec9c2a5d71a892272cbede8dcaa8dd9fe6ec2e3182f69e8ee771d551de96cc9694a6a5961ccf2c6e92a95db3b28e48d5c88d6ece78aaae57821933dcef6ea4753d569192a9ee4d97362aa81d03bf6abdcd763fa205d5140ca5a28608e6926646c46b6496457b9c98e6ae5e6bf89adeac8ebaa75169fa2a2ab9293d25d50d9658d70e6b36115553ff00163822fb1573ec2d34b5ae7b369ba4b7d4ab3a5891caad62aab63cb95c8c6aaf346a2a353f042a756c3592ea8d34b6f9591d4c72543d8926761f88d32d763922a6533ecce78e30064cfa1edada755b74b57415cd4cc7591d4c8e9369392bf69576d3de8ece4a8add53515ba6ac6d9aa56db35d6574357510a2aac291a3ba5d8c655155cdd945f66d67d85c4d76d4d530fa3d269a7d2543f2df49a9aa85d0c5ff008b0c72bddfb36533f81f99b4b4b4763b5c1699dbe9d687a4b0493e766672a2a488fc7247a39d954e4aa8bec029eaa3d291d33a4b3dca7a0b83136a1aa6ba772abd396da2e76dabc951d9ca1917fb957dd748582b295cfa0acaeaca445e0b985cfe0ee0bcf0aabc179e0b27deb534b4e91c1a4e486addc3a4a8ac856062ff003955ae57aa7e1b28bfb0c9d4541575f0dad20892474171827970e4446b1ab972f15ffa7303f12d9a92c960b9ba916659a4a57ac93cd33a49245462e155cabcf8af2c157a7b4ad25d34d5baaef8e9abeae7a68e4573a77b522456a61ac4454d9c27b79aae5554d9aeb0c95368ac8216ed492d3bd8c6e719556aa221e762a69a8f4fdba96a19b13414b14723728bb2e46222a65387340356b15a2aae171bada2ef70a8acb75a274869e274ae474a8f6a488b2b9172fd96bdad4cf0e0aab95c632e0b745a5f57dbe96d8e923b7dd639992d23a473d8c918d4735eccaaece5369151382f02d2cd4155497bbfd4cf16c4559571c903b69176da9046c55e1cbd66aa71f70bad05554ea4b1d5c316d4148f9d6676d226c23a356a70e6bc7dc0784723f7895316dbba34b4c4e46e7867a5938e3de6b74d0e9e9259d35a3e58aeafa89115d5f2c91c5b3b6bb1d0bb28cd9d9c72e39e7c4dad94154dd6d3dc562ff557db6381b26d2717a48f72a639f27271e5c4f17dd2fb142e8aab4bc956fc2a6692aa1744fed1cc5445f7617f781837fa35a4d376ea5a29ae1536b4aa6fa63e9e67cb3ad32a39708e4557ab769588bb3c76722c541a366b8c73d86ad8cab81555f14356f47b931ca48d572a9fb539a1eb65a1bd582c6d653db69a474b552cefa16546ca53b1ee554646ec6cae33cb82715c7b0f3b8c173d4171b622e9f92dde87571d43abaa66855cd6b572ac6246e72aed27aab9c261540cda091ebaf2f51abdcac6d0d1ab5aabc1155d3e709fb93f815b63b543ab6892ff007b74d52958ae7535274ce6c34f16d2a3111a8a88ae54445572f1caf0c2217147415516b0bad7be2c535452534713f693d6731d2ab931cd31b6de7ef2be822bce976bedb4f6892eb6d6bdefa5929e78d9242d72abba373647351511555115157863870026862934e6a9a7b4c55134d6db9432490c73cae91d4f2c7b2aad6b9dc761cd7670aab856f0e6615a6d0b7bbeea15b954cd3504171564548d95cd66d7451ab95d85f5930a9845e09c57195e1696da1b9dc6f8cbe5e299b45e8f0ba1a3a24912473369515ef7b9386d2ecb5111328899e2b93234fd0555155dee4a88b61b577274f0aed22ed33a289b9e1cb8b5dc178f002ae0b745a5b575ba9ad8f923b7dd593325a4748e7b19231bb6d7b32abb3944722a2705e06da535d682aaa751d8aae18b6a1a492674ceda44d84744ad4e1cd78afb0b9034fb3dae2d5d14b7bbcbe69e19a591949469339b0c3135ead4556a2a6d3d765555573cd113183de0a6769bd4d496e8279a5b5dd992b5b04d2ba4f47958ddaf515caaa8d7376bd5cf0544c7326921bc698966a3a4b53eeb6c9267cd4eb4f346c969f6dcae7315b239a8a9b4ab8545ce1718e07b50d15d2eb7d82f377a46d047451bd94947d2a48fda7e11d23d5beaa2e130888abcd78815566d33677eaad4313a8f2c864a7e8d3a57f0cc48abedf79b9cf0c75304904adda8e46ab5c99c6517829556aa0aaa6d477dab9a2d982adf02c2eda45db46c68d5e1cd38fbcb9034bd23a76d4955779bd17d7a6bbc8912f48ef576518a9ede3c7de7a5e2825b97ca251d3254cb4f4eb6b91d51d0b958f91a92b3d4472716e571954e38454f69ef46dbc58ae974862b24b5f4d5b58b550d4433c4c46edb5a8e6bd1ee454c2b557288b94542c1f4154bada2b8a45feaadb6be0593693f4d64639131cf922f1e40526a0b151e98a44d41654928ea29268d66636572b2a2257b5af6bdaaaa8bc1555179a2a21efab6e91a5e2df64a8ae96868e78e4a8aa96157249235aad448dae6f16ed2bb2aa985c3719e25a6aea0aaba698aca3a38ba59e5d8d866d237387b5578af0e48a7e6fb6eaf756d25e6d0d8a4aea36be37412bb61b5113f0ae66d71d95cb5aa8bcb29c7981ac5cea34fdae8a4b869aab969ee34c8b2b226f4cacaac738ded5e0bb49c1179a2e1726fd04a93d3c733515124623911530a994c946977d4752f861834c4948ae7274b3565542b1c6dcf1c246e739cb8e5c138f3360034fbb51d55d75fb6dc95b3d350bad6d92a1209158f7e25722351538b73ed54e384c7b4fdde34cc166b6cf75d3ce968aba8a374ed6b667ac7508d4cab246aaaa39151319e68bc7279dcd9726fca3b6aad88c96486d29b74d23b65b3b16576511d85d9722a22a2f2e69c3394c8b8cba8750d1c96a8ecb35a21aa674751575351139cc62f07246d8dcecb953288ab844e7f801ed7996cd72b4505c6ed729a8a865623d216d4ac293abd115a8ed9c39d8f722fbf28beca265458ad37fb449a72aa58fd2aa929aaa976a558e5639aec3b0fe08e4722714e3c57997d70b554515eedb75b7d0a5643454b2522d2b5ed6be36b958a8f8f6951b94d8c2a2aa705e7ec5c6ba437dbdd6da256db168e9292be39a58e696374ae4447267d572b51133ec5555cfb31c43c2fb62b654ebbb2ba6a6da5a98aa9d2faee4da546c78e4bc3f719baba165b344d44345b50b237c28cd972e5333373c79fb54f6d414b706dded378a0a27572d12cb1cb4ec91ac7b992351369aae546e515a9c155399e77d82e57ed23510b6d925355c9247b34d24b1abb65b2b572aa8e56f2455c640c5d5b748d2f16fb254574b43473c5254554b0ab92491ad56a246d7378b7695d9554c2e1b8cf12aae751a7ed744fb869aab969ee34c8b2b226accacaac738ded5e0bb49c1179a2e1726cf7db757ad6d25e6d0d8a4aea36be37412bb61b5113f0ae66d71d95cb5aa8bcb29c799e4977d47532430c1a624a457393a59ab2aa158e36e7d6c246e739cb8e5c138f30307542d5dc6e9a661a2ab9a892b2697a47b170f48fa1739513dcec7045f62ae7d845f7485be8ad35573b474f4573a385d34352da87b9ce7351570fda55db45c61739e65b5da82aaa750d86ae18b6a1a49a674eeda44d84742e6a705e2bc5513819b77824aab356d3c2dda965a7918c6e5132aad5444e206afad21a4bd6816dd2783323a18648fd654d9db7b155399b3dbed1416ae93d0a0e8ba5c6dfaee76719c7355f7a9515d64acacf93d659d88d8eb5b451351af77abd2311abb2aa9eccb7192c6d571b8d73d5b5b63a8b6a3588bb534f13d1cef6a26c39787e2b8fd8059800000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000014326964a8ac73eb2ef70aba2597a64a095ec5891d9da445546ed39a8b8546abb1c0be0000000000000000000000000000000000000000000000000000000000000000000000000000000000000061515ae0a0abafaa89f239f5f324d2a395308e46359c3872c3139e78e4cd000000000000000185556b82aee7437091f224b43d27468d54d95db6ecae787bbf619a0000000000000000000000000000000000000000000000000000000000c24b5c097b5bbedc9d3ad32536ce5367651caece319ce57de66800000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000007ffd9);

-- --------------------------------------------------------

--
-- Table structure for table `jdh_chief_complaints`
--

DROP TABLE IF EXISTS `jdh_chief_complaints`;
CREATE TABLE IF NOT EXISTS `jdh_chief_complaints` (
  `id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `chief_compaints` text NOT NULL,
  `addedby_user_id` int NOT NULL,
  `modifiedby_user_id` int NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_chief_complaints`
--

INSERT INTO `jdh_chief_complaints` (`id`, `patient_id`, `chief_compaints`, `addedby_user_id`, `modifiedby_user_id`, `date_created`, `date_updated`) VALUES
(1, 3, 'Patient has fever', 4, 0, '2023-08-07 15:35:40', '2023-08-07 15:40:32'),
(2, 1, 'Test complaint', 4, 0, '2023-08-16 11:55:26', '2023-08-16 11:55:26'),
(3, 2, 'Some chest pain...', 4, 0, '2023-08-29 22:09:55', '2023-08-29 22:20:20'),
(4, 1, 'ddsdsf', 0, 0, '2023-08-29 22:59:46', '2023-08-29 22:59:46'),
(5, 1, 'Another test complaint', 4, 0, '2023-08-29 23:50:31', '2023-08-29 23:50:31'),
(6, 1, 'teste4frg sdffdf.', 0, 0, '2023-10-30 08:58:39', '2023-10-30 08:58:39');

-- --------------------------------------------------------

--
-- Stand-in structure for view `jdh_consultation_income`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `jdh_consultation_income`;
CREATE TABLE IF NOT EXISTS `jdh_consultation_income` (
`user_id` int
,`first_name` varchar(50)
,`last_name` varchar(50)
,`department_id` int
,`service_name` varchar(100)
,`service_cost` int
,`patient_id` bigint
);

-- --------------------------------------------------------

--
-- Table structure for table `jdh_departments`
--

DROP TABLE IF EXISTS `jdh_departments`;
CREATE TABLE IF NOT EXISTS `jdh_departments` (
  `department_id` int NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_departments`
--

INSERT INTO `jdh_departments` (`department_id`, `department_name`, `description`) VALUES
(1, 'General Medicine', '<p>General Medicine Department</p>'),
(2, 'Gynaecology', '<p>Gynaecology Department</p>'),
(3, 'Pharmacy', '<p>Pharmacy Department</p>'),
(4, 'Information Technology', '<p>Information Technology Department</p>'),
(5, 'Finance &amp; Administration', '<p>Finance &amp; Administration</p>'),
(6, 'Radiology', '<p>Radiology Department</p>'),
(7, 'Front Office', '<p>Front Office</p>'),
(8, 'Stores', '<p>Stores Department</p>'),
(9, 'Paedeatrics', '<p>Paedeatrics Department</p>');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_doctor_charges`
--

DROP TABLE IF EXISTS `jdh_doctor_charges`;
CREATE TABLE IF NOT EXISTS `jdh_doctor_charges` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `service_id` int NOT NULL,
  `description` text NOT NULL,
  `submission_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `submitted_by_user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_doctor_charges`
--

INSERT INTO `jdh_doctor_charges` (`id`, `user_id`, `service_id`, `description`, `submission_date`, `date_updated`, `submitted_by_user_id`) VALUES
(1, 3, 2, 'Consultation fees for Doctor Demo', '2023-08-25 16:27:17', '2023-08-25 16:27:17', 0),
(2, 9, 2, 'Consultation for Dr. Dennis Miriti', '2023-08-25 16:28:12', '2023-08-25 16:28:12', 0),
(3, 10, 2, 'Consultation', '2023-08-29 22:43:40', '2023-08-29 22:43:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jdh_examination_findings`
--

DROP TABLE IF EXISTS `jdh_examination_findings`;
CREATE TABLE IF NOT EXISTS `jdh_examination_findings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `general_exams` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `systematic_exams` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `submitted_by_user_id` int NOT NULL,
  `date_submitted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_examination_findings`
--

INSERT INTO `jdh_examination_findings` (`id`, `patient_id`, `general_exams`, `systematic_exams`, `submitted_by_user_id`, `date_submitted`) VALUES
(1, 1, 'Test examfr', 'sytematic...', 3, '2023-08-06 18:18:35'),
(2, 1, 'ereree', 'ewewewe', 3, '2023-08-30 00:20:53'),
(3, 1, 'hjhgvbv', 'uityty66', 3, '2023-08-30 00:21:27');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_exportlog`
--

DROP TABLE IF EXISTS `jdh_exportlog`;
CREATE TABLE IF NOT EXISTS `jdh_exportlog` (
  `FileId` varchar(36) NOT NULL,
  `DateTime` datetime NOT NULL,
  `User` varchar(255) NOT NULL,
  `ExportType` varchar(255) NOT NULL,
  `Table` varchar(255) NOT NULL,
  `KeyValue` varchar(255) DEFAULT NULL,
  `Filename` varchar(255) NOT NULL,
  `Request` longtext NOT NULL,
  PRIMARY KEY (`FileId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jdh_facility_units`
--

DROP TABLE IF EXISTS `jdh_facility_units`;
CREATE TABLE IF NOT EXISTS `jdh_facility_units` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_facility_units`
--

INSERT INTO `jdh_facility_units` (`id`, `unit_name`, `description`) VALUES
(1, 'Maternity Wing', 'Maternity Wing Patients'),
(2, 'ICU', 'ICU Patients'),
(3, 'HDU', 'HDU Patients');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_insurance`
--

DROP TABLE IF EXISTS `jdh_insurance`;
CREATE TABLE IF NOT EXISTS `jdh_insurance` (
  `insurance_id` int NOT NULL AUTO_INCREMENT,
  `insurance_name` varchar(100) NOT NULL,
  `insurance_contact_person` varchar(100) NOT NULL,
  `insurance_contact_person_phone` char(13) NOT NULL,
  `insurance_contact_person_email` varchar(100) NOT NULL,
  `insurance_physical_address` text NOT NULL,
  `submission_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `submitted_by_user_id` int NOT NULL,
  PRIMARY KEY (`insurance_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_insurance`
--

INSERT INTO `jdh_insurance` (`insurance_id`, `insurance_name`, `insurance_contact_person`, `insurance_contact_person_phone`, `insurance_contact_person_email`, `insurance_physical_address`, `submission_date`, `date_updated`, `submitted_by_user_id`) VALUES
(1, 'National Hospital Insurance Fund', 'Customer Care', '0800720601', 'customercare@nhif.or.ke', 'P.O BOX: 30443 – 00100, Nairobi, Kenya', '2023-08-08 13:07:15', '2023-08-08 15:12:49', 7),
(2, 'Jubilee Insurance', 'Customer Care', '0203281000', 'info@jubileekenya.com', 'Jubilee Insurance House, Wabera St.\r\nP.O. Box 30376 00100 GPO, Nairobi, Kenya', '2023-08-08 13:11:50', '2023-08-08 15:12:52', 7),
(3, 'Resolution Insurance', 'Customer Care', '0202894000', 'info@resolution.co.ke', 'Parkfield Place, Muthangari Drive, Off Waiyaki Way, Westlands,\r\nP.O Box: 4469 – 00100, Nairobi.', '2023-08-08 14:53:40', '2023-08-08 15:12:55', 7),
(4, 'Madison Insurance', 'Customer Care', '0709922000', 'madison@madison.co.ke', 'Upper Hill Close', '2023-08-08 14:54:44', '2023-08-08 15:12:58', 7),
(5, 'APA Insurance', 'Customer Care', '0203641000', 'info@apainsurance.org', 'Apollo Centre, ring road Parklands, Westlands', '2023-08-08 14:55:44', '2023-08-08 15:13:01', 7),
(6, 'Kenindia Assurance Company', 'Customer Care', '0203316099', 'kenindia@kenindia.com', 'Kenindia House, Loita Street, Nairobi,\r\nP.O. Box: 44372 – 00100 G.P.O. Nairobi', '2023-08-08 14:57:08', '2023-08-08 15:13:05', 7),
(7, 'Pacis Insurance Company', 'Customer Care', '0730677000', 'info@pacisinsurance.com', 'Centenary House, 2nd Floor\r\nOff Ring Road, Westlands,Nairobi Kenya', '2023-08-08 15:02:01', '2023-08-08 15:13:07', 7),
(8, 'UAP Insurance', 'Customer Care', '0202850000', 'uapinsurance@uap-group.com', 'UAP Old Mutual Tower, Upper Hill Road​,\r\nP.O. Box 43013 – 00100, Nairobi, Kenya', '2023-08-08 15:03:14', '2023-08-08 15:13:10', 7),
(9, 'Britam', 'Customer Care', '0703094000', 'info@britam.com', 'Britam Head Office,\r\nMara/Ragati Road Junction, Upperhill\r\nNairobi.', '2023-08-08 15:04:18', '2023-08-08 15:13:13', 7),
(10, 'Heritage Insurance', 'Customer Care', '0711039000', 'info@heritage.co.ke', 'Mamlaka Road, \r\nP.O. Box 30390-00100, Nairobi', '2023-08-08 15:10:11', '2023-08-08 15:13:16', 7),
(11, 'GA Insurance Limited', 'Customer Care', '0202711633', 'info@gainsuranceltd.com', 'GA Insurance Ltd. 4th Fl. GA Insurance House,\r\nRalph Bunche Road,\r\nP.O.Box 42166 – 00100,\r\nNairobi.', '2023-08-08 15:11:37', '2023-08-08 15:13:20', 7),
(12, 'AIG Kenya Insurance Co Limited', 'Customer Care', '0723600400', 'aigkenya@aig.com', 'Eden Square Complex,\r\nChiromo Road,\r\nP.O. Box 49460, 00100 Nairobi.', '2023-08-08 15:16:33', '2023-08-08 15:16:33', 7),
(13, 'AAR Insurance', 'Customer Care', '0202895000', 'info@aar.co.ke', 'Real Towers, Ground Floor, Hospital Road, Upper Hill.', '2023-08-08 15:17:38', '2023-08-08 15:17:38', 7),
(14, 'CIC Group', 'Customer Care', '0703099120', 'info@cicgroup.com', 'CIC Plaza, Mara Road, Upperhill Nairobi, Kenya', '2023-08-08 15:18:52', '2023-08-08 15:18:52', 7),
(15, 'Xplico Insurance Company', 'Customer Care', '0203642000', 'info@xplicoinsurance.co.ke', 'Park Place, 2nd Avenue, 5th Floor, Parklands, Off Limuru Road\r\nP.O.Box 38106-00623, Nairobi.', '2023-08-08 15:19:49', '2023-08-08 15:19:49', 7),
(16, 'Takaful Insurance of Africa', 'Customer Care', '0202725134', 'info@takafulafrica.co.ke', 'CIC Plaza, 3rd Floor\r\nMara Road, Upper Hill,', '2023-08-08 15:21:20', '2023-08-08 15:21:20', 7),
(17, 'Pioneer Assurance Company', 'Customer Care', '0207220000', 'info@pioneerassurance.co.ke', 'Pioneer Assurance Ltd\r\nPioneer House,6th Floor,Moi Avenue.\r\nP.O. Box 20333,Nairobi.', '2023-08-08 15:22:46', '2023-08-08 15:22:46', 7);

-- --------------------------------------------------------

--
-- Table structure for table `jdh_invoice`
--

DROP TABLE IF EXISTS `jdh_invoice`;
CREATE TABLE IF NOT EXISTS `jdh_invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `invoice_title` varchar(100) NOT NULL,
  `invoice_description` text NOT NULL,
  `invoice_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `submittedby_user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_invoice`
--

INSERT INTO `jdh_invoice` (`id`, `patient_id`, `invoice_title`, `invoice_description`, `invoice_date`, `submittedby_user_id`) VALUES
(1, 1, 'Patient One\'s Invoice', 'Patient One\'s Invoice', '2023-10-29 20:53:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jdh_invoice_items`
--

DROP TABLE IF EXISTS `jdh_invoice_items`;
CREATE TABLE IF NOT EXISTS `jdh_invoice_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `invoice_id` int NOT NULL,
  `invoice_item` varchar(100) NOT NULL,
  `total_amount` int NOT NULL,
  `submittedby_user_id` int NOT NULL,
  `submission_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_invoice_items`
--

INSERT INTO `jdh_invoice_items` (`id`, `invoice_id`, `invoice_item`, `total_amount`, `submittedby_user_id`, `submission_date`) VALUES
(1, 1, 'Pharmacy', 2000, 0, '2023-10-29 21:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_ipd_admission`
--

DROP TABLE IF EXISTS `jdh_ipd_admission`;
CREATE TABLE IF NOT EXISTS `jdh_ipd_admission` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unit_id` int NOT NULL,
  `ward_id` int NOT NULL,
  `bed_id` int NOT NULL,
  `patient_id` int NOT NULL,
  `user_id` int NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_ipd_admission`
--

INSERT INTO `jdh_ipd_admission` (`id`, `unit_id`, `ward_id`, `bed_id`, `patient_id`, `user_id`, `date_added`, `date_updated`) VALUES
(1, 1, 1, 1, 4, 4, '2023-10-22 21:28:55', '2023-10-22 21:28:55'),
(2, 1, 1, 2, 6, 4, '2023-10-22 21:41:42', '2023-10-22 21:41:42');

-- --------------------------------------------------------

--
-- Stand-in structure for view `jdh_lab_income`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `jdh_lab_income`;
CREATE TABLE IF NOT EXISTS `jdh_lab_income` (
`patient_name` varchar(50)
,`service_name` varchar(100)
,`service_cost` int
,`request_date` datetime
,`patient_id` int
,`patient_dob_year` int
);

-- --------------------------------------------------------

--
-- Table structure for table `jdh_lab_test_categories`
--

DROP TABLE IF EXISTS `jdh_lab_test_categories`;
CREATE TABLE IF NOT EXISTS `jdh_lab_test_categories` (
  `test_category_id` int NOT NULL AUTO_INCREMENT,
  `test_category_name` varchar(100) NOT NULL,
  `test_category_description` text,
  PRIMARY KEY (`test_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_lab_test_categories`
--

INSERT INTO `jdh_lab_test_categories` (`test_category_id`, `test_category_name`, `test_category_description`) VALUES
(1, 'Radiology', '<p>Radiology category</p>'),
(2, 'Labworks', '<p>Labworks and procedures.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_lab_test_subcategories`
--

DROP TABLE IF EXISTS `jdh_lab_test_subcategories`;
CREATE TABLE IF NOT EXISTS `jdh_lab_test_subcategories` (
  `test_subcategory_id` int NOT NULL AUTO_INCREMENT,
  `test_category_id` int NOT NULL,
  `test_subcategory_name` varchar(100) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`test_subcategory_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_lab_test_subcategories`
--

INSERT INTO `jdh_lab_test_subcategories` (`test_subcategory_id`, `test_category_id`, `test_subcategory_name`, `description`) VALUES
(1, 2, 'RBS', '<p>RBS Test</p>'),
(2, 2, 'Malaria Test/RDT/Bs for MPS', '<p>Malaria Test/RDT/Bs for MPS Test</p>'),
(3, 2, 'Urinalysis', '<p>Urinalysis Test</p>'),
(4, 2, 'VDRL', '<p>VDRL Test</p>'),
(5, 2, 'SAT', '<p>SAT Test</p>'),
(6, 2, 'H. Pylori', '<p>H. Pylori Test</p>'),
(7, 2, 'Check HB', '<p>Check HB Test</p>'),
(8, 2, 'ANC Profile', '<p>ANC Profile Test</p>'),
(9, 2, 'HIV/PITC', '<p>HIV/PITC Test</p>'),
(10, 2, 'Rheumatoid Factor', '<p>Rheumatoid Factor Test</p>'),
(11, 2, 'Stool for o/c', '<p>Stool for o/c test</p>'),
(12, 1, 'Ultrasound', 'Ultrasound'),
(13, 1, 'CT Scan', 'CT Scan');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_medicines`
--

DROP TABLE IF EXISTS `jdh_medicines`;
CREATE TABLE IF NOT EXISTS `jdh_medicines` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `selling_price` double NOT NULL,
  `buying_price` double NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `expiry` date NOT NULL,
  `submitted_by_user_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jdh_medicines`
--

INSERT INTO `jdh_medicines` (`id`, `category_id`, `name`, `selling_price`, `buying_price`, `description`, `expiry`, `submitted_by_user_id`, `date_created`, `date_updated`) VALUES
(1, 1, 'CEFTRIAXONE 1gm', 200, 100, 'None', '2025-05-21', 0, '2023-08-01 01:44:23', '2023-08-25 20:52:40'),
(2, 1, 'ADRENALINE INJECTION 1MG', 100, 100, NULL, '0000-00-00', 0, '2023-08-01 01:58:23', '2023-08-02 19:55:35'),
(3, 1, 'ARTHEMETER INJECTION 80MG', 200, 100, NULL, '0000-00-00', 0, '2023-08-01 01:59:38', '2023-08-02 19:55:35'),
(4, 1, 'GSUNATE 60MG', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 02:00:45', '2023-08-02 19:55:35'),
(5, 1, 'ARTESUNATE 60MG', 200, 150, NULL, '0000-00-00', 0, '2023-08-01 02:01:33', '2023-08-02 19:55:35'),
(6, 1, 'Atropine 1mg', 100, 50, NULL, '0000-00-00', 0, '2023-08-01 02:02:24', '2023-08-02 19:55:35'),
(7, 1, 'Benzyl penicillin (Xpen) 4MU', 200, 100, NULL, '0000-00-00', 0, '2023-08-01 02:03:42', '2023-08-02 19:55:35'),
(8, 1, 'Benzathine Penicillin 2.4 MU I.M', 250, 200, NULL, '0000-00-00', 0, '2023-08-01 02:04:40', '2023-08-02 19:55:35'),
(9, 1, 'Buscopan Injection 20mg', 100, 50, NULL, '0000-00-00', 0, '2023-08-01 02:06:07', '2023-08-02 19:55:35'),
(10, 1, 'Chloropheramine(Piriton) Injection', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 02:07:28', '2023-08-02 19:55:35'),
(11, 1, 'Co-Amoxiclav 1.2gm', 800, 700, NULL, '0000-00-00', 0, '2023-08-01 02:08:29', '2023-08-02 19:55:35'),
(12, 1, 'Depo-Provera', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 02:09:20', '2023-08-02 19:55:35'),
(13, 1, 'Diclofenac 75mg', 200, 150, NULL, '0000-00-00', 0, '2023-08-01 02:10:19', '2023-08-02 19:55:35'),
(14, 1, 'Eomeprazole 40mg', 400, 200, NULL, '0000-00-00', 0, '2023-08-01 02:11:19', '2023-08-02 19:55:35'),
(15, 1, 'FLAGYL 500MG', 200, 100, NULL, '0000-00-00', 0, '2023-08-01 02:12:20', '2023-08-02 19:55:35'),
(16, 1, 'Flucloxacillin 500mg', 250, 100, NULL, '0000-00-00', 0, '2023-08-01 02:13:15', '2023-08-02 19:55:35'),
(17, 1, 'furesomide 20mg', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 02:14:13', '2023-08-02 19:55:35'),
(18, 1, 'GENTAMICIN 80MG', 100, 80, NULL, '0000-00-00', 0, '2023-08-01 02:15:07', '2023-08-02 19:55:35'),
(19, 1, 'Hydrocortisone 100mg', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 02:17:43', '2023-08-02 19:55:35'),
(20, 1, 'Fluconazole 100mg', 300, 200, NULL, '0000-00-00', 0, '2023-08-01 02:18:36', '2023-08-02 19:55:35'),
(21, 1, 'IV Fluids (N/S, D10, RL/ D50)', 300, 200, NULL, '2025-05-21', 0, '2023-08-01 02:20:28', '2023-08-22 18:59:56'),
(22, 1, 'Metoclopromide 10mg', 150, 100, NULL, '2025-05-21', 0, '2023-08-01 02:38:34', '2023-08-22 19:00:30'),
(23, 1, 'Paracetamol  1gm', 200, 150, NULL, '0000-00-00', 0, '2023-08-01 02:39:21', '2023-08-02 19:55:35'),
(24, 1, 'Tramadol 100mg', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 02:40:11', '2023-08-02 19:55:35'),
(25, 1, 'Tranexemic Acid 500mg IV', 400, 250, NULL, '0000-00-00', 0, '2023-08-01 02:41:04', '2023-08-02 19:55:35'),
(26, 1, 'Tetenus toxoid 0.5mls', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 02:42:34', '2023-08-02 19:55:35'),
(27, 1, 'Vitamin B Complex 3mls dose', 300, 100, NULL, '0000-00-00', 0, '2023-08-01 02:43:37', '2023-08-02 19:55:35'),
(28, 1, 'QUININE INJECTION 1 AMPOULE', 200, 150, NULL, '0000-00-00', 0, '2023-08-01 02:45:44', '2023-08-02 19:55:35'),
(29, 3, 'NORASH CREAM', 400, 300, NULL, '0000-00-00', 0, '2023-08-01 02:49:57', '2023-08-02 19:55:35'),
(30, 3, 'MEDIVEN', 200, 150, NULL, '0000-00-00', 0, '2023-08-01 02:50:46', '2023-08-02 19:55:35'),
(31, 3, 'Hydrocortisone Gel', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 02:51:31', '2023-08-02 19:55:35'),
(32, 3, 'Diclofenac Gel', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 02:52:05', '2023-08-02 19:55:35'),
(33, 3, 'CLOZOLE B CREAM', 200, 100, NULL, '0000-00-00', 0, '2023-08-01 02:53:20', '2023-08-02 19:55:35'),
(34, 3, 'Benzyl Benzoate BBB/ Calamine Lotion', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 02:57:52', '2023-08-02 19:55:35'),
(35, 3, 'Burnazine Cream', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 02:58:38', '2023-08-02 19:55:35'),
(36, 3, 'Anustat Ointment', 400, 300, NULL, '0000-00-00', 0, '2023-08-01 02:59:35', '2023-08-02 19:55:35'),
(37, 3, 'CLOTRIMAZOLE CREAM', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 03:00:43', '2023-08-02 19:55:35'),
(38, 3, 'SULPHUR OINTMENT', 200, 150, NULL, '0000-00-00', 0, '2023-08-01 03:01:49', '2023-08-02 19:55:35'),
(39, 3, 'PR ADOL 125MG', 100, 50, NULL, '0000-00-00', 0, '2023-08-01 03:03:45', '2023-08-02 19:55:35'),
(40, 3, 'PR ADOL 250MG', 150, 10, NULL, '0000-00-00', 0, '2023-08-01 03:04:22', '2023-08-02 19:55:35'),
(41, 3, 'Probeta N Eye/ Ear drops', 200, 100, NULL, '0000-00-00', 0, '2023-08-01 03:05:27', '2023-08-02 19:55:35'),
(42, 3, 'Ciprofloxacin/ Gentamicin Eye Drops', 150, 70, NULL, '0000-00-00', 0, '2023-08-01 03:06:22', '2023-08-02 19:55:35'),
(43, 3, 'Dextracin Eye/ Ear drops', 350, 200, NULL, '0000-00-00', 0, '2023-08-01 03:07:10', '2023-08-02 19:55:35'),
(44, 3, 'AEROVENT INHALLER', 1800, 1500, NULL, '0000-00-00', 0, '2023-08-01 03:09:34', '2023-08-02 19:55:35'),
(45, 3, 'AEROCORT INHALLER', 1600, 1300, NULL, '0000-00-00', 0, '2023-08-01 03:10:12', '2023-08-02 19:55:35'),
(46, 3, 'VENTOLIN INHALLER', 250, 150, NULL, '0000-00-00', 0, '2023-08-01 03:11:30', '2023-08-02 19:55:35'),
(47, 2, 'Amoxicillin Syrup 60mls', 120, 80, NULL, '0000-00-00', 0, '2023-08-01 03:12:32', '2023-08-02 19:55:35'),
(48, 2, 'Amoxicillin Syrup 100mls', 200, 120, NULL, '0000-00-00', 0, '2023-08-01 03:13:15', '2023-08-02 19:55:35'),
(49, 2, 'Amoxicillin 250mg Tabs 1 Blister', 100, 60, NULL, '0000-00-00', 0, '2023-08-01 03:14:31', '2023-08-02 19:55:35'),
(50, 2, 'Amoxicillin 500mg Tabs 1 BLISTER', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 03:15:11', '2023-08-02 19:55:35'),
(51, 2, 'Ampiclox Syrup 60mls', 100, 70, NULL, '0000-00-00', 0, '2023-08-01 03:15:53', '2023-08-02 19:55:35'),
(52, 2, 'Ampiclox Syrup 100mls', 170, 100, NULL, '0000-00-00', 0, '2023-08-01 03:16:29', '2023-08-02 19:55:35'),
(53, 2, 'Ampiclox Tabs 250mg 1 Blister', 100, 70, NULL, '0000-00-00', 0, '2023-08-01 03:17:22', '2023-08-02 19:55:35'),
(54, 2, 'Ampiclox Tabs 500mg 1 BLISTER', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 03:18:40', '2023-08-02 19:55:35'),
(55, 2, 'Flucloxacillin 500mg 1 blister', 200, 100, NULL, '0000-00-00', 0, '2023-08-01 03:19:48', '2023-08-02 19:55:35'),
(56, 2, 'flucloxacillin 250mg 1 blister', 130, 100, NULL, '0000-00-00', 0, '2023-08-01 03:20:37', '2023-08-02 19:55:35'),
(57, 2, 'Amoxiclav 228mg  Syrup', 350, 200, NULL, '0000-00-00', 0, '2023-08-01 03:21:48', '2023-08-02 19:55:35'),
(58, 2, 'Amoxiclav 375mg 1 blister /box', 400, 300, NULL, '0000-00-00', 0, '2023-08-01 03:22:35', '2023-08-02 19:55:35'),
(59, 2, 'Amoxiclav 625mg', 500, 350, NULL, '0000-00-00', 0, '2023-08-01 03:23:20', '2023-08-02 19:55:35'),
(60, 2, 'Clindamycin 300mg', 500, 350, NULL, '0000-00-00', 0, '2023-08-01 03:24:18', '2023-08-02 19:55:35'),
(61, 2, 'Levofloxacin 500mg', 400, 250, NULL, '0000-00-00', 0, '2023-08-01 03:25:58', '2023-08-02 19:55:35'),
(62, 2, 'Levofloxacin 750mg', 500, 350, NULL, '0000-00-00', 0, '2023-08-01 03:26:51', '2023-08-02 19:55:35'),
(63, 2, 'Cefuroxime Axetil 500mg Tablets', 500, 350, NULL, '0000-00-00', 0, '2023-08-01 03:27:43', '2023-08-02 19:55:35'),
(64, 2, 'Cefixime 200mg', 400, 300, NULL, '0000-00-00', 0, '2023-08-01 03:29:11', '2023-08-02 19:55:35'),
(65, 2, 'Cefadroxil Syrup 125mg/5ml 100mls', 400, 350, NULL, '0000-00-00', 0, '2023-08-01 03:30:02', '2023-08-02 19:55:35'),
(66, 2, 'DROX (Cefadroxil 500mg)', 300, 200, NULL, '0000-00-00', 0, '2023-08-01 03:30:59', '2023-08-02 19:55:35'),
(67, 2, 'Cefalexin 500mg Capsules 1 BLISTER', 250, 200, NULL, '0000-00-00', 0, '2023-08-01 03:31:48', '2023-08-02 19:55:35'),
(68, 2, 'Erythromycin 500mg 2  blister dose', 250, 150, NULL, '0000-00-00', 0, '2023-08-01 03:33:13', '2023-08-02 19:55:35'),
(69, 2, 'Doxycyline 100mg', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 03:34:05', '2023-08-02 19:55:35'),
(70, 2, 'Ciprofloxacin 500mg', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 03:35:01', '2023-08-02 19:55:35'),
(71, 2, 'COTRIMOXAZOLE 480MG 1 BLISTER PER BLISTER', 100, 70, NULL, '0000-00-00', 0, '2023-08-01 03:37:19', '2023-08-02 19:55:35'),
(72, 2, 'NITROFURANTOIN 100MG', 100, 50, NULL, '0000-00-00', 0, '2023-08-01 03:37:56', '2023-08-02 19:55:35'),
(73, 2, 'Fluconazole tabs 150mg SINGLE TAB', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 03:39:25', '2023-08-02 19:55:35'),
(74, 2, 'FLUCONAZOLE 200MG BLISTER', 250, 150, NULL, '0000-00-00', 0, '2023-08-01 03:40:06', '2023-08-02 19:55:35'),
(75, 2, 'Metronidazole 60ML Susp', 90, 70, NULL, '0000-00-00', 0, '2023-08-01 03:40:54', '2023-08-02 19:55:35'),
(76, 2, 'Metronidazole 100ml syrup', 130, 70, NULL, '0000-00-00', 0, '2023-08-01 03:41:36', '2023-08-02 19:55:35'),
(77, 2, 'Metronidazole tablets 200 mg/ blister', 50, 30, NULL, '0000-00-00', 0, '2023-08-01 03:42:17', '2023-08-02 19:55:35'),
(78, 2, 'Metronidazole tablets 400 mg/ blister', 100, 80, NULL, '0000-00-00', 0, '2023-08-01 03:43:01', '2023-08-02 19:55:35'),
(79, 2, 'Multivitamin Tablets 10S Blister', 100, 70, NULL, '0000-00-00', 0, '2023-08-01 03:45:56', '2023-08-02 19:55:35'),
(80, 2, 'CYPRO B PLUS BLISTER PACK 1 BLISTER', 300, 250, NULL, '0000-00-00', 0, '2023-08-01 03:46:47', '2023-08-02 19:55:35'),
(81, 2, 'CYPRO B PLUS SUSPENSION 200ML', 500, 350, NULL, '0000-00-00', 0, '2023-08-01 03:47:41', '2023-08-02 19:55:35'),
(82, 2, 'FERRO B SUSPENSION 200MLS', 700, 450, NULL, '0000-00-00', 0, '2023-08-01 03:48:16', '2023-08-02 19:55:35'),
(83, 2, 'PARACETAMOL TABLETS 500MG 1 BLISTER', 30, 20, NULL, '0000-00-00', 0, '2023-08-01 03:49:46', '2023-08-02 19:55:35'),
(84, 2, 'IBUPROFEN 200MG 1 BLISTER', 60, 40, NULL, '0000-00-00', 0, '2023-08-01 03:50:22', '2023-08-02 19:55:35'),
(85, 2, 'IBUPROFEN 400MG 1 Blister', 100, 60, NULL, '0000-00-00', 0, '2023-08-01 03:51:18', '2023-08-02 19:55:35'),
(86, 2, 'LOBAK 10 TABS', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 03:51:56', '2023-08-02 19:55:35'),
(87, 2, 'Diclofenac Tablets 100mg 1 BLISTER', 100, 60, NULL, '0000-00-00', 0, '2023-08-01 03:53:02', '2023-08-02 19:55:35'),
(88, 2, 'ACETAL-MR 1 BLISTER', 150, 100, NULL, '0000-00-00', 0, '2023-08-01 03:54:20', '2023-08-02 19:55:35'),
(89, 2, 'Aceclopyn Plus 1 blister', 250, 200, NULL, '0000-00-00', 0, '2023-08-01 03:55:12', '2023-08-02 19:55:35'),
(90, 2, 'METADOL FITZ 325MG 1 BLISTER', 400, 300, NULL, '0000-00-00', 0, '2023-08-01 03:56:29', '2023-08-02 19:55:35'),
(91, 2, 'LE SURE KIT 42\'TABS', 2500, 2000, NULL, '0000-00-00', 0, '2023-08-01 03:57:33', '2023-08-02 19:55:35'),
(92, 2, 'Atorvastatin 20mg 1 Box', 400, 300, NULL, '0000-00-00', 0, '2023-08-01 04:11:28', '2023-08-02 19:55:35'),
(93, 2, 'Diracip MDS 1 Dose/15Tabs', 500, 350, NULL, '0000-00-00', 0, '2023-08-01 04:13:25', '2023-08-02 19:55:35'),
(94, 2, 'Ofloxacin Ornidazole', 350, 200, NULL, '0000-00-00', 0, '2023-08-01 04:14:47', '2023-08-02 19:55:35'),
(95, 2, 'Piroxicam 20MG 1 BLISTER', 100, 50, NULL, '0000-00-00', 0, '2023-08-01 04:16:02', '2023-08-02 19:55:35'),
(96, 2, 'VOMI-KIND 4MG @Tab', 20, 10, NULL, '0000-00-00', 0, '2023-08-01 04:19:18', '2023-08-02 19:55:35'),
(97, 2, 'NOSIC @Tab', 30, 10, NULL, '0000-00-00', 0, '2023-08-01 04:20:22', '2023-08-02 19:55:35'),
(98, 2, 'Promethasine @Tab', 10, 5, NULL, '0000-00-00', 0, '2023-08-01 04:23:14', '2023-08-02 19:55:35'),
(99, 2, 'Metoclopromide 10mg @Tab', 10, 5, NULL, '0000-00-00', 0, '2023-08-01 04:24:18', '2023-08-02 19:55:35'),
(100, 2, 'Allucid/Anti-acid Tabs @Blister', 100, 40, NULL, '0000-00-00', 0, '2023-08-01 04:25:52', '2023-08-02 19:55:35'),
(101, 2, 'Albendazole 400MG', 50, 25, NULL, '0000-00-00', 0, '2023-08-01 04:26:55', '2023-08-02 19:55:35'),
(102, 2, 'Lonart 24s', 200, 100, NULL, '0000-00-00', 0, '2023-08-01 04:28:54', '2023-08-02 19:55:35'),
(103, 2, 'Artequick', 850, 400, NULL, '0000-00-00', 0, '2023-08-01 04:30:16', '2023-08-02 19:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_medicine_categories`
--

DROP TABLE IF EXISTS `jdh_medicine_categories`;
CREATE TABLE IF NOT EXISTS `jdh_medicine_categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `category_description` text NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_medicine_categories`
--

INSERT INTO `jdh_medicine_categories` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'Injectables', 'All injectable medications.'),
(2, 'Oral Medications', 'All oral medications.'),
(3, 'Creams/ Ointments', 'All cream and ointment medications.'),
(4, 'Drops', 'All drop medications.');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_medicine_stock`
--

DROP TABLE IF EXISTS `jdh_medicine_stock`;
CREATE TABLE IF NOT EXISTS `jdh_medicine_stock` (
  `id` int NOT NULL AUTO_INCREMENT,
  `medicine_id` int NOT NULL,
  `units_available` int NOT NULL,
  `expiry_date` date NOT NULL,
  `submittedby_user_id` int NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_medicine_stock`
--

INSERT INTO `jdh_medicine_stock` (`id`, `medicine_id`, `units_available`, `expiry_date`, `submittedby_user_id`, `date_created`, `date_updated`) VALUES
(1, 1, 1000, '2022-04-07', 0, '2023-08-24 12:55:00', '2023-10-10 16:49:20'),
(2, 2, 500, '2026-04-07', 0, '2023-08-24 12:58:46', '2023-10-10 16:45:51'),
(3, 15, 300, '2027-09-15', 0, '2023-08-24 12:59:04', '2023-10-10 16:46:17');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_patients`
--

DROP TABLE IF EXISTS `jdh_patients`;
CREATE TABLE IF NOT EXISTS `jdh_patients` (
  `patient_id` bigint NOT NULL AUTO_INCREMENT,
  `photo` mediumblob,
  `patient_ip_number` char(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `patient_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `patient_dob_year` int NOT NULL,
  `patient_gender` varchar(10) NOT NULL,
  `patient_phone` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `patient_kin_name` varchar(100) DEFAULT NULL,
  `patient_kin_phone` char(15) DEFAULT NULL,
  `service_id` int NOT NULL,
  `is_inpatient` int NOT NULL,
  `submitted_by_user_id` int NOT NULL,
  `patient_registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`patient_id`),
  UNIQUE KEY `patient_phone` (`patient_phone`),
  UNIQUE KEY `patient_national_id` (`patient_ip_number`),
  UNIQUE KEY `patient_ip_number` (`patient_ip_number`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_patients`
--

INSERT INTO `jdh_patients` (`patient_id`, `photo`, `patient_ip_number`, `patient_name`, `patient_dob_year`, `patient_gender`, `patient_phone`, `patient_kin_name`, `patient_kin_phone`, `service_id`, `is_inpatient`, `submitted_by_user_id`, `patient_registration_date`) VALUES
(1, NULL, '001', 'Patient One', 1984, 'Male', '0722000000', 'Demo Kin', '54566788', 1, 0, 1, '2023-08-03 22:57:29'),
(2, NULL, '002', 'Patient Two', 1984, 'Female', '0721123456', 'Demo Kin', '3435545', 1, 0, 1, '2023-08-03 22:58:55'),
(3, NULL, '003', 'Patient Three', 1977, 'Male', '0722103853', 'Mufuta', '0712345678', 1, 0, 1, '2023-08-05 18:02:25'),
(4, NULL, '004', 'Susan Rende', 2004, 'Female', '0722476500', 'Cathy Majiwa', '0722959779', 1, 1, 1, '2023-08-27 14:39:20'),
(5, NULL, '005', 'Mary Doe', 1969, 'Female', '0712345678', 'None', '0712345678', 1, 0, 2, '2023-08-29 21:42:35'),
(6, NULL, '006', 'Patient Four', 1972, 'Female', '23234', NULL, NULL, 1, 1, 1, '2023-10-14 19:50:17'),
(7, NULL, '007', 'Peter Doe', 1990, 'Male', '98002234', NULL, NULL, 1, 0, 1, '2023-10-24 15:40:04'),
(8, NULL, '008', 'Anne Jeremy', 2001, 'Female', '098776554', 'None', NULL, 1, 0, 1, '2023-10-25 10:42:31'),
(9, NULL, '009', 'Rude Jude', 1998, 'Male', '892873743', NULL, NULL, 1, 0, 1, '2023-10-25 11:23:12');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_patient_cases`
--

DROP TABLE IF EXISTS `jdh_patient_cases`;
CREATE TABLE IF NOT EXISTS `jdh_patient_cases` (
  `case_id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `random_blood_sugar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `history` text,
  `medical_history` text NOT NULL,
  `family` text NOT NULL,
  `socio_economic_history` text NOT NULL,
  `notes` text,
  `submission_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `submitted_by_user_id` int NOT NULL,
  PRIMARY KEY (`case_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_patient_cases`
--

INSERT INTO `jdh_patient_cases` (`case_id`, `patient_id`, `random_blood_sugar`, `history`, `medical_history`, `family`, `socio_economic_history`, `notes`, `submission_date`, `submitted_by_user_id`) VALUES
(1, 2, 'Some of it..', 'No history', '', '', '', 'These are demo doctors notes', '2023-08-05 00:00:00', 3),
(2, 3, 'Testing..4567', 'Testing..', 'sddfgrtr  rtrytt tu', 'ddsf sdsdfdf dsdsf', 'sddsd sdsdsf tuyio uo0p0o', 'ewee rytyuio op[p', '2023-08-29 23:57:17', 3);

-- --------------------------------------------------------

--
-- Stand-in structure for view `jdh_patient_queue`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `jdh_patient_queue`;
CREATE TABLE IF NOT EXISTS `jdh_patient_queue` (
`visit_id` int
,`patient_name` varchar(50)
,`visit_type` varchar(100)
,`visit_date` timestamp
);

-- --------------------------------------------------------

--
-- Table structure for table `jdh_patient_visits`
--

DROP TABLE IF EXISTS `jdh_patient_visits`;
CREATE TABLE IF NOT EXISTS `jdh_patient_visits` (
  `visit_id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `visit_type_id` int NOT NULL,
  `user_id` int NOT NULL,
  `insurance_id` int DEFAULT NULL,
  `visit_description` text,
  `visit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subbmitted_by_user_id` int NOT NULL,
  PRIMARY KEY (`visit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_patient_visits`
--

INSERT INTO `jdh_patient_visits` (`visit_id`, `patient_id`, `visit_type_id`, `user_id`, `insurance_id`, `visit_description`, `visit_date`, `subbmitted_by_user_id`) VALUES
(3, 1, 1, 3, NULL, 'This is a test visit', '2023-08-06 15:33:22', 0),
(4, 3, 2, 3, NULL, 'Another visit by patient three', '2023-08-23 19:59:56', 2),
(5, 3, 2, 9, 1, 'Patient needs to be admitted.', '2023-08-24 18:57:45', 0),
(6, 4, 1, 9, NULL, 'This is a visit by Susan', '2023-08-27 11:44:59', 2),
(7, 1, 1, 9, NULL, 'Test visit', '2023-08-27 12:56:07', 2),
(8, 5, 3, 9, 4, 'Test Visit', '2023-08-29 18:47:16', 2),
(9, 1, 2, 10, NULL, 'hujhjuhuh', '2023-08-29 19:42:26', 0),
(10, 2, 1, 9, 2, 'ewrrert frfrtr', '2023-08-29 20:44:19', 2),
(11, 4, 2, 10, 4, 'Emergency operation', '2023-08-29 20:48:09', 2),
(12, 8, 2, 10, 3, 'Test', '2023-10-25 08:22:17', 0),
(13, 1, 3, 3, 3, 'The patient is coming for some CT scan.', '2023-10-30 05:56:15', 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `jdh_pharmacy_income`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `jdh_pharmacy_income`;
CREATE TABLE IF NOT EXISTS `jdh_pharmacy_income` (
`patient_id` bigint
,`patient_name` varchar(50)
,`name` varchar(191)
,`selling_price` double
,`units_available` int
,`units_given` int
,`submission_date` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `jdh_prescriptions`
--

DROP TABLE IF EXISTS `jdh_prescriptions`;
CREATE TABLE IF NOT EXISTS `jdh_prescriptions` (
  `prescription_id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `prescription_title` varchar(200) NOT NULL,
  `medicine_id` int NOT NULL,
  `tabs` int NOT NULL,
  `frequency` int NOT NULL,
  `prescription_days` int NOT NULL,
  `prescription_time` varchar(100) NOT NULL,
  `prescription_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `submitted_by_user_id` int NOT NULL,
  PRIMARY KEY (`prescription_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_prescriptions`
--

INSERT INTO `jdh_prescriptions` (`prescription_id`, `patient_id`, `prescription_title`, `medicine_id`, `tabs`, `frequency`, `prescription_days`, `prescription_time`, `prescription_date`, `submitted_by_user_id`) VALUES
(1, 1, 'Prescription for Patient One', 1, 1, 3, 5, 'After Meals', '2023-08-24 21:27:49', 3);

-- --------------------------------------------------------

--
-- Table structure for table `jdh_prescriptions_actions`
--

DROP TABLE IF EXISTS `jdh_prescriptions_actions`;
CREATE TABLE IF NOT EXISTS `jdh_prescriptions_actions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `medicine_id` int NOT NULL,
  `units_given` int NOT NULL,
  `submittedby_user_id` int NOT NULL,
  `submission_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_prescriptions_actions`
--

INSERT INTO `jdh_prescriptions_actions` (`id`, `patient_id`, `medicine_id`, `units_given`, `submittedby_user_id`, `submission_date`) VALUES
(1, 1, 1, 10, 6, '2023-08-24 21:40:32');

-- --------------------------------------------------------

--
-- Stand-in structure for view `jdh_registration_income`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `jdh_registration_income`;
CREATE TABLE IF NOT EXISTS `jdh_registration_income` (
`patient_id` bigint
,`patient_name` varchar(50)
,`patient_gender` varchar(10)
,`service_cost` int
,`patient_registration_date` datetime
,`patient_dob_year` int
);

-- --------------------------------------------------------

--
-- Table structure for table `jdh_roles`
--

DROP TABLE IF EXISTS `jdh_roles`;
CREATE TABLE IF NOT EXISTS `jdh_roles` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) NOT NULL,
  `role_description` text,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_roles`
--

INSERT INTO `jdh_roles` (`role_id`, `role_name`, `role_description`) VALUES
(1, 'Administrator', '<p>Has access to all modules and functions of the system</p>'),
(2, 'Receptionist', '<p>Has access to receptionist functions.</p>'),
(3, 'Doctor', '<p>Has access to all the doctor functions.</p>'),
(4, 'Nurse', '<p>Has Access to all the nursing functions.</p>'),
(5, 'Lab Technician', '<p>Has access to all the lab technician functions.</p>'),
(6, 'Pharmacist', '<p>Has access to all the pharmacist functions.</p>'),
(7, 'Biller', '<p>Has all the access to biller functions.</p>'),
(8, 'Human Resources Manager', '<p>Has access to all the functions of a human resources manager.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_services`
--

DROP TABLE IF EXISTS `jdh_services`;
CREATE TABLE IF NOT EXISTS `jdh_services` (
  `service_id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `subcategory_id` int NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `service_cost` int NOT NULL,
  `service_description` text,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `submitted_by_user_id` int NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_services`
--

INSERT INTO `jdh_services` (`service_id`, `category_id`, `subcategory_id`, `service_name`, `service_cost`, `service_description`, `date_created`, `date_updated`, `submitted_by_user_id`) VALUES
(1, 1, 1, 'Patient Registration Fee', 100, 'Patient registration fees.', '2023-08-08 15:33:14', '2023-08-08 16:02:08', 0),
(2, 1, 2, 'Doctor Consultation Fee', 500, 'Doctor Consultation Fee.', '2023-08-08 15:45:49', '2023-08-08 15:45:49', 0),
(3, 2, 3, 'Cleaning and Dressing Fee', 250, 'Cleaning and Dressing Fee.', '2023-08-08 15:46:23', '2023-08-08 16:01:49', 0),
(4, 2, 4, 'Injection Fee', 200, 'Injection Fee', '2023-08-08 15:46:47', '2023-08-08 15:49:23', 0),
(5, 2, 5, 'Circumcision', 3000, 'Circumcision Fee', '2023-08-08 15:47:15', '2023-08-08 15:47:15', 0),
(6, 2, 6, 'Stitiching Fee', 1000, 'Stitching Fee', '2023-08-08 15:59:56', '2023-08-08 16:01:35', 0),
(7, 2, 7, 'Catheterization Fee', 500, 'Catheterization Fee', '2023-08-08 20:53:20', '2023-08-08 20:53:20', 0),
(8, 2, 8, 'Suprapubic Catheterization Fee', 4000, 'Suprapubic Catheterization Fee', '2023-08-08 20:54:03', '2023-08-08 20:54:03', 0),
(9, 2, 9, 'MVA Fee', 5000, 'MVA Fee', '2023-08-08 20:55:10', '2023-08-08 20:55:10', 0),
(10, 2, 10, 'Incision and Drainage Fee', 500, 'Incision and Drainage Fee', '2023-08-08 20:56:58', '2023-08-08 20:56:58', 0),
(11, 2, 12, 'ECG Fee', 1500, 'ECG Fee', '2023-08-08 21:01:09', '2023-08-08 21:01:09', 0),
(12, 2, 13, 'Nebulization', 350, '350', '2023-08-08 21:04:39', '2023-08-08 21:04:39', 0),
(13, 3, 14, 'RBS Test', 150, 'RBS Test', '2023-08-08 22:56:34', '2023-08-08 22:56:34', 0),
(14, 3, 15, 'Malaria Test/RDT/BS for MPS Test', 150, 'Malaria Test/RDT/BS for MPS Test', '2023-08-08 22:57:52', '2023-08-08 22:57:52', 0),
(15, 3, 16, 'Urinalysis Test', 150, 'Urinalysis Test', '2023-08-08 22:59:24', '2023-08-08 22:59:24', 0),
(16, 3, 17, 'VDRL Test', 150, 'VDRL Test', '2023-08-08 23:00:23', '2023-08-08 23:00:23', 0),
(17, 3, 18, 'SAT Test', 500, 'SAT Test', '2023-08-08 23:01:26', '2023-08-08 23:01:26', 0),
(18, 3, 19, 'H. Pylori', 1000, 'H. Pylori', '2023-08-08 23:02:53', '2023-08-08 23:02:53', 0),
(19, 3, 20, 'Check HB', 300, 'Check HB', '2023-08-08 23:04:01', '2023-08-08 23:04:01', 0),
(20, 3, 21, 'ANC Profile', 1200, 'ANC Profile', '2023-08-08 23:05:07', '2023-08-08 23:05:07', 0),
(21, 3, 22, 'HIV/PITC', 100, 'HIV/PITC', '2023-08-08 23:06:19', '2023-08-08 23:06:19', 0),
(22, 3, 23, 'Rheumatoid Factor', 300, 'Rheumatoid Factor', '2023-08-08 23:07:31', '2023-08-08 23:07:31', 0),
(23, 3, 24, 'Stool for o/c', 200, 'Stool for o/c', '2023-08-08 23:08:21', '2023-08-08 23:08:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jdh_service_category`
--

DROP TABLE IF EXISTS `jdh_service_category`;
CREATE TABLE IF NOT EXISTS `jdh_service_category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `category_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_service_category`
--

INSERT INTO `jdh_service_category` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'General Services', 'General Services'),
(2, 'Procedures', 'Procedures'),
(3, 'Laboratory', 'Laboratory services'),
(4, 'Others', 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_service_subcategory`
--

DROP TABLE IF EXISTS `jdh_service_subcategory`;
CREATE TABLE IF NOT EXISTS `jdh_service_subcategory` (
  `subcategory_id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `subcategory_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`subcategory_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_service_subcategory`
--

INSERT INTO `jdh_service_subcategory` (`subcategory_id`, `category_id`, `subcategory_name`, `description`) VALUES
(1, 1, 'Registration Fee', 'Registration Fees'),
(2, 1, 'Consultation Fee', 'Doctor consultation fee'),
(3, 2, 'Cleaning and Dressing', 'Cleaning and Dressing'),
(4, 2, 'Injection', 'Injection'),
(5, 2, 'Circumcision', 'Circumcision'),
(6, 2, 'Stitching', 'Stitching'),
(7, 2, 'Catheterization', 'Catheterization'),
(8, 2, 'Suprapubic Catheterization', 'Suprapubic Catheterization'),
(9, 2, 'MVA', 'MVA'),
(10, 2, 'Incision and Drainage', 'Incision and Drainage'),
(11, 2, 'Point of Care Ultrasound', 'Point of Care Ultrasound'),
(12, 2, 'ECG', 'ECG'),
(13, 2, 'Nebulization', 'Nebulization'),
(14, 3, 'RBS', 'RBS Test'),
(15, 3, 'Malaria Test/RDT/BS for MPS Test', 'Malaria Test/RDT/BS for MPS Test'),
(16, 3, 'Urinalysis', 'Urinalysis'),
(17, 3, 'VDRL', 'VDRL'),
(18, 3, 'SAT Test', 'SAT Test'),
(19, 3, 'H. Pylori', 'H. Pylori'),
(20, 3, 'Check HB', 'Check HB'),
(21, 3, 'ANC Profile', 'ANC Profile'),
(22, 3, 'HIV/PITC', 'HIV/PITC'),
(23, 3, 'Rheumatoid Factor', 'Rheumatoid Factor'),
(24, 3, 'Stool for o/c', 'Stool for o/c');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_status`
--

DROP TABLE IF EXISTS `jdh_status`;
CREATE TABLE IF NOT EXISTS `jdh_status` (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_status`
--

INSERT INTO `jdh_status` (`status_id`, `status`) VALUES
(1, 'Done'),
(2, 'Deferred');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_test_reports`
--

DROP TABLE IF EXISTS `jdh_test_reports`;
CREATE TABLE IF NOT EXISTS `jdh_test_reports` (
  `report_id` int NOT NULL AUTO_INCREMENT,
  `request_id` int NOT NULL,
  `patient_id` int NOT NULL,
  `report_findings` text NOT NULL,
  `report_attachment` mediumblob,
  `report_submittedby_user_id` int NOT NULL,
  `report_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`report_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_test_reports`
--

INSERT INTO `jdh_test_reports` (`report_id`, `request_id`, `patient_id`, `report_findings`, `report_attachment`, `report_submittedby_user_id`, `report_date`) VALUES
(1, 1, 1, 'There were some blood clots...', NULL, 5, '2023-08-08 22:34:57'),
(2, 1, 1, 'Testing...', NULL, 5, '2023-08-08 22:41:56'),
(3, 3, 4, 'These are test findings for ANC profile', NULL, 5, '2023-08-30 00:30:33');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_test_requests`
--

DROP TABLE IF EXISTS `jdh_test_requests`;
CREATE TABLE IF NOT EXISTS `jdh_test_requests` (
  `request_id` bigint NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `request_title` varchar(200) NOT NULL,
  `request_service_id` int NOT NULL,
  `request_description` text,
  `requested_by_user_id` int NOT NULL,
  `status_id` int NOT NULL,
  `request_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_test_requests`
--

INSERT INTO `jdh_test_requests` (`request_id`, `patient_id`, `request_title`, `request_service_id`, `request_description`, `requested_by_user_id`, `status_id`, `request_date`) VALUES
(1, 1, 'RBS test request for Patient Demo', 13, 'RBS test request for Patient Demo', 3, 1, '2023-08-05 13:45:01'),
(2, 2, 'RBS test request for Patient Demo', 13, 'RBS test request for Patient Demo', 3, 1, '2023-08-05 14:14:50'),
(3, 4, 'Susan ANC Profile Test', 20, 'This is first test', 3, 1, '2023-08-30 00:13:13');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_users`
--

DROP TABLE IF EXISTS `jdh_users`;
CREATE TABLE IF NOT EXISTS `jdh_users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `photo` mediumblob,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `national_id` char(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int NOT NULL,
  `department_id` int NOT NULL,
  `password` varchar(255) NOT NULL,
  `biography` text NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_users`
--

INSERT INTO `jdh_users` (`user_id`, `photo`, `first_name`, `last_name`, `national_id`, `email_address`, `phone`, `role_id`, `department_id`, `password`, `biography`, `registration_date`) VALUES
(1, NULL, 'Systems', 'Administrator', '001', 'administrator@example.com', '123456789', -1, 4, '12288e7196c773a802343b284b98b755', 'a:23:{s:7:\"user_id\";i:1;s:5:\"photo\";N;s:10:\"first_name\";s:7:\"Systems\";s:9:\"last_name\";s:13:\"Administrator\";s:11:\"national_id\";s:1:\"1\";s:13:\"email_address\";s:25:\"administrator@example.com\";s:5:\"phone\";s:9:\"123456789\";s:4:\"role\";s:13:\"Administrator\";s:13:\"department_id\";i:4;s:9:\"biography\";s:46:\"<p>This is a systems administrator profile</p>\";s:17:\"registration_date\";s:19:\"2023-08-04 20:59:58\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/04\";s:6:\"Secret\";s:8:\"98810353\";s:20:\"SecretCreateDateTime\";s:19:\"2023-09-30 08:14:53\";s:11:\"BackupCodes\";a:10:{i:0;s:184:\"def50200a9e3e15fafb0d2baf8f24e56565a05016636f50fe839ef7336e49a6543cf7609a3308712ac491a813c8f1f8363942b7abf4066b1641eda4ac5e5d7e8f9cc9902dd485c00f0ffe606028ea4e8b12b5f6d157fdbfe81f22a84\";i:1;s:184:\"def5020083461ce99f25bb10a01f2075b15833cc528debd97f2c4298907b68299e6b61992eb947afac9c24922e40769830c475b3c3f1ffb3055a1c814fa79c89d83dc53e3002f97581a9c9a449131a6d39ec0ed5527caa01c0d76b65\";i:2;s:184:\"def5020061ca7b2852a7dbb8a362a800cf92fe63778f515e3bef1cba340aa943a5950e17a9db0662d61d75524d1fa2c3efe1dea73afd9702439d472cd5ea73097c46d8fd8d115e82cc42b7b330b556041aab18a43d93579126160238\";i:3;s:184:\"def50200509ed918d6ca4b1f50c3ce904f800bd2db2ffae68450521feb949ff46f34807c14f894273eb0e49232e3b2b47b41a4ffbb9ddfd8aca4725f264014b966853b69200ec1ba37e21e1bc5be2f02618f8622358c02a73cd1ff87\";i:4;s:184:\"def50200c673b2548574132240adb89fa3ec0d638a974a47ff88bbb224476d5d7b2260a6c841bbb99757332f38320951fbfec2fa4249f62911c15ae71cc48c21d355f2409e3d2fe457ee2de9cf3b32dc7ecb35a3de01b2f8b71087c1\";i:5;s:184:\"def5020030340fdbefd18002dffe81e8b72397a1699d08f3326b768a02a87f4db522e717a81ff301f97f0f7bd37267c96b1eddc5701c53f5f127c5d7d75f8781087d5ab1b9a4c1b1a5e0cdcb0ee55518235affa963824f63d37f8ebc\";i:6;s:184:\"def502000b95ee2a12ef6d1a74a50b23531690d3787be726214ef340bb7c05ca0b0b893f11884fca529771e77d55672114b0473377cf8edb8043062c1f87a64abb4346d7c8006872c4c5f0cc18375131b93311aed4ab6191116beae1\";i:7;s:184:\"def502008d0d9ac7f99fcf9f54a394c71a6ff2eb9c01b7e1a5f8239f3d2daab04a4ef1f639ed6d8feb7ce05954d80e0b8968d70815dc25626ef9a35a7c7be9ec1d854ee0a8716f62cefc41f2862bdfd13f144a771e10affa97766e53\";i:8;s:184:\"def5020070099cda6b9935ac84430e96436402c22e8d6ef766de1be3e89ce53db26aac673b0113df2087c45e4f6937f0e25f42da97209cfd8a2bf2a4415f1cbde4bb62b6021a88f289555351d65c6d7c3ea1a05482ff5f3bfb06972e\";i:9;s:184:\"def502007016973069e25cc6130c478d17e0867535a8b0636f3e6409bc8e17be7b09d0b2e33ad10705625c3c712773d70cbed9c9a1b8f8689c2435fb14ba9fe27fe48e2df27f647b3b6073a7e88719e804da2422aff5a53149b5a9f7\";}s:3:\"OTP\";s:16:\"yyvF9flL8uJtA2tr\";s:10:\"OTPAccount\";s:10:\"0720801001\";s:17:\"OTPCreateDateTime\";s:19:\"2023-09-30 08:14:57\";s:15:\"LoginRetryCount\";i:0;s:9:\"SessionID\";s:26:\"i66ng5gb83fh2gqhq6jd0udtag\";s:20:\"LastAccessedDateTime\";s:19:\"2023/10/24 11:43:23\";s:7:\"role_id\";i:-1;}', '2023-08-04 20:59:58'),
(2, NULL, 'Receptionist', 'Demo', '002', 'receptionist@example.com', '123456789', 1, 7, '12288e7196c773a802343b284b98b755', 'a:14:{s:7:\"user_id\";s:1:\"2\";s:5:\"photo\";N;s:10:\"first_name\";s:12:\"Receptionist\";s:9:\"last_name\";s:4:\"Demo\";s:11:\"national_id\";s:1:\"2\";s:13:\"email_address\";s:24:\"receptionist@example.com\";s:5:\"phone\";s:9:\"123456789\";s:7:\"role_id\";s:1:\"2\";s:13:\"department_id\";s:1:\"7\";s:9:\"biography\";s:37:\"<p>This is a receptionist profile</p>\";s:17:\"registration_date\";s:19:\"2023-08-04 21:06:42\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/04\";s:15:\"LoginRetryCount\";i:0;}', '2023-08-04 21:06:42'),
(3, NULL, 'Doctor', 'Demo', '003', 'doctor@example.com', '123456789', 2, 1, '12288e7196c773a802343b284b98b755', 'a:14:{s:7:\"user_id\";s:1:\"3\";s:5:\"photo\";N;s:10:\"first_name\";s:6:\"Doctor\";s:9:\"last_name\";s:4:\"Demo\";s:11:\"national_id\";s:1:\"3\";s:13:\"email_address\";s:18:\"doctor@example.com\";s:5:\"phone\";s:9:\"123456789\";s:7:\"role_id\";s:1:\"2\";s:13:\"department_id\";s:1:\"1\";s:9:\"biography\";s:31:\"<p>This is a doctor profile</p>\";s:17:\"registration_date\";s:19:\"2023-08-04 22:08:22\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/04\";s:15:\"LoginRetryCount\";i:0;}', '2023-08-04 22:08:22'),
(4, NULL, 'Nurse', 'Demo', '004', 'nurse@example.com', '123456789', 9, 9, '12288e7196c773a802343b284b98b755', 'a:16:{s:7:\"user_id\";i:4;s:5:\"photo\";N;s:10:\"first_name\";s:5:\"Nurse\";s:9:\"last_name\";s:4:\"Demo\";s:11:\"national_id\";s:1:\"4\";s:13:\"email_address\";s:17:\"nurse@example.com\";s:5:\"phone\";s:9:\"123456789\";s:7:\"role_id\";i:9;s:13:\"department_id\";i:9;s:9:\"biography\";s:488:\"a:15:{s:7:\"user_id\";s:1:\"4\";s:5:\"photo\";N;s:10:\"first_name\";s:5:\"Nurse\";s:9:\"last_name\";s:4:\"Demo\";s:11:\"national_id\";s:1:\"4\";s:13:\"email_address\";s:17:\"nurse@example.com\";s:5:\"phone\";s:9:\"123456789\";s:7:\"role_id\";s:1:\"3\";s:13:\"department_id\";s:1:\"9\";s:9:\"biography\";s:30:\"<p>This is a nurse profile</p>\";s:17:\"registration_date\";s:19:\"2023-08-04 22:56:10\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/04\";s:9:\"SessionID\";s:0:\"\";s:20:\"LastAccessedDateTime\";s:0:\"\";}\";s:17:\"registration_date\";s:19:\"2023-08-04 22:56:10\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/04\";s:9:\"SessionID\";s:0:\"\";s:20:\"LastAccessedDateTime\";s:0:\"\";s:15:\"LoginRetryCount\";i:0;}', '2023-08-04 22:56:10'),
(5, NULL, 'Laboratorist', 'Demo', '005', 'laboratorist@example.com', '123456789', 3, 6, '12288e7196c773a802343b284b98b755', 'a:16:{s:7:\"user_id\";i:5;s:5:\"photo\";N;s:10:\"first_name\";s:12:\"Laboratorist\";s:9:\"last_name\";s:4:\"Demo\";s:11:\"national_id\";s:1:\"5\";s:13:\"email_address\";s:24:\"laboratorist@example.com\";s:5:\"phone\";s:9:\"123456789\";s:7:\"role_id\";i:3;s:13:\"department_id\";i:6;s:9:\"biography\";s:442:\"a:13:{s:7:\"user_id\";s:1:\"5\";s:5:\"photo\";N;s:10:\"first_name\";s:12:\"Laboratorist\";s:9:\"last_name\";s:4:\"Demo\";s:11:\"national_id\";s:1:\"5\";s:13:\"email_address\";s:24:\"laboratorist@example.com\";s:5:\"phone\";s:9:\"123456789\";s:7:\"role_id\";s:1:\"4\";s:13:\"department_id\";s:1:\"6\";s:9:\"biography\";s:27:\"<p>Laboratorist profile</p>\";s:17:\"registration_date\";s:19:\"2023-08-05 13:43:15\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/05\";}\";s:17:\"registration_date\";s:19:\"2023-08-05 13:43:15\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/05\";s:15:\"LoginRetryCount\";i:0;s:9:\"SessionID\";s:0:\"\";s:20:\"LastAccessedDateTime\";s:0:\"\";}', '2023-08-05 13:43:15'),
(6, NULL, 'Pharmacist', 'Demo', '006', 'pharmacist@example.com', '123456789', 4, 3, '12288e7196c773a802343b284b98b755', 'a:16:{s:7:\"user_id\";i:6;s:5:\"photo\";N;s:10:\"first_name\";s:10:\"Pharmacist\";s:9:\"last_name\";s:4:\"Demo\";s:11:\"national_id\";s:1:\"6\";s:13:\"email_address\";s:22:\"pharmacist@example.com\";s:5:\"phone\";s:9:\"123456789\";s:7:\"role_id\";i:4;s:13:\"department_id\";i:3;s:9:\"biography\";s:446:\"a:13:{s:7:\"user_id\";s:1:\"6\";s:5:\"photo\";N;s:10:\"first_name\";s:10:\"Pharmacist\";s:9:\"last_name\";s:4:\"Demo\";s:11:\"national_id\";s:1:\"6\";s:13:\"email_address\";s:22:\"pharmacist@example.com\";s:5:\"phone\";s:9:\"123456789\";s:7:\"role_id\";s:1:\"5\";s:13:\"department_id\";s:1:\"3\";s:9:\"biography\";s:35:\"<p>This is a pharmacist profile</p>\";s:17:\"registration_date\";s:19:\"2023-08-08 11:05:42\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/08\";}\";s:17:\"registration_date\";s:19:\"2023-08-08 11:05:42\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/08\";s:15:\"LoginRetryCount\";i:0;s:9:\"SessionID\";s:0:\"\";s:20:\"LastAccessedDateTime\";s:0:\"\";}', '2023-08-08 11:05:42'),
(7, NULL, 'Accountant', 'Demo', '007', 'accountant@example.com', '123456789', 5, 5, '12288e7196c773a802343b284b98b755', 'a:14:{s:7:\"user_id\";s:1:\"7\";s:5:\"photo\";N;s:10:\"first_name\";s:10:\"Accountant\";s:9:\"last_name\";s:4:\"Demo\";s:11:\"national_id\";s:1:\"7\";s:13:\"email_address\";s:22:\"accountant@example.com\";s:5:\"phone\";s:9:\"123456789\";s:7:\"role_id\";s:2:\"-2\";s:13:\"department_id\";s:1:\"5\";s:9:\"biography\";s:35:\"<p>This is accountants profile.</p>\";s:17:\"registration_date\";s:19:\"2023-08-08 14:34:59\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/08\";s:15:\"LoginRetryCount\";i:0;}', '2023-08-08 14:34:59'),
(8, NULL, 'Stores', 'Demo', '008', 'stores@example.com', '123456789', 6, 8, '12288e7196c773a802343b284b98b755', 'a:16:{s:7:\"user_id\";i:8;s:5:\"photo\";N;s:10:\"first_name\";s:6:\"Stores\";s:9:\"last_name\";s:4:\"Demo\";s:11:\"national_id\";s:3:\"900\";s:13:\"email_address\";s:18:\"stores@example.com\";s:5:\"phone\";s:9:\"123456789\";s:7:\"role_id\";i:6;s:13:\"department_id\";i:8;s:9:\"biography\";s:414:\"a:13:{s:7:\"user_id\";i:8;s:5:\"photo\";N;s:10:\"first_name\";s:6:\"Stores\";s:9:\"last_name\";s:4:\"Demo\";s:11:\"national_id\";s:3:\"900\";s:13:\"email_address\";s:18:\"stores@example.com\";s:5:\"phone\";s:9:\"123456789\";s:7:\"role_id\";i:7;s:13:\"department_id\";i:8;s:9:\"biography\";s:22:\"Inventory professional\";s:17:\"registration_date\";s:19:\"2023-08-24 12:15:49\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/24\";}\";s:17:\"registration_date\";s:19:\"2023-08-24 12:15:49\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/24\";s:15:\"LoginRetryCount\";i:0;s:9:\"SessionID\";s:26:\"jti4e485qof5sl2cf2rbe6j4aj\";s:20:\"LastAccessedDateTime\";s:19:\"2023/10/23 13:12:51\";}', '2023-08-24 12:15:49'),
(9, NULL, 'Dennis', 'Miriti', '009', 'miritidennis@gmail.com', '0722103853', 2, 1, '12288e7196c773a802343b284b98b755', 'General Doctor', '2023-08-24 19:52:11'),
(10, NULL, 'John', 'Doe', '010', 'johndoe@example.com', '7544544', 2, 2, '12288e7196c773a802343b284b98b755', 'John Doe has joined the club.', '2023-08-27 19:40:41'),
(11, NULL, 'Human', 'Resources', '011', 'humanresources@example.com', '0712345678', 7, 5, '12288e7196c773a802343b284b98b755', 'Test', '2023-10-10 20:37:29'),
(12, NULL, 'Hospital', 'Manager', '012', 'manager@example.com', '0712345678', 8, 5, '12288e7196c773a802343b284b98b755', 'a:15:{s:15:\"LoginRetryCount\";i:0;s:9:\"SessionID\";s:0:\"\";s:20:\"LastAccessedDateTime\";s:0:\"\";s:7:\"user_id\";i:12;s:5:\"photo\";N;s:10:\"first_name\";s:8:\"Hospital\";s:9:\"last_name\";s:7:\"Manager\";s:11:\"national_id\";s:8:\"33335677\";s:13:\"email_address\";s:19:\"manager@example.com\";s:5:\"phone\";s:10:\"0712345678\";s:7:\"role_id\";i:8;s:13:\"department_id\";i:5;s:9:\"biography\";s:458:\"a:15:{s:15:\"LoginRetryCount\";i:0;s:9:\"SessionID\";s:0:\"\";s:20:\"LastAccessedDateTime\";s:0:\"\";s:7:\"user_id\";i:12;s:5:\"photo\";N;s:10:\"first_name\";s:8:\"Hospital\";s:9:\"last_name\";s:7:\"Manager\";s:11:\"national_id\";s:8:\"33335677\";s:13:\"email_address\";s:19:\"manager@example.com\";s:5:\"phone\";s:10:\"0712345678\";s:7:\"role_id\";i:9;s:13:\"department_id\";i:5;s:9:\"biography\";s:16:\"Hospital Manager\";s:17:\"registration_date\";s:19:\"2023-10-22 20:29:56\";s:9:\"UserImage\";s:0:\"\";}\";s:17:\"registration_date\";s:19:\"2023-10-22 20:29:56\";s:9:\"UserImage\";s:0:\"\";}', '2023-10-22 20:29:56');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_visit_types`
--

DROP TABLE IF EXISTS `jdh_visit_types`;
CREATE TABLE IF NOT EXISTS `jdh_visit_types` (
  `visit_type_id` int NOT NULL AUTO_INCREMENT,
  `visit_type` varchar(100) NOT NULL,
  `visit_description` text,
  PRIMARY KEY (`visit_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_visit_types`
--

INSERT INTO `jdh_visit_types` (`visit_type_id`, `visit_type`, `visit_description`) VALUES
(1, 'Regular', '<p>Regular visit option</p>'),
(2, 'Emergency', '<p>Emergency </p>'),
(3, 'Referral', '<p>Referral</p>');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_vitals`
--

DROP TABLE IF EXISTS `jdh_vitals`;
CREATE TABLE IF NOT EXISTS `jdh_vitals` (
  `vitals_id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int DEFAULT NULL,
  `pressure` int NOT NULL,
  `height` float NOT NULL,
  `weight` int NOT NULL,
  `pulse_rate` int NOT NULL,
  `respiratory_rate` int NOT NULL,
  `temperature` float NOT NULL,
  `random_blood_sugar` varchar(100) NOT NULL,
  `spo_2` int NOT NULL,
  `submission_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `submitted_by_user_id` int NOT NULL,
  PRIMARY KEY (`vitals_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_vitals`
--

INSERT INTO `jdh_vitals` (`vitals_id`, `patient_id`, `pressure`, `height`, `weight`, `pulse_rate`, `respiratory_rate`, `temperature`, `random_blood_sugar`, `spo_2`, `submission_date`, `submitted_by_user_id`) VALUES
(6, 4, 98, 1.7, 81, 77, 73, 35, '56', 93, '2023-09-11 18:48:39', 1),
(7, 2, 189, 1.85, 78, 73, 72, 36.8, '67', 98, '2023-09-11 22:55:23', 1),
(8, 3, 165, 1.89, 65, 73, 71, 33, '76', 90, '2023-09-11 23:01:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jdh_wards`
--

DROP TABLE IF EXISTS `jdh_wards`;
CREATE TABLE IF NOT EXISTS `jdh_wards` (
  `ward_id` int NOT NULL AUTO_INCREMENT,
  `facility_id` int NOT NULL,
  `ward_name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`ward_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jdh_wards`
--

INSERT INTO `jdh_wards` (`ward_id`, `facility_id`, `ward_name`, `description`) VALUES
(1, 1, 'Ward A', 'This is ward A'),
(2, 2, 'Ward B', 'This is ward B');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `User` varchar(255) DEFAULT NULL,
  `Endpoint` longtext NOT NULL,
  `PublicKey` varchar(255) NOT NULL,
  `AuthenticationToken` varchar(255) NOT NULL,
  `ContentEncoding` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`Id`, `User`, `Endpoint`, `PublicKey`, `AuthenticationToken`, `ContentEncoding`) VALUES
(1, '1', 'https://fcm.googleapis.com/fcm/send/emKddpbX70Y:APA91bGCM9GAsa7rOYwUdDjC2U0PL5eF89v-YNPitT9wm93HM1RGztY2-MGf1z832fK5zSNgw1RxyLOm7tZpjC6sZ9meUJmFswstqphi18YdS3ZqWMywMPIf1NyIUzHyLoGCeGSKud0K', 'BOp74E8EcZQ+n9BO5wSj4Rv9JBTBVFPCRnZYxSgXTckfjdWLsffK+GXOnfmZ11sCLMBj6A58CJe+ADf88atJGKo=', 'eBflwXmON4+bsb6HpSNRkQ==', 'aes128gcm'),
(2, '1', 'https://fcm.googleapis.com/fcm/send/epcDFVcz56o:APA91bHQgqv7T-yoiSDfNbKHND2jA7-ZTyaDpeCTnqrudNFzAmJDlSVmED20sGB7bfV8kvQv4ZLRl3Ua9LFaU_tIfybgQxBnpDzcHgWKyaAu-p1DRdOIxjgGKm9nQrxWDl4y6mM9f2Yi', 'BDvJ86VQF1hpxCbktIid7KeZ+9CBLBIMEpA7QwutyS0zkBxOxwVLYBAORfE+kO/cEKJ2UYpVoluxBdu5nPCIHcU=', 'FqqvBAjPlG97mTusVu8mBw==', 'aes128gcm');

-- --------------------------------------------------------

--
-- Structure for view `jdh_consultation_income`
--
DROP TABLE IF EXISTS `jdh_consultation_income`;

DROP VIEW IF EXISTS `jdh_consultation_income`;
CREATE VIEW `jdh_consultation_income`  AS SELECT `jdh_users`.`user_id` AS `user_id`, `jdh_users`.`first_name` AS `first_name`, `jdh_users`.`last_name` AS `last_name`, `jdh_users`.`department_id` AS `department_id`, `jdh_services`.`service_name` AS `service_name`, `jdh_services`.`service_cost` AS `service_cost`, `jdh_patients`.`patient_id` AS `patient_id` FROM (((((`jdh_doctor_charges` join `jdh_users` on((`jdh_users`.`user_id` = `jdh_doctor_charges`.`user_id`))) join `jdh_services` on((`jdh_doctor_charges`.`service_id` = `jdh_services`.`service_id`))) join `jdh_departments` on((`jdh_users`.`department_id` = `jdh_departments`.`department_id`))) join `jdh_patient_visits` on((`jdh_users`.`user_id` = `jdh_patient_visits`.`user_id`))) join `jdh_patients` on((`jdh_patients`.`patient_id` = `jdh_patient_visits`.`patient_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `jdh_lab_income`
--
DROP TABLE IF EXISTS `jdh_lab_income`;

DROP VIEW IF EXISTS `jdh_lab_income`;
CREATE VIEW `jdh_lab_income`  AS SELECT `jdh_patients`.`patient_name` AS `patient_name`, `jdh_services`.`service_name` AS `service_name`, `jdh_services`.`service_cost` AS `service_cost`, `jdh_test_requests`.`request_date` AS `request_date`, `jdh_test_requests`.`patient_id` AS `patient_id`, `jdh_patients`.`patient_dob_year` AS `patient_dob_year` FROM ((`jdh_patients` join `jdh_test_requests` on((`jdh_patients`.`patient_id` = `jdh_test_requests`.`patient_id`))) join `jdh_services` on((`jdh_test_requests`.`request_service_id` = `jdh_services`.`service_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `jdh_patient_queue`
--
DROP TABLE IF EXISTS `jdh_patient_queue`;

DROP VIEW IF EXISTS `jdh_patient_queue`;
CREATE VIEW `jdh_patient_queue`  AS SELECT `jdh_patient_visits`.`visit_id` AS `visit_id`, `jdh_patients`.`patient_name` AS `patient_name`, `jdh_visit_types`.`visit_type` AS `visit_type`, `jdh_patient_visits`.`visit_date` AS `visit_date` FROM ((`jdh_patient_visits` join `jdh_patients` on((`jdh_patients`.`patient_id` = `jdh_patient_visits`.`patient_id`))) join `jdh_visit_types` on((`jdh_visit_types`.`visit_type_id` = `jdh_patient_visits`.`visit_type_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `jdh_pharmacy_income`
--
DROP TABLE IF EXISTS `jdh_pharmacy_income`;

DROP VIEW IF EXISTS `jdh_pharmacy_income`;
CREATE VIEW `jdh_pharmacy_income`  AS SELECT `jdh_patients`.`patient_id` AS `patient_id`, `jdh_patients`.`patient_name` AS `patient_name`, `jdh_medicines`.`name` AS `name`, `jdh_medicines`.`selling_price` AS `selling_price`, `jdh_medicine_stock`.`units_available` AS `units_available`, `jdh_prescriptions_actions`.`units_given` AS `units_given`, `jdh_prescriptions_actions`.`submission_date` AS `submission_date` FROM ((((`jdh_medicines` join `jdh_medicine_stock` on((`jdh_medicines`.`id` = `jdh_medicine_stock`.`medicine_id`))) join `jdh_prescriptions` on((`jdh_medicines`.`id` = `jdh_prescriptions`.`medicine_id`))) join `jdh_patients` on((`jdh_patients`.`patient_id` = `jdh_prescriptions`.`patient_id`))) join `jdh_prescriptions_actions` on((`jdh_patients`.`patient_id` = `jdh_prescriptions_actions`.`patient_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `jdh_registration_income`
--
DROP TABLE IF EXISTS `jdh_registration_income`;

DROP VIEW IF EXISTS `jdh_registration_income`;
CREATE VIEW `jdh_registration_income`  AS SELECT `jdh_patients`.`patient_id` AS `patient_id`, `jdh_patients`.`patient_name` AS `patient_name`, `jdh_patients`.`patient_gender` AS `patient_gender`, `jdh_services`.`service_cost` AS `service_cost`, `jdh_patients`.`patient_registration_date` AS `patient_registration_date`, `jdh_patients`.`patient_dob_year` AS `patient_dob_year` FROM (`jdh_patients` join `jdh_services` on((`jdh_patients`.`service_id` = `jdh_services`.`service_id`)))  ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
