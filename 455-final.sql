-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 07, 2018 at 07:48 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `455-final`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemName` tinytext CHARACTER SET utf8 NOT NULL,
  `itemPrice` tinytext CHARACTER SET utf8 NOT NULL,
  `itemImg` mediumtext CHARACTER SET utf8 NOT NULL,
  `itemDescription` text CHARACTER SET utf8 NOT NULL,
  `quantity` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `itemName`, `itemPrice`, `itemImg`, `itemDescription`, `quantity`) VALUES
(1, 'Generic Laptop', '100.00', 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/5995/5995102cv12d.jpg', 'This is a generic laptop', 100);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `itemId` int(11) NOT NULL,
  `itemPrice` tinytext NOT NULL,
  `userId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`orderId`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` tinytext CHARACTER SET utf8 NOT NULL,
  `password` text CHARACTER SET utf8 NOT NULL,
  `first_name` tinytext CHARACTER SET utf8 NOT NULL,
  `last_name` tinytext CHARACTER SET utf8 NOT NULL,
  `address` tinytext CHARACTER SET utf8 NOT NULL,
  `card_info` tinytext CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `address`, `card_info`) VALUES
(999, 'admin', '1a1dc91c907325c69271ddf0c944bc72', 'admin', 'account', '1234 something st', '1111222233334444'),
(3, 'test', '1a1dc91c907325c69271ddf0c944bc72', 'something', 'else', '111 something st', '1111222233334444');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
