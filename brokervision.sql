-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Aug 28, 2016 at 01:25 AM
-- Server version: 5.5.49-log
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brokervision`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE IF NOT EXISTS `accessories` (
  `accessoryID` int(11) NOT NULL,
  `propertyID` int(11) NOT NULL,
  `description` varchar(300) NOT NULL,
  `value` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auctions`
--

CREATE TABLE IF NOT EXISTS `auctions` (
  `auctionID` int(11) NOT NULL,
  `ownerID` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `startDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `endDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `priceWeight` int(11) NOT NULL DEFAULT '100',
  `TIWeight` int(11) NOT NULL DEFAULT '100',
  `FRWeight` int(11) NOT NULL DEFAULT '100',
  `escalationWeight` int(11) NOT NULL DEFAULT '100',
  `termWeight` int(11) NOT NULL DEFAULT '100'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auctions`
--

INSERT INTO `auctions` (`auctionID`, `ownerID`, `title`, `startDate`, `endDate`, `priceWeight`, `TIWeight`, `FRWeight`, `escalationWeight`, `termWeight`) VALUES
(1, 1, 'CREForge Property Auction', '2016-08-27 04:06:07', '2016-08-28 18:45:00', 100, 50, 100, 100, 100),
(2, 4, 'Google Property Auction', '0000-00-00 00:00:00', '2016-08-28 20:00:00', 100, 100, 100, 100, 100);

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE IF NOT EXISTS `bids` (
  `bidID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` decimal(10,2) NOT NULL,
  `TI` decimal(10,2) NOT NULL,
  `FR` decimal(10,2) NOT NULL,
  `escalation` decimal(10,2) NOT NULL,
  `term` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`bidID`, `memberID`, `date`, `price`, `TI`, `FR`, `escalation`, `term`) VALUES
(3, 1, '2016-08-27 17:22:40', 20.00, 2.00, 1.00, 1.00, 5.00),
(4, 2, '2016-08-27 17:22:40', 20.00, 1.50, 2.00, 2.00, 10.00),
(5, 1, '2016-08-27 17:27:02', 18.00, 2.00, 2.00, 1.00, 10.00),
(6, 2, '2016-08-27 17:27:02', 17.00, 2.00, 2.00, 2.50, 8.00),
(7, 1, '2016-08-27 20:49:39', 18.00, 2.00, 2.00, 1.00, 10.00),
(8, 1, '2016-08-27 20:50:12', 7.00, 3.00, 6.00, 2.00, 8.00),
(9, 3, '2016-08-27 21:40:06', 15.00, 2.00, 2.00, 3.00, 1.50);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `memberID` int(11) NOT NULL,
  `auctionID` int(11) NOT NULL,
  `propertyID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`memberID`, `auctionID`, `propertyID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE IF NOT EXISTS `property` (
  `propertyID` int(11) NOT NULL,
  `ownerID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sqft` int(10) unsigned NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `address` varchar(300) NOT NULL,
  `availableDate` datetime NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`propertyID`, `ownerID`, `title`, `sqft`, `lat`, `lng`, `address`, `availableDate`, `price`) VALUES
(1, 2, '200 W Madison', 100000, 0.000000, 0.000000, '200 W Madison', '2016-09-01 00:00:00', 0),
(2, 3, '1 S Wacker', 100000, 0.000000, 0.000000, '1 S Wacker', '2016-09-15 00:00:00', 0),
(3, 6, 'Union Station', 100000, 0.000000, 0.000000, '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` char(32) NOT NULL,
  `type` varchar(200) NOT NULL,
  `company` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `first_name`, `last_name`, `email`, `password`, `type`, `company`) VALUES
(1, 'John', 'Horton', 'johnharoldhorton@gmail.com', 'e3c9c373c82d6d5bd4a4aa6a8269bbe6', 'tenant', ''),
(2, 'Chester', 'McExample', 'pm1@creforge.com', 'd4277f68d6be7806b30501edfcfd0fd0', 'pm', ''),
(3, 'Nancy', 'Fakeuser', 'pm2@creforge.com', '3da961580b1319ae35bcfd766dd5869d', 'pm', ''),
(4, 'Alex', 'Brokerson', 'broker1@creforge.com', 'ecb8d44f1bb507250d73a0f8a84cadcf', 'broker', ''),
(5, 'Pat', 'Realtor', 'broker2@creforge.com', 'ce4854bd0453ee6e166c2a4982e5b290', 'broker', ''),
(6, 'Larry', 'Propertyguy', 'pm3@creforge.com', '17b0d6dc9db2f54ff5a6382b79c5014f', 'pm', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`accessoryID`);

--
-- Indexes for table `auctions`
--
ALTER TABLE `auctions`
  ADD PRIMARY KEY (`auctionID`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`bidID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`propertyID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `accessoryID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `auctions`
--
ALTER TABLE `auctions`
  MODIFY `auctionID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `bidID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `propertyID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
