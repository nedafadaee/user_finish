-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2016 at 11:17 AM
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
(3, 3091, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(4, 3090, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(5, 3089, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(6, 3077, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(7, 3087, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(8, 3079, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(9, 3080, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(10, 3081, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(11, 3082, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(12, 3083, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(13, 3084, '2016-10-23 08:54:52', 0, 0, 0, '2016-10-23 08:54:52', 0, 0, '2016-10-23 08:54:52'),
(14, 3092, '2016-10-23 08:54:53', 0, 0, 0, '2016-10-23 08:54:53', 0, 0, '2016-10-23 08:54:53'),
(15, 3093, '2016-10-23 08:54:53', 0, 0, 0, '2016-10-23 08:54:53', 0, 0, '2016-10-23 08:54:53'),
(16, 3094, '2016-10-23 08:54:53', 0, 0, 0, '2016-10-23 08:54:53', 0, 0, '2016-10-23 08:54:53'),
(17, 3095, '2016-10-23 08:54:53', 0, 0, 0, '2016-10-23 08:54:53', 0, 0, '2016-10-23 08:54:53'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`id`, `user_id`, `gender`, `stateid`, `cityid`, `regionid`, `address`, `creationdate`) VALUES
(1, 3095, 'men', 5, 23, 238, 'تهران ، صادقیه', '0000-00-00 00:00:00'),
(2, 3096, 'men', 2, 22, 234, 'tehran', '2016-10-23 06:33:22');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
