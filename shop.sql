-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2021 at 12:04 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` smallint(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Ordering` int(11) NOT NULL COMMENT 'To order items',
  `Visibility` tinyint(4) NOT NULL DEFAULT 0,
  `Allow_comment` tinyint(4) NOT NULL DEFAULT 0,
  `Allow_ads` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `name`, `Description`, `Ordering`, `Visibility`, `Allow_comment`, `Allow_ads`) VALUES
(2, 'privet', 'my', 1, 1, 1, 1),
(4, 'playstaion', 'this', 4, 1, 1, 1),
(5, 'pces', 'this is testt catt', 1, 1, 1, 1),
(6, 'playstaion 4', 'this is category play games', 2, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_iD` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `Add_Data` date NOT NULL,
  `country_made` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `Rating` smallint(6) NOT NULL,
  `cat_ID` int(11) NOT NULL,
  `member_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_iD`, `name`, `Description`, `price`, `Add_Data`, `country_made`, `image`, `status`, `Rating`, `cat_ID`, `member_ID`) VALUES
(1, 'adssad', 'sadsadsa', '541', '2021-02-09', 'egypt', '', '2', 0, 0, 0),
(2, 'jous', 'jouss', '12', '2021-02-09', 'chaine', '', '2', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `FullName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT 0,
  `TrustStatus` int(11) NOT NULL DEFAULT 0,
  `RegStatus` int(11) NOT NULL DEFAULT 0,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `username`, `password`, `Email`, `FullName`, `GroupID`, `TrustStatus`, `RegStatus`, `Date`) VALUES
(7, 'ahmed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ahme5d@ahm.com', 'احمد تواب عبد الوهاب', 1, 0, 0, NULL),
(17, 'asdasd', '163cc62e57efd43c052b48bf154e5d2f5d2ccfc2', 'ahmedrayes112277@gmail.com', 'احمد تواب عبد الوهاب', 0, 0, 0, NULL),
(19, 'sada', 'f24e84445c27fdd906c828ce26a69222329235c4', 'sadad@sdad', 'احمد تواب عبد الوهاب', 0, 0, 0, '2021-02-08'),
(20, 'sadsafdsaf', 'd5706908cbd9e5c9cf8b7268aafb7f6d73222062', 'sdfsdaf2@aa', 'asda', 0, 0, 1, '2021-02-01'),
(22, 'aaaasa', '853c43ee11ad2df47d8e2bb96f86aeecc23b60df', 'ahme5d@ahm.coma', 'asdsadsad', 0, 0, 0, '2021-02-07'),
(23, 'adasdsad', '29254084529b387bca53fa41726e7198c88c1424', 'ahmedrayes112277@gmail.com', 'fsadfsa', 0, 0, 1, NULL),
(24, 'asdad', '3ac5e8f184e060793048507eb50c84bcc0ba1825', 'asdad@ffssd', 'asad', 0, 0, 0, NULL),
(25, 'aliab', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '32132@gmail.com', '1321', 0, 0, 1, '2021-02-06'),
(26, 'fathy', '28d462a25e1af470232eaaa560aad698466f5a41', 'asdad@ffssd', 'asdasdsa', 0, 0, 1, '2021-02-06'),
(27, '3bass', '12db64c370b108d5eb35c87517ca388efb91fab5', '010@gmail.com', 'asdsad', 0, 0, 0, '2021-02-07'),
(28, 'ahmed ali', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ahmed_ali@yahoo.com', 'ahmed ali 3a', 0, 0, 1, '2021-02-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_iD`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_iD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
