-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2014 at 08:28 AM
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
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `album_id` varchar(15) NOT NULL,
  `title` varchar(50) NOT NULL,
  `publishing_date` datetime NOT NULL,
  `publisher` varchar(50) NOT NULL,
  `cd_dvd` varchar(15) NOT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`album_id`, `title`, `publishing_date`, `publisher`, `cd_dvd`) VALUES
('ALM_000001', 'Eminem Album', '2014-03-16 00:00:00', 'Publisher Eminem', 'CD'),
('ALM_000002', 'Backstreet Boy Album', '2014-03-16 00:00:00', 'Backstreet Boy Publisher', 'CD'),
('ALM_000003', 'Mariah Carey Album', '2014-03-16 00:00:00', 'Mariah Carey Publisher', 'CD');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `artists_songs`
--

INSERT INTO `artists_songs` (`id`, `artist_id`, `song_id`) VALUES
(7, 'ART000006', 'SNG_000001'),
(8, 'ART000001', 'SNG_000001'),
(9, 'ART000006', 'SNG_000002'),
(10, 'ART000002', 'SNG_000003'),
(11, 'ART000006', 'SNG_000004');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` varchar(15) NOT NULL,
  `authorname` varchar(50) NOT NULL,
  `gender` char(1) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `authorname`, `gender`) VALUES
('AUT_000001', 'Author 1', 'M'),
('AUT_000002', 'Author 2', 'F'),
('AUT_000003', 'Author 3', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `authors_songs`
--

CREATE TABLE IF NOT EXISTS `authors_songs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` varchar(15) NOT NULL,
  `song_id` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `authors_songs`
--

INSERT INTO `authors_songs` (`id`, `author_id`, `song_id`) VALUES
(5, 'AUT_000001', 'SNG_000001'),
(6, 'AUT_000002', 'SNG_000001'),
(7, 'AUT_000002', 'SNG_000002'),
(8, 'AUT_000001', 'SNG_000003'),
(9, 'AUT_000002', 'SNG_000004');

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
('MEM_000001', 'a', 'a', '2014-03-14 00:00:00', '', '', '', ''),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `length` varchar(10) NOT NULL,
  `album_id` varchar(15) NOT NULL,
  `song_type` varchar(50) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `unitprice` decimal(10,2) NOT NULL,
  `vote_count` int(11) unsigned NOT NULL,
  PRIMARY KEY (`song_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`song_id`, `title`, `length`, `album_id`, `song_type`, `filename`, `unitprice`, `vote_count`) VALUES
('SNG_000001', 'song title', '3 min', 'ALM_000001', 'Pop', '02 A Lwan Thint Pa Chi.mp3', '5.00', 0),
('SNG_000002', 'a', 'asdf', 'ALM_000001', 'Rock', 'lay phyu (2).MP3', '3.00', 0),
('SNG_000003', 'adsf', 'sadf', 'ALM_000001', 'Pop', '10 Chit Chin A Lin Kar - Feat - Aung La.mp3', '3.00', 0),
('SNG_000004', 'sadf', 'asdf', 'ALM_000001', 'Rap', 'lay phyu (2).MP3', '5.00', 0);

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
