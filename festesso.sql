-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost

-- Server version: 5.5.38
-- PHP Version: 5.3.10-1ubuntu3.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `festesso`
--

-- --------------------------------------------------------

--
-- Table structure for table `event_master`
--

CREATE TABLE IF NOT EXISTS `event_master` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(256) NOT NULL,
  `event_desp` varchar(5000) NOT NULL,
  `min_part` int(11) NOT NULL,
  `max_part` int(11) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `event_master`
--


-- --------------------------------------------------------

--
-- Table structure for table `info_register`
--

CREATE TABLE IF NOT EXISTS `info_register` (
  `info_id` int(11) NOT NULL AUTO_INCREMENT,
  `info_event_id` int(11) NOT NULL,
  `info_reg_id` int(11) NOT NULL,
  `info_username` varchar(60) NOT NULL,
  `info_email` varchar(60) NOT NULL,
  `info_contact` varchar(20) NOT NULL,
  PRIMARY KEY (`info_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `info_register`
--



-- --------------------------------------------------------

--
-- Table structure for table `register_event`
--

CREATE TABLE IF NOT EXISTS `register_event` (
  `reg_id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_event_id` int(11) NOT NULL,
  `reg_user_id` int(11) NOT NULL,
  `college_name` varchar(256) NOT NULL,
  `team_name` varchar(128) NOT NULL,
  PRIMARY KEY (`reg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `register_event`
--



-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `iduser_details` int(11) NOT NULL AUTO_INCREMENT,
  `user_master_iduser_details` int(11) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `dob` varchar(40) NOT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `college_name` varchar(100) NOT NULL,
  `image_name` varchar(50) DEFAULT NULL,
  `image_thumb` varchar(50) DEFAULT NULL,
  `image_path` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`iduser_details`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `user_details`
--



-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE IF NOT EXISTS `user_master` (
  `iduser_master` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(60) DEFAULT NULL,
  `user_password` varchar(60) DEFAULT NULL,
  `user_fb_id` int(20) DEFAULT NULL,
  `verification_key` varchar(32) DEFAULT NULL,
  `account_verified` int(1) NOT NULL DEFAULT '0',
  `password_verification_key` varchar(32) DEFAULT NULL,
  `login_type` int(1) NOT NULL,
  `user_last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`iduser_master`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `user_master`
--



-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `id_user_roles` int(11) NOT NULL AUTO_INCREMENT,
  `user_master_iduser_roles` int(11) NOT NULL,
  `user_role` int(11) NOT NULL,
  PRIMARY KEY (`id_user_roles`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_roles`
--



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
