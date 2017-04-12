-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2017 at 05:34 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company`
--

-- --------------------------------------------------------

--
-- Table structure for table `holiday_table`
--

CREATE TABLE `holiday_table` (
  `holidayId` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `from_time` varchar(100) DEFAULT NULL,
  `leave_type` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `insert_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holiday_table`
--

INSERT INTO `holiday_table` (`holidayId`, `email`, `days`, `reason`, `from_time`, `leave_type`, `status`, `insert_time`) VALUES
(3, 'titas@gmail.com', 3, 'fffff', '2017-02-09', 'Casual', 2, '2017-03-23 17:45:42'),
(4, 'company@gmail.com', 3, 'koliiiiiiij', '2017-02-14', 'Casual', 2, '2017-03-23 17:47:45');

-- --------------------------------------------------------

--
-- Table structure for table `task_table`
--

CREATE TABLE `task_table` (
  `task_id` int(11) NOT NULL,
  `task_headline` varchar(255) DEFAULT NULL,
  `task_details` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `priority` int(20) DEFAULT NULL,
  `progress` int(20) DEFAULT NULL,
  `finish_status` int(10) DEFAULT NULL,
  `task_assign_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `task_deadline_time` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_table`
--

INSERT INTO `task_table` (`task_id`, `task_headline`, `task_details`, `email`, `priority`, `progress`, `finish_status`, `task_assign_time`, `task_deadline_time`) VALUES
(1, 'HHHH', 'asfdghkjljhgfd', 'motiur@gmail.com', 1, 10, 0, '2017-02-06 09:58:14', '2017-02-09'),
(2, 'Titas job', 'Do this jobbbbbbbbbbbbbb', 'titas@gmail.com', 2, 100, 1, '2017-02-06 09:59:13', '2017-02-10'),
(3, 'Titas job', 'rtertreed eerwerscasdsaf eergrr ', 'company@gmail.com', 1, 80, 0, '2017-02-12 19:29:54', '2017-02-14');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `activate_status` int(11) DEFAULT NULL,
  `regtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `fullname`, `email`, `contact`, `password`, `designation`, `user_type`, `activate_status`, `regtime`) VALUES
(5, 'Jobayer Mojumder', 'jobayer.pro@gmail.com', '9876543', '1234', 'admin', 'super_admin', 1, '2017-02-06 12:39:04'),
(6, 'Motiur', 'company@gmail.com', '9876', '1234', 'Content Writer', 'company_employee', 1, '2017-02-12 19:20:23'),
(7, 'Titas', 'titas@gmail.com', '23456', '1234', 'Project Manager', 'company_employee', 1, '2017-02-12 19:20:57'),
(9, 'Manager-2', 'managerhead@gmail.com', '12345', '1234', 'Accountant', 'company_employee', 1, '2017-02-12 19:22:12'),
(10, 'Manager-2', 'jobayer@gmail.com', '23456', '1234', 'Server Admin', 'company_employee', 1, '2017-02-12 19:25:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `holiday_table`
--
ALTER TABLE `holiday_table`
  ADD PRIMARY KEY (`holidayId`);

--
-- Indexes for table `task_table`
--
ALTER TABLE `task_table`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `holiday_table`
--
ALTER TABLE `holiday_table`
  MODIFY `holidayId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `task_table`
--
ALTER TABLE `task_table`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
