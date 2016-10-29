-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2016 at 03:40 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=13 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=29 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=39 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=257 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_persian_ci NOT NULL,
  `UserType` varchar(150) COLLATE utf8_persian_ci NOT NULL DEFAULT 'User',
  `reg_time` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `last_visit` varchar(40) COLLATE utf8_persian_ci NOT NULL COMMENT 'last visit time',
  `login` int(11) NOT NULL DEFAULT '0',
  `manufacture` int(11) NOT NULL DEFAULT '0',
  `familly` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `city_id` int(50) NOT NULL,
  `phone` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `date_of_birthday` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `meli_card` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `erea_id` int(5) NOT NULL,
  `address` text COLLATE utf8_persian_ci NOT NULL,
  `number_account` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `number_card` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `bank` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `sarteam` int(10) NOT NULL,
  `sarparast` int(10) NOT NULL,
  `sarshakhe` int(10) NOT NULL,
  `sex` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `code_marketer` int(10) NOT NULL,
  `state` int(2) NOT NULL,
  `code_activate` int(20) NOT NULL,
  `activation` int(2) NOT NULL,
  `merried` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `fathers_name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `shenasname` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `business_id` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `first_visit` int(2) NOT NULL,
  `club_id` int(11) NOT NULL DEFAULT '4',
  `newslatter_city` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `newslatter_cat` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `postalcode` int(15) NOT NULL,
  `tell` int(20) NOT NULL,
  `prov_id` int(10) NOT NULL,
  `marketer` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=3097 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=3 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=2 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=7 ;

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
