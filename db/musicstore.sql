-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 15, 2014 at 12:05 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

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
(14, 'ART000006', 'SNG000006'),
(15, 'ART000006', 'SNG000007');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `member_id` varchar(15) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `DOB` datetime DEFAULT NULL,
  `contact_phone` varchar(30) NOT NULL,
  `contact_email` varchar(30) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `firstname`, `lastname`, `DOB`, `contact_phone`, `contact_email`, `country`, `zipcode`) VALUES
('MEM_000001', 'a', 'a', '0000-00-00 00:00:00', '', '', '', ''),
('MEM_000002', 'c', 'c', '2014-03-14 00:00:00', 'c', 'c@gmail.com', 'c', 'c'),
('MEM_000004', 'g', 'g', '2014-03-14 00:00:00', 'g', 'g@gmail.com', 'g', 'g');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` varchar(15) NOT NULL,
  `paymentdate` datetime NOT NULL,
  `purchase_id` varchar(15) NOT NULL,
  `cardno` varchar(30) NOT NULL,
  `cardtype` varchar(10) NOT NULL,
  `cardholdername` varchar(30) NOT NULL,
  `securitycode` varchar(5) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `paymentdate`, `purchase_id`, `cardno`, `cardtype`, `cardholdername`, `securitycode`) VALUES
('1179271741', '2014-03-04 19:27:19', '1370907942', 'a', 'mastercard', 'a', 'a'),
('1191031754', '2014-02-24 01:37:56', '1302783804', 'b', 'mastercard', 'b', 'b'),
('1229441104', '2014-02-24 01:24:24', '1145223358', 'a', 'mastercard', 'a', 'a'),
('1326157855', '2014-03-04 20:04:19', '1219277680', '23r', 'mastercard', 'asdf', 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `purchasedetails`
--

CREATE TABLE IF NOT EXISTS `purchasedetails` (
  `purcahsedetail_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_id` varchar(15) NOT NULL,
  `song_id` varchar(15) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`purcahsedetail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `purchasedetails`
--

INSERT INTO `purchasedetails` (`purcahsedetail_id`, `purchase_id`, `song_id`, `price`) VALUES
(3, '1145223358', 'SNG000003', '3.00'),
(4, '1145223358', 'SNG000001', '32.00'),
(5, '1302783804', 'SNG000007', '33.00'),
(6, '1302783804', 'SNG000002', '3.00'),
(7, '1370907942', 'SNG000006', '3.00'),
(8, '1219277680', 'SNG000006', '3.00');

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

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `purchasedate`, `member_id`, `total`) VALUES
('1145223358', '2014-02-24 01:24:24', 'MEM000002', '35.00'),
('1219277680', '2014-03-04 20:04:19', 'MEM000002', '3.00'),
('1302783804', '2014-02-24 01:37:56', 'MEM000002', '36.00'),
('1370907942', '2014-03-04 19:27:19', 'MEM000002', '3.00');

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
('SNG000006', 'a', '', '3.00', '2014-02-09 21:54:41', 0, 0),
('SNG000007', 'abc', '05 Kyar Par Tae Kwar.mp3', '33.00', '2014-02-23 19:18:40', 0, 0);

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
('MEM_000001', 'admin', 'admin@gmail.com', 'admin', 'admin'),
('MEM_000002', 'a', 'a@gmail.com', 'a', 'member'),
('MEM_000003', 'c', 'c@gmail.com', 'c', 'member'),
('MEM_000004', 'g', 'g@gmail.com', 'g', 'member');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
