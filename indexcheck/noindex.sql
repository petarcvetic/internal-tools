-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2018 at 12:54 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `noindex`
--

-- --------------------------------------------------------

--
-- Table structure for table `live_sites`
--

CREATE TABLE IF NOT EXISTS `live_sites` (
  `live_id` int(5) NOT NULL AUTO_INCREMENT,
  `live_url` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`live_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `live_sites`
--

INSERT INTO `live_sites` (`live_id`, `live_url`, `status`) VALUES
(1, 'https://www.wellaway.com', 1),
(2, 'http://accordbusinesscoaching.com/', 1),
(3, 'https://www.americordblood.com/', 1),
(4, 'https://www.ampfloracel.com/', 1),
(5, 'https://arizonalandpartners.com/', 1),
(6, 'https://www.az420card.com/', 1),
(7, 'https://www.badhabitstattoos.com/', 1),
(8, 'https://boqueriarestaurant.com/', 1),
(9, 'https://bruceturkel.com/', 1),
(10, 'https://burgermeistermia.com/', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stage_sites`
--

CREATE TABLE IF NOT EXISTS `stage_sites` (
  `stage_id` int(5) NOT NULL AUTO_INCREMENT,
  `stage_url` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`stage_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `stage_sites`
--

INSERT INTO `stage_sites` (`stage_id`, `stage_url`, `status`) VALUES
(1, 'http://wellawaystage.wpengine.com', 1),
(2, 'http://accordbusiness.staging.wpengine.com/', 1),
(3, 'https://americordblood.wpengine.com/', 1),
(4, 'http://ampfloracel.staging.wpengine.com/', 1),
(5, 'http://arizonalandpar.staging.wpengine.com/', 1),
(6, 'http://az420card.staging.wpengine.com/', 1),
(7, 'http://bhabitstattoo.staging.wpengine.com/', 1),
(8, 'http://boqueria.staging.wpengine.com/', 1),
(9, 'http://bruceturkel.staging.wpengine.com/', 1),
(10, 'https://phoenixtowingservice.com/', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
