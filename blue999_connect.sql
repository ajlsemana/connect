-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 04, 2016 at 03:39 AM
-- Server version: 5.5.48-37.8
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blue999_connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certification_color_v7`
--

CREATE TABLE IF NOT EXISTS `certification_color_v7` (
  `id` int(11) unsigned NOT NULL,
  `uid` int(11) NOT NULL,
  `color` varchar(10) NOT NULL DEFAULT 'red',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certification_color_v7`
--

INSERT INTO `certification_color_v7` (`id`, `uid`, `color`, `created_at`, `updated_at`) VALUES
(1, 32, 'yellow', '2016-04-12 05:51:12', '0000-00-00 00:00:00'),
(2, 33, 'green', '2016-04-12 05:51:12', '0000-00-00 00:00:00'),
(3, 34, 'green', '2016-04-12 05:51:12', '0000-00-00 00:00:00'),
(4, 35, 'green', '2016-04-12 05:51:12', '0000-00-00 00:00:00'),
(5, 36, 'red', '2016-04-12 05:51:12', '0000-00-00 00:00:00'),
(6, 37, 'red', '2016-04-12 05:51:12', '0000-00-00 00:00:00'),
(7, 46, 'red', '2016-04-12 05:51:12', '0000-00-00 00:00:00'),
(8, 48, 'red', '2016-04-12 05:51:12', '0000-00-00 00:00:00'),
(9, 51, 'yellow', '2016-04-12 05:51:12', '0000-00-00 00:00:00'),
(10, 52, 'green', '2016-04-12 05:51:12', '0000-00-00 00:00:00'),
(11, 53, 'red', '2016-04-13 15:19:17', '0000-00-00 00:00:00'),
(12, 54, 'red', '2016-04-13 15:22:00', '0000-00-00 00:00:00'),
(13, 55, 'red', '2016-04-13 15:28:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `certification_color_v8`
--

CREATE TABLE IF NOT EXISTS `certification_color_v8` (
  `id` int(11) unsigned NOT NULL,
  `uid` int(11) NOT NULL,
  `color` varchar(10) NOT NULL DEFAULT 'red',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certification_color_v8`
--

INSERT INTO `certification_color_v8` (`id`, `uid`, `color`, `created_at`, `updated_at`) VALUES
(1, 32, 'red', '2016-04-12 05:51:42', '0000-00-00 00:00:00'),
(2, 33, 'green', '2016-04-12 05:51:42', '0000-00-00 00:00:00'),
(3, 34, 'red', '2016-04-12 05:51:42', '0000-00-00 00:00:00'),
(4, 35, 'red', '2016-04-12 05:51:42', '0000-00-00 00:00:00'),
(5, 36, 'red', '2016-04-12 05:51:42', '0000-00-00 00:00:00'),
(6, 37, 'red', '2016-04-12 05:51:42', '0000-00-00 00:00:00'),
(7, 46, 'red', '2016-04-12 05:51:42', '0000-00-00 00:00:00'),
(8, 48, 'red', '2016-04-12 05:51:42', '0000-00-00 00:00:00'),
(9, 51, 'red', '2016-04-12 05:51:42', '0000-00-00 00:00:00'),
(10, 52, 'red', '2016-04-12 05:51:42', '0000-00-00 00:00:00'),
(11, 53, 'red', '2016-04-13 15:19:17', '0000-00-00 00:00:00'),
(12, 54, 'red', '2016-04-13 15:22:00', '0000-00-00 00:00:00'),
(13, 55, 'red', '2016-04-13 15:28:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `class_students`
--

CREATE TABLE IF NOT EXISTS `class_students` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `video_conf_status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(10) unsigned NOT NULL,
  `company` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `category` int(1) NOT NULL COMMENT '1-internal; 2-service providers',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company`, `logo`, `category`, `created_at`, `updated_at`) VALUES
(4, 'Curve Technologies', 'Curve.png', 2, '2016-01-20 21:08:14', '2016-01-31 20:17:49'),
(5, 'e-Solutions House', 'eSolutions.jpg', 2, '2016-02-28 22:14:48', '2016-03-29 22:58:38'),
(6, 'Dot Square', 'dot-square.jpg', 2, '2016-02-29 15:27:44', '0000-00-00 00:00:00'),
(7, 'Al Rostamani Communications', 'arc.jpg', 2, '2016-03-20 20:29:30', '2016-03-28 22:21:55'),
(8, 'Xseed', 'Screen Shot 2016-03-27 at 7.07.26 PM.png', 2, '2016-03-28 00:07:46', '0000-00-00 00:00:00'),
(9, 'SAAR Group', 'logo.jpg', 2, '2016-03-28 00:09:51', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_from` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_to` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `duration` tinyint(1) NOT NULL,
  `time` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1-open; 0-ended',
  `trainer` int(11) NOT NULL COMMENT 'trainer is uid from users table',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `date_from`, `date_to`, `duration`, `time`, `status`, `trainer`, `created_at`, `updated_at`) VALUES
(7, 'Workshop - Altitude uCI 8 Reports', '2016-04-07', '2016-02-25', 1, '09:00-17:00', 0, 0, '2016-02-15 08:11:00', '2016-03-08 22:42:32'),
(10, 'Workshop-Altitude uCI8', '2016-05-12', '2016-05-12', 1, '09:00-17:00', 0, 0, '2016-03-08 12:44:15', '2016-05-22 15:46:06'),
(11, 'Contact Center Administration', '2016-05-15', '2016-05-19', 5, '09:00-17:00', 0, 0, '2016-03-27 08:42:18', '2016-05-22 15:45:30'),
(12, 'Script Development', '2016-05-22', '2016-05-26', 5, '09:00-17:00', 1, 0, '2016-03-27 08:43:14', '0000-00-00 00:00:00'),
(13, 'Inbound Floor Operations', '2016-07-12', '2016-07-14', 3, '09:00-17:00', 1, 0, '2016-03-27 08:44:02', '0000-00-00 00:00:00'),
(14, 'Outbound Floor Operations', '2016-07-18', '2016-07-20', 3, '09:00-17:00', 1, 0, '2016-03-27 08:44:52', '0000-00-00 00:00:00'),
(15, 'Workshop-Altitude uCI8', '2016-07-21', '2016-07-21', 1, '09:00-17:00', 1, 0, '2016-03-27 08:44:53', '2016-03-27 19:41:02'),
(16, 'Contact Center Administration', '2016-10-16', '2016-10-20', 5, '09:00-17:00', 1, 0, '2016-03-27 10:27:57', '2016-04-26 16:19:18'),
(17, 'Script Development', '2016-10-23', '2016-10-27', 5, '09:00-17:00', 1, 0, '2016-03-27 10:33:01', '0000-00-00 00:00:00'),
(18, 'Inbound Floor Operations', '2016-11-15', '2016-11-17', 3, '09:00-17:00', 1, 0, '2016-03-27 10:36:56', '0000-00-00 00:00:00'),
(19, 'Outbound Floor Operations', '2016-11-21', '2016-11-23', 3, '09:00-17:00', 1, 0, '2016-03-27 10:37:52', '0000-00-00 00:00:00'),
(20, 'Workshop-Altitude uCI8', '2016-12-08', '2016-12-08', 1, '09:00-17:00', 1, 0, '2016-03-27 10:41:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `course_agenda`
--

CREATE TABLE IF NOT EXISTS `course_agenda` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `days` int(1) NOT NULL,
  `agenda` varchar(100) NOT NULL,
  `time_from` varchar(8) NOT NULL,
  `time_to` varchar(8) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_agenda`
--

INSERT INTO `course_agenda` (`id`, `cid`, `days`, `agenda`, `time_from`, `time_to`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'session 1', '09:00', '12:00', '2016-01-20 10:48:55', '0000-00-00 00:00:00'),
(2, 3, 1, 'Break', '13:00', '14:00', '2016-01-20 10:49:26', '0000-00-00 00:00:00'),
(3, 3, 1, 'Session 2', '14:00', '17:00', '2016-01-20 10:49:58', '0000-00-00 00:00:00'),
(4, 3, 2, 'Session 1', '09:00', '12:00', '2016-01-20 10:50:28', '0000-00-00 00:00:00'),
(5, 3, 2, 'Lunch Break', '12:00', '13:00', '2016-01-20 10:50:53', '0000-00-00 00:00:00'),
(6, 3, 2, 'Session 2', '13:00', '17:00', '2016-01-20 10:51:41', '0000-00-00 00:00:00'),
(8, 4, 1, 'Prayer', '09:00', '09:30', '2016-01-25 09:04:53', '0000-00-00 00:00:00'),
(9, 4, 2, 'Lesson 10-23', '09:00', '12:00', '2016-01-25 09:05:08', '0000-00-00 00:00:00'),
(10, 4, 2, 'Lunch Break', '12:00', '13:00', '2016-01-25 09:05:29', '0000-00-00 00:00:00'),
(11, 4, 2, 'Lesson 23-30', '13:00', '17:00', '2016-01-25 09:05:46', '0000-00-00 00:00:00'),
(12, 4, 1, 'Session 1 - 5', '09:30', '12:00', '2016-01-25 12:18:30', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) unsigned NOT NULL,
  `company` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `company`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Abu Dhabi Islamic Bank (ADIB)', 'adib.jpg', '2016-04-01 00:29:00', '2016-04-01 00:30:37'),
(2, 'United Bank Limited', 'ubl_united_bank_limited_pakistan.png', '2016-04-01 00:32:37', '2016-04-01 00:33:42'),
(3, 'National Bank of Abu Dhabi', 'nbad.jpg', '2016-04-01 00:34:36', '0000-00-00 00:00:00'),
(4, 'G4S', 'g4s_logo_rgb_jpeg_large_250x159.jpg', '2016-04-01 00:53:53', '0000-00-00 00:00:00'),
(5, 'Ahli United Bank (AUB)', 'Ahli_United_Bank.jpg', '2016-04-01 00:55:31', '0000-00-00 00:00:00'),
(6, 'Ahli Bank of Oman (ABO)', 'logo.png', '2016-04-01 00:57:33', '2016-04-01 00:58:14'),
(7, 'Commercial Bank of Qatar (CBQ)', 'CBQ_thumb.jpg', '2016-04-10 20:33:19', '2016-04-10 20:34:36'),
(8, 'Altitude University', 'altitude-university.png', '2016-04-12 21:04:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customers_feedback`
--

CREATE TABLE IF NOT EXISTS `customers_feedback` (
  `id` int(11) unsigned NOT NULL,
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `communication` varchar(10) NOT NULL,
  `commitment` varchar(10) NOT NULL,
  `analysis` varchar(10) NOT NULL,
  `delivery` varchar(10) NOT NULL,
  `productivity` varchar(10) NOT NULL,
  `fixing` varchar(10) NOT NULL,
  `presentability` varchar(10) NOT NULL,
  `recommendation` varchar(10) NOT NULL,
  `remarks` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers_feedback`
--

INSERT INTO `customers_feedback` (`id`, `cid`, `uid`, `admin_id`, `communication`, `commitment`, `analysis`, `delivery`, `productivity`, `fixing`, `presentability`, `recommendation`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 32, 20, '3', '3', '2', '2', '3', '3', '3', '3', '', '2016-04-06 15:19:20', '0000-00-00 00:00:00'),
(2, 2, 32, 20, '3', '3', '3', '3', '3', '3', '3', '3', '', '2016-04-06 15:19:50', '0000-00-00 00:00:00'),
(8, 2, 35, 1, '4', '4', '5', '4', '4', '5', '4', '4', '', '2016-04-10 23:02:51', '0000-00-00 00:00:00'),
(9, 2, 35, 1, '5', '4', '5', '4', '5', '5', '5', '5', '', '2016-04-10 23:03:58', '0000-00-00 00:00:00'),
(10, 1, 48, 18, '5', '5', '4.6', '5', '5', '5', '5', '5', '', '2016-04-24 22:21:15', '0000-00-00 00:00:00'),
(11, 2, 34, 1, '4', '4', '4', '4', '4', '4', '4', '4', '', '2016-04-25 22:42:46', '0000-00-00 00:00:00'),
(12, 7, 33, 1, '5', '4', '5', '4', '5', '4', '4', '4', '', '2016-06-14 20:23:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `lecture_post_message`
--

CREATE TABLE IF NOT EXISTS `lecture_post_message` (
  `id` int(10) unsigned NOT NULL,
  `uid` int(10) NOT NULL,
  `sid` int(10) NOT NULL,
  `post_msg` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lecture_upload`
--

CREATE TABLE IF NOT EXISTS `lecture_upload` (
  `id` int(10) unsigned NOT NULL,
  `post_id` int(10) NOT NULL,
  `upload_path` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lecture_wall_threads`
--

CREATE TABLE IF NOT EXISTS `lecture_wall_threads` (
  `id` int(10) unsigned NOT NULL,
  `post_id` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `wall_comment` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profiling`
--

CREATE TABLE IF NOT EXISTS `profiling` (
  `id` int(11) unsigned NOT NULL,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `outcomes` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profiling`
--

INSERT INTO `profiling` (`id`, `uid`, `cid`, `birthday`, `outcomes`, `created_at`, `updated_at`) VALUES
(1, 43, 7, '0000-00-00', '1- Sometimes the system takes a lot of time to generate a report and it stops loading at a certain percentage.\n2- Cannot retrieve short calls\n3- The recordings do not save immediately, sometimes I need to wait couple of days to listen to recordings on a certain date.|1-I am good with reports and getting reports, however I usually take the data and create formulas on excel. I would like to learn better about how to generate reports from within Altitude.\n2- My weakness is in the configuration and setup. I would like to work on that.|Good', '2016-02-23 12:13:55', '0000-00-00 00:00:00'),
(4, 42, 7, '2016-02-06', 'a|b|Average', '2016-02-25 08:26:34', '0000-00-00 00:00:00'),
(5, 42, 7, '2016-02-06', 'a|b|Average', '2016-02-25 08:26:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `profit_loss`
--

CREATE TABLE IF NOT EXISTS `profit_loss` (
  `id` int(10) unsigned NOT NULL,
  `course` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `groceries` double DEFAULT '0',
  `lunch` double DEFAULT '0',
  `room` double DEFAULT '0',
  `trainer` double DEFAULT '0',
  `stationary` double DEFAULT '0',
  `transportation` double DEFAULT '0',
  `miscellaneous` double DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `time_limit` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `points` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `cid` int(11) NOT NULL COMMENT 'courses id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes_items`
--

CREATE TABLE IF NOT EXISTS `quizzes_items` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `answer` char(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes_students`
--

CREATE TABLE IF NOT EXISTS `quizzes_students` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes_students_items`
--

CREATE TABLE IF NOT EXISTS `quizzes_students_items` (
  `id` int(11) NOT NULL,
  `quiz_student_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` char(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registrants`
--

CREATE TABLE IF NOT EXISTS `registrants` (
  `id` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `course` int(11) NOT NULL,
  `attendance_status` varchar(20) NOT NULL,
  `remarks` longtext NOT NULL,
  `reference` varchar(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `discount` int(10) NOT NULL,
  `proposal_status_sent` varchar(15) NOT NULL,
  `po_date_sent` date NOT NULL,
  `proposal_status_received` varchar(15) NOT NULL,
  `po_date_received` date NOT NULL,
  `invoice` varchar(10) NOT NULL,
  `invoice_date_sent` date NOT NULL,
  `payment_status` varchar(15) NOT NULL,
  `cash_received` int(10) NOT NULL,
  `profiling` int(1) NOT NULL,
  `confirmed_date` varchar(30) NOT NULL,
  `change_status` varchar(30) NOT NULL,
  `certificate` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registrants`
--

INSERT INTO `registrants` (`id`, `uid`, `course`, `attendance_status`, `remarks`, `reference`, `amount`, `discount`, `proposal_status_sent`, `po_date_sent`, `proposal_status_received`, `po_date_received`, `invoice`, `invoice_date_sent`, `payment_status`, `cash_received`, `profiling`, `confirmed_date`, `change_status`, `certificate`, `created_at`, `updated_at`) VALUES
(2, 43, 7, 'Confirmed', '', 'POP', 0, 0, 'Not sent', '0000-00-00', 'Not received', '0000-00-00', 'Not sent', '0000-00-00', 'Not received', 0, 1, '25 - 25 Feb 2016', 'Confirmed', '', '2016-02-21 13:15:58', '2016-02-23 22:13:55'),
(3, 44, 7, 'New', '', '', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '', '', '', '2016-02-22 10:29:58', '0000-00-00 00:00:00'),
(4, 45, 7, 'New', '', '', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '', '', '', '2016-02-22 10:33:19', '0000-00-00 00:00:00'),
(9, 42, 7, 'Confirmed', '', '', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 1, '', 'Confirmed', '', '2016-02-22 10:33:19', '2016-02-25 18:26:34'),
(10, 49, 7, 'Confirmed', '', 'POP', 0, 0, 'Not sent', '0000-00-00', 'Not received', '0000-00-00', 'Not sent', '0000-00-00', 'Not received', 0, 0, '25 - 25 Feb 2016', 'Confirmed', '', '2016-02-21 13:15:58', '2016-02-23 22:13:55'),
(11, 53, 10, 'New', '', '', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '', '', '', '2016-04-26 20:43:39', '0000-00-00 00:00:00'),
(12, 52, 10, 'New', '', '', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '', '', '', '2016-04-28 09:34:33', '0000-00-00 00:00:00'),
(13, 52, 11, 'New', '', '', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '', '', '', '2016-04-28 09:34:33', '0000-00-00 00:00:00'),
(14, 52, 12, 'New', '', '', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '', '', '', '2016-04-28 09:34:33', '0000-00-00 00:00:00'),
(15, 52, 13, 'New', '', '', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '', '', '', '2016-04-28 09:34:33', '0000-00-00 00:00:00'),
(16, 52, 14, 'New', '', '', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '', '', '', '2016-04-28 09:34:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(10) unsigned NOT NULL,
  `uid` int(11) NOT NULL,
  `courses` int(11) NOT NULL,
  `attendance_status` varchar(20) NOT NULL COMMENT 'new, for review, pending, (processed/rescheduled/cancelled)',
  `expectations` longtext NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `skills_map`
--

CREATE TABLE IF NOT EXISTS `skills_map` (
  `id` int(10) unsigned NOT NULL,
  `uid` int(10) NOT NULL,
  `status` int(3) NOT NULL,
  `status_as_of` date NOT NULL,
  `vbox` varchar(2) NOT NULL DEFAULT '0',
  `vbox_rate` int(2) NOT NULL,
  `alcatel` varchar(2) NOT NULL DEFAULT '0',
  `alcatel_rate` int(2) NOT NULL,
  `avaya` varchar(2) NOT NULL DEFAULT '0',
  `avaya_rate` int(2) NOT NULL,
  `cisco` varchar(2) NOT NULL DEFAULT '0',
  `cisco_rate` int(2) NOT NULL,
  `sql_server` varchar(2) NOT NULL DEFAULT '0',
  `sql_rate` int(2) NOT NULL,
  `oracle` varchar(2) NOT NULL DEFAULT '0',
  `oracle_rate` int(2) NOT NULL,
  `altitude_routing` varchar(2) NOT NULL DEFAULT '0',
  `altitude_routing_rate` int(2) NOT NULL,
  `altitude_dialer` varchar(2) NOT NULL DEFAULT '0',
  `altitude_dialer_rate` int(2) NOT NULL,
  `altitude_voice` varchar(2) NOT NULL DEFAULT '0',
  `altitude_voice_rate` int(2) NOT NULL,
  `altitude_email` varchar(2) NOT NULL DEFAULT '0',
  `altitude_email_rate` int(2) NOT NULL,
  `altitude_chat` varchar(2) NOT NULL DEFAULT '0',
  `altitude_chat_rate` int(2) NOT NULL,
  `social` varchar(2) NOT NULL DEFAULT '0',
  `social_rate` int(2) NOT NULL,
  `altitude_desktop` varchar(2) NOT NULL DEFAULT '0',
  `altitude_desktop_rate` int(2) NOT NULL,
  `altitude_ivr` varchar(2) NOT NULL DEFAULT '0',
  `altitude_ivr_rate` int(2) NOT NULL,
  `altitude_express_routing` varchar(2) NOT NULL DEFAULT '0',
  `altitude_express_routing_rate` int(2) NOT NULL,
  `altitude_integration` varchar(2) NOT NULL DEFAULT '0',
  `altitude_integration_rate` int(2) NOT NULL,
  `altitude_workflow` varchar(2) NOT NULL DEFAULT '0',
  `altitude_workflow_rate` int(2) NOT NULL,
  `uci_installation` varchar(2) NOT NULL DEFAULT '0',
  `uci_installation_rate` int(2) NOT NULL,
  `uci_patch` varchar(2) NOT NULL DEFAULT '0',
  `uci_patch_rate` int(2) NOT NULL,
  `sap` varchar(2) NOT NULL DEFAULT '0',
  `sap_rate` int(2) NOT NULL,
  `siebel` varchar(2) NOT NULL DEFAULT '0',
  `siebel_rate` int(2) NOT NULL,
  `ms_crm` varchar(2) NOT NULL DEFAULT '0',
  `ms_crm_rate` int(2) NOT NULL,
  `teleopti` varchar(2) NOT NULL DEFAULT '0',
  `teleopti_rate` int(2) NOT NULL,
  `supervisor` varchar(2) NOT NULL DEFAULT '0',
  `supervisor_rate` int(2) NOT NULL,
  `administrator` varchar(2) NOT NULL DEFAULT '0',
  `administrator_rate` int(2) NOT NULL,
  `developer` varchar(2) NOT NULL DEFAULT '0',
  `developer_rate` int(2) NOT NULL,
  `communication` varchar(10) NOT NULL DEFAULT '0',
  `commitment` varchar(10) NOT NULL DEFAULT '0',
  `analysis` varchar(10) NOT NULL DEFAULT '0',
  `quality_of_delivery` varchar(10) NOT NULL DEFAULT '0',
  `productivity` varchar(10) NOT NULL DEFAULT '0',
  `fixing` varchar(10) NOT NULL DEFAULT '0',
  `presentability` varchar(10) NOT NULL DEFAULT '0',
  `recommendation` varchar(10) NOT NULL DEFAULT '0',
  `mobile_dashboard` varchar(2) NOT NULL DEFAULT '0',
  `reporting_framework` int(2) NOT NULL,
  `strategy_manager` int(2) NOT NULL,
  `enterprise_recorder` int(2) NOT NULL,
  `otcs` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills_map`
--

INSERT INTO `skills_map` (`id`, `uid`, `status`, `status_as_of`, `vbox`, `vbox_rate`, `alcatel`, `alcatel_rate`, `avaya`, `avaya_rate`, `cisco`, `cisco_rate`, `sql_server`, `sql_rate`, `oracle`, `oracle_rate`, `altitude_routing`, `altitude_routing_rate`, `altitude_dialer`, `altitude_dialer_rate`, `altitude_voice`, `altitude_voice_rate`, `altitude_email`, `altitude_email_rate`, `altitude_chat`, `altitude_chat_rate`, `social`, `social_rate`, `altitude_desktop`, `altitude_desktop_rate`, `altitude_ivr`, `altitude_ivr_rate`, `altitude_express_routing`, `altitude_express_routing_rate`, `altitude_integration`, `altitude_integration_rate`, `altitude_workflow`, `altitude_workflow_rate`, `uci_installation`, `uci_installation_rate`, `uci_patch`, `uci_patch_rate`, `sap`, `sap_rate`, `siebel`, `siebel_rate`, `ms_crm`, `ms_crm_rate`, `teleopti`, `teleopti_rate`, `supervisor`, `supervisor_rate`, `administrator`, `administrator_rate`, `developer`, `developer_rate`, `communication`, `commitment`, `analysis`, `quality_of_delivery`, `productivity`, `fixing`, `presentability`, `recommendation`, `mobile_dashboard`, `reporting_framework`, `strategy_manager`, `enterprise_recorder`, `otcs`, `created_at`, `updated_at`) VALUES
(3, 32, 0, '2016-02-02', '0', 0, '0', 0, '1', 0, '2', 0, '3', 0, '3', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, 0, 0, 0, '2016-02-02 12:48:01', '2016-04-25 22:37:58'),
(4, 33, 0, '0000-00-00', '3', 0, '0', 0, '4', 0, '3', 0, '5', 0, '3', 0, '4', 0, '4', 0, '4', 0, '2', 0, '2', 0, '0', 0, '3', 0, '3', 0, '2', 0, '3', 0, '0', 0, '4', 0, '4', 0, '0', 0, '0', 0, '0', 0, '0', 0, '2', 0, '2', 0, '2', 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', 3, 3, 0, 0, '2016-02-02 12:49:01', '2016-06-14 20:21:38'),
(5, 34, 0, '2016-02-02', '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, 0, 0, 0, '2016-02-02 12:49:37', '2016-02-23 17:14:31'),
(6, 35, 0, '2016-02-02', '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, 0, 0, 0, '2016-02-02 12:50:18', '2016-04-24 16:09:10'),
(7, 36, 0, '0000-00-00', '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, 0, 0, 0, '2016-02-02 12:51:06', '0000-00-00 00:00:00'),
(8, 37, 100, '2016-02-23', '3', 0, '0', 0, '2', 0, '2', 0, '3', 0, '2', 0, '3', 0, '3', 0, '3', 0, '2', 0, '0', 0, '0', 0, '4', 0, '4', 0, '2', 0, '3', 0, '0', 0, '3', 0, '3', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '3', '4', '2', '3', '3', '2', '2', '3', '0', 1, 0, 0, 0, '2016-02-02 12:59:13', '2016-04-28 22:55:00'),
(9, 46, 100, '2016-02-23', '3', 0, '0', 0, '1', 0, '0', 0, '3', 0, '3', 0, '3', 0, '2', 0, '2', 0, '2', 0, '1', 0, '0', 0, '2', 0, '3', 0, '2', 0, '3', 0, '0', 0, '2', 0, '2', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '2', '2', '1', '1', '2', '1', '2', '2', '0', 1, 0, 0, 0, '2016-02-23 07:40:10', '2016-04-28 22:11:33'),
(10, 48, 50, '2016-03-24', '0', 0, '2', 0, '0', 0, '0', 0, '0', 0, '0', 0, '1', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '1', 0, '1', 0, '0', 0, '0', 0, '0', 0, '1', 0, '1', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, 0, 0, 0, '2016-03-24 05:26:44', '2016-04-21 21:18:14'),
(11, 51, 100, '2016-03-29', '4', 0, '0', 0, '3', 0, '3', 0, '3', 0, '3', 0, '4', 0, '2', 0, '4', 0, '4', 0, '0', 0, '0', 0, '4', 0, '4', 0, '0', 0, '3', 0, '0', 0, '4', 0, '4', 0, '0', 0, '0', 0, '0', 0, '0', 0, '3', 0, '3', 0, '3', 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, 0, 0, 0, '2016-03-29 13:35:15', '2016-03-29 22:40:39'),
(12, 52, 50, '2016-03-29', '0', 0, '0', 0, '2', 0, '0', 0, '0', 0, '0', 0, '2', 0, '2', 0, '2', 0, '0', 0, '0', 0, '0', 0, '2', 0, '2', 0, '0', 0, '2', 0, '0', 0, '3', 0, '3', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '2', 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, 0, 0, 0, '2016-03-29 13:35:42', '2016-03-29 22:42:59'),
(13, 53, 0, '0000-00-00', '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, 0, 0, 0, '2016-04-13 15:19:17', '0000-00-00 00:00:00'),
(14, 54, 0, '0000-00-00', '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, 0, 0, 0, '2016-04-13 15:22:00', '0000-00-00 00:00:00'),
(15, 55, 0, '0000-00-00', '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, 0, 0, 0, '2016-04-13 15:28:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `skills_map_update`
--

CREATE TABLE IF NOT EXISTS `skills_map_update` (
  `id` int(10) unsigned NOT NULL,
  `uid` int(10) NOT NULL,
  `status` int(3) NOT NULL,
  `status_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status_by` varchar(60) NOT NULL,
  `status_as_of` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status_as_of_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status_as_of_by` varchar(60) NOT NULL,
  `vbox` varchar(2) NOT NULL,
  `vbox_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `vbox_by` varchar(60) NOT NULL,
  `alcatel` varchar(2) NOT NULL,
  `alcatel_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `alcatel_by` varchar(60) NOT NULL,
  `avaya` varchar(2) NOT NULL,
  `avaya_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `avaya_by` varchar(60) NOT NULL,
  `cisco` varchar(2) NOT NULL,
  `cisco_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cisco_by` varchar(60) NOT NULL,
  `sql_server` varchar(2) NOT NULL,
  `sql_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sql_server_by` varchar(60) NOT NULL,
  `oracle` varchar(2) NOT NULL,
  `oracle_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `oracle_by` varchar(60) NOT NULL,
  `altitude_routing` varchar(2) NOT NULL,
  `altitude_routing_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_routing_by` varchar(60) NOT NULL,
  `altitude_dialer` varchar(2) NOT NULL,
  `altitude_dialer_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_dialer_by` varchar(60) NOT NULL,
  `altitude_voice` varchar(2) NOT NULL,
  `altitude_voice_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_voice_by` varchar(60) NOT NULL,
  `altitude_email` varchar(2) NOT NULL,
  `altitude_email_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_email_by` varchar(60) NOT NULL,
  `altitude_chat` varchar(2) NOT NULL,
  `altitude_chat_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_chat_by` varchar(60) NOT NULL,
  `social` varchar(2) NOT NULL,
  `social_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `social_by` varchar(60) NOT NULL,
  `altitude_desktop` varchar(2) NOT NULL,
  `altitude_desktop_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_desktop_by` varchar(60) NOT NULL,
  `altitude_ivr` varchar(2) NOT NULL,
  `altitude_ivr_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_ivr_by` varchar(60) NOT NULL,
  `altitude_express_routing` varchar(2) NOT NULL,
  `altitude_express_routing_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_express_routing_by` varchar(60) NOT NULL,
  `altitude_integration` varchar(2) NOT NULL,
  `altitude_integration_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_integration_by` varchar(60) NOT NULL,
  `altitude_workflow` varchar(2) NOT NULL,
  `altitude_workflow_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_workflow_by` varchar(60) NOT NULL,
  `uci_installation` varchar(2) NOT NULL,
  `uci_installation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uci_installation_by` varchar(60) NOT NULL,
  `uci_patch` varchar(2) NOT NULL,
  `uci_patch_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uci_patch_by` varchar(60) NOT NULL,
  `sap` varchar(2) NOT NULL,
  `sap_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sap_by` varchar(60) NOT NULL,
  `siebel` varchar(2) NOT NULL,
  `siebel_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `siebel_by` varchar(60) NOT NULL,
  `ms_crm` varchar(2) NOT NULL,
  `ms_crm_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ms_crm_by` varchar(60) NOT NULL,
  `teleopti` varchar(2) NOT NULL,
  `teleopti_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `teleopti_by` varchar(60) NOT NULL,
  `supervisor` varchar(2) NOT NULL,
  `supervisor_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `supervisor_by` varchar(60) NOT NULL,
  `administrator` varchar(2) NOT NULL,
  `administrator_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `administrator_by` varchar(60) NOT NULL,
  `developer` varchar(2) NOT NULL,
  `developer_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `developer_by` varchar(60) NOT NULL,
  `communication` varchar(10) NOT NULL,
  `communication_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `communication_by` varchar(60) NOT NULL,
  `commitment` varchar(10) NOT NULL,
  `commitment_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `commitment_by` varchar(60) NOT NULL,
  `analysis` varchar(10) NOT NULL,
  `analysis_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `analysis_by` varchar(60) NOT NULL,
  `quality_of_delivery` varchar(10) NOT NULL,
  `quality_of_delivery_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `quality_of_delivery_by` varchar(60) NOT NULL,
  `productivity` varchar(10) NOT NULL,
  `productivity_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `productivity_by` varchar(60) NOT NULL,
  `fixing` varchar(10) NOT NULL,
  `fixing_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fixing_by` varchar(60) NOT NULL,
  `presentability` varchar(10) NOT NULL,
  `presentability_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `presentability_by` varchar(60) NOT NULL,
  `recommendation` varchar(10) NOT NULL,
  `recommendation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recommendation_by` varchar(60) NOT NULL,
  `mobile_dashboard` varchar(2) NOT NULL,
  `mobile_dashboard_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mobile_dashboard_by` varchar(60) NOT NULL,
  `reporting_framework` varchar(2) NOT NULL,
  `reporting_framework_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reporting_framework_by` varchar(60) NOT NULL,
  `strategy_manager` varchar(2) NOT NULL,
  `strategy_manager_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `strategy_manager_by` varchar(60) NOT NULL,
  `enterprise_recorder` varchar(2) NOT NULL,
  `enterprise_recorder_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `enterprise_recorder_by` varchar(60) NOT NULL,
  `otcs` varchar(2) NOT NULL,
  `otcs_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `otcs_by` varchar(60) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills_map_update`
--

INSERT INTO `skills_map_update` (`id`, `uid`, `status`, `status_update`, `status_by`, `status_as_of`, `status_as_of_date`, `status_as_of_by`, `vbox`, `vbox_date`, `vbox_by`, `alcatel`, `alcatel_date`, `alcatel_by`, `avaya`, `avaya_date`, `avaya_by`, `cisco`, `cisco_date`, `cisco_by`, `sql_server`, `sql_date`, `sql_server_by`, `oracle`, `oracle_date`, `oracle_by`, `altitude_routing`, `altitude_routing_date`, `altitude_routing_by`, `altitude_dialer`, `altitude_dialer_date`, `altitude_dialer_by`, `altitude_voice`, `altitude_voice_date`, `altitude_voice_by`, `altitude_email`, `altitude_email_date`, `altitude_email_by`, `altitude_chat`, `altitude_chat_date`, `altitude_chat_by`, `social`, `social_date`, `social_by`, `altitude_desktop`, `altitude_desktop_date`, `altitude_desktop_by`, `altitude_ivr`, `altitude_ivr_date`, `altitude_ivr_by`, `altitude_express_routing`, `altitude_express_routing_date`, `altitude_express_routing_by`, `altitude_integration`, `altitude_integration_date`, `altitude_integration_by`, `altitude_workflow`, `altitude_workflow_date`, `altitude_workflow_by`, `uci_installation`, `uci_installation_date`, `uci_installation_by`, `uci_patch`, `uci_patch_date`, `uci_patch_by`, `sap`, `sap_date`, `sap_by`, `siebel`, `siebel_date`, `siebel_by`, `ms_crm`, `ms_crm_date`, `ms_crm_by`, `teleopti`, `teleopti_date`, `teleopti_by`, `supervisor`, `supervisor_date`, `supervisor_by`, `administrator`, `administrator_date`, `administrator_by`, `developer`, `developer_date`, `developer_by`, `communication`, `communication_date`, `communication_by`, `commitment`, `commitment_date`, `commitment_by`, `analysis`, `analysis_date`, `analysis_by`, `quality_of_delivery`, `quality_of_delivery_date`, `quality_of_delivery_by`, `productivity`, `productivity_date`, `productivity_by`, `fixing`, `fixing_date`, `fixing_by`, `presentability`, `presentability_date`, `presentability_by`, `recommendation`, `recommendation_date`, `recommendation_by`, `mobile_dashboard`, `mobile_dashboard_date`, `mobile_dashboard_by`, `reporting_framework`, `reporting_framework_date`, `reporting_framework_by`, `strategy_manager`, `strategy_manager_date`, `strategy_manager_by`, `enterprise_recorder`, `enterprise_recorder_date`, `enterprise_recorder_by`, `otcs`, `otcs_date`, `otcs_by`, `created_at`, `updated_at`) VALUES
(3, 32, 0, '2016-02-23 17:18:02', 'Liaqat Saeed', '2016-02-02 12:00:00', '2016-02-03 04:21:49', 'Liaqat Saeed', '0', '2016-04-12 22:00:10', 'Ayman Soliman', '0', '0000-00-00 00:00:00', '', '1', '2016-02-03 04:21:49', 'Liaqat Saeed', '2', '2016-02-03 04:21:49', 'Liaqat Saeed', '3', '2016-02-03 04:21:49', 'Liaqat Saeed', '3', '2016-02-03 04:21:49', 'Liaqat Saeed', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '0000-00-00 00:00:00', '', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '0000-00-00 00:00:00', '', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '0000-00-00 00:00:00', '', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '2016-04-25 22:37:58', 'Ayman Soliman', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '2016-02-23 17:18:02', 'Liaqat Saeed', '0', '2016-04-25 22:37:58', 'Ayman Soliman', '0', '2016-04-25 22:37:58', 'Ayman Soliman', '0', '2016-04-25 22:37:58', 'Ayman Soliman', '0', '2016-04-25 22:37:58', 'Ayman Soliman', '0', '2016-04-25 22:37:58', 'Ayman Soliman', '2016-02-02 12:48:01', '2016-04-25 22:37:58'),
(4, 33, 0, '2016-02-23 00:24:41', 'Liaqat Saeed', '2016-02-02 12:00:00', '2016-02-03 04:26:48', 'Liaqat Saeed', '3', '2016-05-12 18:37:06', 'Ayman Soliman', '0', '0000-00-00 00:00:00', '', '4', '2016-06-14 19:49:18', 'Ayman Soliman', '3', '2016-05-12 18:39:20', 'Ayman Soliman', '5', '2016-05-12 18:40:11', 'Ayman Soliman', '3', '2016-06-14 19:49:30', 'Ayman Soliman', '4', '2016-06-14 20:21:38', 'Ayman Soliman', '4', '2016-06-14 20:20:10', 'Ayman Soliman', '4', '2016-06-14 20:20:23', 'Ayman Soliman', '2', '2016-05-12 18:42:18', 'Ayman Soliman', '2', '2016-05-12 18:42:31', 'Ayman Soliman', '0', '0000-00-00 00:00:00', '', '3', '2016-05-12 18:42:46', 'Ayman Soliman', '3', '2016-05-12 18:42:56', 'Ayman Soliman', '2', '2016-05-12 18:43:37', 'Ayman Soliman', '3', '2016-05-12 18:44:19', 'Ayman Soliman', '0', '0000-00-00 00:00:00', '', '4', '2016-06-14 20:21:02', 'Ayman Soliman', '4', '2016-06-14 20:21:10', 'Ayman Soliman', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '2', '2016-05-12 18:47:07', 'Ayman Soliman', '2', '2016-05-12 18:47:16', 'Ayman Soliman', '2', '2016-05-12 18:47:24', 'Ayman Soliman', '0', '2016-02-08 18:27:30', 'Joseph Semana', '0', '2016-02-08 18:27:30', 'Joseph Semana', '0', '2016-02-08 18:27:30', 'Joseph Semana', '0', '2016-02-08 18:27:30', 'Joseph Semana', '0', '2016-02-08 18:27:30', 'Joseph Semana', '0', '2016-02-08 18:27:30', 'Joseph Semana', '0', '2016-02-08 18:27:30', 'Joseph Semana', '0', '2016-02-08 18:27:30', 'Joseph Semana', '0', '2016-05-12 18:27:30', 'Ayman Soliman', '3', '2016-06-14 20:20:48', 'Ayman Soliman', '3', '2016-06-14 20:21:23', 'Ayman Soliman', '0', '2016-05-12 18:27:30', 'Ayman Soliman', '0', '2016-05-12 18:27:30', 'Ayman Soliman', '2016-02-02 12:49:01', '2016-06-14 20:21:38'),
(5, 34, 0, '2016-02-23 17:14:31', 'Liaqat Saeed', '2016-02-02 12:00:00', '2016-02-03 04:24:34', 'Liaqat Saeed', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '0000-00-00 00:00:00', '', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '0000-00-00 00:00:00', '', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '0000-00-00 00:00:00', '', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '0000-00-00 00:00:00', '', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '0000-00-00 00:00:00', '', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '0', '2016-02-23 17:14:31', 'Liaqat Saeed', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '2016-02-02 12:49:37', '2016-02-23 17:14:31'),
(6, 35, 23, '2016-02-08 18:26:40', 'Joseph Semana', '2016-02-02 12:00:00', '2016-02-03 04:29:26', 'Liaqat Saeed', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '2016-04-24 16:07:48', 'Ayman Soliman', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '2016-04-24 16:07:55', 'Ayman Soliman', '0', '0000-00-00 00:00:00', '', '0', '2016-02-08 18:26:40', 'Joseph Semana', '0', '2016-04-19 20:50:07', 'Ayman Soliman', '0', '2016-04-24 16:08:33', 'Ayman Soliman', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '2016-04-24 16:08:42', 'Ayman Soliman', '0', '2016-04-24 16:08:49', 'Ayman Soliman', '0', '0000-00-00 00:00:00', '', '0', '2016-04-24 16:08:54', 'Ayman Soliman', '0', '0000-00-00 00:00:00', '', '0', '2016-04-24 16:08:59', 'Ayman Soliman', '0', '2016-04-24 16:09:10', 'Ayman Soliman', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '2016-04-19 20:46:38', 'Ayman Soliman', '0', '2016-04-19 20:46:38', 'Ayman Soliman', '0', '2016-04-19 20:46:38', 'Ayman Soliman', '0', '2016-04-19 20:46:38', 'Ayman Soliman', '0', '2016-04-19 20:46:38', 'Ayman Soliman', '2016-02-02 12:50:18', '2016-04-24 16:09:10'),
(7, 36, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '2016-02-02 12:51:06', '0000-00-00 00:00:00'),
(8, 37, 100, '2016-02-03 03:38:45', 'Ayman Soliman', '2016-02-23 06:00:00', '2016-02-23 17:16:46', 'Liaqat Saeed', '3', '2016-04-03 21:11:09', 'Ayman Soliman', '0', '2016-04-28 22:49:55', 'Liaqat Saeed', '2', '2016-04-28 22:50:33', 'Liaqat Saeed', '2', '2016-04-28 22:51:33', 'Liaqat Saeed', '3', '2016-02-03 04:17:16', 'Liaqat Saeed', '2', '2016-02-03 04:17:16', 'Liaqat Saeed', '3', '2016-04-03 21:11:09', 'Ayman Soliman', '3', '2016-04-03 21:11:09', 'Ayman Soliman', '3', '2016-02-03 04:17:16', 'Liaqat Saeed', '2', '2016-02-03 04:17:16', 'Liaqat Saeed', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '4', '2016-04-28 22:55:00', 'Liaqat Saeed', '4', '2016-04-28 22:54:37', 'Liaqat Saeed', '2', '2016-04-28 22:52:49', 'Liaqat Saeed', '3', '2016-04-28 22:53:11', 'Liaqat Saeed', '0', '0000-00-00 00:00:00', '', '3', '2016-02-03 04:17:16', 'Liaqat Saeed', '3', '2016-04-03 21:11:09', 'Ayman Soliman', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00 00:00:00', '', '3', '2016-02-03 04:17:16', 'Liaqat Saeed', '4', '2016-02-03 04:17:16', 'Liaqat Saeed', '2', '2016-02-03 04:17:16', 'Liaqat Saeed', '3', '2016-02-03 04:17:16', 'Liaqat Saeed', '3', '2016-02-03 04:17:16', 'Liaqat Saeed', '2', '2016-02-03 04:17:16', 'Liaqat Saeed', '2', '2016-02-03 04:17:16', 'Liaqat Saeed', '3', '2016-02-03 04:17:16', 'Liaqat Saeed', '0', '2016-04-21 23:00:09', 'Ayman Soliman', '1', '2016-04-21 23:00:09', 'Ayman Soliman', '0', '2016-04-21 23:00:09', 'Ayman Soliman', '0', '2016-04-21 23:00:09', 'Ayman Soliman', '0', '2016-04-21 23:00:09', 'Ayman Soliman', '2016-02-02 12:59:13', '2016-04-28 22:55:00'),
(9, 46, 100, '2016-02-23 17:45:04', 'Liaqat Saeed', '2016-02-23 06:00:00', '2016-02-23 17:45:04', 'Liaqat Saeed', '3', '2016-04-28 22:00:11', 'Liaqat Saeed', '0', '2016-02-23 17:45:04', 'Liaqat Saeed', '1', '2016-02-23 17:45:04', 'Liaqat Saeed', '0', '2016-02-23 17:45:04', 'Liaqat Saeed', '3', '2016-02-23 17:45:04', 'Liaqat Saeed', '3', '2016-02-23 17:45:04', 'Liaqat Saeed', '3', '2016-04-28 22:01:30', 'Liaqat Saeed', '2', '2016-02-23 17:45:04', 'Liaqat Saeed', '2', '2016-04-28 22:03:19', 'Liaqat Saeed', '2', '2016-02-23 17:45:04', 'Liaqat Saeed', '1', '2016-04-28 22:04:37', 'Liaqat Saeed', '0', '2016-02-23 17:45:04', 'Liaqat Saeed', '2', '2016-02-23 17:45:04', 'Liaqat Saeed', '3', '2016-04-28 22:06:14', 'Liaqat Saeed', '2', '2016-02-23 17:45:04', 'Liaqat Saeed', '3', '2016-02-23 17:45:04', 'Liaqat Saeed', '0', '2016-02-23 17:45:04', 'Liaqat Saeed', '2', '2016-02-23 17:45:04', 'Liaqat Saeed', '2', '2016-02-23 17:45:04', 'Liaqat Saeed', '0', '2016-02-23 17:45:04', 'Liaqat Saeed', '0', '2016-02-23 17:45:04', 'Liaqat Saeed', '0', '2016-02-23 17:45:04', 'Liaqat Saeed', '0', '2016-02-23 17:45:04', 'Liaqat Saeed', '0', '2016-04-25 22:39:40', 'Ayman Soliman', '0', '2016-04-25 22:39:51', 'Ayman Soliman', '0', '2016-04-25 22:39:58', 'Ayman Soliman', '2', '2016-02-23 17:45:04', 'Liaqat Saeed', '2', '2016-02-23 17:45:04', 'Liaqat Saeed', '1', '2016-02-23 17:45:04', 'Liaqat Saeed', '1', '2016-02-23 17:45:04', 'Liaqat Saeed', '2', '2016-02-23 17:45:04', 'Liaqat Saeed', '1', '2016-02-23 17:45:04', 'Liaqat Saeed', '2', '2016-02-23 17:45:04', 'Liaqat Saeed', '2', '2016-02-23 17:45:04', 'Liaqat Saeed', '0', '2016-04-25 22:39:40', 'Ayman Soliman', '1', '2016-04-28 22:11:33', 'Liaqat Saeed', '0', '2016-04-25 22:39:40', 'Ayman Soliman', '0', '2016-04-25 22:39:40', 'Ayman Soliman', '0', '2016-04-25 22:39:40', 'Ayman Soliman', '2016-02-23 07:40:10', '2016-04-28 22:11:33'),
(10, 48, 50, '2016-03-24 14:28:28', 'Liaqat Saeed', '2016-03-24 05:00:00', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-04-18 22:17:13', 'Ayman Soliman', '2', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '1', '2016-04-21 21:18:14', 'Ayman Soliman', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '1', '2016-03-24 14:28:28', 'Liaqat Saeed', '1', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '1', '2016-03-24 14:28:28', 'Liaqat Saeed', '1', '2016-03-24 14:29:07', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-03-24 14:28:28', 'Liaqat Saeed', '0', '2016-04-18 22:17:13', 'Ayman Soliman', '0', '2016-04-18 22:17:13', 'Ayman Soliman', '0', '2016-04-18 22:17:13', 'Ayman Soliman', '0', '2016-04-18 22:17:13', 'Ayman Soliman', '0', '2016-04-21 21:15:51', 'Ayman Soliman', '2016-03-24 05:26:44', '2016-04-21 21:18:14'),
(11, 51, 100, '2016-03-29 22:39:12', 'Liaqat Saeed', '2016-03-29 05:00:00', '2016-03-29 22:37:28', 'Liaqat Saeed', '4', '2016-03-29 22:37:28', 'Liaqat Saeed', '0', '2016-03-29 22:37:28', 'Liaqat Saeed', '3', '2016-03-29 22:37:28', 'Liaqat Saeed', '3', '2016-03-29 22:37:28', 'Liaqat Saeed', '3', '2016-03-29 22:37:28', 'Liaqat Saeed', '3', '2016-03-29 22:37:28', 'Liaqat Saeed', '4', '2016-03-29 22:37:28', 'Liaqat Saeed', '2', '2016-03-29 22:37:28', 'Liaqat Saeed', '4', '2016-03-29 22:37:28', 'Liaqat Saeed', '4', '2016-03-29 22:37:28', 'Liaqat Saeed', '0', '2016-03-29 22:37:28', 'Liaqat Saeed', '0', '2016-03-29 22:37:28', 'Liaqat Saeed', '4', '2016-03-29 22:37:28', 'Liaqat Saeed', '4', '2016-03-29 22:37:28', 'Liaqat Saeed', '0', '2016-03-29 22:37:28', 'Liaqat Saeed', '3', '2016-03-29 22:37:28', 'Liaqat Saeed', '0', '2016-03-29 22:37:28', 'Liaqat Saeed', '4', '2016-03-29 22:37:28', 'Liaqat Saeed', '4', '2016-03-29 22:37:28', 'Liaqat Saeed', '0', '2016-03-29 22:37:28', 'Liaqat Saeed', '0', '2016-03-29 22:37:28', 'Liaqat Saeed', '0', '2016-03-29 22:40:39', 'Liaqat Saeed', '0', '2016-03-29 22:37:28', 'Liaqat Saeed', '3', '2016-03-29 22:37:28', 'Liaqat Saeed', '3', '2016-03-29 22:37:28', 'Liaqat Saeed', '3', '2016-03-29 22:37:28', 'Liaqat Saeed', '0', '2016-03-29 22:37:28', 'Liaqat Saeed', '0', '2016-03-29 22:37:28', 'Liaqat Saeed', '0', '2016-03-29 22:37:28', 'Liaqat Saeed', '0', '2016-03-29 22:37:28', 'Liaqat Saeed', '0', '2016-03-29 22:37:28', 'Liaqat Saeed', '0', '2016-03-29 22:37:28', 'Liaqat Saeed', '0', '2016-03-29 22:37:28', 'Liaqat Saeed', '0', '2016-03-29 22:37:28', 'Liaqat Saeed', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '2016-03-29 13:35:15', '2016-03-29 22:40:39'),
(12, 52, 50, '2016-03-29 22:42:59', 'Liaqat Saeed', '2016-03-29 05:00:00', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '2', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '2', '2016-03-29 22:42:59', 'Liaqat Saeed', '2', '2016-03-29 22:42:59', 'Liaqat Saeed', '2', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '2', '2016-03-29 22:42:59', 'Liaqat Saeed', '2', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '2', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '3', '2016-03-29 22:42:59', 'Liaqat Saeed', '3', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '2', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '0', '2016-03-29 22:42:59', 'Liaqat Saeed', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '2016-03-29 13:35:42', '2016-03-29 22:42:59'),
(13, 53, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '2016-04-13 15:19:17', '0000-00-00 00:00:00'),
(14, 54, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '2016-04-13 15:22:00', '0000-00-00 00:00:00'),
(15, 55, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '2016-04-13 15:28:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `skills_map_update_v7`
--

CREATE TABLE IF NOT EXISTS `skills_map_update_v7` (
  `id` int(10) unsigned NOT NULL,
  `uid` int(10) NOT NULL,
  `status` int(3) NOT NULL,
  `status_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status_by` varchar(60) NOT NULL,
  `status_as_of` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status_as_of_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status_as_of_by` varchar(60) NOT NULL,
  `vbox` varchar(2) NOT NULL,
  `vbox_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `vbox_by` varchar(60) NOT NULL,
  `alcatel` varchar(2) NOT NULL,
  `alcatel_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `alcatel_by` varchar(60) NOT NULL,
  `avaya` varchar(2) NOT NULL,
  `avaya_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `avaya_by` varchar(60) NOT NULL,
  `cisco` varchar(2) NOT NULL,
  `cisco_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cisco_by` varchar(60) NOT NULL,
  `sql_server` varchar(2) NOT NULL,
  `sql_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sql_server_by` varchar(60) NOT NULL,
  `oracle` varchar(2) NOT NULL,
  `oracle_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `oracle_by` varchar(60) NOT NULL,
  `altitude_routing` varchar(2) NOT NULL,
  `altitude_routing_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_routing_by` varchar(60) NOT NULL,
  `altitude_dialer` varchar(2) NOT NULL,
  `altitude_dialer_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_dialer_by` varchar(60) NOT NULL,
  `altitude_voice` varchar(2) NOT NULL,
  `altitude_voice_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_voice_by` varchar(60) NOT NULL,
  `altitude_email` varchar(2) NOT NULL,
  `altitude_email_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_email_by` varchar(60) NOT NULL,
  `altitude_chat` varchar(2) NOT NULL,
  `altitude_chat_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_chat_by` varchar(60) NOT NULL,
  `social` varchar(2) NOT NULL,
  `social_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `social_by` varchar(60) NOT NULL,
  `altitude_desktop` varchar(2) NOT NULL,
  `altitude_desktop_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_desktop_by` varchar(60) NOT NULL,
  `altitude_ivr` varchar(2) NOT NULL,
  `altitude_ivr_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_ivr_by` varchar(60) NOT NULL,
  `altitude_express_routing` varchar(2) NOT NULL,
  `altitude_express_routing_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_express_routing_by` varchar(60) NOT NULL,
  `altitude_integration` varchar(2) NOT NULL,
  `altitude_integration_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_integration_by` varchar(60) NOT NULL,
  `altitude_workflow` varchar(2) NOT NULL,
  `altitude_workflow_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `altitude_workflow_by` varchar(60) NOT NULL,
  `uci_installation` varchar(2) NOT NULL,
  `uci_installation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uci_installation_by` varchar(60) NOT NULL,
  `uci_patch` varchar(2) NOT NULL,
  `uci_patch_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uci_patch_by` varchar(60) NOT NULL,
  `sap` varchar(2) NOT NULL,
  `sap_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sap_by` varchar(60) NOT NULL,
  `siebel` varchar(2) NOT NULL,
  `siebel_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `siebel_by` varchar(60) NOT NULL,
  `ms_crm` varchar(2) NOT NULL,
  `ms_crm_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ms_crm_by` varchar(60) NOT NULL,
  `teleopti` varchar(2) NOT NULL,
  `teleopti_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `teleopti_by` varchar(60) NOT NULL,
  `supervisor` varchar(2) NOT NULL,
  `supervisor_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `supervisor_by` varchar(60) NOT NULL,
  `administrator` varchar(2) NOT NULL,
  `administrator_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `administrator_by` varchar(60) NOT NULL,
  `developer` varchar(2) NOT NULL,
  `developer_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `developer_by` varchar(60) NOT NULL,
  `communication` varchar(10) NOT NULL,
  `communication_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `communication_by` varchar(60) NOT NULL,
  `commitment` varchar(10) NOT NULL,
  `commitment_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `commitment_by` varchar(60) NOT NULL,
  `analysis` varchar(10) NOT NULL,
  `analysis_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `analysis_by` varchar(60) NOT NULL,
  `quality_of_delivery` varchar(10) NOT NULL,
  `quality_of_delivery_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `quality_of_delivery_by` varchar(60) NOT NULL,
  `productivity` varchar(10) NOT NULL,
  `productivity_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `productivity_by` varchar(60) NOT NULL,
  `fixing` varchar(10) NOT NULL,
  `fixing_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fixing_by` varchar(60) NOT NULL,
  `presentability` varchar(10) NOT NULL,
  `presentability_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `presentability_by` varchar(60) NOT NULL,
  `recommendation` varchar(10) NOT NULL,
  `recommendation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recommendation_by` varchar(60) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills_map_update_v7`
--

INSERT INTO `skills_map_update_v7` (`id`, `uid`, `status`, `status_update`, `status_by`, `status_as_of`, `status_as_of_date`, `status_as_of_by`, `vbox`, `vbox_date`, `vbox_by`, `alcatel`, `alcatel_date`, `alcatel_by`, `avaya`, `avaya_date`, `avaya_by`, `cisco`, `cisco_date`, `cisco_by`, `sql_server`, `sql_date`, `sql_server_by`, `oracle`, `oracle_date`, `oracle_by`, `altitude_routing`, `altitude_routing_date`, `altitude_routing_by`, `altitude_dialer`, `altitude_dialer_date`, `altitude_dialer_by`, `altitude_voice`, `altitude_voice_date`, `altitude_voice_by`, `altitude_email`, `altitude_email_date`, `altitude_email_by`, `altitude_chat`, `altitude_chat_date`, `altitude_chat_by`, `social`, `social_date`, `social_by`, `altitude_desktop`, `altitude_desktop_date`, `altitude_desktop_by`, `altitude_ivr`, `altitude_ivr_date`, `altitude_ivr_by`, `altitude_express_routing`, `altitude_express_routing_date`, `altitude_express_routing_by`, `altitude_integration`, `altitude_integration_date`, `altitude_integration_by`, `altitude_workflow`, `altitude_workflow_date`, `altitude_workflow_by`, `uci_installation`, `uci_installation_date`, `uci_installation_by`, `uci_patch`, `uci_patch_date`, `uci_patch_by`, `sap`, `sap_date`, `sap_by`, `siebel`, `siebel_date`, `siebel_by`, `ms_crm`, `ms_crm_date`, `ms_crm_by`, `teleopti`, `teleopti_date`, `teleopti_by`, `supervisor`, `supervisor_date`, `supervisor_by`, `administrator`, `administrator_date`, `administrator_by`, `developer`, `developer_date`, `developer_by`, `communication`, `communication_date`, `communication_by`, `commitment`, `commitment_date`, `commitment_by`, `analysis`, `analysis_date`, `analysis_by`, `quality_of_delivery`, `quality_of_delivery_date`, `quality_of_delivery_by`, `productivity`, `productivity_date`, `productivity_by`, `fixing`, `fixing_date`, `fixing_by`, `presentability`, `presentability_date`, `presentability_by`, `recommendation`, `recommendation_date`, `recommendation_by`, `created_at`, `updated_at`) VALUES
(1, 32, 0, '2016-04-06 23:00:03', 'Liaqat Saeed', '2016-02-22 06:00:00', '2016-02-23 00:25:59', 'Liaqat Saeed', '3', '2016-04-06 23:00:03', 'Liaqat Saeed', '0', '2016-02-23 00:25:59', 'Liaqat Saeed', '4', '2016-04-12 21:01:12', 'Joseph Semana', '3', '2016-04-28 22:23:36', 'Liaqat Saeed', '4', '2016-04-28 22:24:09', 'Liaqat Saeed', '4', '2016-04-28 22:24:25', 'Liaqat Saeed', '4', '2016-03-10 18:07:41', 'Liaqat Saeed', '4', '2016-03-10 18:07:41', 'Liaqat Saeed', '4', '2016-03-10 18:07:41', 'Liaqat Saeed', '4', '2016-03-10 18:07:41', 'Liaqat Saeed', '2', '2016-04-28 22:27:09', 'Liaqat Saeed', '', '2016-04-28 22:23:36', 'Liaqat Saeed', '4', '2016-03-10 18:07:41', 'Liaqat Saeed', '4', '2016-03-10 18:07:41', 'Liaqat Saeed', '', '2016-04-28 22:23:36', 'Liaqat Saeed', '4', '2016-03-10 18:07:41', 'Liaqat Saeed', '', '2016-04-28 22:23:36', 'Liaqat Saeed', '4', '2016-02-23 17:19:32', 'Liaqat Saeed', '4', '2016-02-23 17:19:32', 'Liaqat Saeed', '0', '2016-02-23 00:25:59', 'Liaqat Saeed', '1', '2016-02-23 17:19:32', 'Liaqat Saeed', '0', '2016-02-23 00:25:59', 'Liaqat Saeed', '0', '2016-02-23 00:25:59', 'Liaqat Saeed', '3', '2016-02-23 17:19:32', 'Liaqat Saeed', '2', '2016-04-06 15:20:14', 'Liaqat Saeed', '3', '2016-02-23 17:19:32', 'Liaqat Saeed', '4', '2016-04-05 20:04:39', 'Liaqat Saeed', '2', '2016-02-23 17:19:32', 'Liaqat Saeed', '2', '2016-02-23 17:19:32', 'Liaqat Saeed', '2', '2016-02-23 17:19:32', 'Liaqat Saeed', '3', '2016-02-23 17:19:32', 'Liaqat Saeed', '3', '2016-02-23 17:19:32', 'Liaqat Saeed', '3', '2016-02-23 17:19:32', 'Liaqat Saeed', '3', '2016-02-23 17:19:32', 'Liaqat Saeed', '2016-02-07 13:53:39', '2016-04-28 22:27:09'),
(2, 33, 100, '2016-02-23 17:23:36', 'Liaqat Saeed', '2016-02-23 06:00:00', '2016-02-23 17:23:36', 'Liaqat Saeed', '2', '2016-02-23 17:23:36', 'Liaqat Saeed', '0', '2016-02-23 17:23:36', 'Liaqat Saeed', '1', '2016-02-23 17:23:36', 'Liaqat Saeed', '4', '2016-04-10 20:35:33', 'Ayman Soliman', '3', '2016-02-23 17:23:36', 'Liaqat Saeed', '2', '2016-02-23 17:23:36', 'Liaqat Saeed', '3', '2016-02-23 17:23:36', 'Liaqat Saeed', '3', '2016-02-23 17:23:36', 'Liaqat Saeed', '3', '2016-02-23 17:23:36', 'Liaqat Saeed', '3', '2016-02-23 17:23:36', 'Liaqat Saeed', '2', '2016-02-23 17:23:36', 'Liaqat Saeed', '', '2016-04-25 22:45:22', 'Ayman Soliman', '3', '2016-02-23 17:23:36', 'Liaqat Saeed', '3', '2016-02-23 17:23:36', 'Liaqat Saeed', '', '2016-04-25 22:45:22', 'Ayman Soliman', '3', '2016-02-23 17:23:36', 'Liaqat Saeed', '', '2016-04-25 22:45:22', 'Ayman Soliman', '3', '2016-02-23 17:23:36', 'Liaqat Saeed', '3', '2016-02-23 17:23:36', 'Liaqat Saeed', '0', '2016-02-23 17:23:36', 'Liaqat Saeed', '0', '2016-02-23 17:23:36', 'Liaqat Saeed', '0', '2016-02-23 17:23:36', 'Liaqat Saeed', '0', '2016-02-23 17:23:36', 'Liaqat Saeed', '0', '2016-04-25 22:45:22', 'Ayman Soliman', '0', '2016-04-25 22:45:31', 'Ayman Soliman', '0', '2016-04-25 22:45:38', 'Ayman Soliman', '2', '2016-02-23 17:23:36', 'Liaqat Saeed', '3', '2016-02-23 17:23:36', 'Liaqat Saeed', '3', '2016-02-23 17:23:36', 'Liaqat Saeed', '3', '2016-02-23 17:23:36', 'Liaqat Saeed', '3', '2016-02-23 17:23:36', 'Liaqat Saeed', '3', '2016-02-23 17:23:36', 'Liaqat Saeed', '3', '2016-02-23 17:23:36', 'Liaqat Saeed', '3', '2016-02-23 17:23:36', 'Liaqat Saeed', '2016-02-07 13:54:03', '2016-04-25 22:45:38'),
(3, 34, 100, '2016-02-23 17:58:44', 'Liaqat Saeed', '2016-02-23 06:00:00', '2016-02-23 17:16:12', 'Liaqat Saeed', '2', '2016-03-10 18:06:13', 'Liaqat Saeed', '0', '2016-02-08 18:36:11', 'Joseph Semana', '3', '2016-03-10 17:33:27', 'Liaqat Saeed', '0', '2016-02-08 18:36:11', 'Joseph Semana', '2', '2016-04-28 22:34:16', 'Liaqat Saeed', '3', '2016-02-23 17:16:12', 'Liaqat Saeed', '3', '2016-03-10 17:33:27', 'Liaqat Saeed', '3', '2016-03-10 17:33:27', 'Liaqat Saeed', '3', '2016-03-10 17:33:27', 'Liaqat Saeed', '3', '2016-03-10 17:33:27', 'Liaqat Saeed', '0', '2016-02-08 18:36:11', 'Joseph Semana', '', '2016-04-28 22:34:16', 'Liaqat Saeed', '3', '2016-03-10 17:33:27', 'Liaqat Saeed', '3', '2016-03-10 17:33:27', 'Liaqat Saeed', '', '2016-04-28 22:34:16', 'Liaqat Saeed', '4', '2016-04-28 22:36:20', 'Liaqat Saeed', '', '2016-04-28 22:34:16', 'Liaqat Saeed', '4', '2016-03-10 18:06:32', 'Liaqat Saeed', '4', '2016-03-10 18:06:32', 'Liaqat Saeed', '0', '2016-02-08 18:36:11', 'Joseph Semana', '1', '2016-04-28 22:37:56', 'Liaqat Saeed', '0', '2016-02-08 18:36:11', 'Joseph Semana', '0', '2016-02-08 18:36:11', 'Joseph Semana', '0', '2016-03-10 17:33:27', 'Liaqat Saeed', '0', '2016-02-08 18:36:11', 'Joseph Semana', '2', '2016-04-28 22:38:45', 'Liaqat Saeed', '0', '2016-03-10 17:33:27', 'Liaqat Saeed', '0', '2016-03-10 17:33:27', 'Liaqat Saeed', '0', '2016-03-10 17:33:27', 'Liaqat Saeed', '0', '2016-03-10 17:33:27', 'Liaqat Saeed', '0', '2016-03-10 17:33:27', 'Liaqat Saeed', '0', '2016-03-10 17:33:27', 'Liaqat Saeed', '0', '2016-03-10 17:33:27', 'Liaqat Saeed', '0', '2016-03-10 17:33:27', 'Liaqat Saeed', '2016-02-07 13:54:11', '2016-04-28 22:38:45'),
(4, 35, 100, '2016-02-28 04:54:55', 'Ayman Soliman', '2016-03-08 06:00:00', '2016-03-10 17:13:00', 'Ayman Soliman', '0', '2016-02-23 17:13:23', 'Liaqat Saeed', '0', '2016-02-23 17:13:23', 'Liaqat Saeed', '3', '2016-04-18 22:18:05', 'Ayman Soliman', '0', '2016-02-23 17:13:23', 'Liaqat Saeed', '0', '2016-03-10 17:11:33', 'Ayman Soliman', '3', '2016-04-18 22:18:30', 'Ayman Soliman', '3', '2016-04-18 22:19:57', 'Ayman Soliman', '3', '2016-04-25 22:32:31', 'Ayman Soliman', '3', '2016-04-19 20:45:04', 'Ayman Soliman', '3', '2016-04-24 16:10:15', 'Ayman Soliman', '0', '2016-04-18 22:20:53', 'Ayman Soliman', '', '2016-04-17 23:47:53', 'Ayman Soliman', '3', '2016-04-19 20:45:38', 'Ayman Soliman', '3', '2016-03-10 17:11:33', 'Ayman Soliman', '', '2016-04-17 23:47:53', 'Ayman Soliman', '1', '2016-04-10 22:56:44', 'Ayman Soliman', '', '2016-04-17 23:47:53', 'Ayman Soliman', '4', '2016-03-10 17:11:33', 'Ayman Soliman', '4', '2016-03-10 17:11:33', 'Ayman Soliman', '0', '2016-02-23 17:13:23', 'Liaqat Saeed', '0', '2016-02-23 17:13:23', 'Liaqat Saeed', '0', '2016-02-23 17:13:23', 'Liaqat Saeed', '0', '2016-02-23 17:13:23', 'Liaqat Saeed', '0', '2016-03-10 17:11:33', 'Ayman Soliman', '0', '2016-02-23 17:13:23', 'Liaqat Saeed', '0', '2016-03-10 17:11:33', 'Ayman Soliman', '4.25', '2016-03-10 23:32:53', 'Ayman Soliman', '4', '2016-03-10 22:17:58', 'Ayman Soliman', '5', '2016-03-10 22:17:58', 'Ayman Soliman', '4', '2016-03-10 22:17:58', 'Ayman Soliman', '4.5', '2016-03-10 23:32:53', 'Ayman Soliman', '5', '2016-03-10 22:17:58', 'Ayman Soliman', '4.5', '2016-03-10 23:32:53', 'Ayman Soliman', '4.5', '2016-03-10 23:32:53', 'Ayman Soliman', '2016-02-07 13:54:19', '2016-04-25 22:32:31'),
(5, 36, 0, '2016-02-28 04:54:00', 'Ayman Soliman', '2016-02-23 06:00:00', '2016-02-23 18:11:51', 'Liaqat Saeed', '1', '2016-04-12 21:23:53', 'Joseph Semana', '2', '2016-03-30 22:13:38', 'Ayman Soliman', '2', '2016-03-30 22:13:38', 'Ayman Soliman', '2', '2016-03-30 22:13:38', 'Ayman Soliman', '4', '2016-03-30 22:19:35', 'Ayman Soliman', '5', '2016-03-30 22:19:35', 'Ayman Soliman', '0', '2016-03-30 22:13:47', 'Ayman Soliman', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '3', '2016-03-30 22:13:38', 'Ayman Soliman', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '3', '2016-03-30 22:13:38', 'Ayman Soliman', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '3', '2016-03-30 22:13:38', 'Ayman Soliman', '3', '2016-03-30 22:13:38', 'Ayman Soliman', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '0', '2016-02-23 18:11:51', 'Liaqat Saeed', '2016-02-07 13:54:27', '2016-04-12 21:23:54'),
(6, 37, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '2016-02-07 13:54:35', '0000-00-00 00:00:00'),
(7, 46, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '2016-02-23 07:40:10', '0000-00-00 00:00:00'),
(8, 48, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '2016-03-24 05:26:44', '0000-00-00 00:00:00'),
(9, 51, 100, '2016-03-29 22:40:22', 'Liaqat Saeed', '2016-03-29 05:00:00', '2016-03-29 22:40:22', 'Liaqat Saeed', '2', '2016-04-21 18:37:35', 'Joseph Semana', '0', '2016-03-29 22:40:22', 'Liaqat Saeed', '3', '2016-03-29 22:40:22', 'Liaqat Saeed', '3', '2016-03-29 22:40:22', 'Liaqat Saeed', '3', '2016-03-29 22:40:22', 'Liaqat Saeed', '3', '2016-03-29 22:40:22', 'Liaqat Saeed', '1', '2016-04-21 18:39:25', 'Joseph Semana', '4', '2016-03-29 22:40:22', 'Liaqat Saeed', '4', '2016-03-29 22:40:22', 'Liaqat Saeed', '4', '2016-03-29 22:40:22', 'Liaqat Saeed', '3', '2016-03-29 22:40:22', 'Liaqat Saeed', '', '2016-04-21 18:37:12', 'Joseph Semana', '4', '2016-03-29 22:40:22', 'Liaqat Saeed', '4', '2016-03-29 22:40:22', 'Liaqat Saeed', '', '2016-04-21 18:37:12', 'Joseph Semana', '4', '2016-03-29 22:40:22', 'Liaqat Saeed', '', '2016-04-21 18:37:12', 'Joseph Semana', '5', '2016-03-29 22:40:22', 'Liaqat Saeed', '5', '2016-03-29 22:40:22', 'Liaqat Saeed', '0', '2016-03-29 22:40:22', 'Liaqat Saeed', '0', '2016-03-29 22:40:22', 'Liaqat Saeed', '4', '2016-03-29 22:40:22', 'Liaqat Saeed', '0', '2016-03-29 22:40:22', 'Liaqat Saeed', '4', '2016-03-29 22:40:22', 'Liaqat Saeed', '4', '2016-03-29 22:40:22', 'Liaqat Saeed', '4', '2016-03-29 22:40:22', 'Liaqat Saeed', '0', '2016-03-29 22:40:22', 'Liaqat Saeed', '0', '2016-03-29 22:40:22', 'Liaqat Saeed', '0', '2016-03-29 22:40:22', 'Liaqat Saeed', '0', '2016-03-29 22:40:22', 'Liaqat Saeed', '0', '2016-03-29 22:40:22', 'Liaqat Saeed', '0', '2016-03-29 22:40:22', 'Liaqat Saeed', '0', '2016-03-29 22:40:22', 'Liaqat Saeed', '0', '2016-03-29 22:40:22', 'Liaqat Saeed', '2016-03-29 13:35:15', '2016-04-21 18:39:25'),
(10, 52, 100, '2016-03-29 22:41:59', 'Liaqat Saeed', '2016-03-29 05:00:00', '2016-03-29 22:41:59', 'Liaqat Saeed', '2', '2016-04-20 16:10:34', 'Joseph Semana', '0', '2016-03-29 22:41:59', 'Liaqat Saeed', '2', '2016-03-29 22:41:59', 'Liaqat Saeed', '3', '2016-06-16 20:35:04', 'Liaqat Saeed', '3', '2016-03-29 22:41:59', 'Liaqat Saeed', '3', '2016-03-29 22:41:59', 'Liaqat Saeed', '3', '2016-03-29 22:41:59', 'Liaqat Saeed', '3', '2016-03-29 22:41:59', 'Liaqat Saeed', '3', '2016-03-29 22:41:59', 'Liaqat Saeed', '3', '2016-03-29 22:41:59', 'Liaqat Saeed', '0', '2016-03-29 22:41:59', 'Liaqat Saeed', '', '2016-04-20 16:10:34', 'Joseph Semana', '3', '2016-03-29 22:41:59', 'Liaqat Saeed', '3', '2016-03-29 22:41:59', 'Liaqat Saeed', '', '2016-04-20 16:10:34', 'Joseph Semana', '3', '2016-03-29 22:41:59', 'Liaqat Saeed', '', '2016-04-20 16:10:34', 'Joseph Semana', '4', '2016-03-29 22:41:59', 'Liaqat Saeed', '4', '2016-03-29 22:41:59', 'Liaqat Saeed', '0', '2016-03-29 22:41:59', 'Liaqat Saeed', '0', '2016-03-29 22:41:59', 'Liaqat Saeed', '0', '2016-03-29 22:41:59', 'Liaqat Saeed', '0', '2016-03-29 22:41:59', 'Liaqat Saeed', '3', '2016-03-29 22:41:59', 'Liaqat Saeed', '2', '2016-03-29 22:41:59', 'Liaqat Saeed', '3', '2016-03-29 22:41:59', 'Liaqat Saeed', '0', '2016-03-29 22:41:59', 'Liaqat Saeed', '0', '2016-03-29 22:41:59', 'Liaqat Saeed', '0', '2016-03-29 22:41:59', 'Liaqat Saeed', '0', '2016-03-29 22:41:59', 'Liaqat Saeed', '0', '2016-03-29 22:41:59', 'Liaqat Saeed', '0', '2016-03-29 22:41:59', 'Liaqat Saeed', '0', '2016-03-29 22:41:59', 'Liaqat Saeed', '0', '2016-03-29 22:41:59', 'Liaqat Saeed', '2016-03-29 13:35:42', '2016-06-16 20:35:04'),
(11, 53, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '2016-04-13 15:19:17', '0000-00-00 00:00:00'),
(12, 54, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '2016-04-13 15:22:00', '0000-00-00 00:00:00'),
(13, 55, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '', '2016-04-13 15:28:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `skills_map_v7`
--

CREATE TABLE IF NOT EXISTS `skills_map_v7` (
  `id` int(10) unsigned NOT NULL,
  `uid` int(10) NOT NULL,
  `status` int(3) NOT NULL,
  `status_as_of` date NOT NULL,
  `vbox` varchar(2) NOT NULL DEFAULT '0',
  `vbox_rate` int(2) NOT NULL,
  `alcatel` varchar(2) NOT NULL DEFAULT '0',
  `alcatel_rate` int(2) NOT NULL,
  `avaya` varchar(2) NOT NULL DEFAULT '0',
  `avaya_rate` int(2) NOT NULL,
  `cisco` varchar(2) NOT NULL DEFAULT '0',
  `cisco_rate` int(2) NOT NULL,
  `sql_server` varchar(2) NOT NULL DEFAULT '0',
  `sql_rate` int(2) NOT NULL,
  `oracle` varchar(2) NOT NULL DEFAULT '0',
  `oracle_rate` int(2) NOT NULL,
  `altitude_routing` varchar(2) NOT NULL DEFAULT '0',
  `altitude_routing_rate` int(2) NOT NULL,
  `altitude_dialer` varchar(2) NOT NULL DEFAULT '0',
  `altitude_dialer_rate` int(2) NOT NULL,
  `altitude_voice` varchar(2) NOT NULL DEFAULT '0',
  `altitude_voice_rate` int(2) NOT NULL,
  `altitude_email` varchar(2) NOT NULL DEFAULT '0',
  `altitude_email_rate` int(2) NOT NULL,
  `altitude_chat` varchar(2) NOT NULL DEFAULT '0',
  `altitude_chat_rate` int(2) NOT NULL,
  `social` varchar(2) NOT NULL DEFAULT '0',
  `social_rate` int(2) NOT NULL,
  `altitude_desktop` varchar(2) NOT NULL DEFAULT '0',
  `altitude_desktop_rate` int(2) NOT NULL,
  `altitude_ivr` varchar(2) NOT NULL DEFAULT '0',
  `altitude_ivr_rate` int(2) NOT NULL,
  `altitude_express_routing` varchar(2) NOT NULL DEFAULT '0',
  `altitude_express_routing_rate` int(2) NOT NULL,
  `altitude_integration` varchar(2) NOT NULL DEFAULT '0',
  `altitude_integration_rate` int(2) NOT NULL,
  `altitude_workflow` varchar(2) NOT NULL DEFAULT '0',
  `altitude_workflow_rate` int(2) NOT NULL,
  `uci_installation` varchar(2) NOT NULL DEFAULT '0',
  `uci_installation_rate` int(2) NOT NULL,
  `uci_patch` varchar(2) NOT NULL DEFAULT '0',
  `uci_patch_rate` int(2) NOT NULL,
  `sap` varchar(2) NOT NULL DEFAULT '0',
  `sap_rate` int(2) NOT NULL,
  `siebel` varchar(2) NOT NULL DEFAULT '0',
  `siebel_rate` int(2) NOT NULL,
  `ms_crm` varchar(2) NOT NULL DEFAULT '0',
  `ms_crm_rate` int(2) NOT NULL,
  `teleopti` varchar(2) NOT NULL DEFAULT '0',
  `teleopti_rate` int(2) NOT NULL,
  `supervisor` varchar(2) NOT NULL DEFAULT '0',
  `supervisor_rate` int(2) NOT NULL,
  `administrator` varchar(2) NOT NULL DEFAULT '0',
  `administrator_rate` int(2) NOT NULL,
  `developer` varchar(2) NOT NULL DEFAULT '0',
  `developer_rate` int(2) NOT NULL,
  `communication` varchar(10) NOT NULL DEFAULT '0',
  `commitment` varchar(10) NOT NULL DEFAULT '0',
  `analysis` varchar(10) NOT NULL DEFAULT '0',
  `quality_of_delivery` varchar(10) NOT NULL DEFAULT '0',
  `productivity` varchar(10) NOT NULL DEFAULT '0',
  `fixing` varchar(10) NOT NULL DEFAULT '0',
  `presentability` varchar(10) NOT NULL DEFAULT '0',
  `recommendation` varchar(10) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills_map_v7`
--

INSERT INTO `skills_map_v7` (`id`, `uid`, `status`, `status_as_of`, `vbox`, `vbox_rate`, `alcatel`, `alcatel_rate`, `avaya`, `avaya_rate`, `cisco`, `cisco_rate`, `sql_server`, `sql_rate`, `oracle`, `oracle_rate`, `altitude_routing`, `altitude_routing_rate`, `altitude_dialer`, `altitude_dialer_rate`, `altitude_voice`, `altitude_voice_rate`, `altitude_email`, `altitude_email_rate`, `altitude_chat`, `altitude_chat_rate`, `social`, `social_rate`, `altitude_desktop`, `altitude_desktop_rate`, `altitude_ivr`, `altitude_ivr_rate`, `altitude_express_routing`, `altitude_express_routing_rate`, `altitude_integration`, `altitude_integration_rate`, `altitude_workflow`, `altitude_workflow_rate`, `uci_installation`, `uci_installation_rate`, `uci_patch`, `uci_patch_rate`, `sap`, `sap_rate`, `siebel`, `siebel_rate`, `ms_crm`, `ms_crm_rate`, `teleopti`, `teleopti_rate`, `supervisor`, `supervisor_rate`, `administrator`, `administrator_rate`, `developer`, `developer_rate`, `communication`, `commitment`, `analysis`, `quality_of_delivery`, `productivity`, `fixing`, `presentability`, `recommendation`, `created_at`, `updated_at`) VALUES
(1, 32, 0, '0000-00-00', '3', 0, '0', 0, '4', 0, '3', 0, '4', 0, '4', 0, '4', 0, '4', 0, '4', 0, '4', 0, '2', 0, '', 0, '4', 0, '4', 0, '', 0, '4', 0, '', 0, '4', 0, '4', 0, '0', 0, '1', 0, '0', 0, '0', 0, '3', 0, '2', 0, '3', 0, '4', '2', '2', '2', '3', '3', '3', '3', '2016-02-07 13:52:16', '2016-04-28 22:27:09'),
(2, 33, 100, '2016-02-23', '2', 0, '0', 0, '1', 0, '4', 0, '3', 0, '2', 0, '3', 0, '3', 0, '3', 0, '3', 0, '2', 0, '', 0, '3', 0, '3', 0, '', 0, '3', 0, '', 0, '3', 0, '3', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '2', '3', '3', '3', '3', '3', '3', '3', '2016-02-07 13:52:16', '2016-04-25 22:45:38'),
(3, 34, 100, '2016-02-23', '2', 0, '0', 0, '3', 0, '0', 0, '2', 0, '3', 0, '3', 0, '3', 0, '3', 0, '3', 0, '0', 0, '', 0, '3', 0, '3', 0, '', 0, '4', 0, '', 0, '4', 0, '4', 0, '0', 0, '1', 0, '0', 0, '0', 0, '0', 0, '0', 0, '2', 0, '0', '0', '0', '0', '0', '0', '0', '0', '2016-02-07 13:52:16', '2016-04-28 22:38:45'),
(4, 35, 100, '2016-03-08', '0', 0, '0', 0, '3', 0, '0', 0, '0', 0, '3', 0, '3', 0, '3', 0, '3', 0, '3', 0, '0', 0, '', 0, '3', 0, '3', 0, '', 0, '1', 0, '', 0, '4', 0, '4', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '4.25', '4', '5', '4', '4.5', '5', '4.5', '4.5', '2016-02-07 13:52:16', '2016-04-25 22:32:30'),
(5, 36, 0, '2016-02-23', '1', 0, '2', 0, '2', 0, '2', 0, '4', 0, '5', 0, '0', 0, '0', 0, '3', 0, '0', 0, '0', 0, '0', 0, '3', 0, '0', 0, '0', 0, '0', 0, '0', 0, '3', 0, '3', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', '2016-02-07 13:52:16', '2016-04-12 21:23:54'),
(6, 37, 0, '0000-00-00', '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', '2016-02-07 13:52:16', '0000-00-00 00:00:00'),
(7, 46, 0, '0000-00-00', '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', '2016-02-23 07:40:10', '0000-00-00 00:00:00'),
(8, 48, 0, '0000-00-00', '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', '2016-03-24 05:26:44', '0000-00-00 00:00:00'),
(9, 51, 100, '2016-03-29', '2', 0, '0', 0, '3', 0, '3', 0, '3', 0, '3', 0, '1', 0, '4', 0, '4', 0, '4', 0, '3', 0, '', 0, '4', 0, '4', 0, '', 0, '4', 0, '', 0, '5', 0, '5', 0, '0', 0, '0', 0, '4', 0, '0', 0, '4', 0, '4', 0, '4', 0, '0', '0', '0', '0', '0', '0', '0', '0', '2016-03-29 13:35:15', '2016-04-21 18:39:25'),
(10, 52, 100, '2016-03-29', '2', 0, '0', 0, '2', 0, '3', 0, '3', 0, '3', 0, '3', 0, '3', 0, '3', 0, '3', 0, '0', 0, '', 0, '3', 0, '3', 0, '', 0, '3', 0, '', 0, '4', 0, '4', 0, '0', 0, '0', 0, '0', 0, '0', 0, '3', 0, '2', 0, '3', 0, '0', '0', '0', '0', '0', '0', '0', '0', '2016-03-29 13:35:42', '2016-06-16 20:35:04'),
(11, 53, 0, '0000-00-00', '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', '2016-04-13 15:19:17', '0000-00-00 00:00:00'),
(12, 54, 0, '0000-00-00', '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', '2016-04-13 15:22:00', '0000-00-00 00:00:00'),
(13, 55, 0, '0000-00-00', '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', '2016-04-13 15:28:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `skills_proficiency_v7`
--

CREATE TABLE IF NOT EXISTS `skills_proficiency_v7` (
  `id` int(11) unsigned NOT NULL,
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `skill_name` varchar(30) NOT NULL,
  `skill_rate` int(1) NOT NULL,
  `old_skill_rate` int(1) NOT NULL,
  `remarks` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills_proficiency_v7`
--

INSERT INTO `skills_proficiency_v7` (`id`, `cid`, `uid`, `admin_id`, `skill_name`, `skill_rate`, `old_skill_rate`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 7, 33, 1, 'cisco', 3, 2, '', '2016-04-10 20:35:10', '0000-00-00 00:00:00'),
(2, 7, 33, 1, 'cisco', 4, 3, '', '2016-04-10 20:35:33', '0000-00-00 00:00:00'),
(3, 2, 35, 1, 'altitude_integration', 1, 0, '', '2016-04-10 22:56:44', '0000-00-00 00:00:00'),
(4, 2, 32, 18, 'avaya', 4, 2, '', '2016-04-12 21:01:12', '0000-00-00 00:00:00'),
(5, 3, 36, 18, 'vbox', 1, 4, '', '2016-04-12 21:23:53', '0000-00-00 00:00:00'),
(6, 3, 36, 18, 'vbox', 1, 4, '', '2016-04-12 21:23:54', '0000-00-00 00:00:00'),
(11, 2, 35, 1, 'avaya', 3, 0, '', '2016-04-18 22:18:05', '0000-00-00 00:00:00'),
(12, 2, 35, 1, 'oracle', 3, 0, '', '2016-04-18 22:18:30', '0000-00-00 00:00:00'),
(15, 2, 35, 1, 'altitude_routing', 3, 0, '', '2016-04-18 22:19:57', '0000-00-00 00:00:00'),
(20, 2, 35, 1, 'altitude_voice', 3, 0, '', '2016-04-19 20:45:04', '0000-00-00 00:00:00'),
(22, 2, 35, 1, 'altitude_desktop', 3, 0, '', '2016-04-19 20:45:38', '0000-00-00 00:00:00'),
(24, 2, 35, 1, 'altitude_email', 3, 0, '', '2016-04-24 16:10:15', '0000-00-00 00:00:00'),
(25, 2, 35, 1, 'altitude_dialer', 3, 0, '', '2016-04-25 22:32:31', '0000-00-00 00:00:00'),
(26, 1, 32, 20, 'cisco', 3, 2, 'Worked on IVR configurations using ACS etc.', '2016-04-28 22:23:36', '0000-00-00 00:00:00'),
(27, 6, 32, 20, 'sql_server', 4, 3, '', '2016-04-28 22:24:09', '0000-00-00 00:00:00'),
(28, 2, 32, 20, 'oracle', 4, 3, '', '2016-04-28 22:24:25', '0000-00-00 00:00:00'),
(29, 8, 32, 20, 'altitude_chat', 2, 0, 'For NBO.', '2016-04-28 22:27:09', '0000-00-00 00:00:00'),
(30, 8, 34, 20, 'sql_server', 2, 0, 'Did personnel practices but no practical experience with customer.', '2016-04-28 22:34:16', '0000-00-00 00:00:00'),
(31, 2, 34, 20, 'altitude_integration', 4, 3, 'Connection Manager, SMS Integrations etc at UBL Pakistan', '2016-04-28 22:36:20', '0000-00-00 00:00:00'),
(32, 8, 34, 20, 'siebel', 1, 0, 'Self study on this during AVL for Meezan Bank.', '2016-04-28 22:37:56', '0000-00-00 00:00:00'),
(33, 8, 34, 20, 'developer', 2, 0, 'Trained resources in AVL and Yousuf in curve Tech.', '2016-04-28 22:38:45', '0000-00-00 00:00:00'),
(34, 5, 52, 20, 'cisco', 3, 0, '', '2016-06-16 20:35:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `skills_proficiency_v8`
--

CREATE TABLE IF NOT EXISTS `skills_proficiency_v8` (
  `id` int(11) unsigned NOT NULL,
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `skill_name` varchar(30) NOT NULL,
  `skill_rate` int(1) NOT NULL,
  `old_skill_rate` int(1) NOT NULL,
  `remarks` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills_proficiency_v8`
--

INSERT INTO `skills_proficiency_v8` (`id`, `cid`, `uid`, `admin_id`, `skill_name`, `skill_rate`, `old_skill_rate`, `remarks`, `created_at`, `updated_at`) VALUES
(3, 2, 37, 1, 'avaya', 1, 0, '', '2016-04-12 20:58:02', '0000-00-00 00:00:00'),
(9, 8, 48, 1, 'altitude_routing', 1, 0, '', '2016-04-21 21:16:15', '0000-00-00 00:00:00'),
(12, 8, 48, 1, 'altitude_routing', 3, 1, '', '2016-04-21 21:17:00', '0000-00-00 00:00:00'),
(13, 8, 48, 1, 'altitude_routing', 1, 3, '', '2016-04-21 21:18:14', '0000-00-00 00:00:00'),
(14, 8, 37, 1, 'reporting_framework', 1, 0, '', '2016-04-21 23:00:09', '0000-00-00 00:00:00'),
(16, 8, 46, 20, 'vbox', 3, 2, '', '2016-04-28 22:00:11', '0000-00-00 00:00:00'),
(17, 8, 46, 20, 'altitude_routing', 3, 2, 'Worked on OJ later on as well.', '2016-04-28 22:01:30', '0000-00-00 00:00:00'),
(18, 8, 46, 20, 'altitude_voice', 2, 1, '', '2016-04-28 22:03:19', '0000-00-00 00:00:00'),
(19, 8, 46, 20, 'altitude_chat', 1, 0, '', '2016-04-28 22:04:37', '0000-00-00 00:00:00'),
(20, 8, 46, 20, 'altitude_ivr', 3, 2, 'Extra forcetell IVR development with external integration.', '2016-04-28 22:06:14', '0000-00-00 00:00:00'),
(21, 8, 46, 20, 'reporting_framework', 1, 0, '', '2016-04-28 22:11:33', '0000-00-00 00:00:00'),
(22, 8, 37, 20, 'alcatel', 0, 1, '', '2016-04-28 22:49:55', '0000-00-00 00:00:00'),
(23, 2, 37, 20, 'avaya', 2, 1, '', '2016-04-28 22:50:33', '0000-00-00 00:00:00'),
(24, 8, 37, 20, 'cisco', 2, 1, 'NBO CRM CTI Project', '2016-04-28 22:51:33', '0000-00-00 00:00:00'),
(25, 8, 37, 20, 'altitude_express_routing', 2, 0, 'ADIA On the Job\r\nExtra', '2016-04-28 22:52:49', '0000-00-00 00:00:00'),
(26, 8, 37, 20, 'altitude_integration', 3, 2, 'NBO CRM CTI Integration', '2016-04-28 22:53:11', '0000-00-00 00:00:00'),
(27, 8, 37, 20, 'altitude_ivr', 4, 3, 'ABO PCI DSS Compliance', '2016-04-28 22:54:37', '0000-00-00 00:00:00'),
(28, 5, 37, 20, 'altitude_desktop', 4, 3, 'Admin Module, Agent Scripting.', '2016-04-28 22:55:00', '0000-00-00 00:00:00'),
(29, 8, 33, 1, 'vbox', 2, 0, 'Installed at Lab VM', '2016-05-12 18:27:30', '0000-00-00 00:00:00'),
(30, 8, 33, 1, 'vbox', 3, 2, '', '2016-05-12 18:37:06', '0000-00-00 00:00:00'),
(31, 8, 33, 1, 'avaya', 2, 0, 'had previous knowledge of integration with Avaya', '2016-05-12 18:38:07', '0000-00-00 00:00:00'),
(32, 6, 33, 1, 'cisco', 3, 0, 'configured the SIP trunk and CTI integration in test Environment Preparation for V*', '2016-05-12 18:39:20', '0000-00-00 00:00:00'),
(33, 6, 33, 1, 'sql_server', 5, 0, '', '2016-05-12 18:40:11', '0000-00-00 00:00:00'),
(34, 8, 33, 1, 'oracle', 1, 0, '', '2016-05-12 18:40:50', '0000-00-00 00:00:00'),
(35, 8, 33, 1, 'altitude_routing', 3, 0, '', '2016-05-12 18:41:08', '0000-00-00 00:00:00'),
(36, 8, 33, 1, 'altitude_dialer', 2, 0, '', '2016-05-12 18:41:30', '0000-00-00 00:00:00'),
(37, 8, 33, 1, 'altitude_voice', 3, 0, '', '2016-05-12 18:42:01', '0000-00-00 00:00:00'),
(38, 8, 33, 1, 'altitude_email', 2, 0, '', '2016-05-12 18:42:18', '0000-00-00 00:00:00'),
(39, 8, 33, 1, 'altitude_chat', 2, 0, '', '2016-05-12 18:42:31', '0000-00-00 00:00:00'),
(40, 8, 33, 1, 'altitude_desktop', 3, 0, '', '2016-05-12 18:42:46', '0000-00-00 00:00:00'),
(41, 6, 33, 1, 'altitude_ivr', 3, 0, '', '2016-05-12 18:42:56', '0000-00-00 00:00:00'),
(42, 8, 33, 1, 'altitude_express_routing', 2, 0, '', '2016-05-12 18:43:37', '0000-00-00 00:00:00'),
(43, 6, 33, 1, 'altitude_integration', 3, 0, '', '2016-05-12 18:44:19', '0000-00-00 00:00:00'),
(44, 8, 33, 1, 'uci_installation', 2, 0, '', '2016-05-12 18:44:50', '0000-00-00 00:00:00'),
(45, 8, 33, 1, 'uci_patch', 2, 0, '', '2016-05-12 18:45:01', '0000-00-00 00:00:00'),
(46, 8, 33, 1, 'reporting_framework', 2, 0, '', '2016-05-12 18:45:12', '0000-00-00 00:00:00'),
(47, 8, 33, 1, 'strategy_manager', 2, 0, '', '2016-05-12 18:45:29', '0000-00-00 00:00:00'),
(48, 8, 33, 1, 'supervisor', 2, 0, '', '2016-05-12 18:47:07', '0000-00-00 00:00:00'),
(49, 8, 33, 1, 'administrator', 2, 0, '', '2016-05-12 18:47:16', '0000-00-00 00:00:00'),
(50, 8, 33, 1, 'developer', 2, 0, '', '2016-05-12 18:47:24', '0000-00-00 00:00:00'),
(51, 8, 33, 1, 'uci_installation', 3, 2, '', '2016-06-14 19:48:46', '0000-00-00 00:00:00'),
(52, 8, 33, 1, 'avaya', 4, 2, '', '2016-06-14 19:49:18', '0000-00-00 00:00:00'),
(53, 8, 33, 1, 'oracle', 3, 1, '', '2016-06-14 19:49:30', '0000-00-00 00:00:00'),
(54, 8, 33, 1, 'altitude_dialer', 4, 2, '', '2016-06-14 20:20:10', '0000-00-00 00:00:00'),
(55, 8, 33, 1, 'altitude_voice', 4, 3, '', '2016-06-14 20:20:23', '0000-00-00 00:00:00'),
(56, 8, 33, 1, 'uci_patch', 3, 2, '', '2016-06-14 20:20:38', '0000-00-00 00:00:00'),
(57, 8, 33, 1, 'reporting_framework', 3, 2, '', '2016-06-14 20:20:48', '0000-00-00 00:00:00'),
(58, 8, 33, 1, 'uci_installation', 4, 3, '', '2016-06-14 20:21:02', '0000-00-00 00:00:00'),
(59, 8, 33, 1, 'uci_patch', 4, 3, '', '2016-06-14 20:21:10', '0000-00-00 00:00:00'),
(60, 8, 33, 1, 'strategy_manager', 3, 2, '', '2016-06-14 20:21:23', '0000-00-00 00:00:00'),
(61, 8, 33, 1, 'altitude_routing', 4, 3, '', '2016-06-14 20:21:38', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `skill_descriptions`
--

CREATE TABLE IF NOT EXISTS `skill_descriptions` (
  `id` int(11) unsigned NOT NULL,
  `skill_name` varchar(30) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skill_descriptions`
--

INSERT INTO `skill_descriptions` (`id`, `skill_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'vbox', '\r\n<ul>\r\n<li>Install and configure Altitude vBox as All-In-One and Distributed Architecture.</li>\r\n<li>Understands and can validate the prerequisites needed to install vBox.</li>\r\n<li>Install and Configure HA for vBox</li>\r\n<li>Configure Altitude vBox Telephony gateway and understands the different parameters and features.</li>\r\n</ul>', '2016-04-19 11:14:48', '0000-00-00 00:00:00'),
(2, 'alcatel', '\r\n<ul>\r\n<li>Install and Configure the CTI connectivity between Altitude uCI  and  Alcatel Lucent switches through Altitude Alcatel telephony gateway.</li> \r\n<li>Understand and can validate the prerequisites needed to connect uCI with Alcatel voice switch.</li> \r\n<li>Understands the different parameters and features of uCI - Alcatel telephony gateway.i.e VDNs, extensions, … etc</li> \r\n<li>Configure Altitude trunk with Alcatel Lucent to Altitude Communication Server</li> \r\n</ul>\r\n', '2016-04-19 11:35:40', '0000-00-00 00:00:00'),
(3, 'avaya', '\r\n<ul>\r\n<li>Install and Configure the CTI connectivity between Altitude uCI  and  Avaya switches through Altitude Avaya telephony gateway. </li>\r\n<li>Understand and can validate the prerequisites needed to connect uCI with Avaya voice switch.</li>\r\n<li>Understands the different parameters and features of uCI - Avaya telephony gateway.i.e VDNs, extensions, … etc</li>\r\n<li>Configure Altitude trunk with Avaya to Altitude Communication Server</li>\r\n</ul>', '2016-04-19 11:37:39', '0000-00-00 00:00:00'),
(4, 'cisco', '\r\n<ul>\r\n<li>Install and Configure the CTI connectivity between Altitude uCI and Cisco Call Manager through Altitude Cisco telephony gateway. </li>\r\n<li>Understand and can validate the prerequisites needed to connect uCI with Cisco voice switch.</li>\r\n<li>Understands the different parameters and features of uCI - Cisco telephony gateway.i.e VDNs, extensions, … etc</li>\r\n<li>Configure Altitude trunk with Cisco to Altitude Communication Server</li>\r\n</ul>', '2016-04-19 11:38:58', '0000-00-00 00:00:00'),
(5, 'sql_server', '\r\n<ul>\r\n<li>Install Altitude uCI repository on MS-SQL Server.</li>\r\n<li>Configure Assisted server to connect to uCI repository installed on MS-SQL Server </li>\r\n<li>Understand and can validate the prerequisites needed to install uCI on MS-SQL Server.</li>\r\n</ul>', '2016-04-19 11:40:26', '0000-00-00 00:00:00'),
(6, 'oracle', '\r\n<ul>\r\n<li>Install Altitude uCI repository on Oracle DB.</li>\r\n<li>Configure Assisted server to connect to uCI repository installed on Oracle DB. </li>\r\n<li>Understand and can validate the prerequisites needed to install uCI on Oracle.</li>\r\n</ul>', '2016-04-19 11:41:46', '0000-00-00 00:00:00'),
(7, 'altitude_routing', '\r\n<ul>\r\n<li>Configure Altitude uCI for Inbound call Scenarios using default and skill based routing.</li>\r\n<li>Identify and install the needed components for inbound call flow.</li>\r\n</ul>', '2016-04-19 11:55:36', '0000-00-00 00:00:00'),
(8, 'altitude_dialer', '\r\n<ul>\r\n<li>Configure Altitude uCI for Outbound call Scenarios using Preview, Power and Predictive dialing modes.</li>\r\n<li>Understands and capable to do Predictive dialer tuning.</li>\r\n<li>Understand and capable to deploy the Contact Loading using uSupervisor and UCILoader tool</li>\r\n</ul>', '2016-04-19 11:56:26', '0000-00-00 00:00:00'),
(9, 'altitude_voice', '\r\n<ul>\r\n<li>Install and Configure Altitude uCI voice Channels for Automated and assisted services</li>\r\n</ul>\r\n', '2016-04-19 11:58:35', '0000-00-00 00:00:00'),
(10, 'altitude_email', '\r\n<ul>\r\n<li>Install and Configure Altitude uCI email Channel for inbound and outbound.</li>\r\n</ul>', '2016-04-19 11:58:40', '0000-00-00 00:00:00'),
(11, 'altitude_chat', '\r\n<ul>\r\n<li>Install and Configure Altitude uCI web chat  Channels</li>\r\n</ul>', '2016-04-19 11:58:45', '0000-00-00 00:00:00'),
(12, 'social', '\r\n<ul>\r\n<li>Install and Configure Altitude uCI Social Media Channel</li>\r\n</ul>', '2016-04-19 11:59:29', '0000-00-00 00:00:00'),
(13, 'altitude_desktop', '\r\n<ul>\r\n<li>Develop Altitude uCI agent scripts that can handle all the channels. I.e. voice, email, web chat, social media and other custom channels.</li>\r\n<li>Customize agent unified desktop through default scripts</li>\r\n</ul>', '2016-04-19 12:02:40', '0000-00-00 00:00:00'),
(14, 'altitude_ivr', '\r\n<ul>\r\n<li>Develop Altitude uCI IVR scripts.</li>\r\n<li>Develop routing scripts</li>\r\n</ul>', '2016-04-19 12:02:45', '0000-00-00 00:00:00'),
(15, 'altitude_express_routing', '\r\n<ul>\r\n<li>Install and customize IVR Call flows through Altitude Express Router</li>\r\n<li>Customize routing flows for Social Media and Email interaction channels</li>\r\n</ul>', '2016-04-19 12:02:53', '0000-00-00 00:00:00'),
(16, 'altitude_integration', '\r\n<ul>\r\n<li>Develop integrations from uCI to different backend systems. I.e. through DLLs, Web Services, DB Link, … etc</li>\r\n<li>Develop integrations to uCI from other systems through Altitude integration Server.</li>\r\n</ul>', '2016-04-19 12:02:58', '0000-00-00 00:00:00'),
(17, 'altitude_workflow', '\r\n<ul>\r\n<li>Configure Altitude workflow</li>\r\n<li>Customize workflows</li>\r\n</ul>', '2016-04-19 12:03:20', '0000-00-00 00:00:00'),
(18, 'uci_installation', '\r\n<ul>\r\n<li>Install Altitude uCI components. I.e. Assisted Server, License Manager, Repository, Communication Server, uAgent Web,...etc</li>\r\n<li>Install Altitude uCI in HA architecture</li>\r\n<li>Install multi-instance architecture on single server machine</li>\r\n</ul>', '2016-04-19 12:07:17', '0000-00-00 00:00:00'),
(19, 'uci_patch', '\r\n<ul>\r\n<li>Run Altitude uCI patch update for all uCI components.</li>\r\n<li>Familiar with the roll-back scenarios for failed patch updates activities</li>\r\n</ul>', '2016-04-19 12:07:25', '0000-00-00 00:00:00'),
(20, 'reporting_framework', '\r\n<ul>\r\n<li>Customize uCI reports using all the altitude uCI indicators and dimensions</li>\r\n<li>Customize business Indicators and build KPIs.</li>\r\n<li>Use Excel presentation on reports templates with multi data sets etc.</li>\r\n</ul>', '2016-04-19 12:07:28', '0000-00-00 00:00:00'),
(21, 'sap', '\r\n<ul>\r\n<li>Install and configure the Altitude uCI SAP Connector.</li>\r\n<li>Understands and can validate the prerequisites needed to integrate uCI with SAP.</li>\r\n</ul>', '2016-04-21 07:08:04', '0000-00-00 00:00:00'),
(22, 'siebel', '\r\n<ul>\r\n<li>Install and configure the Altitude uCI Siebel Connector.</li>\r\n<li>Understands and can validate the prerequisites needed to integrate uCI with Siebel.</li>\r\n</ul>', '2016-04-21 07:08:51', '0000-00-00 00:00:00'),
(23, 'ms_crm', '\r\n<ul>\r\n<li>Install and configure the Altitude uCI MS Dynamics CRM Connector.</li>\r\n<li>Understands and can validate the prerequisites needed to integrate uCI with MS Dynamics CRM.</li>\r\n</ul>', '2016-04-21 07:08:54', '0000-00-00 00:00:00'),
(24, 'teleopti', '\r\n<ul>\r\n<li>Install and configure the Altitude Teleopti Connector</li>\r\n<li>Understands and can validate the prerequisites needed to integrate uCI with MS Dynamics CRM.</li>\r\n</ul>', '2016-04-21 07:09:04', '0000-00-00 00:00:00'),
(25, 'otcs', '\r\n<ul>\r\n<li>Install Altitude OTCS</li>\r\n<li>Configure OTCS specific components: CS & IP</li>\r\n</ul>', '2016-04-21 07:09:22', '0000-00-00 00:00:00'),
(26, 'supervisor', 'Engineer is capable to deliver Altitude Supervisors and team leaders training courses.', '2016-04-21 07:09:51', '0000-00-00 00:00:00'),
(27, 'administrator', 'Engineer is capable to deliver Altitude uCI Administration and troubleshooting courses', '2016-04-21 07:09:56', '0000-00-00 00:00:00'),
(28, 'developer', 'Engineer is capable to deliver IVR, Routing and Agents scripts', '2016-04-21 07:09:59', '0000-00-00 00:00:00'),
(29, 'mobile_dashboard', '\r\n<ul>\r\n<li>Install Altitude uCI Mobile Dashboard</li>\r\n<li>Customize Dashboards linked to uCI Indicators: Live & Historical</li>\r\n</ul>', '2016-04-21 07:10:18', '0000-00-00 00:00:00'),
(30, 'enterprise_recorder', '\r\n<ul>\r\n<li>Install the different components of Altitude Enterprise Recorder including: Voice Recording, Screen Recording and quality evaluation</li>\r\n</ul>', '2016-04-21 07:10:20', '0000-00-00 00:00:00'),
(31, 'strategy_manager', 'No description.', '2016-04-21 07:10:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `temp_registration`
--

CREATE TABLE IF NOT EXISTS `temp_registration` (
  `id` int(10) unsigned NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `company` varchar(100) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  `course` varchar(60) NOT NULL,
  `attendance_status` varchar(20) NOT NULL,
  `remarks` longtext NOT NULL,
  `reference` varchar(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `discount` int(10) NOT NULL,
  `proposal_status_sent` varchar(15) NOT NULL,
  `po_date_sent` date NOT NULL,
  `proposal_status_received` varchar(15) NOT NULL,
  `po_date_received` date NOT NULL,
  `invoice` varchar(10) NOT NULL,
  `invoice_date_sent` date NOT NULL,
  `payment_status` varchar(15) NOT NULL,
  `cash_received` int(10) NOT NULL,
  `profiling` int(1) NOT NULL,
  `confirmed_date` varchar(30) NOT NULL,
  `change_status` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `primary_email_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `secondary_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1-admin; 2-trainor; 3-trainee; 4-engineers; 5-resource manager',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `skills_map` int(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `primary_email_address`, `secondary_email`, `company`, `position`, `contact_number`, `profile_pic`, `user_type`, `status`, `skills_map`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ayman.soliman@bluemena.com', '$2y$10$3/Q20yqGG5QjnDfOsbz97esE7R8RpNGnMmMPOCQA/jG2Frs5VG4Ny', 'Ayman', '', 'Soliman', 'ayman.soliman@bluemena.com', '', 'Blue Mena Group', 'Customer Development Director', '+971561712971', '1.jpg', 1, 1, 0, 'rTMkQgHTottrOG3tGQ5TVQMaY4uGb60jFvzPCQXyn7qo7oPHhm2j2kRAL3Gg', '2016-01-12 08:15:08', '2016-06-14 20:28:13'),
(18, 'joseph.semana@bluemena.com', '$2y$10$IhDJbR8y5CtIO4dSvKFXGOUZOJf1/5y7thdRvUo6lZozc4ayXi0C6', 'Joseph', '', 'Semana', 'joseph.semana@bluemena.com', '', 'Altitude Software', 'Software Engineer', '', '', 1, 1, 0, 'WqihCAaxyDAri47wfDsFBjf23FgUcuGRZRaHStk7Oh5TVctc6RbGMN7AvjAx', '2016-01-12 08:15:08', '2016-07-04 17:37:31'),
(19, 'amir.alasad@bluemena.com', '$2y$10$c52Tfe/diDzdZH3/rZAkceJwZWrfjkNj9m1jB1a6NiVlcjfxGasLW', 'Amir', '', 'Al Asad', 'amir.alasad@bluemena.com', '', 'Blue Mena Group', 'Team Leader', '', '', 1, 1, 0, 'L6RflR3m01QtnGON3g3CmKh7kwe0sJBgJjDgCZSGaCTXRAQ7bD4Ho3kWwZuf', '2016-01-12 08:15:08', '2016-01-28 21:53:41'),
(20, 'liaqat.saeed@bluemena.com', '$2y$10$1FbU.J1kwJKNnOyj10rNPOKrehO.9w21nsMS0.BkRJcxU94pv/mDi', 'Liaqat', '', 'Saeed', 'liaqat.saeed@bluemena.com', 'liaqat.saeed@altitude.com', '2', 'Project Manager', '', '20.png', 1, 1, 0, 'fJayTA2dybMmkL4C6xSex1DuhweafP9EQJFWKrQq6wQ0tJNvXcSmHEVeShUV', '2016-01-12 08:15:08', '2016-06-16 20:19:58'),
(32, 'muhammed.umair@curvetechnologies.net', '$2y$10$S2UCw9o4YY9mqoTJvb3DP.N3LlvpDbAQAIpHW9/5Y09eEa2P2SuXG', 'Muhammad', '', 'Umair', 'muhammed.umair@curvetechnologies.net', '', '4', 'Engineer', '', '32.jpg', 3, 1, 1, 'KKG6gviMKmfy7PxhmUe1UYoeA5fDWfoILi8r4Ybcm7LXZAAdLfBo2C7qWDqT', '2016-02-02 16:48:01', '2016-04-26 19:09:56'),
(33, 'shahzad.aziz@curvetechnologies.net', '$2y$10$2GhBRU1iXbjAmW.h6HgXDOhwdc0jliUqqPeMjQq5dZUX4jcMGtmgG', 'Shahzad', '', 'Aziz', 'shahzad.aziz@curvetechnologies.net', '', '4', 'Engineer', '', '33.jpg', 3, 1, 1, '85P9Y34ROHRWaBqXLfKc8m4IVhcRgWprRaGmNHAxLgWJfCiJN5hbapAADoYl', '2016-02-02 16:49:01', '2016-04-26 21:05:38'),
(34, 'rafiq.ahmed@curvetechnologies.net', '$2y$10$X/YGoTBZMvPA1eBsvPE0huTFjfczU7bpU3uvUwX95ymuok.8JsmTO', 'Rafiq', '', 'Ahmed', 'rafiq.ahmed@curvetechnologies.net', '', '4', 'Engineer', '', '34.jpg', 3, 1, 1, 'n1ftmYz872GBrYmvvQ3t8E1PKNcushmPo2RgHV4hJoC0yEvBpeYMfqizTUdr', '2016-02-02 16:49:37', '2016-02-23 21:35:41'),
(35, 'adeel.rehman@curvetechnologies.net', '$2y$10$SdtGMmKUReFcwxE8HVntwOelmmHNwysvu9JkHFO.nLj54Gt/TXkR.', 'Adeel', '', 'ur Rehman', 'adeel.rehman@curvetechnologies.net', '', '4', 'Engineer', '', '35.jpg', 3, 1, 1, 'O3bSpmZQyo4Rhv1kGF8appxyOuWoVqA6WSNSZUNNje4W9HfZFFjG4zCJu0jl', '2016-02-02 16:50:18', '2016-02-28 15:22:44'),
(36, 'yousuf.inayat@curvetechnologies.net', '$2y$10$.HI16N3rUTLUnJo7APtqs.UP8dwxpyOvqkG2wQ43Yv2Zbuo53HxGi', 'Yousuf', '', 'Inayat', 'yousuf.inayat@curvetechnologies.net', '', '4', 'Engineer', '', '36.jpg', 3, 1, 1, 'F9CQuN9mSzVqsZTcxe6WypDSF6Bs0xm4I1l58SPbmXcGyFtRjFCNFdbubEU7', '2016-02-02 16:51:06', '2016-04-14 20:32:36'),
(37, 'mazhar.mirza@curvetechnologies.net', '$2y$10$867dSfx/9mUoW8sya6O8ze.rt4R5F4ARMABD6JiIE8AhTOYaalLXO', 'Mazhar', 'mm', 'Mirza', 'mazhar.mirza@curvetechnologies.net', '', '4', 'Engineer', '', '37.jpg', 3, 1, 1, 'HSsGdY8n86gM41VFV8tugJK9l90ekbwfojKB7pn2BD94Xf955xqG4GEULpqP', '2016-02-02 16:59:13', '2016-04-27 00:24:00'),
(38, 'michelle.rodriguez@bluemena.com', '$2y$10$HXSbCxOkrO9DxEwBZwYQAO2KURrHiAZfszUQio5LS/zL7zpM46Yt6', 'Michelle', '', 'Rodriguez', 'michelle.rodriguez@bluemena.com', '', 'Blue Mena', 'Admin Officer', '', '', 1, 1, 0, 'Inc6wvD7bdqF3sz03LM9c57JpmwzkPAuNfiAjnTI6oo0ag4R19gGfR0pzQPr', '2016-02-16 08:15:08', '2016-04-12 18:16:05'),
(39, 'ahmer.jalal#!#@!@bluemena.com', '$2y$10$z8H2My16KfqpZYJ22mwkd.CqPg61RFZcw1.RYhtys0Mky6xzmFnX6', 'Ahmer', '', 'Jalal', 'ahmer.jalal@bluemena.com', '', 'Blue Mena', 'Training and Solutions Design', '', '', 1, 1, 0, 'ANyAwAi2OV0cr6KdwVdXN1ecH55KmuvxDrXEVmsgz0VpRHM7H1XtNVYxg3qr', '2016-02-16 08:15:08', '2016-02-16 21:31:07'),
(42, 'ajlsemana@gmail.com', '$2y$10$eBMImjAB/S/2Ph545/EdX.N9Cfkj7oxjuUDf059aZcF7L0gs7VbD2', 'Aiman Joseph', '', 'Semana', 'ajlsemana@gmail.com', '', 'Altitude Software', 'Software Engineer', '0565492779', '', 3, 1, 0, 'dweWobmuoa3m2lHfUhxoxBi7Su3txnHBV7sm3B3PXksx4aBfcoDTMwFhDsP5', '2016-02-16 21:27:45', '2016-03-27 22:38:51'),
(43, 'lamis@crm-me.ae', '$2y$10$3P0MuUlqViFlWLDmGEuMg.j681gmWEmt6aVHf8djZ4SIwg9eyMkHO', 'Lamis', '', 'Nouaihed', 'lamis@crm-me.ae', 'lamis.nouaihed@hotmail.com', 'crm ME', 'Lead Brand Ambassador', '00971553286748', '', 3, 1, 0, '79uM3FZjS2o5iNYvVue4h2rm49fQl3GaCMlRRdpFrKGwhJ45RR9z2xzuBHxl', '2016-02-21 23:15:58', '2016-02-23 22:14:07'),
(44, 'sheryl.dumasia@neuron.ae', '$2y$10$tFfMPgdltpi9G7XuaOLFlO23hQPKfAGsgld0Jznc9jIdMpGUiTnDa', 'Sheryl', '', 'Dumasia', 'sheryl.dumasia@neuron.ae', 'sheryl.dumasia@gmail.com', 'Neuron LLC', 'VP Corporate Supprt ', '971 50-6409331', '', 3, 1, 0, NULL, '2016-02-22 20:29:58', '2016-02-22 20:29:58'),
(45, 'ali.qasim@neuron.ae', '$2y$10$RAmwwl1cGHFjG6.J/tgVTuwcQwrOVBQOJWkPwxLTJTLto6aobR/A6', 'Dr Ali', '', 'Qasim', 'ali.qasim@neuron.ae', '', 'Neuron ', 'Medical Authorization Manager', '971 55 -1366-234', '', 3, 1, 0, '2zFglGeZTw5ZgsFjXqIstE7gNUNtu5CYxn99RLSn8q8726XaQu2NCDi8kydP', '2016-02-22 20:33:19', '2016-02-24 17:56:02'),
(46, 'najeeb.ahmed@curvetechnologies.net', '$2y$10$KwSTeIT2KFPCqx.MTHZ5LODEy6bmOSXvhH0uSbp0.TgdwRGCTYJ5C', 'Najeeb', '', 'Ahmed', 'najeeb.ahmed@curvetechnologies.net', '', '4', 'Project Manager', '', '46.jpg', 3, 1, 1, 'p4DZinilDPfhaZglYDDrqIE9ANnmobPadolt5behhGLdJcYPdbys6WGoARgJ', '2016-02-23 17:40:10', '2016-04-28 22:59:08'),
(47, 'jawed.mansoor@curvetechnologies.net', '$2y$10$tmJEvJjJ57BP3awMvjMFHuoDM8wci3rdlLIa6ISUu/3zYTvr6eWVS', 'Jawed', '', 'Mansoor', 'jawed.mansoor@curvetechnologies.net', '', '4', 'CEO', '', '', 5, 1, 0, 'L2u18b0tgVvbzDra9FsRN23lPC0MGv45uwGBruezSu7tU0yqsTOqg4yhPIlf', '2016-02-23 17:46:37', '2016-06-15 17:57:14'),
(48, 'Darshana.Bamunuarachchi@alrostamanigroup.ae', '$2y$10$wP8383kPItEVvgFKVyuHpe8.e.NOsV1nuEa9Z6M1uO1wSeiOYEuVa', 'Darshana', '', 'Bamunuarachchi', 'Darshana.Bamunuarachchi@alrostamanigroup.ae', '', '7', 'Software Engineer', '', '48.png', 3, 1, 1, 'sNuYdDoYP2cuzmsVsIFicM8JkNY8nwKWVcTDouog0WzPAimeeVfNiePFQcaj', '2016-03-24 14:26:44', '2016-04-26 17:54:40'),
(49, 'shahee.khan@neuron.ae', '$2y$10$3P0MuUlqViFlWLDmGEuMg.j681gmWEmt6aVHf8djZ4SIwg9eyMkHO', 'Shaheen', '', 'Khan', 'shahee.khan@neuron.ae', '', 'Neuron', '', '', '', 3, 1, 0, '79uM3FZjS2o5iNYvVue4h2rm49fQl3GaCMlRRdpFrKGwhJ45RR9z2xzuBHxl', '2016-02-21 23:15:58', '2016-02-23 22:14:07'),
(51, 'hussain.dibas@esh-me.com', '$2y$10$zVDYf0Z5EwF0rwRTP0bJG.du9ioCgtMK/3umSZpMO/PbmACOP8QxS', 'Hussain', '', 'Dibas', 'hussain.dibas@esh-me.com', '', '5', 'Services Manager', '', '51.jpg', 3, 1, 1, 'yLZ1wYHH5b3AxngpRETVKgeXKUa0QrmpNpHpBCWQsVnW2dHuDgVDsCZNOQp6', '2016-03-29 22:35:15', '2016-04-26 18:20:04'),
(52, 'abdullah.saif@esh-me.com', '$2y$10$4WlFHemdF7tD4Zgpdy7LQuVWx8HIKUPhuxiPJ144/ZLubl6MX9i3e', 'Abdullah', '', 'Saif', 'abdullah.saif@esh-me.com', '', '5', 'Senior Software Engineer', '', '52.png', 3, 1, 1, 'k21cQ8qCCUqu0PbUulrXbUQUVNXBEnJpRO6LCeqG75FVBhNdmt97B8zjkboM', '2016-03-29 22:35:42', '2016-04-28 18:31:18'),
(53, 'mmohsni@dot-square.net', '$2y$10$3UNbXMSiTkwKw0qk/JEDTOwW/OUpMvSTuXGjdJh3HORSTuPAHTqXy', 'Marwa', '', 'Mohsni', 'mmohsni@dot-square.net', '', '6', 'Support Engineer', '', '53.jpg', 3, 1, 1, NULL, '2016-04-14 00:19:17', '2016-04-14 00:20:25'),
(54, 'tiago.ruivo@xseed.pt', '$2y$10$WjKv1GbEOm9uyYyw90MZ2Ot0IIB5cUc/nxaS83u64rrY.P7TQLUsm', 'Tiago', '', 'Ruivo', 'tiago.ruivo@xseed.pt', '', '8', 'Managing Director', '', '54.jpg', 3, 1, 1, 'Rx4J4GpxyZGrM0jTSUsn9LyQIsUqLQO919UkBlMywlNxWCnXWPCLyyDBpiMI', '2016-04-14 00:22:00', '2016-04-26 21:31:12'),
(55, 'sbarbouche@dot-square.net', '$2y$10$ElBC6RwOv8ZV1a2c.7Z0Ve4HQe9QN5WGd6NOLEsJMXVaIBiRfT4Li', 'Samir', '', 'Barbouche', 'sbarbouche@dot-square.net', '', '6', 'Software Engineer', '', '55.jpg', 3, 1, 1, NULL, '2016-04-14 00:28:53', '2016-04-14 00:29:07'),
(56, 'jose.duarte@bluemena.com', '$2y$10$HXSbCxOkrO9DxEwBZwYQAO2KURrHiAZfszUQio5LS/zL7zpM46Yt6', 'Jose', '', 'Duarte', 'jose.duarte@bluemena.com', '', 'Altitude Software', 'Market Development Director', '', '', 1, 1, 0, 'F0O46GqPnrlKGwefDsGnFCcoc5CgDTAU0nigPEg7UyEBE6KHVtZs5KLXoo9G', '2016-04-17 07:15:08', '2016-04-17 22:14:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certification_color_v7`
--
ALTER TABLE `certification_color_v7`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certification_color_v8`
--
ALTER TABLE `certification_color_v8`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_students`
--
ALTER TABLE `class_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_agenda`
--
ALTER TABLE `course_agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers_feedback`
--
ALTER TABLE `customers_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecture_post_message`
--
ALTER TABLE `lecture_post_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecture_upload`
--
ALTER TABLE `lecture_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecture_wall_threads`
--
ALTER TABLE `lecture_wall_threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiling`
--
ALTER TABLE `profiling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profit_loss`
--
ALTER TABLE `profit_loss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes_items`
--
ALTER TABLE `quizzes_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes_students`
--
ALTER TABLE `quizzes_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes_students_items`
--
ALTER TABLE `quizzes_students_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrants`
--
ALTER TABLE `registrants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills_map`
--
ALTER TABLE `skills_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills_map_update`
--
ALTER TABLE `skills_map_update`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills_map_update_v7`
--
ALTER TABLE `skills_map_update_v7`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills_map_v7`
--
ALTER TABLE `skills_map_v7`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills_proficiency_v7`
--
ALTER TABLE `skills_proficiency_v7`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills_proficiency_v8`
--
ALTER TABLE `skills_proficiency_v8`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skill_descriptions`
--
ALTER TABLE `skill_descriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_registration`
--
ALTER TABLE `temp_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `primary_email_address` (`primary_email_address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `certification_color_v7`
--
ALTER TABLE `certification_color_v7`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `certification_color_v8`
--
ALTER TABLE `certification_color_v8`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `class_students`
--
ALTER TABLE `class_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `course_agenda`
--
ALTER TABLE `course_agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `customers_feedback`
--
ALTER TABLE `customers_feedback`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `lecture_post_message`
--
ALTER TABLE `lecture_post_message`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lecture_upload`
--
ALTER TABLE `lecture_upload`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lecture_wall_threads`
--
ALTER TABLE `lecture_wall_threads`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `profiling`
--
ALTER TABLE `profiling`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `profit_loss`
--
ALTER TABLE `profit_loss`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizzes_items`
--
ALTER TABLE `quizzes_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizzes_students`
--
ALTER TABLE `quizzes_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizzes_students_items`
--
ALTER TABLE `quizzes_students_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `registrants`
--
ALTER TABLE `registrants`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `skills_map`
--
ALTER TABLE `skills_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `skills_map_update`
--
ALTER TABLE `skills_map_update`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `skills_map_update_v7`
--
ALTER TABLE `skills_map_update_v7`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `skills_map_v7`
--
ALTER TABLE `skills_map_v7`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `skills_proficiency_v7`
--
ALTER TABLE `skills_proficiency_v7`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `skills_proficiency_v8`
--
ALTER TABLE `skills_proficiency_v8`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `skill_descriptions`
--
ALTER TABLE `skill_descriptions`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `temp_registration`
--
ALTER TABLE `temp_registration`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
