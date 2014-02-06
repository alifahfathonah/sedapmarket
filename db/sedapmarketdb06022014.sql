-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2014 at 12:16 PM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sedapmarketdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_desc` text NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_desc`) VALUES
(1, 'Kecap', ''),
(2, 'sambal', '');

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

DROP TABLE IF EXISTS `configuration`;
CREATE TABLE IF NOT EXISTS `configuration` (
  `option_name` varchar(255) NOT NULL,
  `option_title` varchar(255) NOT NULL,
  `option_value` text NOT NULL,
  `option_desc` text NOT NULL,
  `urut` int(11) NOT NULL,
  PRIMARY KEY (`option_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`option_name`, `option_title`, `option_value`, `option_desc`, `urut`) VALUES
('FAVICON', 'File favicon icon', 'favicon.ico', 'File name of your favicon icon', 3),
('FORMATDATE', 'Format Date', 'Y-m-d H:i:s', 'Format Date', 5),
('PAGEITEM', 'Amount Item', '10', 'Amount item per 1 page.', 4),
('SITEDESC', 'Site Description', 'Marketing Application', 'Explain your website', 2),
('SITETITLE', 'Site Title', 'Sedap Market', 'Web site Name/Application Name', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_type` enum('','D','M') NOT NULL,
  `cust_fullname` varchar(255) NOT NULL,
  `cust_npwp` varchar(255) NOT NULL,
  `cust_address` text NOT NULL,
  `cust_city` varchar(255) NOT NULL,
  `cust_state` varchar(255) NOT NULL,
  `region_id` int(11) NOT NULL,
  `cust_payby` enum('','I','C') NOT NULL,
  `cust_phonenumber` varchar(50) NOT NULL,
  `cust_faxnumber` varchar(50) NOT NULL,
  `cust_mobilenumber` varchar(50) NOT NULL,
  `cust_emailaddress` varchar(100) NOT NULL,
  `cust_regdate` date NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `cust_type`, `cust_fullname`, `cust_npwp`, `cust_address`, `cust_city`, `cust_state`, `region_id`, `cust_payby`, `cust_phonenumber`, `cust_faxnumber`, `cust_mobilenumber`, `cust_emailaddress`, `cust_regdate`) VALUES
(2, 'D', 'Ade Sutrisno', '4453343422452', 'Jl Ciledug Blok V/22', 'Jakarta Barat', 'DKI Jakarta', 1, 'I', '227627262', '', '', '', '2014-02-06');

-- --------------------------------------------------------

--
-- Table structure for table `customer_price`
--

DROP TABLE IF EXISTS `customer_price`;
CREATE TABLE IF NOT EXISTS `customer_price` (
  `price_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` bigint(20) NOT NULL DEFAULT '0',
  `disc1` float(5,2) NOT NULL,
  `disc2` float(5,2) NOT NULL,
  `disc3` float(5,2) NOT NULL,
  `price_desc` text NOT NULL,
  PRIMARY KEY (`price_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customer_price`
--

INSERT INTO `customer_price` (`price_id`, `cust_id`, `product_id`, `price`, `disc1`, `disc2`, `disc3`, `price_desc`) VALUES
(1, 2, 1, 15000, 1.00, 1.00, 1.00, '1');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  `group_desc` text NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_kemasan` enum('','Yes','No') NOT NULL,
  `product_stock` int(11) NOT NULL DEFAULT '0',
  `unit_id` int(11) NOT NULL,
  `product_price` bigint(20) NOT NULL DEFAULT '0',
  `product_disc` float(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `product_name`, `product_kemasan`, `product_stock`, `unit_id`, `product_price`, `product_disc`) VALUES
(1, 1, 'Bingo Manis', 'Yes', 100, 1, 15000, 0.00),
(2, 1, 'Bingo asin', 'Yes', 100, 1, 250000, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `region_id` int(11) NOT NULL AUTO_INCREMENT,
  `region_name` varchar(255) NOT NULL,
  `region_desc` text NOT NULL,
  PRIMARY KEY (`region_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`region_id`, `region_name`, `region_desc`) VALUES
(1, 'Jakarta', '');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
CREATE TABLE IF NOT EXISTS `unit` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(255) NOT NULL,
  `unit_desc` text,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_name`, `unit_desc`) VALUES
(1, 'Dus', NULL),
(2, 'kubik', NULL),
(3, 'Kg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_lastlogindate` datetime NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_pass`, `user_name`, `user_lastlogindate`, `group_id`) VALUES
(1, 'andre@asutarko.com', 'e158843af981dc589768882974440a59a90c616d', 'Admin', '2014-02-06 11:41:56', 1),
(2, 'lusiana27@yahoo.com', 'e85ca3eb7b80f152a776e22dbb6d8bee25f90020', 'Admin', '0000-00-00 00:00:00', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
