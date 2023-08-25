-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 25, 2023 at 09:42 PM
-- Server version: 8.0.31
-- PHP Version: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jootidigitalhealthcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `jdh_appointments`
--

DROP TABLE IF EXISTS `jdh_appointments`;
CREATE TABLE IF NOT EXISTS `jdh_appointments` (
  `appointment_id` bigint NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `appointment_title` varchar(200) NOT NULL,
  `appointment_start_date` datetime NOT NULL,
  `appointment_end_date` datetime NOT NULL,
  `appointment_all_day` tinyint(1) NOT NULL,
  `appointment_description` text NOT NULL,
  `submission_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subbmitted_by_user_id` int NOT NULL,
  PRIMARY KEY (`appointment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jdh_appointments`
--

INSERT INTO `jdh_appointments` (`appointment_id`, `patient_id`, `appointment_title`, `appointment_start_date`, `appointment_end_date`, `appointment_all_day`, `appointment_description`, `submission_date`, `subbmitted_by_user_id`) VALUES
(2, 1, 'Consult Dr. Hello World', '2023-08-06 19:00:00', '2023-08-06 20:00:00', 0, 'Consult Dr. Hello World', '2023-08-06 19:00:53', 2),
(3, 2, 'Seeing another doctor', '2023-08-10 22:20:00', '2023-08-10 23:20:00', 0, '<p>Seeing another doctor...</p>', '2023-08-09 21:23:46', 1),
(4, 1, 'See Dr. Damar Otieno', '2023-08-24 21:25:00', '2023-08-24 22:25:00', 1, '<p>Another appointment..</p>', '2023-08-16 21:26:10', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=543 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(542, '2023-08-25 21:11:33', '/jootidigitalhealthcare/login', '1', 'login', '::1', '', '', '', '');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jdh_chief_complaints`
--

INSERT INTO `jdh_chief_complaints` (`id`, `patient_id`, `chief_compaints`, `addedby_user_id`, `modifiedby_user_id`, `date_created`, `date_updated`) VALUES
(1, 3, 'Patient has fever', 4, 0, '2023-08-07 15:35:40', '2023-08-07 15:40:32'),
(2, 1, 'Test complaint', 4, 0, '2023-08-16 11:55:26', '2023-08-16 11:55:26');

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
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jdh_doctor_charges`
--

INSERT INTO `jdh_doctor_charges` (`id`, `user_id`, `service_id`, `description`, `submission_date`, `date_updated`, `submitted_by_user_id`) VALUES
(1, 3, 2, 'Consultation fees for Doctor Demo', '2023-08-25 16:27:17', '2023-08-25 16:27:17', 0),
(2, 9, 2, 'Consultation for Dr. Dennis Miriti', '2023-08-25 16:28:12', '2023-08-25 16:28:12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jdh_examination_findings`
--

DROP TABLE IF EXISTS `jdh_examination_findings`;
CREATE TABLE IF NOT EXISTS `jdh_examination_findings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `general_exams` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `systematic_exams` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `submitted_by_user_id` int NOT NULL,
  `date_submitted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jdh_examination_findings`
--

INSERT INTO `jdh_examination_findings` (`id`, `patient_id`, `general_exams`, `systematic_exams`, `submitted_by_user_id`, `date_submitted`) VALUES
(1, 1, 'Test examfr', 'sytematic...', 0, '2023-08-06 18:18:35');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Stand-in structure for view `jdh_lab_income`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `jdh_lab_income`;
CREATE TABLE IF NOT EXISTS `jdh_lab_income` (
`patient_name` varchar(50)
,`service_name` varchar(100)
,`service_cost` int
,`request_date` datetime
,`patient_dob` date
,`patient_id` int
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`test_subcategory_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(11, 2, 'Stool for o/c', '<p>Stool for o/c test</p>');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `submittedby_user_id` int NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jdh_medicine_stock`
--

INSERT INTO `jdh_medicine_stock` (`id`, `medicine_id`, `units_available`, `submittedby_user_id`, `date_created`, `date_updated`) VALUES
(1, 1, 1000, 0, '2023-08-24 12:55:00', '2023-08-24 12:55:00'),
(2, 2, 500, 0, '2023-08-24 12:58:46', '2023-08-24 12:58:46'),
(3, 15, 300, 0, '2023-08-24 12:59:04', '2023-08-24 12:59:04');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_notifications`
--

DROP TABLE IF EXISTS `jdh_notifications`;
CREATE TABLE IF NOT EXISTS `jdh_notifications` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `User` varchar(255) DEFAULT NULL,
  `Endpoint` longtext NOT NULL,
  `PublicKey` varchar(255) NOT NULL,
  `AuthenticationToken` varchar(255) NOT NULL,
  `ContentEncoding` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jdh_notifications`
--

INSERT INTO `jdh_notifications` (`Id`, `User`, `Endpoint`, `PublicKey`, `AuthenticationToken`, `ContentEncoding`) VALUES
(1, '6', 'https://fcm.googleapis.com/fcm/send/dPt51ennhGg:APA91bFSomLHKmHVuga3t7UDfq1YlksknKhDYBSLSMPOfqRxeYdAyZ3LaRUtq1nfss6RCJ4YdcQPfCjHZlnc6vOYotndGWRkxq8euMLz2XcKZ74K4qMSlKQ1BxXxMr2caCEvy8vGpFqY', 'BCWAeE5IOi/4JxIeufMOd8Ng4Ks5LChPQQs+AORZK2gVhceoHv/r6iKbDyKrASp+k0qDa8pMhXd5EJQsNKR0I/E=', 'jcdK/2JLqrfE6BCpabxUwQ==', 'aes128gcm'),
(2, '4', 'https://fcm.googleapis.com/fcm/send/ds7KN0z6EIc:APA91bFEhY97dSVtSPguQ5JZvgTuesHualIslxr47LlQG6MeLTnKKr7wcyb4PzSqVsomHoGiBY1e9SLLAk0juWpDWorwyvWVQlg__g5oXB3DH56gOtXKRs3XO7lg4QUZ3HBU84jmjOwR', 'BBI981bA9Ox1zd6YYpts5sH0TAbWGPjGq/KFUiVEpynlqCS4uNKiTmLAsc9oPihm94/Rowqr6UjQSTC3RY5zqO8=', 'X9siOkxb69yy92ifW1fSvQ==', 'aes128gcm');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_patients`
--

DROP TABLE IF EXISTS `jdh_patients`;
CREATE TABLE IF NOT EXISTS `jdh_patients` (
  `patient_id` bigint NOT NULL AUTO_INCREMENT,
  `photo` mediumblob,
  `patient_national_id` char(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `patient_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `patient_dob` date NOT NULL,
  `patient_gender` varchar(10) NOT NULL,
  `patient_phone` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `patient_kin_name` varchar(100) DEFAULT NULL,
  `patient_kin_phone` char(15) DEFAULT NULL,
  `service_id` int NOT NULL,
  `submitted_by_user_id` int NOT NULL,
  `patient_registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jdh_patients`
--

INSERT INTO `jdh_patients` (`patient_id`, `photo`, `patient_national_id`, `patient_name`, `patient_dob`, `patient_gender`, `patient_phone`, `patient_kin_name`, `patient_kin_phone`, `service_id`, `submitted_by_user_id`, `patient_registration_date`) VALUES
(1, NULL, '001', 'Patient One', '1984-08-06', 'Male', '0722000000', 'Demo Kin', '54566788', 1, 2, '2023-08-03 22:57:29'),
(2, NULL, '002', 'Patient Two', '1984-08-07', 'Female', '0721123456', 'Demo Kin', '3435545', 1, 2, '2023-08-03 22:58:55'),
(3, NULL, '003', 'Patient Three', '1989-08-29', 'Male', '0722103853', 'Mufuta', '0712345678', 1, 2, '2023-08-05 18:02:25');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_patient_cases`
--

DROP TABLE IF EXISTS `jdh_patient_cases`;
CREATE TABLE IF NOT EXISTS `jdh_patient_cases` (
  `case_id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `random_blood_sugar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `history` text,
  `medical_history` text NOT NULL,
  `family` text NOT NULL,
  `socio_economic_history` text NOT NULL,
  `notes` text,
  `submission_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `submitted_by_user_id` int NOT NULL,
  PRIMARY KEY (`case_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jdh_patient_cases`
--

INSERT INTO `jdh_patient_cases` (`case_id`, `patient_id`, `random_blood_sugar`, `history`, `medical_history`, `family`, `socio_economic_history`, `notes`, `submission_date`, `submitted_by_user_id`) VALUES
(1, 2, 'Some of it..', 'No history', '', '', '', 'These are demo doctors notes', '2023-08-05 00:00:00', 3);

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jdh_patient_visits`
--

INSERT INTO `jdh_patient_visits` (`visit_id`, `patient_id`, `visit_type_id`, `user_id`, `insurance_id`, `visit_description`, `visit_date`, `subbmitted_by_user_id`) VALUES
(3, 1, 1, 3, NULL, 'This is a test visit', '2023-08-06 15:33:22', 0),
(4, 3, 2, 3, NULL, 'Another visit by patient three', '2023-08-23 19:59:56', 2),
(5, 3, 2, 9, 1, 'Patient needs to be admitted.', '2023-08-24 18:57:45', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
,`patient_dob` date
,`patient_gender` varchar(10)
,`service_cost` int
,`patient_registration_date` datetime
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `category_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `subcategory_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`subcategory_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jdh_test_reports`
--

INSERT INTO `jdh_test_reports` (`report_id`, `request_id`, `patient_id`, `report_findings`, `report_attachment`, `report_submittedby_user_id`, `report_date`) VALUES
(1, 1, 1, 'There were some blood clots...', NULL, 5, '2023-08-08 22:34:57'),
(2, 1, 1, 'Testing...', NULL, 5, '2023-08-08 22:41:56');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jdh_test_requests`
--

INSERT INTO `jdh_test_requests` (`request_id`, `patient_id`, `request_title`, `request_service_id`, `request_description`, `requested_by_user_id`, `status_id`, `request_date`) VALUES
(1, 1, 'RBS test request for Patient Demo', 13, 'RBS test request for Patient Demo', 3, 1, '2023-08-05 13:45:01'),
(2, 2, 'RBS test request for Patient Demo', 13, 'RBS test request for Patient Demo', 3, 0, '2023-08-05 14:14:50');

-- --------------------------------------------------------

--
-- Table structure for table `jdh_users`
--

DROP TABLE IF EXISTS `jdh_users`;
CREATE TABLE IF NOT EXISTS `jdh_users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `photo` mediumblob,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `national_id` char(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role_id` int NOT NULL,
  `department_id` int NOT NULL,
  `password` varchar(255) NOT NULL,
  `biography` text NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jdh_users`
--

INSERT INTO `jdh_users` (`user_id`, `photo`, `first_name`, `last_name`, `national_id`, `email_address`, `phone`, `role_id`, `department_id`, `password`, `biography`, `registration_date`) VALUES
(1, NULL, 'Systems', 'Administrator', '1', 'administrator@example.com', '123456789', -1, 4, '12288e7196c773a802343b284b98b755', 'a:13:{s:7:\"user_id\";s:1:\"1\";s:5:\"photo\";N;s:10:\"first_name\";s:7:\"Systems\";s:9:\"last_name\";s:13:\"Administrator\";s:11:\"national_id\";s:1:\"1\";s:13:\"email_address\";s:25:\"administrator@example.com\";s:5:\"phone\";s:9:\"123456789\";s:4:\"role\";s:13:\"Administrator\";s:13:\"department_id\";s:1:\"4\";s:9:\"biography\";s:46:\"<p>This is a systems administrator profile</p>\";s:17:\"registration_date\";s:19:\"2023-08-04 20:59:58\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/04\";}', '2023-08-04 20:59:58'),
(2, NULL, 'Receptionist', 'Demo', '2', 'receptionist@example.com', '123456789', 1, 7, '12288e7196c773a802343b284b98b755', 'a:13:{s:7:\"user_id\";s:1:\"2\";s:5:\"photo\";N;s:10:\"first_name\";s:12:\"Receptionist\";s:9:\"last_name\";s:4:\"Demo\";s:11:\"national_id\";s:1:\"2\";s:13:\"email_address\";s:24:\"receptionist@example.com\";s:5:\"phone\";s:9:\"123456789\";s:7:\"role_id\";s:1:\"2\";s:13:\"department_id\";s:1:\"7\";s:9:\"biography\";s:37:\"<p>This is a receptionist profile</p>\";s:17:\"registration_date\";s:19:\"2023-08-04 21:06:42\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/04\";}', '2023-08-04 21:06:42'),
(3, NULL, 'Doctor', 'Demo', '3', 'doctor@example.com', '123456789', 2, 1, '12288e7196c773a802343b284b98b755', 'a:13:{s:7:\"user_id\";s:1:\"3\";s:5:\"photo\";N;s:10:\"first_name\";s:6:\"Doctor\";s:9:\"last_name\";s:4:\"Demo\";s:11:\"national_id\";s:1:\"3\";s:13:\"email_address\";s:18:\"doctor@example.com\";s:5:\"phone\";s:9:\"123456789\";s:7:\"role_id\";s:1:\"2\";s:13:\"department_id\";s:1:\"1\";s:9:\"biography\";s:31:\"<p>This is a doctor profile</p>\";s:17:\"registration_date\";s:19:\"2023-08-04 22:08:22\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/04\";}', '2023-08-04 22:08:22'),
(4, NULL, 'Nurse', 'Demo', '4', 'nurse@example.com', '123456789', 3, 9, '12288e7196c773a802343b284b98b755', 'a:13:{s:7:\"user_id\";s:1:\"4\";s:5:\"photo\";N;s:10:\"first_name\";s:5:\"Nurse\";s:9:\"last_name\";s:4:\"Demo\";s:11:\"national_id\";s:1:\"4\";s:13:\"email_address\";s:17:\"nurse@example.com\";s:5:\"phone\";s:9:\"123456789\";s:7:\"role_id\";s:1:\"3\";s:13:\"department_id\";s:1:\"9\";s:9:\"biography\";s:30:\"<p>This is a nurse profile</p>\";s:17:\"registration_date\";s:19:\"2023-08-04 22:56:10\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/04\";}', '2023-08-04 22:56:10'),
(5, NULL, 'Laboratorist', 'Demo', '5', 'laboratorist@example.com', '123456789', 4, 6, '12288e7196c773a802343b284b98b755', 'a:13:{s:7:\"user_id\";s:1:\"5\";s:5:\"photo\";N;s:10:\"first_name\";s:12:\"Laboratorist\";s:9:\"last_name\";s:4:\"Demo\";s:11:\"national_id\";s:1:\"5\";s:13:\"email_address\";s:24:\"laboratorist@example.com\";s:5:\"phone\";s:9:\"123456789\";s:7:\"role_id\";s:1:\"4\";s:13:\"department_id\";s:1:\"6\";s:9:\"biography\";s:27:\"<p>Laboratorist profile</p>\";s:17:\"registration_date\";s:19:\"2023-08-05 13:43:15\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/05\";}', '2023-08-05 13:43:15'),
(6, NULL, 'Pharmacist', 'Demo', '6', 'pharmacist@example.com', '123456789', 5, 3, '12288e7196c773a802343b284b98b755', 'a:13:{s:7:\"user_id\";s:1:\"6\";s:5:\"photo\";N;s:10:\"first_name\";s:10:\"Pharmacist\";s:9:\"last_name\";s:4:\"Demo\";s:11:\"national_id\";s:1:\"6\";s:13:\"email_address\";s:22:\"pharmacist@example.com\";s:5:\"phone\";s:9:\"123456789\";s:7:\"role_id\";s:1:\"5\";s:13:\"department_id\";s:1:\"3\";s:9:\"biography\";s:35:\"<p>This is a pharmacist profile</p>\";s:17:\"registration_date\";s:19:\"2023-08-08 11:05:42\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/08\";}', '2023-08-08 11:05:42'),
(7, NULL, 'Accountant', 'Demo', '7', 'accountant@example.com', '123456789', 6, 5, '12288e7196c773a802343b284b98b755', 'a:13:{s:7:\"user_id\";s:1:\"7\";s:5:\"photo\";N;s:10:\"first_name\";s:10:\"Accountant\";s:9:\"last_name\";s:4:\"Demo\";s:11:\"national_id\";s:1:\"7\";s:13:\"email_address\";s:22:\"accountant@example.com\";s:5:\"phone\";s:9:\"123456789\";s:7:\"role_id\";s:2:\"-2\";s:13:\"department_id\";s:1:\"5\";s:9:\"biography\";s:35:\"<p>This is accountants profile.</p>\";s:17:\"registration_date\";s:19:\"2023-08-08 14:34:59\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/08\";}', '2023-08-08 14:34:59'),
(8, NULL, 'Stores', 'Demo', '900', 'stores@example.com', '123456789', 7, 8, '12288e7196c773a802343b284b98b755', 'a:13:{s:7:\"user_id\";i:8;s:5:\"photo\";N;s:10:\"first_name\";s:6:\"Stores\";s:9:\"last_name\";s:4:\"Demo\";s:11:\"national_id\";s:3:\"900\";s:13:\"email_address\";s:18:\"stores@example.com\";s:5:\"phone\";s:9:\"123456789\";s:7:\"role_id\";i:7;s:13:\"department_id\";i:8;s:9:\"biography\";s:22:\"Inventory professional\";s:17:\"registration_date\";s:19:\"2023-08-24 12:15:49\";s:9:\"UserImage\";s:0:\"\";s:23:\"LastPasswordChangedDate\";s:10:\"2023/08/24\";}', '2023-08-24 12:15:49'),
(9, NULL, 'Dennis', 'Miriti', '18982378', 'miritidennis@gmail.com', '0722103853', 2, 1, '12288e7196c773a802343b284b98b755', 'General Doctor', '2023-08-24 19:52:11');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `pressure` varchar(30) NOT NULL,
  `height` float NOT NULL,
  `weight` int NOT NULL,
  `pulse_rate` int NOT NULL,
  `respiratory_rate` int NOT NULL,
  `temperature` float NOT NULL,
  `random_blood_sugar` varchar(100) NOT NULL,
  `spo2` int NOT NULL,
  `submission_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `submitted_by_user_id` int NOT NULL,
  PRIMARY KEY (`vitals_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jdh_vitals`
--

INSERT INTO `jdh_vitals` (`vitals_id`, `patient_id`, `pressure`, `height`, `weight`, `pulse_rate`, `respiratory_rate`, `temperature`, `random_blood_sugar`, `spo2`, `submission_date`, `submitted_by_user_id`) VALUES
(1, 1, '170/81', 1.7, 78, 70, 34, 36, '56', 0, '2023-08-04 23:01:30', 4),
(2, 3, '108/79', 1.8, 99, 65, 77, 37, '76', 0, '2023-08-05 18:04:51', 4),
(3, 2, '170/81', 1.72, 81, 70, 72, 37, '88', 91, '2023-08-06 14:16:51', 4);

-- --------------------------------------------------------

--
-- Structure for view `jdh_consultation_income`
--
DROP TABLE IF EXISTS `jdh_consultation_income`;

DROP VIEW IF EXISTS `jdh_consultation_income`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `jdh_consultation_income`  AS SELECT `jdh_users`.`user_id` AS `user_id`, `jdh_users`.`first_name` AS `first_name`, `jdh_users`.`last_name` AS `last_name`, `jdh_users`.`department_id` AS `department_id`, `jdh_services`.`service_name` AS `service_name`, `jdh_services`.`service_cost` AS `service_cost`, `jdh_patients`.`patient_id` AS `patient_id` FROM (((((`jdh_doctor_charges` join `jdh_users` on((`jdh_users`.`user_id` = `jdh_doctor_charges`.`user_id`))) join `jdh_services` on((`jdh_doctor_charges`.`service_id` = `jdh_services`.`service_id`))) join `jdh_departments` on((`jdh_users`.`department_id` = `jdh_departments`.`department_id`))) join `jdh_patient_visits` on((`jdh_users`.`user_id` = `jdh_patient_visits`.`user_id`))) join `jdh_patients` on((`jdh_patients`.`patient_id` = `jdh_patient_visits`.`patient_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `jdh_lab_income`
--
DROP TABLE IF EXISTS `jdh_lab_income`;

DROP VIEW IF EXISTS `jdh_lab_income`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `jdh_lab_income`  AS SELECT `jdh_patients`.`patient_name` AS `patient_name`, `jdh_services`.`service_name` AS `service_name`, `jdh_services`.`service_cost` AS `service_cost`, `jdh_test_requests`.`request_date` AS `request_date`, `jdh_patients`.`patient_dob` AS `patient_dob`, `jdh_test_requests`.`patient_id` AS `patient_id` FROM ((`jdh_patients` join `jdh_test_requests` on((`jdh_patients`.`patient_id` = `jdh_test_requests`.`patient_id`))) join `jdh_services` on((`jdh_test_requests`.`request_service_id` = `jdh_services`.`service_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `jdh_pharmacy_income`
--
DROP TABLE IF EXISTS `jdh_pharmacy_income`;

DROP VIEW IF EXISTS `jdh_pharmacy_income`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `jdh_pharmacy_income`  AS SELECT `jdh_patients`.`patient_id` AS `patient_id`, `jdh_patients`.`patient_name` AS `patient_name`, `jdh_medicines`.`name` AS `name`, `jdh_medicines`.`selling_price` AS `selling_price`, `jdh_medicine_stock`.`units_available` AS `units_available`, `jdh_prescriptions_actions`.`units_given` AS `units_given`, `jdh_prescriptions_actions`.`submission_date` AS `submission_date` FROM ((((`jdh_medicines` join `jdh_medicine_stock` on((`jdh_medicines`.`id` = `jdh_medicine_stock`.`medicine_id`))) join `jdh_prescriptions` on((`jdh_medicines`.`id` = `jdh_prescriptions`.`medicine_id`))) join `jdh_patients` on((`jdh_patients`.`patient_id` = `jdh_prescriptions`.`patient_id`))) join `jdh_prescriptions_actions` on((`jdh_patients`.`patient_id` = `jdh_prescriptions_actions`.`patient_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `jdh_registration_income`
--
DROP TABLE IF EXISTS `jdh_registration_income`;

DROP VIEW IF EXISTS `jdh_registration_income`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `jdh_registration_income`  AS SELECT `jdh_patients`.`patient_id` AS `patient_id`, `jdh_patients`.`patient_name` AS `patient_name`, `jdh_patients`.`patient_dob` AS `patient_dob`, `jdh_patients`.`patient_gender` AS `patient_gender`, `jdh_services`.`service_cost` AS `service_cost`, `jdh_patients`.`patient_registration_date` AS `patient_registration_date` FROM (`jdh_patients` join `jdh_services` on((`jdh_patients`.`service_id` = `jdh_services`.`service_id`)))  ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
