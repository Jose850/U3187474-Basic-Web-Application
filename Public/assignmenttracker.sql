-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 29, 2021 at 11:44 PM
-- Server version: 5.7.32
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignmenttracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignmenttracker`
--

CREATE TABLE `assignmenttracker` (
  `id` int(10) UNSIGNED NOT NULL,
  `assignmentname` varchar(50) NOT NULL,
  `classname` varchar(50) NOT NULL,
  `duedate` varchar(30) DEFAULT NULL,
  `assignmentpercentage` varchar(30) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userid` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignmenttracker`
--

INSERT INTO `assignmenttracker` (`id`, `assignmentname`, `classname`, `duedate`, `assignmentpercentage`, `date`, `userid`) VALUES
(13, '', '', '', '', '2021-08-29 02:18:18', 0),
(14, '', '', '', '', '2021-08-29 02:20:02', 0),
(15, '', '', '', '', '2021-08-29 02:22:38', 0),
(16, '', '', '', '', '2021-08-29 02:22:52', 0),
(17, '', '', '', '', '2021-08-29 02:23:03', 0),
(18, '', '', '', '', '2021-08-29 02:26:24', 0),
(19, '', '', '', '', '2021-08-29 02:26:51', 0),
(20, '', '', '', '', '2021-08-29 02:31:02', 0),
(21, '', '', '', '', '2021-08-29 02:31:24', 0),
(22, 'test', 'test', 'sds', 'asdad', '2021-08-29 05:48:09', 0),
(23, 'this should be only viewable by root', 'sfnksf', 'sfjksf', 'sfjksf', '2021-08-29 06:05:42', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignmenttracker`
--
ALTER TABLE `assignmenttracker`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignmenttracker`
--
ALTER TABLE `assignmenttracker`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
