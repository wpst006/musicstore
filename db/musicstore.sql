-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2014 at 01:34 PM
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
('ALM_000001', 'Eminem Album', '2014-03-29 00:00:00', 'Publisher 1', 'DVD'),
('ALM_000002', 'Mariah Carey Album', '2014-03-27 00:00:00', 'Publisher 2', 'CD'),
('ALM_000003', 'Britney Spear Album', '2014-03-27 00:00:00', 'Publisher 1', 'CD');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE IF NOT EXISTS `artists` (
  `artist_id` varchar(15) NOT NULL,
  `artistname` varchar(30) NOT NULL,
  `gender` char(1) NOT NULL,
  PRIMARY KEY (`artist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`artist_id`, `artistname`, `gender`) VALUES
('ART_000001', 'Eminem', 'M'),
('ART_000002', 'Rihanna', 'F'),
('ART_000003', 'Mariah Carey', 'F'),
('ART_000004', 'Aero Smith', 'M'),
('ART_000005', 'Backstreet Boy', 'M'),
('ART_000006', 'Westlife', 'M'),
('ART_000007', 'Britney Spears', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `artists_songs`
--

CREATE TABLE IF NOT EXISTS `artists_songs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `artist_id` varchar(15) NOT NULL,
  `song_id` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `artists_songs`
--

INSERT INTO `artists_songs` (`id`, `artist_id`, `song_id`) VALUES
(3, 'ART_000001', 'SNG_000001'),
(4, 'ART_000002', 'SNG_000001'),
(5, 'ART_000001', 'SNG_000002'),
(6, 'ART_000003', 'SNG_000003'),
(8, 'ART_000007', 'SNG_000004');

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
('AUT_000001', 'author 1', 'M'),
('AUT_000002', 'author 2', 'F'),
('AUT_000003', 'author 3', 'M'),
('AUT_000004', 'authro 4', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `authors_songs`
--

CREATE TABLE IF NOT EXISTS `authors_songs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` varchar(15) NOT NULL,
  `song_id` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `authors_songs`
--

INSERT INTO `authors_songs` (`id`, `author_id`, `song_id`) VALUES
(2, 'AUT_000001', 'SNG_000001'),
(3, 'AUT_000002', 'SNG_000002'),
(4, 'AUT_000003', 'SNG_000003'),
(5, 'AUT_000004', 'SNG_000003'),
(7, 'AUT_000002', 'SNG_000004');

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE IF NOT EXISTS `awards` (
  `award_id` varchar(15) NOT NULL,
  `award_year` datetime NOT NULL,
  `vote_count` int(11) NOT NULL,
  `song_id` varchar(15) NOT NULL,
  PRIMARY KEY (`award_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`award_id`, `award_year`, `vote_count`, `song_id`) VALUES
('AWD_000001', '2014-03-29 00:00:00', 1, 'SNG_000001');

-- --------------------------------------------------------

--
-- Stand-in structure for view `awards_view`
--
CREATE TABLE IF NOT EXISTS `awards_view` (
`award_id` varchar(15)
,`award_year` datetime
,`vote_count` int(11)
,`song_id` varchar(15)
,`title` varchar(50)
);
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
('MEM_000001', 'admin', 'admin', '2014-03-06 00:00:00', 'admin', 'admin', 'admin', 'admin'),
('MEM_000002', 'a', 'a', '2014-03-27 00:00:00', 'a', 'a@gmail.com', 'a', 'abc'),
('MEM_000003', 'b', 'b', '2014-03-27 00:00:00', 'b', 'b@gmail.com', 'b', 'b'),
('MEM_000004', 'c', 'c', '2014-03-29 00:00:00', 'c', 'c@gmail.com', 'c', 'c'),
('MEM_000005', 'd', 'd', '2014-03-29 00:00:00', 'd', 'd@gmail.com', 'd', 'd');

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
('1122871123', '2014-03-27 12:07:42', '1155614866', 'b', 'mastercard', 'b', 'b'),
('1212480776', '2014-03-27 12:00:21', '1141656124', 'a', 'mastercard', 'a', 'a'),
('1365050744', '2014-03-29 12:06:18', '1203174948', 'c', 'mastercard', 'c', 'c');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `purchasedetails`
--

INSERT INTO `purchasedetails` (`purcahsedetail_id`, `purchase_id`, `song_id`, `price`) VALUES
(1, '1141656124', 'SNG_000002', '75.00'),
(2, '1155614866', 'SNG_000004', '30.00'),
(3, '1203174948', 'SNG_000004', '30.00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `purchasedetails_view`
--
CREATE TABLE IF NOT EXISTS `purchasedetails_view` (
`purchase_id` varchar(15)
,`song_id` varchar(15)
,`title` varchar(50)
,`length` varchar(10)
,`song_type` varchar(50)
,`price` decimal(10,2)
);
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
('1141656124', '2014-03-12 12:00:21', 'MEM_000002', '75.00'),
('1155614866', '2014-03-27 12:07:42', 'MEM_000003', '30.00'),
('1203174948', '2014-03-29 12:06:18', 'MEM_000004', '30.00');

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
('SNG_000001', 'Love the way you lie', '3 min', 'ALM_000001', 'Rap', 'Love the way you lie - Eminem.mp3', '100.00', 1),
('SNG_000002', 'I Need a doctor', '6 min', 'ALM_000001', 'Rap', 'I need a doctor - Eminem.mp3', '75.00', 0),
('SNG_000003', 'My All', '5 min', 'ALM_000002', 'Pop', 'Mariah Carey - My All.mp3', '50.00', 0),
('SNG_000004', 'Toxic', '3 min', 'ALM_000003', 'Pop', 'Britney Spears - Toxic.mp3', '30.00', 1);

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
('MEM_000003', 'b', 'b@gmail.com', 'b', 'member'),
('MEM_000004', 'c', 'c@gmail.com', 'c', 'member'),
('MEM_000005', 'd', 'd@gmail.com', 'd', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `vote_id` varchar(15) NOT NULL,
  `vote_date` datetime NOT NULL,
  `member_id` varchar(15) NOT NULL,
  `song_id` varchar(15) NOT NULL,
  `messagedetails` varchar(255) NOT NULL,
  PRIMARY KEY (`vote_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`vote_id`, `vote_date`, `member_id`, `song_id`, `messagedetails`) VALUES
('VOT_000001', '2014-03-27 00:00:00', 'MEM_000002', 'SNG_000001', 'I Like It'),
('VOT_000002', '2014-03-27 00:00:00', 'MEM_000003', 'SNG_000004', ' Very Nice.                 ');

-- --------------------------------------------------------

--
-- Structure for view `awards_view`
--
DROP TABLE IF EXISTS `awards_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `awards_view` AS select `awards`.`award_id` AS `award_id`,`awards`.`award_year` AS `award_year`,`awards`.`vote_count` AS `vote_count`,`songs`.`song_id` AS `song_id`,`songs`.`title` AS `title` from (`awards` join `songs` on((`awards`.`song_id` = `songs`.`song_id`))) order by `awards`.`award_id`;

-- --------------------------------------------------------

--
-- Structure for view `purchasedetails_view`
--
DROP TABLE IF EXISTS `purchasedetails_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purchasedetails_view` AS select `purchasedetails`.`purchase_id` AS `purchase_id`,`purchasedetails`.`song_id` AS `song_id`,`songs`.`title` AS `title`,`songs`.`length` AS `length`,`songs`.`song_type` AS `song_type`,`purchasedetails`.`price` AS `price` from (`purchasedetails` join `songs` on((`purchasedetails`.`song_id` = `songs`.`song_id`))) order by `songs`.`song_id`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
