-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 23, 2014 at 01:31 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `musicstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE IF NOT EXISTS `artists` (
  `artist_id` varchar(15) NOT NULL,
  `title` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`artist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`artist_id`, `title`, `type`, `photo`) VALUES
('ART000001', 'Eminem', 'male', NULL),
('ART000002', 'Rihanna', 'female', NULL),
('ART000003', 'Sai Sai Khan Hlaing', 'male', NULL),
('ART000004', 'Ni Ni Khin Zaw', 'female', NULL),
('ART000006', 'Adele', 'female', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `artists_songs`
--

CREATE TABLE IF NOT EXISTS `artists_songs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `artist_id` varchar(15) NOT NULL,
  `song_id` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `artists_songs`
--

INSERT INTO `artists_songs` (`id`, `artist_id`, `song_id`) VALUES
(8, 'ART000001', 'SNG000001'),
(9, 'ART000001', 'SNG000002'),
(10, 'ART000006', 'SNG000003'),
(11, 'ART000001', 'SNG000004'),
(12, 'ART000004', 'SNG000004'),
(13, 'ART000006', 'SNG000005'),
(14, 'ART000006', 'SNG000006');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `member_id` varchar(15) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `firstname`, `lastname`) VALUES
('MEM000001', 'a', 'a'),
('MEM000002', 'd', 'd'),
('MEM000003', 'c', 'c'),
('MEM000004', 'r', 'r');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` varchar(15) NOT NULL,
  `paymentdate` datetime NOT NULL,
  `order_id` varchar(15) NOT NULL,
  `cardno` varchar(30) NOT NULL,
  `cardtype` varchar(10) NOT NULL,
  `cardholdername` varchar(30) NOT NULL,
  `securitycode` varchar(5) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `paymentdate`, `order_id`, `cardno`, `cardtype`, `cardholdername`, `securitycode`) VALUES
('1291078532', '2014-02-10 23:44:23', '1268023798', 'a', 'mastercard', 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `purchasedetails`
--

CREATE TABLE IF NOT EXISTS `purchasedetails` (
  `purchase_id` varchar(15) NOT NULL,
  `song_id` varchar(15) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
  `purchase_id` varchar(15) NOT NULL,
  `purchasedate` datetime NOT NULL,
  `member_id` varchar(15) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE IF NOT EXISTS `songs` (
  `song_id` varchar(15) NOT NULL,
  `title` varchar(50) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `uploaded_date` datetime NOT NULL,
  `downloaded_count` int(11) unsigned NOT NULL,
  `streamed_count` int(11) unsigned NOT NULL,
  PRIMARY KEY (`song_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`song_id`, `title`, `filename`, `price`, `uploaded_date`, `downloaded_count`, `streamed_count`) VALUES
('SNG000001', 'sda', '13 Pyout Sone Yin Khwin.mp3', '32.00', '2014-01-25 12:24:53', 0, 0),
('SNG000002', 'df', '03 MinNaeNeePho.mp3', '3.00', '2014-01-25 10:55:52', 0, 0),
('SNG000003', 'asf', '13 Pyout Sone Yin Khwin.mp3', '3.00', '2014-01-25 10:57:06', 0, 0),
('SNG000004', 'rrrrrrrr', 'lay phyu (2).MP3', '32.00', '2014-01-25 22:03:38', 0, 0),
('SNG000005', 'asd', '', '3.00', '2014-02-09 21:52:56', 0, 0),
('SNG000006', 'a', '', '3.00', '2014-02-09 21:54:41', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`) VALUES
('MEM000001', 'admin', 'admin@gmail.com', 'admin', 'admin'),
('MEM000002', 'a', 'a@gmail.com', 'a', 'member'),
('MEM000003', 'c', 'c@gmail.com', 'c', 'member'),
('MEM000004', 'r', 'r@gmail.com', 'r', 'member');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
