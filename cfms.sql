-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 08, 2018 at 05:25 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cfms`
--
CREATE DATABASE `cfms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cfms`;

-- --------------------------------------------------------

--
-- Table structure for table `particulars`
--

CREATE TABLE IF NOT EXISTS `particulars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `particulars` varchar(255) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `voucherId` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `particulars`
--


-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `projectCode` varchar(255) NOT NULL,
  `projectName` varchar(255) NOT NULL,
  `projectLocation` text NOT NULL,
  `projectInCharge` varchar(255) NOT NULL,
  `startDate` varchar(255) NOT NULL,
  `endDate` varchar(255) NOT NULL,
  `projectPass` varchar(255) NOT NULL,
  `initialBudget` varchar(255) NOT NULL,
  `projectCost` varchar(255) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `projectCode`, `projectName`, `projectLocation`, `projectInCharge`, `startDate`, `endDate`, `projectPass`, `initialBudget`, `projectCost`, `status`) VALUES
(1, 'projectX', 'Project X 101', 'Polangui Albay', 'Engr. Mian', '2018-02-03', '2019-02-03', '1234567', '500000', '', '1'),
(2, 'projectXv1', 'Project X 101', 'Polangui Albay', 'Engr. Mian', '2018-02-03', '2019-02-03', '1234567', '500000', '1000000', '1');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `projectId` int(3) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `qty` int(3) NOT NULL,
  `price` int(20) NOT NULL,
  `date` varchar(50) NOT NULL,
  `requesteeId` int(3) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `projectId`, `brand`, `type`, `qty`, `price`, `date`, `requesteeId`, `status`) VALUES
(47, 0, 'asdasd', 'asd', 300, 300, '', 0, '1'),
(33, 1, 'Mayon', 'Cement', 20, 300, '', 0, '2'),
(32, 1, 'Portland', 'Cement', 30, 20, '', 0, '2'),
(31, 1, 'asda1', 'asd', 0, 0, '', 0, '2'),
(30, 1, 'Portland', 'Cement', 30, 300, '', 0, '0'),
(29, 1, 'Mayon', 'Cement', 20, 300, '', 0, '2'),
(28, 1, 'Portland', 'Cement', 30, 20, '', 0, '2'),
(27, 1, 'asda1', 'asd', 0, 0, '', 0, '2'),
(39, 1, 'Portland', 'Cement', 100, 800, '', 0, '0'),
(40, 1, 'Portland', 'Cement', 100, 800, '', 0, '0'),
(41, 1, 'Portland', 'Cement', 100, 800, '', 0, '0'),
(42, 1, 'Portland', 'Cement', 100, 800, '', 0, '0'),
(43, 1, 'Portland', 'Cement', 100, 800, '', 0, '2'),
(46, 2, 'Portland', 'Cement', 100, 400, '', 0, '0'),
(45, 2, 'asdjakl', 'ashdkj', 301, 300, '', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `accountType` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `middleName`, `lastName`, `userName`, `accountType`, `password`, `status`) VALUES
(1, 'Administrator', 'admin', 'admin', 'admin', '1', 'admin', '1'),
(3, 'franky', 'Seletaria', 'Samaniego', 'samaniego', '2', 'samaniego_23', '1');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE IF NOT EXISTS `vouchers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `requesteeId` varchar(20) NOT NULL,
  `voucherNo` varchar(20) NOT NULL,
  `requestDate` varchar(30) NOT NULL,
  `payee` varchar(255) NOT NULL,
  `type` varchar(2) NOT NULL,
  `status` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `vouchers`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
