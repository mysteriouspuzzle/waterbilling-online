-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2019 at 12:40 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_waterbilling`
--

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `id` int(255) NOT NULL,
  `pass_id` int(15) NOT NULL,
  `code` int(15) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`id`, `pass_id`, `code`, `status`) VALUES
(1, 3, 827493, 'Expired'),
(2, 3, 809348, 'Expired'),
(3, 3, 388192, 'Expired'),
(4, 3, 695636, 'Expired'),
(5, 3, 301444, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `consumers`
--

CREATE TABLE `consumers` (
  `id` int(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `contactNumber` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `online` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consumers`
--

INSERT INTO `consumers` (`id`, `firstname`, `middlename`, `lastname`, `birthdate`, `address`, `contactNumber`, `email`, `online`) VALUES
(1, 'Makisig', '', 'Gerero', '2009-03-04', 'Lacion City', '09342324255', 'mysterious.puzzle15@gmail.com', 0),
(2, 'Jake Joseph', 'Malinao', 'Lingatong', '2018-10-22', 'Bogo', '09328478343', 'mysterious.puzzle15@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `id` int(15) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `userLevel` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`id`, `fullname`, `username`, `password`, `userLevel`, `email`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@admin.com'),
(2, 'Reader', 'reader', '1de9b0a30075ae8c303eb420c103c320', 'Reader', 'asd@afds.co'),
(3, 'Teller', 'teller', '8482dfb1bca15b503101eb438f52deed', 'Teller', 'mysterious.puzzle15@gmail.com'),
(4, 'Accounting', 'accounting', 'd4c143f004d88b7286e6f999dea9d0d7', 'Accounting', 'accounting@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(10) NOT NULL,
  `cubic_meter` varchar(30) NOT NULL,
  `minimum` int(5) NOT NULL,
  `maximum` int(5) NOT NULL,
  `rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `cubic_meter`, `minimum`, `maximum`, `rate`) VALUES
(1, 'Minimum-10 cu. m.', 0, 10, 35),
(2, '11-20 cu. m.', 11, 20, 3.85),
(3, '21-30 cu. m.', 21, 30, 4.25);

-- --------------------------------------------------------

--
-- Table structure for table `reading`
--

CREATE TABLE `reading` (
  `id` int(11) NOT NULL,
  `consumer_id` int(11) NOT NULL,
  `previous_read` varchar(10) NOT NULL,
  `next_read` varchar(10) NOT NULL,
  `rate` int(10) NOT NULL,
  `date` date NOT NULL,
  `payment` float NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reading`
--

INSERT INTO `reading` (`id`, `consumer_id`, `previous_read`, `next_read`, `rate`, `date`, `payment`, `status`) VALUES
(1, 2, '', '0000', 0, '2019-03-01', 0, 0),
(2, 1, '', '0000', 0, '2019-03-01', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sms_api`
--

CREATE TABLE `sms_api` (
  `id` int(10) NOT NULL,
  `endpoint` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_api`
--

INSERT INTO `sms_api` (`id`, `endpoint`) VALUES
(1, 'http://192.168.1.6:8080/');

-- --------------------------------------------------------

--
-- Table structure for table `user_levels`
--

CREATE TABLE `user_levels` (
  `id` int(255) NOT NULL,
  `user_level` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_levels`
--

INSERT INTO `user_levels` (`id`, `user_level`) VALUES
(1, 'Administrator'),
(2, 'Reader'),
(3, 'Teller'),
(4, 'Accounting'),
(5, 'Consumer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consumers`
--
ALTER TABLE `consumers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reading`
--
ALTER TABLE `reading`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_api`
--
ALTER TABLE `sms_api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_levels`
--
ALTER TABLE `user_levels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `consumers`
--
ALTER TABLE `consumers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `reading`
--
ALTER TABLE `reading`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sms_api`
--
ALTER TABLE `sms_api`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_levels`
--
ALTER TABLE `user_levels`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
