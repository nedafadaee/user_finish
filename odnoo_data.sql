-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2016 at 10:53 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `odnoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl_all_components`
--

CREATE TABLE IF NOT EXISTS `acl_all_components` (
  `component_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `component_name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `component_name_fa` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`component_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `acl_all_components`
--

INSERT INTO `acl_all_components` (`component_id`, `component_name`, `component_name_fa`) VALUES
(1, 'user', 'کاربران'),
(2, 'files', 'فایل ها ');

-- --------------------------------------------------------

--
-- Table structure for table `acl_role`
--

CREATE TABLE IF NOT EXISTS `acl_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `description` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_by` int(11) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `acl_role`
--

INSERT INTO `acl_role` (`role_id`, `name`, `description`, `creation_date`, `create_by`) VALUES
(1, 'مدیریت کاربران', '', '2016-10-06 05:59:24', 0),
(3, 'ادمین', '', '2016-10-08 12:03:21', 0),
(12, 'ثبت نام کرده ها', '', '2016-10-18 06:24:15', 0),
(14, 'تست نقش کاربری', '', '2016-10-27 07:03:35', 0);

-- --------------------------------------------------------

--
-- Table structure for table `acl_role_action`
--

CREATE TABLE IF NOT EXISTS `acl_role_action` (
  `role_action_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `action_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`role_action_id`),
  KEY `idx_acl_role_action` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=77 ;

--
-- Dumping data for table `acl_role_action`
--

INSERT INTO `acl_role_action` (`role_action_id`, `role_id`, `action_id`, `creation_date`) VALUES
(30, 14, 10, '2016-10-27 07:12:28'),
(31, 14, 11, '2016-10-27 07:12:28'),
(32, 14, 14, '2016-10-27 07:12:29'),
(62, 3, 10, '2016-10-29 06:33:01'),
(63, 3, 11, '2016-10-29 06:33:01'),
(64, 3, 14, '2016-10-29 06:33:01'),
(65, 3, 18, '2016-10-29 06:33:01'),
(66, 3, 20, '2016-10-29 06:33:01'),
(67, 3, 24, '2016-10-29 06:33:01'),
(68, 3, 26, '2016-10-29 06:33:01'),
(69, 3, 27, '2016-10-29 06:33:01'),
(70, 3, 28, '2016-10-29 06:33:01'),
(71, 3, 30, '2016-10-29 06:33:01'),
(72, 3, 33, '2016-10-29 06:33:01'),
(73, 3, 35, '2016-10-29 06:33:01'),
(74, 3, 36, '2016-10-29 06:33:01'),
(75, 3, 37, '2016-10-29 06:33:01'),
(76, 3, 39, '2016-10-29 06:33:01');

-- --------------------------------------------------------

--
-- Table structure for table `acl_role_action_list`
--

CREATE TABLE IF NOT EXISTS `acl_role_action_list` (
  `action_id` int(11) NOT NULL AUTO_INCREMENT,
  `action_name` varchar(150) COLLATE utf8_persian_ci NOT NULL,
  `description` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `component_id` int(11) NOT NULL,
  `action_name_fa` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`action_id`),
  UNIQUE KEY `action_name` (`action_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=41 ;

--
-- Dumping data for table `acl_role_action_list`
--

INSERT INTO `acl_role_action_list` (`action_id`, `action_name`, `description`, `component_id`, `action_name_fa`) VALUES
(10, 'user_view', '', 1, 'مشاهده کاربران'),
(11, 'user_edit', '', 1, 'ویرایش کاربران'),
(14, 'user_new', '', 1, 'ثبت کاربر جدید'),
(18, 'user_view_action', '', 1, 'مشاهده فعالیت های سایت'),
(20, 'user_new_roletoaction', '', 1, 'اختصاص  کاربر به نقش'),
(24, 'user_new_roletogroup', '', 1, 'اختصاص گروه کاربری به نقش'),
(26, 'user_view_roll', '', 1, 'مشاهده نقش'),
(27, 'user_new_roll', '', 1, 'ثبت نقش جدید'),
(28, 'user_edit_roll', '', 1, 'ویرایش نقش '),
(30, 'user_new_setrole', '', 1, 'اختصاص کاربر به نقش'),
(33, 'user_new_setusergroup', '', 1, 'اختصاص کاربر به گروه کاربری'),
(35, 'user_view_usergroup', '', 1, 'مشاهده گروه کاربری'),
(36, 'user_new_usergroup', '', 1, 'ثبت گروه کاربری جدید'),
(37, 'user_edit_usergroup', '', 1, 'ویرایش گروه کاربری'),
(39, 'user_view_search', '', 1, 'سرچ پیشرفته کاربران'),
(40, 'user_view_roletoaction', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `acl_role_group`
--

CREATE TABLE IF NOT EXISTS `acl_role_group` (
  `role_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `creation_by` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`role_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `acl_role_group`
--

INSERT INTO `acl_role_group` (`role_group_id`, `group_name`, `role_id`, `creation_by`, `creation_date`, `group_id`) VALUES
(2, 'مدیر کل', 3, 0, '2016-10-08 07:08:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `acl_user_log`
--

CREATE TABLE IF NOT EXISTS `acl_user_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `action_id` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `access_status` int(11) NOT NULL,
  `message` text COLLATE utf8_persian_ci NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=113 ;

--
-- Dumping data for table `acl_user_log`
--

INSERT INTO `acl_user_log` (`log_id`, `user_id`, `action_id`, `access_status`, `message`, `create_at`) VALUES
(1, 6, 'user_view', 1, '', '2016-10-29 06:15:32'),
(2, 6, 'user_view_roll', 1, '', '2016-10-29 06:16:54'),
(3, 6, 'user_new_setrole', 1, '', '2016-10-29 06:17:03'),
(4, 6, 'user_new_setrole', 1, '', '2016-10-29 06:17:10'),
(5, 6, 'user_view_roll', 1, '', '2016-10-29 06:17:11'),
(6, 6, 'user_new_setrole', 1, '', '2016-10-29 06:17:15'),
(7, 6, 'user_new_setrole', 1, '', '2016-10-29 06:17:53'),
(8, 6, 'user_view_roll', 0, '', '2016-10-29 06:17:53'),
(9, 6, 'user_new_setrole', 0, '', '2016-10-29 06:18:01'),
(10, 6, 'user_view_roll', 0, '', '2016-10-29 06:18:04'),
(11, 6, 'user_view_roll', 0, '', '2016-10-29 06:18:07'),
(12, 6, 'user_new_setrole', 1, '', '2016-10-29 06:18:32'),
(13, 6, 'user_new_setrole', 1, '', '2016-10-29 06:18:39'),
(14, 6, 'user_view_roll', 0, '', '2016-10-29 06:18:40'),
(15, 6, 'user_new_setrole', 1, '', '2016-10-29 06:19:12'),
(16, 6, 'user_new_setrole', 1, '', '2016-10-29 06:21:55'),
(17, 6, 'user_view', 1, '', '2016-10-29 06:31:16'),
(18, 6, 'user_view', 1, '', '2016-10-29 06:32:34'),
(19, 6, 'user_view_search', 0, '', '2016-10-29 06:32:37'),
(20, 6, 'user_view', 1, '', '2016-10-29 06:32:39'),
(21, 6, 'user_view_roll', 1, '', '2016-10-29 06:32:45'),
(22, 6, 'user_new_setrole', 1, '', '2016-10-29 06:32:50'),
(23, 6, 'user_new_roletoaction', 1, '', '2016-10-29 06:32:55'),
(24, 6, 'user_new_roletoaction', 1, '', '2016-10-29 06:33:01'),
(25, 6, 'user_view_roll', 1, '', '2016-10-29 06:33:02'),
(26, 6, 'user_view', 1, '', '2016-10-29 06:33:07'),
(27, 6, 'user_view_search', 1, '', '2016-10-29 06:33:10'),
(28, 6, 'user_view_search', 1, '', '2016-10-29 06:33:29'),
(29, 6, 'user_view_search', 1, '', '2016-10-29 06:34:53'),
(30, 6, 'user_view_search', 1, '', '2016-10-29 06:36:25'),
(31, 6, 'user_view_search', 1, '', '2016-10-29 06:36:40'),
(32, 6, 'user_view_search', 1, '', '2016-10-29 06:37:12'),
(33, 6, 'user_view_search', 1, '', '2016-10-29 06:37:24'),
(34, 6, 'user_view_search', 1, '', '2016-10-29 06:37:38'),
(35, 6, 'user_view_search', 1, '', '2016-10-29 06:37:57'),
(36, 6, 'user_view_search', 1, '', '2016-10-29 07:00:31'),
(37, 6, 'user_view_search', 1, '', '2016-10-29 07:01:04'),
(38, 6, 'user_view_search', 1, '', '2016-10-29 07:01:15'),
(39, 6, 'user_view_search', 1, '', '2016-10-29 07:02:03'),
(40, 6, 'user_view_search', 1, '', '2016-10-29 07:02:33'),
(41, 6, 'user_view_search', 1, '', '2016-10-29 07:03:37'),
(42, 6, 'user_view_search', 1, '', '2016-10-29 07:04:56'),
(43, 6, 'user_view_search', 1, '', '2016-10-29 07:06:01'),
(44, 6, 'user_view', 1, '', '2016-10-29 07:06:42'),
(45, 6, 'user_edit', 1, '', '2016-10-29 07:06:48'),
(46, 6, 'user_edit', 1, '', '2016-10-29 07:07:40'),
(47, 6, 'user_view_search', 1, '', '2016-10-29 07:07:44'),
(48, 6, 'user_edit', 1, '', '2016-10-29 07:07:47'),
(49, 6, 'user_view_search', 1, '', '2016-10-29 07:07:54'),
(50, 6, 'user_view', 1, '', '2016-10-29 07:07:58'),
(51, 3090, 'user_view_search', 0, '', '2016-10-29 07:08:20'),
(52, 3090, 'user_view_search', 0, '', '2016-10-29 07:08:24'),
(53, 3090, 'user_view', 0, '', '2016-10-29 07:08:39'),
(54, 3090, 'user_view', 0, '', '2016-10-29 07:08:54'),
(55, 6, 'user_view', 1, '', '2016-10-29 07:10:10'),
(56, 6, 'user_view_search', 1, '', '2016-10-29 07:10:16'),
(57, 6, 'user_view_search', 1, '', '2016-10-29 07:11:28'),
(58, 6, 'user_view_search', 1, '', '2016-10-29 07:12:12'),
(59, 6, 'user_view_search', 1, '', '2016-10-29 07:12:25'),
(60, 6, 'user_view_search', 1, '', '2016-10-29 07:13:02'),
(61, 6, 'user_view_search', 1, '', '2016-10-29 07:18:06'),
(62, 6, 'user_view_search', 1, '', '2016-10-29 07:18:11'),
(63, 6, 'user_view_search', 1, '', '2016-10-29 07:18:34'),
(64, 6, 'user_view_search', 1, '', '2016-10-29 07:19:45'),
(65, 6, 'user_view_search', 1, '', '2016-10-29 07:21:54'),
(66, 6, 'user_view_search', 1, '', '2016-10-29 07:22:48'),
(67, 6, 'user_view_search', 1, '', '2016-10-29 07:22:54'),
(68, 6, 'user_view_search', 1, '', '2016-10-29 07:23:42'),
(69, 6, 'user_view_search', 1, '', '2016-10-29 07:23:58'),
(70, 6, 'user_view_search', 1, '', '2016-10-29 07:24:14'),
(71, 6, 'user_view_search', 1, '', '2016-10-29 07:24:44'),
(72, 6, 'user_view_search', 1, '', '2016-10-29 07:25:29'),
(73, 6, 'user_view_search', 1, '', '2016-10-29 07:26:01'),
(74, 6, 'user_view_search', 1, '', '2016-10-29 07:26:10'),
(75, 6, 'user_view_search', 1, '', '2016-10-29 07:26:18'),
(76, 6, 'user_view_search', 1, '', '2016-10-29 07:26:25'),
(77, 6, 'user_view_search', 1, '', '2016-10-29 07:26:43'),
(78, 6, 'user_view_search', 1, '', '2016-10-29 07:27:18'),
(79, 6, 'user_view_search', 1, '', '2016-10-29 07:29:59'),
(80, 6, 'user_view_search', 1, '', '2016-10-29 07:30:08'),
(81, 6, 'user_view_search', 1, '', '2016-10-29 07:30:50'),
(82, 6, 'user_view_search', 1, '', '2016-10-29 07:31:09'),
(83, 6, 'user_view_search', 1, '', '2016-10-29 07:31:34'),
(84, 6, 'user_view_search', 1, '', '2016-10-29 07:32:01'),
(85, 6, 'user_view_search', 1, '', '2016-10-29 07:38:48'),
(86, 6, 'user_view_search', 1, '', '2016-10-29 07:39:23'),
(87, 6, 'user_view_search', 1, '', '2016-10-29 07:40:13'),
(88, 6, 'user_view_search', 1, '', '2016-10-29 07:55:33'),
(89, 6, 'user_view_search', 1, '', '2016-10-29 07:55:37'),
(90, 6, 'user_view_search', 1, '', '2016-10-29 07:55:46'),
(91, 6, 'user_view_search', 1, '', '2016-10-29 07:55:51'),
(92, 6, 'user_view_search', 1, '', '2016-10-29 07:56:47'),
(93, 6, 'user_view_search', 1, '', '2016-10-29 07:57:13'),
(94, 6, 'user_view_search', 1, '', '2016-10-29 07:57:45'),
(95, 6, 'user_view_search', 1, '', '2016-10-29 07:57:48'),
(96, 6, 'user_view_search', 1, '', '2016-10-29 07:58:15'),
(97, 6, 'user_view_search', 1, '', '2016-10-29 07:58:17'),
(98, 6, 'user_view_search', 1, '', '2016-10-29 07:58:23'),
(99, 6, 'user_view_search', 1, '', '2016-10-29 07:58:27'),
(100, 6, 'user_view_search', 1, '', '2016-10-29 07:58:32'),
(101, 6, 'user_view_search', 1, '', '2016-10-29 07:58:57'),
(102, 6, 'user_view_search', 1, '', '2016-10-29 07:59:03'),
(103, 6, 'user_view_search', 1, '', '2016-10-29 07:59:49'),
(104, 6, 'user_view_search', 1, '', '2016-10-29 07:59:51'),
(105, 6, 'user_view_search', 1, '', '2016-10-29 07:59:54'),
(106, 6, 'user_view_search', 1, '', '2016-10-29 07:59:56'),
(107, 6, 'user_view_search', 1, '', '2016-10-29 08:00:00'),
(108, 6, 'user_view_search', 1, '', '2016-10-29 08:31:27'),
(109, 6, 'user_view_search', 1, '', '2016-10-29 08:35:09'),
(110, 6, 'user_view_search', 1, '', '2016-10-29 08:35:15'),
(111, 6, 'user_view_search', 1, '', '2016-10-29 08:35:19'),
(112, 6, 'user_view_search', 1, '', '2016-10-29 08:35:28');

-- --------------------------------------------------------

--
-- Table structure for table `acl_user_role`
--

CREATE TABLE IF NOT EXISTS `acl_user_role` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_role_id`),
  KEY `idx_acl_user_role` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `acl_user_role`
--

INSERT INTO `acl_user_role` (`user_role_id`, `user_id`, `role_id`, `creation_date`) VALUES
(13, 2, 14, '2016-10-27 07:13:34'),
(20, 6, 3, '2016-10-29 06:18:51');

-- --------------------------------------------------------

--
-- Table structure for table `userhistory`
--

CREATE TABLE IF NOT EXISTS `userhistory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lastlogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isactive` int(1) NOT NULL,
  `lostpasswordcontrol` int(11) NOT NULL,
  `isdelete` int(1) NOT NULL,
  `startsesstion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `islogin` int(1) NOT NULL,
  `createby` int(11) NOT NULL,
  `creationdata` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `userhistory`
--

INSERT INTO `userhistory` (`id`, `user_id`, `lastlogin`, `isactive`, `lostpasswordcontrol`, `isdelete`, `startsesstion`, `islogin`, `createby`, `creationdata`) VALUES
(1, 3096, '2016-10-23 07:40:52', 0, 0, 1, '2016-10-23 07:40:52', 0, 0, '2016-10-23 07:08:59'),
(2, 6, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(3, 3091, '2016-10-23 08:54:52', 0, 0, 1, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(4, 3090, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(5, 3089, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(6, 3077, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(7, 3087, '2016-10-23 08:54:52', 0, 0, 1, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(8, 3079, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(9, 3080, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(10, 3081, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(11, 3082, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(12, 3083, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(13, 3084, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(14, 3092, '2016-10-23 08:54:53', 0, 0, 1, '2016-10-23 08:54:53', 0, 0, '2016-10-23 08:54:53'),
(15, 3093, '2016-10-23 08:54:53', 0, 0, 1, '2016-10-23 08:54:53', 0, 0, '2016-10-23 08:54:53'),
(16, 3094, '2016-10-23 08:54:53', 0, 0, 1, '2016-10-23 08:54:53', 0, 0, '2016-10-23 08:54:53'),
(17, 3095, '2016-10-23 08:54:53', 0, 0, 1, '2016-10-23 08:54:53', 0, 0, '2016-10-23 08:54:53'),
(18, 3096, '2016-10-23 08:54:53', 0, 0, 1, '2016-10-23 08:54:53', 0, 0, '2016-10-23 08:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE IF NOT EXISTS `userprofile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `gender` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `stateid` int(5) NOT NULL,
  `cityid` int(5) NOT NULL,
  `regionid` int(5) NOT NULL,
  `address` text COLLATE utf8_persian_ci NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`id`, `user_id`, `gender`, `stateid`, `cityid`, `regionid`, `address`, `creationdate`) VALUES
(1, 3095, 'men', 5, 23, 238, 'تهران ، صادقیه', '0000-00-00 00:00:00'),
(2, 3096, 'men', 2, 22, 234, 'tehran', '2016-10-23 06:33:22'),
(3, 3089, 'جنسيت', 0, 0, 0, '', '2016-10-26 14:19:35'),
(4, 3097, 'men', 1, 1, 3, 'نارمک', '2016-10-27 06:41:27');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
  `group_description` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`group_id`, `group_name`, `group_description`, `creation_date`, `create_by`) VALUES
(1, 'مدیر کل', NULL, '2016-10-06 09:05:47', NULL),
(2, 'تست گروه کاربری', NULL, '2016-10-27 07:05:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_set_group`
--

CREATE TABLE IF NOT EXISTS `user_set_group` (
  `user_id` int(11) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(11) DEFAULT NULL,
  `set_group_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`set_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `user_set_group`
--

INSERT INTO `user_set_group` (`user_id`, `group_id`, `creation_date`, `create_by`, `set_group_id`) VALUES
(2, 2, '2016-10-27 07:22:32', NULL, 8),
(13, 1, '2016-10-29 06:13:57', NULL, 13);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acl_role_action`
--
ALTER TABLE `acl_role_action`
  ADD CONSTRAINT `fk_acl_role_action_0` FOREIGN KEY (`role_id`) REFERENCES `acl_role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
