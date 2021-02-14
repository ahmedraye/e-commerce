-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2021 at 12:09 PM
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
  `ID` int(11) NOT NULL,
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
(7, 'books', ' show best books', 1, 1, 1, 1),
(8, 'pc', 'pc', 2, 1, 1, 1),
(9, 'Hand made', 'hand made', 3, 1, 1, 0),
(10, 'electronics', 'electronics pcs', 4, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `C_ID` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_Date` datetime NOT NULL,
  `comment_Status` tinyint(4) NOT NULL DEFAULT 1,
  `item_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `approve_items` tinyint(4) NOT NULL DEFAULT 0,
  `cat_ID` int(11) NOT NULL,
  `member_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_iD`, `name`, `Description`, `price`, `Add_Data`, `country_made`, `image`, `status`, `Rating`, `approve_items`, `cat_ID`, `member_ID`) VALUES
(7, 'ahay', 'ahay book', '20$', '2021-02-17', 'egypt', '', '', 0, 0, 7, 12),
(8, 'magic pc', 'pcs \r\n2 ram dd3', '500$', '2021-02-09', 'chine', '', '1', 0, 0, 10, 12),
(9, 'q computer', 'this is QCoumpter', '22$', '2021-02-12', 'egypt', '', '1', 0, 0, 7, 12),
(10, 'chemstery', 'In addition to styling the content within cards, Bootstrap includes a few options for laying out series of cards. For the time being, these layout options are not yet', '20$', '2021-02-12', 'china', '', '1', 0, 0, 7, 19),
(11, 'layout', 'In addition to styling the content within cards, Bootstrap includes a few options for laying out series of cards. For the time being, these layout options are not yet', '15$', '2021-02-12', 'eg', '', '1', 0, 0, 7, 12),
(12, 'bootstrap', 'layout bootsrap', '56$', '2021-02-12', 'USA', '', '1', 0, 0, 7, 12);

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
(12, 'ahmed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ahme5d@ahm.com', 'احمد تواب عبد الوهاب', 1, 0, 0, NULL),
(17, 'asdasd', '163cc62e57efd43c052b48bf154e5d2f5d2ccfc2', 'ahmedrayes112277@gmail.com', 'احمد تواب عبد الوهاب', 0, 0, 0, NULL),
(19, 'sada', 'f24e84445c27fdd906c828ce26a69222329235c4', 'sadad@sdad', 'احمد تواب عبد الوهاب', 0, 0, 0, '2021-02-08'),
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
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`C_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `item_ID` (`item_ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_iD`),
  ADD KEY `cat_ID` (`cat_ID`),
  ADD KEY `member_ID` (`member_ID`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `C_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_iD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`item_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`cat_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_ibfk_3` FOREIGN KEY (`member_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
