-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2015 at 09:17 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tblsys`
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `date_from`, `date_to`, `created_at`, `updated_at`) VALUES
(5, 'Lorem Ipsum Dolor Sit Amet', 'Hardy Herons!\r\nYour Report of Grades for the First Semester, AY 2014 - 2015 is now available. Go to http://umak.edu.ph/olrog-114/\r\n\r\nYour ROG password can be found from your final permits.\r\nIf you haven''t secured your permit yet, please visit the Accounting Office immediately.', '2015-08-11', '2015-09-09', '2014-11-01 18:00:39', '2015-12-30 07:00:56'),
(7, 'Workshop for Scripting', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2015-09-16', '2015-09-17', '2014-11-26 04:12:45', '2015-09-02 23:46:14');

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company`, `created_at`, `updated_at`) VALUES
(1, 'Detecon Consulting', '2015-12-22 11:32:26', '2015-12-28 09:56:36'),
(2, 'Blue MENA Group', '2015-12-22 11:32:26', '0000-00-00 00:00:00'),
(3, 'Altitude Software MENA', '2015-12-22 00:31:46', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `date_from`, `date_to`, `duration`, `time`, `status`, `trainer`, `created_at`, `updated_at`) VALUES
(1, 'Technical Administration', '2015-11-01', '2015-11-05', 5, '09:00-17:00', 1, 2, '2015-10-06 12:09:36', '2015-11-15 07:13:14'),
(2, 'Script Development', '2015-11-08', '2015-11-12', 5, '09:00-17:00', 0, 2, '2015-10-06 13:07:55', '2015-12-14 11:13:00'),
(3, 'Inbound Floor Operations', '2015-12-08', '2015-12-10', 2, '09:00-17:00', 1, 203, '2015-10-06 13:13:22', '2015-12-08 09:45:04'),
(4, 'Outbound Floor Operations', '2015-12-15', '2015-12-17', 3, '09:00-17:00', 1, 2, '2015-10-07 06:56:55', '2015-11-19 14:02:38'),
(5, 'Script Development', '2016-01-17', '2016-01-21', 5, '09:00-17:00', 1, 203, '2015-11-22 10:24:43', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_agenda`
--

INSERT INTO `course_agenda` (`id`, `cid`, `days`, `agenda`, `time_from`, `time_to`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Prayer', '09:00', '09:30', '2015-11-22 07:06:56', '0000-00-00 00:00:00'),
(2, 3, 1, 'Orientation', '09:30', '11:00', '2015-11-22 07:07:22', '0000-00-00 00:00:00'),
(4, 3, 2, 'Review', '09:00', '11:15', '2015-11-22 07:15:28', '0000-00-00 00:00:00'),
(5, 3, 2, 'Lunch', '12:00', '13:00', '2015-11-22 07:15:43', '0000-00-00 00:00:00'),
(6, 3, 2, 'Demonstration', '13:00', '17:00', '2015-11-22 07:16:07', '0000-00-00 00:00:00'),
(7, 2, 1, 'Orientation', '09:00', '10:00', '2015-12-13 13:16:47', '0000-00-00 00:00:00'),
(8, 2, 1, 'Module 1-5', '11:00', '12:00', '2015-12-13 13:17:14', '0000-00-00 00:00:00'),
(9, 2, 1, 'Lunch Break', '12:00', '13:00', '2015-12-13 13:17:26', '0000-00-00 00:00:00'),
(10, 2, 1, 'Module 6-10', '13:00', '17:00', '2015-12-13 13:17:40', '0000-00-00 00:00:00'),
(11, 2, 2, 'Module 11-13', '09:00', '12:00', '2015-12-13 13:18:02', '0000-00-00 00:00:00'),
(12, 2, 2, 'Lunch Break', '12:00', '13:00', '2015-12-13 13:18:14', '0000-00-00 00:00:00'),
(13, 2, 2, 'Module 13-20', '13:00', '17:00', '2015-12-13 13:18:30', '0000-00-00 00:00:00'),
(14, 3, 1, 'Lunch', '11:00', '12:00', '2015-12-30 09:12:53', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecture_post_message`
--

INSERT INTO `lecture_post_message` (`id`, `uid`, `sid`, `post_msg`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'As an interesting side note, as a head without a body, I envy the dead. There''s one way and only one way to determine if an animal is intelligent. Dissect its brain! Man, I''m sore all over. I feel like I just went ten rounds with mighty Thor!!..', '2015-12-08 13:51:44', '0000-00-00 00:00:00'),
(4, 202, 2, 'test 123!', '2015-12-10 11:38:19', '0000-00-00 00:00:00'),
(7, 202, 3, 'How you doing, bro!!?', '2015-12-10 11:43:03', '0000-00-00 00:00:00'),
(8, 202, 3, 'How you doin?', '2015-12-14 11:38:25', '0000-00-00 00:00:00'),
(9, 202, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. -TRAP', '2015-12-27 08:27:58', '0000-00-00 00:00:00'),
(10, 202, 2, 'Hello!!', '2015-12-30 12:39:46', '0000-00-00 00:00:00'),
(11, 202, 1, 'Test!', '2015-12-30 12:41:15', '0000-00-00 00:00:00'),
(14, 202, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a typ', '2015-12-30 12:54:56', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecture_wall_threads`
--

INSERT INTO `lecture_wall_threads` (`id`, `post_id`, `uid`, `wall_comment`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 'qwerty', '2015-12-09 09:42:15', '0000-00-00 00:00:00'),
(8, 7, 200, 'good!!!', '2015-12-10 11:44:46', '0000-00-00 00:00:00'),
(9, 7, 202, 'yehey!', '2015-12-10 11:45:16', '0000-00-00 00:00:00'),
(10, 8, 202, 'FIne!', '2015-12-14 11:38:35', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profit_loss`
--

INSERT INTO `profit_loss` (`id`, `course`, `groceries`, `lunch`, `room`, `trainer`, `stationary`, `transportation`, `miscellaneous`, `created_at`, `updated_at`) VALUES
(1, 'TA', 0, 0, 0, 0, 0, 0, 0, '2015-10-18 18:49:58', '0000-00-00 00:00:00'),
(2, 'SD', 0, 0, 0, 0, 0, 0, 0, '2015-10-18 18:49:58', '2015-10-18 23:57:53'),
(3, 'IFO', 0, 0, 0, 0, 0, 0, 0, '2015-10-18 18:49:58', '0000-00-00 00:00:00'),
(4, 'OFO', 0, 0, 0, 0, 0, 0, 0, '2015-10-18 18:49:58', '0000-00-00 00:00:00'),
(5, 'ITCC', 0, 0, 0, 0, 0, 0, 0, '2015-10-18 18:49:58', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `description`, `time_limit`, `due_date`, `visible`, `points`, `faculty_id`, `cid`, `created_at`, `updated_at`) VALUES
(2, 'Module 1 to 3', 'As an interesting side note, as a head without a body, I envy the dead. There''s one way and only one way to determine if an animal is intelligent. Dissect its brain! Man, I''m sore all over. I feel like I just went ten rounds with mighty Thor.', 60, '2015-12-23', 1, 5, 2, 2, '2015-12-07 12:44:24', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizzes_items`
--

INSERT INTO `quizzes_items` (`id`, `quiz_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `answer`, `created_at`, `updated_at`) VALUES
(118, 2, 'A23', 's', 'a', 'd', 'f', 'b', '2015-12-10 05:59:43', '0000-00-00 00:00:00'),
(119, 2, 'B', 'a', 's', 'd', 'b', 'd', '2015-12-10 05:59:43', '0000-00-00 00:00:00'),
(120, 2, 'Q', 'q', 'a', 's', 'd', 'a', '2015-12-10 05:59:43', '0000-00-00 00:00:00'),
(121, 2, 'X', 'w', 'x', 'a', 'd', 'b', '2015-12-10 05:59:43', '0000-00-00 00:00:00'),
(122, 2, 'U', 'u', 'q', 'e', 'r', 'a', '2015-12-10 05:59:43', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizzes_students`
--

INSERT INTO `quizzes_students` (`id`, `class_id`, `quiz_id`, `student_id`, `grade`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 202, 3, '2015-12-14 13:33:38', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizzes_students_items`
--

INSERT INTO `quizzes_students_items` (`id`, `quiz_student_id`, `question_id`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, 121, 'b', '2015-12-14 13:33:53', '0000-00-00 00:00:00'),
(2, 1, 119, 'd', '2015-12-14 13:33:53', '0000-00-00 00:00:00'),
(3, 1, 118, 'b', '2015-12-14 13:33:53', '0000-00-00 00:00:00'),
(4, 1, 120, 'b', '2015-12-14 13:33:53', '0000-00-00 00:00:00'),
(5, 1, 122, 'c', '2015-12-14 13:33:53', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registrants`
--

INSERT INTO `registrants` (`id`, `uid`, `course`, `attendance_status`, `remarks`, `reference`, `amount`, `discount`, `proposal_status_sent`, `po_date_sent`, `proposal_status_received`, `po_date_received`, `invoice`, `invoice_date_sent`, `payment_status`, `cash_received`, `profiling`, `confirmed_date`, `change_status`, `certificate`, `created_at`, `updated_at`) VALUES
(1, 200, 3, 'Confirmed', '', 'with PO', 2500, 25, 'Sent', '2015-11-23', 'Received', '2015-11-25', 'Sent', '2015-11-27', 'Full', 1875, 1, '08 - 10 Dec 2015', 'Confirmed', 'CERTIFICATE_1_INBOUND FLOOR OPERATIONS.PDF', '2015-12-29 04:23:25', '2015-11-23 11:24:35'),
(5, 201, 1, 'Confirmed', '', 'POP', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '06 - 10 Mar 2016', 'Confirmed', '', '2015-12-29 06:26:04', '2015-12-22 11:43:28'),
(6, 202, 2, 'Confirmed', '', 'POP', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 1, '08 - 12 Nov 2015', 'Confirmed', 'CERTIFICATE_6_SCRIPT DEVELOPMENT.PDF', '2015-11-24 08:22:06', '2015-12-29 13:48:22'),
(7, 202, 1, 'Confirmed', '', 'with PO', 2500, 50, 'Sent', '2015-11-30', 'Received', '2015-11-30', 'Sent', '2015-11-30', 'Full', 2500, 0, '06 - 10 Mar 2016', 'Confirmed', '', '2015-12-28 04:22:06', '2015-12-29 13:27:25'),
(11, 200, 1, 'New', '', '', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '', '', 'CERTIFICATE_11_TECHNICAL ADMINISTRATION.PDF', '2015-12-14 08:47:41', '0000-00-00 00:00:00'),
(12, 200, 2, 'New', '', '', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '', '', '', '2015-12-28 04:47:41', '0000-00-00 00:00:00'),
(13, 200, 4, 'New', '', '', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '', '', '', '2015-11-29 08:47:41', '0000-00-00 00:00:00'),
(14, 202, 3, 'Confirmed', '', 'with PO', 3000, 15, 'Not sent', '0000-00-00', 'Not received', '0000-00-00', 'Not sent', '0000-00-00', 'Full', 2550, 1, '08 - 10 Dec 2015', 'Confirmed', 'CERTIFICATE_14_INBOUND FLOOR OPERATIONS.PDF', '2015-11-30 12:21:27', '2015-11-30 12:22:11'),
(15, 202, 4, 'Confirmed', '', 'with PO', 3000, 0, 'Not sent', '0000-00-00', 'Not received', '0000-00-00', 'Not sent', '0000-00-00', 'Full', 3000, 0, '15 - 17 Dec 2015', '', '', '2015-12-10 06:53:58', '2015-12-30 11:23:02'),
(16, 198, 1, 'New', '', '', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '', '', '', '2015-12-13 07:14:05', '0000-00-00 00:00:00'),
(17, 198, 3, 'New', '', '', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '', '', '', '2015-12-15 07:17:03', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `uid`, `courses`, `attendance_status`, `expectations`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 200, 0, '', '', '', '2015-11-22 12:46:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `skills_map`
--

CREATE TABLE IF NOT EXISTS `skills_map` (
  `id` int(10) unsigned NOT NULL,
  `uid` int(10) NOT NULL,
  `status` int(3) NOT NULL,
  `status_as_of` date NOT NULL,
  `vbox` int(2) NOT NULL,
  `vbox_rate` int(2) NOT NULL,
  `alcatel` int(2) NOT NULL,
  `alcatel_rate` int(2) NOT NULL,
  `avaya` int(2) NOT NULL,
  `avaya_rate` int(2) NOT NULL,
  `cisco` int(2) NOT NULL,
  `cisco_rate` int(2) NOT NULL,
  `sql_server` int(2) NOT NULL,
  `sql_rate` int(2) NOT NULL,
  `oracle` int(2) NOT NULL,
  `oracle_rate` int(2) NOT NULL,
  `altitude_routing` int(2) NOT NULL,
  `altitude_routing_rate` int(2) NOT NULL,
  `altitude_dialer` int(2) NOT NULL,
  `altitude_dialer_rate` int(2) NOT NULL,
  `altitude_voice` int(2) NOT NULL,
  `altitude_voice_rate` int(2) NOT NULL,
  `altitude_email` int(2) NOT NULL,
  `altitude_email_rate` int(2) NOT NULL,
  `altitude_chat` int(2) NOT NULL,
  `altitude_chat_rate` int(2) NOT NULL,
  `social` int(2) NOT NULL,
  `social_rate` int(2) NOT NULL,
  `altitude_desktop` int(2) NOT NULL,
  `altitude_desktop_rate` int(2) NOT NULL,
  `altitude_ivr` int(2) NOT NULL,
  `altitude_ivr_rate` int(2) NOT NULL,
  `altitude_express_routing` int(2) NOT NULL,
  `altitude_express_routing_rate` int(2) NOT NULL,
  `altitude_integration` int(2) NOT NULL,
  `altitude_integration_rate` int(2) NOT NULL,
  `altitude_workflow` int(2) NOT NULL,
  `altitude_workflow_rate` int(2) NOT NULL,
  `uci_installation` int(2) NOT NULL,
  `uci_installation_rate` int(2) NOT NULL,
  `uci_patch` int(2) NOT NULL,
  `uci_patch_rate` int(2) NOT NULL,
  `sap` int(2) NOT NULL,
  `sap_rate` int(2) NOT NULL,
  `siebel` int(2) NOT NULL,
  `siebel_rate` int(2) NOT NULL,
  `ms_crm` int(2) NOT NULL,
  `ms_crm_rate` int(2) NOT NULL,
  `teleopti` int(2) NOT NULL,
  `teleopti_rate` int(2) NOT NULL,
  `supervisor` int(2) NOT NULL,
  `supervisor_rate` int(2) NOT NULL,
  `administrator` int(2) NOT NULL,
  `administrator_rate` int(2) NOT NULL,
  `developer` int(2) NOT NULL,
  `developer_rate` int(2) NOT NULL,
  `communication` int(2) NOT NULL,
  `commitment` int(2) NOT NULL,
  `analysis` int(2) NOT NULL,
  `quality_of_delivery` int(2) NOT NULL,
  `productivity` int(2) NOT NULL,
  `fixing` int(2) NOT NULL,
  `presentability` int(2) NOT NULL,
  `recommendation` int(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills_map`
--

INSERT INTO `skills_map` (`id`, `uid`, `status`, `status_as_of`, `vbox`, `vbox_rate`, `alcatel`, `alcatel_rate`, `avaya`, `avaya_rate`, `cisco`, `cisco_rate`, `sql_server`, `sql_rate`, `oracle`, `oracle_rate`, `altitude_routing`, `altitude_routing_rate`, `altitude_dialer`, `altitude_dialer_rate`, `altitude_voice`, `altitude_voice_rate`, `altitude_email`, `altitude_email_rate`, `altitude_chat`, `altitude_chat_rate`, `social`, `social_rate`, `altitude_desktop`, `altitude_desktop_rate`, `altitude_ivr`, `altitude_ivr_rate`, `altitude_express_routing`, `altitude_express_routing_rate`, `altitude_integration`, `altitude_integration_rate`, `altitude_workflow`, `altitude_workflow_rate`, `uci_installation`, `uci_installation_rate`, `uci_patch`, `uci_patch_rate`, `sap`, `sap_rate`, `siebel`, `siebel_rate`, `ms_crm`, `ms_crm_rate`, `teleopti`, `teleopti_rate`, `supervisor`, `supervisor_rate`, `administrator`, `administrator_rate`, `developer`, `developer_rate`, `communication`, `commitment`, `analysis`, `quality_of_delivery`, `productivity`, `fixing`, `presentability`, `recommendation`, `created_at`, `updated_at`) VALUES
(1, 198, 63, '2015-12-27', 4, 0, 5, 0, 3, 0, 4, 0, 2, 0, 3, 0, 2, 0, 0, 0, 3, 0, 0, 0, 0, 0, 2, 0, 3, 0, 0, 0, 0, 0, 2, 0, 0, 0, 2, 0, 1, 0, 4, 0, 5, 0, 3, 0, 2, 0, 0, 0, 0, 0, 3, 0, 2, 0, 0, 2, 0, 0, 0, 4, '2015-11-15 12:37:11', '2015-12-29 10:32:36'),
(2, 207, 23, '2015-12-17', 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 3, 1, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 3, 2, 0, 0, 0, 0, '2015-12-10 13:49:30', '2015-12-16 10:06:01'),
(5, 206, 0, '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2015-12-16 13:42:34', '0000-00-00 00:00:00'),
(6, 208, 3, '2015-12-22', 2, 0, 3, 0, 4, 0, 5, 0, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 3, 4, 5, '2015-12-21 12:55:11', '2015-12-22 11:07:04');

-- --------------------------------------------------------

--
-- Table structure for table `skills_map_update`
--

CREATE TABLE IF NOT EXISTS `skills_map_update` (
  `id` int(10) unsigned NOT NULL,
  `uid` int(10) NOT NULL,
  `vbox` int(2) NOT NULL,
  `vbox_date` date NOT NULL,
  `alcatel` int(2) NOT NULL,
  `alcatel_date` date NOT NULL,
  `avaya` int(2) NOT NULL,
  `avaya_date` date NOT NULL,
  `cisco` int(2) NOT NULL,
  `cisco_date` date NOT NULL,
  `sql_server` int(2) NOT NULL,
  `sql_date` date NOT NULL,
  `oracle` int(2) NOT NULL,
  `oracle_date` date NOT NULL,
  `altitude_routing` int(2) NOT NULL,
  `altitude_routing_date` date NOT NULL,
  `altitude_dialer` int(2) NOT NULL,
  `altitude_dialer_date` date NOT NULL,
  `altitude_voice` int(2) NOT NULL,
  `altitude_voice_date` date NOT NULL,
  `altitude_email` int(2) NOT NULL,
  `altitude_email_date` date NOT NULL,
  `altitude_chat` int(2) NOT NULL,
  `altitude_chat_date` date NOT NULL,
  `social` int(2) NOT NULL,
  `social_date` date NOT NULL,
  `altitude_desktop` int(2) NOT NULL,
  `altitude_desktop_date` date NOT NULL,
  `altitude_ivr` int(2) NOT NULL,
  `altitude_ivr_date` date NOT NULL,
  `altitude_express_routing` int(2) NOT NULL,
  `altitude_express_routing_date` date NOT NULL,
  `altitude_integration` int(2) NOT NULL,
  `altitude_integration_date` date NOT NULL,
  `altitude_workflow` int(2) NOT NULL,
  `altitude_workflow_date` date NOT NULL,
  `uci_installation` int(2) NOT NULL,
  `uci_installation_date` date NOT NULL,
  `uci_patch` int(2) NOT NULL,
  `uci_patch_date` date NOT NULL,
  `sap` int(2) NOT NULL,
  `sap_date` date NOT NULL,
  `siebel` int(2) NOT NULL,
  `siebel_date` date NOT NULL,
  `ms_crm` int(2) NOT NULL,
  `ms_crm_date` date NOT NULL,
  `teleopti` int(2) NOT NULL,
  `teleopti_date` date NOT NULL,
  `supervisor` int(2) NOT NULL,
  `supervisor_date` date NOT NULL,
  `administrator` int(2) NOT NULL,
  `administrator_date` date NOT NULL,
  `developer` int(2) NOT NULL,
  `developer_date` date NOT NULL,
  `communication` int(2) NOT NULL,
  `communication_date` date NOT NULL,
  `commitment` int(2) NOT NULL,
  `commitment_date` date NOT NULL,
  `analysis` int(2) NOT NULL,
  `analysis_date` date NOT NULL,
  `quality_of_delivery` int(2) NOT NULL,
  `quality_of_delivery_date` date NOT NULL,
  `productivity` int(2) NOT NULL,
  `productivity_date` date NOT NULL,
  `fixing` int(2) NOT NULL,
  `fixing_date` date NOT NULL,
  `presentability` int(2) NOT NULL,
  `presentability_date` date NOT NULL,
  `recommendation` int(2) NOT NULL,
  `recommendation_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills_map_update`
--

INSERT INTO `skills_map_update` (`id`, `uid`, `vbox`, `vbox_date`, `alcatel`, `alcatel_date`, `avaya`, `avaya_date`, `cisco`, `cisco_date`, `sql_server`, `sql_date`, `oracle`, `oracle_date`, `altitude_routing`, `altitude_routing_date`, `altitude_dialer`, `altitude_dialer_date`, `altitude_voice`, `altitude_voice_date`, `altitude_email`, `altitude_email_date`, `altitude_chat`, `altitude_chat_date`, `social`, `social_date`, `altitude_desktop`, `altitude_desktop_date`, `altitude_ivr`, `altitude_ivr_date`, `altitude_express_routing`, `altitude_express_routing_date`, `altitude_integration`, `altitude_integration_date`, `altitude_workflow`, `altitude_workflow_date`, `uci_installation`, `uci_installation_date`, `uci_patch`, `uci_patch_date`, `sap`, `sap_date`, `siebel`, `siebel_date`, `ms_crm`, `ms_crm_date`, `teleopti`, `teleopti_date`, `supervisor`, `supervisor_date`, `administrator`, `administrator_date`, `developer`, `developer_date`, `communication`, `communication_date`, `commitment`, `commitment_date`, `analysis`, `analysis_date`, `quality_of_delivery`, `quality_of_delivery_date`, `productivity`, `productivity_date`, `fixing`, `fixing_date`, `presentability`, `presentability_date`, `recommendation`, `recommendation_date`, `created_at`, `updated_at`) VALUES
(1, 208, 1, '2015-12-22', 2, '2015-12-22', 4, '2015-12-22', 5, '2015-12-22', 5, '2015-12-22', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '2015-12-22', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '2015-12-22', 0, '0000-00-00', 0, '0000-00-00', 0, '2015-12-22', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 2, '2015-12-22', 3, '2015-12-22', 4, '2015-12-22', 5, '2015-12-22', '2015-12-21 12:55:11', '2015-12-22 11:07:04'),
(2, 198, 4, '2015-12-23', 5, '2015-12-23', 3, '2015-12-23', 0, '2015-12-29', 2, '2015-12-22', 3, '2015-12-22', 2, '2015-12-27', 0, '0000-00-00', 3, '2015-12-27', 0, '0000-00-00', 0, '0000-00-00', 2, '2015-12-22', 3, '2015-12-22', 0, '0000-00-00', 0, '0000-00-00', 2, '2015-12-22', 0, '0000-00-00', 2, '2015-12-22', 1, '2015-12-27', 4, '2015-12-29', 5, '2015-12-22', 3, '2015-12-22', 2, '2015-12-22', 0, '0000-00-00', 0, '0000-00-00', 3, '2015-12-27', 2, '2015-12-22', 0, '0000-00-00', 0, '0000-00-00', 2, '2015-12-22', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 4, '2015-12-22', '2015-12-21 12:55:11', '2015-12-29 10:32:36'),
(3, 207, 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '2015-12-21 12:55:11', '0000-00-00 00:00:00'),
(4, 206, 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '2015-12-21 12:55:11', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_registration`
--

INSERT INTO `temp_registration` (`id`, `first_name`, `last_name`, `company`, `contact_number`, `email`, `course`, `attendance_status`, `remarks`, `reference`, `amount`, `discount`, `proposal_status_sent`, `po_date_sent`, `proposal_status_received`, `po_date_received`, `invoice`, `invoice_date_sent`, `payment_status`, `cash_received`, `profiling`, `confirmed_date`, `change_status`, `created_at`, `updated_at`) VALUES
(2, 'Mohamed', 'Salem', 'AUB', '97339328506', 'mohamed.salem@ahliunited.com', 'Technical Administration', 'Confirmed', '', 'POP', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '01 - 05 NOVEMBER 2015', 'Confirmed', '2015-10-12 19:25:19', '2015-11-04 07:23:42'),
(3, 'Sujatha ', 'Shivappala', 'AUB', '00-973-17585733', 'sujatha.shivappala@ahliunited.com', 'Technical Administration', 'Confirmed', '', 'POP', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 1, '01 - 05 NOVEMBER 2015', '', '2015-10-12 19:43:26', '2015-10-21 23:13:29'),
(5, 'Nishant ', 'Pawar', 'CRM me', '+971553969963 ', 'nishant@crm-me.ae', 'Script Development', 'Confirmed', '', 'POP', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 1, '08 - 12 NOVEMBER 2015', '', '2015-10-12 20:35:03', '2015-10-28 19:37:25'),
(7, 'Joe', 'Koueik', 'Transmed KSA', '+966507484658 ', 'joe.koueik@transmed.com', 'Technical Administration', 'Confirmed', '', 'with PO', 2500, 10, 'Sent', '2015-10-12', 'Received', '2015-10-15', 'Sent', '2015-10-18', 'Full', 2250, 0, '01 - 05 NOVEMBER 2015', '', '2015-10-12 20:48:39', '2015-10-28 21:48:18'),
(8, 'Edrian ', 'Tomoro ', 'Nestle Waters Factory ', '0551084404 ', 'edrian.tomoro@ap.nestle-waters.com', 'Technical Administration', 'New', '', 'with PO', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '01 - 05 NOVEMBER 2015', '', '2015-10-12 21:20:40', '0000-00-00 00:00:00'),
(9, 'Edrian ', 'Tomoro ', 'Nestle Waters Factory ', '0551084404 ', 'edrian.tomoro@ap.nestle-waters.com', 'Script Development', 'New', '', 'with PO', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '08 - 12 NOVEMBER 2015', '', '2015-10-12 21:20:40', '0000-00-00 00:00:00'),
(10, 'Vipin ', 'Thulaseedharan ', 'Nestle Waters ', '+971551084406 ', 'vipin.thulaseedharan@ap.nestle-waters.com', 'Technical Administration', 'New', '', 'with PO', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '01 - 05 NOVEMBER 2015', '', '2015-10-12 21:22:32', '0000-00-00 00:00:00'),
(11, 'Darshana Priyanjan ', 'Bamunuarachchi ', 'Al Rostamani Communications LLC ', '00971557050275 ', 'darshana.bamunuarachchi@alrostamanigroup.ae', 'Technical Administration', 'Invoice Sent', '', 'with PO', 2500, 50, 'Not sent', '0000-00-00', 'Received', '2015-10-18', 'Sent', '2015-10-20', 'Not received', 0, 0, '01 - 05 NOVEMBER 2015', '', '2015-10-12 21:25:38', '2015-10-21 23:16:48'),
(12, 'Darshana Priyanjan ', 'Bamunuarachchi ', 'Al Rostamani Communications LLC ', '00971557050275 ', 'darshana.bamunuarachchi@alrostamanigroup.ae', 'Script Development', 'New', '', 'with PO', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '08 - 12 NOVEMBER 2015', '', '2015-10-12 21:25:38', '0000-00-00 00:00:00'),
(13, 'Alok ', 'Kumar ', 'Al Rostamani Comminication ', '+971-554400860 ', 'alok.kumar@alrostamanigroup.ae', 'Technical Administration', 'Invoice Sent', '', 'with PO', 2500, 50, 'Sent', '0000-00-00', 'Received', '2015-10-18', 'Sent', '2015-10-20', 'Not received', 0, 1, '01 - 05 NOVEMBER 2015', '', '2015-10-12 21:28:12', '2015-10-28 21:13:46'),
(14, 'Alok ', 'Kumar ', 'Al Rostamani Comminication ', '+971-554400860 ', 'alok.kumar@alrostamanigroup.ae', 'Script Development', 'New', '', 'with PO', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0, '08 - 12 NOVEMBER 2015', '', '2015-10-12 21:28:12', '0000-00-00 00:00:00'),
(16, 'Fardin', 'Mavad', 'ETISALAT', '+971 56 741 375', 'fmavad@etisalat.ae', 'Technical Administration', 'Confirmed', 'POP', 'POP', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 1, '01 - 05 NOVEMBER 2015', '', '2015-10-21 23:19:50', '2015-10-21 23:27:33'),
(17, 'Rashid ', 'Abdul Rasheed ', 'SNTTA', '00971506329215 ', 'rashid@sntta.ae', 'Technical Administration', 'Proposal Received', '', 'with PO', 2500, 60, 'Sent', '2015-10-27', 'Received', '2015-10-28', 'Not sent', '0000-00-00', 'Not received', 0, 0, '01 - 05 NOVEMBER 2015', '', '2015-10-28 19:34:02', '2015-10-28 19:43:07'),
(18, 'Fashan ', 'Amanullah ', 'SNTTA', '0504629724 ', 'fashan.a@snttadubai.com', 'Technical Administration', 'Proposal Received', '', 'with PO', 2500, 60, 'Sent', '2015-10-27', 'Received', '2015-10-28', 'Not sent', '0000-00-00', 'Not received', 0, 1, '01 - 05 NOVEMBER 2015', '', '2015-10-28 19:35:24', '2015-10-28 19:41:08'),
(19, 'Shanavas', 'Ayyanoth', 'CRM ME', '+971 55 458 177', 'shanavas@crm-me.ae', 'Technical Administration', 'Confirmed', '', 'POP', 0, 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 1, '01 - 05 NOVEMBER 2015', '', '2015-10-28 19:36:58', '2015-10-28 19:38:47');

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
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `primary_email_address`, `secondary_email`, `company`, `position`, `contact_number`, `profile_pic`, `user_type`, `status`, `skills_map`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$z8H2My16KfqpZYJ22mwkd.CqPg61RFZcw1.RYhtys0Mky6xzmFnX6', 'Admin', 'A.', 'Altitude', 'joseph.semana@bluemena.com', '', '', '', '', '', 1, 1, 0, 'v9gtsszrg1G4kQOI5jOxwTiFM6hiThAVAuDPu21ubJvQpCUecJlsm23uUCMi', '2014-09-06 11:07:08', '2015-12-30 11:16:16'),
(2, 'asemana', '$2y$10$z8H2My16KfqpZYJ22mwkd.CqPg61RFZcw1.RYhtys0Mky6xzmFnX6', 'AJ', 'Lascano', 'Semana', 'ajlsemana@gmail.com', '', 'Blue Mena Groups', 'Customer Development Director', '', '', 2, 1, 0, 'xHgruUAhYqLRVDpciRF9mgyqkGJ6rweOqVOc3SGM6C67jPu1DCAUgdKZY6TJ', '2014-11-12 23:29:35', '2015-12-29 06:40:25'),
(191, 'mich', '$2y$10$z8H2My16KfqpZYJ22mwkd.CqPg61RFZcw1.RYhtys0Mky6xzmFnX6', 'Michelle', '', 'Rodriguez', 'michelle.rodriguez@bluemena.com', '', 'Blue Mena Group', 'Customer Development Director', '', '', 1, 1, 0, 'hagQWHMTvOxWwmmmy3sNzsPGuUg4nLcK7bPVw5gbjZ4Oui5hfJ5faOJduBnv', '2015-10-12 07:00:00', '2015-10-29 19:25:31'),
(192, 'ahmer', '$2y$10$z8H2My16KfqpZYJ22mwkd.CqPg61RFZcw1.RYhtys0Mky6xzmFnX6', 'Ahmer', '', 'Jalal', 'ahmer.jalal@bluemena.com', '', 'Blue Mena Group', 'Customer Development Director', '', '', 1, 1, 0, 'vDfSJLDMgO3iFTladIMB5Rm46AmW7bASDP8JT3iMwV2OKOusOwgrytyhRI3S', '2015-10-12 19:42:00', '2015-12-10 12:25:23'),
(193, 'ayman', '$2y$10$z8H2My16KfqpZYJ22mwkd.CqPg61RFZcw1.RYhtys0Mky6xzmFnX6', 'Ayman', '', 'Soliman', 'ayman@bluemena.com', '', 'Blue Mena Group', 'Customer Development Director', '', '', 1, 1, 0, 'XrtY8wVEoF9KlwhRX0DLygV4dyKf7MbyZg3oqWpfb2zxpOeiCUx9kiFrJrR2', '2015-10-12 19:42:00', '2015-10-14 00:30:57'),
(194, 'rbk', '$2y$10$z8H2My16KfqpZYJ22mwkd.CqPg61RFZcw1.RYhtys0Mky6xzmFnX6', 'Riadh', '', 'Boukhris', 'riahd@bluemena.com', '', 'Blue Mena Group', 'Customer Development Director', '', '', 1, 1, 0, 'uWpbsDou7BzSYsY9TUQNnoFsziFsd6txG5WNtRLOdxNbvmnBcFmEmbJGddwq', '2015-10-12 19:42:00', '2015-10-19 22:24:03'),
(197, 'res', '$2y$10$mM.GKSg384eY67e7VCA6.elaix/I9jglfxtmP7Q8sxMTntzVzMKx.', 'John', '', 'Smith', 'res@gmail.com', 'resource@yahoo.com', '3', 'Customer Development Director', '', '', 5, 1, 0, 'pKCtTdU9BEFMlQPT7u2WGcnNsaZUlG9igGVL7JKxnwfkvnU5WmfzZ3JggvCO', '2015-11-15 12:16:56', '2015-12-31 07:53:30'),
(198, 'eng', '$2y$10$z8H2My16KfqpZYJ22mwkd.CqPg61RFZcw1.RYhtys0Mky6xzmFnX6', 'Ayman', 'X.', 'Soliman', 'ajlsemana23@gmail.com', 'aiman_semana23@yahoo.com', '3', 'Customer Development Director', '', '198.jpg', 3, 1, 1, 'CcjlPtdtrB80815mpcBEZYB0WO6xIt37GoH4Pkyqnwg9JqxPYHAYeDznJnqz', '2015-11-24 12:37:11', '2015-12-28 13:45:12'),
(200, 'newby', '$2y$10$z8H2My16KfqpZYJ22mwkd.CqPg61RFZcw1.RYhtys0Mky6xzmFnX6', 'John', '', 'Smith', 'smith@gmail.com', 'smith_mith@yahoo.com', 'AS Mena', 'Customer Development Director', '0565492779', '', 3, 1, 0, 'XjARnLcRK0h9lY8SSCHycAFbmxzijzaec6pTi7TEk4QxgXw56uZOaKO1iyc0', '2015-11-24 04:23:25', '2015-12-10 13:34:22'),
(201, 'tesda', '$2y$10$FIWYjEjbMhYvJSKaPcGpaOd29gESAGWz9gkWk/k6rprSVoxLpGjT.', 'Peter', '', 'Pan', 'peter_pan@gmail.com', '', 'Cloudypedia', 'Customer Development Director', '+55151611515', '', 3, 1, 0, NULL, '2015-11-29 04:00:04', '2015-11-26 04:26:04'),
(202, 'ajls', '$2y$10$3eCr4JVDCwrmXC3sCqb9F.lM9s4TFqUSPaGzTRHdotP.nJ12ijoFS', 'AJ', 'Lascano', 'Semana', 'joseph.semana@bluemena.com', 'aiman@yahoo.com', 'Blue Mena Group Dubai, UAE', 'Customer Development Director', '+9715655492779', '', 3, 1, 0, 'KfyWY4HU7q5KPXT1XRM5Yza3U7H7XGqq4Vnq1ZVkxIMt0yfYVUrk8Tivkwa0', '2015-11-29 04:22:06', '2015-12-30 12:23:39'),
(203, 'trainer', '$2y$10$FAOwSdcd5WLeYrGrf.fDq.2C7n4F30GPSSgq/ORFM4pv4K0EEgRSS', 'John', '', 'Smith', 'smith@yahoo.com', '', 'AS Mena', 'Customer Development Director', '', '', 2, 1, 0, NULL, '2015-12-08 09:39:35', '2015-12-08 09:39:35'),
(206, 'haha', '$2y$10$9HMzuJesntv134V//JcU8O8B0ln/oX03F0dtb4raOOl1iT86/IJMy', 'hehe', '', 'hihi', 'haha@yahoo.com', '', '1', 'Customer Development Director', '', '', 3, 1, 1, NULL, '2015-12-10 13:12:53', '2015-12-16 13:42:34'),
(207, 'qwerty', '$2y$10$CcUycu9t/Nm3x9ddf1w/quEEZSLzyqv8pXsy2fD4yHzCstihKksLO', 'qwert', '', 'jdhshfds', 'aj@test.com', '', '1', 'Customer Development Director', '', '', 3, 1, 1, NULL, '2015-12-10 13:49:30', '2015-12-10 13:49:30'),
(208, 'engr', '$2y$10$1.IuQWL4C9dAHkHIEtVMje98Qhs2BlRxE..LhAO0INatfPiI0nn.e', 'Rody', '', 'Duterte', 'roa@gmail.com', '', '3', 'Network Engineer', '', '', 3, 1, 1, NULL, '2015-12-21 12:55:11', '2015-12-21 12:55:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
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
-- Indexes for table `temp_registration`
--
ALTER TABLE `temp_registration`
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
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `class_students`
--
ALTER TABLE `class_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `course_agenda`
--
ALTER TABLE `course_agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `lecture_post_message`
--
ALTER TABLE `lecture_post_message`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `lecture_upload`
--
ALTER TABLE `lecture_upload`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lecture_wall_threads`
--
ALTER TABLE `lecture_wall_threads`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `profit_loss`
--
ALTER TABLE `profit_loss`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `quizzes_items`
--
ALTER TABLE `quizzes_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=123;
--
-- AUTO_INCREMENT for table `quizzes_students`
--
ALTER TABLE `quizzes_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `quizzes_students_items`
--
ALTER TABLE `quizzes_students_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `registrants`
--
ALTER TABLE `registrants`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `skills_map`
--
ALTER TABLE `skills_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `skills_map_update`
--
ALTER TABLE `skills_map_update`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `temp_registration`
--
ALTER TABLE `temp_registration`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=209;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
